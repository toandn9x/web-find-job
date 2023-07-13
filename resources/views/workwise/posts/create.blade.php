<div class="post-popup pst-pj">
    <div class="post-project">
        <h3 id="pst-header">
            <span id="mode-name">
                Tạo bài viết
            </span>
        </h3>
        <div class="post-project-fields">
            <form action="{{ route('post.store') }}" id="frm-created-pst" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">
                    <div class="col-lg-12 mb-3">
                        <div id="wrapper-info-ps">
                            <div id="ps-info-avatar">
                                <img src="{{ Auth::user()->userInfo->CheckEmptyImage('/workwise/images/resources/user-pic.png') }}"
                                    alt>
                            </div>
                            <div id="ps-info-name">
                                <span id="info-name">{!! Auth::user()->name !!}</span>
                                <span class="badge badge-primary btn-action" id="ps-mode" data-href="#wrapper-status"
                                    data-wrapper="show-wrapper-status">
                                    <span id="mode">
                                        <i class="la la-users"></i>
                                        Bạn bè
                                    </span>
                                    <i class="la la-caret-down"></i>
                                </span>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div id="wrapper-area" class="">
                            <textarea name="content" placeholder="{!! Auth::user()->name !!} ơi, Bạn đang nghĩ gì thế ?" id="form-area-pst"></textarea>
                            <input type="file" id="ipt-files" class="d-none" multiple>
                        </div>
                        <div id="wrp-list-img" class="d-flex flex-wrap">
                            <div id="list-preview-image">
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12" id="wrapper-background">
                        <img src="/workwise/images/background/SATP_Aa_square-2x.png" alt="" id="btn-choose-bg"
                            data-bs-toggle="tooltip" data-bs-placement="top" title="Cap">
                        <div id="list-img-bg">
                            <button type="button" id="btn-back" class="btn"><i
                                    class="la la-angle-left"></i></button>
                            <button type="button" id="btn-not-bg" class="btn bg-img-active img-bg" data-image="null"><i
                                    class="la la-ban"></i></button>
                            <img src="/workwise/images/background/bg_shadow.jpg" alt="" class="img-bg"
                                data-image="/workwise/images/background/bg_main_shadow.jpg">
                            <img src="/workwise/images/background/bg_tree.jpg" alt="" class="img-bg"
                                data-image="/workwise/images/background/bg_main_tree.jpg">
                            <img src="/workwise/images/background/bg_player.jpg" alt="" class="img-bg"
                                data-image="/workwise/images/background/bg_main_player.jpg">
                            <img src="/workwise/images/background/bg_rain.jpg" alt="" class="img-bg"
                                data-image="/workwise/images/background/bg_main_rain.jpg">
                            <img src="/workwise/images/background/bg_sakura.jpg" alt="" class="img-bg"
                                data-image="/workwise/images/background/bg_main_sakura.jpg">
                            <img src="/workwise/images/background/bg_cloud.jpg" alt="" class="img-bg"
                                data-image="/workwise/images/background/bg_main_cloud.jpg">
                            <img src="/workwise/images/background/bg_cake.jpg" alt="" class="img-bg"
                                data-image="/workwise/images/background/bg_main_cake.jpg">
                            <img src="/workwise/images/background/bg_heart.jpg" alt="" class="img-bg"
                                data-image="/workwise/images/background/bg_main_heart.jpg">
                            <img src="/workwise/images/background/bg_rocket.jpg" alt="" class="img-bg"
                                data-image="/workwise/images/background/bg_main_rocket.jpg">
                        </div>
                        <div id="wrapper-list">
                            <i class="la la-smile-o" id="btn-show-wrp-emojis" data-bs-toggle="tooltip"
                                data-bs-placement="top" title="Emoji"></i>
                            <div id="wrapper-append-emoji">

                            </div>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <div class="add-action mt-3">
                            <p id="text-add-action">Thêm vào bài viết của bạn</p>
                            <span id="list-icon-action">
                                <span class="img-icon-action img-action-hover mr-3" id="btn-add-images"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Ảnh/Video">
                                    <img src="/workwise/images/resources/a6OjkIIE-R0.png" alt=""
                                        id="btn-append-images">
                                </span>
                                <span class="img-icon-action img-action-hover btn-action mr-3"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Cảm xúc"
                                    data-href="#wrapper-emoji" data-wrapper="show-wrapper-emoji">
                                    <img src="/workwise/images/resources/yMDS19UDsWe.png" alt="">
                                </span>
                                <span class="img-icon-action img-action-hover btn-action mr-3"
                                    data-bs-toggle="tooltip" data-bs-placement="top" title="Check in"
                                    data-href="#wrapper-check-in" data-wrapper="show-wrapper-check-in">
                                    <img src="/workwise/images/resources/uywzfiZad5N.png" alt="">
                                </span>
                            </span>
                        </div>
                    </div>
                    <div class="col-lg-12">
                        <ul>
                            <li class="w-100"><button class="active w-100 btn-disabled" type="btn"
                                    value="post" id="btn-submit-frm" disabled>Đăng</button></li>
                        </ul>
                    </div>
                </div>
            </form>
            {{-- Emoji --}}
            <div class="row d-none" id="wrapper-emoji">
                <div class="col-lg-12" id="list-emojis">
                </div>
            </div>
            {{-- Address Check In --}}
            <div class="row d-none" id="wrapper-check-in">
                <div class="col-lg-12 mb-4">
                    <input type="text" class="form-control" placeholder="Bạn đang ở đâu ? "
                        id="ip-search-address">
                </div>
                <div class="col-lg-12" id="list-address-check-in">
                </div>
            </div>

            {{-- Status Post --}}
            <div class="row d-none" id="wrapper-status">
                <div class="col-lg-12">
                    <h4 id="who-view">Ai có thể xem bài viết của bạn ?</h4>
                    <p class="mt-2">Bài viết của bạn sẽ hiển thị ở trang cá nhân.</p>
                    <p class="mt-2 mb-2">Tuy đối tượng mặc định là Bạn bè, nhưng bạn có thể thay đổi đối tượng của
                        riêng bài viết này.</p>
                </div>
                <div class="col-lg-12 d-inline-block" id="list-status-pst">
                    <div class="status" data-status="1">

                        <span class="icon-status"> <i class="la la-globe"></i> </span>
                        <span class="name-status">
                            <span>Công khai</span>
                            <p class="m-0 mt-1">Bất kỳ ai ở trên hoặc ngoài WorkWise</p>
                        </span>
                        <input type="radio" name="status" class="ip-choose-status-pst">
                    </div>
                    <div class="status status-active status-choose" data-status="2">
                        <span class="icon-status"> <i class="la la-users"></i> </span>
                        <span class="name-status">
                            <span>Bạn bè</span>
                            <p class="m-0 mt-1">Bạn bè của bạn WorkWise</p>
                        </span>
                        <input type="radio" name="status" class="ip-choose-status-pst" checked>
                    </div>
                    <div class="status" data-status="3">

                        <span class="icon-status"> <i class="la la-lock"></i> </span>
                        <span class="name-status">
                            <span>
                                Chỉ mình tôi
                            </span>
                        </span>
                        <input type="radio" name="status" class="ip-choose-status-pst">
                    </div>
                </div>
                <div class="col-lg-12 d-flex justify-content-end mt-3 pt-3" id="wr-btn-access">
                    <button type="button" class="btn btn-light mr-3 active-cancel-status"
                        id="btn-cancel-status">Hủy</button>
                    <button type="button" class="btn btn-primary active-access-status"
                        id="btn-choose-status">Xong</button>
                </div>
            </div>
        </div>
        <a href="#" title><i class="la la-times-circle-o"></i></a>
    </div>
</div>
