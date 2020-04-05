<section class="navbar main-menu">
	<div class="navbar-inner main-menu">				
		<a href="/" class="logo pull-left">
			<img src="shopper/themes/images/logo.png" style="height: 40px;" class="site_logo" alt="">
		</a>
		<nav id="menu" class="pull-right">
			<ul>
				<li><a href="/">Trang Chủ</a></li>	
				<li><a href="/introduce">Giới thiệu</a></li>			
				<li><a>Loại đồ uống</a>
					<ul>
						@foreach($drink as $d)									
						<li><a href="./products.html">{{$d->name}}</a></li>
						@endforeach
					</ul>
				</li>	
				<li><a>Loại Thức Ăn</a>
					<ul>									
						@foreach($food as $f)									
						<li><a href="./products.html">{{$f->name}}</a></li>
						@endforeach
					</ul>
				</li>
				<li><a href="./products.html">Khuyến mãi</a></li>
			</ul>
		</nav>
	</div>
</section>