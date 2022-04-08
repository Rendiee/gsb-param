<?php
// contrôleur qui gère l'affichage des produits
initPanier(); // se charge de réserver un emplacement mémoire pour le panier si pas encore fait
$action = $_REQUEST['action'];
switch ($action) {
	case 'produitsCategorie': {
			$lesCategories = getLesCategories();
			$categorie = $_REQUEST['categorie'];
			$categorieLibelle = getTitreCategorie($categorie);
			$nomCategorie  = getLesInfosCategorie($categorie);
			$lesProduits = getLesProduitsDeCategorie($categorie);
			include("vues/v_produitsDeCategorie.php");
			break;
		}
	case 'voirLeProduit': {
			$id = $_REQUEST['produit'];
			$infoProduit = getInfoProduit($id);
			$prixMin = getMinPriceProduct($id);
			$prixMax = getMaxPriceProduct($id);
			$uniteEtPrix = getUniteEtPrix($infoProduit['id']);
			include("vues/v_voirProduit.php");
			break;
		}
	case 'ajouterAuPanier': {
			$idProduit = $_REQUEST['produit'];

			$ok = ajouterAuPanier($idProduit);
			if (!$ok) {
				$message = "Cet article est déjà dans le panier !!";
				include("vues/v_message.php");
			} else {
				// on recharge la même page ( NosProduits si pas categorie passée dans l'url')
				if (isset($_REQUEST['categorie'])) {
					$categorie = $_REQUEST['categorie'];
					header('Location:index.php?uc=voirProduits&action=produitsCategorie&categorie=' . $categorie);
				} else
					header('Location:index.php?uc=voirProduits&action=nosProduits');
			}
			break;
		}

	case 'nosProduits': {
			if (isset($_POST['filtrer']) && ($_POST['price-min'] != '' || $_POST['price-max'] != '' || $_POST['list-marque'] != 'default')) {
				if (!empty($_POST['price-min']) || $_POST['price-min'] >= '0') {
					$filtre['price-min'] = $_POST['price-min'];
				}
				if (!empty($_POST['price-max']) || $_POST['price-max'] >= '0') {
					$filtre['price-max'] = $_POST['price-max'];
				}
				if ($_POST['list-marque'] != 'default') {
					$filtre['marque'] = $_POST['list-marque'];
				}
				$lesProduits = getTousLesProduitsFiltres($filtre);
			} else {
				$lesProduits = getTousLesProduits();
			}
			$lesMarques = getLesMarques();
			include("vues/v_produits.php");
		}
}
