@extends('frontend.layout.main')
@section('title','Chun.Official - '.$product->name)
@section('content')
    <section class="banner bg-parallax">
        <div class="overlay"></div>
        <div class="container">
            <div class="banner-content text-center">
                <h2 class="page-title">SHOP DETAIL</h2>
                <div class="breadcrumbs">
                    <a href="#">Home</a>
                    <a href="#">Shop</a>
                    <a href="#">SHOP DETAIL</a>
                    <span>LONG Tube Dress</span>
                </div>
            </div>
        </div>
    </section>
    <div class="maincontainer">
        <div class="container">
            <div class="row">
                <div class="col-sm-6">
                    <div class="single-images">
                        <a class="popup-image" href="{{$product->image}}"><img class="main-image" src="{{$product->image}}"  alt=""/></a>
                        <div class="single-product-thumbnails">
                            <span data-image_full="{{$product->thumbnail1}}"><img src="{{$product->thumbnail1}}" style="width: 80px" /></span>
                            <span data-image_full="{{$product->thumbnail2}}"><img src="{{$product->thumbnail2}}" style="width: 80px"/></span>
                            <span  class="selected" data-image_full="{{$product->thumbnail3}}"><img src="{{$product->thumbnail3}}" style="width: 80px" /></span>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="summary entry-summary">
                        <h1 class="product_title entry-title">{{$product->name}}</h1>
                        <div class="product-star edo-star" title="Rated 1 out of 5">
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            <i class="fa fa-star"></i>
                            {{--                        <i class="fa fa-star-o"></i>--}}
                        </div>
                        {{--                    <a href="#reviews" class="woocommerce-review-link review-link">1 Review(s)  |  Add Your Review</a>--}}
                        {{--                    <span class="in-stock"><i class="fa fa-check-circle-o"></i> In stock</span>--}}
                        <div class="description">
                            <p>{!! $product->shorts !!}</p>
                        </div>

                        <p class="price">
                            @if($product->price_sale != 0)
                                <ins><span class="amount">{{number_format($product->price_sale)}}₫</span></ins>
                                <del><span class="amount">{{number_format($product->price)}}₫</span></del>
                            @else
                                <ins><span class="amount">{{number_format($product->price)}}₫</span></ins>
                            @endif
                        </p>

                        <form class="variations_form" method="POST" action="javascript:;" onsubmit="addtoCart({{$product->id}})">
                            @csrf
                            <table class="variations">
                                <tbody>
                                <tr>
                                    <td class="label"><label for="pa_color">Color</label></td>
                                    <td class="value">
                                        @php
                                            $value = array();
                                            $count = 0;
                                                foreach ($product_option as $o => $item){
                                                    $arr=(array)$item;
                                                    $value[$count++] = $arr;
                                                }
                                                $ids = array_column($value, 'color_name');
                                                $ids = array_unique($ids);
                                                $array = array_filter($value, function ($key, $value) use ($ids) {
                                                    return in_array($value, array_keys($ids));
                                                }, ARRAY_FILTER_USE_BOTH);

                                                $ids_size = array_column($value, 'size_name');
                                                $ids_size = array_unique($ids_size);
                                                $array_size = array_filter($value, function ($key, $value) use ($ids_size) {
                                                    return in_array($value, array_keys($ids_size));
                                                }, ARRAY_FILTER_USE_BOTH);
                                        @endphp
                                        <script>
                                            const value_color = [];
                                            const value_size = [];
                                            const new_arr = [];
                                            const color_new =[];
                                            const count =0;
                                            @for($i = 1; $i<3; $i++)
                                            function Options{{$i}}(action,slug){
                                                if(slug == 'color'){
                                                    const value_option = action.value;
                                                    value_color.pop();
                                                    value_color.unshift({"color":value_option});
                                                }
                                                else{
                                                    const value_option = action.value;
                                                    value_size.pop();
                                                    value_size.unshift({"size":value_option});
                                                }
                                                const data = [...new Set([...value_color ,...value_size])];
                                                // const new_data = data.toString();
                                                $_token = "{{ csrf_token() }}";
                                                $.ajax({
                                                    headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                                                    url:`{{url('options')}}`,
                                                    type: 'GET',
                                                    cache: false,
                                                    data: { '_token': $_token, 'pro_id':{{$product->id}},'data':data }, //see the $_token
                                                    success: function(response) {
                                                        var element = JSON.parse(response);
                                                        console.log(element);
                                                        // console.log(response);
                                                        $('.options-new').empty();
                                                        if(element['title'] ==true){
                                                            $('.options-new').append(`
                                                           <span style="color:#B40431"><i class="fa fa-check-circle-o"></i> Hết hàng</span>
                                                        `);
                                                            $('.single_add_to_cart_button').attr("disabled");
                                                        }
                                                        else{
                                                            if(element['amount']>0){
                                                                $('.single_add_to_cart_button').removeAttr("disabled");
                                                            }
                                                            else{
                                                                $('.single_add_to_cart_button').attr("disabled");
                                                            }
                                                            $('.options-new').append(`
                                                            ${element['amount'] > 0 ? `<span style="color:#04B431"><i class="fa fa-check-circle-o"></i> Còn hàng</span>`:`<span style="color:#B40431"><i class="fa fa-check-circle-o"></i> Hết hàng</span>`}
                                                        `);
                                                        }
                                                    }
                                                });
                                            }
                                            @endfor
                                        </script>
                                        <select id="pa_color" onchange="Options1(this,'color')"  name="attribute_pa_color">
                                            <option value="">Choose an option</option>
                                            @foreach($array as $o => $item)
                                                @php
                                                    $object = (object)$item;
                                                @endphp
                                                <option value="{{$object->color_name}}" class="attached color_name enabled">{{$object->color_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                <tr>
                                    <td class="label"><label for="pa_size">Size</label></td>
                                    <td class="value">
                                        <select id="pa_size" onchange="Options2(this,'size')"  name="attribute_pa_size">
                                            <option value="0">Choose an option</option>
                                            @foreach($array_size as $o => $item)
                                                @php
                                                    $object_size = (object)$item;
                                                @endphp
                                                <option value="{{$object_size->size_name}}" class="attached enabled">{{$object_size->size_name}}</option>
                                            @endforeach
                                        </select>
                                    </td>
                                </tr>

                                </tbody>
                            </table>
                            <div class="options-new"></div>
                            <div class="single_variation_wrap">

                                <div class="box-qty">
                                    <a href="javascript:;" onclick="upqty()" class="quantity-plus"><i class="fa fa-angle-up"></i></a>
                                    <input type="text" class="input-text qty text" disabled id="qty" name="amount" value="1"  size="4">
                                    {{--                                    <input  class="input-text qty text" type="number" min="1" max="" id="amount" name="amount">--}}
                                    <a href="javascript:;" onclick="downqty()"  class="quantity-minus"><i class="fa fa-angle-down"></i></a>
                                </div>
                                @if(session()->has('auth') == true)
                                    <button type="submit"  class="single_add_to_cart_button" disabled>Add to cart</button>
                                @else
                                    <a href="{{url('login/member')}}" class="single_add_to_cart_button disabled">Add to cart</a>
                                @endif
                                <a href="#" class="buttom-compare"><i class="fa fa-retweet"></i></a>
                                <a href="#" class="buttom-wishlist"><i class="fa fa-heart-o"></i></a>
                            </div>
                        </form>
                        <div class="sigle-product-services">
                            <div class="services-item">
                                <div class="icon"><i class="fa fa-plane"></i></div>
                                <h5 class="service-name">FREE SHIPPING WORLD WIDE</h5>
                            </div>
                            <div class="services-item">
                                <div class="icon"><i class="fa fa-whatsapp"></i></div>
                                <h5 class="service-name">24/24 ONLINE SUPPORT CUSTOME</h5>
                            </div>
                            <div class="services-item">
                                <div class="icon"><i class="fa fa-usd"></i></div>
                                <h5 class="service-name">30 Days money back</h5>
                            </div>
                        </div>
                        <div class="product-share">
                            <strong>Share:</strong>
                            <a href="#"><i class="fa fa-facebook"></i></a>
                            <a href="#"><i class="fa fa-twitter"></i></a>
                            <a href="#"><i class="fa fa-tencent-weibo"></i></a>
                            <a href="#"><i class="fa fa-vk"></i></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Product tab -->
            <div class="product-tabs">
                <ul class="nav-tab">
                    <li class="active"><a data-toggle="tab" href="#tab1">Mô tả</a></li>
                    <li><a  data-toggle="tab" href="#tab2">Đánh giá</a></li>
                    <li><a data-toggle="tab" href="#tab3">Product tags</a></li>
                </ul>
                <div class="tab-content">
                    <div id="tab1" class="active tab-pane">
                        <p>
                            {!! $product->description !!}
                        </p>
                    </div>
                    <div id="tab2" class="tab-pane">
                        <div class="reviews">
                            <div class="comments">
                                <h2>Phản hồi của khách hàng ({{count($stars)}})</h2>
                                <ol class="commentlist">
                                    @foreach($stars as $s => $item)
                                        <li class="comment">
                                            <div class="comment_container">
                                                <img class="avatar" src="{{$item->user->image}}" alt="" />
                                                <div class="comment-text">
                                                    <div itemprop="description" class="description">
                                                        <p>{{$item->comment}}</p>
                                                    </div>
                                                    <p class="meta">
                                                        <strong itemprop="author">{{$item->user->role == 100 ? 'Quản trị viên' : 'Thành viên'}}</strong> – <time itemprop="datePublished" datetime="{{date('d-m-Y', strtotime($item->created_at))}}">{{date('d-m-Y', strtotime($item->created_at))}}</time>
                                                    </p>
                                                    <div class="product-star edo-star" title="Rated 1 out of 5">
                                                        <i class="fa fa-star"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                        <i class="fa fa-star-o"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </li>
                                    @endforeach
                                </ol>
                            </div>
                        </div>
                        <!-- Review form -->
                        <div class="review_form_wrapper" class="review_form_wrapper">
                            <div class="review_form">
                                <div class="comment-respond">
                                    <h3 class="comment-reply-title">WRITE YOUR OWN REVIEW</h3>
                                    <div class="rating">
                                        <div class="attribute">
                                            <span class="title">Quality</span>
                                            <span class="star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                        </div>
                                        <div class="attribute">
                                            <span class="title">PRICE</span>
                                            <span class="star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                        </div>
                                        <div class="attribute">
                                            <span class="title">VALUE</span>
                                            <span class="star">
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                                <i class="fa fa-star"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <form action="#" method="post"class="comment-form">
                                        <p class="comment-form-author">
                                            <label for="author">Name <span class="required">*</span></label>
                                            <input id="author" name="author" type="text" value="" size="30" placeholder="Name">
                                        </p>
                                        <p class="comment-form-email">
                                            <label for="email">Email <span class="required">*</span></label>
                                            <input id="email" name="email" type="text" value="" size="30" placeholder="Email">
                                        </p>
                                        <p class="comment-form-comment">
                                            <label for="comment">Your Review</label>
                                            <textarea id="comment" name="comment" cols="45" rows="8" placeholder="Your Review"></textarea>
                                        </p>
                                        <p class="form-submit">
                                            <input name="submit" type="submit" id="submit" class="submit" value="Submit">
                                        </p>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <!--./review form -->
                    </div>
                    <div id="tab3" class="tab-pane">
                        <div class="tagcloud">
                            <a href="#">Cotton</a>
                            <a href="#">Leggings</a>
                            <a href="#">Men</a>
                            <a href="#">Shirt</a>
                            <a href="#">T-shirt</a>
                            <a href="#">COSMETIC</a>
                            <a href="#">SOFT WEAR</a>
                            <a href="#">ACCESSORIES</a>
                            <a href="#">LIFE STYLE</a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- ./ Product tab -->
            <!--related products-->
            <div class="related-products">
                <div class="title-section text-center">
                    <h2 class="title">RELATED PRODUCTS</h2>
                </div>
                <div class="product-slide owl-carousel"  data-dots="false" data-nav = "true" data-margin = "30" data-responsive='{"0":{"items":1},"600":{"items":3},"1000":{"items":4}}'>
                    <div class="product">
                        <div  class="product-thumb">
                            <a href="single-product.html">
                                <img src="images/products/product8.png" alt="">
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
                                <img src="images/products/product7.png" alt="">
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
                                <img src="images/products/product6.png" alt="">
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
                                <img src="images/products/product5.png" alt="">
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
                                <img src="images/products/product4.png" alt="">
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
                                <img src="images/products/product3.png" alt="">
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
            <!--./related products-->
        </div>
    </div>
@endsection
@section('page-script')

<script>
    /*
    * Addtocart
    * */
    function addtoCart(id){
        $_token = "{{ csrf_token() }}";
        const amount = $('#qty').val();
        const color = $('#pa_color').val();
        const size = $('#pa_size').val();
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url:`{{url('add/to/cart')}}`,
            type: 'get',
            cache: false,
            data: { '_token': $_token, 'id':id,'color':color,'size':size,'amount':amount }, //see the $_token
            success: function(response) {
                var element = JSON.parse(response);
                toastr.success(element.success);

                // console.log(response);
            }
        });
    }

    /*
    * Quantity
    * */
    function upqty(){
        $_token = "{{ csrf_token() }}";
        const qty = $('#qty').val();
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url:`{{url('up/qty')}}`,
            type: 'get',
            cache: false,
            data: { '_token': $_token, 'qty':qty }, //see the $_token
            success: function(response) {
                var element = JSON.parse(response);
                $('#qty').val(element);
            }
        });
    }
    function downqty(){
        $_token = "{{ csrf_token() }}";
        const qty = $('#qty').val();
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url:`{{url('down/qty')}}`,
            type: 'get',
            cache: false,
            data: { '_token': $_token, 'qty':qty }, //see the $_token
            success: function(response) {
                var element = JSON.parse(response);
                $('#qty').val(element);
            }
        });
    }
</script>

@endsection
<!-- Mirrored from kute-themes.com/html/leka/html/single-product.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Jul 2021 04:47:49 GMT -->

