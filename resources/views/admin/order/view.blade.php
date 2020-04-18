@extends('admin.master')
@section('content')
<div class="container-fluid">
	<!-- Breadcrumbs-->
	<ol class="breadcrumb">
		<li class="breadcrumb-item">
			<a href="/index">Trang Chủ</a>
		</li>
		<li class="breadcrumb-item active">Hóa Đơn</li>
	</ol>

	<div id="invoice">
		<div class="toolbar hidden-print">
			<div class="text-right">
				<button id="printInvoice" class="btn btn-info">
					<i class="fa fa-print"></i> Print
				</button>
				@if($order->status == 0 or $order->status == 1)
				<a href="/admin/order/accept/{{$order->id}}" title="Duyệt" onclick="return confirm('Bạn chắc chắn đơn đã hoàn thành?')" class="btn btn-xs btn-primary"><i class="fas fa-check"></i> Hoàn Thành</a>
				<a href="/admin/order/cancel/{{$order->id}}"  onclick="return confirm('Bạn chắc chắn muốn hủy?')" title="Cancel" class="btn btn-xs btn-danger"><i class="fas fa-window-close"></i> Hủy</a>
				@endif
			</div>
			<hr>
		</div>
		<div class="invoice overflow-auto">
			<div style="min-width: 600px">
				<header>
					<div class="row">
						<div class="col">
							<a target="_blank" href="/">
								<img src="shopper/themes/images/logo.png" width="200" height="50" data-holder-rendered="true" />
							</a> 
						</div>
						<div class="col company-details">
							<h2 class="name">
								<a target="_blank" href="#">
									FASTFOOD
								</a>
							</h2>
							<div>Bách Khoa, HN</div>
							<div>(123) 456-789</div>
							<div>fastfood@example.com</div>
						</div>
					</div>
				</header>
				<main>
					<div class="row contacts">
						<div class="col invoice-to">
							<div class="to">Chuyển Tới: {{$order->customer->name}}</div>
							<div class="to">Địa Chỉ: {{$order->customer->address}}</div>
							<div class="address">SĐT: {{$order->customer->phone}}</div>
							<div class="price">
								Tổng tiền (chưa thuế): {{number_format((float)($order->total_price)/1.05)}} VNĐ
							</div>
							<div class="price-vat">
								Tổng tiền (đã bảo gồm thuế VAT): {{number_format($order->total_price)}} VNĐ
							</div>
						</div>
						<div class="col invoice-details">
							<h1 class="invoice-id">Hóa Đơn</h1>
							<div class="date">Mã Hóa Đơn: #OD{{$order->id}}</div>
							<div class="date">Ngày đặt: {{$order->created_at}}</div>
						</div>
					</div>
					<table border="0" cellspacing="0" cellpadding="0">
						<thead>
							<tr>
								<th>STT</th>
								<th class="text-left">Sản Phẩm</th>
								<th class="text-left">Ảnh</th>
								<th class="text-right">Số Lượng</th>
								<th class="text-right">Đơn Giá</th>
							</tr>
						</thead>
						<tbody>
							<?php $i=0 ?>
							@foreach($order_details as $dt)
							<tr>
								<td class="no">{{++$i}}</td>
								<td class="text-left"><h3>{{$dt->product->product_name}}</h3></td>
								<td class="unit"><img src="/img/{{$dt->product->image}}" width="100"></td>
								<td class="qty">{{$dt->quantity}}</td>
								<td class="total">{{number_format($dt->unit_price)}} VNĐ</td>
							</tr>
							@endforeach
						</tbody>
						<tfoot>
							<tr>
								<td colspan="2"></td>
							</tr>
							<tr>
								<td colspan="2"></td>
							</tr>
							<tr>
								<td colspan="2"></td>
							</tr>
							<tr>
								<td colspan="2"></td>
							</tr>
							<tr>
								<td colspan="2"></td>
							</tr>
						</tfoot>
					</table>
				</main>
				<footer>
					Cảm ơn bạn đã mua hàng của chúng tôi.
				</footer>
			</div>
			<!--DO NOT DELETE THIS div. IT is responsible for showing footer always at the bottom-->
			<div></div>
		</div>
	</div>
