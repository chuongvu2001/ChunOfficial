<!DOCTYPE html>
<html lang="en">

<!-- Mirrored from designreset.com/cork/ltr/demo3/table_dt_custom.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 14:49:04 GMT -->
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{csrf_token()}}">
    <title>@yield('title','Ghi chú')</title>
    <link rel="icon" type="image/x-icon" href="{{asset('assets/logo/c-clothes-1.png')}}" style="width: 100%"/>
    <link href="{{asset('assets/css/loader.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('assets/js/loader.js')}}"></script>
    <!-- BEGIN GLOBAL MANDATORY STYLES -->
    <link href="https://fonts.googleapis.com/css?family=Nunito:400,600,700" rel="stylesheet">
    <link href="{{asset('bootstrap/css/bootstrap.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/plugins.css')}}" rel="stylesheet" type="text/css" />
    <!-- END GLOBAL MANDATORY STYLES -->

    <!-- BEGIN PAGE LEVEL CUSTOM STYLES -->
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/datatables.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/dt-global_style.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/table/datatable/custom_dt_custom.css')}}">
    <link href="{{asset('assets/css/components/cards/card.css')}}" rel="stylesheet" type="text/css" />
    <!-- END PAGE LEVEL CUSTOM STYLES -->
    <link href="{{asset('plugins/animate/animate.css')}}" rel="stylesheet" type="text/css" />
    <script src="{{asset('plugins/sweetalerts/promise-polyfill.js')}}"></script>
    <link href="{{asset('plugins/sweetalerts/sweetalert2.min.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('plugins/sweetalerts/sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/components/custom-sweetalert.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/apps/notes.css')}}" rel="stylesheet" type="text/css" />
    <link href="{{asset('assets/css/forms/theme-checkbox-radio.css')}}" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tiny.cloud/1/jf5oe0cyu1cbd53hcoc5qut5q4kihnsgyugioeixs4ris6w9/tinymce/5/tinymce.min.js" referrerpolicy="origin"></script>
</head>

<body>

<!--  BEGIN NAVBAR  -->
@include('backend.layouts.navbar')

<!--  END NAVBAR  -->

<!--  BEGIN NAVBAR  -->
<div class="sub-header-container">
    <header class="header navbar navbar-expand-sm">
        <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></a>

        <ul class="navbar-nav flex-row">
            <li>
                <div class="page-header">

                    <nav class="breadcrumb-one" aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0);">Apps</a></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>Notes</span></li>
                        </ol>
                    </nav>

                </div>
            </li>
        </ul>
    </header>
</div>
<!--  END NAVBAR  -->

<!--  BEGIN MAIN CONTAINER  -->
<div class="main-container" id="container">

    <div class="overlay"></div>
    <div class="search-overlay"></div>

    <!--  BEGIN SIDEBAR  -->
