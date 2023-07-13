@extends('auth.layout.master')

@section('content')
    <form action="{{ url('/messenger/login') }}" method="POST">
        @csrf
            <h3>Đăng nhập</h3>

            <label for="email" id="label-email">Email</label>
            <input type="text" name="email" placeholder="Email" id="email">

            <label for="password">Mật khẩu</label>
            <input type="password" name="password" placeholder="Password" id="password">

            <button type="submit">Đăng nhập</button>

            <p class="not-account">Bạn chưa có tài khoản ? <a role="link" aria-disabled="true" id="btn-register">Đăng ký</a></p>
    </form>
@endsection

@section('script')
    <script src="/script/login.js"></script>
@endsection