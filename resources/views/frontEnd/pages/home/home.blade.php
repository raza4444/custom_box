@extends('frontEnd.main')
@section('content')
<div class="body-wrapper" id="app">

    <!-- Begin Slider With Banner Area -->
    <div class="slider-with-banner pt-30">
        <div class="container">
            <div class="row">
                <!-- Begin Slider Area -->
               
                @include('frontEnd.pages.home.container.slider')
                <!-- Slider Area End Here -->

            </div>
        </div>
    </div>
    <!-- Slider With Banner Area End Here -->
    <!-- Begin FB's customer Support Area -->

    @include('frontEnd.pages.home.container.customer-support-top')
    <?php
                $title_var = "title_" . trans('backLang.boxCode');
                $title_var2 = "title_" . trans('backLang.boxCodeOther');
                $details_var = "details_" . trans('backLang.boxCode');
                $details_var2 = "details_" . trans('backLang.boxCodeOther');
                $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                $i = 0;
                ?>
    <!-- FB's customer Support Area End Here -->
   @include('frontEnd.pages.home.container.latest')
    <!-- Begin FB's Banner Wrap Area -->
    <div class="fb-banner_wrap">
        <div class="container">
            <div class="row">
                <!-- Begin FB's Banner Area -->
                <div class="col-lg-12">
                    <div class="fb-banner fb-img-hover-effect pb-sm-30 pb-xs-30 our-procedure">
                        <br/><br/>


                        <div class="row"> 

                            <div class="col-lg-12"> <h1 style="font-size: 50px; color: #F98100;">
                                <span style="display: block; text-align: center;"> Our <strong>Procedure</strong>
                                </span></h1> 

                                <p>
                                  <span style="display: block; text-align: center; font-size: 20px; color: #fff;">Our Online Procedure With 24/7 Customer Service Provides you a Convenient way
                                        <br> to help Process your Order Faster and more Reliable.
                                    </span></p> 
                                </div> 
                            </div>

                            

<div class="row" style="margin-top: 4em;"> 

<div class="col-lg-1 no-div">
</div> 

<div class="col-xs-12 col-sm-6 col-md-2 text-center our-procedure-img-div"> <span><img class="img-responsive lazy" alt="quality.png" src="{{ URL::asset('front_end/images/procedure/get-a-label.png') }}" style="display: block;"></span> 
<br>     <img class="img-responsive lazy" alt="quote.png" src="{{ URL::asset('front_end//images/procedure/quote.png') }}" style="display: block;  max-width: 170px;"> 
</div> 

<div class="col-xs-12 col-sm-6 col-md-2 text-center our-procedure-img-div"> <span><img class="img-responsive lazy" alt="quality.png" src="{{ URL::asset('front_end/images/procedure/aprove-art-work-label.png') }}" style="display: block;"></span> 
<br>  <img class="img-responsive lazy" alt="art.png" src="{{ URL::asset('front_end/images/procedure/art.png') }}" style="display: block;  max-width: 170px;"> 
</div> 

<div class="col-xs-12 col-sm-6 col-md-2 text-center our-procedure-img-div"> <span><img class="img-responsive lazy" alt="quality.png" src="{{ URL::asset('front_end/images/procedure/production-label.png') }}" style="display: block;"></span> 
<br>    <img class="img-responsive lazy" alt="production.png" src="{{ URL::asset('front_end//images/procedure/production.png') }}" style="display: block;  max-width: 170px;"> 
</div> 

<div class="col-xs-12 col-sm-6 col-md-2 text-center our-procedure-img-div"> <span><img class="img-responsive lazy" alt="quality.png" src="{{ URL::asset('front_end//images/procedure/quality-label.png') }}" style="display: block;"></span> 
<br>  <img class="img-responsive lazy" alt="quality.png" src="{{ URL::asset('front_end//images/procedure/quality.png') }}" style="display: block;  max-width: 170px;"> 
</div> 

<div class="col-xs-12 col-sm-6 col-md-2 text-center our-procedure-img-div"> <span><img class="img-responsive lazy" alt="quality.png" src="{{ URL::asset('front_end/images/procedure/shipping-label.png') }}" style="display: block;"></span> 
<br> <img class="img-responsive lazy" alt="shipment.png" src="{{ URL::asset('front_end//images/procedure/shipment.png') }}" style="display: block; max-width: 200px;"> 
</div> 

<div class="col-xs-1 no-div">
</div> 
</div>

                        </div>
                    </div>
                    <!-- FB's Banner Area End Here -->
                    <!-- Begin FB's Banner Area -->

                    <!-- FB's Banner Area End Here -->
                </div>
            </div>
        </div>
        <!-- FB's Banner Wrap Area End Here -->

@include('frontEnd.pages.home.container.main-category')

<!--begin bottom banner are -->
@include('frontEnd.pages.home.container.bottom-banner')

<!--end bottom banner are -->





</div>
@endsection