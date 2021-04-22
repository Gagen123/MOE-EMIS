/*
SQLyog Ultimate v8.82 
MySQL - 5.0.86-community-nt : Database - usermanagement_db
*********************************************************************
*/

/*!40101 SET NAMES utf8 */;

/*!40101 SET SQL_MODE=''*/;

/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;
CREATE DATABASE /*!32312 IF NOT EXISTS*/`usermanagement_db` /*!40100 DEFAULT CHARACTER SET latin1 */;

USE `usermanagement_db`;

/*Table structure for table `migrations` */

DROP TABLE IF EXISTS `migrations`;

CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL auto_increment,
  `migration` varchar(255) collate utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `migrations` */

insert  into `migrations`(`id`,`migration`,`batch`) values (1,'2016_06_01_000001_create_oauth_auth_codes_table',1),(2,'2016_06_01_000002_create_oauth_access_tokens_table',1),(3,'2016_06_01_000003_create_oauth_refresh_tokens_table',1),(4,'2016_06_01_000004_create_oauth_clients_table',1),(5,'2016_06_01_000005_create_oauth_personal_access_clients_table',1),(6,'2020_12_31_105643_create_table_user_access_token',1);

/*Table structure for table `oauth_access_tokens` */

DROP TABLE IF EXISTS `oauth_access_tokens`;

