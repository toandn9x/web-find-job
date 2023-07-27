<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đăng nhập hệ thống</title>
    <link rel="shortcut icon" href="/workwise/images/logo.png">

    <!-- Font -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet">

    <!-- CSS Implementing Plugins -->

    <!-- CSS Front Template -->
    <link rel="stylesheet" href="/admins/assets/css/theme.minc619.css?v=1.0">
</head>
<body>
    <main id="content" role="main" class="main">
        <div class="position-fixed top-0 end-0 start-0 bg-img-start" style="height: 32rem; background-image: url(/admins/assets/svg/components/card-6.svg);">
            <!-- Shape -->
            <div class="shape shape-bottom zi-1">
                <svg preserveAspectRatio="none" xmlns="http://www.w3.org/2000/svg" x="0px" y="0px" viewBox="0 0 1921 273">
                    <polygon fill="#fff" points="0,273 1921,273 1921,0 " />
                </svg>
            </div>
            <!-- End Shape -->
        </div>

        <!-- Content -->
        <div class="container py-5 py-sm-7">
            <div class="mx-auto" style="max-width: 30rem;">
                <!-- Card -->
                <div class="card card-lg mb-5">
                    <div class="card-body">
                        <!-- Form -->
                        <form action="{{ route('admin.login') }}" method="POST" id="formSubmit">
                            @csrf
                            <div class="text-center">
                                <div class="mb-5">
                                    <h1 class="display-5">Đăng nhập hệ thống</h1>
                                </div>
                            </div>

                            <!-- Form -->
                            <div class="mb-4">
                                <label class="form-label" for="signinSrEmail">Email</label>
                                <input type="text" class="form-control form-control-lg" name="email" id="signinSrEmail" tabindex="1" placeholder="Email" value="adminworkwise@gmail.com">
                            </div>
                            <!-- End Form -->

                            <!-- Form -->
                            <div class="mb-4">
                                <label class="form-label w-100" for="signupSrPassword" tabindex="0">
                                  <span class="d-flex justify-content-between align-items-center">
                                    <span>Mật khẩu</span>
                                  </span>
                                </label>

                                <div class="input-group input-group-merge">
                                    <input type="password" class="js-toggle-password form-control form-control-lg" name="password" id="signupSrPassword" placeholder="Mật khẩu" value="123456789">
                                </div>
                                @if (request()->session()->has('error'))
                                    <span style="font-size: 13px;
                                    color: red;
                                    margin-top: 2%;
                                    display: inline-block;">
                                            {!! request()->session()->get('error', 'Email hoặc mật khẩu không đúng'); !!}
                                    </span> 
                                @endif  
                            </div>
                            <!-- End Form -->
                            <div class="d-grid">
                                <button type="submit" class="btn btn-primary btn-lg" id="btnSubmit">Đăng nhập</button>
                            </div>
                        </form>
                        <!-- End Form -->
                    </div>
                </div>
                <!-- End Card -->

                <!-- Footer -->
                <div class="position-relative text-center zi-1">
                    <small class="text-cap text-body mb-4">Chào mừng đến với hệ thống WorkWise</small>

                    <div class="w-85 mx-auto">
                        <div class="row justify-content-between">
                            <div class="col">
                                <img class="img-fluid" src="/admins/assets/svg/brands/gitlab-gray.svg" alt="Logo">
                            </div>
                            <!-- End Col -->

                            <div class="col">
                                <img class="img-fluid" src="/admins/assets/svg/brands/fitbit-gray.svg" alt="Logo">
                            </div>
                            <!-- End Col -->

                            <div class="col">
                                <img class="img-fluid" src="/admins/assets/svg/brands/flow-xo-gray.svg" alt="Logo">
                            </div>
                            <!-- End Col -->

                            <div class="col">
                                <img class="img-fluid" src="/admins/assets/svg/brands/layar-gray.svg" alt="Logo">
                            </div>
                            <!-- End Col -->
                        </div>
                        <!-- End Row -->
                    </div>
                </div>
                <!-- End Footer -->
            </div>
        </div>
        <!-- End Content -->
    </main>
    <script>
        var email = document.getElementById('signinSrEmail');
        var password = document.getElementById('signupSrPassword');
        var btnSub = document.getElementById('btnSubmit');
        var form = document.getElementById('formSubmit');

        email.addEventListener('keyup', function() {
            handleCheckForm();
        });

        password.addEventListener('keyup', function() {
            handleCheckForm();
        });

        function handleCheckForm() {
            if(email.value != "" && password.value != "") {
                btnSub.removeAttribute('disabled');
            } else {
                btnSub.setAttribute('disabled', true);
            }
        }
        
    </script>
</body>
</html>
