<div class="col-lg-3 order-2 order-lg-1">
    <div class="sidebar-title">
       @if($CurrentCategory!="none")
       <?php
       $category_title_var = "title_" . trans('backLang.boxCode');
       ?>
       <h2>{{ $CurrentCategory->$category_title_var }}</h2>
       @else 
       @if(@$WebmasterSection!="none")
       {{ $WebmasterSection->name }}
       @endif
        @endif

   </div>
   @if(count($Categories)>0)
   <?php
   $category_title_var = "title_" . trans('backLang.boxCode');
   $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
   $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
   ?>
   <!--Begin Sidebar Categores Box Area -->
   <div class="sidebar-categores-box mt-sm-30 mt-xs-30">
    <!-- Begin Category Sub Menu Area -->
    <div class="category-sub-menu">
        <ul>
            <?php $has_sub = ''; ?>
            @foreach($Categories as $Category)

            <?php $active_cat = ""; ?>
            @if($CurrentCategory!="none")
            @if(!empty($CurrentCategory))
            @if($Category->id == $CurrentCategory->id)
            <?php $active_cat = "active"; ?>
            @endif
            @if(count($Category->fatherSections)>0)
            <?php $has_sub = 'has-sub'; ?>
            @else 
            <?php $has_sub = ''; ?>
            @endif


            @endif
            @endif
            <?php
            $ccount = $category_and_topics_count[$Category->id];
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
            <li  class="{{ $active_cat }} {{ $has_sub }}">
                @if($Category->icon !="")
                <i class="fa {{$Category->icon}}"></i> &nbsp;
                @endif
                <a  href="{{ $Category_link_url }}">{{$Category->$category_title_var}} ({{ $ccount }})</a>


                @if($has_sub != '')
                <ul>
                @foreach($Category->fatherSections as $MnuCategory)
                <?php $active_cat = ""; ?>
                @if($CurrentCategory!="none")
                @if(!empty($CurrentCategory))
                @if($MnuCategory->id == $CurrentCategory->id)
                <?php $active_cat = "class=active"; ?>
                @endif
                @endif
                @endif
                <?php
                $ccount = $category_and_topics_count[$MnuCategory->id];
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
                
                <li style="display: -webkit-inline-box;">
                   
                    <a class="{{ $active_cat }}"  href="{{ $SubCategory_link_url }}">{{$MnuCategory->$category_title_var}}({{ $ccount }})</a></li>
                    @foreach($MnuCategory->fatherSections as $MnuCategory)
                <?php $active_cat = ""; ?>
                @if($CurrentCategory!="none")
                @if(!empty($CurrentCategory))
                @if($MnuCategory->id == $CurrentCategory->id)
                <?php $active_cat = "class=active"; ?>
                @endif
                @endif
                @endif
                <?php
                $ccount = $category_and_topics_count[$MnuCategory->id];
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
                
                <li style="display: -webkit-inline-box;">
                    
                    <a class="{{ $active_cat }}"  href="{{ $SubCategory_link_url }}">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{{$MnuCategory->$category_title_var}}({{ $ccount }})</a></li>
                    @endforeach
                    @endforeach

                </ul>
                @endif
                </li>



                    @endforeach
                   
                   
                   
                </ul>
            </div>
            <!-- Category Sub Menu Area End Here -->
        </div>


        @endif


    </div>