<?php
$action = $_REQUEST['action'];
$_SESSION['page'] = 'navbarDarkDropdownMenuLink';
switch ($action) {
	case 'ajouterProduit': {
			if (isset($_POST['ajouterproduit'])) {
				if (empty($_POST['nomproduit'])) {
					$_SESSION['messageErrorProduit'] = 'Veuillez saisir un nom !';
				} else if (empty($_POST['descproduit'])) {
					$_SESSION['messageErrorProduit'] = 'Veuillez saisir une description !';
				} else if (empty($_POST['imgproduit'])) {
					$_SESSION['messageErrorProduit'] = 'Veuillez mettre une image !';
				} else if (empty($_POST['marqueproduit'])) {
					$_SESSION['messageErrorProduit'] = 'Veuillez saisir une marque !';
				} else if ($_POST['list-marque-produit'] == 'default') {
					$_SESSION['messageErrorProduit'] = 'Veuillez choisir une catégorie !';
				} else {
					//insert product ici
					insertProduct($_POST['nomproduit'], $_POST['imgproduit'], $_POST['descproduit'], $_POST['marqueproduit'], $_POST['list-marque-produit']);
					$_SESSION['messageSuccessProduit'] = 'Le produit a bien été enregistré !';
				}
			}
			$maxId = getLastIdProduit();
			$lesCategories = getLesCategories();
			$lesUnites = getUniteContenance();
			$lesContenances = getContenanceValue();
			include('./vues/v_ajouterProduit.php');
			break;
		}
	case 'ajouterContenance': {
		if(isset($_POST['ajoutercontenance'])){
			if(empty($_POST['nomcontenance'])){
				$_SESSION['messageErrorContenance'] = 'Veuillez saisir un nom !';
			} else {
				insertContenance($_POST['nomcontenance']);
				$_SESSION['messageSuccessContenance'] = 'La contenance a bien été enregistrée !';
				header('location: index.php?uc=administrer&action=ajouterContenance');
			}
		}
		$lastId = getLastIdContenance();
		include('./vues/v_ajouterContenance.php');
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
