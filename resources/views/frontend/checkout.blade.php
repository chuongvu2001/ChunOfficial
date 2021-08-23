@extends('frontend.layout.main')
    @section('title', 'Chun.Official - Thanh toán')
    @section('content')
        <section class="banner banner-cart bg-parallax">
            <div class="overlay"></div>
            <div class="container">
                <div class="banner-content text-center">
                    <h2 class="page-title">TRANG THANH TOÁN</h2>
                    <div class="breadcrumbs">
                        <a href="{{url('/')}}">Trang chủ</a>
                        <span>Thanh toán</span>
                    </div>
                </div>
            </div>
        </section>
        {{--{{dd(session()->get('checkout'))}}--}}
        <div class="maincontainer">
            <div class="container">
                <!-- Step Checkout-->
                <div class="step-checkout">
                    <div class="row">
                        <div class="col-sm-2"></div>
                        <div class="col-sm-2">
                            <div class="step cart">
                                <div class="icon"></div>
                                <span class="step-count">01</span>
                                <h3 class="step-name">Mua sắm</h3>
                            </div>
                        </div>
                        <div class="col-sm-1"></div>
                        <div class="col-sm-2">
                            <div class="step checkout active">
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
                <div class="checkout-page">
                    <div class="row">
                        <form method="POST" action="{{url('submit-checkout')}}">
                            @csrf
                            <div class="col-sm-12 col-md-6">
                                <div class="form">
                                    <h3 class="form-title">THÔNG TIN VẬN CHUYỂN</h3>
                                    <div class="row">
                                        {{--                            <div class="col-sm-6">--}}
                                        {{--                                <p>--}}
                                        {{--                                    <label>FIRST NAME <span class="required">*</span></label>--}}
                                        {{--                                    <input type="text" />--}}
                                        {{--                                </p>--}}
                                        {{--                            </div>--}}
                                        <div class="col-sm-12">
                                            <p>
                                                <label>Họ tên khách hàng <span class="required">*</span></label>
                                                <input type="text" name="name" value="{{old('name')}}" />
                                            </p>
                                        </div>
                                    </div>
                                    <p>
                                        <label>Email</label>
                                        <input type="text" name="email" placeholder="{{\Illuminate\Support\Facades\Auth::user()->email}}"  />
                                    </p>
                                    <p>
                                        <label>Số điện thoại<span class="required">*</span></label>
                                        <input type="text" name="phone" value="{{old('phone')}}" />
                                    </p>
                                    <p class="form-group">
                                        <label>Tỉnh/thành<span class="required">*</span></label>
                                        <select name="city" class="form-select" onchange="Town()" id="city">
                                            <option>-----Chọn Tỉnh/Thành phố-----</option>
                                            @foreach($city as $c =>$item)
                                                <option value="{{$item->id}}">{{ucwords($item->address)}}</option>
                                            @endforeach
                                        </select>
                                    </p>
                                    <p class="form-group town">
                                        <label>Quận/huyện <span class="required">*</span></label>
                                        <select name="town" class="form-select" id="townn">
                                            <option>-----Chọn Quận/Huyện-----</option>
                                            <option>No 1</option>
                                        </select>
                                    </p>
                                    <p>
                                        <label>Xã/phường <span class="required">*</span></label>
                                        <input type="text" name="address" placeholder="Địa chỉ cụ thể." />
                                    </p>
                                </div>
                            </div>
                            <div class="col-sm-12 col-md-6">
                                <h3 class="form-title">ĐƠN HÀNG CỦA BẠN</h3>
                                <div class="order-review">
                                    @if(session()->has('checkout'))
                                        <table>
                                            <tbody>
                                            @php
                                                $checkout = session()->get('checkout');
                                            @endphp
                                            <tr>
                                                <td colspan="2">THÔNG TIN</td>
                                                <td>TẠM TÍNH</td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">GIỎ HÀNG</td>
                                                <td><span class="amount">{{$checkout['sum']}}</span></td>
                                            </tr>
                                            <tr>
                                                <td colspan="2">PHÍ COD</td>
                                                <td>
                                                    <span class="amount">{{$checkout['ship']}}</span>
                                                </td>
                                            </tr>
                                            @if(session()->has('voucher'))
                                                <tr>
                                                    <td colspan="2">MÃ GIẢM GIÁ</td>
                                                    <td>
                                                        <span class="amount">@if($checkout['voucher_ship']){{$checkout['voucher_ship']}}@else{{$checkout['voucher_sale']}} @endif </span>
                                                    </td>
                                                </tr>
                                            @endif
                                            <tr>
                                                <td colspan="2">THANH TOÁN</td>
                                                <td>
                                                    <span class="amount">{{$checkout['pay']}}</span>
                                                </td>
                                            </tr>
                                            </tbody>
                                        </table>
                                    @endif
                                </div>
                                <div class="paymment-method">
                                    <h3 class="form-title">HÌNH THỨC THANH TOÁN</h3>
                                    @php
                                        if(session()->has('checkout')){
                                            $checkout = session()->get('checkout');
                                           $dola = floatval(preg_replace('/^([^,]*).*$/', '$1', $checkout['pay']))/22.938;
                                        }

                                    @endphp
                                    <div id="paypal-button"></div>
                                    <script src="https://www.paypalobjects.com/api/checkout.js"></script>
                                    <script>
                                        paypal.Button.render({
                                            // Configure environment
                                            env: 'sandbox',
                                            client: {
                                                sandbox: 'AZFVo4kkBXGsr_RX7usR32BaeVBhrP5BVzXOokW8ovylY5DanStz8ummjt_k8In_FpQaIMcxVYedYrxs',
                                                production: 'demo_production_client_id'
                                            },
                                            // Customize button (optional)
                                            locale: 'en_US',
                                            style: {
                                                size: 'small',
                                                color: 'gold',
                                                shape: 'pill',
                                            },

                                            // Enable Pay Now checkout flow (optional)
                                            commit: true,

                                            // Set up a payment
                                            payment: function(data, actions) {
                                                return actions.payment.create({
                                                    redirect_urls:{
                                                        return_url : "http://localhost:8000/execute-payment"
                                                    },

                                                    transactions: [{
                                                        amount: {
                                                            total: '20',
                                                            currency: 'USD'
                                                        }
                                                    }]
                                                });
                                            },
                                            // Execute the payment
                                            onAuthorize: function(data, actions) {
                                                return actions.redirect();
                                            }
                                        }, '#paypal-button');
                                    </script>

                                    <div class="form-check">
                                        <input class="form-check-input" value="1" name="payment_id" type="radio"  id="flexRadioDefault1">
                                        <label class="form-check-label" for="flexRadioDefault1">
                                            Chuyển khoản ngân hàng
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="2" name="payment_id" type="radio"  id="flexRadioDefault2" checked>
                                        <label class="form-check-label" for="flexRadioDefault2">
                                            Nhận hàng thanh toán
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" value="3" name="payment_id" type="radio"  id="flexRadioDefault3" checked>
                                        <label class="form-check-label" for="flexRadioDefault3">
                                            Thanh toán online Paypal
                                        </label>
                                    </div>

