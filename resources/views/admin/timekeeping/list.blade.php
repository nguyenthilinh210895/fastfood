@extends('admin.master')
@section('content')
<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="/admin/index">Trang Chủ</a>
		</li>
		<li class="breadcrumb-item active">Nghỉ Phép - Làm Bù</li>
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
					Danh Sách Nghỉ Phép - Làm Bù
					<a class="btn btn-sm btn-success right" href="/admin/salary-staff">Xem bảng lương</a> 
					<a class="btn btn-sm btn-primary right" data-toggle="modal" data-target="#modalAddTable" href="#">Thêm Mới</a> &nbsp;
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>#</th>
									<th>Ngày</th>
									<th>Nhân Viên Nghỉ</th>
									<th>Nhân Viên Làm Thay</th>
									<th>Thao Tác</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Ngày</th>
									<th>Nhân Viên Nghỉ</th>
									<th>Nhân Viên Làm Thay</th>
									<th>Thao Tác</th>
								</tr>
							</tfoot>
							<tbody>
								<?php $i = 0; ?>
								@foreach($time as $r)
								<tr>
									<td>{{++$i}}</td>
									<td>{{$r->date}}</td>
									<td>{{$r->staff_absent->name}}</td>
									<td>{{$r->staff_replace->name}}</td>
									<td>
										<div class="btn-group" role="group">
											<a href="/admin/timekeeping/delete/{{$r->id}}"  onclick="return confirm('Bạn chắc chắn muốn xóa?')" title="Cancel" class="btn btn-xs btn-danger"><i class="fas fa-window-close"></i></a>
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
			<form action="/admin/timekeeping/add" method="post" enctype="multipart/form-data">
				{!!csrf_field()!!}
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold">Thêm Mới</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body mx-3">
					<div class="md-form mb-2">
						<label>Ngày:</label>
						<input type="date" name="date" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Nhân Viên Nghỉ:</label>
						<select class="form-control" name="staff_absent">
							@foreach($staff as $st)
							<option value="{{$st->id}}">{{$st->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="md-form mb-2">
						<label>Nhân Viên Làm Thay:</label>
						<select class="form-control" name="staff_replace">
							@foreach($staff as $st)
							<option value="{{$st->id}}">{{$st->name}}</option>
							@endforeach
						</select>
					</div>
				</div>
				<div class="modal-footer d-flex justify-content-center">
					<input type="submit" name="" value="Xác Nhận" class="btn btn-primary">
				</div>
			</form>
		</div>
	</div>
</div>
@endsection
