<?php
// contrôleur qui gère l'affichage des produits
$action = $_REQUEST['action'];
switch ($action) {
	case 'produitsCategorie': {
			$_SESSION['page'] = 'categories';
			$lesCategories = getLesCategories();
			if (issetCategorie($_REQUEST['categorie'])) {
				$categorie = $_REQUEST['categorie'];
				$categorieLibelle = getTitreCategorie($categorie);
				$nomCategorie  = getLesInfosCategorie($categorie, false);
				$lesProduits = getLesProduitsDeCategorie($categorie);
				include("vues/v_produitsDeCategorie.php");
			} else {
				header('location: index.php?uc=voirProduits&categorie=' . $lesCategories[0]['ca_acronyme'] . '&action=produitsCategorie');
			}
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
				if ($_SESSION['page'] == 'panier') {
					$value = "index.php?uc=gererPanier&action=voirPanier";
				} elseif ($_SESSION['page'] == 'nosproduits') {
					$value = "index.php?uc=voirProduits&action=nosProduits";
				} else {
					$value = "index.php?uc=connexion&action=profil";
				}
			}
			$id = $_REQUEST['produit'];
			$infoProduit = getInfoProduit($id);
			if (is_null($infoProduit[0])) {
				if ($_SESSION['page'][0] == 'categories') {
					header('location:index.php?uc=voirProduits&categorie=CH&action=produitsCategorie');
				} else {
					header('location:' . $value);
				}
			} else {
				if ($_SESSION['page'][0] == 'categories') {
					$categorieActive = "index.php?uc=voirProduits&categorie=" . $_SESSION['page'][1] . "&action=produitsCategorie";
				} else {
					$categorieActive = $value;
				}
			}
			$avis = tousLesAvisDuProduit($id);
			$avisMoyen = round(floatval(avisMoyenProduit($id)[0]));
			$nbAvis = nbAvisProduit($id)[0];
			$prixMin = getMinPriceProduct($id);
			$prixMax = getMaxPriceProduct($id);
			$uniteEtPrix = getUniteEtPrix($infoProduit['id']);
			include("vues/v_voirProduit.php");
			break;
		}
	case 'ajouterAuPanier': {
			if (isset($_POST['list-contenance']) && isset($_POST['quantite']) && isset($_POST['ajouter'])) {
				$idProduit = $_REQUEST['produit'];
				$contenance = $_POST['list-contenance'];
				$qte = $_POST['quantite'];
				if (produitExiste($idProduit, $contenance)) {
					$qteDispo = quantiteDispo($idProduit, $contenance);
					if ($qte > 0 && $qteDispo[0] >= $qte && $qte <= 10) {
						$ajoutOk = ajouterAuPanier($idProduit, $contenance, $qte);
						if (!$ajoutOk) {
							$_SESSION['message'] = '<div class="m-auto fit alert alert-danger mb-2">Cet article est déjà dans le panier !</div>';
							header("Location: " . $_SERVER["HTTP_REFERER"]); // recharge la page du produit
						} else {
							if ($_SESSION['page'][0] == 'categories') { // on recharge la même page ( NosProduits si pas categorie passée dans la session')
								header("location:index.php?uc=voirProduits&categorie=" . $_SESSION['page'][1] . "&action=produitsCategorie");
							} else {
								header('location:index.php?uc=voirProduits&action=nosProduits');
							}
							$_SESSION['message'] = '<div class="m-auto fit alert alert-success mb-2">L\'article a bien été ajouter au panier !</div>';
							header("Location: " . $_SERVER["HTTP_REFERER"]); // recharge la page du produit
						}
					} else {
						$_SESSION['message'] = '<div class="m-auto fit alert alert-danger mb-2">Un problème est survenu</div>';
						header("Location: " . $_SERVER["HTTP_REFERER"]); // recharge la page du produit
					}
				} else {
					$_SESSION['message'] = '<div class="m-auto fit alert alert-danger mb-2">Un problème est survenu</div>';
					header("Location: " . $_SERVER["HTTP_REFERER"]); // recharge la page du produit
				}
			} else {
				$_SESSION['message'] = '<div class="m-auto fit alert alert-danger mb-2">Un problème est survenu</div>';
				header("Location: " . $_SERVER["HTTP_REFERER"]); // recharge la page du produit
			}
			break;
		}

	case 'nosProduits': {
			if (isset($_POST['suppFiltre'])) {
				$_SESSION['filtre'] = false;
				header('location:index.php?uc=voirProduits&action=nosProduits');
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
				header('location:index.php?uc=voirProduits&action=nosProduits');
			}
			if (isset($_SESSION['filtre']) && $_SESSION['filtre'] !== false) {
				$lesProduits = getTousLesProduitsFiltres($_SESSION['filtre']);
				if (isset($_SESSION['filtre']['price-min'])) {
					$priceMin = intval($_SESSION['filtre']['price-min']);
				}
				if (isset($_SESSION['filtre']['price-max'])) {
					$priceMax = intval($_SESSION['filtre']['price-max']);
				}
				if (isset($_SESSION['filtre']['marque'])) {
					$marque = $_SESSION['filtre']['marque'];
				}
			} else {
				$lesProduits = getTousLesProduits();
			}
			$lesMarques = getLesMarques();
			include("vues/v_produits.php");
			break;
		}
	case 'avis': {
			if (!isset($_SESSION['u_hab'])) {
				header('location: index.php?uc=connexion&action=connexion');
			}
			if (isset($_POST['valider'])) {
				ajouterAvis($_POST['note'], $_POST['commentaire'], $_REQUEST['produit'], $_SESSION['u_id']);
				$_SESSION['message'] = '<div class="m-auto fit alert alert-success mb-2">Avis ajouté avec succès</div>';
				header('location:index.php?uc=voirProduits&produit=' . $_REQUEST['produit'] . '&action=voirLeProduit');
			} elseif (avisDejaExistant($_SESSION['u_id'], $_REQUEST['produit'])) {
				$idProduit = $_REQUEST['produit'];
				$infoProduit = getInfoProduit($idProduit);
				include("vues/v_redigerAvis.php");
			} else {
				$_SESSION['message'] = '<div class="m-auto fit alert alert-danger mb-2">Vous avez déjà donné votre avis sur ce produit</div>';
				header('location:index.php?uc=voirProduits&produit=' . $_REQUEST['produit'] . '&action=voirLeProduit');
			}
			break;
		}
	default: {
			header('location:index.php?uc=voirProduits&action=nosProduits');
			break;
		}
}
