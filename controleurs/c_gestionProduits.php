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
				$idProduit = insertProduct($_POST['nomproduit'], $_POST['imgproduit'], $_POST['descproduit'], $_POST['marqueproduit'], $_POST['list-marque-produit'], $_POST['list-contenance'], $_POST['prixproduit'], $_POST['quantite'], $idUnite);
				//insertRemplir($idProduit, $idContenance, $_POST['prixproduit'], $_POST['quantite'], $idUnite);
				$_SESSION['countProduit'] = 0;
				$_SESSION['messageSuccessProduit'] = 'Le produit a bien été enregistré !';
				header('location: index.php?uc=administrer&action=ajouterProduit');
			}
			$maxId = getLastIdProduit();
			$lesCategories = getLesCategories();
			$lesUnites = getUniteContenance();
			//$lesContenances = getContenanceValue();
			include('./vues/v_ajouterProduit.php');
			break;
		}
	case 'editerProduit': {
			$lesProduits = getTousLesProduitsOrderId();
			if (isset($_POST['editproduit'])) {
				if (isset($_POST['list-edit-produit-contenance']) && $_POST['list-edit-produit-contenance'] != "") {
					$infoProduit = $_POST['list-edit-produit-contenance'];
					$paramProduit = explode("|", $infoProduit);
					$idProduit = $paramProduit[0];
					$_SESSION['editProduit'] = $paramProduit;
					$_SESSION['idProduit'] = $idProduit;
					$leProduit = getInfoTechProduit($paramProduit[0], $paramProduit[1], $paramProduit[2]);
					$lesCategories = getLesCategories();
					$lesUnites = getUniteContenance();
					//$lesContenances = getContenanceValue();
					include('./vues/v_pageEditerProduit.php');
				}
			} else if (isset($_POST['suppProduit'])) {
				if (isset($_POST['list-edit-produit']) && $_POST['list-edit-produit'] != "") {
					supprimerLesContenancesEtLeProduit($_POST['list-edit-produit']);
					header('location: index.php?uc=administrer&action=editerProduit');
				}
			} else if (isset($_POST['modif-product'])) {
				//update product ici
				updateProduct($_SESSION['idProduit'], $_POST['nomproduit'], $_POST['descproduit'], $_POST['marqueproduit'], $_POST['list-cat-produit'], $_POST['list-contenance'], $_POST['prixproduit'], $_POST['quantite'], $_POST['list-unite']);
				//updateRemplir($_SESSION['idProduit'], $_POST['prixproduit'], $_POST['quantite'], $_POST['list-unite'], $_POST['list-cat-produit']);
				unset($_SESSION['idProduit']);
				header('location: index.php?uc=administrer&action=editerProduit', true);
			} else if (isset($_POST['suppContenance'])) {
				//suppression contenance ici
				$infoProduit = $_POST['list-edit-produit-contenance'];
				$paramProduit = explode("|", $infoProduit);
				supprimerContenanceProduit($paramProduit);
				header('location: index.php?uc=administrer&action=editerProduit', true);
			} else if (isset($_POST['chooseproduct'])) {
				if (isset($_POST['list-edit-produit']) && $_POST['list-edit-produit'] != "") {
					$produitsContenance = getMemeProduitAvecContenance($_POST['list-edit-produit']);
					unset($_POST['chooseproduct']);
					include('./vues/v_choixProduitContenance.php');
				}
				else{
					$_SESSION['messageErrorEditProduit'] = 'Un problème est survenu.';
					header('location: index.php?uc=administrer&action=editerProduit');
				}
			} elseif (isset($_POST['addContenance'])) {
				$id = $_POST['list-edit-produit'];
				$unité = getUniteProduit($_POST['list-edit-produit']);				
				$produitsContenance = getMemeProduitAvecContenance($_POST['list-edit-produit']);
				var_dump($produitsContenance);
				include('vues/v_ajouterContenanceProduit.php');
			}elseif (isset($_POST['ajoutContenance'])) {
				//ajoutContenanceProduit($);
				include('vues/v_ajouterContenanceProduit.php');
			} else {
				include('./vues/v_formEditerProduit.php');
			}
			break;
		}
	case 'editerCategorie': {
			$lesCategories = getLesCategories();
			if (isset($_POST['edit-categorie'])) {
				if (isset($_POST['list-edit-categorie']) && $_POST['list-edit-categorie'] != "") {
					$lesInfos = getLesInfosCategorie($_POST['list-edit-categorie'], true);
					include('./vues/v_pageEditerCategorie.php');
				}
			} elseif (isset($_POST['modif-categorie'])) {
				if (isset($_POST['acronymeCategorie']) && isset($_POST['nomCategorie'])) {
					$id = $_REQUEST['categorie'];
					updateCategorie($id, $_POST['acronymeCategorie'], $_POST['nomCategorie']);
					$_SESSION['messageCategorie'] = '<div class="alert alert-success fit mx-auto">La catégorie a bien été modifier</div>';
					header('location: index.php?uc=administrer&action=editerCategorie', true);
				}
			} elseif (isset($_POST['supp-categorie']) && isset($_POST['list-edit-categorie']) && $_POST['list-edit-categorie'] != "") {
				$id = $_POST['list-edit-categorie'];
				if (getNbProduitCategorie($id) == 0) {
					supprimerCategorie($id);
					$_SESSION['messageCategorie'] = '<div class="alert alert-success fit mx-auto">La catégorie a bien été supprimer</div>';
					header('location: index.php?uc=administrer&action=editerCategorie', true);
				} else {
					$_SESSION['messageCategorie'] = '<div class="alert alert-danger fit mx-auto">Impossible de supprimer la catégorie : des produits y sont liés</div>';
					header('location: index.php?uc=administrer&action=editerCategorie', true);
				}
			} else {
				include('./vues/v_formEditerCategorie.php');
			}
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
