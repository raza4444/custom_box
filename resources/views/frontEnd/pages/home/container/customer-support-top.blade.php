 <div class="fb-customer_support pb-55">
                <div class="container">
                    <div class="row fb-customer_support-nav bg-white ml-0 mr-0 mt-30">
                        <div class="col-lg-4 col-md-4">
                            <ul class="customer-support_info pt-xs-30">
                                <li class="customer-support_text">
                                    <i class="fa fa-clock-o"></i>
                                    <span class="customer-support_date">{{ Helper::GeneralSiteSettings("contact_t7_en") }}</span>
                                    <span class="customer-support_service">Working Days/Hours!</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <ul class="customer-support_info pt-xs-30">
                                <li class="customer-support_text">
                                    <i class="fa fa-mobile"></i>
                                    @if(Helper::GeneralSiteSettings("contact_t3") !="")
                                    <span class="customer-support_date">{{ Helper::GeneralSiteSettings("contact_t5") }}</span>
                                     @endif
                                    <span class="customer-support_service">Free support line!</span>
                                </li>
                            </ul>
                        </div>
                        <div class="col-lg-4 col-md-4">
                            <ul class="customer-support_info customer-support_info-3 pt-xs-30 pb-xs-30">
                                <li class="customer-support_text">
                                    <i class="fa fa-envelope-o"></i>
                                    @if(Helper::GeneralSiteSettings("contact_t6") !="")
                                    <span class="customer-support_date">{{ Helper::GeneralSiteSettings("contact_t6") }}</span>
                                    @endif
                                    <span class="customer-support_service">Orders Support!</span>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>