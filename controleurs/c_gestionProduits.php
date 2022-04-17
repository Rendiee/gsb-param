<?php
$action = $_REQUEST['action'];
$_SESSION['page'] = 'navbarDarkDropdownMenuLink';
switch ($action) {
	case 'ajouterProduit': {
			if (isset($_POST['ajouterproduit'])) {
				$count = 0;
				foreach ($_POST as $value) {
					if ($count != 6) {
						if ($value == "" || $value <= "0") {
							var_dump($count);
							var_dump($value);
							$_SESSION['messageErrorProduit'] = 'Un problème est survenu';
						}
					}
					$count++;
				}
				//insert product ici
				$idProduit = insertProduct($_POST['nomproduit'], $_POST['imgproduit'], $_POST['descproduit'], $_POST['marqueproduit'], $_POST['list-marque-produit']);
				$idContenance = insertContenance($_POST['contenance'], $_POST['list-unite-contenance']);
				insertRemplir($idProduit, $idContenance, $_POST['prixproduit'], $_POST['quantite']);
				$_SESSION['countProduit'] = 0;
				$_SESSION['messageSuccessProduit'] = 'Le produit a bien été enregistré !';
				header('location: index.php?uc=administrer&action=ajouterProduit');
			}
			$maxId = getLastIdProduit();
			$lesCategories = getLesCategories();
			$lesUnites = getUniteContenance();
			$lesContenances = getContenanceValue();
			include('./vues/v_ajouterProduit.php');
			break;
		}
	case 'ajouterContenance': {
			if (isset($_POST['ajoutercontenance'])) {
				if (empty($_POST['nomcontenance'])) {
					$_SESSION['messageErrorContenance'] = 'Veuillez saisir un nom !';
				} else {
					insertUnite($_POST['nomcontenance']);
					$_SESSION['countContenance'] = 0;
					$_SESSION['messageSuccessContenance'] = 'La contenance a bien été enregistrée !';
					header('location: index.php?uc=administrer&action=ajouterContenance');
				}
			}
			$lastId = getLastIdUnite();
			include('./vues/v_ajouterContenance.php');
			break;
		}
	case 'editerProduit': {
			include('./vues/v_editerProduit.php');
			break;
		}
	case 'editerCategorie': {
			include('./vues/v_editerCategorie.php');
			break;
		}
	case 'gererStock': {
			include('./vues/v_gererStock.php');
			break;
		}

	default: {
			header('location: index.php?uc=accueil');
			break;
		}
}
