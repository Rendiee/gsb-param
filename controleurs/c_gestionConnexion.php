<?php
// contrôleur qui gère la connexion
if (isset($_POST['connexion'])) {
	$arr = checkConnexion($_POST['email'], $_POST['password']);
	if (empty($arr)) {
		$userEmpty = "Informations incorrectes !";
		$userInfos = $_POST['email'];
	} else {
		$_SESSION['u_hab'] = $arr['u_hab'];
		$_SESSION['u_id'] = $arr['u_id'];
		$_SESSION['u_email'] = $arr['u_email'];
		header('Location: index.php?uc=connexion&action=profil');
	}
}
$action = $_REQUEST['action'];
$_SESSION['page'] = 'profil';
switch ($action) {
	case 'inscription': {
			if (isset($_SESSION['u_hab'])) {
				header('location: index.php?uc=connexion&action=profil');
			} else {
				include("vues/v_inscription.php");
				break;
			}
		}
	case 'connexion': {
			if (isset($_SESSION['u_hab'])) {
				header('location: index.php?uc=connexion&action=profil');
			} else {
				include("vues/v_connexion.php");
				break;
			}
		}
	case 'profil': {
			if (!isset($_SESSION['u_hab'])) {
				header('location: index.php?uc=connexion&action=connexion');
			} else {
				$info = infoProfil();
				include("vues/v_profil.php");
			}
			break;
		}
	case 'deconnexion': {
			if (!isset($_SESSION['u_hab'])) {
				header('location: index.php?uc=connexion&action=connexion');
			} else {
				session_destroy();
				session_start();
				$_SESSION['filtre'] = false;
				header('location: index.php?uc=accueil');
			}
			break;
		}
	default: {
			if (!isset($_SESSION['u_hab'])) {
				header('location: index.php?uc=connexion&action=connexion');
			} else {
				header('location: index.php?uc=connexion&action=profil');
			}
			break;
		}
}
