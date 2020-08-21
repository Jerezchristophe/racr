-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mer. 19 août 2020 à 06:41
-- Version du serveur :  10.4.10-MariaDB
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
-- Base de données :  `racr`
--

-- --------------------------------------------------------

--
-- Structure de la table `apprenant`
--

DROP TABLE IF EXISTS `apprenant`;
CREATE TABLE IF NOT EXISTS `apprenant` (
  `idApprenant` int(11) NOT NULL AUTO_INCREMENT,
  `idFormation` int(5) DEFAULT NULL,
  `nomApprenant` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenomApprenant` varchar(50) COLLATE utf8_bin NOT NULL,
  `emailApprenant` varchar(50) COLLATE utf8_bin NOT NULL,
  `sexeApprenant` varchar(20) COLLATE utf8_bin NOT NULL,
  `ageApprenant` int(3) NOT NULL,
  `telApprenant` varchar(10) COLLATE utf8_bin NOT NULL,
  `codepostalApprenant` varchar(5) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idApprenant`),
  KEY `apprenant_ibfk_1` (`idFormation`)
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `apprenant`
--

INSERT INTO `apprenant` (`idApprenant`, `idFormation`, `nomApprenant`, `prenomApprenant`, `emailApprenant`, `sexeApprenant`, `ageApprenant`, `telApprenant`, `codepostalApprenant`) VALUES
(1, 20, 'Jerez', 'Christophe', 'jerezchristophe@gmail.com', 'homme', 35, '0666060608', '84300'),
(18, 1, 'sd', 'sd', 'jc@bdd.com', 'homme', 44, '0625321545', '30000'),
(19, 2, 'yumi', 'yumo', 'yumi@yumo.com', 'femme', 25, '0645869555', '84330'),
(21, 9, 'umtiti', 'samuel', 'samuelu@kjkjk.com', 'homme', 27, '0606060606', '69000'),
(22, 1, 'pp', 'pp', 'ghxxh@mhkmk.com', 'homme', 34, '0625321545', '84300'),
(25, 3, 'Juan', 'Marie', 'juanmarie@toto.om', 'femme', 24, '0623154578', '84130'),
(26, 3, 'keke', 'tataru', 'tataru@gmail.com', 'homme', 45, '0621454545', '69000');

-- --------------------------------------------------------

--
-- Structure de la table `categoriequestion`
--

