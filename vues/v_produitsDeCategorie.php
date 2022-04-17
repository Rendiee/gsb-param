<div class="w-100 text-center h2 text-success fw-bold mb-3">
	Produits de la catégorie
	<?php
	echo $nomCategorie['ca_libelle'];
	?>
</div>
<div class="d-flex flex-wrap justify-content-center">
	<div class="col-xl-3 col-lg-4 col-md-6 col-9 p-1">
		<div class="filtre filtre-sticky rounded p-2 bg-white shadow-sm me-1 height-filtre-categorie">
			<h4 class="filtre-title">Filtre</h4>
			<hr>
			<div class="d-flex flex-column m-auto">
				<label for="list-categorie" class="text-center">Catégories</label>
				<select class="form-select border-success w-75 text-center mx-auto mt-2" id="list-categorie" name="list-categorie" onchange="location = this.value">
					<?php

					foreach ($lesCategories as $uneCategorie) {
						$idCategorie = $uneCategorie['ca_acronyme'];
						$libCategorie = $uneCategorie['ca_libelle'];

						if ($_REQUEST['categorie'] == $idCategorie) {
					?>
							<option value="index.php?uc=voirProduits&categorie=<?php echo $idCategorie ?>&action=produitsCategorie" selected><?php echo $libCategorie ?></option>
						<?php
						} else {
						?>
							<option value="index.php?uc=voirProduits&categorie=<?php echo $idCategorie ?>&action=produitsCategorie"><?php echo $libCategorie ?></option>
					<?php
						}
					}

					?>
				</select>
			</div>
		</div>
	</div>
	<div class="col-xl-9 col-lg-7 col-sm-12">
		<div class="card-group ms-1 d-flex flex-wrap justify-content-lg-start justify-content-center">
			<?php
			foreach ($lesProduits as $unProduit) {
				$description = $unProduit['description'];
				$image = "assets/" . $unProduit['photo'];
				$nom = $unProduit['nom'];
				$marque = $unProduit['marque'];
				$id = $unProduit['id'];
				$qte = $unProduit['quantite'];

				$prix = getMinPriceProduct($id);

				$description = substr($description, 0, 80);
				$description = $description . '...';
				// affichage d'un produit avec ses informations
			?>
				<div class="col-xl-4 col-lg-6 col-md-5 col-sm-6 col-8">
					<div class="card m-1">
						<div class="d-flex flex-column justify-content-center pb-1 height325px">
							<p class="card-title marque-product"><?php echo $marque ?></p>
							<div class="name-product title-height"><?php echo $nom ?></div>
							<img class="img-product" src="<?php echo $image ?>" alt="image product">
							<p class="card-text description-product"><?php echo $description ?></p>
						</div>
						<div class="card-footer d-flex justify-content-between align-items-center">
							<div class="d-flex flex-column align-items-center">
								<small>À partir de </small>
								<div class="text-success fw-bold"><?php echo $prix[0] ?>€</div>
							</div>
							<?php if ($qte > 0) echo '<small class="text-success opacity-75">En Stock';
							else echo '<small class="text-danger opacity-75">Rupture de Stock' ?></small>
							<div class="col-3">
								<a id="categProduit" href="index.php?uc=voirProduits&produit=<?php echo $id ?>&categorie=<?php echo $unProduit['ca_acronyme'] ?>&action=voirLeProduit">
									<button class="btn btn-outline-success w-100" type="button">Voir</button>
								</a>
							</div>
						</div>
					</div>
				</div>
			<?php
			}
			?>
		</div>
	</div>
</div>