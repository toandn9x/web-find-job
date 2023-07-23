@extends('workwise.layouts.master', ['title' => 'Tran Dinh Nghia | WorkWise'])

@section('style')
    <link rel="stylesheet" href="/workwise/css/dashboard/style.css">
@endsection

@section('main-content')
    <section class="cover-sec">
        <div id="wrapper-default">
            <div class="wrp-confirm-change">
                <div class="wrp-text-notifi">
                    <span class="text-notificate">
                        <i class="la la-globe"></i> Ảnh bìa sẽ của bạn hiển thị công khai.
                    </span>
                </div>
                <div class="wrp-btn">
                    <button type="button" class="btn btn-sm btn-light btn-cancel">Hủy</button>
                    <button type="button" class="btn btn-sm btn-primary btn-agree">Lưu thay đổi</button>
                </div>
            </div>
        </div>
        @if ($user->userInfo->cover_image)
            <img id="cover-image" src="{{ $user->userInfo->url_cover_image }}" alt="NULL"
                data-old-image="{{ $user->userInfo->url_cover_image }}">
        @else
            <img id="cover-image" src="/workwise/images/cover_images/cover_image_empty.jpg" alt="NULL"
                data-old-image="/workwise/images/cover_images/cover_image_empty.jpg">
        @endif
        <div class="add-pic-box">
            <div class="container">
                <div class="row no-gutters">
                    @can('view', $user)
                        <div class="col-lg-12 col-sm-12">
                            <input type="file" id="file-change-cover-image">
                            <label id="btn-choose-cover-image">Chỉnh sửa ảnh bìa</label>
                        </div>
                    @endcan
                </div>
            </div>
        </div>
    </section>
    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-4">
                            <div class="main-left-sidebar">
                                <div class="user_profile">
                                    <div class="user-pro-img">
                                        <img src="{{ $user->userInfo->CheckEmptyImage() }}"
                                            alt id="avatar"
                                            data-old-avatar="{{ $user->userInfo->CheckEmptyImage() }}">
                                        @can('view', $user)
                                            <div class="add-dp" id="OpenImgUpload">
                                                <input type="file" id="file-change-avatar">
                                                <label id="btn-choose-avatar"><i class="fas fa-camera"></i></label>
                                            </div>
                                            <div class="wrp-btn-avatar">
                                                <button class="btn btn-sm btn-agree-avatar">Lưu</button>
                                                <button class="btn btn-sm btn-secondary btn-cancel-avatar">Hủy</button>
                                            </div>
                                        @endcan
                                    </div>
                                    <div class="user_pro_status">
                                        <ul class="flw-status">
                                            <li>
                                                <span>Bạn bè</span>
                                                <b>{{ count($user->friends) }}</b>
                                            </li>
                                            <li>
                                                <span>Bài viết</span>
                                                <b>{{ count($user->posts) }}</b>
                                            </li>
                                        </ul>
                                    </div>
                                    <ul class="social_links">
                                        <li><a href="#" title><i class="la la-globe"></i> www.example.com</a></li>
                                        <li><a href="#" title><i class="fa fa-facebook-square"></i>
                                                Http://www.facebook.com/john...</a></li>
                                        <li><a href="#" title><i class="fa fa-twitter"></i>
                                                Http://www.Twitter.com/john...</a></li>
                                        <li><a href="#" title><i class="fa fa-google-plus-square"></i>
                                                Http://www.googleplus.com/john...</a></li>
                                        <li><a href="#" title><i class="fa fa-behance-square"></i>
                                                Http://www.behance.com/john...</a></li>
                                        <li><a href="#" title><i class="fa fa-pinterest"></i>
                                                Http://www.pinterest.com/john...</a></li>
                                        <li><a href="#" title><i class="fa fa-instagram"></i>
                                                Http://www.instagram.com/john...</a></li>
                                        <li><a href="#" title><i class="fa fa-youtube"></i>
                                                Http://www.youtube.com/john...</a></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-8">
                            <div class="main-ws-sec">
                                <div class="user-tab-sec rewivew">
                                    <div class="d-flex justify-content-between">
                                        <h3>{!! $user->name !!}</h3>
                                        @can('view', $user)
                                            <div class="message-btn">
                                                <a href="{{ route('user.view-setting-profile', $user->id) }}" title><i class="fas fa-cog"></i>
                                                    Cài đặt</a>
                                            </div>
                                        @endcan
                                    </div>
                                    <div class="star-descp">
                                        <span>{{ $user->userInfo->nick_name_user }}</span>
                                    </div>
                                    <div class="tab-feed st2 settingjb">
                                        <ul>
                                            <li data-tab="feed-dd" class="active">
                                                <a href="#" title>
                                                    <img src="/workwise/images/ic1.png" alt>
                                                    <span>Bài viết</span>
                                                </a>
                                            </li>
                                            <li data-tab="info-dd">
                                                <a href="#" title>
                                                    <img src="/workwise/images/ic2.png" alt>
                                                    <span>Thông tin</span>
                                                </a>
                                            </li>
                                            <li data-tab="portfolio-dd">
                                                <a href="#" title>
                                                    <img src="/workwise/images/ic3.png" alt>
                                                    <span>Bạn bè</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                               
                                <div class="product-feed-tab current" id="feed-dd">
                                    <div class="posts-section">
                                        @foreach ($user->posts as $post)
                                            <div class="post-bar">
                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <img src="{{ $post->user->userInfo->CheckEmptyImage() }}"
                                                            class="avatar-user-post" alt>
                                                        <div class="usy-name">
                                                            <h3 class="fw-bold">{!! $post->title !!}</h3>
                                                            <span class="created-post" data-bs-toggle="tooltip"
                                                                data-placement="bottom"
                                                                title="{{ $post->getTime() }}">
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
                                                                {!! $post->content !!}
                                                            </div>
                                                        @else
                                                            <p id="content">
                                                                {!! $post->content !!}
                                                            </p>
                                                            @php
                                                                $countImage = count($post->images);
                                                            @endphp
                                                            @if ($countImage > 0)
                                                                @php
                                                                    $divImage = 0;
                                                                @endphp
                                                                <div class="row list-image-of-post">
                                                                    {{-- Dạng 1 ảnh --}}
                                                                    @if ($countImage == 1 || $countImage == 2)
                                                                        @php
                                                                            $divideImage = (int) 12 / $countImage;
                                                                        @endphp
                                                                        @foreach ($post->images as $image)
                                                                            <div class="col-{{ $divideImage }} p-0">
                                                                                <a href="{{ $image->image_url }}"
                                                                                    data-lightbox="roadtrip-{{ $post->id }}">
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
                                                                                data-lightbox="roadtrip-{{ $post->id }}">
                                                                                <img class="image-posts type-one-image-12"
                                                                                    src="{{ $post->images[0]->image_url }}"
                                                                                    alt="">
                                                                            </a>
                                                                        </div>
                                                                        @for ($index = 1; $index < $countImage; $index++)
                                                                            <div class="col-{{ $divideImage }} p-0">
                                                                                <a href="{{ $post->images[$index]->image_url }}"
                                                                                    data-lightbox="roadtrip-{{ $post->id }}">
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
                                                                                    data-lightbox="roadtrip-{{ $post->id }}">
                                                                                    <img class="image-posts image-list1"
                                                                                        src="{{ $post->images[$index]->image_url }}"
                                                                                        alt="">
                                                                                </a>
                                                                            @endfor
                                                                        </div>
                                                                        <div class="col-6 p-0">
                                                                            @for ($index = 2; $index < 5; $index++)
                                                                                <a href="{{ $post->images[$index]->image_url }}"
                                                                                    data-lightbox="roadtrip-{{ $post->id }}">
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
                                        <div class="process-comm">
                                            <div class="spinner">
                                                <div class="bounce1"></div>
                                                <div class="bounce2"></div>
                                                <div class="bounce3"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="product-feed-tab" id="info-dd">
                                    <div class="user-profile-ov st2">
                                        <h3>Thông tin</h3>
                                        <div class="mb-3">
                                            <h4 class="d-inline-block m-0">Biệt danh :</h4> <span class="w-0 float-none fs-3 text_style">{{ $user->userInfo->nick_name_user }}</span>
                                        </div>

                                        <div class="mb-3">
                                            <h4 class="d-inline-block m-0">Địa chỉ :</h4> <span class="w-0 float-none text_style">{{ $user->userInfo->address ?? "Đang cập nhật" }}</span>
                                        </div>

                                        <div class="mb-3">
                                            <h4 class="d-inline-block m-0">Giới tính :</h4> <span class="w-0 float-none text_style">{{ $user->userInfo->gender_text['text'] }}</span>
                                        </div>

                                        <div class="mb-3">
                                            <h4 class="d-inline-block m-0">Sinh nhật :</h4> <span class="w-0 float-none text_style">{{ $user->userInfo->birthday ? date('d-m-Y', strtotime($user->userInfo->birthday)) : 'Đang cập nhật' }}</span>
                                        </div>

                                        @if($user->userInfo->links)
                                            <div class="mb-3">
                                                <h4 class="d-inline-block m-0">Liên kết xã hội :</h4> 
                                                @foreach ($user->userInfo->links_url_json as $key => $val)
                                                    <a href="{{ $val }}" class="text_style d-block blockquote-footer mt-2" target="_blank">{{ $val }}</a>
                                                @endforeach
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                
                                <div class="product-feed-tab" id="portfolio-dd">
                                    <div class="portfolio-gallery-sec">
                                        <h3>Tất cả bạn bè</h3>
                                        <div class="gallery_pf">
                                            <div class="row">
                                                @if(count($user->friends) > 0)
                                                    @foreach ($user->friends as $friend)
                                                        <div class="col-lg-6 col-md-6 col-sm-6 col-6 mb-5">
                                                            <a href="{{ route('user.profile', $friend->id) }}" class="link_friend">
                                                                <div>
                                                                    <img src="{{ $friend->userInfo->CheckEmptyImage() }}" class="avatar_friend" width="60" height="60" alt="">
                                                                </div>
                                                                <div class="ml-2">
                                                                    <span class="name_friend">{{ $friend->name }}</span>
                                                                </div>
                                                            </a>
                                                        </div>
                                                    @endforeach
                                                @endif
                                            </div>
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
    @include('workwise.posts.update')
    
    {{-- Start modal xem chi viết bài viết --}}
    @include('workwise.posts.show')
    {{-- End --}}
@endsection

@section('script')
    <script src="/script/profile/index.js"></script>
    <script src="/script/posts/update.js"></script>
    <script src="/script/posts/like.js"></script>
@endsection
