-- MySQL dump 10.13  Distrib 8.0.22, for macos10.15 (x86_64)
--
-- Host: localhost    Database: todoDatabase
-- ------------------------------------------------------
-- Server version	5.7.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `Todos`
--

DROP TABLE IF EXISTS `Todos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Todos` (
  `id Todos` int(11) NOT NULL AUTO_INCREMENT,
  `prioritaet` tinyint(5) NOT NULL,
  `kategorie` varchar(255) NOT NULL,
  `aufgabe` varchar(45) NOT NULL,
  `erstellt` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `faellig` datetime NOT NULL,
  `status` tinyint(100) NOT NULL,
  `archiv` tinyint(1) NOT NULL,
  `Users_idUsers` int(11) NOT NULL,
  `Kategorien_idKategorien` int(11) NOT NULL,
  PRIMARY KEY (`id Todos`),
  KEY `fk_ Todos_Users1` (`Users_idUsers`),
  KEY `fk_ Todos_Kategorien1` (`Kategorien_idKategorien`),
  CONSTRAINT `fk_ Todos_Kategorien1` FOREIGN KEY (`Kategorien_idKategorien`) REFERENCES `Kategorien` (`idKategorien`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `fk_ Todos_Users1` FOREIGN KEY (`Users_idUsers`) REFERENCES `Users` (`idUsers`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Todos`
--

LOCK TABLES `Todos` WRITE;
/*!40000 ALTER TABLE `Todos` DISABLE KEYS */;
INSERT INTO `Todos` VALUES (3,1,'Schule','Socken waschen','2022-02-25 10:03:28','2022-12-17 00:00:00',20,0,1,1),(4,1,'Schule','Socken waschen','2022-02-25 11:35:34','2022-12-17 00:00:00',80,1,1,1);
/*!40000 ALTER TABLE `Todos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2022-02-25 18:41:46
