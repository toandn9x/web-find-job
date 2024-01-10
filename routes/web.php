<?php

use Illuminate\Support\Facades\Route;

// Route::get('/test', "Client\HandBookController@getHandBookPaginate");
// Route::get('/test', function() {
//     return view('workwise.cv.candidate.find-employer');
// });

// Admin
Route::group([
    'namespace' => "Admin",
    'prefix' => 'admin',
], function () {
    Route::group([
        'middleware' => ['auth.admin', 'PreventBackHistory']
    ], function() {
        Route::get('/', 'DashboardController@index')->name('admin.home');
       

        Route::prefix('employer')->group(function () {
            Route::get('/', 'EmployerController@index')->name('admin.employer');
            Route::get('/updateStaus/{id}', "EmployerController@updateStatus")->name('admin.employer.updateStatus');
        });

        Route::get('/auth/logout', "Auth\LoginController@logout")->name('admin.logout');
        Route::prefix('handbook')->group(function () {
            Route::get('/', "HandBookController@index")->name('admin.handbook');
            Route::get('/create', "HandBookController@create")->name('handbook.create');
            Route::post('/store', "HandBookController@store")->name('handbook.store');
            Route::get('/edit/{id}', "HandBookController@edit");
            Route::post('/update/{id}', "HandBookController@update");
        });
    });

    Route::group([
        'namespace' => "Auth",
        'prefix' => 'auth',
    ], function() {
        Route::get('/login', "LoginController@formLogin");
        Route::post('/login', "LoginController@login")->name('admin.login');
    });
});

// Client
Route::group([
    'namespace' => "Client\Auth\Social",
    'prefix' => '/',
], function() {

    Route::get('login', 'LoginController@formLogin')->name('form-login');
    Route::post('/login', 'LoginController@login')->name('login');
    Route::post('/register', 'LoginController@register');
    Route::post('/forget-password', "LoginController@forgetPass")->name('forget-password');

    Route::prefix('auth')->group(function () {
        Route::get('/facebook', 'LoginController@redirectToFacebook')->name('redirect-to-facebook');
        Route::get('/facebook/callback', 'LoginController@handleFacebookCallback');

        Route::get('/google', 'LoginController@redirectToGoogle')->name('redirect-to-google');
        Route::get('/google/callback', 'LoginController@handleGoogleCallback');

        Route::get('/logout', 'LogoutController@logout')->name('logout');
    });
});

//Giao diện chính
// Không có đăng nhập
Route::get('/home', function() {
    return view('workwise.home.home');
})->name('home.page');
Route::get('/', "Client\JobController@index")->name('home');
Route::get('/job/detail/{id}', "Client\JobController@show")->name('job.detail');

//Hiển thị các comment của bài tin tuyển dụng
Route::get('/comment/show/{id}', "Client\CommentController@show");

//Chi tiết công ty tuyển dụng
Route::get('/company/show/{id}', "Client\CompanyController@show")->name('company.show');

// Cẩm nang
Route::get('/handbook', "Client\HandBookController@index")->name('handbook');
Route::get('/handbook-paginate', "Client\HandBookController@getHandBookPaginate");
Route::get('/handbook/{slug}', "Client\HandBookController@detail")->name('handbook.detail');
//Bắt buộc đăng nhập tài khoản
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
            Route::get('/show/{id}', "PostController@show");
            Route::post('/store', "PostController@store")->name('post.store');
            Route::post('/edit', "PostController@edit")->name('post.edit');
            Route::post('/update', "PostController@update")->name('post.update');
            Route::post('/destroy', "PostController@destroy")->name('post.destroy');
            Route::post('/like', "PostController@like");
            Route::post('/comment', "PostController@comment");
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
        Route::get('/user/update-status-cv', "UserController@updateStatus");

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
                Route::get('/update-status/{id}', "JobController@updateStatus")->name('job.update-status');
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
            Route::get('/search', "ChatController@search");
        });

        //CV
        Route::prefix('cv')->group(function () {
            Route::get('/', "CvController@index")->name('cv.index');
            Route::post('/upload', "CvController@store")->name('cv.store');
            Route::post('/upload-main-cv', "CvController@updateMainCv");
            Route::post('/apply-job', "CvController@apply");
            Route::get('/cv-apply', "CvController@uiCvApply")->name('cv.ui-apply');
            Route::post('/find-job', "CvController@findJob");
            

            Route::middleware(['checkRole'])->group(function () {
                Route::get('/manage-cv', "CvController@uiManageCv")->name('cv.manage');
                
                //Giao diện xem danh sách hồ sơ các ứng viên đã lưu
                Route::get('/manage-save-cv', "CvController@uiSaveCv")->name('cv.manage-save-cv');

                //Xem danh sách ứng viên ứng tuyển
                Route::post('/view-candidate', "CvController@viewCandidate");

                //Tìm kiếm ứng viên
                Route::get('/find-candidate', "CvController@findCandidate")->name('cv.find-candidate');

                //Lưu cv ứng viên
                Route::get('/save-cv/{id}', "CvController@saveCv")->name('cv.save');

                Route::post('/update-cv-candidate', "CvController@updateCvCandidate");
            });
        });
            
    });

    //Đăng xuất tài khoản
    // Route::get('/logout','LoginController@logout');
});
