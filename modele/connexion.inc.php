<?php

function checkConnexion($username, $mdp){

    try 
    {
        $getInfo = connexionPDO();
        $req = $getInfo -> prepare('SELECT l.l_id as l_id, l.u_id as u_id, u.h_id as u_hab FROM login l INNER JOIN utilisateur u ON l.u_id = u.u_id WHERE l.l_identifiant = :identifiant AND l.l_motdepasse = "'.hash('sha512', $mdp).'"');
        $req -> bindParam(':identifiant', $username, PDO::PARAM_STR);
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

?>