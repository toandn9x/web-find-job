@extends('workwise.layouts.master')

@section('style')
    <link rel="stylesheet" href="/workwise/css/work/style.css">
@endsection

@section('main-content')
    <div class="search-sec">
        <div class="container">
            <div class="search-box">
                <form>
                    <input type="text" name="search" placeholder="Search keywords">
                    <button type="submit">Search</button>
                </form>
            </div>
        </div>
    </div>
    <main>
        <div class="main-section">
            <div class="container">
                <div class="main-section-data">
                    <div class="row">
                        <div class="col-lg-9">
                            <div class="main-ws-sec">
                                @foreach ($jobs as $job)
                                    <div class="posts-section">
                                        <div class="post-bar">
                                            <div class="post_topbar p-0 mb-4">
                                                <div>
                                                    <div class="wrp-logo">
                                                        <img src="{{ $job->company->image_url }}"
                                                            alt class="logo-company">
                                                    </div>
                                                    <div class="wrp-info-work">
                                                        <span>
                                                            <a href="{{ route('job.detail', $job->id) }}" class="name-work">{{ $job->title_limit }}</a>
                                                        </span>
                                                        <span>
                                                            <a href="" class="name-company d-block">
                                                                {{ $job->company->name }}
                                                            </a>
                                                        </span>
                                                        <div class="wrp_job_info">
                                                            <div class="job_local job_info" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Địa chỉ"><i
                                                                    class="fa fa-map-marker" aria-hidden="true"></i> {{ $job->company->address }}
                                                            </div>
                                                            <div class="job_time job_info" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Ngày đăng"><i
                                                                    class="fa fa-calendar-check-o"
                                                                    aria-hidden="true"></i>{{ date('d-m-Y', strtotime($job->created_at)) }}</div>
                                                            <div class="job_chat">
                                                                <a href="">
                                                                    <i class="fa fa-weixin" aria-hidden="true"></i> Chat
                                                                </a>
                                                            </div>
                                                        </div>
                                                        <div class="job_money job_info" data-bs-toggle="tooltip"
                                                                data-bs-placement="top" title="Lương"><i
                                                                    class="fa fa-money" aria-hidden="true"></i>
                                                                @if ($job->money_type == 1)
                                                                    Thỏa thuận
                                                                @elseif($job->money_type == 2)
                                                                    {{ number_format($job->money_min) }} VNĐ
                                                                @elseif($job->money_type == 3)
                                                                    {{ number_format($job->money_min, 0, '', '.') }} - {{ number_format($job->money_max, 0, '', '.') }} VNĐ
                                                                @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="job-status-bar">
                                                <ul class="like-com">
                                                    <li>
                                                        <a href="#" class="active"><i class="fas fa-heart"></i>
                                                            Like</a>
                                                        <span class="m-0">25</span>
                                                    </li>
                                                    <li><a href="#" class="com"><i class="fas fa-comment-alt"></i>
                                                            Comments 15</a></li>
                                                </ul>
                                                <a href="#"><i class="fas fa-eye"></i>Views 50</a>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>

                        <div class="col-lg-3">
                            <div class="filter-secs">
                                <div class="filter-heading">
                                    <h3>Filters</h3>
                                    <a href="#" title>Clear all filters</a>
                                </div>
                                <div class="paddy">
                                    <div class="filter-dd">
                                        <div class="filter-ttl">
                                            <h3>Skills</h3>
                                            <a href="#" title>Clear</a>
                                        </div>
                                        <form>
                                            <input type="text" name="search-skills" placeholder="Search skills">
                                        </form>
                                    </div>
                                    <div class="filter-dd">
                                        <div class="filter-ttl">
                                            <h3>Availabilty</h3>
                                            <a href="#" title>Clear</a>
                                        </div>
                                        <ul class="avail-checks">
                                            <li>
                                                <input type="radio" name="cc" id="c1">
                                                <label for="c1">
                                                    <span></span>
                                                </label>
                                                <small>Hourly</small>
                                            </li>
                                            <li>
                                                <input type="radio" name="cc" id="c2">
                                                <label for="c2">
                                                    <span></span>
                                                </label>
                                                <small>Part Time</small>
                                            </li>
                                            <li>
                                                <input type="radio" name="cc" id="c3">
                                                <label for="c3">
                                                    <span></span>
                                                </label>
                                                <small>Full Time</small>
                                            </li>
                                        </ul>
                                    </div>
                                    <div class="filter-dd">
                                        <div class="filter-ttl">
                                            <h3>Job Type</h3>
                                            <a href="#" title>Clear</a>
                                        </div>
                                        <form class="job-tp">
                                            <select>
                                                <option>Select a job type</option>
                                                <option>Select a job type</option>
                                                <option>Select a job type</option>
                                                <option>Select a job type</option>
                                            </select>
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </form>
                                    </div>
                                    <div class="filter-dd">
                                        <div class="filter-ttl">
                                            <h3>Pay Rate / Hr ($)</h3>
                                            <a href="#" title>Clear</a>
                                        </div>
                                        <div class="rg-slider">
                                            <input class="rn-slider slider-input" type="hidden" value="5,50" />
                                        </div>
                                        <div class="rg-limit">
                                            <h4>1</h4>
                                            <h4>100+</h4>
                                        </div>
                                    </div>
                                    <div class="filter-dd">
                                        <div class="filter-ttl">
                                            <h3>Experience Level</h3>
                                            <a href="#" title>Clear</a>
                                        </div>
                                        <form class="job-tp">
                                            <select>
                                                <option>Select a experience level</option>
                                                <option>3 years</option>
                                                <option>4 years</option>
                                                <option>5 years</option>
                                            </select>
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </form>
                                    </div>
                                    <div class="filter-dd">
                                        <div class="filter-ttl">
                                            <h3>Countries</h3>
                                            <a href="#" title>Clear</a>
                                        </div>
                                        <form class="job-tp">
                                            <select>
                                                <option>Select a country</option>
                                                <option>United Kingdom</option>
                                                <option>United States</option>
                                                <option>Russia</option>
                                            </select>
                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection
