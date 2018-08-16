CREATE DATABASE  IF NOT EXISTS `a1th3_soceng` /*!40100 DEFAULT CHARACTER SET latin1 */;
USE `a1th3_soceng`;
-- MySQL dump 10.13  Distrib 5.6.17, for Win64 (x86_64)
--
-- Host: localhost    Database: a1th3_soceng
-- ------------------------------------------------------
-- Server version	5.5.5-10.1.13-MariaDB

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
-- Table structure for table `campaign`
--

DROP TABLE IF EXISTS `campaign`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `description` text,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(45) DEFAULT 'ACTIVE',
  `body_email` text,
  `subject_email` varchar(100) DEFAULT NULL,
  `from_email` varchar(100) DEFAULT NULL,
  `from_name` varchar(100) DEFAULT NULL,
  `get_variables` varchar(100) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `tempatemail_id` int(11) DEFAULT NULL,
  `templatews_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_campaign_id_idx` (`user_id`),
  KEY `template_campaign_idx_idx` (`tempatemail_id`),
  KEY `template_ws_campaign_idx_idx` (`templatews_id`),
  CONSTRAINT `template_campaign_idx` FOREIGN KEY (`tempatemail_id`) REFERENCES `template_mail` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `template_ws_campaign_idx` FOREIGN KEY (`templatews_id`) REFERENCES `template_ws` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  CONSTRAINT `user_campaign_id` FOREIGN KEY (`user_id`) REFERENCES `campaign` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign`
--

LOCK TABLES `campaign` WRITE;
/*!40000 ALTER TABLE `campaign` DISABLE KEYS */;
INSERT INTO `campaign` (`id`, `name`, `description`, `created_date`, `status`, `body_email`, `subject_email`, `from_email`, `from_name`, `get_variables`, `user_id`, `tempatemail_id`, `templatews_id`) VALUES (1,'','','2017-01-04 20:16:45','DELETED','','','','','',1,NULL,NULL),(2,'1','2','2017-01-04 20:45:59','DELETED','6','1','7','8','9',1,NULL,NULL),(3,'1','2','2017-01-04 20:46:17','DELETED','6','1','7','8','9',1,NULL,NULL),(4,'1','2','2017-01-04 20:46:38','DELETED','6','1','7','8','9',1,NULL,NULL),(5,'1','2','2017-01-04 20:46:47','DELETED','6','1','7','8','9',1,NULL,NULL),(6,'1','2','2017-01-04 20:47:31','DELETED','6','1','7','8','9',1,NULL,NULL),(7,'1','2','2017-01-04 20:48:13','DELETED','6','1','7','8','9',1,NULL,NULL),(8,'1','2','2017-01-04 20:48:26','DELETED','6','1','7','8','9',1,NULL,NULL),(9,'test send updated','asdfg','2017-01-05 06:02:11','ACTIVE','hola <#NAME>\r\nda click alqui\r\n<#URL>\r\n','TEST INGENIERIA SOCIAL','jorge@illumant.com','jorgito chido','<#EMAIL>,<#URL>',1,NULL,NULL),(10,'test','tienda de cosmeticos','2017-01-06 23:35:58','ACTIVE','HI! <#NAME>\r\n\r\nIf you can not see this message correctly click here\r\n<#URL>','TEST INGENIERIA SOCIAL','jorge@illumant.com','jorgito chido','<#NAME>,<#URL>',1,NULL,NULL);
/*!40000 ALTER TABLE `campaign` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `campaign_email`
--

DROP TABLE IF EXISTS `campaign_email`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `campaign_email` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `campaign_id` int(11) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVE',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `deleted` varchar(45) DEFAULT NULL,
  `user_deleted` int(11) DEFAULT NULL,
  `name` text,
  `lastname` text,
  `sent_date` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `campaign_idx_idx` (`campaign_id`),
  CONSTRAINT `campaign_idxx` FOREIGN KEY (`campaign_id`) REFERENCES `campaign` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `campaign_email`
--

LOCK TABLES `campaign_email` WRITE;
/*!40000 ALTER TABLE `campaign_email` DISABLE KEYS */;
INSERT INTO `campaign_email` (`id`, `campaign_id`, `email`, `status`, `created_date`, `deleted`, `user_deleted`, `name`, `lastname`, `sent_date`) VALUES (1,8,'1@1.c','SEND','2017-01-04 20:48:26',NULL,NULL,NULL,NULL,NULL),(23,10,'jororisan@gmail.com','SEND','2017-01-10 22:24:27',NULL,NULL,NULL,NULL,NULL),(24,10,'jorge.orihuela@tigears.com','SEND','2017-01-10 22:24:27',NULL,NULL,NULL,NULL,NULL),(25,9,'jororisan@gmail.com','SEND','2017-01-11 19:00:46',NULL,NULL,NULL,NULL,NULL),(26,9,'jorge.orihuela@tigears.com','SEND','2017-01-11 19:00:46',NULL,NULL,NULL,NULL,NULL);
/*!40000 ALTER TABLE `campaign_email` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `company`
--

DROP TABLE IF EXISTS `company`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(100) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVE',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `logo` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `company`
--

LOCK TABLES `company` WRITE;
/*!40000 ALTER TABLE `company` DISABLE KEYS */;
/*!40000 ALTER TABLE `company` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_mail`
--

