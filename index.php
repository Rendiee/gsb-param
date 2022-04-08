<?php
	session_start();
	require_once("modele/fonctions.inc.php");
	require_once("modele/bd.produits.inc.php");
	require_once("modele/connexion.inc.php");

	if(!isset($_REQUEST['uc']))
		$uc = 'accueil';
	else
		$uc = $_REQUEST['uc'];

	include("vues/v_header.php");
	echo '<div class="container my-4">';
	switch($uc)
	{
		case 'accueil':{
			include("vues/v_accueil.php");
			break;
		}
		case 'voirProduits' :{
			include("controleurs/c_voirProduits.php");
			break;
		}
		case 'gererPanier' :{
			include("controleurs/c_gestionPanier.php");
			break;
		}
		case 'connexion' :{
			include("controleurs/c_gestionConnexion.php");
			break;
		}
		case 'administrer' :{
			include("controleurs/c_gestionProduits.php");
			break;
		}
		default :{
			header('location: index.php?uc=accueil');
			break;
		}
	}
	echo '</div>';
	include("vues/v_footer.php") ;
?>

