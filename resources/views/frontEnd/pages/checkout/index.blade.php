@extends('frontEnd.main')
@section('content')

<!-- Begin FB's Breadcrumb Area -->
<div class="breadcrumb-area pt-30">
    <div class="container">
        <div class="row">
            <div class="col-lg-12">
                <div class="breadcrumb-content">
                    <ul>
                        <li><a href="index.html">Home</a></li>
                        <li class="active">Checkout</li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- FB's Breadcrumb Area End Here -->
<!--Checkout Area Strat-->
<div class="checkout-area pt-60 pb-30">
    <div class="container">
        <div class="row">
            <div class="checkout_error">
            
        </div>
            <div class="col-12">
                <div class="coupon-accordion">
                    <!--Accordion Start-->
                    <h3>Returning customer? <span id="showlogin">Click here to login</span></h3>
                    <div id="checkout-login" class="coupon-content">
                        <div class="coupon-info">
                            <p class="coupon-text">Quisque gravida turpis sit amet nulla posuere lacinia. Cras sed est sit amet ipsum luctus.</p>
                            <form action="{{ route('userLogin') }}" method="post">
                                {{ csrf_field() }}
                                <p class="form-row-first">
                                    <label>Email <span class="required">*</span></label>
                                    <input type="email" name ="email">
                                </p>
                                <p class="form-row-last">
                                    <label>Password  <span class="required">*</span></label>
                                    <input type="password" name="password">
                                </p>
                                <input type="hidden" name="checkout_id" value="{{ $topic_id }}">
                                <p class="form-row">
                                    <input type="submit" value="Login" name="submit" >
                                    <label>
                                        <input type="checkbox">
                                        Remember me 
                                    </label>
                                </p>
                                <p class="lost-password"><a href="#">Lost your password?</a></p>
                            </form>
                        </div>
                    </div>
                    <!--Accordion End-->

                    <!--Accordion End-->
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-12">
                <form action="#">
                    <div class="checkbox-form">
                        <h3>Billing Details</h3>
                        <div class="row">
                            
                          <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Full Name <span class="required">*</span></label>
                                <input placeholder="" name="customer_name" type="text" value="{{ Auth::check() ? Auth::user()->name : ''  }}">
                                <div class="error error_customer_name"></div>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="checkout-form-list mb-30">
                                <label>Address <span class="required">*</span></label>
                                <input placeholder="Street address" name="customer_address" type="text">
                           <div class="error error_customer_address"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <input name="customer_apartment" placeholder="Apartment, suite, unit etc. (optional)" type="text">
                            </div>
                        </div>
                        <div class="col-md-12">
                                <div class="country-select clearfix">
                                    <label>Country <span class="required">*</span></label>
                                    <select name="customer_country" class="country-select-option wide country">
                                        @foreach($countries as $country)

                                         <option value="{{ $country }}">{{ $country }}</option>
                                        @endforeach
                                     
                                     
                                  </select>
                              <div class="error error_customer_country"></div>
                              </div>
                          </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list">
                                <label>Town / City <span class="required">*</span></label>
                                <input type="text" placeholder="Town" name="customer_city">
                                 <div class="error error_customer_city"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>State <span class="required">*</span></label>
                                <input placeholder="" name="customer_state" type="text">
                                <div class="error error_customer_state"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Postcode / Zip <span class="required">*</span></label>
                                <input placeholder="" name="customer_postcode" type="text">
                                <div class="error error_customer_postcode"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Email Address <span class="required">*</span></label>
                                <input placeholder="" type="email" name="customer_email" value="{{ Auth::check() ? Auth::user()->email : ''  }}">
                                <div class="error error_customer_email"></div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="checkout-form-list">
                                <label>Phone  <span class="required">*</span></label>
                                <input type="text" name="customer_phone">
                             <div class="error error_customer_phone"></div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="checkout-form-list create-acc">
                                <input id="cbox" type="checkbox" name="checked_create_account">
                                <label>Create an account?</label>
                            </div>
                            <div id="cbox-info" class="checkout-form-list create-account">
                                <p>Create an account by entering the information below. If you are a returning customer please login at the top of the page.</p>
                                <label>Account password  <span class="required">*</span></label>
                                <input placeholder="password" type="password" name="customer_account_password">
                                <div class="error error_customer_account_password"></div>
                            </div>
                        </div>
                    </div>
                    <div class="different-address">
                        
                        
                    <div class="order-notes">
                        <div class="checkout-form-list">
                            <label>Order Notes</label>
                            <textarea id="checkout-mess" name="order_notes" cols="30" rows="10" placeholder="Notes about your order, e.g. special notes for delivery."></textarea>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <div class="col-lg-6 col-12">
        <div class="your-order">
            <h3>Your order</h3>
            <div class="">

            </div>
            <div class="your-order-table table-responsive">
                @if($WebmasterSection->related_status)
                @if(count($Topic->relatedTopics))
                <table class="table">
                    <thead>
                        <tr>
                            <th class="cart-product-name">Product</th>
                            <th>    </th>

                        </tr>
                    </thead>
                    <tbody>
                       <?php
                       $title_var = "title_" . trans('backLang.boxCode');
                       $title_var2 = "title_" . trans('backLang.boxCodeOther');
                       $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                       $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                       $items = array();
                       ?>
                       @foreach($Topic->relatedTopics as $relatedTopic)


                       <?php


                       if ($relatedTopic->topic->$title_var != "") {
                        $relatedTopic_title = $relatedTopic->topic->$title_var;
                    } else {
                        $relatedTopic_title = $relatedTopic->topic->$title_var2;
                    }

                    if ($relatedTopic->topic->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                        if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {

                            $topic_link_url = url(trans('backLang.code') . "/" . $relatedTopic->topic->$slug_var);
                        } else {
                            $topic_link_url = url($relatedTopic->topic->$slug_var);
                        }
                    } else {
                        $topic_link_url = route('FrontendProduct', [ "id" => $relatedTopic->topic->id]);
                    }
                    ?>
                    <?php 

                     $items[] = array(
                        'product_id' => $relatedTopic->topic->id,
                        'prdocut_name' => $relatedTopic->topic->$title_var,
                        'product_url'=> $topic_link_url,
                        'product_image'=>$relatedTopic->topic->photo_file,
                        );
                    ?>
                    <tr class="cart_item">
                      <td class="cart-product-name"><span><img style="    max-width: 47px;" src="{{ URL::to('uploads/topics/'.$relatedTopic->topic->photo_file) }}"></span> <a href="{{ $topic_link_url }}">{!! $relatedTopic_title !!}</a><strong class="product-quantity"></strong></td>
                      <th>    </th>
                  </tr>
                  @endforeach

                  <?php
                  $checkout_items = json_encode($items);
                    //                echo '<pre>';
                  //print_r($items);
                 // echo '</pre>';
                  //die();
                  $cf_title_var = "title_" . trans('backLang.boxCode');
                  $cf_title_var2 = "title_" . trans('backLang.boxCodeOther');
                  ?>
                  <?php $currency = ''; ?>
                  @foreach($Topic->webmasterSection->customFields as $customField)
                  <?php
                  if ($customField->$cf_title_var != "") {
                    $cf_title = $customField->$cf_title_var;
                } else {
                    $cf_title = $customField->$cf_title_var2;
                }

                $cf_saved_val = "";
                $cf_saved_val_array = array();
                if (count($Topic->fields) > 0) {
                    foreach ($Topic->fields as $t_field) {
                        if ($t_field->field_id == $customField->id) {
                            if ($customField->type == 7) {
                                                            // if multi check
                                $cf_saved_val_array = explode(", ", $t_field->field_value);
                            } else {
                                $cf_saved_val = $t_field->field_value;
                            }
                        }
                    }
                }

                ?>

                @if(($cf_saved_val!="" || count($cf_saved_val_array) > 0) && ($customField->lang_code == "all" || $customField->lang_code == trans('backLang.boxCode')))
                @if($customField->type ==12)
                {{--Vimeo Video Link--}}
                <?php
                $CF_Vimeo_id = Helper::Get_vimeo_video_id($cf_saved_val);
                ?>
                @if($CF_Vimeo_id !="")
                <div class="row field-row">
                    <div class="col-lg-3">
                        {!!  $cf_title !!} :
                    </div>
                    <div class="col-lg-9">
                        {{-- Vimeo Video --}}
                        <iframe allowfullscreen style="height:450px;width: 100%"
                        src="https://player.vimeo.com/video/{{ $CF_Vimeo_id }}?title=0&amp;byline=0">
                    </iframe>
                </div>
            </div>
            @endif
            @elseif($customField->type ==11)
            {{--Youtube Video Link--}}

            <?php
            $CF_Youtube_id = Helper::Get_youtube_video_id($cf_saved_val);
            ?>
            @if($CF_Youtube_id !="")
            <div class="row field-row">
                <div class="col-lg-3">
                    {!!  $cf_title !!} :
                </div>
                <div class="col-lg-9">
                    {{-- Youtube Video --}}
                    <iframe allowfullscreen
                    style="height: 450px;width: 100%"
                    src="https://www.youtube.com/embed/{{ $CF_Youtube_id }}">
                </iframe>
            </div>
        </div>
        @endif
        @elseif($customField->type ==10)
        {{--Video File--}}
        <div class="row field-row">
            <div class="col-lg-3">
                {!!  $cf_title !!} :
            </div>
            <div class="col-lg-9">
                <video width="100%" height="450" controls>
                    <source src="{{ URL::to('uploads/topics/'.$cf_saved_val) }}"
                    type="video/mp4">
                    Your browser does not support the video tag.
                </video>
            </div>
        </div>
        @elseif($customField->type ==9)
        {{--Attach File--}}
        <div class="row field-row">
            <div class="col-lg-3">
                {!!  $cf_title !!} :
            </div>
            <div class="col-lg-9">
                <a href="{{ URL::to('uploads/topics/'.$cf_saved_val) }}"
                target="_blank">
                <span class="badge">
                    {!! Helper::GetIcon(URL::to('uploads/topics/'),$cf_saved_val) !!}
                {!! $cf_saved_val !!}</span>
            </a>
        </div>
    </div>

    @elseif($customField->type ==8)
    {{--Photo File--}}
    <div class="row field-row">
        <div class="col-lg-3">
            {!!  $cf_title !!} :
        </div>
        <div class="col-lg-9">
            <img src="{{ URL::to('uploads/topics/'.$cf_saved_val) }}"
            alt="{{ $cf_title }} - {{ $title }}"
            title="{{ $cf_title }} - {{ $title }}">
        </div>
    </div>
    
    @elseif($customField->type ==5)
    {{--Date & Time--}}
    <div class="row field-row">
        <div class="col-lg-3">
            {!!  $cf_title !!} :
        </div>
        <div class="col-lg-9">
            {!! date('Y-m-d H:i:s', strtotime($cf_saved_val)) !!}
        </div>
    </div>
    @elseif($customField->type ==4)
    {{--Date--}}
    <div class="row field-row">
        <div class="col-lg-3">
            {!!  $cf_title !!} :
        </div>
        <div class="col-lg-9">
            {!! date('Y-m-d', strtotime($cf_saved_val)) !!}
        </div>
    </div>
    @elseif($customField->type ==3)
    {{--Email Address--}}
    <div class="row field-row">
        <div class="col-lg-3">
            {!!  $cf_title !!} :
        </div>
        <div class="col-lg-9">
            {!! $cf_saved_val !!}
        </div>
    </div>
    @elseif($customField->type ==2 )
    {{--Number--}}
    @if( $customField->id == 14 || stripos($cf_title, 'Shipping Rate') !== FALSE)
    <tr>
     <td>{!!  $cf_title !!}</td>
     <td>
       <!-- price currency -->
       @include('frontEnd.pages.checkout.price-unit')
       <!-- price currency -->
       {!! $cf_saved_val !!}


   </td>
