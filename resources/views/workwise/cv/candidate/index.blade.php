@extends('workwise.layouts.master')

@section('style')
    <link rel="stylesheet" href="/workwise/css/cv/style.css">
@endsection

@section('main-content')
    <section class="profile-account-setting">
        <div class="container-fluid">
            <div class="account-tabs-setting">
                <div class="row justify-content-center">
                    <div class="col-lg-8 col-8">
                        <div class="tab-content" id="nav-tabContent">
                            {{-- Giu --}}
                            <div class="tab-pane fade active show" id="nav-notification" role="tabpanel"
                                aria-labelledby="nav-notification-tab">
                                <div class="acc-setting">
                                    <div class="acc-setting-wrapper d-flex justify-content-between align-items-center p-2">
                                        <h3> Quản lí CV </h3>
                                        <button class="btn-upload-cv btn btn-success fw-bold">
                                            <i class="la la-cloud-upload"></i> Tải CV lên
                                        </button>
                                        <input type="file" class="ipt-upload-cv d-none">
                                    </div>

                                    <div class="notifications-list py-3">
                                        <div class="cv">
                                            @if (count($pdf_url) <= 0)
                                                <div
                                                    class="no-cv d-flex flex-column justify-content-center align-items-center">
                                                    <img src="/workwise/images/icons/no-cv-upload.png" alt="">
                                                    <p class="pt-3">Bạn chưa tải lên CV nào</p>
                                                </div>
                                            @else
                                                <div class="row">
                                                    @foreach ($pdf_url as $cv)
                                                        <div class="col-lg-4 col-6">
                                                            <div class="wrapper-cv">
                                                                <embed scrolling="no"
                                                                    style="overflow: hidden !important; height:400px"
                                                                    src="{{ $cv['cv'] }}" type="application/pdf"
                                                                    width="100%">
                                                                <div class="wrapper-cv__action">
                                                                    <h2 class="name-cv">CV - {{ $cv['user']['name'] }}</h2>
                                                                    <div
                                                                        class="d-flex align-items-center justify-content-between">
                                                                        <p class="created-cv text-white my-3">Cập nhật lần
                                                                            cuối
                                                                            {{ date('d-m-Y', strtotime($cv['created_at'])) }}
                                                                            -
                                                                            {{ date('H:i', strtotime($cv['created_at'])) }}
                                                                        </p>
                                                                        <button class="btn-delete-cv bg-transparent">
                                                                            <i class="la la-trash"></i>
                                                                        </button>
                                                                    </div>
                                                                    <div class="main-cv {{ $cv['status'] == 0 ? 'sub-cv' : '' }}"
                                                                        data-id={{ $cv['id'] }}>
                                                                        @if ($cv['status'] == 1)
                                                                            <i class="la la-star main-cv-icon"></i>
                                                                            <span>
                                                                                CV chính
                                                                            </span>
                                                                        @else
                                                                            <i class="la la-star"></i>
                                                                            <span>
                                                                                Đặt làm cv chính
                                                                            </span>
                                                                        @endif

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                            @endif

                                        </div>

                                    </div>
                                </div>
                            </div>
                            {{-- Giu --}}
                        </div>
                    </div>
                    <div class="col-lg-3 col-3">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-notification" role="tabpanel"
                                aria-labelledby="nav-notification-tab">
                                <div class="acc-setting ">
                                    <div class="acc-setting-wrapper d-flex justify-content-between align-items-center p-2">
                                        <h3 class="title-status-cv"> {{ Auth::user()->status_cv == 1 ? 'Trạng thái tìm việc đang bật' : 'Đã tắt trạng thái tìm việc' }}
                                        </h3>
                                            <input type="checkbox" class="ipt-find" style="width:20px; height:20px;"
                                            {{ Auth::user()->status_cv == 1 ? 'checked' : 'data-toggle=modal data-target=#exampleModalCenter' }}  />
                                    </div>
                                    <p class="note p-2 mb-0">
                                        Bật tìm việc giúp hồ sơ của bạn nổi bật hơn và được chú ý nhiều hơn trong danh sách
                                        tìm kiếm của NTD.
                                    </p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog"
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="header d-flex flex-column align-items-center py-3">
                    <h1 class="header_title mb-2">Hãy để WorkWise hiểu mong muốn của bạn?</h1>
                    <p class="mb-0">WorkWise sẽ kết nối bạn với những cơ hội việc làm phù hợp nhất.</p>
                </div>
                <div class="middle">
                    <div class="my-3">
                        <p class="mb-2">Chọn ngành nghề bạn quan tâm <span class="text-danger">*</span></p>
                        <select class="js-example-basic-multiple w-100 py-3" name="states[]" multiple="multiple">

                        </select>
                    </div>
                    <div class="my-3">
                        <p class="mb-2">Địa điểm làm việc <span class="text-danger">*</span></p>
                        <select class="js-example-basic-multiple-city w-100 py-3" name="states[]" multiple="multiple">
                            
                        </select>
                    </div>
                    <div class="wrapper-btn">
                        <button class="btn btn-secondary mr-3 btn-close-modal" data-dismiss="modal">Không có nhu cầu</button>
                        <button class="btn btn-success btn-on-find-work">Bật tìm việc ngay</button>
                    </div>

                    <div class="wrapper-note mt-5">
                        <p class="mb-0 text-danger py-2 px-3 text-note">
                            Lưu ý: Khi bật tính năng này, Nhà tuyển dụng trên WorkWise sẽ chủ động liên hệ với bạn, hãy sẵn
                            sàng nghe điện thoại để nhận cơ hội tốt.
                        </p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @if (Auth::user()->findJob)
        @foreach (Auth::user()->findJob->json_job as $job)
            <input type="hidden" class="jobs" value="{{$job}}">
        @endforeach

        @foreach (Auth::user()->findJob->json_address as $address)
            <input type="hidden" class="address" value="{{$address}}">
        @endforeach
    @endif
@endsection

@section('script')
    <script src="/script/cv/index.js"></script>
@endsection
