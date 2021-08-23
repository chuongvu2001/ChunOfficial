@extends('frontend.layout.main')

@section('title','Chun.Official - '.$cate_name)
@section('content')
    <section class="banner bg-parallax banner-blog">
        <div class="overlay"></div>
        <div class="container">
            <div class="banner-content text-center">
                <h2 class="page-title">BLOG RIGHT SIDE BAR</h2>
                <div class="breadcrumbs">
                    <a href="#">Home</a>
                    <span>BLOG RIGHT SIDE BAR</span>
                </div>
            </div>
        </div>
    </section>
    <div class="maincontainer">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 main-content">
                    <div class="blog-list">
                        @foreach($news as $n => $item)
                        <article class="blog-item">
                            <div class="post-format">
                                <figure><img alt="" src="{{$item->image}}" height="450px" style="object-fit: cover" width="100%"></figure>
                                <span class="icon-post"><i class="fa fa-image"></i></span>
                            </div>
                            <h3><a href="{{url('news/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank">{{$item->title}}</a></h3>
                            <div class="post-cat"><a href="#">{{$item->get_cate->name}}</a></div>
                            <div class="content-post">{!! substr($item->shorts, 0, 130) !!}...</div>
                            <div class="meta-post">
                                <div class="date-post">{{date("d-m-Y", strtotime($item->created_at))}}</div>
                                <div class="like-post"><a href="javascript:;"><i class="fa fa-heart-o"></i>{{$item->like}}</a></div>
{{--                                <div class="comment-post"><a href="#"><i class="fa fa-comments-o"></i>68</a></div>--}}
                            </div>
                        </article>
                        @endforeach
                        <nav class="pagination">
                            <ul>
                                <li class="active"><a href="#">1</a></li>
                                <li><a href="#">2</a></li>
                                <li><a href="#">3</a></li>
                                <li><a href="#">4</a></li>
                                <li><a href="#">5</a></li>
                                <li><a href="#">Next</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
                <div class="col-md-3 col-sm-4 sidebar">
                    <div class="widget widget_categories">
                        <h2 class="widget-title">Chuyên mục</h2>
                        <ul class="product-categories">
                            @foreach($cates_news as $c => $item)
                                @if($item->status == 1)
                                    <li class="cat-parent current-cat-parent">
                                        <a href="{{url($item->slug.'/'.$item->id.'.html')}}" target="_blank">{{$item->name}}</a>
                                        @if(count($item->child) > 0)
                                            <ul class="children">
                                                @foreach($item->child as $ch => $item)
                                                    <li class="current-cat"><a href="{{url($item->slug.'/'.$item->id.'.html')}}" target="_blank">{{$item->name}}</a></li>
                                                @endforeach
                                            </ul>
                                        @endif
                                    </li>
                                @endif
                            @endforeach
                        </ul>
                    </div>
                    <div class="widget leka-recentpost">
                        <h2 class="widget-title">tin nổi bật</h2>
                        <ul class="recent_posts_list">
                            @foreach($news_top as $t => $item)
                            <li>
								<span class="post-img">
									<a href="{{url('news/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank">
										<img src="{{$item->image}}" alt="">
									</a>
								</span>
                                <h3 class="post-title"><a href="{{url('news/'.$item->slug.'/'.$item->id.'.html')}}" target="_blank">{{substr($item->title, 0, 45)}}...</a></h3>
                                <div class="post-cat"><a href="#">{{$item->get_cate->name}}</a></div>
                            </li>
                          @endforeach
                        </ul>
                    </div>
                    <div class="widget leka-photoflick">
                        <h2 class="widget-title">Theo dõi</h2>
                        <ul class="list-photo">
                            <li><a href="javascript:;"><img src="{{asset('frontend/images/flick1.png')}}" alt=""></a></li>
                            <li><a href="javascript:;"><img src="{{asset('frontend/images/flick2.png')}}" alt=""></a></li>
                            <li><a href="javascript:;"><img src="{{asset('frontend/images/flick3.png')}}" alt=""></a></li>
                            <li><a href="javascript:;"><img src="{{asset('frontend/images/flick4.png')}}" alt=""></a></li>
                            <li><a href="javascript:;"><img src="{{asset('frontend/images/flick5.png')}}" alt=""></a></li>
                            <li><a href="javascript:;"><img src="{{asset('frontend/images/flick6.png')}}" alt=""></a></li>
                        </ul>
                    </div>
                    <div class="widget widget_tag_cloud">
                        <h2 class="widget-title">TAGS</h2>
                        <div class="tagcloud">
                            @foreach($news_tag as $t=>$item)
                                <a href="#">{{$item->get_cate->name}}</a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('page-script')

@endsection


