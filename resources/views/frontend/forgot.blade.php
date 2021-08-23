<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from brandio.io/envato/iofrm/html/login22.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Aug 2021 12:59:17 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chun.Official | Khôi phục tài khoản</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/logo/c-clothes-1.png')}}" style="width: 100%"/>
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/bootstrap.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/fontawesome-all.min.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/iofrm-style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('auth/css/iofrm-theme22.css')}}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/elements/alert.css')}}">
</head>

<body>

<div class="form-body without-side">
    <div class="website-logo">
        <a href="{{url('/')}}">
            <div class="logo">
                <a href="{{url('/')}}"><img src="{{asset('frontend/chun2.png')}}" alt="" /></a>
            </div>
        </a>
    </div>
    <div class="row">
        <div class="img-holder">
            <div class="bg"></div>
            <div class="info-holder">
                <img src="{{asset('auth/images/graphic3.svg')}}" alt="">
            </div>
        </div>
        <div class="form-holder">
            <div class="form-content">
                <div class="form-items">
                    <h3>ĐẶT LẠI MẬT KHẨU</h3>
                    <p>Bạn cần nhập email, để khôi phục tài khoản đăng nhập.</p>
                    @isset($msg)
                        <div class="alert alert-arrow-right alert-icon-right alert-light-danger mb-4"
                             role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                            {{$msg}}
                        </div>
                    @endisset
                    @isset($msgsuccess)
                        <div class="alert alert-icon-left alert-light-success mb-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                            <strong>Thông báo! </strong>{{$msgsuccess}}.
                        </div>
                    @endisset
                    <form action="{{route('post.forgot')}}" novalidate method="POST">
                        @csrf
                        <input class="form-control" type="email" value="{{old('email')}}" name="email" placeholder="Địa chỉ E-mail" required>
                        @error("email")
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-button full-width">
                            <button id="submit" type="submit" class="ibtn btn-forget">Khôi phục</button>
                        </div>
                    </form>
                </div>
                <div class="form-sent">
                    <div class="tick-holder">
                        <div class="tick-icon"></div>
                    </div>
                    <h3>Password link sent</h3>
                    <p>Please check your inbox <a href="http://brandio.io/cdn-cgi/l/email-protection" class="__cf_email__" data-cfemail="acc5c3cadec1ecc5c3cadec1d8c9c1dcc0cdd8c982c5c3">[email&#160;protected]</a></p>
                    <div class="info-holder">
                        <span>Unsure if that email address was correct?</span> <a href="#">We can help</a>.
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('auth/js/jquery-3.5.0.min.js')}}"></script>
<!-- Popper js -->
<script src="{{asset('auth/js/popper.min.js')}}"></script>
<!-- Bootstrap js -->
<script src="{{asset('auth/js/bootstrap.min.js')}}"></script>
<!-- Imagesloaded js -->
<script src="{{asset('auth/js/imagesloaded.pkgd.min.js')}}"></script>
<!-- Validator js -->
<script src="{{asset('auth/js/validator.min.js')}}"></script>
<!-- Custom Js -->
<script src="{{asset('auth/js/main.js')}}"></script>
<script src="{{asset('auth/js/starfield.js')}}"></script>

</body>


<!-- Mirrored from affixtheme.com/html/xmee/demo/forgot-password-26.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 27 Jul 2021 11:16:20 GMT -->
</html>