DROP TABLE IF EXISTS `template_mail`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `template_mail` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `status` varchar(45) DEFAULT 'ACTIVE',
  `url_original` text,
  `url_fake` text,
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_mail`
--

LOCK TABLES `template_mail` WRITE;
/*!40000 ALTER TABLE `template_mail` DISABLE KEYS */;
/*!40000 ALTER TABLE `template_mail` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `template_ws`
--

DROP TABLE IF EXISTS `template_ws`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `template_ws` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(250) DEFAULT NULL,
  `url_original` text,
  `url_fake` text,
  `status` varchar(45) DEFAULT 'ACTIVE',
  `created_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `url_image` text,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `template_ws`
--

LOCK TABLES `template_ws` WRITE;
/*!40000 ALTER TABLE `template_ws` DISABLE KEYS */;
INSERT INTO `template_ws` (`id`, `name`, `url_original`, `url_fake`, `status`, `created_date`, `url_image`) VALUES (1,'Microsoft Outlook','https://login.microsoftonline.com/common/oauth2/authorize?client_id=00000006-0000-0ff1-ce00-000000000000&response_mode=form_post&response_type=code+id_token&scope=openid+profile&state=OpenIdConnect.AuthenticationProperties%3dWn9aBukQBoLCLFZWCKo0oGSiWFXYzHvE66wtC5OYW6QAabJXhr-14ShlcIYc8Ds8A79qyylWEH9WQ-kqPgHlxwIENMdKjMZ8jc-ab4C0MfG4ZOiyfAU2Bts0v0WxZsSr05Z-lYVdL7ZKgvzh65tKSAiad5va_xEzdB7VkDcI8FiAnE5pFRMxXfXDGSpHSqJ5&nonce=636517394440614482.NDg3OTRkYzYtMmFiZS00ZTYwLWFjYWMtODAzNmJmOGEyZWE5ZDllNmM2OGEtZTAxNi00NDYzLTk5NTAtZmU4NjFkZTllMjFk&redirect_uri=https%3a%2f%2fportal.office.com%2flanding&ui_locales=en-US&mkt=en-US&client-request-id=cd225590-2701-4e3e-8b60-a32a908e393a&msafed=0','http://aaa.breachsmart.com:8080/SocEng_v2.1/soceng_v2/templates/','ACTIVE','2018-01-29 22:52:23',NULL);
/*!40000 ALTER TABLE `template_ws` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `email` varchar(255) NOT NULL DEFAULT '',
  `first_name` varchar(200) NOT NULL DEFAULT '',
  `last_name` varchar(200) NOT NULL DEFAULT '',
  `initials` varchar(5) DEFAULT NULL,
  `password` varchar(250) NOT NULL DEFAULT '',
  `type` varchar(20) NOT NULL DEFAULT 'user',
  `enabled` int(11) NOT NULL DEFAULT '1',
  `deleted` int(11) NOT NULL DEFAULT '0',
  `token` varchar(200) NOT NULL DEFAULT '',
  `token_expires` datetime DEFAULT NULL,
  `created_date` datetime DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  KEY `company_user_idx_idx` (`company_id`),
  CONSTRAINT `company_user_idx` FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user`
--

LOCK TABLES `user` WRITE;
/*!40000 ALTER TABLE `user` DISABLE KEYS */;
INSERT INTO `user` (`id`, `email`, `first_name`, `last_name`, `initials`, `password`, `type`, `enabled`, `deleted`, `token`, `token_expires`, `created_date`, `company_id`) VALUES (1,'msnod@illumant.com','','','aaa..','$2y$10$Bkg7r5LLlnPrNjb4KyBSOuW.2uwbO2fnyR6tuUQE8VfsQU2HJtEt.','user',1,0,'',NULL,NULL,NULL),(2,'jorge@illumant.com','jorge','ori','','','',1,0,'','0000-00-00 00:00:00','2017-05-16 16:20:22',NULL);
/*!40000 ALTER TABLE `user` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Dumping events for database 'a1th3_soceng'
--

--
-- Dumping routines for database 'a1th3_soceng'
--
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-03-14 13:46:35
