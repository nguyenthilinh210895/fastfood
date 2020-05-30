function addToCard(param){
    var productId = param;
    $.ajax({
        url: "/ajax/add-to-card",
        method: "GET",
        data: { 'productId': productId },
        success: function(data) {
            $("#cartSession").css("display", "none");
            $("#cartSession").html(data);
            $("#cartSession").fadeIn(500);
            console.log('get full list success');
        }
    });

}