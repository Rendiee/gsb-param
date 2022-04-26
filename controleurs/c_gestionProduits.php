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
							$_SESSION['messageErrorProduit'] = 'Un problème est survenu';
						}
					}
					$count++;
				}
				if (isset($_POST['nomUnite'])) {
					$contenance = $_POST['nbContenance'];
					$unite = $_POST['nomUnite'];
					if (!empty(idExistUnite($unite))) {
						$idUnite = idExistUnite($unite)[0];
					} else {
						$idUnite = insertUnite($unite);
					}
				} else {
					$contenance = $_POST['list-contenance'];
					$idUnite = $_POST['list-unite'];
				}
				//insert product ici
				$idProduit = insertProduct($_POST['nomproduit'], $_POST['imgproduit'], $_POST['descproduit'], $_POST['marqueproduit'], $_POST['list-marque-produit']);
				if (!empty(idExistContenance($contenance))) {
					$idContenance = idExistContenance($contenance)[0];
				} else {
					$idContenance = insertContenance($contenance);
				}
				insertRemplir($idProduit, $idContenance, $_POST['prixproduit'], $_POST['quantite'], $idUnite);
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
	case 'ajouterContenance': { // PLUS UTILE -> FAIT DIRECTEMENT DANS AJOUTER PRODUIT
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
			$lesProduits = getTousLesProduitsOrderId();
			if (isset($_POST['editproduit'])) {
				//var_dump($_POST['list-edit-produit']);
				if (isset($_POST['list-edit-produit']) && $_POST['list-edit-produit'] != "") {
					$idProduit = $_POST['list-edit-produit'];
					$leProduit = getInfoTechProduit($idProduit);
					include('./vues/v_pageEditerProduit.php');
				}else{
					$_SESSION['messageErrorEditProduit'] = 'Un problème est survenu.';
					header('location: index.php?uc=administrer&action=editerProduit');
				}
			}else{
				include('./vues/v_formEditerProduit.php');
			}
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