</tr>
<input type="hidden" name="shipping_rate" id="product_shipping_rate" value="{!! $cf_saved_val !!}">
@endif
@if( $customField->id == 12 || stripos($cf_title, 'Total Price') !== FALSE)
<tr>
    <th>{!!  $cf_title !!}</th>
 <td>
    <strong><span class="amount">
   <!-- price currency -->
   @include('frontEnd.pages.checkout.price-unit')
   <!-- price currency -->
   {!! $cf_saved_val !!} </span></strong></td>


</td>
</tr>
<input type="hidden" name="total_price" value="{!! $cf_saved_val !!}">
@endif
@elseif($customField->type ==1)
{{--Text Area--}}
@if( $customField->id == 15 || stripos($cf_title, 'Comment') !== FALSE)
<tr>
    <td> {!! nl2br($cf_saved_val) !!}</td>
    
    <input type="hidden" name="admin_product_comment" value="{!! nl2br($cf_saved_val) !!}" id="product_comments_from_admin" ?>
</tr>

@endif
@elseif($customField->type == 0)
{{--Text Box--}}
@if( $t_field->field_id == 17 || stripos($cf_title, 'CSR') !== FALSE)
<input type="hidden" name="csr"  value="{!! $cf_saved_val !!}">
@endif


@if( $t_field->field_id == 5 || stripos($cf_title, 'Quantity') !== FALSE)
<tr>
    <td>{!!  $cf_title !!}</td>
    <td>{!! $cf_saved_val !!}</td>
