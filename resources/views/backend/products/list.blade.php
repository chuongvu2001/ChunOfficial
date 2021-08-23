@extends('backend.layouts.main')
@section('title','Hiển thị sản phẩm')
@section('bread')
    <ul class="navbar-nav flex-row">
        <li>
            <div class="page-header">
                <nav class="breadcrumb-one" aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{url('admin/san-pham')}}">Sản phẩm</a></li>
                        {{--                        <li class="breadcrumb-item active" aria-current="page"><span>Edit-Cate</span></li>--}}
                    </ol>
                </nav>

            </div>
        </li>
    </ul>
@endsection
@section('content')
    <table id="style-3" class="table style-3  table-hover">
        <a href="{{url('admin/san-pham/add')}}" class="btn btn-primary">Thêm sản phẩm</a>
        <thead>
        <tr>
            <th class="checkbox-column text-center"> Id </th>
            <th class="text-center"> Name </th>
            <th class="text-center">Image</th>
            <th class="text-center">Price</th>
            <th class="text-center">Price_sale</th>
            <th class="text-center">Sku</th>
            <th class="text-center">Cate_id</th>
            <th class="text-center">Brand</th>
            <th class="text-center">Specifications</th>
            <th class="text-center">Status</th>
            <th class="text-center dt-no-sorting">Action</th>
        </tr>
        </thead>
        <tbody id="load">
        @foreach($products as $p => $item)
                <tr>
                    <td class="checkbox-column text-center"> {{$loop->iteration}} </td>
                    <td class="text-center">{{$item->name}}</td>
                    <td class="text-center">
                        <span><img src="{{$item->image}}" class="profile-img" alt="image"></span>
                    </td>
                    <td class="text-center">{{$item->price}}</td>
                    <td class="text-center">{{$item->price_sale}}</td>
                    <td class="text-center">{{$item->sku}}</td>
                    <td class="text-center">{{$item->category->name}}</td>
                    <td class="text-center">{{$item->brand}}</td>

                    <td class="text-center"><a href="{{url('admin/san-pham/chi-tiet/'.$item->id)}}">Chi tiết</a></td>
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
                                url:`{{url('admin/san-pham/xoa-status/${status_id}')}}`,
                                type: 'GET',
                                cache: false,
                                data: { '_token': $_token, 'id':status_id }, //see the $_token
                                success: function(response) {
                                    var response = JSON.parse(response);
                                    $('#load').empty();
                                    response.forEach(element=>{

                                        let ele_id = element['id'];
                                        let image = element['image'];
                                            $('#load').append(`
                                <tr>
                                    <td class="checkbox-column text-center">${index++}</td>
                                    <td class="text-center">${element['name']}</td>
                                    <td class="text-center">
                                        <span><img src="${image}" class="profile-img" alt="image"></span>
                                    </td>

                                    <td class="text-center">${element['price']}</td>
                                    <td class="text-center">${element['price_sale']? element['price_sale'] : 'null'}</td>
                                    <td class="text-center">${element['sku']}</td>
                                    <td class="text-center">${element['category']['name']}</td>
                                    <td class="text-center">${element['brand']}</td>

                                    <td class="text-center"><a href="{{url('admin/san-pham/chi-tiet/${ele_id}')}}">Chi tiết</a></td>
                                    <td class="text-center">
                                        ${
                                                element['status'] == 1 ? `<a onclick="return status(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-success">ON</span></a>`:
                                                    `<a onclick="return editStatus(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-danger">OFF</span></a>`
                                            }
                                    </td>

                                    <td class="text-center">
                                        <ul class="table-controls">
                                        <li><a href="javascript:;" data-toggle="modal" onclick="show(${ele_id})" data-target="#modalQuickView" class="bs-tooltip"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a></li>
                                            <li><a href="{{url('admin/san-pham/edit/${ele_id}')}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                            <li><a onclick="return remove(${ele_id})" href="javascript:;" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            `);
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
                                url:`{{url('admin/san-pham/edit-status/${status_id}')}}`,
                                type: 'GET',
                                cache: false,
                                data: { '_token': $_token,'id':status_id }, //see the $_token
                                success: function(response) {
                                    var response = JSON.parse(response);
                                    $('#load').empty();
                                    response.forEach(element=>{
                                        let ele_id = element['id'];
                                        let image = element['image'];
                                        $('#load').append(`
                                <tr>
                                    <td class="checkbox-column text-center">${index++}</td>
                                    <td class="text-center">${element['name']}</td>
                                    <td class="text-center">
                                        <span><img src="${image}" class="profile-img" alt="image"></span>
                                    </td>

                                    <td class="text-center">${element['price']}</td>
                                    <td class="text-center">${element['price_sale']? element['price_sale'] : 'null'}</td>
                                    <td class="text-center">${element['sku']}</td>
                                    <td class="text-center">${element['category']['name']}</td>
                                    <td class="text-center">${element['brand']}</td>

                                    <td class="text-center"><a href="{{url('admin/san-pham/chi-tiet/${ele_id}')}}">Chi tiết</a></td>
                                    <td class="text-center">
                                        ${
                                            element['status'] == 1 ? `<a onclick="return status(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-success">ON</span></a>`:
                                                `<a onclick="return editStatus(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-danger">OFF</span></a>`
                                        }
                                    </td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="javascript:;" data-toggle="modal" onclick="show(${ele_id})" data-target="#modalQuickView" class="bs-tooltip"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a></li>
                                            <li><a href="{{url('admin/san-pham/edit/${ele_id}')}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                            <li><a onclick="return remove(${ele_id})" href="javascript:;" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            `);
                                    });
                                }
                            });
                        }
                    </script>
                    <script>
                        function show(id){
                            $_token = "{{ csrf_token() }}";
                            const pro_id = id;
                            $.ajax({
                                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                                url:`{{url('admin/san-pham/show')}}`,
                                type: 'GET',
                                cache: false,
                                data: { '_token': $_token,'pro_id':id }, //see the $_token
                                success: function(response) {
                                    var element = JSON.parse(response);
                                    // console.log(element['product_new']);

                                    let product = element['product'];
                                    let product_new = element['product_new'];
                                    // console.log(product_new);
                                    // var result = Object.keys(product_new).map((key) => [String(key), product_new[key]]);
                                    // console.log(result);
                                    let image = element['product']['image'];
                                    let thumbnail1 = element['product']['thumbnail1'];
                                    let thumbnail2 = element['product']['thumbnail2'];
                                    let thumbnail3 = element['product']['thumbnail3'];
                                    $('.modal-body').empty();
                                    $('.modal-body').append(`
                                         <div class="row">
                                        <div class="col-lg-5">
                                            <!--Carousel Wrapper-->
                                            <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails"
                                                 data-ride="carousel">
                                                <!--Slides-->
                                                <div class="carousel-inner" role="listbox">

                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100"
                                                             src="${image}"
                                                             alt="First slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100"
                                                             src="${image}"
                                                             alt="Second slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100"
                                                             src="${image}"
                                                             alt="Third slide">
                                                    </div>
                                                      <div class="carousel-item">
                                                        <img class="d-block w-100"
                                                             src="${image}"
                                                             alt="Third slide">
                                                    </div>
                                                </div>
                                                <!--/.Slides-->
                                                <!--Controls-->
                                                <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                                <!--/.Controls-->
                                                <ol class="carousel-indicators">
                                                    <li data-target="#carousel-thumb" data-slide-to="0" class="active">
                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/img%20(23).jpg" width="60">
                                                    </li>
                                                    <li data-target="#carousel-thumb" data-slide-to="1">
                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/img%20(24).jpg" width="60">
                                                    </li>
                                                    <li data-target="#carousel-thumb" data-slide-to="2">
                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/img%20(25).jpg" width="60">
                                                    </li>
                                                </ol>
                                            </div>
                                            <!--/.Carousel Wrapper-->
                                        </div>
                                        <div class="col-lg-7">
                                            <div class="card-body">
                                                <h2 class="h2-responsive product-name">
                                                <strong>${element['product']['name']}</strong>
                                                </h2>
                                                ${element['product']['price_sale']? `<h4 class="h4-responsive">

                                                      <span class="green-text">
                                                        <strong>${element['product']['price_sale']}</strong>
                                                      </span>
                                                    <span class="grey-text">
                                                        <small>
                                                          <s>${product['price']}</s>
                                                        </small>
                                                    </span>
                                                </h4>`: `
                                                    <span class="green-text">
                                                        <strong>${product['price']}</strong>
                                                      </span>

                                                `}
                                            </div>
                                                <div class="card-body params">
                                                <p>Mô tả: ${product['short']}</p>
                                                <p>Thương hiệu: ${product['brand']}</p>
                                                <p>SKU: ${product['sku']}</p>
                                                <p class="category">Danh mục: ${product['category']['name']}</p>
                                          </div>
                                            <!-- Add to Cart -->
                                            <div class="card-body">
                                                <div class="row">
                                                     <table id="multi-column-ordering" class="table table-hover" >
                                                <thead>
                                                    <tr>
                                                        <th>Color</th>
                                                        <th>Size</th>
                                                        <th>Amount</th>

                                                    </tr>
                                                </thead>
                                                ${ product_new.forEach(element=>
                                                    {
                                                    // const arr = Object.values(element);
                                                    // console.log(element['color_name']);
                                                        return`
                                                         <tfoot>
                                                            <tr>
                                                                <th>${element['color_name']}</th>
                                                                <th>${element['size_name']}</th>
                                                                <th>${element['amount']}</th>
                                                            </tr>
                                                         </tfoot>
                                                            `
                                                    })
                                                }
                                            </table>
                                                </div>
                                                <div class="text-center">
                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                </div>
                                            </div>
                                            <!-- /.Add to Cart -->
                                        </div>
                                    </div>
                                    `)
                                }
                            });
                        }
                    </script>




                    <!-- Modal: modalQuickView -->
                    <div class="modal fade" id="modalQuickView" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                         aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-body">
                                    <div class="row">
                                        <div class="col-lg-5">
                                            <!--Carousel Wrapper-->
                                            <div id="carousel-thumb" class="carousel slide carousel-fade carousel-thumbnails"
                                                 data-ride="carousel">
                                                <!--Slides-->
                                                <div class="carousel-inner" role="listbox">
                                                    <div class="carousel-item active">
                                                        <img class="d-block w-100"
                                                             src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/img%20(23).jpg"
                                                             alt="First slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100"
                                                             src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/img%20(24).jpg"
                                                             alt="Second slide">
                                                    </div>
                                                    <div class="carousel-item">
                                                        <img class="d-block w-100"
                                                             src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/img%20(25).jpg"
                                                             alt="Third slide">
                                                    </div>
                                                </div>
                                                <!--/.Slides-->
                                                <!--Controls-->
                                                <a class="carousel-control-prev" href="#carousel-thumb" role="button" data-slide="prev">
                                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Previous</span>
                                                </a>
                                                <a class="carousel-control-next" href="#carousel-thumb" role="button" data-slide="next">
                                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                    <span class="sr-only">Next</span>
                                                </a>
                                                <!--/.Controls-->
                                                <ol class="carousel-indicators">
                                                    <li data-target="#carousel-thumb" data-slide-to="0" class="active">
                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/img%20(23).jpg" width="60">
                                                    </li>
                                                    <li data-target="#carousel-thumb" data-slide-to="1">
                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/img%20(24).jpg" width="60">
                                                    </li>
                                                    <li data-target="#carousel-thumb" data-slide-to="2">
                                                        <img src="https://mdbootstrap.com/img/Photos/Horizontal/E-commerce/Vertical/img%20(25).jpg" width="60">
                                                    </li>
                                                </ol>
                                            </div>
                                            <!--/.Carousel Wrapper-->
                                        </div>
                                        <div class="col-lg-7">
                                            <h2 class="h2-responsive product-name">
                                                <strong>Product Name</strong>
                                            </h2>
                                            <h4 class="h4-responsive">
                                                  <span class="green-text">
                                                    <strong>$49</strong>
                                                  </span>
                                                <span class="grey-text">
                                                    <small>
                                                      <s>$89</s>
                                                    </small>
                                                </span>
                                            </h4>

                                            <!--Accordion wrapper-->
                                            <div class="accordion md-accordion" id="accordionEx" role="tablist" aria-multiselectable="true">

                                                <!-- Accordion card -->
                                                <div class="card">

                                                    <!-- Card header -->
                                                    <div class="card-header" role="tab" id="headingOne1">
                                                        <a data-toggle="collapse" data-parent="#accordionEx" href="#collapseOne1" aria-expanded="true"
                                                           aria-controls="collapseOne1">
                                                            <h5 class="mb-0">
                                                                Collapsible Group Item #1 <i class="fas fa-angle-down rotate-icon"></i>
                                                            </h5>
                                                        </a>
                                                    </div>

                                                    <!-- Card body -->
                                                    <div id="collapseOne1" class="collapse show" role="tabpanel" aria-labelledby="headingOne1"
                                                         data-parent="#accordionEx">
                                                        <div class="card-body">
                                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                                            squid. 3
                                                            wolf moon officia aute,
                                                            non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- Accordion card -->

                                                <!-- Accordion card -->
                                                <div class="card">

                                                    <!-- Card header -->
                                                    <div class="card-header" role="tab" id="headingTwo2">
                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseTwo2"
                                                           aria-expanded="false" aria-controls="collapseTwo2">
                                                            <h5 class="mb-0">
                                                                Collapsible Group Item #2 <i class="fas fa-angle-down rotate-icon"></i>
                                                            </h5>
                                                        </a>
                                                    </div>

                                                    <!-- Card body -->
                                                    <div id="collapseTwo2" class="collapse" role="tabpanel" aria-labelledby="headingTwo2"
                                                         data-parent="#accordionEx">
                                                        <div class="card-body">
                                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                                            squid. 3
                                                            wolf moon officia aute,
                                                            non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- Accordion card -->

                                                <!-- Accordion card -->
                                                <div class="card">

                                                    <!-- Card header -->
                                                    <div class="card-header" role="tab" id="headingThree3">
                                                        <a class="collapsed" data-toggle="collapse" data-parent="#accordionEx" href="#collapseThree3"
                                                           aria-expanded="false" aria-controls="collapseThree3">
                                                            <h5 class="mb-0">
                                                                Collapsible Group Item #3 <i class="fas fa-angle-down rotate-icon"></i>
                                                            </h5>
                                                        </a>
                                                    </div>

                                                    <!-- Card body -->
                                                    <div id="collapseThree3" class="collapse" role="tabpanel" aria-labelledby="headingThree3"
                                                         data-parent="#accordionEx">
                                                        <div class="card-body">
                                                            Anim pariatur cliche reprehenderit, enim eiusmod high life accusamus terry richardson ad
                                                            squid. 3
                                                            wolf moon officia aute,
                                                            non cupidatat skateboard dolor brunch. Food truck quinoa nesciunt laborum eiusmod.
                                                        </div>
                                                    </div>

                                                </div>
                                                <!-- Accordion card -->
                                            </div>
                                            <!-- Accordion wrapper -->


                                            <!-- Add to Cart -->
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-6">

                                                        <select class="md-form mdb-select colorful-select dropdown-primary">
                                                            <option value="" disabled selected>Choose your option</option>
                                                            <option value="1">White</option>
                                                            <option value="2">Black</option>
                                                            <option value="3">Pink</option>
                                                        </select>
                                                        <label>Select color</label>

                                                    </div>
                                                    <div class="col-md-6">
                                                        <select class="md-form mdb-select colorful-select dropdown-primary">
                                                            <option value="" disabled selected>Choose your option</option>
                                                            <option value="1">XS</option>
                                                            <option value="2">S</option>
                                                            <option value="3">L</option>
                                                        </select>
                                                        <label>Select size</label>

                                                    </div>
                                                </div>
                                                <div class="text-center">

                                                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                                    <button class="btn btn-primary">Add to cart
                                                        <i class="fas fa-cart-plus ml-2" aria-hidden="true"></i>
                                                    </button>
                                                </div>
                                            </div>
                                            <!-- /.Add to Cart -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    <td class="text-center">
                        <ul class="table-controls">
                            <li><a href="javascript:;" data-toggle="modal" onclick="return show({{$item->id}})" data-target="#modalQuickView" class="bs-tooltip"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a></li>
                            <li><a href="{{url('admin/san-pham/edit/'.$item->id)}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                            <li><a onclick="return remove({{$item->id}})" href="javascript:;" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                        </ul>
                    </td>
                    <script>
                        function remove(id){
                            $_token = "{{ csrf_token() }}";
                            let index = 1;
                            $.ajax({
                                headers: { 'X-CSRF-Token' : $('meta[name=_token]').attr('content') },
                                url:`{{url('admin/san-pham/delete')}}`,
                                type: 'GET',
                                cache: false,
                                data: { '_token': $_token, 'id':id }, //see the $_token
                                success: function(response) {
                                    var response = JSON.parse(response);
                                    $('#load').empty();
                                    response.forEach(element=>{
                                        let ele_id = element['id'];
                                        let image = element['image'];
                                        $('#load').append(`
                                <tr>
                                    <td class="checkbox-column text-center">${index++}</td>
                                    <td class="text-center">${element['name']}</td>
                                    <td class="text-center">
                                        <span><img src="${image}" class="profile-img" alt="image"></span>
                                    </td>

                                    <td class="text-center">${element['price']}</td>
                                    <td class="text-center">${element['price_sale']? element['price_sale'] : 'null'}</td>
                                    <td class="text-center">${element['sku']}</td>
                                    <td class="text-center">${element['category']['name']}</td>
                                    <td class="text-center">${element['brand']}</td>

                                    <td class="text-center"><a href="{{url('admin/san-pham/chi-tiet/${ele_id}')}}">Chi tiết</a></td>
                                    <td class="text-center">
                                        ${
                                            element['status'] == 1 ? `<a onclick="return status(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-success">ON</span></a>`:
                                                `<a onclick="return editStatus(${ele_id})" href="javascript:;"><span class="shadow-none badge badge-danger">OFF</span></a>`
                                        }
                                    </td>
                                    <td class="text-center">
                                        <ul class="table-controls">
                                            <li><a href="javascript:;" data-toggle="modal" onclick="show(${ele_id})" data-target="#modalQuickView" class="bs-tooltip"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-eye"><path d="M1 12s4-8 11-8 11 8 11 8-4 8-11 8-11-8-11-8z"></path><circle cx="12" cy="12" r="3"></circle></svg></a></li>
                                            <li><a href="{{url('admin/san-pham/edit/${ele_id}')}}" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Edit"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-edit-2 p-1 br-6 mb-1"><path d="M17 3a2.828 2.828 0 1 1 4 4L7.5 20.5 2 22l1.5-5.5L17 3z"></path></svg></a></li>
                                            <li><a onclick="return remove(${ele_id})" href="javascript:;" class="bs-tooltip" data-toggle="tooltip" data-placement="top" title="" data-original-title="Delete"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-trash p-1 br-6 mb-1"><polyline points="3 6 5 6 21 6"></polyline><path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path></svg></a></li>
                                        </ul>
                                    </td>
                                </tr>
                            `);
                                    });
                                }
                            });
                        }
                    </script>
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
