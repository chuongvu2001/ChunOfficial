@extends('backend.layouts.main')
@section('title','Thêm sản phẩm')
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
        <form action="{{route('products.add')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-8 col-lg-7 mt-3 mb-3">
                    <div class="card component-card_6" style="margin: 0px !important; width:100% !important;">
                        <div class="card-body" style="margin-top: 20px;">
                            <div class="card-header">
                                <h4 class="m-0 font-weight-bold text-primary">Thêm sản phẩm</h4>
                            </div>
                            <div class="card-body">

                                <div class="form-group">
                                    <label for="formGroupExampleInput">Tên sản phẩm <span style="color:red;">(*)</span></label>
                                    <input type="text" class="form-control" id="name" value="{{old('name')}}" name="name" placeholder="Nhập tên sản phẩm">
                                    @error("name")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-floating">
                                    <label for="formGroupExampleInput">Mô tả ngắn <span style="color:red;">(*)</span></label>
                                    {{-- <textarea class="form-control"  name="content" id="postTextArea" style="height: 100px"></textarea> --}}
                                    <textarea name="shorts" class="form-control short">{{old('shorts')}}</textarea>
                                    @error("shorts")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-floating mt-3">
                                    <label for="formGroupExampleInput">Mô tả dài <span style="color:red;">(*)</span></label>
                                    {{-- <textarea class="form-control"  name="content" id="postTextArea" style="height: 100px"></textarea> --}}
                                    <textarea name="description" class="form-control my-editor">{{old('description')}}</textarea>
                                </div>
                                @error("description")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                                {{-- <script src="/path-to-your-tinymce/tinymce.min.js"></script> --}}


                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{url('admin/san-pham')}}" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 mt-3">
                    <div class="card component-card_6" style="margin: 0px !important; width:100% !important;">
                        <div class="card-body" style="margin-top: 20px">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Hình ảnh <span style="color:red;">(*)</span></label>
                                <div class="input-group">
                                   <span class="input-group-btn">
                                     <a id="lfm" data-input="thumbnail" data-preview="holder" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> Choose
                                     </a>
                                   </span>
                                    <input id="thumbnail" class="form-control" value="{{old('image')}}" type="text" name="image">
                                    @error("image")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                            </div>
                                <div class="form-group">
                                <label for="formGroupExampleInput">Thumbnail 1 <span style="color:red;">(*)</span></label>
                                <div class="input-group">
                                   <span class="input-group-btn">
                                     <a id="lfm1" data-input="thumbnail1" data-preview="holder" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> Choose
                                     </a>
                                   </span>
                                    <input id="thumbnail1" class="form-control" type="text" value="{{old('thumbnail1')}}" name="thumbnail1">
                                    @error("thumbnail1")
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Thumbnail 2 <span style="color:red;">(*)</span></label>
                                    <div class="input-group">
                                   <span class="input-group-btn">
                                     <a id="lfm2" data-input="thumbnail2" data-preview="holder" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> Choose
                                     </a>
                                   </span>
                                        <input id="thumbnail2" class="form-control" value="{{old('thumbnail2')}}" type="text" name="thumbnail2">
                                        @error("thumbnail2")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Thumbnail 3 <span style="color:red;">(*)</span></label>
                                    <div class="input-group">
                                   <span class="input-group-btn">
                                     <a id="lfm3" data-input="thumbnail3" data-preview="holder" class="btn btn-primary">
                                       <i class="fa fa-picture-o"></i> Choose
                                     </a>
                                   </span>
                                        <input id="thumbnail3" class="form-control" type="text" value="{{old('thumbnail3')}}" name="thumbnail3">
                                        @error("thumbnail3")
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Giá sản phẩm <span style="color:red;">(*)</span></label>
                                <input type="number" class="form-control" id="price" name="price" value="{{old('price')}}" placeholder="Nhập giá sản phẩm">
                                @error("price")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Giá sale <span style="color:yellow;">(không bắt buộc)</span></label>
                                <input type="number" class="form-control" id="price_sale" name="price_sale" value="{{old('price_sale')}}" placeholder="Nhập giá sale">
                                @error("price_sale")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Thương hiệu  <span style="color:red;">(*)</span></label>
                                <input type="text" class="form-control" id="brand" name="brand" value="{{old('brand')}}" placeholder="Thương hiệu">
                            </div>
                            @error("brand")
                                <span class="text-danger">{{$message}}</span>
                            @enderror
                            <div class="form-group">
                                <label for="formGroupExampleInput">SKU  <span style="color:red;">(*)</span></label>
                                <input type="text" class="form-control" id="sku" name="sku" value="{{old('sku')}}" placeholder="Đơn vị phân loại">
                                @error("sku")
                                    <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Danh mục <span style="color:red;">(*)</span></label>
                                <select name="cate_id"  class="form-control">
                                    <option value="0">Danh mục</option>
                                    @if($cates)
                                        @foreach($cates as $key => $item)
                                            @if($item->status == 1)
                                                <option value="{{$item->id}}">
                                                    {{$item->name}}
                                                </option>
                                            @endif
                                        @endforeach
                                    @endif
                                </select>
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
                            const amount = $('#amount').val();
                            const select_color = $('#select-color').val();
                            const select_size = $('#select-size').val();


                            let index = 1;
                            $.ajax({
                                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                url: `{{url('admin/san-pham/options')}}`,
                                type: 'POST',
                                cache: false,
                                data: {'color': color == false? select_color : color,'size':size ==false? select_size: size,'amount':amount,'_token': $_token}, //see the $_token
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
                                                   <a onclick="return remove()" href="javascript:;" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a>
                                               </td>
                                            </tr>

                                        `);
                                    });
                                    $('.note-container').prepend(`
                                                        <div class="note-item ${favourite == 1 ? 'note-fav': ''} all-notes ${element['status'] == 1 ? 'note-personal' : element['status'] == 2 ? 'note-work' : element['status'] ==3 ? 'note-social' : element['status'] ==4? 'note-important': ''}">
                                                            <div class="note-inner-content">
                                                                <div class="note-content">
                                                                    <p class="note-title" data-noteTitle="Meeting with Kelly">${element['title']}</p>
                                                                    <p class="meta-time">${da}/${mo}/${ye}</p>
                                                                    <div class="note-description-content">
                                                                        <p class="note-description" data-noteDescription="Curabitur facilisis vel elit sed dapibus sodales purus rhoncus.">${element['short']}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="note-action">
                                                                    <svg xmlns="http://www.w3.org/2000/svg" onclick="myFavourite(${ele_id})" idth="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fav-note"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                                    <svg xmlns="http://www.w3.org/2000/svg"  onclick="myDelete(${ele_id})" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 delete-note"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
                                                                </div>
                                                                <div class="note-footer">
                                                                    <div class="tags-selector btn-group">
                                                                        <a class="nav-link dropdown-toggle d-icon label-group" data-toggle="dropdown" href="#" role="button" aria-haspopup="true" aria-expanded="true">
                                                                            <div class="tags">
                                                                                <div class="g-dot-personal"></div>
                                                                                <div class="g-dot-work"></div>
                                                                                <div class="g-dot-social"></div>
                                                                                <div class="g-dot-important"></div>
                                                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-more-vertical"><circle cx="12" cy="12" r="1"></circle><circle cx="12" cy="5" r="1"></circle><circle cx="12" cy="19" r="1"></circle></svg>
                                                                            </div>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right d-icon-menu">
                                                                            <a class="note-personal label-group-item label-personal dropdown-item position-relative g-dot-personal" onclick="editstatus(${ele_id},1)" href="javascript:void(0);"> Cá nhân</a>
                                                                            <a class="note-work label-group-item label-work dropdown-item position-relative g-dot-work" onclick="editstatus(${ele_id},2)" href="javascript:void(0);"> Công việc</a>
                                                                            <a class="note-social label-group-item label-social dropdown-item position-relative g-dot-social" onclick="editstatus(${ele_id},3)" href="javascript:void(0);"> Xã hội</a>
                                                                            <a class="note-important label-group-item label-important dropdown-item position-relative g-dot-important" onclick="editstatus(${ele_id},4)" href="javascript:void(0);"> Quan trọng</a>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                `);
                                }
                            });
                        }
                    </script>
                    <div class="modal-body mx-3">
                        <form action="javacript:;" onsubmit="options()">
                            <div class="md-form mb-5">
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
                                <button type="submit"  class="btn btn-primary btn-models">Add <i class="fas fa-paper-plane-o ml-1"></i></button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('page-script')
    <script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script>
        $('#lfm').filemanager('image');
        $('#lfm1').filemanager('image');
        $('#lfm2').filemanager('image');
        $('#lfm3').filemanager('image');
    </script>

    /*
        tinymce
    */
    <script>
        var short = {
            path_absolute : "/",
            selector: 'textarea.short',
            relative_urls: false,
            height:400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar1:
                "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons",
            file_picker_callback : function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(short);
    </script>
    <script>
        var editor_config = {
            path_absolute : "/",
            selector: 'textarea.my-editor',
            relative_urls: false,
            height:400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar1:
                "insertfile undo redo | styleselect | bold italic | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons",
            file_picker_callback : function(callback, value, meta) {
                var x = window.innerWidth || document.documentElement.clientWidth || document.getElementsByTagName('body')[0].clientWidth;
                var y = window.innerHeight|| document.documentElement.clientHeight|| document.getElementsByTagName('body')[0].clientHeight;

                var cmsURL = editor_config.path_absolute + 'laravel-filemanager?editor=' + meta.fieldname;
                if (meta.filetype == 'image') {
                    cmsURL = cmsURL + "&type=Images";
                } else {
                    cmsURL = cmsURL + "&type=Files";
                }

                tinyMCE.activeEditor.windowManager.openUrl({
                    url : cmsURL,
                    title : 'Filemanager',
                    width : x * 0.8,
                    height : y * 0.8,
                    resizable : "yes",
                    close_previous : "no",
                    onMessage: (api, message) => {
                        callback(message.content);
                    }
                });
            }
        };

        tinymce.init(editor_config);
    </script>
@endsection
