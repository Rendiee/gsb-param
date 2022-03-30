-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mer. 30 mars 2022 à 12:34
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
-- Structure de la table `contenance`
--

DROP TABLE IF EXISTS `contenance`;
CREATE TABLE IF NOT EXISTS `contenance` (
  `co_id` int(11) NOT NULL,
  `co_qte` int(11) NOT NULL,
  `co_unite` varchar(10) CHARACTER SET utf8 COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`co_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `contenance`
--

INSERT INTO `contenance` (`co_id`, `co_qte`, `co_unite`) VALUES
(1, 25, 'ml'),
(2, 50, 'ml'),
(3, 75, 'ml'),
(4, 100, 'ml'),
(5, 150, 'ml'),
(6, 200, 'ml'),
(7, 50, 'gélules'),
(8, 100, 'gélules'),
(9, 10, 'gr'),
(10, 200, 'gr'),
(11, 30, 'capsules'),
(12, 50, 'capsules'),
(13, 300, 'ml'),
(14, 500, 'ml'),
(15, 10, 'sachets'),
(16, 20, 'sachets'),
(17, 50, 'sachets');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
