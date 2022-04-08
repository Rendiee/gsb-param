function checkStock() {
	$("#stock").remove();
	if ($("select").children(":selected").attr("id") > 0) {
		$("#prix").append(
			'<small id="stock" class="text-success pt-2 opacity-75"> - En Stock</small></div>'
		);
		$("#ajoutPanier").attr("disabled", false);
		$("#nbProduit").attr("disabled", false);
		$("#nbProduit").val("1");
	} else {
		$("#prix").append(
			'<small id="stock" id="rupture" class="text-danger pt-2 opacity-75"> - Rupture de Stock</small></div>'
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
		$("#prix").append('<small id="stock" class="text-success pt-2 opacity-75"> - En Stock</small>');
	} else {
		$("#prix").append('<small id="stock" class="text-danger pt-2 opacity-75"> - Rupture de Stock</small>');
		$("#ajoutPanier").attr("disabled", true);
		$("#nbProduit").attr("disabled", true);
		$("#nbProduit").val("0");
	}
});

$(function () {
	$("#formFiltrer").on('submit', function (event) {
		$("#noFiltre").remove();
		if(($("input[name='price-min']").val() == '' && $("input[name='price-max']").val() == '' && $("select[name='list-marque']").val() == 'default')){
			$("#formFiltrer").append('<div id="noFiltre" class="text-danger text-center small">Veuillez saisir un filtre</div>');
			event.preventDefault();
		}
	});
});