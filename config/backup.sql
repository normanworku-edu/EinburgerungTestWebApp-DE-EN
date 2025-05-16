-- MySQL dump 10.13  Distrib 8.0.42, for Win64 (x86_64)
--
-- Host: localhost    Database: german_citizenship_test_db
-- ------------------------------------------------------
-- Server version	8.0.42

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `exam_history`
--

DROP TABLE IF EXISTS `exam_history`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `exam_history` (
  `exam_id` int NOT NULL AUTO_INCREMENT,
  `user_id` int NOT NULL,
  `timestamp` datetime DEFAULT CURRENT_TIMESTAMP,
  `score` tinyint NOT NULL,
  PRIMARY KEY (`exam_id`),
  KEY `user_id` (`user_id`),
  CONSTRAINT `exam_history_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `exam_history`
--

LOCK TABLES `exam_history` WRITE;
/*!40000 ALTER TABLE `exam_history` DISABLE KEYS */;
INSERT INTO `exam_history` VALUES (1,1,'2025-05-16 15:35:53',0),(2,1,'2025-05-16 15:40:52',85),(3,1,'2025-05-16 15:40:59',85),(4,1,'2025-05-16 15:41:02',85);
/*!40000 ALTER TABLE `exam_history` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(100) NOT NULL,
  `token` varchar(255) NOT NULL,
  `expires_at` datetime NOT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('john@example.com','494c887ed7d064b6ace090abcec1fe36','2025-05-16 14:29:13');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `questions` (
  `id` int NOT NULL AUTO_INCREMENT,
  `text_de` text NOT NULL,
  `text_en` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `choice1_de` varchar(255) NOT NULL,
  `choice1_en` varchar(255) NOT NULL,
  `choice2_de` varchar(255) NOT NULL,
  `choice2_en` varchar(255) NOT NULL,
  `choice3_de` varchar(255) NOT NULL,
  `choice3_en` varchar(255) NOT NULL,
  `choice4_de` varchar(255) NOT NULL,
  `choice4_en` varchar(255) NOT NULL,
  `correct_choice_index` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=742 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `questions`
--

LOCK TABLES `questions` WRITE;
/*!40000 ALTER TABLE `questions` DISABLE KEYS */;
INSERT INTO `questions` VALUES (2,'Test Frage DE','Test Question EN',NULL,'Antwort 1 DE','Answer 1 EN','Antwort 2 DE','Answer 2 EN','Antwort 3 DE','Answer 3 EN','Antwort 4 DE','Answer 4 EN',2),(734,'Test Frage DE','Test Question EN',NULL,'Antwort 1 DE','Answer 1 EN','Antwort 2 DE','Answer 2 EN','Antwort 3 DE','Answer 3 EN','Antwort 4 DE','Answer 4 EN',2),(735,'Test Frage DE','Test Question EN',NULL,'Antwort 1 DE','Answer 1 EN','Antwort 2 DE','Answer 2 EN','Antwort 3 DE','Answer 3 EN','Antwort 4 DE','Answer 4 EN',2),(736,'Test Frage DE','Test Question EN',NULL,'Antwort 1 DE','Answer 1 EN','Antwort 2 DE','Answer 2 EN','Antwort 3 DE','Answer 3 EN','Antwort 4 DE','Answer 4 EN',2),(737,'Test Frage DE','Test Question EN',NULL,'Antwort 1 DE','Answer 1 EN','Antwort 2 DE','Answer 2 EN','Antwort 3 DE','Answer 3 EN','Antwort 4 DE','Answer 4 EN',2),(738,'Test Frage DE','Test Question EN',NULL,'Antwort 1 DE','Answer 1 EN','Antwort 2 DE','Answer 2 EN','Antwort 3 DE','Answer 3 EN','Antwort 4 DE','Answer 4 EN',2),(739,'Test Frage DE','Test Question EN',NULL,'Antwort 1 DE','Answer 1 EN','Antwort 2 DE','Answer 2 EN','Antwort 3 DE','Answer 3 EN','Antwort 4 DE','Answer 4 EN',2),(740,'Test Frage DE','Test Question EN',NULL,'Antwort 1 DE','Answer 1 EN','Antwort 2 DE','Answer 2 EN','Antwort 3 DE','Answer 3 EN','Antwort 4 DE','Answer 4 EN',2),(741,'Test Frage DE','Test Question EN',NULL,'Antwort 1 DE','Answer 1 EN','Antwort 2 DE','Answer 2 EN','Antwort 3 DE','Answer 3 EN','Antwort 4 DE','Answer 4 EN',2);
/*!40000 ALTER TABLE `questions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_answers`
--

DROP TABLE IF EXISTS `user_answers`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_answers` (
  `exam_id` int NOT NULL,
  `question_id` int NOT NULL,
  `selected_choice_index` tinyint(1) DEFAULT NULL,
  PRIMARY KEY (`exam_id`,`question_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `user_answers_ibfk_1` FOREIGN KEY (`exam_id`) REFERENCES `exam_history` (`exam_id`) ON DELETE CASCADE,
  CONSTRAINT `user_answers_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_answers`
--

LOCK TABLES `user_answers` WRITE;
/*!40000 ALTER TABLE `user_answers` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_answers` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_progress`
--

DROP TABLE IF EXISTS `user_progress`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_progress` (
  `user_id` int NOT NULL,
  `question_id` int NOT NULL,
  `attempt_count` int DEFAULT '0',
  `correct_count` int DEFAULT '0',
  `incorrect_count` int DEFAULT '0',
  PRIMARY KEY (`user_id`,`question_id`),
  KEY `question_id` (`question_id`),
  CONSTRAINT `user_progress_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `user_progress_ibfk_2` FOREIGN KEY (`question_id`) REFERENCES `questions` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_progress`
--

LOCK TABLES `user_progress` WRITE;
/*!40000 ALTER TABLE `user_progress` DISABLE KEYS */;
/*!40000 ALTER TABLE `user_progress` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` int NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password_hash` varchar(255) NOT NULL,
  `is_admin` tinyint(1) DEFAULT '0',
  `created_at` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'John Doe','john@example.com','$2y$12$R6YIPKKNidF3/ROHMk0aaOyxkv7Dk3OiW8MB4OVTDq4Ryq47.916K',0,'2025-05-16 15:29:13');
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

-- Dump completed on 2025-05-16 16:45:03
