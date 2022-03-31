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
/**
 * Retourne toutes les informations d'une catégorie passée en paramètre
 *
 * @param string $idCategorie l'id de la catégorie
 * @return array $laLigne le tableau associatif des informations de la catégorie 
 */
function getLesInfosCategorie($idCategorie)
{
	try {
		$monPdo = connexionPDO();
		$req = 'SELECT ca_id, ca_libelle, ca_acronyme from categorie WHERE ca_acronyme="' . $idCategorie . '"';
		$res = $monPdo->query($req);
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
		$req = 'SELECT p.p_id as \'id\', p.p_nom as \'nom\', p.p_photo as \'photo\', p.p_description as \'description\', p.p_marque as \'marque\', round(r.r_prixVente, 2) as \'prix\' FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id INNER JOIN categorie c ON p.ca_id = c.ca_id WHERE c.ca_acronyme = "' . $idCategorie . '" GROUP BY p.p_id';
		$res = $monPdo->query($req);
		$lesLignes = $res->fetchAll();
		return $lesLignes;
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
				$req = 'SELECT p.p_id as \'id\', p.p_nom as \'nom\', p.p_photo as \'photo\', p.p_description as \'description\', p.p_marque as \'marque\', round(r.r_prixVente, 2) as \'prix\' FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id JOIN contenance co ON co.co_id=r.co_id INNER JOIN categorie c ON p.ca_id = c.ca_id WHERE p.`p_id` = "' . $unIdProduit . '" GROUP BY p.p_id';
				$res = $monPdo->query($req);
				$unProduit = $res->fetch();
				$lesProduits[] = $unProduit;
			}
		}
		return $lesProduits;
	} catch (PDOException $e) {
		print "Erreur !: " . $e->getMessage();
		die();
	}
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

function getTousLesProduits()
{
	try {
		$monPdo = connexionPDO();
		$req = 'SELECT p.p_id as \'id\', p.p_nom as \'nom\', p.p_photo as \'photo\', p.p_description as \'description\', p.p_marque as \'marque\', r.r_prixVente as \'prix\' FROM produit p INNER JOIN remplir r ON p.p_id = r.p_id GROUP BY p.p_id';
		$res = $monPdo->query($req);
		$lesLignes = $res->fetchAll();
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
		$req = 'SELECT ROUND(MIN(r.r_prixVente),2) as \'prixMin\' FROM remplir r WHERE r.p_id = ' . $id;
		$res = $monPdo->query($req);
		$result = $res->fetch();
		return $result;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}

function getCategorieProduit($id)
{
	try {

		$monPdo = connexionPDO();
		$req = 'SELECT MIN(r.r_prixVente) as \'prixMin\' FROM remplir r WHERE r.p_id = ' . $id;
		$res = $monPdo->query($req);
		$result = $res->fetch();
		return $result;
	} catch (PDOException $e) {

		print "Erreur !: " . $e->getMessage();
		die();
	}
}
