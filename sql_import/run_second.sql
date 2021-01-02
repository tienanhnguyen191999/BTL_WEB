-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: btl_web
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `user_conference`
--

DROP TABLE IF EXISTS `user_conference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_conference` (
  `id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `conference_id` int NOT NULL,
  `hotel_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_new_table_1_idx` (`conference_id`),
  KEY `fk_new_table_2_idx` (`hotel_id`),
  KEY `fk_new_table_3_idx` (`user_id`),
  CONSTRAINT `fk_new_table_1` FOREIGN KEY (`conference_id`) REFERENCES `conference` (`id`),
  CONSTRAINT `fk_new_table_2` FOREIGN KEY (`hotel_id`) REFERENCES `hotel` (`id`),
  CONSTRAINT `fk_new_table_3` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=75 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_conference`
--

LOCK TABLES `user_conference` WRITE;
/*!40000 ALTER TABLE `user_conference` DISABLE KEYS */;
INSERT INTO `user_conference` VALUES (1,1,1,1),(2,11,1,1),(3,1,1,1),(4,1,1,1),(5,1,1,1),(6,11,1,1),(7,1,1,1),(8,11,1,1),(9,1,1,1),(10,11,1,1),(11,1,1,1),(12,11,1,1),(13,1,1,1),(14,10,1,1),(15,1,1,1),(16,10,1,1),(17,1,1,1),(18,10,1,1),(19,1,1,1),(20,10,1,1),(21,1,1,1),(22,10,1,1),(23,1,1,1),(24,10,1,1),(25,1,1,1),(26,10,1,1),(27,1,1,1),(28,11,1,1),(29,1,1,1),(30,10,1,1),(31,1,1,1),(32,10,1,1),(33,1,1,1),(34,10,1,1),(35,1,1,1),(36,10,1,1),(37,1,1,1),(38,10,1,1),(39,1,1,1),(40,1,1,1),(41,10,1,1),(42,1,1,1),(43,10,1,1),(44,1,1,1),(45,10,1,1),(46,1,1,1),(47,10,1,1),(48,1,1,1),(49,10,1,1),(50,1,1,1),(51,1,1,1),(52,1,1,1),(53,1,1,1),(54,1,1,1),(55,10,1,1),(56,10,1,1),(57,10,1,1),(58,10,1,1),(59,10,1,1),(60,1,1,1),(61,10,1,1),(62,1,1,1),(63,10,1,1),(64,11,1,1),(65,1,1,1),(66,10,1,1),(67,1,3,1),(68,12,3,1),(69,1,5,4),(70,12,5,1),(71,1,5,1),(72,10,5,1),(73,1,1,4),(74,12,1,1);
/*!40000 ALTER TABLE `user_conference` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-02 10:58:46

-- MySQL dump 10.13  Distrib 5.7.32, for Linux (x86_64)
--
-- Host: 127.0.0.1    Database: btl_web
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `conference`
--

DROP TABLE IF EXISTS `conference`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `conference` (
  `id` int NOT NULL AUTO_INCREMENT,
  `name` varchar(45) NOT NULL,
  `diadiem` varchar(45) DEFAULT NULL,
  `thoigian` varchar(45) DEFAULT NULL,
  `nhataitro_id` int NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_conference_1_idx` (`nhataitro_id`),
  CONSTRAINT `fk_conference_1` FOREIGN KEY (`nhataitro_id`) REFERENCES `nhataitro` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `conference`
--

LOCK TABLES `conference` WRITE;
/*!40000 ALTER TABLE `conference` DISABLE KEYS */;
INSERT INTO `conference` VALUES (1,'Olympic','HaNoi','2020-12-30 08:00:00',1),(3,'asd','das','2020-12-20 00:00:00',1),(4,'Hoithao2','asd','2020-12-26 00:00:00',6),(5,'Hoi Thao Moi','Ha Noi','2020-12-26 00:00:00',6);
/*!40000 ALTER TABLE `conference` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-02 10:58:45
