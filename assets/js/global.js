function checkStock() {
	$("#stock").remove();
	if ($("select").children(":selected").attr("id") > 0) {
		var qte = $("#list-contenance").children(":selected").attr("id")
		$("#prix").append('<small id="stock" class="text-success pt-2 opacity-75"> - En Stock ('+qte+')</small></div>');
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
	$("input[name='price-min']").on("input", function () {
		$(this).val(
			$(this)
				.val()
				.replace(/[^0-9]/g, "")
		);
	});
});

$(function () {
	$("input[name='price-max']").on("input", function () {
		$(this).val(
			$(this)
				.val()
				.replace(/[^0-9]/g, "")
		);
	});
});

$(function () {
	$("#formFiltrer").on("submit", function (event) {
		$("#noFiltre").remove();
		if (
			$("input[name='price-min']").val() == "" &&
			$("input[name='price-max']").val() == "" &&
			$("select[name='list-marque']").val() == "default"
		) {
			$("#formFiltrer").append(
				'<div id="noFiltre" class="text-danger text-center small mt-1 shakeDiv">Veuillez saisir un filtre</div>'
			);
			event.preventDefault();
			$("#noFiltre").delay(4000).slideUp("fast");
		}
	});
});

$(function () {
	$(".qte").on("change", function () {
		if (parseInt($(this).val()) > 10) {
			$(this).val(10);
		} else if (parseInt($(this).val()) < 1) {
			$(this).val(1);
		}
	});
});


$(function() {
	$(".divVoirProduit").on("mouseenter", function() {
		$(this).children().addClass(
			"opacity-50 user-select-none"
		).css("cursor", "pointer");
		$(this).css("cursor", "pointer");
		$(this).append('<div id="voir">Voir</div>');
		$("#voir").css({
			"position": "absolute",
			"margin-left": "auto",
			"margin-right": "auto",
			"left": "0",
			"right": "0",
			"text-align": "center",
			"font-size": "1.5rem",
			"border": "1px solid black",
			"cursor": "pointer"

		});
		$("#voir").addClass(
			"rounded fit px-3 py-1 bg-light"
		);
	});
	$(".divVoirProduit").on("mouseleave", function() {
		$(this).children().removeClass(
			"opacity-50 user-select-none"
		);
		$("#voir").remove();
	});
});