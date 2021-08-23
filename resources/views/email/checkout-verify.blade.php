<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from kute-themes.com/html/leka/html/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Jul 2021 03:50:07 GMT -->
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="UTF-8">
    <title>@yield('title','Chun.Official - Thời trang nam')</title>
    <link rel="stylesheet" href="{{asset('frontend/css/bootstrap.min.css')}}">
    <link rel="icon" type="image/x-icon" href="{{asset('assets/logo/c-clothes-1.png')}}" style="width: 100%"/>
    <link rel="stylesheet" href="{{asset('frontend/css/font-awesome.min.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/owl.carousel.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/chosen.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/superslides.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/magnific-popup.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/jquery.mCustomScrollbar.css')}}">
    <link rel="stylesheet" href="{{asset('frontend/css/animate.css')}}">
    {{--    <link href='https://fonts.googleapis.com/css?family=Lato:400,300,700,900' rel='stylesheet' type='text/css'>--}}
    {{--    <link href='https://fonts.googleapis.com/css?family=Crimson+Text:400,400italic,600,600italic,700,700italic' rel='stylesheet' type='text/css'>--}}
    {{--    <link href='https://fonts.googleapis.com/css?family=Raleway:400,700,500' rel='stylesheet' type='text/css'>--}}
    <link rel="stylesheet" href="{{asset('frontend/css/style.css')}}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Mali&family=Montserrat+Alternates:wght@500&family=Open+Sans:wght@600&display=swap" rel="stylesheet">
    {{--    @notifyCss--}}
</head>

<body>

    @if(session()->has('cart') == true)
    <div class="maincontainer">
        <div class="container">
            <!-- Step Checkout-->
            <!-- ./Step Checkout-->
            <!-- Table cart -->
            <div class="row "><h2 class="text-center">XÁC NHẬN HOÁ ĐƠN</h2></div>
            <table class="shop_table cart">
                <thead>
                <tr>
                    <th class="product-thumbnail">Hình ảnh</th>
                    <th class="product-name">Tên sản phẩm</th>
                    <th class="product-quantity">Số lượng</th>
                    <th class="product-price">Giá</th>
                    <th class="product-subtotal">Tổng sản phẩm</th>
                </tr>
                </thead>
                <tbody>
                @php
                    $cart = session()->get('cart');
                @endphp
                @foreach($cart as $c => $item)
                    <tr class="cart_item">
                        <td class="product-thumbnail">
                            <a href="{{url('product/'.$item['slug'].'/'.$item['pro_id'].'.html')}}" target="_blank">
                                <img src="{{$item['pro_image']}}" width="120" alt="" />
                            </a>
                        </td>
                        <td class="product-name">
                            <a href="{{url('product/'.$item['slug'].'/'.$item['pro_id'].'.html')}}" target="_blank">{{$item['pro_name']}}</a>
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
                                <a href="javascript:;" class="quantity-plus"><i class="fa fa-angle-up"></i></a>
                                <input type="text" disabled step="1" min="1" name="quantity" value="{{$item['amount']}}" id="amount-{{$c}}"  title="Qty" class="input-text qty  text" size="4">
                                <a href="javascript:;" class="quantity-minus"><i class="fa fa-angle-down"></i></a>
                            </div>
                        </td>
                        <td class="product-price">
                            <span class="amount">{{number_format($item['pro_price'])}}₫</span>
                        </td>
                        <td class="product-subtotal">
                            <span class="amount total-{{$c}}">{{number_format($item['total'])}}₫</span>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

            <h3 class="text-center" style="margin-top: 30px">CHI TIẾT HOÁ ĐƠN</h3>
            <div style="max-width: 1000px; margin: 30px auto">
                <div class="table-responsive">
                    <table class="table table-bordered mt-3">
                        <thead>
                        <tr>
                            <th class="text-center">Họ tên KH</th>
                            <th class="text-center">SĐT</th>
                            <th class="text-center">Địa chỉ</th>
                            <th class="text-center">Tổng hoá đơn</th>
                            <th class="text-center">Ship COD</th>
                            <th class="text-center">Khuyễn mãi</th>
                            <th class="text-center">Thanh toán</th>
                        </tr>
                        </thead>
                            <tbody>
                                <tr>
                                    <td class="text-center">{{$model->name}}</td>
                                    <td class="text-center">{{$model->phone}}</td>
                                    <td class="text-center">{{$model->address}}</td>
                                    <td class="text-center">{{number_format((float)$model->sum, 0, '.', '.')}}₫</td>
                                    <td class="text-center">{{number_format((float)$model->ship, 0, '.', '.')}}₫</td>
                                    <td class="text-center">{{$model->voucher_sale != ""? number_format((float)$model->voucher_sale, 0, '.', '.') : "Không tồn tại" }}</td>
                                    <td class="text-center">{{number_format((float)$model->total, 0, '.', '.')}}₫</td>
                                </tr>
                            </tbody>
                    </table>

                </div>
            </div>
            <div class="row">
                <a href="{{ URL::to('checkout/verify/customer/' . $confirmation_code) }}" target="_blank" class="button pull-right">Xác nhận</a>
            </div>
        </div>
    </div>
@endif


    <script type="text/javascript" src="{{asset('frontend/js/jquery-2.1.4.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/custom-ajax-view.js')}}"></script>
    {{--<x:notify-messages />--}}
    {{--@notifyJs--}}
    {{--<script src="{{asset('assets/js/libs/jquery-3.1.1.min.js')}}"></script>--}}
    <script type="text/javascript" src="{{asset('frontend/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.fitvids.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/owl.carousel.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.parallax-1.1.3.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/chosen.jquery.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/isotope.pkgd.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/packery-mode.pkgd.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery-ui.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.superslides.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.magnific-popup.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.mCustomScrollbar.concat.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/Modernizr.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/jquery.actual.min.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/blog-masonry.js')}}"></script>
    <script type="text/javascript" src="{{asset('frontend/js/custom.js')}}"></script>

</body>

<!-- Mirrored from kute-themes.com/html/leka/html/index2.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Jul 2021 03:53:53 GMT -->
</html>

<!-- Mirrored from kute-themes.com/html/leka/html/cart.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 25 Jul 2021 04:47:25 GMT -->

