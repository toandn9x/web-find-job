@extends('workwise.layouts.master')

@section('style')
    <link rel="stylesheet" href="/workwise/css/company/style.css">
@endsection

@section('main-content')
    <section class="profile-account-setting">
        <div class="container-fluid">
            <div class="account-tabs-setting">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="tab-content" id="nav-tabContent">

                            <div class="tab-pane active show" id="nav-notification" role="tabpanel"
                                aria-labelledby="nav-notification-tab">
                                <div class="acc-setting">
                                    <h3>Trang chủ &nbsp; &rarr; &nbsp; Công ty tuyển dụng &nbsp; &rarr; &nbsp;
                                        {{ $company->name }}</h3>
                                    <div class="notifications-list">
                                        <div class="notfication-details">
                                            <div class="wrp_info_job_company">
                                                <div class="img_logo_company">
                                                    <img src="{{ $company->image_url }}" alt="" width="120"
                                                        height="120" class="avatar_company mr-3">
                                                </div>
                                                <div class="info_job_compnay">
                                                    <p class="name_company">Công ty: <span
                                                            class="tag_blue">{{ $company->name }}</span></p>
                                                    <p class="mt-2">
                                                        @if (Auth::check())
                                                            <a href="{{ route('chat.index', $company->user_id) }}" class="btn btn-primary" target="_blank"><i class="fa fa-weixin"
                                                                aria-hidden="true"></i> Chat ngay</a>
                                                        @else
                                                            <a href="" class="btn btn-primary chat_not_login"><i class="fa fa-weixin"
                                                                aria-hidden="true"></i> Chat ngay</a>
                                                        @endif
                                                        
                                                    </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="acc-setting mt-1">
                                    <div class="notifications-list">
                                        <div class="notfication-details">
                                            <div class="row">
                                                <div class="col-lg-8 p-0 mt-3 ak">
                                                    <p class="info_title">Mô tả công ty</p>
                                                    <p class="intro_company">
                                                        {!! $company->introduce ?? 'Đang cập nhật .....' !!}
                                                    </p>
                                                </div>
                                                <div class="col-lg-4 p-0 mt-3 d-flex justify-content-center">
                                                    <div class="info_company">
                                                        <div class="text_ntd">Chi tiết nhà tuyển dụng</div>
                                                        <div class="text_ntd_2">
                                                            <p class="fs_text">
                                                                <span class="fw-bold">Địa chỉ :</span> {{ $company->address }}
                                                            </p>
                                                            <p class="fs_text">
                                                                <span class="fw-bold">Số điện thoại :</span> {{ $company->phone }}
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="wrp_list_job">
                                    <p class="title_cpn mt-3 mb-3">{{ $company->name }} tuyển dụng</p>
                                    <div class="list_job mt-5">
                                        @foreach ($company->jobs as $job)
                                            <div class="wrp_info_job mb-5">
                                                <h3 class="title_job">{{ $job->title }}</h3>
                                                <span class="role_job">{{ $job->rank_text }}</span>
                                                <span class="created_job">{{ date('d/m/Y', strtotime($job->created_at)) }}</span>
                                                <div class="row mt-3">
                                                    <div class="col-lg-8 p-0 mb-3 wrp_money_job">
                                                        <i class="fa fa-money img_info_job"></i>
                                                        @if ($job->money_type == 1)
                                                            Thỏa thuận
                                                        @elseif($job->money_type == 2)
                                                            {{ number_format($job->money_min) }} VNĐ
                                                        @elseif($job->money_type == 3)
                                                            {{ number_format($job->money_min, 0, '', '.') }} - {{ number_format($jojobb->money_max, 0, '', '.') }} VNĐ
                                                        @else
                                                            {{ $job->money_text }} VNĐ
                                                        @endif
                                                    </div>
                                                    <div class="col-lg-4 p-0 mb-3 text_info_job">
                                                        <img src="/workwise/images/icons/dt_9.png" class="img_info_job" alt="">
                                                        {{ $job->method_work_text }}
                                                    </div>
                                                    <div class="col-lg-8 p-0 mb-3 text_info_job wrp_info_detail">
                                                        <div>
                                                            <img src="/workwise/images/icons/dt_5.png" class="img_info_job" alt="">
                                                            {{ $job->gender_text }}
                                                        </div>
                                                        <div>
                                                            <img src="/workwise/images/icons/dt_6.png" class="img_info_job" alt="">
                                                            {{ $job->category }}
                                                        </div>
                                                        <div>
                                                            <img src="/workwise/images/icons/dt_7.png" class="img_info_job" alt="">
                                                            {{ $job->city }}
                                                        </div>
                                                    </div>
                                                    <div class="col-lg-4 p-0 mb-3 text_info_job">
                                                        <img src="/workwise/images/icons/dt_8.png" class="img_info_job" alt="">
                                                        {{ $job->degree_text }}
                                                    </div>
                                                </div>
                                                <div class="description_job">
                                                    {!! $job->description !!}
                                                </div>
                                                <a href="{{ route('job.detail', $job->id) }}" class="btn btn-outline-primary mt-4">Xem chi tiết</a>
                                            </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script>
        $(document).ready(function () {
            $('.chat_not_login').on('click', function(event) {
                event.preventDefault();
                Swal.fire({
                    title: 'Đăng nhập đê',
                    text: "Bạn chưa đăng nhập tài khoản. Bạn muốn đến trang đăng nhập không ?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Chuyển đến',
                    cancelButtonText: 'Ở lại'
                }).then((result) => {
                    if (result.isConfirmed) {
                        window.open('/login', '_self');
                    }
                })
            });
        });
    </script>
@endsection
