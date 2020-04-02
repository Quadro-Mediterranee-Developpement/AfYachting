-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  jeu. 02 avr. 2020 à 08:04
-- Version du serveur :  5.7.26
-- Version de PHP :  7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `AfYachting`
--

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

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `evenement`
--
ALTER TABLE `evenement`
  ADD CONSTRAINT `FK_Evenement_ID_Admin` FOREIGN KEY (`ID_Admin`) REFERENCES `admin` (`ID`),
  ADD CONSTRAINT `FK_Evenement_ID_Bateau` FOREIGN KEY (`ID_Bateau`) REFERENCES `bateau` (`ID`),
  ADD CONSTRAINT `FK_Evenement_ID_Client` FOREIGN KEY (`ID_Client`) REFERENCES `client` (`ID`),
  ADD CONSTRAINT `FK_Evenement_ID_Client_Ponctuel` FOREIGN KEY (`ID_Client_Ponctuel`) REFERENCES `client_ponctuel` (`ID`),
  ADD CONSTRAINT `FK_Evenement_ID_Skipper` FOREIGN KEY (`ID_Skipper`) REFERENCES `skipper` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
