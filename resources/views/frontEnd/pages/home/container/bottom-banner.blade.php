 @if(count($BottomBanners)>0)

 <div class="fb-banner_with-new_product pb-60">
                <div class="container">
                   

                    <div class="row">

                        
                           <?php
        $title_var = "title_" . trans('backLang.boxCode');
        $details_var = "details_" . trans('backLang.boxCode');
        $file_var = "file_" . trans('backLang.boxCode');
        ?>
             @foreach($BottomBanners as $SliderBanner)
                     <div class="col-lg-6 col-sm-12" style="padding: 8px !important;">
                                <div class="fb-banner fb-img-hover-effect">
                                <a href="{!! $SliderBanner->link_url !!}">
                                    <img src="{{ URL::to('uploads/banners/'.$SliderBanner->$file_var) }}" alt="FB'S Banner">
                                </a>
                            </div>
                            </div>

@endforeach


                    </div>
                    </div>
                    </div>

                    @endif