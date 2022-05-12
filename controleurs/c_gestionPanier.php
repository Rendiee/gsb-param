<?php
$action = $_REQUEST['action'];
$_SESSION['page'] = 'panier';
switch ($action) {
	case 'voirPanier': {
			if (isset($_GET['produit'])) {//Changer quantité selectionnée du produit dans panier
				$result = explode('|', $_GET['produit']); //$result[0] = id du produit - $result[1] = contenance du produit - $result[2] = quantite du produit a changé
				$resultId = array_search($result[0], array_column($_SESSION['produits'], 0));
				if($_SESSION['produits'][$resultId][1] == $result[1]){
						$_SESSION['produits'][$resultId][2] = $result[2];
				}
				header('location: index.php?uc=gererPanier&action=voirPanier');
			}
			$n = nbProduitsDuPanier();
			if ($n > 0) {
				$desIdProduit = getLesIdProduitsDuPanier();
				$lesProduitsDuPanier = getLesProduitsDuTableau($desIdProduit);
				$totalPanier = getTotalPanier($lesProduitsDuPanier);
			}
			include("vues/v_panier.php");
			break;
		}
	case 'supprimerUnProduit': {
			$result_explode = explode('|', $_POST['retirer']);
			$idProduit = $result_explode[0];
			$contenance = $result_explode[1];
			retirerDuPanier($idProduit, $contenance);
			header('location: index.php?uc=gererPanier&action=voirPanier');
			break;
		}
	case 'resumerCommande':
		if(isset($_SESSION['u_id'])){
			$n = nbProduitsDuPanier();
			$info = infoProfil();
			$idCommande = getLastIdCommande();
			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = getLesProduitsDuTableau($desIdProduit);
			$total = getTotalPanier($lesProduitsDuPanier);
	
			if ($n > 0) {
				include("vues/v_resumerCommande.php");
			} else {
				$message = "Votre panier est vide !";
				include("vues/v_panier.php");
			}
		}else{
			header('location: index.php?uc=connexion&action=connexion');
		}
		break;
	case 'confirmerCommande': {
			$desIdProduit = getLesIdProduitsDuPanier();
			$lesProduitsDuPanier = getLesProduitsDuTableau($desIdProduit);
			$totalPanier = getTotalPanier($lesProduitsDuPanier);
			if(isset($_POST['commander'])){
				creerCommande($totalPanier, $_SESSION['u_id'], $lesProduitsDuPanier);
				supprimerPanier();
				header('location: index.php?uc=voirProduits&action=nosProduits');
			}
			break;
		}

	case 'videPanier': {
			supprimerPanier();
			header('location: index.php?uc=gererPanier&action=voirPanier');
			break;
		}
	default: {
			header('location: index.php?uc=gererPanier&action=voirPanier');
			break;
		}
}
