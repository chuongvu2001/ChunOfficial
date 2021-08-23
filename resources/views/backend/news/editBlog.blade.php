@extends('backend.layouts.main')
@section('title','Edit|News')
@section('bread')
    <ul class="navbar-nav flex-row">
        <li>
            <div class="page-header">
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/tin-tuc')}};">News</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>Edit-News</span></li>
                    </ol>
                </nav>

            </div>
        </li>
    </ul>
@endsection
@section('content')
    <div class="container">
        <form action="{{url('admin/tin-tuc/edit/'.$new->id)}}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="row">
                <div class="col-xl-8 col-lg-7 mt-3 mb-3">
                    <div class="card component-card_6" style="margin: 0px !important; width:100% !important;">
                        <div class="card-body" style="margin-top: 20px;">
                            <div class="card-header">
                                <h4 class="m-0 font-weight-bold text-primary">Edit News</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Title <span style="color:red;">(*)</span></label>
                                    <input type="text" class="form-control" id="title" value="{{old('title',$new->title)}}" name="title" placeholder="Nhập tiêu đề">
                                    @error("title")
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>

                                <div class="form-floating">
                                    <label for="formGroupExampleInput">Content <span style="color:red;">(*)</span></label>
                                    <textarea class="form-control content"  placeholder="Nội dung" name="content"  style="height: 100px">{{old('content',$new->content)}}</textarea>
                                </div>
                                @error("content")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{url('admin/tin-tuc')}}" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 mt-3">
                    <div class="card component-card_6" style="margin: 0px !important; width:100% !important;">
                        <div class="card-body" style="margin-top: 20px">
                            <div class="form-group">
                                <label for="formGroupExampleInput">Image <span style="color:red;">(*)</span></label>
                                <div class="input-group">
                                       <span class="input-group-btn">
                                         <a id="lfm1" data-input="image" data-preview="holder" class="btn btn-primary">
                                           <i class="fa fa-picture-o"></i> Choose
                                         </a>
                                       </span>
                                    <input id="image" class="form-control" type="text" value="{{old('image',$new->image)}}" name="image">
                                </div>
                                @error("image")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">image 2 <span style="color:red;">(*)</span></label>
                                <div class="input-group">
                                       <span class="input-group-btn">
                                         <a id="lfm2" data-input="image2" data-preview="holder" class="btn btn-primary">
                                           <i class="fa fa-picture-o"></i> Choose
                                         </a>
                                       </span>
                                    <input id="image2" class="form-control" value="{{old('image2',$new->image2)}}" type="text" name="image2">
                                </div>
                                @error("image2")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">Categories <span style="color:red;">(*)</span></label>
                                <select name="cate_id" class="form-control">
                                    @isset($cates)
                                        <option>Chuyên mục</option>
                                        @foreach($cates as $c)
                                            @if($c->status == 1)
                                                <option @if($c->id == old('cate_id',$new->cate_id)) selected @endif value="{{$c->id}}">{{$c->name}}</option>
                                            @endif
                                        @endforeach
                                    @endisset
                                </select>
                                @error("cate_id")
                                <span class="text-danger">{{$message}}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="formGroupExampleInput">User  <span style="color:red;">(*)</span></label>
                                <select disabled name="user_id" class="form-control">
                                    <option value="{{\Illuminate\Support\Facades\Auth::user()->id}}">{{\Illuminate\Support\Facades\Auth::user()->name}}</option>
                                </select>
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
        $('#lfm2').filemanager('image');
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
