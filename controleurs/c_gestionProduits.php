<?php
$action = $_REQUEST['action'];
$_SESSION['page'] = 'navbarDarkDropdownMenuLink';
switch ($action) {
	case 'ajouterProduit': {
			if (isset($_POST['ajouterproduit'])) {
				if (empty($_POST['nomproduit'])) {
					$errorProduct = 'Veuillez saisir un nom !';
				} else if (empty($_POST['descproduit'])) {
					$errorProduct = 'Veuillez saisir une description !';
				} else if (empty($_POST['imgproduit'])) {
					$errorProduct = 'Veuillez mettre une image !';
				} else if (empty($_POST['marqueproduit'])) {
					$errorProduct = 'Veuillez saisir une marque !';
				} else if ($_POST['list-marque-produit'] == 'default') {
					$errorProduct = 'Veuillez choisir une catégorie !';
				} else {
					//insert product ici
					insertProduct($_POST['nomproduit'], $_POST['imgproduit'], $_POST['descproduit'], $_POST['marqueproduit'], $_POST['list-marque-produit']);
					$successProduct = 'Le produit a bien été enregistrer !';
				}
			}
			$maxId = getLastIdProduit();
			$lesCategories = getLesCategories();
			include('./vues/v_ajouterProduit.php');
			break;
		}
	case 'editerProduit': {
			include('./vues/v_editerProduit.php');
			break;
		}
	case 'gererStock': {
			include('./vues/v_gererStock.php');
			break;
		}

	default: {
			header('location: index.php?uc=gererPanier&action=voirPanier');
			break;
		}
}
