@extends('master')
@section('content')
<div class="container">
	<div class="row">
		<div class="col-md-12">
			<div class="error-template">
				<h1>
				Success!</h1>
				<h2>
				Hoàn Tất Đặt Hàng</h2>
				<div class="error-details">
					Quay trờ lại trang chủ để tiếp tục mua hàng.
				</div>
				<div class="error-actions">
					<a href="/" class="btn btn-primary btn-lg"><span class="glyphicon glyphicon-home"></span>
					Take Me Home </a>
				</div>
			</div>
		</div>
	</div>
</div>
<style type="text/css">
	.error-template {padding: 40px 15px;text-align: center;}
	.error-actions {margin-top:15px;margin-bottom:15px;}
	.error-actions .btn { margin-right:10px; }
</style>
@endsection