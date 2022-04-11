<div class="w-100 text-center h2 text-success fw-bold mb-3">Votre Panier</div>
<div class="d-flex flex-column align-items-center commander rounded m-auto col-lg-8 col-12">
	<div id="produits-commande" class="d-flex flex-wrap justify-content-left p-3 w-100">
		<?php
		if (isset($lesProduitsDuPanier)) {
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
				$qte = $unProduit['quantite'];

				$description = substr($description, 0, 80);
				$description = $description . '...';
				// affichage
		?>
				<div class="col-xxl-4 col-xl-5 col-lg-6 col-md-5 col-6">
					<form method="POST" action="index.php?uc=gererPanier&action=supprimerUnProduit">
						<div class="card m-1">
							<p class="card-title marque-product"><?php echo $marque ?></p>
							<div class="name-product title-height"><?php echo $nom ?></div>
							<img class="img-product" src="<?php echo $image ?>" alt="image product">
							<p class="card-text description-product"><?php echo $description ?></p>
							<div class="card-footer d-flex justify-content-between align-items-center">
								<div class="d-flex flex-column align-items-start col-8">
									<div class="d-flex">
										<div class="text-success fw-bold me-1"><?php echo $prix ?>€</div>
										<div class="ms-1"><?php echo $contenance . ' ' . $unite ?></div>
									</div>
									<div class="small d-flex align-items-center input-group">
										<div class="me-1">Quantite :</div><input class="border border-success rounded w-25 p-1" name="quantite" type="number" min="1" max="10" value="<?php echo $qte ?>">
									</div>
								</div>
								<button class="btn btn-outline-success" type="submit" name="retirer" value="<?php echo $id . '|' . $unProduit['idContenance'] ?>" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">Retirer</button>
							</div>
						</div>
					</form>
				</div>
		<?php
			}
		} else {
			echo '<div class="alert alert-danger mx-auto mt-3">' . $message . '</div>';
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