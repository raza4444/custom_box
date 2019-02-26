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
            <div class="breadcrumb-area pt-30">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="breadcrumb-content">
                                <ul>
                                    <li><a href="{{ route("Home") }}">Home</a></li>
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

            <!-- Begin FB's Main Blog Page Area -->
            <div class="fb-main-blog-page fb-main-blog-details-page pt-60 pb-30 pb-sm-45 pb-xs-45">
                <div class="container">
                    <div class="row">
                        <!-- Begin FB's Blog Sidebar Area -->
                        <div class="col-lg-3 order-lg-2 order-2">
                            <div class="fb-blog-sidebar-wrapper">
                                <div class="fb-blog-sidebar">
                                    <div class="fb-sidebar-search-form">
                                                {{Form::open(['route'=>['searchBlogs'],'method'=>'POST','class'=>'form-search'])}}
            <div class="input-group input-group-sm">
                {!! Form::text('search_word',@$search_word, array('placeholder' => trans('frontLang.search'),'class' => 'fb-search-field','id'=>'search_word','required'=>'')) !!}
                <span class="input-group-btn">
                    <button type="submit" class="fb-search-btn"><i class="fa fa-search"></i></button>
                </span>
            </div>

            {{Form::close()}}
                                    </div>
                                </div>
                                	@if(count($Categories)>0)
            <?php
            $category_title_var = "title_" . trans('backLang.boxCode');
            $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
            $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
            ?>
					<div class="fb-blog-sidebar pt-25">
						<h4 class="fb-blog-sidebar-title">Categories</h4>
						<ul class="fb-blog-archive">
							@foreach($Categories as $Category)
                        <?php $active_cat = ""; ?>
                        @if($CurrentCategory!="none")
                            @if(!empty($CurrentCategory))
                                @if($Category->id == $CurrentCategory->id)
                                    <?php $active_cat = "class=active"; ?>
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
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $Category_link_url = route('FrontendBlogsByCatWithLang', ["lang" => trans('backLang.code'), "section" => $Category->webmasterSection->name, "cat" => $Category->id]);
                            } else {
                                $Category_link_url = route('FrontendTopicsByCat', ["section" => $Category->webmasterSection->name, "cat" => $Category->id]);
                            }
                        }
                        ?>
                        <li>
                            @if($Category->icon !="")
                                <i class="fa {{$Category->icon}}"></i> &nbsp;
                            @endif
                            <a {{ $active_cat }} href="{{ $Category_link_url }}">{{$Category->$category_title_var}}</a><span
                                    class="pull-right">({{ $ccount }})</span></li>
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
                                if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                    $SubCategory_link_url = route('FrontendBlogsByCatWithLang', ["lang" => trans('backLang.code'), "section" => $MnuCategory->webmasterSection->name, "cat" => $MnuCategory->id]);
                                } else {
                                    $SubCategory_link_url = route('FrontendTopicsByCat', ["section" => $MnuCategory->webmasterSection->name, "cat" => $MnuCategory->id]);
                                }
                            }
                            ?>
                            <li> &nbsp; &nbsp; &nbsp;
                                @if($MnuCategory->icon !="")
                                    <i class="fa {{$MnuCategory->icon}}"></i> &nbsp;
                                @endif
                                <a {{ $active_cat }}  href="{{ $SubCategory_link_url }}">{{$MnuCategory->$category_title_var}}</a><span
                                        class="pull-right">({{ $ccount }})</span></li>
                        @endforeach

                    @endforeach
						</ul>
					</div>
					@endif
                                
					<div class="fb-blog-sidebar">
						<h4 class="fb-blog-sidebar-title">Most Viewed</h4>
						@if(count($TopicsMostViewed)>0)
						 <?php
            $side_title_var = "title_" . trans('backLang.boxCode');
            $side_title_var2 = "title_" . trans('backLang.boxCodeOther');
            $slug_var = "seo_url_slug_" . trans('backLang.boxCode');
            $slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
            ?>
            @foreach($TopicsMostViewed as $TopicMostViewed)
            <?php
                        if ($TopicMostViewed->$side_title_var != "") {
                            $side_title = $TopicMostViewed->$side_title_var;
                        } else {
                            $side_title = $TopicMostViewed->$side_title_var2;
                        }
                        if ($TopicMostViewed->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
                            if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
                                $topic_link_url = url(trans('backLang.code') . "/" . $TopicMostViewed->$slug_var);
                            } else {
                                $topic_link_url = url($TopicMostViewed->$slug_var);
                            }
                        } else {
                            
                                $topic_link_url = route('FrontendBlogDetail', [ "id" => $TopicMostViewed->id]);
                            
                        }
                        ?>
						<div class="fb-recent-post pb-30">
							<div class="fb-recent-post-thumb">
								<a href="blog-details-left-sidebar.html">
									
									<img src="{{ URL::to('uploads/topics/'.$TopicMostViewed->photo_file) }}"
                                                 class="pull-left" alt="{{ $side_title }}"/>
								</a>
							</div>
							<div class="fb-recent-post-des">
								<span><a href="{{ $topic_link_url }}">{{ $side_title }}</a></span>
								<span class="fb-post-date">{{ $TopicMostViewed->date }}</span>
							</div>
						</div>
						@endforeach
						@endif
						
					</div>
                               
                            </div>
                        </div>
                        <!-- FB's Blog Sidebar Area End Here -->
                        <!-- Begin FB's Main Content Area -->
                        <div class="col-lg-9 order-lg-1 order-1">
                            <div class="row fb-main-content">
                                <div class="col-lg-12">
                                    <div class="fb-blog-single-item pb-30">
                                        <div class="fb-blog-banner">
                                            <a href="#"><img class="img-full" src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" alt=""></a>
                                        </div>
                                        <div class="fb-blog-content">
                                            <div class="fb-blog-details">
                                                <h3 class="fb-blog-heading pt-25"><a href="#"> {{ $title }}</a></h3>
                                                <div class="fb-blog-meta">
                                                    <a class="author"  href="{{route('FrontendUserTopics',$Topic->created_by)}}"><i class="fa fa-user"></i>{{$Topic->user->name}}</a>
                                            
                                                    
                                                    <a class="comment"  href="#comments"><i class="fa fa-comment-o"></i>{{ trans('frontLang.comments') }}
                                            : {{count($Topic->approvedComments)}}</a>
                                                    
                               		
                                					@if($WebmasterSection->date_status)
                                                    <a class="post-time" href="#"><i class="fa fa-calendar"></i>{!! $Topic->date  !!}</a>
                                                     @endif
                                                </div>
                                               {!! $Topic->$details !!}
                                                <!-- Begin Blog Blockquote Area -->
                                                
                                                <div class="fb-tag-line">
                                                    <h4>tag:</h4>
                                                    <a href="#">Headphones</a>,
                                                    <a href="#">Video Games</a>,
                                                    <a href="#">Wireless Speakers</a>
                                                </div>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <!-- Begin FB's Blog Comment Section -->
                                    <div class="fb-comment-section">
                                        <h3>3 comment</h3>
                                        <ul id="comments">
                                            @foreach($Topic->approvedComments as $comment)
                                        <?php
                                        $dtformated = date('d M Y h:i A', strtotime($comment->date));
                                        ?>

                                            <li>
                                                <div class="author-avatar pt-15">
                                                    <img src="{{ URL::to('uploads/contacts/profile.jpg') }}" alt="User">
                                                </div>
                                                <div class="comment-body pl-15">
                                                        
                                                    <h5 class="comment-author pt-15">{{$comment->name}}</h5>
                                                    <div class="comment-post-date">
                                                        {{ $dtformated }}
                                                    </div>
                                                    <p> {!! nl2br(strip_tags($comment->comment)) !!}</p>
                                                </div>
                                            </li>
                                             @endforeach
                                            
                                        </ul>
                                    </div>
                                    <!-- FB's Blog Comment Section End Here -->
                                    <!-- Begin Blog comment Box Area -->
                                    <div class="fb-blog-comment-wrapper">
                                        <h3>Add New Comment</h3>
                                        <p id="my_validation_error"></p>
                                         {{Form::open(['route'=>['Home'],'method'=>'POST','class'=>'commentForm'])}}
                                            <div class="comment-post-box">
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <label>Comment</label>
                                                         {!! Form::textarea('comment_message','', array('placeholder' => trans('frontLang.comment'),'class' => 'coment-field','id'=>'comment_message','rows'=>'5', 'data-msg'=> trans('frontLang.enterYourComment'),'data-rule'=>'required')) !!}
                                                         
                                                        
                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-4 mt-5 mb-sm-20 mb-xs-20">
                                                        <label>Name</label>

                                                        {!! Form::text('comment_name',"", array('placeholder' => trans('frontLang.yourName'),'class' => 'coment-field','id'=>'comment_name', 'data-msg'=> trans('frontLang.enterYourName'),'data-rule'=>'minlen:4')) !!}
                                                


                                                    </div>
                                                    <div class="col-lg-6 col-md-6 col-sm-4 mt-5 mb-sm-20 mb-xs-20">
                                                        <label>Email</label>
                                                         {!! Form::email('comment_email',"", array('placeholder' => trans('frontLang.yourEmail'),'class' => 'coment-field','id'=>'comment_email', 'data-msg'=> trans('frontLang.enterYourEmail'),'data-rule'=>'email')) !!}
                                                          
                                                        
                                                    </div>
                                                    <div class="col-lg-12">
                                                        @if(env('NOCAPTCHA_STATUS', false))
                                                <div class="form-group">
                                                    {!! NoCaptcha::renderJs(trans('backLang.code')) !!}
                                                    {!! NoCaptcha::display() !!}
                                                </div>
                                            @endif

                                                    </div>
                                                     <input type="hidden" name="topic_id" value="{{$Topic->id}}">
                                                     
                                                    <div class="col-lg-12">
                                                        <div class="coment-btn pt-30 pb-sm-30 pb-xs-30 f-left" style="display: inline-flex;">
                                                            <input class="fb-btn-2" type="submit" name="submit" value="post comment">
                                                            <span id="small-loader" style="display: none;">
                                                         <img src="{{ URL::asset('front_end/images/small-loader.gif') }}" style="width:30px;" />
                                                     </span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                      {{Form::close()}}
                                    </div>
                                    <!-- Blog comment Box Area End Here -->
                                </div>
                            </div>
                        </div>
                        <!-- FB's Main Content Area End Here -->
                    </div>
                </div>
            </div>
            <!-- FB's Main Blog Page Area End Here -->

