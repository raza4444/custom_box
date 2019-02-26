 <div class="col-lg-12">
    <div class="slider-area">
         @if(count($SliderBanners)>0)
        <div class="slider-active owl-carousel">
           
            @foreach($SliderBanners->slice(0,1) as $SliderBanner)
            <?php
            try {
                $SliderBanner_type = $SliderBanner->webmasterBanner->type;
            } catch (Exception $e) {
                $SliderBanner_type = 0;
            }
            ?>
            @endforeach
            <?php
        $title_var = "title_" . trans('backLang.boxCode');
        $details_var = "details_" . trans('backLang.boxCode');
        $file_var = "file_" . trans('backLang.boxCode');
        ?> @if($SliderBanner_type==0)
            {{-- Text/Code Banners--}}
            <div class="text-center">
                @foreach($SliderBanners as $SliderBanner)
                    @if($SliderBanner->$details_var !="")
                        <div>{!! $SliderBanner->$details_var !!}</div>
                    @endif
                @endforeach
            </div>
             @elseif($SliderBanner_type==1)
             @foreach($SliderBanners as $SliderBanner)
            <!-- Begin Single Slide Area -->
            <div class="single-slide align-center-left  animation-style-01 bg-1" style="background-image: url({{ URL::to('uploads/banners/'.$SliderBanner->$file_var) }});">
                <div class="slider-progress"></div>
                <div class="slider-content">
                    @if($SliderBanner->$details_var !="")
                                    <h2>{!! $SliderBanner->$title_var !!}</h2>
                                @endif
                  @if($SliderBanner->$details_var !="")
                                    <h5>{!! nl2br($SliderBanner->$details_var) !!}</h5>
                                @endif
                                 @if($SliderBanner->link_url !="")
                    <div class="default-btn slide-btn">
                        <a class="fb-links fb-links-round" href="{!! $SliderBanner->link_url !!}">Shop Now</a>
                    </div>
                      @endif
                </div>
            </div>
            @endforeach
            @endif
            <!-- Single Slide Area End Here -->

        </div>
        @endif
    </div>
</div>