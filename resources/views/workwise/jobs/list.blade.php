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
                                    <h3>Trang chủ &nbsp; &rarr; &nbsp; Tin đã đăng </h3>
                                </div>

                                <div class="mt-5">
                                    <div class="notfication-details p-0 mt-5">
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col" class="text-center">STT</th>
                                                    <th scope="col" class="text-center">Vị trí tuyển dụng</th>
                                                    <th scope="col" class="text-center">Lượt xem</th>
                                                    <th scope="col" class="text-center">Trạng thái</th>
                                                    <th scope="col" class="text-center">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($jobs as $index => $job)
                                                    <tr>
                                                        <th scope="row" class="text-center">{{ ++$index }}</th>
                                                        <td class="text-center">
                                                            <a href="{{ route('job.detail', $job->id) }}" class="d-block">
                                                                {{ $job->title }}
                                                            </a>
                                                            <br>
                                                            Cập nhật lúc: {{ date('H:m'), strtotime($job->updated_at) }} ngày {{ date('d/m/Y'), strtotime($job->updated_at) }}
                                                        </td>
                                                        <td class="text-center">{{ number_format($job->views,0, '', '.') }}</td>
                                                        <td class="text-center">Tin đã được đăng</td>
                                                        <td class="text-center">
                                                            <a href="{{ route('job.edit', $job->id) }}" class="btn btn-primary btn-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Chỉnh sửa tin">
                                                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                                            </a>
                                                            <form action="{{ route('job.destroy', $job->id) }}" class="d-inline-block" method="POST">
                                                                @csrf
                                                                <button type="button" class="btn btn-danger btn-sm btn_delete_job" data-bs-toggle="tooltip" data-bs-placement="top" title="Xóa tin"> <i class="fa fa-trash" aria-hidden="true"></i> </button>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endforeach
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
    <script src="/script/works/delete.js"></script>
@endsection