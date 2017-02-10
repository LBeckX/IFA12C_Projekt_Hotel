-- mysqldump-php https://github.com/ifsnop/mysqldump-php
--
-- Host: localhost	Database: hotel
-- ------------------------------------------------------
-- Server version 	5.5.5-10.1.10-MariaDB
-- Date: Thu, 02 Feb 2017 12:33:49 +0100

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
-- Table structure for table `gast`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gast` (
  `gastID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nachname` varchar(40) NOT NULL,
  `vorname` varchar(40) NOT NULL,
  `geschlecht` varchar(20) NOT NULL,
  `geburtsdatum` int(12) DEFAULT NULL,
  `stammgast` int(10) DEFAULT NULL,
  `strasse` varchar(200) NOT NULL,
  `plz` varchar(30) NOT NULL,
  `ort` varchar(100) NOT NULL,
  `email` varchar(30) NOT NULL,
  PRIMARY KEY (`gastID`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gast`
--

LOCK TABLES `gast` WRITE;
/*!40000 ALTER TABLE `gast` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `gast` VALUES (6,'schmidt','herbert','male',-314845200,0,'blumenstraÃŸe 4','gartenhausen','91827','schmidt.herbert@schmidt.de'),(7,'meier','hans','male',5871600,0,'sandkastenstraÃŸe 4','gartenhausen','91827','meier.hans@hans.de'),(8,'huber','isabell','female',326757600,0,'teichstraÃŸe 4','gartenhausen','91827','huber.isabell@huber.de'),(9,'mÃ¼ller','gÃ¼nter','male',647560800,0,'baumstraÃŸe 4','gartenhausen','91827','mueller.guenter@mueller.de'),(10,'mayer','isolde','female',968536800,0,'buschstraÃŸe 4','gartenhausen','91827','mayer.isolde@isolde.de');
/*!40000 ALTER TABLE `gast` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `gastzimmer`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `gastzimmer` (
  `gastzimmerID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `gastID` int(6) DEFAULT NULL,
  `zimmerID` int(6) DEFAULT NULL,
  `anreisedatum` int(12) DEFAULT NULL,
  `abreisedatum` int(12) DEFAULT NULL,
  PRIMARY KEY (`gastzimmerID`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `gastzimmer`
--

LOCK TABLES `gastzimmer` WRITE;
/*!40000 ALTER TABLE `gastzimmer` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `gastzimmer` VALUES (1,1,2,1484002800,1489100400),(2,3,6,1486681200,1486854000),(3,5,10,1510268400,1512082800),(4,1,2,1491775200,1497045600),(5,3,6,1552172400,1552345200),(6,5,10,1512860400,1513119600),(7,1,2,1594332000,1599688800),(8,3,6,1494367200,1499810400),(9,5,10,1541804400,1543618800);
/*!40000 ALTER TABLE `gastzimmer` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `hotel`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `hotel` (
  `hotelID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `hotelname` varchar(30) NOT NULL,
  `hotelort` varchar(30) NOT NULL,
  PRIMARY KEY (`hotelID`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `hotel`
--

LOCK TABLES `hotel` WRITE;
/*!40000 ALTER TABLE `hotel` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `hotel` VALUES (1,'Green','Berlin'),(2,'HundO','Erlangen'),(3,'Hugggo','Nuernberg'),(4,'Eston','St. Martin');
/*!40000 ALTER TABLE `hotel` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `mitarbeiter`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `mitarbeiter` (
  `mitarbeiterID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `nachname` varchar(30) NOT NULL,
  `vorname` varchar(30) NOT NULL,
  `hotelID` int(6) DEFAULT NULL,
  PRIMARY KEY (`mitarbeiterID`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `mitarbeiter`
--

LOCK TABLES `mitarbeiter` WRITE;
/*!40000 ALTER TABLE `mitarbeiter` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `mitarbeiter` VALUES (1,'beck','Loggasch',1),(2,'hacker','joachim',1),(3,'heinz','Ismeinz',2),(4,'Gott','Herr',3),(5,'Stein','Heinrich',3);
/*!40000 ALTER TABLE `mitarbeiter` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `preise`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `preise` (
  `preiseID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `kategorie` varchar(20) NOT NULL,
  `zimmerart` varchar(20) NOT NULL,
  `preise` varchar(10) NOT NULL,
  PRIMARY KEY (`preiseID`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `preise`
--

LOCK TABLES `preise` WRITE;
/*!40000 ALTER TABLE `preise` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `preise` VALUES (1,'Standart','Einzelzimmer','50'),(2,'Premium','Einzelzimmer','100'),(3,'Luxus','Einzelzimmer','150'),(4,'Standart','Doppelzimmer','75'),(5,'Premium','Doppelzimmer','150'),(6,'Luxus','Doppelzimmer','225');
/*!40000 ALTER TABLE `preise` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `rechnung`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `rechnung` (
  `rechnungID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `zimmernummer` varchar(10) NOT NULL,
  `hotelID` int(6) DEFAULT NULL,
  `preisID` int(6) DEFAULT NULL,
  PRIMARY KEY (`rechnungID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rechnung`
--

LOCK TABLES `rechnung` WRITE;
/*!40000 ALTER TABLE `rechnung` DISABLE KEYS */;
SET autocommit=0;
/*!40000 ALTER TABLE `rechnung` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

--
-- Table structure for table `zimmer`
--

/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `zimmer` (
  `zimmerID` int(6) unsigned NOT NULL AUTO_INCREMENT,
  `zimmernummer` varchar(10) NOT NULL,
  `hotelID` int(6) DEFAULT NULL,
  `preisID` int(6) DEFAULT NULL,
  PRIMARY KEY (`zimmerID`)
) ENGINE=InnoDB AUTO_INCREMENT=61 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zimmer`
--

LOCK TABLES `zimmer` WRITE;
/*!40000 ALTER TABLE `zimmer` DISABLE KEYS */;
SET autocommit=0;
INSERT INTO `zimmer` VALUES (1,'0123',1,1),(2,'0124',2,1),(3,'0125',3,1),(4,'0126',1,1),(5,'0127',2,1),(6,'0128',3,1),(7,'0129',4,1),(8,'0130',1,2),(9,'0131',2,2),(10,'0132',3,2),(11,'0133',4,2),(12,'0134',1,2),(13,'0135',2,2),(14,'0136',4,2),(15,'0137',3,1),(16,'0138',1,3),(17,'0139',2,3),(18,'0140',3,3),(19,'0141',1,3),(20,'0142',2,3),(21,'0143',3,3),(22,'0144',4,3),(23,'0145',1,3),(24,'0146',2,4),(25,'0147',3,4),(26,'0148',4,4),(27,'0149',1,4),(28,'0150',2,4),(29,'0151',4,4),(30,'0152',3,4),(31,'0153',1,3),(32,'0154',2,3),(33,'0155',3,3),(34,'0156',1,3),(35,'0157',2,3),(36,'0158',3,3),(37,'0159',4,3),(38,'0160',1,3),(39,'0161',2,4),(40,'0162',3,4),(41,'0163',4,4),(42,'0164',1,4),(43,'0165',2,4),(44,'0166',4,4),(45,'0167',3,4),(46,'0168',1,5),(47,'0169',2,5),(48,'0170',3,5),(49,'0171',1,5),(50,'0172',2,5),(51,'0173',3,5),(52,'0174',4,5),(53,'0175',1,6),(54,'0176',2,6),(55,'0177',3,6),(56,'0178',4,6),(57,'0179',1,6),(58,'0180',2,6),(59,'0181',4,6),(60,'0182',3,6);
/*!40000 ALTER TABLE `zimmer` ENABLE KEYS */;
UNLOCK TABLES;
COMMIT;

/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on: Thu, 02 Feb 2017 12:33:49 +0100
