@extends('workwise.layouts.master')
@section('style')
    <link rel="stylesheet" href="/workwise/css/dashboard/style.css">
@endsection
@section('main-content')
<div class="wrapper">
    <div class="wrap">
		<div class="wrap-hand">
			<img src="/workwise/images/sut-vao-dit.png" alt="">
		</div>
		<div class="forbidden">
			<h1>UNAUTHORIZED</h1>
			<h1>401</h1>
			<a href="{{ route('form-login') }}">Đăng nhập</a>
		</div>
	</div>
</div>
<style>
.wrapper{
	width: 100%;
}
.wrap{
	width: 800px;
	height: 100%;
	margin: 0 auto;
}
.wrap-hand{
	width: 100%;
    margin: 0 auto;
    height: 350px;
    display: flex;
    justify-content: center;
}
.wrap-hand img{
	color: #e44d3a;
    width: 400px;
    height: 300px;
}
.forbidden{
	width: 100%;
    margin: 0 auto;
	text-align: center;
	font-family: Arial, Helvetica, sans-serif;
}
.forbidden :nth-child(1){
	font-size: 80px;
	color: purple;
	font-weight: bold;
}
.forbidden :nth-child(2){
	font-size: 80px;
	color: #e44d3a;
	font-weight: bold;
	text-align: center;
}
.forbidden :nth-child(3){
	font-size: 20px;
	color: rgb(242, 238, 245);
	font-weight: bold;
	text-align: center;
	background-color: #e44d3a;
	border-radius: 5px;
	display: block;
    width: 200px;
    height: 50px;
    line-height: 50px;
    margin: 0 auto;
    margin-bottom: 60px;
    margin-top: 20px;
}
</style>
@endsection