<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">Hello <span style="font-weight: bold; font-size:18px">{{$user->name}}</span>. Hãy bấm link bên dưới để đổi mật khẩu mới của bạn.</div>
                <div class="card-body">
                    @if (session('resent'))
                        <div class="alert alert-success" role="alert">
                            {{ __('A fresh verification link has been sent to your email address.') }}
                        </div>
                    @endif
                    <a href="{{ url('/reset-password/'.$email.'/'.$token) }}" class="btn btn-info">Đổi mật khẩu mới</a>
                </div>
            </div>
        </div>
    </div>
</div>

</body>
</html>
