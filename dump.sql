-- MySQL dump 10.13  Distrib 5.5.45, for Linux (x86_64)
--
-- Host: comment-asp.ctscvoby7rnj.ap-northeast-1.rds.amazonaws.com    Database: comment
-- ------------------------------------------------------
-- Server version	5.6.23-log

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
-- Current Database: `comment`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `comment` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `comment`;

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comment` (
  `comment_id` int(11) NOT NULL AUTO_INCREMENT,
  `comment_site_id` int(11) NOT NULL,
  `comment_text` text NOT NULL,
  `comment_sex` int(11) NOT NULL COMMENT '0：デフォルト　1：男　２女',
  `comment_age` int(11) NOT NULL COMMENT '10,20,30,40,50,60',
  `comment_like` int(11) NOT NULL COMMENT '1,2,3,4,5',
  `comment_delete_flg` int(11) NOT NULL COMMENT ' 0：デフォルト　1：削除',
  `comment_reg_datetime` datetime NOT NULL,
  `comment_mod_datetime` datetime NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comment`
--

LOCK TABLES `comment` WRITE;
/*!40000 ALTER TABLE `comment` DISABLE KEYS */;
/*!40000 ALTER TABLE `comment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `customer`
--

DROP TABLE IF EXISTS `customer`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `customer` (
  `customer_id` int(11) NOT NULL AUTO_INCREMENT,
  `customer_name` varchar(255) NOT NULL,
  `customer_mail` varchar(255) NOT NULL,
  `customer_pass` varchar(255) NOT NULL,
  `customer_tel` varchar(255) NOT NULL,
  `customer_address` varchar(255) NOT NULL,
  `customer_auth_hash` varchar(255) NOT NULL,
  `customer_status` int(11) NOT NULL COMMENT '0：仮登録　1：本登録　2：退会',
  `customer_reg_datetime` datetime NOT NULL,
  `customer_mod_datetime` datetime NOT NULL,
  PRIMARY KEY (`customer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `customer`
--

LOCK TABLES `customer` WRITE;
/*!40000 ALTER TABLE `customer` DISABLE KEYS */;
INSERT INTO `customer` VALUES (1,'スポーツホビー','sho.kuroda@gmail.com','7413b5d100579084cfe16636d7ad73cd08f79e6f','090-5555-5555','新宿区','e02a0d7e665d9e6a7fd2e3031c5f83aaf6e1f297',1,'2015-10-05 04:04:19','2015-10-05 04:04:30');
/*!40000 ALTER TABLE `customer` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `payment`
--

DROP TABLE IF EXISTS `payment`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `payment` (
  `payment_id` int(11) NOT NULL AUTO_INCREMENT,
  `payment_customer_id` int(11) NOT NULL,
  `payment_site_id` int(11) NOT NULL,
  `payment_period` int(11) NOT NULL COMMENT '利用期間（日）',
  `payment_price` int(11) NOT NULL,
  `payment_status` int(11) NOT NULL DEFAULT '0' COMMENT '0：未払い　1：支払済',
  `payment_transfer_name` varchar(255) NOT NULL COMMENT '振込元名',
  `payment_approval_datetime` datetime NOT NULL COMMENT '承認日',
  `payment_reg_datetime` datetime NOT NULL,
  `payment_mod_datetime` datetime NOT NULL,
  PRIMARY KEY (`payment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `payment`
--

LOCK TABLES `payment` WRITE;
/*!40000 ALTER TABLE `payment` DISABLE KEYS */;
INSERT INTO `payment` VALUES (1,1,1,7,0,1,'クロダショウ','2015-10-05 04:05:56','2015-10-05 04:05:56','2015-10-05 04:05:56'),(2,1,2,90,60000,0,'クロダショウ','0000-00-00 00:00:00','2015-10-20 22:02:43','2015-10-20 22:02:43'),(3,1,1,270,120000,0,'クロダショウ','0000-00-00 00:00:00','2015-10-20 23:03:25','2015-10-20 23:03:25');
/*!40000 ALTER TABLE `payment` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `site`
--

DROP TABLE IF EXISTS `site`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `site` (
  `site_id` int(11) NOT NULL AUTO_INCREMENT,
  `site_customer_id` int(11) NOT NULL,
  `site_name` varchar(255) NOT NULL,
  `site_url` varchar(255) NOT NULL,
  `site_code` varchar(255) NOT NULL COMMENT '認証コード',
  `site_start_time` datetime NOT NULL,
  `site_end_time` datetime NOT NULL,
  `site_sex_flg` int(11) NOT NULL DEFAULT '0' COMMENT '0：デフォルト　1：利用',
  `site_age_flg` int(11) NOT NULL DEFAULT '0' COMMENT '0：デフォルト　1：利用',
  `site_like_flg` int(11) NOT NULL DEFAULT '0' COMMENT '0：デフォルト　1：利用',
  `site_ng_word` text NOT NULL,
  `site_delete_flg` int(11) NOT NULL COMMENT '0：デフォルト　1：削除済み',
  `site_reg_datetime` datetime NOT NULL,
  `site_mod_datetime` datetime NOT NULL,
  PRIMARY KEY (`site_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `site`
--

LOCK TABLES `site` WRITE;
/*!40000 ALTER TABLE `site` DISABLE KEYS */;
INSERT INTO `site` VALUES (1,1,'スポーツホビー','sportshobby.co.jp','','2015-10-15 00:00:00','2015-10-20 00:00:00',1,1,1,'NGワード',0,'2015-10-05 04:05:12','2015-10-20 23:03:25'),(2,1,'アマトレ','amatrade.jp','','2015-10-20 00:00:00','2016-01-18 00:00:00',1,0,1,'ワード',0,'2015-10-20 22:02:06','2015-10-20 22:10:50'),(3,1,'aaa','esportshobby.co.jp','','0000-00-00 00:00:00','0000-00-00 00:00:00',0,0,0,'ee',0,'2015-10-20 23:04:17','2015-10-20 23:04:17');
/*!40000 ALTER TABLE `site` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Current Database: `golang_bbs_development`
--

CREATE DATABASE /*!32312 IF NOT EXISTS*/ `golang_bbs_development` /*!40100 DEFAULT CHARACTER SET utf8 */;

