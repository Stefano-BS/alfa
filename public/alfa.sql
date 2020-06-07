-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Creato il: Giu 05, 2020 alle 12:21
-- Versione del server: 10.4.11-MariaDB
-- Versione PHP: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `alfa`
--

-- --------------------------------------------------------

--
-- Struttura della tabella `corpi`
--

CREATE TABLE `corpi` (
  `ID` int(11) NOT NULL,
  `Nome` char(5) NOT NULL,
  `Data` date NOT NULL,
  `MSRP` int(11) NOT NULL,
  `Materiale` varchar(15) NOT NULL,
  `Risoluzione` float(10,1) NOT NULL,
  `Formato` varchar(10) NOT NULL,
  `MaxISO` int(11) NOT NULL,
  `MaxISOExt` int(11) NOT NULL,
  `OSS` tinyint(1) NOT NULL,
  `AF` int(11) NOT NULL,
  `Schermo` int(11) NOT NULL,
  `Mirino` int(11) NOT NULL,
  `Touch` tinyint(1) NOT NULL,
  `MaxSS` int(11) NOT NULL,
  `Flash` tinyint(1) NOT NULL,
  `FPS` tinyint(4) NOT NULL,
  `QHD` tinyint(4) NOT NULL,
  `FHD` tinyint(4) NOT NULL,
  `CIPA` smallint(6) NOT NULL,
  `Peso` smallint(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `corpi`
--

INSERT INTO `corpi` (`ID`, `Nome`, `Data`, `MSRP`, `Materiale`, `Risoluzione`, `Formato`, `MaxISO`, `MaxISOExt`, `OSS`, `AF`, `Schermo`, `Mirino`, `Touch`, `MaxSS`, `Flash`, `FPS`, `QHD`, `FHD`, `CIPA`, `Peso`) VALUES
(1, 'α5100', '2014-08-18', 549, 'Composito', 24.0, 'APS-C', 25600, 25600, 0, 179, 921600, 0, 1, 4000, 1, 6, 0, 60, 400, 283),
(2, 'α6000', '2014-02-12', 799, 'Composito', 24.0, 'APS-C', 25600, 51200, 0, 179, 921600, 1440000, 0, 4000, 1, 11, 0, 60, 360, 344),
(3, 'α6100', '2019-08-28', 750, 'Composito', 24.0, 'APS-C', 32000, 51200, 0, 425, 921600, 1440000, 1, 4000, 1, 11, 30, 120, 420, 396),
(4, 'α6300', '2016-02-03', 1000, 'Magnesio', 24.0, 'APS-C', 25600, 51200, 0, 425, 921600, 2359296, 0, 4000, 1, 11, 30, 120, 400, 404),
(5, 'α6400', '2019-01-15', 900, 'Magnesio', 24.0, 'APS-C', 32000, 102800, 0, 425, 921600, 2359296, 1, 4000, 1, 11, 30, 120, 410, 403),
(6, 'α6500', '2016-10-06', 1400, 'Magnesio', 24.0, 'APS-C', 25600, 51200, 1, 425, 921600, 2359296, 1, 4000, 1, 11, 30, 120, 350, 453),
(7, 'α6600', '2019-08-28', 1400, 'Magnesio', 24.0, 'APS-C', 32000, 102400, 1, 425, 921600, 2359296, 1, 4000, 0, 11, 30, 120, 810, 503);

-- --------------------------------------------------------

--
-- Struttura della tabella `des`
--

CREATE TABLE `des` (
  `IDUtente` int(11) NOT NULL,
  `IDCorpo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struttura della tabella `desideri`
--

CREATE TABLE `desideri` (
  `IDUtente` int(11) NOT NULL,
  `IDObbiettivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `desideri`
--

INSERT INTO `desideri` (`IDUtente`, `IDObbiettivo`) VALUES
(2, 10),
(2, 6),
(2, 71);

-- --------------------------------------------------------

--
-- Struttura della tabella `obbiettivi`
--

CREATE TABLE `obbiettivi` (
  `ID` int(11) NOT NULL,
  `Nome Completo` varchar(50) NOT NULL,
  `LMin` float(10,1) NOT NULL,
  `LMax` float(10,1) NOT NULL,
  `F` float(10,1) NOT NULL,
  `FLMax` float(10,1) DEFAULT NULL,
  `Rating` varchar(5) DEFAULT NULL,
  `Marca` varchar(10) NOT NULL,
  `TAG` varchar(20) DEFAULT NULL,
  `OSS` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `obbiettivi`
--

INSERT INTO `obbiettivi` (`ID`, `Nome Completo`, `LMin`, `LMax`, `F`, `FLMax`, `Rating`, `Marca`, `TAG`, `OSS`) VALUES
(1, 'Laowa 4mm F2.8 Fisheye', 4.0, 4.0, 2.8, 0.0, '***', 'Laowa', 'Fisheye Circolare', 0),
(2, 'Lensbaby 5.8mm F3.5', 5.8, 5.8, 3.5, 0.0, NULL, 'Lensbaby', 'Circular Fisheye', 0),
(3, 'Meike 6-11mm F3.5', 6.0, 11.0, 3.5, 0.0, '*', 'Meike', '', 0),
(4, 'Meike 6.5mm F2', 6.5, 6.5, 2.0, 0.0, '*', 'Meike', '', 0),
(5, 'Yasuhara 7.3mm Madoka', 7.3, 7.3, 4.0, 0.0, '***', 'Yasuhara', 'Madoka', 0),
(6, '7Artisans 7.5mm F2.8', 7.5, 7.5, 2.8, 0.0, '***', '7Artisans', '', 0),
(7, 'Samyang 8mm F2.8 UMC Fisheye II', 8.0, 8.0, 2.8, 0.0, '***', 'Samyang', 'UMC Fisheye II', 0),
(8, 'Samyang 8mm F3.5 UMC CS II', 8.0, 8.0, 3.5, 0.0, '*', 'Samyang', 'UMC CS II', 0),
(9, 'Meike 8mm F3.5 Fisheye', 8.0, 8.0, 3.5, 0.0, '*', 'Meike', 'Fisheye', 0),
(10, 'Laowa 9mm F2.8 Zero D', 9.0, 9.0, 2.8, 0.0, '****', 'Laowa', 'Zero D', 0),
(11, 'Samyang 10mm F2.8 ED AS NCS CS', 10.0, 10.0, 2.8, 0.0, '***', 'Samyang', 'ED AS NCS CS', 0),
(12, 'Sony 10-18mm F4', 10.0, 18.0, 4.0, 0.0, '**', 'Sony', 'OSS', 1),
(13, 'Samyang 12mm F2 NCS CS', 12.0, 12.0, 2.0, 0.0, '**', 'Samyang', 'NCS CS', 0),
(14, '7Artisans 12mm F2.8', 12.0, 12.0, 2.8, 0.0, '*', '7Artisans', '', 0),
(15, 'Meike 12mm F2.8', 12.0, 12.0, 2.8, 0.0, '*', 'Meike', '', 0),
(16, 'Zeiss 12mm F2.8 Touit', 12.0, 12.0, 2.8, 0.0, '***', 'Zeiss', 'Touit', 0),
(17, 'Dorr 12mm F7.4', 12.0, 12.0, 7.4, 0.0, '', 'Dorr', '', 0),
(18, 'Sigma 16mm F1.4 DC DN Contemporary', 16.0, 16.0, 1.4, 0.0, '****', 'Sigma', 'DC DN', 0),
(19, 'Samyang 16mm F2 ED AS UMC', 16.0, 16.0, 2.0, 0.0, '**', 'Samyang', 'ED AS UMC', 0),
(20, 'Sony 16mm F2.8', 16.0, 16.0, 2.8, 0.0, '', 'Sony', '', 0),
(21, 'Sony E 16-55 F2.8 G', 16.0, 55.0, 2.8, 0.0, '****', 'Sony', 'G', 0),
(22, 'Sony 16-50 F3.5-5.6 PZ OSS', 16.0, 50.0, 3.5, 5.6, '*', 'Sony', 'PZ OSS', 1),
(23, 'Sony 16-70 F4 ZA OSS', 16.0, 70.0, 4.0, 0.0, '***', 'Sony', 'ZA OSS', 1),
(24, 'Sony 18-55mm F3.5-5.6', 18.0, 55.0, 3.5, 5.6, '**', 'Sony', 'OSS', 1),
(25, 'Sony 18-105 F4 PZ G OSS', 18.0, 105.0, 4.0, 0.0, '**', 'Sony', 'PZ G OSS', 1),
(26, 'Sony 18-110 F4 PZ G OSS', 18.0, 110.0, 4.0, 0.0, '***', 'Sony', 'PZ G OSS', 1),
(27, 'Sony 18-135 F3.5-5.6', 18.0, 135.0, 3.5, 5.6, '***', 'Sony', 'OSS', 1),
(28, 'Sony 18-200 F3.5-6.3 OSS', 18.0, 200.0, 3.5, 6.3, '*', 'Sony', 'OSS', 1),
(29, 'Sony 18-200 F3.5-6.3 OSS LE', 18.0, 200.0, 3.5, 6.3, '', 'Sony', 'LE OSS', 1),
(30, 'Sony 18-200 F3.5-6.3 PZ', 18.0, 200.0, 3.5, 6.3, '*', 'Sony', 'PZ OSS', 1),
(31, 'Tamron 18-200 F3.5-6.3 Di III VC', 18.0, 200.0, 3.5, 6.3, NULL, 'Tamron', 'Di III VC', 1),
(32, 'Sigma 19mm F2.8 EX DN', 19.0, 19.0, 2.8, 0.0, '*', 'Sigma', 'EX DN', 0),
(33, 'Sony 20mm F2.8', 20.0, 20.0, 2.8, 0.0, '', 'Sony', '', 0),
(34, 'Samyang 21mm F1.4 ED UMC CS', 21.0, 21.0, 1.4, 0.0, '***', 'Samyang', 'ED UMC CS', 0),
(35, 'Zonlai 22mm F1.8', 22.0, 22.0, 1.8, 0.0, '*', 'Zonlai', '', 0),
(36, 'Sony 24mm F1.8', 24.0, 24.0, 1.8, 0.0, '**', 'Sony', '', 0),
(37, 'Neewer 25mm F0.95', 25.0, 25.0, 1.0, 0.0, '**', 'Neewer', '', 0),
(38, '7Artisans / Zonlai 25mm F1.8', 25.0, 25.0, 1.8, 0.0, '', '7Artisans', '', 0),
(39, 'Meike 25mm F1.8', 25.0, 25.0, 1.8, 0.0, '*', 'Meike', '', 0),
(40, 'Meike 25mm F2', 25.0, 25.0, 2.0, 0.0, '**', 'Meike', '', 0),
(41, 'Kamlan 28mm F1.4', 28.0, 28.0, 1.4, 0.0, '*', 'Kamlan', '', 0),
(42, 'Meike 28mm F2.8', 28.0, 28.0, 2.8, 0.0, '***', 'Meike', '', 0),
(43, 'Yasuhara 28mm F6.4', 28.0, 28.0, 6.4, 0.0, '', 'Yasuhara', '', 0),
(44, 'Sigma 30mm F1.4 DC DN Contemporary', 30.0, 30.0, 1.4, 0.0, '****', 'Sigma', 'DC DN', 0),
(45, 'Sigma 30mm F2.8 EX DN', 30.0, 30.0, 2.8, 0.0, '**', 'Sigma', 'EX DN', 0),
(46, 'Sony 30mm F3.5 Macro', 30.0, 30.0, 3.5, 0.0, '*', 'Sony', 'Macro', 0),
(47, 'Neewer 32mm F1.6', 32.0, 32.0, 1.6, 0.0, '', 'Neewer', '', 0),
(48, 'Zeiss 32mm F1.8 Touit', 32.0, 32.0, 1.8, 0.0, '**', 'Zeiss', 'Touit', 0),
(49, '7Artisans 35mm F1.2', 35.0, 35.0, 1.2, 0.0, '**', '7Artisans', '', 0),
(50, 'Neewer 35mm F1.2', 35.0, 35.0, 1.2, 0.0, '', 'Neewer', '', 0),
(51, 'Samyang 35mm F1.2 ED UMC CS', 35.0, 35.0, 1.2, 0.0, '***', 'Samyang', 'ED UMC CS', 0),
(52, 'Meike 35mm F1.4', 35.0, 35.0, 1.4, 0.0, '*', 'Meike', '', 0),
(53, 'Mitakon 35mm F0.95 Mark II', 35.0, 35.0, 1.0, 0.0, '*', 'Mitakon', 'Mark II', 0),
(54, 'SLR Magic 35mm T1.4 Cine II', 35.0, 35.0, 1.4, 0.0, '*', 'SLR Magic', 'Cine II', 0),
(55, 'SLR Magic 35mm F1.7', 35.0, 35.0, 1.7, 0.0, '', 'SLR Magic', '', 0),
(56, 'Meike 35mm F1.7', 35.0, 35.0, 1.7, 0.0, '', 'Meike', '', 0),
(57, 'Craphy 35mm F1.7', 35.0, 35.0, 1.7, 0.0, '*', 'Craphy', '', 0),
(58, 'Sony 35mm F1.8', 35.0, 35.0, 1.8, 0.0, '**', 'Sony', 'OSS', 1),
(59, 'Kipon 40mm F0.85 Ibelux Mark I', 40.0, 40.0, 0.8, 0.0, '**', 'Kipon', 'Ibelux Mark I', 0),
(60, 'SLR Magic 50mm F0.95 Hyperprime', 50.0, 50.0, 1.0, 0.0, '', 'SLR Magic', 'Hyperprime', 0),
(61, 'Kamlan 50mm F1.1', 50.0, 50.0, 1.1, 0.0, '', 'Kamlan', '', 0),
(62, 'Kamlan 50mm F1.1 Mark II', 50.0, 50.0, 1.1, 0.0, '***', 'Kamlan', 'Mark II', 0),
(63, 'Samyang 50mm F1.2 ED UMC CS', 50.0, 50.0, 1.2, 0.0, '****', 'Samyang', 'ED UMC CS', 0),
(64, 'Zonlai 50mm F1.4', 50.0, 50.0, 1.4, 0.0, '**', 'Zonlai', '', 0),
(65, 'Sony 50mm F1.8 OSS', 50.0, 50.0, 1.8, 0.0, '**', 'Sony', 'OSS', 1),
(66, '7Artisans 50mm F1.8', 50.0, 50.0, 1.8, 0.0, '***', '7Artisans', NULL, 0),
(67, 'Meike 50mm F2', 50.0, 50.0, 2.0, 0.0, '', 'Meike', '', 0),
(68, 'Zeiss 50mm F2.8 Touit', 50.0, 50.0, 2.8, 0.0, '***', 'Zeiss', 'Touit', 0),
(69, '7Artians 55mm F1.4', 55.0, 55.0, 1.4, 0.0, '**', '7Artians', '', 0),
(70, 'Sony 55-210mm OSS', 55.0, 210.0, 4.5, 6.3, '*', 'Sony', 'OSS', 1),
(71, 'Sigma 56mm F1.4 DC DN Contemporary', 56.0, 56.0, 1.4, 0.0, '*****', 'Sigma', 'DC DN', 0),
(72, '7Artisans 60mm F2.8 Macro', 60.0, 60.0, 2.8, 0.0, '**', '7Artisans', 'Macro', 0),
(73, 'Sigma 60mm F2.8 DN', 60.0, 60.0, 2.8, 0.0, '***', 'Sigma', 'DN', 0),
(74, 'Laowa CF 65mm F2.8 CA Dreamer X2 Macro', 65.0, 65.0, 2.8, 0.0, '****', 'Laowa', '65mm F2.8 CA\nDreamer', 0),
(75, 'Sony E 70-350 F4.5-6.3 G OSS', 70.0, 350.0, 4.5, 6.3, '****', 'Sony', 'G OSS', 1),
(76, 'Samyang 85mm F1.8 ED UMC CS', 85.0, 85.0, 1.8, 0.0, '****', 'Samyang', 'ED UMC CS', 0),
(77, 'Samyang 300mm F6.3', 300.0, 300.0, 6.3, 0.0, '*', 'Samyang', 'MirrorLens', 0);

-- --------------------------------------------------------

--
-- Struttura della tabella `poss`
--

CREATE TABLE `poss` (
  `IDUtente` int(11) NOT NULL,
  `IDCorpo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `poss`
--

INSERT INTO `poss` (`IDUtente`, `IDCorpo`) VALUES
(2, 4);

-- --------------------------------------------------------

--
-- Struttura della tabella `possedimenti`
--

CREATE TABLE `possedimenti` (
  `IDUtente` int(11) NOT NULL,
  `IDObbiettivo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `possedimenti`
--

INSERT INTO `possedimenti` (`IDUtente`, `IDObbiettivo`) VALUES
(2, 44),
(2, 13),
(2, 27),
(2, 75);

-- --------------------------------------------------------

--
-- Struttura della tabella `utenti`
--

CREATE TABLE `utenti` (
  `ID` int(11) NOT NULL,
  `Nome` varchar(50) NOT NULL,
  `Password` varchar(32) NOT NULL,
  `permessi` int(1) NOT NULL,
  `lingua` char(2) NOT NULL DEFAULT 'it'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dump dei dati per la tabella `utenti`
--

INSERT INTO `utenti` (`ID`, `Nome`, `Password`, `permessi`, `lingua`) VALUES
(2, 'stefano.trerotola@outlook.it', 'fffe2600280051ec7d4a16f878a9676f', 1, 'it'),
(3, 'schiappa', 'dab6e2e1d5d620b3dacee4e3ddd4af8e', 0, 'it'),
(4, 'terzo', '16d47ae5f4fb01553d0036dd5e339b9a', 0, 'it'),
(5, 'luca', '2333bdd9f6f9e823835e3815b33baed8', 0, 'it');

--
-- Indici per le tabelle scaricate
--

--
-- Indici per le tabelle `corpi`
--
ALTER TABLE `corpi`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `desideri`
--
ALTER TABLE `desideri`
  ADD KEY `IDUtente` (`IDUtente`),
  ADD KEY `IDObbiettivo` (`IDObbiettivo`);

--
-- Indici per le tabelle `obbiettivi`
--
ALTER TABLE `obbiettivi`
  ADD PRIMARY KEY (`ID`);

--
-- Indici per le tabelle `possedimenti`
--
ALTER TABLE `possedimenti`
  ADD KEY `IDObbiettivo` (`IDObbiettivo`),
  ADD KEY `IDUtente` (`IDUtente`);

--
-- Indici per le tabelle `utenti`
--
ALTER TABLE `utenti`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT per le tabelle scaricate
--

--
-- AUTO_INCREMENT per la tabella `corpi`
--
ALTER TABLE `corpi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT per la tabella `obbiettivi`
--
ALTER TABLE `obbiettivi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT per la tabella `utenti`
--
ALTER TABLE `utenti`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Limiti per le tabelle scaricate
--

--
-- Limiti per la tabella `desideri`
--
ALTER TABLE `desideri`
  ADD CONSTRAINT `desideri_ibfk_1` FOREIGN KEY (`IDUtente`) REFERENCES `utenti` (`ID`),
  ADD CONSTRAINT `desideri_ibfk_2` FOREIGN KEY (`IDObbiettivo`) REFERENCES `obbiettivi` (`ID`);

--
-- Limiti per la tabella `possedimenti`
--
ALTER TABLE `possedimenti`
  ADD CONSTRAINT `possedimenti_ibfk_1` FOREIGN KEY (`IDObbiettivo`) REFERENCES `obbiettivi` (`ID`),
  ADD CONSTRAINT `possedimenti_ibfk_2` FOREIGN KEY (`IDUtente`) REFERENCES `utenti` (`ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
