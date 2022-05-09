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
				if (isset($_POST['inscription'])) {
					$_SESSION['countInscription'] = 0;
					if ($_POST['email'] != "" && $_POST['password'] != "" && checkEmail($_POST['email'])) {
						createLogin($_POST['nom'], $_POST['prenom'], $_POST['email'], $_POST['adresse'], $_POST['cp'], $_POST['ville'], $_POST['password']);
						$_SESSION['successInscription'] = "Inscription réussie";
						header('location: index.php?uc=connexion&action=inscription');
					} else {
						$_SESSION['erreurInscription'] = "Un problème est survenu, l'adresse mail est peut être déjà utilisée";
						header("Location: " . $_SERVER["HTTP_REFERER"]);
					}
				}
				include("vues/v_inscription.php");
			}
			break;
		}
	case 'connexion': {
			if (isset($_SESSION['u_hab'])) {
				header('location: index.php?uc=connexion&action=profil');
			} else {
				include("vues/v_connexion.php");
			}
			break;
		}
	case 'profil': {
			if (!isset($_SESSION['u_hab'])) {
				header('location: index.php?uc=connexion&action=connexion');
			} else {
				$info = infoProfil();
				$commande = getCommandesClient($_SESSION['u_id']);
				include("vues/v_profil.php");
			}
			break;
		}
	case 'deconnexion': {
			if (!isset($_SESSION['u_hab'])) {
				header('location: index.php?uc=connexion&action=connexion');
			} else {
				session_destroy();
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
