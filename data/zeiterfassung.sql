-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 17. Okt 2018 um 15:19
-- Server-Version: 10.1.34-MariaDB
-- PHP-Version: 5.6.37

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `zeiterfassung`
--
CREATE DATABASE IF NOT EXISTS `zeiterfassung` DEFAULT CHARACTER SET utf8 COLLATE utf8_general_ci;
USE `zeiterfassung`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `arbeitsbeginn`
--

DROP TABLE IF EXISTS `arbeitsbeginn`;
CREATE TABLE IF NOT EXISTS `arbeitsbeginn` (
  `abId` int(11) NOT NULL AUTO_INCREMENT,
  `beginn` datetime NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`abId`),
  KEY `arbeitsbeginn_mitarbeiter_ForeignKey` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `arbeitsende`
--

DROP TABLE IF EXISTS `arbeitsende`;
CREATE TABLE IF NOT EXISTS `arbeitsende` (
  `aeId` int(11) NOT NULL AUTO_INCREMENT,
  `ende` datetime NOT NULL,
  `sid` int(11) NOT NULL,
  PRIMARY KEY (`aeId`),
  KEY `arbeitsende_mitarbeiter_ForeignKey` (`sid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter`
--

DROP TABLE IF EXISTS `mitarbeiter`;
CREATE TABLE IF NOT EXISTS `mitarbeiter` (
  `mid` int(11) NOT NULL AUTO_INCREMENT,
  `benutzername` varchar(4) NOT NULL,
  `passwort` varchar(30) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL,
  PRIMARY KEY (`mid`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`mid`, `benutzername`, `passwort`, `admin`, `vorname`, `nachname`) VALUES
(1, 'T123', '', 0, 'Tester', 'Test'),
(2, 'A123', '', 1, 'Admin', 'Admin'),
(3, 's028', '$2y$10$/PyWLvW5ICOD/Qe2SOdU3.c', 0, 'huhn ', 'vithu');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeiterfassungen`
--

DROP TABLE IF EXISTS `zeiterfassungen`;
CREATE TABLE IF NOT EXISTS `zeiterfassungen` (
  `zid` int(11) NOT NULL AUTO_INCREMENT,
  `mId` int(11) NOT NULL,
  `abId` int(11) NOT NULL,
  `aeId` int(11) NOT NULL,
  PRIMARY KEY (`zid`),
  KEY `zeiterf_mitarbeiter` (`mId`),
  KEY `zeiterf_ae_ForeignKey` (`aeId`),
  KEY `zeiterf_ab_ForeignKey` (`abId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `arbeitsbeginn`
--
ALTER TABLE `arbeitsbeginn`
  ADD CONSTRAINT `arbeitsbeginn_mitarbeiter_ForeignKey` FOREIGN KEY (`sid`) REFERENCES `mitarbeiter` (`mid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `arbeitsende`
--
ALTER TABLE `arbeitsende`
  ADD CONSTRAINT `arbeitsende_mitarbeiter_ForeignKey` FOREIGN KEY (`sid`) REFERENCES `mitarbeiter` (`mid`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `zeiterfassungen`
--
ALTER TABLE `zeiterfassungen`
  ADD CONSTRAINT `zeiterf_ab_ForeignKey` FOREIGN KEY (`abId`) REFERENCES `arbeitsbeginn` (`abId`),
  ADD CONSTRAINT `zeiterf_ae_ForeignKey` FOREIGN KEY (`aeId`) REFERENCES `arbeitsende` (`aeId`),
  ADD CONSTRAINT `zeiterf_mitarbeiter` FOREIGN KEY (`mId`) REFERENCES `mitarbeiter` (`mid`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
