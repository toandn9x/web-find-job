@extends('workwise.layouts.master')
@section('style')
    <link rel="stylesheet" href="/workwise/css/dashboard/style.css">
@endsection
@section('main-content')
<div class="wrapper">
    <div class="wrap">
		<div class="wrap-hand">
			<i class="fa fa-hand-paper-o" aria-hidden="true"></i>
		</div>
		<div class="forbidden">
			<h1>FORBIDDEN</h1>
			<h1>403</h1>
			<b>Xin lỗi bạn không có quyền truy cập vào trang này !!</b>
			<a href="/">Quay lại trang chủ</a>
		</div>
	</div>
</div>
<style>
.wrapper{
	width: 100%;
	height: 90vh;
}
.wrap{
	width: 800px;
	height: 100%;
	margin: 0 auto;
	display: flex;
	align-items: center;
	justify-content: space-between;
}
.wrap-hand{
	width: 350px;
	height: 350px;
	background-color: #e44d3a;
	position: relative;
}
.wrap-hand i{
	display: flex;
	justify-content: center;
	line-height: 350px;
	font-size: 200px;
	color: white;
}
.wrap-hand:before {
    content: "";
    width: 350px;
    height: 0;
    position: absolute;
    top: 0;
    left: 0;
    border-bottom: 80px solid #e44d3a;
    border-left: 80px solid #f4f4f4;
    border-right: 80px solid #f4f4f4;
}
.wrap-hand::after {
    content: "";
    width: 350px;
    height: 0;
    position: absolute;
    bottom: 0;
    left: 0;
    border-top: 80px solid #e44d3a;
    border-left: 80px solid #f4f4f4;
    border-right: 80px solid #f4f4f4;
}
.forbidden{
	width: 400px;
	height: 350px;
	text-align: start;
	font-family: Arial, Helvetica, sans-serif;
	margin-top: 100px;
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
	color: rgb(122, 14, 209);
	font-weight: bold;
	text-align: center;
	display: block;
	margin: 20px 0;
}
.forbidden :nth-child(4){
	font-size: 20px;
	color: rgb(242, 238, 245);
	font-weight: bold;
	text-align: center;
	background-color: #e44d3a;
	border-radius: 5px;
	padding: 10px 15px;
	display: block;
}
</style>
@endsection