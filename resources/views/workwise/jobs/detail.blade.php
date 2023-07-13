@extends('workwise.layouts.master')

@section('style')
    <link rel="stylesheet" href="/workwise/css/work/detail.css">
@endsection

@section('main-content')
<section class="profile-account-setting">
    <div class="container-fluid">
        <div class="account-tabs-setting">
            <div class="row">
                <div class="col-lg-9">
                    <div class="tab-content" id="nav-tabContent">
                       
                        <div class="tab-pane active show" id="nav-notification" role="tabpanel"
                            aria-labelledby="nav-notification-tab">
                            <div class="acc-setting">
                                <h3>Trang chủ &nbsp; &rarr; &nbsp; Việc Làm {{ $job->category }} &nbsp; &rarr; &nbsp; {{ $job->category }}</h3>
                                <div class="notifications-list">
                                    <div class="notfication-details">
                                        <div class="wrp_info_job_company">
                                            <div class="img_logo_company">
                                                <img src="{{ $job->company->image_url }}" alt="" width="135" height="135">
                                            </div>
                                            <div class="info_job_compnay">
                                                <p class="title_job">{{ $job->title }}</p>
                                                <p class="name_company">Công ty: <span class="tag_blue">{{ $job->company->name }}</span></p>
                                                <p class="job">Ngành nghề: <span class="tag_blue">{{ $job->category }}</span></p>
                                                <p class="money">Mức lương: 
                                                    <span class="tag_red"> 
                                                        @if ($job->money_type == 1)
                                                            Thỏa thuận
                                                        @elseif($job->money_type == 2)
                                                            {{ number_format($job->money_min) }} VNĐ
                                                        @elseif($job->money_type == 3)
                                                            {{ number_format($job->money_min, 0, '', '.') }} - {{ number_format($job->money_max, 0, '', '.') }} VNĐ
                                                        @else
                                                            {{ $job->money_text }} VNĐ
                                                        @endif
                                                    </span>
                                                </p>
                                                <p class="view">Lượt xem: <span class="tag_red">{{ number_format($job->views, 0, '', '.') }}</span>  &nbsp; |  &nbsp; Ngày đăng: <span class="tag_red">{{ date('d-m-Y' ,strtotime($job->created_at)) }}</span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="acc-setting mt-5">
                                <div class="notifications-list">
                                    <div class="notfication-details">
                                        <p class="info_title">Thông tin chung</p>
                                        <div class="row">
                                            <div class="col-lg-6 p-0 mt-3 ak">Chức vụ: <span class="font-weight-bold font-italic"> {{ $job->rank_text }}</span></div>
                                            <div class="col-lg-6 p-0 mt-3 ak">Số lượng cần tuyển: <span class="font-weight-bold font-italic"> {{ $job->qty }} mạng</span></div>
                                            <div class="col-lg-6 p-0 mt-3 ak">Hình thức làm việc: <span class="font-weight-bold font-italic"> {{ $job->method_work_text }}</span></div>
                                        </div>
                                        <p class="info_title mt-5">Địa điểm làm việc</p>
                                        <div class="row">
                                            <div class="col-lg-12 p-0 mt-3 ak">Tỉnh thành: <span class="font-weight-bold font-italic">{{ $job->city }}</span></div>
                                            <div class="col-lg-12 p-0 mt-3 ak">Địa chỉ chi tiết: <span class="font-weight-bold font-italic">{{ $job->address }}</span></div>
                                        </div>
                                        <p class="tit_detail_post mt-5">Mô tả công việc</p>
                                        <div class="row">
                                            <div class="col-lg-12 p-0 mt-2 text_content ak">
                                                {!! $job->descirption !!}
                                            </div>
                                        </div>
                                        <p class="tit_detail_post mt-5 ak">Yêu cầu</p>
                                        <div class="row">
                                            <div class="col-lg-6 p-0 mt-3 ak">Kinh nghiệm: <span class="font-weight-bold font-italic"> {{ $job->exp_text }}</span></div>
                                            <div class="col-lg-6 p-0 mt-3 ak">Bằng cấp: <span class="font-weight-bold font-italic"> {{ $job->degree_text }}</span></div>
                                            <div class="col-lg-6 p-0 mt-3 ak">Giới tính: <span class="font-weight-bold font-italic"> {{ $job->gender_text }}</span></div>
                                            <div class="col-lg-12 p-0 mt-2 text_content ak">
                                                {!! $job->request_other !!}
                                            </div>
                                        </div>
                                        <p class="tit_detail_post mt-5">Quyền lợi</p>
                                        <div class="row">
                                            <div class="col-lg-12 p-0 mt-2 text_content ak">
                                                {!! $job->benefits_enjoyed !!}
                                            </div>
                                        </div>
                                        <p class="tit_detail_post mt-5">Hồ sơ bao gồm</p>
                                        <div class="row">
                                            <div class="col-lg-12 p-0 mt-2 text_content ak">
                                                {!! $job->job_application !!}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3">
                    <div class="acc-setting">
                        <h3 class="info_qr text-center">Quét mã QR ủng hộ nhà phát triển</h3>
                    </div>
                    <div class="acc-setting mt-3">
                        <div class="tit_chat">
                            <div class="tit_chat_left"></div>
                            <div class="tit_chat_mid">
                                <span class="tit_chat_mid_text">Quét mã QR 1</span>
                            </div>
                            <div class="tit_chat_right"></div>
                        </div>
                        <div class="notfication-details">
                            <div class="wr_qr">
                                <img src="/workwise/images/resources/qr_1.png" alt="">
                            </div>
                        </div>
                    </div>
                    <div class="acc-setting mt-3">
                        <div class="tit_chat">
                            <div class="tit_chat_left"></div>
                            <div class="tit_chat_mid">
                                <span class="tit_chat_mid_text">Quét mã QR 2</span>
                            </div>
                            <div class="tit_chat_right"></div>
                        </div>
                        <div class="notfication-details">
                            <div class="wr_qr">
                                <img src="/workwise/images/resources/qr_2.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection