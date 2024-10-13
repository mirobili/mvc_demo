CREATE DATABASE  IF NOT EXISTS `mvc_demo` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_0900_ai_ci */ /*!80016 DEFAULT ENCRYPTION='N' */;
USE `mvc_demo`;
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
INSERT INTO `contract` VALUES (1,'CDSM1000-050-1001234',1,'2024-10-10 00:00:00','2029-10-10 00:00:00','Active','2024-10-10 19:02:16','2024-10-10 19:02:16'),(2,'CDSM1000-050-1002222',1,'2024-10-10 00:00:00','2029-10-10 00:00:00','Active','2024-10-10 19:35:33','2024-10-10 19:40:36'),(3,'CDSM1000-050-2001234',2,'2024-10-10 00:00:00','2029-10-10 00:00:00','Active','2024-10-10 19:02:16','2024-10-10 19:02:16'),(4,'CDSM1000-050-2002222',2,'2024-10-10 00:00:30','2029-10-10 00:00:00','Active','2024-10-10 19:35:33','2024-10-10 20:41:10');
/*!40000 ALTER TABLE `contract` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

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
INSERT INTO `customer` VALUES (1,'Miro','Sofia 1000','+359 882220002','miroslav.biliarski@gmail.com','2024-10-08 22:06:34','2024-10-08 22:09:27'),(2,'Ivan Ivanov','Sofia 1111','+359 700 12 012','office@credissimo.bg','2024-10-08 22:08:41','2024-10-08 22:08:41'),(3,'testName_2024-10-11 17:29:15','testAddress_2024-10-11 17:29:15','testPhone_2024-10-11 17:29:15','testEmail_2024-10-11 17:29:15',NULL,'2024-10-11 18:29:17'),(4,'aaaa','address','phone','email','2024-10-10 16:51:50','2024-10-10 16:51:50'),(5,'aaaa','address','phone','email','2024-10-10 16:55:48','2024-10-10 16:55:48'),(6,'aaaa','address','phone','email','2024-10-10 16:55:48','2024-10-10 16:55:48'),(7,'aaaa','address','phone','email','2024-10-10 16:55:52','2024-10-10 16:55:52'),(8,'aaaa','address','phone','email','2024-10-10 16:55:52','2024-10-10 16:55:52'),(9,'name','address','phone','email','2024-10-10 17:04:53','2024-10-10 17:04:53'),(10,'name','address','phone','email','2024-10-10 17:05:10','2024-10-10 17:05:10'),(11,'name','address','phone','email','2024-10-10 17:05:22','2024-10-10 17:05:22'),(12,'name','address','phone','email','2024-10-10 17:05:30','2024-10-10 17:05:30'),(13,'name','address','phone','email','2024-10-10 17:07:16','2024-10-10 17:07:16'),(14,'name','address','phone','email','2024-10-10 17:09:39','2024-10-10 17:09:39'),(15,'name','address','phone','email','2024-10-10 17:09:45','2024-10-10 17:09:45'),(16,'name','address','phone','email','2024-10-10 17:10:07','2024-10-10 17:10:07'),(17,'name','address','phone','email','2024-10-10 17:10:49','2024-10-10 17:10:49'),(18,'name','address','phone','email','2024-10-10 17:11:23','2024-10-10 17:11:23'),(19,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 17:12:57','2024-10-10 17:12:57'),(20,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 17:13:25','2024-10-10 17:13:25'),(21,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 17:15:04','2024-10-10 17:15:04'),(22,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 17:16:45','2024-10-10 17:16:45'),(23,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 17:17:22','2024-10-10 17:17:22'),(24,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 17:17:46','2024-10-10 17:17:46'),(25,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 17:18:32','2024-10-10 17:18:32'),(26,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 17:25:42','2024-10-10 17:25:42'),(27,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 17:25:47','2024-10-10 17:25:47'),(28,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 17:57:02','2024-10-10 17:57:02'),(29,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:31:07','2024-10-10 18:31:07'),(30,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:31:17','2024-10-10 18:31:17'),(31,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:32:13','2024-10-10 18:32:13'),(32,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:33:15','2024-10-10 18:33:15'),(33,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:34:30','2024-10-10 18:34:30'),(34,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:34:46','2024-10-10 18:34:46'),(35,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:35:02','2024-10-10 18:35:02'),(36,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:36:02','2024-10-10 18:36:02'),(37,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:37:27','2024-10-10 18:37:27'),(38,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:40:33','2024-10-10 18:40:33'),(39,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:53:47','2024-10-10 18:53:47'),(40,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:54:29','2024-10-10 18:54:29'),(41,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 18:54:57','2024-10-10 18:54:57'),(42,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 19:05:40','2024-10-10 19:05:40'),(43,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 19:08:03','2024-10-10 19:08:03'),(44,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 19:55:48','2024-10-10 19:55:48'),(45,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 19:56:27','2024-10-10 19:56:27'),(46,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 19:56:50','2024-10-10 19:56:50'),(47,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 19:57:07','2024-10-10 19:57:07'),(48,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 19:57:44','2024-10-10 19:57:44'),(49,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 19:58:07','2024-10-10 19:58:07'),(50,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 19:58:29','2024-10-10 19:58:29'),(51,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 19:58:38','2024-10-10 19:58:38'),(52,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 19:59:43','2024-10-10 19:59:43'),(53,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 20:00:12','2024-10-10 20:00:12'),(54,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 20:00:43','2024-10-10 20:00:43'),(55,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 20:03:24','2024-10-10 20:03:24'),(56,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 20:08:19','2024-10-10 20:08:19'),(57,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 20:08:26','2024-10-10 20:08:26'),(58,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 20:14:10','2024-10-10 20:14:10'),(59,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 20:14:24','2024-10-10 20:14:24'),(60,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 20:15:55','2024-10-10 20:15:55'),(61,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 20:17:19','2024-10-10 20:17:19'),(62,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 21:03:48','2024-10-10 21:03:48'),(63,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 21:21:46','2024-10-10 21:21:46'),(64,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-10 21:27:00','2024-10-10 21:34:19'),(65,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-10 21:33:30','2024-10-10 21:33:30'),(66,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-10 21:39:01','2024-10-10 21:39:01'),(67,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-10 21:41:40','2024-10-10 21:41:40'),(68,'JohnDoe de REST - 2024-10-11 17:29:16','Meta HQ Partial Data Updated ','','','2024-10-10 21:42:01','2024-10-11 18:29:18'),(69,'Miro','Sofia+1000 8833111','+359+882220002','miroslav.biliarski@gmail.com','2024-10-10 21:48:38','2024-10-12 03:42:14'),(70,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-10 21:58:56','2024-10-10 21:58:56'),(71,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-10 21:58:57','2024-10-10 21:58:57'),(72,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-10 21:58:57','2024-10-10 21:58:57'),(73,'mm2','aaaaaaaaa','pppppp','eeeeeeee','2024-10-11 01:04:41','2024-10-11 01:04:41'),(74,'mm3','aaa','ppp','eee','2024-10-11 01:07:15','2024-10-11 01:07:15'),(75,'mm3','aaa','ppp','eee','2024-10-11 01:09:23','2024-10-11 01:09:23'),(76,'mm3','aaa','ppp','eee','2024-10-11 01:09:36','2024-10-11 01:09:36'),(77,'mm3','aaa','ppp','eee','2024-10-11 01:09:49','2024-10-11 01:09:49'),(78,'mm3','aaa','ppp','eee','2024-10-11 01:10:21','2024-10-11 01:10:21'),(79,'mm3','aaa','ppp','eee','2024-10-11 01:11:27','2024-10-11 01:11:27'),(80,'test insert','no address ','888 222 222 221','','2024-10-11 11:47:23','2024-10-11 11:47:49'),(81,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 14:36:10','2024-10-11 14:36:10'),(82,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:36:11','2024-10-11 14:36:11'),(83,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:36:12','2024-10-11 14:36:12'),(84,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 14:38:06','2024-10-11 14:38:06'),(85,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:38:06','2024-10-11 14:38:06'),(86,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:38:07','2024-10-11 14:38:07'),(87,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 14:39:36','2024-10-11 14:39:36'),(88,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:39:37','2024-10-11 14:39:37'),(89,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:39:37','2024-10-11 14:39:37'),(90,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 14:41:49','2024-10-11 14:41:49'),(91,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:41:49','2024-10-11 14:41:49'),(92,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:41:50','2024-10-11 14:41:50'),(93,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 14:42:21','2024-10-11 14:42:21'),(94,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:42:22','2024-10-11 14:42:22'),(95,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:42:22','2024-10-11 14:42:22'),(96,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 14:42:51','2024-10-11 14:42:51'),(97,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:42:51','2024-10-11 14:42:51'),(98,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-11 14:42:52','2024-10-11 14:42:52'),(99,'test post','','','','2024-10-11 16:12:07','2024-10-11 16:12:07'),(100,'test post 33333333333333','','','','2024-10-11 16:12:17','2024-10-11 16:12:24'),(101,'','','','','2024-10-11 16:13:06','2024-10-11 16:13:06'),(102,'777777777777','','','','2024-10-11 16:13:16','2024-10-11 16:20:06'),(103,'asd asda 111111111111','','','','2024-10-11 16:23:02','2024-10-11 16:23:09'),(104,'','','','','2024-10-11 16:25:28','2024-10-11 16:25:28'),(105,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 16:34:49','2024-10-11 16:34:49'),(106,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 16:34:49','2024-10-11 16:34:49'),(107,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-11 16:34:49','2024-10-11 16:34:49'),(108,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 17:43:58','2024-10-11 17:43:58'),(109,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 17:43:58','2024-10-11 17:43:58'),(110,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-11 17:43:58','2024-10-11 17:43:58'),(111,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 17:44:25','2024-10-11 17:44:25'),(112,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 17:44:26','2024-10-11 17:44:26'),(113,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-11 17:44:26','2024-10-11 17:44:26'),(114,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 18:23:30','2024-10-11 18:23:30'),(115,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 18:23:30','2024-10-11 18:23:30'),(116,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-11 18:23:30','2024-10-11 18:23:30'),(117,'ivan','sofia','+359 700 12 012','miroslav.biliarski@gmail.com','2024-10-11 18:29:17','2024-10-11 18:29:17'),(118,'JohnDoe de REST','Meta HQ','+359 700 12 012','John.Doe@gmail.com','2024-10-11 18:29:17','2024-10-11 18:29:17'),(119,'JohnDoe de REST','Meta HQ Partial Data','+359 700 12 012','John.Doe@gmail.com','2024-10-11 18:29:18','2024-10-11 18:29:18'),(120,'','','','','2024-10-11 18:41:20','2024-10-11 18:41:20'),(121,'','','','','2024-10-11 18:41:28','2024-10-11 18:41:28'),(122,'','','','','2024-10-11 19:37:08','2024-10-11 19:37:08'),(123,'','','','','2024-10-11 19:37:08','2024-10-11 19:37:08'),(124,'','','','','2024-10-11 19:37:08','2024-10-11 19:37:08'),(125,'','','','','2024-10-11 19:37:09','2024-10-11 19:37:09'),(126,'','','','','2024-10-11 19:37:09','2024-10-11 19:37:09'),(127,'','','','','2024-10-11 19:43:32','2024-10-11 19:43:32'),(128,'','','','','2024-10-11 19:43:33','2024-10-11 19:43:33'),(129,'','','','','2024-10-11 19:43:33','2024-10-11 19:43:33'),(130,'','','','','2024-10-11 19:43:33','2024-10-11 19:43:33'),(131,'','','','','2024-10-11 19:43:33','2024-10-11 19:43:33'),(132,'','','','','2024-10-11 20:00:28','2024-10-11 20:00:28'),(133,'','','','','2024-10-11 20:00:28','2024-10-11 20:00:28'),(134,'','','','','2024-10-11 20:08:01','2024-10-11 20:08:01'),(135,'','','','','2024-10-11 20:08:01','2024-10-11 20:08:01'),(136,'','','','','2024-10-11 20:08:06','2024-10-11 20:08:06'),(137,'','','','','2024-10-11 20:08:06','2024-10-11 20:08:06'),(138,'','','','','2024-10-11 20:09:23','2024-10-11 20:09:23'),(139,'','','','','2024-10-11 20:09:24','2024-10-11 20:09:24'),(140,'','','','','2024-10-11 20:32:29','2024-10-11 20:32:29'),(141,'','','','','2024-10-11 20:34:19','2024-10-11 20:34:19'),(142,'','','','','2024-10-11 20:36:09','2024-10-11 20:36:09'),(143,'','','','','2024-10-11 20:36:11','2024-10-11 20:36:11'),(144,'','','','','2024-10-11 20:36:50','2024-10-11 20:36:50'),(145,'','','','','2024-10-11 20:36:54','2024-10-11 20:36:54'),(146,'','','','','2024-10-11 20:40:58','2024-10-11 20:40:58'),(147,'','','','','2024-10-11 20:41:01','2024-10-11 20:41:01'),(148,'','','','','2024-10-12 03:41:05','2024-10-12 03:41:05');
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
