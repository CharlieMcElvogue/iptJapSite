-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table majprojsite.flashcards
DROP TABLE IF EXISTS `flashcards`;
CREATE TABLE IF NOT EXISTS `flashcards` (
  `cardId` int(11) NOT NULL AUTO_INCREMENT,
  `cardLoc` char(50) NOT NULL DEFAULT '',
  `cardAns` char(50) NOT NULL,
  PRIMARY KEY (`cardId`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

-- Dumping data for table majprojsite.flashcards: ~5 rows (approximately)
/*!40000 ALTER TABLE `flashcards` DISABLE KEYS */;
INSERT INTO `flashcards` (`cardId`, `cardLoc`, `cardAns`) VALUES
	(1, 'a.png', 'a'),
	(2, 'i.png', 'i'),
	(3, 'u.png', 'u'),
	(4, 'e.png', 'e'),
	(5, 'o.png', 'o'),
	(6, 'ooga', 'booga');
/*!40000 ALTER TABLE `flashcards` ENABLE KEYS */;

-- Dumping structure for table majprojsite.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role` char(15) NOT NULL,
  PRIMARY KEY (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table majprojsite.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`role`) VALUES
	('admin'),
	('student'),
	('teacher');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table majprojsite.sessioninfo
DROP TABLE IF EXISTS `sessioninfo`;
CREATE TABLE IF NOT EXISTS `sessioninfo` (
  `sessionId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `reviewCount` int(11) NOT NULL DEFAULT '0',
  `time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quizScore` int(11) DEFAULT NULL,
  `cardsLearnt` int(11) NOT NULL DEFAULT '0',
  `cardsStarted` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`sessionId`),
  KEY `anal_userId` (`userId`),
  KEY `anal_cardViewCount` (`reviewCount`),
  CONSTRAINT `anal_cardViewCount` FOREIGN KEY (`reviewCount`) REFERENCES `users` (`reviewCount`),
  CONSTRAINT `anal_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=eucjpms;

-- Dumping data for table majprojsite.sessioninfo: ~20 rows (approximately)
/*!40000 ALTER TABLE `sessioninfo` DISABLE KEYS */;
INSERT INTO `sessioninfo` (`sessionId`, `userId`, `reviewCount`, `time`, `quizScore`, `cardsLearnt`, `cardsStarted`) VALUES
	(1, 1, 0, '2020-06-03 21:19:39', NULL, 0, 0),
	(2, 2, 0, '2020-06-03 21:20:59', NULL, 0, 0),
	(3, 3, 0, '2020-06-03 21:21:12', NULL, 0, 0),
	(4, 1, 0, '2020-06-04 12:02:04', NULL, 0, 0),
	(5, 1, 0, '2020-06-04 12:15:38', NULL, 0, 0),
	(6, 1, 0, '2020-06-04 12:27:02', NULL, 0, 0),
	(7, 1, 0, '2020-06-04 13:06:10', NULL, 0, 0),
	(8, 1, 0, '2020-06-04 13:13:13', NULL, 0, 0),
	(9, 1, 0, '2020-06-04 13:15:10', NULL, 0, 0),
	(10, 1, 0, '2020-06-04 16:23:24', NULL, 0, 0),
	(11, 1, 0, '2020-06-04 17:05:58', NULL, 0, 0),
	(12, 1, 0, '2020-06-04 17:19:02', NULL, 0, 0),
	(13, 1, 0, '2020-06-05 10:08:21', NULL, 0, 0),
	(14, 1, 0, '2020-06-06 20:17:33', NULL, 0, 0),
	(15, 3, 0, '2020-06-06 20:23:11', NULL, 0, 0),
	(16, 2, 0, '2020-06-06 20:23:50', NULL, 0, 0),
	(17, 1, 0, '2020-06-06 20:26:00', NULL, 0, 0),
	(18, 2, 0, '2020-06-06 20:53:45', NULL, 0, 0),
	(19, 2, 0, '2020-06-09 08:53:38', NULL, 0, 0),
	(20, 1, 0, '2020-06-09 08:55:41', NULL, 0, 0);
/*!40000 ALTER TABLE `sessioninfo` ENABLE KEYS */;

-- Dumping structure for table majprojsite.spacedrepetition
DROP TABLE IF EXISTS `spacedrepetition`;
CREATE TABLE IF NOT EXISTS `spacedrepetition` (
  `userId` int(11) NOT NULL,
  `cardId` int(11) NOT NULL,
  `box` int(11) NOT NULL DEFAULT '1',
  KEY `userId` (`userId`),
  KEY `cardId` (`cardId`),
  CONSTRAINT `cardId` FOREIGN KEY (`cardId`) REFERENCES `flashcards` (`cardId`),
  CONSTRAINT `userId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=eucjpms;

-- Dumping data for table majprojsite.spacedrepetition: ~5 rows (approximately)
/*!40000 ALTER TABLE `spacedrepetition` DISABLE KEYS */;
INSERT INTO `spacedrepetition` (`userId`, `cardId`, `box`) VALUES
	(1, 1, 1),
	(1, 2, 1),
	(1, 3, 1),
	(1, 4, 1),
	(1, 5, 1),
	(1, 6, 1);
/*!40000 ALTER TABLE `spacedrepetition` ENABLE KEYS */;

-- Dumping structure for table majprojsite.users
DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `role` char(15) NOT NULL,
  `username` char(15) NOT NULL,
  `password` char(15) NOT NULL,
  `reviewCount` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`userId`),
  KEY `role` (`role`),
  KEY `cardViewCount` (`reviewCount`),
  CONSTRAINT `FK_users_roles` FOREIGN KEY (`role`) REFERENCES `roles` (`role`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

-- Dumping data for table majprojsite.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`userId`, `role`, `username`, `password`, `reviewCount`) VALUES
	(1, 'admin', 'admin', 'admin', 0),
	(2, 'student', 'testStudent', 'password', 0),
	(3, 'teacher', 'testTeacher', 'password', 0);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
