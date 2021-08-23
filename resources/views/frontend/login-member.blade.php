<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from brandio.io/envato/iofrm/html/login22.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Aug 2021 12:59:17 GMT -->
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Chun.Official | Đăng nhập tài khoản</title>
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
                    <h3>Đăng nhập</h3>
                    <p>Đăng nhập để nhận nhiều voucher ưu đãi. </p>
                    @if(session()->has('message'))
                        <div class="alert alert-icon-left alert-light-success mb-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                            <strong>Thông báo! </strong>{{session()->get('message')}}.
                        </div>
                    @endif
                    @isset($msg)
                        <div class="alert alert-arrow-right alert-icon-right alert-light-danger mb-4"
                             role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                            {{$msg}}
                        </div>
                    @endisset
                    @if(session()->has('error-auth'))
                        <div class="alert alert-arrow-right alert-icon-right alert-light-danger mb-4"
                             role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"><svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-circle"><circle cx="12" cy="12" r="10"></circle><line x1="12" y1="8" x2="12" y2="12"></line><line x1="12" y1="16" x2="12" y2="16"></line></svg>
                            {{session()->get('error-auth')}}
                        </div>
                    @endif
                    @isset($notification_status)
                        <div class="alert alert-icon-left alert-light-success mb-4" role="alert">
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close"> <svg xmlns="http://www.w3.org/2000/svg" data-dismiss="alert" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-x close"><line x1="18" y1="6" x2="6" y2="18"></line><line x1="6" y1="6" x2="18" y2="18"></line></svg></button>
                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-alert-triangle"><path d="M10.29 3.86L1.82 18a2 2 0 0 0 1.71 3h16.94a2 2 0 0 0 1.71-3L13.71 3.86a2 2 0 0 0-3.42 0z"></path><line x1="12" y1="9" x2="12" y2="13"></line><line x1="12" y1="17" x2="12" y2="17"></line></svg>
                            <strong>Thông báo! </strong>{{$notification_status}}.
                        </div>
                    @endisset

                    <form action="{{url('login/member')}}" method="POST" novalidate>
                        @csrf
                        <input class="form-control" type="email" name="email" value="{{old('email')}}" placeholder="Địa chỉ E-mail " required>
                        @error('email')
                        <span class="text-danger">{{$message}}</span>
                        @enderror
                        <input class="form-control" type="password" name="password" placeholder="*******" required>
                        @error('password')
                        <span  class="text-danger">{{$message}}</span>
                        @enderror
                        <div class="form-button">
                            <button id="submit" type="submit" class="ibtn">Login</button> <a href="{{url('forgot/member')}}">Quên mật khẩu?</a>
                        </div>
                    </form>
                    <div class="other-links">
                        <div class="text">Hoặc đăng nhập bằng</div>
                        <a href="#"><i class="fab fa-facebook-f"></i>Facebook</a><a href="#"><i class="fab fa-google"></i>Google</a><a href="#"><i class="fab fa-linkedin-in"></i>Linkedin</a>
                    </div>
                    <div class="page-links">
                        <a href="{{url('register/member')}}">Đăng ký</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<script src="{{asset('auth/js/jquery.min.js')}}"></script>
<script src="{{asset('auth/js/popper.min.js')}}"></script>
<script src="{{asset('auth/js/bootstrap.min.js')}}"></script>
<script src="{{asset('auth/js/main.js')}}"></script>
</body>

<!-- Mirrored from brandio.io/envato/iofrm/html/login22.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 01 Aug 2021 12:59:20 GMT -->
</html>
