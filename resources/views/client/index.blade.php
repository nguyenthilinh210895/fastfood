@extends('master')
@section('content')
<section  class="homepage-slider" id="home-slider">
	<div class="flexslider">
		<ul class="slides">
			<li>
				<img src="shopper/themes/images/carousel/banner-1.jpg" alt="" />
			</li>
			<li>
				<img src="shopper/themes/images/carousel/banner-2.jpg" alt="" />
				<div class="intro">
					<h1>Mid season sale</h1>
					<p><span>Up to 50% Off</span></p>
					<p><span>On selected items online and in stores</span></p>
				</div>
			</li>
		</ul>
	</div>			
</section>
<section class="header_text">
	Chúng tôi mang lại những món ăn ngon, hấp dẫn, luôn luôn tươi sạch.
	<br/>Hãy đến với chúng tôi và thưởng thức.
</section>
@if(Session::has('error'))
<div class="alert alert-danger">{{Session::get('error')}}</div>
@endif
<section class="main-content">
	<div class="row">
		<div class="span12">													
			<div class="row">
				<div class="span12">
					<h4 class="title">
						<span class="pull-left"><span class="text"><span class="line"><strong>Menu </strong>Món Ăn </span></span></span>
						<!-- <span class="pull-right">
							<a class="left button" href="#myCarousel" data-slide="prev"></a><a class="right button" href="#myCarousel" data-slide="next"></a>
						</span> -->
					</h4>
					<div class="myCarousel carousel slide">
						<div class="item">
							<ul class="thumbnails">	
								@foreach($food as $f)
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
										<a onclick="addToCard({{$f->id}})" class="btn btn-primary">Add Cart <i class="fas fa-cart-plus"></i></a>
									</div>
								</li>
								@endforeach
							</ul>
							<div class=" row pagination pagination-small pagination-centered"> 
								{{ $food->appends(array_except(Request::only('f'), 'page'))->links() }}
							</div>
						</div>						
					</div>
				</div>						
			</div>
			<br/>
			<div class="row">
				<div class="span12">
					<h4 class="title">
						<span class="pull-left"><span class="text"><span class="line"><strong>Menu</strong>Đồ Uống</span></span></span>
					</h4>
					<div class="myCarousel carousel slide">
						
						<div class="active item">
							<ul class="thumbnails">	
								@foreach($drink as $d)
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
										<a onclick="addToCard({{$d->id}})" class="btn btn-primary">Add Cart <i class="fas fa-cart-plus"></i></a>
									</div>
								</li>
								@endforeach
								<div class=" row pagination pagination-small pagination-centered"> 
									{{ $drink->appends(array_except(Request::only('q'), 'page'))->links() }}
								</div>
							</ul>
						</div>					
					</div>
				</div>						
			</div>
			<div class="row feature_box">						
				<div class="span4">
					<div class="service">
						<div class="responsive">	
							<img src="shopper/themes/images/feature_img_2.png" alt="" />
							<h4>MODERN <strong>DESIGN</strong></h4>
							<p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>									
						</div>
					</div>
				</div>
				<div class="span4">	
					<div class="service">
						<div class="customize">			
							<img src="shopper/themes/images/feature_img_1.png" alt="" />
							<h4>FREE <strong>SHIPPING</strong></h4>
							<p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>
						</div>
					</div>
				</div>
				<div class="span4">
					<div class="service">
						<div class="support">	
							<img src="shopper/themes/images/feature_img_3.png" alt="" />
							<h4>24/7 LIVE <strong>SUPPORT</strong></h4>
							<p>Lorem Ipsum is simply dummy text of the printing and printing industry unknown printer.</p>
						</div>
					</div>
				</div>	
			</div>		
		</div>				
	</div>
</section>
@endsection