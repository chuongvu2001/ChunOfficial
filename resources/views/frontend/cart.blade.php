@extends('frontend.layout.main')
    @section('title','Chun.Official - Giỏ hàng')
    @section('content')
        <section class="banner banner-cart bg-parallax">
            <div class="overlay"></div>
            <div class="container">
                <div class="banner-content text-center">
                    <h2 class="page-title">SHOPPING CART</h2>
                    <div class="breadcrumbs">
                        <a href="#">Home</a>
                        <span>SHOPPING CART</span>
                    </div>
                </div>
            </div>
        </section>
        @if(session()->has('cart') ==true)
            <div class="maincontainer">
                <div class="container">
                    <!-- Step Checkout-->
                    <div class="step-checkout">
                        <div class="row">
                            <div class="col-sm-2"></div>
                            <div class="col-sm-2">
                                <div class="step cart active">
                                    <div class="icon"></div>
                                    <span class="step-count">01</span>
                                    <h3 class="step-name">Mua sắm</h3>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2">
                                <div class="step checkout">
                                    <div class="icon"></div>
                                    <span class="step-count">02</span>
                                    <h3 class="step-name">Thanh toán</h3>
                                </div>
                            </div>
                            <div class="col-sm-1"></div>
                            <div class="col-sm-2">
                                <div class="step complete">
                                    <div class="icon"></div>
                                    <span class="step-count">03</span>
                                    <h3 class="step-name">Hoàn thành</h3>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!-- ./Step Checkout-->
                    <!-- Table cart -->
                    <table class="shop_table cart">
                        <thead>
                        <tr>
                            <th class="product-thumbnail">Sản phẩm</th>
                            <th class="product-name">Tên</th>
                            <th class="product-quantity">Số lượng</th>
                            <th class="product-price">Price</th>
                            <th class="product-subtotal">Tổng sản phẩm</th>
                            <th class="product-remove">&nbsp;</th>
                        </tr>
                        </thead>
                        <tbody>

                        @if(session()->has('cart') ==true)
                            @php
                                $cart = session()->get('cart');
                            @endphp
                            @foreach($cart as $c => $item)
                                <tr class="cart_item">
                                    <td class="product-thumbnail">
                                        <a href="{{url('product/'.$item['slug'].'/'.$item['pro_id'].'.html')}}">
                                            <img src="{{$item['pro_image']}}" width="120" alt="" />
                                        </a>
                                    </td>
                                    <td class="product-name">
                                        <a href="{{url('product/'.$item['slug'].'/'.$item['pro_id'].'.html')}}">{{$item['pro_name']}}</a>
                                        <dl class="variation">
                                            <dt class="variation-Color">Color:</dt>
                                            <dd class="variation-Color">
                                                <p>{{$item['color']}}</p>
                                            </dd>
                                            <dt class="variation-Size">Size:</dt>
                                            <dd class="variation-Size">
                                                <p>{{$item['size']}}</p>
                                            </dd>
                                        </dl>
                                    </td>
                                    <td class="product-quantity">
                                        <div class="box-qty">
                                            @php
                                                $id = ($item['pro_id']);
                                                $size =($item['size']);
                                                $color = $item['color'];
                                            @endphp
                                            <a href="javascript:;" onclick="upAmount({{$c}},{{$item['pro_id']}}, '{{$size}}','{{$color}}')" class="quantity-plus"><i class="fa fa-angle-up"></i></a>
                                            <input type="text" disabled step="1" min="1" name="quantity" value="{{$item['amount']}}" id="amount-{{$c}}"  title="Qty" class="input-text qty  text" size="4">
                                            <a href="javascript:;" onclick="downAmount({{$c}},{{$item['pro_id']}}, '{{$size}}','{{$color}}')" class="quantity-minus"><i class="fa fa-angle-down"></i></a>
                                        </div>
                                    </td>
                                    <td class="product-price">
                                        <span class="amount">{{number_format($item['pro_price'])}}₫</span>
                                    </td>
                                    <td class="product-subtotal">
                                        <span class="amount total-{{$c}}">{{number_format($item['total'])}}₫</span>
                                    </td>
                                    <td class="product-remove">
                                        <a class="remove" href="{{url('remove/'.$c)}}"><i class="fa fa-times"></i></a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                        <tr>
                            <td colspan="6" class="actions">
                                <a href="{{url('/')}}" class="button pull-left">TIẾP TỤC MUA HÀNG</a>
                                <a href="{{url('delete/cart')}}" class="button">XOÁ GIỎ HÀNG</a>
                            </td>
                        </tr>

                        </tbody>
                    </table>
                    <div class="cart-collaterals">
                        <div class="row">
                            <div class="col-sm-12 col-md-4">
                                <div class="discount-codes">
                                    <h2>MÃ GIẢM GIÁ</h2>
                                    <p class="notice">Nhập mã giảm giá nếu bạn có.</p>
                                    <form class="form" action="javascript:;" onsubmit="Voucher()">
                                        <p><input type="text" placeholder="MÃ GIẢM GIÁ.." /></p>
                                        <p>
                                            <label>MÃ GIẢM GIÁ ĐANG CÓ</label>
                                            <select id="voucher" name="voucher">
                                                @foreach($voucher as $v =>$item)
                                                    @php
                                                        $object_voucher = (object)$item;
                                                    @endphp
                                                    @if($object_voucher->attr_status == 1)
                                                        <option value="{{$object_voucher->voucher_id}}">{{ucwords($object_voucher->voucher_name)}}</option>
                                                    @endif
                                                @endforeach
                                            </select>
                                        </p>
                                        <button class="button">ÁP DỤNG</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="shipping-form">
                                    <h2>THÔNG TIN VẬN CHUYỂN</h2>
                                    {{--                        <p class="notice">ĐÃ ÁP DỤNG MÃ GIẢM 25% CHO HOÁ ĐƠN</p>--}}
                                    <form class="form" action="javascript:;" onsubmit="Address()">
                                        <p>
                                            <label>VẬN CHUYỂN</label>
                                            <select id="address">
                                                <option value="1">HÀ NỘI</option>
                                                <option value="2">HÀ NAM</option>
                                                <option value="2">NAM ĐỊNH</option>
                                                <option value="2">BẮC NINH</option>
                                                <option value="2">BẮC GIANG</option>
                                                <option value="3">NINH BÌNH</option>
                                                <option value="3">HẢI PHÒNG</option>
                                                <option value="3">HOÀ BÌNH</option>
                                                <option value="3">HẢI DƯƠNG</option>
                                                <option value="3">THÁI BÌNH</option>
                                                <option value="3">THANH HOÁ</option>
                                                <option value="4">NGHỆ AN</option>
                                                <option value="4">HÀ TĨNH</option>
                                                <option value="4">LÀO CAI</option>
                                                <option value="4">SƠN LA</option>
                                                <option value="4">THÁI NGUYÊN</option>
                                                <option value="4">TUYÊN QUANG</option>
                                                <option value="4">LẠNG SƠN</option>
                                                <option value="4">YÊN BÁI</option>
                                                <option value="4">ĐÀ NẴNG</option>
                                                <option value="4">TP. HỒ CHÍ MINH</option>
                                            </select>
                                        </p>
                                        <button class="button">ÁP DỤNG</button>
                                    </form>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-4">
                                <div class="cart_totals ">
                                    <h2>THANH TOÁN</h2>
                                    <table>
                                        <tbody>
                                        @php
                                            $cart = session()->get('cart');
                                                $key = 'total';
                                                $sum = array_sum(array_column($cart,$key));
                                                if(session()->has('ship-cod') == true){
                                                    $shipcod = session()->get('ship-cod');

                                                }
                                                if(session()->has('voucher') == true){
                                                    $voucher = session()->get('voucher');
                                                }
                                        @endphp
                                        <tr class="order-total bill">
                                            <th>Tổng tiền</th>
                                            <td>
                                                <strong><span class="amount sum-bill">{{number_format((float)$sum, 0, '.', '.')}}</span>₫</strong>
                                            </td>
                                        </tr>
                                        <tr class="order-total ship-cod">
                                            <th>Phí Ship (Tạm tính)</th>
                                            <td>
                                                <strong><span class="amount sum-ship">{{number_format((float)20000, 0, '.', '.')}}</span>₫</strong>
                                            </td>
                                        </tr>
                                        <tr class="cart-subtotal voucher">
                                            @isset($voucher['freeship'])
                                                <th>Mã giảm giá</th>
                                                <td>
                                                    <strong><span class="amount  sum-voucher-ship">{{number_format(- (float)$voucher['freeship'], 0, '.', '.')}}</span>₫</strong>
                                                </td>
                                            @endisset
                                            @isset($voucher['sale'])
                                                <th>Mã giảm giá <span id="phantram">{{$voucher['phantram']* 100}}%</span></th>
                                                <td><input class="amount sum-voucher-sale text-right"  name="sale" disabled style="border:none; background: #fff !important;" value="">₫</td>
                                                <td>
                                                    <strong><span class="amount  sum-voucher-sale">{{number_format(- (float)$voucher['sale'], 0, '.', '.')}}</span>₫</strong>
                                                </td>
                                            @endisset
                                        </tr>
                                        <tr class="order-total pay">
                                            <th>Thanh toán</th>
                                            <td>
                                                <strong><span class="amount  sum-pay">{{number_format((float)($sum+20000), 0, '.', '.')}}</span>₫</strong>
                                            </td>
                                        </tr>
                                        </tbody>
                                    </table>
                                    <div class="wc-proceed-to-checkout">
                                        <a href="javascript:;" onclick="Checkout()"  class="checkout-button button alt wc-forward">XÁC NHẬN</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!--Sell products-->
                    <div class="related-products">
                        <div class="title-section text-center">
                            <h2 class="title">SELL PRODUCTS</h2>
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
                    <!--./Sell products-->
                    @else
                        <div class="container">
                            <div class="row">

                                <div class="d-flex text-center justify-content-center">
                                    <h2 class="page-title" style="margin-top: 20px">CHƯA CÓ SẢN PHẨM NÀO!</h2>
                                    <img src="{{asset('frontend/shiper.png')}}" width="60%" class="">
                                </div>
                            </div>
                        </div>
                    @endif

                </div>
            </div>
    @endsection
