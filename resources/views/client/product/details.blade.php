@extends('master')
@section('content')
<section class="header_text sub">
	<h4><span>Chi Tiết Sản Phẩm</span></h4>
</section>
<section class="main-content">				
	<div class="row">						
		<div class="span9">
			<div class="row">
				<div class="span4">
					<a href="img/{{$product->image}}" class="thumbnail" data-fancybox-group="group1" title="Description 1"><img alt="" src="img/{{$product->image}}"></a>		
				</div>
				<div class="span5">
					<address>
						<strong>Loại sản phẩm:</strong> <span>{{$product->category->name}}</span><br>
						<strong>Sản Phẩm:</strong> <span>{{$product->product_name}}</span><br>
						<strong>Reward Points:</strong> <span>0</span><br>
						<strong>Availability:</strong> <span>Out Of Stock</span><br>								
					</address>
					@if($product->promotion_price != null)
					<h4><strong>
						<p class="price">
							Giá:
							<span class="price-line">
								{{number_format($product->unit_price)}} VNĐ
							</span>
							<span class="pro-price">
								{{number_format($product->promotion_price)}} VNĐ
							</span>
						</p>
					</strong></h4>
					@else
					<h4><strong>
						<p class="price">
							Giá:
							{{number_format($product->unit_price)}} VNĐ
						</p>
					</strong></h4>
					@endif									
					
				</div>
				<div class="span5">
					<form class="form-inline">
						<label>Số Lượng:</label>
						<input type="text" class="span1" placeholder="1">
						<button class="btn btn-primary" type="submit">Add cart</button>
					</form>
				</div>							
			</div>
			<div class="row">
				<div class="span9">
					<ul class="nav nav-tabs" id="myTab">
						<li class="active"><a href="#home">Mô tả</a></li>
						<li class=""><a href="#profile">Đánh Giá</a></li>
					</ul>							 
					<div class="tab-content">
						<div class="tab-pane active" id="home">
							{!! $product->description !!}
						</div>
						<div class="tab-pane" id="profile">
							<table class="table table-striped shop_attributes">	
								<tbody>
									<tr class="">
										<th>Size</th>
										<td>Large, Medium, Small, X-Large</td>
									</tr>		
									<tr class="alt">
										<th>Colour</th>
										<td>Orange, Yellow</td>
									</tr>
								</tbody>
							</table>
						</div>
					</div>							
				</div>						
				<div class="span9">	
					<br>
					<h4 class="title">
						<span class="pull-left"><span class="text">Sản Phẩm <strong>Tương Tự</strong> </span></span>
					</h4>
					<div class="carousel slide">
						<div class="active item">
							<ul class="thumbnails">	
								@foreach($relate_product as $d)
								<li class="span3">
									<div class="product-box">
										<span class="sale_tag"></span>
										<p>
											<a href="product-detail/{{$d->id}}">
												<img src="img/{{$d->image}}" alt="" />
											</a>
										</p>
										<a href="product-detail/{{$d->id}}" class="title">{{$d->product_name}}</a><br/>
										<a href="products.html" class="category">{{$d->name}}</a>
										@if($d->promotion_price != null)
										<p class="price">
											<span class="price-line">
												{{number_format($d->unit_price)}} VNĐ
											</span>
											<span class="pro-price">
												{{number_format($d->promotion_price)}} VNĐ
											</span>
										</p>
										@else
										<p class="price">
											{{number_format($d->unit_price)}} VNĐ
										</p>
										@endif
									</div>
								</li>
								@endforeach
							</ul>
						</div>	
					</div>
				</div>
			</div>
		</div>
		<div class="span3 col">
			<div class="block">	
				<ul class="nav nav-list">
					<li class="nav-header">MENU Món</li>
					@foreach($category as $c)
					<li><a href="products.html">{{$c->name}}</a></li>
					@endforeach
				</ul>
				<br/>
			</div>
			<div class="block">								
				<h4 class="title"><strong>Best</strong> Seller</h4>								
				<ul class="small-product">
					<li>
						<a href="#" title="Praesent tempor sem sodales">
							<img src="themes/images/ladies/1.jpg" alt="Praesent tempor sem sodales">
						</a>
						<a href="#">Praesent tempor sem</a>
					</li>
					<li>
						<a href="#" title="Luctus quam ultrices rutrum">
							<img src="themes/images/ladies/2.jpg" alt="Luctus quam ultrices rutrum">
						</a>
						<a href="#">Luctus quam ultrices rutrum</a>
					</li>
					<li>
						<a href="#" title="Fusce id molestie massa">
							<img src="themes/images/ladies/3.jpg" alt="Fusce id molestie massa">
						</a>
						<a href="#">Fusce id molestie massa</a>
					</li>   
				</ul>
			</div>
		</div>
	</div>
</section>	
<script>
	$(function () {
		$('#myTab a:first').tab('show');
		$('#myTab a').click(function (e) {
			e.preventDefault();
			$(this).tab('show');
		})
	})
	$(document).ready(function() {
		$('.thumbnail').fancybox({
			openEffect  : 'none',
			closeEffect : 'none'
		});

		$('#myCarousel-2').carousel({
			interval: 2500
		});								
	});
</script>
@endsection