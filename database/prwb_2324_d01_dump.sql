-- MariaDB dump 10.19  Distrib 10.4.28-MariaDB, for Win64 (AMD64)
--
-- Host: 127.0.0.1    Database: prwb_2324_d01
-- ------------------------------------------------------
-- Server version	10.4.28-MariaDB

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `checklist_note_items`
--

DROP TABLE IF EXISTS `checklist_note_items`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checklist_note_items` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `checklist_note` int(11) NOT NULL,
  `content` varchar(256) NOT NULL,
  `checked` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `checklist_note` (`checklist_note`,`content`),
  CONSTRAINT `fkchecklist_note_items_checklist_notes` FOREIGN KEY (`checklist_note`) REFERENCES `checklist_notes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=21 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checklist_note_items`
--

LOCK TABLES `checklist_note_items` WRITE;
/*!40000 ALTER TABLE `checklist_note_items` DISABLE KEYS */;
/*!40000 ALTER TABLE `checklist_note_items` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `checklist_notes`
--

DROP TABLE IF EXISTS `checklist_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `checklist_notes` (
  `id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_checklist_notes_notes` FOREIGN KEY (`id`) REFERENCES `notes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `checklist_notes`
--

LOCK TABLES `checklist_notes` WRITE;
/*!40000 ALTER TABLE `checklist_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `checklist_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `note_shares`
--

DROP TABLE IF EXISTS `note_shares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `note_shares` (
  `note` int(11) NOT NULL,
  `user` int(11) NOT NULL,
  `editor` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`note`,`user`),
  KEY `fk_note_shares_users` (`user`),
  CONSTRAINT `fk_note_shares_notes` FOREIGN KEY (`note`) REFERENCES `notes` (`id`),
  CONSTRAINT `fk_note_shares_users` FOREIGN KEY (`user`) REFERENCES `users` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `note_shares`
--

LOCK TABLES `note_shares` WRITE;
/*!40000 ALTER TABLE `note_shares` DISABLE KEYS */;
/*!40000 ALTER TABLE `note_shares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `notes`
--

DROP TABLE IF EXISTS `notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `notes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(256) NOT NULL,
  `owner` int(11) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `edited_at` datetime DEFAULT NULL,
  `pinned` tinyint(1) NOT NULL DEFAULT 0,
  `archived` tinyint(1) NOT NULL DEFAULT 0,
  `weight` double NOT NULL DEFAULT 1,
  PRIMARY KEY (`id`),
  KEY `fk_notes_users` (`owner`),
  CONSTRAINT `fk_notes_users` FOREIGN KEY (`owner`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `notes`
--

LOCK TABLES `notes` WRITE;
/*!40000 ALTER TABLE `notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `text_notes`
--

DROP TABLE IF EXISTS `text_notes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `text_notes` (
  `id` int(11) NOT NULL,
  `content` text DEFAULT NULL,
  PRIMARY KEY (`id`),
  CONSTRAINT `fk_text_notes_notes` FOREIGN KEY (`id`) REFERENCES `notes` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `text_notes`
--

LOCK TABLES `text_notes` WRITE;
/*!40000 ALTER TABLE `text_notes` DISABLE KEYS */;
/*!40000 ALTER TABLE `text_notes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `mail` varchar(256) NOT NULL,
  `hashed_password` varchar(512) NOT NULL,
  `full_name` varchar(256) NOT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  PRIMARY KEY (`id`),
  UNIQUE KEY `mail` (`mail`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-12-04 16:02:28
