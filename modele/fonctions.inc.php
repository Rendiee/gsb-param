<?php

/**
 * @file fonctions.inc.php
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    2.0
 * @date juin 2021
 * @details contient les fonctions qui ne font pas accès aux données de la BD

 * regroupe les fonctions pour gérer le panier, et les erreurs de saisie dans le formulaire de commande

 * @package  GsbParam\util
 */
/**
 * Initialise le panier
 *
 * Crée un tableau associatif $_SESSION['produits']en session dans le cas
 * où il n'existe pas déjà
 */
function initPanier()
{
	if (!isset($_SESSION['produits'])) {
		$_SESSION['produits'] = array();
		$_SESSION['produits'][] = array();
	}
}
/**
 * Supprime le panier
 *
 * Supprime le tableau associatif $_SESSION['produits']
 */
function supprimerPanier()
{
	unset($_SESSION['produits']);
}
/**
 * Ajoute un produit au panier
 *
 * Teste si l'identifiant du produit est déjà dans la variable session 
 * ajoute l'identifiant à la variable de type session dans le cas où
 * où l'identifiant du produit n'a pas été trouvé
 
 * @param string $idProduit identifiant de produit
 * @return boolean $ok vrai si le produit n'était pas dans la variable, faux sinon 
 */
function ajouterAuPanier($idProduit, $contenance, $qte)
{
	$ok = true;
	if (empty($_SESSION['produits'][0])) {
		$i = 0;
	} else {
		$i = sizeof($_SESSION['produits']);
		foreach ($_SESSION['produits'] as $value) {
			if ($value[0] == $idProduit && $value[1] == $contenance) {
				$ok = false;
			}
		}
	}
	if ($ok) {
		$_SESSION['produits'][$i][] = $idProduit; // l'indice n'est pas précisé : il sera automatiquement celui qui suit le dernier occupé
		$_SESSION['produits'][$i][] = $contenance;
		$_SESSION['produits'][$i][] = $qte;
	}
	return $ok;
}
/**
 * Retourne les produits du panier
 *
 * Retourne le tableau des identifiants de produit
 
 * @return array $_SESSION['produits'] le tableau des id produits du panier 
 */
function getLesIdProduitsDuPanier()
{
	var_dump($_SESSION['produits']);
	return $_SESSION['produits'];
}
/**
 * Retourne le nombre de produits du panier
 *
 * Teste si la variable de session existe
 * et retourne le nombre d'éléments de la variable session
 
 * @return int $n
 */
function nbProduitsDuPanier()
{
	$n = 0;
	if (isset($_SESSION['produits'][0])) {
		$n = count($_SESSION['produits'][0]);
	}
	return $n;
}
/**
 * Retire un des produits du panier
 *
 * Recherche l'index de l'idProduit dans la variable session
 * et détruit la valeur à ce rang
 
 * @param string $idProduit identifiant de produit
 * @param string $idContenance identifiant de la contenance
 * array_unshift() déplace le dernier produit du tableau à l'endroit du produit supprimer
 
 */
function retirerDuPanier($idProduit, $idContenance)
{
	$index = 0;
	$ok = false;
	$nb = sizeof($_SESSION['produits']) - 1;
	foreach ($_SESSION['produits'] as $value) {
		if ($value[0] == $idProduit && $value[1] == $idContenance) {
			unset($_SESSION['produits'][$index]);
			$ok = true;
			break;
		}
		$index++;
	}
	if ($ok && $nb > 0 && $index != $nb) {
		array_unshift($_SESSION['produits'], $_SESSION['produits'][$nb]);
		unset($_SESSION['produits'][$nb]);
	}
}
/**
 * Retourne un tableau d'erreurs de saisie pour une commande
 *
 * @param string $nom  chaîne testée
 * @param  string $rue chaîne
 * @param string $ville chaîne
 * @param string $cp chaîne
 * @param string $mail  chaîne 
 * @return array $lesErreurs un tableau de chaînes d'erreurs
 */
function getErreursSaisieCommande($nom, $prenom, $rue, $ville, $cp, $mail)
{
	$erreur = 'Champs manquants : ';
	$lesErreurs = array();
	if ($nom == "") {
		$erreur += ' prénom';
		$lesErreurs[] = "Il faut saisir un prénom";
	}
	if ($rue == "") {
		$lesErreurs[] = "Il faut saisir le champ rue";
	}
	if ($ville == "") {
		$lesErreurs[] = "Il faut saisir le champ ville";
	}
	if ($cp == "") {
		$lesErreurs[] = "Il faut saisir le champ Code postal";
	}
	if ($mail == "") {
		$lesErreurs[] = "Il faut saisir le champ mail";
	}
	return $lesErreurs;
}

function getErreursCommander($nom, $prenom, $rue, $ville, $cp, $mail){

	$erreur = 'Champs manquants : ';
	if ($nom == "") {
		$erreur += ', nom';
	}
	if ($prenom == "") {
		$erreur += ' prénom';
	}
	if ($rue == "") {
		$erreur += ', rue';
	}
	if ($cp == "") {
		$erreur += ', code postal';
	}
	if ($ville == "") {
		$erreur += ', ville';
	}
	if ($mail == "") {
		$erreur += ", email";
	}
	return $erreur;
}

function checkCommander($nom, $prenom, $rue, $ville, $cp, $mail){
	$check = true;
	if($nom == "" || $prenom == "" || $rue == "" || $cp == "" || $ville == "" || $mail == ""){
		$check = false;
	}
	return $check;
}
