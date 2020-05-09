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
												<input type="number" value="{{Auth::user()->phone}}" name="phone" required="" class="input-xlarge">
											</div>
										</div>
										<div class="control-group">
											<label class="control-label">Địa Chỉ Nhận Hàng (*)</label>
											<div class="controls">
												<textarea class="input-xlarge" name="address" required="">{{Auth::user()->address}}</textarea>
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
										<ul class="list-checkout">
											<li>
												<label>
													<input type="radio" name="option_payment" value="2" checked> Thanh toán khi nhận hàng
												</label>
											</li>
											<li>
												<label><input type="radio" value="ATM_ONLINE" name="option_payment">	 Thanh toán online bằng thẻ ngân hàng nội địa</label>
												<div class="boxContent">
													<p>
														<i>
															<span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>
														: Bạn cần đăng ký Internet-Banking hoặc dịch vụ thanh toán trực tuyến tại ngân hàng trước khi thực hiện.</i>
													</p>

													<ul class="cardList clearfix">
														<li class="bank-online-methods ">
															<label for="vcb_ck_on">
																<i class="BIDV" title="Ngân hàng TMCP Đầu tư &amp; Phát triển Việt Nam"></i>
																<input type="radio" value="BIDV" name="bankcode" >
															</label>
														</li>
														<li class="bank-online-methods ">
															<label for="vcb_ck_on">
																<i class="VCB" title="Ngân hàng TMCP Ngoại Thương Việt Nam"></i>
																<input type="radio" value="VCB"  name="bankcode" >
															</label>
														</li>
														<li class="bank-online-methods ">
															<label for="sml_atm_bab_ck_on">
																<i class="TPB" title="Tền phong bank"></i>
																<input type="radio" value="TPB"  name="bankcode" >
															</label>
														</li>
														<li class="bank-online-methods ">
															<label for="sml_atm_exb_ck_on">
																<i class="EXB" title="Ngân hàng Xuất Nhập Khẩu"></i>
																<input type="radio" value="EXB"  name="bankcode" >

															</label>
														</li>
													</ul>
												</div>
											</li>
											<li>
												<label><input type="radio" value="VISA" name="option_payment" selected="true">  Thanh toán bằng thẻ Visa hoặc MasterCard</label>
												<div class="boxContent">
													<p><span style="color:#ff5a00;font-weight:bold;text-decoration:underline;">Lưu ý</span>:Visa hoặc MasterCard.</p>
													<ul class="cardList clearfix">
														<li class="bank-online-methods ">
															<label for="vcb_ck_on">
																Visa:
																<input type="radio" value="VISA"  name="bankcode" >

															</label>
														</li>

														<li class="bank-online-methods ">
															<label for="vnbc_ck_on">
																Master:<input type="radio" value="MASTER"  name="bankcode" >
															</label>
														</li>
													</ul>	
												</div>
											</li>
										</ul>
									</div>

									<div class="control-group">
										<label for="textarea" class="control-label">Ghi Chú</label>
										<div class="controls">
											<textarea rows="3" required="" name="note" id="textarea" class="span12"></textarea>
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
<script src="https://www.nganluong.vn/webskins/javascripts/jquery_min.js" type="text/javascript"></script>
<script language="javascript">
	$('input[name="option_payment"]').bind('click', function() {
		$('.list-checkout li').removeClass('active');
		$(this).parent().parent('li').addClass('active');
	});		
</script> 	
<style>
	
	ul.bankList {
		clear: both;
		height: 202px;
		width: 636px;
	}
	ul.bankList li {
		list-style-position: outside;
		list-style-type: none;
		cursor: pointer;
		float: left;
		margin-right: 0;
		padding: 5px 2px;
		text-align: center;
		width: 90px;
	}
	.list-checkout li {
		list-style: none outside none;
		margin: 0 0 10px;
	}
	
	.list-checkout li .boxContent {
		display: none;
		width: 636px;
		border:1px solid #cccccc;
		padding:10px; 
	}
	.list-checkout li.active .boxContent {
		display: block;
	}
	.list-checkout li .boxContent ul {
		/*height:80px;*/
	}
	
	i.VISA, i.MASTE, i.AMREX, i.JCB, i.VCB, i.TCB, i.MB, i.VIB, i.ICB, i.EXB, i.ACB, i.HDB, i.MSB, i.NVB, i.DAB, i.SHB, i.OJB, i.SEA, i.TPB, i.PGB, i.BIDV, i.AGB, i.SCB, i.VPB, i.VAB, i.GPB, i.SGB,i.NAB,i.BAB 
	{ width:80px; height:30px; display:block; background:url(https://www.nganluong.vn/webskins/skins/nganluong/checkout/version3/images/bank_logo.png) no-repeat;}
	i.MASTE { background-position:0px -31px}
	i.AMREX { background-position:0px -62px}
	i.JCB { background-position:0px -93px;}
	i.VCB { background-position:0px -124px;}
	i.TCB { background-position:0px -155px;}
	i.MB { background-position:0px -186px;}
	i.VIB { background-position:0px -217px;}
	i.ICB { background-position:0px -248px;}
	i.EXB { background-position:0px -279px;}
	i.ACB { background-position:0px -310px;}
	i.HDB { background-position:0px -341px;}
	i.MSB { background-position:0px -372px;}
	i.NVB { background-position:0px -403px;}
	i.DAB { background-position:0px -434px;}
	i.SHB { background-position:0px -465px;}
	i.OJB { background-position:0px -496px;}
	i.SEA { background-position:0px -527px;}
	i.TPB { background-position:0px -558px;}
	i.PGB { background-position:0px -589px;}
	i.BIDV { background-position:0px -620px;}
	i.AGB { background-position:0px -651px;}
	i.SCB { background-position:0px -682px;}
	i.VPB { background-position:0px -713px;}
	i.VAB { background-position:0px -744px;}
	i.GPB { background-position:0px -775px;}
	i.SGB { background-position:0px -806px;}
	i.NAB { background-position:0px -837px;}
	i.BAB { background-position:0px -868px;}
	
	ul.cardList li {
		cursor: pointer;
		float: left;
		margin-right: 0;
		padding: 5px 4px;
		text-align: center;
	/*	width: 90px;*/
	}

</style>
@endsection