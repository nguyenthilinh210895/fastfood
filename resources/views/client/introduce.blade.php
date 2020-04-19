@extends('master')
@section('content')
<section class="header_text sub">
	<h4><span>Về Chúng Tôi</span></h4>
	<div class="msg">
		@if(Session::has('error'))
		<div class="alert alert-danger">{{Session::get('error')}}</div>
		@endif
		@if(Session::has('message'))
		<div class="alert alert-success">{{Session::get('message')}}</div>
		@endif
	</div>		
</section>
<section class="intro">
	<div class="row">
		<div class="span5">
			<div class="img"><img src="img/place.jpg" alt=""></div>
		</div>
		<div class="span7">
			<h2>FastFood</h2>
			<p>
				Thiên đường ầm thực đường phố, mang đến cho các bạn những món ăn hấp dẫn, đa dạng, tươi ngon nhất.
				Đến với chúng tôi bạn không bao giờ phải lo đói :))
			</p>
			<a href="/introduce#booktable">Đặt bàn ngay!!!</a>
		</div>
	</div>
</section>

<section class="booktable" id="booktable">
	<div class="row">
		<div class="span12">
			<h4 class="title">
				<span class="pull-left">
					<span class="text">
						<span class="line">
							<strong>Đặt Bàn </strong>
						</span>
					</span>
				</span>
			</h4>
			<p style="color: blue">Đặt bàn trước để được giữ chỗ. Chúng tôi sẽ giữ chỗ cho bạn trong vòng 2h, nếu bạn không đến, chúng tôi sẽ hủy.</p>
			<div class="item">
				<ul class="thumbnails">	
					@foreach($table as $t)
					<li class="span2">
						<div class="product-box">
							<span class="sale_tag"></span>
							<p>
								<img src="img/table.jpg" alt="" />
							</p>
							<p href="#" class="title">{{$t->table_name}}</p><br/>
							@if($t->status == 0) 
							<span class="badge badge-primary">Còn trống</span> <br>
							<a href="#" class="btn btn-primary booknow" data-idtable="{{$t->id}}" data-toggle="modal" data-target="#modalBookTable" >Đặt Ngay</a>
							@else 
							<span class="badge badge-danger">Hết Chỗ</span>
							@endif
						</div>
					</li>
					@endforeach
				</ul>
			</div>	
		</div>
	</div>
</section>

<section class="main-content">				
	<div class="row">
		<div class="span12">
			<h4 class="title">
				<span class="pull-left">
					<span class="text">
						<span class="line">
							<strong>Liện Hệ </strong>
						</span>
					</span>
				</span>
			</h4>	
		</div>	
		<div class="span5">
			<div>
				<h5>Thông tin liên hệ</h5>
				<p>
					<strong>Phone:</strong>&nbsp;(123) 456-7890<br>
					<strong>Fax:</strong>&nbsp;+04 (123) 456-7890<br>
					<strong>Email:</strong>&nbsp;<a href="#">fastfood@example.com</a>	
					<strong>Địa Chỉ:</strong>&nbsp; Hai bà trưng - hà Nội<br>		
				</p>
				<br/>
			</div>
		</div>
		<div class="span7">
			<p>Bạn Có thể xem địa chỉ cửa hàng tại đây.</p>
			<iframe width="100%" height="300" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3724.6769534298314!2d105.84135936424494!3d21.00558274394664!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3135ac77ac7d5ef3%3A0x67e140808c44baa8!2zQsOhY2ggS2hvYSwgSGFpIELDoCBUcsawbmcsIEjDoCBO4buZaSwgVmnhu4d0IE5hbQ!5e0!3m2!1svi!2s!4v1587200986835!5m2!1svi!2s"></iframe>
		</div>				
	</div>
</section>	

<!-- modal book table -->
<div class="modal fade" id="modalBookTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="booktable" method="post">
				{!!csrf_field()!!}
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold">Đặt Bàn</h4>
					<p>Vul lòng để lại thông tin liên hệ. Chúng tôi sẽ liên hệ lại với bạn.</p>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body mx-3">
					<div class="md-form mb-2">
						<label>Họ Tên:</label>
						<input type="text" id="defaultForm-email" name="name" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Email:</label>
						<input type="email" id="defaultForm-email" name="email" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Số Điện Thoại:</label>
						<input type="number" id="defaultForm-email" name="phone" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Ghi Chú:</label>
						<input type="text" id="defaultForm-email" name="note" class="form-control validate" required="">
					</div>
					<input type="hidden" id="idtable" name="id" value="">
					<div class="modal-footer d-flex justify-content-center">
						<input type="submit" name="" value="Gửi" class="btn btn-primary">
					</div>
				</div>
			</form>
		</div>
	</div>
</div>

<style type="text/css">
	.product-box img{
		height: auto;
	}
	.badge-primary{
		background-color: green;
	}
	.badge-danger{
		background-color: red;
	}
	.ml-3, .mx-3 {
		margin-left: 1rem !important;
	}
	.mr-3, .mx-3 {
		margin-right: 1rem !important;
	}
	.modal-content {
		position: relative;
		display: -webkit-box;
		display: -ms-flexbox;
		display: flex;
		-webkit-box-orient: vertical;
		-webkit-box-direction: normal;
		-ms-flex-direction: column;
		flex-direction: column;
		width: 100%;
		pointer-events: auto;
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid rgba(0, 0, 0, 0.2);
		border-radius: 0.3rem;
		outline: 0;
	}
	.modal-dialog {
		position: relative;
		width: auto;
		margin: 0.5rem;
		pointer-events: none;
	}
	.form-control {
		display: block;
		width: 100%;
		height: calc(1.5em + 0.75rem + 2px);
		padding: 0.375rem 0.75rem;
		font-size: 1rem;
		font-weight: 400;
		line-height: 1.5;
		color: #495057;
		background-color: #fff;
		background-clip: padding-box;
		border: 1px solid #ced4da;
		border-radius: 0.25rem;
		-webkit-transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
		transition: border-color 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
		transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out;
		transition: border-color 0.15s ease-in-out, box-shadow 0.15s ease-in-out, -webkit-box-shadow 0.15s ease-in-out;
	}
	@media (min-width: 576px)
	.modal-dialog {
		max-width: 500px;
		margin: 1.75rem auto;
	}
</style>
<script>
	$(document).on("click", ".booknow", function() {
		var id = $(this).data('idtable');
		$(".modal-body #idtable").val(id);
	});
</script>
@endsection