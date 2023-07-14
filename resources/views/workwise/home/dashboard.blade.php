@extends('workwise.layouts.master')

@section('style')
    <link rel="stylesheet" href="/workwise/css/dashboard/style.css">
@endsection

@section('main-content')
    <main>
        <div class="main-section">
            <div class="container-fluid">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-3 col-md-4 pd-left-none no-pd">
                            <div class="main-left-sidebar no-margin">
                                <div class="user-data full-width">
                                    <div class="user-profile">
                                        <div class="username-dt">
                                            <div class="usr-pic">
                                                <img src="{{ Auth::user()->userInfo->CheckEmptyImage('/workwise/images/resources/user-pic.png') }}"
                                                    alt>
                                            </div>
                                        </div>
                                        <div class="user-specs">
                                            <h3>{!! Auth::user()->name !!}</h3>
                                            <span>{{ Auth::user()->userInfo->nick_name_user }}</span>
                                        </div>
                                    </div>
                                    <ul class="user-fw-status">
                                        <li>
                                            <h4>Bạn bè LOL</h4>
                                            <span>34</span>
                                        </li>
                                        <li>
                                            <h4>Theo dõi</h4>
                                            <span>155</span>
                                        </li>
                                        <li>
                                            <a href="my-profile.html" title>Xem trang cá nhân</a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="suggestions full-width">
                                    <div class="sd-title">
                                        <h3>Suggestions</h3>
                                        <i class="la la-ellipsis-v"></i>
                                    </div>
                                    <div class="suggestions-list">
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s1.png" alt>
                                            <div class="sgt-text">
                                                <h4>Jessica William</h4>
                                                <span>Graphic Designer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s2.png" alt>
                                            <div class="sgt-text">
                                                <h4>John Doe</h4>
                                                <span>PHP Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s3.png" alt>
                                            <div class="sgt-text">
                                                <h4>Poonam</h4>
                                                <span>Wordpress Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s4.png" alt>
                                            <div class="sgt-text">
                                                <h4>Bill Gates</h4>
                                                <span>C & C++ Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s5.png" alt>
                                            <div class="sgt-text">
                                                <h4>Jessica William</h4>
                                                <span>Graphic Designer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s6.png" alt>
                                            <div class="sgt-text">
                                                <h4>John Doe</h4>
                                                <span>PHP Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="view-more">
                                            <a href="#" title>View More</a>
                                        </div>
                                    </div>
                                </div>
                                <div class="tags-sec full-width">
                                    <ul>
                                        <li><a href="#" title>Help Center</a></li>
                                        <li><a href="#" title>About</a></li>
                                        <li><a href="#" title>Privacy Policy</a></li>
                                        <li><a href="#" title>Community Guidelines</a></li>
                                        <li><a href="#" title>Cookies Policy</a></li>
                                        <li><a href="#" title>Career</a></li>
                                        <li><a href="#" title>Language</a></li>
                                        <li><a href="#" title>Copyright Policy</a></li>
                                    </ul>
                                    <div class="cp-sec">
                                        <img src="/workwise/images/logo2.png" alt>
                                        <p><img src="/workwise/images/cp.png" alt>Copyright 2019</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8 no-pd">
                            <div class="main-ws-sec">
                                <div class="post-topbar">
                                    <div class="user-picy">
                                        <img src="{{ Auth::user()->userInfo->CheckEmptyImage('/workwise/images/resources/user-pic.png') }}"
                                            alt>
                                        <span> <b class="bold-name"> {!! Auth::user()->name !!} </b> ơi, bạn đang nghĩ gì thế
                                            ?</span>
                                    </div>
                                    <div class="post-st">
                                        <ul>
                                            <li><a class="post_project active" href="#" title>Tạo bài viết</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="posts-section">
                                    @if (isset($posts))
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="{{ $posts[0]->user->userInfo->CheckEmptyImage('/workwise/images/resources/user-pic.png') }}" class="avatar-user-post" alt>
                                                    <div class="usy-name">
                                                        <h3 class="fw-bold">{!! $posts[0]->title !!}</h3>
                                                        <span class="created-post" data-bs-toggle="tooltip" data-placement="bottom" 
                                                                title="{{ $posts[0]->getTime() }}">
                                                            <img src="/workwise/images/clock.png" alt>{{ $posts[0]->format_date }}
                                                        </span>
                                                    </div>
                                                </div>
                                                @can('setting', $posts[0])
                                                    <div class="ed-opts">
                                                        <a href="" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li>
                                                                <a href="#" class="edit-post setting-post" data-post="{{ $posts[0]->id }}" title>
                                                                    <i class="la la-pencil icon-setting-post mr-1"></i> Chỉnh sửa bài viết
                                                                </a>
                                                            </li>
                                                            <li>
                                                                <a href="{{ route('post.destroy') }}" class="delete-post setting-post" data-post="{{ $posts[0]->id }}">
                                                                <i class="la la-trash-o icon-setting-post mr-1"></i> Chuyển vào thùng rác
                                                                </a>
                                                            </li>
                                                            <li><a href="#" title>Chỉnh sửa đối tượng</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                @endcan
                                            </div>
                                            <div class="job_descp">
                                                <div class="wrp-get-content">
                                                        @if ($posts[0]->background_post)
                                                            <div style="background-image:url('{{ $posts[0]->background_post }}')" class="background-post">
                                                                {!! nl2br($posts[0]->content) !!}
                                                            </div>
                                                        @else
                                                            <p id="content">
                                                                {!! nl2br($posts[0]->content) !!}
                                                            </p>
                                                            @php
                                                                $countImage = count($posts[0]->images);
                                                            @endphp
                                                            @if($countImage > 0)
                                                            @php
                                                                $divImage = 0;
                                                            @endphp
                                                                <div class="row list-image-of-post">
                                                                    {{-- Dạng 1 ảnh --}}
                                                                    @if ($countImage == 1 || $countImage == 2)
                                                                        @php
                                                                            $divideImage = (int) 12/$countImage;
                                                                        @endphp
                                                                        @foreach ($posts[0]->images as $image)
                                                                            <div class="col-{{$divideImage}} p-0">
                                                                                <a href="{{ $image->image_url }}" data-lightbox="roadtrip">
                                                                                    <img class="image-posts type-one-image-{{$divideImage}}" src="{{ $image->image_url }}" alt="">
                                                                                </a>
                                                                            </div>
                                                                        @endforeach

                                                                    {{-- Dạng 3  4 ảnh --}}
                                                                    @elseif($countImage == 3 || $countImage == 4)
                                                                        @php
                                                                            $divideImage = (int) 12/($countImage - 1);
                                                                        @endphp
                                                                        <div class="col-12 p-0">
                                                                            <a href="{{ $posts[0]->images[0]->image_url }}" data-lightbox="roadtrip">
                                                                                <img class="image-posts type-one-image-12" src="{{ $posts[0]->images[0]->image_url }}" alt="">
                                                                            </a>
                                                                        </div>
                                                                        @for ($index = 1 ; $index < $countImage; $index++)
                                                                            <div class="col-{{$divideImage}} p-0">
                                                                                <a href="{{ $posts[0]->images[$index]->image_url }}" data-lightbox="roadtrip">
                                                                                    <img class="image-posts type-one-image-6" src="{{ $posts[0]->images[$index]->image_url }}" alt="">
                                                                                </a>
                                                                            </div>
                                                                        @endfor

                                                                    {{-- Dạng 5 ảnh --}}
                                                                    @elseif($countImage >= 5)
                                                                        <div class="col-6 p-0">
                                                                            @for ($index = 0 ; $index < 2; $index++)
                                                                                <a href="{{ $posts[0]->images[$index]->image_url }}" data-lightbox="roadtrip">
                                                                                    <img class="image-posts image-list1" src="{{ $posts[0]->images[$index]->image_url }}" alt="">
                                                                                </a>
                                                                            @endfor
                                                                        </div>
                                                                        <div class="col-6 p-0">
                                                                            @for ($index = 2 ; $index < 5; $index++)
                                                                            <a href="{{ $posts[0]->images[$index]->image_url }}" data-lightbox="roadtrip">
                                                                                <img class="image-posts image-list2" src="{{ $posts[0]->images[$index]->image_url }}" alt="">
                                                                            </a>
                                                                            @endfor
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            @endif
                                                        @endif
                                                </div>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="fas fa-heart"></i> Like</a>
                                                        <img src="/workwise/images/liked-img.png" alt>
                                                        <span>25</span>
                                                    </li>
                                                    <li><a href="#" class="com"><i
                                                                class="fas fa-comment-alt"></i>
                                                            Comment 15</a></li>
                                                </ul>
                                                <a href="#"><i class="fas fa-eye"></i>Views 50</a>
                                            </div>
                                        </div>
                                    @endif
                                    <div class="process-comm">
                                        <div class="spinner">
                                            <div class="bounce1"></div>
                                            <div class="bounce2"></div>
                                            <div class="bounce3"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-3 pd-right-none no-pd">
                            <div class="right-sidebar">
                                <div class="widget widget-about">
                                    <img src="/workwise/images/wd-logo.png" alt>
                                    <h3>Track Time on Workwise</h3>
                                    <span>Pay only for the Hours worked</span>
                                    <div class="sign_link">
                                        <h3><a href="sign-in.html" title>Sign up</a></h3>
                                        <a href="#" title>Learn More</a>
                                    </div>
                                </div>
                                <div class="widget widget-jobs">
                                    <div class="sd-title">
                                        <h3>Top Jobs</h3>
                                        <i class="la la-ellipsis-v"></i>
                                    </div>
                                    <div class="jobs-list">
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Senior Product Designer</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                                            </div>
                                            <div class="hr-rate">
                                                <span>$25/hr</span>
                                            </div>
                                        </div>
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Senior UI / UX Designer</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                                            </div>
                                            <div class="hr-rate">
                                                <span>$25/hr</span>
                                            </div>
                                        </div>
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Junior Seo Designer</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                                            </div>
                                            <div class="hr-rate">
                                                <span>$25/hr</span>
                                            </div>
                                        </div>
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Senior PHP Designer</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                                            </div>
                                            <div class="hr-rate">
                                                <span>$25/hr</span>
                                            </div>
                                        </div>
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Senior Developer Designer</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                                            </div>
                                            <div class="hr-rate">
                                                <span>$25/hr</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget widget-jobs">
                                    <div class="sd-title">
                                        <h3>Most Viewed This Week</h3>
                                        <i class="la la-ellipsis-v"></i>
                                    </div>
                                    <div class="jobs-list">
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Senior Product Designer</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                                            </div>
                                            <div class="hr-rate">
                                                <span>$25/hr</span>
                                            </div>
                                        </div>
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Senior UI / UX Designer</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                                            </div>
                                            <div class="hr-rate">
                                                <span>$25/hr</span>
                                            </div>
                                        </div>
                                        <div class="job-info">
                                            <div class="job-details">
                                                <h3>Junior Seo Designer</h3>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit..</p>
                                            </div>
                                            <div class="hr-rate">
                                                <span>$25/hr</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="widget suggestions full-width">
                                    <div class="sd-title">
                                        <h3>Most Viewed People</h3>
                                        <i class="la la-ellipsis-v"></i>
                                    </div>
                                    <div class="suggestions-list">
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s1.png" alt>
                                            <div class="sgt-text">
                                                <h4>Jessica William</h4>
                                                <span>Graphic Designer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s2.png" alt>
                                            <div class="sgt-text">
                                                <h4>John Doe</h4>
                                                <span>PHP Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s3.png" alt>
                                            <div class="sgt-text">
                                                <h4>Poonam</h4>
                                                <span>Wordpress Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s4.png" alt>
                                            <div class="sgt-text">
                                                <h4>Bill Gates</h4>
                                                <span>C &amp; C++ Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s5.png" alt>
                                            <div class="sgt-text">
                                                <h4>Jessica William</h4>
                                                <span>Graphic Designer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="suggestion-usd">
                                            <img src="/workwise/images/resources/s6.png" alt>
                                            <div class="sgt-text">
                                                <h4>John Doe</h4>
                                                <span>PHP Developer</span>
                                            </div>
                                            <span><i class="la la-plus"></i></span>
                                        </div>
                                        <div class="view-more">
                                            <a href="#" title>View More</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
    {{-- Start form tạo bài viết --}}
        @include('workwise.posts.create')
    {{-- End form tạo bài viết --}}

    {{-- Start form chỉnh sửa bài viết --}}
        @include('workwise.posts.update')
    {{-- End form chỉnh sửa bài viết --}}
    <div class="chatbox-list">
        <div class="chatbox">
            <div class="chat-mg">
                <a href="#" title><img src="/workwise/images/resources/usr-img1.png" alt></a>
                <span>2</span>
            </div>
            <div class="conversation-box">
                <div class="con-title mg-3">
                    <div class="chat-user-info">
                        <img src="/workwise/images/resources/us-img1.png" alt>
                        <h3>John Doe <span class="status-info"></span></h3>
                    </div>
                    <div class="st-icons">
                        <a href="#" title><i class="la la-cog"></i></a>
                        <a href="#" title class="close-chat"><i class="la la-minus-square"></i></a>
                        <a href="#" title class="close-chat"><i class="la la-close"></i></a>
                    </div>
                </div>
                <div class="chat-hist mCustomScrollbar" data-mcs-theme="dark">
                    <div class="chat-msg">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget
                            malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
                        <span>Sat, Aug 23, 1:10 PM</span>
                    </div>
                    <div class="date-nd">
                        <span>Sunday, August 24</span>
                    </div>
                    <div class="chat-msg st2">
                        <p>Cras ultricies ligula.</p>
                        <span>5 minutes ago</span>
                    </div>
                    <div class="chat-msg">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget
                            malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
                        <span>Sat, Aug 23, 1:10 PM</span>
                    </div>
                </div>
                <div class="typing-msg">
                    <form>
                        <textarea placeholder="Type a message here"></textarea>
                        <button type="submit"><i class="fa fa-send"></i></button>
                    </form>
                    <ul class="ft-options">
                        <li><a href="#" title><i class="la la-smile-o"></i></a></li>
                        <li><a href="#" title><i class="la la-camera"></i></a></li>
                        <li><a href="#" title><i class="fa fa-paperclip"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="chatbox">
            <div class="chat-mg">
                <a href="#" title><img src="/workwise/images/resources/usr-img2.png" alt></a>
            </div>
            <div class="conversation-box">
                <div class="con-title mg-3">
                    <div class="chat-user-info">
                        <img src="/workwise/images/resources/us-img1.png" alt>
                        <h3>John Doe <span class="status-info"></span></h3>
                    </div>
                    <div class="st-icons">
                        <a href="#" title><i class="la la-cog"></i></a>
                        <a href="#" title class="close-chat"><i class="la la-minus-square"></i></a>
                        <a href="#" title class="close-chat"><i class="la la-close"></i></a>
                    </div>
                </div>
                <div class="chat-hist mCustomScrollbar" data-mcs-theme="dark">
                    <div class="chat-msg">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget
                            malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
                        <span>Sat, Aug 23, 1:10 PM</span>
                    </div>
                    <div class="date-nd">
                        <span>Sunday, August 24</span>
                    </div>
                    <div class="chat-msg st2">
                        <p>Cras ultricies ligula.</p>
                        <span>5 minutes ago</span>
                    </div>
                    <div class="chat-msg">
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec rutrum congue leo eget
                            malesuada. Vivamus suscipit tortor eget felis porttitor.</p>
                        <span>Sat, Aug 23, 1:10 PM</span>
                    </div>
                </div>
                <div class="typing-msg">
                    <form>
                        <textarea placeholder="Type a message here"></textarea>
                        <button type="submit"><i class="fa fa-send"></i></button>
                    </form>
                    <ul class="ft-options">
                        <li><a href="#" title><i class="la la-smile-o"></i></a></li>
                        <li><a href="#" title><i class="la la-camera"></i></a></li>
                        <li><a href="#" title><i class="fa fa-paperclip"></i></a></li>
                    </ul>
                </div>
            </div>
        </div>
        <div class="chatbox">
            <div class="chat-mg bx">
                <a href="#" title><img src="/workwise/images/chat.png" alt></a>
                <span>2</span>
            </div>
            <div class="conversation-box">
                <div class="con-title">
                    <h3>Messages</h3>
                    <a href="#" title class="close-chat"><i class="la la-minus-square"></i></a>
                </div>
                <div class="chat-list">
                    <div class="conv-list active">
                        <div class="usrr-pic">
                            <img src="/workwise/images/resources/usy1.png" alt>
                            <span class="active-status activee"></span>
                        </div>
                        <div class="usy-info">
                            <h3>John Doe</h3>
                            <span>Lorem ipsum dolor <img src="/workwise/images/smley.png" alt></span>
                        </div>
                        <div class="ct-time">
                            <span>1:55 PM</span>
                        </div>
                        <span class="msg-numbers">2</span>
                    </div>
                    <div class="conv-list">
                        <div class="usrr-pic">
                            <img src="/workwise/images/resources/usy2.png" alt>
                        </div>
                        <div class="usy-info">
                            <h3>John Doe</h3>
                            <span>Lorem ipsum dolor <img src="/workwise/images/smley.png" alt></span>
                        </div>
                        <div class="ct-time">
                            <span>11:39 PM</span>
                        </div>
                    </div>
                    <div class="conv-list">
                        <div class="usrr-pic">
                            <img src="/workwise/images/resources/usy3.png" alt>
                        </div>
                        <div class="usy-info">
                            <h3>John Doe</h3>
                            <span>Lorem ipsum dolor <img src="/workwise/images/smley.png" alt></span>
                        </div>
                        <div class="ct-time">
                            <span>0.28 AM</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/script/posts/index.js"></script>
    <script src="/script/posts/update.js"></script>
    <script src="/script/posts/delete.js"></script>
@endsection
