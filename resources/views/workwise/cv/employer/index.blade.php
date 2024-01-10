@extends('workwise.layouts.master')

@section('style')
    <link rel="stylesheet" href="/workwise/css/work/list.css">
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
                                    <h3>Trang chủ &nbsp; &rarr; &nbsp; Quản lí công việc tuyển dụng </h3>
                                </div>

                                <div class="mt-5">
                                    <div class="notfication-details p-0 mt-5">
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col" class="text-center">STT</th>
                                                    <th scope="col" class="text-center">Vị trí tuyển dụng</th>
                                                    <th scope="col" class="text-center">Số ứng tuyển</th>
                                                    <th scope="col" class="text-center">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($jobs) > 0)
                                                    @foreach ($jobs as $index => $job)
                                                        <tr>
                                                            <td class="text-center"> {{ ++$index }} </td>
                                                            <td class="text-center"> {{ $job->title }} </td>
                                                            <td class="text-center"> {{ count($job->users) }} </td>
                                                            <td class="text-center">
                                                                <button class="btn btn-success btn-view-candidate"
                                                                    data-toggle="modal" data-target="#exampleModalCenter"
                                                                    data-id="{{ $job->id }}">
                                                                    Xem danh sách
                                                                </button>
                                                            </td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                    <tr>
                                                        <td colspan="4" class="text-center p-5">Không có dữ liệu....</td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <div class="modal fade" id="exampleModalCenter" tabindex="-1" role="dialog" aria-labelledby="exampleModalCenterTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-xl" role="document">
            <div class="modal-content">
                <div class="header d-flex flex-column align-items-center py-3">
                    <h1 class="header_title-modal mb-2">Danh sách ứng viên</h1>
                    <p class="header_name-work">Công việc: <span class="name-work"></span></p>
                </div>
                <div class="middle-modal px-3">
                    <table class="table">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col" class="text-center">STT</th>
                                <th scope="col" class="text-center">Vị trí tuyển dụng</th>
                                <th scope="col" class="text-center">Tên ứng viên</th>
                                <th scope="col" class="text-center">Ngày nộp</th>
                                <th scope="col" class="text-center">Hành động</th>
                                <th scope="col" class="text-center">Kết quả</th>
                            </tr>
                        </thead>
                        <tbody class="list-candidate">

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    {{-- Modal đặt lịch hẹn phỏng vấn --}}
    <div class="modal fade" id="ModalSetTime" tabindex="-1" role="dialog" aria-labelledby="ModalSetTimeTitle"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg" role="document">
            <div class="modal-content">
                <div class="header d-flex flex-column align-items-center py-3">
                    <h1 class="header_title-modal mb-2">Cập nhật thời gian hẹn phỏng vấn</h1>
                </div>
                <div class="middle-modal px-3" style="height: 150px">
                    <input type="datetime-local" class="form-control" id="time-interview">
                    <div class="mt-3 fl-right">
                        <button class="btn btn-primary" onclick="handleSetTimeInterview()">Cập nhật</button>
                        <button class="btn btn-danger" id="close-modal-set-time" data-dismiss="modal">Hủy bỏ</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        var _token = $('meta[name="csrf-token"]').attr('content');
        var dataAjax = {
            status: '',
            jobId: '',
            userId: '',
            valueStatus: '',
            text: '',
        }

        $(document).ready(function() {
            $('.btn-view-candidate').on('click', function() {
                let id = $(this).data('id');

                $.ajax({
                    type: "POST",
                    url: "/cv/view-candidate",
                    data: {
                        _token,
                        id,
                    },
                    dataType: "JSON",
                    success: function(response) {
                        $('.name-work').text(response.data.title);
                        $('.list-candidate').empty();
                        $.each(response.data.users, function(index, value) {
                            let time_interview = '';
                            if (value.time_interview != null) {
                                let date = new Date(value.time_interview);
                                let hour = date.getHours();
                                let minute = date.getMinutes();
                                let day = date.getDate();
                                let month = date.getMonth() + 1;
                                let year = date.getFullYear();

                                time_interview = "(" + hour + ":" + minute + " ngày " +
                                    day + "/" + month + "/" + year + ")";
                            }
                            $('.list-candidate').append(
                                `<tr>
                                    <td class="text-center">${++index}</td>
                                    <td class="text-center">${response.data.title}</td>
                                    <td class="text-center">${value.name}</td>
                                    <td class="text-center">${value.date_format}</td>
                                    <td class="text-center">
                                        <a href="${value.cv}" class="btn btn-primary" target="_blank">Xem CV</a>
                                    </td>
                                    <td class="text-center hover-menu position-relative ">
                                        <span class="text-menu-status">
                                            ${value.status_apply}
                                        </span>
                                        <div class="position-absolute menu-status">
                                                @foreach (App\Models\MyCv::$status_text as $indexStaus => $valueStatus)
                                                    <a class="status-item status-item-action" data-current="${value.status_value}" data-job="${response.data.id}" data-user="${value.id}" data-value="{{ $indexStaus }}">{{ $valueStatus }}</a>
                                                @endforeach
                                        </div>
                                        <p class="time-await-interview">
                                            ${time_interview}
                                        </p>
                                    </td>
                                </tr>`
                            )
                        });
                        handleSetDisable()
                    }
                });
            });

            $(document).on('click', '.status-item-action', function() {
                let status = $(this);
                let jobId = $(this).data('job');
                let userId = $(this).data('user');
                let valueStatus = $(this).data('value');
                let text = $(this).text();

                if (valueStatus == 1) {
                    dataAjax = {
                        status: status,
                        jobId,
                        userId,
                        valueStatus,
                        text,
                    }
                    return false;
                }
                callAjaxUpdateCv(status, jobId, userId, valueStatus, text);
            });
        });

        function handleSetDisable() {
            for (let i = 0; i < $('.status-item').length; i++) {
                if ($('.status-item').eq(i).data('current') === $('.status-item').eq(i).data('value')) {
                    $('.status-item').eq(i).addClass('status-item-choose');
                }
                if ($('.status-item').eq(i).data('value') <= $('.status-item').eq(i).data('current')) {
                    $('.status-item').eq(i).addClass('status-item-disable');
                    $('.status-item').eq(i).removeClass('status-item-action');
                }
                if ($('.status-item').eq(i).data('value') == 1 && $('.status-item').eq(i).hasClass('status-item-action')) {
                    $('.status-item').eq(i).attr({
                        'data-toggle': 'modal',
                        'data-target': '#ModalSetTime'
                    })
                }
            }
        }

        function handleSetTimeInterview() {
            let time = $('#time-interview').val();
            if (time == '') {
                alert("Vui lòng chọn thời gian phỏng vấn ứng viên.");
                return false;
            } else {
                callAjaxUpdateCv(dataAjax.status, dataAjax.jobId, dataAjax.userId, dataAjax.valueStatus, dataAjax.text,
                    time);
                let date = new Date(time);
                let hour = date.getHours();
                let minute = date.getMinutes();
                let day = date.getDate();
                let month = date.getMonth() + 1;
                let year = date.getFullYear();

                dataAjax.status.parents('.hover-menu').append(
                    `<p class="time-await-interview">
                        ( ${hour}:${minute} ngày ${day}/${month}/${year} )
                    </p>`
                )
                $('#close-modal-set-time').click();
            }
        }

        function callAjaxUpdateCv(status, jobId, userId, valueStatus, text, time = null) {
            $.ajax({
                type: "POST",
                url: "/cv/update-cv-candidate",
                data: {
                    _token,
                    jobId,
                    userId,
                    valueStatus,
                    time,
                },
                dataType: "JSON",
                success: function(response) {
                    status.parent().siblings('.text-menu-status').text(text);
                    status.removeClass('status-item-action').prevAll().removeClass('status-item-action');
                    status.addClass('status-item-choose').prevAll().removeClass('status-item-choose').addClass(
                        'status-item-disable');
                    toastr.success("Cập nhật thành công.");
                }
            });
        }
    </script>
@endsection

{{-- 
<p>(Lịch hẹn Ngày 12-10-2001)</p> --}}
