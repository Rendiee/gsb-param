<div class="w-100 text-center h3 fw-bold">
	<?php
	$titre = getTitreCategorie($_REQUEST['categorie']);
	echo 'Produit de la catégorie : '.$titre['libelle'];
	?>
</div>
<div class="d-flex flex-wrap justify-content-center">
	<div id="categories" class="list-group my-2">
		<?php
		foreach( $lesCategories as $uneCategorie) 
		{
			$idCategorie = $uneCategorie['id'];
			$libCategorie = $uneCategorie['libelle'];
			?>
				<a id="categorie" class="list-group-item list-group-item-action" href="index.php?uc=voirProduits&categorie=<?php echo $idCategorie ?>&action=voirProduits">
				<?php echo $libCategorie ?></a>
		<?php
		}
		?>
	</div>
	<div id="produits" class="d-flex flex-wrap justify-content-around col-8">
		<?php
		// parcours du tableau contenant les produits à afficher

		foreach( $lesProduits as $unProduit) 
		{ 	// récupération des informations du produit
			$id = $unProduit['id'];
			$description = $unProduit['description'];
			$prix=$unProduit['prix'];
			$image = "assets/" . $unProduit['image'];
			// affichage d'un produit avec ses informations
			?>	
			<div class="card mt-2 d-flex flex-column justify-content-between">
				<div class="d-flex flex-column justify-content-center align-items-center">
					<div class="photoCard"><img src="<?php echo $image ?>" alt=image /></div>
					<div class="descrCard"><?php echo $description ?></div>
				</div>
				<div class="d-flex flex-wrap justify-content-around align-items-center">
					<div class=""><?php echo $prix."€" ?></div>		
					<a href="index.php?uc=voirProduits&categorie=<?php echo $categorie ?>&produit=<?php echo $id ?>&action=ajouterAuPanier">
						<img src="assets/images/mettrepanier.png" TITLE="Ajouter au panier" alt="Mettre au panier">
					</a>
				</div>
			</div>
		<?php			
		} // fin du foreach qui parcourt les produits
		?>
	</div>
</div>

