<?php

$action = $_REQUEST['action'];
$_SESSION['page'] = 'navbarDarkDropdownMenuLink';
switch ($action) {
	case 'ajouterProduit': {
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
