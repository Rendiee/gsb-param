<?php

function checkConnexion($email, $mdp){

    try 
    {
        $getInfo = connexionPDO();
        $req = $getInfo -> prepare('SELECT l.l_id as l_id, l.u_id as u_id, u.h_id as u_hab, u.u_email as u_email FROM login l INNER JOIN utilisateur u ON l.u_id = u.u_id WHERE u.u_email = :email AND l.l_motdepasse = "'.hash('sha512', $mdp).'"');
        $req -> bindParam(':email', $email, PDO::PARAM_STR);
        $req -> execute();
        $res = $req -> fetch();

        return $res;
    } 

    catch (PDOException $e) 
    {
           print "Erreur !: " . $e->getMessage();
            die();
    }

}

function infoProfil(){
    try 
    {
        $monPdo = connexionPDO();
		$req = 'SELECT u_nom, u_prenom, u_adresse, u_cp, u_ville, u_email, u.h_id as h_id, h_libelle FROM utilisateur u JOIN habilitation h ON h.h_id = u.h_id where u_id = '.$_SESSION['u_id'].'';
		$res = $monPdo->query($req);
		$res = $res->fetch();

        return $res;
    } 

    catch (PDOException $e) 
    {
           print "Erreur !: " . $e->getMessage();
            die();
    }
}

?>