</tr>
<input type="hidden" name="product_quantity" id="product_quantity" value="{!! $cf_saved_val !!}">
@endif

@endif
@endif
@endforeach

</tbody>

</table>
@endif
@endif
</div>


      
       
<div class="payment-method">
    <div class="payment-accordion">
       <!-- price currency -->
       @include('frontEnd.pages.checkout.payment_gateway')
       <!-- price currency -->
<br><br>
<div id="paypal_place_order" class="order-button-payment">
    <input onclick="place_order('paypal')" value="Place order" type="submit">
</div>
<div id="stripe_place_order" style="display: none;"  class="order-button-payment">
    <input onclick="place_order('stripe')" value="Place order" type="submit">
</div>

</div>
</div>
</div>
</div>
</div>
</div>
</div>
<!--Checkout Area End-->





@endsection



@section('scripts')
<script type="text/javascript">
$(document).ready(function(){
    $(".nice-select .main").on("click", function() { setTimeout(function() { $(this).find(".list li.selected")[0].scrollIntoView(); }.bind(this), 100); });
    $('.nice-select.open .list').css('max-height' , '300px');
    $('.nice-select.open .list').css('overflow-y' , 'scroll');

});


    $("input[name='payment_method']").change(function(){
        var payment_method = $(this).val();
        if(payment_method == 'stripe')
        {
            $('#stripe_place_order').show();
            $('#paypal_place_order').hide();
            $('#stripes').show();
        }
        else
        {
            $('#stripe_place_order').hide();
            $('#paypal_place_order').show();
            $('#stripes').hide();

        }
    })
    
