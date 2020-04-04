<!DOCTYPE html>
<html lang="en">

<head>

	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<meta name="description" content="">
	<meta name="author" content="">
	<base href="{{asset('')}}">
	<meta name="csrf-token" content="{{ csrf_token() }}">
	<title>Admin - FasterFood</title>

	<!-- Custom fonts for this template-->
	<link href="admintemplate/vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">

	<!-- Custom styles for this template-->
	<link href="admintemplate/css/sb-admin.css" rel="stylesheet">

</head>

<body class="bg-dark">

	<div class="container">
		<div class="card card-login mx-auto mt-5">
			<div class="card-header">Đăng Nhập</div>
			@if(count($errors)>0)
			<div class="alert alert-danger">
				@foreach($errors->all() as $err)
				{{$err}}<br>
				@endforeach
			</div>
			@endif
			@if(Session::has('message'))
			<div class="alert alert-danger">{{Session::get('message')}}</div>
			@endif
			<div class="card-body">
				<form action="/admin/login" method="post" enctype="multipart/form-data">
					{!!csrf_field()!!}
					<div class="form-group">
						<div class="form-label-group">
							<input type="email" id="inputEmail" name="email" class="form-control" placeholder="Email address" required="required">
							<label for="inputEmail">Email</label>
						</div>
					</div>
					<div class="form-group">
						<div class="form-label-group">
							<input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password" required="required">
							<label for="inputPassword">Mật Khẩu</label>
						</div>
					</div>
					<div class="form-group">
						<div class="checkbox">
							<label>
								<input type="checkbox" value="remember-me">
								Remember Password
							</label>
						</div>
					</div>
					<input type="submit" value="Đăng Nhập" class="btn btn-primary btn-block" name="">
				</form>
				<div class="text-center">
					<a class="d-block small mt-3" href="register.html">Register an Account</a>
					<a class="d-block small" href="forgot-password.html">Forgot Password?</a>
				</div>
			</div>
		</div>
	</div>

	<!-- Bootstrap core JavaScript-->
	<script src="admintemplate/vendor/jquery/jquery.min.js"></script>
	<script src="admintemplate/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

	<!-- Core plugin JavaScript-->
	<script src="admintemplate/vendor/jquery-easing/jquery.easing.min.js"></script>

</body>

</html>
