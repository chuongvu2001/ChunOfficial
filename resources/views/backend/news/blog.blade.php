@extends('backend.layouts.main')
@section('title','List|News')
@section('bread')
<ul class="navbar-nav flex-row">
    <li>
        <div class="page-header">
            <nav class="breadcrumb-one" aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="javascript:void(0);">News</a></li>
                    {{-- <li class="breadcrumb-item active" aria-current="page"><span></span></li> --}}
                </ol>
            </nav>

        </div>
    </li>
</ul>
@endsection
@section('content')
<a class="btn btn-primary" href="{{url('admin/tin-tuc/add')}}">Thêm bản tin</a>
<table id="style-3" class="table style-3  table-hover">
    <thead>
        <tr>
            <th class="checkbox-column text-center"> Id </th>
            <th class="text-center">Title</th>
            <th class="text-center">Image</th>
            <th class="text-center">Image2</th>
            <th class="text-center">View</th>
            <th class="text-center">Like</th>
            <th class="text-center">Category</th>
            <th class="text-center">User</th>
            <th class="text-center">Slug</th>
            <th class="text-center">Status</th>
            <th class="text-center dt-no-sorting">Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($news as $n => $item)
        <tr>
            <td class="checkbox-column text-center"> {{$loop->iteration}} </td>
            <td class="text-center">{{$item->title}}</td>
            <td class="text-center">
                <span><img src="{{$item->image}}" class="profile-img" alt="avatar"></span>
            </td>
            <td class="text-center">
                <span><img src="{{$item->image2}}" class="profile-img" alt="avatar"></span>
            </td>
            <td class="text-center">{{$item->view}}</td>
            <td class="text-center">{{$item->like}}</td>
            <td class="text-center">{{$item->get_cate->name}}</td>
            <td class="text-center">{{$item->get_user->name}}</td>
            <td class="text-center">{{$item->slug}}</td>
            @if($item->status == 1)
                <td class="text-center"><span class="shadow-none badge badge-success">ON</span></td>
            @else
                <td class="text-center"><span class="shadow-none badge badge-danger">OFF</span></td>
            @endif

            <td class="text-center">
                <ul class="table-controls">
                    <li><a href="{{url('admin/tin-tuc/edit/'.$item->id)}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                    <li><a href="{{url('admin/tin-tuc/remove/'.$item->id)}}" onclick="return confirm('Bạn có chắc chắn xoá?');" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                </ul>
            </td>
        </tr>
        @endforeach
    </tbody>
</table>

@endsection
