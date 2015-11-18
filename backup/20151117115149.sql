-- MySQL dump 10.15  Distrib 10.0.17-MariaDB, for osx10.6 (i386)
--
-- Host: localhost    Database: Trender
-- ------------------------------------------------------
-- Server version	10.0.17-MariaDB

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
-- Table structure for table `ActorUsecases`
--

DROP TABLE IF EXISTS `ActorUsecases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ActorUsecases` (
  `actor` varchar(50) NOT NULL,
  `usecase` varchar(100) NOT NULL,
  PRIMARY KEY (`actor`,`usecase`),
  KEY `usecase` (`usecase`),
  CONSTRAINT `actorusecases_ibfk_1` FOREIGN KEY (`actor`) REFERENCES `Actors` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `actorusecases_ibfk_2` FOREIGN KEY (`usecase`) REFERENCES `Usecases` (`usecase`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ActorUsecases`
--

LOCK TABLES `ActorUsecases` WRITE;
/*!40000 ALTER TABLE `ActorUsecases` DISABLE KEYS */;
/*!40000 ALTER TABLE `ActorUsecases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Actors`
--

DROP TABLE IF EXISTS `Actors`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Actors` (
  `actor` varchar(50) NOT NULL,
  `note` varchar(3000) DEFAULT NULL,
  PRIMARY KEY (`actor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Actors`
--

LOCK TABLES `Actors` WRITE;
/*!40000 ALTER TABLE `Actors` DISABLE KEYS */;
INSERT INTO `Actors` VALUES ('Utente',''),('Utente autenticato','');
/*!40000 ALTER TABLE `Actors` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ActorsInheritance`
--

DROP TABLE IF EXISTS `ActorsInheritance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ActorsInheritance` (
  `base` varchar(50) NOT NULL,
  `derivative` varchar(50) NOT NULL,
  PRIMARY KEY (`base`,`derivative`),
  KEY `derivative` (`derivative`),
  CONSTRAINT `actorsinheritance_ibfk_1` FOREIGN KEY (`base`) REFERENCES `Actors` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `actorsinheritance_ibfk_2` FOREIGN KEY (`derivative`) REFERENCES `Actors` (`actor`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ActorsInheritance`
--

LOCK TABLES `ActorsInheritance` WRITE;
/*!40000 ALTER TABLE `ActorsInheritance` DISABLE KEYS */;
INSERT INTO `ActorsInheritance` VALUES ('Utente','Utente autenticato');
/*!40000 ALTER TABLE `ActorsInheritance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Admin`
--

DROP TABLE IF EXISTS `Admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Admin` (
  `username` varchar(50) NOT NULL,
  `password` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`username`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Admin`
--

LOCK TABLES `Admin` WRITE;
/*!40000 ALTER TABLE `Admin` DISABLE KEYS */;
INSERT INTO `Admin` VALUES ('admin','admin');
/*!40000 ALTER TABLE `Admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ClassAttributes`
--

DROP TABLE IF EXISTS `ClassAttributes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ClassAttributes` (
  `class` varchar(100) NOT NULL,
  `attribute` varchar(50) NOT NULL,
  `type` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`class`,`package`,`attribute`),
  KEY `type` (`type`),
  CONSTRAINT `classattributes_ibfk_1` FOREIGN KEY (`class`, `package`) REFERENCES `Classes` (`class`, `package`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `classattributes_ibfk_2` FOREIGN KEY (`type`) REFERENCES `Types` (`type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ClassAttributes`
--

LOCK TABLES `ClassAttributes` WRITE;
/*!40000 ALTER TABLE `ClassAttributes` DISABLE KEYS */;
/*!40000 ALTER TABLE `ClassAttributes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ClassInheritance`
--

DROP TABLE IF EXISTS `ClassInheritance`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ClassInheritance` (
  `base` varchar(100) NOT NULL,
  `derivative` varchar(100) NOT NULL,
  `basePackage` varchar(100) NOT NULL,
  `derivativePackage` varchar(100) NOT NULL,
  PRIMARY KEY (`base`,`derivative`,`basePackage`,`derivativePackage`),
  KEY `derivative` (`derivative`),
  KEY `basePackage` (`basePackage`),
  KEY `derivativePackage` (`derivativePackage`),
  CONSTRAINT `classinheritance_ibfk_1` FOREIGN KEY (`base`) REFERENCES `Classes` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `classinheritance_ibfk_2` FOREIGN KEY (`derivative`) REFERENCES `Classes` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `classinheritance_ibfk_3` FOREIGN KEY (`basePackage`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `classinheritance_ibfk_4` FOREIGN KEY (`derivativePackage`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ClassInheritance`
--

LOCK TABLES `ClassInheritance` WRITE;
/*!40000 ALTER TABLE `ClassInheritance` DISABLE KEYS */;
/*!40000 ALTER TABLE `ClassInheritance` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ClassMethods`
--

DROP TABLE IF EXISTS `ClassMethods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ClassMethods` (
  `class` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `returnType` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`class`,`signature`,`returnType`,`package`),
  KEY `class` (`class`,`package`),
  KEY `returnType` (`returnType`),
  CONSTRAINT `classmethods_ibfk_1` FOREIGN KEY (`class`, `package`) REFERENCES `Classes` (`class`, `package`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `classmethods_ibfk_2` FOREIGN KEY (`returnType`) REFERENCES `Types` (`type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ClassMethods`
--

LOCK TABLES `ClassMethods` WRITE;
/*!40000 ALTER TABLE `ClassMethods` DISABLE KEYS */;
/*!40000 ALTER TABLE `ClassMethods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ClassMethodsParams`
--

DROP TABLE IF EXISTS `ClassMethodsParams`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ClassMethodsParams` (
  `class` varchar(100) NOT NULL,
  `package` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `returnType` varchar(100) NOT NULL,
  `param` varchar(50) NOT NULL,
  `paramType` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  PRIMARY KEY (`class`,`signature`,`returnType`,`package`,`param`),
  KEY `class` (`class`,`package`,`signature`,`returnType`),
  KEY `paramType` (`paramType`),
  KEY `returnType` (`returnType`),
  CONSTRAINT `classmethodsparams_ibfk_1` FOREIGN KEY (`class`, `package`, `signature`, `returnType`) REFERENCES `ClassMethods` (`class`, `package`, `signature`, `returnType`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `classmethodsparams_ibfk_2` FOREIGN KEY (`paramType`) REFERENCES `Types` (`type`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `classmethodsparams_ibfk_3` FOREIGN KEY (`returnType`) REFERENCES `Types` (`type`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ClassMethodsParams`
--

LOCK TABLES `ClassMethodsParams` WRITE;
/*!40000 ALTER TABLE `ClassMethodsParams` DISABLE KEYS */;
/*!40000 ALTER TABLE `ClassMethodsParams` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ClassRelations`
--

DROP TABLE IF EXISTS `ClassRelations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ClassRelations` (
  `classStart` varchar(100) NOT NULL,
  `packageStart` varchar(100) NOT NULL,
  `classEnd` varchar(100) NOT NULL,
  `packageEnd` varchar(100) NOT NULL,
  `relation` varchar(15) NOT NULL,
  PRIMARY KEY (`classStart`,`packageStart`,`classEnd`,`packageEnd`,`relation`),
  KEY `packageStart` (`packageStart`),
  KEY `classEnd` (`classEnd`),
  KEY `packageEnd` (`packageEnd`),
  CONSTRAINT `classrelations_ibfk_1` FOREIGN KEY (`classStart`) REFERENCES `Classes` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `classrelations_ibfk_2` FOREIGN KEY (`packageStart`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `classrelations_ibfk_3` FOREIGN KEY (`classEnd`) REFERENCES `Classes` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `classrelations_ibfk_4` FOREIGN KEY (`packageEnd`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ClassRelations`
--

LOCK TABLES `ClassRelations` WRITE;
/*!40000 ALTER TABLE `ClassRelations` DISABLE KEYS */;
/*!40000 ALTER TABLE `ClassRelations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Classes`
--

DROP TABLE IF EXISTS `Classes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Classes` (
  `class` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `applications` longtext NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`class`,`package`),
  KEY `package` (`package`),
  CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`package`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Classes`
--

LOCK TABLES `Classes` WRITE;
/*!40000 ALTER TABLE `Classes` DISABLE KEYS */;
/*!40000 ALTER TABLE `Classes` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER TypesInsert
AFTER INSERT ON Classes
FOR EACH ROW BEGIN 		
INSERT INTO Types VALUES (NEW.class, NEW.package);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER TypesUpdate
AFTER UPDATE ON Classes 
FOR EACH ROW BEGIN 		
UPDATE Types SET type = NEW.class where type = OLD.class and package = OLD.package;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER TypesDelete
AFTER DELETE ON Classes
FOR EACH ROW BEGIN 		
DELETE FROM Types WHERE type = OLD.class and package = OLD.package;
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `Glossario`
--

DROP TABLE IF EXISTS `Glossario`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Glossario` (
  `voice` varchar(100) NOT NULL,
  `definition` longtext NOT NULL,
  PRIMARY KEY (`voice`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Glossario`
--

LOCK TABLES `Glossario` WRITE;
/*!40000 ALTER TABLE `Glossario` DISABLE KEYS */;
/*!40000 ALTER TABLE `Glossario` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `IntegrationTest`
--

DROP TABLE IF EXISTS `IntegrationTest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `IntegrationTest` (
  `idTest` tinyint(255) NOT NULL AUTO_INCREMENT,
  `package` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `implemented` varchar(15) NOT NULL,
  `satisfied` varchar(15) NOT NULL,
  PRIMARY KEY (`idTest`,`package`),
  KEY `package` (`package`),
  CONSTRAINT `integrationtest_ibfk_1` FOREIGN KEY (`package`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `IntegrationTest`
--

LOCK TABLES `IntegrationTest` WRITE;
/*!40000 ALTER TABLE `IntegrationTest` DISABLE KEYS */;
/*!40000 ALTER TABLE `IntegrationTest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PackageInteractions`
--

DROP TABLE IF EXISTS `PackageInteractions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PackageInteractions` (
  `packageA` varchar(100) NOT NULL,
  `packageB` varchar(100) NOT NULL,
  `interaction` longtext NOT NULL,
  PRIMARY KEY (`packageA`,`packageB`),
  KEY `packageB` (`packageB`),
  CONSTRAINT `packageinteractions_ibfk_1` FOREIGN KEY (`packageA`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `packageinteractions_ibfk_2` FOREIGN KEY (`packageB`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PackageInteractions`
--

LOCK TABLES `PackageInteractions` WRITE;
/*!40000 ALTER TABLE `PackageInteractions` DISABLE KEYS */;
/*!40000 ALTER TABLE `PackageInteractions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Packages`
--

DROP TABLE IF EXISTS `Packages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Packages` (
  `package` varchar(100) NOT NULL,
  `dad` varchar(100) DEFAULT NULL,
  `description` varchar(2000) NOT NULL,
  `imagePath` varchar(500) DEFAULT NULL,
  `didascalia` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`package`),
  KEY `dad` (`dad`),
  CONSTRAINT `packages_ibfk_1` FOREIGN KEY (`dad`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Packages`
--

LOCK TABLES `Packages` WRITE;
/*!40000 ALTER TABLE `Packages` DISABLE KEYS */;
INSERT INTO `Packages` VALUES ('Default',NULL,'Default package for all type request by project but not mentionated',NULL,NULL);
/*!40000 ALTER TABLE `Packages` ENABLE KEYS */;
UNLOCK TABLES;
/*!50003 SET @saved_cs_client      = @@character_set_client */ ;
/*!50003 SET @saved_cs_results     = @@character_set_results */ ;
/*!50003 SET @saved_col_connection = @@collation_connection */ ;
/*!50003 SET character_set_client  = utf8 */ ;
/*!50003 SET character_set_results = utf8 */ ;
/*!50003 SET collation_connection  = utf8_general_ci */ ;
/*!50003 SET @saved_sql_mode       = @@sql_mode */ ;
/*!50003 SET sql_mode              = '' */ ;
DELIMITER ;;
/*!50003 CREATE*/ /*!50017 DEFINER=`root`@`localhost`*/ /*!50003 TRIGGER PackageDelete
BEFORE DELETE ON Packages
FOR EACH ROW BEGIN
DELETE FROM Types where type in (SELECT class FROM Classes where package = OLD.package);
END */;;
DELIMITER ;
/*!50003 SET sql_mode              = @saved_sql_mode */ ;
/*!50003 SET character_set_client  = @saved_cs_client */ ;
/*!50003 SET character_set_results = @saved_cs_results */ ;
/*!50003 SET collation_connection  = @saved_col_connection */ ;

--
-- Table structure for table `PackagesRequirements`
--

DROP TABLE IF EXISTS `PackagesRequirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `PackagesRequirements` (
  `package` varchar(100) NOT NULL,
  `requirement` varchar(100) NOT NULL,
  PRIMARY KEY (`package`,`requirement`),
  KEY `requirement` (`requirement`),
  CONSTRAINT `packagesrequirements_ibfk_1` FOREIGN KEY (`package`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `packagesrequirements_ibfk_2` FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PackagesRequirements`
--

LOCK TABLES `PackagesRequirements` WRITE;
/*!40000 ALTER TABLE `PackagesRequirements` DISABLE KEYS */;
/*!40000 ALTER TABLE `PackagesRequirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RequirementSources`
--

DROP TABLE IF EXISTS `RequirementSources`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RequirementSources` (
  `source` varchar(50) NOT NULL,
  PRIMARY KEY (`source`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RequirementSources`
--

LOCK TABLES `RequirementSources` WRITE;
/*!40000 ALTER TABLE `RequirementSources` DISABLE KEYS */;
INSERT INTO `RequirementSources` VALUES ('Esterno'),('Interno'),('RFC4226'),('RFC6238'),('Zucchetti');
/*!40000 ALTER TABLE `RequirementSources` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Requirements`
--

DROP TABLE IF EXISTS `Requirements`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Requirements` (
  `requirement` varchar(100) NOT NULL,
  `dad` varchar(100) DEFAULT NULL,
  `description` longtext NOT NULL,
  `source` varchar(50) NOT NULL,
  `satisfied` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`requirement`),
  KEY `dad` (`dad`),
  KEY `source` (`source`),
  CONSTRAINT `requirements_ibfk_1` FOREIGN KEY (`dad`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requirements_ibfk_2` FOREIGN KEY (`source`) REFERENCES `RequirementSources` (`source`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Requirements`
--

LOCK TABLES `Requirements` WRITE;
/*!40000 ALTER TABLE `Requirements` DISABLE KEYS */;
INSERT INTO `Requirements` VALUES ('R0F1.2.1','R0V1.2','La password deve avere una lunghezza di minimo 8 caratteri','Interno','notSatisfied'),('R0F2',NULL,'Il sistema permette all\'utente di autenticarsi nel sistema','Interno','notSatisfied'),('R0F2.1','R0F2','Il sistema richiede l\'inserimento di un\'email','Interno','notSatisfied'),('R0F2.2','R0F2','Il sistema richiede l\'inserimento di un pin','Interno','notSatisfied'),('R0F2.3','R0F2','Il sistema avvisa l\'utente che durante la procedura si Ã¨ verificato un problema','Interno','notSatisfied'),('R0F2.3.1','R0F2.3','Il sistema interrompe la procedura se l\'email inserita non Ã¨ nel formato corretto','Interno','notSatisfied'),('R0F2.3.2','R0F2.3','Il sistema interrompe la procedura se l\'email inserita non Ã¨ stata trovata nel sistema','Interno','notSatisfied'),('R0F2.3.3','R0F2.3','Il sistema interrompe la procedura se il pin inviato non corrisponde a quello calcolato','RFC4226','notSatisfied'),('R0F3',NULL,'Il sistema permette all\'utente di ritirare le chiavi dei dispositivi ad esso associati','Interno','notSatisfied'),('R0F3.1','R0F3','Il sistema richiede l\'inserimento di un\'email','Interno','notSatisfied'),('R0F3.2','R0F3','Il sistema richiede l\'inserimento di una password','Interno','notSatisfied'),('R0F3.3','R0F3','Il sistema avvisa l\'utente che durante la procedura Ã¨ avvenuto un errore','Interno','notSatisfied'),('R0F3.3.1','R0F3.3','Il sistema interrompe la procedura se l\'email inserita non Ã¨ nel formato corretto','Interno','notSatisfied'),('R0F3.3.2','R0F3.3','Il sistema interrompe la procedura se l\'email inserita non Ã¨ stata trovata nel sistema','Interno','notSatisfied'),('R0F3.3.3','R0F3.3','Il sistema interrompe la procedura se la password inserita non corrisponde a quella associata all\'utente','Interno','notSatisfied'),('R0F4.1','R1F4','Il sistema richiede l\'inserimento della propria un\'email','Interno','notSatisfied'),('R0F4.2','R1F4','Il sistema richiede l\'inserimento della vecchia password','Interno','notSatisfied'),('R0F4.3','R1F4','Il sistema richiede l\'inserimento di una nuova password','Interno','notSatisfied'),('R0F4.3.1','R0F4.3','La password deve avere una lunghezza di minimo 8 caratteri','Interno','notSatisfied'),('R0F4.4','R1F4','Il sistema richiede l\'inserimento di una nuova password di conferma','Interno','notSatisfied'),('R0F4.4.1','R0F4.4','La nuova password di conferma deve essere identica alla nuova password inserita','Interno','notSatisfied'),('R0P2.3.4','R0F2.3','Il sistema interrompe la procedura se il pin inserito non Ã¨ di un formato numerico','Interno','notSatisfied'),('R0V1',NULL,'Il sistema permette all\'utente di registrarsi nel sistema','Interno','notSatisfied'),('R0V1.1','R0V1','Il sistema richiede l\'inserimento di un\'email','Interno','notSatisfied'),('R0V1.1.1','R0V1.1','L\'email deve avere un formato valido ovvero deve contenere una sequenza di lettere nella forma prima\'@\'seconda dove prima corrisponde all\'utente e seconda il dominio di appartenenza','Interno','notSatisfied'),('R0V1.1.2','R0V1.1','L\'email deve essere univocamente riconosciuta dal sistema','Interno','notSatisfied'),('R0V1.2','R0V1','Il sistema richiede l\'inserimento di una password','Interno','notSatisfied'),('R0V1.3','R0V1','Il sistema richiede l\'inserimento di un pin','RFC4226','notSatisfied'),('R0V1.3.1','R0V1.3','Il pin deve avere una lunghezza minima di 6 caratteri','RFC4226','notSatisfied'),('R0V1.3.2','R0V1.3','Il pin deve essere in un formato numerico','Interno','notSatisfied'),('R0V1.4.1','R1V1.4','Il sistema interrompe la procedura se l\'email inserita non soddisfa i requisiti','Interno','notSatisfied'),('R0V1.4.2','R1V1.4','Il sistema interrompe la procedura se la password non rispetta i requisiti','Interno','notSatisfied'),('R0V1.4.3','R1V1.4','Il sistema interrompe la procedura se la password di conferma non soddisfa i requisiti','Interno','notSatisfied'),('R0V1.4.4','R1V1.4','Il sistema interrompe la procedura se il pin inviato differisce da quello calcolato sul server','RFC4226','notSatisfied'),('R0V1.5','R0V1','Il sistema richiede l\'inserimento di una password di conferma','Interno','notSatisfied'),('R0V1.5.1','R0V1.5','La password di conferma deve essere identica alla password inserita','Interno','notSatisfied'),('R1F4',NULL,'Il sistema permette all\'utente autenticato di cambiare la propria password','Interno','notSatisfied'),('R1V1.4','R0V1','Il sistema avvisa l\'utente che durante la procedura di registrazione  avvenuto un errore','Interno','notSatisfied');
/*!40000 ALTER TABLE `Requirements` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RequirementsClasses`
--

DROP TABLE IF EXISTS `RequirementsClasses`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RequirementsClasses` (
  `requirement` varchar(100) NOT NULL,
  `class` varchar(100) NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`requirement`,`class`,`package`),
  KEY `class` (`class`),
  KEY `package` (`package`),
  CONSTRAINT `requirementsclasses_ibfk_1` FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requirementsclasses_ibfk_2` FOREIGN KEY (`class`) REFERENCES `Classes` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requirementsclasses_ibfk_3` FOREIGN KEY (`package`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RequirementsClasses`
--

LOCK TABLES `RequirementsClasses` WRITE;
/*!40000 ALTER TABLE `RequirementsClasses` DISABLE KEYS */;
/*!40000 ALTER TABLE `RequirementsClasses` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RequirementsUsecases`
--

DROP TABLE IF EXISTS `RequirementsUsecases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RequirementsUsecases` (
  `requirement` varchar(100) NOT NULL,
  `usecase` varchar(100) NOT NULL,
  PRIMARY KEY (`requirement`,`usecase`),
  KEY `usecase` (`usecase`),
  CONSTRAINT `requirementsusecases_ibfk_1` FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requirementsusecases_ibfk_2` FOREIGN KEY (`usecase`) REFERENCES `Usecases` (`usecase`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RequirementsUsecases`
--

LOCK TABLES `RequirementsUsecases` WRITE;
/*!40000 ALTER TABLE `RequirementsUsecases` DISABLE KEYS */;
/*!40000 ALTER TABLE `RequirementsUsecases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `RequirementsVerbal`
--

DROP TABLE IF EXISTS `RequirementsVerbal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `RequirementsVerbal` (
  `requirement` varchar(100) NOT NULL DEFAULT '',
  `verbal` date NOT NULL,
  PRIMARY KEY (`requirement`,`verbal`),
  KEY `verbal` (`verbal`),
  CONSTRAINT `requirementsverbal_ibfk_1` FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `requirementsverbal_ibfk_2` FOREIGN KEY (`verbal`) REFERENCES `Verbals` (`date`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `RequirementsVerbal`
--

LOCK TABLES `RequirementsVerbal` WRITE;
/*!40000 ALTER TABLE `RequirementsVerbal` DISABLE KEYS */;
/*!40000 ALTER TABLE `RequirementsVerbal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Settings_Prints`
--

DROP TABLE IF EXISTS `Settings_Prints`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Settings_Prints` (
  `voice` varchar(100) NOT NULL,
  `active` tinyint(1) DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Settings_Prints`
--

LOCK TABLES `Settings_Prints` WRITE;
/*!40000 ALTER TABLE `Settings_Prints` DISABLE KEYS */;
INSERT INTO `Settings_Prints` VALUES ('arFunctionalRequirement',1),('arQualitativeRequirement',1),('arBindingRequirement',1),('arPerformanceRequirement',1),('arResume',1),('arUsecase',1),('arTrackingRequirementSource',1),('arTrackingSourceRequirement',1),('arSatisfiedObbligatory',1),('arSatisfiedDesiderable',1),('arSatisfiedOptional',1),('arTrackingRequirementTestValidationSystem',1),('pqTestValidation',1),('pqTestSystem',1),('pqTestIntegration',0),('pqTestUnit',0),('pqTrackingComponentTest',0),('pqTrackingClassMethodTest',0),('pqDesignInstability',0),('pqMetricsSatisfiement',0),('pqCodeCoverage',0),('stTrackingClassRequirement',0),('stTrackingRequirementClass',0),('dpPackage',0),('glVoices',0);
/*!40000 ALTER TABLE `Settings_Prints` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `SystemTests`
--

DROP TABLE IF EXISTS `SystemTests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `SystemTests` (
  `requirement` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `implemented` varchar(15) NOT NULL,
  `satisfied` varchar(15) NOT NULL,
  PRIMARY KEY (`requirement`),
  CONSTRAINT `systemtests_ibfk_1` FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `SystemTests`
--

LOCK TABLES `SystemTests` WRITE;
/*!40000 ALTER TABLE `SystemTests` DISABLE KEYS */;
/*!40000 ALTER TABLE `SystemTests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Types`
--

DROP TABLE IF EXISTS `Types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Types` (
  `type` varchar(100) NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`type`),
  KEY `package` (`package`),
  CONSTRAINT `types_ibfk_1` FOREIGN KEY (`package`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Types`
--

LOCK TABLES `Types` WRITE;
/*!40000 ALTER TABLE `Types` DISABLE KEYS */;
/*!40000 ALTER TABLE `Types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UnitTestClassesMethods`
--

DROP TABLE IF EXISTS `UnitTestClassesMethods`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UnitTestClassesMethods` (
  `test` tinyint(255) NOT NULL,
  `class` varchar(100) NOT NULL,
  `signature` varchar(100) NOT NULL,
  `returnType` varchar(100) NOT NULL,
  `package` varchar(100) NOT NULL,
  PRIMARY KEY (`test`,`class`,`signature`,`returnType`,`package`),
  KEY `package` (`package`),
  KEY `returnType` (`returnType`),
  KEY `class` (`class`,`signature`,`returnType`,`package`),
  CONSTRAINT `unittestclassesmethods_ibfk_1` FOREIGN KEY (`test`) REFERENCES `UnitTests` (`test`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `unittestclassesmethods_ibfk_2` FOREIGN KEY (`class`) REFERENCES `Classes` (`class`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `unittestclassesmethods_ibfk_3` FOREIGN KEY (`package`) REFERENCES `Packages` (`package`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `unittestclassesmethods_ibfk_4` FOREIGN KEY (`returnType`) REFERENCES `Types` (`type`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `unittestclassesmethods_ibfk_5` FOREIGN KEY (`class`, `signature`, `returnType`, `package`) REFERENCES `ClassMethods` (`class`, `signature`, `returnType`, `package`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UnitTestClassesMethods`
--

LOCK TABLES `UnitTestClassesMethods` WRITE;
/*!40000 ALTER TABLE `UnitTestClassesMethods` DISABLE KEYS */;
/*!40000 ALTER TABLE `UnitTestClassesMethods` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UnitTests`
--

DROP TABLE IF EXISTS `UnitTests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UnitTests` (
  `test` tinyint(255) NOT NULL,
  `description` longtext NOT NULL,
  `implemented` varchar(15) NOT NULL,
  `satisfied` varchar(15) NOT NULL,
  PRIMARY KEY (`test`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UnitTests`
--

LOCK TABLES `UnitTests` WRITE;
/*!40000 ALTER TABLE `UnitTests` DISABLE KEYS */;
/*!40000 ALTER TABLE `UnitTests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Usecases`
--

DROP TABLE IF EXISTS `Usecases`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Usecases` (
  `usecase` varchar(100) NOT NULL,
  `dad` varchar(100) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `description` varchar(2000) NOT NULL,
  `type` varchar(10) DEFAULT NULL,
  `precondition` varchar(2000) NOT NULL,
  `postcondition` varchar(2000) NOT NULL,
  `imagePath` varchar(500) DEFAULT NULL,
  `didascalia` varchar(255) DEFAULT NULL,
  `scene` varchar(2000) DEFAULT NULL,
  `alternativeScene` varchar(2000) DEFAULT NULL,
  PRIMARY KEY (`usecase`),
  KEY `dad` (`dad`),
  CONSTRAINT `usecases_ibfk_1` FOREIGN KEY (`dad`) REFERENCES `Usecases` (`usecase`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Usecases`
--

LOCK TABLES `Usecases` WRITE;
/*!40000 ALTER TABLE `Usecases` DISABLE KEYS */;
/*!40000 ALTER TABLE `Usecases` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `UsecasesVerbals`
--

DROP TABLE IF EXISTS `UsecasesVerbals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `UsecasesVerbals` (
  `usecase` varchar(100) NOT NULL,
  `verbal` date NOT NULL,
  PRIMARY KEY (`usecase`,`verbal`),
  KEY `verbal` (`verbal`),
  CONSTRAINT `usecasesverbals_ibfk_1` FOREIGN KEY (`usecase`) REFERENCES `Usecases` (`usecase`) ON DELETE CASCADE ON UPDATE CASCADE,
  CONSTRAINT `usecasesverbals_ibfk_2` FOREIGN KEY (`verbal`) REFERENCES `Verbals` (`date`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `UsecasesVerbals`
--

LOCK TABLES `UsecasesVerbals` WRITE;
/*!40000 ALTER TABLE `UsecasesVerbals` DISABLE KEYS */;
/*!40000 ALTER TABLE `UsecasesVerbals` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ValidationTest`
--

DROP TABLE IF EXISTS `ValidationTest`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ValidationTest` (
  `requirement` varchar(100) NOT NULL,
  `test` varchar(100) NOT NULL,
  `description` longtext NOT NULL,
  `implemented` varchar(15) NOT NULL,
  `satisfied` varchar(15) NOT NULL,
  PRIMARY KEY (`test`),
  KEY `requirement` (`requirement`),
  CONSTRAINT `validationtest_ibfk_1` FOREIGN KEY (`requirement`) REFERENCES `Requirements` (`requirement`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ValidationTest`
--

LOCK TABLES `ValidationTest` WRITE;
/*!40000 ALTER TABLE `ValidationTest` DISABLE KEYS */;
/*!40000 ALTER TABLE `ValidationTest` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ValidationTestStep`
--

DROP TABLE IF EXISTS `ValidationTestStep`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `ValidationTestStep` (
  `test` varchar(100) NOT NULL,
  `stepNumber` varchar(100) NOT NULL,
  `stepDescription` longtext NOT NULL,
  PRIMARY KEY (`test`,`stepNumber`),
  CONSTRAINT `validationteststep_ibfk_1` FOREIGN KEY (`test`) REFERENCES `ValidationTest` (`test`) ON DELETE CASCADE ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ValidationTestStep`
--

LOCK TABLES `ValidationTestStep` WRITE;
/*!40000 ALTER TABLE `ValidationTestStep` DISABLE KEYS */;
/*!40000 ALTER TABLE `ValidationTestStep` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Verbals`
--

DROP TABLE IF EXISTS `Verbals`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `Verbals` (
  `date` date NOT NULL,
  `text` longtext,
  PRIMARY KEY (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Verbals`
--

LOCK TABLES `Verbals` WRITE;
/*!40000 ALTER TABLE `Verbals` DISABLE KEYS */;
/*!40000 ALTER TABLE `Verbals` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-11-17 11:51:49
