<nav class="navbar navbar-expand navbar-dark bg-dark static-top">

	<a class="navbar-brand mr-1" href="/admin/index">FasterFood</a>

	<button class="btn btn-link btn-sm text-white order-1 order-sm-0" id="sidebarToggle" href="#">
		<i class="fas fa-bars"></i>
	</button>

	<!-- Navbar Search -->
	<form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
		<div class="input-group">
			<!-- <input type="text" class="form-control" placeholder="Search for..." aria-label="Search" aria-describedby="basic-addon2">
			<div class="input-group-append">
				<button class="btn btn-primary" type="button">
					<i class="fas fa-search"></i>
				</button>
			</div> -->
		</div>
	</form>

	<!-- Navbar -->
	<ul class="navbar-nav ml-auto ml-md-0">
		<li class="nav-item dropdown no-arrow mx-1">
			<a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				<i class="fas fa-bell fa-fw"></i>
				<span class="badge badge-danger" id="countOrder" style="margin-left: -0.25rem"></span>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="alertsDropdown">
				<a class="dropdown-item" href="/admin/order-review/list" id="linkOrderReview">Có đơn hàng mới</a>
			</div>
		</li>
		
		<li class="nav-item dropdown no-arrow">
			<a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
				Xin chào: {{Auth::user()->name}} <i class="fas fa-user-circle fa-fw"></i>
			</a>
			<div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
				<a class="dropdown-item" href="/admin/info">Thông tin cá nhân</a>
				<div class="dropdown-divider"></div>
				<a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">Đăng Xuất</a>
			</div>
		</li>
	</ul>

</nav>

<script>
$('document').ready(function () {
 setInterval(function () {getCountOrder()}, 1000);//request every x seconds

 }); 

function getCountOrder() {
	$.ajax({
			url: "/admin/getCountOrder",
			type: "GET",
			data: {
			},
			cache: false,
			success: function (data) {
				$("#countOrder").html(data.countOrder);
				if(data.countOrder == 0){
					$('#linkOrderReview').hide();
				}
				else{
					$('#linkOrderReview').show();
				}
			}
		})
	}
</script>