# CREATE DATABASE  IF NOT EXISTS `mvcdemo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
# USE `mvc_demo`;
-- MySQL dump 10.13  Distrib 8.0.33, for Win64 (x86_64)
--
-- Host: 192.168.0.114    Database: mvc_demo
-- ------------------------------------------------------
-- Server version	8.0.39-0ubuntu0.20.04.1

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



DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `customer` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `name` varchar(255) NOT NULL,
                            `address` varchar(255) DEFAULT NULL,
                            `phone` varchar(255) DEFAULT NULL,
                            `email` varchar(255) NOT NULL,
                            `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                            `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=149 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'Miro','Sofia 1000','+359 882220002','miroslav.biliarski@gmail.com','2024-10-08 22:06:34','2024-10-08 22:09:27');
INSERT INTO `customer` VALUES (2,'Ivan Ivanov','Sofia 1111','+359 700 12 012','office@credissimo.bg','2024-10-08 22:08:41','2024-10-08 22:08:41');
INSERT INTO `customer` VALUES (3,'testName_2024-10-11 17:29:15','testAddress_2024-10-11 17:29:15','testPhone_2024-10-11 17:29:15','testEmail_2024-10-11 17:29:15',NULL,'2024-10-11 18:29:17');
INSERT INTO `customer` VALUES (4,'aaaa','address','phone','email','2024-10-10 16:51:50','2024-10-10 16:51:50');
INSERT INTO `customer` VALUES (19,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 17:12:57','2024-10-10 17:12:57');
INSERT INTO `customer` VALUES (64,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-10 21:27:00','2024-10-10 21:34:19');
INSERT INTO `customer` VALUES (69,'Miro','Sofia+1000 8833111','+359+882220002','miroslav.biliarski@gmail.com','2024-10-10 21:48:38','2024-10-12 03:42:14');
INSERT INTO `customer` VALUES (80,'test insert','no address ','888 222 222 221','','2024-10-11 11:47:23','2024-10-11 11:47:49');
INSERT INTO `customer` VALUES (96,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 14:42:51','2024-10-11 14:42:51');
INSERT INTO `customer` VALUES (97,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:42:51','2024-10-11 14:42:51');

/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-10-12 16:29:41


--
-- Table structure for table `contract`
--

DROP TABLE IF EXISTS `contract`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contract` (
                            `id` int NOT NULL AUTO_INCREMENT,
                            `code` varchar(255) NOT NULL,
                            `customer_id` int NOT NULL,
                            `valid_from` datetime DEFAULT NULL,
                            `valid_to` datetime DEFAULT NULL,
                            `status` enum('Active','Deactivate') DEFAULT NULL,
                            `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
                            `updated_at` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                            PRIMARY KEY (`id`),
                            KEY `customer_id` (`customer_id`),
                            CONSTRAINT `contract_ibfk_1` FOREIGN KEY (`customer_id`) REFERENCES `customer` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contract`
--

LOCK TABLES `contract` WRITE;
/*!40000 ALTER TABLE `contract` DISABLE KEYS */;
INSERT INTO `contract` VALUES (1,'CDSM1000-050-1001234',1,'2024-10-10 00:00:00','2029-10-10 00:00:00','Active','2024-10-10 19:02:16','2024-10-10 19:02:16');
INSERT INTO `contract` VALUES (2,'CDSM1000-050-1002222',1,'2024-10-10 00:00:00','2029-10-10 00:00:00','Active','2024-10-10 19:35:33','2024-10-10 19:40:36');
INSERT INTO `contract` VALUES (3,'CDSM1000-050-2001234',2,'2024-10-10 00:00:00','2029-10-10 00:00:00','Active','2024-10-10 19:02:16','2024-10-10 19:02:16');
INSERT INTO `contract` VALUES (4,'CDSM1000-050-2002222',2,'2024-10-10 00:00:30','2029-10-10 00:00:00','Active','2024-10-10 19:35:33','2024-10-10 20:41:10');
/*!40000 ALTER TABLE `contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--