DROP TABLE IF EXISTS `categoriequestion`;
CREATE TABLE IF NOT EXISTS `categoriequestion` (
  `idCategorie` tinyint(1) NOT NULL,
  `intituleCategorie` varchar(20) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idCategorie`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `categoriequestion`
--

INSERT INTO `categoriequestion` (`idCategorie`, `intituleCategorie`) VALUES
(1, 'réaction'),
(2, 'apprentissage'),
(3, 'comportement'),
(4, 'résultat');

-- --------------------------------------------------------

--
-- Structure de la table `en_charge`
--

DROP TABLE IF EXISTS `en_charge`;
CREATE TABLE IF NOT EXISTS `en_charge` (
  `idAttribution` int(150) NOT NULL AUTO_INCREMENT,
  `idUser` int(5) NOT NULL,
  `idFormation` int(5) NOT NULL,
  PRIMARY KEY (`idAttribution`),
  KEY `idFormation` (`idFormation`),
  KEY `idUser` (`idUser`)
) ENGINE=InnoDB AUTO_INCREMENT=74 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `en_charge`
--

INSERT INTO `en_charge` (`idAttribution`, `idUser`, `idFormation`) VALUES
(1, 1, 1),
(5, 3, 2),
(8, 13, 2),
(33, 23, 20),
(41, 2, 3),
(69, 35, 2),
(72, 36, 1);

-- --------------------------------------------------------

--
-- Structure de la table `evaluation`
--

DROP TABLE IF EXISTS `evaluation`;
CREATE TABLE IF NOT EXISTS `evaluation` (
  `idEvaluation` int(11) NOT NULL AUTO_INCREMENT,
  `idApprenant` int(11) DEFAULT NULL,
  `dateEvaluation` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`idEvaluation`),
  KEY `idApprenant` (`idApprenant`)
) ENGINE=InnoDB AUTO_INCREMENT=64 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `evaluation`
--

INSERT INTO `evaluation` (`idEvaluation`, `idApprenant`, `dateEvaluation`) VALUES
(59, 1, '2020-07-13'),
(60, 22, '2020-07-13'),
(61, 25, '2020-08-18'),
(62, 1, '2020-08-18'),
(63, 19, '2020-08-18');

-- --------------------------------------------------------

--
-- Structure de la table `formation`
--

DROP TABLE IF EXISTS `formation`;
CREATE TABLE IF NOT EXISTS `formation` (
  `idFormation` int(5) NOT NULL AUTO_INCREMENT,
  `intituleFormation` varchar(50) COLLATE utf8_bin NOT NULL,
  `domaineFormation` varchar(50) COLLATE utf8_bin NOT NULL,
  `dateDebutFormation` date NOT NULL DEFAULT '0000-00-00',
  `dateFinFormation` date NOT NULL DEFAULT '0000-00-00',
  PRIMARY KEY (`idFormation`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `formation`
--

INSERT INTO `formation` (`idFormation`, `intituleFormation`, `domaineFormation`, `dateDebutFormation`, `dateFinFormation`) VALUES
(1, 'developpeur web/web mobile', 'informatique', '2020-01-21', '2020-10-01'),
(2, 'cuisinier', 'restauration', '2020-04-01', '2020-05-30'),
(3, 'comique', 'theatre', '2020-04-26', '2020-07-24'),
(9, 'mécanicien automobile', 'mecanique', '2020-04-30', '2020-06-30'),
(17, 'Esthéticienne', 'du poil', '2020-07-14', '2020-12-31'),
(19, 'fleuriste2020', 'fleuriste', '2020-06-04', '2020-06-30'),
(20, 'danse', 'danse', '2020-06-02', '2020-07-30');

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

DROP TABLE IF EXISTS `question`;
CREATE TABLE IF NOT EXISTS `question` (
  `idQuestion` int(11) NOT NULL AUTO_INCREMENT,
  `idQuestionnaire` int(11) NOT NULL,
  `idCategorie` tinyint(4) NOT NULL,
  `intituleQuestion` varchar(250) COLLATE utf8_bin NOT NULL,
  `typeQuestion` tinyint(4) NOT NULL COMMENT '0=range,1=texte',
  PRIMARY KEY (`idQuestion`),
  KEY `idCategorie` (`idCategorie`),
  KEY `idQuestionnaire` (`idQuestionnaire`)
) ENGINE=InnoDB AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `question`
--

INSERT INTO `question` (`idQuestion`, `idQuestionnaire`, `idCategorie`, `intituleQuestion`, `typeQuestion`) VALUES
(38, 3, 1, 'satisfaction ?', 0),
(39, 3, 1, 'Commentaire ?', 1),
(40, 3, 2, 'Assiduité ?', 0),
(41, 3, 2, 'Capacité d\'écoute ?', 0),
(42, 3, 2, 'Commentaire ?', 1),
(43, 3, 3, 'Rigueur ?', 0),
(44, 3, 3, 'Motivation ?', 0),
(45, 3, 3, 'Avis ?', 1),
(46, 3, 4, 'Force de proposition ?', 0),
(47, 3, 4, 'Capacité d\'intégrer une équipe ?', 0),
(48, 3, 4, 'Suggestion', 1),
(49, 3, 1, 'Contenu de la formation ?', 0);

-- --------------------------------------------------------

--
-- Structure de la table `questionnaire`
--

DROP TABLE IF EXISTS `questionnaire`;
CREATE TABLE IF NOT EXISTS `questionnaire` (
  `idQuestionnaire` int(11) NOT NULL AUTO_INCREMENT,
  `intituleQuestionnaire` varchar(100) COLLATE utf8_bin NOT NULL,
  `dateQuestionnaire` date NOT NULL,
  PRIMARY KEY (`idQuestionnaire`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `questionnaire`
--

INSERT INTO `questionnaire` (`idQuestionnaire`, `intituleQuestionnaire`, `dateQuestionnaire`) VALUES
(3, 'Questionnaire de la certification 2020', '2020-07-09');

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

DROP TABLE IF EXISTS `reponse`;
CREATE TABLE IF NOT EXISTS `reponse` (
  `idReponse` bigint(20) NOT NULL AUTO_INCREMENT,
  `idEvaluation` int(11) NOT NULL,
  `idQuestion` int(11) NOT NULL,
  `valeurReponse` longtext COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idReponse`),
  KEY `reponse_ibfk_1` (`idEvaluation`),
  KEY `idQuestion` (`idQuestion`)
) ENGINE=InnoDB AUTO_INCREMENT=320 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `reponse`
--

