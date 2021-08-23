@extends('frontend.layout.main')

@section('content')
    <div class="section-slide">
        <div class="slide-home owl-carousel" data-animatein="fadeIn" data-animateout="fadeOut" data-margin="0"  data-nav="true" data-autoplay="true" data-loop="true" data-responsive='{"0":{"items":1,"nav":false},"600":{"items":1},"1000":{"items":1}}'>
            <div class="item-slide">
                <figure><img src="{{asset('frontend/images/slide/slide2.jpg')}}" alt=""></figure>
                <div class="overlay"></div>
                <div class="content-slide">
                    <p class="crimtext caption-small">The Fall Report</p>
                    <h2 class="caption-title-2">the  fall  2016</h2>
                    <div class="ground-button">
                        <a href="#" class="leka-button">SHOP NOW</a>
                        <a href="#" class="leka-button button-style2">BUY THEME</a>
                    </div>
                </div>
            </div>
            <div class="item-slide">
                <figure><img src="{{asset('frontend/images/slide/slide2-2.jpg')}}" alt=""></figure>
                <div class="overlay"></div>
                <div class="content-slide">
                    <p class="crimtext caption-small">Special Price 2016</p>
                    <h2 class="caption-title-2">LONG SLEEVE COAT</h2>
                    <div class="ground-button">
                        <a href="#" class="leka-button">SHOP NOW</a>
                        <a href="#" class="leka-button button-style2">BUY THEME</a>
                    </div>
                </div>
            </div>
            <div class="item-slide">
                <figure><img src="{{asset('frontend/images/slide/slide2-3.jpg')}}" alt=""></figure>
                <div class="overlay"></div>
                <div class="content-slide">
                    <p class="crimtext caption-small">Special Price 2016</p>
                    <h2 class="caption-title-2">POLO NECK SWEATER</h2>
                    <div class="ground-button">
                        <a href="#" class="leka-button">SHOP NOW</a>
                        <a href="#" class="leka-button button-style2">BUY THEME</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Group banner -->
    <div class="group-banner">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 col-md-4">
                    <div class="banner-text">
                        <a href="#">
                            <img src="{{asset('frontend/images/b/b1.jpg')}}" alt="Banner">
                            <span class="group-text">
								<span class="small-text text-uppercase">SALE UP TO</span>
								<span class="big-text text-uppercase">70%</span>
								<span class="small-text3 text-uppercase">Asymmetric ParkaJacket</span>
							</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="banner-text">
                        <a href="#">
                            <img src="{{asset('frontend/images/b/b2.jpg')}}" alt="Banner">
                            <span class="group-text">
								<span class="medium-text text-uppercase">SALE UP TO</span>
								<span class="big-text text-uppercase">60%<span class="light">OFF</span></span>
								<span class="small-text2 text-uppercase">CUTE COATS</span>
							</span>
                        </a>
                    </div>
                </div>
                <div class="col-sm-4 col-md-4">
                    <div class="banner-text">
                        <a href="#">
                            <img src="{{asset('frontend/images/b/b3.jpg')}}" alt="Banner">
                            <span class="group-text">
								<span class="small-text2 light">Blank NYC Leather Biker Jacket</span>
								<span class="medium-text text-uppercase black">NEW LOOK 2016</span>
							</span>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Group banner -->

    <!-- Tabs product -->
    @if(session()->has('success'))

    @endif
    <section class="section-tabslide">
        <div class="container">
            <div class="title-section text-center">
                <h2 class="title">Sản Phẩm Mới</h2>
            </div>
            <div class="tab-slide-category">
                <ul class="products-tab nav nav-tabs" role="tablist">
                    @foreach($cates as $c => $item)
                        @if($item->status ==1)
                            <li role="presentation"><a href="#tab-product-{{$loop->iteration}}" aria-controls="tab-product-{{$loop->iteration}}" role="tab" data-toggle="tab">{{$item->name}}</a></li>
                        @endif
                    @endforeach

                    {{--                    <li role="presentation"><a href="#tab-product-2" aria-controls="tab-product-2" role="tab" data-toggle="tab">MEN’S</a></li>--}}
                    {{--                    <li role="presentation"><a href="#tab-product-3" aria-controls="tab-product-3" role="tab" data-toggle="tab">BAG &amp; SHOES</a></li>--}}
                    {{--                    <li role="presentation"><a href="#tab-product-4" aria-controls="tab-product-4" role="tab" data-toggle="tab">ACCESSORIES</a></li>--}}
                    {{--                    <li role="presentation"><a href="#tab-product-5" aria-controls="tab-product-5" role="tab" data-toggle="tab">CROP TOP</a></li>--}}
                </ul>
                <div class="tab-content">
                    <div id="tab-product-1" role="tabpanel" class="tab-pane fade in active">
                        <div class="product-slide owl-carousel"  data-dots="false" data-nav = "true" data-margin = "30" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            @foreach($product1 as $p => $item)
                                @if($item->status == 1)
                                    <div class="product">
                                        <div  class="product-thumb">
                                            <a href="{{url('product/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank">
                                                <img src="{{$item->image}}" alt="">
                                            </a>
                                            <div class="product-button">
                                                <a href="#" class="button-compare">Compare</a>
                                                <a href="#" class="button-wishlist">Wishlist</a>
                                                <a href="#" class="button-quickview">Quick view</a>
                                            </div>
                                            @if($item->price_sale != 0)
                                                @php
                                                    $percent = ($item->price_sale / $item->price) * 100
                                                @endphp
                                                <span class="onsale">-{{round(100-$percent, 2)}}%</span>
                                            @else
                                                <span class="new">New</span>
                                            @endif
                                        </div>
                                        <div class="product-info">
                                            <h3><a href="{{url('product/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank">{{$item->name}}</a></h3>
                                            @if($item->price_sale != 0)
                                                <span class="product-price">
                                            <span class="product-price">{{number_format($item->price_sale)}}₫
                                                <del><span style="color: red" class="amount">{{number_format($item->price)}}₫</span></del>
                                            </span>
                                        </span>
                                            @else
                                                <span class="product-price">{{number_format($item->price, 0)}}₫</span>
                                            @endif

                                            <a href="javascript:;" onclick="openModal({{$item->id}})" class="button-add-to-cart">ADD TO CART</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="tab-product-2" role="tabpanel" class="tab-pane fade">
                        <div class="product-slide owl-carousel"  data-dots="false" data-nav = "true" data-margin = "30" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            @foreach($product2 as $p => $item)
                                @if($item->status == 1)
                                    <div class="product">
                                        <div  class="product-thumb">
                                            <a href="{{url('product/'.$item->slug.'/'.$item->id.'.html')}}">
                                                <img src="{{$item->image}}" alt="">
                                            </a>
                                            <div class="product-button">
                                                <a href="#" class="button-compare">Compare</a>
                                                <a href="#" class="button-wishlist">Wishlist</a>
                                                <a href="#" class="button-quickview">Quick view</a>
                                            </div>
                                            @if($item->price_sale != 0)
                                                @php
                                                    $percent = ($item->price_sale / $item->price) * 100
                                                @endphp
                                                <span class="onsale">-{{round(100-$percent, 2)}}%</span>
                                            @else
                                                <span class="new">New</span>
                                            @endif
                                        </div>
                                        <div class="product-info">
                                            <h3><a href="#">{{$item->name}}</a></h3>
                                            @if($item->price_sale != 0)
                                                <span class="product-price">
                                            <span class="product-price">{{number_format($item->price_sale)}}₫
                                                <del><span style="color: red" class="amount">{{number_format($item->price)}}₫</span></del>
                                            </span>
                                        </span>
                                            @else
                                                <span class="product-price">{{number_format($item->price, 0)}}₫</span>
                                            @endif

                                            <a href="javascript:;" onclick="openModal({{$item->id}})" class="button-add-to-cart">ADD TO CART</a>
                                        </div>
                                    </div>
                                @endif
                            @endforeach
                        </div>
                    </div>
                    <div id="tab-product-3" role="tabpanel" class="tab-pane fade">
                        <div class="product-slide owl-carousel"  data-dots="false" data-nav = "true" data-margin = "30" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-product-4" role="tabpanel" class="tab-pane fade">
                        <div class="product-slide owl-carousel"  data-dots="false" data-nav = "true" data-margin = "30" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id="tab-product-5" role="tabpanel" class="tab-pane fade">
                        <div class="product-slide owl-carousel"  data-dots="false" data-nav = "true" data-margin = "30" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                            <div class="product">
                                <div  class="product-thumb">
                                    <a href="single-product.html">
                                        <img src="{{asset('frontend/images/products/product3.png')}}" alt="">
                                    </a>
                                    <div class="product-button">
                                        <a href="#" class="button-compare">Compare</a>
                                        <a href="#" class="button-wishlist">Wishlist</a>
                                        <a href="#" class="button-quickview">Quick view</a>
                                    </div>
                                </div>
                                <div class="product-info">
                                    <h3><a href="#">Ledtead Predae</a></h3>
                                    <span class="product-price">$89.00</span>
                                    <a href="#" class="button-add-to-cart">ADD TO CART</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- ./ Tabs product -->
    <!-- parallax1 -->
    <section class="parallax1 bg-parallax">
        <div class="container">
            <h2 class="text-center">MILITARY STYLE COAT</h2>
        </div>
    </section>
    <!-- ./ parallax1 -->
    <!-- Group banner 2 -->
    <div class="group-banner2">
        <div class="container">
            <div class="row">
                <div class="col-sm-5">
                    <div class="banner-single-image">
                        <a href="#">
                            <img src="{{asset('frontend/images/b/b4.jpg')}}" alt="Banner">
                        </a>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="banner-single-image">
                        <a href="#">
                            <img src="{{asset('frontend/images/b/b5.jpg')}}" alt="Banner">
                        </a>
                    </div>
                    <div class="banner-single-image">
                        <a href="#">
                            <img src="{{asset('frontend/images/b/b6.jpg')}}" alt="Banner">
                        </a>
                    </div>
                </div>
                <div class="col-sm-3">
                    <div class="banner-single-image">
                        <a href="#">
                            <img src="{{asset('frontend/images/b/b7.jpg')}}" alt="Banner">
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Group banner 2 -->
    <!-- Block products -->
    <section class="block-buttom-products">
        <div class="container">
            <div class="row">
                <div class="col-sm-12 col-md-4">
                    <div class="block-products">
                        <div class="title-section text-left">
                            <h3 class="title">bán chạy</h3>
                        </div>
                        <ul class="prodcut-list">
                            @foreach($product_sold as $s => $item)
                                <li>
                                    <div class="product-img">
                                        <a href="{{url('product/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank"><img src="{{$item->image}}" alt=""></a>
                                    </div>
                                    <div class="product-info">
                                        <h6><a href="{{url('product/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank">{{$item->name}}</a></h6>
                                        @if($item->price_sale != 0)
                                            <span class="product-price">
                                            <span class="product-price">{{number_format($item->price_sale)}}₫
                                                <del><span style="color: red" class="amount">{{number_format($item->price)}}₫</span></del>
                                            </span>
                                        </span>
                                        @else
                                            <span class="product-price">{{number_format($item->price, 0)}}₫</span>
                                        @endif
                                        <div class="box-button">
                                            <a class="wishlist" href="javascript:;">Wishlist</a>
                                            <a class="compare" href="javascript:;">Compare</a>
                                            <a class="add-to-cart" href="javascript:;">Add Cart</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="block-products">
                        <div class="title-section text-left">
                            <h3 class="title">yêu thích</h3>
                        </div>
                        <ul class="prodcut-list">
                            @foreach($product_view as $s => $item)
                                <li>
                                    <div class="product-img">
                                        <a href="{{url('product/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank"><img src="{{$item->image}}" alt=""></a>
                                    </div>
                                    <div class="product-info">
                                        <h6><a href="{{url('product/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank">{{$item->name}}</a></h6>
                                        @if($item->price_sale != 0)
                                            <span class="product-price">
                                            <span class="product-price">{{number_format($item->price_sale)}}₫
                                                <del><span style="color: red" class="amount">{{number_format($item->price)}}₫</span></del>
                                            </span>
                                        </span>
                                        @else
                                            <span class="product-price">{{number_format($item->price, 0)}}₫</span>
                                        @endif
                                        <div class="box-button">
                                            <a class="wishlist" href="javascript:;">Wishlist</a>
                                            <a class="compare" href="javascript:;">Compare</a>
                                            <a class="add-to-cart" href="javascript:;">Add Cart</a>
                                        </div>
                                    </div>
                                </li>
                            @endforeach
                        </ul>
                    </div>
                </div>
                <div class="col-sm-12 col-md-4">
                    <div class="block-products">
                        <div class="title-section text-left">
                            <h3 class="title">Nổi bật</h3>
                        </div>
                        <ul class="prodcut-list">
                            @foreach($product_random as $s => $item)

                                <li>
                                    <div class="product-img">
                                        <a href="{{url('product/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank"><img src="{{$item->image}}" alt=""></a>
                                    </div>
                                    <div class="product-info">
                                        <h6><a href="{{url('product/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank">{{$item->name}}</a></h6>
                                        @if($item->price_sale != 0)
                                            <span class="product-price">
                                                <span class="product-price">{{number_format($item->price_sale)}}₫
                                                    <del><span style="color: red" class="amount">{{number_format($item->price)}}₫</span></del>
                                                </span>
                                            </span>
                                        @else
                                            <span class="product-price">{{number_format($item->price, 0)}}₫</span>
                                        @endif
                                        <div class="box-button">
                                            <a class="wishlist" href="javascript:;">Wishlist</a>
                                            <a class="compare" href="javascript:;">Compare</a>
                                            <a class="add-to-cart" href="javascript:;">Add Cart</a>
                                        </div>
                                    </div>
                                </li>

                            @endforeach
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./Block products -->
    <!-- parallax1 -->
    <section class="parallax2 bg-parallax">
        <div class="container">
            <h2 class="text-center">MILITARY STYLE COAT</h2>
        </div>
    </section>
    <!-- ./ parallax1 -->
    <!-- Our services -->
    <section class="section-services">
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="service">
                        <div class="service-title">
                            <span class="service-icon"><i class="fa fa-plane"></i></span>
                            <h4>FREESHIPPING</h4>
                            <p class="service-desc">We Are Free Shipping World Wide</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="service">
                        <div class="service-title">
                            <span class="service-icon"><i class="fa fa-whatsapp"></i></span>
                            <h4>best support</h4>
                            <p class="service-desc">We provide best services & support</p>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="service">
                        <div class="service-title">
                            <span class="service-icon"><i class="fa fa-gift"></i></span>
                            <h4>GIFT DISCOUNT</h4>
                            <p class="service-desc">Flats , Coupon, sale off</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./Our services -->

    <!-- TESTIMONIAL -->
    <section class="section-testimonial">
        <div class="container">
            <div class="title-section text-center">
                <h2 class="title">TESTIMONIAL</h2>
            </div>
            <div class="row">
                <div class="col-sm-6">
                    <div class="testimonial">
                        <div class="client-avatar">
                            <img src="{{asset('frontend/images/testimonials/3.jpg')}}" alt="">
                        </div>
                        <div class="info-testimonial">
                            <div class="client-quote">
                                <p>“New Creative Cloud Libraries makes your favorite assets — images, colors, type styles, brushes, and more — available to you and your creative team anywhere, anytime”</p>
                            </div>
                            <div class="client-info">
                                <span class="client-name">JOHN SNOW</span>
                                <span class="client-position">FOUNDER/ CEO APPLE</span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="testimonial">
                        <div class="client-avatar">
                            <img src="{{asset('frontend/images/testimonials/3.jpg')}}" alt="">
                        </div>
                        <div class="info-testimonial">
                            <div class="client-quote">
                                <p>“There are many variations of passages of Lorem Ipsum available, but the majority have suffered”</p>
                            </div>
                            <div class="client-info">
                                <span class="client-name">CHUN LEE</span>
                                <span class="client-position">FASHION DESIGN ZARA</span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="testimonial">
                        <div class="client-avatar">
                            <img src="{{asset('frontend/images/testimonials/3.jpg')}}" alt="">
                        </div>
                        <div class="info-testimonial">
                            <div class="client-quote">
                                <p>“Neque porro quisquam est, qui dolorem ipsum quia dolor sit amet, consectetur, adipisci velit...”</p>
                            </div>
                            <div class="client-info">
                                <span class="client-name">MARIA CATARINA</span>
                                <span class="client-position">CEO MICROSOFT</span>
                            </div>

                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="testimonial">
                        <div class="client-avatar">
                            <img src="{{asset('frontend/images/testimonials/3.jpg')}}" alt="">
                        </div>
                        <div class="info-testimonial">
                            <div class="client-quote">
                                <p>“Nemo enim ipsam voluptatem quia voluptas sit aspernatur aut odit aut fugit, sed quia consequuntur magni dolores eos qui ratione”</p>
                            </div>
                            <div class="client-info">
                                <span class="client-name">WHITE SHADOW</span>
                                <span class="client-position">CEO NIGHT WATCH</span>
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- ./TESTIMONIAL -->

    <!-- Blog -->
    <section class="section-fashion-blog">
        <div class="container">
            <div class="title-section text-center">
                <h2 class="title">TIN TỨC THỜI TRANG</h2>
            </div>
            <div class="blog-style2 owl-carousel owl-dots-style1" data-responsive='{"0":{"items":1},"767":{"items":1},"1000":{"items":2}}' data-auto="true" data-loop="true" data-items="2" data-margin="30">
                @foreach($news as $n => $item)
                <article class="post-item">
                    <div class="post-thumb">
                        <a href="{{url('news/'.$item->slug.'/'.$item->id.'.html')}}"><img src="{{$item->image}}" target="_blank" alt=""></a>
                        <span class="post-date">
{{--							<span class="month-day">Sep 07</span>--}}
							<span class="year">{{date("d/m/Y", strtotime($item->created_at))}}</span>
						</span>
                    </div>
                    <div class="post-info">
                        <h5><a href="{{url('news/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank">{{$item->title}}</a></h5>
                        <div class="post-excerpt">
                            <p>{!! substr($item->shorts, 0, 130) !!}...</p>
                        </div>
                        <div class="post-meta">
{{--                            <span class="comment-count"><i class="fa fa-comments-o"></i> 68</span>--}}
                            <span class="like"><i class="fa fa-heart-o"></i> {{$item->like}}</span>
                        </div>
                    </div>
                </article>
                @endforeach
            </div>
        </div>
    </section>
    <!-- ./Blog -->

    <!-- Shop band -->
    <div class="section-shopbrand bg-parallax">
        <div class="overlay"></div>
        <div class="container">
            <div class="row">
                <div class="col-sm-4">
                    <div class="title-section text-left">
                        <h2 class="title">SHOP BRANDS</h2>
                    </div>
                    <p>Contrary to popular belief, Lorem Ipsum is not simply random text. It has roots in a piece of classical Latin literature from 45 BC, making it over 2000 years old.
                        Richard McClintock, a Latin professor at Hampden-Sydney College in Virginia,</p>
                </div>
                <div class="col-sm-8">
                    <div class="list-brand owl-carousel" data-nav="true" data-dots="false" data-margin="130" data-responsive='{"0":{"items":3,"margin":20},"600":{"items":3,"margin":50},"1000":{"items":4}}'>
                        <div class="item-brand">
                            <a href="#">
                                <div class="logo-brand"><img src="{{asset('frontend/images/brand-1.png')}}" alt=""></div>
                                <div class="logo-brand-color"><img src="{{asset('frontend/images/brand-1-color.png')}}" alt=""></div>
                            </a>
                        </div>
                        <div class="item-brand">
                            <a href="#">
                                <div class="logo-brand"><img src="{{asset('frontend/images/brand-2.png')}}" alt=""></div>
                                <div class="logo-brand-color"><img src="{{asset('frontend/images/brand-2-color.png')}}" alt=""></div>
                            </a>
                        </div>
                        <div class="item-brand">
                            <a href="#">
                                <div class="logo-brand"><img src="{{asset('frontend/images/brand-3.png')}}" alt=""></div>
                                <div class="logo-brand-color"><img src="{{asset('frontend/images/brand-3-color.png')}}" alt=""></div>
                            </a>
                        </div>
                        <div class="item-brand">
                            <a href="#">
                                <div class="logo-brand"><img src="{{asset('frontend/images/brand-4.png')}}" alt=""></div>
                                <div class="logo-brand-color"><img src="{{asset('frontend/images/brand-4-color.png')}}" alt=""></div>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ./Shop band -->
