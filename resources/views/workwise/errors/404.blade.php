@extends('workwise.layouts.master')
@section('style')
    <link rel="stylesheet" href="/workwise/css/dashboard/style.css">
@endsection
@section('main-content')
<div class="wrapper">
    <div class="wrap">
		<div class="wrap-hand">
			<i class="fa fa-frown-o" aria-hidden="true"></i>
		</div>
		<div class="forbidden">
			<h1>OOPS !!</h1>
			<h1>404</h1>
			<b>Trang bạn tìm không tồn tại</b>
			<a href="/">Quay lại trang chủ</a>
		</div>
	</div>
</div>
<style>
.wrapper{
	width: 100%;
	/* height: 90vh; */
}
.wrap{
	width: 800px;
	height: 100%;
	margin: 0 auto;
}
.wrap-hand{
	width: 100%;
  margin: 0 auto;
}
.wrap-hand i{
	display: flex;
	justify-content: center;
	font-size: 300px;
	color: #e44d3a;
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
	font-size: 40px;
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
	display: block;
  width: 200px;
  height: 50px;
  line-height: 50px;
  margin: 0 auto;
  margin-bottom: 60px;
}
</style>
@endsection