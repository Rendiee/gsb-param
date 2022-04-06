function checkStock() {
	$("#enStock").remove();
	$("#rupture").remove();
	$("#minus").remove();
	if ($("select").children(":selected").attr("id") > 0) {
		$("select").after(
			' <div id="minus">-</div> <small id="enStock" class="ms-2 text-success opacity-75">En Stock</small>'
		);
		$("#ajoutPanier").attr("disabled", false);
	} else {
		$("select").after(
			' <div id="minus">-</div> <small id="rupture" class="ms-2 text-danger opacity-75">Rupture de Stock</small>'
		);
		$("#ajoutPanier").attr("disabled", true);
	}
}
