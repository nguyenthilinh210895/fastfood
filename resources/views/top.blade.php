<div id="top-bar" class="container">
	<div class="row">
		<div class="span4">
			<form method="GET" action="/search-product" class="search_form">
				{!!csrf_field()!!}
				<input type="text" name="key" class="input-block-level search-query" Placeholder="eg. Gà Quay...">
			</form>
		</div>
		<div class="span8">
			<div class="account pull-right">
				<ul class="user-menu">		
					<li class="dropdown">
						@if(Session::has('cart'))
						<a href="" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Giỏ hàng <span class="badge">{{$totalQty}}</span> <span class="caret"></span></a>
						<ul class="dropdown-menu" role="menu">
							@foreach($product_cart as $product)
							<li style="width: 250px">
								<div class="item">
									<div class="item-left">
										<div style="float: left;">
											<img src="img/{{$product['item']['image']}}" alt="" width="50" />
										</div>
										
										<div class="item-info" style="float: left; padding-left: 10px;">
											<b>{{$product['item']['product_name']}}</b>
											<p>{{$product['qty']}} * @if($product['item']['promotion_price']!=0)
												{{number_format($product['item']['promotion_price'])}} VNĐ
												@else
												{{number_format($product['item']['unit_price'])}} VNĐ
											@endif</p>
										</div>
										<div style="float: right;"><a href="{{route('delete-cart', $product['item']['id'])}}" class="btn btn-xs btn-danger pull-right">x</a></div>
									</div>
								</div>
							</li>
							<hr>
							@endforeach
							<div>
								<p style="margin-left: 10px;"> Tổng Tiền: {{number_format($totalPrice)}} VNĐ <a href="/cart" class="btn btn-primary">Xem giỏ hàng</a></p>
							</div>
						</ul>
						@endif
					</li>	
					@if(Auth::user())	
					<li>Xin chào: <a href="#">{{Auth::user()->name}}</a></li>			
					<li><a href="/logout">Đăng Xuất</a></li>
					@else
					<li><a href="/login">Đăng Nhập</a></li>
					<li><a href="/login">Đăng Ký</a></li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>