function place_order(payment_method) {
  
    var customer_name = $("input[name='customer_name']").val();

   var customer_address = $("input[name='customer_address']").val();
   var customer_country = $("select[name='customer_country']").val(); 

   var customer_city = $("input[name='customer_city']").val();
   var customer_state = $("input[name='customer_state']").val();
   var customer_postcode = $("input[name='customer_postcode']").val();
   var customer_apartment = $("input[name='customer_apartment']").val();
   var customer_email = $("input[name='customer_email']").val();
   var customer_phone = $("input[name='customer_phone']").val();
   var checked_create_account = $("input[name='checked_create_account']").val();
   var customer_account_password = $("input[name='customer_account_password']").val();
   var order_notes = $("textarea[name='order_notes']").val();
   var product_quantity = $("input[name='product_quantity']").val();
   var admin_product_comment = $("input[name='admin_product_comment']").val();
   var total_price = $("input[name='total_price']").val();
   var csr_name = $("input[name='csr']").val();

   var shipping_rate = $("input[name='shipping_rate']").val();
   var price_currency = $("input[name='price_currency']").val();
   var items = <?php echo $checkout_items; ?>;

   if(validate())
   {
    $('.error').hide()

    console.log(items);
   console.log(customer_apartment , 'customer_apartment');
   var business_detail = {
    'customer_name':customer_name,
    'customer_address': customer_address,
    'customer_apartment':customer_apartment,
    'customer_country': customer_country,
    'customer_city': customer_city,
    'customer_state': customer_state,
    'customer_postcode': customer_postcode,
    'customer_email': customer_email,
    'customer_phone':customer_phone,
    'order_notes':order_notes
   };
  // console.log(JSON.stringify(business_detail));
   //paypal start 
   if(payment_method == 'paypal')
   {
     if ($("input[name='checked_create_account']").is(':checked')) {
        var checkout_detail = {
        'business_detail': JSON.stringify(business_detail),
        'itemsDetail':items,
        'product_quantity': product_quantity,
        'shipping_rate':shipping_rate,
        'total_price':total_price,
        'price_currency':price_currency,
        'payment_method': 'paypal',
        'customer_type': 'registered',
        'account_password': customer_account_password,
        'admin_product_comment':admin_product_comment,
        'csr_name':csr_name  
};
   

     }
     else
     {
      var checkout_detail = {
        'business_detail': JSON.stringify(business_detail),
        'itemsDetail':items,
        'product_quantity': product_quantity,
        'shipping_rate':shipping_rate,
        'total_price':total_price,
        'price_currency':price_currency,
        'payment_method': 'paypal',
        'customer_type': 'guest',
        'account_password': '',
        'admin_product_comment':admin_product_comment,
        'csr_name':csr_name
    };

      }

      paymentByPaypal(checkout_detail);
      return;
   }
   //paypal end
//stripe start
else if(payment_method == 'stripe')
{
    var url = "https://js.stripe.com/v2/";
$.getScript( url, function() {
var stripe_id = '{{ env('stripe_publishable_key') }}'
Stripe.setPublishableKey(stripe_id);

      Stripe.createToken({
        number: $('#cardNumber').val(),
        cvc: $('#cardCVC').val(),
        exp_month: $('#cardExpMonth').val(),
        exp_year: $('#cardExpYear').val()
      }, handleStripeResponse);


      return;

});
//stripe end
}



//stripe end


    
   }

   //validate function end


}