USE `golang_bbs_development`;

--
-- Table structure for table `comments`
--

DROP TABLE IF EXISTS `comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `comments` (
  `comment_id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `comment_site_id` int(11) NOT NULL,
  `comment_text` varchar(3000) NOT NULL,
  `comment_sex` int(11) NOT NULL,
  `comment_age` int(11) NOT NULL,
  `comment_like` int(11) NOT NULL,
  `comment_delete_flg` int(11) NOT NULL,
  `comment_reg_datetime` datetime NOT NULL,
  `comment_mod_datetime` datetime NOT NULL,
  PRIMARY KEY (`comment_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `comments`
--

LOCK TABLES `comments` WRITE;
/*!40000 ALTER TABLE `comments` DISABLE KEYS */;
INSERT INTO `comments` VALUES (1,0,'ああああ',1,10,1,0,'2015-11-19 00:03:05','2015-11-19 00:03:05'),(2,0,'いいいい',2,20,2,0,'2015-11-19 00:03:17','2015-11-19 00:03:17'),(3,0,'うううう',1,30,3,0,'2015-11-19 00:03:24','2015-11-19 00:03:24'),(4,0,'あいおうえお',2,20,3,0,'2015-11-19 00:12:34','2015-11-19 00:12:34'),(5,0,'ｓｄｓｄふぁｄｓふぁ',0,40,3,0,'2015-11-19 00:39:48','2015-11-19 00:39:48');
/*!40000 ALTER TABLE `comments` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2016-08-30 23:36:07
