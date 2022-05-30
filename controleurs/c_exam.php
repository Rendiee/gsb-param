<?php
// contrôleur tout pret pour l'exam
$action = $_REQUEST['action'];
switch ($action) {
	case 'test1': {
			include('vues/v_formulaireTest1.php');
			break;
		}
	case 'test2': {
            include('vues/v_formulaireTest2.php');
			break;
		}
	case '': {
			
			break;
		}
	default: {
        // remplacer la valeur par défaut
			header('location:index.php?uc=voirProduits&action=nosProduits');
			break;
		}
}
