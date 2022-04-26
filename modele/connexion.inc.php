<?php

function checkConnexion($email, $mdp)
{

    try {
        $getInfo = connexionPDO();
        $req = $getInfo->prepare('SELECT l.l_id as l_id, l.u_id as u_id, u.h_id as u_hab, u.u_email as u_email FROM login l INNER JOIN utilisateur u ON l.u_id = u.u_id WHERE u.u_email = :email AND l.l_motdepasse = "' . hash('sha512', $mdp) . '"');
        $req->bindParam(':email', $email, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch();

        return $res;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function infoProfil()
{
    try {
        $monPdo = connexionPDO();
        $req = 'SELECT u_nom, u_prenom, u_adresse, u_cp, u_ville, u_email, u.h_id as h_id, h_libelle FROM utilisateur u JOIN habilitation h ON h.h_id = u.h_id where u_id = ' . $_SESSION['u_id'] . '';
        $res = $monPdo->query($req);
        $res = $res->fetch();

        return $res;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function checkEmail($email)
{
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare('SELECT count(*) FROM utilisateur where u_email = :email');
        $req->bindParam(':email', $email, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch();
        if ($res[0] == 0) {
            $ok = true;
        } else {
            $ok = false;
        }
        return $ok;
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getLastIdUtilisateur()
{
    try {

        $monPdo = connexionPDO();
        $req = 'SELECT MAX(u_id) as idMax FROM utilisateur';
        $res = $monPdo->query($req);
        $result = $res->fetch();
        return $result;
    } catch (PDOException $e) {

        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function getLastIdLogin()
{
    try {

        $monPdo = connexionPDO();
        $req = 'SELECT MAX(l_id) as idMax FROM login';
        $res = $monPdo->query($req);
        $result = $res->fetch();
        return $result;
    } catch (PDOException $e) {

        print "Erreur !: " . $e->getMessage();
        die();
    }
}

function createLogin($nom, $prenom, $email, $adresse, $cp, $ville, $mdp)
{
    $idUser = getLastIdUtilisateur()[0];
    $idUser++;
    $idLog = getLastIdLogin()[0];
    $idLog++;
    try {
        $monPdo = connexionPDO();
        $req = $monPdo->prepare('INSERT INTO utilisateur values (' . $idUser . ', :nom, :prenom, :adresse, :cp, :ville, :email, null, 1)');
        $req->bindParam(':email', $email, PDO::PARAM_STR);
        $req->bindParam(':nom', $nom, PDO::PARAM_STR);
        $req->bindParam(':prenom', $prenom, PDO::PARAM_STR);
        $req->bindParam(':adresse', $adresse, PDO::PARAM_STR);
        $req->bindParam(':cp', $cp, PDO::PARAM_STR);
        $req->bindParam(':ville', $ville, PDO::PARAM_STR);
        $req->execute();
        $req = $monPdo->prepare('SELECT u_id FROM utilisateur where u_email = :email');
        $req->bindParam(':email', $email, PDO::PARAM_STR);
        $req->execute();
        $res = $req->fetch();
        $req = $monPdo->prepare('INSERT INTO login (l_id, `l_motdepasse`, `u_id`) values (' . $idLog . ',"' . hash('sha512', $mdp) . '","' . $res[0] . '")');
        $req->execute();
        $req = $monPdo->prepare('UPDATE utilisateur set l_id=' . $idLog . ' WHERE u_id="' . $idUser . '"');
        $req->execute();
    } catch (PDOException $e) {
        print "Erreur !: " . $e->getMessage();
        die();
    }
}
