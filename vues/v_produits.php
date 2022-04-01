<div class="w-100 text-center h2 text-success fw-bold mb-3">Tous les produits</div>
<div class="d-flex flex-wrap justify-content-center">
	<div class="col-xl-3 col-lg-4 col-md-6 col-8 column-product p-1">
		<div class="filtre filtre-sticky rounded p-2 bg-white shadow-sm me-1">
			<h4 class="filtre-title">Filtre</h4>
			<hr>
			<div class="titre-sous-partie">Prix</div>
			<div class="row">
				<div class="col-6 d-flex flex-column">
					<div class="text-filtre-prix">Minimum</div>
					<input class="input-filtre-price" type="text" id="price-min" name="price-min" size="10" maxlength="3" placeholder="EUR Min">
				</div>
				<div class="col-6 d-flex flex-column">
					<div class="text-filtre-prix">Maximum</div>
					<input class="input-filtre-price" type="text" id="price-max" name="price-max" size="10" maxlength="3" placeholder="EUR Max">
				</div>
			</div>
			<br />
			<hr>
			<div class="titre-sous-partie">Marque</div>
			<div class="button-position">
				<input class="input-filtre-price" type="text" id="marque" name="marque" size="20" placeholder="Marque">
				<button type="button" class="btn btn-success button-filtre align-items-center">Filtrer</button>
			</div>
		</div>
	</div>
	<div class="col-xl-9 col-sm-12 column-product">
		<div class="card-group ms-1 justify-content-center">
			<?php
			if (isset($message)) {
				echo '<div class="alert alert-danger mt-3">' . $message . '</div>';
			}
			foreach ($lesProduits as $unProduit) {
				$description = $unProduit['description'];
				$image = "assets/" . $unProduit['photo'];
				$nom = $unProduit['nom'];
				$marque = $unProduit['marque'];
				$id = $unProduit['id'];

				$prix = getMinPriceProduct($id);

				$description = substr($description, 0, 80);
				$description = $description . '...';


			?>
				<div class="col-xl-4 col-lg-5 col-6">
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
							<a id="categProduit" href="index.php?uc=voirProduits&produit=<?php echo $id ?>&action=ajouterAuPanier">
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