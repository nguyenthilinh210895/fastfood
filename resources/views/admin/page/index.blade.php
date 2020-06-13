@extends('admin.master')
@section('content')
<div class="container-fluid">

	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="/admin/index">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Overview</li>
	</ol>

	@include('admin.notification')

	<!-- Area Chart Example-->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-chart-area"></i>
			Doanh Thu Cửa Hàng
			<div style="float: right;">
				<form action="/admin/search-statistical" method="get" enctype="multipart/form-data">
					{!!csrf_field()!!}
					<label>Từ:</label> <input type="date"  value="<?php echo date('Y-m-d', strtotime('-30 days')); ?>" name="start_date">
					<label>Đến:</label> <input type="date"  value="<?php echo date('Y-m-d'); ?>" name="end_date">
					<input type="submit" name="" class="btn btn-sm btn-primary" value="Xem">
				</form>
			</div>
		</div>
		<div class="card-body">
			<canvas id="myAreaChart" width="100%" height="30"></canvas>
		</div>
			<div class="card-footer small text-muted"> <a href="/admin/befenit">Xem Lãi/lỗ cửa hàng >></a></div>
	</div>

	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Doanh số bán hàng của nhân viên
			<div style="float: right;">
				<form action="/admin/search-revenue" method="get" enctype="multipart/form-data">
					{!!csrf_field()!!}
					<select name="month">
						<?php for($i = 1; $i<13; $i++ )
							echo "<option value='". $i . "'>" . "Tháng ". $i . "</option>";
						?>
					</select>
					<input type="submit" name="" class="btn btn-sm btn-primary" value="Xem">
				</form>
			</div>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>STT</th>
							<th>Nhân Viên</th>
							<th>Tháng</th>
							<th>Doanh Số</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>STT</th>
							<th>Nhân Viên</th>
							<th>Tháng</th>
							<th>Doanh Số</th>
						</tr>
					</tfoot>
					<tbody>
						<?php $i = 0 ?>
						@foreach($revenue as $r)
						<tr>
							<td>{{++$i}}</td>
							<td>{{$r->staff->name}}</td>
							<td>{{$month}}/{{$year}}</td>
							<td>{{number_format($r->total)}} VNĐ</td>
						</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
@endsection
@section('script')
<script type="text/javascript">
	var data = {!! $data !!};
	var dateArray = data.map(function (el) { return el.date; });
	var countArray = data.map(function (el) { return el.totalPrice; });

	// Set new default font family and font color to mimic Bootstrap's default styling
	Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
	Chart.defaults.global.defaultFontColor = '#292b2c';

	// Area Chart Example
	var ctx = document.getElementById("myAreaChart");
	var myLineChart = new Chart(ctx, {
		type: 'line',
		data: {
			labels: dateArray,
			datasets: [{
				label: "Tổng",
				lineTension: 0.3,
				backgroundColor: "rgba(2,117,216,0.2)",
				borderColor: "rgba(2,117,216,1)",
				pointRadius: 5,
				pointBackgroundColor: "rgba(2,117,216,1)",
				pointBorderColor: "rgba(255,255,255,0.8)",
				pointHoverRadius: 5,
				pointHoverBackgroundColor: "rgba(2,117,216,1)",
				pointHitRadius: 50,
				pointBorderWidth: 2,
				data: countArray,
			}],
		},
		options: {
			scales: {
				xAxes: [{
					time: {
						unit: 'date'
					},
					gridLines: {
						display: false
					},
					ticks: {
						maxTicksLimit: 30
					}
				}],
				yAxes: [{
					ticks: {
						min: 0,
						max: 2000000,
						maxTicksLimit: 10
					},
					gridLines: {
						color: "rgba(0, 0, 0, .125)",
					}
				}],
			},
			legend: {
				display: false
			}
		}
	});
</script>
@endsection