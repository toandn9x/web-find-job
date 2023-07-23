@extends('workwise.layouts.master', ['title' => 'Tran Dinh Nghia | WorkWise'])

@section('style')
    <link rel="stylesheet" href="/workwise/css/setting-profile/style.css">
@endsection

@section('main-content')
    <section class="profile-account-setting">
        <div class="container">
            <div class="account-tabs-setting">
                <div class="row">
                    <div class="col-lg-4">
                        <div class="acc-leftbar">
                            <div class="nav nav-tabs" id="nav-tab" role="tablist">
                                <a class="nav-item nav-link active" id="security" data-toggle="tab" href="#security-login"
                                    role="tab" aria-controls="security-login" aria-selected="false"><i
                                        class="fa fa-user-secret"></i>Thông tin liên hệ và cơ bản</a>
                                <a class="nav-item nav-link" id="nav-password-tab" data-toggle="tab" href="#nav-password"
                                    role="tab" aria-controls="nav-password" aria-selected="false"><i
                                        class="fa fa-lock"></i>Thay đổi mật khẩu</a>
                                @can('viewCompany', $user)
                                    <a class="nav-item nav-link" id="nav-privacy-tab" data-toggle="tab" href="#privacy"
                                    role="tab" aria-controls="privacy" aria-selected="false"><i
                                        class="la la-building"></i>Thông tin công ty</a>
                                @endcan
                                <a class="nav-item nav-link" id="nav-blockking-tab" data-toggle="tab" href="#blockking"
                                        role="tab" aria-controls="blockking" aria-selected="false"><i
                                            class="fa fa-cc-diners-club"></i>FAQ</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-8">
                        <div class="tab-content" id="nav-tabContent">
                            {{-- Start thay đổi mật khẩu --}}
                            <div class="tab-pane fade" id="nav-password" role="tabpanel"
                                aria-labelledby="nav-password-tab">
                                <div class="acc-setting">
                                    <h3>Thay đổi mật khẩu</h3>
                                    <form action="{{ route('user.setting-profile.change-password', Auth::user()->id) }}"
                                        method="POST" id="change-password">
                                        @csrf
                                        <div class="cp-field">
                                            <h5>Mật khẩu cũ<span class="text-danger">&nbsp; *</span></h5>
                                            <div class="cpp-fiel">
                                                <input type="password" name="old-password" placeholder="Mật khẩu cũ"
                                                    class="enter-input" data-error="#errOpC">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <span id="errOpC" class="error-register">&nbsp;</span>
                                        </div>
                                        <div class="cp-field">
                                            <h5>Mật khẩu mới<span class="text-danger">&nbsp; *</span></h5>
                                            <div class="cpp-fiel">
                                                <input type="password" name="password" placeholder="Mật khẩu mới"
                                                    id="password" class="enter-input" data-error="#errPwC">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <span id="errPwC" class="error-register">&nbsp;</span>
                                        </div>
                                        <div class="cp-field">
                                            <h5>Xác nhận mật khẩu mới<span class="text-danger">&nbsp; *</span></h5>
                                            <div class="cpp-fiel">
                                                <input type="password" name="repeat-password"
                                                    placeholder="Xác thực mật khẩu" class="enter-input"
                                                    data-error="#errRPwC">
                                                <i class="fa fa-lock"></i>
                                            </div>
                                            <span id="errRPwC" class="error-register">&nbsp;</span>
                                        </div>
                                        <div class="save-stngs pd2">
                                            <ul>
                                                <li><button type="submit">Lưu</button></li>
                                            </ul>
                                        </div>
                                    </form>
                                </div>
                            </div>
                            {{-- End thay đổi mật khẩu --}}
                            
                            {{-- Start thông tin liên hệ và cơ bản --}}
                            <div class="tab-pane fade active show" id="security-login" role="tabpanel"
                                aria-labelledby="security">
                                <div class="privacy security">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Thông tin liên hệ</h3>
                                            <div class="wrp-contact-info">
                                                <div class="contact-info mb-3 mt-3">
                                                    <img src="/workwise/images/icons/P1gdNPNhMhn.png" alt="" class="hidden-update">
                                                    <p class="info hidden-update">
                                                        <span class="text-contact-info phone-info">{{ $user->userInfo->phone ?? "Đang cập nhật" }}</span>
                                                        <span>Di động</span>
                                                    </p>
                                                    <i class="la la-edit icon-edit btn-edit hidden-update"
                                                        data-info-base="edit-phone"></i>
                                                    <div class="ipt-update-address ipt-edit">
                                                        <input type="text" class="form-control" id="phone"
                                                            value="{{ $user->userInfo->phone }}"
                                                            data-val-old="{{ $user->userInfo->phone }}"
                                                            placeholder="Số điện thoại">
                                                        <span class="error-phone"></span>
                                                        <div class="wrp-btn-update-address">
                                                            <button class="btn btn-secondary btn-sm btn-cancel-update"
                                                                data-info-base="edit-phone">Hủy</button>
                                                            <button class="btn btn-primary btn-sm btn-access-update btn-update-phone"
                                                                data-info-base="edit-phone" disabled>Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="contact-info mb-3">
                                                    <img src="/workwise/images/icons/xvEObuNKnwt.png" alt="">
                                                    <p class="info">
                                                        <span class="text-contact-info">{{ $user->email }}</span>
                                                        <span>Email</span>
                                                    </p>
                                                </div>
                                                <div class="contact-info mb-3">
                                                    <i class="fa fa-user icon-role"></i>
                                                    <p class="info">
                                                        <span class="text-contact-info">{{ $user->role_text }}</span>
                                                        <span>Vai trò</span>
                                                    </p>
                                                </div>
                                            </div>
                                            <hr>
                                            <h3>Các trang web và liên kết xã hội</h3>
                                            <div class="wrp-link-web mt-3">
                                                <div class="wrp-get-links mb-5">
                                                    @if ($user->userInfo->links)
                                                        @foreach ($user->userInfo->links_url_json as $key => $value)
                                                            <div class="info-links d-flex align-items-center mt-3">
                                                                <img width="24" height="24"
                                                                    src="/workwise/images/icons/Tfkd21nE_8j.png"
                                                                    alt="">
                                                                <p class="info">
                                                                    <a href="{{ $value }}" target="_blank"
                                                                        class="href-url-link">{{ $value }}</a>
                                                                    <span>Trang web</span>
                                                                </p>
                                                            </div>
                                                        @endforeach
                                                    @endif
                                                </div>
                                                <div class="wrp-add-link">
                                                    <i class="la la-plus icon-add-link"></i>
                                                    <span id="add-link">Thêm liên kết</span>
                                                </div>
                                                <div class="wrp-ipt-add-link">
                                                    <div class="ipt-links">
                                                        @if ($user->userInfo->links)
                                                            @foreach ($user->userInfo->links_url_json as $key => $value)
                                                                <div class="info-links d-flex align-items-center">
                                                                    <input type="text"
                                                                        class="form-control ipt-add-link mt-2"
                                                                        name="links[]" placeholder="Đường dẫn trang web"
                                                                        value="{{ $value }}"
                                                                        data-value-old="{{ $value }}">
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                    <div class="btn-add-ipt-link">
                                                        <i class="la la-plus icon-add-ipt-link"></i>
                                                        <span>Thêm một liên kết</span>
                                                    </div>
                                                    <div class="wrp-btn-add-link">
                                                        <button
                                                            class="btn btn-secondary btn-sm btn-cancel-add-links">Hủy</button>
                                                        <button
                                                            class="btn btn-primary btn-sm btn-access-add-link">Lưu</button>
                                                    </div>
                                                </div>
                                            </div>

                                            <hr>
                                            <h3>Thông tin cơ bản</h3>
                                            <div class="wrp-info-base">
                                                <div class="contact-info-base mb-3 mt-3">
                                                    <i class="fa fa-user-secret icon-nick-name hidden-update"></i>
                                                    <p class="info hidden-update">
                                                        <span
                                                            class="text-contact-info nick-name-info">{{ $user->userInfo->nick_name ?? 'Đang cập nhật' }}</span>
                                                        <span>Biệt danh</span>
                                                    </p>
                                                    <i class="la la-edit icon-edit btn-edit hidden-update"
                                                        data-info-base="edit-nick-name"></i>
                                                    <div class="ipt-update-address ipt-edit">
                                                        <input type="text" class="form-control" id="nick-name"
                                                            value="{{ $user->userInfo->nick_name }}"
                                                            data-val-old="{{ $user->userInfo->nick_name }}"
                                                            placeholder="Biệt danh">
                                                        <div class="wrp-btn-update-address">
                                                            <button class="btn btn-secondary btn-sm btn-cancel-update"
                                                                data-info-base="edit-nick-name">Hủy</button>
                                                            <button class="btn btn-primary btn-sm btn-access-update"
                                                                data-info-base="edit-nick-name">Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="contact-info-base mb-3 mt-3">
                                                    <img src="/workwise/images/icons/9RISa0HPFnB.png" alt=""
                                                        class="hidden-update">
                                                    <p class="info hidden-update">
                                                        <span
                                                            class="text-contact-info address-contact-info">{{ $user->userInfo->address ?? 'Đang cập nhật' }}</span>
                                                        <span>Địa chỉ</span>
                                                    </p>
                                                    <i class="la la-edit icon-edit btn-edit hidden-update"
                                                        data-info-base="edit-address"></i>
                                                    <div class="ipt-update-address ipt-edit">
                                                        <input type="text" class="form-control" id="address"
                                                            value="{{ $user->userInfo->address }}"
                                                            data-val-old="{{ $user->userInfo->address }}"
                                                            placeholder="Địa chỉ">
                                                        <div class="wrp-btn-update-address">
                                                            <button class="btn btn-secondary btn-sm btn-cancel-update"
                                                                data-info-base="edit-address">Hủy</button>
                                                            <button class="btn btn-primary btn-sm btn-access-update"
                                                                data-info-base="edit-address">Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="contact-info-base mb-3 mt-3">
                                                    <img src="{{ $user->userInfo->gender_text['icon'] }}" alt=""
                                                        class="img-icon-gender hidden-update">
                                                    <p class="info hidden-update">
                                                        <span
                                                            class="text-contact-info gender-info">{{ $user->userInfo->gender_text['text'] }}</span>
                                                        <span>Giới tính</span>
                                                    </p>
                                                    <i class="la la-edit icon-edit btn-edit hidden-update"
                                                        data-info-base="edit-gender"></i>
                                                    <div class="ipt-update-gender ipt-edit">
                                                        <select id="select-gender" class="form-control">
                                                            @foreach (App\Models\UserInfo::$gender_text as $key => $value)
                                                                <option value="{{ $key }}"
                                                                    data-img-gender={{ $value['icon'] }}
                                                                    {{ $user->userInfo->gender == $key ? 'selected' : '' }}>
                                                                    {{ $value['text'] }}</option>
                                                            @endforeach

                                                        </select>
                                                        <div class="wrp-btn-update-address">
                                                            <button class="btn btn-secondary btn-sm btn-cancel-update"
                                                                data-info-base="edit-gender">Hủy</button>
                                                            <button
                                                                class="btn btn-primary btn-sm btn-access-update btn-update-gender"
                                                                data-info-base="edit-gender" disabled>Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="contact-info-base mb-3 mt-3">
                                                    <img src="/workwise/images/icons/RuWoPd8_oMo.png" alt=""
                                                        class="hidden-update">
                                                    <p class="info hidden-update">
                                                        <span class="text-contact-info"><span
                                                                id="date">{{ $user->userInfo->birthday ? date('d', strtotime($user->userInfo->birthday)) : '' }}</span>&nbsp;tháng&nbsp;<span
                                                                id="month">{{ $user->userInfo->birthday ? date('m', strtotime($user->userInfo->birthday)) : '' }}</span></span>
                                                        <span>Ngày sinh</span>
                                                        <span class="text-contact-info mt-3"><span
                                                                id="year">{{ $user->userInfo->birthday ? date('Y', strtotime($user->userInfo->birthday)) : '' }}</span></span>
                                                        <span>Năm sinh</span>
                                                    </p>
                                                    <i class="la la-edit icon-edit btn-edit hidden-update"
                                                        data-info-base="edit-date"></i>
                                                    <div class="ipt-update-date ipt-edit">
                                                        <div class="w-100 d-flex wrp-select-date">
                                                            <select name="" id="years" class="form-control">
                                                                <option value="null" selected>Năm</option>
                                                            </select>
                                                            <select name="" id="months" class="form-control">
                                                                <option value="null" selected>Tháng</option>
                                                                <option value="1">Tháng 1</option>
                                                                <option value="2">Tháng 2</option>
                                                                <option value="3">Tháng 3</option>
                                                                <option value="4">Tháng 4</option>
                                                                <option value="5">Tháng 5</option>
                                                                <option value="6">Tháng 6</option>
                                                                <option value="7">Tháng 7</option>
                                                                <option value="8">Tháng 8</option>
                                                                <option value="9">Tháng 9</option>
                                                                <option value="10">Tháng 10</option>
                                                                <option value="11">Tháng 11</option>
                                                                <option value="12">Tháng 12</option>
                                                            </select>
                                                            <select name="" id="dates" class="form-control">
                                                            </select>
                                                        </div>
                                                        <div class="wrp-btn-update-address">
                                                            <button class="btn btn-secondary btn-sm btn-cancel-update"
                                                                data-info-base="edit-date">Hủy</button>
                                                            <button
                                                                class="btn btn-primary btn-sm btn-access-update btn-update-date"
                                                                data-info-base="edit-date" disabled>Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            {{-- End thông tin liên hệ và cơ bản --}}
                            <div class="tab-pane fade" id="blockking" role="tabpanel"
                                aria-labelledby="nav-blockking-tab">
                                <div class="helpforum">
                                    <div class="row">
                                        <div class="col-12 security">
                                            <h3>Blocking</h3>
                                            <hr>
                                        </div>
                                        <div class="row">
                                            <div class="col-12">
                                                <h4>Blocking</h4>
                                                <p>See your list,and make changes if you'd like</p>
                                                <div class="bloktext">
                                                    <p>You are not bloking anyone</p>
                                                    <p>Need to blok or report someone? Go to the profile of the
                                                        person you want to blok and select "Blok or Report" from the
                                                        drowp-down menu at the top of the profile summery</p>
                                                    <p>Note: After you have blocked the person, Any previous profile
                                                        views of yours and of the other person will disappear from
                                                        each of your "Who's viewed your profile" sections. </p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="tab-pane fade" id="privciy" role="tabpanel" aria-labelledby="nav-privcy-tab">
                                <div class="acc-setting">
                                    <h3>Requests</h3>
                                    <div class="requests-list">
                                        <div class="request-details">
                                            <div class="noty-user-img">
                                                <img src="/workwise/images/resources/r-img1.png" alt>
                                            </div>
                                            <div class="request-info">
                                                <h3>Jessica William</h3>
                                                <span>Graphic Designer</span>
                                            </div>
                                            <div class="accept-feat">
                                                <ul>
                                                    <li><button type="submit" class="accept-req">Accept</button>
                                                    </li>
                                                    <li><button type="submit" class="close-req"><i
                                                                class="la la-close"></i></button></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="request-details">
                                            <div class="noty-user-img">
                                                <img src="/workwise/images/resources/r-img2.png" alt>
                                            </div>
                                            <div class="request-info">
                                                <h3>John Doe</h3>
                                                <span>PHP Developer</span>
                                            </div>
                                            <div class="accept-feat">
                                                <ul>
                                                    <li><button type="submit" class="accept-req">Accept</button>
                                                    </li>
                                                    <li><button type="submit" class="close-req"><i
                                                                class="la la-close"></i></button></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="request-details">
                                            <div class="noty-user-img">
                                                <img src="/workwise/images/resources/r-img3.png" alt>
                                            </div>
                                            <div class="request-info">
                                                <h3>Poonam</h3>
                                                <span>Wordpress Developer</span>
                                            </div>
                                            <div class="accept-feat">
                                                <ul>
                                                    <li><button type="submit" class="accept-req">Accept</button>
                                                    </li>
                                                    <li><button type="submit" class="close-req"><i
                                                                class="la la-close"></i></button></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="request-details">
                                            <div class="noty-user-img">
                                                <img src="/workwise/images/resources/r-img4.png" alt>
                                            </div>
                                            <div class="request-info">
                                                <h3>Bill Gates</h3>
                                                <span>C & C++ Developer</span>
                                            </div>
                                            <div class="accept-feat">
                                                <ul>
                                                    <li><button type="submit" class="accept-req">Accept</button>
                                                    </li>
                                                    <li><button type="submit" class="close-req"><i
                                                                class="la la-close"></i></button></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="request-details">
                                            <div class="noty-user-img">
                                                <img src="/workwise/images/resources/r-img5.png" alt>
                                            </div>
                                            <div class="request-info">
                                                <h3>Jessica William</h3>
                                                <span>Graphic Designer</span>
                                            </div>
                                            <div class="accept-feat">
                                                <ul>
                                                    <li><button type="submit" class="accept-req">Accept</button>
                                                    </li>
                                                    <li><button type="submit" class="close-req"><i
                                                                class="la la-close"></i></button></li>
                                                </ul>
                                            </div>
                                        </div>
                                        <div class="request-details">
                                            <div class="noty-user-img">
                                                <img src="/workwise/images/resources/r-img6.png" alt>
                                            </div>
                                            <div class="request-info">
                                                <h3>John Doe</h3>
                                                <span>PHP Developer</span>
                                            </div>
                                            <div class="accept-feat">
                                                <ul>
                                                    <li><button type="submit" class="accept-req">Accept</button>
                                                    </li>
                                                    <li><button type="submit" class="close-req"><i
                                                                class="la la-close"></i></button></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @can('viewCompany', $user)
                            {{-- Start thông tin công ty --}}
                            <div class="tab-pane fade" id="privacy" role="tabpanel" aria-labelledby="nav-privacy-tab">
                                <div class="privacy">
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Thông tin công ty</h3>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-12">
                                            <h3>Logo Công ty</h3>
                                            <input type="hidden" value="{{ $user->company->id }}" class="d-none" id="idCompany">
                                            <div class="wrp-logo-company">
                                                <div class="img-logo-company">
                                                    <img src="{{ $user->company->image_url }}" alt="" id="logo-company" data-old="{{ $user->company->image_url }}"> 
                                                    <i class="fa fa-camera" aria-hidden="true"></i>
                                                    <input type="file" class="d-none" id="ipt-choose-logo">
                                                </div>
                                                <div class="wrp-btn-update-logo text-center">
                                                    <button class="btn btn-secondary btn-sm btn-cancel-update-logo">Hủy</button>
                                                    <button class="btn btn-primary btn-sm btn-access-update-logo">Lưu</button>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <h3>Thông tin liên hệ</h3>
                                            <div class="wrp-contact-info-company">
                                                <div class="contact-info-base mb-3 mt-3">
                                                    <i class="la la-building icon-nick-name hidden-update"></i>
                                                    <p class="info hidden-update">
                                                        <span
                                                            class="text-contact-info name-company-info">{{ $user->company->name }}</span>
                                                        <span>Tên công ty</span>
                                                    </p>
                                                    <i class="la la-edit icon-edit btn-edit hidden-update"
                                                        data-info-base="edit-name"></i>
                                                    <div class="ipt-update-gender ipt-edit">
                                                        <input type="text" class="form-control" id="name-company"
                                                            value="{{ $user->company->name }}"
                                                            data-val-old="{{ $user->company->name }}"
                                                            placeholder="Tên công ty">
                                                        <div class="wrp-btn-update-address">
                                                            <button class="btn btn-secondary btn-sm btn-cancel-update-company"
                                                                data-info-base="edit-name">Hủy</button>
                                                            <button class="btn btn-primary btn-sm btn-access-update-company btn-update-name-company"
                                                                data-info-base="edit-name">Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="contact-info-company mb-3 mt-3">
                                                    <img src="/workwise/images/icons/P1gdNPNhMhn.png" alt="" class="hidden-update">
                                                    <p class="info hidden-update">
                                                        <span class="text-contact-info phone-company-info">{{ $user->company->phone ?? "Đang cập nhật" }}</span>
                                                        <span>Di động</span>
                                                    </p>
                                                    <i class="la la-edit icon-edit btn-edit hidden-update"
                                                        data-info-base="edit-phone"></i>
                                                    <div class="ipt-update-address ipt-edit">
                                                        <input type="text" class="form-control" id="phone-company"
                                                            value="{{ $user->company->phone }}"
                                                            data-val-old="{{ $user->company->phone }}"
                                                            placeholder="Số điện thoại">
                                                        <span class="error-phone-company"></span>
                                                        <div class="wrp-btn-update-address">
                                                            <button class="btn btn-secondary btn-sm btn-cancel-update-company"
                                                                data-info-base="edit-phone">Hủy</button>
                                                            <button class="btn btn-primary btn-sm btn-access-update-company btn-update-phone-company"
                                                                data-info-base="edit-phone">Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="contact-info-base mb-3 mt-3">
                                                    <img src="/workwise/images/icons/9RISa0HPFnB.png" alt=""
                                                        class="hidden-update">
                                                    <p class="info hidden-update">
                                                        <span
                                                            class="text-contact-info address-company-info">{{ $user->company->address ?? 'Đang cập nhật' }}</span>
                                                        <span>Địa chỉ</span>
                                                    </p>
                                                    <i class="la la-edit icon-edit btn-edit hidden-update"
                                                        data-info-base="edit-address"></i>
                                                    <div class="ipt-update-address ipt-edit">
                                                        <input type="text" class="form-control" id="address-company"
                                                            value="{{ $user->company->address }}"
                                                            data-val-old="{{ $user->company->address }}"
                                                            placeholder="Địa chỉ">
                                                        <div class="wrp-btn-update-address">
                                                            <button class="btn btn-secondary btn-sm btn-cancel-update-company"
                                                                data-info-base="edit-address">Hủy</button>
                                                            <button class="btn btn-primary btn-sm btn-access-update-company btn-update-address-company"
                                                                data-info-base="edit-address">Lưu</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <hr>
                                        </div>
                                        <div class="col-12">
                                            <h3 class="title-intro">Giới thiệu
                                                <i class="la la-edit icon-edit btn-edit-introduce"
                                                        data-info-base="edit-introduce"></i>
                                            </h3>
                                            <div class="content-introduce">
                                                {!! $user->company->introduce ?? "<p>Đang cập nhật....</p>" !!}
                                            </div>
                                            <div class="wrp-edit-intro">
                                                <textarea name="editor1" id="editor1" rows="10" cols="80" data-val-old="{!! $user->company->introduce !!}">
                                                    {!! $user->company->introduce !!}
                                                </textarea>
                                                <div class="wrp-btn-update-address">
                                                    <button class="btn btn-secondary btn-sm btn-cancel-update-intro"
                                                                        data-info-base="edit-introduce">Hủy</button>
                                                    <button class="btn btn-primary btn-sm btn-access-update-company btn-update-introduce-company"
                                                        data-info-base="edit-introduce">Lưu</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endcan
                            {{-- End thông tin công ty --}}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('script')
    <script src="/workwise/js/validate.min.js"></script>
    <script src="/script/profile/setting-profile.js"></script>
    <script src="/script/profile/update-company.js"></script>
@endsection
