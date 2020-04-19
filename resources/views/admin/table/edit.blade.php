@extends('admin.master')
@section('content')
<div class="container-fluid">

	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="/admin/index">Dashboard</a>
		</li>
		<li class="breadcrumb-item active">Sửa Bàn</li>
	</ol>
	<!-- DataTables Example -->
	<div class="card mb-3">
		<div class="card-header">
			<i class="fas fa-table"></i>
			Sửa Bàn
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
				<form action="/admin/table/edit/{{$table->id}}" method="post" enctype="multipart/form-data">
					{!!csrf_field()!!}
					<div class="form-group">
						<label>Tên</label>
						<input type="text" name="table_name" value="{{$table->table_name}}" class="form-control" required="">
					</div>
					<div class="form-group">
						<label>Mã</label>
						<input type="text" value="{{$table->code}}" required="" name="code" class="form-control">
					</div>
					<div class="form-group">
						<button type="submit" class="btn btn-primary">Update</button>
						<a href="admin/table/delete/{{$table->id}}" title="Xóa" onclick="return confirm('Bạn chắc chắn muốn xóa?')" class="btn btn-xs btn-danger"> 
							<i class="fas fa-trash-alt"></i>
						</a>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>
<!-- /.container-fluid -->
@endsection