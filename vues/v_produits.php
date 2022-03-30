<div class="container-fluid">
	<div class="w-100 text-center h2 text-success fw-bold">Tous les produits</div>
	<div class="container">
		<div class="row">
			<div class="col-3">
				<h1>Test</h1>
			</div>
			<div class="col-9 d-flex flex-column flex-wrap">
				<div class="row row-cols-3">
				<?php
				if (isset($message)) {
					echo '<div class="alert alert-danger mt-3">' . $message . '</div>';
				}
				foreach( $lesProduits as $unProduit) 
				{ 
					$description = $unProduit['description'];
					$prix = $unProduit['prix'];
					$image = "assets/" . $unProduit['photo'];
					$nom = $unProduit['nom'];
					$marque = $unProduit['marque'];

					$description = substr($description, 0, 116);
					$description = $description . '...';

				?>

				<div class="col">
					<div class="card-product">
						<p class="marque-product"><?php echo $marque ?></p>
						<div class="title-height">
							<p class="name-product"><?php echo $nom ?></p>
						</div>
						<img class="img-product" src="<?php echo $image ?>" alt="image product" />
						<p class="description-product"><?php echo $description ?></p>
					</div>
				</div>

				<?php

				}

				?>
				</div>
			</div>
		</div>
	</div>
</div>