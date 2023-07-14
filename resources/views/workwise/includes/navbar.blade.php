<header>
    <div class="container">
        <div class="header-data">
            <div class="logo">
                <a href="{{ route('home') }}" title><img src="/workwise/images/logo.png" alt></a>
            </div>
            <div class="search-bar">
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="{{ route('home') }}" title>
                            <span><img src="/workwise/images/icon5.png" alt></span>
                            Tìm việc làm
                        </a>
                    </li>
                    <li>
                        <a href="index.html" title>
                            <span><img src="/workwise/images/icon1.png" alt></span>
                            Trang chủ
                        </a>
                    </li>
                    @if (Auth::check())
                        <li>
                            <a href="{{ route('home.socail') }}" title>
                                <span><img src="/workwise/images/icon3.png" alt></span>
                                Mạng xã hội
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
                        <img src="{{ Auth::user()->userInfo->CheckEmptyImage('/workwise/images/resources/user.png') }}" width="40px"
                        height="40px" alt style="object-fit: cover">
                        <i class="la la-sort-down"></i>
                    </div>
                    <div class="user-account-settingss" id="users">
                        <h3 class="info-user-login">
                            <a href="{{ route('user.profile', Auth::user()->id) }}">
                                <img src="{{ Auth::user()->userInfo->CheckEmptyImage('/workwise/images/resources/user.png') }}" width="36px"
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
                            <li><a href="#" title>Privacy</a></li>
                            <li><a href="#" title>Faqs</a></li>
                            <li><a href="#" title>Terms & Conditions</a></li>
                        </ul>
                        <h3 class="tc"><a href="{{ route('logout') }}" title>Đăng xuất</a></h3>
                    </div>
                </div>
            @else
            <div class="login_register">
                <ul>
                    <li><a href="{{ route('form-login') }}" title="">Đăng nhập</a></li>
                </ul>
            </div>
            @endif
            
        </div>
    </div>
</header>
