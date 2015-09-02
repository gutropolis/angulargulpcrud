-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Server version:               5.6.17 - MySQL Community Server (GPL)
-- Server OS:                    Win64
-- HeidiSQL Version:             9.2.0.4981
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;

-- Dumping structure for table demo_test_db.library_db
CREATE TABLE IF NOT EXISTS `library_db` (
  `book_id` int(255) NOT NULL AUTO_INCREMENT,
  `book_name` varchar(255) NOT NULL,
  `author_name` varchar(255) NOT NULL,
  `department` varchar(255) NOT NULL,
  `in_stock` text NOT NULL,
  PRIMARY KEY (`book_id`)
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

-- Dumping data for table demo_test_db.library_db: ~3 rows (approximately)
DELETE FROM `library_db`;
/*!40000 ALTER TABLE `library_db` DISABLE KEYS */;
INSERT INTO `library_db` (`book_id`, `book_name`, `author_name`, `department`, `in_stock`) VALUES
	(12, 'Anatomy', 'Dr. Roger', 'bio', 'yes'),
	(13, 'C  ', 'Sk Malhotra', 'ca', 'yes'),
	(14, 'Mathematic', 'DS. Khera', 'ca', 'yes');
/*!40000 ALTER TABLE `library_db` ENABLE KEYS */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
