
<!-- Begin Header Bottom Menu Area -->
<div class="col-lg-9 d-none d-lg-block d-xl-block position-static">
    <!-- FB's Navigation -->
    <nav class="fb-navigation">
        <ul>
            <li class="active">
                <a href="{{ route('Home') }}">Home</a>

            </li>
            <?php
   $category_title_var = "title_" . trans('backLang.boxCode');
   $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
   $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
   ?>
          @foreach($SearchCategories as $Category)
          <?php
            //$ccount = $category_and_topics_count[$Category->id];
            if ($Category->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                    $Category_link_url = url(trans('backLang.code') . "/" . $Category->$slug_var);
                } else {
                    $Category_link_url = url($Category->$slug_var);
                }
            } else {
               
                    $Category_link_url = route('FrontendProductsByCat', ["cat" => $Category->id]);
                
            }
            ?>
           <li class="dropdown-holder">
                                            <a href="{{ $Category_link_url }}">{{$Category->$category_title_var}}</a>
                                            @if(count($Category->fatherSections)>0)
                                            <ul class="hb-dropdown hb-dropdown-2">
                                                  @foreach($Category->fatherSections as $MnuCategory)
                                                  <?php
                //$ccount = $category_and_topics_count[$MnuCategory->id];
                if ($MnuCategory->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                        $SubCategory_link_url = url(trans('backLang.code') . "/" . $MnuCategory->$slug_var);
                    } else {
                        $SubCategory_link_url = url($MnuCategory->$slug_var);
                    }
                } else {
                    $SubCategory_link_url = route('FrontendProductsByCat', [ "cat" => $MnuCategory->id]);
                }
                ?>
                                                  
                                                <li><a href="{{$SubCategory_link_url}}">{{$MnuCategory->$category_title_var}}</a>
                                                    @if(count($MnuCategory->fatherSections)>0)
                            <?php $products =  Helper::productsByCategory($MnuCategory->id);
                         
                             ?>
                <?php
                $product_title_var = "title_" . trans('backLang.boxCode');
                $product_title_var2 = "title_" . trans('backLang.boxCodeOther');
                $product_details_var = "details_" . trans('backLang.boxCode');
                $product_details_var2 = "details_" . trans('backLang.boxCodeOther');
                $product_slug_var = "seo_url_slug_" . trans('backLang.boxCode');
                $product_slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
                $i = 0;
                ?>
                            <ul>
                                        @foreach($products as $key=> $Topic)
                  <?php
                                    if ($Topic->$product_title_var != "") {
                                        $title = $Topic->$product_title_var;
                                    } else {
                                        $title = $Topic->$product_title_var2;
                                    }
                                    if ($Topic->$product_details_var != "") {
                                        $details = $product_details_var;
                                    } else {
                                        $details = $product_details_var2;
                                    }
                                    $section = "";
                                    try {
                                        if ($Topic->section->$product_title_var != "") {
                                            $section = $Topic->section->$product_title_var;
                                        } else {
                                            $section = $Topic->section->$product_title_var2;
                                        }
                                    } catch (Exception $e) {
                                        $section = "";
                                    }
                                    if ($Topic->$product_slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                                        if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                            $topic_link_url = url(trans('backLang.code') . "/" . $Topic->$slug_var);
                                        } else {
                                            $topic_link_url = url($Topic->$slug_var);
                                        }
                                    } else {
                                        $topic_link_url = route('FrontendProduct', ["id" => $Topic->id]);
                                    }
                                    
                                        ?>
                                        
                                                        <li><a href="{{ $topic_link_url }}">{{ $title }}</a></li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                               
                                                
                                            </ul>
                                            @endif
                                        </li>
                                         @endforeach



                                        

            <li >
                <a href="{{ url('blogs') }}">Blog</a>
               
            </li>
            <li>
                <a href="{{ url('about') }}">About Us</a>
            </li>
           
        </ul>
    </nav>
    <!--FB's Navigation -->
</div>
                            <!-- Header Bottom Menu Area End Here -->