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
				@endif
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">Thông Tin Khách Hàng</a>
					</div>
					<div id="collapseTwo" class="accordion-body collapse <?php if(Auth::user()) echo 'in' ?>">
						<div class="accordion-inner">
							<div class="row-fluid">
								<div class="span6">
									<div class="control-group">
										<label class="control-label">Họ Tên</label>
										<div class="controls">
											<input type="text" name="name" placeholder="" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Email</label>
										<div class="controls">
											<input type="email" name="email" placeholder="" class="input-xlarge">
										</div>
									</div>					  
									<div class="control-group">
										<label class="control-label">Số Điện Thoại</label>
										<div class="controls">
											<input type="number" name="phone" placeholder="" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Địa Chỉ Nhận Hàng</label>
										<div class="controls">
											<input type="text" name="address" placeholder="" class="input-xlarge">
										</div>
									</div>
								</div>
								<div class="span6">
									<h4>Your Address</h4>
									<div class="control-group">
										<label class="control-label">Company</label>
										<div class="controls">
											<input type="text" placeholder="" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Company ID:</label>
										<div class="controls">
											<input type="text" placeholder="" class="input-xlarge">
										</div>
									</div>					  
									<div class="control-group">
										<label class="control-label"><span class="required">*</span> Address 1:</label>
										<div class="controls">
											<input type="text" placeholder="" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label">Address 2:</label>
										<div class="controls">
											<input type="text" placeholder="" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label"><span class="required">*</span> City:</label>
										<div class="controls">
											<input type="text" placeholder="" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label"><span class="required">*</span> Post Code:</label>
										<div class="controls">
											<input type="text" placeholder="" class="input-xlarge">
										</div>
									</div>
									<div class="control-group">
										<label class="control-label"><span class="required">*</span> Country:</label>
										<div class="controls">
											<select class="input-xlarge">
												<option value="1">Afghanistan</option>
												<option value="2">Albania</option>
												<option value="3">Algeria</option>
												<option value="4">American Samoa</option>
												<option value="5">Andorra</option>
												<option value="6">Angola</option>
											</select>
										</div>
									</div>
									<div class="control-group">
										<label class="control-label"><span class="required">*</span> Region / State:</label>
										<div class="controls">
											<select name="zone_id" class="input-xlarge">
												<option value=""> --- Please Select --- </option>
												<option value="3513">Aberdeen</option>
												<option value="3514">Aberdeenshire</option>
												<option value="3515">Anglesey</option>
												<option value="3516">Angus</option>
												<option value="3517">Argyll and Bute</option>
											</select>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="accordion-group">
					<div class="accordion-heading">
						<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">Confirm Order</a>
					</div>
					<div id="collapseThree" class="accordion-body collapse">
						<div class="accordion-inner">
							<div class="row-fluid">
								<div class="control-group">
									<label for="textarea" class="control-label">Comments</label>
									<div class="controls">
										<textarea rows="3" id="textarea" class="span12"></textarea>
									</div>
								</div>									
								<button class="btn btn-inverse pull-right">Confirm order</button>
							</div>
						</div>
					</div>
				</div>
			</div>				
		</div>
	</div>
</section>	
@endsection