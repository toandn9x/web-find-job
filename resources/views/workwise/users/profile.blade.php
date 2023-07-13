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
                    <div class="col-lg-12 col-sm-12">
                        <input type="file" id="file-change-cover-image">
                        <label id="btn-choose-cover-image">Chỉnh sửa ảnh bìa</label>
                    </div>
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
                                        <img src="{{ $user->userInfo->CheckEmptyImage('/workwise/images/resources/user-pro-img.png') }}"
                                            alt id="avatar"
                                            data-old-avatar="{{ $user->userInfo->CheckEmptyImage('/workwise/images/resources/user-pro-img.png') }}">
                                        <div class="add-dp" id="OpenImgUpload">
                                            <input type="file" id="file-change-avatar">
                                            <label id="btn-choose-avatar"><i class="fas fa-camera"></i></label>
                                        </div>
                                        <div class="wrp-btn-avatar">
                                            <button class="btn btn-sm btn-agree-avatar">Lưu</button>
                                            <button class="btn btn-sm btn-secondary btn-cancel-avatar">Hủy</button>
                                        </div>
                                    </div>
                                    <div class="user_pro_status">
                                        <ul class="flw-status">
                                            <li>
                                                <span>Ban be</span>
                                                <b>34</b>
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
                                        <div class="message-btn">
                                            <a href="{{ route('user.view-setting-profile', $user->id) }}" title><i class="fas fa-cog"></i>
                                                Cài đặt</a>
                                        </div>
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
                                                    <span>Info</span>
                                                </a>
                                            </li>
                                            <li data-tab="saved-jobs">
                                                <a href="#" title>
                                                    <img src="/workwise/images/ic4.png" alt>
                                                    <span>Jobs</span>
                                                </a>
                                            </li>
                                            <li data-tab="my-bids">
                                                <a href="#" title>
                                                    <img src="/workwise/images/ic5.png" alt>
                                                    <span>Bids</span>
                                                </a>
                                            </li>
                                            <li data-tab="portfolio-dd">
                                                <a href="#" title>
                                                    <img src="/workwise/images/ic3.png" alt>
                                                    <span>Portfolio</span>
                                                </a>
                                            </li>
                                            <li data-tab="rewivewdata">
                                                <a href="#" title>
                                                    <img src="/workwise/images/review.png" alt>
                                                    <span>Reviews</span>
                                                </a>
                                            </li>
                                            <li data-tab="payment-dd">
                                                <a href="#" title>
                                                    <img src="/workwise/images/ic6.png" alt>
                                                    <span>Payment</span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-feed-tab" id="saved-jobs">
                                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="mange-tab" data-toggle="tab" href="#mange"
                                                role="tab" aria-controls="home" aria-selected="true">Manage Jobs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="saved-tab" data-toggle="tab" href="#saved"
                                                role="tab" aria-controls="profile" aria-selected="false">Saved
                                                Jobs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="contact-tab" data-toggle="tab" href="#applied"
                                                role="tab" aria-controls="applied" aria-selected="false">Applied
                                                Jobs</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="cadidates-tab" data-toggle="tab" href="#cadidates"
                                                role="tab" aria-controls="contact" aria-selected="false">Applied
                                                cadidates</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="mange" role="tabpanel"
                                            aria-labelledby="mange-tab">
                                            <div class="posts-bar">
                                                <div class="post-bar bgclr">
                                                    <div class="wordpressdevlp">
                                                        <h2>Senior Wordpress Developer</h2>
                                                        <p><i class="la la-clock-o"></i>Posted on 30 August 2018</p>
                                                    </div>
                                                    <br>
                                                    <div class="row no-gutters">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="cadidatesbtn">
                                                                <button type="button" class="btn btn-primary">
                                                                    <span class="badge badge-light">3</span>Candidates
                                                                </button>
                                                                <a href="#">
                                                                    <i class="far fa-edit"></i>
                                                                </a>
                                                                <a href="#">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <ul class="bk-links bklink">
                                                                <li><a href="#" title><i
                                                                            class="la la-bookmark"></i></a></li>
                                                                <li><a href="#" title><i
                                                                            class="la la-envelope"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="posts-bar">
                                                <div class="post-bar bgclr">
                                                    <div class="wordpressdevlp">
                                                        <h2>Senior Php Developer</h2>
                                                        <p><i class="la la-clock-o"></i> Posted on 29 August 2018
                                                        </p>
                                                    </div>
                                                    <br>
                                                    <div class="row no-gutters">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="cadidatesbtn">
                                                                <button type="button" class="btn btn-primary">
                                                                    <span class="badge badge-light">3</span>Candidates
                                                                </button>
                                                                <a href="#">
                                                                    <i class="far fa-edit"></i>
                                                                </a>
                                                                <a href="#">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <ul class="bk-links bklink">
                                                                <li><a href="#" title><i
                                                                            class="la la-bookmark"></i></a></li>
                                                                <li><a href="#" title><i
                                                                            class="la la-envelope"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="posts-bar">
                                                <div class="post-bar bgclr">
                                                    <div class="wordpressdevlp">
                                                        <h2>Senior UI UX Designer</h2>
                                                        <div class="row no-gutters">
                                                            <div class="col-md-6 col-sm-12">
                                                                <p class="posttext"><i class="la la-clock-o"></i>Posted on
                                                                    5 June
                                                                    2018</p>
                                                            </div>
                                                            <div class="col-md-6 col-sm-12">
                                                                <p><i class="la la-clock-o"></i>Expiried on 5
                                                                    October 2018</p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <br>
                                                    <div class="row no-gutters">
                                                        <div class="col-md-6 col-sm-12">
                                                            <div class="cadidatesbtn">
                                                                <button type="button" class="btn btn-primary">
                                                                    <span class="badge badge-light">3</span>Candidates
                                                                </button>
                                                                <a href="#">
                                                                    <i class="far fa-trash-alt"></i>
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6 col-sm-12">
                                                            <ul class="bk-links bklink">
                                                                <li><a href="#" title><i
                                                                            class="la la-bookmark"></i></a></li>
                                                                <li><a href="#" title><i
                                                                            class="la la-envelope"></i></a></li>
                                                            </ul>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="saved" role="tabpanel"
                                            aria-labelledby="saved-tab">
                                            <div class="post-bar">
                                                <div class="p-all saved-post">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>Senior Wordpress Developer</h2>
                                                            <p><i class="la la-clock-o"></i>Posted on 30 August 2018
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Unsaved</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info saved-info">
                                                    <li>
                                                        <h3>Applicants</h3>
                                                        <p>10</p>
                                                    </li>
                                                    <li>
                                                        <h3>Job Type</h3>
                                                        <p>Full Time</p>
                                                    </li>
                                                    <li>
                                                        <h3>Salary</h3>
                                                        <p>$600 - Mannual</p>
                                                    </li>
                                                    <li>
                                                        <h3>Posted : 5 Days Ago</h3>
                                                        <p>Open</p>
                                                    </li>
                                                    <div class="devepbtn saved-btn">
                                                        <a class="clrbtn" href="#">Unsaved</a>
                                                        <a class="clrbtn" href="#">Message</a>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="post-bar">
                                                <div class="p-all saved-post">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>Senior PHP Developer</h2>
                                                            <p><i class="la la-clock-o"></i>Posted on 30 August 2018
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Unsaved</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info saved-info">
                                                    <li>
                                                        <h3>Applicants</h3>
                                                        <p>10</p>
                                                    </li>
                                                    <li>
                                                        <h3>Job Type</h3>
                                                        <p>Full Time</p>
                                                    </li>
                                                    <li>
                                                        <h3>Salary</h3>
                                                        <p>$600 - Mannual</p>
                                                    </li>
                                                    <li>
                                                        <h3>Posted : 5 Days Ago</h3>
                                                        <p>Open</p>
                                                    </li>
                                                    <div class="devepbtn saved-btn">
                                                        <a class="clrbtn" href="#">Unsaved</a>
                                                        <a class="clrbtn" href="#">Message</a>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="post-bar">
                                                <div class="p-all saved-post">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>UI UX Designer</h2>
                                                            <p><i class="la la-clock-o"></i>Posted on 30 August 2018
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Unsaved</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info saved-info">
                                                    <li>
                                                        <h3>Applicants</h3>
                                                        <p>10</p>
                                                    </li>
                                                    <li>
                                                        <h3>Job Type</h3>
                                                        <p>Full Time</p>
                                                    </li>
                                                    <li>
                                                        <h3>Salary</h3>
                                                        <p>$600 - Mannual</p>
                                                    </li>
                                                    <li>
                                                        <h3>Posted : 5 Days Ago</h3>
                                                        <p>Open</p>
                                                    </li>
                                                    <div class="devepbtn saved-btn">
                                                        <a class="clrbtn" href="#">Unsaved</a>
                                                        <a class="clrbtn" href="#">Message</a>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="applied" role="tabpanel"
                                            aria-labelledby="applied-tab">
                                            <div class="post-bar">
                                                <div class="p-all saved-post">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>Senior Wordpress Developer</h2>
                                                            <p><i class="la la-clock-o"></i>Posted on 30 August 2018
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Unsaved</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info saved-info">
                                                    <li>
                                                        <h3>Applicants</h3>
                                                        <p>10</p>
                                                    </li>
                                                    <li>
                                                        <h3>Job Type</h3>
                                                        <p>Full Time</p>
                                                    </li>
                                                    <li>
                                                        <h3>Salary</h3>
                                                        <p>$600 - Mannual</p>
                                                    </li>
                                                    <li>
                                                        <h3>Posted : 5 Days Ago</h3>
                                                        <p>Open</p>
                                                    </li>
                                                    <div class="devepbtn saved-btn">
                                                        <a class="clrbtn" href="#">Applied</a>
                                                        <a class="clrbtn" href="#">Message</a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="post-bar">
                                                <div class="p-all saved-post">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>Senior PHP Developer</h2>
                                                            <p><i class="la la-clock-o"></i>Posted on 30 August 2018
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Unsaved</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info saved-info">
                                                    <li>
                                                        <h3>Applicants</h3>
                                                        <p>10</p>
                                                    </li>
                                                    <li>
                                                        <h3>Job Type</h3>
                                                        <p>Full Time</p>
                                                    </li>
                                                    <li>
                                                        <h3>Salary</h3>
                                                        <p>$600 - Mannual</p>
                                                    </li>
                                                    <li>
                                                        <h3>Posted : 5 Days Ago</h3>
                                                        <p>Open</p>
                                                    </li>
                                                    <div class="devepbtn saved-btn">
                                                        <a class="clrbtn" href="#">Applied</a>
                                                        <a class="clrbtn" href="#">Message</a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="post-bar">
                                                <div class="p-all saved-post">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>UI UX Designer</h2>
                                                            <p><i class="la la-clock-o"></i>Posted on 30 August 2018
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Unsaved</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info saved-info">
                                                    <li>
                                                        <h3>Applicants</h3>
                                                        <p>10</p>
                                                    </li>
                                                    <li>
                                                        <h3>Job Type</h3>
                                                        <p>Full Time</p>
                                                    </li>
                                                    <li>
                                                        <h3>Salary</h3>
                                                        <p>$600 - Mannual</p>
                                                    </li>
                                                    <li>
                                                        <h3>Posted : 5 Days Ago</h3>
                                                        <p>Open</p>
                                                    </li>
                                                    <div class="devepbtn saved-btn">
                                                        <a class="clrbtn" href="#">Applied</a>
                                                        <a class="clrbtn" href="#">Message</a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="cadidates" role="tabpanel"
                                            aria-labelledby="cadidates-tab">
                                            <div class="post-bar">
                                                <div class="post_topbar applied-post">
                                                    <div class="usy-dt">
                                                        <img src="/workwise/images/resources/us-pic.png" alt>
                                                        <div class="usy-name">
                                                            <h3>John Doe</h3>
                                                            <div class="epi-sec epi2">
                                                                <ul class="descp descptab bklink">
                                                                    <li><img src="/workwise/images/icon8.png"
                                                                            alt><span>Epic
                                                                            Coder</span></li>
                                                                    <li><img src="/workwise/images/icon9.png"
                                                                            alt><span>India</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Accept</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="job_descp noborder">
                                                        <div class="star-descp review profilecnd">
                                                            <ul class="bklik">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-half-o"></i></li>
                                                                <a href="#" title>5.0 of 5 Reviews</a>
                                                            </ul>
                                                        </div>
                                                        <div class="devepbtn appliedinfo noreply">
                                                            <a class="clrbtn" href="#">Accept</a>
                                                            <a class="clrbtn" href="#">View Profile</a>
                                                            <a class="clrbtn" href="#">Message</a>
                                                            <a href="#">
                                                                <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-bar">
                                                <div class="post_topbar  applied-post">
                                                    <div class="usy-dt">
                                                        <img src="/workwise/images/resources/us-pic.png" alt>
                                                        <div class="usy-name">
                                                            <h3>John Doe</h3>
                                                            <div class="epi-sec epi2">
                                                                <ul class="descp descptab bklink">
                                                                    <li><img src="/workwise/images/icon8.png"
                                                                            alt><span>Epic
                                                                            Coder</span></li>
                                                                    <li><img src="/workwise/images/icon9.png"
                                                                            alt><span>India</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Accept</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="job_descp noborder">
                                                        <div class="star-descp review profilecnd">
                                                            <ul class="bklik">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-half-o"></i></li>
                                                                <a href="#" title>5.0 of 5 Reviews</a>
                                                            </ul>
                                                        </div>
                                                        <div class="devepbtn appliedinfo noreply">
                                                            <a class="clrbtn" href="#">Accept</a>
                                                            <a class="clrbtn" href="#">View Profile</a>
                                                            <a class="clrbtn" href="#">Message</a>
                                                            <a href="#">
                                                                <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-bar">
                                                <div class="post_topbar applied-post">
                                                    <div class="usy-dt">
                                                        <img src="/workwise/images/resources/us-pic.png" alt>
                                                        <div class="usy-name">
                                                            <h3>John Doe</h3>
                                                            <div class="epi-sec epi2">
                                                                <ul class="descp descptab bklink">
                                                                    <li><img src="/workwise/images/icon8.png"
                                                                            alt><span>Epic
                                                                            Coder</span></li>
                                                                    <li><img src="/workwise/images/icon9.png"
                                                                            alt><span>India</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Accept</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="job_descp noborder">
                                                        <div class="star-descp review profilecnd">
                                                            <ul class="bklik">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-half-o"></i></li>
                                                                <a href="#" title>5.0 of 5 Reviews</a>
                                                            </ul>
                                                        </div>
                                                        <div class="devepbtn appliedinfo noreply">
                                                            <a class="clrbtn" href="#">Accept</a>
                                                            <a class="clrbtn" href="#">View Profile</a>
                                                            <a class="clrbtn" href="#">Message</a>
                                                            <a href="#">
                                                                <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-feed-tab current" id="feed-dd">
                                    <div class="posts-section">
                                        @foreach ($user->posts as $post)
                                            <div class="post-bar">
                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <img src="{{ $post->user->userInfo->CheckEmptyImage('/workwise/images/resources/user-pic.png') }}"
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
                                                            <li><a href="#" title>Chỉnh sửa đối tượng</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
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
                                                                                    data-lightbox="roadtrip">
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
                                                                                data-lightbox="roadtrip">
                                                                                <img class="image-posts type-one-image-12"
                                                                                    src="{{ $post->images[0]->image_url }}"
                                                                                    alt="">
                                                                            </a>
                                                                        </div>
                                                                        @for ($index = 1; $index < $countImage; $index++)
                                                                            <div class="col-{{ $divideImage }} p-0">
                                                                                <a href="{{ $post->images[$index]->image_url }}"
                                                                                    data-lightbox="roadtrip">
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
                                                                                    data-lightbox="roadtrip">
                                                                                    <img class="image-posts image-list1"
                                                                                        src="{{ $post->images[$index]->image_url }}"
                                                                                        alt="">
                                                                                </a>
                                                                            @endfor
                                                                        </div>
                                                                        <div class="col-6 p-0">
                                                                            @for ($index = 2; $index < 5; $index++)
                                                                                <a href="{{ $post->images[$index]->image_url }}"
                                                                                    data-lightbox="roadtrip">
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
                                <div class="product-feed-tab" id="my-bids">
                                    <ul class="nav nav-tabs bid-tab" id="myTab" role="tablist">
                                        <li class="nav-item">
                                            <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                                role="tab" aria-controls="home" aria-selected="true">Manage Bids</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="bidders-tab" data-toggle="tab" href="#bidders"
                                                role="tab" aria-controls="contact" aria-selected="false">Manage
                                                Bidders</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" id="profile-tab" data-toggle="tab" href="#profile"
                                                role="tab" aria-controls="profile" aria-selected="false">My Active
                                                Bids</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content" id="myTabContent">
                                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                                            aria-labelledby="home-tab">
                                            <div class="post-bar">
                                                <div class="post_topbar">
                                                    <div class="wordpressdevlp">
                                                        <h2>Travel Wordpress Theme</h2>
                                                        <p><i class="la la-clock-o"></i>5 Hour Lefts</p>
                                                    </div>
                                                    <ul class="savedjob-info mangebid manbids">
                                                        <li>
                                                            <h3>Bids</h3>
                                                            <p>4</p>
                                                        </li>
                                                        <li>
                                                            <h3>Avg Bid (USD)</h3>
                                                            <p>$510</p>
                                                        </li>
                                                        <li>
                                                            <h3>Project Budget (USD)</h3>
                                                            <p>$500 - $600</p>
                                                        </li>
                                                        <ul class="bk-links bklink">
                                                            <li><a href="#" title><i class="la la-bookmark"></i></a>
                                                            </li>
                                                            <li><a href="#" title><i class="la la-envelope"></i></a>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                    <br>
                                                    <div class="cadidatesbtn bidsbtn">
                                                        <button type="button" class="btn btn-primary">
                                                            <span class="badge badge-light">3</span>Candidates
                                                        </button>
                                                        <a href="#">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-bar">
                                                <div class="post_topbar">
                                                    <div class="wordpressdevlp">
                                                        <h2>Travel Wordpress Theme</h2>
                                                        <p><i class="la la-clock-o"></i>5 Hour Lefts</p>
                                                    </div>
                                                    <ul class="savedjob-info mangebid manbids">
                                                        <li>
                                                            <h3>Bids</h3>
                                                            <p>4</p>
                                                        </li>
                                                        <li>
                                                            <h3>Avg Bid (USD)</h3>
                                                            <p>$510</p>
                                                        </li>
                                                        <li>
                                                            <h3>Project Budget (USD)</h3>
                                                            <p>$500 - $600</p>
                                                        </li>
                                                        <ul class="bk-links bklink">
                                                            <li><a href="#" title><i class="la la-bookmark"></i></a>
                                                            </li>
                                                            <li><a href="#" title><i class="la la-envelope"></i></a>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                    <br>
                                                    <div class="cadidatesbtn bidsbtn">
                                                        <button type="button" class="btn btn-primary">
                                                            <span class="badge badge-light">3</span>Candidates
                                                        </button>
                                                        <a href="#">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-bar">
                                                <div class="post_topbar">
                                                    <div class="wordpressdevlp">
                                                        <h2>Travel Wordpress Theme</h2>
                                                        <p><i class="la la-clock-o"></i>5 Hour Lefts</p>
                                                    </div>
                                                    <ul class="savedjob-info mangebid manbids">
                                                        <li>
                                                            <h3>Bids</h3>
                                                            <p>4</p>
                                                        </li>
                                                        <li>
                                                            <h3>Avg Bid (USD)</h3>
                                                            <p>$510</p>
                                                        </li>
                                                        <li>
                                                            <h3>Project Budget (USD)</h3>
                                                            <p>$500 - $600</p>
                                                        </li>
                                                        <ul class="bk-links bklink">
                                                            <li><a href="#" title><i class="la la-bookmark"></i></a>
                                                            </li>
                                                            <li><a href="#" title><i class="la la-envelope"></i></a>
                                                            </li>
                                                        </ul>
                                                    </ul>
                                                    <br>
                                                    <div class="cadidatesbtn bidsbtn">
                                                        <button type="button" class="btn btn-primary">
                                                            <span class="badge badge-light">3</span>Candidates
                                                        </button>
                                                        <a href="#">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="profile" role="tabpanel"
                                            aria-labelledby="profile-tab">
                                            <div class="post-bar">
                                                <div class="post_topbar active-bids">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>Travel Wordpress Theme</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info activ-bidinfo">
                                                    <li>
                                                        <h3>Fixed Price</h3>
                                                        <p>$500</p>
                                                    </li>
                                                    <li>
                                                        <h3>Delivery Time</h3>
                                                        <p>8 Days</p>
                                                    </li>
                                                    <div class="devepbtn activebtn">
                                                        <a href="#">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="post-bar">
                                                <div class="post_topbar active-bids">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>Restaurant Android Application</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info activ-bidinfo">
                                                    <li>
                                                        <h3>Fixed Price</h3>
                                                        <p>$1500</p>
                                                    </li>
                                                    <li>
                                                        <h3>Delivery Time</h3>
                                                        <p>15 Days</p>
                                                    </li>
                                                    <div class="devepbtn activebtn">
                                                        <a href="#">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="post-bar">
                                                <div class="post_topbar active-bids">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>Online Shopping Html Template with PHP</h2>
                                                        </div>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info activ-bidinfo">
                                                    <li>
                                                        <h3>Fixed Price</h3>
                                                        <p>$1500</p>
                                                    </li>
                                                    <li>
                                                        <h3>Delivery Time</h3>
                                                        <p>15 Days</p>
                                                    </li>
                                                    <div class="devepbtn activebtn">
                                                        <a href="#">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="contact" role="tabpanel"
                                            aria-labelledby="contact-tab">
                                            <div class="post-bar">
                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>Senior Wordpress Developer</h2>
                                                            <br>
                                                            <p><i class="la la-clock-o"></i>Posted on 30 August 2018
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Unsaved</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info">
                                                    <li>
                                                        <h3>Applicants</h3>
                                                        <p>10</p>
                                                    </li>
                                                    <li>
                                                        <h3>Job Type</h3>
                                                        <p>Full Time</p>
                                                    </li>
                                                    <li>
                                                        <h3>Salary</h3>
                                                        <p>$600 - Mannual</p>
                                                    </li>
                                                    <li>
                                                        <h3>Posted : 5 Days Ago</h3>
                                                        <p>Open</p>
                                                    </li>
                                                    <div class="devepbtn">
                                                        <a class="clrbtn" href="#">Applied</a>
                                                        <a class="clrbtn" href="#">Message</a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="post-bar">
                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>Senior PHP Developer</h2>
                                                            <br>
                                                            <p><i class="la la-clock-o"></i>Posted on 30 August 2018
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Unsaved</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info">
                                                    <li>
                                                        <h3>Applicants</h3>
                                                        <p>10</p>
                                                    </li>
                                                    <li>
                                                        <h3>Job Type</h3>
                                                        <p>Full Time</p>
                                                    </li>
                                                    <li>
                                                        <h3>Salary</h3>
                                                        <p>$600 - Mannual</p>
                                                    </li>
                                                    <li>
                                                        <h3>Posted : 5 Days Ago</h3>
                                                        <p>Open</p>
                                                    </li>
                                                    <div class="devepbtn">
                                                        <a class="clrbtn" href="#">Applied</a>
                                                        <a class="clrbtn" href="#">Message</a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </ul>
                                            </div>
                                            <div class="post-bar">
                                                <div class="post_topbar">
                                                    <div class="usy-dt">
                                                        <div class="wordpressdevlp">
                                                            <h2>UI UX Designer</h2>
                                                            <br>
                                                            <p><i class="la la-clock-o"></i>Posted on 30 August 2018
                                                            </p>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Unsaved</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                </div>
                                                <ul class="savedjob-info">
                                                    <li>
                                                        <h3>Applicants</h3>
                                                        <p>10</p>
                                                    </li>
                                                    <li>
                                                        <h3>Job Type</h3>
                                                        <p>Full Time</p>
                                                    </li>
                                                    <li>
                                                        <h3>Salary</h3>
                                                        <p>$600 - Mannual</p>
                                                    </li>
                                                    <li>
                                                        <h3>Posted : 5 Days Ago</h3>
                                                        <p>Open</p>
                                                    </li>
                                                    <div class="devepbtn">
                                                        <a class="clrbtn" href="#">Applied</a>
                                                        <a class="clrbtn" href="#">Message</a>
                                                        <a href="#">
                                                            <i class="far fa-trash-alt"></i>
                                                        </a>
                                                    </div>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="tab-pane fade" id="bidders" role="tabpanel"
                                            aria-labelledby="bidders-tab">
                                            <div class="post-bar">
                                                <div class="post_topbar post-bid">
                                                    <div class="usy-dt">
                                                        <img src="/workwise/images/resources/us-pic.png" alt>
                                                        <div class="usy-name">
                                                            <h3>John Doe</h3>
                                                            <div class="epi-sec epi2">
                                                                <ul class="descp descptab bklink">
                                                                    <li><img src="/workwise/images/icon8.png"
                                                                            alt><span>Epic
                                                                            Coder</span></li>
                                                                    <li><img src="/workwise/images/icon9.png"
                                                                            alt><span>India</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Accept</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="job_descp noborder">
                                                        <div class="star-descp review profilecnd">
                                                            <ul class="bklik">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-half-o"></i></li>
                                                                <a href="#" title>5.0 of 5 Reviews</a>
                                                            </ul>
                                                        </div>
                                                        <ul class="savedjob-info biddersinfo">
                                                            <li>
                                                                <h3>Fixed Price</h3>
                                                                <p>$500</p>
                                                            </li>
                                                            <li>
                                                                <h3>Delivery Time</h3>
                                                                <p>10 Days</p>
                                                            </li>
                                                        </ul>
                                                        <div class="devepbtn appliedinfo bidsbtn">
                                                            <a class="clrbtn" href="#">Accept</a>
                                                            <a class="clrbtn" href="#">View Profile</a>
                                                            <a class="clrbtn" href="#">Message</a>
                                                            <a href="#">
                                                                <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-bar">
                                                <div class="post_topbar post-bid">
                                                    <div class="usy-dt">
                                                        <img src="/workwise/images/resources/Jassica.html" alt>
                                                        <div class="usy-name">
                                                            <h3>John Doe</h3>
                                                            <div class="epi-sec epi2">
                                                                <ul class="descp descptab bklink">
                                                                    <li><img src="/workwise/images/icon8.png"
                                                                            alt><span>Epic
                                                                            Coder</span></li>
                                                                    <li><img src="/workwise/images/icon9.png"
                                                                            alt><span>India</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Accept</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="job_descp noborder">
                                                        <div class="star-descp review profilecnd">
                                                            <ul class="bklik">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-half-o"></i></li>
                                                                <a href="#" title>5.0 of 5 Reviews</a>
                                                            </ul>
                                                        </div>
                                                        <ul class="savedjob-info biddersinfo">
                                                            <li>
                                                                <h3>Fixed Price</h3>
                                                                <p>$500</p>
                                                            </li>
                                                            <li>
                                                                <h3>Delivery Time</h3>
                                                                <p>10 Days</p>
                                                            </li>
                                                        </ul>
                                                        <div class="devepbtn appliedinfo bidsbtn">
                                                            <a class="clrbtn" href="#">Accept</a>
                                                            <a class="clrbtn" href="#">View Profile</a>
                                                            <a class="clrbtn" href="#">Message</a>
                                                            <a href="#">
                                                                <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="post-bar">
                                                <div class="post_topbar post-bid">
                                                    <div class="usy-dt">
                                                        <img src="/workwise/images/resources/rock.jpg" alt>
                                                        <div class="usy-name">
                                                            <h3>John Doe</h3>
                                                            <div class="epi-sec epi2">
                                                                <ul class="descp descptab bklink">
                                                                    <li><img src="/workwise/images/icon8.png"
                                                                            alt><span>Epic
                                                                            Coder</span></li>
                                                                    <li><img src="/workwise/images/icon9.png"
                                                                            alt><span>India</span></li>
                                                                </ul>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="ed-opts">
                                                        <a href="#" title class="ed-opts-open"><i
                                                                class="la la-ellipsis-v"></i></a>
                                                        <ul class="ed-options">
                                                            <li><a href="#" title>Edit Post</a></li>
                                                            <li><a href="#" title>Accept</a></li>
                                                            <li><a href="#" title>Unbid</a></li>
                                                            <li><a href="#" title>Close</a></li>
                                                            <li><a href="#" title>Hide</a></li>
                                                        </ul>
                                                    </div>
                                                    <div class="job_descp noborder">
                                                        <div class="star-descp review profilecnd">
                                                            <ul class="bklik">
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star"></i></li>
                                                                <li><i class="fa fa-star-half-o"></i></li>
                                                                <a href="#" title>5.0 of 5 Reviews</a>
                                                            </ul>
                                                        </div>
                                                        <ul class="savedjob-info biddersinfo">
                                                            <li>
                                                                <h3>Fixed Price</h3>
                                                                <p>$500</p>
                                                            </li>
                                                            <li>
                                                                <h3>Delivery Time</h3>
                                                                <p>10 Days</p>
                                                            </li>
                                                        </ul>
                                                        <div class="devepbtn appliedinfo bidsbtn">
                                                            <a class="clrbtn" href="#">Accept</a>
                                                            <a class="clrbtn" href="#">View Profile</a>
                                                            <a class="clrbtn" href="#">Message</a>
                                                            <a href="#">
                                                                <i class="far fa-trash-alt"></i>
                                                            </a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-feed-tab" id="info-dd">
                                    <div class="user-profile-ov">
                                        <h3><a href="#" title class="overview-open">Overview</a> <a href="#"
                                                title class="overview-open"><i class="fa fa-pencil"></i></a></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor
                                            aliquam felis, nec condimentum ipsum commodo id. Vivamus sit amet augue
                                            nec urna efficitur tincidunt. Vivamus consectetur aliquam lectus commodo
                                            viverra. Nunc eu augue nec arcu efficitur faucibus. Aliquam accumsan ac
                                            magna convallis bibendum. Quisque laoreet augue eget augue fermentum
                                            scelerisque. Vivamus dignissim mollis est dictum blandit. Nam porta
                                            auctor neque sed congue. Nullam rutrum eget ex at maximus. Lorem ipsum
                                            dolor sit amet, consectetur adipiscing elit. Donec eget vestibulum
                                            lorem.</p>
                                    </div>
                                    <div class="user-profile-ov st2">
                                        <h3><a href="#" title class="exp-bx-open">Experience </a><a href="#"
                                                title class="exp-bx-open"><i class="fa fa-pencil"></i></a> <a
                                                href="#" title class="exp-bx-open"><i
                                                    class="fa fa-plus-square"></i></a></h3>
                                        <h4>Web designer <a href="#" title><i class="fa fa-pencil"></i></a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor
                                            aliquam felis, nec condimentum ipsum commodo id. Vivamus sit amet augue
                                            nec urna efficitur tincidunt. Vivamus consectetur aliquam lectus commodo
                                            viverra. </p>
                                        <h4>UI / UX Designer <a href="#" title><i class="fa fa-pencil"></i></a></h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor
                                            aliquam felis, nec condimentum ipsum commodo id.</p>
                                        <h4>PHP developer <a href="#" title><i class="fa fa-pencil"></i></a></h4>
                                        <p class="no-margin">Lorem ipsum dolor sit amet, consectetur adipiscing
                                            elit. Quisque tempor aliquam felis, nec condimentum ipsum commodo id.
                                            Vivamus sit amet augue nec urna efficitur tincidunt. Vivamus consectetur
                                            aliquam lectus commodo viverra. </p>
                                    </div>
                                    <div class="user-profile-ov">
                                        <h3><a href="#" title class="ed-box-open">Education</a> <a href="#"
                                                title class="ed-box-open"><i class="fa fa-pencil"></i></a> <a
                                                href="#" title><i class="fa fa-plus-square"></i></a></h3>
                                        <h4>Master of Computer Science</h4>
                                        <span>2015 - 2018</span>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Quisque tempor
                                            aliquam felis, nec condimentum ipsum commodo id. Vivamus sit amet augue
                                            nec urna efficitur tincidunt. Vivamus consectetur aliquam lectus commodo
                                            viverra. </p>
                                    </div>
                                    <div class="user-profile-ov">
                                        <h3><a href="#" title class="lct-box-open">Location</a> <a href="#"
                                                title class="lct-box-open"><i class="fa fa-pencil"></i></a> <a
                                                href="#" title><i class="fa fa-plus-square"></i></a></h3>
                                        <h4>India</h4>
                                        <p>151/4 BT Chownk, Delhi </p>
                                    </div>
                                    <div class="user-profile-ov">
                                        <h3><a href="#" title class="skills-open">Skills</a> <a href="#"
                                                title class="skills-open"><i class="fa fa-pencil"></i></a> <a
                                                href="#"><i class="fa fa-plus-square"></i></a></h3>
                                        <ul>
                                            <li><a href="#" title>HTML</a></li>
                                            <li><a href="#" title>PHP</a></li>
                                            <li><a href="#" title>CSS</a></li>
                                            <li><a href="#" title>Javascript</a></li>
                                            <li><a href="#" title>Wordpress</a></li>
                                            <li><a href="#" title>Photoshop</a></li>
                                            <li><a href="#" title>Illustrator</a></li>
                                            <li><a href="#" title>Corel Draw</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-feed-tab" id="my-bids">
                                    <div class="posts-section">
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="/workwise/images/resources/us-pic.png" alt>
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="/workwise/images/clock.png" alt>3 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title class="ed-opts-open"><i
                                                            class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title>Edit Post</a></li>
                                                        <li><a href="#" title>Unsaved</a></li>
                                                        <li><a href="#" title>Unbid</a></li>
                                                        <li><a href="#" title>Close</a></li>
                                                        <li><a href="#" title>Hide</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="/workwise/images/icon8.png" alt><span>Frontend
                                                            Developer</span></li>
                                                    <li><img src="/workwise/images/icon9.png" alt><span>India</span></li>
                                                </ul>
                                                <ul class="bk-links">
                                                    <li><a href="#" title><i class="la la-bookmark"></i></a></li>
                                                    <li><a href="#" title><i class="la la-envelope"></i></a></li>
                                                    <li><a href="#" title class="bid_now">Bid Now</a></li>
                                                </ul>
                                            </div>
                                            <div class="job_descp">
                                                <h3>Simple Classified Site</h3>
                                                <ul class="job-dt">
                                                    <li><span>$300 - $350</span></li>
                                                </ul>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                                    luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id
                                                    magna sit amet... <a href="#" title>view more</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title>HTML</a></li>
                                                    <li><a href="#" title>PHP</a></li>
                                                    <li><a href="#" title>CSS</a></li>
                                                    <li><a href="#" title>Javascript</a></li>
                                                    <li><a href="#" title>Wordpress</a></li>
                                                    <li><a href="#" title>Photoshop</a></li>
                                                    <li><a href="#" title>Illustrator</a></li>
                                                    <li><a href="#" title>Corel Draw</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i> Like</a>
                                                        <img src="/workwise/images/liked-img.png" alt>
                                                        <span>25</span>
                                                    </li>
                                                    <li><a href="#" title class="com"><img
                                                                src="/workwise/images/com.png" alt>
                                                            Comment 15</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Views 50</a>
                                            </div>
                                        </div>
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="/workwise/images/resources/us-pic.png" alt>
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="/workwise/images/clock.png" alt>3 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title class="ed-opts-open"><i
                                                            class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title>Edit Post</a></li>
                                                        <li><a href="#" title>Unsaved</a></li>
                                                        <li><a href="#" title>Unbid</a></li>
                                                        <li><a href="#" title>Close</a></li>
                                                        <li><a href="#" title>Hide</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="/workwise/images/icon8.png" alt><span>Frontend
                                                            Developer</span></li>
                                                    <li><img src="/workwise/images/icon9.png" alt><span>India</span></li>
                                                </ul>
                                                <ul class="bk-links">
                                                    <li><a href="#" title><i class="la la-bookmark"></i></a></li>
                                                    <li><a href="#" title><i class="la la-envelope"></i></a></li>
                                                    <li><a href="#" title class="bid_now">Bid Now</a></li>
                                                </ul>
                                            </div>
                                            <div class="job_descp">
                                                <h3>Ios Shopping mobile app</h3>
                                                <ul class="job-dt">
                                                    <li><span>$300 - $350</span></li>
                                                </ul>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                                    luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id
                                                    magna sit amet... <a href="#" title>view more</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title>HTML</a></li>
                                                    <li><a href="#" title>PHP</a></li>
                                                    <li><a href="#" title>CSS</a></li>
                                                    <li><a href="#" title>Javascript</a></li>
                                                    <li><a href="#" title>Wordpress</a></li>
                                                    <li><a href="#" title>Photoshop</a></li>
                                                    <li><a href="#" title>Illustrator</a></li>
                                                    <li><a href="#" title>Corel Draw</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i> Like</a>
                                                        <img src="/workwise/images/liked-img.png" alt>
                                                        <span>25</span>
                                                    </li>
                                                    <li><a href="#" title class="com"><img
                                                                src="/workwise/images/com.png" alt>
                                                            Comment 15</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Views 50</a>
                                            </div>
                                        </div>
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="/workwise/images/resources/us-pic.png" alt>
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="/workwise/images/clock.png" alt>3 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title class="ed-opts-open"><i
                                                            class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title>Edit Post</a></li>
                                                        <li><a href="#" title>Unsaved</a></li>
                                                        <li><a href="#" title>Unbid</a></li>
                                                        <li><a href="#" title>Close</a></li>
                                                        <li><a href="#" title>Hide</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="/workwise/images/icon8.png" alt><span>Frontend
                                                            Developer</span></li>
                                                    <li><img src="/workwise/images/icon9.png" alt><span>India</span></li>
                                                </ul>
                                                <ul class="bk-links">
                                                    <li><a href="#" title><i class="la la-bookmark"></i></a></li>
                                                    <li><a href="#" title><i class="la la-envelope"></i></a></li>
                                                    <li><a href="#" title class="bid_now">Bid Now</a></li>
                                                </ul>
                                            </div>
                                            <div class="job_descp">
                                                <h3>Simple Classified Site</h3>
                                                <ul class="job-dt">
                                                    <li><span>$300 - $350</span></li>
                                                </ul>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                                    luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id
                                                    magna sit amet... <a href="#" title>view more</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title>HTML</a></li>
                                                    <li><a href="#" title>PHP</a></li>
                                                    <li><a href="#" title>CSS</a></li>
                                                    <li><a href="#" title>Javascript</a></li>
                                                    <li><a href="#" title>Wordpress</a></li>
                                                    <li><a href="#" title>Photoshop</a></li>
                                                    <li><a href="#" title>Illustrator</a></li>
                                                    <li><a href="#" title>Corel Draw</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i> Like</a>
                                                        <img src="/workwise/images/liked-img.png" alt>
                                                        <span>25</span>
                                                    </li>
                                                    <li><a href="#" title class="com"><img
                                                                src="/workwise/images/com.png" alt>
                                                            Comment 15</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Views 50</a>
                                            </div>
                                        </div>
                                        <div class="post-bar">
                                            <div class="post_topbar">
                                                <div class="usy-dt">
                                                    <img src="/workwise/images/resources/us-pic.png" alt>
                                                    <div class="usy-name">
                                                        <h3>John Doe</h3>
                                                        <span><img src="/workwise/images/clock.png" alt>3 min ago</span>
                                                    </div>
                                                </div>
                                                <div class="ed-opts">
                                                    <a href="#" title class="ed-opts-open"><i
                                                            class="la la-ellipsis-v"></i></a>
                                                    <ul class="ed-options">
                                                        <li><a href="#" title>Edit Post</a></li>
                                                        <li><a href="#" title>Unsaved</a></li>
                                                        <li><a href="#" title>Unbid</a></li>
                                                        <li><a href="#" title>Close</a></li>
                                                        <li><a href="#" title>Hide</a></li>
                                                    </ul>
                                                </div>
                                            </div>
                                            <div class="epi-sec">
                                                <ul class="descp">
                                                    <li><img src="/workwise/images/icon8.png" alt><span>Frontend
                                                            Developer</span></li>
                                                    <li><img src="/workwise/images/icon9.png" alt><span>India</span></li>
                                                </ul>
                                                <ul class="bk-links">
                                                    <li><a href="#" title><i class="la la-bookmark"></i></a></li>
                                                    <li><a href="#" title><i class="la la-envelope"></i></a></li>
                                                    <li><a href="#" title class="bid_now">Bid Now</a></li>
                                                </ul>
                                            </div>
                                            <div class="job_descp">
                                                <h3>Ios Shopping mobile app</h3>
                                                <ul class="job-dt">
                                                    <li><span>$300 - $350</span></li>
                                                </ul>
                                                <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Aliquam
                                                    luctus hendrerit metus, ut ullamcorper quam finibus at. Etiam id
                                                    magna sit amet... <a href="#" title>view more</a></p>
                                                <ul class="skill-tags">
                                                    <li><a href="#" title>HTML</a></li>
                                                    <li><a href="#" title>PHP</a></li>
                                                    <li><a href="#" title>CSS</a></li>
                                                    <li><a href="#" title>Javascript</a></li>
                                                    <li><a href="#" title>Wordpress</a></li>
                                                    <li><a href="#" title>Photoshop</a></li>
                                                    <li><a href="#" title>Illustrator</a></li>
                                                    <li><a href="#" title>Corel Draw</a></li>
                                                </ul>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#"><i class="la la-heart"></i> Like</a>
                                                        <img src="/workwise/images/liked-img.png" alt>
                                                        <span>25</span>
                                                    </li>
                                                    <li><a href="#" title class="com"><img
                                                                src="/workwise/images/com.png" alt>
                                                            Comment 15</a></li>
                                                </ul>
                                                <a><i class="la la-eye"></i>Views 50</a>
                                            </div>
                                        </div>
                                        <div class="process-comm">
                                            <a href="#" title><img src="/workwise/images/process-icon.png"
                                                    alt></a>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-feed-tab" id="portfolio-dd">
                                    <div class="portfolio-gallery-sec">
                                        <h3>Portfolio</h3>
                                        <div class="portfolio-btn">
                                            <a href="#" title><i class="fas fa-plus-square"></i> Add Portfolio</a>
                                        </div>
                                        <div class="gallery_pf">
                                            <div class="row">
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="/workwise/images/resources/pf-img1.jpg" alt>
                                                        <a href="#" title><img src="/workwise/images/all-out.png"
                                                                alt></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="/workwise/images/resources/pf-img2.jpg" alt>
                                                        <a href="#" title><img src="/workwise/images/all-out.png"
                                                                alt></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="/workwise/images/resources/pf-img3.jpg" alt>
                                                        <a href="#" title><img src="/workwise/images/all-out.png"
                                                                alt></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="/workwise/images/resources/pf-img4.jpg" alt>
                                                        <a href="#" title><img src="/workwise/images/all-out.png"
                                                                alt></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="/workwise/images/resources/pf-img5.jpg" alt>
                                                        <a href="#" title><img src="/workwise/images/all-out.png"
                                                                alt></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="/workwise/images/resources/pf-img6.jpg" alt>
                                                        <a href="#" title><img src="/workwise/images/all-out.png"
                                                                alt></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="/workwise/images/resources/pf-img7.jpg" alt>
                                                        <a href="#" title><img src="/workwise/images/all-out.png"
                                                                alt></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="/workwise/images/resources/pf-img8.jpg" alt>
                                                        <a href="#" title><img src="/workwise/images/all-out.png"
                                                                alt></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="/workwise/images/resources/pf-img9.jpg" alt>
                                                        <a href="#" title><img src="/workwise/images/all-out.png"
                                                                alt></a>
                                                    </div>
                                                </div>
                                                <div class="col-lg-4 col-md-4 col-sm-6 col-6">
                                                    <div class="gallery_pt">
                                                        <img src="/workwise/images/resources/pf-img10.jpg" alt>
                                                        <a href="#" title><img src="/workwise/images/all-out.png"
                                                                alt></a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="product-feed-tab" id="payment-dd">
                                    <div class="billing-method">
                                        <ul>
                                            <li>
                                                <h3>Add Billing Method</h3>
                                                <a href="#" title><i class="fa fa-plus-circle"></i></a>
                                            </li>
                                            <li>
                                                <h3>See Activity</h3>
                                                <a href="#" title>View All</a>
                                            </li>
                                            <li>
                                                <h3>Total Money</h3>
                                                <span>$0.00</span>
                                            </li>
                                        </ul>
                                        <div class="lt-sec">
                                            <img src="/workwise/images/lt-icon.png" alt>
                                            <h4>All your transactions are saved here</h4>
                                            <a href="#" title>Click Here</a>
                                        </div>
                                    </div>
                                    <div class="add-billing-method">
                                        <h3>Add Billing Method</h3>
                                        <h4><img src="/workwise/images/dlr-icon.png" alt><span>With workwise payment
                                                protection , only pay for work delivered.</span></h4>
                                        <div class="payment_methods">
                                            <h4>Credit or Debit Cards</h4>
                                            <form>
                                                <div class="row">
                                                    <div class="col-lg-12">
                                                        <div class="cc-head">
                                                            <h5>Card Number</h5>
                                                            <ul>
                                                                <li><img src="/workwise/images/cc-icon1.png" alt></li>
                                                                <li><img src="/workwise/images/cc-icon2.png" alt></li>
                                                                <li><img src="/workwise/images/cc-icon3.png" alt></li>
                                                                <li><img src="/workwise/images/cc-icon4.png" alt></li>
                                                            </ul>
                                                        </div>
                                                        <div class="inpt-field pd-moree">
                                                            <input type="text" name="cc-number" placeholder>
                                                            <i class="fa fa-credit-card"></i>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="cc-head">
                                                            <h5>First Name</h5>
                                                        </div>
                                                        <div class="inpt-field">
                                                            <input type="text" name="f-name" placeholder>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="cc-head">
                                                            <h5>Last Name</h5>
                                                        </div>
                                                        <div class="inpt-field">
                                                            <input type="text" name="l-name" placeholder>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="cc-head">
                                                            <h5>Expiresons</h5>
                                                        </div>
                                                        <div class="rowwy">
                                                            <div class="row">
                                                                <div class="col-lg-6 pd-left-none no-pd">
                                                                    <div class="inpt-field">
                                                                        <input type="text" name="f-name"
                                                                            placeholder>
                                                                    </div>
                                                                </div>
                                                                <div class="col-lg-6 pd-right-none no-pd">
                                                                    <div class="inpt-field">
                                                                        <input type="text" name="f-name"
                                                                            placeholder>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-6">
                                                        <div class="cc-head">
                                                            <h5>Cvv (Security Code) <i class="fa fa-question-circle"></i>
                                                            </h5>
                                                        </div>
                                                        <div class="inpt-field">
                                                            <input type="text" name="l-name" placeholder>
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-12">
                                                        <button type="submit">Continue</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <h4>Add Paypal Account</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{-- <div class="col-lg-3">
                            <div class="right-sidebar">
                                <div class="message-btn">
                                    <a href="{{ route('user.view-setting-profile', $user->id) }}" title><i class="fas fa-cog"></i>
                                        Cài đặt</a>
                                </div>
                                <div class="widget widget-portfolio">
                                    <div class="wd-heady">
                                        <h3>Portfolio</h3>
                                        <img src="/workwise/images/photo-icon.png" alt>
                                    </div>
                                    <div class="pf-gallery">
                                        <ul>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery1.png" alt></a></li>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery2.png" alt></a></li>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery3.png" alt></a></li>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery4.png" alt></a></li>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery5.png" alt></a></li>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery6.png" alt></a></li>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery7.png" alt></a></li>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery8.png" alt></a></li>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery9.png" alt></a></li>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery10.png" alt></a></li>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery11.png" alt></a></li>
                                            <li><a href="#" title><img
                                                        src="/workwise/images/resources/pf-gallery12.png" alt></a></li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div> --}}
                    </div>
                </div>
            </div>
        </div>
    </main>
    @include('workwise.posts.update')
@endsection

@section('script')
    <script src="/script/profile/index.js"></script>
    <script src="/script/posts/update.js"></script>
@endsection
