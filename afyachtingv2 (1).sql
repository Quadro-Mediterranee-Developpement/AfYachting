-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  lun. 13 juil. 2020 à 14:00
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
-- Base de données :  `afyachtingv2`
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
  `valide` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`ID`, `Username`, `Password`, `Mail`, `Creation`, `Phone`, `valide`) VALUES
(1, 'Admin@12', '1ee6426845a223d3622f39b86a7efadfd6e41dc5', 'Admin@12.com', '2020-06-02 22:00:00', '0652565620', '0');

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
  `Password` tinyint(1) NOT NULL DEFAULT '1',
  `ID_Images` int(11) DEFAULT NULL,
  `ID_Vente` int(11) NOT NULL,
  `ID_Location` int(11) NOT NULL,
  `ID_entreprise` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bateau`
--

INSERT INTO `bateau` (`ID`, `Description`, `Nom`, `Modele`, `Passagers`, `Moteur`, `Longueur`, `Equipement`, `Divers`, `Password`, `ID_Images`, `ID_Vente`, `ID_Location`, `ID_entreprise`) VALUES
(1, 'un grand bateau', 'LeGrandLarge', 'rigide', 5, 'turboBoost56', 65, 'coque;voile;frigo;', 'c\'est un bat', 1, 1, 1, 1, 0),
(2, 'yjuki', 'rtyjukil', 'rigide', 55, '(t\'y-uèi', 55, 'rdfbg', 'efrgt', 1, 2, 0, 0, 0),
(3, 'bateau', 'bateau', 'bateau', 6, 'bateau', 6, 'bateau', '8', 1, 3, 0, 0, 0),
(4, 'bateau', 'bateau', 'bateau', 5, 'bateau', 6, 'bateau', 'bateau', 1, 4, 0, 0, 0),
(5, 'bateau', 'bateau', 'bateau', 5, 'bateau', 6, 'bateau', 'bateau', 1, 5, 0, 0, 0),
(6, 'wwsdzefrgthyjukilomom', 'le corcaire', 'semi', 455, 'zdefrgthyj', 545, 'coque;voile;frigo;', 'bateau', 1, 6, 0, 0, 1);

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
  `valide` text CHARACTER SET latin1 COLLATE latin1_swedish_ci,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID`, `Username`, `Password`, `Mail`, `Creation`, `Phone`, `valide`) VALUES
(16, 'Client@12', 'a12e173daeb63ccd9d5fd657110d3238a8c77ac8', 'Client@12.com', '2020-06-14 14:00:10', '0606060606', '0');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `entreprise`
--

DROP TABLE IF EXISTS `entreprise`;
CREATE TABLE IF NOT EXISTS `entreprise` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Username` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Password` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Mail` varchar(50) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `Creation` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Phone` varchar(25) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `valide` text CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `entreprise`
--

INSERT INTO `entreprise` (`ID`, `Username`, `Password`, `Mail`, `Creation`, `Phone`, `valide`) VALUES
(1, 'Entreprise@12', '4a6db3a793438d31cd3508e25b95dbe8df062395', 'Entreprise@12.com', '2020-07-10 09:52:59', '0000000000', '0');

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
  `ID_routageoptionevenement` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`ID`, `Start`, `Stop`, `Total`, `State`, `Note`, `Start_Override`, `Stop_Override`, `ID_Admin`, `ID_Skipper`, `ID_Client`, `ID_Client_Ponctuel`, `ID_Bateau`, `ID_routageoptionevenement`) VALUES
