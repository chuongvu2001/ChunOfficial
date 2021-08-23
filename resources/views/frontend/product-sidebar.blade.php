@extends('frontend.layout.main')
@section('title','Chun.Official - '.$cate_name)
@section('content')
    <section class="banner bg-parallax">
        <div class="overlay"></div>
        <div class="container">
            <div class="banner-content text-center">
                <h2 class="page-title">SHOP LEFT SIDEBAR</h2>
                <div class="breadcrumbs">
                    <a href="#">Home</a>
                    <a href="#">Shop</a>
                    <span>SHOP LEFT SIDEBAR</span>
                </div>
            </div>
        </div>
    </section>
    <div class="maincontainer left-sidebar">
        <div class="container">
            <div class="row">
                <div class="col-sm-8 col-md-9 main-content">
                    <!-- Sortbar -->
                    <div class="sortBar">
                        <div class="sortBar-left">
                            <form class="ordering">
                                <select id="order_by" onchange="Options1()">
                                    @foreach(config('common.product_order_by') as $k => $item)
                                        <option value="{{$k}}">{{$item}}</option>
                                    @endforeach
                                </select>
                                <select id="order_new" onchange="Options2()">
                                    @foreach(config('common.product_order_new') as $k => $item)
                                        <option value="{{$k}}">{{$item}}</option>
                                    @endforeach
                                </select>
                            </form>
                            <div class="display-product-option">
                                <a href="#" class="view-as-grid selected"><i class="fa fa-th-large"></i></a>
                                <a href="#" class="view-as-list"><i class="fa fa-th-list"></i></a>
                            </div>
                        </div>
                        <div class="sortBar-right">
{{--                            <div class="result-count">--}}
{{--                                SHOW ITEMS 1 to 12 of 36 total--}}
{{--                            </div>--}}
                        </div>
                    </div>
                    <!-- ./ SortBar -->
                    <!-- List products -->
                    @isset($products)
                    <ul class="products row order-by">

                        @foreach($products as $p => $item)
                        <li class="product col-sm-6 col-md-4 ">
                            @if($item->status == 1)
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
                            @endif
                        </li>
                        @endforeach
                    </ul>
                    <nav class="pagination">
                        <ul>
                            {{$products->links()}}
{{--                            <li class="active"><a href="">1</a></li>--}}
{{--                            <li><a href="">2</a></li>--}}
{{--                            <li><a href="#">3</a></li>--}}
{{--                            <li><a href="#">4</a></li>--}}
{{--                            <li><a href="#">5</a></li>--}}
{{--                            <li><a href="#">NEXT</a></li>--}}
                        </ul>
                    </nav>
                    @endisset

                    @isset($products_cate)
                        <ul class="products row order-by">
                            @foreach($products_cate as $p => $item)
                                <li class="product col-sm-6 col-md-4 ">
                                    @if($item->status == 1)
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
                                    @endif
                                </li>
                            @endforeach
                        </ul>
                        <nav class="pagination">
                            <ul>
                                {{$products_cate->links()}}
                                {{--                            <li class="active"><a href="">1</a></li>--}}
                                {{--                            <li><a href="">2</a></li>--}}
                                {{--                            <li><a href="#">3</a></li>--}}
                                {{--                            <li><a href="#">4</a></li>--}}
                                {{--                            <li><a href="#">5</a></li>--}}
                                {{--                            <li><a href="#">NEXT</a></li>--}}
                            </ul>
                        </nav>
                    @endisset
                    <!-- ./ List Products -->
                </div>
                <!-- Sliderbar -->
                <div class="col-sm-4 col-md-3 sidebar">
                    <!-- Filter price -->
                    <div class="widget widget_price_filter">
                        <h2 class="widget-title">Lọc theo giá</h2>
                        <div class="price_slider_wrapper">
                            <div class="amount-range-price"> {{number_format((float)250, 3, '.', '.')}}₫ - {{number_format((float)1000, 3, '.', '.')}}₫</div>
                            <div data-label-reasult="" data-min="0" data-max="2000000"  class="slider-range-price" data-value-min="250000" data-value-max="1000000" data-unit="VND"></div>
                            <button class="button" onclick="RangePrice()">TÌM KIẾM</button>
                        </div>
                    </div>
                    <!-- ./Filter price -->
                    <!-- Product category -->
                    <div class="widget widget_product_categories">
                        <h2 class="widget-title">lọc theo Danh mục</h2>
                        <ul class="product-categories">
                            @foreach($cates as $c => $item)
                                @if($item->status == 1)
                                    <li class="cat-parent current-cat-parent">
                                        <a href="{{url($item->slug.'/'.$item->id.'.html')}}" target="_blank">{{$item->name}}</a>
                                        @if(count($item->child) > 0)
                                        <ul class="children">
                                            @foreach($item->child as $ch => $item)
                                                <li class="current-cat"><a href="{{url($item->slug.'/'.$item->id.'.html')}}" target="_blank">{{$item->name}}</a></li>
                                            @endforeach
                                        </ul>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <!-- ./Product category -->
                    <!-- Filter color -->
                    <div class="widget widget_layered_nav">
                        <h2 class="widget-title">Lọc theo Màu sắc</h2>
                        <ul>

                            @foreach($color as $c => $item)
                                @php
                                    $slug_color = Str::slug($item->color,'-');
                                @endphp
                                <li><a href="javascript:;" onclick="ColorFilter('{{$item->color}}')">{{$item->color}}</a></li>
                            @endforeach
                        </ul>
                    </div>
                    <!-- ./Filter color -->

                    <!-- Product tags -->
                    <div class="widget widget_product_tag_cloud">
                        <h2 class="widget-title">Tags</h2>
                        <div class="tagcloud">

                            @foreach($products_tag as $t=>$item)
                                <a href="javascript:;" onclick="brand('{{$item->brand}}')">{{$item->brand}}</a>
                            @endforeach
                        </div>
                    </div>
                    <!-- ./Product tags -->
                    <!-- Product tags -->
                    <div class="widget widget_custom_image">
                        <a href="#"><img src="{{asset('frontend/images/b/b9.jpg')}}" alt="" /></a>
                    </div>
                    <!-- ./Product tags -->
                </div>
                <!-- ./Sileka-popupdebar -->
            </div>


        </div>
    </div>
