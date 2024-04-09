-- --------------------------------------------------------
-- Hôte:                         127.0.0.1
-- Version du serveur:           8.0.30 - MySQL Community Server - GPL
-- SE du serveur:                Win64
-- HeidiSQL Version:             12.1.0.6537
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


-- Listage de la structure de la base pour rplto
CREATE DATABASE IF NOT EXISTS `rplto` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `rplto`;

-- Listage de la structure de table rplto. document
CREATE TABLE IF NOT EXISTS `document` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Reference` varchar(100) DEFAULT NULL,
  `fichier` blob,
  `Date_creation` date DEFAULT NULL,
  `Date_Exp` date DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table rplto.document : ~1 rows (environ)
INSERT INTO `document` (`ID`, `Reference`, `fichier`, `Date_creation`, `Date_Exp`, `type`) VALUES
	(3, 'rrrt', _binary 0x53455354525f3031315f303038362e706466, '2024-04-05', '2024-04-02', 'Document');

-- Listage de la structure de table rplto. materiel
CREATE TABLE IF NOT EXISTS `materiel` (
  `ID` int NOT NULL AUTO_INCREMENT,
  `Refe` varchar(50) DEFAULT NULL,
  `Descrip` varchar(77) DEFAULT NULL,
  `date_creat` datetime DEFAULT NULL,
  `date_exp` datetime DEFAULT NULL,
  `type` varchar(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci DEFAULT NULL,
  PRIMARY KEY (`ID`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=28 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table rplto.materiel : ~1 rows (environ)
INSERT INTO `materiel` (`ID`, `Refe`, `Descrip`, `date_creat`, `date_exp`, `type`) VALUES
	(27, 'rvt', 'rrr', '2024-04-05 16:54:05', '2024-04-24 00:00:00', 'Materiel');

-- Listage de la structure de table rplto. users
CREATE TABLE IF NOT EXISTS `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_email` varchar(100) NOT NULL,
  `user_password` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- Listage des données de la table rplto.users : ~1 rows (environ)
INSERT INTO `users` (`id`, `user_email`, `user_password`) VALUES
	(1, 'martial', 'martial');

/*!40103 SET TIME_ZONE=IFNULL(@OLD_TIME_ZONE, 'system') */;
/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IFNULL(@OLD_FOREIGN_KEY_CHECKS, 1) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40111 SET SQL_NOTES=IFNULL(@OLD_SQL_NOTES, 1) */;
