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
                                    <h3>Trang chủ &nbsp; &rarr; &nbsp; Hồ sơ ứng viên đã lưu </h3>
                                </div>

                                <div class="mt-5">
                                    <div class="notfication-details p-0 mt-5">
                                        <table class="table">
                                            <thead class="thead-dark">
                                                <tr>
                                                    <th scope="col" class="text-center">STT</th>
                                                    <th scope="col" class="text-center">Tên ứng viên</th>
                                                    <th scope="col" class="text-center">Ngày lưu</th>
                                                    <th scope="col" class="text-center">Hành động</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @if (count($profiles) > 0)
                                                    @foreach ($profiles as $index => $profile)
                                                        <tr>
                                                            <td class="text-center">{{ ++$index }}</td>
                                                            <td class="text-center">{{ $profile->user->name }}</td>
                                                            <td class="text-center">
                                                                {{ date('d/m/Y', strtotime($profile->created_at)) }}</td>
                                                            <td class="text-center">
                                                                <a href="{{ $profile->path }}" class="btn btn-primary"
                                                                    target="_blank">Xem CV</a>
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
@endsection

@section('script')
    <script>
        var _token = $('meta[name="csrf-token"]').attr('content');
    </script>
@endsection
