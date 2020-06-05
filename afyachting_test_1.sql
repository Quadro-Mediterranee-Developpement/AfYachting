-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  ven. 05 juin 2020 à 12:10
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
-- Base de données :  `afyachting`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Mail` varchar(50) DEFAULT NULL,
  `Creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Phone` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`ID`, `Username`, `Password`, `Mail`, `Creation`, `Phone`) VALUES
(1, 'hugo', 'eee729d0fa4d59ae5a513061bc16ba42198cb9b1', 'hugo.hugo@gmail.com', '2020-06-02 22:00:00', 'hugo');

-- --------------------------------------------------------

--
-- Structure de la table `bateau`
--

DROP TABLE IF EXISTS `bateau`;
CREATE TABLE IF NOT EXISTS `bateau` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Description` longtext,
  `Nom` varchar(50) DEFAULT NULL,
  `Modele` varchar(50) DEFAULT NULL,
  `Passagers` int(11) DEFAULT NULL,
  `Moteur` tinytext,
  `Longueur` float DEFAULT NULL,
  `Equipement` longtext,
  `Divers` longtext,
  `Images` longtext,
  `ID_Vente` int(11) NOT NULL,
  `ID_Location` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Bateau_ID_Vente` (`ID_Vente`),
  KEY `FK_Bateau_ID_Location` (`ID_Location`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `client`
--

DROP TABLE IF EXISTS `client`;
CREATE TABLE IF NOT EXISTS `client` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Mail` varchar(50) DEFAULT NULL,
  `Creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Phone` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID`, `Username`, `Password`, `Mail`, `Creation`, `Phone`) VALUES
(1, 'hugohuu', '529a6b923e382614ddda1e768428061465712a44', 'hugo.hugoo@gmail.com', NULL, ''),
(2, 'hugoop', '2e71a418c35ec3b1c39a2e6e3f5850bff9ee08f5', 'hugoop@gmail.com', NULL, ''),
(3, 'hugoope', '2e71a418c35ec3b1c39a2e6e3f5850bff9ee08f5', 'hugoop@gmail.come', NULL, ''),
(4, 'hugoopee', 'af9add22cf5127c342cfb2ddbc230f4baab3ccac', 'hugoop@gmail.comee', NULL, ''),
(5, 'efrgthy', 'dbaa30de22b1129ec140a188fc3c06a6af8e9f1f', 'unemail@email.com', NULL, ''),
(6, 'hughh', '8b55feb9bb3828a53041873529ba209ab26053a6', 'hughh@hughh.com', NULL, ''),
(7, 'yy', '2598804bf38733deaf83708315745aa360006701', 'yy.yy@gmail.com', '2020-06-05 12:07:52', '');

-- --------------------------------------------------------

--
-- Structure de la table `client_ponctuel`
--

DROP TABLE IF EXISTS `client_ponctuel`;
CREATE TABLE IF NOT EXISTS `client_ponctuel` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Mail` varchar(50) DEFAULT NULL,
  `Creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Phone` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client_ponctuel`
--

INSERT INTO `client_ponctuel` (`ID`, `Username`, `Mail`, `Creation`, `Phone`) VALUES
(1, 'hugo', 'hugo.hugo@gmail.Com', NULL, NULL);

-- --------------------------------------------------------

--
-- Structure de la table `evenement`
--

DROP TABLE IF EXISTS `evenement`;
CREATE TABLE IF NOT EXISTS `evenement` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Start` timestamp NOT NULL,
  `Stop` timestamp NOT NULL,
  `Total` decimal(15,3) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Note` mediumtext,
  `Start_Override` timestamp NULL DEFAULT NULL,
  `Stop_Override` timestamp NULL DEFAULT NULL,
  `ID_Admin` int(11) NOT NULL,
  `ID_Skipper` int(11) NOT NULL,
  `ID_Client` int(11) NOT NULL,
  `ID_Client_Ponctuel` int(11) NOT NULL,
  `ID_Bateau` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Evenement_ID_Admin` (`ID_Admin`),
  KEY `FK_Evenement_ID_Skipper` (`ID_Skipper`),
  KEY `FK_Evenement_ID_Client` (`ID_Client`),
  KEY `FK_Evenement_ID_Client_Ponctuel` (`ID_Client_Ponctuel`),
  KEY `FK_Evenement_ID_Bateau` (`ID_Bateau`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `location`
--

DROP TABLE IF EXISTS `location`;
CREATE TABLE IF NOT EXISTS `location` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `HS` decimal(15,3) DEFAULT NULL,
  `MS` decimal(15,3) DEFAULT NULL,
  `BS` decimal(15,3) DEFAULT NULL,
  `Caution` decimal(15,3) DEFAULT NULL,
  `ID_Skipper` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Location_ID_Skipper` (`ID_Skipper`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `skipper`
--

DROP TABLE IF EXISTS `skipper`;
CREATE TABLE IF NOT EXISTS `skipper` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) DEFAULT NULL,
  `Password` varchar(50) DEFAULT NULL,
  `Mail` varchar(50) DEFAULT NULL,
  `Creation` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `Phone` varchar(25) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `validation`
--

DROP TABLE IF EXISTS `validation`;
CREATE TABLE IF NOT EXISTS `validation` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Code` varchar(25) DEFAULT NULL,
  `Type` tinyint(1) DEFAULT NULL,
  `Creation` timestamp NULL DEFAULT NULL,
  `ID_Client` int(11) NOT NULL,
  `ID_Skipper` int(11) NOT NULL,
  `ID_Admin` int(11) NOT NULL,
  PRIMARY KEY (`ID`),
  KEY `FK_Validation_ID_Client` (`ID_Client`),
  KEY `FK_Validation_ID_Skipper` (`ID_Skipper`),
  KEY `FK_Validation_ID_Admin` (`ID_Admin`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `vente`
--

DROP TABLE IF EXISTS `vente`;
CREATE TABLE IF NOT EXISTS `vente` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Age` year(4) DEFAULT NULL,
  `State` varchar(50) DEFAULT NULL,
  `Largeur` float DEFAULT NULL,
  `Prix` decimal(15,3) DEFAULT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `bateau`
--
ALTER TABLE `bateau`
  ADD CONSTRAINT `FK_Bateau_ID_Location` FOREIGN KEY (`ID_Location`) REFERENCES `location` (`ID`),
  ADD CONSTRAINT `FK_Bateau_ID_Vente` FOREIGN KEY (`ID_Vente`) REFERENCES `vente` (`ID`);

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_Evenement_ID_Admin` FOREIGN KEY (`ID_Admin`) REFERENCES `admin` (`ID`),
  ADD CONSTRAINT `FK_Evenement_ID_Bateau` FOREIGN KEY (`ID_Bateau`) REFERENCES `bateau` (`ID`),
  ADD CONSTRAINT `FK_Evenement_ID_Client` FOREIGN KEY (`ID_Client`) REFERENCES `client` (`ID`),
  ADD CONSTRAINT `FK_Evenement_ID_Client_Ponctuel` FOREIGN KEY (`ID_Client_Ponctuel`) REFERENCES `client_ponctuel` (`ID`),
  ADD CONSTRAINT `FK_Evenement_ID_Skipper` FOREIGN KEY (`ID_Skipper`) REFERENCES `skipper` (`ID`);

--
-- Contraintes pour la table `location`
--
ALTER TABLE `location`
  ADD CONSTRAINT `FK_Location_ID_Skipper` FOREIGN KEY (`ID_Skipper`) REFERENCES `skipper` (`ID`);

--
-- Contraintes pour la table `validation`
--
ALTER TABLE `validation`
  ADD CONSTRAINT `FK_Validation_ID_Admin` FOREIGN KEY (`ID_Admin`) REFERENCES `admin` (`ID`),
  ADD CONSTRAINT `FK_Validation_ID_Client` FOREIGN KEY (`ID_Client`) REFERENCES `client` (`ID`),
  ADD CONSTRAINT `FK_Validation_ID_Skipper` FOREIGN KEY (`ID_Skipper`) REFERENCES `skipper` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
