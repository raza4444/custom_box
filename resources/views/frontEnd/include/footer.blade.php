 <!-- Begin FB's Footer Area -->
 <div class="fb-footer">
 	<!-- Begin Footer Top Area -->
 	<div class="fb-footer_top">
 		<div class="container">
 			<div class="row">
 				<!-- Begin FB's Newsletters Area -->
 				<div class="col-lg-5">
 					<div class="fb-newsletters">
 						<h2 class="newsletters-headeing">Sign Up For Newsletters</h2>
 						<p class="short-desc">Be The First To Know. Sign Up For Newsletter Today</p>
 					</div>
 				</div>
 				<!-- FB's Newsletters Area End Here -->
 				<!-- Begin FB's Newsletters Form Area -->
 				<div class="col-lg-7">
 					<div class="fb-newsletters_form pt-sm-15 pt-xs-15">

 						@if(Helper::GeneralSiteSettings("style_subscribe"))
 						{{Form::open(['route'=>['Home'],'method'=>'POST','class'=>'footer-subscribe-form validate subscribeForm'])}}
 						<div id="mc_embed_signup_scroll">
 							<div id="mc-form" class="mc-form subscribe-form form-group" >
 								{{ Form::hidden('subscribe_name', 'Visitor' , array('id'=>'subscribe_name')) }}
 								{!! Form::email('subscribe_email',"", array('placeholder' => trans('frontLang.yourEmail'),'id'=>'subscribe_email', 'data-msg'=> trans('frontLang.enterYourEmail'),'data-rule'=>'email')) !!}

 								<button  type="submit" class="btn mt-sm-15 mt-xs-15" id="mc-submit">Subscribe!</button>
 							</div>
 						</div>
 						{{Form::close()}}
 						@endif
 					</div>

                       <div id="subscribesendmessage"><i class="fa fa-check-circle"></i> &nbsp;{{ trans('frontLang.subscribeToOurNewsletterDone') }}</div>
            <div id="subscribeerrormessage">{{ trans('frontLang.youMessageNotSent') }}</div>
 				</div>
 				<!-- FB's Newsletters Form Area End Here -->
 			</div>
 		</div>
 	</div>
 	<!-- Footer Top Area End Here -->

 	<!-- Begin FB's Footer Middle Area -->
 	<div class="fb-footer_middle bg-white">
 		<div class="container">
 			<!-- Begin Footer Middle Top Area -->
 			<div class="footer-middle_top">
 				<div class="row">
 					<!-- Begin FB's Footer Widget Area -->
 					<div class="col-xl-4 col-lg-4 col-sm-12">
 						<div class="footer-widget-logo pt-30 mb-20 pt-sm-5 pt-xs-5">
               @if(Helper::GeneralSiteSettings("footer_logo") !="")
                       <a href="#">
                        <img style="width: 62%;" alt=""
                             src="{{ URL::to('uploads/settings/'.Helper::GeneralSiteSettings("footer_logo" )) }}">
                    </a>
                    @else
                    <a href="#">
                        <img alt="" src="{{ URL::to('uploads/settings/nologo.png') }}">
                   </a>
                    @endif
 						</div>
 						<div class="footer-widget-info">
 							<p class="footer-widget_short-desc">We are a team of designers and developers that create high quality HTML Template & Woocommerce, Shopify Theme.
 							</p>
 							

 						</div>
 					</div>
 					<!-- FB's Footer Widget Area End Here -->
 					<!-- Begin FB's Footer Widget Area -->
 					@if(Helper::GeneralWebmasterSettings("footer_menu_id") >0)
 					<?php
                    // Get list of footer menu links by group Id
 					$FooterMenuLinks = Helper::MenuList(Helper::GeneralWebmasterSettings("footer_menu_id"));
 					?>
 					@if(count($FooterMenuLinks)>0)
 					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-l2">
 						<div class="fb-footer_widget pt-20 pt-xs-0">
 							<?php
 							$link_title_var = "title_" . trans('backLang.boxCode');
 							$main_title_var = "FooterMenuLinks_name_" . trans('backLang.boxCode');
 							$slug_var = "seo_url_slug_" . trans('backLang.boxCode');
 							$slug_var2 = "seo_url_slug_" . trans('backLang.boxCodeOther');
 							?>
 							<h3 class="fb-footer-widget-headeing">{{$$main_title_var}}</h3>
 							<ul>
 								@foreach($FooterMenuLinks as $FooterMenuLink)
 								@if($FooterMenuLink->type==3 || $FooterMenuLink->type==2)
 								<li> <?php
 								if ($FooterMenuLink->webmasterSection->$slug_var != "" && Helper::GeneralWebmasterSettings("links_status")) {
 									if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
 										$mmnnuu_link = url(trans('backLang.code') . "/" . $FooterMenuLink->webmasterSection->$slug_var);
 									} else {
 										$mmnnuu_link = url($FooterMenuLink->webmasterSection->$slug_var);
 									}
 								} else {
 									if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
 										$mmnnuu_link = url(trans('backLang.code') . "/" . $FooterMenuLink->webmasterSection->name);
 									} else {
 										$mmnnuu_link = url($FooterMenuLink->webmasterSection->name);
 									}
 								}
 								?>
 								<a href="{{ $mmnnuu_link }}">{{ $FooterMenuLink->$link_title_var }}</a></li>
 								@elseif($FooterMenuLink->type==1)
 								{{-- Direct link --}}
 								<?php
 								if (trans('backLang.code') != env('DEFAULT_LANGUAGE')) {
 									$this_link_url = url(trans('backLang.code') . "/" . $FooterMenuLink->link);
 								} else {
 									$this_link_url = url($FooterMenuLink->link);
 								}
 								?>
 								<li>
 									<a href="{{ $this_link_url }}">{{ $FooterMenuLink->$link_title_var }}</a>
 								</li>
 								@else
 								{{-- No link --}}
 								<li><a>{{ $FooterMenuLink->$link_title_var }}</a></li>

 								@endif
 								@endforeach
 							</ul>
 						</div>
 					</div>

 					@endif
 					@endif
 					<!-- FB's Footer Widget Area End Here -->
 					<!-- Begin FB's Footer Widget Area -->
 					<div class="col-xl-4 col-lg-4 col-md-4 col-sm-12">
 						<div class="fb-footer_widget pt-20 pt-xs-0">
 							<h3 class="fb-footer-widget-headeing">Contact info</h3>
 							@if(Helper::GeneralSiteSettings("contact_t1_" . trans('backLang.boxCode')) !="")
 							<address>
 								<strong>{{ trans('frontLang.address') }}:</strong><br>
 								<i class="fa fa-map-marker"></i>
 								&nbsp;{{ Helper::GeneralSiteSettings("contact_t1_" . trans('backLang.boxCode')) }}
 							</address>
 							@endif
 							@if(Helper::GeneralSiteSettings("contact_t3") !="")
 							<p>
 								<strong>{{ trans('frontLang.callUs') }}:</strong><br>
 								<i class="fa fa-phone"></i> &nbsp;<a
 								href="tel:{{ Helper::GeneralSiteSettings("contact_t3") }}"><span
 								dir="ltr">{{ Helper::GeneralSiteSettings("contact_t3") }}</span></a></p>
 								@endif
 								@if(Helper::GeneralSiteSettings("contact_t6") !="")
 								<p>
 									<strong>{{ trans('frontLang.email') }}:</strong><br>
 									<i class="fa fa-envelope"></i> &nbsp;<a
 									href="mailto:{{ Helper::GeneralSiteSettings("contact_t6") }}">{{ Helper::GeneralSiteSettings("contact_t6") }}</a>
 								</p>
 								@endif
 								<div class="footer-widget-social-link">
 									<ul class="social-link">
 										@if($WebsiteSettings->social_link1)
 										<li class="facebook">
 											<a href="{{$WebsiteSettings->social_link1}}" data-toggle="tooltip" target="_blank" title="Facebook">
 												<i class="fa fa-facebook"></i>
 											</a>
 										</li>
 										@endif
 										@if($WebsiteSettings->social_link2)
 										<li class="twitter">
 											<a href="{{$WebsiteSettings->social_link2}}" data-toggle="tooltip" target="_blank" title="Twitter">
 												<i class="fa fa-twitter"></i>
 											</a>
 										</li>
 										@endif

 										@if($WebsiteSettings->social_link3)
 										<li class="google-plus">
 											<a href="{{$WebsiteSettings->social_link3}}" data-toggle="tooltip" target="_blank" title="Google Plus">
 												<i class="fa fa-google-plus"></i>
 											</a>
 										</li>
 										@endif
 										@if($WebsiteSettings->social_link5)
 										<li class="youtube">
 											<a href="{{$WebsiteSettings->social_link5}}" data-toggle="tooltip" target="_blank" title="Youtube">
 												<i class="fa fa-youtube"></i>
 											</a>
 										</li>
 										@endif
 										@if($WebsiteSettings->social_link4)
 										<li><a class="linkedin" href="{{$WebsiteSettings->social_link4}}" data-placement="top" title="linkedin"
 											target="_blank"><i
 											class="fa fa-linkedin"></i></a></li>
 											@endif
 											@if($WebsiteSettings->social_link6)
 											<li class="instagram">
 												<a href="{{$WebsiteSettings->social_link6}}" data-toggle="tooltip" target="_blank" title="Instagram">
 													<i class="fa fa-instagram"></i>
 												</a>
 											</li>
 											@endif
 											  @if($WebsiteSettings->social_link8)
                            <li><a href="{{$WebsiteSettings->social_link8}}" data-placement="top" title="Tumblr"
                                   target="_blank"><i
                                            class="fa fa-tumblr"></i></a></li>
                        @endif
                        @if($WebsiteSettings->social_link9)
                            <li><a href="{{$WebsiteSettings->social_link9}}" data-placement="top" title="Flickr"
                                   target="_blank"><i
                                            class="fa fa-flickr"></i></a></li>
                        @endif
 											  @if($WebsiteSettings->social_link10)
                            <li><a class="twitter" href="https://api.whatsapp.com/send?phone={{$WebsiteSettings->social_link10}}"
                                   data-placement="top"
                                   title="Whatsapp" target="_blank"><i
                                            class="fa fa-whatsapp"></i></a></li>
                        @endif
 										</ul>
 									</div>
 								</div>
 							</div>
 							<!-- FB's Footer Widget Area End Here -->

 						</div>
 					</div>
 					<!-- Footer Middle Top Area End Here -->
 					<!-- Begin Footer Middle Bottom Area -->

 					<!-- Footer Middle Bottom Area End Here -->
 				</div>
 			</div>
 			<!-- FB's Footer Middle Area End Here -->
 			<!-- Begin Footer Bottom Area -->
 			<div class="footer-bottom">
 				<div class="container">
 					<div class="row">
 						<!-- Begin Copyright Area -->
 						<div class="col-lg-6 col-md-6">
 							<div class="copyright">

 								<span>
 									<?php
 									$site_title_var = "site_title_" . trans('backLang.boxCode');
 									?>
 									&copy; <?php echo date("Y") ?> {{ trans('frontLang.AllRightsReserved') }}
 									. <a>{{$WebsiteSettings->$site_title_var}}</a>
 								</span>
 							</div>
 						</div>
 						<!-- Copyright Area End Here -->

 					</div>
 				</div>
 			</div>
 			<!-- Footer Bottom Area End Here -->
 		</div>
 <!-- FB's Footer Area End Here -->