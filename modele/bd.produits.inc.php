<?php

/** 
 * Mission 3 : architecture MVC GsbParam
 
 * @file bd.produits.inc.php
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    2.0
 * @date juin 2021
 * @details contient les fonctions d'accès BD à la table produits
 */
include_once 'bd.inc.php';

/**
 * Retourne toutes les catégories sous forme d'un tableau associatif
 *
 * @return array $lesLignes le tableau associatif des catégories 
 */
function getLesCategories()
{
	try {
		$monPdo = connexionPDO();
		$req = 'SELECT ca_id, ca_libelle, ca_acronyme from categorie';
		$res = $monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function issetCategorie($id)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT ca_id, ca_libelle, ca_acronyme from categorie where ca_acronyme = :id');
		$req->bindParam(':id', $id, PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch();
		if (empty($res)) {
			return false;
		} else {
			return true;
		}
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getIdCategorie($acro)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT ca_id from categorie WHERE ca_acronyme = :acro');
		$req->bindParam(':acro', $acro, PDO::PARAM_STR);
		$req->execute();
		$laLigne = $req->fetch();
		return $laLigne;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
function tousLesAvisDuProduit($id)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT `a_id`, `a_description`, concat(DAY(a_date),\'/\',MONTH(a_date),\'/\',YEAR(a_date)) as `a_date`, `a_note`, `p_id`, `u_id` FROM `avis` WHERE p_id = :id');
		$req->bindParam(':id', $id, PDO::PARAM_STR);
		$req->execute();
		$laLigne = $req->fetchAll();
		return $laLigne;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
function avisMoyenProduit($id)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT AVG(a_note) from avis WHERE p_id = :id');
		$req->bindParam(':id', $id, PDO::PARAM_STR);
		$req->execute();
		$laLigne = $req->fetch();
		return $laLigne;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
function nbAvisProduit($id)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT COUNT(a_note) from avis WHERE p_id = :id');
		$req->bindParam(':id', $id, PDO::PARAM_STR);
		$req->execute();
		$laLigne = $req->fetch();
		return $laLigne;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
/**
 * Retourne toutes les informations d'une catégorie passée en paramètre
 *
 * @param string $idCategorie l'id de la catégorie
 * @return array $laLigne le tableau associatif des informations de la catégorie 
 */
function getLesInfosCategorie($id, $isNumber)
{
	$req = 'SELECT ca_id, ca_libelle, ca_acronyme from categorie WHERE ';
	if ($isNumber) {
		$req = $req . 'ca_id = ';
	} else {
		$req = $req . 'ca_acronyme = ';
	}

	try {
		$monPdo = connexionPDO();
		$req = $req . '"' . $id . '"';
		$res = $monPdo->query($req);
		$laLigne = $res->fetch();
		return $laLigne;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
function produitExiste($idProduit, $contenance)
{
	try {
		$monPdo = connexionPDO();
		$res = $monPdo->prepare('SELECT p_id as id FROM contenant_produit WHERE p_id = :id AND con_volume = :volume');
		$res->bindParam(':id', $idProduit, PDO::PARAM_INT);
		$res->bindParam(':volume', $contenance, PDO::PARAM_INT);
		$res->execute();
		$laLigne = $res->fetch();
		if (empty($laLigne)) {
			return false;
		} else
			return true;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
function quantiteDispo($idProduit, $contenance)
{
	try {
		$monPdo = connexionPDO();
		$res = $monPdo->prepare('SELECT con_qteStock as quantite FROM contenant_produit WHERE p_id = :id AND con_volume = :volume');
		$res->bindParam(':id', $idProduit, PDO::PARAM_INT);
		$res->bindParam(':volume', $contenance, PDO::PARAM_INT);
		$res->execute();
		$laLigne = $res->fetch();
		return $laLigne;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
/**
 * Retourne sous forme d'un tableau associatif tous les produits de la
 * catégorie passée en argument
 * 
 * @param string $idCategorie  l'id de la catégorie dont on veut les produits
 * @return array $lesLignes un tableau associatif  contenant les produits de la categ passée en paramètre
 */

function getLesProduitsDeCategorie($idCategorie)
{
	try {
		$monPdo = connexionPDO();
		$req = 'SELECT p.p_id AS id, p.p_nom AS nom, p.p_photo AS photo, p.p_description AS description, p.p_marque AS marque, ROUND(cp.con_prixVente, 2) AS prix, SUM(cp.con_qteStock) AS quantite, c.ca_acronyme FROM produit p INNER JOIN contenant_produit cp ON p.p_id = cp.p_id INNER JOIN categorie c ON p.ca_id = c.ca_id WHERE c.ca_acronyme = "' . $idCategorie . '" GROUP BY p.p_id';
		$res = $monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
function getInfoProduit($id)
{
	try {
		$monPdo = connexionPDO();
		$req = 'SELECT p.p_id AS id, p.p_nom AS nom, p.p_photo AS photo, p.p_description AS description, p.p_marque AS marque, ROUND(cp.con_prixVente, 2) AS prix, c.ca_libelle AS categorie, SUM(cp.con_qteStock) AS quantite FROM produit p INNER JOIN contenant_produit cp ON cp.p_id = p.p_id INNER JOIN categorie c ON p.ca_id = c.ca_id WHERE p.p_id = "' . $id . '"';
		$res = $monPdo->query($req);
		$res = $res->fetch();
		return $res;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getLesProduitsDuTableau($desIdProduit)
{
	try {
		$monPdo = connexionPDO();
		$nbProduits = count($desIdProduit);
		$lesProduits = array();
		if ($nbProduits != 0) {
			foreach ($desIdProduit as $unIdProduit) {
				$req = 'SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, round(c.con_prixVente, 2) as prix, u.un_libelle as unite, c.con_volume as contenance, c.con_qteStock as quantiteMax FROM produit p INNER JOIN contenant_produit c ON p.p_id = c.p_id AND c.con_volume = "' . $unIdProduit[1] . '" JOIN unite u ON u.un_id=c.un_id INNER JOIN categorie ca ON p.ca_id = ca.ca_id WHERE p.`p_id` = "' . $unIdProduit[0] . '" GROUP BY p.p_id;';
				$res = $monPdo->query($req);
				$unProduit = $res->fetch();
				$unProduit['quantite'] = $unIdProduit[2];
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getTotalPanier($prix)
{
	$total = 0;
	foreach ($prix as $unPrix) {
		$total += $unPrix['prix'] * $unPrix['quantite'];
	}
	return $total;
}

function getLastIdCommande(){
	try {
		$monPdo = connexionPDO();
		$req = 'SELECT MAX(com_id) as max FROM commande;';
		$res = $monPdo->query($req);
		$res = $res->fetch();
		return $res;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function creerCommande($montant, $utilisateurId, $lesIdProduit)
{

	$commandeId = getLastIdCommande();
	var_dump($commandeId);
	if(is_null($commandeId)){
		$commandeId = 0;
	}else{
		$commandeId++;
	}

	$dateCommande = date("Y-m-d");

	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('INSERT INTO commande VALUES (:comId, :date, :prix, :uId)');
		$req->bindParam(':comId', $commandeId, PDO::PARAM_INT);
		$req->bindParam(':date', $dateCommande, PDO::PARAM_STR);
		$req->bindParam(':prix', $montant, PDO::PARAM_STR);
		$req->bindParam(':uId', $utilisateurId, PDO::PARAM_INT);

		// on récupère le dernier id de commande
		//$req = 'select max(id) as maxi from commande';
		$res = $monPdo->query($req);
		$laLigne = $res->fetch();
		$maxi = $laLigne['maxi']; // on place le dernier id de commande dans $maxi
		$idCommande = $maxi + 1; // on augmente le dernier id de commande de 1 pour avoir le nouvel idCommande
		$date = date('Y/m/d'); // récupération de la date système
		//$req = "insert into commande values ('$idCommande','$date','$nom','$rue','$cp','$ville','$mail')";
		$res = $monPdo->exec($req);
		// insertion produits commandés
		foreach ($lesIdProduit as $unIdProduit) {
			$req = "insert into contenir values ('$idCommande','$unIdProduit')";
			$res = $monPdo->exec($req);
		}
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getLesCommandesDuMois($mois, $an)
{
	try {
		$monPdo = connexionPDO();
		$req = 'select id, dateCommande, nomPrenomClient, adresseRueClient, cpClient, villeClient, mailClient from commande where YEAR(dateCommande)= ' . $an . ' AND MONTH(dateCommande)=' . $mois;
		$res = $monPdo->query($req);
		$lesCommandes = $res->fetchAll();
		return $lesCommandes;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getTitreCategorie($lib)
{

	try {
		$monPdo = connexionPDO();
		$req = 'SELECT ca_libelle FROM categorie WHERE ca_acronyme = "' . $lib . '"';
		$res = $monPdo->query($req);
		$titre = $res->fetch();
		return $titre[0];
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getTousLesProduitsOrderId()
{
	try {
		$monPdo = connexionPDO();
		$req = 'SELECT p.p_id AS id, p.p_nom AS nom, p.p_photo AS photo, p.p_description AS description, p.p_marque AS marque, cp.con_prixVente AS prix, SUM(cp.con_qteStock) AS quantite FROM produit p INNER JOIN contenant_produit cp ON p.p_id = cp.p_id GROUP BY p.p_id ORDER BY id;';
		$res = $monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
function getMaxIdAvis()
{
	try {
		$monPdo = connexionPDO();
		$req = 'SELECT MAX(a_id) from avis';
		$res = $monPdo->query($req);
		$res = $res->fetch();

		return $res[0];
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function ajouterAvis($note, $commentaire, $idProduit, $idUtilisateur)
{
	$idAvis = getMaxIdAvis();
	$idAvis++;
	$date = date('Y-m-d');
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('INSERT INTO avis VALUES(:idAvis, :commentaire, :date, :note, :idProduit, :idUtilisateur)');
		$req->bindParam(':idAvis', $idAvis, PDO::PARAM_INT);
		$req->bindParam(':commentaire', $commentaire, PDO::PARAM_STR);
		$req->bindParam(':date', $date, PDO::PARAM_STR);
		$req->bindParam(':note', $note, PDO::PARAM_INT);
		$req->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
		$req->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
		$req->execute();
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function avisDejaExistant($idUtilisateur, $idProduit)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT COUNT(*) from avis WHERE u_id = :idUtilisateur AND p_id = :idProduit');
		$req->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
		$req->bindParam(':idUtilisateur', $idUtilisateur, PDO::PARAM_INT);
		$req->execute();
		$res = $req->fetch();
		if (intval($res[0]) > 0) {
			return false;
		} else {
			return true;
		}
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getTousLesProduits()
{
	try {
		$monPdo = connexionPDO();
		$req = 'SELECT p.p_id AS id, p.p_nom AS nom, p.p_photo AS photo, p.p_description AS description, p.p_marque AS marque, cp.con_prixVente AS prix, SUM(cp.con_qteStock) AS quantite FROM produit p INNER JOIN contenant_produit cp ON p.p_id = cp.p_id GROUP BY p.p_id ORDER BY prix';
		$res = $monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getTousLesProduitsFiltres($filtre)
{
	try {
		$monPdo = connexionPDO();

		if (isset($filtre['price-min']) && isset($filtre['price-max']) && isset($filtre['marque'])) {
			$filtreMin = floatval($filtre['price-min']);
			$filtreMax = floatval($filtre['price-max']);
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, c.con_prixVente as prix, SUM(c.con_qteStock) as quantite FROM produit p INNER JOIN contenant_produit c ON p.p_id = c.p_id AND c.con_prixVente >= :prixMin AND c.con_prixVente <= :prixMax WHERE p_marque = :marque GROUP BY p.p_id ORDER BY prix;');
			$requete->bindParam(':prixMin', $filtreMin, PDO::PARAM_STR);
			$requete->bindParam(':prixMax', $filtreMax, PDO::PARAM_STR);
			$requete->bindParam(':marque', $filtre['marque'], PDO::PARAM_STR);
		} elseif (isset($filtre['price-min']) && isset($filtre['price-max'])) {
			$filtreMin = floatval($filtre['price-min']);
			$filtreMax = floatval($filtre['price-max']);
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, c.con_prixVente as prix, SUM(c.con_qteStock) as quantite FROM produit p INNER JOIN contenant_produit c ON p.p_id = c.p_id AND c.con_prixVente >= :prixMin AND c.con_prixVente <= :prixMax  GROUP BY p.p_id;');
			$requete->bindParam(':prixMin', $filtreMin, PDO::PARAM_STR);
			$requete->bindParam(':prixMax', $filtreMax, PDO::PARAM_STR);
		} elseif (isset($filtre['price-min']) && isset($filtre['marque'])) {
			$filtreMin = floatval($filtre['price-min']);
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, c.con_prixVente as prix, SUM(c.con_qteStock) as quantite FROM produit p INNER JOIN contenant_produit c ON p.p_id = c.p_id AND c.con_prixVente >= :prixMin WHERE p_marque = :marque GROUP BY p.p_id;');
			$requete->bindParam(':prixMin', $filtreMin, PDO::PARAM_STR);
			$requete->bindParam(':marque', $filtre['marque'], PDO::PARAM_STR);
		} elseif (isset($filtre['price-max']) && isset($filtre['marque'])) {
			$filtreMax = floatval($filtre['price-max']);
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, c.con_prixVente as prix, SUM(c.con_qteStock) as quantite FROM produit p INNER JOIN contenant_produit c ON p.p_id = c.p_id AND c.con_prixVente <= :prixMax WHERE p_marque = :marque GROUP BY p.p_id;');
			$requete->bindParam(':prixMax', $filtreMax, PDO::PARAM_STR);
			$requete->bindParam(':marque', $filtre['marque'], PDO::PARAM_STR);
		} elseif (isset($filtre['price-min'])) {
			$filtreMin = floatval($filtre['price-min']);
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, c.con_prixVente as prix, SUM(c.con_qteStock) as quantite FROM produit p INNER JOIN contenant_produit c ON p.p_id = c.p_id AND c.con_prixVente >= :prix GROUP BY p.p_id;');
			$requete->bindParam(':prix', $filtreMin, PDO::PARAM_STR);
		} elseif (isset($filtre['price-max'])) {
			$filtreMax = floatval($filtre['price-max']);
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, c.con_prixVente as prix, SUM(c.con_qteStock) as quantite FROM produit p INNER JOIN contenant_produit c ON p.p_id = c.p_id AND c.con_prixVente <= :prix GROUP BY p.p_id;');
			$requete->bindParam(':prix', $filtreMax, PDO::PARAM_STR);
		} else {
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, c.con_prixVente as prix, SUM(c.con_qteStock) as quantite FROM produit p INNER JOIN contenant_produit c ON p.p_id = c.p_id WHERE p_marque = :marque GROUP BY p.p_id;');
			$requete->bindParam(':marque', $filtre['marque'], PDO::PARAM_STR);
		}
		$req = $requete;
		$req->execute();
		$lesLignes = $req->fetchAll();
		return $lesLignes;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getMinPriceProduct($id)
{

	try {

		$monPdo = connexionPDO();
		$req = 'SELECT ROUND(MIN(cp.con_prixVente),2) as prixMin FROM contenant_produit cp WHERE cp.p_id = ' . $id;
		$res = $monPdo->query($req);
		$result = $res->fetch();
		return $result;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getMaxPriceProduct($id)
{

	try {

		$monPdo = connexionPDO();
		$req = 'SELECT ROUND(MAX(cp.con_prixVente),2) as prixMin FROM contenant_produit cp WHERE cp.p_id = ' . $id;
		$res = $monPdo->query($req);
		$result = $res->fetch();
		return $result;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getUniteEtPrix($id)
{
	try {

		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT cp.p_id, cp.con_prixVente as prix, cp.con_qteStock AS quantite, u.un_libelle as unite, cp.con_volume as volume, cp.un_id FROM contenant_produit cp JOIN unite u ON u.un_id = cp.un_id WHERE cp.p_id = :id');
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();
		$res = $req->fetchAll();
		return $res;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getCategorieProduit($id)
{
	try {

		$monPdo = connexionPDO();
		$req = 'SELECT MIN(cp.con_prixVente) as prixMin FROM contenant_produit cp WHERE cp.p_id = ' . $id;
		$res = $monPdo->query($req);
		$result = $res->fetch();
		return $result;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getLesMarques()
{
	try {

		$monPdo = connexionPDO();
		$req = 'SELECT p_marque FROM produit ORDER BY p_marque';
		$res = $monPdo->query($req);
		$result = $res->fetchAll();
		return $result;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getLastIdProduit()
{
	try {

		$monPdo = connexionPDO();
		$req = 'SELECT MAX(p_id) as maxId FROM produit';
		$res = $monPdo->query($req);
		$result = $res->fetch();
		return $result;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function insertProduct($nom, $imgName, $desc, $marque, $idCategorie, $volume, $prixVente, $qteStock, $unite)
{
	$id = getLastIdProduit()[0];
	$id++;
	$imgLink = 'img-product/' . $imgName;

	try {

		$monPdo = connexionPDO();
		$req = $monPdo->prepare('INSERT INTO produit VALUES (:idProduct, :nomProduct, :imgProduct, :descProduct, :marqueProduct, :idCategorie)');
		$req->bindParam(':idProduct', $id, PDO::PARAM_INT);
		$req->bindParam(':nomProduct', $nom, PDO::PARAM_STR);
		$req->bindParam(':imgProduct', $imgLink, PDO::PARAM_STR);
		$req->bindParam(':descProduct', $desc, PDO::PARAM_STR);
		$req->bindParam(':marqueProduct', $marque, PDO::PARAM_STR);
		$req->bindParam(':idCategorie', $idCategorie, PDO::PARAM_INT);
		$req->execute();
		$req = $monPdo->prepare('INSERT INTO contenant_produit VALUES (:idProduct, :volume, :prixVente, :qteStock, :unite)');
		$req->bindParam(':idProduct', $id, PDO::PARAM_INT);
		$req->bindParam(':volume', $volume, PDO::PARAM_INT);
		$req->bindParam(':prixVente', $prixVente, PDO::PARAM_STR);
		$req->bindParam(':qteStock', $qteStock, PDO::PARAM_INT);
		$req->bindParam(':unite', $unite, PDO::PARAM_INT);
		$req->execute();
		return $id;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getUniteContenance()
{
	try {

		$monPdo = connexionPDO();
		$req = 'SELECT un_id, un_libelle FROM unite';
		$res = $monPdo->query($req);
		$result = $res->fetchAll();
		return $result;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getContenanceValue()
{
	try {

		$monPdo = connexionPDO();
		$req = 'SELECT co_id, co_contenance FROM contenance ORDER BY co_contenance';
		$res = $monPdo->query($req);
		$result = $res->fetchAll();
		return $result;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getLastIdUnite()
{
	try {

		$monPdo = connexionPDO();
		$req = 'SELECT MAX(un_id) as idMax FROM unite';
		$res = $monPdo->query($req);
		$result = $res->fetch();
		return $result;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getLastIdContenance()
{
	try {

		$monPdo = connexionPDO();
		$req = 'SELECT MAX(co_id) as idCon FROM contenance';
		$res = $monPdo->query($req);
		$result = $res->fetch();
		return $result;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function insertUnite($nom)
{
	$id = getLastIdUnite()[0];
	$id++;

	try {

		$monPdo = connexionPDO();
		$req = $monPdo->prepare('INSERT INTO unite VALUES (:idUnite, :nomUnite)');
		$req->bindParam(':idUnite', $id, PDO::PARAM_INT);
		$req->bindParam(':nomUnite', $nom, PDO::PARAM_STR);
		$req->execute();
		return $id;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function idExistContenance($valeur)
{
	try {

		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT co_id FROM contenance WHERE co_contenance = :valeurContenance;');
		$req->bindParam(':valeurContenance', $valeur, PDO::PARAM_INT);
		$req->execute();
		$res = $req->fetch();
		return $res;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function idExistUnite($unite)
{
	try {

		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT un_id FROM unite WHERE un_libelle = :unite;');
		$req->bindParam(':unite', $unite, PDO::PARAM_STR);
		$req->execute();
		$res = $req->fetch();
		return $res;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function insertContenance($valeur)
{
	$id = getLastIdContenance()[0];
	$id++;

	try {

		$monPdo = connexionPDO();
		$req = $monPdo->prepare('INSERT INTO contenance VALUES (:idContenance, :valeurContenance)');
		$req->bindParam(':idContenance', $id, PDO::PARAM_INT);
		$req->bindParam(':valeurContenance', $valeur, PDO::PARAM_INT);
		$req->execute();
		return $id;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getInfoTechProduit($idProd, $volume, $unite)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT p.p_id AS id, p.p_nom AS nom, p.p_photo AS img, p.p_description AS descr, p.p_marque AS marque, c.ca_id AS catId, cp.con_prixVente AS prix, cp.con_qteStock AS stock, cp.un_id AS unite, cp.con_volume AS volume FROM produit p INNER JOIN contenant_produit cp ON cp.p_id = p.p_id INNER JOIN categorie c ON c.ca_id = p.ca_id WHERE p.p_id = :idProd AND cp.con_volume = :volume AND cp.un_id = :unite;');
		$req->bindParam(':idProd', $idProd, PDO::PARAM_INT);
		$req->bindParam(':volume', $volume, PDO::PARAM_INT);
		$req->bindParam(':unite', $unite, PDO::PARAM_INT);
		$req->execute();
		$res = $req->fetch();
		return $res;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function updateProduct($id, $nom, $desc, $marque, $idCategorie, $volume, $prix, $qteStock, $unite)
{

	try {

		$monPdo = connexionPDO();
		$req = $monPdo->prepare('UPDATE produit p SET p.p_nom = :nom, p.p_description = :descr, p.p_marque = :marque, p.ca_id = :catId WHERE p.p_id = :id');
		$req->bindParam(':id', $id, PDO::PARAM_STR);
		$req->bindParam(':nom', $nom, PDO::PARAM_STR);
		$req->bindParam(':descr', $desc, PDO::PARAM_STR);
		$req->bindParam(':marque', $marque, PDO::PARAM_STR);
		$req->bindParam(':catId', $idCategorie, PDO::PARAM_INT);
		$req->execute();
		$req = $monPdo->prepare('UPDATE contenant_produit cp SET cp.p_id = :id, cp.con_volume = :volume, cp.con_prixVente = :prixVente, cp.con_qteStock = :qte, cp.un_id = :unite WHERE cp.p_id = :id AND cp.con_volume = :volume AND cp.un_id = :unite');
		$req->bindParam(':id', $id, PDO::PARAM_STR);
		$req->bindParam(':volume', $volume, PDO::PARAM_INT);
		$req->bindParam(':prixVente', $prix, PDO::PARAM_STR);
		$req->bindParam(':qte', $qteStock, PDO::PARAM_INT);
		$req->bindParam(':unite', $unite, PDO::PARAM_INT);
		$req->execute();
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getContenanceProduit($id)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT count(*) from contenant_produit cp where cp.p_id = :id');
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();
		$res = $req->fetch();
		return $res[0];
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function supprimerToutLeProduit($id)
{
	// A FAIRE
}

function supprimerProduit($id)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('DELETE FROM produit WHERE p_id = :id');
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function supprimerContenanceProduit($tab)
{
	$nb = getContenanceProduit($tab[0]);
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('DELETE FROM contenant_produit WHERE p_id = :id AND con_volume = :coId AND un_id = :uniteId');
		$req->bindParam(':id', $tab[0], PDO::PARAM_INT);
		$req->bindParam(':coId', $tab[1], PDO::PARAM_INT);
		$req->bindParam(':uniteId', $tab[2], PDO::PARAM_INT);
		$req->execute();
		$nb = getContenanceProduit($tab[0]);
		if ($nb == 0) {
			supprimerProduit($tab[0]);
		}
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function supprimerLesContenancesEtLeProduit($id)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('DELETE FROM contenant_produit WHERE p_id = :id');
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();
		supprimerProduit($id);
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getMemeProduitAvecContenance($id)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT p.p_id AS id, p.p_nom AS nom, u.un_id AS unId, u.un_libelle AS unite, cp.con_volume AS volume, cp.con_prixVente AS prix FROM produit p INNER JOIN contenant_produit cp ON p.p_id = cp.p_id INNER JOIN unite u ON u.un_id = cp.un_id WHERE p.p_id = :id ORDER BY :id;');
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();
		$res = $req->fetchAll();
		return $res;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function updateCategorie($idCat, $acro, $lib)
{

	try {

		$monPdo = connexionPDO();
		$req = $monPdo->prepare('UPDATE categorie SET ca_acronyme = :acro, ca_libelle = :lib WHERE ca_id = :id');
		$req->bindParam(':id', $idCat, PDO::PARAM_INT);
		$req->bindParam(':acro', $acro, PDO::PARAM_STR);
		$req->bindParam(':lib', $lib, PDO::PARAM_STR);
		$req->execute();
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getInfoUtilisateurAvis($idAvis)
{

	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT u.u_nom as nom, u.u_prenom as prenom FROM utilisateur u INNER JOIN avis a ON u.u_id = a.u_id WHERE a.a_id = :idAvis');
		$req->bindParam(':idAvis', $idAvis, PDO::PARAM_INT);
		$req->execute();
		$res = $req->fetch();
		return $res;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
