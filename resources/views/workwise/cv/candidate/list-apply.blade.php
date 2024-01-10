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
                                    <h3>Trang chủ &nbsp; &rarr; &nbsp; Cv đã ứng tuyển </h3>
                                </div>

                                <div class="mt-5">
                                    <div class="notfication-details p-0 mt-5">
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col" class="text-center">STT</th>
                                                    <th scope="col" class="text-center">Tên công ty</th>
                                                    <th scope="col" class="text-center">Vị trí công việc</th>
                                                    <th scope="col" class="text-center">Ngày nộp</th>
                                                    <th scope="col" class="text-center">Kết quả</th>
                                                    <th scope="col" class="text-center">Lịch phỏng vấn</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($user->jobs) > 0)
                                                    @foreach ($user->jobs as $index => $job )
                                                        <tr>
                                                            <td class="text-center">{{ ++$index }}</td>
                                                            <td class="text-center">{{ $job->company->name }}</td>
                                                            <td class="text-center">{{ $job->title }}</td>
                                                            <td class="text-center">
                                                                {{ date('H:i', strtotime($job->pivot->created_at)) }} ngày {{ date('d/m/Y', strtotime($job->pivot->created_at)) }}
                                                            </td>
                                                            <td class="text-center">
                                                                {{ $job->pivot->status == 0 ? "Đang chờ xét duyệt" : ($job->pivot->status == 1 ? "Hẹn phỏng vấn" : ($job->pivot->status ==  2 ? "Hồ sơ không phù hợp" : "Ứng tuyển thành công")); }}
                                                            </td>
                                                            <td class="text-center">{{ $job->pivot->time_interview ? date('H:i', strtotime($job->pivot->time_interview)) ." | ". date('d-m-Y', strtotime($job->pivot->time_interview)) :  "Đang cập nhật" }}</td>
                                                        </tr>
                                                    @endforeach
                                                @else
                                                        <tr>
                                                            <td colspan="6" class="text-center p-5">Không có dữ liệu.....</td>
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
@endsection

@section('script')
    
@endsection