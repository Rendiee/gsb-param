<div class="w-100 text-center h2 text-success fw-bold mb-3">Mon Panier</div>
<div id="produits-commande" class="d-flex flex-wrap justify-content-between p-3 mx-auto<?php if (!isset($lesProduitsDuPanier)) { ?> w-75 bg-white rounded shadow<?php } else { ?> w-100<?php } ?>">

	<?php
	if (isset($lesProduitsDuPanier)) {
	?> <div class="col-lg-8 col-12">
			<?php
			foreach ($lesProduitsDuPanier as $unProduit) {
				// récupération des données d'un produit
				$description = $unProduit['description'];
				$image = "assets/" . $unProduit['photo'];
				$nom = $unProduit['nom'];
				$marque = $unProduit['marque'];
				$id = $unProduit['id'];
				$unite = $unProduit['unite'];
				$contenance = $unProduit['contenance'];
				$prix = $unProduit['prix'];
				$qteMax = $unProduit['quantiteMax'];
				$qte = $unProduit['quantite'];
				
				$description = mb_strimwidth($description, 0, 80, '...');
				// affichage
			?>
				<div class="w-100 height325px border border-gris rounded my-2 py-2 bg-white">
					<form class="h-100" method="POST" action="index.php?uc=gererPanier&action=supprimerUnProduit">
						<div class="d-flex h-100">
							<div class="d-flex align-items-center col-4">
								<img class="w-100 mh-100" src="<?php echo $image ?>" alt="image product">
							</div>
							<div class="d-flex flex-column justify-content-between align-items-center col-8">
								<p class="card-title marque-product"><?php echo $marque ?></p>
								<div class="name-product"><?php echo $nom ?></div>
								<p class="card-text description-product"><?php echo $description ?></p>
								<div class="d-flex flex-column align-items-start">
									<div class="d-flex">
										<div class="text-success fw-bold me-1"><?php echo $prix ?>€</div>
										<div class="ms-1"><?php echo $contenance . ' ' . $unite ?></div>
									</div>
									<div class="small d-flex align-items-center">
										<div class="me-1">Quantite :</div>
										<select class="border border-success rounded p-1 qte" name="quantite" id="<?php echo $id .'|'.$contenance ?>">
											<?php
											if ($qteMax > 10) {
												$qteMax = 10;
											}
											for ($i = 1; $i <= $qteMax; $i++) {
											?>
												<option <?php if ($i == $qte) { ?>selected <?php } ?>value="<?php echo $i ?>"><?php echo $i ?></option>
											<?php
											}
											?>
										</select>
									</div>
								</div>
								<div>
									<a class="text-decoration-none fit me-2" href="index.php?uc=voirProduits&produit=<?php echo $id; ?>&action=voirLeProduit">
										<button type="button" class="btn btn-success">Voir</button>
									</a>
									<button class="btn btn-outline-success" type="submit" name="retirer" value="<?php echo $id . '|' . $unProduit['contenance'] ?>" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">Retirer</button>
								</div>
							</div>
						</div>
					</form>
				</div>
			<?php
			} ?>
		</div>
		<div class="col-lg-4 col-12 my-lg-2">
			<div class="d-flex flex-column justify-content-between p-3 rounded ms-lg-1 sticky rounded height325px bg-white">
				<h2 class="fw-bold mb-4">Total</h2>
				<div class="d-flex justify-content-between">
					<div>Sous-total</div>
					<div><?php echo sprintf("%.02f", $totalPanier) ?> €</div>
				</div>
				<div class="d-flex justify-content-between">
					<div>Livraison</div>
					<div>(Gratuit) 0.00 €</div>
				</div>
				<hr class="w-75 mx-auto">
				<div class="d-flex justify-content-between">
					<div>Total TTC</div>
					<div><?php echo sprintf("%.02f", $totalPanier) ?> €</div>
				</div>
				<div class="d-flex flex-row justify-content-center align-items-center fit mx-auto mt-4">
					<a class="text-decoration-none fit me-2" href="index.php?uc=gererPanier&action=resumerCommande">
						<button type="button" class="btn btn-success">Commander</button>
					</a>
					<a class="ms-2" href="index.php?uc=gererPanier&action=videPanier">
						<button class="btn btn-outline-success" onclick="return confirm('Voulez-vous vraiment vider le panier ?');" type="button">Vider le panier</button>
					</a>
				</div>
			</div>
		</div>
	<?php } else { ?>
		<div class="d-flex flex-column w-100">
			<img class="w-25 mx-auto" src="assets/images/panierVide.png" alt="Panier vide">
			<div class="mx-auto mt-3">Votre panier est vide, remplissez le avec nos produits</div>
			<a class="text-decoration-none fit mx-auto mt-2" href="index.php?uc=voirProduits&action=nosProduits">
				<button type="button" class="btn btn-success">Continuer mes achats</button>
			</a>
		</div>
	<?php
	}
	?>
</div>
<script>
	$("select").on("change", function(){
		id = $(this).attr('id') + '|' + $(this).children(":selected").val();
		location = "index.php?uc=gererPanier&action=voirPanier&produit="+id
	})
</script>