/*
SQLyog Ultimate v8.82 
MySQL - 8.0.24 : Database - system_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`system_db` /*!40100 DEFAULT CHARACTER SET latin1 */ /*!80016 DEFAULT ENCRYPTION='N' */;

/*Table structure for table `master_guidelines` */

CREATE TABLE `master_guidelines` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `guideline_for` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `guideline` varchar(500) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `created_by` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8_unicode_ci;

/*Data for the table `master_guidelines` */

insert  into `master_guidelines`(`id`,`guideline_for`,`guideline`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values ('12d212c2-0783-469d-8b44-ac986698f3ce','Organization Establishment Change','guide liasndfkj asjdfas',1,'0f5ec683-2127-4f41-a54f-5f4829893285','0f5ec683-2127-4f41-a54f-5f4829893285','2021-06-14 05:51:46','2021-06-14 05:53:18');
insert  into `master_guidelines`(`id`,`guideline_for`,`guideline`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values ('1e8d8065-23c5-4d13-8319-e07d58c46117','Organization Establishment Change','sekjdfnjsdf aijsnf iajskdfn aisjf niajsdk',1,'0f5ec683-2127-4f41-a54f-5f4829893285','0f5ec683-2127-4f41-a54f-5f4829893285','2021-06-14 05:51:47','2021-06-14 05:53:29');
insert  into `master_guidelines`(`id`,`guideline_for`,`guideline`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values ('4b74a5ce-7a39-4c0d-aa48-3b7d76b070b3','Student Admission Validation','@annoyingmouse never mind... I think this is a bug in select plugin. Please see this post: datatables.net/forums/discussion/53372/…. I have reported this bug and posted my solution based on yours.',0,'0f5ec683-2127-4f41-a54f-5f4829893285','0f5ec683-2127-4f41-a54f-5f4829893285','2021-06-12 09:15:34','2021-06-12 04:11:20');
insert  into `master_guidelines`(`id`,`guideline_for`,`guideline`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values ('518f2190-e557-4322-ad3f-c09db5af685b','Student Admission Validation','I\'ve had a wee look at the css and it\'s changed a little, perhaps raise another question rather than adding a comment? – annoyingmouse May 29 \'18 at 6:',1,'0f5ec683-2127-4f41-a54f-5f4829893285',NULL,'2021-06-12 09:16:02',NULL);
insert  into `master_guidelines`(`id`,`guideline_for`,`guideline`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values ('7304da5c-7c5e-4323-8f16-37037cc1333f','Student Admission Validation','I\'ve had a wee look at the css and it\'s changed a little, perhaps raise another question rather than adding a comment? – annoyingmouse May 29 \'18 at 6:27',1,'0f5ec683-2127-4f41-a54f-5f4829893285',NULL,'2021-06-12 09:16:02',NULL);
insert  into `master_guidelines`(`id`,`guideline_for`,`guideline`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values ('b6cdb66f-29f9-4527-a48d-020cd30fcd52','Organization Establishment','False Error Reporting That A Laravel Eloquent Model Does not implement method \'getQueueableRelations\' intelephense',1,'f9304ca7-d113-4aff-a09e-4e987821fe1f',NULL,'2021-06-14 07:14:50',NULL);
insert  into `master_guidelines`(`id`,`guideline_for`,`guideline`,`status`,`created_by`,`updated_by`,`created_at`,`updated_at`) values ('eeef2f59-2f7e-4606-93cd-b3eaae67a882','Organization Establishment','A clear and concise description of what the bug is.\nIn a Laravel 5.8 project, an class that inherits the base eloquent class Model, Intelephense wrongly reports that the class \"does not implement method \'getQueueableRelations\' intelephense(1037)\".',1,'f9304ca7-d113-4aff-a09e-4e987821fe1f',NULL,'2021-06-14 07:14:51',NULL);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
