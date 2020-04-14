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
					Danh Sách Bàn
					<a class="btn btn-sm btn-primary right" data-toggle="modal" data-target="#modalAddTable" href="#">Thêm Mới</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>#</th>
									<th>Tên</th>
									<th>Mã</th>
									<th>Trạng Thái</th>
									<th>Thao Tác</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Tên</th>
									<th>Mã</th>
									<th>Trạng Thái</th>
									<th>Thao Tác</th>
								</tr>
							</tfoot>
							<tbody>
								<?php $i = 0; ?>
								@foreach($table as $t)
								<tr>
									<td>{{++$i}}</td>
									<td>{{$t->table_name}}</td>
									<td>
										<img src="data:image/png;base64, {!! base64_encode(QrCode::format('png')->size(100)->generate($t->code)) !!} ">
									</td>
									<td>
										@if($t->status == 0)
										<span class="badge badge-primary">Còn trống</span>
										@else
										<span class="badge badge-danger">Đã Đặt</span>
										@endif
									</td>
									<td>
										<div class="btn-group" role="group">
											<a href="/admin/table/edit/{{$t->id}}" title="Sửa" class="btn btn-xs btn-danger"><i class="fas fa-edit"></i></a>
											<a href="/admin/table/on/{{$t->id}}" title="Book" class="btn btn-xs btn-primary"><i class="fas fa-check"></i></a>
											<a href="/admin/table/off/{{$t->id}}" title="Cancel" class="btn btn-xs btn-success"><i class="fas fa-window-close"></i></a>
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
			<form action="/admin/table/add" method="post" enctype="multipart/form-data">
				{!!csrf_field()!!}
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold">Thêm bàn</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body mx-3">
					<div class="md-form mb-2">
						<label>Tên:</label>
						<input type="text" name="table_name" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Mã:</label>
						<input type="text" name="code" class="form-control validate" required="">
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