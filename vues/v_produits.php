<div class="w-100 text-center h2 text-success fw-bold mb-3">Tous les produits</div>
<div class="d-flex flex-wrap justify-content-center">
	<div class="col-xl-3 col-lg-4 col-md-6 col-9 p-1">
		<div class="filtre filtre-sticky rounded p-2 bg-white shadow-sm me-1">
			<form action="index.php?uc=voirProduits&action=nosProduits" method="POST">
				<h4 class="filtre-title">Filtre</h4>
				<hr>
				<div class="text-center">Prix</div>
				<div class="row">
					<div class="col-6 d-flex flex-column">
						<label for="price-min" class="text-filtre-prix">Minimum</label>
						<div class="input-group">
							<input class="form-control text-center m-auto" type="text" id="price-min" name="price-min" size="10" maxlength="3" placeholder="Min">
							<span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
						</div>
					</div>
					<div class="col-6 d-flex flex-column">
						<label for="price-max" class="text-filtre-prix">Maximum</label>
						<div class="input-group">
							<input class="form-control text-center m-auto" type="text" id="price-max" name="price-max" size="10" maxlength="3" placeholder="Max">
							<span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
						</div>
					</div>
				</div>
				<br />
				<hr>
				<div class="text-center">Marque</div>
				<div class="d-flex flex-column align-items-center">
					<select class="form-select border-success fit mt-2" id="list-marque" name="list-marque">
						<option value="default"> - Choisissez une marque - </option>
						<?php
						foreach ($lesMarques as $uneMarque) {
						?>
							<option value="<?php echo $uneMarque['p_marque'] ?>"><?php echo $uneMarque['p_marque'] ?></option>
						<?php
						}
						?>
					</select>
					<button type="submit" class="btn btn-success mt-4 align-items-center w-75" name="filtrer">Filtrer</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-xl-9 col-lg-7 col-sm-12">
		<div class="card-group ms-1 d-flex flex-wrap justify-content-lg-start justify-content-center">
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
				$qte = $unProduit['quantite'];

				$prix = getMinPriceProduct($id);

				$description = substr($description, 0, 80);
				$description = $description . '...';


			?>
				<div class="col-xl-4 col-lg-6 col-md-5 col-sm-6 col-8">
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
							<?php if ($qte > 0) echo '<small class="text-success opacity-75">En Stock';
							else echo '<small class="text-danger opacity-75">Rupture de Stock' ?></small>
							<div class="col-3">
								<a id="categProduit" href="index.php?uc=voirProduits&produit=<?php echo $id ?>&action=voirLeProduit">
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