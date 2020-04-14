@extends('master')
@section('content')
<section class="header_text">
	<h4 class="title">
		<span class="text"><strong>Đăng Nhập</strong> hoặc <strong>Đăng Ký</strong></span>
	</h4>
</section>	
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
<section class="main-content">				
	<div class="row">
		<div class="span5">					
			<h4 class="title"><span class="text"><strong>Đăng Nhập</strong> Form</span></h4>
			<form action="/login" method="post">
				{!!csrf_field()!!}
				<fieldset>
					<div class="control-group">
						<label class="control-label">Email</label>
						<div class="controls">
							<input type="email" name="email" required="" id="username" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Mật Khẩu</label>
						<div class="controls">
							<input type="password" name="password" required="" id="password" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<input tabindex="3" class="btn btn-primary large" type="submit" value="Đăng Nhập">
						<hr>
						<p class="reset">Recover your <a tabindex="4" href="#" title="Recover your username or password">username or password</a></p>
					</div>
				</fieldset>
			</form>				
		</div>
		<div class="span7">					
			<h4 class="title"><span class="text"><strong>Đăng Ký</strong> Form</span></h4>
			<form action="/register" method="post" class="form-stacked">
				{!!csrf_field()!!}
				<fieldset>
					<div class="control-group">
						<label class="control-label">Họ Tên</label>
						<div class="controls">
							<input type="text" name="name" required="" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Email:</label>
						<div class="controls">
							<input type="email" name="email" required="" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Địa chỉ:</label>
						<div class="controls">
							<input type="text" name="address" required="" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Số Điện Thoại:</label>
						<div class="controls">
							<input type="text" name="phone" required="" class="input-xlarge">
						</div>
					</div>
					<div class="control-group">
						<label class="control-label">Mật Khẩu:</label>
						<div class="controls">
							<input type="password" name="password" required="" class="input-xlarge">
						</div>
					</div>	
					<div class="control-group">
						<label class="control-label">Nhập Lại Mật Khẩu:</label>
						<div class="controls">
							<input type="password" name="re_password" required="" class="input-xlarge">
						</div>
					</div>
					<div class="actions"><input tabindex="9" class="btn btn-primary large" type="submit" value="Đăng ký"></div>
				</fieldset>
			</form>					
		</div>				
	</div>
</section>	
@endsection