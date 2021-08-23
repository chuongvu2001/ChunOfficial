@extends('backend.layouts.main')
@section('title','Danh sách tài khoản')
@section('bread')
    <ul class="navbar-nav flex-row">
        <li>
            <div class="page-header">
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/tai-khoan')}}">Tài khoản</a></li>
                        {{--                        <li class="breadcrumb-item active" aria-current="page"><span>Edit-Cate</span></li>--}}
                    </ol>
                </nav>

            </div>
        </li>
    </ul>
@endsection
@section('content')
    <table id="style-3" class="table style-3  table-hover">
        <thead>
        <a href="{{url('admin/tai-khoan/add')}}" class="btn btn-primary">Thêm tài khoản</a>
        <tr>
            <th class="checkbox-column text-center"> Id </th>
            <th class="text-center" width="350"> Name </th>
            <th class="text-center">Avatar</th>
            <th class="text-center">Email</th>
            <th class="text-center">Role</th>
            <th class="text-center">Verification</th>
            <th class="text-center dt-no-sorting">Action</th>
        </tr>
        </thead>
        <tbody id="load">
        @foreach($users as $c => $item)
                <tr>
                    <td class="checkbox-column text-center"> {{$loop->iteration}} </td>
                    <td class="text-center">{{$item->name}}</td>
                    <td class="text-center">
                        <span><img src="{{$item->image}}" class="profile-img" alt="avatar"></span>
                    </td>
                    <td class="text-center">{{ $item->email  }}</td>
                    @if($item->role == 100)
                        <td class="text-center"><a href="javascript:;"><span class="shadow-none badge badge-success">Admin</span></a></td>
                    @elseif($item->role == 10)
                        <td class="text-center"><a href="javascript:;"><span class="shadow-none badge badge-warning">Nhân viên</span></a></td>
                    @else
                        <td class="text-center"><a href="javascript:;"><span class="shadow-none badge badge-primary">Thành viên</span></a></td>
                    @endif

                    @if($item->confirmed == 1)
                        <td class="text-center"><a href="javascript:;"><span class="shadow-none badge badge-success">Đã xác minh</span></a></td>
                    @else
                        <td class="text-center"><a href="javascript:;"><span class="shadow-none badge badge-danger">Chưa xác minh</span></a></td>
                    @endif
                    <td class="text-center">
                        <ul class="table-controls">
                            <li><a href="{{url('admin/danh-muc/edit/'.$item->id)}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                            <li><a href="{{url('admin/tai-khoan/remove/'.$item->id)}}" onclick="return confirm('Bạn có chắc chắn xoá?')" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                        </ul>
                    </td>
                </tr>

        @endforeach
        </tbody>
    </table>
    <div class="dt--pagination">
        <div class="dataTables_paginate paging_simple_numbers" id="style-3_paginate">
            <ul class="pagination">
                <!-- <li class="paginate_button page-item previous disabled" id="style-3_previous">
                    <a href="#" aria-controls="style-3" data-dt-idx="0" tabindex="0" class="page-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-left">
                        <line x1="19" y1="12" x2="5" y2="12"></line>
                        <polyline points="12 19 5 12 12 5"></polyline></svg>
                    </a>
                </li>
                <li class="paginate_button page-item active">
                    <a href="#" aria-controls="style-3" data-dt-idx="1" tabindex="0" class="page-link">1</a>
                </li>
                <li class="paginate_button page-item next disabled" id="style-3_next">
                    <a href="#" aria-controls="style-3" data-dt-idx="2" tabindex="0" class="page-link">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-arrow-right">
                        <line x1="5" y1="12" x2="19" y2="12"></line>
                        <polyline points="12 5 19 12 12 19"></polyline>
                    </svg>
                </a>
            </li> -->

            </ul>
        </div>
    </div>
@endsection
