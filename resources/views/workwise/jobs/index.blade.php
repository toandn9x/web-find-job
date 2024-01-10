@extends('workwise.layouts.master')

@section('style')
    <link rel="stylesheet" href="/workwise/css/work/style.css">
@endsection

@section('main-content')
    <form method="GET" id="formSubmitSearch">
        <div class="search-sec">
            <div class="container">
                <div class="search-box">
                    <div class="wrp_search">
                        <input type="text" name="keyword" placeholder="Nhập tên công việc..." id="iptKey"
                            value="{{ request()->has('keyword') ? request()->get('keyword') : '' }}">
                        <button type="submit" id="btnSerach">
                            <i class="fa fa-search"></i>
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <main>
            <div class="main-section">
                <div class="container">
                    <div class="main-section-data">
                        <div class="row">
                            <div class="col-lg-9">
                                @if (Auth::check() && Auth::user()->findJob && Auth::user()->status_cv == 1 && count($jobs[1]) > 0)
                                    <h3 class="title-jobsss">
                                        <img src="/workwise/images/icons/icn_vlth.png" alt="" class="mr-2">
                                        Công việc gợi ý
                                    </h3>
                                    <div class="main-ws-sec mb-5" style="float: unset !important">
                                        <div class="job-suggest">
                                            <div class="slick-job-suggest">
                                                @foreach ($jobs[1] as $arr)
                                                    <div class="d-flex justify-content-between flex-wrap">
                                                        @foreach ($arr as $job)
                                                            <div class="posts-section">
                                                                <div class="post-bar">
                                                                    <div class="post_topbar p-0 mb-4">
                                                                        <div>
                                                                            <div class="wrp-logo">
                                                                                <img src="{{ $job->company->image_url }}" alt
                                                                                    class="logo-company">
                                                                            </div>
                                                                            <div class="wrp-info-work">
                                                                                <span>
                                                                                    <a href="{{ route('job.detail', $job->id) }}"
                                                                                        class="name-work">{{ $job->TitleLimit($job->title) }}</a>
                                                                                </span>
                                                                                <span>
                                                                                    <a href="{{ route('company.show', $job->company_id) }}"
                                                                                        class="name-company d-block">
                                                                                        {{ $job->TitleLimit($job->company->name) }}
                                                                                    </a>
                                                                                </span>
                                                                                <div class="wrp_job_info">
                                                                                    <div class="job_local job_info"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-placement="top" title="Địa chỉ">
                                                                                        <i class="fa fa-map-marker"
                                                                                            aria-hidden="true"></i>
                                                                                        {{ $job->city }}
                                                                                    </div>
                                                                                    <div class="job_time job_info"
                                                                                        data-bs-toggle="tooltip"
                                                                                        data-bs-placement="top"
                                                                                        title="Hạn ứng tuyển"><i
                                                                                            class="fa fa-calendar-check-o"
                                                                                            aria-hidden="true"></i>{{ date('d-m-Y', strtotime($job->expired_time)) }}
                                                                                    </div>
                                                                                    @can('viewChat', $job)
                                                                                        <div class="job_chat">
                                                                                            <a href="{{ route('chat.index', $job->user_id) }}"
                                                                                                target="_blank" class="job_info">
                                                                                                <i class="fa fa-weixin"
                                                                                                    aria-hidden="true"></i> Chat
                                                                                            </a>
                                                                                        </div>
                                                                                    @endcan
                                                                                </div>
                                                                                <div class="job_money job_info"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="top" title="Lương"><i
                                                                                        class="fa fa-money"
                                                                                        aria-hidden="true"></i>
                                                                                    @if ($job->money_type == 1)
                                                                                        Thỏa thuận
                                                                                    @elseif($job->money_type == 2)
                                                                                        {{ number_format($job->money_min) }} VNĐ
                                                                                    @elseif($job->money_type == 3)
                                                                                        {{ number_format($job->money_min, 0, '', '.') }}
                                                                                        -
                                                                                        {{ number_format($job->money_max, 0, '', '.') }}
                                                                                        VNĐ
                                                                                    @else
                                                                                        {{ $job->money_text }} VNĐ
                                                                                    @endif
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="job-status-bar p-0">
                                                                        <ul class="like-com">
                                                                            @if (Auth::check())
                                                                                <li><a href="#"
                                                                                        class="com like {{ $job->checkLike() ? 'active_like' : '' }}"
                                                                                        data-id="{{ $job->id }}"><i
                                                                                            class="fas fa-heart"></i>
                                                                                        Yêu thích <span
                                                                                            class="count_like">{{ count($job->likes) }}</span></a>
                                                                                </li>
                                                                            @else
                                                                                <li><a href="#"
                                                                                        class="com not_auth_like">
                                                                                        <i class="fas fa-heart"></i>
                                                                                        Yêu thích 
                                                                                        <span  class="count_like">{{ count($job->likes) }}</span></a>
                                                                                </li>
                                                                            @endif

                                                                            <li><a href="#" class="com"
                                                                                    data-toggle="modal"
                                                                                    data-target="#exampleModalCenter"
                                                                                    data-id="{{ $job->id }}"><i
                                                                                        class="fas fa-comment-alt"></i>
                                                                                    Bình luận {{ count($job->comments) }}</a>
                                                                            </li>

                                                                            <li>
                                                                                <a href="#" class="com"><i class="fas fa-eye"></i>Lượt xem
                                                                                    {{ $job->views }}</a>
                                                                            </li>
                                                                        </ul>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    </div>
                                                @endforeach
                                            </div>
                                        </div>
                                    </div>
                                @endif

                                <h3 class="title-jobsss">
                                    <img src="/workwise/images/icons/icn_vlth.png" alt="" class="mr-2">
                                    Công việc tuyển dụng
                                </h3>
                                <div class="main-ws-sec">
                                    <div class="job-normal">
                                        <div class="slick-job">
                                            @foreach ($jobs[0] as $arr)
                                                <div class="d-flex justify-content-between flex-wrap">
                                                    @foreach ($arr as $job)
                                                        <div class="posts-section">
                                                            <div class="post-bar">
                                                                <div class="post_topbar p-0 mb-4">
                                                                    <div>
                                                                        <div class="wrp-logo">
                                                                            <img src="{{ $job->company->image_url }}" alt
                                                                                class="logo-company">
                                                                        </div>
                                                                        <div class="wrp-info-work">
                                                                            <span>
                                                                                <a href="{{ route('job.detail', $job->id) }}"
                                                                                    class="name-work">{{ $job->TitleLimit($job->title) }}</a>
                                                                            </span>
                                                                            <span>
                                                                                <a href="{{ route('company.show', $job->company_id) }}"
                                                                                    class="name-company d-block">
                                                                                    {{ $job->TitleLimit($job->company->name) }}
                                                                                </a>
                                                                            </span>
                                                                            <div class="wrp_job_info">
                                                                                <div class="job_local job_info"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="top" title="Địa chỉ">
                                                                                    <i class="fa fa-map-marker"
                                                                                        aria-hidden="true"></i>
                                                                                    {{ $job->city }}
                                                                                </div>
                                                                                <div class="job_time job_info"
                                                                                    data-bs-toggle="tooltip"
                                                                                    data-bs-placement="top"
                                                                                    title="Hạn ứng tuyển"><i
                                                                                        class="fa fa-calendar-check-o"
                                                                                        aria-hidden="true"></i>{{ date('d-m-Y', strtotime($job->expired_time)) }}
                                                                                </div>
                                                                                @can('viewChat', $job)
                                                                                    <div class="job_chat">
                                                                                        <a href="{{ route('chat.index', $job->user_id) }}"
                                                                                            target="_blank" class="job_info">
                                                                                            <i class="fa fa-weixin"
                                                                                                aria-hidden="true"></i> Chat
                                                                                        </a>
                                                                                    </div>
                                                                                @endcan
                                                                            </div>
                                                                            <div class="job_money job_info"
                                                                                data-bs-toggle="tooltip"
                                                                                data-bs-placement="top" title="Lương"><i
                                                                                    class="fa fa-money"
                                                                                    aria-hidden="true"></i>
                                                                                @if ($job->money_type == 1)
                                                                                    Thỏa thuận
                                                                                @elseif($job->money_type == 2)
                                                                                    {{ number_format($job->money_min,0 ,'', '.') }} VNĐ
                                                                                @elseif($job->money_type == 3)
                                                                                    {{ number_format($job->money_min, 0, '', '.') }}
                                                                                    -
                                                                                    {{ number_format($job->money_max, 0, '', '.') }}
                                                                                    VNĐ
                                                                                @else
                                                                                    {{ $job->money_text }} VNĐ
                                                                                @endif
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="job-status-bar p-0">
                                                                    <ul class="like-com">
                                                                        @if (Auth::check())
                                                                            <li><a href="#"
                                                                                    class="com like {{ $job->checkLike() ? 'active_like' : '' }}"
                                                                                    data-id="{{ $job->id }}"><i
                                                                                        class="fas fa-heart"></i>
                                                                                    Yêu thích <span
                                                                                        class="count_like">{{ count($job->likes) }}</span></a>
                                                                            </li>
                                                                        @else
                                                                            <li><a href="#"
                                                                                    class="com not_auth_like"><i
                                                                                        class="fas fa-heart"></i>
                                                                                    Yêu thích <span
                                                                                        class="count_like">{{ count($job->likes) }}</span></a>
                                                                            </li>
                                                                        @endif

                                                                        <li><a href="#" class="com"
                                                                                data-toggle="modal"
                                                                                data-target="#exampleModalCenter"
                                                                                data-id="{{ $job->id }}"><i
                                                                                    class="fas fa-comment-alt"></i>
                                                                                Bình luận {{ count($job->comments) }}</a>
                                                                        </li>

                                                                        <li>
                                                                            <a href="#" class="com"><i class="fas fa-eye"></i>Lượt xem
                                                                                {{ $job->views }}</a>
                                                                        </li>
                                                                    </ul>
                                                                    
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-3">
                                <div class="filter-secs">
                                    <div class="filter-heading">
                                        <h3>Lọc</h3>
                                    </div>
                                    <div class="paddy">
                                        <div class="filter-dd">
                                            <div class="filter-ttl">
                                                <h3>Chọn ngành nghề</h3>
                                            </div>
                                            <div class="wrp_filter">
                                                <select class="select_search select_choose_work" name="work">
                                                    <option value="0" selected>Chọn ngành nghề</option>
                                                </select>
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </div>
                                        </div>

                                        <div class="filter-dd">
                                            <div class="filter-ttl">
                                                <h3>Tỉnh thành</h3>
                                            </div>
                                            <div class="wrp_filter">
                                                <input type="text" name="city" placeholder="Nhập tỉnh thành"
                                                    id="search_city"
                                                    value="{{ request()->has('city') ? request()->get('city') : '' }}">
                                            </div>
                                        </div>

                                        <div class="filter-dd">
                                            <div class="filter-ttl">
                                                <h3>Chọn cấp bậc</h3>
                                            </div>
                                            <div class="wrp_filter">
                                                <select class="select_search" name="rank">
                                                    <option value="0" selected>Chọn cấp bậc</option>
                                                    @foreach (App\Models\Job::$rank_text as $key => $val)
                                                        <option value="{{ $key }}"
                                                            {{ request()->get('rank') == $key ? 'selected' : '' }}>
                                                            {{ $val }} </option>
                                                    @endforeach
                                                </select>
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="filter-dd">
                                            <div class="filter-ttl">
                                                <h3>Hình thức làm việc</h3>
                                            </div>
                                            <div class="wrp_filter">
                                                <select class="select_search" name="method_work">
                                                    <option value="0" selected>Chọn hình thức</option>
                                                    @foreach (App\Models\Job::$method_work_text as $key => $val)
                                                        <option value="{{ $key }}"
                                                            {{ request()->get('method_work') == $key ? 'selected' : '' }}>
                                                            {{ $val }} </option>
                                                    @endforeach
                                                </select>
                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        <div class="filter-dd">
                                            <div class="filter-ttl">
                                                <h3>Kinh nghiệm</h3>
                                            </div>
                                            <div class="wrp_filter">
                                                <select class="select_search" name="exp">
                                                    <option value="0" selected>Chọn kinh nghiệm</option>
                                                    @foreach (App\Models\Job::$exp_text as $key => $val)
                                                        <option value="{{ $key }}"
                                                            {{ request()->get('exp') == $key ? 'selected' : '' }}>
                                                            {{ $val }} </option>
                                                    @endforeach
                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                </select>
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
    </form>

    {{-- Modal bình luận --}}
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="header">
                    <h1 class="header_title">Bình luận</h1>
                    <input type="hidden" value="" id="idJob" name="idJob">
                </div>
                <div class="middle">

                </div>
                <div class="footer">
                    <div class="footer_title">
                        @if (Auth::check())
                            <img src="{{ Auth::user()->userInfo->CheckEmptyImage() }}" alt=""
                                id="avatar_user_login">
                            <span class="d-none" id="name_user_login">{{ Auth::user()->name }}</span>
                            <div class="wrp_ipt_comment">
                                <textarea class="ipt_cm send_comment" placeholder="Viết bình luận của bạn" oninput="check_data(this)"
                                    maxlength="250" required></textarea>
                                <div class="wrp_icon">
                                    <i class="fa fa-paper-plane-o icon_send" aria-hidden="true"></i>
                                </div>
                            </div>
                        @else
                            <div class="d-flex justify-content-center w-100">
                                <a href="{{ route('form-login') }}" class="btn btn-primary">Đăng nhập tài khoản để bình
                                    luận</a>
                            </div>
                        @endif

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script src="/script/works/comment.js"></script>
    <script>
        $(document).ready(function() {
            $('.slick-job-suggest').slick({
                dots: true,
            });

            $('.slick-job').slick({
                dots: true,
            });
        });
    </script>
@endsection
