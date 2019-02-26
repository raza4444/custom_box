@extends('frontEnd.main')
@section('content')
<?php
    $title_var = "title_" . trans('backLang.boxCode');
    $title_var2 = "title_" . trans('backLang.boxCodeOther');
    $details_var = "details_" . trans('backLang.boxCode');
    $details_var2 = "details_" . trans('backLang.boxCodeOther');
    if ($Topic->$title_var != "") {
        $title = $Topic->$title_var;
    } else {
        $title = $Topic->$title_var2;
    }
    if ($Topic->$details_var != "") {
        $details = $details_var;
    } else {
        $details = $details_var2;
    }
    $section = "";
    try {
        if ($Topic->section->$title_var != "") {
            $section = $Topic->section->$title_var;
        } else {
            $section = $Topic->section->$title_var2;
        }
    } catch (Exception $e) {
        $section = "";
    }
    ?>
<!-- Begin FB's Breadcrumb Area -->
            <div class="breadcrumb-area pt-30 pb-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-content">
                                <ul>
                                    <li><a href="{{ route("Home") }}"><i class="fa fa-home"></i></a><i class="icon-angle-right"></i>
                        </li>
                        @if($WebmasterSection->id != 1)
                            <li class="active">{!! trans('backLang.'.$WebmasterSection->name) !!}</li>
                        @else
                            <li class="active">{{ $title }}</li>
                        @endif
                        @if(!empty($CurrentCategory))
                            <?php
                            $category_title_var = "title_" . trans('backLang.boxCode');
                            ?>
                            <li class="active"><i
                                        class="icon-angle-right"></i>{{ $CurrentCategory->$category_title_var }}</li>
                        @endif
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- FB's Breadcrumb Area End Here -->

            <!--page content area-->
            <div class="page-content">
                               <!-- Product Details Area -->
                <div class="product-details-area">
                    <div class="container">
                        <div class="pdetails bg-white">
                            <div class="row">
                                <div class="col-lg-5">
                                    <div class="pdetails-images">
                                        <div class="pdetails-largeimages pdetails-imagezoom">
                                            @if($Topic->photo_file !="")
                                                    
                                                  
                                            <div class="pdetails-singleimage" data-src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}">
                                                <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" alt="product image">
                                                
                                            </div>
                                              @endif
                                              @if(count($Topic->photos)>0)
                                               @foreach($Topic->photos as $key=>$photo)
                                            <div class="pdetails-singleimage" data-src="{{ URL::to('uploads/topics/'.$photo->file) }}">
                                                <img src="{{ URL::to('uploads/topics/'.$photo->file) }}" alt="product image">
                                            </div>
                                            @endforeach
                                             @endif
                                           
                                        </div>

                                        <div class="pdetails-thumbs">
                                            @if($Topic->photo_file !="")
                                            <div class="pdetails-singlethumb">
                                                <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" alt="{{ $title }}" style="width: 100%;     height: 75px;">
                                            </div>
                                            @endif
                                             @if(count($Topic->photos)>0)
                                               @foreach($Topic->photos as $key=>$photo)
                                            <div class="pdetails-singlethumb">
                                                <img src="{{ URL::to('uploads/topics/'.$photo->file) }}" alt="{{ $title }}" style="width: 100%;    height: 75px;">
                                            </div>
                                            @endforeach
                                             @endif
                                            
                                         
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-7">
                                    <div class="product-details-view-content mt-20">
                                        <div class="product-info">
                                            <h2>{{ $title }}</h2>
                                            
                                            <div class="product-desc">
                                                <p>
                                                    <span>
                                                     @if(count($Topic->webmasterSection->customFields) >0)

                                                         <?php
                                        $cf_title_var = "title_" . trans('backLang.boxCode');
                                        $cf_title_var2 = "title_" . trans('backLang.boxCodeOther');
                                        ?>
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
                                                    if ($t_field->field_id == 3) {
                                                            $cf_saved_val = $t_field->field_value;

                                                            ?>

                                                    @if($customField->type ==1)
                                                    {{--Text Area--}}
                                                    <div class="row field-row">
                                                        
                                                        <div class="col-lg-12">
                                                            {!! nl2br($cf_saved_val) !!}
                                                        </div>
                                                    </div>
                                                    @endif
                                                            <?php 
                                                    }
                                                }
                                            }
                                                ?>

                                            
                                            @endforeach

                                                        @endif
                                                    </span>
                                                </p>
                                            </div>
                                            <a data-toggle="modal" data-target="#request_for_quote" style="width:100%;" class="fb-btn add-to-cart request-for-quote-btn">Request for quote</a>

                                            <hr/>
                                            <div class="block-reassurance">
                                                <ul>
                                                    <li>
                                                        <div class="reassurance-item">
                                                            <div class="reassurance-icon">
                                                                <i class="fa fa-truck"></i>
                                                            </div>
                                                            <p>FREE SHIPPING (Across USA & Canada)</p>
                                                        </div>
                                                    </li>

                                                    <li>
                                                        <div class="reassurance-item">
                                                            <div class="reassurance-icon">
                                                                <i class="fa fa-paint-brush "></i>
                                                            </div>
                                                            <p>FREE DESIGN SUPPORT (Flat & 3D View)</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                    <div class="reassurance-item">
                                                            <div class="reassurance-icon">
                                                                <i class="fa fa-print "></i>
                                                            </div>
                                                            <p> REQUEST NOW FOR (Free Custom Template)</p>
                                                        </div>
                                                    </li>
                                                    <li>
                                                    <div class="reassurance-item">
                                                            <div class="reassurance-icon">
                                                                <i class="fa fa-calculator "></i>
                                                            </div>
                                                            <p> GET ONLINE QUOTE (Up To 10,000 Retail Boxes)</p>
                                                        </div>
                                                    </li>
                                                    
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product Details Area End Here -->

                <!--product quotes-->

                <!--product request for quote-->
                  <!-- Begin Product Area -->
                <div class="product-area pt-30">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-12">
                                <div class="fb-product-tab">
                                    <ul class="nav fb-product-menu">
                                       <li><a class="active" data-toggle="tab" href="#description"><span>Description</span></a></li>
                                       <li><a data-toggle="tab" href="#product-details"><span>Specification</span></a></li>
                                       
                                    </ul>               
                                </div>
                                <!-- Begin FB's Tab Menu Content Area -->
                            </div>
                        </div>
                        <div class="tab-content">
                            <div id="description" class="tab-pane active show" role="tabpanel">
                                <div class="product-description">
                                    <span>{!! $Topic->$details !!}</span>
                                </div>
                            </div>
                            <div id="product-details" class="tab-pane" role="tabpanel">

                                
                             
                                <div class="product-details-manufacturer">
                                    
                                       @if(count($Topic->fields) > 0) 
                             @foreach ($Topic->fields as $t_field)
                            @if ($t_field->field_id == 4) 
                            
                              {!! nl2br($t_field->field_value) !!}
                            
                                @endif 
                                @endforeach
                                @endif 
                                </div>
                            </div>
                            <div id="reviews" class="tab-pane" role="tabpanel">
                                <div class="product-reviews">
                                    <div class="product-details-comment-block">
                                        <div class="review-btn">
                                            <a class="review-links" href="#" data-toggle="modal" data-target="#mymodal">Be the first to write your review !</a>
                                        </div>
                                        <!-- Begin Quick View | Modal Area -->
                                        <div class="modal fade modal-wrapper" id="mymodal" >
                                            <div class="modal-dialog modal-dialog-centered" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-body">
                                                        <h3 class="review-page-title">Write Your Review</h3>
                                                        <div class="modal-inner-area row">
                                                            <div class="col-lg-6">
                                                               <div class="fb-review-product">
                                                                   <img src="assets/images/product-details/large-size/3.jpg" alt="FB's Product">
                                                                   <div class="fb-review-product-desc">
                                                                       <p class="fb-product-name">Printed Summer Dress</p>
                                                                       <p>
                                                                           <span>Sleeveless knee-length chiffon dress. V-neckline with elastic under the bust lining.</span>
                                                                       </p>
                                                                   </div>
                                                               </div>
                                                            </div>
                                                            <div class="col-lg-6">
                                                                <div class="fb-review-content">
                                                                    <!-- Begin Feedback Area -->
                                                                    <div class="feedback-area">
                                                                        <div class="feedback">
                                                                            <h3 class="feedback-title">Our Feedback</h3>
                                                                            <form action="#">
                                                                                <p class="your-opinion">
                                                                                    <label>Your Rating</label>
                                                                                    <span>
                                                                                        <select class="star-rating">
                                                                                          <option value="1">1</option>
                                                                                          <option value="2">2</option>
                                                                                          <option value="3">3</option>
                                                                                          <option value="4">4</option>
                                                                                          <option value="5">5</option>
                                                                                        </select>
                                                                                    </span>
                                                                                </p>
                                                                                <p class="feedback-form">
                                                                                    <label for="feedback">Your Review</label>
                                                                                    <textarea id="feedback" name="comment" cols="45" rows="8" aria-required="true"></textarea>
                                                                                </p>
                                                                                <div class="feedback-input">
                                                                                    <p class="feedback-form-author">
                                                                                        <label for="author">Name<span class="required">*</span>
                                                                                        </label>
                                                                                        <input id="author" name="author" value="" size="30" aria-required="true" type="text">
                                                                                    </p>
                                                                                    <p class="feedback-form-author feedback-form-email">
                                                                                        <label for="email">Email<span class="required">*</span>
                                                                                        </label>
                                                                                        <input id="email" name="email" value="" size="30" aria-required="true" type="text">
                                                                                        <span class="required"><sub>*</sub> Required fields</span>
                                                                                    </p>
                                                                                    <div class="feedback-btn pb-15">
                                                                                        <a href="#" class="close" data-dismiss="modal" aria-label="Close">Close</a>
                                                                                        <a href="#">Submit</a>
                                                                                    </div>
                                                                                </div>
                                                                            </form>
                                                                        </div>
                                                                    </div>
                                                                    <!-- Feedback Area End Here -->
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>   
                                        <!-- Quick View | Modal Area End Here -->
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Product Area End Here -->

                <!-- Begin FB's Product With Banner Area -->
                 @if($WebmasterSection->related_status)
                            @if(count($Topic->relatedTopics))
                <div class="fb-product_with_banner fb-featured-pro_with_banner other-product pt-60 pb-60">
                    <div class="container">
                        <div class="other-product-nav bg-white">
                            <div class="fb-section_title-2">
                                <h2>12 other products in the same category:</h2>
                            </div>
                            <div class="row no-gutters">
                                <!-- Begin FB's Product Wrap Area -->
                                <div class="col-lg-12">
                                    <div class="fb-product_wrap bg-white mt-sm-60 mt-xs-60">
                                        <div class="fb-other-product_active owl-carousel">
                                            <!-- Begin Sigle Product Area -->
                                              <?php
                                                $title_var = "title_" . trans('backLang.boxCode');
                                                $title_var2 = "title_" . trans('backLang.boxCodeOther');
                                                $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                                                $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
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
                                            <div class="single-product">
                                                <!-- Begin Product Image Area -->
                                                <div class="product-img">
                                                    <a href="single-product.html">
                                                        <img class="primary-img" src="{{ URL::to('uploads/topics/'.$relatedTopic->topic->photo_file) }}" >
                                                        @if(count($Topic->photos)>0)
                                             @foreach($relatedTopic->topic->photos as $key=>$photo)
                                             @if($key == '1' || $key == 1)
                                                        <img class="secondary-img" src="{{ URL::to('uploads/topics/'.$photo->file) }}" >
                                                    @endif
                                                    @endforeach
                                                    @endif
                                                    </a>
                                                   
                                                </div>

                                                <!-- Product Image Area End Here -->
                                                <!-- Begin Product Content Area -->
                                                <div class="product-content">
                                                    <h2 class="product-name">
                                                        <a href="{{ $topic_link_url }}">{!! $relatedTopic_title !!}</a>
                                                    </h2>
                                                    
                                                   
                                                </div>
                                                <!-- Product Content Area End Here -->
                                            </div>
                                            @endforeach
                                            <!-- Sigle Product Area End Here -->

                                            
                                        </div>
                                    </div>
                                </div>
                                <!-- FB's Product Wrap Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                @endif
                <!-- FB's Product Area End Here -->
            </div>
            <!--page content area-->
