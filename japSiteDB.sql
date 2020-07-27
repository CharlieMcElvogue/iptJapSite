-- --------------------------------------------------------
-- Host:                         localhost
-- Server version:               5.7.24 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             10.2.0.5599
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Dumping database structure for mcel01db
DROP DATABASE IF EXISTS `mcel01db`;
CREATE DATABASE IF NOT EXISTS `mcel01db` /*!40100 DEFAULT CHARACTER SET eucjpms */;
USE `mcel01db`;

-- Dumping structure for table mcel01db.flashcards
DROP TABLE IF EXISTS `flashcards`;
CREATE TABLE IF NOT EXISTS `flashcards` (
  `cardId` int(11) NOT NULL AUTO_INCREMENT,
  `cardLoc` char(50) NOT NULL DEFAULT '',
  `cardAns` char(50) NOT NULL,
  PRIMARY KEY (`cardId`)
) ENGINE=InnoDB AUTO_INCREMENT=47 DEFAULT CHARSET=latin1;

-- Dumping data for table mcel01db.flashcards: ~42 rows (approximately)
/*!40000 ALTER TABLE `flashcards` DISABLE KEYS */;
INSERT INTO `flashcards` (`cardId`, `cardLoc`, `cardAns`) VALUES
	(1, 'a.png', 'a'),
	(2, 'i.png', 'i'),
	(3, 'u.png', 'u'),
	(4, 'e.png', 'e'),
	(5, 'o.png', 'o'),
	(6, 'ka.png', 'ka'),
	(7, 'ki.png', 'ki'),
	(8, 'ku.png', 'ku'),
	(9, 'ke.png', 'ke'),
	(10, 'ko.png', 'ko'),
	(11, 'sa.png', 'sa'),
	(12, 'shi.png', 'shi'),
	(13, 'su.png', 'su'),
	(14, 'se.png', 'se'),
	(15, 'so.png', 'so'),
	(16, 'ta.png', 'ta'),
	(17, 'chi.png', 'chi'),
	(18, 'tsu.png', 'tsu'),
	(19, 'te.png', 'te'),
	(20, 'to.png', 'to'),
	(21, 'na.png', 'na'),
	(22, 'ni.png', 'ni'),
	(23, 'nu.png', 'nu'),
	(24, 'ne.png', 'ne'),
	(25, 'no.png', 'no'),
	(26, 'ha.png', 'ha'),
	(27, 'hi.png', 'hi'),
	(28, 'fu.png', 'fu'),
	(29, 'he.png', 'he'),
	(30, 'ho.png', 'ho'),
	(31, 'ma.png', 'ma'),
	(32, 'mi.png', 'mi'),
	(33, 'mu.png', 'mu'),
	(34, 'me.png', 'me'),
	(35, 'mo.png', 'mo'),
	(36, 'ya.png', 'ya'),
	(37, 'yu.png', 'yu'),
	(38, 'yo.png', 'yo'),
	(39, 'ra.png', 'ra'),
	(40, 'ri.png', 'ri'),
	(41, 'ru.png', 'ru'),
	(42, 're.png', 're'),
	(43, 'ro.png', 'ro'),
	(44, 'wa.png', 'wa'),
	(45, 'wo.png', 'wo'),
	(46, 'n.png', 'n');
/*!40000 ALTER TABLE `flashcards` ENABLE KEYS */;

