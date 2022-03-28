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
		$image = "assets/" . $unProduit['image'];
		// affichage d'un produit avec ses informations
		?>	
		<div class="card d-flex flex-column justify-content-between">
			<div class="d-flex flex-column justify-content-center align-items-center">
				<div class="photoCard"><img src="<?php echo $image ?>" alt=image /></div>
				<div class="descrCard"><?php echo $description ?></div>
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
