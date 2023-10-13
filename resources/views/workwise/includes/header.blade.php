<head>
    <!-- Mirrored from gambolthemes.net/workwise-new/index.html by HTTrack Website Copier/3.x [XR&CO'2014], Sun, 16 Apr 2023 14:55:34 GMT -->
    <meta charset="UTF-8">
    {{-- <title>WorkWise</title> --}}
    <title>{{ isset($title) ? $title : 'WorkWise' }}</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <meta name="description" content />
    <meta name="keywords" content />
    {{-- <meta http-equiv="Cache-control" content="no-cache"> --}}
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600&amp;display=swap" rel="stylesheet">
    <link rel="shortcut icon" type="image/x-icon" href="/workwise/images/logo.png">
    <link rel="stylesheet" type="text/css" href="/workwise/css/animate.css">
    <link rel="stylesheet" type="text/css" href="/workwise/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="/workwise/css/line-awesome.css">
    <link rel="stylesheet" type="text/css" href="/workwise/css/line-awesome-font-awesome.min.css">
    <link href="/workwise/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="/workwise/css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="/workwise/css/jquery.mCustomScrollbar.min.css">
    <link rel="stylesheet" type="text/css" href="/workwise/lib/slick/slick.css">
    <link rel="stylesheet" type="text/css" href="/workwise/lib/slick/slick-theme.css">
    <link rel="stylesheet" type="text/css" href="/workwise/css/style.css">
    <link rel="stylesheet" type="text/css" href="/workwise/css/responsive.css">
    <link rel="stylesheet" href="/workwise/css/profile/style.css">
    <link rel="stylesheet" href="/toastr/toastr.min.css">
    <link rel="stylesheet" href="/lightbox/lightbox.css">
    <link rel="stylesheet" href="/sweetalert2/sweetalert2.min.css">
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@10/swiper-bundle.min.css"/>
    <style>
        body {
            font-family: "Inter";
        }
        ::-webkit-scrollbar {
            width: 5px;
            height: 10px;
        }

        ::-webkit-scrollbar-thumb {
            background-color:#e44d3a;
            border: 4px solid transparent;
            /* border-radius: 8px; */
        }
    </style>
    @yield('style')
</head>