@extends('admin.master')
@section('content')
<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="/admin/index">Trang Chủ</a>
		</li>
		<li class="breadcrumb-item active">Danh Sách Nhập Hàng</li>
	</ol>
	@if(Session::has('message'))
	<div class="alert alert-success">{{Session::get('message')}}</div>
	@endif
	@if(Session::has('error'))
	<div class="alert alert-danger">{{Session::get('error')}}</div>
	@endif
	<div class="row">
		<!-- DataTables Example -->
		<div class="col-xs-12 col-md-12">
			<div class="card mb-3">
				<div class="card-header">
					<i class="fas fa-table"></i>
					Danh Sách Nhập Hàng
					<a class="btn btn-sm btn-primary right" data-toggle="modal" data-target="#modalAddTable" href="#">Thêm Mới</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>#</th>
									<th>Ngày Nhập</th>
									<th>Sản Phẩm</th>
									<th>Số Lượng</th>
									<th>Đơn Giá</th>
									<th>Tổng Tiền</th>
									<th>Thao Tác</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Ngày Nhập</th>
									<th>Sản Phẩm</th>
									<th>Số Lượng</th>
									<th>Đơn Giá</th>
									<th>Tổng Tiền</th>
									<th>Thao Tác</th>
								</tr>
							</tfoot>
							<tbody>
								<?php $i = 0; ?>
								@foreach($receive as $r)
								<tr>
									<td>{{++$i}}</td>
									<td>{{$r->day}}</td>
									<td>{{$r->name}}</td>
									<td>{{$r->unit}}</td>
									<td>{{number_format($r->unit_price)}} VNĐ</td>
									<td>{{number_format($r->total_price)}} VNĐ</td>
									<td>
										<div class="btn-group" role="group">
											<a href="/admin/receive/delete/{{$r->id}}"  onclick="return confirm('Bạn chắc chắn muốn xóa?')" title="Cancel" class="btn btn-xs btn-danger"><i class="fas fa-window-close"></i></a>
										</div>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->

<!-- add product -->
<div class="modal fade" id="modalAddTable" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="/admin/receive/add" method="post" enctype="multipart/form-data">
				{!!csrf_field()!!}
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold">Nhập Hàng</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body mx-3">
					<div class="md-form mb-2">
						<label>Sản Phẩm:</label>
						<input type="text" name="name" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Số Lượng:</label>
						<input type="text" name="unit" id="unit" value="1" min="1" step="1" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Giá Sản Phẩm:</label>
						<input type="number" name="unit_price" id="unit_price" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Tổng Giá:</label>
						<input type="number"  name="total_price" id="total_price" class="form-control validate" readonly ="">
					</div>
					<div class="md-form mb-2">
						<label>Ngày:</label>
						<input type="date" name="day" class="form-control validate" required="">
					</div>
				</div>
				<div class="modal-footer d-flex justify-content-center">
					<input type="submit" name="" value="Xác Nhận" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>

<script>
	$(document).ready(function(){
		$('#unit, #unit_price').change(function(){
			$unit = $('#unit').val();
			$price = $('#unit_price').val();
			$total_price = $unit * $price
			$('#total_price').val($total_price);
		})
	});
</script>
@endsection
