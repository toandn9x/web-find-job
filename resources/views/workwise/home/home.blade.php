@extends('workwise.layouts.master')

@section('style')
    <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
    <link rel="stylesheet" href="/workwise/css/dashboard/home.css">
@endsection
{{-- /workwise/images/banner_1.jpg --}}
@section('main-content')
    <main>
        <div class="main-section">
            <div class="container-fluid">
                <div class="main-slide">
                    <div class="background_header">

                    </div>
                </div>
                <div class="content">
                    <div class="main-content">
                        <h1 class="title-content">
                            Tính năng nổi bật của WorkWise
                        </h1>
                        <div class="tab-content">
                            <div class="tab-content-child" data-aos="flip-left" data-aos-duration="1500">
                                <i class="fa fa-comments-o" aria-hidden="true"></i>
                                <p>Chat trực tuyến</p>
                                <span>
                                    Phần mềm chat trực tuyến giúp các mọi người dễ dàng giao tiếp với nhau, nội
                                    dung hoàn toàn bảo mật.
                                </span>
                            </div>
                            <div class="tab-content-child" data-aos="flip-left" data-aos-duration="1500">
                                <i class="fa fa-file-text-o" aria-hidden="true"></i>
                                <p>Đăng tin tuyển dụng</p>
                                <span>
                                    Giúp đăng tin lên để giới thiệu việc làm cho các ứng viên.
                                </span>
                            </div>
                            <div class="tab-content-child" data-aos="flip-left" data-aos-duration="1500">
                                <i class="fa fa-search" aria-hidden="true"></i>
                                <p>Quản lý tập tin</p>
                                <span>
                                    Với phần mềm Workwise, bạn có thể dễ dàng tìm kiếm lại các tập tin hình ảnh, file một
                                    cách dễ dàng với chỉ 1 click chuột.
                                </span>
                            </div>
                            <div class="tab-content-child" data-aos="flip-left" data-aos-duration="1500">
                                <i class="fa fa-bell-o" aria-hidden="true"></i>
                                <p>Thông báo tin nhắn mới</p>
                                <span>
                                    Hệ thống sẽ hiển thị thông báo mỗi khi có tin nhắn mới được gửi đến giúp xử lý công việc
                                    nhanh chóng kịp thời.
                                </span>
                            </div>
                            <div class="tab-content-child" data-aos="flip-left" data-aos-duration="1500">
                                <i class="fa fa-group" aria-hidden="true"></i>
                                <p>Tạo và chat nhóm</p>
                                <span>
                                    Cho phép người dùng tạo nhóm và chat nhóm một cách dễ dàng không giới hạn số lượng thành
                                    viên tham gia.
                                </span>
                            </div>
                            <div class="tab-content-child" data-aos="flip-left" data-aos-duration="1500">
                                <i class="fa fa-cube" aria-hidden="true"></i>
                                <p>Hỗ trợ đa nền tảng</p>
                                <span>
                                    Hỗ trợ mọi trình duyệt web:Chrom,Cốc Cốc,Mozilla,..
                                </span>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="introduce">
                    <div class="main-intro">
                        <h1 class="title-intro">Tại sao doanh nghiệp nên chọn Workwise</h1>
                        <div class="content-intro">
                            <div data-aos="fade-right" data-aos-offset="500" data-aos-duration="500">
                                <h1>Workwise hoàn toàn miễn phí</h1>
                                <p>
                                    Đây là một mối quan tâm đặc biệt đối với bất cứ cá nhân hay doanh nghiệp nào dù quy mô
                                    nhỏ hay lớn. Và hiển nhiên, điều này không còn là mối lo lắng khi sử dụng Chat.
                                </p>
                            </div>
                            <div data-aos="fade-left" data-aos-offset="500" data-aos-duration="500">
                                <img src="/workwise/images/body_img1.png" alt="">
                            </div>
                        </div>
                        <div class="content-intro2">
                            <div data-aos="fade-right" data-aos-offset="500" data-aos-duration="500">
                                <img src="/workwise/images/body_img2.png" alt="">
                            </div>
                            <div data-aos="fade-left" data-aos-offset="500" data-aos-duration="500">
                                <h1>Hỗ trợ đa nền tảng và thiết bị</h1>
                                <p>
                                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Libero, voluptas!
                                </p>
                            </div>
                        </div>
                        <div class="content-intro">
                            <div data-aos="fade-right" data-aos-offset="500" data-aos-duration="500">
                                <h1>Giao diện thân thiện dễ dàng sử dụng</h1>
                                <p>
                                    Tất cả mọi người đều có thể sử dụng Chat WorkWise một cách thuận tiện và dễ dàng. Giúp tập
                                    trung trao đổi thông tin công việc, tránh việc xáo trộn với thông
                                    tin đời sống cá nhân của nhân viên.
                                </p>
                            </div>
                            <div data-aos="fade-left" data-aos-offset="500" data-aos-duration="500">
                                <img src="/workwise/images/body_img3.png" alt="">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="content">
                    <div class="main-content">
                        <h1 class="title-content">
                            Hệ thống phong phú của WorkWise
                        </h1>
                        <div class="mt-3">
                            <p class="text_cmd">Ứng dụng nhắn tin số n Việt Nam </p>
                            <p class="text_cmd">1. Tính năng đăng tin tuyển dụng đối với tài khoản nhà tuyển dụng, có thể đăng bài không giới hạn.</p>
                            <p class="text_cmd">2. Tìm kiếm công việc phù hợp với bản thân thông qua bộ lọc tìm kiếm.</p>
                            <p class="text_cmd">3. Like công việc, bình luận công việc yêu thích.</p>
                            <p class="text_cmd">4. Đăng bài viết trên mạng xã hội để mọi người cùng nhau lan tỏa niềm vui đến mọi người.(Like bài viết, Bình luận bài viết). </p>
                            <p class="text_cmd">5. Chat cùng với mọi người thông qua Chat WorkWise.</p>
                            <p class="text_cmd">6. Hiển thị thời gian tin nhắn được gửi đến.</p>
                            <p class="text_cmd">.....</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
@section('script')
    <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
    <script>
        AOS.init();
    </script>
@endsection