CREATE TABLE `oauth_access_tokens` (
  `id` varchar(100) collate utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned default NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `name` varchar(255) collate utf8_unicode_ci default NULL,
  `scopes` text collate utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  `expires_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `oauth_access_tokens_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `oauth_access_tokens` */

insert  into `oauth_access_tokens`(`id`,`user_id`,`client_id`,`name`,`scopes`,`revoked`,`created_at`,`updated_at`,`expires_at`) values ('1882e7d7460da7f7d42ae0bad5fb9d7701009e7651d2d8fd05d75edc1050e5cb12b445b5ec907b36',NULL,2,NULL,'[]',0,'2020-12-31 11:34:39','2020-12-31 11:34:39','2021-12-31 11:34:39'),('9cf85bce63430710acc77d054e05b62ee413dca949c127c497904e3ee20f953f14054b4d800ea8c2',NULL,2,NULL,'[]',1,'2020-12-31 11:33:47','2020-12-31 11:33:47','2021-12-31 11:33:47'),('bdc31edaab449e5b1921e21379408389a0dc13a0f39844a464cbf6f5ba423e38343b3b523d135fad',NULL,2,NULL,'[]',1,'2020-12-31 11:31:09','2020-12-31 11:31:09','2021-12-31 11:31:09');

/*Table structure for table `oauth_auth_codes` */

DROP TABLE IF EXISTS `oauth_auth_codes`;

CREATE TABLE `oauth_auth_codes` (
  `id` varchar(100) collate utf8_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `client_id` bigint(20) unsigned NOT NULL,
  `scopes` text collate utf8_unicode_ci,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `oauth_auth_codes_user_id_index` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `oauth_auth_codes` */

/*Table structure for table `oauth_clients` */

DROP TABLE IF EXISTS `oauth_clients`;

CREATE TABLE `oauth_clients` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `user_id` bigint(20) unsigned default NULL,
  `name` varchar(255) collate utf8_unicode_ci NOT NULL,
  `secret` varchar(100) collate utf8_unicode_ci default NULL,
  `provider` varchar(255) collate utf8_unicode_ci default NULL,
  `redirect` text collate utf8_unicode_ci NOT NULL,
  `personal_access_client` tinyint(1) NOT NULL,
  `password_client` tinyint(1) NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`),
  KEY `oauth_clients_user_id_index` (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `oauth_clients` */

insert  into `oauth_clients`(`id`,`user_id`,`name`,`secret`,`provider`,`redirect`,`personal_access_client`,`password_client`,`revoked`,`created_at`,`updated_at`) values (1,NULL,'User Management Personal Access Client','ZPFVU2dN9KFnpkzz9wNOtbS3XYPH2HfbzIlyw61P',NULL,'http://localhost',1,0,0,'2020-12-31 11:27:11','2020-12-31 11:27:11'),(2,NULL,'User Management Password Grant Client','03woaG2vOnwNTEsvXYGzUta3i4jIxIOjNfEuRQK2','users','http://localhost',0,1,0,'2020-12-31 11:27:11','2020-12-31 11:27:11');

/*Table structure for table `oauth_personal_access_clients` */

DROP TABLE IF EXISTS `oauth_personal_access_clients`;

CREATE TABLE `oauth_personal_access_clients` (
  `id` bigint(20) unsigned NOT NULL auto_increment,
  `client_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL default NULL,
  `updated_at` timestamp NULL default NULL,
  PRIMARY KEY  (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `oauth_personal_access_clients` */

insert  into `oauth_personal_access_clients`(`id`,`client_id`,`created_at`,`updated_at`) values (1,1,'2020-12-31 11:27:11','2020-12-31 11:27:11');

/*Table structure for table `oauth_refresh_tokens` */

DROP TABLE IF EXISTS `oauth_refresh_tokens`;

CREATE TABLE `oauth_refresh_tokens` (
  `id` varchar(100) collate utf8_unicode_ci NOT NULL,
  `access_token_id` varchar(100) collate utf8_unicode_ci NOT NULL,
  `revoked` tinyint(1) NOT NULL,
  `expires_at` datetime default NULL,
  PRIMARY KEY  (`id`),
  KEY `oauth_refresh_tokens_access_token_id_index` (`access_token_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

/*Data for the table `oauth_refresh_tokens` */

/*Table structure for table `t_module_details` */

DROP TABLE IF EXISTS `t_module_details`;

CREATE TABLE `t_module_details` (
  `Id` int(11) NOT NULL auto_increment,
  `Module_Name` varchar(100) NOT NULL,
  `Status` enum('Active','In_Active') NOT NULL default 'Active',
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `t_module_details` */

insert  into `t_module_details`(`Id`,`Module_Name`,`Status`) values (1,'Developer Screens','Active'),(2,'System Management','Active');

/*Table structure for table `t_role_master` */

DROP TABLE IF EXISTS `t_role_master`;

CREATE TABLE `t_role_master` (
  `Id` int(11) NOT NULL auto_increment,
  `Role_Name` varchar(100) NOT NULL,
  `Role_Code` varchar(100) default NULL,
  `Role_Description` varchar(200) default NULL,
  `Status` enum('Active','In_Active') NOT NULL default 'Active',
  `Last_Updated_By` int(11) default NULL,
  `Last_Updated_On` datetime default NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `t_role_master` */

insert  into `t_role_master`(`Id`,`Role_Name`,`Role_Code`,`Role_Description`,`Status`,`Last_Updated_By`,`Last_Updated_On`) values (1,'Admin','admin','System Administration of the system','Active',NULL,'2020-12-31 10:52:51'),(2,'Principal','PRINCIPAL','Description of the principal role','Active',NULL,'2020-12-31 10:54:02'),(3,'Assestant Principal','Ass','Assestant principal','Active',NULL,NULL);

/*Table structure for table `t_screen_details` */

DROP TABLE IF EXISTS `t_screen_details`;

CREATE TABLE `t_screen_details` (
  `Id` int(11) NOT NULL auto_increment,
  `Module_Id` int(11) default NULL,
  `Sub_Module_Id` int(11) default NULL,
  `Screen_Name` varchar(100) NOT NULL,
  `Status` enum('Active','In_Active') NOT NULL default 'Active',
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

/*Data for the table `t_screen_details` */

insert  into `t_screen_details`(`Id`,`Module_Id`,`Sub_Module_Id`,`Screen_Name`,`Status`) values (1,NULL,NULL,'Module','Active'),(2,1,3,'screen changed','Active'),(3,2,NULL,'Under System Development Edited','Active'),(4,NULL,NULL,'Direct Screen','Active');

/*Table structure for table `t_sub_module_details` */

DROP TABLE IF EXISTS `t_sub_module_details`;

CREATE TABLE `t_sub_module_details` (
  `Id` int(11) NOT NULL auto_increment,
  `Module_Id` int(11) NOT NULL,
  `Sub_Module_Name` varchar(100) NOT NULL,
  `Status` enum('Active','In_Active') NOT NULL default 'Active',
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

/*Data for the table `t_sub_module_details` */

insert  into `t_sub_module_details`(`Id`,`Module_Id`,`Sub_Module_Name`,`Status`) values (1,1,'Module','Active'),(2,1,'Sub Modules','Active'),(3,1,'Screens','Active');

/*Table structure for table `t_system_master` */

DROP TABLE IF EXISTS `t_system_master`;

CREATE TABLE `t_system_master` (
  `Id` int(11) NOT NULL auto_increment,
  `System_Name` varchar(200) NOT NULL,
  `Code` varchar(100) NOT NULL,
  `Redirection` varchar(200) NOT NULL,
  `Status` enum('Active','In_Active') default 'Active',
  `Added_By` int(11) NOT NULL,
  `Added_On` datetime default NULL,
  `Last_Updated_By` int(11) default NULL,
  `Last_Updated_On` datetime default NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `t_system_master` */

insert  into `t_system_master`(`Id`,`System_Name`,`Code`,`Redirection`,`Status`,`Added_By`,`Added_On`,`Last_Updated_By`,`Last_Updated_On`) values (1,'MOE-User Management','User_Management','http://localhost:82/moe-usermanagement/usermanagement-ui/public/dashboard','Active',0,NULL,1,'2020-12-31 10:18:03'),(2,'Teacher Requirement Excercise','TRE','http://localhost:83/emis-usermanagementV1/public/dashboard','Active',1,'2020-12-31 10:16:01',NULL,NULL);

/*Table structure for table `t_system_role_mapping` */

DROP TABLE IF EXISTS `t_system_role_mapping`;

CREATE TABLE `t_system_role_mapping` (
  `Id` int(11) NOT NULL auto_increment,
  `Role_Id` int(11) NOT NULL,
  `System_Id` int(11) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

/*Data for the table `t_system_role_mapping` */

insert  into `t_system_role_mapping`(`Id`,`Role_Id`,`System_Id`) values (1,1,1),(2,2,2);

/*Table structure for table `t_user_master` */

DROP TABLE IF EXISTS `t_user_master`;

CREATE TABLE `t_user_master` (
  `Id` int(11) NOT NULL auto_increment,
  `User_Name` varchar(100) NOT NULL,
  `User_Password` varchar(255) NOT NULL,
  `Passport_CID` varchar(100) default NULL,
  `Full_Name` varchar(200) NOT NULL,
  `Contact_Number` varchar(100) NOT NULL,
  `Email` varchar(100) default NULL,
  `Status` enum('Active','In_Active') NOT NULL default 'Active',
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `t_user_master` */

insert  into `t_user_master`(`Id`,`User_Name`,`User_Password`,`Passport_CID`,`Full_Name`,`Contact_Number`,`Email`,`Status`) values (1,'admin','$2y$10$RP4KXnyj2fJy76ThOvPaku1zNTYHqmP5aPp4V5d66av9L/8XSmWtS','123123','Administrator','123','email','Active');

/*Table structure for table `t_user_role_mapping` */

DROP TABLE IF EXISTS `t_user_role_mapping`;

CREATE TABLE `t_user_role_mapping` (
  `Id` int(11) NOT NULL auto_increment,
  `User_Id` int(11) NOT NULL,
  `Role_Id` int(11) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `t_user_role_mapping` */

insert  into `t_user_role_mapping`(`Id`,`User_Id`,`Role_Id`) values (1,1,1);

/*Table structure for table `t_user_system_mapping` */

DROP TABLE IF EXISTS `t_user_system_mapping`;

CREATE TABLE `t_user_system_mapping` (
  `Id` int(11) NOT NULL auto_increment,
  `User_Id` int(11) NOT NULL,
  `System_Id` int(11) NOT NULL,
  PRIMARY KEY  (`Id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

/*Data for the table `t_user_system_mapping` */

insert  into `t_user_system_mapping`(`Id`,`User_Id`,`System_Id`) values (1,1,1);

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
