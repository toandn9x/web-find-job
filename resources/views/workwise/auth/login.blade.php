<!DOCTYPE html>
<html>

{{-- Header --}}
@include('workwise.includes.header', ['title' => 'WorkWise - Đăng nhập hoặc đăng ký'])
<style>
    .error-register {
        display: inline-block;
        margin-bottom: 10px;
        font-style: italic;
        font-size: 13px;
        color: red;
    }

    .fgt-sec {
        float: unset !important;
    }

    #c1,#c2 {
        width: unset;
    }
    #name-role {
        margin-left: 5px;
    }
    input[type=radio] {
        accent-color: #e44d3a;
    }
</style>
<body class="sign-in">
    <div class="wrapper">
        <div class="sign-in-page">
            <div class="signin-popup">
                <div class="signin-pop">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="cmp-info">
                                <div class="cm-logo">
                                    <img src="/workwise/images/cm-logo.png" alt>
                                    <p>Workwise, là một nền tảng trao đổi trên mạng xã hội, nơi mọi người và chuyên gia
                                        độc lập kết nối và cộng tác từ xa</p>
                                </div>
                                <img src="/workwise/images/cm-main-img.png" alt>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="login-sec">
                                <ul class="sign-control">
                                    <li data-tab="tab-1" class="current" id="li-tab-1"><a href="#" class="tab-current" title>Đăng nhập</a></li>
                                    <li data-tab="tab-2" id="li-tab-2"><a href="#" class="tab-current" title>Đăng ký</a></li>
                                </ul>
                                <div class="sign_in_sec current" id="tab-1">
                                    <h3>Đăng nhập</h3>
                                    <form action="{{ route('login') }}" method="POST" class="form-auth" id="login">
                                    @csrf
                                        <div class="row">
                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="text" name="email" class="enter-input" placeholder="Email" data-error="#errNm">
                                                    <i class="la la-user"></i>
                                                </div>
                                                <span id="errNm" class="error-register">&nbsp;</span>
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <div class="sn-field">
                                                    <input type="password" name="password" class="enter-input" placeholder="Mật khẩu" data-error="#errEm">
                                                    <i class="la la-lock"></i>
                                                </div>
                                                <span id="errEm" class="error-register">&nbsp;</span>
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <div class="checky-sec">
                                                    <div class="fgt-sec">
                                                        <input type="checkbox" name="cc" id="c1">
                                                        <label for="c1">
                                                            <span></span>
                                                        </label>
                                                        <small>Ghi nhớ đăng nhập</small>
                                                    </div>
                                                    <a href="#" title>Quên mật khẩu?</a>
                                                </div>
                                            </div>
                                            <div class="col-lg-12 no-pdd">
                                                <button type="submit" value="submit">Đăng nhập</button>
                                            </div>
                                        </div>
                                    </form>
                                    <div class="login-resources">
                                        <h4>Đăng nhập qua tài khoản xã hội</h4>
                                        <ul>
                                            <li><a href="{{ route('redirect-to-facebook') }}" title class="fb"><i
                                                        class="fa fa-facebook"></i>Đăng nhập với tài khoản Facebook</a>
                                            </li>
                                            <li><a href="{{ route('redirect-to-google') }}" title class="tw"><i
                                                        class="fa fa-google"></i>Đăng nhập với tài khoản Google</a></li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="sign_in_sec" id="tab-2">
                                    <h3>Đăng ký</h3>
                                    <div class="dff-tab current" id="tab-3">
                                        <form action="{{ url('/register') }}" method="POST" id="register" class="form-auth">
                                        @csrf
                                            <div class="row">
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="checky-sec st2 d-flex justify-content-between align-items-center mt-0 mb-3">
                                                        <div class="d-flex align-items-center">
                                                            <input type="radio" name="role" id="c2" class="checkbox-choose-role candidate" value="1" checked>
                                                            <small id="name-role">Người ứng tuyển</small>
                                                        </div>
                                                        <div class="d-flex align-items-center">
                                                            <input type="radio" name="role" id="c1" class="checkbox-choose-role employer" value="2">
                                                            <small id="name-role">Nhà tuyển dụng</small>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <i class="la la-user"></i>
                                                        <input type="text" name="name" class="enter-input" placeholder="Họ và tên" data-error="#errNmR">
                                                    </div>
                                                    <span id="errNmR" class="error-register">&nbsp;</span>
                                                </div>
                                                <div class="col-lg-12 no-pdd" id="wrp-company">
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="text" name="email" class="enter-input" placeholder="Email" data-error="#errEmR">
                                                        <i class="la la-envelope"></i>
                                                    </div>
                                                    <span id="errEmR" class="error-register">&nbsp;</span>
                                                </div>
                                                <div class="col-lg-12 no-pdd" id="wrp-phone">
                                                </div>
                                                <div class="col-lg-12 no-pdd" id="wrp-address">
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="password" name="password" id="password" class="enter-input" placeholder="Mật khẩu" data-error="#errPwR">
                                                        <i class="la la-lock"></i>
                                                    </div>
                                                    <span id="errPwR" class="error-register">&nbsp;</span>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <div class="sn-field">
                                                        <input type="password" name="repeat-password" class="enter-input"
                                                            placeholder="Nhập lại nhập khẩu" data-error="#errRPwR">
                                                        <i class="la la-lock"></i>
                                                    </div>
                                                    <span id="errRPwR" class="error-register">&nbsp;</span>
                                                </div>
                                                <div class="col-lg-12 no-pdd">
                                                    <button type="submit" value="submit">Đăng ký</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="footy-sec">
                <div class="container">
                    <p><img src="/workwise/images/copy-icon.png" alt>2023 WorkWise. Được phát triển bởi DNDev</p>
                </div>
            </div>
        </div>
    </div>

    {{-- Footer --}}
    @include('workwise.includes.footer')
    <script src="/workwise/auth.js"></script>
</body>

</html>
