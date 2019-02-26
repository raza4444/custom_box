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
						<li class="active">Blogs</li>
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- FB's Breadcrumb Area End Here -->

<!-- Begin FB's Main Blog Page Area -->
<div class="fb-main-blog-page pt-60 pb-40 pb-sm-15 pb-xs-15">
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
                                $Category_link_url = route('FrontendTopicsByCatWithLang', ["lang" => trans('backLang.code'), "section" => $Category->webmasterSection->name, "cat" => $Category->id]);
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
                                    $SubCategory_link_url = route('FrontendTopicsByCatWithLang', ["lang" => trans('backLang.code'), "section" => $MnuCategory->webmasterSection->name, "cat" => $MnuCategory->id]);
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
					@if($Topics->total() > 0)
					<?php
					$title_var = "title_" . trans('backLang.boxCode');
					$title_var2 = "title_" . trans('backLang.boxCodeOther');
					$details_var = "details_" . trans('backLang.boxCode');
					$details_var2 = "details_" . trans('backLang.boxCodeOther');
					$slug_var = "seo_url_slug_" . trans('backLang.boxCode');
					$slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
					$i = 0;
					?>
					@foreach($Topics as $Topic)
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
						
							$topic_link_url = route('FrontendBlogDetail', ["id" => $Topic->id]);
						
					}
					?>
					<div class="col-lg-12">
						<div class="fb-blog-single-item mb-30">
							<div class="row">
								
								<div class="col-lg-6">
									<div class="fb-blog-banner">
										<a href="{{ $topic_link_url }}">@if($Topic->photo_file !="")
                                        <img src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}"
                                        alt="{{ $title }}"/>
                                        @endif</a>

									</div>
								</div>
								<div class="col-lg-6">
									<div class="fb-blog-content">
										<div class="fb-blog-details">
											<h3 class="fb-blog-heading pt-xs-25 pt-sm-25"><a href="{{ $topic_link_url }}">{{ $title }}</a></h3>
											<div class="fb-blog-meta">
												
												<a class="author" href="{{route('FrontendUserTopics',$Topic->created_by)}}"><i class="fa fa-user"></i>{{$Topic->user->name}}</a>
												@if($Topic->webmasterSection->comments_status)
                                                
                                                <a class="comment"
                                                    href="{{route('FrontendBlogDetail',["id"=>$Topic->id])}}#comments"> <i class="fa fa-comment-o"></i> {{ trans('frontLang.comments') }}
                                                    : {{count($Topic->approvedComments)}} </a>
                                                @endif
												
												
												@if($Topic->webmasterSection->date_status)
                                                       
                                                        <a class="post-time" href="#"><i class="fa fa-calendar"></i>{!! $Topic->date  !!}</a>
                                                    @endif
												
											</div>
											<p>{{ str_limit(strip_tags($Topic->$details), $limit = 200, $end = '...') }}</p>
											<a class="read-more"href="{{ $topic_link_url }}">Read More...</a>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>


					@endforeach
					@endif

					<!-- Begin FB's Pagination Area -->
					<div class="col-lg-12">
						<div class="fb-paginatoin-area text-center pt-25">
							<div class="row">
								{{-- <div class="col-lg-12">
									<ul class="fb-pagination-box">
										<li><a class="Previous" href="#">Previous</a></li>
										<li class="active"><a href="#">1</a></li>
										<li><a href="#">2</a></li>
										<li><a href="#">3</a></li>
										<li><a class="Next" href="#">Next</a></li>
									</ul>
								</div> --}}
							</div>
						</div>
					</div>
					<!-- FB's Pagination End Here Area -->
				</div>
			</div>
			<!-- FB's Main Content Area End Here -->
		</div>
	</div>
</div>
<!-- FB's Main Blog Page Area End Here -->
@endsection