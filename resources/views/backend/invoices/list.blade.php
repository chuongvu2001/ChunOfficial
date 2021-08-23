@extends('backend.layouts.main')
@section('title','Danh sách hoá đơn')
@section('bread')
    <ul class="navbar-nav flex-row">
        <li>
            <div class="page-header">
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/hoa-don')}}">Hoá đơn</a></li>
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
        {{--        <a href="{{url('admin/tai-khoan/add')}}" class="btn btn-primary">Thêm tài khoản</a>--}}
            <tr>
                <th class="checkbox-column text-center"> Id </th>
                <th class="text-center"> Name </th>
                <th class="text-center">Phone</th>
                <th class="text-center">Address</th>
                <th class="text-center">Payment</th>
                <th class="text-center">Sum</th>
                <th class="text-center">Ship</th>
                <th class="text-center">Voucher</th>
                <th class="text-center">Total</th>
                <th class="text-center">Confirmed</th>
                <th class="text-center">Created_at</th>
                <th class="text-center">Detail</th>
                <th class="text-center dt-no-sorting">Action</th>
            </tr>
        </thead>
        <tbody>
        @foreach($invoices as $i => $item)
            <tr>
                <td class="checkbox-column text-center"> {{$loop->iteration}} </td>
                <td class="text-center">{{$item->name}}</td>
                <td class="text-center">{{ $item->phone}}</td>
                <td class="text-center">{{ $item->address.', '.$item->town.', '.$item->city}}</td>
                <td class="text-center">{{ $item->get_payments->payment}}</td>
                <td class="text-center">{{number_format((float)$item->sum, 0, '.', '.')}}₫</td>
                <td class="text-center">{{number_format((float)$item->Ship, 0, '.', '.')}}₫</td>
                <td class="text-center">{{number_format((float)$item->voucher_sale, 0, '.', '.')}}₫</td>
                <td class="text-center">{{number_format((float)$item->total, 0, '.', '.')}}₫</td>

                @if($item->confirmed == 1)
                    <td class="text-center"><a href="javascript:;"><span class="shadow-none badge badge-success">Đã xác nhận</span></a></td>
                @else
                    <td class="text-center"><a href="javascript:;"><span class="shadow-none badge badge-danger">Chưa xác nhận</span></a></td>
                @endif
                <td class="text-center">{{ $item->created_at}}</td>
                <td class="text-center"><a href="{{url('admin/hoa-don/show/'.$item->id)}}">Chi tiết</a></td>
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

@endsection





