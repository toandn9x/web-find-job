@extends('workwise.layouts.master')

@section('style')
    <link rel="stylesheet" href="/workwise/css/work/style.css">
@endsection

@section('main-content')
    <form method="GET" id="formSubmitSearch">
        <main>
            <div class="main-section">
                <div class="container">
                    <div class="main-section-data">
                        <div class="row">
                            <div class="col-lg-12">
                                <h3 class="title-jobsss">
                                    <img src="/workwise/images/icons/exp_ntv_mnhat.png" alt="" class="mr-2">
                                    Danh sách ứng viên
                                </h3>
                                <div class="main-ws-sec mb-5">
                                    <div class="list-candidate d-flex flex-column">
                                        @foreach ($candidates as $candidate)
                                            @if ($candidate->findJob && $candidate->status_cv == 1)
                                                <div class="info-candidate d-flex my-3 bg-white px-3 py-2">
                                                    <div class="avatar-candidate">
                                                        <img src="{{ $candidate->userInfo->CheckEmptyImage() }}"
                                                            alt="" width="95" height="95"
                                                            style="border-radius:50%; object-fit:cover">
                                                    </div>
                                                    <div class="ml-3">
                                                        <div class="d-flex">
                                                            @foreach ($candidate->findJob->json_job as $job)
                                                                <h2 style="font-weight:bold" class="mr-1">
                                                                    {{ $job }},
                                                                </h2>
                                                            @endforeach
                                                        </div>

                                                        <h2 style="color: #F88C00; font-size:16px" class="mt-3">{{ $candidate->name }}</h2>

                                                        <div class="d-flex mt-3">
                                                            <div>
                                                                <img src="/workwise/images/icons/dt_7.png" alt="" class="mr-1"> {{ $user->userInfo->address ?? 'Đang cập nhật' }}
                                                            </div>
                                                            <div class="ml-5">
                                                                <img src="/workwise/images/icons/dt_6.png" alt="" class="mr-1"> Chi tiết trong CV
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-flex flex-column justify-content-center ml-auto">
                                                        <a href="{{ route('chat.index', $candidate->id) }}" target="_blank" style="background: #5DC22D !important; color: white; padding: 7px; border-radius: 20px;" class="d-flex align-items-end justify-content-center">
                                                            <i class="fa fa-weixin mr-1" aria-hidden="true"></i> Chat
                                                        </a>
                                                        <a href="" style="color: #4C5BD4; border:0.8px solid #4C5BD4; padding: 7px; border-radius: 20px;" 
                                                                        class="btn-save-cv mt-2 d-flex align-items-end justify-content-center"
                                                                        data-id="{{ $candidate->id }}">
                                                            <i class="fa fa-floppy-o mr-1" aria-hidden="true"></i> Lưu
                                                        </a>
                                                    </div>
                                                </div>
                                            @endif
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </form>
@endsection

@section('script')
    <script>
            $(document).ready(function () {
                $(".btn-save-cv").on('click', function(e) {

                    let id = $(this).data('id');
                    
                    e.preventDefault();
                    
                    $.ajax({
                        type: "GET",
                        url: "/cv/save-cv/"+ id,
                        dataType: "JSON",
                        success: function (response) {
                            if(response.code == 1) {
                                toastr.info(response.message);
                            }else if(response.code == 0) {
                                toastr.success("Lưu ứng viên thành công");
                            }
                        }
                    });
                })
            });
    </script>
@endsection
