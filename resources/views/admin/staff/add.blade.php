@extends('admin.master')
@section('content')
<div class="container-fluid">

	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="/admin/index">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Thêm Nhân Viên</li>
	</ol>
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Thêm Nhân Viên
		</div>
		<div class="msg">
			@if(count($errors)>0)
			<div class="alert alert-danger">
				@foreach($errors->all() as $err)
				{{$err}}<br>
				@endforeach
			</div>
			@endif
			@if(Session::has('error'))
			<div class="alert alert-danger">{{Session::get('error')}}</div>
			@endif
			@if(Session::has('message'))
			<div class="alert alert-success">{{Session::get('message')}}</div>
			@endif
		</div>
		<div class="card-body col-md-12">
			<form action="/admin/staff/add" method="post" enctype="multipart/form-data">
				{!!csrf_field()!!}
				<div class="form-group col-md-6 s-form">
					<label>Họ Tên</label>
					<input type="text" name="name" class="form-control" required="">
				</div>
				<div class="form-group col-md-6 s-form">
					<label>Email</label>
					<input type="Email" name="email" class="form-control" required="">
				</div>
				<div class="form-group col-md-6 s-form">
					<label>Mật Khẩu</label>
					<input class="form-control" name="password" type="password" required />
				</div>
				<div class="form-group col-md-6 s-form">
					<label>Nhập lại Mật Khẩu</label>
					<input class="form-control" name="re_pasword" type="password" required />
				</div>
				<div class="form-group col-md-6 s-form">
					<label>Số Điện Thoại</label>
					<input class="form-control" name="phone" type="number" required />
				</div>
				<div class="form-group col-md-6 s-form">
					<label>Địa Chỉ</label>
					<input type="text" name="address" class="form-control" required>
				</div>
				<div class="form-group col-md-6 s-form">
					<label>Giờ bắt đầu làm</label>
					<input class="form-control" name="start_in" type="time" required />
				</div>
				<div class="form-group col-md-6 s-form">
					<label>Giờ kết thúc</label>
					<input type="time" name="start_out" class="form-control" required >
				</div>
				<div class="form-group col-md-6 s-form">
					<label>Mức Lương</label>
					<input class="form-control" type="number" name="salary" required />
				</div>
				<div class="form-group col-md-6 s-form">
					<label>Quyền</label>
					<select name="role" id="" class="form-control">
						<option value="1">Quản lý</option>
						<option value="2">Nhân viên</option>
					</select>
				</div>
				<div class="form-group col-md-6 s-form">
					<button type="submit" class="btn btn-primary">Thêm</button>
					<button type="reset" class="btn btn-danger">Đặt Lại</button>
				</div>
			</form>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
<style type="text/css">
	.s-form{
		float: left;
	}
</style>
@endsection