(1, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '559562.000', 'départ en bateau', 'rdv skipper 7h devant le port + embarcation 8h', '2020-06-23 06:00:00', '2020-06-23 12:00:00', 1, 2, 16, 0, 1, 0),
(2, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '559562.000', 'départ en bateau', 'rdv skipper 7h devant le port + embarcation 8h', '2020-06-24 06:00:00', '2020-06-24 12:00:00', 1, 2, 16, 0, 1, 0),
(3, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '559562.000', 'départ en bateau', 'rdv skipper 7h devant le port + embarcation 8h', '2020-06-24 13:00:00', '2020-06-24 16:00:00', 1, 2, 16, 0, 1, 0),
(4, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '559562.000', 'départ en bateau', 'rdv skipper 7h devant le port + embarcation 8h', '2020-06-25 13:00:00', '2020-06-25 16:00:00', 1, 2, 16, 0, 1, 0),
(5, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '559562.000', 'départ en bateau', 'rdv skipper 7h devant le port + embarcation 8h', '2020-06-26 08:00:00', '2020-06-26 16:00:00', 1, 2, 16, 0, 1, 0),
(6, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '500.000', 'depart midi apres midi', 'un boat', '2020-07-15 06:00:00', '2020-07-15 09:59:00', 1, 2, 16, 0, 1, 0),
(7, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0.000', 'un texte', 'sdvfbgnh,j;k', '2020-07-17 09:06:00', '2020-07-17 09:06:00', 1, 2, 0, 0, 6, 0);

-- --------------------------------------------------------

--
-- Structure de la table `images`
--

DROP TABLE IF EXISTS `images`;
CREATE TABLE IF NOT EXISTS `images` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Url` varchar(65) NOT NULL,
  `Alt_Description` varchar(65) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci NOT NULL,
  `ID_select` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`ID`, `Url`, `Alt_Description`, `ID_select`) VALUES
(7, '../img/bateau/(1)Capture.PNG', 'un truc marrant', 1),
(6, '../img/bateau/Capture.PNG', 'url', 1),
(8, '../img/bateau/(2)Capture.PNG', 'sazdfgh', 6),
(9, '../img/bateau/téléchargement.jpg', 'un airet d r', 6);

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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `location`
--

INSERT INTO `location` (`ID`, `HS`, `MS`, `BS`, `Caution`) VALUES
(1, '120.000', '110.000', '100.000', '500.000');

-- --------------------------------------------------------

--
-- Structure de la table `option_boat`
--

DROP TABLE IF EXISTS `option_boat`;
CREATE TABLE IF NOT EXISTS `option_boat` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(65) NOT NULL,
  `Description` text NOT NULL,
  `Prix` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `option_boat`
--

INSERT INTO `option_boat` (`ID`, `Name`, `Description`, `Prix`) VALUES
(1, 'volant', 'c\'est pratique pour conduire', 235),
(2, 'ocean', 'c\'est en option', 12);

-- --------------------------------------------------------

--
-- Structure de la table `routageimage`
--

DROP TABLE IF EXISTS `routageimage`;
CREATE TABLE IF NOT EXISTS `routageimage` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `routageimage`
--

INSERT INTO `routageimage` (`ID`) VALUES
(1),
(2),
(3),
(4),
(5),
(6);

-- --------------------------------------------------------

--
-- Structure de la table `routageoption`
--

DROP TABLE IF EXISTS `routageoption`;
CREATE TABLE IF NOT EXISTS `routageoption` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Bateau` int(11) NOT NULL,
  `ID_Option` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `routageoption`
--

INSERT INTO `routageoption` (`ID`, `ID_Bateau`, `ID_Option`) VALUES
(1, 1, 1),
(2, 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `routageoptionevenement`
--

DROP TABLE IF EXISTS `routageoptionevenement`;
CREATE TABLE IF NOT EXISTS `routageoptionevenement` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Evenement` int(11) NOT NULL,
  `ID_Option` int(11) NOT NULL,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

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
  `valide` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `skipper`
--

INSERT INTO `skipper` (`ID`, `Username`, `Password`, `Mail`, `Creation`, `Phone`, `valide`) VALUES
(2, 'Skipper@12', '693e0eb587013a66c8f315411737469229ad4111', 'Skipper@12.com', '2020-06-14 13:59:17', '0606060606', '0');

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
  PRIMARY KEY (`ID`)
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `vente`
--

INSERT INTO `vente` (`ID`, `Age`, `State`, `Largeur`, `Prix`) VALUES
(1, 2012, 'tout neuf', 32, '55658.000');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
