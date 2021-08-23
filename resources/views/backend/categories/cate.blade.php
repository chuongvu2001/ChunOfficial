@extends('backend.layouts.main')
@section('title','Hiển thị danh mục')
@section('bread')
    <ul class="navbar-nav flex-row">
        <li>
            <div class="page-header">
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/danh-muc')}}">Danh mục</a></li>
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
    <a href="{{url('admin/danh-muc/add')}}" class="btn btn-primary">Thêm danh mục</a>
        <tr>
            <th class="checkbox-column text-center"> Id </th>
            <th class="text-center" width="350"> Name </th>
            <th class="text-center">Child</th>
            <th class="text-center">Status</th>
            <th class="text-center">Slug</th>
            <th class="text-center">Chi tiết</th>
            <th class="text-center dt-no-sorting">Action</th>
        </tr>
    </thead>
    <tbody id="load">
        @foreach($cates as $c => $item)
        @if($item->role == 0)
        <tr>
            <td class="checkbox-column text-center"> {{$loop->iteration}} </td>
            <td class="text-center">{{$item->name}}</td>
            <td class="text-center">{{ count($item->child) }}</td>
            @if($item->status == 1)
                <td class="text-center"><a onclick="return status({{$item->id}})" href="javascript:;"><span class="shadow-none badge badge-success">ON</span></a></td>
            @else
                <td class="text-center"><a onclick="return editStatus({{$item->id}})" href="javascript:;"><span class="shadow-none badge badge-danger">OFF</span></a></td>
            @endif
            <script>
                function status(id){
                    let status_id = id;
                        $_token = "{{ csrf_token() }}";
                        let index = 1;
                        $.ajax({
                            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                            url:`{{url('admin/danh-muc/xoastatus/${status_id}')}}`,
                            type: 'GET',
                            cache: false,
                            data: { '_token': $_token, 'id':status_id }, //see the $_token
                            success: function(response) {
                            var response = JSON.parse(response);
                            console.log(response);
                            $('#load').empty();
                            response.forEach(element=>{
                            let ele_id = element['id'];
                            let count = (element['child']).length;
                            if(element['role'] == 0){
                                $('#load').append(`
                                <tr>
                                    <td class="checkbox-column text-center">${index++}</td>
                                    <td class="text-center">${element['name']}</td>
                                    <td class="text-center">${count}</td>
                                    <td class="text-center">
                                        ${
                                    element['status'] == 1 ? `<a onclick="return status(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-success">ON</span></a>`:
                                        `<a onclick="return editStatus(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-danger">OFF</span></a>`
                                }
                                    </td>
                                     <td class="text-center">
                                        ${element['slug']}
                                    </td>
                                                        <td class="text-center">
                                    ${count>0 ? `<a href="{{url('admin/danh-muc/child/${ele_id}')}}">Danh mục con</a>`:'Null'}
                                    </td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="{{url('admin/danh-muc/edit/${ele_id}')}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                            <li><a onclick="return remove(${ele_id})" href="javascript:;" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            `);
                            }
                        });
                            }
                        });
                }
                function editStatus(id){
                    const status_id = id;
                    $_token = "{{ csrf_token() }}";
                        let index = 1;
                        $.ajax({
                            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                            url:`{{url('admin/danh-muc/editstatus/${status_id}')}}`,
                            type: 'GET',
                            cache: false,
                            data: { '_token': $_token }, //see the $_token
                            success: function(response) {
                            var response = JSON.parse(response);
                            console.log(response);
                            $('#load').empty();
                            response.forEach(element=>{
                            let ele_id = element['id'];
                            let count = (element['child']).length;
                                if(element['role'] == 0){
                                    $('#load').append(`
                                <tr>
                                    <td class="checkbox-column text-center">${index++}</td>
                                    <td class="text-center">${element['name']}</td>
                                    <td class="text-center">${count}</td>
                                    <td class="text-center">
                                        ${
                                        element['status'] == 1 ? `<a onclick="return status(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-success">ON</span></a>`:
                                            `<a onclick="return editStatus(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-danger">OFF</span></a>`
                                    }
                                    </td>
                                    <td class="text-center">
                                        ${element['slug']}
                                    </td>
                                    <td class="text-center">
                                        ${count>0 ? `<a href="{{url('admin/danh-muc/child/${ele_id}')}}">Danh mục con</a>`:'Null'}
                                    </td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="{{url('admin/danh-muc/edit/${ele_id}')}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                            <li><a onclick="return remove(${ele_id})" href="javascript:;" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            `);
                                }
                        });
                            }
                        });
                }
            </script>
            <td class="text-center">
                {{$item->slug}}
            </td>
            @if(count($item->child) > 0)
            <td class="text-center">
                <a href="{{url('admin/danh-muc/child/'.$item->id)}}">Danh mục con</a>
            </td>
            @else
                <td class="text-center">
                   Null
                </td>
            @endif

            <td class="text-center">
                <ul class="table-controls">
                    <li><a href="{{url('admin/danh-muc/edit/'.$item->id)}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                    <li><a onclick="return remove({{$item->id}})" href="javascript:;" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                </ul>
            </td>
            <script>
                function remove(id){
                    const remove_id = id;
                    $_token = "{{ csrf_token() }}";
                        let index = 1;
                        $.ajax({
                            headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                            url:`{{url('admin/danh-muc/remove/${remove_id}')}}`,
                            type: 'GET',
                            cache: false,
                            data: { '_token': $_token}, //see the $_token
                            success: function(response) {
                            var response = JSON.parse(response);
                            console.log(response);
                            $('#load').empty();
                            response.forEach(element=>{
                            let ele_id = element['id'];
                            let count = (element['child']).length;
                            if(element['role'] == 0){
                                $('#load').append(`
                                <tr>
                                    <td class="checkbox-column text-center">${index++}</td>
                                    <td class="text-center">${element['name']}</td>
                                    <td class="text-center">${count}</td>
                                    <td class="text-center">
                                        ${
                                    element['status'] == 1 ? `<a onclick="return status(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-success">ON</span></a>`:
                                        `<a onclick="return editStatus(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-danger">OFF</span></a>`
                                }
                                    </td>
                                    <td class="text-center">
                                        ${element['slug']}
                                    </td>
                                    <td class="text-center">
                                        ${count>0 ? `<a href="{{url('admin/danh-muc/child/${ele_id}')}}">Danh mục con</a>`:'Null'}
                                    </td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="{{url('admin/danh-muc/edit/${ele_id}')}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                            <li><a onclick="return remove(${ele_id})" href="javascript:;" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            `);
                            }
                        });
                            }
                        });
                }
            </script>
        </tr>
        @endif
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
