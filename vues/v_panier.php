<div class="w-100 text-center h2 text-success fw-bold mb-3">Votre Panier</div>
<div class="d-flex flex-column align-items-center commander rounded fit m-auto col-lg-8 col-12">
	<div id="produits-commande" class="d-flex flex-wrap justify-content-around">
		<?php
		if (isset($lesProduitsDuPanier)) {
			foreach ($lesProduitsDuPanier as $unProduit) {
				// récupération des données d'un produit
				$description = $unProduit['description'];
				$image = "assets/" . $unProduit['photo'];
				$nom = $unProduit['nom'];
				$marque = $unProduit['marque'];
				$id = $unProduit['id'];

				$prix = getMinPriceProduct($id);

				$description = substr($description, 0, 80);
				$description = $description . '...';
				// affichage
		?>
				<!-- <div class="card d-flex flex-column justify-content-between">
					<div class="d-flex flex-column justify-content-center align-items-center">
						<div class="photoCard"><img src="" alt=image /></div>
						<div class="descrCard"></div>
					</div>
					<div class="d-flex flex-wrap justify-content-around align-items-center">
						<div class=""></div>
						<a href="index.php?uc=gererPanier&produit=&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
							<img src="assets/images/retirerpanier.png" TITLE="Retirer du panier" alt="retirer du panier">
						</a>
					</div>
				</div> -->
				<div class="col-xl-4 col-lg-5 col-6">
					<div class="card m-1">
						<p class="card-title marque-product"><?php echo $marque ?></p>
						<div class="name-product title-height"><?php echo $nom ?></div>
						<img class="img-product" src="<?php echo $image ?>" alt="image product">
						<p class="card-text description-product"><?php echo $description ?></p>
						<div class="card-footer d-flex justify-content-between align-items-center">
							<div class="text-success fw-bold"><?php echo $prix[0] ?>€</div>
							<a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
								<button class="btn btn-outline-success" type="button">Retirer</button>
							</a>
						</div>
					</div>
				</div>
		<?php
			}
		} else {
			echo '<div class="alert alert-danger mt-3">' . $message . '</div>';
		}
		?>
	</div>
	<div id="divider" class="w-75 bg-secondary"></div>
	<div class="d-flex flex-row justify-content-center align-items-center my-3 fit">
		<a class="text-decoration-none fit me-2" href="index.php?uc=gererPanier&action=passerCommande">
			<button type="button" class="btn btn-success">Passer la commande</button>
		</a>
		<a class="ms-2" href="index.php?uc=gererPanier&action=videPanier">
			<button class="btn btn-outline-success" onclick="return confirm('Voulez-vous vraiment vider le panier ?');" type="button">Vider le panier</button>
		</a>
	</div>
</div>