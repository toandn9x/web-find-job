@extends('workwise.layouts.master')

@section('style')
    <link rel="stylesheet" href="/workwise/css/handbook/detail.css">
@endsection

@section('main-content')
    <section class="companies-info">
        <div class="container">
            <div class="acc-setting mb-4">
                <h3>Trang chủ &nbsp; &rarr; &nbsp; Cẩm nang &nbsp; &rarr; &nbsp; Chi tiết</h3>
            </div>
            <div class="post-detail position-relative">
                <p class="post-detail__title my-4 p-0">{{ $data[0]->title }}</p>
                <div class="post-detail__content p-0 text-black">
                    {!! $data[0]->content !!}
                </div>
            </div>
        </div>
        <div class="container list-post-random mt-4 p-0 pt-5">
            <div class="row">
                @if (count($data[1]) > 0)
                    @foreach ($data[1] as $item)
                        <div class="col-6 col-lg-4 px-2">
                            <a href="/handbook/{{$item->slug}}" class="hover-zoom text-decoration-none">
                                <div
                                    class="post-hot d-flex flex-column justify-content-between align-items-center h-100 shadow-sm">
                                    <div class="post-hot__img w-100">
                                        <img src="{{ $item->thumbnail ? $item->image_url : '' }}"
                                            alt="" class="hover-zoom-img w-100">
                                    </div>
                                    <div class="w-100 overflow-hidden px-2 py-3 d-flex flex-column flex-grow-1">
                                        <h3 class="post-hot__title text-2-rows mb-2 text-dark">
                                            {{ $item->title }}
                                        </h3>
                                    </div>
                                </div>
                            </a>
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </section>
@endsection