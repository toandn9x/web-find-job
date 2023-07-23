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
    <footer>
        <div class="footy-sec mn no-margin">
            <div class="container">
                <ul>
                    <li><a href="help-center.html" title>Help Center</a></li>
                    <li><a href="about.html" title>About</a></li>
                    <li><a href="#" title>Privacy Policy</a></li>
                    <li><a href="#" title>Community Guidelines</a></li>
                    <li><a href="#" title>Cookies Policy</a></li>
                    <li><a href="#" title>Career</a></li>
                    <li><a href="forum.html" title>Forum</a></li>
                    <li><a href="#" title>Language</a></li>
                    <li><a href="#" title>Copyright Policy</a></li>
                </ul>
                <p><img src="/workwise/images/copy-icon2.png" alt>Copyright 2023</p>
                <img class="fl-rgt" src="/workwise/images/logo2.png" alt>
            </div>
        </div>
    </footer>
    {{-- File Footer --}}
    @include('workwise.includes.footer')
    @yield('script')
</body>

</html>
