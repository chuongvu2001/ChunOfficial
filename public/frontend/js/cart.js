//Update qty
function upAmount(c ,id, size, color){
    console.log(c);
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
                                            ${element['total'].toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            })
            }
                                        `)
        }
    });
}

//Down Qty
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
                                            ${element['total'].toLocaleString('vi-VN', {
                style: 'currency',
                currency: 'VND'
            })
            }

                                `)
        }
    });
}
