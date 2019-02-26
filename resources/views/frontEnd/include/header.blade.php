<!-- Begin Header Area -->
<header class="bg-midnight">
                                    <!-- Begin Header Top Area -->
                <div class="header-top">
                    <div class="container">
                        <div class="header-top-nav">
                            <div class="row">
                                <!-- Begin Header Top Left Area Area -->
                                <div class="col-lg-5 col-md-6">
                                    <div class="top-selector-wrapper">
                                        <ul class="single-top-selector">
                                            <!-- Begin Language Area -->
                                            <li class="language list-inline-item">
                                               
                            @if(Helper::GeneralSiteSettings("contact_t3") !="")
                      <span style="color:#fff;"> <i class="fa fa-phone"></i> &nbsp;<a
                                href="tel:{{ Helper::GeneralSiteSettings("contact_t5") }}"><span
                                    dir="ltr">{{ Helper::GeneralSiteSettings("contact_t5") }}</span></a></span> 
                    @endif
                                            </li>
                                            <!-- Language End Here -->
                                            <!-- Begin Currency Area -->
                                            <li class="currency list-inline-item">
                                              
                      @if(Helper::GeneralSiteSettings("contact_t6") !="")
                        <span class="top-email" style="color:#fff;">
                      
                    <i class="fa fa-envelope"></i> &nbsp;<a
                                    href="mailto:{{ Helper::GeneralSiteSettings("contact_t6") }}">{{ Helper::GeneralSiteSettings("contact_t6") }}</a>
                    </span>
                    @endif
                                            </li>
                                            <!-- Currency Area End Here -->
                                        </ul>
                                    </div>
                                </div>
                                <!-- Header Top Left Area End Here -->
                                <!-- Begin Header Top Right Area -->
                                <div class="col-lg-7 col-md-6">
                                    <div class="header-top-right">
                              
                                        <ul class="user-block list-inline">
                                        @if(Helper::GeneralWebmasterSettings("dashboard_link_status"))
                                        @if(Auth::check()) 
                                            <li><a href="{{ route('usersEdit', ["id" => Auth::user()->id ]) }}">My Account</a></li>
                                            <li><a href="{{ url("user") }}"> {{ Auth::user()->name }}</a></li>
                                            <li><a href="{{ url('logout') }}">Logout</a></li>
                                           @else
                                            <li><a href="{{ url("user") }}">Sign In</a>/<a href="{{ url("user") }}">Sign Up </a></li>
                                        @endif
                                        @endif
                                        </ul>
                                    </div>
                                </div>
                                <!-- Header Top Right Area End Here -->
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Header Top Area End Here -->
                                <!-- Begin Header Middle Area -->
                <div class="header-middle">
                    <div class="container logo-nav">
                        <div class="row align-items-center">
                            <!-- Begin Logo Area -->
                            <div class="col-lg-3">
                                <div class="logo">
                                <a class="navbar-brand" href="{{ route("Home") }}">
                    @if(Helper::GeneralSiteSettings("style_logo_" . trans('backLang.boxCode')) !="")
                        <img alt=""
                             src="{{ URL::to('uploads/settings/'.Helper::GeneralSiteSettings("style_logo_" . trans('backLang.boxCode'))) }}">
                    @else
                        <img alt="" src="{{ URL::to('uploads/settings/nologo.png') }}">
                    @endif

                </a>
                                    <!-- <a href="index.html">
                                        <img src="assets/images/menu/logo/1.jpg" alt="FB's Logo">
                                    </a> -->
                                </div>
                            </div>
                            <!-- Logo Area End Here -->
                            <!-- Begin Header Middle Right Area -->
                            <div class="col-lg-9">
                                <?php
   $category_title_var = "title_" . trans('backLang.boxCode');
   ?>
                                <!-- Begin Header Middle Right Area -->
                                <div class="header-middle-right">

                                    <!-- Begin Header Middle Searchbox Area -->
                                    {{Form::open(['route'=>['searchTopics'],'method'=>'POST','class'=>'hm-searchbox'])}}
                                       {{ csrf_field() }}
                                        <select name="search_category" class="nice-select select-search-category">
                                            
                                            <option value="0">All categories</option>
                                            @foreach($SearchCategories as $Category)
                                            <option value="{{ $Category->id }}">{{$Category->$category_title_var}}</option>
                                            @foreach($Category->fatherSections as $MnuCategory)
                                            <option value="{{ $MnuCategory->id }}" style="text-align:center">--{{$MnuCategory->$category_title_var}}</option>
                                            @foreach($MnuCategory->fatherSections as $MnuCategory)
                                            <option value="{{ $MnuCategory->id }}" style="text-align:center">----{{$MnuCategory->$category_title_var}}</option>
                                            @endforeach

                                            @endforeach
                                            @endforeach
                                            
                                        </select>
                                        {!! Form::text('search_word',@$search_word, array('placeholder' => trans('frontLang.search'),'required'=>'')) !!}

                                        <button class="fb-search_btn" type="submit"><i class="fa fa-search"></i></button>
                                    {{Form::close()}}
                                    <!-- Header Middle Searchbox Area End Here -->
                                   <div class="hm-menu">
                                   <a href="{{ route('Requestquote') }}" class="btn btn-lg btn-info Quote_btn">Get A Quote</a>
                                   </div>
                                </div>
                                <!-- Header Middle Right Area End Here -->
                            </div>
                            <!-- Header Middle Right Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Middle Area End Here -->

                 <!-- Begin Header Bottom Area -->
                <div class="header-bottom bg-polo-blue header-sticky stick">
                    <div class="container">
                        <div class="row">
                            <!-- Begin Category Menu Area -->
                            <div class="col-lg-3 col-md-5 col-sm-6">
                                <!--Category Menu Start-->
                                <div class="category-menu category-menu-hidden">
                                    <div class="category-heading">
                                        <h2 class="categories-toggle"><span>All Categories</span></h2>
                                    </div>
                                    <div id="cate-toggle" class="category-menu-list">
                                        <ul>
                                            <li class="right-menu"><a href="shop-left-sidebar.html"><span><img src="{{ URL::asset('front_end/images/category-thumb/1.jpg')}}" alt="Category-thumb"></span>Electronics</a>
                                                <ul class="cat-mega-menu">
                                                    <li class="right-menu cat-mega-title">
                                                       <a href="shop-left-sidebar.html">Cameras</a>
                                                        <ul>
                                                            <li><a href="#">Cords and Cables</a></li>
                                                            <li><a href="#">gps accessories</a></li>
                                                            <li><a href="#">Microphones</a></li>
                                                            <li><a href="#">Wireless Transmitters</a></li>
                                                        </ul>
                                                        <a class="cat-mega-title-2 pt-30 pt-sm-10 pt-xs-10" href="shop-left-sidebar.html">GamePad</a>
                                                         <ul>
                                                             <li><a href="#">cube lifestyle hd</a></li>
                                                             <li><a href="#">gopro hero4</a></li>
                                                             <li><a href="#">handycam cx405</a></li>
                                                             <li><a href="#">vixia hf r600</a></li>
                                                         </ul>
                                                    </li>
                                                    <li class="right-menu cat-mega-title">
                                                       <a href="shop-left-sidebar.html">Digital Cameras</a>
                                                        <ul>
                                                            <li><a href="#">Gold eye</a></li>
                                                            <li><a href="#">Questek</a></li>
                                                            <li><a href="#">Snm</a></li>
                                                            <li><a href="#">Vantech</a></li>
                                                        </ul>
                                                       <a class="cat-mega-title-2 pt-30 pt-sm-10 pt-xs-10" href="shop-left-sidebar.html">Virtual Reality</a>
                                                        <ul>
                                                            <li><a href="#">Samsung</a></li>
                                                            <li><a href="#">Toshiba</a></li>
                                                            <li><a href="#">Transcend</a></li>
                                                            <li><a href="#">Sandisk</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="right-menu"><a href="shop-left-sidebar.html"><span><img src="assets/images/category-thumb/2.jpg" alt="Category-thumb"></span>Book</a>
                                                <ul class="cat-mega-menu">
                                                    <li class="right-menu cat-mega-title">
                                                       <a href="shop-left-sidebar.html">Children's Books</a>
                                                        <ul>
                                                            <li><a href="#">Early Learning</a></li>
                                                            <li><a href="#">Animals</a></li>
                                                            <li><a href="#">Action & Adventure</a></li>
                                                            <li><a href="#">Education & Reference</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="right-menu cat-mega-title">
                                                       <a href="shop-left-sidebar.html">comic book</a>
                                                        <ul>
                                                            <li><a href="#">Superhero</a></li>
                                                            <li><a href="#">Slice-of-Life</a></li>
                                                            <li><a href="#">Humor</a></li>
                                                            <li><a href="#">Science-Fiction</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="right-menu"><a href="shop-left-sidebar.html"><span><img src="assets/images/category-thumb/3.jpg" alt="Category-thumb"></span>Home & Kitchen</a>
                                                <ul class="cat-mega-menu cat-mega-menu-2">
                                                    <li class="right-menu cat-mega-title">
                                                       <a href="shop-left-sidebar.html">Large Appliances</a>
                                                        <ul>
                                                            <li><a href="#">Armchairs</a></li>
                                                            <li><a href="#">Bunk Bed</a></li>
                                                            <li><a href="#">Mattress</a></li>
                                                            <li><a href="#">Sideboard</a></li>
                                                        </ul>
                                                       <a class="cat-mega-title-2 pt-30" href="shop-left-sidebar.html">Small Appliances</a>
                                                        <ul>
                                                            <li><a href="#">Bootees Bags</a></li>
                                                            <li><a href="#">Jackets</a></li>
                                                            <li><a href="#">Shelf</a></li>
                                                            <li><a href="#">Shoes</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="right-menu cat-mega-title">
                                                       <a href="shop-left-sidebar.html">Drinkware</a>
                                                        <ul>
                                                            <li><a href="#">Tour Drinkware</a></li>
                                                            <li><a href="#">Hatch Drinkware</a></li>
                                                            <li><a href="#">Direction Drinkware</a></li>
                                                            <li><a href="#">Crescent Drinkware</a></li>
                                                        </ul>
                                                       <a class="cat-mega-title-2 pt-30" href="shop-left-sidebar.html">Cookware</a>
                                                        <ul>
                                                            <li><a href="#">Cookware Brands</a></li>
                                                            <li><a href="#">Cookware Sets</a></li>
                                                            <li><a href="#">Individual Cookware</a></li>
                                                            <li><a href="#">Enamel Cookware</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="right-menu"><a href="shop-left-sidebar.html"><span><img src="assets/images/category-thumb/4.jpg" alt="Category-thumb"></span>Phones & Tablets</a>
                                                <ul class="cat-mega-menu">
                                                    <li class="right-menu cat-mega-title">
                                                       <a href="shop-left-sidebar.html">Tablet</a>
                                                        <ul>
                                                            <li><a href="#">Chamcham</a></li>
                                                            <li><a href="#">Sanai</a></li>
                                                            <li><a href="#">Meito</a></li>
                                                            <li><a href="#">Walton</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="right-menu cat-mega-title">
                                                       <a href="shop-left-sidebar.html">Smartphone</a>
                                                        <ul>
                                                            <li><a href="#">Xail</a></li>
                                                            <li><a href="#">Sanai</a></li>
                                                            <li><a href="#">Meito</a></li>
                                                            <li><a href="#">Chamcham</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li class="right-menu"><a href="shop-left-sidebar.html"><span><img src="assets/images/category-thumb/5.jpg" alt="Category-thumb"></span>Furnitured</a>
                                                <ul class="cat-mega-menu">
                                                    <li class="right-menu cat-mega-title">
                                                       <a href="shop-left-sidebar.html">bedroom</a>
                                                        <ul>
                                                            <li><a href="#">Bed</a></li>
                                                            <li><a href="#">lamp</a></li>
                                                            <li><a href="#">Mattress Sets</a></li>
                                                            <li><a href="#">Home Office</a></li>
                                                        </ul>
                                                    </li>
                                                    <li class="right-menu cat-mega-title">
                                                       <a href="shop-left-sidebar.html">livingroom</a>
                                                        <ul>
                                                            <li><a href="#">chair</a></li>
                                                            <li><a href="#">table</a></li>
                                                            <li><a href="#">carpet</a></li>
                                                            <li><a href="#">Sofa</a></li>
                                                        </ul>
                                                    </li>
                                                </ul>
                                            </li>
                                            <li><a href="#"><span><img src="assets/images/category-thumb/6.jpg" alt="Category-thumb"></span>Video games</a></li>
                                            <li><a href="#"><span><img src="assets/images/category-thumb/7.jpg" alt="Category-thumb"></span>Sport & tourisim</a></li>
                                            <li><a href="#"><span><img src="assets/images/category-thumb/8.jpg" alt="Category-thumb"></span>Fruits & Veggies</a></li>
                                            <li><a href="#"><span><img src="assets/images/category-thumb/9.jpg" alt="Category-thumb"></span>Computer & Laptop</a></li>
                                            <li><a href="#"><span><img src="assets/images/category-thumb/10.jpg" alt="Category-thumb"></span>Meat & Seafood</a></li>
                                            <li class="rx-child"><a href="#"><span><img src="assets/images/category-thumb/11.jpg" alt="Category-thumb"></span>Accessories</a></li>
                                            <li class="rx-parent">
                                                <a class="rx-default">More Categories</a>
                                                <a class="rx-show">Less Categories</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <!--Category Menu End-->
                            </div>
                            <!-- Category Menu Area End Here -->

                                @include('frontEnd.include.menu')
                              

                        </div>
                        <div class="row">
                            <!-- Begin Mobile Menu Area -->
                            <div class="mobile-menu-area d-lg-none d-xl-none col-12">
                                <div class="mobile-menu"></div>
                            </div>
                            <!-- Mobile Menu Area End Here -->
                        </div>
                    </div>
                </div>
                <!-- Header Bottom Area End Here -->


                </header>
            <!-- Header Area End Here -->