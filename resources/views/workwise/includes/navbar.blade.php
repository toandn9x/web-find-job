<header>
    <div class="container">
        <div class="header-data">
            <div class="logo">
                <a href="{{ route('home') }}" title id="logo"><img src="/workwise/images/logo.png" alt> <span
                        id="name_logo">WorkWise</span></a>
            </div>
            <div class="search-bar">
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="{{ url('/home') }}" title>
                            <span><img src="/workwise/images/icon1.png" alt></span>
                            Trang chủ
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('home') }}" title>
                            <span><img src="/workwise/images/icon5.png" alt></span>
                            Tìm việc làm
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('handbook') }}" title>
                            <span><i class="fa fa-book" aria-hidden="true"></i></span>
                            Cẩm nang
                        </a>
                    </li>
                    @if (Auth::check())
                        <li>
                            <a href="{{ route('home.socail') }}" title>
                                <span><i class="fa fa-envira" aria-hidden="true"></i></span>
                                Mạng xã hội
                            </a>
                        </li>

                        <li>
                            <a href="{{ route('chat.index', Auth::user()->id) }}" target="_blank"
                                style="position: relative">
                                <span><i class="fa fa-weixin" aria-hidden="true"></i></span>
                                Chat
                                @if (Auth::user()->friends()->wherePivot('status', 1)->count() > 0)
                                    <span
                                        style="position: absolute;
                                    width: 15px;
                                    height: 15px;
                                    background: #007bff;
                                    border-radius: 50%;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    font-weight: bold;
                                    top: -10px;
                                    right: -10px;
                                    font-size: 12px">
                                        {{ Auth::user()->friends()->wherePivot('status', 1)->count() }} </span>
                                @endif
                            </a>
                        </li>

                        <li style="position: relative">
                            <a style="position: relative; color:white; cursor: pointer;" class="not-box-openm">
                                <span><img src="/workwise/images/icon6.png" alt></span>
                                Thông báo
                                <span
                                    style="position: absolute;
                                    width: 15px;
                                    height: 15px;
                                    background: #007bff;
                                    border-radius: 50%;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    font-weight: bold;
                                    top: -10px;
                                    right: -10px;
                                    font-size: 12px"
                                    id="number-notification">
                                    {{ count($notifications) }} </span>
                            </a>
                            <div class="notification-box msg" id="message">
                                <div class="nt-title">
                                    <h4 class="notifi">Thông báo</h4>
                                </div>
                                <div class="nott-list py-3">
                                    @if (count($notifications) > 0)
                                        @foreach ($notifications as $notification)
                                            <a href="{{ $notification->path }}">
                                                <div class="notfication-detail px-2 mb-3">
                                                    <div class="noty-user-img">
                                                        <img src="{{ $notification->sender->company->image_url ?? $notification->sender->userInfo->CheckEmptyImage() }}"
                                                            alt class="img-notifi">
                                                    </div>
                                                    <div class="notification-info">
                                                        <h3 class="name-notify">{{ $notification->sender->company->name ?? $notification->sender->name }}</h3>
                                                        <p class="text-notify">{{ $notification->content }}</p>
                                                        <span class="dot-notify"></span>
                                                        <p class="time-notify">{{ $notification->getTimeAgo($notification->created_at) }}</p>
                                                    </div>
                                                </div>
                                            </a>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                            <style>
                                .notifi {
                                    font-size: 17px !important;
                                    font-weight: bold !important;
                                }

                                .notfication-detail {
                                    display: flex !important;
                                    justify-content: space-between;
                                }

                                .name-notify {
                                    font-weight: bold !important;
                                }

                                #message {
                                    width: 360px;
                                    height: 90vh;
                                    min-height: 90vh;
                                    box-shadow: 0 12px 28px 0 rgba(0, 0, 0, 0.2),
                                        0 2px 4px 0 rgba(0, 0, 0, 0.1);
                                    border-radius: 10px;
                                }

                                .img-notifi {
                                    width: 50px !important;
                                    max-width: 50px !important;
                                    height: 50px;
                                    border-radius: 50%;
                                }

                                .text-notify {
                                    overflow: hidden;
                                    display: -webkit-box;
                                    -webkit-line-clamp: 2;
                                    -webkit-box-orient: vertical;
                                }

                                .dot-notify {
                                    width: 10px !important;
                                    height: 10px !important;
                                    display: inline-block;
                                    border-radius: 50%;
                                    background-color: #0866FF;
                                }

                                .time-notify {
                                    font-size: 12px !important;
                                    font-weight: bold !important;
                                    color: #0866FF;
                                }

                                .nott-list {
                                    height: 100%;
                                    overflow-y: auto;
                                }
                            </style>
                        </li>
                    @else
                        <li>
                            <a href="{{ route('form-login') }}" title>
                                <span><i class="fa fa-user" aria-hidden="true"></i></span>
                                Đăng nhập
                            </a>
                        </li>
                    @endif
                </ul>
            </nav>
            <div class="menu-btn">
                <a href="#" title><i class="fa fa-bars"></i></a>
            </div>
            @if (Auth::check())
                <div class="user-account">
                    <div class="user-info d-flex justify-content-around">
                        <img src="{{ Auth::user()->userInfo->CheckEmptyImage() }}" width="40px" height="40px" alt
                            style="object-fit: cover">
                        <i class="la la-sort-down"></i>
                    </div>
                    <input type="hidden" id="user_login_id" value="{{ Auth::user()->id }}">
                    <div class="user-account-settingss" id="users">
                        <h3 class="info-user-login">
                            <a href="{{ route('user.profile', Auth::user()->id) }}">
                                <img src="{{ Auth::user()->userInfo->CheckEmptyImage() }}" width="36px"
                                    height="36px" style="border-radius: 50%; object-fit: cover" alt>
                                <span class="name-user-login">
                                    {!! Auth::user()->name !!}
                                </span>
                            </a>
                        </h3>
                        <h3>Cài đặt</h3>
                        <ul class="us-links">
                            @if (Auth::user()->role == App\Models\User::ROLE['EMPLOYER'])
                                <li>
                                    <a href="{{ route('job.create') }}" title>
                                        <img src="/workwise/images/icons/ic_menu_dtin.svg" alt=""> Đăng tin
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('job.list') }}" title>
                                        <img src="/workwise/images/icons/icon_da_dang.png" alt=""> Tin đã đăng
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cv.find-candidate') }}" title>
                                        <img src="/workwise/images/icons/ic_menu_cvguv.svg" alt=""> Tìm kiếm ứng
                                        viên
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cv.manage') }}" title>
                                        <img src="/workwise/images/icons/ic_menu_cvguv.svg" alt=""> Quản lí công
                                        việc tuyển dụng
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cv.manage-save-cv') }}" title>
                                        <img src="/workwise/images/icons/ic_menu_cvguv.svg" alt=""> Hồ sơ ứng
                                        viên đã lưu
                                    </a>
                                </li>
                            @endif
                            @if (Auth::user()->role == App\Models\User::ROLE['CANDIDATE'])
                                <li>
                                    <a href="{{ route('cv.index') }}" title>
                                        <img src="/workwise/images/icons/ic_menu_vldl.svg" alt="">
                                        Quản lí CV
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('cv.ui-apply') }}" title>
                                        <img src="/workwise/images/icons/ic_menu_cvguv.svg" alt="">
                                        CV đã ứng tuyển
                                    </a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ route('logout') }}" title>
                                    <img src="/workwise/images/icons/ic_log_out.svg" alt=""> Đăng xuất
                                </a>
                            </li>

                        </ul>
                    </div>
                </div>
            @endif
        </div>
    </div>
</header>