<!-- Modal -->
  <div class="modal fade" id="request_for_quote" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
            <div style="width: 90%;">
                @if($Topic->photo_file !="")
                <img  class="primary-img" src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" >
                @endif
                <span class="title">{{ $title }}</span>
            </div>
           
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          
        </div>
        <div class="modal-body">
            <div class ="row">
         <div class="col-lg-6 col-md-6 col-sm-12" style="padding: 34px;">
             <form action="{{ route('requestForQuote') }}" method="post" class="product-form-style order-form" enctype="multipart/form-data">
                {{ csrf_field() }}
   <div class="row">
        <div class="form-group col-sm-4 col-md-4 col-xs-12">
        <input  type="text" name="name" value="" placeholder="Your Name *" required="" class="form-control"> </div>
    <div class="form-group col-sm-4 col-md-4 col-xs-12">
        <input  type="email" name="email" value="" placeholder="Your Email *" required="" class="form-control"> </div>
    <div class="form-group col-sm-4 col-md-4 col-xs-12">
        <input  type="text" name="phone" value="" placeholder="Contact no *" required="" class="form-control"> </div>
    <div class="clearfix"></div>
    <div class="form-group col-sm-6 col-md-6 col-xs-12">
        <label for="">Stock <span class="required">*</span></label>
        <select  name="stock" class="form-control" required="">
            <option value="12pt Cardboard Stock">12pt Cardboard Stock</option>
            <option value="14pt Cardboard Stock">14pt Cardboard Stock</option>
            <option value="16pt Cardboard Stock">16pt Cardboard Stock</option>
            <option value="18pt Cardboard Stock">18pt Cardboard Stock</option>
            <option value="20pt Cardboard Stock">20pt Cardboard Stock</option>
            <option value="22pt Cardboard Stock">22pt Cardboard Stock</option>
            <option value="24pt Cardboard Stock">24pt Cardboard Stock</option>
            <option value="Kraft Stock">Kraft Stock</option>
            <option value="Recycled BuxBoard">Recycled BuxBoard</option>
            <option value="Corrugated Stock">Corrugated Stock</option>
            <option value="No Printing Required">No Printing Required</option>
        </select>
    </div>
    <div class="form-group col-sm-6 col-md-6 col-xs-12">
        <label for="">Box style <span class="required">*</span></label>
        <input  type="text" name="box_style" value="{{ $title }}" placeholder="Box Style" required="" class="form-control" readonly=""> </div>
    <div class="clearfix"></div>
    <div class="form-group col-sm-6 col-md-6 col-xs-12">
        <label for="">color <span class="required">*</span></label>
        <select  name="color" required="" class="form-control">
            <option value="1 Color">1 Color</option>
            <option value="2 Color">2 Color</option>
            <option value="3 Color">3 Color</option>
            <option value="4 Color">4 Color</option>
            <option value="4/1 Color">4/1 Color</option>
            <option value="4/2 Color">4/2 Color</option>
            <option value="4/3 Color">4/3 Color</option>
            <option value="4/4 Color">4/4 Color</option>
            <option value="4 Color+PMS">4 Color+PMS</option>
        </select>
    </div>
    <div class="form-group col-sm-6 col-md-6 col-xs-12">
        <label for="">type <span class="required">*</span></label>
        <select  name="type" required="" class="form-control">
            <option value="Get Quote">Get Quote</option>
            <option value="Get Template">Get Template</option>
        </select>
    </div>
    <div class="form-group col-xs-12 col-sm-6 col-md-3">
            <label for="">Length <span class="required">*</span></label>
            
                <input type="text"  name="length" value="" placeholder="Length" required="" class="form-control">
        </div>
        <div class="form-group col-xs-12 col-sm-6 col-md-3">
            <label for="">Width <span class="required">*</span></label>
            
                 <input type="text" name="width" value="" placeholder="Width" required="" class="form-control">
        </div>
        <div class="form-group col-xs-12 col-sm-6 col-md-3">
            <label for="">Height <span class="required">*</span></label>
            
               <input type="text"  name="height" value="" placeholder="Height" required="" class="form-control">
        </div>
        <div class="form-group col-xs-12 col-sm-6 col-md-3">
            <label for="">Unit <span class="required">*</span></label>
            
              <select  name="unit" class="form-control">
                <option value="Inch">inch</option>
                <option value="cm">cm</option>
                <option value="mm">mm</option>
            </select>
        </div>
    
    <input type="hidden" name="pid" value="{{ $Topic->id }}">
    <div class="clearfix"></div>
    <div class="form-group col-md-4 col-sm-4 col-xs-12">
        <label for="">Quantity 1<span class="required">*</span></label>
        <input  type="text" name="qty" id="qty" value="" placeholder="QTY1 Required" required="" class="form-control" onchange="if (!window.__cfRLUnblockHandlers) return false; calculate_price(this.value)"> </div>
    <div class="form-group col-md-4 col-sm-4 col-xs-12">
        <label for="">Quantity 2</label>
        <input  type="text" name="qty1" id="qty" value="" placeholder="QTY2" class="form-control" onchange="if (!window.__cfRLUnblockHandlers) return false; calculate_price(this.value)"> </div>
    <div class="form-group col-md-4 col-sm-4 col-xs-12">
        <label for="">Quantity 3</label>
        <input  type="text" name="qty2" id="qty" value="" placeholder="QTY3" class="form-control" onchange="if (!window.__cfRLUnblockHandlers) return false; calculate_price(this.value)"> </div>
        <div>
            @if(env('NOCAPTCHA_STATUS', false))
            <div class="form-group">
                 {!! NoCaptcha::renderJs(trans('backLang.code')) !!}
                    {!! NoCaptcha::display() !!}
                  </div>
                @endif
        </div>
  <div class="col-md-12">
      <input type="submit" name="btnSubmit" style="width:100%;" class="fb-btn add-to-cart request-for-quote-btn" value="Get Quote" >
      
  </div>
    {{-- <div style="" class="form-group col-xs-10 col-xs-offset-1 col-sm-8 col-sm-offset-2">
        <input style="margin-top:10px; height:50px; font-size:25px; color:#45413b; border:1px solid #3092c0; background-color:#f6f6f6; width:70%; border-radius:10px; margin-left:auto; margin-right:auto;" type="submit" name="btnSubmit" value="Get Quote"> </div> --}}
   </div>
    <div class="clearfix"></div>
</form>
         </div>
        <div class="col-lg-6 col-md-6 col-sm-12" style="margin-top: -1px;
">
            <div style="height: 100%; background-image: url({{ URL::asset('front_end/images/product/product-rfq.jpg') }});    background-size: cover;" >
      
            </div>

        </div>
        </div>
        </div>
        
      </div>
      
    </div>
  </div>
  
</div>

@endsection

