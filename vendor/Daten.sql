-- --------------------------------------------------------

-- Host:                         localhost
-- Server Version:               10.2.3-MariaDB-log - mariadb.org binary distribution
-- Server Betriebssystem:        Win32
-- HeidiSQL Version:             9.4.0.5125
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Exportiere Daten aus Tabelle schuldendb.personen: ~8 rows (ungefähr)
/*!40000 ALTER TABLE `personen` DISABLE KEYS */;
INSERT INTO `personen` (`id`, `Name`) VALUES
	(1, 'Hermann'),
	(71, 'Ewald'),
	(72, 'Florian'),
	(73, 'Stefan'),
	(74, 'Marco'),
	(75, 'Dominik'),
	(76, 'Jocky'),
	(77, 'Gisela'),
	(78, 'Roman'),
	(80, 'Marie');
/*!40000 ALTER TABLE `personen` ENABLE KEYS */;

-- Exportiere Daten aus Tabelle schuldendb.schulden: ~8 rows (ungefähr)
/*!40000 ALTER TABLE `schulden` DISABLE KEYS */;
INSERT INTO `schulden` (`id`, `zahler`, `bezeichnung`, `betrag`, `intervalTime`, `startDate`, `endDate`, `datum`) VALUES
	(29, 1, 'Spotify', 14.99, 1, '2017-05-12', NULL, '2017-07-16'),
	(33, 1, 'Umstellung', -12.264, NULL, NULL, NULL, '2017-07-19'),
	(34, 1, 'Umstellung', 3.026, NULL, NULL, NULL, '2017-07-19'),
	(35, 1, 'Umstellung', 1.5, NULL, NULL, NULL, '2017-07-19'),
	(36, 1, 'Umstellung', -5.924, NULL, NULL, NULL, '2017-07-19'),
	(37, 1, 'Umstellung', 1.48, NULL, NULL, NULL, '2017-07-19'),
	(38, 1, 'Drucker', 300, NULL, NULL, NULL, '2017-07-20'),
	(44, 1, 'Netflix', 11.99, 1, '2017-07-14', NULL, '2017-07-20');
/*!40000 ALTER TABLE `schulden` ENABLE KEYS */;

-- Exportiere Daten aus Tabelle schuldendb.schulden_personen: ~21 rows (ungefähr)
/*!40000 ALTER TABLE `schulden_personen` DISABLE KEYS */;
INSERT INTO `schulden_personen` (`id`, `schuldenId`, `PersonenId`) VALUES
	(18, 29, 71),
	(19, 29, 74),
	(20, 29, 72),
	(21, 29, 75),
	(22, 29, 76),
	(23, 30, 71),
	(24, 30, 72),
	(25, 30, 74),
	(26, 31, 72),
	(27, 29, 79),
	(28, 32, 72),
	(29, 33, 72),
	(30, 34, 73),
	(31, 35, 71),
	(32, 36, 75),
	(33, 37, 74),
	(34, 38, 77),
	(40, 44, 80),
	(41, 44, 72),
	(42, 44, 1),
	(43, 44, 73);
/*!40000 ALTER TABLE `schulden_personen` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
