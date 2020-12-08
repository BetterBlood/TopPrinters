-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 01 Décembre 2020 à 13:42
-- Version du serveur :  5.7.11
-- Version de PHP :  7.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `db_printer`
--
create database db_printer;
use db_printer;-- --------------------------------------------------------

--
-- Structure de la table `t_maker`
--

CREATE TABLE `t_maker` (
  `idMaker` int(10) UNSIGNED NOT NULL,
  `marName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_mark`
--

CREATE TABLE `t_mark` (
  `idMark` int(10) UNSIGNED NOT NULL,
  `marName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_printer`
--

CREATE TABLE `t_printer` (
  `idPrinter` int(10) UNSIGNED NOT NULL,
  `priModel` varchar(50) NOT NULL,
  `priPrintingSpeed` mediumint(8) UNSIGNED NOT NULL,
  `priCapacity` mediumint(8) UNSIGNED NOT NULL,
  `priWeight` mediumint(8) UNSIGNED NOT NULL,
  `priResolution` mediumint(8) UNSIGNED NOT NULL,
  `priWidth` mediumint(8) UNSIGNED NOT NULL,
  `priLength` mediumint(8) UNSIGNED NOT NULL,
  `priHeight` mediumint(8) UNSIGNED NOT NULL,
  `idMaker` int(10) UNSIGNED DEFAULT NULL,
  `idMark` int(10) UNSIGNED DEFAULT NULL,
  `idTechnology` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `t_technology`
--

CREATE TABLE `t_technology` (
  `idTechnology` int(10) UNSIGNED NOT NULL,
  `tecName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Index pour les tables exportées
--

--
-- Index pour la table `t_maker`
--
ALTER TABLE `t_maker`
  ADD PRIMARY KEY (`idMaker`);

--
-- Index pour la table `t_mark`
--
ALTER TABLE `t_mark`
  ADD PRIMARY KEY (`idMark`);

--
-- Index pour la table `t_printer`
--
ALTER TABLE `t_printer`
  ADD PRIMARY KEY (`idPrinter`),
  ADD KEY `idMaker` (`idMaker`),
  ADD KEY `idMark` (`idMark`),
  ADD KEY `idTechnology` (`idTechnology`);

--
-- Index pour la table `t_technology`
--
ALTER TABLE `t_technology`
  ADD PRIMARY KEY (`idTechnology`);

--
-- AUTO_INCREMENT pour les tables exportées
--

--
-- AUTO_INCREMENT pour la table `t_maker`
--
ALTER TABLE `t_maker`
  MODIFY `idMaker` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_mark`
--
ALTER TABLE `t_mark`
  MODIFY `idMark` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_printer`
--
ALTER TABLE `t_printer`
  MODIFY `idPrinter` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT pour la table `t_technology`
--
ALTER TABLE `t_technology`
  MODIFY `idTechnology` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Contraintes pour les tables exportées
--

--
-- Contraintes pour la table `t_printer`
--
ALTER TABLE `t_printer`
  ADD CONSTRAINT `t_printer_ibfk_1` FOREIGN KEY (`idMaker`) REFERENCES `t_maker` (`idMaker`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `t_printer_ibfk_2` FOREIGN KEY (`idTechnology`) REFERENCES `t_technology` (`idTechnology`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `t_printer_ibfk_3` FOREIGN KEY (`idMark`) REFERENCES `t_mark` (`idMark`) ON DELETE SET NULL ON UPDATE SET NULL;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
