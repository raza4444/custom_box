
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
                                                    <ul>
                                        @foreach($MnuCategory->fatherSections as $MnusubCategory)
                                        <?php
                //$ccount = $category_and_topics_count[$MnusubCategory->id];
                if ($MnuCategory->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                    if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                        $SubsubCategory_link_url = url(trans('backLang.code') . "/" . $MnusubCategory->$slug_var);
                    } else {
                        $SubsubCategory_link_url = url($MnusubCategory->$slug_var);
                    }
                } else {
                    $SubsubCategory_link_url = route('FrontendProductsByCat', [ "cat" => $MnusubCategory->id]);
                }
                ?>
                                        
                                        
                                                        <li><a href="{{$SubsubCategory_link_url}}">{{$MnusubCategory->$category_title_var}}</a></li>
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