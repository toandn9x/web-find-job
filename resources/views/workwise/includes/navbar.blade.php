<header>
    <div class="container">
        <div class="header-data">
            <div class="logo">
                <a href="index.html" title><img src="/workwise/images/logo.png" alt></a>
            </div>
            <div class="search-bar">
                <form>
                    <input type="text" name="search" placeholder="Search...">
                    <button type="submit"><i class="la la-search"></i></button>
                </form>
            </div>
            <nav>
                <ul>
                    <li>
                        <a href="{{ route('job.index') }}" title>
                            <span><img src="/workwise/images/icon5.png" alt></span>
                            Tìm việc làm
                        </a>
                    </li>
                    <li>
                        <a href="index.html" title>
                            <span><img src="/workwise/images/icon1.png" alt></span>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="companies.html" title>
                            <span><img src="/workwise/images/icon2.png" alt></span>
                            Companies
                        </a>
                        <ul>
                            <li><a href="/workwise/companies.html" title>Companies</a></li>
                            <li><a href="/workwise/company-profile.html" title>Company Profile</a></li>
                        </ul>
                    </li>
                    <li>
                        <a href="projects.html" title>
                            <span><img src="/workwise/images/icon3.png" alt></span>
                            Projects
                        </a>
                    </li>
                    <li>
                        <a href="profiles.html" title>
                            <span><img src="/workwise/images/icon4.png" alt></span>
                            Profiles
                        </a>
                        <ul>
                            <li><a href="user-profile.html" title>User Profile</a></li>
                            <li><a href="my-profile-feed.html" title>my-profile-feed</a></li>
                        </ul>
                    </li>
                   
                    <li>
                        <a href="#" title class="not-box-openm">
                            <span><img src="/workwise/images/icon6.png" alt></span>
                            Messages
                        </a>
                        <div class="notification-box msg" id="message">
                            <div class="nt-title">
                                <h4>Setting</h4>
                                <a href="#" title>Clear all</a>
                            </div>
                            <div class="nott-list">
                                <div class="notfication-details">
                                    <div class="noty-user-img">
                                        <img src="/workwise/images/resources/ny-img1.png" alt>
                                    </div>
                                    <div class="notification-info">
                                        <h3><a href="messages.html" title>Jassica William</a> </h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do.</p>
                                        <span>2 min ago</span>
                                    </div>
                                </div>
                                <div class="notfication-details">
                                    <div class="noty-user-img">
                                        <img src="/workwise/images/resources/ny-img2.png" alt>
                                    </div>
                                    <div class="notification-info">
                                        <h3><a href="messages.html" title>Jassica William</a></h3>
                                        <p>Lorem ipsum dolor sit amet.</p>
                                        <span>2 min ago</span>
                                    </div>
                                </div>
                                <div class="notfication-details">
                                    <div class="noty-user-img">
                                        <img src="/workwise/images/resources/ny-img3.png" alt>
                                    </div>
                                    <div class="notification-info">
                                        <h3><a href="messages.html" title>Jassica William</a></h3>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do
                                            eiusmod tempo incididunt ut labore et dolore magna aliqua.</p>
                                        <span>2 min ago</span>
                                    </div>
                                </div>
                                <div class="view-all-nots">
                                    <a href="messages.html" title>View All Messsages</a>
                                </div>
                            </div>
                        </div>
                    </li>
                    <li>
                        <a href="#" title class="not-box-open">
                            <span><img src="/workwise/images/icon7.png" alt></span>
                            Notification
                        </a>
                        <div class="notification-box noti" id="notification">
                            <div class="nt-title">
                                <h4>Setting</h4>
                                <a href="#" title>Clear all</a>
                            </div>
                            <div class="nott-list">
                                <div class="notfication-details">
                                    <div class="noty-user-img">
                                        <img src="/workwise/images/resources/ny-img1.png" alt>
                                    </div>
                                    <div class="notification-info">
                                        <h3><a href="#" title>Jassica William</a> Comment on your
                                            project.</h3>
                                        <span>2 min ago</span>
                                    </div>
                                </div>
                                <div class="notfication-details">
                                    <div class="noty-user-img">
                                        <img src="/workwise/images/resources/ny-img2.png" alt>
                                    </div>
                                    <div class="notification-info">
                                        <h3><a href="#" title>Jassica William</a> Comment on your
                                            project.</h3>
                                        <span>2 min ago</span>
                                    </div>
                                </div>
                                <div class="notfication-details">
                                    <div class="noty-user-img">
                                        <img src="/workwise/images/resources/ny-img3.png" alt>
                                    </div>
                                    <div class="notification-info">
                                        <h3><a href="#" title>Jassica William</a> Comment on your
                                            project.</h3>
                                        <span>2 min ago</span>
                                    </div>
                                </div>
                                <div class="notfication-details">
                                    <div class="noty-user-img">
                                        <img src="/workwise/images/resources/ny-img2.png" alt>
                                    </div>
                                    <div class="notification-info">
                                        <h3><a href="#" title>Jassica William</a> Comment on your
                                            project.</h3>
                                        <span>2 min ago</span>
                                    </div>
                                </div>
                                <div class="view-all-nots">
                                    <a href="#" title>View All Notification</a>
                                </div>
                            </div>
                        </div>
                    </li>
                </ul>
            </nav>
            <div class="menu-btn">
                <a href="#" title><i class="fa fa-bars"></i></a>
            </div>
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
                        <li><a href="#" title>Privacy</a></li>
                        <li><a href="#" title>Faqs</a></li>
                        <li><a href="#" title>Terms & Conditions</a></li>
                    </ul>
                    <h3 class="tc"><a href="{{ route('logout') }}" title>Đăng xuất</a></h3>
                </div>
            </div>
        </div>
    </div>
</header>
