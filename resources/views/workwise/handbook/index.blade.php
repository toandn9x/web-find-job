@extends('workwise.layouts.master')

@section('style')
    <link rel="stylesheet" href="/workwise/css/handbook/index.css">
@endsection

@section('main-content')
    <section class="companies-info">
        <div class="container">
            <div class="acc-setting mb-4">
                <h3>Trang chủ &nbsp; &rarr; &nbsp; Cẩm nang </h3>
            </div>
            <div>
                <h3 class="title my-4">Bài viết nổi bật</h3>
            </div>
            <div class="post-hot-list position-relative">
                <div class="post-hot-swiper swiper d-flex align-items-center h-auto">
                    <div class="swiper-wrapper">
                        @if (count($handbooksHot) > 0)
                            @foreach ($handbooksHot as $handbook)
                                <div class="swiper-slide px-2 swiper-max h-auto">
                                    <a href="handbook/{{$handbook->slug}}" class="hover-zoom text-decoration-none">
                                        <div
                                            class="post-hot d-flex flex-column justify-content-between align-items-center h-100 shadow-sm">
                                            <div class="post-hot__img w-100">
                                                <img src="{{ $handbook->thumbnail ? $handbook->image_url : '' }}"
                                                    alt="" class="hover-zoom-img w-100">
                                            </div>
                                            <div class="w-100 overflow-hidden px-2 py-3 d-flex flex-column flex-grow-1">
                                                <h3 class="post-hot__title text-2-rows mb-2 text-dark">
                                                    {{ $handbook->title }}
                                                </h3>
                                                <p class="post-hot__description text-4-rows">
                                                    {{ $handbook->description }}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>
                            @endforeach
                        @endif
                    </div>
                </div>
                <div class="swiper-button swiper-button-prev d-xl-flex d-none">
                    <img src="/workwise/images/prev.svg" alt="">
                </div>
                <div class="swiper-button swiper-button-next d-xl-flex d-none">
                    <img src="/workwise/images/next.svg" alt="">
                </div>
            </div>
            <div>
                <h3 class="title my-4 mt-5">Bài viết khác</h3>
            </div>
            <div class="row handbook-orther-list">
            </div>
            <div class="paginate handbook-paginate d-flex align-items-center justify-content-center mt-5"></div>
        </div>
    </section>
@endsection
@section('script')
    <script>
        $(document).ready(function () {
            getHandBookPaginate();
            
            function getHandBookPaginate() {
                $.ajax({
                    type: "GET",
                    url: "/handbook-paginate",
                    dataType: "JSON",
                    success: function (response) {
                        let active = "";
                        $(".paginate").empty();
                        for(let i = 1; i <= response.data.last_page; i++) {
                            if(i == 1) {
                                active = "paginate-item-active";
                            }else{
                                active = "";
                            }
                            $(".paginate").append(
                                `<span class="px-2 paginate-item ${active}" data-page="${i}">${i}</span>`
                            )
                        }

                        $('.handbook-orther-list').empty();
                        $.each(response.data.data, function(index, item) {
                            $('.handbook-orther-list').append(
                                `<div class="col-lg-4 col-12 p-0 px-2 mt-3">
                                    <a href="/handbook/${item.slug}" class="hover-zoom text-decoration-none">
                                        <div class="post-hot d-flex flex-column justify-content-between align-items-center h-100 shadow-sm">
                                            <div class="post-hot__img w-100">
                                                <img src="${item.thumbnail}" class="hover-zoom-img w-100">
                                            </div>
                                            <div class="w-100 overflow-hidden px-2 py-3 d-flex flex-column flex-grow-1">
                                                <h3 class="post-hot__title text-2-rows mb-2 text-dark">
                                                    ${item.title}
                                                </h3>
                                                <p class="post-hot__description text-4-rows">
                                                    ${item.description}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>`
                            )
                        });
                    }
                });
            }

            $(document).on('click', '.paginate-item', function() {
                let item = $(this);
                if(!item.hasClass('paginate-item-active')) {
                    let page = item.data('page');
                    item.addClass('paginate-item-active');
                    item.siblings().removeClass('paginate-item-active');
                    handleChangePageHandBook(page);
                }
            });

            function handleChangePageHandBook(page) {
                $.ajax({
                    type: "GET",
                    url: "/handbook-paginate?page="+page,
                    dataType: "JSON",
                    success: function (response) {
                        $('html, body').scrollTop($('.handbook-orther-list').offset().top - 200);
                        $('.handbook-orther-list').empty();
                        $.each(response.data.data, function(index, item) {
                            $('.handbook-orther-list').append(
                                `<div class="col-lg-4 col-12 p-0 px-2 mt-3">
                                    <a href="/handbook/${item.slug}" class="hover-zoom text-decoration-none">
                                        <div class="post-hot d-flex flex-column justify-content-between align-items-center h-100 shadow-sm">
                                            <div class="post-hot__img w-100">
                                                <img src="${item.thumbnail}" class="hover-zoom-img w-100">
                                            </div>
                                            <div class="w-100 overflow-hidden px-2 py-3 d-flex flex-column flex-grow-1">
                                                <h3 class="post-hot__title text-2-rows mb-2 text-dark">
                                                    ${item.title}
                                                </h3>
                                                <p class="post-hot__description text-4-rows">
                                                    ${item.description}
                                                </p>
                                            </div>
                                        </div>
                                    </a>
                                </div>`
                            )
                        });
                    }
                });
            }
        });
    </script>
@endsection