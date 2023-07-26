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
                                                <img src="{{ Auth::user()->userInfo->CheckEmptyImage() }}" alt>
                                            </div>
                                        </div>
                                        <div class="user-specs">
                                            <h3>{!! Auth::user()->name !!}</h3>
                                            <span>{{ Auth::user()->userInfo->nick_name_user }}</span>
                                        </div>
                                    </div>
                                    <ul class="user-fw-status">
                                        <li>
                                            <h4>Bạn bè</h4>
                                            <span>{{ count(Auth::user()->friends) }}</span>
                                        </li>
                                        <li>
                                            <h4>Bài viết</h4>
                                            <span>{{ count(Auth::user()->posts) }}</span>
                                        </li>
                                        <li>
                                            <a href="{{ route('user.profile', Auth::user()->id) }}" title>Xem trang cá
                                                nhân</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-6 col-md-8 no-pd">
                            <div class="main-ws-sec">
                                <div class="post-topbar">
                                    <div class="user-picy">
                                        <img src="{{ Auth::user()->userInfo->CheckEmptyImage() }}" alt>
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
                                        @foreach ($posts as $post)
                                            <div class="post-bar">
                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <img src="{{ $post->user->userInfo->CheckEmptyImage() }}"
                                                            class="avatar-user-post" alt>
                                                        <div class="usy-name">
                                                            <h3 class="fw-bold">{!! $post->title !!}</h3>
                                                            <span class="created-post" data-bs-toggle="tooltip"
                                                                data-placement="bottom" title="{{ $post->getTime() }}">
                                                                <img src="/workwise/images/clock.png"
                                                                    alt>{{ $post->format_date }}
                                                            </span>
                                                        </div>
                                                    </div>
                                                    @can('setting', $post)
                                                        <div class="ed-opts">
                                                            <a href="" title class="ed-opts-open"><i
                                                                    class="la la-ellipsis-v"></i></a>
                                                            <ul class="ed-options">
                                                                <li>
                                                                    <a href="#" class="edit-post setting-post"
                                                                        data-post="{{ $post->id }}" title>
                                                                        <i class="la la-pencil icon-setting-post mr-1"></i>
                                                                        Chỉnh sửa bài viết
                                                                    </a>
                                                                </li>
                                                                <li>
                                                                    <a href="{{ route('post.destroy') }}"
                                                                        class="delete-post setting-post"
                                                                        data-post="{{ $post->id }}">
                                                                        <i class="la la-trash-o icon-setting-post mr-1"></i>
                                                                        Chuyển vào thùng rác
                                                                    </a>
                                                                </li>
                                                            </ul>
                                                        </div>
                                                    @endcan
                                                </div>
                                                <div class="job_descp">
                                                    <div class="wrp-get-content">
                                                        @if ($post->background_post)
                                                            <div style="background-image:url('{{ $post->background_post }}')"
                                                                class="background-post">
                                                                {!! nl2br($post->content) !!}
                                                            </div>
                                                        @else
                                                            <p id="content">
                                                                {!! nl2br($post->content) !!}
                                                            </p>
                                                            @php
                                                                $countImage = count($post->images);
                                                            @endphp
                                                            @if ($countImage > 0)
                                                                <div class="row list-image-of-post">
                                                                    {{-- Dạng 1 ảnh --}}
                                                                    @if ($countImage == 1 || $countImage == 2)
                                                                        @php
                                                                            $divideImage = (int) 12 / $countImage;
                                                                        @endphp
                                                                        @foreach ($post->images as $image)
                                                                            <div class="col-{{ $divideImage }} p-0">
                                                                                <a href="{{ $image->image_url }}"
                                                                                    data-lightbox="roadtrip-{{$post->id}}">
                                                                                    <img class="image-posts type-one-image-{{ $divideImage }}"
                                                                                        src="{{ $image->image_url }}"
                                                                                        alt="">
                                                                                </a>
                                                                            </div>
                                                                        @endforeach

                                                                        {{-- Dạng 3  4 ảnh --}}
                                                                    @elseif($countImage == 3 || $countImage == 4)
                                                                        @php
                                                                            $divideImage = (int) 12 / ($countImage - 1);
                                                                        @endphp
                                                                        <div class="col-12 p-0">
                                                                            <a href="{{ $post->images[0]->image_url }}"
                                                                                data-lightbox="roadtrip-{{$post->id}}">
                                                                                <img class="image-posts type-one-image-12"
                                                                                    src="{{ $post->images[0]->image_url }}"
                                                                                    alt="">
                                                                            </a>
                                                                        </div>
                                                                        @for ($index = 1; $index < $countImage; $index++)
                                                                            <div class="col-{{ $divideImage }} p-0">
                                                                                <a href="{{ $post->images[$index]->image_url }}"
                                                                                    data-lightbox="roadtrip-{{$post->id}}">
                                                                                    <img class="image-posts type-one-image-6"
                                                                                        src="{{ $post->images[$index]->image_url }}"
                                                                                        alt="">
                                                                                </a>
                                                                            </div>
                                                                        @endfor

                                                                        {{-- Dạng 5 ảnh --}}
                                                                    @elseif($countImage >= 5)
                                                                        <div class="col-6 p-0">
                                                                            @for ($index = 0; $index < 2; $index++)
                                                                                <a href="{{ $post->images[$index]->image_url }}"
                                                                                    data-lightbox="roadtrip-{{$post->id}}">
                                                                                    <img class="image-posts image-list1"
                                                                                        src="{{ $post->images[$index]->image_url }}"
                                                                                        alt="">
                                                                                </a>
                                                                            @endfor
                                                                        </div>
                                                                        <div class="col-6 p-0">
                                                                            @for ($index = 2; $index < 5; $index++)
                                                                                <a href="{{ $post->images[$index]->image_url }}"
                                                                                    data-lightbox="roadtrip-{{$post->id}}">
                                                                                    <img class="image-posts image-list2"
                                                                                        src="{{ $post->images[$index]->image_url }}"
                                                                                        alt="">
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
                                                        <li><a href="#"
                                                                class="com like_post {{ $post->checkUserLike() ? 'active_like' : '' }}"
                                                                data-id="{{ $post->id }}"><i class="fas fa-heart"></i>
                                                                Yêu thích <span
                                                                    class="number_post_like">{{ count($post->likes) }}</span></a>
                                                        </li>
                                                        <li><a href="#" class="com comment_post" data-toggle="modal"
                                                                data-target=".bd-example-modal-lg"
                                                                data-id="{{ $post->id }}">
                                                                <i class="fas fa-comment-alt"></i>
                                                                Bình luận {{ count($post->comments) }}</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                        @endforeach
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

    {{-- Start modal xem chi viết bài viết --}}
    @include('workwise.posts.show')
    {{-- End --}}
    
@endsection

@section('script')
    <script src="/script/posts/index.js"></script>
    <script src="/script/posts/update.js"></script>
    <script src="/script/posts/delete.js"></script>
    <script src="/script/posts/like.js"></script>
@endsection
