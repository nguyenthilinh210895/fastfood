@extends('master')
@section('content')
<div class="header-title">
	<h3>Lịch Sử Đặt Hàng</h3>
</div>
<!-- .courses -->
<div class="container">
	<div class="row">
		<div class="span12">
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
										<th>Ngày Đăt</th>
										<th>Tổng Tiền</th>
										<th>Thanh toán</th>
										<th>Trạng Thái</th>
										<th>Loại Đơn</th>
										<th>Hóa Đơn</th>
									</tr>
								</thead>
								<tfoot>
									<tr>
										<th>#</th>
										<th>Mã đơn</th>
										<th>Ngày Đăt</th>
										<th>Tổng Tiền</th>
										<th>Thanh toán</th>
										<th>Trạng Thái</th>
										<th>Loại Đơn</th>
										<th>Hóa Đơn</th>
									</tr>
								</tfoot>
								<tbody>
									<?php $i = 0; ?>
									@foreach($order as $o)
									<tr>
										<td>{{++$i}}</td>
										<td>#OD{{$o->id}}</td>
										<td>{{$o->created_at}}</td>
										<td>{{number_format($o->total_price)}} VNĐ</td>
										<td>
											@if($o->status == 0)
											<span class="badge badge-secondary">Chờ thanh toán</span>
											@elseif($o->status == 1)
											<span class="badge badge-primary">Đã Thanh toán</span>
											@endif
										</td>
										<td>
											@if($o->status_staff == 0)
											<span class="badge badge-secondary">Chưa duyệt</span>
											@elseif($o->status == 1)
											<span class="badge badge-primary">Đã Duyệt</span>
											@elseif($o->status == 2)
											<span class="badge badge-danger">Hủy</span>
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
											<div class="btn-group" role="group">
												<a href="/order/view/{{$o->id}}" title="Xem" class="btn btn-xs btn-success"><i class="fas fa-eye"></i></a>
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
</div>
<style type="text/css">
	.badge-primary{
		background-color: #007BFF;
	}
	.badge-danger{
		background-color: #DC3545;	
	}
	.badge-succes{
		background-color: #28A745;	
	}
</style>
@endsection
