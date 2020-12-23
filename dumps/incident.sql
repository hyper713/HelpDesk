-- Adminer 4.7.8 MySQL dump

SET NAMES utf8;
SET time_zone = '+00:00';
SET foreign_key_checks = 0;
SET sql_mode = 'NO_AUTO_VALUE_ON_ZERO';

DROP DATABASE IF EXISTS `incidents`;
CREATE DATABASE `incidents` /*!40100 DEFAULT CHARACTER SET utf8 */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `incidents`;

DROP TABLE IF EXISTS `demande`;
CREATE TABLE `demande` (
  `id_dmd` int NOT NULL AUTO_INCREMENT,
  `titre` varchar(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `catgorie` varchar(11) NOT NULL,
  `priorite` varchar(11) NOT NULL,
  `etat` varchar(11) NOT NULL,
  `matricule` int NOT NULL,
  `date_dmd` date NOT NULL,
  PRIMARY KEY (`id_dmd`),
  KEY `matricule` (`matricule`),
  CONSTRAINT `demande_ibfk_1` FOREIGN KEY (`matricule`) REFERENCES `utilisateur` (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `intervention`;
CREATE TABLE `intervention` (
  `id_dmd` int NOT NULL,
  `id_tech` int NOT NULL,
  `date_intervention` date NOT NULL,
  PRIMARY KEY (`id_dmd`,`id_tech`),
  KEY `id_tech` (`id_tech`),
  CONSTRAINT `intervention_ibfk_1` FOREIGN KEY (`id_dmd`) REFERENCES `demande` (`id_dmd`),
  CONSTRAINT `intervention_ibfk_2` FOREIGN KEY (`id_tech`) REFERENCES `technicien` (`id_tech`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `technicien`;
CREATE TABLE `technicien` (
  `id_tech` int NOT NULL AUTO_INCREMENT,
  `commentaire` varchar(300) NOT NULL,
  `matricule` int NOT NULL,
  PRIMARY KEY (`id_tech`),
  KEY `matricule` (`matricule`),
  CONSTRAINT `technicien_ibfk_1` FOREIGN KEY (`matricule`) REFERENCES `utilisateur` (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


DROP TABLE IF EXISTS `utilisateur`;
CREATE TABLE `utilisateur` (
  `matricule` int NOT NULL AUTO_INCREMENT,
  `nom` varchar(200) NOT NULL,
  `prenom` varchar(200) NOT NULL,
  `login` varchar(200) NOT NULL,
  `mdp` varchar(200) NOT NULL,
  PRIMARY KEY (`matricule`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


-- 2020-12-17 10:00:53
