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

function getIdCategorie($acro){
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT ca_id from categorie WHERE ca_acronyme = :acro');
		$req->bindParam(':acro', $acro, PDO::PARAM_STR);
		$req -> execute();
		$laLigne = $req->fetch();
		return $laLigne;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
function tousLesAvisDuProduit($id){
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT * from avis WHERE p_id = :id');
		$req->bindParam(':id', $id, PDO::PARAM_STR);
		$req -> execute();
		$laLigne = $req->fetchAll();
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
	if($isNumber){
		$req = $req . 'ca_id = ';
	}else{
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
		$res = $monPdo->prepare('SELECT p_id as id FROM remplir WHERE p_id = :id AND co_id = :id_co');
		$res->bindParam(':id', $idProduit, PDO::PARAM_INT);
		$res->bindParam(':id_co', $contenance, PDO::PARAM_INT);
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
		$res = $monPdo->prepare('SELECT r_qteStock as quantite FROM remplir WHERE p_id = :id AND co_id = :id_co');
		$res->bindParam(':id', $idProduit, PDO::PARAM_INT);
		$res->bindParam(':id_co', $contenance, PDO::PARAM_INT);
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
		$req = 'SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, round(r.r_prixVente, 2) as prix, SUM(r.r_qteStock) as quantite, c.ca_acronyme FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id INNER JOIN categorie c ON p.ca_id = c.ca_id WHERE c.ca_acronyme = "' . $idCategorie . '" GROUP BY p.p_id';
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
		$req = 'SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, round(r.r_prixVente, 2) as prix, c.ca_libelle as categorie, SUM(r.r_qteStock) as quantite FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id INNER JOIN categorie c ON p.ca_id = c.ca_id WHERE p.p_id = "' . $id . '"';
		$res = $monPdo->query($req);
		$res = $res->fetch();
		return $res;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}
/**
 * Retourne les produits concernés par le tableau des idProduits passée en argument
 *
 * @param array $desIdProduit tableau d'idProduits
 * @return array $lesProduits un tableau associatif contenant les infos des produits dont les id ont été passé en paramètre
 */
function getLesProduitsDuTableau($desIdProduit)
{
	try {
		$monPdo = connexionPDO();
		$nbProduits = count($desIdProduit);
		$lesProduits = array();
		if ($nbProduits != 0) {
			foreach ($desIdProduit as $unIdProduit) {
				$req = 'SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, round(r.r_prixVente, 2) as prix, u.un_libelle as unite, co.co_contenance as contenance, r.co_id as idContenance, r.r_qteStock as quantiteMax FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id JOIN contenance co ON co.co_id=r.co_id AND co.co_id = "' . $unIdProduit[1] . '" JOIN unite u ON u.un_id=r.un_id INNER JOIN categorie c ON p.ca_id = c.ca_id WHERE p.`p_id` = "' . $unIdProduit[0] . '" GROUP BY p.p_id;';
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
/**
 * Crée une commande 
 *
 * Crée une commande à partir des arguments validés passés en paramètre, l'identifiant est
 * construit à partir du maximum existant ; crée les lignes de commandes dans la table contenir à partir du
 * tableau d'idProduit passé en paramètre
 * @param string $nom nom du client
 * @param string $rue rue du client
 * @param string $cp cp du client
 * @param string $ville ville du client
 * @param string $mail mail du client
 * @param array $lesIdProduit tableau associatif contenant les id des produits commandés
	 
 */
function creerCommande($nom, $rue, $cp, $ville, $mail, $lesIdProduit)
{
	try {
		$monPdo = connexionPDO();
		// on récupère le dernier id de commande
		$req = 'select max(id) as maxi from commande';
		$res = $monPdo->query($req);
		$laLigne = $res->fetch();
		$maxi = $laLigne['maxi']; // on place le dernier id de commande dans $maxi
		$idCommande = $maxi + 1; // on augmente le dernier id de commande de 1 pour avoir le nouvel idCommande
		$date = date('Y/m/d'); // récupération de la date système
		$req = "insert into commande values ('$idCommande','$date','$nom','$rue','$cp','$ville','$mail')";
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
/**
 * Retourne les produits concernés par le tableau des idProduits passée en argument
 *
 * @param int $mois un numéro de mois entre 1 et 12
 * @param int $an une année
 * @return array $lesCommandes un tableau associatif contenant les infos des commandes du mois passé en paramètre
 */
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
		$req = 'SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, r.r_prixVente as prix, SUM(r.r_qteStock) as quantite FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id GROUP BY p.p_id ORDER BY id';
		$res = $monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getTousLesProduits()
{
	try {
		$monPdo = connexionPDO();
		$req = 'SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, r.r_prixVente as prix, SUM(r.r_qteStock) as quantite FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id GROUP BY p.p_id ORDER BY prix';
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
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, r.r_prixVente as prix, SUM(r.r_qteStock) as quantite FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id AND r.r_prixVente >= :prixMin AND r.r_prixVente <= :prixMax WHERE p_marque = :marque GROUP BY p.p_id ORDER BY prix;');
			$requete->bindParam(':prixMin', $filtreMin, PDO::PARAM_STR);
			$requete->bindParam(':prixMax', $filtreMax, PDO::PARAM_STR);
			$requete->bindParam(':marque', $filtre['marque'], PDO::PARAM_STR);
		} elseif (isset($filtre['price-min']) && isset($filtre['price-max'])) {
			$filtreMin = floatval($filtre['price-min']);
			$filtreMax = floatval($filtre['price-max']);
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, r.r_prixVente as prix, SUM(r.r_qteStock) as quantite FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id AND r.r_prixVente >= :prixMin AND r.r_prixVente <= :prixMax  GROUP BY p.p_id;');
			$requete->bindParam(':prixMin', $filtreMin, PDO::PARAM_STR);
			$requete->bindParam(':prixMax', $filtreMax, PDO::PARAM_STR);
		} elseif (isset($filtre['price-min']) && isset($filtre['marque'])) {
			$filtreMin = floatval($filtre['price-min']);
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, r.r_prixVente as prix, SUM(r.r_qteStock) as quantite FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id AND r.r_prixVente >= :prixMin WHERE p_marque = :marque GROUP BY p.p_id;');
			$requete->bindParam(':prixMin', $filtreMin, PDO::PARAM_STR);
			$requete->bindParam(':marque', $filtre['marque'], PDO::PARAM_STR);
		} elseif (isset($filtre['price-max']) && isset($filtre['marque'])) {
			$filtreMax = floatval($filtre['price-max']);
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, r.r_prixVente as prix, SUM(r.r_qteStock) as quantite FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id AND r.r_prixVente <= :prixMax WHERE p_marque = :marque GROUP BY p.p_id;');
			$requete->bindParam(':prixMax', $filtreMax, PDO::PARAM_STR);
			$requete->bindParam(':marque', $filtre['marque'], PDO::PARAM_STR);
		} elseif (isset($filtre['price-min'])) {
			$filtreMin = floatval($filtre['price-min']);
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, r.r_prixVente as prix, SUM(r.r_qteStock) as quantite FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id AND r.r_prixVente >= :prix GROUP BY p.p_id;');
			$requete->bindParam(':prix', $filtreMin, PDO::PARAM_STR);
		} elseif (isset($filtre['price-max'])) {
			$filtreMax = floatval($filtre['price-max']);
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, r.r_prixVente as prix, SUM(r.r_qteStock) as quantite FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id AND r.r_prixVente <= :prix GROUP BY p.p_id;');
			$requete->bindParam(':prix', $filtreMax, PDO::PARAM_STR);
		} else {
			$requete = $monPdo->prepare('SELECT p.p_id as id, p.p_nom as nom, p.p_photo as photo, p.p_description as description, p.p_marque as marque, r.r_prixVente as prix, SUM(r.r_qteStock) as quantite FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id WHERE p_marque = :marque GROUP BY p.p_id;');
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
		$req = 'SELECT ROUND(MIN(r.r_prixVente),2) as prixMin FROM remplir r WHERE r.p_id = ' . $id;
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
		$req = 'SELECT ROUND(MAX(r.r_prixVente),2) as prixMin FROM remplir r WHERE r.p_id = ' . $id;
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
		$req = $monPdo->prepare('SELECT r.p_id, r.r_prixVente, r.r_qteStock as quantite, co.co_contenance, u.un_libelle, r.co_id, r.un_id FROM remplir r JOIN contenance co ON co.co_id = r.co_id JOIN unite u ON u.un_id=r.un_id WHERE r.p_id = :id');
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
		$req = 'SELECT MIN(r.r_prixVente) as prixMin FROM remplir r WHERE r.p_id = ' . $id;
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

function insertProduct($nom, $imgName, $desc, $marque, $idCategorie)
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

function insertRemplir($idProduit, $idContenance, $prixproduit, $quantite, $idUnite)
{
	try {

		$monPdo = connexionPDO();
		$req = $monPdo->prepare('INSERT INTO remplir VALUES (:idProduit, :idContenance, :idUnite, :prixproduit, :qte)');
		$req->bindParam(':idProduit', $idProduit, PDO::PARAM_INT);
		$req->bindParam(':idContenance', $idContenance, PDO::PARAM_INT);
		$req->bindParam(':idUnite', $idUnite, PDO::PARAM_INT);
		$req->bindParam(':prixproduit', $prixproduit, PDO::PARAM_STR);
		$req->bindParam(':qte', $quantite, PDO::PARAM_INT);
		$req->execute();
		return $req;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getInfoTechProduit($idProd, $coId, $unite){
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT p.p_id AS id, p.p_nom AS nom, p.p_photo AS img, p.p_description AS descr, p.p_marque AS marque, c.ca_id AS catId, r.r_prixVente AS prix, r.r_qteStock AS stock, r.un_id AS unite, r.co_id AS coId, co.co_contenance as coLib FROM produit p INNER JOIN categorie c ON c.ca_id = p.ca_id INNER JOIN remplir r ON r.p_id = p.p_id INNER JOIN contenance co ON r.co_id = co.co_id WHERE p.p_id = :idProd AND r.co_id = :coId AND r.un_id = :unite');
		$req->bindParam(':idProd', $idProd, PDO::PARAM_INT);
		$req->bindParam(':coId', $coId, PDO::PARAM_INT);
		$req->bindParam(':unite', $unite, PDO::PARAM_INT);
		$req->execute();
		$res = $req->fetch();
		return $res;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function updateProduct($id, $nom, $desc, $marque, $idCategorie)
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
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function updateRemplir($id, $prix, $stock, $uniteId, $contId)
{
	try {

		$monPdo = connexionPDO();
		$req = $monPdo->prepare('UPDATE remplir r SET r.co_id = :coId, r.un_id = :uniteId, r.r_prixVente = :prix, r.r_qteStock = :stock WHERE r.p_id = :id AND r.co_id = :coId AND r.un_id = :uniteId');
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->bindParam(':coId', $contId, PDO::PARAM_INT);
		$req->bindParam(':uniteId', $uniteId, PDO::PARAM_INT);
		$req->bindParam(':prix', $prix, PDO::PARAM_STR);
		$req->bindParam(':stock', $stock, PDO::PARAM_INT);
		$req->execute();
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getMemeProduitAvecContenance($id)
{
	try {
		$monPdo = connexionPDO();
		$req = $monPdo->prepare('SELECT p.p_id AS id, p.p_nom AS nom, c.co_contenance AS coCont, c.co_id as coId, u.un_id as unId, u.un_libelle AS unite, r.r_prixVente AS prix FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id INNER JOIN contenance c ON c.co_id = r.co_id INNER JOIN unite u ON u.un_id = r.un_id WHERE p.p_id = :id ORDER BY :id;');
		$req->bindParam(':id', $id, PDO::PARAM_INT);
		$req->execute();
		$res = $req->fetchAll();
		return $res;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function updateCategorie($idCat, $acro, $lib){

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

function getInfoUtilisateurAvis($idAvis){

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
