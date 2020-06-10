@extends('admin.master')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/admin/index">Trang Chủ</a>
        </li>
        <li class="breadcrumb-item active">Bảng lương</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-12">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                    Bảng lương của nhân viên
                    <div style="float: right;">
                        <form action="/admin/search-salary" method="get" enctype="multipart/form-data">
                            {!!csrf_field()!!}
                            <select name="month">
                                <?php for ($i = 1; $i < 13; $i++)
                                    echo "<option value='" . $i . "'>" . "Tháng " . $i . "</option>";
                                ?>
                            </select>
                            <input type="submit" name="" class="btn btn-sm btn-primary" value="Xem">
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                            <thead>
                                <tr>
                                    <th>STT</th>
                                    <th>Nhân Viên</th>
                                    <th>Tháng</th>
                                    <th>Lương</th>
                                </tr>
                            </thead>
                            <tfoot>
                                <tr>
                                    <th>STT</th>
                                    <th>Nhân Viên</th>
                                    <th>Tháng</th>
                                    <th>Lương</th>
                                </tr>
                            </tfoot>
                            <tbody>
                                <?php $i = 0 ?>
                                @foreach($staff as $st)
                                <tr>
                                    <td>{{++$i}}</td>
                                    <td>{{$st->name}}</td>
                                    <td>{{$month}}/2020</td>
                                    <td>{{number_format($st->salary)}} VNĐ</td>
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