@endsection



@section('page.script')
    <script>
        function openModal(id){
            $_token = "{{ csrf_token() }}";
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url:`{{url('open/modal')}}`,
                type: 'get',
                cache: false,
                data: { '_token': $_token, 'id':id}, //see the $_token
                success: function(response) {

                    var element = JSON.parse(response);
                    console.log(element);
                    const product = element['product'];
                    let ele_id = product['id'];
                    let slug = product['slug'];

                    var result ='';
                    result += '<div class="popup-add-to-cart">';
                    result +='       <div class="message">';
                    result +='          <i class="fa fa-check-circle-o"></i>';
                    result +='      </div>';
                    result +='      <div class="popup-product">';
                    result +=`          <a href="{{url('/product/${slug}/${ele_id}.html')}}"><img src="${product['image']}" width="200px" alt="" /></a>`;
                    result +=`          <h3 class="product-name"><a href="{{url('/product/${slug}/${ele_id}.html')}}">${product['name']}</a></h3>`;

                    result +=`${product['price_sale']  != 0? `
                        <span class="product-price">
                                            <span class="product-price">${product['price_sale'].toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    })}
                                                <del><span style="color: red" class="amount">${product['price'].toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    })}</span></del>
                                            </span>
                        </span>

                    ` : `  <span class="product-price">${product['price'].toLocaleString('vi-VN', {
                        style: 'currency',
                        currency: 'VND'
                    })}</span>`}`;
                    result +='          <a href="cart.html" class="button button-view-cart">SẢN PHẨM YÊU THÍCH</a>';
                    result +='         @if(session()->has('auth') == true) <a href="" class="button button-continue-shop">GIỎ HÀNG</a> @endif';
                    result +='      </div>';
                    result +='</div>';
                    $.magnificPopup.open({
                        items: {
                            src: result, // can be a HTML string, jQuery object, or CSS selector
                            type: 'inline'
                        }
                    });
                    return false;

                }
            });
        }
        // $(document).on('click','.button-add-to-cart',function(){
        //
        // });
    </script>

@endsection
