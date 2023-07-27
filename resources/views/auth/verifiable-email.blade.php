@extends('auth.layout.master')

@section('content')
@if (Session::has("token"))
    <p>Xin chào</p>
@endif
<form action="{{ url('/check-verifiablde-email') }}" method="POST" id="form-check-verifiable-email">
    @csrf
        <label for="code-email" id="label-code-email">Nhập mã xác minh</label>
        <input type="text" name="code-email" placeholder="Nhập mã gồm sáu chữ số" id="code-email" maxlength="6">

        <button type="submit">Xác nhận</button>

        <p class="not-account">Mã đã hết hạn ? <a role="link" aria-disabled="true" id="btn-send-agian-mail">Gửi lại mã</a></p>
</form>
@endsection

@section('script')
    <script src="/script/verifiable-email.js"></script>
@endsection