INSERT INTO `reponse` (`idReponse`, `idEvaluation`, `idQuestion`, `valeurReponse`) VALUES
(269, 59, 38, '-1'),
(270, 59, 49, '5'),
(271, 59, 39, 'votre réponse'),
(272, 59, 41, '5'),
(273, 59, 40, '5'),
(274, 59, 42, 'pas mal'),
(275, 59, 44, '5'),
(276, 59, 43, '4'),
(277, 59, 45, 'super motivé'),
(281, 59, 47, '5'),
(282, 59, 46, '3'),
(283, 59, 48, 'peu s\'améliorer'),
(284, 61, 38, '-1'),
(285, 61, 49, '-1'),
(286, 61, 39, 'votre réponse'),
(287, 61, 41, '-1'),
(288, 61, 40, '-1'),
(289, 61, 42, 'votre réponse'),
(290, 61, 44, '-1'),
(291, 61, 43, '-1'),
(292, 61, 45, 'votre réponse'),
(293, 61, 47, '-1'),
(294, 61, 46, '-1'),
(295, 61, 48, 'votre réponse'),
(296, 62, 38, '-1'),
(297, 62, 49, '-1'),
(298, 62, 39, 'votre réponse'),
(299, 62, 41, '-1'),
(300, 62, 40, '-1'),
(301, 62, 42, 'votre réponse'),
(302, 62, 44, '-1'),
(303, 62, 43, '-1'),
(304, 62, 45, 'votre réponse'),
(305, 62, 47, '-1'),
(306, 62, 46, '-1'),
(307, 62, 48, 'votre réponse'),
(308, 63, 38, '5'),
(309, 63, 49, '4'),
(310, 63, 39, 'ravi'),
(311, 63, 41, '3'),
(312, 63, 40, '3'),
(313, 63, 42, 'bien'),
(314, 63, 44, '5'),
(315, 63, 43, '5'),
(316, 63, 45, 'trés bien'),
(317, 63, 47, '5'),
(318, 63, 46, '5'),
(319, 63, 48, 'Bien intégré');

-- --------------------------------------------------------

--
-- Structure de la table `role`
--

