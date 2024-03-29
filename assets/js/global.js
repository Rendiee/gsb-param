//filtre on submit
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

//Check si il y a du stock du produit dans la vue voirLeProduit
function checkStock() {
	$("#stock").remove();
	if ($("select").children(":selected").attr("id") > 0) {
		var qte = $("#list-contenance").children(":selected").attr("id");
		$("#prix").append('<small id="stock" class="text-success pt-2 opacity-75"> - En Stock </small>');
		if ($("select").children(":selected").attr("id") > 10) {
			$("#stock").append('(' + qte + ')');
		}else{
			$("#stock").append('<small class="text-danger">(plus que ' + qte + ')</small>');			
		}
		$("#ajoutPanier").attr("disabled", false);
	} else {
		$("#prix").append('<small id="stock" id="rupture" class="text-danger pt-2 opacity-75"> - Rupture de Stock</small>');
		$("#ajoutPanier").attr("disabled", true);
		$("#nbProduit").remove();
	}
}

//Check la quantite du produit dans la vue voirLeProduit
function checkQte(item) {
	if ($("select").children(":selected").attr("value") == item["volume"] && item["quantite"] > 0) {
		unQte = item["quantite"];
		$("#nbProduit").remove();
		$("#ajoutPanier").before(
			'<select class="form-select border-success fit rounded-0 rounded-start" name="quantite" id="nbProduit">'
		);
		if (unQte > 10) unQte = 10;
		for (i = 1; i <= unQte; i++) {
			$("#nbProduit").append('<option id="' + i + '" value="' + i + '">' + i + "</option>");
		}
	}
}

//Check le prix du produit dans la vue voirLeProduit
function checkPrix(item) {
	if ($("select").children(":selected").attr("value") == item["volume"]) {
		unPrix = item["prix"];
		$("#prix span").remove();
		$("#prix").prepend('<span class="text-success fw-bold opacity-75" value="' + unPrix + '">' + unPrix + "€");
	}
}