{{--                                    <div class="checkbox">--}}
{{--                                        <label>--}}
{{--                                            <input type="checkbox" value=1">--}}
{{--                                                Chuyển khoản--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
{{--                                    <div class="checkbox">--}}
{{--                                        <label>--}}
{{--                                            <input type="checkbox" value="2">--}}
{{--                                                Nhận hàng thanh toán--}}
{{--                                        </label>--}}
{{--                                    </div>--}}

{{--                                    <div class="checkbox">--}}
{{--                                        <label>--}}
{{--                                            <input type="checkbox" value="3">--}}
{{--                                                Paypal--}}
{{--                                        </label>--}}
{{--                                    </div>--}}
                                </div>
                                <button type="submit" class="button pull-right">THANH TOÁN</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    @endsection
@section('page-script')
<script>
     function Town(){
        $_token = "{{ csrf_token() }}";
        const city = $('#city').val();
        $.ajax({
            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
            url:`{{url('city/town')}}`,
            type: 'get',
            cache: false,
            data: { '_token': $_token, 'city':city }, //see the $_token
            success: function(response) {
                var element = JSON.parse(response);

                $('#city').css('display','block');
                $('.chosen-container').css('display','none');
                $('#townn').empty();
                $('#townn').css('display','block');
                    element.forEach(ele=>{
                        $('#townn').append(`
                        <option value="${ele['id']}" style="text-transform: capitalize;">${ele['address']}</option>
                        `)
                    })
                        // console.log(ele);
                    // $('.town').append(`
                    //       <div class="chosen-container chosen-container-single chosen-with-drop chosen-container-active" style="width: 570px;" title="" id="city_chosen">
                    //         <a class="chosen-single" tabindex="-1"><span>-----Chọn Quận/Huyện-----</span>
                    //             <div><b></b></div>
                    //         </a>
                    //         <div class="chosen-drop">
                    //             <div class="chosen-search">
                    //                 <input type="text" autocomplete="off">
                    //             </div><ul class="chosen-results datatown">
                    //                 <li class="active-result  result-selected" data-option-array-index="0" style="">-----Chọn Tỉnh/Thành phố-----</li>
                    //                  <li class="active-result" data-option-array-index="xyz" style="">abc</li
                    //             </ul>
                    //         </div>
                    //     </div>
                    // `);

                    // $('.datatown').append(`
                    //     ${ element.forEach(ele=>{
                    //         console.log(ele['address']);
                    //         `>`
                    //     })}
                    // `)
            }
        });
    }
</script>
@endsection
