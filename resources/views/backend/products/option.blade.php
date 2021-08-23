@extends('backend.layouts.main')
@section('title','Thêm lựa chọn')
@section('bread')
    <ul class="navbar-nav flex-row">
        <li>
            <div class="page-header">
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/san-pham')}};">Sản phẩm</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>Thêm sản phẩm</span></li>
                    </ol>
                </nav>

            </div>
        </li>
    </ul>
@endsection
@section('content')
    <div class="container">
        <form action="javascript:;" onsubmit="options()" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-7 col-lg-8 mt-3 mb-3">
                    <div class="card component-card_6" style="margin: 0px !important; width:100% !important;">
                        <div class="card-body" style="margin-top: 20px;">
                            <div class="card-header">
                                <h4 class="m-0 font-weight-bold text-primary">Thêm lựa chọn</h4>
                            </div>
                            <div class="card-body">
                                <form action="javacript:;" onsubmit="options()">
                                    <div class="md-form mb-5">
                                        <input type="number" id="product" value="{{$pro_id}}" class="" style="display: none">
                                        <i class="fas fa-user prefix grey-text"></i>
                                        <label data-error="wrong" data-success="right" for="form34">Color</label>
                                        <select class="form-control validate" id="select-color" name="color" aria-label="Default select example">
                                            @foreach($colors as $c => $item)
                                                <option value="{{$item->color}}">{{$item->color}}</option>
                                            @endforeach
                                        </select>
                                        <label data-error="wrong" data-success="right" class="mt-3" for="form34">Màu khác</label>
                                        <input type="text" id="color" name="color" class="form-control validate">
                                    </div>
                                    <div class="md-form mb-5">
                                        <i class="fas fa-user prefix grey-text"></i>
                                        <label data-error="wrong" data-success="right" for="form34">Size</label>
                                        <select class="form-control validate" id="select-size" name="size" aria-label="Default select example">
                                            @foreach($sizes as $s => $item)
                                                <option value="{{$item->size}}">{{$item->size}}</option>
                                            @endforeach
                                        </select>
                                        <label data-error="wrong" data-success="right" class="mt-3" for="form34">Size khác</label>
                                        <input type="text" id="size" name="size" class="form-control validate">

                                    </div>
                                    <div class="md-form mb-5">
                                        <i class="fas fa-user prefix grey-text"></i>
                                        <label data-error="wrong" data-success="right" for="form34">Số lượng</label>
                                        <input type="number" id="amount" name="amount" class="form-control validate">
                                    </div>
                                    <div class="modal-footer d-flex justify-content-center">
                                        <a onclick="return confirm('Bạn có chắc chắn muốn thoát?')" href="{{url('admin/san-pham/success')}}" class="btn btn-success btn-models" > Hoàn thành</a>
                                        <button type="submit"  class="btn btn-primary btn-models">Add <i class="fas fa-paper-plane-o ml-1"></i></button>
                                    </div>
                                </form>
{{--                                <div class="form-group mt-3">--}}
{{--                                    <button type="submit" class="btn btn-success">Submit</button>--}}
{{--                                    <a href="{{url('admin/san-pham')}}" class="btn btn-warning">Cancel</a>--}}
{{--                                </div>--}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-5 col-lg-6 mt-3">
                    <div class="card component-card_6" style="margin: 0px !important; width:100% !important;">
                        <div class="card-body" style="margin-top: 20px">
                            <div class="form-group">
                                <table class="table table-hover border-primary">
                                    <thead>
                                    <tr>
                                        <th scope="col">Size</th>
                                        <th scope="col">Màu</th>
                                        <th scope="col">Số lượng</th>
                                        <th scope="col">Action</th>
                                    </tr>
                                    </thead>
                                    <tbody id="table-option">

                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>


        <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
             aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header text-center">
                        <h4 class="modal-title w-100 font-weight-bold">Thêm lựa chọn</h4>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>


                    <script>
                        function options(){
                            $_token = "{{ csrf_token() }}";
                            const color = $('#color').val();
                            const size = $('#size').val();
                            const pro_id = $('#product').val();
                            const amount = $('#amount').val();
                            const select_color = $('#select-color').val();
                            const select_size = $('#select-size').val();
                            let index = 1;
                            $.ajax({
                                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                url: `{{url('admin/san-pham/options')}}`,
                                type: 'POST',
                                cache: false,
                                data: {'pro_id':pro_id,'color': color == false? select_color : color,'size':size ==false? select_size: size,'amount':amount,'_token': $_token}, //see the $_token
                                success: function (response) {
                                    var response = JSON.parse(response);
                                    // console.log(response);
                                    $('#table-option').empty();
                                    // console.log(data['title']);
                                    // $('.note-container').empty();
                                    $('.modal').css('display','none');
                                    $('.modal-backdrop').removeClass('show');
                                    $('.modal-backdrop').removeClass('fade');
                                    $('.modal-backdrop').removeClass('modal-backdrop');
                                    response.forEach(element=>{
                                        let ele_id = element['id'];
                                        let d = new Date(element['created_at']);
                                        let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                                        let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
                                        let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                                        $('#table-option').append(`
                                            <tr>
                                               <td>${element['size']}</td>
                                               <td>${element['color']}</td>
                                               <td>
                                                   ${element['amount']}
                                               </td>
                                                <td>
                                                    <a onclick="xoaop(${ele_id})" href="javascript:;" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                                </td>
                                            </tr>

                                        `);
                                    });
                                }
                            });
                        }

                    </script>
                    <script>
                        function xoaop(id){
                            $_token = "{{ csrf_token() }}";
                            const color = $('#color').val();
                            const size = $('#size').val();
                            const pro_id = $('#product').val();
                            const amount = $('#amount').val();
                            const select_color = $('#select-color').val();
                            const select_size = $('#select-size').val();
                            let index = 1;
                            $.ajax({
                                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                url: `{{url('admin/san-pham/xoa')}}`,
                                type: 'GET',
                                cache: false,
                                data: {'option_id': id,'pro_id':pro_id,'color': color == false? select_color : color,'size':size ==false? select_size: size,'amount':amount,'_token': $_token}, //see the $_token
                                success: function (response) {
                                    var response = JSON.parse(response);
                                    console.log(response);
                                    $('#table-option').empty();
                                    // console.log(data['title']);
                                    // $('.note-container').empty();
                                    $('.modal').css('display','none');
                                    $('.modal-backdrop').removeClass('show');
                                    $('.modal-backdrop').removeClass('fade');
                                    $('.modal-backdrop').removeClass('modal-backdrop');
                                    response.forEach(element=>{
                                        let ele_id = element['id'];
                                        let d = new Date(element['created_at']);
                                        let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                                        let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
                                        let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                                        $('#table-option').append(`
                                            <tr>
                                               <td>${element['size']}</td>
                                               <td>${element['color']}</td>
                                               <td>
                                                   ${element['amount']}
                                               </td>
                                                <td>
                                                    <a onclick="xoaop(${ele_id})" href="javascript:;" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                                </td>
                                            </tr>

                                        `);
                                    });
                                }
                            });
                        }
                    </script>
                </div>
            </div>
        </div>
    </div>
@endsection

