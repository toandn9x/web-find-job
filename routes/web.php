<?php

use Illuminate\Support\Facades\Route;

// Route::get('/test', function () {
//     return view('workwise.chats.index');
// });

// Admin
Route::group([
    'namespace' => "Admin",
    'prefix' => 'admin',
    // 'middleware' => 'localization'
], function () {
    Route::get('/', 'DashboardController@index');

    // Thay đổi ngôn ngữ
    Route::get('/change-language/{language}', 'LangController@changeLanguage')->name('change-language');
});

// Client
Route::group([
    'namespace' => "Client\Auth\Social",
    'prefix' => '/',
], function() {

    Route::get('login', 'LoginController@formLogin')->name('form-login');
    Route::post('/login', 'LoginController@login')->name('login');

    Route::post('/register', 'LoginController@register');

    Route::prefix('auth')->group(function () {
        Route::get('/facebook', 'LoginController@redirectToFacebook')->name('redirect-to-facebook');
        Route::get('/facebook/callback', 'LoginController@handleFacebookCallback');

        Route::get('/google', 'LoginController@redirectToGoogle')->name('redirect-to-google');
        Route::get('/google/callback', 'LoginController@handleGoogleCallback');

        Route::get('/logout', 'LogoutController@logout')->name('logout');
    });
});

//Giao diện chính
Route::get('/', "Client\JobController@index")->name('home');
Route::get('/job/detail/{id}', "Client\JobController@show")->name('job.detail');

//Hiển thị các comment của bài tin tuyển dụng
Route::get('/comment/show/{id}', "Client\CommentController@show");

Route::group([
    'middleware' => ['auth','PreventBackHistory'],
],function () {
    Route::group([
        'namespace' => "Client"
    ], function() {
        //Giao diện mạng xã hội
        Route::get('/socail','DashboardController@index')->name('home.socail');

        // Phần bài viết của người dùng
        Route::prefix('post')->group(function () {
            Route::post('/store', "PostController@store")->name('post.store');
            Route::post('/edit', "PostController@edit")->name('post.edit');
            Route::post('/update', "PostController@update")->name('post.update');
            Route::post('/destroy', "PostController@destroy")->name('post.destroy');
        });

        // Profile
        Route::prefix('profile')->group(function() {
            Route::get('/{id}', "UserController@profile")->name('user.profile');
            Route::post('/update-cover-image', "UserController@updateCoverImage")->name('user.update-cover-image');
            Route::post('/update-avatar', "UserController@updateAvatar")->name('user.update-avatar');
        });
        Route::prefix('setting-profile')->group(function() {
            Route::get('/{id}', "UserController@viewSettingProfile")->name('user.view-setting-profile');
            Route::post('/change-password/{id}', "UserController@changePassword")->name('user.setting-profile.change-password');
            Route::post('/update', "UserController@update")->name('user.update');
        });

        // Công ty tuyển dụng
        Route::prefix('company')->group(function () {
            Route::post('/update', "CompanyController@update");
            Route::post('/update-image', "CompanyController@updateImage");
        });

        //Bải tin tuyển dụng
        Route::group([
            'middleware' => ['checkRole'],
        ], function () {
            Route::prefix('job')->group(function () {
                Route::get('/create', "JobController@create")->name('job.create');
                Route::post('/store', "JobController@store")->name('job.store');
                Route::get('/list', "JobController@list")->name('job.list');
                Route::get('/edit/{id}', "JobController@edit")->name('job.edit');
                Route::post('/update', "JobController@update")->name('job.update');
                Route::post('/destroy/{id}', "JobController@destroy")->name('job.destroy');
            });
        });
        // Chức năng like bài tin
        Route::post('job/like', "JobController@like");

        // Bình luận bài tin
        Route::prefix('comment')->group(function () {
            Route::post('/store', "CommentController@store");
            Route::post('/destroy', "CommentController@destroy");
            
        });

        Route::prefix('chat')->group(function () {
            Route::get('/user/{id}', "ChatController@index")->name('chat.index');
            Route::post('/message', "ChatController@store");
        });
    });

    //Đăng xuất tài khoản
    Route::get('/logout','LoginController@logout');
});
Route::get('/404', function(){
    return view('workwise.errors.404');
});
Route::get('/403', function(){
    return view('workwise.errors.403');
});
Route::get('/401', function(){
    return view('workwise.errors.401');
});
Route::get('/messenger/form-login', 'LoginController@formLogin');
Route::post('/messenger/login', 'App\Http\Controllers\LoginController@login');
Route::post('/messenger/register', 'App\Http\Controllers\LoginController@register');
Route::get("/verifiablde-email", 'App\Http\Controllers\LoginController@verifiableEmail');
Route::post("/check-verifiablde-email", 'App\Http\Controllers\LoginController@checkVerifiableEmail');
Route::get("/send-again-email", 'App\Http\Controllers\LoginController@sendAgainEmail');
