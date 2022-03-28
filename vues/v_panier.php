<div class="w-100 text-center h2 text-success fw-bold mb-3">Votre Panier</div>
<div class="d-flex flex-column align-items-center commander rounded fit m-auto col-lg-8 col-12">
	<div id="produits-commande" class="d-flex flex-wrap justify-content-around">
		<?php
		if(isset($lesProduitsDuPanier)){
			foreach( $lesProduitsDuPanier as $unProduit) 
			{
				// récupération des données d'un produit
				$id = $unProduit['id'];
				$description = $unProduit['description'];
				$image = "assets/".$unProduit['image'];
				$prix = $unProduit['prix'];
				// affichage
				?>
				<div class="card d-flex flex-column justify-content-between">
						<div class="d-flex flex-column justify-content-center align-items-center">
							<div class="photoCard"><img src="<?php echo $image ?>" alt=image /></div>
							<div class="descrCard"><?php echo $description ?></div>
						</div>
						<div class="d-flex flex-wrap justify-content-around align-items-center">
							<div class=""><?php echo $prix."€" ?></div>
							<a href="index.php?uc=gererPanier&produit=<?php echo $id ?>&action=supprimerUnProduit" onclick="return confirm('Voulez-vous vraiment retirer cet article ?');">
								<img src="assets/images/retirerpanier.png" TITLE="Retirer du panier" alt="retirer du panier">
							</a>
						</div>
					</div>
				<?php
			}
		}else{
			echo '<div class="alert alert-danger mt-3">'.$message.'</div>';
		}
		?>
	</div>
	<div id="divider" class="w-75 bg-secondary"></div>
	<div class="d-flex flex-row justify-content-center align-items-center my-3 fit">
		<a class="text-decoration-none fit me-2" href="index.php?uc=gererPanier&action=passerCommande">
			<img class="btn-height" src="assets/images/commander.png" title="Passer commande" alt="Commander">
		</a>
		<a class="ms-2" href="index.php?uc=gererPanier&action=videPanier">
			<button class="btn btn-outline-success" type="button">Vider le panier</button>
		</a>
	</div>
</div>