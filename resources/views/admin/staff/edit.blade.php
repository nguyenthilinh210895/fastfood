@extends('admin.master')
@section('content')
<div class="container-fluid">

	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Sửa Nhân Viên</li>
	</ol>
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Sửa Nhân Viên
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
			<div class="alert alert-error">{{Session::get('error')}}</div>
			@endif
			@if(Session::has('message'))
			<div class="alert alert-success">{{Session::get('message')}}</div>
			@endif
		</div>
		<div class="row card-body">
			<div class="col-md-6">
				<form action="/admin/staff/edit/{{$staff->id}}" method="post" enctype="multipart/form-data">
					{!!csrf_field()!!}
					<div class="form-group">
						<label>Họ Tên</label>
						<input type="text" name="name" value="{{$staff->name}}" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="Email" value="{{$staff->email}}" readonly="" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label>Mật Khẩu</label>
						<input class="form-control" name="password" type="password" />
					</div>
					<div class="form-group">
						<label>Nhập lại Mật Khẩu</label>
						<input class="form-control" name="re_pasword" type="password" />
					</div>
					<div class="form-group">
						<label>Số Điện Thoại</label>
						<input class="form-control" value="{{$staff->phone}}" name="phone" type="number" required />
					</div>
					<div class="form-group">
						<label>Địa Chỉ</label>
						<input type="text" value="{{$staff->address}}" name="address" class="form-control">
					</div>
					<div class="form-group">
						<label>Mức Lương</label>
						<input class="form-control" value="{{$staff->salary}}"  type="number" name="salary" required />
					</div>
					<div class="form-group">
						<label>Quyền</label>
						<select name="role" id="" class="form-control">
							@if($staff->role == 1)
							<option value="1" selected>Quản lý</option>
							<option value="2">Nhân viên</option>
							@else if($staff->role == 2)
							<option value="1">Quản lý</option>
							<option value="2" selected>Nhân viên</option>
							@endif
						</select>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update</button>
						<button type="reset" class="btn btn-danger">Đặt Lại</button>
					</div>
				</form>
			</div>
			<div class="col-md-6" style="padding-left: 40px;">
				<p>Avatar</p>
				<div class="form-group">
					<img src="img/{{$staff->avatar}}" width="200" height="200">
				</div>
			</div>	
		</div>
	</div>
</div>
<!-- /.container-fluid -->
@endsection