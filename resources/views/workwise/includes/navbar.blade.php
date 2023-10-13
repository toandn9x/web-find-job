<header>
    <div class="container">
        <div class="header-data">
            <div class="logo">
                <a href="{{ route('home') }}" title id="logo"><img src="/workwise/images/logo.png" alt> <span id="name_logo">WorkWise</span></a>
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
                            <a href="{{ route('chat.index', Auth::user()->id) }}" title target="_blank" style="position: relative">
                                <span><i class="fa fa-weixin" aria-hidden="true"></i></span>
                                Chat
                                @if (Auth::user()->friends()->wherePivot('status', 1)->count() > 0)
                                    <span style="position: absolute;
                                    width: 15px;
                                    height: 15px;
                                    background: #4C5BD4;
                                    border-radius: 50%;
                                    display: flex;
                                    justify-content: center;
                                    align-items: center;
                                    font-weight: bold;
                                    top: -10px;
                                    right: -10px;"> {{ Auth::user()->friends()->wherePivot('status', 1)->count() }} </span>
                                @endif
                            </a>
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
                        <img src="{{ Auth::user()->userInfo->CheckEmptyImage() }}" width="40px"
                        height="40px" alt style="object-fit: cover">
                        <i class="la la-sort-down"></i>
                    </div>
                    <input type="hidden" id="user_login_id" value="{{ Auth::user()->id }}">
                    <div class="user-account-settingss" id="users">
                        <h3 class="info-user-login">
                            <a href="{{ route('user.profile', Auth::user()->id) }}">
                                <img src="{{ Auth::user()->userInfo->CheckEmptyImage() }}" width="36px"
                                height="36px" style="border-radius: 50%; object-fit: cover" alt >
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
