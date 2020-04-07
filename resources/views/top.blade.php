<div id="top-bar" class="container">
	<div class="row">
		<div class="span4">
			<form method="POST" class="search_form">
				<input type="text" class="input-block-level search-query" Placeholder="eg. Gà Quay...">
			</form>
		</div>
		<div class="span8">
			<div class="account pull-right">
				<ul class="user-menu">		
					<li><a href="cart.html">Your Cart</a></li>
					@if(Auth::user())	
					<li>Xin chào: <a href="#">{{Auth::user()->name}}</a></li>			
					<li><a href="/logout">Đăng Xuất</a></li>
					@else
					<li><a href="/login">Đăng Nhập</a></li>
					@endif
				</ul>
			</div>
		</div>
	</div>
</div>