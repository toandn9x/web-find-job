@extends('workwise.layouts.master')

@section('main-content')
    <section class="companies-info">
        <div class="container">
            <div class="company-title">
                <h3>Nhóm</h3>
            </div>
            <div class="companies-list">
                <div class="row">
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="company_profile_info">
                            <div class="company-up-info">
                                <img src="/workwise/images/resources/cmp-icon.png" alt>
                                <h3>Facebook Inc.</h3>
                                <h4>Establish Feb, 2004</h4>
                                <ul>
                                    <li><a href="#" title class="follow">Follow</a></li>
                                    <li><a href="#" title class="message-us"><i class="fa fa-envelope"></i></a></li>
                                </ul>
                            </div>
                            <a href="company-profile.html" title class="view-more-pro">View Profile</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="company_profile_info">
                            <div class="company-up-info">
                                <img src="/workwise/images/resources/cmp-icon1.png" alt>
                                <h3>Google Inc.</h3>
                                <h4>Establish Feb, 2004</h4>
                                <ul>
                                    <li><a href="#" title class="follow">Follow</a></li>
                                    <li><a href="#" title class="message-us"><i class="fa fa-envelope"></i></a></li>
                                </ul>
                            </div>
                            <a href="company-profile.html" title class="view-more-pro">View Profile</a>
                        </div>
                    </div>
                    <div class="col-lg-4 col-md-4 col-sm-6">
                        <div class="company_profile_info">
                            <div class="company-up-info">
                                <img src="/workwise/images/resources/cmp-icon2.png" alt>
                                <h3>Pinterest</h3>
                                <h4>Establish Feb, 2004</h4>
                                <ul>
                                    <li><a href="#" title class="follow">Follow</a></li>
                                    <li><a href="#" title class="message-us"><i class="fa fa-envelope"></i></a></li>
                                </ul>
                            </div>
                            <a href="company-profile.html" title class="view-more-pro">View Profile</a>
                        </div>
                    </div>
                   
                </div>
            </div>
            <div class="process-comm">
                <div class="spinner">
                    <div class="bounce1"></div>
                    <div class="bounce2"></div>
                    <div class="bounce3"></div>
                </div>
            </div>
        </div>
    </section>
@endsection