</div>
<script type="text/javascript">
	$(document).ready(function(){
		$('#printInvoice').click(function(){
			Popup($('.invoice')[0].outerHTML);
			function Popup(data) 
			{
				window.print();
				return true;
			}
		});
	});
</script>
<style type="text/css">
	#invoice{
		padding: 30px;
	}

	.invoice {
		position: relative;
		background-color: #FFF;
		min-height: 680px;
		padding: 15px
	}

	.invoice header {
		padding: 10px 0;
		margin-bottom: 20px;
		border-bottom: 1px solid #3989c6
	}

	.invoice .company-details {
		text-align: right
	}

	.invoice .company-details .name {
		margin-top: 0;
		margin-bottom: 0
	}

	.invoice .contacts {
		margin-bottom: 20px
	}

	.invoice .invoice-to {
		text-align: left
	}

	.invoice .invoice-to .to {
		margin-top: 0;
		margin-bottom: 0
	}

	.invoice .invoice-details {
		text-align: right
	}

	.invoice .invoice-details .invoice-id {
		margin-top: 0;
		color: #3989c6
	}

	.invoice main {
		padding-bottom: 50px
	}

	.invoice main .thanks {
		margin-top: -100px;
		font-size: 2em;
		margin-bottom: 50px
	}

	.invoice main .notices {
		padding-left: 6px;
		border-left: 6px solid #3989c6
	}

	.invoice main .notices .notice {
		font-size: 1.2em
	}

	.invoice table {
		width: 100%;
		border-collapse: collapse;
		border-spacing: 0;
		margin-bottom: 20px
	}

	.invoice table td,.invoice table th {
		padding: 15px;
		background: #eee;
		border-bottom: 1px solid #fff
	}

	.invoice table th {
		white-space: nowrap;
		font-weight: 400;
		font-size: 16px
	}

	.invoice table td h3 {
		margin: 0;
		font-weight: 400;
		color: #3989c6;
		font-size: 1.2em
	}

	.invoice table .qty,.invoice table .total,.invoice table .unit {
		text-align: right;
		font-size: 1.2em
	}

	.invoice table .no {
		color: #fff;
		font-size: 1.6em;
		background: #3989c6
	}

	.invoice table .unit {
		background: #ddd
	}

	.invoice table .total {
		background: #3989c6;
		color: #fff
	}

	.invoice table tbody tr:last-child td {
		border: none
	}

	.invoice table tfoot td {
		background: 0 0;
		border-bottom: none;
		white-space: nowrap;
		text-align: right;
		padding: 10px 20px;
		font-size: 1.2em;
		border-top: 1px solid #aaa
	}

	.invoice table tfoot tr:first-child td {
		border-top: none
	}

	.invoice table tfoot tr:last-child td {
		color: #3989c6;
		font-size: 1.4em;
		border-top: 1px solid #3989c6
	}

	.invoice table tfoot tr td:first-child {
		border: none
	}

	.invoice footer {
		width: 100%;
		text-align: center;
		color: #777;
		border-top: 1px solid #aaa;
		padding: 8px 0
	}

	.price-vat{
		font-weight: bold;
		color: red;
	}

	@media print {
		body * {
			visibility: hidden;
			height:0;
		}
		.invoice * {
			visibility: visible;
			height:auto;
		}
		.invoice {
			position: absolute;
			left: 0;
			top: 0;
		}
		.invoice {
			font-size: 11px!important;
			overflow: hidden!important
		}

		.invoice footer {
			position: absolute;
			bottom: 10px;
			page-break-after: always
		}

		.invoice>div:last-child {
			page-break-before: always
		}
	}
</style>
<!-- /.container-fluid -->
@endsection