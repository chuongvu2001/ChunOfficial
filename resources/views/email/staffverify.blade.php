<!DOCTYPE html>
<html lang="en-US">
<head>
    <meta charset="utf-8">
</head>
<body>
<h2>XÁC MINH ĐỊA CHỈ EMAIL CỦA BẠN</h2>

<div>
    Cảm ơn bạn đã tạo một tài khoản với ứng dụng xác minh. Vui lòng theo liên kết bên dưới để xác minh địa chỉ email của bạn.
    {{ URL::to('staff/register/verify/' . $confirmation_code) }}.<br/>

</div>

</body>
</html>
