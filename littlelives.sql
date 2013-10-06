CREATE DATABASE  IF NOT EXISTS `littlelives` /*!40100 DEFAULT CHARACTER SET utf8 */;
USE `littlelives`;
-- MySQL dump 10.13  Distrib 5.6.13, for Win64 (x86_64)
--
-- Host: localhost    Database: littlelives
-- ------------------------------------------------------
-- Server version	5.6.13-log

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
-- Table structure for table `catalogs`
--

DROP TABLE IF EXISTS `catalogs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `catalogs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type` char(15) DEFAULT NULL,
  `name` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=21 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `catalogs`
--

LOCK TABLES `catalogs` WRITE;
/*!40000 ALTER TABLE `catalogs` DISABLE KEYS */;
INSERT INTO `catalogs` VALUES (1,'BASIC','LittleLives',3500),(2,'ATTEND','Attendance Monitoring',500),(3,'HEALTH','Health Check Monitoring',500),(4,'PORTFOLIO','Portfolios Package',350),(5,'FEE','Fee Management Module',1000),(6,'RESOURCE','Resource Management Module',1000),(7,'LITTLESCH','Little Schools',1500),(8,'PARENTSCOMM','Parent\'s Communication',500),(9,'PARENTSLOG','Parent\'s Login',500),(10,'EVENTCAL','Event Calendar',150);
/*!40000 ALTER TABLE `catalogs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marketing_package_items`
--

DROP TABLE IF EXISTS `marketing_package_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marketing_package_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `marketing_packages_id` int(11) NOT NULL,
  `catalogs_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_marketing_package_items_catalogs1_idx` (`marketing_packages_id`),
  KEY `fk_marketing_package_items_marketing_packages1_idx1` (`catalogs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=51 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marketing_package_items`
--

LOCK TABLES `marketing_package_items` WRITE;
/*!40000 ALTER TABLE `marketing_package_items` DISABLE KEYS */;
INSERT INTO `marketing_package_items` VALUES (1,1,1),(2,2,2),(3,2,3),(4,2,4),(5,3,5),(6,3,6),(7,4,7),(8,5,8),(9,5,9),(10,2,10);
/*!40000 ALTER TABLE `marketing_package_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marketing_packages`
--

DROP TABLE IF EXISTS `marketing_packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marketing_packages` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(45) DEFAULT NULL,
  `price` float DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=16 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marketing_packages`
--

LOCK TABLES `marketing_packages` WRITE;
/*!40000 ALTER TABLE `marketing_packages` DISABLE KEYS */;
INSERT INTO `marketing_packages` VALUES (1,'Basic LittleLives Package',3500),(2,'Basic+',1500),(3,'Management Package',2000),(4,'Little Schools',1000),(5,'Parental Access',1000);
/*!40000 ALTER TABLE `marketing_packages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisations`
--

DROP TABLE IF EXISTS `organisations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisations` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organisations_id` int(11) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_organizations_organizations1_idx1` (`organisations_id`)
) ENGINE=MyISAM AUTO_INCREMENT=444 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisations`
--

LOCK TABLES `organisations` WRITE;
/*!40000 ALTER TABLE `organisations` DISABLE KEYS */;
INSERT INTO `organisations` VALUES (1,NULL,'LIttlelives Demo'),(2,1,'Brighton Orchard'),(3,1,'Brighton Clarke Quay'),(4,1,'LittleLives Main'),(5,NULL,'Morse Academy'),(6,5,'Morse Preschool'),(7,5,'Morse Primary'),(8,2,'Brighton Kindergarten');
/*!40000 ALTER TABLE `organisations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `organisations_cards`
--

DROP TABLE IF EXISTS `organisations_cards`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `organisations_cards` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organisations_id` int(11) NOT NULL,
  `card_name` varchar(45) NOT NULL,
  `card_shadow` varchar(24) DEFAULT NULL,
  `card_real` varchar(24) DEFAULT NULL,
  `expires_month` tinyint(2) DEFAULT NULL,
  `expires_year` int(4) DEFAULT NULL,
  `cvv2` char(3) DEFAULT NULL,
  `status` char(4) DEFAULT 'MAIN',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `organisations_cards`
--

LOCK TABLES `organisations_cards` WRITE;
/*!40000 ALTER TABLE `organisations_cards` DISABLE KEYS */;
INSERT INTO `organisations_cards` VALUES (1,1,'Jamoy Rocela','4813........7777','4813058277337777',10,2018,NULL,'MAIN');
/*!40000 ALTER TABLE `organisations_cards` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `catalogs_id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `price` float DEFAULT NULL,
  `recurring` tinyint(4) DEFAULT '0',
  `perchild` tinyint(4) DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `fk_products_catalogs_idx` (`catalogs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=145 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `products`
--

LOCK TABLES `products` WRITE;
/*!40000 ALTER TABLE `products` DISABLE KEYS */;
INSERT INTO `products` VALUES (1,1,'Web Presence',NULL,0,0),(2,1,'Page Signup',NULL,0,0),(3,1,'Personal Profile',NULL,0,0),(4,1,'Notifications',NULL,0,0),(5,1,'Personal Settings',NULL,0,0),(6,1,'To-dos',NULL,0,0),(7,1,'Basic School Profile',NULL,0,0),(8,1,'User Login',NULL,0,0),(9,1,'Little Questions™',NULL,0,0),(10,1,'Administration',NULL,0,0),(11,2,'Check In',NULL,0,0),(12,2,'Reports',NULL,0,0),(13,3,'Thermometer',20,1,0),(14,3,'Reports',NULL,0,0),(15,4,'Templates',NULL,0,0),(16,4,'Evaluation/Checklist',NULL,0,0),(17,4,'Reports',NULL,0,0),(18,5,'Fee Management',NULL,0,0),(19,5,'Fee Management Reports',NULL,0,0),(20,6,'Resource Management',NULL,0,0),(21,6,'Resource Management Reports',NULL,0,0),(22,7,'Emails',NULL,0,0),(23,7,'Templates',NULL,0,0),(24,7,'Lead Management',NULL,0,0),(25,8,'Emails',NULL,0,0),(26,8,'SMS',NULL,0,0),(27,8,'Notifications',NULL,0,0),(28,9,'Parental Access',5,0,0),(29,10,'Event Calendar',NULL,1,1),(140,2,'Haein',2000,0,0),(142,2,'Haein',NULL,0,0),(143,141,'Haein2',2000,0,0);
/*!40000 ALTER TABLE `products` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `subscriptions`
--

DROP TABLE IF EXISTS `subscriptions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `subscriptions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organisations_id` int(11) NOT NULL,
  `catalogs_id` int(11) NOT NULL,
  `effective_date` varchar(45) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_subscriptions_organizations1_idx1` (`organisations_id`),
  KEY `fk_subscriptions_catalogs1_idx1` (`catalogs_id`)
) ENGINE=MyISAM AUTO_INCREMENT=30 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `subscriptions`
--

LOCK TABLES `subscriptions` WRITE;
/*!40000 ALTER TABLE `subscriptions` DISABLE KEYS */;
INSERT INTO `subscriptions` VALUES (25,2,4,'1381034550'),(24,2,3,'1381034548'),(23,2,2,'1381034546'),(22,2,4,'1381034550'),(21,2,3,'1381034548'),(20,2,2,'1381034546'),(19,2,3,'1381034548'),(18,2,2,'1381034546'),(17,2,2,'1381034546'),(16,2,1,'1381034538'),(26,2,10,'1381034553'),(27,2,5,'1381039269'),(28,2,5,'1381039269'),(29,2,6,'1381039271');
/*!40000 ALTER TABLE `subscriptions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `transactions`
--

DROP TABLE IF EXISTS `transactions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `organisations_id` int(11) NOT NULL,
  `ipn` varchar(255) DEFAULT NULL,
  `data` varchar(12) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_transactions_organizations1_idx` (`organisations_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `transactions`
--

LOCK TABLES `transactions` WRITE;
/*!40000 ALTER TABLE `transactions` DISABLE KEYS */;
/*!40000 ALTER TABLE `transactions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping routines for database 'littlelives'
--
/*!50003 DROP FUNCTION IF EXISTS `GetAncestry` */;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = 'STRICT_TRANS_TABLES,NO_AUTO_CREATE_USER,NO_ENGINE_SUBSTITUTION' */ ;
DELIMITER ;;
CREATE DEFINER=`root`@`localhost` FUNCTION `GetAncestry`(GivenID INT) RETURNS varchar(1024) CHARSET utf8
    DETERMINISTIC
BEGIN
    DECLARE rv VARCHAR(1024);
    DECLARE cm CHAR(1);
    DECLARE ch INT;

    SET rv = '';
    SET cm = '';
    SET ch = GivenID;
    WHILE ch > 0 DO
        SELECT IFNULL(`organisations_id`,-1) INTO ch FROM
        (SELECT `organisations_id` FROM organisations WHERE id = ch) A;
        IF ch > 0 THEN
            SET rv = CONCAT(rv,cm,ch);
            SET cm = ',';
        END IF;
    END WHILE;
    RETURN rv;

END ;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Final view structure for view `organisation_subscriptions`
--

/*!50001 DROP TABLE IF EXISTS `organisation_subscriptions`*/;
/*!50001 DROP VIEW IF EXISTS `organisation_subscriptions`*/;
/*!50001 SET @saved_cs_client          = @@character_set_client */;
/*!50001 SET @saved_cs_results         = @@character_set_results */;
/*!50001 SET @saved_col_connection     = @@collation_connection */;
/*!50001 SET character_set_client      = utf8 */;
/*!50001 SET character_set_results     = utf8 */;
/*!50001 SET collation_connection      = utf8_general_ci */;
/*!50001 CREATE ALGORITHM=UNDEFINED */
/*!50013 DEFINER=`root`@`localhost` SQL SECURITY DEFINER */
/*!50001 VIEW `organisation_subscriptions` AS select `o`.`id` AS `id`,`o`.`name` AS `name`,`s`.`effective_date` AS `effective_date`,`s`.`catalogs_id` AS `catalogs_id` from (`organisations` `o` join `subscriptions` `s`) where (`o`.`id` = `s`.`organisations_id`) */;
/*!50001 SET character_set_client      = @saved_cs_client */;
/*!50001 SET character_set_results     = @saved_cs_results */;
/*!50001 SET collation_connection      = @saved_col_connection */;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-10-06 14:06:50


CREATE VIEW organisation_subscriptions
AS
  SELECT O.id, O.name, S.effective_date, S.catalogs_id
  FROM organisations as O, subscriptions as S
  WHERE O.id=S.organisations_id;