@extends('backend.layouts.main')
@section('title','Add|User')
@section('bread')
    <ul class="navbar-nav flex-row">
        <li>
            <div class="page-header">
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/tai-khoan')}};">Users</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>Add-User</span></li>
                    </ol>
                </nav>

            </div>
        </li>
    </ul>
@endsection
@section('content')
    <div class="container">
        <form action="{{route('users.add')}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-8 col-lg-7 mt-3 mb-3">
                    <div class="card component-card_6" style="margin: 0px !important; width:100% !important;">
                        <div class="card-body" style="margin-top: 20px;">
                            <div class="card-header">
                                <h4 class="m-0 font-weight-bold text-primary">Add User</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Name <span style="color:red;">(*)</span></label>
                                    <input type="text" class="form-control" id="name" value="{{old('name')}}" name="name" placeholder="Nhập họ tên">
                                    @error("name")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Email <span style="color:red;">(*)</span></label>
                                    <input type="email" class="form-control" id="email" value="{{old('email')}}" name="email" placeholder="Nhập email">
                                    @error("email")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Password <span style="color:red;">(*)</span></label>
                                    <input type="password" class="form-control" id="password" value="{{old('password')}}" name="password" placeholder="Nhập password">
                                    @error("password")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{url('admin/tai-khoan')}}" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
@endsection

@section('page-script')
    <script src="{{asset('/vendor/laravel-filemanager/js/stand-alone-button.js')}}"></script>
    <script>
        $('#lfm1').filemanager('image');
    </script>
    <script>
        var short = {
            path_absolute : "/",
            selector: 'textarea.content',
            relative_urls: false,
            height:400,
            plugins: [
                "advlist autolink lists link image charmap print preview hr anchor pagebreak",
                "searchreplace wordcount visualblocks visualchars code fullscreen",
                "insertdatetime media nonbreaking save table directionality",
                "emoticons template paste textpattern"
            ],
            toolbar1:
                "insertfile undo redo | styleselect | bold italic underline | alignleft aligncenter alignright alignjustify | bullist numlist outdent indent | link image",
            toolbar2: "print preview media | forecolor backcolor emoticons |",
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

        // add_filter( 'tiny_mce_before_init', 'dieuhau_mce_custom_font_size' );
        // function dieuhau_mce_custom_font_size($init){
        //
        //     $init['fontsize_formats'] = "9pt 10pt 11pt 12pt 13pt 14pt 15pt 16pt 17pt 18pt 19pt 20pt 36pt 72pt";
        //
        //     return $init;
        // }

    </script>

@endsection