@endsection

@section('page-script')

    <script>
        @for($i = 1; $i<3;$i++)
        function Options{{$i}}(){
            $_token = "{{ csrf_token() }}";
            const order_by = $('#order_by').val();
            const order_new = $('#order_new').val();
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url:`{{url('order/by')}}`,
                type: 'get',
                cache: false,
                data: { '_token': $_token, 'order_by':order_by, 'order_new':order_new }, //see the $_token
                success: function(response) {
                    var element = JSON.parse(response);
                    // console.log(element);
                    $('.order-by').empty();
                    element.forEach(ele => {
                        if(ele['status'] == 1){
                            if((ele['price_sale'])){
                                const percent =ele['price_sale']/ele['price'] * 100;
                            }
                            const slug = ele['slug'];
                            const id = ele['id'];
                            $('.order-by').append(`
                                                    <li class="product col-sm-6 col-md-4 ">
                                                            <div  class="product-thumb">
                                                                <a href="{{url('product/${slug}/${id}.html')}}">
                                                            <img src="${ele['image']}" alt="">
                                                         </a>
                                                    <div class="product-button">
                                                        <a href="javascript:;" class="button-compare">Compare</a>
                                                        <a href="javascript:;" class="button-wishlist">Wishlist</a>
                                                        <a href="javascript:;" class="button-quickview">Quick view</a>
                                                    </div>

                                                            <div class="product-info">
                                                                <h3><a href="{{url('product/${slug}/${id}.html')}}">${ele['name']}</a></h3>

                                                   ${ele['price_sale'] ? `<span class="product-price">
                                                                <span class="product-price">${ele['price_sale'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}
                                                                    <del><span style="color: red" class="amount">${ele['price'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}</span></del>
                                                                </span>
                                                            </span>` : ` <span class="product-price">${ele['price'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}</span>
                                                `}
                                                            <a href="javascript:;" onclick="openModal(${id})" class="button-add-to-cart">ADD TO CART</a>
                                                    </div>

                                                            </li>
`)
                        }
                    })
                }
            });
        }
        @endfor
    </script>


    <script>
        function RangePrice(){
            $_token = "{{ csrf_token() }}";
            const value = $('.amount-range-price').text();
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url:`{{url('range/price')}}`,
                type: 'get',
                cache: false,
                data: { '_token': $_token, 'value':value }, //see the $_token
                success: function(response) {
                    var element = JSON.parse(response);
                    $('.order-by').empty();
                    element.forEach(ele => {
                        if(ele['status'] == 1){
                            if((ele['price_sale'])){
                                const percent =ele['price_sale']/ele['price'] * 100;
                            }
                            const slug = ele['slug'];
                            const id = ele['id'];
                            $('.order-by').append(`
                                                    <li class="product col-sm-6 col-md-4 ">
                                                            <div  class="product-thumb">
                                                                <a href="{{url('product/${slug}/${id}.html')}}">
                                                            <img src="${ele['image']}" alt="">
                                                         </a>
                                                    <div class="product-button">
                                                        <a href="javascript:;" class="button-compare">Compare</a>
                                                        <a href="javascript:;" class="button-wishlist">Wishlist</a>
                                                        <a href="javascript:;" class="button-quickview">Quick view</a>
                                                    </div>

                                                            <div class="product-info">
                                                                <h3><a href="{{url('product/${slug}/${id}.html')}}">${ele['name']}</a></h3>

                                                   ${ele['price_sale'] ? `<span class="product-price">
                                                                <span class="product-price">${ele['price_sale'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}
                                                                    <del><span style="color: red" class="amount">${ele['price'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}</span></del>
                                                                </span>
                                                            </span>` : ` <span class="product-price">${ele['price'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}</span>
                                                `}
                                                            <a href="javascript:;" onclick="openModal(${id})" class="button-add-to-cart">ADD TO CART</a>
                                                    </div>

                                                            </li>
`)
                        }
                    })
                }
            });
        }
    </script>

    <script>
        function ColorFilter(color){
            $_token = "{{ csrf_token() }}";
            const value = $('.amount-range-price').text();
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url:`{{url('color/filter')}}`,
                type: 'get',
                cache: false,
                data: { '_token': $_token, 'color':color }, //see the $_token
                success: function(response) {
                    var element = JSON.parse(response);
                    $('.order-by').empty();
                    element.forEach(ele => {
                        console.log(ele['products']['name']);
                        if(ele['products']['status'] == 1){
                            if((ele['products']['price_sale'])){
                                const percent =ele['products']['price_sale']/ele['products']['price'] * 100;
                            }
                            const slug = ele['products']['slug'];
                            const id = ele['products']['id'];
                            $('.order-by').append(`
                                                <li class="product col-sm-6 col-md-4 ">
                                                        <div  class="product-thumb">
                                                            <a href="{{url('product/${slug}/${id}.html')}}">
                                                        <img src="${ele['products']['image']}" alt="">
                                                     </a>
                                                <div class="product-button">
                                                    <a href="javascript:;" class="button-compare">Compare</a>
                                                    <a href="javascript:;" class="button-wishlist">Wishlist</a>
                                                    <a href="javascript:;" class="button-quickview">Quick view</a>
                                                </div>

                                                        <div class="product-info">
                                                            <h3><a href="{{url('product/${slug}/${id}.html')}}">${ele['products']['name']}</a></h3>

                                               ${ele['products']['price_sale'] ? `<span class="product-price">
                                                            <span class="product-price">${ele['products']['price_sale'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}
                                                                <del><span style="color: red" class="amount">${ele['products']['price'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}</span></del>
                                                            </span>
                                                        </span>` : ` <span class="product-price">${ele['products']['price'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}</span>
                                            `}
                                                        <a href="javascript:;" onclick="openModal(${id})" class="button-add-to-cart">ADD TO CART</a>
                                                </div>

                                                        </li>
`)
                        }

                    })
                }
            });
        }
    </script>

    <script>
        function brand(brand){
            $_token = "{{ csrf_token() }}";
            $.ajax({
                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                url:`{{url('brand/filter')}}`,
                type: 'get',
                cache: false,
                data: { '_token': $_token, 'brand':brand }, //see the $_token
                success: function(response) {
                    var element = JSON.parse(response);
                    $('.order-by').empty();
                    element.forEach(ele => {
                        if(ele['status'] == 1){
                            if((ele['price_sale'])){
                                const percent =ele['price_sale']/ele['price'] * 100;
                            }
                            const slug = ele['slug'];
                            const id = ele['id'];
                            $('.order-by').append(`
                                                    <li class="product col-sm-6 col-md-4 ">
                                                            <div  class="product-thumb">
                                                                <a href="{{url('product/${slug}/${id}.html')}}">
                                                            <img src="${ele['image']}" alt="">
                                                         </a>
                                                    <div class="product-button">
                                                        <a href="javascript:;" class="button-compare">Compare</a>
                                                        <a href="javascript:;" class="button-wishlist">Wishlist</a>
                                                        <a href="javascript:;" class="button-quickview">Quick view</a>
                                                    </div>

                                                            <div class="product-info">
                                                                <h3><a href="{{url('product/${slug}/${id}.html')}}">${ele['name']}</a></h3>

                                                   ${ele['price_sale'] ? `<span class="product-price">
                                                                <span class="product-price">${ele['price_sale'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}
                                                                    <del><span style="color: red" class="amount">${ele['price'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}</span></del>
                                                                </span>
                                                            </span>` : ` <span class="product-price">${ele['price'].toLocaleString('vi-VN', {
                                style: 'currency',
                                currency: 'VND'
                            })}</span>
                                                `}
                                                            <a href="javascript:;" onclick="openModal(${id})" class="button-add-to-cart">ADD TO CART</a>
                                                    </div>
                                                            </li>
`)
                        }
                    })
                }
            });
        }
    </script>
@endsection
