@extends('master')
@section('content')
<section class="header_text sub">
	<h4><span>Sản Phẩm Khuyến Mãi </span></h4>
</section>
<section class="main-content">				
	<div class="row">						
		<div class="span9">
			<h4 class="title">
				<span class="pull-left">
					<span class="text">
						<span class="line">
							<strong>Khuyến Mãi </strong>
						</span>
					</span>
				</span>
			</h4>
			<div class="myCarousel carousel slide">
				<div class="item">
					<ul class="thumbnails">	
						@foreach($product as $f)
						<li class="span3">
							<div class="product-box">
								<span class="sale_tag"></span>
								<p>
									<a href="product-detail/{{$f->id}}">
										<img src="img/{{$f->image}}" alt="" />
									</a>
								</p>
								<a href="product-detail/{{$f->id}}" class="title">{{$f->product_name}}</a><br/>
								<a href="products.html" class="category">{{$f->name}}</a>
								@if($f->promotion_price != null)
								<p class="price">
									<span class="price-line">
										{{number_format($f->unit_price)}} VNĐ
									</span>
									<span class="pro-price">
										{{number_format($f->promotion_price)}} VNĐ
									</span>
								</p>
								@else
								<p class="price">
									{{number_format($f->unit_price)}} VNĐ
								</p>
								@endif
								<a href="{{route('addcart', $f->id)}}" class="btn btn-primary">Add Cart <i class="fas fa-cart-plus"></i></a>
							</div>
						</li>
						@endforeach
					</ul>
					<div class=" row pagination pagination-small pagination-centered"> 
						{{$product->links()}}
					</div>
				</div>						
			</div>
		</div>
		<div class="span3 col">
			<div class="block">	
				<ul class="nav nav-list">
					<li class="nav-header">MENU Món</li>
					@foreach($category as $c)
					<li><a href="/product/{{$c->id}}">{{$c->name}}</a></li>
					@endforeach
				</ul>
				<br/>
			</div>
		</div>
	</div>
</section>	
@endsection