@extends('admin.master')
@section('content')
<div class="container-fluid">

	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="/admin/index">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Danh Sách Nhân Viên</li>
	</ol>
	<div class="msg">
		@if(Session::has('message'))
		<div class="alert alert-success">{{Session::get('message')}}</div>
		@endif
	</div>
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Danh Sách Nhân Viên
			<a href="/admin/staff/add" class="btn btn-primary right">Thêm Nhân Viên</a>
		</div>
		<div class="card-body">
			<div class="table-responsive">
				<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
					<thead>
						<tr>
							<th>STT</th>
							<th>Họ Tên</th>
							<th>Số Điện Thoại</th>
							<th>Email</th>
							<th>Địa Chỉ</th>
							<th>Lương</th>
							<th>Quyền</th>
							<th>Action</th>
						</tr>
					</thead>
					<tfoot>
						<tr>
							<th>STT</th>
							<th>Họ Tên</th>
							<th>Số Điện Thoại</th>
							<th>Email</th>
							<th>Địa Chỉ</th>
							<th>Lương</th>
							<th>Quyền</th>
							<th>Action</th>
						</tr>
					</tfoot>
					<tbody>
						<?php $i=0; ?>
						@foreach($staff as $st)
						<tr>
							<td>{{++$i}}</td>
							<td>{{$st->name}}</td>
							<td>{{$st->phone}}</td>
							<td>{{$st->email}}</td>
							<td>{{$st->address}}</td>
							<td>{{number_format($st->salary)}} VNĐ</td>
							<td>
								@if($st->role == 1)
								<span class="badge badge-danger">Admin</span>
								@else
								<span class="badge badge-primary">Nhân Viên</span>
								@endif
							</td>
							<td>
								<div class="btn-group">
									<a class="btn btn-primary" href="/admin/staff/edit/{{$st->id}}" title="Edit Nhân Viên">
										<i class="fas fa-edit"></i>
									</a>
									<a href="/admin/staff/delete/{{$st->id}}" class="btn btn-danger" onclick="return confirm('Bạn chắc chắn muốn xóa?')" title="Xóa Nhân Viên">
										<i class="fas fa-trash-alt"></i>
									</a>
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
<!-- /.container-fluid -->
@endsection