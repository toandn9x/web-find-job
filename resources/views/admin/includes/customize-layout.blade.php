<div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasBuilder" aria-labelledby="offcanvasBuilderLabel">
    <div class="offcanvas-header align-items-start">
        <div>
            <h3 id="offcanvasBuilderLabel">Front Builder</h3>
            <p class="mb-0">Customize the overview page layout.</p>
        </div>
        <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>

    <div class="offcanvas-body">
        <h4 class="mb-1">Theme Appearance Mode</h4>
        <p>Check out all <a href="documentation/layout.html">Layout Options here</a></p>

        <div class="row gx-3">
            <!-- Check -->
            <div class="col-6">
                <div class="form-check form-check-label-highlighter text-center">
                    <input type="radio" class="form-check-input" name="layoutSkinsRadio" id="layoutSkinsRadio1"
                        checked value="default">
                    <label class="form-check-label mb-2" for="layoutSkinsRadio1">
                        <img class="form-check-img" src="/admins/assets/img/415x310/img1.jpg" alt="Image Description">
                    </label>
                    <span class="form-check-text">Default</span>
                </div>
            </div>
            <!-- End Check -->

            <!-- Check -->
            <div class="col-6">
                <div class="form-check form-check-label-highlighter text-center">
                    <input type="radio" class="form-check-input" name="layoutSkinsRadio" id="layoutSkinsRadio2"
                        value="dark">
                    <label class="form-check-label mb-2" for="layoutSkinsRadio2">
                        <img class="form-check-img" src="/admins/assets/img/415x310/img2.jpg" alt="Image Description">
                    </label>
                    <span class="form-check-text">Dark Mode</span>
                </div>
            </div>
            <!-- End Check -->
        </div>
        <!-- End Row -->

        <hr>

        <div class="row gx-3">
            <!-- Check -->
            <div class="col-6">
                <div class="form-check form-check-label-highlighter text-center">
                    <input type="radio" class="form-check-input" name="layout" id="navbarLayoutSkinsRadio1" checked
                        value="default">
                    <label class="form-check-label mb-2" for="navbarLayoutSkinsRadio1">
                        <img class="form-check-img" src="/admins/assets/svg/layouts-light/sidebar-default.svg"
                            alt="Image Description" data-hs-theme-appearance="dark">
                        <img class="form-check-img" src="/admins/assets/svg/layouts/sidebar-default.svg"
                            alt="Image Description" data-hs-theme-appearance="default">
                    </label>
                    <span class="form-check-text">Default</span>
                </div>
            </div>
            <!-- End Check -->

            <!-- Check -->
            <div class="col-6">
                <div class="form-check form-check-label-highlighter text-center">
                    <input type="radio" class="form-check-input" name="layout" id="navbarLayoutSkinsRadio2"
                        value="navbar-dark">
                    <label class="form-check-label mb-2" for="navbarLayoutSkinsRadio2">
                        <img class="form-check-img" src="/admins/assets/svg/layouts-light/sidebar-dark.svg"
                            alt="Image Description" data-hs-theme-appearance="dark">
                        <img class="form-check-img" src="/admins/assets/svg/layouts/sidebar-dark.svg"
                            alt="Image Description" data-hs-theme-appearance="default">
                    </label>
                    <span class="form-check-text">Dark</span>
                </div>
            </div>
            <!-- End Check -->
        </div>
        <!-- End Row -->

        <hr>

        <h4 class="mb-1">Sidebar Nav</h4>
        <p>Check out all <a href="documentation/layout.html">Layout Options here</a></p>

        <div class="row gx-3">
            <!-- Check -->
            <div class="col-6">
                <div class="form-check form-check-label-highlighter text-center">
                    <input type="radio" class="form-check-input" name="sidebarNavOptions" id="sidebarNavOptions1"
                        value="pills" checked>
                    <label class="form-check-label mb-2" for="sidebarNavOptions1">
                        <img class="form-check-img"
                            src="/admins/assets/svg/layouts-light/demo-layouts-default-classic.svg"
                            alt="Image Description" data-hs-theme-appearance="dark">
                        <img class="form-check-img" src="/admins/assets/svg/layouts/demo-layouts-default-classic.svg"
                            alt="Image Description" data-hs-theme-appearance="default">
                    </label>
                    <span class="form-check-text">Pills</span>
                </div>
            </div>
            <!-- End Check -->

            <!-- Check -->
            <div class="col-6">
                <div class="form-check form-check-label-highlighter text-center">
                    <input type="radio" class="form-check-input" name="sidebarNavOptions" id="sidebarNavOptions2"
                        value="tabs">
                    <label class="form-check-label mb-2" for="sidebarNavOptions2">
                        <img class="form-check-img" src="/admins/assets/svg/layouts-light/demo-layouts-nav-tabs.svg"
                            alt="Image Description" data-hs-theme-appearance="dark">
                        <img class="form-check-img" src="/admins/assets/svg/layouts/demo-layouts-nav-tabs.svg"
                            alt="Image Description" data-hs-theme-appearance="default">
                    </label>
                    <span class="form-check-text">Tabs</span>
                </div>
            </div>
            <!-- End Check -->
        </div>
        <!-- End Row -->

        <hr>

        <!-- Form Switch -->
        <label class="row form-check form-switch mb-3" for="builderFluidSwitch">
            <span class="col-10 ms-0">
                <span class="d-block h4 mb-1">Header Layout Options</span>
                <span class="d-block fs-5">Toggle to container-fluid layout</span>
            </span>
            <span class="col-2 text-end">
                <input type="checkbox" class="form-check-input" id="builderFluidSwitch">
            </span>
        </label>
        <!-- End Form Switch -->

        <div class="row gx-3">
            <!-- Check -->
            <div class="col-6">
                <div class="form-check form-check-label-highlighter text-center">
                    <input type="radio" class="form-check-input" name="layout" id="headerLayoutOptions1"
                        value="single-header">
                    <label class="form-check-label mb-2" for="headerLayoutOptions1">
                        <img class="form-check-img" src="/admins/assets/svg/layouts/header-default-container.svg"
                            alt="Image Description" data-hs-theme-appearance="default">
                        <img class="form-check-img" src="/admins/assets/svg/layouts-light/header-default-container.svg"
                            alt="Image Description" data-hs-theme-appearance="dark">
                    </label>
                    <span class="form-check-text">Default</span>
                </div>
            </div>
            <!-- End Check -->

            <!-- Check -->
            <div class="col-6">
                <div class="form-check form-check-label-highlighter text-center">
                    <input type="radio" class="form-check-input" name="layout" id="headerLayoutOptions2"
                        value="double-header">
                    <label class="form-check-label mb-2" for="headerLayoutOptions2">
                        <img class="form-check-img" src="/admins/assets/svg/layouts/header-double-line-container.svg"
                            alt="Image Description" data-hs-theme-appearance="default">
                        <img class="form-check-img"
                            src="/admins/assets/svg/layouts-light/header-double-line-container.svg"
                            alt="Image Description" data-hs-theme-appearance="dark">
                    </label>
                    <span class="form-check-text">Double line</span>
                </div>
            </div>
            <!-- End Check -->
        </div>
        <!-- End Row -->
    </div>

    <!-- Footer -->
    <div class="offcanvas-footer">
        <div class="row gx-3">
            <div class="col">
                <div class="d-grid">
                    <button type="button" id="js-builder-reset" class="btn btn-white btn-lg">
                        <i class="bi-arrow-counterclockwise"></i> Mặc định
                    </button>
                </div>
            </div>
            <!-- End Col -->

            <div class="col">
                <div class="d-grid">
                    <button type="button" id="js-builder-preview" class="btn btn-primary btn-lg">
                        <i class="eye-visible"></i> Cài đặt
                    </button>
                </div>
            </div>
            <!-- End Col -->
        </div>
        <!-- End Row -->
    </div>
    <!-- End Footer -->
</div>
