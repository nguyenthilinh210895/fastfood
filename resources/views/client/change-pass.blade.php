@extends('master')
@section('content')
<div class="header-title">
	<h3>Đổi Mật Khẩu</h3>
</div>
<!-- .courses -->
<div class="container">
	<div class="row">
		<div class="span3">	
			<div class="student-info">
				@if(Session::has('message'))
				<div class="alert alert-success">{{Session::get('message')}}</div>
				@endif
				@if(Session::has('error'))
				<div class="alert alert-danger">{{Session::get('error')}}</div>
				@endif
				<form action="/change-password" method="Post" enctype="multipart/form-data">
					{!!csrf_field()!!}
					<div class="input-container">
						<label>Mật Khẩu Cũ:</label>
						<input type="password" name="oldPass" class="form-control" required="">
					</div>

					<div class="input-container">
						<label>Mật Khẩu Mới:</label>
						<input type="password" name="newPass" class="form-control" required=""> 
					</div>
					<div class="input-container">
						<label>Xác Nhận Mật Khẩu:</label>
						<input type="password" name="rePass" class="form-control" required="">
					</div>
					<button type="submit" class="btn btn-primary">Cập Nhật</button>
				</form>
			</div>
		</div>		
	</div>
</div>
@endsection
