
<header class="header header-style2">
    <div class="top-header">
        <div class="container">
            <div class="top-header-menu">
                <a href="#"><i class="fa fa-phone"></i> +84 845.381.921</a>
                <a href="#"><i class="fa fa-clock-o"></i> T2 - CN: 08 am - 22 pm</a>
                <a href="mailto:chuongvu2806@gmail.com"><i class="fa fa-envelope-o"></i> chuongvu2806@gmail.com</a>
            </div>
            <div class="top-header-right">
                <ul>
                    @if(session()->has('auth') == false)
                    <li><a href="{{url('login/member')}}"><i class="fa fa-key"></i> Đăng nhập</a></li>
                    <li><a href="{{url('register/member')}}"><i class="fa fa-user"></i> Đăng ký</a></li>
                    @endif
                    <li class="dropdown">
                        <a data-toggle="dropdown" href="#"><i class="fa fa-cog"></i> SETTINGS</a>
                        <ul class="dropdown-menu">
                            <li><a href="#">MY ACCOUNT</a></li>
                            <li><a href="#">My Wishlist</a></li>
                            @if(session()->has('auth') ==true)
                            <li><a href="{{url('logout/member')}}">Logout</a></li>
                            @endif
                        </ul>
                    </li>
{{--                    <li class="dropdown">--}}
{{--                        <a data-toggle="dropdown" href="#">USD</a>--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            <li><a class="current" href="#">USD</a></li>--}}
{{--                            <li><a href="#">Euro</a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
{{--                    <li class="dropdown language">--}}
{{--                        <a data-toggle="dropdown" href="#"><img src="{{asset('frontend/js/custom.js')}}x" alt=""/>ENGLISH</a>--}}
{{--                        <ul class="dropdown-menu">--}}
{{--                            <li><a class="current" href="#">ENGLISH</a></li>--}}
{{--                            <li><a href="#">French<img src="{{asset('frontend/images/fr.jpg')}}" alt="" /></a></li>--}}
{{--                            <li><a href="#">GERMANY<img src="{{asset('frontend/images/gren.jpg')}}" alt="" /></a></li>--}}
{{--                        </ul>--}}
{{--                    </li>--}}
                </ul>
            </div>
        </div>
    </div>
    <div class="main-header">
        <div class="container main-header-inner">
            <div id="form-search" class="form-search">
                <form>
                    <input type="text" placeholder="YOU CAN SEARCH HERE..." />
                    <button class="btn-search"><i class="fa fa-search"></i></button>
                </form>
            </div>
            <div class="row">
                <div  class="col-sm-12 col-md-12 col-lg-3">
                    <div class="logo">
                        <a href="{{url('/')}}"><img src="{{asset('frontend/chunn1.png')}}" style="width: 180px" alt="" /></a>
                    </div>
                </div>
                <div class="col-sm-10 col-md-10 col-lg-7 main-menu-wapper">
                    <a href="#" class="mobile-navigation"><i class="fa fa-bars"></i></a>
                    <nav id="main-menu" class="main-menu">
                        <ul class="navigation">
                            <li class="menu-item">
                                <a href="{{url('/')}}">Trang chủ</a>
{{--                                <ul class="sub-menu">--}}
{{--                                    <li><a href="index.html">Home Version 01</a></li>--}}
{{--                                    <li><a href="index2.html">Home Version 02</a></li>--}}
{{--                                    <li><a href="index3.html">Home Version 03</a></li>--}}
{{--                                    <li><a href="index4.html">Home Version 04</a></li>--}}
{{--                                    <li><a href="index5.html">Home Version 05</a></li>--}}
{{--                                    <li><a href="index6.html">Home Version 06</a></li>--}}
{{--                                    <li><a href="index7.html">Home Version 07</a></li>--}}
{{--                                </ul>--}}
                            </li>
                            <li><a href="{{url('sale-upto-50%.html')}}">Sale upto 50%</a></li>
{{--                            <li class="menu-item-has-children item-mega-menu">--}}
{{--                                <a href="#">Sale</a>--}}
{{--                                <div class="sub-menu mega-menu">--}}
{{--                                    <div class="row">--}}
{{--                                        <div class="col-sm-1"></div>--}}
{{--                                        <div class="col-sm-2">--}}
{{--                                            <div class="widget">--}}
{{--                                                <h3 class="widgettitle">Shop pages</h3>--}}
{{--                                                <ul>--}}
{{--                                                    <li><a href="shop-fullwidth.html">Shop fullwidth</a></li>--}}
{{--                                                    <li><a href="shop-with-colection.html">Shop with Colection</a></li>--}}
{{--                                                    <li><a href="shop-left-sidebar.html">Shop left sidebar</a></li>--}}
{{--                                                    <li><a href="shop-list-view.html">Shop list view</a></li>--}}
{{--                                                    <li><a href="cart.html">Cart page</a></li>--}}
{{--                                                    <li><a href="checkout.html">Checkout page</a></li>--}}
{{--                                                    <li><a href="single-product.html">Product page</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-2">--}}
{{--                                            <div class="widget">--}}
{{--                                                <h3 class="widgettitle">Inner page</h3>--}}
{{--                                                <ul><li><a href="about.html">About Us</a></li>--}}
{{--                                                    <li><a href="contact.html">Contact Us</a></li>--}}
{{--                                                    <li><a href="faq.html">Faq</a></li>--}}
{{--                                                    <li><a href="typography.html">Typography</a></li>--}}
{{--                                                    <li><a href="columns.html">Columns</a></li>--}}
{{--                                                    <li><a href="#">Jackets</a></li>--}}
{{--                                                    <li><a href="#">Parkas</a></li>--}}
{{--                                                </ul>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="widget">--}}
{{--                                                <a href="#"><img src="{{asset('frontend/images/megamenus/banner1.jpg')}}" alt="" /></a>--}}
{{--                                            </div>--}}
{{--                                            <div class="widget">--}}
{{--                                                <a href="#"><img src="{{asset('frontend/images/megamenus/banner2.jpg')}}" alt="" /></a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                        <div class="col-sm-3">--}}
{{--                                            <div class="widget">--}}
{{--                                                <a href="#"><img src="{{asset('frontend/images/megamenus/banner3.jpg')}}" alt="" /></a>--}}
{{--                                            </div>--}}
{{--                                            <div class="widget">--}}
{{--                                                <a href="#"><img src="{{asset('frontend/images/megamenus/banner4.jpg')}}" alt="" /></a>--}}
{{--                                            </div>--}}
{{--                                        </div>--}}
{{--                                    </div>--}}
{{--                                </div>--}}
{{--                            </li>--}}

                            <li class="menu-item-has-children item-mega-menu">
                                <a href="{{url('san-pham.html')}}" target="_blank">Sản Phẩm</a>
                                <div class="sub-menu mega-menu style2">
                                    <div class="row">
                                        <div class="col-sm-1"></div>
                                        @foreach($cates as $c => $item)
                                                <div class="col-sm-2">
                                                    <div class="widget">
                                                        @if($item->role == 0 && $item->status == 1)
                                                        <a href="{{url($item->slug.'/'.$item->id.'.html')}}" target="_blank" class="widgettitle">{{$item->name}}</a>
                                                        @endif
                                                        <ul>
                                                            @foreach($item->child as $child => $item)
                                                                @if($item->status == 1)
                                                                    <li><a href="{{url($item->slug.'/'.$item->id.'.html')}}" target="_blank">{{$item->name}}</a></li>
                                                                @endif
                                                            @endforeach
                                                        </ul>

                                                    </div>
                                                </div>
                                        @endforeach
                                        <div class="col-sm-4">
                                            <div class="widget">
                                                <a href="#"><img src="{{asset('frontend/images/megamenus/banner5.jpg')}}" alt="" /></a>
                                            </div>
                                            <div class="widget">
                                                <a href="#"><img src="{{asset('frontend/images/megamenus/banner6.jpg')}}" alt="" /></a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </li>

                            <li class="menu-item-has-children">
                                <a href="#">Bộ sưu tập</a>
                                <ul class="sub-menu">
                                    <li><a href="">Bộ sưu tập mùa hè </a></li>
                                    <li><a href="">Bộ sưu tập mùa đông</a></li>
                                </ul>
                            </li>
                            <li><a href="{{url('tin-tuc.html')}}" target="_blank">Tin tức</a></li>
                            <li class="menu-item-has-children">
                                <a href="blog-list.html">Trợ giúp</a>
                                <ul class="sub-menu">
                                    <li><a href="blog-grid-2columns.html">Giới thiệu</a></li>
                                    <li><a href="blog-list.html">Liên hệ</a></li>
                                    <li><a href="blog-grid-3columns.html">Đăng nhập</a></li>
                                    <li><a href="blog-masonry.html">Đăng ký</a></li>
                                    <li><a href="blog-detail.html">Giỏ hàng</a></li>
                                </ul>
                            </li>
                        </ul>
                    </nav>
                </div>
                <div class="col-sm-2 col-md-2">
                    <!-- Icon search -->
                    <div class="icon-search">
                        <span class="icon"><i class="fa fa-search"></i></span>
                    </div>
                    <!-- ./Icon search -->
                    <!-- Mini cart -->
                    @php
                    if(session()->get('cart')){
                         $cart = session()->get('cart');
                    }
                    $total = 0;
                    @endphp
                    <div class="mini-cart">
                        @if(session()->has('auth') == true)

                        <a class="icon" href="{{url('cart')}}" target="_blank">Cart <span class="count">@if(session()->get('cart')){{count($cart)}}@else 0 @endif</span></a>
                        @else
                            <a class="icon" href="{{url('login/member')}}" target="_blank">Cart <span class="count">@if(session()->get('cart')){{count($cart)}}@else 0 @endif</span></a>
                        @endif
                            <div class="mini-cart-content">
                                @if(session()->get('cart') ==true)
                                    @php
                                        $cart = session()->get('cart');
                                        $key = 'total';
                                        $sum = array_sum(array_column($cart,$key));
                                    @endphp
                                    <ul class="list-cart-product">
                                        @foreach($cart as $c => $item)
                                            <li>
                                                <div class="product-thumb">
                                                    <a href="#"><img src="{{$item['pro_image']}}" alt="" /></a>
                                                </div>
                                                <div class="product-info">
                                                    <h5 class="product-name"><a href="#">{{$item['pro_name']}}</a></h5>
                                                    <span class="price">{{number_format($item['pro_price'])}}₫</span>
                                                    <span class="qty">Qty: {{$item['amount']}} - Size: {{$item['size']}} - Color: {{$item['color']}}</span>
                                                    <a href="#" class="remove">remove</a>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                    <p class="sub-toal-wapper">
                                        <span>SUBTOTAL</span>
                                        <span class="sub-toal">{{number_format($sum)}}₫</span>
                                    </p>
                                    <a href="#" class="btn-view-cart">VIEW SHOPPING CART</a>
                                    <a href="#" class="btn-check-out">PROCESS TO CHECK OUT</a>
                                @else
                                    <div class="d-flex text-center justify-content-center">
                                        <img src="{{asset('frontend/shiper.png')}}" width="80%" class="">
                                    </div>
                                @endif

                            </div>
                    </div>
                    <!-- ./Mini cart -->
                </div>
            </div>
        </div>
    </div>
</header>
