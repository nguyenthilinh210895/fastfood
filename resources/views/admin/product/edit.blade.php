@extends('admin.master')
@section('content')
<div class="container-fluid">

	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="#">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Sửa sản phẩm</li>
	</ol>
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Sửa sản phẩm
		</div>
		<div class="msg">
			@if(count($errors)>0)
			<div class="alert alert-danger">
				@foreach($errors->all() as $err)
				{{$err}}<br>
				@endforeach
			</div>
			@endif
			@if(Session::has('error'))
			<div class="alert alert-error">{{Session::get('error')}}</div>
			@endif
			@if(Session::has('message'))
			<div class="alert alert-success">{{Session::get('message')}}</div>
			@endif
		</div>
		<div class="row card-body">
			<div class="col-md-6">
				<form action="/admin/product/edit/{{$product->id}}" method="post" enctype="multipart/form-data">
					{!!csrf_field()!!}
					<div class="form-group">
						<label>Loại Sản phẩm:</label>
						<select name="id_category" class="form-control validate">
							@foreach($category as $c)
							@if($c->id == $product->id )
							<option value="{{$c->id}}" selected>{{$c->name}}</option>
							@else
							<option value="{{$c->id}}">{{$c->name}}</option>
							@endif
							@endforeach
						</select>
					</div>
					<div class="form-group">
						<label>Sản Phẩm:</label>
						<input type="text" value="{{$product->product_name}}" name="product_name" class="form-control validate" required="">
					</div>
					<div class="form-group">
						<label>Ảnh:</label><br>
						<input type="file" id="defaultForm-pass" name="image" placeholder="Chọn Ảnh" class="validate" required="">
					</div>
					<div class="form-group">
						<label>Giá Sản Phẩm:</label>
						<input type="number" value="{{$product->unit_price}}" name="unit_price" class="form-control validate" required="">
					</div>
					<div class="form-group">
						<label>Giá KM (nếu có):</label>
						<input type="number" value="{{$product->promotion_price}}" name="promotion_price" class="form-control validate">
					</div>
					<div class="form-group">
						<label>Số Lượng:</label>
						<input type="text" name="unit" value="{{$product->unit}}" class="form-control validate" required="">
					</div>
					<div class="form-group">
						<label>Mô tả:</label>
						<textarea class="form-control" rows="3" name="description">{{$product->description}}</textarea>
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update</button>
						<button type="reset" class="btn btn-danger">Đặt Lại</button>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
@endsection