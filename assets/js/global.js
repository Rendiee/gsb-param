function checkStock() {
	$("#stock").remove();
	if ($("select").children(":selected").attr("id") > 0) {
		$("select").parent().parent().parent().append(
			'<div class="d-flex align-items-center justify-content-xl-start justify-content-lg-center justify-content-start text-center col-3 col-lg-4" id="stock"><div class="ms-2">-</div> <small class="ms-2 text-success opacity-75">En Stock</small></div>'
		);
		$("#ajoutPanier").attr("disabled", false);
		$("#nbProduit").attr("disabled", false);
		$("#nbProduit").val("1");
	} else {
		$("select").parent().parent().parent().append(
			'<div class="d-flex align-items-center justify-content-xl-start justify-content-lg-center justify-content-start text-center col-3 col-lg-4" id="stock"><div class="ms-2">-</div> <small id="rupture" class="ms-2 text-danger opacity-75">Rupture de Stock</small></div>'
		);
		$("#ajoutPanier").attr("disabled", true);
		$("#nbProduit").attr("disabled", true);
		$("#nbProduit").val("0");
	}
}

$(function () {
	$("input[name='price-min']").on('input', function () {
		$(this).val($(this).val().replace(/[^0-9]/g, ''));
	});
});

$(function () {
	$("input[name='price-max']").on('input', function () {
		$(this).val($(this).val().replace(/[^0-9]/g, ''));
	});
});

$(document).ready(function () {
	if ($("#list-prix").children(":selected").attr("id") > 0) {
		$("#list-prix").parent().parent().parent().append('<div class="d-flex align-items-center justify-content-xl-start justify-content-lg-center justify-content-start text-center col-3 col-lg-4" id="stock"><div class="ms-2">-</div> <small class="ms-2 text-success opacity-75">En Stock</small></div> ');
	} else {
		$("#list-prix").parent().parent().parent().append('<div class="d-flex align-items-center justify-content-xl-start justify-content-lg-center justify-content-start text-center col-3 col-lg-4" id="stock"><div class="ms-2">-</div> <small class="ms-2 text-danger opacity-75">Rupture de Stock</small></div>');
		$("#ajoutPanier").attr("disabled", true);
		$("#nbProduit").attr("disabled", true);
		$("#nbProduit").val("0");
	}
});