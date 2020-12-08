-- phpMyAdmin SQL Dump
-- version 4.5.4.1
-- http://www.phpmyadmin.net
--
-- Client :  localhost
-- Généré le :  Mar 08 Décembre 2020 à 12:42
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
  `makName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_maker`
--

INSERT INTO `t_maker` (`idMaker`, `makName`) VALUES
(2, 'HP'),
(3, 'Canon'),
(4, 'Epson'),
(5, 'Lexmark'),
(6, 'Brother');

-- --------------------------------------------------------

--
-- Structure de la table `t_mark`
--

CREATE TABLE `t_mark` (
  `idMark` int(10) UNSIGNED NOT NULL,
  `marName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_mark`
--

INSERT INTO `t_mark` (`idMark`, `marName`) VALUES
(2, 'Lexmark'),
(3, 'HP'),
(4, 'Epson'),
(5, 'Canon'),
(6, 'Brother');

-- --------------------------------------------------------

--
-- Structure de la table `t_printer`
--

CREATE TABLE `t_printer` (
  `idPrinter` int(10) UNSIGNED NOT NULL,
  `priModel` varchar(50) NOT NULL,
  `priPrintingSpeed` float UNSIGNED NOT NULL,
  `priCapacity` mediumint(8) UNSIGNED NOT NULL,
  `priWeight` float UNSIGNED NOT NULL,
  `priResolutionX` mediumint(8) UNSIGNED NOT NULL,
  `priResolutionY` mediumint(8) UNSIGNED NOT NULL,
  `priWidth` float UNSIGNED NOT NULL,
  `priLength` float UNSIGNED NOT NULL,
  `priHeight` float UNSIGNED NOT NULL,
  `priPrice` float UNSIGNED NOT NULL,
  `idMaker` int(10) UNSIGNED DEFAULT NULL,
  `idMark` int(10) UNSIGNED DEFAULT NULL,
  `idTechnology` int(10) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_printer`
--

INSERT INTO `t_printer` (`idPrinter`, `priModel`, `priPrintingSpeed`, `priCapacity`, `priWeight`, `priResolutionX`, `priResolutionY`, `priWidth`, `priLength`, `priHeight`, `priPrice`, `idMaker`, `idMark`, `idTechnology`) VALUES
(43, 'Officejet Pro 8730 All-in-One', 24, 50, 15.2, 1200, 1200, 49.95, 44.97, 32.73, 300, 2, 3, 2),
(44, 'Officejet Pro 9020 All-In-One', 24, 500, 12, 1200, 1200, 43.7, 39.6, 31.8, 415, 2, 3, 2),
(45, 'LaserJet Pro MFP M28w ', 18, 150, 5.4, 600, 600, 36, 26.4, 19.7, 171, 2, 3, 3),
(46, 'DeskJet 3720 All-in-One Printer', 8, 60, 2.33, 1200, 1200, 40.3, 17.7, 14.1, 80, 2, 3, 2),
(47, 'Color Laser Jet Pro M255dw', 30, 250, 14.8, 600, 600, 39.2, 41.9, 24.7, 451, 2, 3, 3),
(48, 'I-SENSYS MF740', 27, 250, 26.7, 600, 600, 47.1, 46.9, 46, 565, 3, 5, 3),
(49, 'ET-2756 EcoTank', 33, 200, 5.5, 5760, 1400, 37.5, 18.7, 37.5, 317, 4, 4, 2),
(50, 'MC2425adw', 25, 250, 26.8, 1200, 1200, 44.2, 55.6, 46.2, 278, 5, 2, 4),
(51, 'M479fdn Color LaserJet Pro', 27, 300, 24.4, 600, 600, 47.2, 41.6, 40, 459, 2, 3, 4),
(52, 'M454dn Color LaserJet Pro', 27, 300, 18.9, 600, 600, 41.2, 46.9, 29.5, 352, 2, 3, 4),
(53, 'HL_L3230CDW', 18, 250, 18, 2400, 600, 46.1, 41, 25.2, 244, 6, 6, 4),
(54, 'ET-2710 EcoTank', 10, 100, 3.9, 5760, 1440, 34.7, 37.5, 17.9, 200, 4, 4, 2),
(55, 'DeskJet 2710 white', 7.5, 60, 5, 1200, 1200, 40, 35, 20, 50, 2, 3, 5),
(56, 'Officejet 7110 Wide Format A3', 15, 100, 58.5, 600, 600, 50, 40, 20, 159, 2, 3, 2),
(57, 'EcoTank ET-15000 Imprimante multifonction', 17, 270, 9.7, 1200, 2400, 49.8, 24.5, 35.8, 539, 4, 4, 2),
(58, 'DCP-L3510CDW', 18, 250, 21.7, 600, 2400, 41, 36.8, 47.5, 305, 6, 6, 4),
(59, 'M479dw Color LaserJet Pro', 27, 300, 21.8, 600, 600, 47.2, 41.6, 40, 395, 2, 3, 4),
(60, 'MC3326adwe', 24, 250, 23.02, 600, 600, 56, 43.5, 51.6, 267, 5, 2, 4),
(61, 'MC2535adwe', 33, 250, 27.1, 1200, 1200, 57.5, 55, 57, 457, 5, 2, 4),
(62, 'M183fw Color LaserJet Pro', 16, 150, 21.5, 600, 600, 50, 40, 50, 334, 2, 3, 4),
(63, 'PIXMA G6050 MegaTank', 13, 350, 11.8, 4800, 1200, 53, 50, 28, 330, 3, 5, 2),
(64, 'HL-L2350DW', 30, 250, 8.14, 2400, 600, 43, 28, 52, 120, 6, 6, 4),
(65, 'MFC-L8690CDW', 31, 300, 27.9, 2400, 600, 52.6, 43.5, 53.9, 459, 6, 6, 4),
(66, 'MF744Cdw i-Sensys', 27, 300, 26.5, 600, 600, 46.9, 47.1, 46, 459, 3, 5, 4),
(67, 'ET-3750 EcoTank', 15, 150, 9.72, 4800, 1200, 51, 41, 31.5, 384, 4, 4, 2),
(68, 'MFC-L2750DW', 34, 300, 12, 2400, 600, 41, 39.85, 31.85, 329, 6, 6, 4),
(69, 'OfficeJet Pro 9020', 24, 500, 14.36, 1200, 1200, 49, 50, 37.5, 273, 2, 3, 2),
(70, 'PIXMA TS8351', 15, 100, 6.6, 4800, 1200, 37.3, 31.9, 14.1, 100, 3, 5, 2),
(71, 'PIXMA TS5350', 13, 200, 6.3, 4800, 1200, 40.3, 31.5, 14.8, 60, 3, 5, 2),
(72, 'LaserJet Pro MFP M28w', 18, 150, 5.4, 600, 400, 36, 26.3, 19.6, 139, 2, 3, 3);

-- --------------------------------------------------------

--
-- Structure de la table `t_technology`
--

CREATE TABLE `t_technology` (
  `idTechnology` int(10) UNSIGNED NOT NULL,
  `tecName` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Contenu de la table `t_technology`
--

INSERT INTO `t_technology` (`idTechnology`, `tecName`) VALUES
(2, 'Jet d\'encre'),
(3, 'Laser'),
(4, 'Laser/LED'),
(5, 'Thermo');

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
  MODIFY `idMaker` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `t_mark`
--
ALTER TABLE `t_mark`
  MODIFY `idMark` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
--
-- AUTO_INCREMENT pour la table `t_printer`
--
ALTER TABLE `t_printer`
  MODIFY `idPrinter` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;
--
-- AUTO_INCREMENT pour la table `t_technology`
--
ALTER TABLE `t_technology`
  MODIFY `idTechnology` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
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
