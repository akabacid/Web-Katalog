$(function () {
    var minPrice = parseInt($("#min_price").val()) || 0;
    var maxPrice = parseInt($("#max_price").val()) || 1000000;

    $("#slider-range").slider({
        range: true,
        min: 0,
        max: maxPrice,
        values: [minPrice, maxPrice],
        step: 1000,
        slide: function (event, ui) {
            $("#amount").val(
                ui.values[0].toLocaleString('id-ID') + " - " + ui.values[1].toLocaleString('id-ID')
            );
            $("#min_price").val(ui.values[0]);
            $("#max_price").val(ui.values[1]);
        }
    });

    var min = $("#slider-range").slider("values", 0);
    var max = $("#slider-range").slider("values", 1);
    $("#amount").val(min.toLocaleString('id-ID') + " - " + max.toLocaleString('id-ID'));
    $("#min_price").val(min);
    $("#max_price").val(max);
});

