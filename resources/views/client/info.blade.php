@extends('master')
@section('content')
<div class="header-title">
	<h3>Thông Tin Cá Nhân</h3>
</div>
<!-- .courses -->
<div class="container">
	<div class="row">
		<div class="span4">
			<div class="student-outer">
				<div class="student-img">
					<img src="/img/{{Auth::user()->avatar}}" width="200px" >
				</div>
				<div class="student-text">
					<a href="/history-order">
						Lịch Sử Đặt Hàng
					</a>	
					<a href="change-password">
						Đổi Mật Khẩu
					</a>
				</div>
			</div>					
		</div>
		<div class="span2"></div>
		<div class="span6">	
			<div class="student-info">
				@if(Session::has('message'))
				<div class="alert alert-success">{{Session::get('message')}}</div>
				@endif
				@if(Session::has('error'))
				<div class="alert alert-danger">{{Session::get('error')}}</div>
				@endif
				<form action="/update-info" method="Post" enctype="multipart/form-data">
					{!!csrf_field()!!}
					<div class="input-container">
						<label>Họ Tên:</label>
						<input class="input-field form-control" type="text" value="{{Auth::user()->name}}" name="name">
					</div>

					<div class="input-container">
						<label>Email:</label>
						<input class="input-field form-control" type="text" placeholder="Email" name="email" readonly value="{{Auth::user()->email}}">
					</div>

					<div class="input-container">
						<label>Địa Chỉ</label>
						<input class="input-field form-control" type="text" value="{{Auth::user()->address}}" name="address" >
					</div>

					<div class="input-container">
						<label>Số Điện Thoại</label>
						<input class="input-field form-control" type="text" value="{{Auth::user()->phone}}" name="phone" >
					</div>
					<div class="input-container">
						<label>Avatar:</label>
						<input class="input-field" type="file" name="avatar">
					</div>
					<button type="submit" class="btn btn-primary">Cập Nhật</button>
				</form>
			</div>
		</div>		
	</div>
</div>
<style type="text/css">
	.student-img{
		text-align: center;
	}

	.student-img img{
		width: 100%;
	}

	.student-text{
		display: flex;
	}

	.student-text a{
		display: block;
		height: 40px;
		width: 50%;
		background-color: #08c;
		text-align: center;
		line-height: 40px;
		color: #fff;
		font-size: 13px;
		padding: 0px;
		margin: 5px;
	}
</style>
@endsection
