/*
SQLyog Community v12.2.4 (64 bit)
MySQL - 10.0.19-MariaDB-1~trusty-log : Database - KeyValueStore
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`KeyValueStore` /*!40100 DEFAULT CHARACTER SET utf8 COLLATE utf8_unicode_ci */;

USE `KeyValueStore`;

/*Table structure for table `KeyValue` */

DROP TABLE IF EXISTS `KeyValue`;

CREATE TABLE `KeyValue` (
  `keyValueId` bigint(20) NOT NULL AUTO_INCREMENT,
  `key` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `value` text COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime NOT NULL,
  PRIMARY KEY (`keyValueId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `KeyValue` */

/*Table structure for table `User` */

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
  `userId` int(11) NOT NULL AUTO_INCREMENT,
  `userUUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `status` enum('active','inactive') COLLATE utf8_unicode_ci DEFAULT 'active',
  `createdAt` datetime DEFAULT NULL,
  `updatedAt` datetime DEFAULT NULL,
  PRIMARY KEY (`userId`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `User` */

insert  into `User`(`userId`,`userUUID`,`username`,`password`,`status`,`createdAt`,`updatedAt`) values 
(1,'93988ff7-a14f-11e6-ab1a-08002700bc01','admin','4b1f38381c3730bec443e69af8271332bdb03748','active','2016-11-04 00:06:31','2016-11-04 00:06:31');

/*Table structure for table `UserSession` */

DROP TABLE IF EXISTS `UserSession`;

CREATE TABLE `UserSession` (
  `sessionId` int(11) NOT NULL AUTO_INCREMENT,
  `token` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `userId` int(11) NOT NULL,
  `userUUID` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `createdAt` datetime DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  `expiredAt` datetime DEFAULT NULL,
  PRIMARY KEY (`sessionId`),
  KEY `FK_UserSession-userId` (`userId`),
  CONSTRAINT `FK_UserSession-userId` FOREIGN KEY (`userId`) REFERENCES `User` (`userId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `UserSession` */

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