function validate() {
    var customer_name = $("input[name='customer_name']").val();

   var customer_address = $("input[name='customer_address']").val();
   var customer_country = $("select[name='customer_country']").val(); 

   var customer_city = $("input[name='customer_city']").val();
   var customer_state = $("input[name='customer_state']").val();
   var customer_postcode = $("input[name='customer_postcode']").val();

   var customer_email = $("input[name='customer_email']").val();
   var customer_phone = $("input[name='customer_phone']").val();
   var checked_create_account = $("input[name='checked_create_account']").val();
   var customer_account_password = $("input[name='customer_account_password']").val();
    var payment_method = $("input[name='payment_method']:checked").val();


   if(customer_name == '' || customer_name == null)
   {
       $('.checkout_error').html("<div class='alert alert-danger'>Please Enter Full Name</div>");
 
    return false;
   }

 if(customer_address == '' || customer_address == null)
{
       $('.checkout_error').html("<div class='alert alert-danger'>Please Enter Your Address</div>");
 
    return false;
}

 if(customer_country == '' || customer_country == null)
   {
    $('.checkout_error').html("<div class='alert alert-danger'>Please Select Your Country</div>");
   return false;
   }

 if(customer_city == '' || customer_city == null)
   {
           $('.checkout_error').html("<div class='alert alert-danger'>Please Enter Your City</div>");
 
    return false;
   }

 if(customer_state == '' || customer_state == null)
   {
         $('.checkout_error').html("<div class='alert alert-danger'>Please Enter Your State</div>");
 
    return false;
   }
 if(customer_postcode == '' || customer_postcode == null)
   {
      $('.checkout_error').html("<div class='alert alert-danger'>Please Enter Your Postcode</div>");
  
   return false;
   }

if(customer_email == '' || customer_email == null)
   {
    if(!validateEmail(customer_email)) { 
    $('.checkout_error').html("<div class='alert alert-danger'>Please Enter Your Email</div>");
    return false;
   }
}

 if(customer_phone == '' || customer_phone == null)
   {
    $('.checkout_error').html("<div class='alert alert-danger'>Please Enter Your Phone Number</div>");
    return false;
   }
 if ($("input[name='checked_create_account']").is(':checked')) {
    if(customer_account_password == '' || customer_account_password == null)
    {
    $('.error_customer_account_password').html("Please Enter Your Password");
    return false;
    } 

   }
   if(payment_method == 'stripe')
   {
    
     if($.trim($('#cardNumber').val()) == ''){
        $('.checkout_error').html("<div class='alert alert-danger'>Please Enter Cradit card Number</div>");

     return false;
    }
    if($.trim($('#cardCVC').val()) == '') {
        $('.checkout_error').html("<div class='alert alert-danger'>Please Enter CVC card Number</div>");
     //   $('.error_cardNumber').html('');
     return false;
    }
   }
   

   return true;

    // body...
}

function validateEmail($email) {
  var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
  return emailReg.test( $email );
}

function paymentByPaypal(checkout_detail)
{
//console.log(checkout_detailt);
 var url = '{{ route('orderByPaypal') }}';
$.ajax({
  type: "POST",
  url: url,
  data: {
    _token:'{{csrf_token()}}',
    checkout_detail: JSON.stringify(checkout_detail),

  },
  success: function(data){
    console.log(data);
  },
  error: function(data){

  },

});


}
</script>


