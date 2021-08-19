-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jul 13, 2021 at 06:06 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `emis_academic_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `aca_absence_reason`
--

CREATE TABLE `aca_absence_reason` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0-Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_assessment_area`
--

CREATE TABLE `aca_assessment_area` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dzo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `code` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_rating_type_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_order` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0-Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aca_assessment_area`
--

INSERT INTO `aca_assessment_area` (`id`, `aca_sub_id`, `name`, `dzo_name`, `code`, `aca_rating_type_id`, `display_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('014e5613-b8d0-11eb-b80d-b07b2586b8c6', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Areas for Growth', '', 'AG', NULL, 22, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('017dd42b-deed-11eb-9029-e89eb413ce43', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Reading Portfolio', '', 'RP', NULL, 17, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('02264731-def9-11eb-9029-e89eb413ce43', '9bb96ba6-de98-11eb-9029-e89eb413ce43', 'Class Activity', '', 'CA', NULL, 60, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('0557a7e1-d02a-11eb-a9e6-e89eb413ce43', '2f733141-d029-11eb-a9e6-e89eb413ce43', ' History, Civics & Culture (Class Activity)', '', 'HC&C (CA)', NULL, 88, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('0717dab2-def7-11eb-9029-e89eb413ce43', '6a7a26d1-de97-11eb-9029-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 58, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('0d083e82-b8d2-11eb-b80d-b07b2586b8c6', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Data Management & Probability', '', 'DM&P', NULL, 34, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('0dfef1cb-b8ce-11eb-b80d-b07b2586b8c6', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Language & Grammar', 'སྐད་ཡིག་དང་ཡིག་སྦྱོར།', 'L&G', NULL, 5, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1177ecb8-b8d5-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Social Etiquettes', '', 'SE', NULL, 245, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1296952d-defa-11eb-9029-e89eb413ce43', '3ce9cdb1-b8c9-11eb-b80d-b07b2586b8c6', 'Assignment', '', 'Ass', NULL, 65, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('12969534-defa-11eb-9029-e89eb413ce43', '3ce9cdb1-b8c9-11eb-b80d-b07b2586b8c6', 'Class Activity', '', 'CA', NULL, 66, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('12969536-defa-11eb-9029-e89eb413ce43', '3ce9cdb1-b8c9-11eb-b80d-b07b2586b8c6', 'Test', '', 'T', NULL, 67, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('12969537-defa-11eb-9029-e89eb413ce43', '3ce9cdb1-b8c9-11eb-b80d-b07b2586b8c6', 'Project', '', 'P', NULL, 68, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('188b866f-d027-11eb-a9e6-e89eb413ce43', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Facts & Procedures', '', 'F&P', NULL, 28, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('19805e59-e09e-11eb-bd8c-e89eb413ce43', '772478db-dec6-11eb-9029-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 178, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('19805e5f-e09e-11eb-bd8c-e89eb413ce43', '772478db-dec6-11eb-9029-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 180, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('19805e61-e09e-11eb-bd8c-e89eb413ce43', '41f56c70-cefc-11eb-8c53-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 181, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('19805e63-e09e-11eb-bd8c-e89eb413ce43', '41f56c70-cefc-11eb-8c53-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 182, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('19805e64-e09e-11eb-bd8c-e89eb413ce43', '41f56c70-cefc-11eb-8c53-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 183, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('19805e66-e09e-11eb-bd8c-e89eb413ce43', '41f56c70-cefc-11eb-8c53-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 184, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('19805e67-e09e-11eb-bd8c-e89eb413ce43', '41f56c70-cefc-11eb-8c53-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 185, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('19805e69-e09e-11eb-bd8c-e89eb413ce43', '5d35b1ef-d02c-11eb-a9e6-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 186, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1adaeb50-b8d5-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Civic Sense', '', 'CS', NULL, 246, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbd7c-df02-11eb-9029-e89eb413ce43', 'ec491ebe-de97-11eb-9029-e89eb413ce43', 'Assignment', '', 'ASS', NULL, 104, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbd81-df02-11eb-9029-e89eb413ce43', 'ec491ebe-de97-11eb-9029-e89eb413ce43', 'Presentation', '', 'PRE', NULL, 105, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbd84-df02-11eb-9029-e89eb413ce43', 'ec491ebe-de97-11eb-9029-e89eb413ce43', 'Model Making', '', 'MM', NULL, 106, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbd88-df02-11eb-9029-e89eb413ce43', 'ec491ebe-de97-11eb-9029-e89eb413ce43', 'Practical', '', 'PRAC', NULL, 107, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbd8c-df02-11eb-9029-e89eb413ce43', 'ec491ebe-de97-11eb-9029-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 108, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbd90-df02-11eb-9029-e89eb413ce43', 'ec491ebe-de97-11eb-9029-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 109, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbd94-df02-11eb-9029-e89eb413ce43', 'b1a51a08-de9b-11eb-9029-e89eb413ce43', 'Assignment', '', 'ASS', NULL, 110, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbd98-df02-11eb-9029-e89eb413ce43', 'b1a51a08-de9b-11eb-9029-e89eb413ce43', 'Class Activity', '', 'AE', NULL, 111, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbd9c-df02-11eb-9029-e89eb413ce43', 'b1a51a08-de9b-11eb-9029-e89eb413ce43', 'Practical Work/Field Exercise', '', 'PRACT-W|FE', NULL, 112, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbda0-df02-11eb-9029-e89eb413ce43', 'b1a51a08-de9b-11eb-9029-e89eb413ce43', 'Test', '', 'T', NULL, 113, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbda4-df02-11eb-9029-e89eb413ce43', 'b1a51a08-de9b-11eb-9029-e89eb413ce43', 'Project Work', '', 'PW', NULL, 114, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbda8-df02-11eb-9029-e89eb413ce43', 'b1a51a08-de9b-11eb-9029-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 115, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1b8bbdac-df02-11eb-9029-e89eb413ce43', 'b1a51a08-de9b-11eb-9029-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 116, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('1c2cebe6-b8d2-11eb-b80d-b07b2586b8c6', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Areas of Strength', '', 'AS', NULL, 35, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2165f6a0-e0ab-11eb-bd8c-e89eb413ce43', 'f6e28e34-decc-11eb-9029-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 230, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2165f6a6-e0ab-11eb-bd8c-e89eb413ce43', '67ef35a1-decd-11eb-9029-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 231, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2165f6a9-e0ab-11eb-bd8c-e89eb413ce43', '67ef35a1-decd-11eb-9029-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 232, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2165f6aa-e0ab-11eb-bd8c-e89eb413ce43', '67ef35a1-decd-11eb-9029-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', '', NULL, 233, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2165f6ac-e0ab-11eb-bd8c-e89eb413ce43', '67ef35a1-decd-11eb-9029-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 234, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2165f6ad-e0ab-11eb-bd8c-e89eb413ce43', '67ef35a1-decd-11eb-9029-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 235, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2165f6af-e0ab-11eb-bd8c-e89eb413ce43', '86a6dcc7-e0ab-11eb-bd8c-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 236, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2165f6b1-e0ab-11eb-bd8c-e89eb413ce43', '86a6dcc7-e0ab-11eb-bd8c-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 237, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('25928f8e-b8d5-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'General Appearance', '', 'GA', NULL, 247, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2a5aaba2-deed-11eb-9029-e89eb413ce43', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Writing Portfolio', '', 'WP', NULL, 20, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2b67adad-b8d2-11eb-b80d-b07b2586b8c6', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Areas for Growth', '', 'AG', NULL, 36, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2bc6a897-dee8-11eb-9029-e89eb413ce43', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 13, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('2d927f7f-d02a-11eb-a9e6-e89eb413ce43', '2f733141-d029-11eb-a9e6-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 94, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('30263857-b8d5-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Participation in Cultural Activities', '', 'PCA', NULL, 248, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3a6ad239-b8d5-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Participation in Games & Sports', '', 'PGS', NULL, 249, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3bf440c0-e0a7-11eb-bd8c-e89eb413ce43', '69a4c327-decb-11eb-9029-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 202, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3bf440c6-e0a7-11eb-bd8c-e89eb413ce43', '69a4c327-decb-11eb-9029-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 203, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3bf440c8-e0a7-11eb-bd8c-e89eb413ce43', '69a4c327-decb-11eb-9029-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 204, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3bf440cb-e0a7-11eb-bd8c-e89eb413ce43', '69a4c327-decb-11eb-9029-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 205, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3d2905c8-b8d2-11eb-b80d-b07b2586b8c6', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Recommended Action(s)', '', 'RA', NULL, 37, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3d948429-e0aa-11eb-bd8c-e89eb413ce43', '58994546-cefd-11eb-8c53-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 214, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3d948430-e0aa-11eb-bd8c-e89eb413ce43', '58994546-cefd-11eb-8c53-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 215, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3d948432-e0aa-11eb-bd8c-e89eb413ce43', '30c668c2-decc-11eb-9029-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 216, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3d948433-e0aa-11eb-bd8c-e89eb413ce43', '30c668c2-decc-11eb-9029-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 217, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3d948435-e0aa-11eb-bd8c-e89eb413ce43', '30c668c2-decc-11eb-9029-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 218, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3d948436-e0aa-11eb-bd8c-e89eb413ce43', '30c668c2-decc-11eb-9029-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 219, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3d948438-e0aa-11eb-bd8c-e89eb413ce43', '30c668c2-decc-11eb-9029-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 220, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3d94843a-e0aa-11eb-bd8c-e89eb413ce43', '9dd9405d-decc-11eb-9029-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 221, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db4f669-df0a-11eb-9029-e89eb413ce43', '029773c2-cef4-11eb-8c53-e89eb413ce43', 'Assignment', '', 'ASS', NULL, 117, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50f98-df0a-11eb-9029-e89eb413ce43', '029773c2-cef4-11eb-8c53-e89eb413ce43', 'Class Activity', '', 'CA', NULL, 118, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fa1-df0a-11eb-9029-e89eb413ce43', '029773c2-cef4-11eb-8c53-e89eb413ce43', 'Test', '', 'T', NULL, 119, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fa5-df0a-11eb-9029-e89eb413ce43', '029773c2-cef4-11eb-8c53-e89eb413ce43', 'Project Work', '', 'PW', NULL, 120, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fa9-df0a-11eb-9029-e89eb413ce43', '029773c2-cef4-11eb-8c53-e89eb413ce43', 'Environmental Profile', '', 'EP', NULL, 121, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fae-df0a-11eb-9029-e89eb413ce43', '029773c2-cef4-11eb-8c53-e89eb413ce43', 'Mid Term Examination', '', 'AE', NULL, 122, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fb1-df0a-11eb-9029-e89eb413ce43', '029773c2-cef4-11eb-8c53-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 123, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fb5-df0a-11eb-9029-e89eb413ce43', '514070b5-cef8-11eb-8c53-e89eb413ce43', 'Economic Knowledge', '', 'EK', NULL, 124, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fb9-df0a-11eb-9029-e89eb413ce43', '514070b5-cef8-11eb-8c53-e89eb413ce43', 'Economic skills', '', 'ES', NULL, 125, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fbe-df0a-11eb-9029-e89eb413ce43', '514070b5-cef8-11eb-8c53-e89eb413ce43', 'Economics Values & Attitude', '', 'EV&A', NULL, 126, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fc2-df0a-11eb-9029-e89eb413ce43', '514070b5-cef8-11eb-8c53-e89eb413ce43', 'Mid Term Examination', '', 'AE', NULL, 127, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fc6-df0a-11eb-9029-e89eb413ce43', '514070b5-cef8-11eb-8c53-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 128, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fca-df0a-11eb-9029-e89eb413ce43', 'c14eddcc-de9b-11eb-9029-e89eb413ce43', 'Class Activity', '', 'CA', NULL, 129, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('3db50fce-df0a-11eb-9029-e89eb413ce43', 'c14eddcc-de9b-11eb-9029-e89eb413ce43', 'Home Activity', '', 'HA', NULL, 130, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('4400806d-b8d5-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Participation in Literary Activities', '', 'PLA', NULL, 250, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('4516ab48-dee9-11eb-9029-e89eb413ce43', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Writing', 'འབྲི་ནི།', 'W', NULL, 7, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('472d658e-d026-11eb-a9e6-e89eb413ce43', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Reading', '', 'R', NULL, 16, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('4851693d-def6-11eb-9029-e89eb413ce43', 'c00d93b6-b8cb-11eb-b80d-b07b2586b8c6', 'Assignment', '', 'Ass', NULL, 45, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('4c0a5baf-b8d5-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Areas of Strength', '', 'AS', NULL, 251, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('50b5e14c-d027-11eb-a9e6-e89eb413ce43', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Mid Term Examination', '', 'MTE', NULL, 38, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('51e384e2-def9-11eb-9029-e89eb413ce43', '9bb96ba6-de98-11eb-9029-e89eb413ce43', 'Test', '', 'T', NULL, 61, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('56b7f0d6-b8ce-11eb-b80d-b07b2586b8c6', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Writing Portfolio', 'འབྲི་ནི་ཡིག་སྣོད།', 'WP', NULL, 6, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('5720f404-b8d5-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Areas for Growth', '', 'AG', NULL, 252, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('57cecd5f-def2-11eb-9029-e89eb413ce43', '75eedb73-cef6-11eb-8c53-e89eb413ce43', 'Home Activity', '', 'HA', NULL, 41, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('5e00f90e-defa-11eb-9029-e89eb413ce43', '3ce9cdb1-b8c9-11eb-b80d-b07b2586b8c6', 'Mid Term Examination', '', 'MTE', NULL, 70, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('5e00f914-defa-11eb-9029-e89eb413ce43', '3ce9cdb1-b8c9-11eb-b80d-b07b2586b8c6', 'Annual Examination', '', 'AE', NULL, 71, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('5f69609d-e0c5-11eb-bd8c-e89eb413ce43', '0a734b20-cef8-11eb-8c53-e89eb413ce43', 'Class Work', '', 'CW', NULL, 241, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('5f6960a4-e0c5-11eb-bd8c-e89eb413ce43', '0a734b20-cef8-11eb-8c53-e89eb413ce43', 'Home Work', '', 'HW', NULL, 241, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('5f6960a6-e0c5-11eb-bd8c-e89eb413ce43', '0a734b20-cef8-11eb-8c53-e89eb413ce43', 'Project Work', '', 'PW', NULL, 241, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('5f6960a8-e0c5-11eb-bd8c-e89eb413ce43', '0a734b20-cef8-11eb-8c53-e89eb413ce43', 'Practical', '', 'PRAC', NULL, 241, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('5f6960a9-e0c5-11eb-bd8c-e89eb413ce43', '0a734b20-cef8-11eb-8c53-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 241, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('5f6960ab-e0c5-11eb-bd8c-e89eb413ce43', '0a734b20-cef8-11eb-8c53-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 241, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('61f0ac9d-def2-11eb-9029-e89eb413ce43', '75eedb73-cef6-11eb-8c53-e89eb413ce43', 'Digital Artefacts', '', 'DA', NULL, 42, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('637fea1c-b8d5-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Recommended Action(s)', '', 'RA', NULL, 253, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('64cc4528-e0a5-11eb-bd8c-e89eb413ce43', '5d35b1ef-d02c-11eb-a9e6-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 187, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('64cc452f-e0a5-11eb-bd8c-e89eb413ce43', '5d35b1ef-d02c-11eb-a9e6-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 188, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('64cc4533-e0a5-11eb-bd8c-e89eb413ce43', '5d35b1ef-d02c-11eb-a9e6-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 189, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('64cc4536-e0a5-11eb-bd8c-e89eb413ce43', '5d35b1ef-d02c-11eb-a9e6-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 190, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('64cc4538-e0a5-11eb-bd8c-e89eb413ce43', '7d7f112a-cefd-11eb-8c53-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 191, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('64cc453b-e0a5-11eb-bd8c-e89eb413ce43', '7d7f112a-cefd-11eb-8c53-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 192, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('64cc453d-e0a5-11eb-bd8c-e89eb413ce43', '7d7f112a-cefd-11eb-8c53-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 193, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('64cc453f-e0a5-11eb-bd8c-e89eb413ce43', '7d7f112a-cefd-11eb-8c53-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 194, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('65ded77d-def6-11eb-9029-e89eb413ce43', 'c00d93b6-b8cb-11eb-b80d-b07b2586b8c6', 'Class Activity', '', 'CA', NULL, 46, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('6cb9efca-b8d3-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Leadership Quality', '', 'LQ', NULL, 241, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('6ff07dd8-def2-11eb-9029-e89eb413ce43', '75eedb73-cef6-11eb-8c53-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 43, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('70c529bb-d026-11eb-a9e6-e89eb413ce43', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Mid Term Examination', '', 'MTE', NULL, 24, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('74b25398-def6-11eb-9029-e89eb413ce43', 'c00d93b6-b8cb-11eb-b80d-b07b2586b8c6', 'Test', '', 'T', NULL, 47, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('78cfcff4-defa-11eb-9029-e89eb413ce43', '3ce9cdb1-b8c9-11eb-b80d-b07b2586b8c6', 'Practical', '', 'PRAC', NULL, 69, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf535e-defb-11eb-9029-e89eb413ce43', '7b5a4b19-b8c9-11eb-b80d-b07b2586b8c6', 'Assignment', '', 'Ass', NULL, 72, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf5364-defb-11eb-9029-e89eb413ce43', '7b5a4b19-b8c9-11eb-b80d-b07b2586b8c6', 'Class Activity', '', 'CA', NULL, 73, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf5366-defb-11eb-9029-e89eb413ce43', '7b5a4b19-b8c9-11eb-b80d-b07b2586b8c6', 'Test', '', 'T', NULL, 74, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf5368-defb-11eb-9029-e89eb413ce43', '7b5a4b19-b8c9-11eb-b80d-b07b2586b8c6', 'Project', '', 'P', NULL, 75, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf536a-defb-11eb-9029-e89eb413ce43', '7b5a4b19-b8c9-11eb-b80d-b07b2586b8c6', 'Practical', '', 'PRAC', NULL, 76, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf536b-defb-11eb-9029-e89eb413ce43', '7b5a4b19-b8c9-11eb-b80d-b07b2586b8c6', 'Mid Term Examination', '', 'MTE', NULL, 77, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf536d-defb-11eb-9029-e89eb413ce43', '7b5a4b19-b8c9-11eb-b80d-b07b2586b8c6', 'Annual Examination', '', 'AE', NULL, 78, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf536e-defb-11eb-9029-e89eb413ce43', 'e8600895-b8c9-11eb-b80d-b07b2586b8c6', 'Assignment', '', 'Ass', NULL, 79, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf5370-defb-11eb-9029-e89eb413ce43', 'e8600895-b8c9-11eb-b80d-b07b2586b8c6', 'Class Activity', '', 'CA', NULL, 80, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf5372-defb-11eb-9029-e89eb413ce43', 'e8600895-b8c9-11eb-b80d-b07b2586b8c6', 'Test', '', 'T', NULL, 81, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf5373-defb-11eb-9029-e89eb413ce43', 'e8600895-b8c9-11eb-b80d-b07b2586b8c6', 'Project', '', 'P', NULL, 82, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf5375-defb-11eb-9029-e89eb413ce43', 'e8600895-b8c9-11eb-b80d-b07b2586b8c6', 'Practical', '', 'PRAC', NULL, 83, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf5377-defb-11eb-9029-e89eb413ce43', 'e8600895-b8c9-11eb-b80d-b07b2586b8c6', 'Mid Term Examination', '', 'MTE', NULL, 84, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('79bf5378-defb-11eb-9029-e89eb413ce43', 'e8600895-b8c9-11eb-b80d-b07b2586b8c6', 'Annual Examination', '', 'AE', NULL, 85, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7a1897a6-def8-11eb-9029-e89eb413ce43', '9bb96ba6-de98-11eb-9029-e89eb413ce43', 'Assignment', '', 'Ass', NULL, 59, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630bb-defd-11eb-9029-e89eb413ce43', '2f733141-d029-11eb-a9e6-e89eb413ce43', ' History, Civics & Culture (Project Work)', '', 'HC&C (PW)', NULL, 89, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630c4-defd-11eb-9029-e89eb413ce43', '2f733141-d029-11eb-a9e6-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 95, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630c6-defd-11eb-9029-e89eb413ce43', '2f733141-d029-11eb-a9e6-e89eb413ce43', 'Human Wellbeing & the Environment (Class Activity)', '', 'HW&E (CA)', NULL, 90, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630c8-defd-11eb-9029-e89eb413ce43', '2f733141-d029-11eb-a9e6-e89eb413ce43', 'Human Wellbeing & the Environment (Project Work)', '', 'HW&E (PW)', NULL, 91, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630ca-defd-11eb-9029-e89eb413ce43', '2f733141-d029-11eb-a9e6-e89eb413ce43', 'Economy & Living (Class Activity)', '', 'E&L (CA)', NULL, 92, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630cb-defd-11eb-9029-e89eb413ce43', '2f733141-d029-11eb-a9e6-e89eb413ce43', 'Economy & Living (Project Work)', '', 'E&L (PW)', NULL, 93, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630cd-defd-11eb-9029-e89eb413ce43', '0bc3a3dc-b8ca-11eb-b80d-b07b2586b8c6', 'Research Project', '', 'RP', NULL, 96, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630cf-defd-11eb-9029-e89eb413ce43', '0bc3a3dc-b8ca-11eb-b80d-b07b2586b8c6', 'Historical Memoir', '', 'HMe', NULL, 97, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630d0-defd-11eb-9029-e89eb413ce43', '0bc3a3dc-b8ca-11eb-b80d-b07b2586b8c6', 'Class Activity', '', 'CA', NULL, 98, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630d2-defd-11eb-9029-e89eb413ce43', '0bc3a3dc-b8ca-11eb-b80d-b07b2586b8c6', 'Home Activity', '', 'HA', NULL, 99, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630d3-defd-11eb-9029-e89eb413ce43', '0bc3a3dc-b8ca-11eb-b80d-b07b2586b8c6', 'History Museum', '', 'HMu', NULL, 100, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630d5-defd-11eb-9029-e89eb413ce43', '0bc3a3dc-b8ca-11eb-b80d-b07b2586b8c6', 'Mid Term Examination', '', 'MTE', NULL, 101, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630d7-defd-11eb-9029-e89eb413ce43', '0bc3a3dc-b8ca-11eb-b80d-b07b2586b8c6', 'Annual Examination', '', 'AE', NULL, 102, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('7ba630d8-defd-11eb-9029-e89eb413ce43', 'ec491ebe-de97-11eb-9029-e89eb413ce43', 'Project work', '', 'PW', NULL, 103, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('80bc378b-def2-11eb-9029-e89eb413ce43', '75eedb73-cef6-11eb-8c53-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 44, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('86a6dcbc-e0ab-11eb-bd8c-e89eb413ce43', '86a6dcc7-e0ab-11eb-bd8c-e89eb413ce43', '', 'བསམ་སྤྱོད།', '', NULL, 238, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('86a6dcc1-e0ab-11eb-bd8c-e89eb413ce43', '86a6dcc7-e0ab-11eb-bd8c-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 239, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('86a6dcc4-e0ab-11eb-bd8c-e89eb413ce43', '86a6dcc7-e0ab-11eb-bd8c-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 240, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('86a6dcc9-e0ab-11eb-bd8c-e89eb413ce43', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Annual Examination', '', 'AE', NULL, 25, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('8b63edee-def6-11eb-9029-e89eb413ce43', 'c00d93b6-b8cb-11eb-b80d-b07b2586b8c6', 'Project', '', 'P', NULL, 48, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('8c2df4ca-deef-11eb-9029-e89eb413ce43', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Interpreting Mathematical Results', '', 'IMR', NULL, 29, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('8c4074f8-def9-11eb-9029-e89eb413ce43', '9bb96ba6-de98-11eb-9029-e89eb413ce43', 'Project', '', 'P', NULL, 62, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('8c407500-def9-11eb-9029-e89eb413ce43', '9bb96ba6-de98-11eb-9029-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 63, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('8c407502-def9-11eb-9029-e89eb413ce43', '9bb96ba6-de98-11eb-9029-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 64, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('8eb386bc-df11-11eb-9029-e89eb413ce43', 'd6d2410a-cefc-11eb-8c53-e89eb413ce43', 'Class Activity', '', 'CA', NULL, 158, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('8eb386c8-df11-11eb-9029-e89eb413ce43', 'd6d2410a-cefc-11eb-8c53-e89eb413ce43', 'Assignment', '', 'ASS', NULL, 160, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('8eb386cb-df11-11eb-9029-e89eb413ce43', 'd6d2410a-cefc-11eb-8c53-e89eb413ce43', 'Presentations', '', 'P', NULL, 161, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('8eb386cd-df11-11eb-9029-e89eb413ce43', 'd6d2410a-cefc-11eb-8c53-e89eb413ce43', 'Project Work', '', 'PW', NULL, 162, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('8eb386ce-df11-11eb-9029-e89eb413ce43', 'd6d2410a-cefc-11eb-8c53-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 163, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('8eb386d0-df11-11eb-9029-e89eb413ce43', 'd6d2410a-cefc-11eb-8c53-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 164, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('96d00377-def6-11eb-9029-e89eb413ce43', 'c00d93b6-b8cb-11eb-b80d-b07b2586b8c6', 'Scrap', '', 'S', NULL, 49, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('99f07592-d025-11eb-a9e6-e89eb413ce43', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 12, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('9e23e203-def1-11eb-9029-e89eb413ce43', '75eedb73-cef6-11eb-8c53-e89eb413ce43', 'Class Activity', '', 'CA', NULL, 40, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a13a7d38-def6-11eb-9029-e89eb413ce43', 'c00d93b6-b8cb-11eb-b80d-b07b2586b8c6', 'Mid Term Examination', '', 'MTE', NULL, 50, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fc8-df0d-11eb-9029-e89eb413ce43', 'c14eddcc-de9b-11eb-9029-e89eb413ce43', 'Presentations', '', 'P', NULL, 131, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fce-df0d-11eb-9029-e89eb413ce43', 'c14eddcc-de9b-11eb-9029-e89eb413ce43', 'Small-Scale Research', '', 'SSR', NULL, 132, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fd0-df0d-11eb-9029-e89eb413ce43', 'c14eddcc-de9b-11eb-9029-e89eb413ce43', 'Case Studies', '', 'CS', NULL, 133, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fd2-df0d-11eb-9029-e89eb413ce43', 'c14eddcc-de9b-11eb-9029-e89eb413ce43', 'Project Work', '', 'PW', NULL, 134, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fd3-df0d-11eb-9029-e89eb413ce43', 'c14eddcc-de9b-11eb-9029-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 135, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fd5-df0d-11eb-9029-e89eb413ce43', 'c14eddcc-de9b-11eb-9029-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 136, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fd6-df0d-11eb-9029-e89eb413ce43', 'b1204e8f-cefd-11eb-8c53-e89eb413ce43', 'Class Work', '', 'CW', NULL, 137, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fd8-df0d-11eb-9029-e89eb413ce43', 'b1204e8f-cefd-11eb-8c53-e89eb413ce43', 'Home Work', '', 'HW', NULL, 138, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fda-df0d-11eb-9029-e89eb413ce43', 'b1204e8f-cefd-11eb-8c53-e89eb413ce43', 'Presentations', '', 'P', NULL, 139, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fdb-df0d-11eb-9029-e89eb413ce43', 'b1204e8f-cefd-11eb-8c53-e89eb413ce43', 'Small-Scale Research', '', 'SSR', NULL, 140, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fdd-df0d-11eb-9029-e89eb413ce43', 'b1204e8f-cefd-11eb-8c53-e89eb413ce43', 'Case Studies', '', 'CS', NULL, 141, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fdf-df0d-11eb-9029-e89eb413ce43', 'b1204e8f-cefd-11eb-8c53-e89eb413ce43', 'Project Work,', '', 'PW', NULL, 142, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fe0-df0d-11eb-9029-e89eb413ce43', 'b1204e8f-cefd-11eb-8c53-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 143, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a3308fe2-df0d-11eb-9029-e89eb413ce43', 'b1204e8f-cefd-11eb-8c53-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 144, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a5447cda-b8ce-11eb-b80d-b07b2586b8c6', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Areas of Strength', 'ལྕོགས་གྲུབ།', 'AS', NULL, 9, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a9c83099-e0aa-11eb-bd8c-e89eb413ce43', '9dd9405d-decc-11eb-9029-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 222, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a9c8309e-e0aa-11eb-bd8c-e89eb413ce43', '9dd9405d-decc-11eb-9029-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 223, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a9c830a0-e0aa-11eb-bd8c-e89eb413ce43', '9dd9405d-decc-11eb-9029-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 224, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a9c830a2-e0aa-11eb-bd8c-e89eb413ce43', '9dd9405d-decc-11eb-9029-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 225, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a9c830a4-e0aa-11eb-bd8c-e89eb413ce43', 'f6e28e34-decc-11eb-9029-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 226, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a9c830a5-e0aa-11eb-bd8c-e89eb413ce43', 'f6e28e34-decc-11eb-9029-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 227, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a9c830a7-e0aa-11eb-bd8c-e89eb413ce43', 'f6e28e34-decc-11eb-9029-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 228, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('a9c830a8-e0aa-11eb-bd8c-e89eb413ce43', 'f6e28e34-decc-11eb-9029-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 229, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('aaa62102-dd49-11eb-9d5b-e89eb413ce43', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Listening & Speaking', 'ཉན་སླབ།', 'L&S', NULL, 1, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d313b-df0f-11eb-9029-e89eb413ce43', 'fd9b9ca3-cefd-11eb-8c53-e89eb413ce43', 'Class Work', '', 'CW', NULL, 145, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d3143-df0f-11eb-9029-e89eb413ce43', 'fd9b9ca3-cefd-11eb-8c53-e89eb413ce43', 'Home Work', '', 'HW', NULL, 146, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d3145-df0f-11eb-9029-e89eb413ce43', 'fd9b9ca3-cefd-11eb-8c53-e89eb413ce43', 'Presentations', '', 'P', NULL, 147, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d3147-df0f-11eb-9029-e89eb413ce43', 'fd9b9ca3-cefd-11eb-8c53-e89eb413ce43', 'Small-Scale Research', '', 'SSR', NULL, 148, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d3149-df0f-11eb-9029-e89eb413ce43', 'fd9b9ca3-cefd-11eb-8c53-e89eb413ce43', 'Case Studies', '', 'CS', NULL, 149, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d314a-df0f-11eb-9029-e89eb413ce43', 'fd9b9ca3-cefd-11eb-8c53-e89eb413ce43', 'Project Work,', '', 'PW', NULL, 150, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d314c-df0f-11eb-9029-e89eb413ce43', 'fd9b9ca3-cefd-11eb-8c53-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 151, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d314e-df0f-11eb-9029-e89eb413ce43', 'fd9b9ca3-cefd-11eb-8c53-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 152, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d314f-df0f-11eb-9029-e89eb413ce43', '8d762e53-cef8-11eb-8c53-e89eb413ce43', 'Media Knowledge', '', 'MK', NULL, 153, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d3151-df0f-11eb-9029-e89eb413ce43', '8d762e53-cef8-11eb-8c53-e89eb413ce43', 'Media Skills', '', 'MS', NULL, 154, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d3153-df0f-11eb-9029-e89eb413ce43', '8d762e53-cef8-11eb-8c53-e89eb413ce43', 'Media Values & Attitude', '', 'MV&A', NULL, 155, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d3154-df0f-11eb-9029-e89eb413ce43', '8d762e53-cef8-11eb-8c53-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 156, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ac7d3157-df0f-11eb-9029-e89eb413ce43', '8d762e53-cef8-11eb-8c53-e89eb413ce43', 'Annual Examination', '', 'AE', NULL, 157, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ae606f06-d024-11eb-a9e6-e89eb413ce43', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Reading', 'ལྷག་རིག།', 'R', NULL, 3, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('af7a264c-def6-11eb-9029-e89eb413ce43', 'c00d93b6-b8cb-11eb-b80d-b07b2586b8c6', 'Annual Examination', '', 'AE', NULL, 51, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('af9264a7-b8d0-11eb-b80d-b07b2586b8c6', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Recommended Action(s)', 'དང་ལེན་གྲོས་འཆར།', 'RA', NULL, 11, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('b0b2e01b-e09b-11eb-bd8c-e89eb413ce43', '619fe69a-dec1-11eb-9029-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 165, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('b0b2e021-e09b-11eb-bd8c-e89eb413ce43', '619fe69a-dec1-11eb-9029-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 166, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('b0b2e023-e09b-11eb-bd8c-e89eb413ce43', '619fe69a-dec1-11eb-9029-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 167, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('b0b2e025-e09b-11eb-bd8c-e89eb413ce43', '619fe69a-dec1-11eb-9029-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 168, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('b0b2e026-e09b-11eb-bd8c-e89eb413ce43', '619fe69a-dec1-11eb-9029-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 169, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('b0b2e029-e09b-11eb-bd8c-e89eb413ce43', '7d36c907-dec1-11eb-9029-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 170, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('b0b2e02b-e09b-11eb-bd8c-e89eb413ce43', '7d36c907-dec1-11eb-9029-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 171, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('b2889780-d026-11eb-a9e6-e89eb413ce43', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Formulating Situations Mathematically', '', 'FSM', NULL, 26, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('bc29e2b4-b8ce-11eb-b80d-b07b2586b8c6', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Areas for Growth', 'ལྕོགས་གྲུབ་ཡར་སྐྱེད།', 'AG', NULL, 10, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('bc5baf75-deeb-11eb-9029-e89eb413ce43', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Over all Behaviour', 'སྤྱིར་བཏང་གི་སྤྱོད་ལམ།', 'OB', NULL, 8, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('bcdc386c-deea-11eb-9029-e89eb413ce43', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Reading Portfolio', 'ལྷག་རིག་ཡིག་སྣོད', 'RP', NULL, 4, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('c25333d0-b8d0-11eb-b80d-b07b2586b8c6', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Recommended Action(s)', '', 'RA', NULL, 23, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('c2f9f39d-b8d1-11eb-b80d-b07b2586b8c6', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Number & Operations', '', 'N&O', NULL, 30, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('c48ddc77-def6-11eb-9029-e89eb413ce43', '6a7a26d1-de97-11eb-9029-e89eb413ce43', 'Assignment', '', 'Ass', NULL, 52, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('c9754796-e09c-11eb-bd8c-e89eb413ce43', '7d36c907-dec1-11eb-9029-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 172, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('c975479d-e09c-11eb-bd8c-e89eb413ce43', '7d36c907-dec1-11eb-9029-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 173, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('c975479e-e09c-11eb-bd8c-e89eb413ce43', '7d36c907-dec1-11eb-9029-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 174, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('c97547a2-e09c-11eb-bd8c-e89eb413ce43', '772478db-dec6-11eb-9029-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 175, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('c97547a5-e09c-11eb-bd8c-e89eb413ce43', '772478db-dec6-11eb-9029-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 176, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('c97547a6-e09c-11eb-bd8c-e89eb413ce43', '772478db-dec6-11eb-9029-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 177, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('caa2db73-e0a9-11eb-bd8c-e89eb413ce43', 'e87ba5db-dec9-11eb-9029-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 206, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('caa2db79-e0a9-11eb-bd8c-e89eb413ce43', 'e87ba5db-dec9-11eb-9029-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 207, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('caa2db7b-e0a9-11eb-bd8c-e89eb413ce43', 'e87ba5db-dec9-11eb-9029-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 208, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('caa2db7d-e0a9-11eb-bd8c-e89eb413ce43', 'e87ba5db-dec9-11eb-9029-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 209, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('caa2db7f-e0a9-11eb-bd8c-e89eb413ce43', 'e87ba5db-dec9-11eb-9029-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 210, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('caa2db80-e0a9-11eb-bd8c-e89eb413ce43', '58994546-cefd-11eb-8c53-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 211, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('caa2db82-e0a9-11eb-bd8c-e89eb413ce43', '58994546-cefd-11eb-8c53-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 212, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('caa2db84-e0a9-11eb-bd8c-e89eb413ce43', '58994546-cefd-11eb-8c53-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 213, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('cb7d1e97-b8cf-11eb-b80d-b07b2586b8c6', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Listening & Speaking', '', 'LS', NULL, 14, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ce3dd895-def6-11eb-9029-e89eb413ce43', '6a7a26d1-de97-11eb-9029-e89eb413ce43', 'Class Activity', '', 'CA', NULL, 53, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ce7af51e-b8d1-11eb-b80d-b07b2586b8c6', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Patterns & Algebra', '', 'P&A', NULL, 31, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('d5be316f-b8cf-11eb-b80d-b07b2586b8c6', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Reading & Literature', '', 'R&L', NULL, 15, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('d83f356f-b8d1-11eb-b80d-b07b2586b8c6', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Measurement', '', 'M', NULL, 32, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('d94fdced-def6-11eb-9029-e89eb413ce43', '6a7a26d1-de97-11eb-9029-e89eb413ce43', 'Test', '', 'T', NULL, 54, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('de881fd2-b8cf-11eb-b80d-b07b2586b8c6', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Language & Grammar', '', 'L&G', NULL, 18, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('e10b0e88-b8d4-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Punctuality', '', 'P', NULL, 242, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('e4dbdee2-e0a5-11eb-bd8c-e89eb413ce43', '7d7f112a-cefd-11eb-8c53-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 195, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('e4dbdee9-e0a5-11eb-bd8c-e89eb413ce43', 'b01d3198-dec6-11eb-9029-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 196, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('e4dbdeeb-e0a5-11eb-bd8c-e89eb413ce43', 'b01d3198-dec6-11eb-9029-e89eb413ce43', 'Skills', 'རིག་རྩལ།', 'S', NULL, 197, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('e4dbdeed-e0a5-11eb-bd8c-e89eb413ce43', 'b01d3198-dec6-11eb-9029-e89eb413ce43', 'Attitude', 'བསམ་སྤྱོད།', 'A', NULL, 198, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('e4dbdeee-e0a5-11eb-bd8c-e89eb413ce43', 'b01d3198-dec6-11eb-9029-e89eb413ce43', 'Mid Term Examination', 'ལོ་ཕྱེད་ཆོས་རྒྱུགས།', 'MTE', NULL, 199, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('e4dbdef0-e0a5-11eb-bd8c-e89eb413ce43', 'b01d3198-dec6-11eb-9029-e89eb413ce43', 'Annual Examination', 'ལོ་འཁོར་ཆོས་རྒྱུགས།', 'AE', NULL, 200, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('e4dbdef3-e0a5-11eb-bd8c-e89eb413ce43', '69a4c327-decb-11eb-9029-e89eb413ce43', 'Thinking', 'མནོ་རིག།', 'T', NULL, 201, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('e53f8bf1-def6-11eb-9029-e89eb413ce43', '6a7a26d1-de97-11eb-9029-e89eb413ce43', 'Project', '', 'P', NULL, 55, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('e951b923-b8cf-11eb-b80d-b07b2586b8c6', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Writing', '', 'W', NULL, 19, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL);
INSERT INTO `aca_assessment_area` (`id`, `aca_sub_id`, `name`, `dzo_name`, `code`, `aca_rating_type_id`, `display_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('ecd01f30-d026-11eb-a9e6-e89eb413ce43', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Applying concepts', '', 'AC', NULL, 27, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('edcfdfb1-d029-11eb-a9e6-e89eb413ce43', '2f733141-d029-11eb-a9e6-e89eb413ce43', 'My World (Class Activity)', '', 'MW (CW)', NULL, 86, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('ef4f8910-def6-11eb-9029-e89eb413ce43', '6a7a26d1-de97-11eb-9029-e89eb413ce43', 'Journal', '', 'J', NULL, 56, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('f0e6b154-b8d4-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Honesty & Integrity', '', 'HI', NULL, 243, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('f1ada391-deef-11eb-9029-e89eb413ce43', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Annual Examination', '', 'AE', NULL, 39, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('f76554ad-b8cf-11eb-b80d-b07b2586b8c6', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'Areas of Strength', '', 'AS', NULL, 21, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('f82b31b5-d029-11eb-a9e6-e89eb413ce43', '2f733141-d029-11eb-a9e6-e89eb413ce43', 'My World (Project Work)', '', 'MW (PW)', NULL, 87, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('f9162f4d-b8d1-11eb-b80d-b07b2586b8c6', 'e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'Geometry', '', 'G', NULL, 33, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('fbf8aa44-def6-11eb-9029-e89eb413ce43', '6a7a26d1-de97-11eb-9029-e89eb413ce43', 'Mid Term Examination', '', 'MTE', NULL, 57, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('fc1f7219-b8cd-11eb-b80d-b07b2586b8c6', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Reading & Literature', 'ལྷག་རིག་དང་རྩོམ་རིག།', 'R&L', NULL, 2, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL),
('fe574d0e-b8d4-11eb-b80d-b07b2586b8c6', 'bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'Adherance to rules', '', 'Ar', NULL, 244, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:12', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aca_assessment_frequency`
--

CREATE TABLE `aca_assessment_frequency` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `not_assessed` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 - Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aca_assessment_frequency`
--

INSERT INTO `aca_assessment_frequency` (`id`, `name`, `not_assessed`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('b11b216c-c5d4-11eb-870b-e89eb413ce43', 'Not Assessed', 1, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:26', NULL),
('c5815af7-b8c0-11eb-b80d-b07b2586b8c6', 'Quarterly', 0, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:26', NULL),
('e3cc5557-b8c0-11eb-b80d-b07b2586b8c6', 'Half Yearly', 0, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:26', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aca_assessment_term`
--

CREATE TABLE `aca_assessment_term` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_assmt_frequency_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dzo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_text` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `from_month` tinyint(3) UNSIGNED NOT NULL,
  `to_month` tinyint(3) UNSIGNED NOT NULL,
  `from_date` tinyint(3) UNSIGNED DEFAULT NULL,
  `to_date` tinyint(3) UNSIGNED DEFAULT NULL,
  `display_order` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 - Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aca_assessment_term`
--

INSERT INTO `aca_assessment_term` (`id`, `aca_assmt_frequency_id`, `name`, `dzo_name`, `display_text`, `from_month`, `to_month`, `from_date`, `to_date`, `display_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('0147ff87-b8c1-11eb-b80d-b07b2586b8c6', 'e3cc5557-b8c0-11eb-b80d-b07b2586b8c6', 'First Term', 'སློབ་དུས་ ༡ པ།', '', 2, 6, 1, 15, 1, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:44', NULL),
('5f1bf047-b8c1-11eb-b80d-b07b2586b8c6', 'e3cc5557-b8c0-11eb-b80d-b07b2586b8c6', 'Second Term', 'སློབ་དུས་ ༢ པ།', '', 7, 12, 1, 30, 2, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:44', NULL),
('7d662b7d-b8c1-11eb-b80d-b07b2586b8c6', 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6', 'Quarter I', 'བཞི་དཔྱ་ ༡ པ།', 'February - Mid April', 2, 4, 1, 15, 3, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:44', NULL),
('a3e65b7b-b8c1-11eb-b80d-b07b2586b8c6', 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6', 'Quarter II', 'བཞི་དཔྱ་ ༢ པ།', 'Mid April - June', 4, 6, 16, 30, 4, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:44', NULL),
('c6e9a293-b8c1-11eb-b80d-b07b2586b8c6', 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6', 'Quarter III', 'བཞི་དཔྱ་ ༣ པ།', 'July - Mid October', 7, 10, 1, 15, 5, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:44', NULL),
('e8274e75-b8c1-11eb-b80d-b07b2586b8c6', 'c5815af7-b8c0-11eb-b80d-b07b2586b8c6', 'Quarter IV', 'བཞི་དཔྱ་ ༤ པ།', 'Mid October - December', 10, 12, 16, 30, 6, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:11:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aca_class_assessment_frequency`
--

CREATE TABLE `aca_class_assessment_frequency` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_assmt_frequency_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_class_assmnt_frequency_history`
--

CREATE TABLE `aca_class_assmnt_frequency_history` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_assmt_frequency_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recorded_for` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_class_subject`
--

CREATE TABLE `aca_class_subject` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_rating_type_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_score` decimal(6,2) DEFAULT NULL,
  `is_elective` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1-Subject is elective for the class',
  `show_in_result` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_class_subject_assessment`
--

CREATE TABLE `aca_class_subject_assessment` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_assmt_term_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_assmt_area_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weightage` decimal(5,2) DEFAULT NULL COMMENT 'Not Null, if rating type is marks (summative)',
  `display_order` tinyint(3) UNSIGNED NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_class_subject_history`
--

CREATE TABLE `aca_class_subject_history` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_rating_type_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pass_score` decimal(6,2) DEFAULT NULL,
  `is_elective` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '1-Subject is elective for the class',
  `show_in_result` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `recorded_for` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_class_subject_teacher`
--

CREATE TABLE `aca_class_subject_teacher` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stf_staff_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_class_sub_assmnt_history`
--

CREATE TABLE `aca_class_sub_assmnt_history` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_assmt_term_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_assmt_area_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `weightage` decimal(5,2) DEFAULT NULL COMMENT 'Not Null, if rating type is marks (summative)',
  `display_order` tinyint(3) UNSIGNED NOT NULL,
  `recorded_for` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_class_teacher`
--

CREATE TABLE `aca_class_teacher` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_class_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stf_staff_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aca_class_teacher`
--

INSERT INTO `aca_class_teacher` (`id`, `org_id`, `org_class_id`, `org_stream_id`, `org_section_id`, `org_class_stream_id`, `stf_staff_id`, `class_stream_section`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('059f0b7d-3487-4c89-b350-b530ad151229', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'b25d7be2-1237-45e5-ab7f-4a0214e044ae', 'Null', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '74217e56-f58b-4aef-a976-6277bae06d58', 'fcc956d7-876e-4930-aeb9-d15ce4c565de', 'PP B', '4120', NULL, '2021-07-10 08:57:04', NULL),
('11a281d5-d559-4670-8f1a-a7aeb402b686', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'ea6fe1b1-3b3e-4489-abc0-5ab9af1ce8b3', 'Null', '7ebcce72-a667-43e1-8023-653cf9cf08db', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '978dbdd1-5426-48df-ad8e-64201510c02f', 'IX B', '4120', NULL, '2021-07-10 08:57:04', NULL),
('185b4fa0-f947-4edd-8cad-58b49186c771', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1e4d1886-afeb-4161-bb8b-49cdca0e50a1', 'Null', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '978dbdd1-5426-48df-ad8e-64201510c02f', 'VIII B', '4120', NULL, '2021-07-10 08:57:04', NULL),
('20c9ae96-b7b3-4c37-aff0-0b7024d48756', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '88449356-ede4-42b2-a449-ce6561d86bc0', 'Null', 'e89b9344-03df-4e8e-9543-908db89415a1', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', '978dbdd1-5426-48df-ad8e-64201510c02f', 'I C', '4120', NULL, '2021-07-10 08:57:04', NULL),
('235eaa40-83f9-4c00-afd1-68530ad6d65c', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '327adec4-fb7d-40fb-b351-9924c9d05562', 'Null', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ffc1b5f0-3e0e-42e8-b460-b1b03f810522', 'V A', '4120', NULL, '2021-07-10 08:57:04', NULL),
('23662de9-2f1b-40eb-833e-90472521e878', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '327adec4-fb7d-40fb-b351-9924c9d05562', 'Null', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'dd1007ab-f87f-401a-a4ae-1ad43725da6a', 'V B', '4120', NULL, '2021-07-10 08:57:04', NULL),
('2cd46b60-5e72-404c-9190-2104839d6911', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '17b8e2ba-aeaa-4e87-a2ae-cf6bc13cd446', 'Null', '9316a24d-15ad-446d-abd5-edcf544c2a39', '780d917c-ed3e-4157-b8c3-146039118805', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'II B', '4120', NULL, '2021-07-10 08:57:04', NULL),
('2d83ae41-d88d-42cd-94e7-32ba129f18dc', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '4e28295d-a18f-46a1-8af2-6b79f6276176', 'Null', 'd617cdbf-0817-417e-a3ea-abce63ede097', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'III C', '4120', NULL, '2021-07-10 08:57:04', NULL),
('39314c4f-498f-4706-9e4f-a4a8900cfee1', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'efc535b3-dda4-4dba-8f4f-6e0fc01556c1', 'Null', '4838b1c6-f11a-4772-944e-b01da75b4fce', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'dd1007ab-f87f-401a-a4ae-1ad43725da6a', 'X B', '4120', NULL, '2021-07-10 08:57:04', NULL),
('4584232b-2c48-49db-baf4-3f855aa62ea8', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'ea6fe1b1-3b3e-4489-abc0-5ab9af1ce8b3', 'Null', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'IX A', '4120', NULL, '2021-07-10 08:57:04', NULL),
('46c6ed9e-a278-4915-a998-a6a9ca773cde', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '37e6a4d1-ad28-4902-a524-2c176c90a2c9', 'Null', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '7daac690-94d1-409e-86b3-d07fa1522b9c', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'IV B', '4120', NULL, '2021-07-10 08:57:04', NULL),
('4c58a203-87f3-4131-bc53-f7812a470e5e', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '8930ec7a-b690-4f43-a4d2-d9a8dce162b2', 'Null', 'b112e5bc-1cc9-4974-a09f-35b851042587', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'VII B', '4120', NULL, '2021-07-10 08:57:04', NULL),
('5a2b2dc4-8c4c-48fa-b253-982f00552696', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '327adec4-fb7d-40fb-b351-9924c9d05562', 'Null', 'a5288db0-79d3-4674-b84a-186b5bdb5dbe', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'fcc956d7-876e-4930-aeb9-d15ce4c565de', 'V C', '4120', NULL, '2021-07-10 08:57:04', NULL),
('5f656355-7ce1-4834-9699-72c827756990', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1e4d1886-afeb-4161-bb8b-49cdca0e50a1', 'Null', '797809f0-1189-478b-b293-fa030715d37a', '6fc68168-937b-4d24-80b9-3d2a241e10c4', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'VIII A', '4120', NULL, '2021-07-10 08:57:04', NULL),
('803443b0-a74b-421e-87a8-359a6a4a50b3', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '17b8e2ba-aeaa-4e87-a2ae-cf6bc13cd446', 'Null', '7cc00f86-71d6-471e-9d9a-adadb2b6a475', '780d917c-ed3e-4157-b8c3-146039118805', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'II C', '4120', NULL, '2021-07-10 08:57:04', NULL),
('808e8ac8-2275-45af-8036-862b51732088', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'efc535b3-dda4-4dba-8f4f-6e0fc01556c1', 'Null', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'X C', '4120', NULL, '2021-07-10 08:57:04', NULL),
('8a2c7d05-859a-4852-86ea-bd1b65802a22', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '37e6a4d1-ad28-4902-a524-2c176c90a2c9', 'Null', 'dd8f3ced-a903-415b-bf63-139bbcf672f8', '7daac690-94d1-409e-86b3-d07fa1522b9c', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'IV C', '4120', NULL, '2021-07-10 08:57:04', NULL),
('94ddd8f6-df0e-4b6a-9e16-41c10603dfba', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '17b8e2ba-aeaa-4e87-a2ae-cf6bc13cd446', 'Null', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '780d917c-ed3e-4157-b8c3-146039118805', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'II A', '4120', NULL, '2021-07-10 08:57:04', NULL),
('9bf5ccfb-1c2f-40f5-9948-7fa7a180f116', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '8930ec7a-b690-4f43-a4d2-d9a8dce162b2', 'Null', '173152e5-f129-4877-ae71-205336f2879b', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'ffc1b5f0-3e0e-42e8-b460-b1b03f810522', 'VII A', '4120', NULL, '2021-07-10 08:57:04', NULL),
('a47260dd-7908-481e-9e6d-ad80e3dba04c', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'b25d7be2-1237-45e5-ab7f-4a0214e044ae', 'Null', '6a430904-c901-47ad-b351-3b6cdd95617b', '74217e56-f58b-4aef-a976-6277bae06d58', 'dd1007ab-f87f-401a-a4ae-1ad43725da6a', 'PP A', '4120', NULL, '2021-07-10 08:57:04', NULL),
('a72ea2ee-1f9c-43ce-8d79-e2d3a02c45a2', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '4e28295d-a18f-46a1-8af2-6b79f6276176', 'Null', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'III A', '4120', NULL, '2021-07-10 08:57:04', NULL),
('ad5b732e-2c77-4fcc-90a4-331238176456', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '0f150274-91e4-4fc1-906e-79bd1b3a1734', 'Null', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '755bb014-859b-4c7c-b194-8a134fd059eb', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'VI C', '4120', NULL, '2021-07-10 08:57:04', NULL),
('c56661b3-6c8f-4d86-a18d-9fa458757631', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'efc535b3-dda4-4dba-8f4f-6e0fc01556c1', 'Null', 'bd481b88-2257-413f-b273-4de795150231', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'fcc956d7-876e-4930-aeb9-d15ce4c565de', 'X A', '4120', NULL, '2021-07-10 08:57:04', NULL),
('c66fb03d-a2b2-42ad-8a66-6279884d6e38', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '88449356-ede4-42b2-a449-ce6561d86bc0', 'Null', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'I A', '4120', NULL, '2021-07-10 08:57:04', NULL),
('cbb540a4-8d3a-48ae-b42c-1eed6e329815', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '88449356-ede4-42b2-a449-ce6561d86bc0', 'Null', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'b2352dda-efec-4988-ac62-b35f31bb3b8d', 'I B', '4120', NULL, '2021-07-10 08:57:04', NULL),
('d80fea7c-754f-4f7a-9b68-bae3a5ea38cd', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1e4d1886-afeb-4161-bb8b-49cdca0e50a1', 'Null', '2a32c940-523e-40ed-9f4d-856fd678051a', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '978dbdd1-5426-48df-ad8e-64201510c02f', 'VIII C', '4120', NULL, '2021-07-10 08:57:04', NULL),
('db29581b-52b5-496b-bcb5-840fe89b731a', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '0f150274-91e4-4fc1-906e-79bd1b3a1734', 'Null', '3f706abc-3063-4fd4-803f-a63897dded97', '755bb014-859b-4c7c-b194-8a134fd059eb', 'ffc1b5f0-3e0e-42e8-b460-b1b03f810522', 'VI A', '4120', NULL, '2021-07-10 08:57:04', NULL),
('e1ad3115-d44e-49ae-9516-4b4f0cbdfdd1', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '8930ec7a-b690-4f43-a4d2-d9a8dce162b2', 'Null', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '978dbdd1-5426-48df-ad8e-64201510c02f', 'VII C', '4120', NULL, '2021-07-10 08:57:04', NULL),
('ebafa09c-fc25-4345-9bde-417a2ce43709', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '0f150274-91e4-4fc1-906e-79bd1b3a1734', 'Null', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '755bb014-859b-4c7c-b194-8a134fd059eb', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'VI B', '4120', NULL, '2021-07-10 08:57:04', NULL),
('ec366d8c-28cb-4b8a-912b-12c9954a1f36', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'b25d7be2-1237-45e5-ab7f-4a0214e044ae', 'Null', '3e640f02-9f16-4821-9934-5297aa1f2765', '74217e56-f58b-4aef-a976-6277bae06d58', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'PP C', '4120', NULL, '2021-07-10 08:57:04', NULL),
('f5a466ba-4b13-4908-86dd-5f5220775802', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'ea6fe1b1-3b3e-4489-abc0-5ab9af1ce8b3', 'Null', '4da9d182-6f65-4d7c-a097-67c8924c8200', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'IX C', '4120', NULL, '2021-07-10 08:57:04', NULL),
('ff21fe9f-cfda-4b13-8b6c-9d247f4ee497', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '4e28295d-a18f-46a1-8af2-6b79f6276176', 'Null', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'III B', '4120', NULL, '2021-07-10 08:57:04', NULL),
('ffe4ada9-67f5-4975-8368-c8b322d0f270', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '37e6a4d1-ad28-4902-a524-2c176c90a2c9', 'Null', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '7daac690-94d1-409e-86b3-d07fa1522b9c', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'IV A', '4120', NULL, '2021-07-10 08:57:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aca_class_teacher_history`
--

CREATE TABLE `aca_class_teacher_history` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_class_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stf_staff_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recorded_for` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aca_class_teacher_history`
--

INSERT INTO `aca_class_teacher_history` (`id`, `org_id`, `org_class_id`, `org_stream_id`, `org_section_id`, `org_class_stream_id`, `stf_staff_id`, `class_stream_section`, `recorded_for`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('02eb7124-7264-442a-a836-a7b455f22a03', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '8930ec7a-b690-4f43-a4d2-d9a8dce162b2', 'Null', 'b112e5bc-1cc9-4974-a09f-35b851042587', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'VII B', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('09f5256d-e211-4f9f-859a-c4683616be56', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'ea6fe1b1-3b3e-4489-abc0-5ab9af1ce8b3', 'Null', '7ebcce72-a667-43e1-8023-653cf9cf08db', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '978dbdd1-5426-48df-ad8e-64201510c02f', 'IX B', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('1df2d334-74e2-4b1f-8d0e-58e04d37048d', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '327adec4-fb7d-40fb-b351-9924c9d05562', 'Null', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'dd1007ab-f87f-401a-a4ae-1ad43725da6a', 'V B', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('220ad223-04e0-41d0-9efd-c08d6732aec4', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '37e6a4d1-ad28-4902-a524-2c176c90a2c9', 'Null', 'dd8f3ced-a903-415b-bf63-139bbcf672f8', '7daac690-94d1-409e-86b3-d07fa1522b9c', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'IV C', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('22d1f7b9-db1e-4ca1-92d8-795d60b6bfc2', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'efc535b3-dda4-4dba-8f4f-6e0fc01556c1', 'Null', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'X C', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('278e1c0d-08e6-425f-a5e1-2b36aab68cc9', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'b25d7be2-1237-45e5-ab7f-4a0214e044ae', 'Null', '3e640f02-9f16-4821-9934-5297aa1f2765', '74217e56-f58b-4aef-a976-6277bae06d58', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'PP C', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('2a0bd581-c930-45cf-bd8b-7706ba4f056e', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'efc535b3-dda4-4dba-8f4f-6e0fc01556c1', 'Null', 'bd481b88-2257-413f-b273-4de795150231', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'fcc956d7-876e-4930-aeb9-d15ce4c565de', 'X A', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('31e2619e-5c9c-4344-9dee-d0e1e21ffa1a', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '4e28295d-a18f-46a1-8af2-6b79f6276176', 'Null', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'III A', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('4163310f-f7dc-4c6a-b7d6-2874e49469f6', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '37e6a4d1-ad28-4902-a524-2c176c90a2c9', 'Null', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '7daac690-94d1-409e-86b3-d07fa1522b9c', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'IV B', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('536b1f6e-8b29-43d7-9c6f-1188d3814dfd', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '88449356-ede4-42b2-a449-ce6561d86bc0', 'Null', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'b2352dda-efec-4988-ac62-b35f31bb3b8d', 'I B', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('60749acd-fa58-4e34-8562-57b1d26b45aa', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '88449356-ede4-42b2-a449-ce6561d86bc0', 'Null', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'I A', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('61d9e260-b0c1-4407-8188-0a2a3989a9fc', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '17b8e2ba-aeaa-4e87-a2ae-cf6bc13cd446', 'Null', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '780d917c-ed3e-4157-b8c3-146039118805', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'II A', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('7328b9ed-6ae5-4f02-a5cd-b4225cd598b6', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '8930ec7a-b690-4f43-a4d2-d9a8dce162b2', 'Null', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '978dbdd1-5426-48df-ad8e-64201510c02f', 'VII C', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('7ab97d87-4a85-484e-b5b0-22f2e82cf185', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'ea6fe1b1-3b3e-4489-abc0-5ab9af1ce8b3', 'Null', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'IX A', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('7bde1c7a-4c5b-4a78-8480-4176be289097', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'b25d7be2-1237-45e5-ab7f-4a0214e044ae', 'Null', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '74217e56-f58b-4aef-a976-6277bae06d58', 'fcc956d7-876e-4930-aeb9-d15ce4c565de', 'PP B', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('7d78ce0b-c807-44e2-95ff-c8a5b999782c', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '17b8e2ba-aeaa-4e87-a2ae-cf6bc13cd446', 'Null', '9316a24d-15ad-446d-abd5-edcf544c2a39', '780d917c-ed3e-4157-b8c3-146039118805', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'II B', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('7e9a52e3-eaf5-4fab-b3e7-da4aebc521a3', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1e4d1886-afeb-4161-bb8b-49cdca0e50a1', 'Null', '797809f0-1189-478b-b293-fa030715d37a', '6fc68168-937b-4d24-80b9-3d2a241e10c4', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'VIII A', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('814f8588-2c49-4254-8e7b-0dc556629a73', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1e4d1886-afeb-4161-bb8b-49cdca0e50a1', 'Null', '2a32c940-523e-40ed-9f4d-856fd678051a', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '978dbdd1-5426-48df-ad8e-64201510c02f', 'VIII C', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('84bb113a-2e8b-42b4-ad7d-8374b50c51be', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'b25d7be2-1237-45e5-ab7f-4a0214e044ae', 'Null', '6a430904-c901-47ad-b351-3b6cdd95617b', '74217e56-f58b-4aef-a976-6277bae06d58', 'dd1007ab-f87f-401a-a4ae-1ad43725da6a', 'PP A', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('8e7318c1-9349-4d94-a059-738bd9642400', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'efc535b3-dda4-4dba-8f4f-6e0fc01556c1', 'Null', '4838b1c6-f11a-4772-944e-b01da75b4fce', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'dd1007ab-f87f-401a-a4ae-1ad43725da6a', 'X B', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('a872007b-3e47-45a7-b8a5-f622bc0c5e13', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1e4d1886-afeb-4161-bb8b-49cdca0e50a1', 'Null', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '978dbdd1-5426-48df-ad8e-64201510c02f', 'VIII B', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('a8f96da1-ead7-41be-9cd1-8c163ff95cf1', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '327adec4-fb7d-40fb-b351-9924c9d05562', 'Null', 'a5288db0-79d3-4674-b84a-186b5bdb5dbe', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'fcc956d7-876e-4930-aeb9-d15ce4c565de', 'V C', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('ab8ada0b-5d94-4d69-90bf-c8eb84376064', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '0f150274-91e4-4fc1-906e-79bd1b3a1734', 'Null', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '755bb014-859b-4c7c-b194-8a134fd059eb', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'VI B', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('ac8bc01a-dc59-42a8-adf4-2023e6676e41', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '0f150274-91e4-4fc1-906e-79bd1b3a1734', 'Null', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '755bb014-859b-4c7c-b194-8a134fd059eb', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'VI C', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('bbad6fea-4d82-4e56-b7e8-ceb96378b337', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'ea6fe1b1-3b3e-4489-abc0-5ab9af1ce8b3', 'Null', '4da9d182-6f65-4d7c-a097-67c8924c8200', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'IX C', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('bedc6483-3d79-452c-90a0-7003ea8c6288', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '4e28295d-a18f-46a1-8af2-6b79f6276176', 'Null', 'd617cdbf-0817-417e-a3ea-abce63ede097', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'III C', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('c19a53c3-e337-4dbe-abd0-a453712eddea', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '327adec4-fb7d-40fb-b351-9924c9d05562', 'Null', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ffc1b5f0-3e0e-42e8-b460-b1b03f810522', 'V A', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('d9d99dee-214c-476a-b5fc-a77acb7065ed', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '8930ec7a-b690-4f43-a4d2-d9a8dce162b2', 'Null', '173152e5-f129-4877-ae71-205336f2879b', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'ffc1b5f0-3e0e-42e8-b460-b1b03f810522', 'VII A', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('ef9ea498-e88b-416b-8607-9f05381412b6', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '88449356-ede4-42b2-a449-ce6561d86bc0', 'Null', 'e89b9344-03df-4e8e-9543-908db89415a1', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', '978dbdd1-5426-48df-ad8e-64201510c02f', 'I C', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('f1162977-3b21-4ac3-974a-94e1097123e0', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '4e28295d-a18f-46a1-8af2-6b79f6276176', 'Null', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'III B', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('f40d411e-502e-4044-812f-bca3a6be79aa', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '37e6a4d1-ad28-4902-a524-2c176c90a2c9', 'Null', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '7daac690-94d1-409e-86b3-d07fa1522b9c', '905efaf2-128c-4fdd-9b04-0ddb0e46308e', 'IV A', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('f9fa61e5-44ee-45fc-98d3-698a72a40b08', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '17b8e2ba-aeaa-4e87-a2ae-cf6bc13cd446', 'Null', '7cc00f86-71d6-471e-9d9a-adadb2b6a475', '780d917c-ed3e-4157-b8c3-146039118805', 'ad14d3ee-6948-4ea5-acec-883181e6c1ba', 'II C', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04'),
('fd75cf7e-a060-4e5c-993e-20920ad3c8dd', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '0f150274-91e4-4fc1-906e-79bd1b3a1734', 'Null', '3f706abc-3063-4fd4-803f-a63897dded97', '755bb014-859b-4c7c-b194-8a134fd059eb', 'ffc1b5f0-3e0e-42e8-b460-b1b03f810522', 'VI A', 'Class Teacher Change', '4120', '4120', '2021-07-10 08:57:04', '2021-07-10 08:57:04');

-- --------------------------------------------------------

--
-- Table structure for table `aca_con_result_history`
--

CREATE TABLE `aca_con_result_history` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_assmt_term_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Null for final/annual result',
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finalized` tinyint(3) UNSIGNED DEFAULT 0,
  `finalized_date` datetime DEFAULT NULL,
  `published` tinyint(3) UNSIGNED DEFAULT 0,
  `published_date` datetime DEFAULT NULL,
  `std_student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1-Promoted; 0-Detained',
  `remarks` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recorded_for` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_instructional_days_special_case`
--

CREATE TABLE `aca_instructional_days_special_case` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `std_student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_term_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `instructional_days` int(11) NOT NULL,
  `remarks` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_rating`
--

CREATE TABLE `aca_rating` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_rating_type_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dzo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `score` tinyint(4) NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0-Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aca_rating`
--

INSERT INTO `aca_rating` (`id`, `aca_rating_type_id`, `name`, `dzo_name`, `score`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('204f3544-b8c7-11eb-b80d-b07b2586b8c6', '2eefff10-b8c5-11eb-b80d-b07b2586b8c6', 'Good', 'ལེགས་ཤོམ།', 2, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:12:14', NULL),
('2c51c8a6-b8c2-11eb-b80d-b07b2586b8c6', '2eefff10-b8c5-11eb-b80d-b07b2586b8c6', 'Need Improvement', 'ཡར་དྲག་གཏང་དགོཔ།', 1, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:12:14', NULL),
('3a22aa4e-b8c7-11eb-b80d-b07b2586b8c6', '2eefff10-b8c5-11eb-b80d-b07b2586b8c6', 'Very Good', 'གནམ་མེད་ས་མེད་ལེགས་ཤོམ།', 3, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:12:14', NULL),
('4747f296-b8c7-11eb-b80d-b07b2586b8c6', '2eefff10-b8c5-11eb-b80d-b07b2586b8c6', 'Outstanding', 'ཁྱད་འཕགས།', 4, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:12:14', NULL),
('54b29b7e-b8c7-11eb-b80d-b07b2586b8c6', '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6', 'Beginning', 'གཞི་འཛུགས།', 1, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:12:14', NULL),
('67fdfba5-b8c7-11eb-b80d-b07b2586b8c6', '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6', 'Approaching', 'ཉེ་འབྱོར།', 2, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:12:14', NULL),
('7881f340-b8c7-11eb-b80d-b07b2586b8c6', '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6', 'Meeting', 'རེ་མཐུན།', 3, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:12:14', NULL),
('88ddb252-b8c7-11eb-b80d-b07b2586b8c6', '4fdcc557-b8c5-11eb-b80d-b07b2586b8c6', 'Exceeding', 'རྨད་བྱུང་།', 4, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:12:14', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aca_rating_type`
--

CREATE TABLE `aca_rating_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_sub_category_id` char(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `input_type` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 - dropdown; 1 - number (percentage); 2 - descriptive text',
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0-Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aca_rating_type`
--

INSERT INTO `aca_rating_type` (`id`, `name`, `aca_sub_category_id`, `input_type`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('2eefff10-b8c5-11eb-b80d-b07b2586b8c6', 'Four level rating (Need Improvement-Good-Very Good-Outstanding)', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', 0, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:49', NULL),
('4fdcc557-b8c5-11eb-b80d-b07b2586b8c6', 'Four level rating (Beginning-Approaching-Meeting-Exceeding)', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', 0, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:49', NULL),
('643c845c-b8c5-11eb-b80d-b07b2586b8c6', 'Percentage marks', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', 1, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:49', NULL),
('ad1aacc8-b8c5-11eb-b80d-b07b2586b8c6', 'Descriptive', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', 2, 1, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', NULL, '2021-07-10 08:10:49', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aca_result_consolidated`
--

CREATE TABLE `aca_result_consolidated` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_assmt_term_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Null for final/annual result',
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finalized` tinyint(3) UNSIGNED DEFAULT 0,
  `finalized_date` datetime DEFAULT NULL,
  `published` tinyint(3) UNSIGNED DEFAULT 0,
  `published_date` datetime DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_result_consolidated_detail`
--

CREATE TABLE `aca_result_consolidated_detail` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_result_consol_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `std_student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `result` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '1-Promoted; 0-Detained',
  `remarks` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_school_elective_subject`
--

CREATE TABLE `aca_school_elective_subject` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_setting`
--

CREATE TABLE `aca_setting` (
  `id` int(11) NOT NULL,
  `description` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `value` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description_of_value` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aca_setting`
--

INSERT INTO `aca_setting` (`id`, `description`, `value`, `description_of_value`) VALUES
(1, 'Assessment area format in result', '1', '1 - Code/abbreviation 2 - Name'),
(2, 'In result, show upto postion', '3', 'The position depends on the value');

-- --------------------------------------------------------

--
-- Table structure for table `aca_std_assmnt_history`
--

CREATE TABLE `aca_std_assmnt_history` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_assmt_term_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finalized_date` date DEFAULT NULL,
  `finalized` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `std_student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_assmt_area_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_rating_type_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` decimal(6,2) UNSIGNED DEFAULT NULL,
  `descriptive_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recorded_for` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_std_attendance_history`
--

CREATE TABLE `aca_std_attendance_history` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendance_date` date NOT NULL,
  `std_student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_absence_reason_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `recorded_for` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_std_optional_sub_history`
--

CREATE TABLE `aca_std_optional_sub_history` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recorded_for` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_student_assessment`
--

CREATE TABLE `aca_student_assessment` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_assmt_term_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `finalized_date` date DEFAULT NULL,
  `finalized` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_student_assessment_detail`
--

CREATE TABLE `aca_student_assessment_detail` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_student_assmt_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `std_student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_assmt_area_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_rating_type_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `score` decimal(6,2) UNSIGNED DEFAULT NULL,
  `descriptive_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(1000) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_student_attendance`
--

CREATE TABLE `aca_student_attendance` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendance_date` date NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_student_attendance_detail`
--

CREATE TABLE `aca_student_attendance_detail` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_std_attendance_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `std_student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_absence_reason_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_student_elective_subject`
--

CREATE TABLE `aca_student_elective_subject` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `std_student_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `aca_subject`
--

CREATE TABLE `aca_subject` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_sub_category_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dzo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `assessed_by_class_teacher` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `is_special_educational_needs` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `display_order` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0-Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aca_subject`
--

INSERT INTO `aca_subject` (`id`, `aca_sub_category_id`, `aca_sub_id`, `name`, `dzo_name`, `assessed_by_class_teacher`, `is_special_educational_needs`, `display_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('01a8a4f5-b8cb-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Dzongkha I', 'རྫོང་ཁ ༡ པ།', 0, 0, 3, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('029773c2-cef4-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Environment Science', '', 0, 0, 18, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'English', '', 0, 0, 2, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('059f0cc6-cef6-11eb-8c53-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Arts Education', '', 0, 0, 24, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('0a734b20-cef8-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Technical and Vocational Education Training', '', 0, 0, 17, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('0bc3a3dc-b8ca-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'History', '', 0, 0, 7, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Dzongkha', 'རྫོང་ཁ།', 0, 0, 1, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('2cbfa8b5-b8cb-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', '19979f9d-b8cc-11eb-b80d-b07b2586b8c6', 'Dzongkha II', 'རྫོང་ཁ ༢ པ།', 0, 0, 4, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('2f733141-d029-11eb-a9e6-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Social Studies', '', 0, 0, 6, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('30c668c2-decc-11eb-9029-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Chenju', 'སྤྱོད་འཇུག།', 0, 0, 40, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('3ce9cdb1-b8c9-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Physics', '', 0, 0, 25, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('3f846f32-cef5-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Health and Physical Education', '', 0, 0, 22, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('41f56c70-cefc-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Nyen-ngag', 'སྙན་ངག།', 0, 0, 33, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('470ed853-de9c-11eb-9029-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Business Mathematics', '', 0, 0, 12, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('514070b5-cef8-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Economics', '', 0, 0, 14, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('58994546-cefd-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Gyalrab', 'རྒྱལ་རབས།', 0, 0, 39, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('5d35b1ef-d02c-11eb-a9e6-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Nencha', 'སྙན་ཆ།', 0, 0, 34, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('619fe69a-dec1-11eb-9029-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Lekshe Jon Wang', 'ལེགས་བཤད་ལྗོན་དབང་།', 0, 0, 30, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('67ef35a1-decd-11eb-9029-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Ngadroen Dang Tagijupa', 'ངག་སྒྲོན་དང་རྟགས་ཀྱི་འཇུག་པ།', 0, 0, 43, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('69a4c327-decb-11eb-9029-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Ngon Ja', 'མངོན་བརྗོད།', 0, 0, 37, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('6a7a26d1-de97-11eb-9029-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'General Science', '', 0, 0, 5, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('72a65ede-b8ca-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'English I', '', 0, 0, 1, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('75eedb73-cef6-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Information and Communication Technology', '', 0, 0, 21, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('772478db-dec6-11eb-9029-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Chu Dang Shing Gi Ten chey', 'ཆུ་དང་ཤིང་གི་བསྟན་བཅོས།', 0, 0, 32, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('7b5a4b19-b8c9-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Chemistry', '', 0, 0, 26, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('7d36c907-dec1-11eb-9029-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Ngadroen', 'ངག་སྒྲོན།', 0, 0, 31, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('7d7bcfc7-de99-11eb-9029-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'History and Civics', '', 0, 0, 13, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('7d7f112a-cefd-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Tsi', 'སྩིས།', 0, 0, 35, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('86a6dcc7-e0ab-11eb-bd8c-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Dreklam', 'སྒྲིག་ལམ།', 0, 0, 44, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('8d762e53-cef8-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Media Studies', '', 0, 0, 16, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('9b864903-cef5-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Values Education', '', 0, 0, 23, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('9bb96ba6-de98-11eb-9029-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Science (Physics,Chemistry,Biology)', '', 0, 0, 9, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('9dd9405d-decc-11eb-9029-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Ngadroen Sumtag', 'ངག་སྒྲོན་སུམ་རྟགས།', 0, 0, 41, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('9e60a1ef-de9c-11eb-9029-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Business and Enterpreneurship', '', 0, 0, 15, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('9f37c505-b8ca-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', '04956ce3-b8cc-11eb-b80d-b07b2586b8c6', 'English II', '', 0, 0, 2, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('b01d3198-dec6-11eb-9029-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Lhari', '', 0, 0, 36, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('b1204e8f-cefd-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Commerce', '', 0, 0, 10, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('b1a51a08-de9b-11eb-9029-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Agriculture for Food Security', '', 0, 0, 19, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('bbf1c5d8-b8d2-11eb-b80d-b07b2586b8c6', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Personal Characteristics', '', 1, 0, 29, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('c00d93b6-b8cb-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Science', '', 0, 0, 4, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('c14eddcc-de9b-11eb-9029-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Commercial Studies', '', 0, 0, 20, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('d6d2410a-cefc-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Rigzhung', '', 0, 0, 28, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('e11febf6-b8cb-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Mathematics', '', 0, 0, 3, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('e8600895-b8c9-11eb-b80d-b07b2586b8c6', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Biology', '', 0, 0, 27, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('e87ba5db-dec9-11eb-9029-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Sumtag Didom', 'སུམ་རྟགས་སྡུད་སྡོམ།', 0, 0, 38, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('ec491ebe-de97-11eb-9029-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Geography', '', 0, 0, 8, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('f6e28e34-decc-11eb-9029-e89eb413ce43', 'b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Jungrab', 'འབྱུང་རབས།', 0, 0, 42, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL),
('fd9b9ca3-cefd-11eb-8c53-e89eb413ce43', 'aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', NULL, 'Accountancy', '', 0, 0, 11, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:35', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aca_subject_category`
--

CREATE TABLE `aca_subject_category` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `dzo_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `display_order` tinyint(3) UNSIGNED NOT NULL,
  `status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0-Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `aca_subject_category`
--

INSERT INTO `aca_subject_category` (`id`, `name`, `dzo_name`, `display_order`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('aad4fd53-b8c7-11eb-b80d-b07b2586b8c6', 'Academic', '', 1, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:18', NULL),
('b8d29a44-b8c7-11eb-b80d-b07b2586b8c6', 'Non-Academic', '', 2, 1, '013328f4-a381-4c6b-a270-8c071b366fc4', NULL, '2021-07-10 08:10:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `aca_sub_teacher_history`
--

CREATE TABLE `aca_sub_teacher_history` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_class_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `org_stream_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `org_section_id` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aca_sub_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stf_staff_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `class_stream_section` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `recorded_for` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_04_07_064440_aca_subject_category', 1),
(2, '2021_04_07_064442_aca_subject', 1),
(3, '2021_04_07_064443_aca_rating_type', 1),
(4, '2021_04_07_064649_aca_assessment_area', 1),
(5, '2021_04_07_064806_aca_assessment_frequency', 1),
(6, '2021_04_07_065154_aca_assessment_term', 1),
(7, '2021_04_07_065316_aca_class_assessment_frequency', 1),
(8, '2021_04_07_065650_aca_rating', 1),
(9, '2021_04_07_065715_aca_class_subject', 1),
(10, '2021_04_07_065750_aca_class_subject_assesment', 1),
(11, '2021_04_07_065818_aca_class_subject_teacher', 1),
(12, '2021_04_07_065831_aca_class_teacher', 1),
(13, '2021_04_07_065928_aca_school_elective_subject', 1),
(14, '2021_04_07_065958_aca_student_assessment', 1),
(15, '2021_04_07_065959_aca_student_assessment_detail', 1),
(16, '2021_04_07_070023_aca_result_consolidated', 1),
(17, '2021_04_07_070024_aca_result_consolidated_detail', 1),
(18, '2021_04_07_070049_aca_student_elective_subject', 1),
(19, '2021_05_12_033748_aca_setting', 1),
(20, '2021_05_13_054104_aca_absence_reason', 1),
(21, '2021_05_17_044529_aca_student_attendance', 1),
(22, '2021_05_17_044552_aca_student_attendance_detail', 1),
(23, '2021_06_22_155219_add_foreign_to_aca_subject', 1),
(24, '2021_07_02_110230_aca_instructional_days_special_case', 1),
(25, '2021_07_05_055809_aca_class_subject_history', 1),
(26, '2021_07_05_055859_aca_class_assessment_frequency_history', 1),
(27, '2021_07_05_060016_aca_class_subject_assessment_history', 1),
(28, '2021_07_05_094623_aca_class_teacher_history', 1),
(29, '2021_07_05_103044_aca_subject_teacher__history', 1),
(30, '2021_07_06_052225_aca_student_attendance_history', 1),
(31, '2021_07_06_054342_aca_student_assessment_history', 1),
(32, '2021_07_06_060640_aca_consolidated_result_history', 1),
(33, '2021_07_06_063947_aca_stduent_elective_subject_history', 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `aca_absence_reason`
--
ALTER TABLE `aca_absence_reason`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aca_absence_reason_name_unique` (`name`),
  ADD KEY `aca_absence_reason_status_index` (`status`),
  ADD KEY `aca_absence_reason_created_by_index` (`created_by`),
  ADD KEY `aca_absence_reason_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_assessment_area`
--
ALTER TABLE `aca_assessment_area`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aca_assessment_area_aca_sub_id_name_unique` (`aca_sub_id`,`name`),
  ADD KEY `aca_assessment_area_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_assessment_area_aca_rating_type_id_index` (`aca_rating_type_id`),
  ADD KEY `aca_assessment_area_display_order_index` (`display_order`),
  ADD KEY `aca_assessment_area_status_index` (`status`),
  ADD KEY `aca_assessment_area_created_by_index` (`created_by`),
  ADD KEY `aca_assessment_area_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_assessment_frequency`
--
ALTER TABLE `aca_assessment_frequency`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aca_assessment_frequency_name_unique` (`name`),
  ADD KEY `aca_assessment_frequency_not_assessed_index` (`not_assessed`),
  ADD KEY `aca_assessment_frequency_status_index` (`status`),
  ADD KEY `aca_assessment_frequency_created_by_index` (`created_by`),
  ADD KEY `aca_assessment_frequency_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_assessment_term`
--
ALTER TABLE `aca_assessment_term`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aca_assessment_term_name_unique` (`name`),
  ADD KEY `aca_assessment_term_aca_assmt_frequency_id_index` (`aca_assmt_frequency_id`),
  ADD KEY `aca_assessment_term_display_order_index` (`display_order`),
  ADD KEY `aca_assessment_term_status_index` (`status`),
  ADD KEY `aca_assessment_term_created_by_index` (`created_by`),
  ADD KEY `aca_assessment_term_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_class_assessment_frequency`
--
ALTER TABLE `aca_class_assessment_frequency`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_class_assessment_frequency_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_class_assessment_frequency_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_class_assessment_frequency_aca_assmt_frequency_id_index` (`aca_assmt_frequency_id`),
  ADD KEY `aca_class_assessment_frequency_created_by_index` (`created_by`),
  ADD KEY `aca_class_assessment_frequency_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_class_assmnt_frequency_history`
--
ALTER TABLE `aca_class_assmnt_frequency_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_class_assmnt_frequency_history_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_class_assmnt_frequency_history_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_class_assmnt_frequency_history_aca_assmt_frequency_id_index` (`aca_assmt_frequency_id`),
  ADD KEY `aca_class_assmnt_frequency_history_created_by_index` (`created_by`),
  ADD KEY `aca_class_assmnt_frequency_history_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_class_subject`
--
ALTER TABLE `aca_class_subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_class_stream_sub` (`org_class_id`,`org_stream_id`,`aca_sub_id`),
  ADD KEY `aca_class_subject_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_class_subject_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_class_subject_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_class_subject_aca_rating_type_id_index` (`aca_rating_type_id`),
  ADD KEY `aca_class_subject_is_elective_index` (`is_elective`),
  ADD KEY `aca_class_subject_show_in_result_index` (`show_in_result`),
  ADD KEY `aca_class_subject_created_by_index` (`created_by`),
  ADD KEY `aca_class_subject_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_class_subject_assessment`
--
ALTER TABLE `aca_class_subject_assessment`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_class_stream_sub_term_area` (`org_class_id`,`org_stream_id`,`aca_sub_id`,`aca_assmt_term_id`,`aca_assmt_area_id`),
  ADD KEY `aca_class_subject_assessment_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_class_subject_assessment_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_class_subject_assessment_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_class_subject_assessment_aca_assmt_term_id_index` (`aca_assmt_term_id`),
  ADD KEY `aca_class_subject_assessment_aca_assmt_area_id_index` (`aca_assmt_area_id`),
  ADD KEY `aca_class_subject_assessment_display_order_index` (`display_order`),
  ADD KEY `aca_class_subject_assessment_created_by_index` (`created_by`),
  ADD KEY `aca_class_subject_assessment_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_class_subject_history`
--
ALTER TABLE `aca_class_subject_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_class_subject_history_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_class_subject_history_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_class_subject_history_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_class_subject_history_aca_rating_type_id_index` (`aca_rating_type_id`),
  ADD KEY `aca_class_subject_history_is_elective_index` (`is_elective`),
  ADD KEY `aca_class_subject_history_show_in_result_index` (`show_in_result`),
  ADD KEY `aca_class_subject_history_created_by_index` (`created_by`),
  ADD KEY `aca_class_subject_history_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_class_subject_teacher`
--
ALTER TABLE `aca_class_subject_teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_class_subject_teacher_org_id_index` (`org_id`),
  ADD KEY `aca_class_subject_teacher_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_class_subject_teacher_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_class_subject_teacher_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_class_subject_teacher_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_class_subject_teacher_stf_staff_id_index` (`stf_staff_id`),
  ADD KEY `aca_class_subject_teacher_created_by_index` (`created_by`),
  ADD KEY `aca_class_subject_teacher_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_class_sub_assmnt_history`
--
ALTER TABLE `aca_class_sub_assmnt_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_class_sub_assmnt_history_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_class_sub_assmnt_history_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_class_sub_assmnt_history_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_class_sub_assmnt_history_aca_assmt_term_id_index` (`aca_assmt_term_id`),
  ADD KEY `aca_class_sub_assmnt_history_aca_assmt_area_id_index` (`aca_assmt_area_id`),
  ADD KEY `aca_class_sub_assmnt_history_display_order_index` (`display_order`),
  ADD KEY `aca_class_sub_assmnt_history_created_by_index` (`created_by`),
  ADD KEY `aca_class_sub_assmnt_history_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_class_teacher`
--
ALTER TABLE `aca_class_teacher`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_class_teacher_org_id_index` (`org_id`),
  ADD KEY `aca_class_teacher_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_class_teacher_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_class_teacher_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_class_teacher_org_class_stream_id_index` (`org_class_stream_id`),
  ADD KEY `aca_class_teacher_stf_staff_id_index` (`stf_staff_id`),
  ADD KEY `aca_class_teacher_created_by_index` (`created_by`),
  ADD KEY `aca_class_teacher_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_class_teacher_history`
--
ALTER TABLE `aca_class_teacher_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_class_teacher_history_org_id_index` (`org_id`),
  ADD KEY `aca_class_teacher_history_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_class_teacher_history_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_class_teacher_history_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_class_teacher_history_org_class_stream_id_index` (`org_class_stream_id`),
  ADD KEY `aca_class_teacher_history_stf_staff_id_index` (`stf_staff_id`),
  ADD KEY `aca_class_teacher_history_created_by_index` (`created_by`),
  ADD KEY `aca_class_teacher_history_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_con_result_history`
--
ALTER TABLE `aca_con_result_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_con_result_history_org_id_index` (`org_id`),
  ADD KEY `aca_con_result_history_aca_assmt_term_id_index` (`aca_assmt_term_id`),
  ADD KEY `aca_con_result_history_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_con_result_history_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_con_result_history_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_con_result_history_finalized_index` (`finalized`),
  ADD KEY `aca_con_result_history_published_index` (`published`),
  ADD KEY `aca_con_result_history_std_student_id_index` (`std_student_id`),
  ADD KEY `aca_con_result_history_result_index` (`result`),
  ADD KEY `aca_con_result_history_created_by_index` (`created_by`),
  ADD KEY `aca_con_result_history_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_instructional_days_special_case`
--
ALTER TABLE `aca_instructional_days_special_case`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_instructional_days_special_case_org_id_index` (`org_id`),
  ADD KEY `aca_instructional_days_special_case_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_instructional_days_special_case_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_instructional_days_special_case_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_instructional_days_special_case_std_student_id_index` (`std_student_id`),
  ADD KEY `aca_instructional_days_special_case_aca_term_id_index` (`aca_term_id`),
  ADD KEY `aca_instructional_days_special_case_instructional_days_index` (`instructional_days`),
  ADD KEY `aca_instructional_days_special_case_created_by_index` (`created_by`),
  ADD KEY `aca_instructional_days_special_case_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_rating`
--
ALTER TABLE `aca_rating`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aca_rating_name_unique` (`name`),
  ADD KEY `aca_rating_aca_rating_type_id_index` (`aca_rating_type_id`),
  ADD KEY `aca_rating_status_index` (`status`),
  ADD KEY `aca_rating_created_by_index` (`created_by`),
  ADD KEY `aca_rating_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_rating_type`
--
ALTER TABLE `aca_rating_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aca_rating_type_name_unique` (`name`),
  ADD KEY `aca_rating_type_aca_sub_category_id_foreign` (`aca_sub_category_id`),
  ADD KEY `aca_rating_type_input_type_index` (`input_type`),
  ADD KEY `aca_rating_type_status_index` (`status`),
  ADD KEY `aca_rating_type_created_by_index` (`created_by`),
  ADD KEY `aca_rating_type_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_result_consolidated`
--
ALTER TABLE `aca_result_consolidated`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_result_consolidated_org_id_index` (`org_id`),
  ADD KEY `aca_result_consolidated_aca_assmt_term_id_index` (`aca_assmt_term_id`),
  ADD KEY `aca_result_consolidated_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_result_consolidated_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_result_consolidated_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_result_consolidated_finalized_index` (`finalized`),
  ADD KEY `aca_result_consolidated_published_index` (`published`),
  ADD KEY `aca_result_consolidated_created_by_index` (`created_by`),
  ADD KEY `aca_result_consolidated_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_result_consolidated_detail`
--
ALTER TABLE `aca_result_consolidated_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_result_consolidated_detail_aca_result_consol_id_index` (`aca_result_consol_id`),
  ADD KEY `aca_result_consolidated_detail_std_student_id_index` (`std_student_id`),
  ADD KEY `aca_result_consolidated_detail_result_index` (`result`),
  ADD KEY `aca_result_consolidated_detail_created_by_index` (`created_by`),
  ADD KEY `aca_result_consolidated_detail_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_school_elective_subject`
--
ALTER TABLE `aca_school_elective_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_school_elective_subject_org_id_index` (`org_id`),
  ADD KEY `aca_school_elective_subject_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_school_elective_subject_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_school_elective_subject_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_school_elective_subject_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_school_elective_subject_created_by_index` (`created_by`),
  ADD KEY `aca_school_elective_subject_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_setting`
--
ALTER TABLE `aca_setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `aca_std_assmnt_history`
--
ALTER TABLE `aca_std_assmnt_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_std_assmnt_history_org_id_index` (`org_id`),
  ADD KEY `aca_std_assmnt_history_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_std_assmnt_history_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_std_assmnt_history_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_std_assmnt_history_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_std_assmnt_history_aca_assmt_term_id_index` (`aca_assmt_term_id`),
  ADD KEY `aca_std_assmnt_history_finalized_index` (`finalized`),
  ADD KEY `aca_std_assmnt_history_std_student_id_index` (`std_student_id`),
  ADD KEY `aca_std_assmnt_history_aca_assmt_area_id_index` (`aca_assmt_area_id`),
  ADD KEY `aca_std_assmnt_history_aca_rating_type_id_index` (`aca_rating_type_id`),
  ADD KEY `aca_std_assmnt_history_created_by_index` (`created_by`),
  ADD KEY `aca_std_assmnt_history_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_std_attendance_history`
--
ALTER TABLE `aca_std_attendance_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_std_attendance_history_org_id_index` (`org_id`),
  ADD KEY `aca_std_attendance_history_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_std_attendance_history_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_std_attendance_history_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_std_attendance_history_attendance_date_index` (`attendance_date`),
  ADD KEY `aca_std_attendance_history_std_student_id_index` (`std_student_id`),
  ADD KEY `aca_std_attendance_history_created_by_index` (`created_by`),
  ADD KEY `aca_std_attendance_history_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_std_optional_sub_history`
--
ALTER TABLE `aca_std_optional_sub_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_std_optional_sub_history_org_id_index` (`org_id`),
  ADD KEY `aca_std_optional_sub_history_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_std_optional_sub_history_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_std_optional_sub_history_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_std_optional_sub_history_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_std_optional_sub_history_created_by_index` (`created_by`),
  ADD KEY `aca_std_optional_sub_history_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_student_assessment`
--
ALTER TABLE `aca_student_assessment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_student_assessment_org_id_index` (`org_id`),
  ADD KEY `aca_student_assessment_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_student_assessment_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_student_assessment_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_student_assessment_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_student_assessment_aca_assmt_term_id_index` (`aca_assmt_term_id`),
  ADD KEY `aca_student_assessment_finalized_index` (`finalized`),
  ADD KEY `aca_student_assessment_created_by_index` (`created_by`),
  ADD KEY `aca_student_assessment_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_student_assessment_detail`
--
ALTER TABLE `aca_student_assessment_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_student_assessment_detail_aca_student_assmt_id_index` (`aca_student_assmt_id`),
  ADD KEY `aca_student_assessment_detail_std_student_id_index` (`std_student_id`),
  ADD KEY `aca_student_assessment_detail_aca_assmt_area_id_index` (`aca_assmt_area_id`),
  ADD KEY `aca_student_assessment_detail_aca_rating_type_id_index` (`aca_rating_type_id`),
  ADD KEY `aca_student_assessment_detail_created_by_index` (`created_by`),
  ADD KEY `aca_student_assessment_detail_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_student_attendance`
--
ALTER TABLE `aca_student_attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `unique_class_stream_attendance_date` (`org_class_id`,`org_stream_id`,`org_section_id`,`attendance_date`),
  ADD KEY `aca_student_attendance_org_id_index` (`org_id`),
  ADD KEY `aca_student_attendance_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_student_attendance_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_student_attendance_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_student_attendance_attendance_date_index` (`attendance_date`),
  ADD KEY `aca_student_attendance_created_by_index` (`created_by`),
  ADD KEY `aca_student_attendance_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_student_attendance_detail`
--
ALTER TABLE `aca_student_attendance_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_student_attendance_detail_aca_absence_reason_id_foreign` (`aca_absence_reason_id`),
  ADD KEY `aca_student_attendance_detail_aca_std_attendance_id_index` (`aca_std_attendance_id`),
  ADD KEY `aca_student_attendance_detail_std_student_id_index` (`std_student_id`),
  ADD KEY `aca_student_attendance_detail_created_by_index` (`created_by`),
  ADD KEY `aca_student_attendance_detail_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_student_elective_subject`
--
ALTER TABLE `aca_student_elective_subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_student_elective_subject_std_student_id_index` (`std_student_id`),
  ADD KEY `aca_student_elective_subject_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_student_elective_subject_created_by_index` (`created_by`),
  ADD KEY `aca_student_elective_subject_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_subject`
--
ALTER TABLE `aca_subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aca_subject_name_unique` (`name`),
  ADD KEY `aca_subject_aca_sub_category_id_index` (`aca_sub_category_id`),
  ADD KEY `aca_subject_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_subject_assessed_by_class_teacher_index` (`assessed_by_class_teacher`),
  ADD KEY `aca_subject_is_special_educational_needs_index` (`is_special_educational_needs`),
  ADD KEY `aca_subject_display_order_index` (`display_order`),
  ADD KEY `aca_subject_status_index` (`status`),
  ADD KEY `aca_subject_created_by_index` (`created_by`),
  ADD KEY `aca_subject_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_subject_category`
--
ALTER TABLE `aca_subject_category`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `aca_subject_category_name_unique` (`name`),
  ADD KEY `aca_subject_category_display_order_index` (`display_order`),
  ADD KEY `aca_subject_category_status_index` (`status`),
  ADD KEY `aca_subject_category_created_by_index` (`created_by`),
  ADD KEY `aca_subject_category_updated_by_index` (`updated_by`);

--
-- Indexes for table `aca_sub_teacher_history`
--
ALTER TABLE `aca_sub_teacher_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `aca_sub_teacher_history_org_id_index` (`org_id`),
  ADD KEY `aca_sub_teacher_history_org_class_id_index` (`org_class_id`),
  ADD KEY `aca_sub_teacher_history_org_stream_id_index` (`org_stream_id`),
  ADD KEY `aca_sub_teacher_history_org_section_id_index` (`org_section_id`),
  ADD KEY `aca_sub_teacher_history_aca_sub_id_index` (`aca_sub_id`),
  ADD KEY `aca_sub_teacher_history_stf_staff_id_index` (`stf_staff_id`),
  ADD KEY `aca_sub_teacher_history_created_by_index` (`created_by`),
  ADD KEY `aca_sub_teacher_history_updated_by_index` (`updated_by`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `aca_assessment_area`
--
ALTER TABLE `aca_assessment_area`
  ADD CONSTRAINT `aca_assessment_area_aca_rating_type_id_foreign` FOREIGN KEY (`aca_rating_type_id`) REFERENCES `aca_rating_type` (`id`),
  ADD CONSTRAINT `aca_assessment_area_aca_sub_id_foreign` FOREIGN KEY (`aca_sub_id`) REFERENCES `aca_subject` (`id`);

--
-- Constraints for table `aca_assessment_term`
--
ALTER TABLE `aca_assessment_term`
  ADD CONSTRAINT `aca_assessment_term_aca_assmt_frequency_id_foreign` FOREIGN KEY (`aca_assmt_frequency_id`) REFERENCES `aca_assessment_frequency` (`id`);

--
-- Constraints for table `aca_class_assessment_frequency`
--
ALTER TABLE `aca_class_assessment_frequency`
  ADD CONSTRAINT `aca_class_assessment_frequency_aca_assmt_frequency_id_foreign` FOREIGN KEY (`aca_assmt_frequency_id`) REFERENCES `aca_assessment_frequency` (`id`);

--
-- Constraints for table `aca_class_subject`
--
ALTER TABLE `aca_class_subject`
  ADD CONSTRAINT `aca_class_subject_aca_rating_type_id_foreign` FOREIGN KEY (`aca_rating_type_id`) REFERENCES `aca_rating_type` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `aca_class_subject_aca_sub_id_foreign` FOREIGN KEY (`aca_sub_id`) REFERENCES `aca_subject` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aca_class_subject_assessment`
--
ALTER TABLE `aca_class_subject_assessment`
  ADD CONSTRAINT `aca_class_subject_assessment_aca_assmt_area_id_foreign` FOREIGN KEY (`aca_assmt_area_id`) REFERENCES `aca_assessment_area` (`id`),
  ADD CONSTRAINT `aca_class_subject_assessment_aca_assmt_term_id_foreign` FOREIGN KEY (`aca_assmt_term_id`) REFERENCES `aca_assessment_term` (`id`),
  ADD CONSTRAINT `aca_class_subject_assessment_aca_sub_id_foreign` FOREIGN KEY (`aca_sub_id`) REFERENCES `aca_subject` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aca_class_subject_teacher`
--
ALTER TABLE `aca_class_subject_teacher`
  ADD CONSTRAINT `aca_class_subject_teacher_aca_sub_id_foreign` FOREIGN KEY (`aca_sub_id`) REFERENCES `aca_subject` (`id`);

--
-- Constraints for table `aca_rating`
--
ALTER TABLE `aca_rating`
  ADD CONSTRAINT `aca_rating_aca_rating_type_id_foreign` FOREIGN KEY (`aca_rating_type_id`) REFERENCES `aca_rating_type` (`id`);

--
-- Constraints for table `aca_rating_type`
--
ALTER TABLE `aca_rating_type`
  ADD CONSTRAINT `aca_rating_type_aca_sub_category_id_foreign` FOREIGN KEY (`aca_sub_category_id`) REFERENCES `aca_subject_category` (`id`);

--
-- Constraints for table `aca_result_consolidated`
--
ALTER TABLE `aca_result_consolidated`
  ADD CONSTRAINT `aca_result_consolidated_aca_assmt_term_id_foreign` FOREIGN KEY (`aca_assmt_term_id`) REFERENCES `aca_assessment_term` (`id`);

--
-- Constraints for table `aca_result_consolidated_detail`
--
ALTER TABLE `aca_result_consolidated_detail`
  ADD CONSTRAINT `aca_result_consolidated_detail_aca_result_consol_id_foreign` FOREIGN KEY (`aca_result_consol_id`) REFERENCES `aca_result_consolidated` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aca_school_elective_subject`
--
ALTER TABLE `aca_school_elective_subject`
  ADD CONSTRAINT `aca_school_elective_subject_aca_sub_id_foreign` FOREIGN KEY (`aca_sub_id`) REFERENCES `aca_subject` (`id`);

--
-- Constraints for table `aca_student_assessment`
--
ALTER TABLE `aca_student_assessment`
  ADD CONSTRAINT `aca_student_assessment_aca_assmt_term_id_foreign` FOREIGN KEY (`aca_assmt_term_id`) REFERENCES `aca_assessment_term` (`id`),
  ADD CONSTRAINT `aca_student_assessment_aca_sub_id_foreign` FOREIGN KEY (`aca_sub_id`) REFERENCES `aca_subject` (`id`);

--
-- Constraints for table `aca_student_assessment_detail`
--
ALTER TABLE `aca_student_assessment_detail`
  ADD CONSTRAINT `aca_student_assessment_detail_aca_assmt_area_id_foreign` FOREIGN KEY (`aca_assmt_area_id`) REFERENCES `aca_assessment_area` (`id`),
  ADD CONSTRAINT `aca_student_assessment_detail_aca_rating_type_id_foreign` FOREIGN KEY (`aca_rating_type_id`) REFERENCES `aca_rating_type` (`id`),
  ADD CONSTRAINT `aca_student_assessment_detail_aca_student_assmt_id_foreign` FOREIGN KEY (`aca_student_assmt_id`) REFERENCES `aca_student_assessment` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aca_student_attendance_detail`
--
ALTER TABLE `aca_student_attendance_detail`
  ADD CONSTRAINT `aca_student_attendance_detail_aca_absence_reason_id_foreign` FOREIGN KEY (`aca_absence_reason_id`) REFERENCES `aca_absence_reason` (`id`),
  ADD CONSTRAINT `aca_student_attendance_detail_aca_std_attendance_id_foreign` FOREIGN KEY (`aca_std_attendance_id`) REFERENCES `aca_student_attendance` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `aca_student_elective_subject`
--
ALTER TABLE `aca_student_elective_subject`
  ADD CONSTRAINT `aca_student_elective_subject_aca_sub_id_foreign` FOREIGN KEY (`aca_sub_id`) REFERENCES `aca_subject` (`id`);

--
-- Constraints for table `aca_subject`
--
ALTER TABLE `aca_subject`
  ADD CONSTRAINT `aca_subject_aca_sub_category_id_foreign` FOREIGN KEY (`aca_sub_category_id`) REFERENCES `aca_subject_category` (`id`),
  ADD CONSTRAINT `aca_subject_aca_sub_id_foreign` FOREIGN KEY (`aca_sub_id`) REFERENCES `aca_subject` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
