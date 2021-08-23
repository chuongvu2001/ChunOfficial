@extends('backend.layouts.main')
@section('title','Edit|CateNew')
@section('bread')
    <ul class="navbar-nav flex-row">
        <li>
            <div class="page-header">
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/chuyen-muc')}}">CateNew</a></li>
                        <li class="breadcrumb-item active" aria-current="page"><span>Edit-CateNew</span></li>
                    </ol>
                </nav>
            </div>
        </li>
    </ul>
@endsection
@section('content')
    <div class="container">
       <form action="{{url('admin/chuyen-muc/edit/'.$cate->id)}}" id="add-edit-form" method="POST">
           @csrf
            <div class="row">
                <div class="col-xl-8 col-lg-7 mt-3 mb-3">
                    <div class="card component-card_6" style="margin: 0px !important; width:100% !important;">
                        <div class="card-body" style="margin-top: 20px;">
                            <div class="card-header">
                                <h4 class="m-0 font-weight-bold text-primary">Edit Categories News</h4>
                            </div>
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Name <span style="color:red;">(*)</span></label>
                                    <input type="text" class="form-control" value="{{old('name',$cate->name)}}" id="name" name="name" placeholder="Nhập tên danh mục">
                                    @error('name')
                                        <span class="text-danger">{{$message}}</span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="formGroupExampleInput">Categories <span style="color:red;">(*)</span></label>
                                    <select name="role" class="form-control">
                                        @if($cate->role == 0)
                                            <option value="{{$cate->role}}">
                                                Danh mục cha
                                            </option>
                                        @endif

                                        @if($cates)
                                            @foreach($cates as $key => $item)

                                                @if($item->status == 1 && $item->role == 0)
                                                    @if($item->id == $cate->role)
                                                        <option value="{{$item->id}}">
                                                            {{$item->name}}
                                                        </option>
                                                    @endif
    {{--                                                @if($item->status == 1 && $item->role == 0 && $item->id != $cate->role)--}}
    {{--                                                    <option value="{{$item->id}}">--}}
    {{--                                                        {{$item->name}}--}}
    {{--                                                    </option>--}}
    {{--                                                @endif--}}


                                                @endif


                                            @endforeach
                                            @if($cate->role != 0)
                                                <option value="0">
                                                    Danh mục cha
                                                </option>
                                            @endif
                                            @foreach($cates as $key => $item)
                                                    @if($item->status == 1 && $item->role == 0)
                                                        @if($item->id != $cate->role)
                                                            <option value="{{$item->id}}">
                                                                {{$item->name}}
                                                            </option>
                                                        @endif
                                                    @endif
                                            @endforeach
                                        @endif

                                    </select>
                                </div>
                                {{-- <div class="form-floating">
                                    <label for="formGroupExampleInput">Nội dung <span style="color:red;">(*)</span></label>
                                    <textarea class="form-control" placeholder="Leave a comment here" name="content" id="editor" style="height: 100px"></textarea>
                                </div> --}}
                                <div class="form-group mt-3">
                                    <button type="submit" class="btn btn-success">Submit</button>
                                    <a href="{{url('admin/chuyen-muc')}}" class="btn btn-warning">Cancel</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
       </form>
    </div>
@endsection
