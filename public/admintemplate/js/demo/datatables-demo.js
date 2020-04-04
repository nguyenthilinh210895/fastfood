// Call the dataTables jQuery plugin
$(document).ready(function() {
	$('#dataTable, #dataTable1, #dataTable2, #dataTable3, #dataTable4, #dataTable5').DataTable({
        responsive: true,
        "order": [
        [0, "asc"]
        ],
        "language": {
            "decimal": "-",
            "thousands": ".",
            "search": "Tìm kiếm:",
            "info": "",
            "lengthMenu": "Xem _MENU_ Hàng",
            "zeroRecords": "Không tồn tại",
            "infoEmpty": "",
            "infoFiltered": "",
            "paginate": {
                "first": "Đầu ",
                "last": "Cuối",
                "next": "Tiếp",
                "previous": "Trước"
            },
        }
    });
});