@include('backend.layouts.sidebar')
    <!--  END SIDEBAR  -->

    <!--  BEGIN CONTENT AREA  -->
    <div id="content" class="main-content">
        <div class="layout-px-spacing">

            <div class="row app-notes layout-top-spacing" id="cancel-row">
                <div class="col-lg-12">
                    <div class="app-hamburger-container">
                        <div class="hamburger"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-menu chat-menu d-xl-none"><line x1="3" y1="12" x2="21" y2="12"></line><line x1="3" y1="6" x2="21" y2="6"></line><line x1="3" y1="18" x2="21" y2="18"></line></svg></div>
                    </div>

                    <div class="app-container">

                        <div class="app-note-container">

                            <div class="app-note-overlay"></div>

                            <div class="tab-title">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 col-12 text-center">
                                        <a href="javascript:;" class="btn btn-primary btn-rounded " data-toggle="modal" data-target="#modalContactForm">
                                            Add
                                        </a>
                                    </div>
                                    <div class="col-md-12 col-sm-12 col-12 mt-5">
                                        <ul class="nav nav-pills d-block" id="pills-tab3" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link list-actions" onclick="myFavourAll(0)" href="javascript:;" id="all-notes"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit"><path d="M11 4H4a2 2 0 0 0-2 2v14a2 2 0 0 0 2 2h14a2 2 0 0 0 2-2v-7"></path><path d="M18.5 2.5a2.121 2.121 0 0 1 3 3L12 15l-4 1 1-4 9.5-9.5z"></path></svg> Tất cả</a>
                                            </li>
                                            <script>
                                                function myFavourAll(id){
                                                    $_token = "{{ csrf_token() }}";
                                                    let index = 1;
                                                    $.ajax({
                                                        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                                        url: `{{url('admin/ghi-chu/favourite')}}`,
                                                        type: 'GET',
                                                        cache: false,
                                                        data: {'favouriteAll':id,'_token': $_token}, //see the $_token
                                                        success: function (response) {
                                                            var response = JSON.parse(response);
                                                            console.log(response);
                                                            $('.note-container').empty();
                                                            response.forEach(element => {

                                                                let ele_id = element['id'];
                                                                let d = new Date(element['created_at']);
                                                                let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                                                                let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
                                                                let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                                                                let favourite = element['favourite'];
                                                                $('.note-container').append(`
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
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" onclick="myDelete(${ele_id})" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 delete-note"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
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
                                                                                                <a class="note-personal label-group-item label-personal dropdown-item position-relative g-dot-personal"  onclick="editstatus(${ele_id},1)" href="javascript:void(0);"> Cá nhân</a>
                                                                                                <a class="note-work label-group-item label-work dropdown-item position-relative g-dot-work" onclick="editstatus(${ele_id},2)" href="javascript:void(0);"> Công việc</a>
                                                                                                <a class="note-social label-group-item label-social dropdown-item position-relative g-dot-social" onclick="editstatus(${ele_id},3)" href="javascript:void(0);"> Xã hội</a>
                                                                                                <a class="note-important label-group-item label-important dropdown-item position-relative g-dot-important" onclick="editstatus(${ele_id},4)" href="javascript:void(0);"> Quan trọng</a>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                    `);
                                                            });

                                                        }
                                                    });
                                                }

                                            </script>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions" onclick="myFa(1)" href="javascript:;" id="note-fav"><svg xmlns="http://www.w3.org/2000/svg"  width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg> Nổi bật</a>
                                            </li>
                                            <script>
                                                function myFa(id){
                                                    $_token = "{{ csrf_token() }}";
                                                    let index = 1;
                                                    $.ajax({
                                                        headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                                        url: `{{url('admin/ghi-chu/favourite')}}`,
                                                        type: 'GET',
                                                        cache: false,
                                                        data: {'favourite':id,'_token': $_token}, //see the $_token
                                                        success: function (response) {
                                                            var response = JSON.parse(response);
                                                            console.log(response);
                                                            $('.note-container').empty();
                                                            response.forEach(element => {

                                                                let ele_id = element['id'];
                                                                let d = new Date(element['created_at']);
                                                                let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                                                                let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
                                                                let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                                                                let favourite = element['favourite'];
                                                                $('.note-container').append(`
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
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  onclick="myDelete(${ele_id})" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 delete-note"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
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
                                                            });

                                                        }
                                                    });
                                                }

                                            </script>
                                        </ul>

                                        <hr/>

                                        <p class="group-section"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-tag"><path d="M20.59 13.41l-7.17 7.17a2 2 0 0 1-2.83 0L2 12V2h10l8.59 8.59a2 2 0 0 1 0 2.82z"></path><line x1="7" y1="7" x2="7" y2="7"></line></svg> Tags</p>

                                        <ul class="nav nav-pills d-block group-list" id="pills-tab" role="tablist">
                                            <li class="nav-item">
                                                <a class="nav-link list-actions g-dot-primary" href="javascript:;" onclick="person(1)" id="note-personal">Cá nhân</a>
                                                <script>
                                                    function person(id){
                                                        $_token = "{{ csrf_token() }}";
                                                        let index = 1;
                                                        $.ajax({
                                                            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                                            url: `{{url('admin/ghi-chu/tags')}}`,
                                                            type: 'GET',
                                                            cache: false,
                                                            data: {'personn':id,'_token': $_token}, //see the $_token
                                                            success: function (response) {
                                                                var response = JSON.parse(response);
                                                                // console.log(response);
                                                                $('.note-container').empty();
                                                                response.forEach(element => {
                                                                    let ele_id = element['id'];
                                                                    let d = new Date(element['created_at']);
                                                                    let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                                                                    let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
                                                                    let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                                                                    let favourite = element['favourite'];
                                                                    $('.note-container').append(`
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
                                                                });

                                                            }
                                                        });
                                                    }

                                                </script>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions g-dot-warning" href="javascript:;"  onclick="person(2)" id="note-work">Công việc</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions g-dot-success" id="note-social" href="javascript:;"  onclick="person(3)">Xã hội</a>
                                            </li>
                                            <li class="nav-item">
                                                <a class="nav-link list-actions g-dot-danger" id="note-important" href="javascript:;"  onclick="person(4)">Quan trọng</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="row d-flex justify-content-end ">
                                    {!! $notes->links() !!}
                                </div>
                            </div>


                            <div id="ct" class="note-container note-grid">

                                @foreach($notes as $n => $item)
                                    <div class="note-item all-notes @if($item->favourite == 1)  note-fav @endif @if($item->status == 1) note-personal @elseif($item->status == 2) note-work @elseif($item->status == 3) note-social @elseif($item->status == 4) note-important @endif">
                                        <div class="note-inner-content">
                                            <div class="note-content">
                                                <p class="note-title" data-noteTitle="Meeting with Kelly">{{$item->title}}</p>
                                                <p class="meta-time">{{$item->created_at->format('d/m/Y')}}</p>
                                                <div class="note-description-content">
                                                    <p class="note-description" data-noteDescription="Curabitur facilisis vel elit sed dapibus sodales purus rhoncus.">{!! $item->short !!}</p>
                                                </div>
                                            </div>
                                            <div class="note-action">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" onclick="myFavourite({{$item->id}})" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-star fav-note"><polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon></svg>
                                                <script>
                                                  function myFavourite(id){
                                                      $_token = "{{ csrf_token() }}";
                                                      let index = 1;
                                                      $.ajax({
                                                          headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                                          url: `{{url('admin/ghi-chu/favourite')}}`,
                                                          type: 'GET',
                                                          cache: false,
                                                          data: {'id':id,'_token': $_token}, //see the $_token
                                                          success: function (response) {
                                                              var response = JSON.parse(response);
                                                              console.log(response);
                                                              $('.note-container').empty();
                                                              response.forEach(element => {

                                                                  let ele_id = element['id'];
                                                                  let d = new Date(element['created_at']);
                                                                  let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                                                                  let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
                                                                  let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                                                                  let favourite = element['favourite'];
                                                                    $('.note-container').append(`
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
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"  onclick="myDelete(${ele_id})" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 delete-note"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
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
                                                              });

                                                          }
                                                      });
                                                    }
                                                </script>
                                                <script>
                                                    function myDelete(id){
                                                        $_token = "{{ csrf_token() }}";
                                                        let index = 1;
                                                        $.ajax({
                                                            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                                            url: `{{url('admin/ghi-chu/delete')}}`,
                                                            type: 'GET',
                                                            cache: false,
                                                            data: {'id':id,'_token': $_token}, //see the $_token
                                                            success: function (response) {
                                                                var response = JSON.parse(response);
                                                                console.log(response);
                                                                $('.note-container').empty();

                                                                response.forEach(element => {

                                                                    let ele_id = element['id'];
                                                                    let d = new Date(element['created_at']);
                                                                    let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                                                                    let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
                                                                    let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                                                                    let favourite = element['favourite'];
                                                                    $('.note-container').append(`
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
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"  onclick="myDelete(${ele_id})" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 delete-note"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
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
                                                                });

                                                            }
                                                        });
                                                    }
                                                </script>
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" onclick="myDelete({{$item->id}})" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 delete-note"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
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
                                                    <script>
                                                        function editstatus(id,status){
                                                            $_token = "{{ csrf_token() }}";
                                                            let index = 1;
                                                            $.ajax({
                                                                headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                                                url: `{{url('admin/ghi-chu/status')}}`,
                                                                type: 'GET',
                                                                cache: false,
                                                                data: {'id':id,'status':status,'_token': $_token}, //see the $_token
                                                                success: function (response) {
                                                                    var response = JSON.parse(response);
                                                                    console.log(response);
                                                                    $('.note-container').empty();
                                                                    response.forEach(element => {

                                                                        let ele_id = element['id'];
                                                                        let d = new Date(element['created_at']);
                                                                        let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                                                                        let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
                                                                        let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                                                                        let favourite = element['favourite'];
                                                                        $('.note-container').append(`
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
                                                                                        <svg xmlns="http://www.w3.org/2000/svg" width="24"  onclick="myDelete(${ele_id})" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash-2 delete-note"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path><line x1="10" y1="11" x2="10" y2="17"></line><line x1="14" y1="11" x2="14" y2="17"></line></svg>
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
                                                                    });

                                                                }
                                                            });
                                                        }
                                                    </script>
                                                    <div class="dropdown-menu dropdown-menu-right d-icon-menu">
                                                        <a class="note-personal label-group-item label-personal dropdown-item position-relative g-dot-personal" href="javascript:void(0);"  onclick="editstatus({{$item->id}},1)"> Cá nhân</a>
                                                        <a class="note-work label-group-item label-work dropdown-item position-relative g-dot-work" href="javascript:void(0);" onclick="editstatus({{$item->id}},2)"> Công việc</a>
                                                        <a class="note-social label-group-item label-social dropdown-item position-relative g-dot-social" href="javascript:void(0);" onclick="editstatus({{$item->id}},3)"> Xã hội</a>
                                                        <a class="note-important label-group-item label-important dropdown-item position-relative g-dot-important" href="javascript:void(0);" onclick="editstatus({{$item->id}},4)"> Quan trọng</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach


                            </div>

                        </div>

                    </div>

                    <div class="modal fade" id="modalContactForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog" role="document">
                            <div class="modal-content">
                                <div class="modal-header text-center">
                                    <h4 class="modal-title w-100 font-weight-bold">Thêm ghi chú</h4>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <script>
                                    function addNote(){
                                        $_token = "{{ csrf_token() }}";
                                        const title = $('#form34').val();
                                        const short = $('#form8').val();
                                        let index = 1;
                                        $.ajax({
                                            headers: {'X-CSRF-Token': $('meta[name=_token]').attr('content')},
                                            url: `{{url('admin/ghi-chu/add-note')}}`,
                                            type: 'POST',
                                            cache: false,
                                            data: {'title':title,'short':short,'_token': $_token}, //see the $_token
                                            success: function (response) {
                                                var element = JSON.parse(response);
                                                // console.log(data['title']);
                                                // $('.note-container').empty();
                                                    $('.modal').css('display','none');
                                                    $('.modal-backdrop').removeClass('show');
                                                    $('.modal-backdrop').removeClass('fade');
                                                    $('.modal-backdrop').removeClass('modal-backdrop');
                                                let ele_id = element['id'];
                                                    let d = new Date(element['created_at']);
                                                    let ye = new Intl.DateTimeFormat('en', { year: 'numeric' }).format(d);
                                                    let mo = new Intl.DateTimeFormat('en', { month: '2-digit' }).format(d);
                                                    let da = new Intl.DateTimeFormat('en', { day: '2-digit' }).format(d);
                                                    let favourite = element['favourite'];
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
                                    <form action="javascript:;" method="post" onsubmit="addNote()">
                                        <div class="md-form mb-5">
                                            <i class="fas fa-user prefix grey-text"></i>
                                            <label data-error="wrong" data-success="right" for="form34">Tiêu đề</label>
                                            <input type="text" id="form34" name="title" class="form-control validate">
                                        </div>
                                        <div class="md-form">
                                            <i class="fas fa-pencil prefix grey-text"></i>
                                            <label data-error="wrong" data-success="right" for="form8">Mô tả</label>
                                            <textarea type="text" id="form8" name="short" class="md-textarea form-control" rows="4"></textarea>
                                        </div>
                                        <div class="modal-footer d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary btn-models">Add <i class="fas fa-paper-plane-o ml-1"></i></button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
        <div class="footer-wrapper">
            <div class="footer-section f-section-1">
                <p class="">Copyright © 2021 <a target="_blank" href="https://designreset.com/">DesignReset</a>, All rights reserved.</p>
            </div>
            <div class="footer-section f-section-2">
                <p class="">Coded with <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-heart"><path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path></svg></p>
            </div>
        </div>
    </div>
    <!--  END CONTENT AREA  -->

</div>
<!-- END MAIN CONTAINER -->

<!-- BEGIN GLOBAL MANDATORY SCRIPTS -->
@include('backend.layouts.script')
<!-- END GLOBAL MANDATORY SCRIPTS -->

<!-- BEGIN PAGE LEVEL SCRIPTS -->
<script src="{{asset('assets/js/ie11fix/fn.fix-padStart.js')}}"></script>
<script src="{{asset('assets/js/apps/notes.js')}}"></script>
<!-- END PAGE LEVEL SCRIPTS -->
</body>

<!-- Mirrored from designreset.com/cork/ltr/demo3/apps_notes.html by HTTrack Website Copier/3.x [XR&CO'2014], Tue, 01 Jun 2021 14:46:48 GMT -->
</html>
