       @if(count($MainCategoryProducts) > 0)

       @foreach($MainCategoryProducts as $mainCategoryDetail)
        <!-- Begin FB's Banner With List Product Area -->
        <div class="fb-banner_with_list-product cookware-product pt-60 pb-60">
            <div class="container">
                <div class="fb-product_list_nav">
                    <div class="row no-gutters">
                        <div class="col-xl-3 col-lg-4 col-md-5">
                            <div class="fb-section_title-2">
                                <h2>{{ $mainCategoryDetail['category_name'] }}</h2>
                            </div>
                            <!-- Begin FB's Banner Area -->
                            <div class="fb-banner fb-img-hover-effect">
                                <a href="#">
                                    {{--  --}}
                                    <img src="{{ URL::to('uploads/sections/'.$mainCategoryDetail['category_image']) }}" alt="FB'S Banner">
                                </a>
                            </div>
                            <!-- FB's Banner Area End Here -->
                        </div>
                        <div class="col-xl-9 col-lg-8 col-md-7">
                            <div class="btn-group">
                                <button class="subcategories-trigger"><i class="fa fa-bars"></i></button>
                                
                             <!-- Begin FB's List Product Menu Area -->
                             
                            <!-- FB's List Product Menu Area End Here -->
                        </div>
                        <!-- Begin FB's List Product Area -->
                        <div class="fb-list_product">
                           
                             <div  class="fb-list_product_active owl-carousel">
                            <!-- Begin Sigle Product Area -->
                           
                           @foreach($mainCategoryDetail['category_products'] as $key => $Topic)
                                    @if($key <= 10)
                                    <?php
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

                                    // set row div
                                    if (($i == 1 && count($Categories) > 0) || ($i == 2 && count($Categories) == 0)) {
                                        $i = 0;
                                        echo "</div><div class='row'>";
                                    }
                                    if ($Topic->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                        if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                            $topic_link_url = url(trans('backLang.code') . "/" . $Topic->$slug_var);
                                        } else {
                                            $topic_link_url = url($Topic->$slug_var);
                                        }
                                    } else {
                                        $topic_link_url = route('FrontendProduct', ["id" => $Topic->id]);
                                    }
                                    ?> 
                            <div class="single-product">
                                <!-- Begin Product Image Area -->
                                <div class="product-img">
                                    <a href="{{ $topic_link_url }}">
                                        @if($Topic->photo_file !="")
                                        <img class="primary-img" src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" alt="FB'S Prduct">
                                        @endif
                                                @if(count($Topic->photos)>0)
                                             @foreach($Topic->photos as $key=>$photo)
                                             @if($key == '1' || $key == 1)
                                                    <img class="secondary-img" src="{{ URL::to('uploads/topics/'.$photo->file) }}"
                                                                         alt="{{ $photo->title  }}">
                                                    @endif
                                                     @endforeach
                                                    @endif
                                    </a>
                                    <div class="countersection">
                                       
                                    </div>
                                </div>
                                <!-- Product Image Area End Here -->
                                <!-- Begin Product Content Area -->
                                <div class="product-content">
                                    <h2 class="product-name">
                                        <a href="{{ $topic_link_url }}"> {{ $title }}</a>
                                    </h2>
                                    
                                </div>
                                <!-- Product Content Area End Here -->
                            </div>
                            <!-- Sigle Product Area End Here -->
                            @endif
                            @endforeach

                        </div>
                        </div>
                        <!-- FB's List Product Area End Here -->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- FB's Banner With List Product Area End Here -->
@endforeach
    @endif