@section('page-script')
<script>
    /*
    * Update Quantity
    * */
    function formatNumber(num) {
        return num.toString().replace(/(\d)(?=(\d{3})+(?!\d))/g, '$1.')
    }
    function upAmount(c ,id, size, color){
        // console.log(c);

        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url:`{{url('up/amount')}}`,
            type: 'get',
            cache: false,
            data: { '_token': $_token,'c':c,'id':id, 'size':size, 'color': color}, //see the $_token
            success: function(response) {
                var element = JSON.parse(response);
                // console.log(element);
                $(`#amount-${element['key']}`).val(element['amount']);
                $(`.total-${element['key']}`).empty();
                $(`.total-${element['key']}`).append(`
                ${formatNumber(element['total'])
                }
                                        `)
                $('.bill').empty();
                $('.bill').append(`
                    <th>Tổng tiền</th>
                    <td>
                        <strong><span class="amount sum-bill">${(formatNumber(element['bill']))}</span>₫</strong>
                     </td>
                    `)

                if(element['freeship']){
                    $('.voucher').empty();
                    $('.voucher').append(`
                     <th>Mã giảm giá Free Ship</th>
                     <td>
                        <strong><span class="amount sum-voucher-ship">-${(formatNumber(element['freeship']))}</span>₫</strong>
                     </td>
                                                    `)
                }
                else if(element['sale']){
                    $('.voucher').empty();
                    $('.voucher').append(`
                    <th>Mã giảm giá  <span id="phantram">${element['phantram']*100}%</span></th>
                        <strong><span class="amount sum-voucher-sale">-${(formatNumber(element['sale']))}</span>₫</strong>
                     <td>
                        <strong><span class="amount sum-voucher-sale">-${(formatNumber(element['sale']))}</span>₫</strong>
                     </td>
                                            `)
                }
                else{
                    $('.voucher').empty();
                }


                $('.pay').empty();
                $('.pay').append(`
                                            <th>Thanh toán</th>
                                            <td>
                                                <strong><span class="amount  sum-pay">${(formatNumber(element['pay']))}</span>₫</strong>
                                            </td>
                                        `)
            }
        });
    }
    function downAmount(c ,id, size, color){
        // console.log(c);
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
            url: `{{url('down/amount')}}`,
            type: 'get',
            cache: false,
            data: {'_token': $_token, 'c': c, 'id': id, 'size': size, 'color': color}, //see the $_token
            success: function (response) {
                var element = JSON.parse(response);
                // console.log(element);
                $(`#amount-${element['key']}`).val(element['amount']);
                $(`.total-${element['key']}`).empty();
                $(`.total-${element['key']}`).append(`
                ${formatNumber(element['total'])
                }
                                        `)
                $('.bill').empty();
                $('.bill').append(`
                    <th>Tổng tiền</th>
                    <td>
                        <strong><span class="amount sum-bill">${(formatNumber(element['bill']))}</span>₫</strong>
                     </td>
                    `)

                if(element['freeship']){
                    $('.voucher').empty();
                    $('.voucher').append(`
                     <th>Mã giảm giá Free Ship</th>
                     <td>
                        <strong><span class="amount sum-voucher-ship">-${(formatNumber(element['freeship']))}</span>₫</strong>
                     </td>
                                                    `)
                }
                else if(element['sale']){
                    $('.voucher').empty();
                    $('.voucher').append(`
                    <th>Mã giảm giá  <span id="phantram">${element['phantram']*100}%</span></th>
                        <strong><span class="amount sum-voucher-sale">-${(formatNumber(element['sale']))}</span>₫</strong>
                     <td>
                        <strong><span class="amount sum-voucher-sale">-${(formatNumber(element['sale']))}</span>₫</strong>
                     </td>
                                            `)
                }
                else{
                    $('.voucher').empty();
                }


                $('.pay').empty();
                $('.pay').append(`
                    <th>Thanh toán</th>
                    <td>
                        <strong><span class="amount  sum-pay">${(formatNumber(element['pay']))}</span>₫</strong>
                    </td>
                `)
            }
        });
    }
    /*
        endUpdateQuantity
    */


    /*
    * Location
    * */


    function Address(){
        const address =  $('#address').val();
        $_token = "{{ csrf_token() }}";
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url:`{{url('check-address')}}`,
            type: 'get',
            cache: false,
            data: { '_token': $_token, 'address':address }, //see the $_token
            success: function(response) {
                var element = JSON.parse(response);
                // console.log(element);
                $('.ship-cod').empty();
                $('.ship-cod').append(`
                    <th>Phí Ship (Tạm tính)</th>
                     <td>
                        <strong><span class="amount sum-ship">${(formatNumber(element['ship']))}</span>₫</strong>
                    </td>
                                        `)
                $('.bill').empty();
                $('.bill').append(`
                     <th>Tổng tiền</th>
                    <td>
                        <strong><span class="amount sum-bill">${(formatNumber(element['sum']))}</span>₫</strong>
                    </td>
                                        `)
                $('.pay').empty();
                $('.pay').append(
                    `
                    <th>Thanh toán</th>
                     <td>
                        <strong><span class="amount sum-pay">${(formatNumber(element['pay']))}</span>₫</strong>
                    </td>
                                `
                )
            }
        });
    }


    /*
    * Vocher
    * */
    function Voucher(){
        $_token = "{{ csrf_token() }}";
        const voucher_id = $('#voucher').val();
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url:`{{url('check-voucher')}}`,
            type: 'get',
            cache: false,
            data: { '_token': $_token, 'voucher_id':voucher_id}, //see the $_token
            success: function(response) {
                var element = JSON.parse(response);
                $('.voucher').empty();
                if((element['freeship'])){
                    $('.bill').empty();
                    $('.bill').append(`
                        <th>Tổng tiền</th>
                        <td>
                            <strong><span class="amount  sum-bill">${(formatNumber(element['sum']))}</span>₫</strong>
                         </td>
                                        `)

                    $('.voucher').append(`
                        <th>Mã giảm giá Free Ship</th>
                        <td>
                            <strong><span class="amount  sum-voucher-ship">-${(formatNumber(element['freeship']))}</span>₫</strong>
                         </td>
                                                    `)
                    $('.pay').empty();
                    $('.pay').append(`
                        <th>Thanh toán</th>
                        <td>
                            <strong><span class="amount sum-pay">${(formatNumber(element['pay']))}</span>₫</strong>
                         </td>
                    `)
                }
                else{
                    $('.bill').empty();
                    $('.bill').append(`
                          <th>Tổng tiền</th>
                          <td>
                            <strong><span class="amount sum-bill">${(formatNumber(element['sum']))}</span>₫</strong>
                         </td>
                                        `)

                    $('.voucher').append(`
                         <th>Mã giảm giá <span id="phantram">${element['phantram']*100}%</span></th>
                        <td>
                            <strong><span class="amount sum-voucher-sale">-${(formatNumber(element['sale']))}</span>₫</strong>
                         </td>
                                            `)
                    $('.pay').empty();
                    $('.pay').append(`
                        <th>Thanh toán</th>
                        <td>
                            <strong><span class="amount sum-pay">${(formatNumber(element['pay']))}</span>₫</strong>
                         </td>
                                        `)
                }
            }
        });
    }


    /*Checkout*/
    function Checkout(){
//     document.querySelector('.checkout-button').onclick = function (){
        $_token = "{{ csrf_token() }}";
        const sum = $(".sum-bill").text();
        const ship = $(".sum-ship").text();
        const voucher_ship = $(".sum-voucher-ship ").text();
        const voucher_sale = $(".sum-voucher-sale").text();
        const phantram = $("#phantram").text();
        const pay = $(".sum-pay").text();
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url:`{{url('checkout')}}`,
            type: 'get',
            cache: false,
            data: { '_token': $_token, 'sum':sum,'ship':ship,'voucher_ship':voucher_ship,'voucher_sale':voucher_sale,'pay':pay,'phantram':phantram }, //see the $_token
            success: function(response) {
                var element = JSON.parse(response);
                $('.checkout-button').removeAttr("onclick");
                $('.checkout-button').removeAttr("href");
                $('.checkout-button').attr('href',"{{url('checkout/verify')}}");
                $('.checkout-button').empty();
                $('.checkout-button').append(`THANH TOÁN`);
            }
        });
        // }
    }
    /*endcheckout*/

</script>
@endsection

<!-- Mirrored from kute-themes.com/html/leka/html/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Jul 2021 04:47:25 GMT -->

