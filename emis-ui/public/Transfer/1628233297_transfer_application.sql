/*
SQLyog Ultimate v8.82 
MySQL - 5.5.5-10.4.18-MariaDB : Database - staff_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`staff_db` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;

USE `staff_db`;

/*Table structure for table `transfer_application` */

DROP TABLE IF EXISTS `transfer_application`;

CREATE TABLE `transfer_application` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `transfer_type_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `aplication_number` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transfer_window_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transferType` varchar(60) COLLATE utf8_unicode_ci DEFAULT NULL,
  `applicant_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `transfer_reason_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `preference_school` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dzongkhagApproved` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `transfer_application` */

insert  into `transfer_application`(`id`,`transfer_type_id`,`aplication_number`,`transfer_window_id`,`transferType`,`applicant_name`,`transfer_reason_id`,`description`,`preference_school`,`dzongkhagApproved`,`created_by`,`updated_by`,`created_at`,`updated_at`,`status`) values ('bb07b987-2d57-44da-8d16-63808889f8f0','e2b6ab45-64ca-4b89-9743-9cb5ba45bf75','TR_-202107-0011','e2b6ab45-64ca-4b89-9743-9cb5ba45bf75','inter_transfer','Sonam Choden','4057ad29-caf8-4ed7-ab66-3b24c51e0850','lksdfads',NULL,NULL,'4131',NULL,'2021-07-28 04:00:05',NULL,'Submitted'),('ddde1134-09d4-49fa-8342-e99d1ba16b20','b160ff3a-daad-44c5-ad29-a6af9a48768c','TR_-202107-0012','b160ff3a-daad-44c5-ad29-a6af9a48768c','intra_transfer','Sonam Choden','4057ad29-caf8-4ed7-ab66-3b24c51e0850','isdnfdsfjsdfbsdfbsdfds',NULL,NULL,'4131',NULL,'2021-07-28 04:09:23',NULL,'Submitted');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
