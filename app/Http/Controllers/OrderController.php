<?php

namespace App\Http\Controllers;
use App\User;
use App\Orders;
use App\OrdersProducts;
use App\Payments;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;

use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\RedirectUrls;
use PayPal\Api\Transaction;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Rest\ApiContext;
use Redirect;
use Session;
use URL;

class OrderController extends AppBaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    private $_api_context;
    public function __construct()
    {
        /** PayPal api context **/
        $paypal_conf = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential(
                $paypal_conf['client_id'],
                $paypal_conf['secret'])
        );
        $this->_api_context->setConfig($paypal_conf['settings']);

    }

    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function orderByPaypal(Request $request)
    {
    
      $checkout_detail =  json_decode($request->checkout_detail);
      $business_detail = json_decode($checkout_detail->business_detail);
     $product_quantity = $checkout_detail->product_quantity;
     $shipping_rate = $checkout_detail->shipping_rate;
     $total_price = $checkout_detail->total_price;
     $price_currency = $checkout_detail->price_currency;
     $payment_method = $checkout_detail->payment_method;
     $customer_type = $checkout_detail->customer_type;
     $account_password = $checkout_detail->account_password;
     $admin_product_comment = $checkout_detail->admin_product_comment;
     $csr_name = $checkout_detail->csr_name;
     $customer_id = 0;
     if($customer_type == 'guest')
     {

         $order_id = $this->orderStore($customer_id , $business_detail , $shipping_rate , $total_price , $price_currency , $admin_product_comment ,$product_quantity ,$csr_name ,$payment_method);
        

    }
     else if($customer_type == 'registered')
     {
        $loginData = array(
            'name' => $business_detail->customer_name,
            'email' => $business_detail->customer_email,
            'password'=>$account_password,
         );
         if (User::where('email', $loginData['email'])->exists()) {
            return $this->sendError('User is already exists in our systems, please try witn different email addres', 409);
        }
        else
        {
            $loggedIn_customer =  $this->create_customer($loginData); 
            $customer_id = $loggedIn_customer->id;    
            $order_id = $this->orderStore( $customer_id , $business_detail , $shipping_rate , $total_price , $price_currency , $admin_product_comment ,$product_quantity ,$csr_name , $payment_method);
            

            

        }
       


     }


        //paypal start
        $payer = new Payer();
        $payer->setPaymentMethod('paypal');
        $items = [];
        //add order products
        
            $price_detail = array(
                'total_price' => $total_price,
                'shipping_price' => $shipping_rate,
                'price_currency' => $price_currency,
                'payment_method'=>$payment_method,
             );
                Session::put('order_id', $order_id);
               Session::put('price_detail', $price_detail);


        foreach ($checkout_detail->itemsDetail as $key => $item) 
        {
         $OrdersProducts = new OrdersProducts;
         $OrdersProducts->product_id = $item->product_id;
         $OrdersProducts->title = $item->prdocut_name;
         $OrdersProducts->image = $item->product_image;
         $OrdersProducts->order_id = $order_id;
         $OrdersProducts->save();
         ${'item_' . $key}  = new Item();
         ${'item_' . $key}->setName($item->prdocut_name);

         $items[] = ${'item_' . $key};
        }
         //add order products


        $item_list = new ItemList();

        $item_list->setItems($items);

        $amount = new Amount();
        $amount->setCurrency('USD')
            ->setTotal($total_price);

        $transaction = new Transaction();
        $transaction->setAmount($amount)
            ->setItemList($item_list)
            ->setDescription($admin_product_comment)
            ->setInvoiceNumber(uniqid());

        $redirect_urls = new RedirectUrls();
        $redirect_urls->setReturnUrl(URL::to('payment-status')) /** Specify return URL **/
        ->setCancelUrl(URL::to('payment-status'));

        $payment = new Payment();
        $payment->setIntent('Sale')
            ->setPayer($payer)
            ->setRedirectUrls($redirect_urls)
            ->setTransactions(array($transaction));
        /** dd($payment->create($this->_api_context));exit; **/
        try {

            $payment->create($this->_api_context);

        } catch (\PayPal\Exception\PPConnectionException $ex) {

            if (\Config::get('app.debug')) {
                $order_fail_message = 'Your order Failed due to some Issue . Please Try again.';
                return redirect()->back()->with('order_fail',$order_fail_message));
                
            } else {

            $order_fail_message = 'Your order Failed due to some Issue . Please Try again.';
                return redirect()->back()->with('order_fail',$order_fail_message));
                
            }

        }
           foreach ($payment->getLinks() as $link) {

            if ($link->getRel() == 'approval_url') {

                $orderPayment = new Payments;
                $orderPayment->order_id = Session::get('order_id'); 
                $orderPayment->payment_type = Session::get('price_detail')->payment_method;
                $orderPayment->status =  0; //failed payment
                $orderPayment->save();

                Session::put('order_payment_id', $orderPayment->id);
                $redirect_url = $link->getHref();
                break;

            }

        }

        /** add payment ID to session **/
        Session::put('paypal_payment_id', $payment->getId());

        if (isset($redirect_url)) {

            /** redirect to paypal **/
            return Redirect::away($redirect_url);

        }


            $order_fail_message = 'Your order Failed due to some Issue . Please Try again.';
                return redirect()->back()->with('order_fail',$order_fail_message));



        //paypal end

}
public function paymentStatus()
{

 $payment_id = Session::get('paypal_payment_id');

        /** clear the session payment ID **/
        Session::forget('paypal_payment_id');

        if (empty(Input::get('PayerID')) || empty(Input::get('token'))) {

            return Redirect::to('/order/fail');

        }  

        $payment = Payment::get($payment_id, $this->_api_context);
        $execution = new PaymentExecution();
        $execution->setPayerId(Input::get('PayerID'));

        /**Execute the payment **/
        $result = $payment->execute($execution, $this->_api_context);

        $order_payment_id = Session::get('order_payment_id');
        Session::forget('order_payment_id');


         if ($result->getState() == 'approved') {

            $transactions = $payment->getTransactions();
            $transaction = $transactions[0];
            $relatedResources = $transaction->getRelatedResources();
            $relatedResource = $relatedResources[0];
            $sale = $relatedResource->getSale();
            $saleId = $sale->getId();

            $orderDetails = Payments::find($order_payment_id);
            $orderDetails->paypal_payment_id =  $saleId;
            $orderDetails->status = 1;
            $orderDetails->save();

            $emailService = app(EmailService::class);
            $emailService->orderEmail($order->id);

            
            return Redirect::to('/order/success');

        }


}
    public function orderByStripe(Request $request)
    {


      $checkout_detail =  json_decode($request->checkout_detail);
      $business_detail = json_decode($checkout_detail->business_detail);
     $product_quantity = $checkout_detail->product_quantity;
     $shipping_rate = $checkout_detail->shipping_rate;
     $total_price = $checkout_detail->total_price;
     $price_currency = $checkout_detail->price_currency;
     $payment_method = $checkout_detail->payment_method;
     $customer_type = $checkout_detail->customer_type;
     $account_password = $checkout_detail->account_password;
     $admin_product_comment = $checkout_detail->admin_product_comment;
     $csr_name = $checkout_detail->csr_name;
     $stripe_token = $checkout_detail->stripe_token;
     $customer_id = 0;
     if($customer_type == 'guest')
     {

         $order_id = $this->orderStore($customer_id , $business_detail , $shipping_rate , $total_price , $price_currency , $admin_product_comment ,$product_quantity ,$csr_name ,$payment_method);
        

    }
     else if($customer_type == 'registered')
     {
        $loginData = array(
            'name' => $business_detail->customer_name,
            'email' => $business_detail->customer_email,
            'password'=>$account_password,
         );
         if (User::where('email', $loginData['email'])->exists()) {
            return $this->sendError('User is already exists in our systems, please try witn different email addres', 409);
        }
        else
        {
            $loggedIn_customer =  $this->create_customer($loginData); 
            $customer_id = $loggedIn_customer->id;    
            $order_id = $this->orderStore( $customer_id , $business_detail , $shipping_rate , $total_price , $price_currency , $admin_product_comment ,$product_quantity ,$csr_name , $payment_method);
            Session::put('order_id', $order_id);

        }
       


     }
        //add order products
        Session::put('order_id', $order_id);
        foreach ($checkout_detail->itemsDetail as $item) 
        {
         $OrdersProducts = new OrdersProducts;
         $OrdersProducts->product_id = $item->product_id;
         $OrdersProducts->title = $item->prdocut_name;
         $OrdersProducts->image = $item->product_image;
         $OrdersProducts->order_id = $order_id;
         $OrdersProducts->save();
        }
         //add order products


        # code...
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */

    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function create_customer(array $data)
    {

        
        return User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'status' => true,
            'permissions_id' => 3,    // Permission Group ID
            'password' => bcrypt($data['password']),
        ]);
    }

    public function orderStore($customer_id , $business_detail , $shipping_rate , $total_price , $price_currency , $admin_product_comment ,$product_quantity ,$csr_name , $payment_method)
    {
        $order = new Orders();
        $order->customer_id = $customer_id;
        $order->customer_name = $business_detail->customer_name;
        $order->customer_email = $business_detail->customer_email;
        $order->customer_phone = $business_detail->customer_phone;
        $order->customer_address = $business_detail->customer_address;
        $order->customer_apartment = $business_detail->customer_apartment;
        $order->customer_city = $business_detail->customer_city;
        $order->customer_state = $business_detail->customer_state;
        $order->customer_postcode = $business_detail->customer_postcode;
        $order->customer_country = $business_detail->customer_country;
        $order->order_notes = $business_detail->order_notes;
        $order->shipping_rate = $shipping_rate;
        $order->total_price = $total_price;
        $order->price_currency = $price_currency;
        $order->admin_product_comment = $admin_product_comment;
        $order->product_quantity = $product_quantity;
        $order->csr_name = $csr_name;
        $order->payment_method = $payment_method;
        $order->save();
        return $order->id;
        # code...
    }


    public function addOrderInWebmail($contact_id=null ,$title ,$message_detail ,$email , $name , $phone , $order_id  )
    {
        $WebsiteSettings = Setting::find(1);
        $Webmail = new Webmail;
        $Webmail->cat_id = 0;
        $Webmail->group_id = 3;
        $Webmail->contact_id = null;
        $Webmail->father_id = null;
        $Webmail->title = $title;
        $Webmail->details = $message_detail;
        $Webmail->date = date("Y-m-d H:i:s");
        $Webmail->from_email = $email;
        $Webmail->from_name = $name;
        $Webmail->from_phone = $phone;
        $Webmail->to_email = $WebsiteSettings->site_webmails;
        $Webmail->to_name = $WebsiteSettings->$site_title_var;
        $Webmail->order_id = $order_id,
        $Webmail->status = 0;
        $Webmail->flag = 0;
        $Webmail->save();
        # code...
    }
}
