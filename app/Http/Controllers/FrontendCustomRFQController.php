<?php

namespace App\Http\Controllers;


use App\Setting;
use App\User;
use App\Webmail;
use Mail;
use App\Http\Requests;
use Illuminate\Http\Request;
use App\WebmasterSetting;

class FrontendCustomRFQController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //


    }
    public function requestForQuote(Request $request)
    {

        $this->validate($request, [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'stock' => 'required',
            'box_style' => 'required',
            'colors' => 'required',
            'comments'=> 'required',
            'purpose' => 'required',
            'length' => 'required',
            'width' => 'required',
            'height' => 'required',
            'unit' => 'required',
            
        ]);
        if (env('NOCAPTCHA_STATUS', false)) {
            $this->validate($request, [
                'g-recaptcha-response' => 'required|captcha'
            ]);
        }
        $name = $request->first_name.' '.$request->last_name;
        $WebsiteSettings = Setting::find(1);
        $site_title_var = "site_title_" . trans('backLang.boxCode');
        $site_email = $WebsiteSettings->site_webmails;
        $site_url = $WebsiteSettings->site_url;
        $site_title = $WebsiteSettings->$site_title_var;
        $message_detail = $this->RFQTemplate($request);
        $Webmail = new Webmail;
        $Webmail->cat_id = 0;
        $Webmail->group_id = null;
        $Webmail->contact_id = null;
        $Webmail->father_id = null;
        $Webmail->title = "Custom Request For Query";
        $Webmail->details = $message_detail;
        $Webmail->date = date("Y-m-d H:i:s");
        $Webmail->from_email = $request->email;
        $Webmail->from_name = $request->first_name.' '.$request->last_name;
        $Webmail->from_phone = $request->phone;
        $Webmail->to_email = $WebsiteSettings->site_webmails;
        $Webmail->to_name = $WebsiteSettings->$site_title_var;
        $Webmail->status = 0;
        $Webmail->flag = 0;
        $Webmail->save();
        $name = $request->first_name.' '.$request->last_name;
        $purpose = $request->purpose;
        if ($WebsiteSettings->notify_orders_status) {
                if (env('MAIL_USERNAME') != "") {
                    Mail::send('backEnd.emails.webmail', [
                        'title' => "Custom Request For Query :",
                        'details' => $message_detail,
                        'websiteURL' => $site_url,
                        'websiteName' => $site_title
                    ], function ($message) use ($request, $site_email, $site_title, $purpose) {
                        $message->from(env('NO_REPLAY_EMAIL', $request->email), $request->first_name.' '.$request->last_name);
                        $message->to($site_email);
                        $message->replyTo($request->email, $site_title);
                        $message->subject("Custom Request For Query");

                    });
                }
            }
    \Session::flash('success_msg', 'Request Has been submitted. We will contact you soon.');
    return back();      



    //     }

    //     
    //     //
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
    public function store(Request $request)
    {
        //
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

    public function RFQTemplate($data)
    {
        $html = '';
        $html .= 'Hi,';
        $html .= '<br></br>';
        $html .= 'I am interested in ordering a custom packaging for my product with the following details:';
        $html .= '<br>';
        $html .= '<br>';
        $html .= '<b>Purpose:</b>  '.' '.$data->purpose;
        $html .= '<br>';
        $html .= '<b>Stock:</b>  '.' '.$data->stock;
        $html .= '<br>';
        $html .= '<b>Box Style:</b>  '.' '.$data->box_style;
        $html .= '<br>';
        $html .= '<b>Color:</b>  '.' '.$data->colors;
        $html .= '<br>';
        $html .= '<b>Length:</b>  '.' '.$data->length.' '.$data->unit;
        $html .= '<br>';
        $html .= '<b>Width:</b>  '.' '.$data->width.' '.$data->unit;
        $html .= '<br>';
        $html .= '<b>Height:</b>  '.' '.$data->height.' '.$data->unit;
        $html .= '<br>';
        $html .= '<b>Quantity:</b>  '.' '.$data->Qty1;
        $html .= '<br>';
        if($data->Qty2 != '' || $data->Qty2 != null)
        {
            $html .= '<b>Quantity2:</b>  '.' '.$data->Qty2;
            $html .= '<br>';
        }
        $html .= '<br>';
        $html .= 'Other Instruction<br>';
        $html .= '<br>';
        $html .= '<p>'.$data->comments.'</p>';        
        $html .= '<br>';
        $html .= 'I am looking forward for you reply.';
        $html .= '</br>';
        $html .= 'Best Regards';

 return $html;   # code...
}

}
