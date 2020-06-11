-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  mer. 10 juin 2020 à 12:23
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
(1, 'Admin@12', '1ee6426845a223d3622f39b86a7efadfd6e41dc5', 'Admin@12.com', '2020-06-02 22:00:00', '0652565620', '0'),
(2, 'Admin', '1ee6426845a223d3622f39b86a7efadfd6e41dc5', 'Admin@12gg.Com', '2020-06-09 06:41:59', '0656822465', '??^n?U?');

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
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `bateau`
--

INSERT INTO `bateau` (`ID`, `Description`, `Nom`, `Modele`, `Passagers`, `Moteur`, `Longueur`, `Equipement`, `Divers`, `Password`, `ID_Images`, `ID_Vente`, `ID_Location`) VALUES
(1, 'gg', 'gg', 'gg', 4, 'gg', 4, 'gg', 'gg', 1, 1, 0, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client`
--

INSERT INTO `client` (`ID`, `Username`, `Password`, `Mail`, `Creation`, `Phone`, `valide`) VALUES
(1, 'hugohuu', NULL, 'hugo.hugoo@gmail.com', NULL, '', '0'),
(2, 'hugoop', NULL, 'hugoop@gmail.com', NULL, '', '0'),
(3, 'hugoope', NULL, 'hugoop@gmail.come', NULL, '', '0'),
(4, 'hugoopee', NULL, 'hugoop@gmail.comee', NULL, '', '0'),
(5, 'efrgthy', NULL, 'unemail@email.com', NULL, '', '0'),
(6, 'hughh', NULL, 'hughh@hughh.com', NULL, '', '0'),
(7, 'yy', NULL, 'yy.yy@gmail.com', '2020-06-05 12:07:52', '', '0'),
(8, 'hugo', NULL, 'f.g@gmail.com', '2020-06-08 10:02:25', '', '0'),
(9, 'H1@gmail.com', 'cca5153240d5f5d61ea46258bf47fec12b547e98', 'H1@gmail.com', '2020-06-08 10:03:54', '', '0'),
(10, 'H1', 'cca5153240d5f5d61ea46258bf47fec12b547e98', 'H1@gmail.com', '2020-06-08 10:04:09', '', '0'),
(11, 'hugo9', NULL, 'H1@gmail.co', '2020-06-08 10:05:09', '', '0'),
(12, 'huho', NULL, 'huho@huho.fr', '2020-06-08 10:17:15', '', '0'),
(13, 'hhhh', NULL, 'hugo.hugo@gmail.com', '2020-06-08 16:44:37', '', '0'),
(14, 'New@12.00', NULL, 'New@12.com', '2020-06-08 16:52:42', '', '0'),
(15, 'Pop20.salut', NULL, 'hugo.musoles@gmail.com', '2020-06-08 20:34:19', '', '0');

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
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `client_ponctuel`
--

INSERT INTO `client_ponctuel` (`ID`, `Username`, `Mail`, `Creation`, `Phone`) VALUES
(1, 'hugo', 'hugo.hugo@gmail.Com', NULL, NULL),
(2, 'hugo', 'hugo@gmail.com', '2020-06-05 12:29:46', NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `evenement`
--

INSERT INTO `evenement` (`ID`, `Start`, `Stop`, `Total`, `State`, `Note`, `Start_Override`, `Stop_Override`, `ID_Admin`, `ID_Skipper`, `ID_Client`, `ID_Client_Ponctuel`, `ID_Bateau`, `ID_routageoptionevenement`) VALUES
(11, '0000-00-00 00:00:00', '0000-00-00 00:00:00', NULL, 'zertyu', 'zertyukil', '2020-06-09 10:52:00', '2020-06-09 10:52:00', 0, 0, 0, 0, 0, 1),
(12, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '555.000', 'klmù', 'hujikolpm', '2020-06-09 13:08:00', '2020-06-09 13:08:00', 1, 1, 1, 0, 0, 0),
(13, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5956.000', 'un salut', 'whechfergthyjuil', '2020-06-09 14:08:00', '2020-06-09 14:08:00', 1, 1, 8, 1, 0, 0),
(14, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '0.000', 'fffffff', '', '2020-06-09 20:52:00', '2020-06-18 20:52:00', 0, 0, 0, 0, 0, 0),
(15, '0000-00-00 00:00:00', '0000-00-00 00:00:00', '5555.000', 'teste3', 'oui non peut etre', '2020-06-11 12:42:00', '2020-06-11 12:42:00', 2, 1, 15, 1, 1, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `images`
--

INSERT INTO `images` (`ID`, `Url`, `Alt_Description`, `ID_select`) VALUES
(1, 'boat1.png', 'hh', 1),
(2, 'boat2.png', 'oo', 1);

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

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
(1, 'yo', 'yooo', 5),
(2, 'oui', 'non', 6);

-- --------------------------------------------------------

--
-- Structure de la table `routageimage`
--

DROP TABLE IF EXISTS `routageimage`;
CREATE TABLE IF NOT EXISTS `routageimage` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`ID`)
) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `routageimage`
--

INSERT INTO `routageimage` (`ID`) VALUES
(1),
(2);

-- --------------------------------------------------------

--
-- Structure de la table `routageoption`
--

DROP TABLE IF EXISTS `routageoption`;
CREATE TABLE IF NOT EXISTS `routageoption` (
  `ID_Bateau` int(11) NOT NULL,
  `ID_Option` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `routageoption`
--

INSERT INTO `routageoption` (`ID_Bateau`, `ID_Option`) VALUES
(1, 1);

-- --------------------------------------------------------

--
-- Structure de la table `routageoptionevenement`
--

DROP TABLE IF EXISTS `routageoptionevenement`;
CREATE TABLE IF NOT EXISTS `routageoptionevenement` (
  `ID_Evenement` int(11) NOT NULL,
  `ID_Option` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Déchargement des données de la table `routageoptionevenement`
--

INSERT INTO `routageoptionevenement` (`ID_Evenement`, `ID_Option`) VALUES
(1, 2);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `skipper`
--

INSERT INTO `skipper` (`ID`, `Username`, `Password`, `Mail`, `Creation`, `Phone`, `valide`) VALUES
(1, 'Skipper@12.', '9b9ffaa57a745f661ed7e9ceace1a48ec8daf802', 'Skipper@12.com', '2020-06-09 06:43:23', '6666666666', '0');

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
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
