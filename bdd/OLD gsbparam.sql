-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mar. 03 mai 2022 à 14:06
-- Version du serveur : 5.7.36
-- Version de PHP : 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `gsbparam`
--

-- --------------------------------------------------------

--
-- Structure de la table `avis`
--

DROP TABLE IF EXISTS `avis`;
CREATE TABLE IF NOT EXISTS `avis` (
  `a_id` int(11) NOT NULL,
  `a_description` varchar(255) COLLATE utf8_bin NOT NULL,
  `a_date` date NOT NULL,
  `a_note` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`a_id`),
  KEY `avis_produit0_FK` (`p_id`),
  KEY `avis_utilisateur1_FK` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `avis`
--

INSERT INTO `avis` (`a_id`, `a_description`, `a_date`, `a_note`, `p_id`, `u_id`) VALUES
(1, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, facere ad? Quas repellendus ducimus nemo quaerat similique itaque odio illo, quasi harum, culpa doloremque exercitationem quod commodi consectetur, repudiandae sit.', '2022-05-03', 4, 1, 2),
(2, 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam, facere ad? Quas repellendus ducimus nemo quaerat similique itaque odio illo, quasi harum, culpa doloremque exercitationem quod commodi consectetur, repudiandae sit.', '2022-04-05', 3, 1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `ca_id` int(11) NOT NULL,
  `ca_libelle` varchar(50) COLLATE utf8_bin NOT NULL,
  `ca_acronyme` varchar(2) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`ca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`ca_id`, `ca_libelle`, `ca_acronyme`) VALUES
(1, 'Cheveux', 'CH'),
(2, 'Sommeil', 'SM'),
(3, 'Visage', 'VG'),
(4, 'Maternité', 'MT');

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `com_id` int(11) NOT NULL,
  `com_dateComande` date NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`com_id`),
  KEY `commande_utilisateur0_FK` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `commander`
--

DROP TABLE IF EXISTS `commander`;
CREATE TABLE IF NOT EXISTS `commander` (
  `com_id` int(11) NOT NULL,
  `p_id` int(11) NOT NULL,
  `qte_produit` int(11) NOT NULL,
  PRIMARY KEY (`com_id`,`p_id`),
  KEY `commander_produit1_FK` (`p_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `contenance`
--

DROP TABLE IF EXISTS `contenance`;
CREATE TABLE IF NOT EXISTS `contenance` (
  `co_id` int(11) NOT NULL,
  `co_contenance` int(11) NOT NULL,
  PRIMARY KEY (`co_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `contenance`
--

INSERT INTO `contenance` (`co_id`, `co_contenance`) VALUES
(1, 75),
(2, 150),
(3, 200),
(4, 500),
(5, 20),
(6, 40);

-- --------------------------------------------------------

--
-- Structure de la table `habilitation`
--

DROP TABLE IF EXISTS `habilitation`;
CREATE TABLE IF NOT EXISTS `habilitation` (
  `h_id` int(11) NOT NULL,
  `h_libelle` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `habilitation`
--

INSERT INTO `habilitation` (`h_id`, `h_libelle`) VALUES
(1, 'Client'),
(2, 'Administrateur'),
(3, 'Responsable commercial');

-- --------------------------------------------------------

--
-- Structure de la table `login`
--

DROP TABLE IF EXISTS `login`;
CREATE TABLE IF NOT EXISTS `login` (
  `l_id` int(11) NOT NULL,
  `l_motdepasse` varchar(255) COLLATE utf8_bin NOT NULL,
  `u_id` int(11) NOT NULL,
  PRIMARY KEY (`l_id`),
  UNIQUE KEY `login_utilisateur0_AK` (`u_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `login`
--

INSERT INTO `login` (`l_id`, `l_motdepasse`, `u_id`) VALUES
(1, '6cf17e0501b8078722f316f094e230341b4f1b2d4d14cc082c41494d6b462024f031beff6fc25145ed02a58181fc90a7fca58f0d879b349638df19dca85efa7f', 1),
(2, 'ff781e873746adf59e3165b217034477ca29d4f2322720e05492ea90d21010378252a85f2d66025874647c6d162d45df2766e8003f33c885bbc3c4dbbe92141f', 2),
(3, 'dbb65dd51a8348771883fae9cd7cc40ce1cf33e3756b4ca798bfcdcc37499b7e7236af7bd16d469bdaf8b039f3d5f414cb8a840d3675862675c0dc4a18fb5946', 3),
(4, 'd0f2a12b1928e2a54043a3e360b2f9ed7df27b780f668b066ed9de61e0007898a07ff05fbf2f062348d55cb4bf824c8c96e9102050271204713f228034ce709c', 4),
(5, '9a07a357cc916422bf1c22ad26a1fbf87298ca0842531b1bf39f42802885e1006b3f1f0f94d7fe3722bd13dce1924c43d85ff310216a1c1b9494ebc0920af5ae', 5),
(6, '339ba91f5fb96b88de6e708ec7d474da3bacca9d716ddde2b1a6f823b69a0673b68b4b1befa8d0166719e75d2b215f710b40ee846b023f515d5248c369a4c123', 6),
(7, '969e3a1370ee3cfd2ad66a4625d234d35d394fd7a41a17d5c9990ad7682fbac7f7fb48c1294792d48d9e4e1f8d62a44cf47de23a5de07997d91051fed2355df3', 7),
(8, '63b1fc033109ff454b5f206d694331ea9ff59d063bb82f1814c1cda1c0e39b846e59a2c14bc0059f0c7209703017e6c95e4eaf5a76a2bc65b62aa23d232e2473', 8),
(9, 'cf83dbc8c8342dbcc14d5f8bdf9fb1d553e63a123f8ca0b66712e82aaddd35cb62c1a82545bb7f791c5d038fc0563a641f0f53cde79428991f521f136bdc0cdc', 9),
(10, '91aab2882ec9ecc6d99d4f54c79e62bca477aed8e581744a82903c93404a5c64fa5214bab11cc646d4414eda1ba9f2b4bf30f37eb858cd576f184c92edc0e543', 10),
(11, '76c0ddffa104f6dd5ecea921b6f8eeea52ea6e97d42c9643cee29cc21ecbf91ccfc7ec1e10a0cbacf5c3c3cd79f99edf860c55333889aa9dffc1a615b421821d', 11);

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
  `ca_id` int(11) NOT NULL,
  PRIMARY KEY (`p_id`),
  KEY `produit_categorie0_FK` (`ca_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `produit`
--

INSERT INTO `produit` (`p_id`, `p_nom`, `p_photo`, `p_description`, `p_marque`, `ca_id`) VALUES
(1, 'Shampooing à la Mangue', 'img-product/shampoing2.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus aliquam venenatis neque, quis pretium orci molestie non.', 'Klorane', 1),
(2, 'Novathrix - Shampooing Energisant Fortifiant', 'img-product/fortifiant.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus aliquam venenatis neque, quis pretium orci molestie non.', 'Phyto', 1),
(3, 'Mystérieux Repulpant', 'img-product/repulpant.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus aliquam venenatis neque, quis pretium orci molestie non.', 'Garancia', 3),
(4, 'Infusion Bonne Nuit', 'img-product/infusion.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus aliquam venenatis neque, quis pretium orci molestie non.', 'Juvamine', 2),
(5, 'Gel Lavant Doux Corps et Cheveux pour nouveau née', 'img-product/gellavant.jpg', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit. Vivamus aliquam venenatis neque, quis pretium orci molestie non.', 'Mustela', 4);

-- --------------------------------------------------------

--
-- Structure de la table `remplir`
--

DROP TABLE IF EXISTS `remplir`;
CREATE TABLE IF NOT EXISTS `remplir` (
  `p_id` int(11) NOT NULL,
  `co_id` int(11) NOT NULL,
  `un_id` int(11) NOT NULL,
  `r_prixVente` float NOT NULL,
  `r_qteStock` int(11) NOT NULL,
  PRIMARY KEY (`p_id`,`co_id`,`un_id`),
  KEY `remplir_contenance1_FK` (`co_id`),
  KEY `remplir_unite2_FK` (`un_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `remplir`
--

INSERT INTO `remplir` (`p_id`, `co_id`, `un_id`, `r_prixVente`, `r_qteStock`) VALUES
(1, 3, 1, 5.95, 10),
(1, 4, 1, 8.99, 10),
(2, 2, 1, 6.85, 10),
(2, 3, 1, 9.95, 10),
(3, 1, 1, 12.99, 10),
(3, 2, 1, 18.65, 10),
(4, 5, 2, 4.26, 10),
(4, 6, 2, 6.38, 10),
(5, 3, 1, 8.15, 10),
(5, 4, 1, 12.35, 10);

-- --------------------------------------------------------

--
-- Structure de la table `suggerer`
--

DROP TABLE IF EXISTS `suggerer`;
CREATE TABLE IF NOT EXISTS `suggerer` (
  `p_id` int(11) NOT NULL,
  `p_id_produit` int(11) NOT NULL,
  PRIMARY KEY (`p_id`,`p_id_produit`),
  KEY `suggerer_produit1_FK` (`p_id_produit`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Structure de la table `unite`
--

DROP TABLE IF EXISTS `unite`;
CREATE TABLE IF NOT EXISTS `unite` (
  `un_id` int(11) NOT NULL,
  `un_libelle` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`un_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `unite`
--

INSERT INTO `unite` (`un_id`, `un_libelle`) VALUES
(1, 'ml'),
(2, 'sachets');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE IF NOT EXISTS `utilisateur` (
  `u_id` int(11) NOT NULL,
  `u_nom` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `u_prenom` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `u_adresse` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `u_cp` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `u_ville` varchar(100) COLLATE utf8_bin DEFAULT NULL,
  `u_email` varchar(100) COLLATE utf8_bin NOT NULL,
  `l_id` int(11) DEFAULT NULL,
  `h_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`u_id`),
  UNIQUE KEY `utilisateur_login0_AK` (`l_id`),
  KEY `utilisateur_habilitation1_FK` (`h_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `utilisateur`
--

INSERT INTO `utilisateur` (`u_id`, `u_nom`, `u_prenom`, `u_adresse`, `u_cp`, `u_ville`, `u_email`, `l_id`, `h_id`) VALUES
(1, 'Villechalane', 'Louis', '8 cours Lafontaine', '29000', 'BREST', 'villechalane.louis@gmail.com', 1, 2),
(2, 'Andre', 'David', '1 r Aimon de Chissée', '38100', 'GRENOBLE', 'andre.david@gmail.com', 2, 3),
(3, 'Bedos', 'Christian', '1 r Bénédictins', '65000', 'TARBES', 'bedos.christian@gmail.com', 3, 1),
(4, 'Tusseau', 'Louis', '22 r Renou', '86000', 'POITIERS', 'tusseau.louis@gmail.com', 4, 1),
(5, 'Bentot', 'Pascal', '11 av 6 Juin', '67000', 'STRASBOURG', 'bentot.pascal@gmail.com', 5, 1),
(6, 'Bioret', 'Luc', '1 r Linne', '35000', 'RENNES', 'bioret.luc@gmail.com', 6, 1),
(7, 'Bunisset', 'Francis', '10 r Nicolas Chorier', '85000', 'LA ROCHE SUR YON', 'bunisset.francis@gmail.com', 7, 1),
(8, 'Bunisset', 'Denise', '1 r Lionne', '49100', 'ANGERS', 'bunisset.denise@gmail.com', 8, 1),
(9, 'Cacheux', 'Bernard', '114 r Authie', '34000', 'MONTPELLIER', 'cacheux.bernard@gmail.com', 9, 1),
(10, 'Cadic', 'Eric', '123 r Caponière', '41000', 'BLOIS', 'cadic.eric@gmail.com', 10, 1),
(11, 'Charoze', 'Catherine', '100 pl Géants', '33000', 'BORDEAUX', 'charoze.catherine@gmail.com', 11, 1);

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `avis`
--
ALTER TABLE `avis`
  ADD CONSTRAINT `avis_produit0_FK` FOREIGN KEY (`p_id`) REFERENCES `produit` (`p_id`),
  ADD CONSTRAINT `avis_utilisateur1_FK` FOREIGN KEY (`u_id`) REFERENCES `utilisateur` (`u_id`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `commande_utilisateur0_FK` FOREIGN KEY (`u_id`) REFERENCES `utilisateur` (`u_id`);

--
-- Contraintes pour la table `commander`
--
ALTER TABLE `commander`
  ADD CONSTRAINT `commander_commande0_FK` FOREIGN KEY (`com_id`) REFERENCES `commande` (`com_id`),
  ADD CONSTRAINT `commander_produit1_FK` FOREIGN KEY (`p_id`) REFERENCES `produit` (`p_id`);

--
-- Contraintes pour la table `login`
--
ALTER TABLE `login`
  ADD CONSTRAINT `login_utilisateur0_FK` FOREIGN KEY (`u_id`) REFERENCES `utilisateur` (`u_id`);

--
-- Contraintes pour la table `produit`
--
ALTER TABLE `produit`
  ADD CONSTRAINT `produit_categorie0_FK` FOREIGN KEY (`ca_id`) REFERENCES `categorie` (`ca_id`);

--
-- Contraintes pour la table `remplir`
--
ALTER TABLE `remplir`
  ADD CONSTRAINT `remplir_contenance1_FK` FOREIGN KEY (`co_id`) REFERENCES `contenance` (`co_id`),
  ADD CONSTRAINT `remplir_produit0_FK` FOREIGN KEY (`p_id`) REFERENCES `produit` (`p_id`),
  ADD CONSTRAINT `remplir_unite2_FK` FOREIGN KEY (`un_id`) REFERENCES `unite` (`un_id`);

--
-- Contraintes pour la table `suggerer`
--
ALTER TABLE `suggerer`
  ADD CONSTRAINT `suggerer_produit0_FK` FOREIGN KEY (`p_id`) REFERENCES `produit` (`p_id`),
  ADD CONSTRAINT `suggerer_produit1_FK` FOREIGN KEY (`p_id_produit`) REFERENCES `produit` (`p_id`);

--
-- Contraintes pour la table `utilisateur`
--
ALTER TABLE `utilisateur`
  ADD CONSTRAINT `utilisateur_habilitation1_FK` FOREIGN KEY (`h_id`) REFERENCES `habilitation` (`h_id`),
  ADD CONSTRAINT `utilisateur_login0_FK` FOREIGN KEY (`l_id`) REFERENCES `login` (`l_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
