-- phpMyAdmin SQL Dump
-- version 4.1.12
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mar 06 Mai 2014 à 21:51
-- Version du serveur :  5.6.16
-- Version de PHP :  5.5.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `enquetes`
--

-- --------------------------------------------------------

--
-- Structure de la table `enquete`
--

CREATE TABLE IF NOT EXISTS `enquete` (
  `ID_ENQUETE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_UTILISATEUR` int(11) NOT NULL,
  `TITRE` varchar(255) NOT NULL,
  `DESCRIPTION` varchar(512) DEFAULT NULL,
  PRIMARY KEY (`ID_ENQUETE`),
  KEY `FK_CREER` (`ID_UTILISATEUR`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `qcm`
--

CREATE TABLE IF NOT EXISTS `qcm` (
  `ID_QCM` int(11) NOT NULL AUTO_INCREMENT,
  `ID_QUESTION` int(11) NOT NULL,
  `VALEUR_QCM` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`ID_QCM`),
  KEY `FK_A_POUR_VALEUR_QCM` (`ID_QUESTION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `question`
--

CREATE TABLE IF NOT EXISTS `question` (
  `ID_QUESTION` int(11) NOT NULL AUTO_INCREMENT,
  `ID_ENQUETE` int(11) NOT NULL,
  `ID_TYPE_QUESTION` int(11) NOT NULL,
  `LIBELLE_QUESTION` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_QUESTION`),
  KEY `FK_EST_COMPOSEE` (`ID_ENQUETE`),
  KEY `FK_EST_DE_TYPE` (`ID_TYPE_QUESTION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `reponse`
--

CREATE TABLE IF NOT EXISTS `reponse` (
  `ID_REPONSE` int(11) NOT NULL AUTO_INCREMENT,
  `ID_QUESTION` int(11) NOT NULL,
  `VALEUR_REPONSE` varchar(512) NOT NULL,
  `UNIQUE_USER_ID` varchar(128) NOT NULL,
  PRIMARY KEY (`ID_REPONSE`),
  KEY `FK_REPOND_A_LA_QUESTION` (`ID_QUESTION`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `type_question`
--

CREATE TABLE IF NOT EXISTS `type_question` (
  `ID_TYPE_QUESTION` int(11) NOT NULL AUTO_INCREMENT,
  `LIBELLE_TYPE_QUESTION` varchar(255) NOT NULL,
  PRIMARY KEY (`ID_TYPE_QUESTION`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `type_question`
--

INSERT INTO `type_question` (`ID_TYPE_QUESTION`, `LIBELLE_TYPE_QUESTION`) VALUES
(1, 'Texte'),
(2, 'Nombre'),
(3, 'QCM');

-- --------------------------------------------------------

--
-- Structure de la table `utilisateur`
--

CREATE TABLE IF NOT EXISTS `utilisateur` (
  `ID_UTILISATEUR` int(11) NOT NULL AUTO_INCREMENT,
  `NOM` varchar(255) NOT NULL,
  `PRENOM` varchar(255) NOT NULL,
  `EMAIL` varchar(255) NOT NULL,
  `PASSWORD` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_UTILISATEUR`),
  UNIQUE KEY `EMAIL` (`EMAIL`),
  KEY `AK_IDENTIFIER_2` (`EMAIL`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `enquete`
--
ALTER TABLE `enquete`
  ADD CONSTRAINT `FK_CREER` FOREIGN KEY (`ID_UTILISATEUR`) REFERENCES `utilisateur` (`ID_UTILISATEUR`);

--
-- Contraintes pour la table `qcm`
--
ALTER TABLE `qcm`
  ADD CONSTRAINT `FK_A_POUR_VALEUR_QCM` FOREIGN KEY (`ID_QUESTION`) REFERENCES `question` (`ID_QUESTION`);

--
-- Contraintes pour la table `question`
--
ALTER TABLE `question`
  ADD CONSTRAINT `FK_EST_DE_TYPE` FOREIGN KEY (`ID_TYPE_QUESTION`) REFERENCES `type_question` (`ID_TYPE_QUESTION`),
  ADD CONSTRAINT `FK_EST_COMPOSEE` FOREIGN KEY (`ID_ENQUETE`) REFERENCES `enquete` (`ID_ENQUETE`);

--
-- Contraintes pour la table `reponse`
--
ALTER TABLE `reponse`
  ADD CONSTRAINT `FK_REPOND_A_LA_QUESTION` FOREIGN KEY (`ID_QUESTION`) REFERENCES `question` (`ID_QUESTION`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
