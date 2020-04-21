@extends('master')
@section('content')
<section class="main-content">
	<div class="row">
		<div class="span12">
			<div class="accordion" id="accordion2">
				@if(!Auth::user())
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Đăng Nhập</a>
					</div>
					<div id="collapseOne" class="accordion-body in collapse">
						<div class="accordion-inner">
							<div class="row-fluid">
								<div class="span6">
									<h4>Vui Lòng Đăng Nhập</h4>
									<p>bạn cần đăng nhập để tiến hành thanh toán</p>
									<form action="/login" method="post">
										{!!csrf_field()!!}
										<fieldset>
											<div class="control-group">
												<label class="control-label">Email</label>
												<div class="controls">
													<input type="email" name="email" id="email" class="input-xlarge">
												</div>
											</div>
											<div class="control-group">
												<label class="control-label">Mật Khẩu</label>
												<div class="controls">
													<input type="password" name="password" id="password" class="input-xlarge">
												</div>
											</div>
											<input type="hidden" value="1" name="reg">
											<input type="submit" class="btn btn-primary" name="" value="Đăng Nhập">
										</fieldset>
									</form>
								</div>
							</div>
						</div>
					</div>
				</div>
				@else
				<form action="/accept-order-online" method="post">
					{!!csrf_field()!!}
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Thông Tin Khách Hàng</a>
						</div>
						<div id="collapseTwo" class="accordion-body collapse in">
							<div class="accordion-inner">
								<div class="row-fluid">
									<div class="span6">
										<div class="control-group">
											<label class="control-label">Họ Tên</label>
											<div class="controls">
												<input type="text" name="name" value="{{Auth::user()->name}}" readonly=""  class="input-xlarge">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Email</label>
											<div class="controls">
												<input type="email" name="email" value="{{Auth::user()->email}}" readonly="" class="input-xlarge">
											</div>
										</div>	
									</div>
									<div class="span6">
										<div class="control-group">
											<label class="control-label">Số Điện Thoại (*)</label>
											<div class="controls">
												<input type="number" name="phone" required="" class="input-xlarge">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Địa Chỉ Nhận Hàng (*)</label>
											<div class="controls">
												<textarea class="input-xlarge" name="address" required=""></textarea>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="accordion-group">
						<div class="accordion-heading">
							<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Xác Nhận Đơn Hàng</a>
						</div>
						<div id="collapseThree" class="accordion-body in collapse">
							<div class="accordion-inner">
								<div class="row-fluid">
									<div class="control-group">
										<h3 style="color: red">Tổng Tiền: {{ number_format(Session::get('checkout')->total_price )}}VNĐ</h3>
									</div>
									<div class="control-group">
										<h4>Phương Thức Thanh Toán?</h4>
										<label class="radio">
											<input type="radio" name="payment" id="optionsRadios1" value="1" checked="">
											Online
										</label>
										<label class="radio">
											<input type="radio" name="payment" id="optionsRadios2" value="2">
											Thanh toán khi nhận hàng
										</label>
									</div>

									<div class="control-group">
										<label for="textarea" class="control-label">Ghi Chú</label>
										<div class="controls">
											<textarea rows="3" name="note" id="textarea" class="span12"></textarea>
										</div>
									</div>
									<div class="control-group">
										<input type="submit" value="Xác Nhận" class="btn btn-primary" name="">
									</div>
								</div>
							</div>
						</div>
					</div>
				</form>
				@endif
			</div>				
		</div>
	</div>
</section>	
@endsection