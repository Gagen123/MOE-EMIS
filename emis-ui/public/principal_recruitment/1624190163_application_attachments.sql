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

/*Table structure for table `application_attachments` */

DROP TABLE IF EXISTS `application_attachments`;

CREATE TABLE `application_attachments` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApplicationDetailsId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ApplicationVerificationId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_defined_file_name` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `path` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `upload_type` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_app_attachments_application_details1_idx` (`ApplicationDetailsId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

/*Data for the table `application_attachments` */

insert  into `application_attachments`(`id`,`ApplicationDetailsId`,`ApplicationVerificationId`,`name`,`user_defined_file_name`,`path`,`upload_type`,`created_by`,`updated_by`,`created_at`,`updated_at`) values ('a0bd6b82-1d48-4097-8fdc-d5cb59831bdc','f8032da8-06d4-430c-8762-7fcc111d7205',NULL,'1624181612_usermanagement_dum.sql','references','D:/file_store/principal_recruitment',NULL,NULL,NULL,'2021-06-20 15:33:32.000000','2021-06-20 15:33:32.000000'),('e08e130f-7ad2-4712-9d41-937c639444c6','f3d0362d-66b2-47ca-b311-d2edcc0d2d10',NULL,'1624183196_emis_organization (5).sql','references','D:/file_store/principal_recruitment',NULL,NULL,NULL,'2021-06-20 15:59:56.000000','2021-06-20 15:59:56.000000');

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
