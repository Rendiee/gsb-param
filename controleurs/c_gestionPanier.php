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
	case 'passerCommande':
		$n = nbProduitsDuPanier();
		if ($n > 0) {   // les variables suivantes servent à l'affectation des attributs value du formulaire
			// ici le formulaire doit être vide, quand il est erroné, le formulaire sera réaffiché pré-rempli
			$nom = '';
			$rue = '';
			$ville = '';
			$cp = '';
			$mail = '';
			include("vues/v_commande.php");
		} else {
			$message = "Votre panier est vide !";
			include("vues/v_panier.php");
		}
		break;
	case 'confirmerCommande': {
			$nom = $_REQUEST['nom'];
			$prenom = $_REQUEST['prenom'];
			$rue = $_REQUEST['rue'];
			$ville = $_REQUEST['ville'];
			$cp = $_REQUEST['cp'];
			$mail = $_REQUEST['mail'];

			if (!checkCommander($nom, $prenom, $rue, $ville, $cp, $mail)) {
				$msgError = 'Champ vide détecté !';
				include("vues/v_erreurs.php");
				include("vues/v_commande.php");
			} else {
				$desIdProduit = getLesIdProduitsDuPanier();
				$lesProduitsDuPanier = getLesProduitsDuTableau($desIdProduit);
				$totalPanier = getTotalPanier($lesProduitsDuPanier);
				// creerCommande($totalPanier, )
				creerCommande($nom, $rue, $cp, $ville, $mail, $lesIdProduit);
				$message = "Commande enregistrée";
				supprimerPanier();
				include("vues/v_panier.php");
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
