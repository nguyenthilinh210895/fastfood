@extends('admin.master')
@section('content')
<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="/index">Trang Chủ</a>
		</li>
		<li class="breadcrumb-item active">Sản Phẩm</li>
	</ol>
	@if(count($errors)>0)
	<div class="alert alert-danger">
		@foreach($errors->all() as $err)
		{{$err}}<br>
		@endforeach
	</div>
	@endif
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
					Danh Sách Đơn
					<!-- <a class="btn btn-sm btn-primary right" data-toggle="modal" data-target="#modalAddTable" href="#">Thêm Mới</a> -->
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>#</th>
									<th>Mã đơn</th>
									<th>Khách Hàng</th>
									<th>Tổng Tiền</th>
									<th>Trạng Thái</th>
									<th>Loại Đơn</th>
									<th>Địa Chỉ</th>
									<th>Thao Tác</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Mã đơn</th>
									<th>Khách Hàng</th>
									<th>Tổng Tiền</th>
									<th>Trạng Thái</th>
									<th>Loại Đơn</th>
									<th>Địa Chỉ</th>
									<th>Thao Tác</th>
								</tr>
							</tfoot>
							<tbody>
								<?php $i = 0; ?>
								@foreach($order as $o)
								<tr>
									<td>{{++$i}}</td>
									<td>#OD{{$o->id}}</td>
									<td>{{$o->customer->name}}</td>
									<td>{{number_format($o->total_price)}} VNĐ</td>
									<td>
										@if($o->status == 0)
										<span class="badge badge-secondary">Chờ thanh toán</span>
										@elseif($o->status == 1)
										<span class="badge badge-primary">Đã Thanh toán</span>
										@elseif($o->status == 2)
										<span class="badge badge-danger">Hủy</span>
										@else
										<span class="badge badge-success">Hoàn Tất</span>
										@endif
									</td>
									<td>
										@if($o->type_order == 1)
										<span class="badge badge-danger">Online</span>
										@else
										<span class="badge badge-success">Offline</span>
										@endif
									</td>
									<td>
										@if($o->table)
										Bàn: {{$o->table->table_name}}
										@else
										{{$o->customer->address}}
										@endif
									</td>
									<td>
										<div class="btn-group" role="group">
											<a href="/admin/order/view/{{$o->id}}" title="Xem" class="btn btn-xs btn-success"><i class="fas fa-eye"></i></a>
											@if($o->status == 0 or $o->status == 1)
											<a href="/admin/order/accept/{{$o->id}}" title="Duyệt" onclick="return confirm('Bạn chắc chắn đơn đã hoàn thành?')" class="btn btn-xs btn-primary"><i class="fas fa-check"></i></a>
											<a href="/admin/order/cancel/{{$o->id}}"  onclick="return confirm('Bạn chắc chắn muốn hủy?')" title="Cancel" class="btn btn-xs btn-danger"><i class="fas fa-window-close"></i></a>
											@endif
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
@endsection