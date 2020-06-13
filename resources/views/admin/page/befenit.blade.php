@extends('admin.master')
@section('content')
<div class="container-fluid">
    <!-- Breadcrumbs-->
    <ol class="breadcrumb">
        <li class="breadcrumb-item">
            <a href="/admin/index">Trang Chủ</a>
        </li>
        <li class="breadcrumb-item active">Xem lãi/lỗ</li>
    </ol>
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-12">
                <div class="card-header">
                    <i class="fas fa-table"></i>
                     Lãi/Lỗ: <span style="color:blue; font-weight: bold">Tháng {{$month}}</span>
                    <div style="float: right;">
                        <form action="/admin/search-befenit" method="get" enctype="multipart/form-data">
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
                    <canvas id="myPieChart" width="100%" height="30"></canvas>
                </div>
                <div class="card-footer small text-muted">
                    {{(float)($o - $r)}} VNĐ
                </div>
            </div>
        </div>
    </div>
</div>
<!-- /.container-fluid -->
@endsection
@section('script')
    <script>
        var r = {!! $r !!};
        var o = {!! $o !!};
        // Set new default font family and font color to mimic Bootstrap's default styling
        Chart.defaults.global.defaultFontFamily = '-apple-system,system-ui,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif';
        Chart.defaults.global.defaultFontColor = '#292b2c';

        // Pie Chart Example
        var ctx = document.getElementById("myPieChart");
        var myPieChart = new Chart(ctx, {
        type: 'pie',
        data: {
            labels: ["Nhập Hàng", "Doanh Thu"],
            datasets: [{
            data: [r, o],
            backgroundColor: ['#007bff', '#dc3545'],
            }],
        },
        });

    </script>
@endsection