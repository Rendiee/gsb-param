<?php

/**
 * Mission 3 : architecture MVC
 * @mainpage La documentation de la mission 3
 */
/**
 * @file bd.inc.php
 * @author Marielle Jouin <jouin.marielle@gmail.com>
 * @version    2.0
 * @date nov 2021
 * @details contient la fonction qui créée l'ojet Pdo $conn pour l'accès à la BD
 */

/**
 * connexionPdo fournit un objet Pdo $conn
 * pour effectuer ensuite des requêtes
 */
function connexionPDO(){
    $login = 'george';
    $mdp = 'george';
    $bd = 'GsbParam';
    $serveur = 'localhost:3308';

    try {
        $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
        $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $conn;
    } catch (PDOException $e) {
        print "Erreur de connexion PDO " . $e->getMessage();
        die();
    }
}
// POUR MAC OS : SET GLOBAL sql_mode=(SELECT REPLACE(@@sql_mode,'ONLY_FULL_GROUP_BY',''));
// function connexionPDO()
// {
//     $login = 'george';
//     $mdp = 'george';
//     $bd = 'GsbParam';
//     $serveur = 'localhost;port=8889';

//     try {
//         $conn = new PDO("mysql:host=$serveur;dbname=$bd", $login, $mdp, array(PDO::MYSQL_ATTR_INIT_COMMAND => 'SET NAMES \'UTF8\''));
//         $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
//         return $conn;
//     } catch (PDOException $e) {
//         print "Erreur de connexion PDO " . $e->getMessage();
//         die();
//     }
// }
