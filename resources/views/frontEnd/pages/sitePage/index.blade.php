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
                        <div class="">
                            <div class="row">

                             @if($Topic->photo_file !="")
                                                    
                                                  
                                            <div class="pdetails-singleimage" data-src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}">
                                                <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" alt="product image">
                                                
                                            </div>
                                              @endif

                                            <br><br/>
                                            <div class=" ">
                                                {!! $Topic->$details !!}
                                            </div>
                                            <br><br/>
                                            <br>

                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @endsection