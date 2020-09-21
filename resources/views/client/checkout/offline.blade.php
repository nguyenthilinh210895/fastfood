@extends('master')
@section('content')
<section class="main-content">
	<div class="row">
		<div class="span12">
			<div class="accordion" id="accordion2">
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Thông Tin Khách Hàng</a>
					</div>
					<div class="msg">
						@if(Session::has('error'))
						<div class="alert alert-danger">{{Session::get('error')}}</div>
						@endif
					</div>
					<div id="collapseTwo" class="accordion-body in collapse">
						<div class="accordion-inner">
							<form action="/accept-order-offline" method="post">
								{!!csrf_field()!!}
								<div class="row-fluid">
									<div class="span6">
										<div class="control-group">
											<label class="control-label">Họ Tên</label>
											<div class="controls">
												@if (!Auth::user())
												<input type="text" name="name" placeholder="" class="input-xlarge" required="">
												@else
												<input type="text" name="name" placeholder="" class="input-xlarge" readonly required="" value = '{{Auth::user()->name}}'>
												@endif
											</div>
										</div>		
										<div class="control-group">
											<label class="control-label">Email</label>
											<div class="controls">
											@if (!Auth::user())
												<input type="email" name="email" placeholder="" class="input-xlarge" required="">
											@else
												<input type="email" name="email" placeholder="" class="input-xlarge" required="" value = '{{Auth::user()->email}}' readonly>
											@endif
											</div>
										</div>	  
										<div class="control-group">
											<label class="control-label">Số Điện Thoại</label>
											<div class="controls">
											@if (!Auth::user())
												<input type="number" name="phone" required="" placeholder="" class="input-xlarge">
											@else
												<input type="number" name="phone" required="" placeholder="" class="input-xlarge" value = '{{Auth::user()->phone}}' readonly>
											@endif
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Ghi Chú</label>
											<div class="controls">
												<textarea class="input-xlarge" name="note"></textarea>
											</div>
										</div>	
									</div>
									<div class="span6">
										<div class="control-group">
											<label class="control-label">QRCode</label>
											<div class="controls">
												<input type="text" class="qr-code" name="code" id="qrcode" placeholder="" class="input-xlarge" required="">
											</div>
										</div>
										<div class="control-group">
											<video id="camera" style="width: 250px"></video>

											<script type="text/javascript">
												let scanner = new Instascan.Scanner({
													video: document.getElementById("camera")
												});

												let resultado = document.getElementById("qrcode");
												scanner.addListener("scan", function(content) {
													resultado.value = content;
													//scanner.stop();
												});
												Instascan.Camera.getCameras()
												.then(function(cameras) {
													if (cameras.length > 0) {
														scanner.start(cameras[0]);
													} else {
														resultado.innerText = "No cameras found.";
													}
												})
												.catch(function(e) {
													resultado.innerText = e;
												});

											</script>
										</div>
									</div>
								</div>
								<div class="control-group">
									<h3 style="color: red">Tổng Tiền: {{ number_format(Session::get('checkout')->total_price )}}VNĐ</h3>
								</div>
								<input type="submit" class="btn btn-primary" value="xác nhận" name="">
							</form>
						</div>
					</div>
				</div>
			</div>				
		</div>
	</div>
</section>	
<style type="text/css">
</style>
@endsection