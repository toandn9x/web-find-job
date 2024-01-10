@extends('workwise.layouts.master')

@section('style')
    <link rel="stylesheet" href="/workwise/css/work/create.css">
@endsection

@section('main-content')
    <section class="profile-account-setting">
        <div class="container-fluid">
            <div class="account-tabs-setting">
                <div class="row">
                    <div class="col-lg-9">
                        <div class="tab-content" id="nav-tabContent">
                            <div class="tab-pane fade active show" id="nav-notification" role="tabpanel"
                                aria-labelledby="nav-notification-tab">
                                <div class="acc-setting">
                                    <h3>Chỉnh sửa tin</h3>
                                    <div class="notifications-list">
                                        <div class="notfication-details">
                                            <form action="{{ route('job.update') }}" id="formSubmit" method="POST">
                                                @csrf
                                                <input type="hidden" name="id" id="" value="{{ $job->id }}">
                                                <p class="title_dm">Thông tin việc làm</p>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12 mb-4">
                                                        <label for="lg_title" class="mb-3">Vị trí đăng tuyển <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control enter_ipt" id="lg_title"
                                                            placeholder="Ví dụ: Nhân viên IT, Nhân viên kinh doanh, ..."
                                                            name="lg_title" data-error="#error_lg_title" value="{{ $job->title }}">
                                                        <span class="form_error" id="error_lg_title">&nbsp;</span>
                                                    </div>

                                                    <div class="form-group col-md-6 mb-4">
                                                        <label class="mb-3" for="lg_cate">Ngành nghề <span
                                                                class="text-danger">*</span></label>
                                                        <br>
                                                        <select class="custom-select js-example-basic-single enter_sel" name="lg_cate"
                                                            id="lg_cate" data-error="#error_lg_cate">
                                                            <option selected>{{ $job->category }}</option>
                                                        </select>
                                                        <span class="form_error" id="error_lg_cate">&nbsp;</span>
                                                    </div>

                                                    <div class="form-group col-md-6 mb-4">
                                                        <label for="lg_qty" class="mb-3">Số lượng cần tuyển <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control enter_ipt" id="lg_qty"
                                                            placeholder="Số lượng tuyển" name="lg_qty" data-error="#error_lg_qty" value="{{ $job->qty }}">
                                                        <span class="form_error" id="error_lg_qty">&nbsp;</span>
                                                    </div>

                                                    <div class="form-group col-md-6 mb-4">
                                                        <label for="lg_rank" class="mb-3">Cấp bậc <span
                                                                class="text-danger">*</span></label>
                                                        <select class="custom-select enter_sel" name="lg_rank" id="lg_rank" data-error="#error_lg_rank">
                                                            <option selected disabled>Chọn cấp bậc</option>
                                                            @foreach (App\Models\Job::$rank_text as $key => $val)
                                                                <option value="{{ $key }}" {{ $job->rank == $key ? 'selected':'' }}>{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="form_error" id="error_lg_rank">&nbsp;</span>
                                                    </div>

                                                    <div class="form-group col-md-6 mb-4">
                                                        <label for="lg_time_work" class="mb-3">Hình thức làm việc <span
                                                                class="text-danger">*</span></label>
                                                        <select class="custom-select enter_sel" name="lg_time_work" id="lg_time_work" data-error="#error_lg_time_work">
                                                            <option selected disabled>Chọn hình thức</option>
                                                            @foreach (App\Models\Job::$method_work_text as $key => $val)
                                                                <option value="{{ $key }}" {{ $job->form_time_work == $key ? 'selected':'' }}>{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                        <span class="form_error" id="error_lg_time_work">&nbsp;</span>
                                                    </div>

                                                    <div class="form-group col-md-6 mb-4">
                                                        <label for="lg_city" class="mb-3">Tỉnh thành làm việc <span
                                                                class="text-danger">*</span></label>
                                                        <br>
                                                        <select class="custom-select js-example-basic-single-city enter_sel"
                                                            name="lg_city" id="lg_city" data-error="#error_lg_city">
                                                            <option selected>{{ $job->city }}</option>
                                                        </select>
                                                        <span class="form_error" id="error_lg_city">&nbsp;</span>
                                                    </div>

                                                    <div class="form-group col-md-12 mb-4">
                                                        <label for="lg_addr" class="mb-3">Địa chỉ chi tiết <span
                                                                class="text-danger">*</span></label>
                                                        <input type="text" class="form-control enter_ipt" id="lg_addr"
                                                            placeholder="Ví dụ: Số nhà 13 Thiên Đàng, Bầu Trời"
                                                            name="lg_addr" data-error="#error_lg_addr" value="{{ $job->address }}">
                                                        <span class="form_error" id="error_lg_addr">&nbsp;</span>
                                                    </div>

                                                    <div class="form-group col-md-3 mb-4">
                                                        <label for="lg_money" class="mb-3">Mức lương <span
                                                                class="text-danger">*</span></label>
                                                        <select class="custom-select" name="lg_money" id="lg_money">
                                                            <option selected value="1">VNĐ</option>
                                                        </select>
                                                        <span class="form_error text-left" id="error_lg_money">&nbsp;</span>
                                                    </div>

                                                    <div class="form-group col-md-3 mb-4">
                                                        <label for="new_money_type" class="mb-3">&nbsp;</label>
                                                        <select class="custom-select" name="new_money_type"
                                                            id="new_money_type">
                                                            <option value="1" {{ $job->money_type == 1 ? 'selected':'' }}>Thỏa thuận</option>
                                                            <option value="2" {{ $job->money_type == 2 ? 'selected':'' }}>Cố định</option>
                                                            <option value="3" {{ $job->money_type == 3 ? 'selected':'' }}>Từ mức - Đến mức</option>
                                                            <option value="4" {{ $job->money_type == 4 ? 'selected':'' }}>Trong khoảng</option>
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-3 mb-4 wrp_new_money_min" {{ $job->money_type == 2 || $job->money_type == 3 ? 'style=display:block' : '' }}>
                                                        <label for="new_money_min" class="mb-3">&nbsp;</label>
                                                        <input type="text" class="form-control" name="new_money_min"
                                                            id="new_money_min" placeholder="Từ mức lương" data-error="#error_lg_money" value="{{ $job->money_min }}">
                                                    </div>
                                                    <div class="form-group col-md-3 mb-4 wrp_new_money_max" {{ $job->money_type == 3 ? "style=display:block" : '' }} >
                                                        <label for="new_money_max" class="mb-3">&nbsp;</label>
                                                        <input type="text" class="form-control" name="new_money_max"
                                                            id="new_money_max" placeholder="Đến mức lượng" data-error="#error_lg_money" value="{{ $job->money_max }}">
                                                    </div>

                                                    <div class="form-group col-md-6 mb-4 wrp_new_money_kg" {{ $job->money_type == 4 ? 'style=display:block' : '' }}>
                                                        <label for="new_money_kg" class="mb-3">&nbsp;</label>
                                                        <select class="custom-select" name="new_money_kg"
                                                            id="new_money_kg" {{ $job->money_type != 4 ? 'disabled' : '' }}>
                                                            @foreach (App\Models\Job::$money_text as $key => $val)
                                                                <option value="{{ $key }}" {{ $job->money_kg == $key ? 'selected':''}}>{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>

                                                <p class="title_dm">Mô tả công việc</p>

                                                <div class="form-row">
                                                    <div class="form-group col-md-12 mb-4">
                                                        <label for="lg_descirption" class="mb-3">Mô tả công việc <span
                                                                class="text-danger">*</span></label>
                                                        <span class="form_error mb-3" id="error_lg_description">&nbsp;</span>
                                                        <textarea name="lg_descirption" id="lg_descirption" data-error="#error_lg_description">
                                                            {!! $job->description !!}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                <p class="title_dm">Yêu cầu công việc</p>

                                                <div class="form-row">
                                                    <div class="form-group col-md-12 mb-4">
                                                        <label for="lg_experience" class="mb-3">Kinh nghiệm <span
                                                                class="text-danger">*</span></label>
                                                        <select class="custom-select" name="lg_experience"
                                                            id="lg_experience">
                                                            @foreach (App\Models\Job::$exp_text as $key => $val)
                                                                <option value="{{ $key }}" {{ $job->experience == $key ? 'selected':'' }}>{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-12 mb-4">
                                                        <label for="lg_degree" class="mb-3">Bằng cấp <span
                                                                class="text-danger">*</span></label>
                                                        <select class="custom-select" name="lg_degree" id="lg_degree">
                                                            @foreach (App\Models\Job::$degree_text as $key => $val)
                                                                <option value="{{ $key }}" {{ $job->degree == $key ? 'selected':'' }}>{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-12 mb-4">
                                                        <label for="lg_gender" class="mb-3">Giới tính <span
                                                                class="text-danger">*</span></label>
                                                        <select class="custom-select" name="lg_gender" id="lg_gender">
                                                            @foreach (App\Models\Job::$gender_text as $key => $val)
                                                                <option value="{{ $key }}" {{ $job->gender == $key ? 'selected':'' }}>{{ $val }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>

                                                    <div class="form-group col-md-12 mb-4">
                                                        <label for="lg_request_other" class="mb-3">Yêu cầu khác</label>
                                                        <textarea name="lg_request_other" id="lg_request_other">
                                                            {!! $job->request_other !!}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                <p class="title_dm">Quyền lợi được hưởng</p>

                                                <div class="form-row">
                                                    <div class="form-group col-md-12 mb-4">
                                                        <label for="lg_benefits_enjoyed" class="mb-3">Quyền lợi được
                                                            hưởng <span class="text-danger">*</span></label>
                                                        <span class="form_error mb-3" id="error_lg_benefits_enjoyed">&nbsp;</span>
                                                        <textarea name="lg_benefits_enjoyed" id="lg_benefits_enjoyed" data-error="#error_lg_benefits_enjoyed">
                                                            {!! $job->benefits_enjoyed !!}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                <p class="title_dm">Yêu cầu hồ sơ</p>

                                                <div class="form-row">
                                                    <div class="form-group col-md-12 mb-4">
                                                        <label for="lg_job_application" class="mb-3">Hồ sơ bao gồm</label>
                                                        <textarea name="lg_job_application" id="lg_job_application">
                                                            {!! $job->job_application !!}
                                                        </textarea>
                                                    </div>
                                                </div>

                                                <p class="title_dm">Thời hạn ứng tuyển</p>

                                                <div class="form-group col-md-12 mb-4">
                                                    <input type="date" class="form-control deadlinequne" id="deadline-deadlinequne" name="expired_time" data-ignored value="{{ date('Y-m-d', strtotime($job->expired_time)) }}"/>
                                                </div>
                                                <button type="submit" class="btn btn-primary">Chỉnh sửa</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-3">
                        <div class="acc-leftbar acc-setting">
                            <h3>Thông tin</h3>
                            <div class="notfication-details">
                                <p class="title_dm">Thông tin liên hệ</p>
                                <div class="form-row mt-4">
                                    <div class="form-group col-12 mb-4">
                                        <label for="" class="mb-3">Tên người liên hệ</label>
                                        <input type="text" class="form-control" disabled value="{{ auth()->user()->company->name }}">
                                    </div>

                                    <div class="form-group col-12 mb-4">
                                        <label for="" class="mb-3">Số điện thoại liên hệ</label>
                                        <input type="text" class="form-control" disabled value="{{ auth()->user()->company->phone }}">
                                    </div>

                                    <div class="form-group col-12 mb-4">
                                        <label for="" class="mb-3">Địa chỉ liên hệ</label>
                                        <input type="text" class="form-control" disabled value="{{ auth()->user()->company->address }}">
                                    </div>

                                    <div class="form-group col-12 mb-4">
                                        <label for="" class="mb-3">Email liên hệ</label>
                                        <input type="text" class="form-control" disabled value="{{ auth()->user()->email }}">
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="acc-leftbar acc-setting mt-5" id="wrp-suggest">
                            <h3 class="d-flex align-items-center justify-content-center">
                                <img src="/workwise/images/icons/icon_goiy.svg" alt="">
                                 Gợi ý
                            </h3>
                            <div class="notfication-details">
                                <div class="form-row">
                                    <div class="form-group col-12 mb-3">
                                        <div class="form_item">
                                            <div class="left_form_item">
                                                <div class="bg_img_suggest"></div>
                                                <p>Mô tả công việc</p>
                                            </div>
                                            <div class="right_form_item">
                                                <div class="bg_img_dropdown"></div>
                                            </div>
                                        </div>
                                        <p class="text_suggest">
                                            Vui lòng nêu rõ<br>
                                            - Tiêu đề cho vị trí công việc cần tuyển dụng là gì?<br>
                                            => Phần này nêu tên chính xác của vị trí công việc cần tuyển dụng<br>
                                            - Mục tiêu của vị trí công việc: “vị trí này tồn tại để làm gì cho công ty?”<br>
                                            - Các nhiệm vụ chính của vị trí công việc là gì?<br>
                                            - Địa chỉ nơi làm việc<br>
                                            - Nội dung công việc cần thực hiện: ...
                                        </p>
                                    </div>

                                    <div class="form-group col-12 mb-4">
                                        <div class="form_item">
                                            <div class="left_form_item">
                                                <div class="bg_img_suggest"></div>
                                                <p>Yêu cầu công việc</p>
                                            </div>
                                            <div class="right_form_item">
                                                <div class="bg_img_dropdown"></div>
                                            </div>
                                        </div>
                                        <p class="text_suggest">
                                            Vui lòng nêu rõ<br>
                                            - Trách nhiệm của nhân viên cần làm là gì?<br>
                                            - Nhiệm vụ công việc cần thực hiện hàng ngày là gì?<br>
                                            - Những kỹ năng nào cần có để thực hiện công việc tốt nhất?<br>
                                            + Những kỹ năng bắt buộc (Những kỹ năng cần có là gì?)<br>
                                            + Những kỹ năng mang tính khuyến khích (Ngoài ra ứng viên có thể đáp ứng những kỹ năng nào để phát triển công việc tốt nhất?)<br>
                                            - Bằng cấp, chứng chỉ phù hợp với công việc<br>
                                            - Yêu cầu về kinh nghiệm, thái độ, phẩm chất/thái<br>
                                            - Ngoài ra tùy vào đặc thù công việc tuyển dụng để nêu ra các yêu cầu khác như giới tính, ngoại hình,...<br>
                                        </p>
                                    </div>

                                    <div class="form-group col-12 mb-4">
                                        <div class="form_item">
                                            <div class="left_form_item">
                                                <div class="bg_img_suggest"></div>
                                                <p>Quyền lợi được hưởng</p>
                                            </div>
                                            <div class="right_form_item">
                                                <div class="bg_img_dropdown"></div>
                                            </div>
                                        </div>
                                        <p class="text_suggest">
                                            Vui lòng nêu rõ<br>
                                            - Chế độ về mức lương, thưởng, chế độ đãi ngộ.<br>
                                            - Các chế độ đóng bảo hiểm xã hội và phúc lợi khác của nhân viên cụ thể là gì?<br>
                                            - Môi trường làm việc của công ty hấp dẫn như thế nào? Có thể mang đến những cơ hội học tập, huấn luyện cho ứng viên ra sao?<br>
                                            - Cơ hội thăng tiến của nhân viên là như thế nào?<br>
                                        </p>
                                    </div>

                                    <div class="form-group col-12 mb-4">
                                        <div class="form_item">
                                            <div class="left_form_item">
                                                <div class="bg_img_suggest"></div>
                                                <p>Yêu cầu hồ sơ</p>
                                            </div>
                                            <div class="right_form_item">
                                                <div class="bg_img_dropdown"></div>
                                            </div>
                                        </div>
                                        <p class="text_suggest">
                                            - Đơn xin việc.<br>
                                            - Sơ yếu lý lịch.<br>
                                            - Hộ khẩu, chứng minh nhân dân và giấy khám sức khoẻ.<br>
                                            - Các bằng cấp có liên quan.<br>
                                        </p>
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
    <script src="/script/works/index.js"></script>
@endsection
