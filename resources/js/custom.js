/*Checkout*/
// function Checkout(){
document.querySelector('.checkout-button').onclick = function (){
    $_token = "{{ csrf_token() }}";
    const sum = $(".sum-bill").val();
    const ship = $(".sum-ship").val();
    const voucher_ship = $(".sum-voucher-ship ").val();
    const voucher_sale = $(".sum-voucher-sale").val();
    const pay = $(".sum-pay").val();
    $.ajax({
        headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
        url:`{{url('checkout')}}`,
        type: 'get',
        cache: false,
        data: { '_token': $_token, 'sum':sum,'ship':ship,'voucher_ship':voucher_ship,'voucher_sale':voucher_sale,'pay':pay }, //see the $_token
        success: function(response) {
            var element = JSON.parse(response);
            $('.checkout-button').removeAttr("onclick");
            $('.checkout-button').removeAttr("href");
            $('.checkout-button').attr('href',"{{url('checkout/verify')}}");
            $('.checkout-button').empty();
            $('.checkout-button').append(`THANH TOÁN`);
        }
    });
}
// }
/*endcheckout*/