-- Dumping structure for table mcel01db.roles
DROP TABLE IF EXISTS `roles`;
CREATE TABLE IF NOT EXISTS `roles` (
  `role` char(15) NOT NULL,
  PRIMARY KEY (`role`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- Dumping data for table mcel01db.roles: ~2 rows (approximately)
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` (`role`) VALUES
	('admin'),
	('student'),
	('teacher');
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;

-- Dumping structure for table mcel01db.sessioninfo
DROP TABLE IF EXISTS `sessioninfo`;
CREATE TABLE IF NOT EXISTS `sessioninfo` (
  `sessionId` int(11) NOT NULL AUTO_INCREMENT,
  `userId` int(11) NOT NULL,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `quizScore` float DEFAULT NULL,
  PRIMARY KEY (`sessionId`),
  KEY `anal_userId` (`userId`),
  CONSTRAINT `anal_userId` FOREIGN KEY (`userId`) REFERENCES `users` (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=115 DEFAULT CHARSET=eucjpms;

-- Dumping data for table mcel01db.sessioninfo: ~113 rows (approximately)
/*!40000 ALTER TABLE `sessioninfo` DISABLE KEYS */;
INSERT INTO `sessioninfo` (`sessionId`, `userId`, `time`, `quizScore`) VALUES
	(1, 1, '2020-06-03 21:19:39', NULL),
	(2, 2, '2020-06-03 21:20:59', 1),
	(3, 3, '2020-06-03 21:21:12', 0.7),
	(4, 1, '2020-06-04 12:02:04', NULL),
	(5, 1, '2020-06-04 12:15:38', 0),
	(6, 1, '2020-06-04 12:27:02', NULL),
	(7, 1, '2020-06-04 13:06:10', NULL),
	(8, 1, '2020-06-04 13:13:13', NULL),
	(9, 1, '2020-06-04 13:15:10', NULL),
	(10, 1, '2020-06-04 16:23:24', NULL),
	(11, 1, '2020-06-04 17:05:58', 0),
	(12, 1, '2020-06-04 17:19:02', NULL),
	(13, 1, '2020-06-05 10:08:21', NULL),
	(14, 1, '2020-06-06 20:17:33', NULL),
	(15, 3, '2020-06-06 20:23:11', NULL),
	(16, 2, '2020-06-06 20:23:50', NULL),
	(17, 1, '2020-06-06 20:26:00', NULL),
	(18, 2, '2020-06-06 20:53:45', NULL),
	(19, 2, '2020-06-09 08:53:38', NULL),
	(20, 1, '2020-06-09 08:55:41', NULL),
	(21, 3, '2020-06-09 20:45:00', NULL),
	(22, 1, '2020-06-17 14:00:48', NULL),
	(23, 1, '2020-06-18 12:34:54', NULL),
	(24, 1, '2020-06-18 13:22:16', NULL),
	(25, 1, '2020-06-18 13:25:12', NULL),
	(26, 2, '2020-06-18 13:25:51', NULL),
	(27, 1, '2020-06-18 13:26:12', NULL),
	(28, 1, '2020-06-18 13:27:09', NULL),
	(29, 1, '2020-06-18 13:28:39', NULL),
	(30, 1, '2020-06-18 13:28:44', NULL),
	(31, 1, '2020-06-18 13:29:03', NULL),
	(32, 1, '2020-06-19 14:43:26', NULL),
	(33, 1, '2020-06-19 14:52:38', NULL),
	(34, 1, '2020-06-19 14:54:24', NULL),
	(35, 1, '2020-06-19 14:55:29', NULL),
	(36, 1, '2020-06-19 14:57:40', 0),
	(37, 2, '2020-06-19 14:59:00', 0.5),
	(38, 3, '2020-06-19 15:02:25', 1),
	(39, 3, '2020-06-19 15:09:48', 1),
	(40, 2, '2020-06-22 09:55:54', 0.7),
	(41, 1, '2020-06-22 09:56:47', NULL),
	(42, 1, '2020-06-23 12:42:53', NULL),
	(43, 1, '2020-06-30 16:44:39', NULL),
	(44, 1, '2020-06-30 20:35:59', NULL),
	(45, 1, '2020-06-30 20:38:27', NULL),
	(46, 1, '2020-06-30 21:32:41', NULL),
	(47, 1, '2020-06-30 21:33:21', NULL),
	(48, 3, '2020-06-30 21:34:09', NULL),
	(49, 3, '2020-06-30 21:41:04', NULL),
	(50, 1, '2020-06-30 21:46:30', NULL),
	(51, 1, '2020-06-30 21:52:27', NULL),
	(52, 1, '2020-06-30 21:56:06', NULL),
	(53, 1, '2020-06-30 22:08:06', NULL),
	(54, 1, '2020-06-30 22:09:08', NULL),
	(55, 1, '2020-06-30 22:12:17', NULL),
	(56, 1, '2020-06-30 22:16:11', NULL),
	(57, 1, '2020-06-30 22:24:30', NULL),
	(58, 1, '2020-07-01 00:07:32', NULL),
	(59, 1, '2020-07-01 00:26:45', NULL),
	(60, 3, '2020-07-01 00:33:24', NULL),
	(61, 3, '2020-07-01 00:42:07', NULL),
	(62, 3, '2020-07-01 00:47:23', NULL),
	(63, 1, '2020-07-12 22:21:16', NULL),
	(64, 2, '2020-07-12 22:49:59', 0.2),
	(65, 2, '2020-07-12 22:54:27', NULL),
	(66, 1, '2020-07-22 08:18:24', NULL),
	(67, 1, '2020-07-22 08:23:05', NULL),
	(68, 2, '2020-07-22 08:25:01', NULL),
	(69, 3, '2020-07-22 08:27:02', NULL),
	(70, 3, '2020-07-22 08:27:53', NULL),
	(71, 1, '2020-07-22 08:28:21', NULL),
	(72, 3, '2020-07-22 08:31:18', NULL),
	(73, 3, '2020-07-22 08:33:16', NULL),
	(74, 3, '2020-07-22 08:39:51', NULL),
	(75, 2, '2020-07-22 08:41:03', NULL),
	(76, 1, '2020-07-22 08:53:30', NULL),
	(77, 1, '2020-07-22 10:01:37', NULL),
	(78, 1, '2020-07-22 10:12:23', NULL),
	(79, 1, '2020-07-22 10:15:59', NULL),
	(80, 1, '2020-07-22 10:18:53', NULL),
	(81, 1, '2020-07-22 10:23:34', NULL),
	(82, 1, '2020-07-22 10:28:44', NULL),
	(83, 1, '2020-07-22 10:33:10', NULL),
	(84, 1, '2020-07-22 10:42:42', NULL),
	(85, 1, '2020-07-22 12:12:41', NULL),
	(86, 1, '2020-07-22 12:49:06', NULL),
	(87, 1, '2020-07-22 12:52:30', NULL),
	(88, 1, '2020-07-22 12:53:52', NULL),
	(89, 1, '2020-07-22 13:14:38', NULL),
	(90, 1, '2020-07-22 13:15:57', NULL),
	(91, 1, '2020-07-22 13:17:52', NULL),
	(92, 1, '2020-07-22 13:27:34', NULL),
	(93, 1, '2020-07-22 13:27:52', NULL),
	(94, 1, '2020-07-22 22:07:38', NULL),
	(95, 1, '2020-07-22 22:14:03', NULL),
	(96, 1, '2020-07-22 22:19:59', NULL),
	(97, 1, '2020-07-22 22:24:48', NULL),
	(98, 1, '2020-07-22 22:44:58', NULL),
	(99, 1, '2020-07-22 22:46:33', NULL),
	(100, 2, '2020-07-23 09:56:36', NULL),
	(101, 2, '2020-07-23 14:26:18', 0.4),
	(102, 2, '2020-07-23 14:28:14', NULL),
	(103, 3, '2020-07-23 14:40:27', NULL),
	(104, 3, '2020-07-23 14:59:50', NULL),
	(105, 3, '2020-07-23 15:00:55', NULL),
	(106, 3, '2020-07-23 15:02:34', NULL),
	(107, 1, '2020-07-23 15:11:33', NULL),
	(108, 1, '2020-07-23 16:08:42', NULL),
	(109, 1, '2020-07-23 17:00:58', 0.1),
	(110, 1, '2020-07-23 17:06:30', NULL),
	(111, 1, '2020-07-24 08:06:53', 0.7),
	(112, 3, '2020-07-24 08:13:29', NULL),
	(113, 1, '2020-07-24 11:22:37', NULL),
	(114, 1, '2020-07-24 12:27:16', NULL);
/*!40000 ALTER TABLE `sessioninfo` ENABLE KEYS */;

-- Dumping structure for table mcel01db.spacedrepetition
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

-- Dumping data for table mcel01db.spacedrepetition: ~10 rows (approximately)
/*!40000 ALTER TABLE `spacedrepetition` DISABLE KEYS */;
INSERT INTO `spacedrepetition` (`userId`, `cardId`, `box`) VALUES
	(1, 1, 3),
	(1, 2, 2),
	(1, 3, 2),
	(1, 4, 2),
	(1, 5, 3),
	(1, 6, 3),
	(1, 7, 3),
	(1, 8, 3),
	(1, 9, 3),
	(1, 10, 3);
/*!40000 ALTER TABLE `spacedrepetition` ENABLE KEYS */;

-- Dumping structure for table mcel01db.users
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

-- Dumping data for table mcel01db.users: ~3 rows (approximately)
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` (`userId`, `role`, `username`, `password`, `reviewCount`) VALUES
	(1, 'admin', 'admin', 'admin', 42),
	(2, 'student', 'testStudent', 'password', 16),
	(3, 'teacher', 'testTeacher', 'password', 23);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