<!--stripe payment gateway--->

<script type="text/javascript">
    function check_cardNumber(){

      var inp = $('#cardNumber');

      var num = inp.val();

      if(num.length < 15 || num.length > 16){
        inp.next().css('color', 'red');
        inp.next().html('Invalid card number');
      }
      else{
       inp.next().css('color', 'green');
       inp.next().html('Card number is valid.');
     }



   }



   function check_cvcNumber(){

    var inp = $('#cardCVC');

    var num = inp.val();

    if(num.length < 3 || num.length > 4){
      inp.next().css('color', 'red');
      inp.next().html('Invalid CVV/CVC number');
    }
    else{
     inp.next().css('color', 'green');
     inp.next().html('CVV/CVC number is valid.');
   }



 }
    function handleStripeResponse(status, response) {
    // //console.logJSON.stringify(response));
    if (response.error) {
    $('.checkout_error').html("<div class='alert alert-danger'>"+ response.error.message+"</div>");
        

    } else {
        //get stripe token id from response
        var stripeToken = response['id'];
        console.log(stripeToken);
       paymentBystripe(stripeToken);

      }
    }

    function paymentBystripe(stripeToken)
{
console.log(stripeToken);
var customer_name = $("input[name='customer_name']").val();

   var customer_address = $("input[name='customer_address']").val();
   var customer_country = $("select[name='customer_country']").val(); 

   var customer_city = $("input[name='customer_city']").val();
   var customer_state = $("input[name='customer_state']").val();
   var customer_postcode = $("input[name='customer_postcode']").val();
   var customer_apartment = $("input[name='customer_apartment']")
   var customer_email = $("input[name='customer_email']").val();
   var customer_phone = $("input[name='customer_phone']").val();
   var checked_create_account = $("input[name='checked_create_account']").val();
   var customer_account_password = $("input[name='customer_account_password']").val();
   var order_notes = $("textarea[name='order_notes']").val();
   var product_quantity = $("input[name='product_quantity']").val();
   var admin_product_comment = $("input[name='admin_product_comment']").val();
   var total_price = $("input[name='total_price']").val();
   var csr_name = $("input[name='csr']").val();

   var shipping_rate = $("input[name='shipping_rate']").val();
   var price_currency = $("input[name='price_currency']").val();
   var items = <?php echo $checkout_items; ?>;

   if(validate())
   {
    $('.checkout_error').html('');

    console.log(items);
   
   var business_detail = {
    'customer_name':customer_name,
    'customer_address': customer_address,
    'customer_apartment':customer_apartment,
    'customer_country': customer_country,
    'customer_city': customer_city,
    'customer_state': customer_state,
    'customer_postcode': customer_postcode,
    'customer_email': customer_email,
    'customer_phone':customer_phone,
    'order_notes':order_notes
   };
   if ($("input[name='checked_create_account']").is(':checked')) {
    var checkout_detail = {
        'business_detail': JSON.stringify(business_detail),
        'itemsDetail':items,
        'product_quantity': product_quantity,
        'shipping_rate':shipping_rate,
        'total_price':total_price,
        'price_currency':price_currency,
        'payment_method': 'stripe',
        'customer_type': 'registered',
        'stripe_token':stripeToken,
        'account_password': customer_account_password,
        'admin_product_comment':admin_product_comment,
        'csr_name':csr_name
    };

   }
   else
   {
     var checkout_detail = {
        'business_detail': JSON.stringify(business_detail),
        'itemsDetail':items,
        'product_quantity': product_quantity,
        'shipping_rate':shipping_rate,
        'total_price':total_price,
        'price_currency':price_currency,
        'payment_method': 'stripe',
        'customer_type': 'guest',
        'stripe_token':stripeToken,
        'account_password': '',
        'admin_product_comment':admin_product_comment,
        'csr_name':csr_name
    };

   }
  

paymentByStripe(checkout_detail);

}

}


function paymentByStripe(checkout_detail)
{
//console.log(checkout_detailt);
 var url = '{{ route('orderByStripe') }}';
$.ajax({
  type: "POST",
  url: url,
  data: {
    _token:'{{csrf_token()}}',
    checkout_detail: JSON.stringify(checkout_detail),

  },
  success: function(data){
    console.log(data);
  },
  error: function(data){

  },

});


}

</script>

<!--stripe payent gateway-->

@endsection