DROP TABLE IF EXISTS `role`;
CREATE TABLE IF NOT EXISTS `role` (
  `idRole` int(1) NOT NULL,
  `designation` varchar(50) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idRole`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `role`
--

INSERT INTO `role` (`idRole`, `designation`) VALUES
(0, 'admin'),
(1, 'formateur'),
(2, 'superAdmin');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `idUser` int(5) NOT NULL AUTO_INCREMENT,
  `idRole` int(1) DEFAULT NULL,
  `nomUser` varchar(50) COLLATE utf8_bin NOT NULL,
  `prenomUser` varchar(50) COLLATE utf8_bin DEFAULT NULL,
  `emailUser` varchar(50) COLLATE utf8_bin NOT NULL,
  `telephoneUser` varchar(10) COLLATE utf8_bin DEFAULT NULL,
  `codepostalUser` varchar(5) COLLATE utf8_bin DEFAULT NULL,
  `mdpUser` varchar(250) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`idUser`),
  KEY `idRole` (`idRole`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`idUser`, `idRole`, `nomUser`, `prenomUser`, `emailUser`, `telephoneUser`, `codepostalUser`, `mdpUser`) VALUES
(1, 2, 'Jerez', 'Christophe', 'jc@gmail.com', '0621458686', '84300', '$2y$10$ogP0ZRJ0GHfX5IAmbZPFRuByNNQMuTJXnLXaFpb8lVBXADEDh3AlW'),
(2, 1, ' Dujardin', 'Jean', 'jeandj@gmail.com', '0623568645', '17564', '$2y$10$bZpOXOekH3f712j8j88Mde.LYkkEJmjS0s0eikxrNFP49T0YexrhG'),
(3, 1, 'Echtebest', 'Philippe', 'philoudu13@gmail.com', '0666698945', '13000', '0'),
(13, 1, 'Michelle', 'tzétzé', 'jcvd@aware.com', '0621454545', '84300', '$2y$10$LtIXwSrImFchCxfWhLkb4.MPm.QYQ/Q7/cPbnWtgsi3YuGs.7WBM.'),
(23, 1, 'Shakira', 'sha', 'sha@gmail.com', '0656782642', '38000', '$2y$10$1zz92U7ckKqbQHazmlrWMeNofGN/u6MPrwfBrtX6YkP0OVXfImPKe'),
(26, 1, 'kiri', 'ff', 'jc@gmail.com', '0621785206', '87650', '$2y$10$fSVV2Xsf1MjgfVcMz9YFVerkOeAj9UWTn4GiQSR8a4P/2HkZBK1aK'),
(29, 0, 'Lebanc', NULL, 'leblanc@gmail.com', NULL, NULL, '$2y$10$RiJjW3J.bY.omIQ4LeTD3uZoMaL6I2s4cfltNIUYBGBRkgTrWEAkS'),
(30, 0, 'maitre', NULL, 'maitre@gmail.com', NULL, NULL, '$2y$10$LxQ/4Nv8cEGymrjke8R3Gewce4rZnq8m3fTLnM11QAI4BYygXftxy'),
(35, 1, 'Lignac', 'Cyril', 'lignac@gmail.com', '0606859565', '75000', '$2y$10$mt4SJVSZ6VnvlCKayMXxAeDarf.Kz6a58vUkAOZpI..TvVIjAS9Om'),
(36, 1, 'sofiane', NULL, 'sofiane@gmail.com', NULL, NULL, '$2y$10$tjEHDIhdYO2M1XSz2VmVGOiguDBrguyJ.1u.Ojo3u8jhdVustV30u');

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `apprenant`
--
ALTER TABLE `apprenant`
  ADD CONSTRAINT `apprenant_ibfk_1` FOREIGN KEY (`idFormation`) REFERENCES `formation` (`idFormation`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Contraintes pour la table `en_charge`
--
ALTER TABLE `en_charge`
  ADD CONSTRAINT `en_charge_ibfk_2` FOREIGN KEY (`idFormation`) REFERENCES `formation` (`idFormation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `en_charge_ibfk_3` FOREIGN KEY (`idUser`) REFERENCES `user` (`idUser`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `evaluation`
--
ALTER TABLE `evaluation`
  ADD CONSTRAINT `evaluation_ibfk_1` FOREIGN KEY (`idApprenant`) REFERENCES `apprenant` (`idApprenant`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `question_ibfk_1` FOREIGN KEY (`idCategorie`) REFERENCES `categoriequestion` (`idCategorie`) ON UPDATE CASCADE,
  ADD CONSTRAINT `question_ibfk_2` FOREIGN KEY (`idQuestionnaire`) REFERENCES `questionnaire` (`idQuestionnaire`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `reponse_ibfk_1` FOREIGN KEY (`idEvaluation`) REFERENCES `evaluation` (`idEvaluation`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `reponse_ibfk_2` FOREIGN KEY (`idQuestion`) REFERENCES `question` (`idQuestion`) ON UPDATE CASCADE;

--
-- Contraintes pour la table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `user_ibfk_1` FOREIGN KEY (`idRole`) REFERENCES `role` (`idRole`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
