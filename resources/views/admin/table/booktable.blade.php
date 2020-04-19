@extends('admin.master')
@section('content')
<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="/admin/index">Trang Chủ</a>
		</li>
		<li class="breadcrumb-item active">Danh Sách Đặt Bàn</li>
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
					Danh Sách Đặt Bàn
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>#</th>
									<th>Khách Hàng</th>
									<th>Email</th>
									<th>Số Điện Thoại</th>
									<th>Bàn</th>
									<th>Ghi Chú</th>
									<th>Ngày</th>
									<th>Trạng Thái</th>
									<th>Thao Tác</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Khách Hàng</th>
									<th>Email</th>
									<th>Số Điện Thoại</th>
									<th>Bàn</th>
									<th>Ghi Chú</th>
									<th>Ngày</th>
									<th>Trạng Thái</th>
									<th>Thao Tác</th>
								</tr>
							</tfoot>
							<tbody>
								<?php $i = 0; ?>
								@foreach($bookTable as $t)
								<tr>
									<td>{{++$i}}</td>
									<td>{{$t->customer->name}}</td>
									<td>{{$t->customer->email}}</td>
									<td>{{$t->customer->phone}}</td>
									<td>{{$t->table->table_name}}</td>
									<td>
										<textarea rows="2" readonly="">{{$t->note}}</textarea>
									</td>
									<td>{{$t->created_at}}</td>
									<td>
										@if($t->status == 0)
										<span class="badge badge-primary">Chưa Duyệt</span>
										@elseif($t->status == 1)
										<span class="badge badge-success">Đã Duyệt</span>
										@else
										<span class="badge badge-danger">Đã Hủy</span>
										@endif
									</td>
									<td>
										<div class="btn-group" role="group">
											<a href="/admin/booktable/accept/{{$t->id}}" title="Duyệt" class="btn btn-xs btn-primary"><i class="fas fa-check"></i></a>
											<a href="/admin/booktable/cancel/{{$t->id}}" title="Cancel" class="btn btn-xs btn-danger"><i class="fas fa-window-close"></i></a>
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