<!DOCTYPE html>
<html>
{{-- File Header.blade --}}
@include('workwise.includes.header')
@yield('style')
<body>
    <div class="wrapper">
        {{-- File Navbar.blade --}}
        @include('workwise.includes.navbar')

        {{-- Main Content --}}
        @yield('main-content')
    </div>
    <footer class="p-3">
        <div class="footy-sec mn no-margin">
            <div class="container d-flex justify-content-center align-items-lg-center">
                <img class="fl-rgt" src="/workwise/images/logo2.png" alt>
                <p>&copy; Copyright 2023. Được phát triển bởi DNDev</p>
            </div>
        </div>
    </footer>
    {{-- File Footer --}}
    @include('workwise.includes.footer')
    @yield('script')
</body>

</html>
