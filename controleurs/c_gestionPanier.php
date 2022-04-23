<?php
$action = $_REQUEST['action'];
$_SESSION['page'] = 'panier';
switch ($action) {
	case 'voirPanier': {
			$n = nbProduitsDuPanier();
			if ($n > 0) {
				$desIdProduit = getLesIdProduitsDuPanier();
				$lesProduitsDuPanier = getLesProduitsDuTableau($desIdProduit);
				$totalPanier = getTotalPanier($lesProduitsDuPanier);
				include("vues/v_panier.php");
			} else {
				include("vues/v_panier.php");
			}
			break;
		}
	case 'supprimerUnProduit': {
			$result_explode = explode('|', $_POST['retirer']);
			$idProduit = $result_explode[0];
			$idContenance = $result_explode[1];
			retirerDuPanier($idProduit, $idContenance);
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
			$rue = $_REQUEST['rue'];
			$ville = $_REQUEST['ville'];
			$cp = $_REQUEST['cp'];
			$mail = $_REQUEST['mail'];
			$msgErreurs = getErreursSaisieCommande($nom, $rue, $ville, $cp, $mail);
			if (count($msgErreurs) != 0) {
				include("vues/v_erreurs.php");
				include("vues/v_commande.php");
			} else {
				$lesIdProduit = getLesIdProduitsDuPanier();
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
