/*
SQLyog Ultimate v8.82 
MySQL - 5.5.5-10.4.28-MariaDB : Database - rexxsystest
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`rexxsystest` /*!40100 DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci */;

USE `rexxsystest`;

/*Table structure for table `rexx_bookings` */

CREATE TABLE `rexx_bookings` (
  `booking_id` int(11) unsigned NOT NULL AUTO_INCREMENT,
  `participation_id` int(11) unsigned NOT NULL,
  `employee_name` varchar(100) DEFAULT NULL,
  `employee_email` varchar(255) NOT NULL,
  `event_id` int(11) unsigned NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `participation_fee` decimal(10,2) unsigned NOT NULL DEFAULT 0.00,
  `event_date` datetime DEFAULT NULL,
  `pversion` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`booking_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
