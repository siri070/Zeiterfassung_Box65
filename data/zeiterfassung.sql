-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 18. Nov 2018 um 12:46
-- Server-Version: 10.1.28-MariaDB
-- PHP-Version: 7.1.10

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
CREATE DATABASE IF NOT EXISTS `zeiterfassung` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `zeiterfassung`;

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `arbeitsbeginn`
--

CREATE TABLE `arbeitsbeginn` (
  `abId` int(11) NOT NULL,
  `beginn` datetime NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `arbeitsbeginn`
--

INSERT INTO `arbeitsbeginn` (`abId`, `beginn`, `sid`) VALUES
(8, '2018-11-15 07:24:00', 8),
(9, '2018-11-21 10:22:00', 9),
(10, '2018-11-18 01:00:00', 7),
(11, '2018-11-18 23:59:00', 7);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `arbeitsende`
--

CREATE TABLE `arbeitsende` (
  `aeId` int(11) NOT NULL,
  `ende` datetime NOT NULL,
  `sid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `arbeitsende`
--

INSERT INTO `arbeitsende` (`aeId`, `ende`, `sid`) VALUES
(6, '2018-11-15 14:59:00', 8),
(7, '2018-11-21 15:13:00', 9),
(8, '2018-11-18 07:00:00', 7),
(9, '2018-11-18 16:12:00', 7);

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `mitarbeiter`
--

CREATE TABLE `mitarbeiter` (
  `id` int(11) NOT NULL,
  `benutzername` varchar(4) NOT NULL,
  `passwort` varchar(200) NOT NULL,
  `admin` tinyint(1) NOT NULL,
  `vorname` varchar(50) NOT NULL,
  `nachname` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `mitarbeiter`
--

INSERT INTO `mitarbeiter` (`id`, `benutzername`, `passwort`, `admin`, `vorname`, `nachname`) VALUES
(6, 'A123', '$2y$10$ililPdrPHE4eh2YvCG.98.hCEec5IWhe.Mf/8HkmhXry/GN0xWuSW', 1, 'Admin', 'Admin'),
(7, 'T123', '$2y$10$TP15YXPFoAc7d8NTOs9sc.AO.m00mp9mhBg4UUwosJtStw297n9ni', 0, 'Tester', 'Test'),
(8, 'S000', '$2y$10$DTzrWd.ykp3osdHh8F9YE.H4RJLamGTdeaP9PL6selwH/YDX5OHPi', 0, 'Max', 'Mustermann'),
(9, 'S001', '$2y$10$x9.3yT2BSvv/w0Md/68cEO8wssmhmAT7tN/6KOKL17pklrkSoeRuK', 0, 'Anna', 'Musterfrau ');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `zeiterfassungen`
--

CREATE TABLE `zeiterfassungen` (
  `zid` int(11) NOT NULL,
  `mId` int(11) NOT NULL,
  `abId` int(11) NOT NULL,
  `aeId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Daten für Tabelle `zeiterfassungen`
--

INSERT INTO `zeiterfassungen` (`zid`, `mId`, `abId`, `aeId`) VALUES
(8, 8, 8, 6),
(9, 9, 9, 7),
(10, 7, 10, 8),
(11, 7, 11, 9);

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `arbeitsbeginn`
--
ALTER TABLE `arbeitsbeginn`
  ADD PRIMARY KEY (`abId`),
  ADD KEY `arbeitsbeginn_mitarbeiter_ForeignKey` (`sid`);

--
-- Indizes für die Tabelle `arbeitsende`
--
ALTER TABLE `arbeitsende`
  ADD PRIMARY KEY (`aeId`),
  ADD KEY `arbeitsende_mitarbeiter_ForeignKey` (`sid`);

--
-- Indizes für die Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `zeiterfassungen`
--
ALTER TABLE `zeiterfassungen`
  ADD PRIMARY KEY (`zid`),
  ADD KEY `zeiterf_mitarbeiter` (`mId`),
  ADD KEY `zeiterf_ae_ForeignKey` (`aeId`),
  ADD KEY `zeiterf_ab_ForeignKey` (`abId`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `arbeitsbeginn`
--
ALTER TABLE `arbeitsbeginn`
  MODIFY `abId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT für Tabelle `arbeitsende`
--
ALTER TABLE `arbeitsende`
  MODIFY `aeId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `mitarbeiter`
--
ALTER TABLE `mitarbeiter`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT für Tabelle `zeiterfassungen`
--
ALTER TABLE `zeiterfassungen`
  MODIFY `zid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints der exportierten Tabellen
--

--
-- Constraints der Tabelle `arbeitsbeginn`
--
ALTER TABLE `arbeitsbeginn`
  ADD CONSTRAINT `arbeitsbeginn_mitarbeiter_ForeignKey` FOREIGN KEY (`sid`) REFERENCES `mitarbeiter` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `arbeitsende`
--
ALTER TABLE `arbeitsende`
  ADD CONSTRAINT `arbeitsende_mitarbeiter_ForeignKey` FOREIGN KEY (`sid`) REFERENCES `mitarbeiter` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

--
-- Constraints der Tabelle `zeiterfassungen`
--
ALTER TABLE `zeiterfassungen`
  ADD CONSTRAINT `zeiterf_ab_ForeignKey` FOREIGN KEY (`abId`) REFERENCES `arbeitsbeginn` (`abId`),
  ADD CONSTRAINT `zeiterf_ae_ForeignKey` FOREIGN KEY (`aeId`) REFERENCES `arbeitsende` (`aeId`),
  ADD CONSTRAINT `zeiterf_mitarbeiter` FOREIGN KEY (`mId`) REFERENCES `mitarbeiter` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
