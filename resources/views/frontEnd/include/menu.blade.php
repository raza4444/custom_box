
<!-- Begin Header Bottom Menu Area -->
<div class="col-lg-9 d-none d-lg-block d-xl-block position-static">
    <!-- FB's Navigation -->
    <nav class="fb-navigation">
        <ul>
            <li class="active">
                <a href="{{ route('Home') }}">Home</a>

            </li>
          @foreach($SearchCategories as $Category)
           <li class="dropdown-holder">
                                            <a href="shop-left-sidebar.html">{{$Category->$category_title_var}}</a>
                                            @if(count($Category->fatherSections)>0)
                                            <ul class="hb-dropdown hb-dropdown-2">
                                                  @foreach($Category->fatherSections as $MnuCategory)
                                                <li><a href="shop-left-sidebar.html">{{$MnuCategory->$category_title_var}}</a>
                                                    @if(count($MnuCategory->fatherSections)>0)
                                                    <ul>
                                                        @foreach($MnuCategory->fatherSections as $MnusubCategory)
                                                        <li><a href="shop-3-column.html">{{$MnusubCategory->$category_title_var}}</a></li>
                                                        @endforeach
                                                        
                                                    </ul>
                                                    @endif
                                                </li>
                                                @endforeach
                                               
                                                
                                            </ul>
                                            @endif
                                        </li>
                                         @endforeach



                                        

            <li >
                <a href="{{ url('blogs') }}">Blog</a>
               
            </li>
            <li>
                <a href="{{ url('about') }}">About Us</a>
            </li>
           
        </ul>
    </nav>
    <!--FB's Navigation -->
</div>
                            <!-- Header Bottom Menu Area End Here -->