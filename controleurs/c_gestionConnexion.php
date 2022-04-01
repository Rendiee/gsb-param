<?php
// contrôleur qui gère la connexion
$action = $_REQUEST['action'];
switch ($action) {
	case 'inscription': {
			include("vues/v_inscription.php");
			break;
		}
	case 'connexion': {
            include("vues/v_connexion.php");
			break;
		}
	case 'profil': {
		if(!isset($_SESSION['u_hab'])){
			header('location: index.php?uc=connexion&action=connexion');
		}else{
			include("vues/v_profil.php");
		}
		break;
	}
}
