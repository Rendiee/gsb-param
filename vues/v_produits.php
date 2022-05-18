<div class="w-100 text-center h2 text-success fw-bold mb-3">Tous les produits</div>
<?php if (isset($_SESSION['message'])) {
	echo $_SESSION['message'];
	unset($_SESSION['message']);
} ?>
<div class="d-flex flex-wrap justify-content-center">
	<div class="col-xl-3 col-lg-4 col-md-6 col-9 p-1">
		<div class="sticky rounded p-2 bg-white shadow-sm me-lg-1">
			<form action="index.php?uc=voirProduits&action=nosProduits" method="POST" id='formFiltrer'>
				<h4 class="filtre-title">Filtre</h4>
				<hr>
				<div class="text-center">Prix</div>
				<div class="row">
					<div class="col-6 d-flex flex-column">
						<label for="price-min" class="text-filtre-prix">Minimum</label>
						<div class="input-group">
							<input class="form-control text-center m-auto" type="number" step="0.01" id="price-min" name="price-min" size="10" maxlength="3" min="0" placeholder="Min" value="<?php if (isset($priceMin)) echo $priceMin ?>">
							<span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
						</div>
					</div>
					<div class="col-6 d-flex flex-column">
						<label for="price-max" class="text-filtre-prix">Maximum</label>
						<div class="input-group">
							<input class="form-control text-center m-auto" type="number" step="0.01" id="price-max" name="price-max" size="10" maxlength="3" min="0" placeholder="Max" value="<?php if (isset($priceMax)) echo $priceMax ?>">
							<span class="input-group-text"><i class="bi bi-currency-euro"></i></span>
						</div>
					</div>
				</div>
				<br />
				<hr>
				<label for="list-marque" class="text-center w-100">Marque</label>
				<div class="d-flex flex-column align-items-center">
					<select class="form-select border-success fit mt-2" id="list-marque" name="list-marque">
						<option value="default"> - Choisissez une marque - </option>
						<?php
						foreach ($lesMarques as $uneMarque) {
							if (isset($marque) && $marque == $uneMarque['p_marque']) {
						?>
								<option selected value="<?php echo $uneMarque['p_marque'] ?>"><?php echo $uneMarque['p_marque'] ?></option>
							<?php } else { ?>
								<option value="<?php echo $uneMarque['p_marque'] ?>"><?php echo $uneMarque['p_marque'] ?></option>
						<?php }
						}
						?>
					</select>
					<button type="submit" class="btn btn-success mt-4 align-items-center w-75" name="filtrer">Filtrer</button>
				</div>
			</form>
		</div>
	</div>
	<div class="col-xl-9 col-lg-7 col-sm-12">
		<?php
		if (!empty($lesProduits)) { ?>
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
					$avis = round(floatval(avisMoyenProduit($id)[0]));
					$nbAvis = nbAvisProduit($id)[0];

					$description = mb_strimwidth($description, 0, 80, '...');


				?>
					<div class="col-xl-4 col-lg-6 col-md-6 col-9">
						<div class="card m-1">
							<div class="d-flex flex-column justify-content-center pb-1 height325px">
								<p class="card-title marque-product"><?php echo $marque ?></p>
								<div class="name-product title-height"><?php echo $nom ?></div>
								<img class="img-product" src="<?php echo $image ?>" alt="image product">
								<p class="card-text description-product"><?php echo $description ?></p>
								<div class="d-flex justify-content-center pb-2 align-items-center">
									<?php for ($i = 1; $i <= 5; $i++) {
										if ($avis != null && $avis >= $i) {
									?> <svg xmlns="http://www.w3.org/2000/svg" height="1rem" width="1rem" fill="var(--color-star-full, #ea7315)" viewBox="0 0 24 24">
												<path d="M12 18.58 5.82 22 7 14.76 2 9.64l6.91-1.06L12 2l3.09 6.58L22 9.64l-5 5.12L18.18 22 12 18.58z" />
											</svg>
										<?php } else {
										?> <svg xmlns="http://www.w3.org/2000/svg" height="1rem" width="1rem" fill="var(--color-star-empty, #d3d2d6)" viewBox="0 0 24 24">
												<path d="M12 18.58 5.82 22 7 14.76 2 9.64l6.91-1.06L12 2l3.09 6.58L22 9.64l-5 5.12L18.18 22 12 18.58z" />
											</svg>
									<?php }
									}
									echo '&nbsp<span class="text-decoration-underline small">' . $nbAvis . ' avis</span>';
									?>
								</div>
							</div>
							<div class="card-footer d-flex justify-content-between align-items-center">
								<div class="d-flex flex-column align-items-center">
									<small>À partir de </small>
									<div class="text-success fw-bold"><?php echo $prix[0] ?>€</div>
								</div>
								<?php if ($qte > 0) echo '<small class="text-center col-4 text-success opacity-75">En Stock';
								else echo '<small class="text-center col-4 text-danger opacity-75">Rupture de Stock' ?></small>
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
		<?php
		} else {
		?>
			<div class="ms-1">
				<div class="mx-auto fit display-2">Oups !</div><br />
				<div class="mx-auto fit">Il semblerait qu'il n'y ait aucun produit...</div>
			</div>
		<?php
		}
		?>
	</div>
</div>