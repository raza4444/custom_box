@extends('frontEnd.main')
@section('content')

<!-- Begin Li's Breadcrumb Area -->
<div class="breadcrumb-area pt-30 pb-30">
	<div class="container">
		<div class="row">
			<div class="col-lg-12">
				<div class="breadcrumb-content">
					<ul>
						<li><a href="{{ route("Home") }}">Home</a></li>
						@if(@$WebmasterSection!="none")
						<li class="active">{!! trans('backLang.'.$WebmasterSection->name) !!}</li>
						@elseif(@$search_word!="")
						<li class="active">{{ @$search_word }}</li>
						@else
						<li class="active">{{ $User->name }}</li>
						@endif
						@if($CurrentCategory!="none")
						@if(!empty($CurrentCategory))
						<?php
						$category_title_var = "title_" . trans('backLang.boxCode');
						?>
						<li class="active"><i
							class="icon-angle-right"></i>{{ $CurrentCategory->$category_title_var }}
						</li>
						@endif
						@endif
					</ul>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- Li's Breadcrumb Area End Here -->

<div class="content-wraper">
	<div class="container">
		<div class="row">
			<div class="col-lg-9 order-1 order-lg-2">
				<!-- Begin FB's Banner Area -->
				<div class="shoptopbar-heading">
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

				<!-- shop-products-wrapper start -->
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
				<div class="shop-products-wrapper bg-white mt-30 pb-60 pb-sm-30">
					<div class="tab-content">
						<div id="grid-view" class="tab-pane fade active show" role="tabpanel">
							<div class="fb-product_wrap shop-product-area">
								<div class="row">
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
										$topic_link_url = route('FrontendProduct', ["id" => $Topic->id]);
									}
									?>
									<div class="col-lg-4 col-md-4 col-sm-6">
										<!-- Begin Sigle Product Area -->
										<div class="single-product">
											<!-- Begin Product Image Area -->
											<div class="product-img">

												<a href="{{ $topic_link_url }}">
													@if($Topic->photo_file !="")
													<img class="primary-img" src="{{ URL::to('uploads/topics/'.$Topic->photo_file) }}" >
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


											</div>
											<!-- Product Image Area End Here -->
											<!-- Begin Product Content Area -->
											<div class="product-content">
												<h2 class="product-name">
													<a href="{{ $topic_link_url }}"> {{ $title }}</a>
												</h2>


												<div class="product-action">
													
												</div>
											</div>
											<!-- Product Content Area End Here -->
										</div>
										<!-- Sigle Product Area End Here -->
									</div>

									@endforeach

									<!--here finish-->


								</div>
							</div>
						</div>
					</div>
				</div>
				@endif

				<!-- shop-products-wrapper start -->

				<!-- shop-top-bar end -->
			</div>


			<!--sidebar-->
			@include('frontEnd.pages.products.sidebar')
			<!--end-->


		</div>
	</div>
</div>
<br><br><br><br>
@endsection