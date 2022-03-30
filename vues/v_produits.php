<div class="container-fluid">
	<div class="container">
		<div class="row">
			<div class="col-3">
				<h1>Test</h1>
			</div>
			<div class="col-9 d-flex flex-column flex-wrap">
				<div class="row row-cols-3">
				<?php
				
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

<div class="w-100 text-center h2 text-success fw-bold">Tous les produits</div>
<div id="produits" class="d-flex flex-wrap justify-content-around col-lg-8 col-12 m-auto">
	<?php
	// parcours du tableau contenant les produits à afficher
	if(isset($message)){echo '<div class="alert alert-danger mt-3">'.$message.'</div>';}
	foreach( $lesProduits as $unProduit) 
	{ 	// récupération des informations du produit
		$id = $unProduit['id'];
		$description = $unProduit['description'];
		$prix=$unProduit['prix'];
		$image = "assets/" . $unProduit['photo'];
		$nom = $unProduit['nom'];
		// affichage d'un produit avec ses informations
		?>	
		<div class="card d-flex flex-column justify-content-between">
			<div class="d-flex flex-column justify-content-center align-items-center">
				<div class="photoCard"><img src="<?php echo $image ?>" alt=image /></div>
				<div class="descrCard"><?php echo $nom ?></div>
			</div>
			<div class="d-flex flex-wrap justify-content-around align-items-center">
				<div class=""><?php echo $prix."€" ?></div>		
				<a href="index.php?uc=voirProduits&produit=<?php echo $id ?>&action=ajouterAuPanier">
					<img src="assets/images/mettrepanier.png" TITLE="Ajouter au panier" alt="Mettre au panier">
				</a>
			</div>
		</div>
	<?php			
	} // fin du foreach qui parcourt les produits
	?>
</div>
