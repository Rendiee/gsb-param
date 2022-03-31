-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mer. 30 mars 2022 à 12:18
-- Version du serveur :  8.0.18
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `gsbparam`
--

-- --------------------------------------------------------

--
-- Structure de la table `produit`
--

DROP TABLE IF EXISTS `produit`;
CREATE TABLE IF NOT EXISTS `produit` (
  `p_id` int(11) NOT NULL,
  `p_nom` varchar(50) COLLATE utf8_bin NOT NULL,
  `p_photo` varchar(255) COLLATE utf8_bin NOT NULL,
  `p_description` varchar(255) COLLATE utf8_bin NOT NULL,
  `p_marque` varchar(50) COLLATE utf8_bin NOT NULL,
  `p_stock` int(11) NOT NULL,
  `ca_id` int(11) NOT NULL,
  PRIMARY KEY (`p_id`),
  KEY `produit_categorie0_FK` (`ca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`p_id`, `p_nom`, `p_photo`, `p_description`, `p_marque`, `p_stock`, `ca_id`) VALUES
(1, 'Coloration Blond foncé doré', 'img-product/coloration-cheveux.jpg', 'Color & Soin Coloration Permanente Teinte Blond foncé doré', 'Les 3 Chênes', 10, 1),
(2, 'Shampooing Antipelliculaire', 'img-product/antipellicule.jpg', 'Kerium DS Shampooing Intensif Antipelliculaire', 'La Roche Posay', 10, 1),
(3, 'Shampooing à la Mangue', 'img-product/shampoing2.jpg', 'Shampooing à la Mangue', 'Klorane', 10, 1),
(4, 'Shampooing Anti-Pelliculaire', 'img-product/antipellicule2.jpg', 'Dercos Anti-Pelliculaire Shampooing Purifiant Profond', 'Vichy Laboratoire', 10, 1),
(5, 'Anti-chute de cheveux', 'img-product/chute-cheveux.jpg', 'Chute de Cheveux', 'Luxéol', 10, 1),
(6, 'Shampooing Extra-Doux', 'img-product/shampoing.jpg', 'Extra-Doux Shampooing Dermo-Protecteur', 'Ducray', 10, 1),
(7, 'Shampooing Energisant', 'img-product/fortifiant.jpg', 'Novathrix - Shampooing Energisant Fortifiant', 'Phyto', 10, 1),
(8, 'Sérum Pousse Cheveux', 'img-product/pousse-cheveux.png', 'Sérum Pousse Cheveux', 'Luxéol', 10, 1),
(9, 'Bio Sommeil', 'img-product/bio-sommeil.jpg', 'Noctigem Bio Sommeil', 'Herbalgem', 10, 2),
(10, 'Sommeil Réparateur', 'img-product/sommeil-reparateur.jpg', 'Sommeil Réparateur Valériane - Oranger', 'Juvamine', 10, 2),
(11, 'Ergycalm', 'img-product/relaxant.jpg', 'Ergycalm', 'Nutergia', 10, 2),
(12, 'Infusion', 'img-product/infusion.jpg', 'Infusion Bonne Nuit', 'Juvamine', 10, 2),
(13, 'Arkogélules Valériane Bio', 'img-product/qualite-sommeil.jpg', 'Arkogélules Valériane Bio', 'Arkopharma', 10, 2),
(14, 'Cardamome Huile Essentielle', 'img-product/huile-essentielle.jpg', 'Cardamome Huile Essentielle', 'Pranarom', 10, 2),
(15, 'Mystérieux Repulpant', 'img-product/repulpant.jpg', 'Mystérieux Repulpant', 'Garancia', 10, 3),
(16, 'Baume à Lèvres Aloe Vera Bio', 'img-product/baume.jpg', 'Baume à Lèvres Aloe Vera Bio', 'MLK Green Nature', 10, 3),
(17, 'Crème Antioxydant', 'img-product/antioxydant.jpg', 'C25 Cream Concentré Antioxydant', 'Dermaceutic', 10, 3),
(18, 'Crème Anti-Tâches', 'img-product/antitache.jpg', 'Yellow Cream Correcteur Anti-Taches', 'Dermaceutic', 10, 3),
(19, 'Crème Réparatrice Protectrice', 'img-product/reparatrice.jpg', 'Cicalfate+ Crème Réparatrice Protectrice', 'Avène', 10, 3),
(20, 'Sérum rides', 'img-product/serum.jpg', 'Hyalu B5 Sérum', 'La Roche Posay', 10, 3),
(21, 'Gel Lavant', 'img-product/gellavant.jpg', 'Gel Lavant Doux Corps et Cheveux pour nouveau née', 'Mustela', 10, 4),
(22, 'Spray Solaire Enfant', 'img-product/spray-enfant.jpg', 'Bébé Enfant Spray Solaire Haute Protection SPF50', 'Mustela', 10, 4),
(23, 'Gel Douche pour bébé', 'img-product/moussant.jpg', 'Bébé Moussant 3 en 1 Bio', 'Alpha Nova Santé', 10, 4),
(24, 'Shampoing pour Nourrisson', 'img-product/shampoing-nourrisson.jpg', 'Peau normale - Shampoing mousse nourrisson', 'Mustela', 10, 4),
(25, 'Sérum Physiologique', 'img-product/physiologique.jpg', 'Bébé Sérum Physiologique Lavage Nasal et Ophtalmique', 'Gifrer', 10, 4),
(26, 'Tisane allaitement', 'img-product/tisane.jpg', 'Maternité Tisane allaitement', 'Weleda', 10, 4),
(27, 'Céréales Légumes Bio', 'img-product/cereale.jpg', 'Céréales Légumes dès 4 Mois Bio', 'Physiolac', 10, 4);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie0_FK` FOREIGN KEY (`ca_id`) REFERENCES `categorie` (`ca_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
