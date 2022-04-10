<?php
// contrôleur qui gère l'affichage des produits
$action = $_REQUEST['action'];
switch ($action) {
	case 'produitsCategorie': {
			$_SESSION['page'] = 'categories';
			$lesCategories = getLesCategories();
			$categorie = $_REQUEST['categorie'];
			$categorieLibelle = getTitreCategorie($categorie);
			$nomCategorie  = getLesInfosCategorie($categorie);
			$lesProduits = getLesProduitsDeCategorie($categorie);
			include("vues/v_produitsDeCategorie.php");
			break;
		}
	case 'voirLeProduit': {
			if (isset($_GET['categorie']) || is_array($_SESSION['page'])) {
				if (isset($_GET['categorie'])) {
					$_SESSION['page'] = array();
					$_SESSION['page'][] = 'categories';
					$_SESSION['page'][] = $_GET['categorie'];
				}
			} else {
				$_SESSION['page'] = 'nosproduits';
			}
			$id = $_REQUEST['produit'];
			$infoProduit = getInfoProduit($id);
			if (is_null($infoProduit[0])) {
				if ($_SESSION['page'][0] == 'categories') {
					header('location:index.php?uc=voirProduits&categorie=CH&action=produitsCategorie');
				} else {
					header('location:index.php?uc=voirProduits&action=nosProduits');
				}
			} else {
				if ($_SESSION['page'][0] == 'categories') {
					$categorieActive = "index.php?uc=voirProduits&categorie=" . $_SESSION['page'][1] . "&action=produitsCategorie";
				} else {
					$categorieActive = "index.php?uc=voirProduits&action=nosProduits";
				}
			}
			$prixMin = getMinPriceProduct($id);
			$prixMax = getMaxPriceProduct($id);
			$uniteEtPrix = getUniteEtPrix($infoProduit['id']);
			include("vues/v_voirProduit.php");
			break;
		}
	case 'ajouterAuPanier': {
			$idProduit = $_REQUEST['produit'];
			$contenance = $_POST['list-contenance'];
			$qte = $_POST['quantite'];
			$ok = ajouterAuPanier($idProduit, $contenance, $qte);
			if (!$ok) {
				$message = "Cet article est déjà dans le panier !!";
				include("vues/v_message.php");
			} else {
				// on recharge la même page ( NosProduits si pas categorie passée dans l'url')
				if ($_SESSION['page'][0] == 'categories') {
					header("location:index.php?uc=voirProduits&categorie=" . $_SESSION['page'][1] . "&action=produitsCategorie");
				} else {
					header('location:index.php?uc=voirProduits&action=nosProduits');
				}
			}
			break;
		}

	case 'nosProduits': {
			if (isset($_POST['suppFiltre'])) {
				$_SESSION['filtre'] = false;
			}
			$_SESSION['page'] = 'nosproduits';
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
				$_SESSION['filtre'] = $filtre;
			}
			if (isset($_SESSION['filtre']) && $_SESSION['filtre'] !== false) {
				$lesProduits = getTousLesProduitsFiltres($_SESSION['filtre']);
			} else {
				$lesProduits = getTousLesProduits();
			}
			$lesMarques = getLesMarques();
			include("vues/v_produits.php");
			break;
		}
	default: {
			header('location:index.php?uc=voirProduits&action=nosProduits');
			break;
		}
}
