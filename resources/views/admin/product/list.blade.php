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
		<div class="col-xs-12 col-md-8">
			<div class="card mb-3">
				<div class="card-header">
					<i class="fas fa-table"></i>
					Danh Sách Category
					<a class="btn btn-sm btn-primary right" data-toggle="modal" data-target="#modalAddCategory" href="#" >Thêm Mới</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>#</th>
									<th>Tên</th>
									<th>Loại</th>
									<th>Thao Tác</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Tên</th>
									<th>Loại</th>
									<th>Thao Tác</th>
								</tr>
							</tfoot>
							<tbody>
								<?php $i = 0; ?>
								@foreach($category as $c)
								<tr>
									<td>{{++$i}}</td>
									<td>{{$c->name}}</td>
									<td>{{$c->type}}</td>
									<td>
										<div class="btn-group" role="group">
											<a href="admin/category/delete/{{$c->id}}" title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-xs btn-danger"> 
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
		<!-- DataTables Example -->
		<div class="col-xs-12 col-md-12">
			<div class="card mb-3">
				<div class="card-header">
					<i class="fas fa-table"></i>
					Danh Sách Sản Phẩm
					<a class="btn btn-sm btn-primary right" data-toggle="modal" data-target="#modalAddProduct" href="#">Thêm Mới</a>
				</div>
				<div class="card-body">
					<div class="table-responsive">
						<table class="table table-bordered" id="dataTable2" width="100%" cellspacing="0">
							<thead>
								<tr>
									<th>#</th>
									<th>Tên</th>
									<th>Ảnh</th>
									<th>Giá Sản Phẩm</th>
									<th>Giá KM</th>
									<th>Số Lượng</th>
									<th>Mô tả</th>
									<th>Loại Sản Phẩm</th>
									<th>Thao Tác</th>
								</tr>
							</thead>
							<tfoot>
								<tr>
									<th>#</th>
									<th>Tên</th>
									<th>Ảnh</th>
									<th>Giá Sản Phẩm</th>
									<th>Giá KM</th>
									<th>Số Lượng</th>
									<th>Mô tả</th>
									<th>Loại Sản Phẩm</th>
									<th>Thao Tác</th>
								</tr>
							</tfoot>
							<tbody>
								<?php $i = 0; ?>
								@foreach($product as $p)
								<tr>
									<td>{{++$i}}</td>
									<td>{{$p->product_name}}</td>
									<td><a href="img/{{$p->image}}"><img src="img/{{$p->image}}" width="50" height="50"></a></td>
									<td>{{number_format($p->unit_price)}}</td>
									<td>{{number_format($p->promotion_price)}}</td>
									<td>{{$p->unit}}</td>
									<td><textarea class="form-control" rows="3">{{$p->description}}</textarea></td>
									<td>{{$p->category->name}}</td>
									<td>
										<div class="btn-group" role="group">
											<a href="/admin/product/delete/{{$p->id}}" title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-xs btn-danger"><i class="fas fa-trash-alt"></i></a>
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

<!-- add category -->
<div class="modal fade" id="modalAddCategory" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="admin/category/add" method="post" enctype="multipart/form-data">
				{!!csrf_field()!!}
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold">Thêm Loại Hàng</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body mx-3">
					<div class="md-form mb-2">
						<label>Tên Loại:</label>
						<input type="text" id="defaultForm-email" name="name" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Loại Hàng:</label>
						<select class="form-control" name="type">
							<option value="Đồ Ăn">Đồ Ăn</option>
							<option value="Đồ Uống">Đồ Uống</option>
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

<!-- add product -->
<div class="modal fade" id="modalAddProduct" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<form action="/admin/product/add" method="post" enctype="multipart/form-data">
				{!!csrf_field()!!}
				<div class="modal-header text-center">
					<h4 class="modal-title w-100 font-weight-bold">Thêm Sản Phẩm</h4>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body mx-3">
					<div class="md-form mb-2">
						<label>Loại Sản phẩm:</label>
						<select name="id_category" class="form-control validate">
							@foreach($category as $c)
							<option value="{{$c->id}}">{{$c->name}}</option>
							@endforeach
						</select>
					</div>
					<div class="md-form mb-2">
						<label>Sản Phẩm:</label>
						<input type="text" name="product_name" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Ảnh:</label><br>
						<input type="file" id="defaultForm-pass" name="image" placeholder="Chọn Ảnh" class="validate" required="">
					</div>
					
					<div class="md-form mb-2">
						<label>Giá Sản Phẩm:</label>
						<input type="number" name="unit_price" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Giá KM (nếu có):</label>
						<input type="number" name="promotion_price" class="form-control validate">
					</div>
					<div class="md-form mb-2">
						<label>Số Lượng:</label>
						<input type="text" name="unit" class="form-control validate" required="">
					</div>
					<div class="md-form mb-2">
						<label>Mô tả:</label>
						<textarea class="form-control" rows="3" name="description"></textarea>
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