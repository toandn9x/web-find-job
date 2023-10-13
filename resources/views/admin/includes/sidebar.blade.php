<aside
    class="js-navbar-vertical-aside navbar navbar-vertical-aside navbar-vertical navbar-vertical-fixed navbar-expand-xl navbar-bordered bg-white  ">
    <div class="navbar-vertical-container">
        <div class="navbar-vertical-footer-offset">
            <!-- Logo -->

            <a class="navbar-brand" href="index.html" aria-label="Front">
                <img class="navbar-brand-logo" src="/workwise/images/logo2.png" alt="">
            </a>

            <!-- End Logo -->

            <!-- Navbar Vertical Toggle -->
            <button type="button" class="js-navbar-vertical-aside-toggle-invoker navbar-aside-toggler">
                <i class="bi-arrow-bar-left navbar-toggler-short-align"
                    data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Collapse"></i>
                <i class="bi-arrow-bar-right navbar-toggler-full-align"
                    data-bs-template='<div class="tooltip d-none d-md-block" role="tooltip"><div class="arrow"></div><div class="tooltip-inner"></div></div>'
                    data-bs-toggle="tooltip" data-bs-placement="right" title="Expand"></i>
            </button>

            <!-- End Navbar Vertical Toggle -->

            <!-- Content -->
            <div class="navbar-vertical-content">
                <div id="navbarVerticalMenu" class="nav nav-pills nav-vertical card-navbar-nav">
                    <div class="nav-item">
                        <a class="nav-link {{ Route::is('admin.home') ? 'active' : '' }}" href="/admin" role="button"
                            aria-expanded="true" aria-controls="navbarVerticalMenuDashboards">
                            <i class="bi-house-door nav-icon"></i>
                            <span class="nav-link-title">Hệ thống</span>
                        </a>
                        <a class="nav-link {{ Route::is('admin.employer') ? 'active' : '' }}" href="{{ route('admin.employer') }}" role="button"
                            aria-expanded="true" aria-controls="navbarVerticalMenuDashboards">
                            <i class="bi bi-building nav-icon"></i>
                            <span class="nav-link-title">Nhà tuyển dụng</span>
                        </a>
                        <a class="nav-link {{ str_contains(url()->current(), 'admin/handbook') ? 'active' : '' }}" href="{{ route('admin.handbook') }}" role="button"
                            aria-expanded="true" aria-controls="navbarVerticalMenuDashboards">
                            <i class="bi bi-book nav-icon"></i>
                            <span class="nav-link-title">Cẩm nang</span>
                        </a>
                    </div>
                    <!-- End Content -->

                    <!-- Footer -->
                    <div class="navbar-vertical-footer">
                        <ul class="navbar-vertical-footer-list">
                            <li class="navbar-vertical-footer-list-item">
                                <!-- Style Switcher -->
                                <div class="dropdown dropup">
                                    <button type="button" class="btn btn-ghost-secondary btn-icon rounded-circle"
                                        id="selectThemeDropdown" data-bs-toggle="dropdown" aria-expanded="false"
                                        data-bs-dropdown-animation>

                                    </button>

                                    <div class="dropdown-menu navbar-dropdown-menu navbar-dropdown-menu-borderless"
                                        aria-labelledby="selectThemeDropdown">
                                        <a class="dropdown-item" href="#" data-icon="bi-moon-stars"
                                            data-value="auto">
                                            <i class="bi-moon-stars me-2"></i>
                                            <span class="text-truncate" title="Auto (system default)">Sáng (Mặc định)</span>
                                        </a>
                                        <a class="dropdown-item" href="#" data-icon="bi-brightness-high"
                                            data-value="default">
                                            <i class="bi-brightness-high me-2"></i>
                                            <span class="text-truncate" title="Default (light mode)">Mặc định (Chế độ ánh sáng)</span>
                                        </a>
                                        <a class="dropdown-item active" href="#" data-icon="bi-moon"
                                            data-value="dark">
                                            <i class="bi-moon me-2"></i>
                                            <span class="text-truncate" title="Dark">Tối</span>
                                        </a>
                                    </div>
                                </div>

                                <!-- End Style Switcher -->
                            </li>
                        </ul>
                    </div>
                    <!-- End Footer -->
                </div>
            </div>
</aside>
