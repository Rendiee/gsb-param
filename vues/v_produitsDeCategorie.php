<div class="w-100 text-center h2 text-success fw-bold mb-3">
	Produits de la catégorie
	<?php
	echo $nomCategorie['ca_libelle'];
	?>
</div>
<div class="d-flex flex-wrap justify-content-center">
	<div id="categories" class="list-group col-3 mt-1">
		<?php
		foreach ($lesCategories as $uneCategorie) {
			$idCategorie = $uneCategorie['ca_acronyme'];
			$libCategorie = $uneCategorie['ca_libelle'];
		?>
			<a id="<?php echo $idCategorie ?>" class="list-group-item list-group-item-action text-center" href="index.php?uc=voirProduits&categorie=<?php echo $idCategorie ?>&action=voirProduits">
				<?php echo $libCategorie ?></a>
		<?php
		}
		?>
	</div>
	<div class="col-9">
		<div class="card-group">
			<?php
			// parcours du tableau contenant les produits à afficher

			foreach ($lesProduits as $unProduit) { 	// récupération des informations du produit
				$description = $unProduit['description'];
				$image = "assets/" . $unProduit['photo'];
				$nom = $unProduit['nom'];
				$marque = $unProduit['marque'];
				$id = $unProduit['id'];

				$prix = getMinPriceProduct($id);

				$description = substr($description, 0, 80);
				$description = $description . '...';
				// affichage d'un produit avec ses informations
			?>
				<div class="col-xl-4 col-lg-5 col-md-6 col-12">
					<div class="card m-1">
						<p class="card-title marque-product"><?php echo $marque ?></p>
						<div class="name-product title-height"><?php echo $nom ?></div>
						<img class="img-product" src="<?php echo $image ?>" alt="image product">
						<p class="card-text description-product"><?php echo $description ?></p>
						<div class="card-footer d-flex justify-content-between align-items-center">
							<div class="d-flex flex-column align-items-center">
								<small>À partir de </small>
								<div class="text-success fw-bold"><?php echo $prix[0] ?>€</div>
							</div>
							<a id="categProduit" href="index.php?uc=voirProduits&categorie=<?php echo $categorie ?>&produit=<?php echo $id ?>&action=ajouterAuPanier">
								<button class="btn btn-outline-success" type="button">Ajouter</button>
							</a>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>