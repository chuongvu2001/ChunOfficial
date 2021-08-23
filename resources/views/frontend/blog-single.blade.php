@extends('frontend.layout.main')

@section('title','Chun.Official - '.$new->title)

@section('content')
    <section class="banner bg-parallax banner-blog">
        <div class="overlay"></div>
        <div class="container">
            <div class="banner-content text-center">
                <h2 class="page-title">BLOG 3 COLUMNS</h2>
                <div class="breadcrumbs">
                    <a href="#">Home</a>
                    <span>BLOG 3 COLUMNS</span>
                </div>
            </div>
        </div>
    </section>
    <div class="maincontainer">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-8 main-content">
                    <div class="blog-single">
                        <article class="blog-item">
                            <div class="post-format post-sile owl-carousel" data-nav="true" data-items="1" data-margin="0" data-dots="false">
                                <div class="item-image">
                                    <img src="{{$new->image}}" width="100%" height="450px" style="object-fit: cover" alt="">
                                </div>
                                <div class="item-image">
                                    <img src="{{$new->image2}}" width="100%" height="450px" style="object-fit: cover" alt="">
                                </div>
                            </div>
                            <h3><a href="javascript:;">{{$new->title}}</a></h3>
                            <div class="post-cat"><a href="#">{{$new->get_cate->name}}</a></div>
                            <div class="meta-post">
                                <div class="date-post"><span>{{date("d-m-Y", strtotime($new->created_at))}}</span><span>By <a href="javascript:;">{{$new->get_user->name}}</a></span></div>
                                <div class="like-post"><a href="#"><i class="fa fa-heart-o"></i>{{$new->like}}</a></div>
{{--                                <div class="comment-post"><a href="#"><i class="fa fa-comments-o"></i>68</a></div>--}}
                            </div>
                            <div class="content-post">
                                {!! $new->content !!}
                            </div>
                            <div class="bottom-post">
                                <div class="groupshare">
                                    <span>CHIA SẺ VỚI BẠN BÈ</span>
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                    </ul>
                                    <div id="fb-root"></div>
                                    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&appId=374846627650710&autoLogAppEvents=1" nonce="esPiou1w"></script>
                                    <div class="fb-like" data-href="{{url('news/'.$new->slug.'/'.$new->id.'.html')}}" data-width="50px" data-layout="button" data-action="like" data-size="small" data-share="true"></div>
                                </div>
                                <div class="tagcloud">
                                    <span>Tags</span>
                                    <a href="#">{{$new->get_cate->name}}</a>
                                </div>

                            </div>
                        </article>
                        <div class="leka-post-author">
                            <div class="author-img"><img class="avatar" src="{{$new->get_user->image}}" alt=""></div>
                            <div class="author-content">
                                <h3>Sáng tác bởi: <a rel="author" title="" href="javascript:;">{{$new->get_user->name}}</a></h3>
{{--                                <p>At vero eos et accusamus et iusto odio dignissimos ducimus qui blanditiis praesentium voluptatum deleniti atque corrupti quos dolores et quas molestias excepturi sint occaecati cupiditat</p>--}}
                                <div class="groupshare">
                                    <ul>
                                        <li><a href="#"><i class="fa fa-facebook"></i></a></li>
                                        <li><a href="#"><i class="fa fa-google-plus"></i></a></li>
                                        <li><a href="#"><i class="fa fa-twitter"></i></a></li>
                                        <li><a href="#"><i class="fa fa-pinterest-p"></i></a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="comments-area" id="comments">
                            <h3 class="comments-title">BÌNH LUẬN<i class="fa fa-chevron-down"></i></h3>
                            <div id="fb-root"></div>
                            <script async defer crossorigin="anonymous" src="https://connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v11.0&appId=374846627650710&autoLogAppEvents=1" nonce="xGVtTmxF"></script>
                            <div class="fb-comments" data-href="{{url('news/'.$new->slug.'/'.$new->id.'.html')}}" data-width="800" data-numposts="10"></div>
                        </div>

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
