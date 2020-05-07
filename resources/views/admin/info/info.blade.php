@extends('admin.master')
@section('content')
<div class="container-fluid">

	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="/admin/index">Trang chủ</a>
		</li>
		<li class="breadcrumb-item active">Thông tin cá nhân</li>
	</ol>
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Thông tin cá nhân
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
				<form action="/admin/info/edit" method="post" enctype="multipart/form-data">
					{!!csrf_field()!!}
					<div class="form-group">
						<label>Họ Tên</label>
						<input type="text" name="name" value="{{Auth::user()->name}}" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="Email" value="{{Auth::user()->email}}" readonly="" name="email" class="form-control">
					</div>
					<div class="form-group">
						<label>Số Điện Thoại</label>
						<input class="form-control" value="{{Auth::user()->phone}}" name="phone" type="number" required />
					</div>
					<div class="form-group">
						<label>Địa Chỉ</label>
						<input type="text" value="{{Auth::user()->address}}" name="address" class="form-control">
					</div>
					<div class="form-group">
						<label>Ảnh đại diện</label>
						<input type="file" name="avatar" class="form-control">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update</button>
					</div>
				</form>
			</div>
			<div class="col-md-6" style="padding-left: 40px;">
				<p>Avatar</p>
				<div class="form-group">
					<img src="img/{{Auth::user()->avatar}}" width="200" height="200">
				</div>
			</div>	
		</div>
	</div>
</div>
<!-- /.container-fluid -->
@endsection