@endsection



@section('scripts')
<script type="text/javascript">
        $('form.commentForm').submit(function () {
                $("#small-loader").css('display' , 'block');
               // var f = $(this).find('.coment-field'),
                    ferror = false;
                    var comment_name = $('#comment_name').val();
                if(comment_name == '' || comment_name == null  )
                {
                    ferror = true;
                }
                if(comment_email == '' || comment_name == null  )
                {
                        ferror = true;
                }
                if(comment_message == '' || comment_message == null  )
                {
                        ferror = true;
                }
                
                if (ferror) 
                    {
                            $("#small-loader").css('display' , 'none');
                            $('#my_validation_error').html('<div class="alert alert-warning">Required Field is Missing! Please Try Again</div>');
                     return false;   
                    }
                else var str = $(this).serialize();
                var comment_html = '';
                $.ajax({
                    type: "POST",
                    url: "<?php echo route("commentSubmit"); ?>",
                    data: str,
                    success: function (data) {

                      var comment_data =  JSON.parse(data);
                            console.log(comment_data.name);
                            console.log(comment_data.email);
                            console.log(comment_data.comment);

                        comment_html += '<li>';
                        comment_html += '<div class="author-avatar pt-15">';
                        comment_html += '<img src="{{ URL::to('uploads/contacts/profile.jpg') }}" alt="User">';
                        comment_html += '</div>';
                        comment_html += '<div class="comment-body pl-15">';
                        comment_html += '<h5 class="comment-author pt-15">'+comment_data.name+'</h5>';
                        comment_html += '<div class="comment-post-date">'+comment_data.date+'</div>';
                        comment_html += '<p>'+comment_data.comment+'</p>';
                        comment_html += '</div>';
                        comment_html += '</li>';
                        $('#comments').append(comment_html);
                        $("#small-loader").css('display' , 'none');

                    }
                });
                return false;
            });

</script>

@endsection