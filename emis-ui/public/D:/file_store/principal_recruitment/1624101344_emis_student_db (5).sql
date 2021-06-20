-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jun 09, 2021 at 03:24 PM
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
-- Database: `emis_student_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cea_award`
--

CREATE TABLE `cea_award` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaAwardTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaAwardId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CeaProgrammeId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Description` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cea_award`
--

INSERT INTO `cea_award` (`id`, `CeaAwardTypeId`, `Name`, `CeaAwardId`, `CeaProgrammeId`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('4b492393-8401-42c0-9b48-925143084f6d', '3783e1da-cd74-423f-975c-6b89fe4c667c', 'Best Student Award', NULL, NULL, 'test', 1, NULL, NULL, '2021-05-16 10:45:55', '2021-05-16 10:45:28'),
('6ec499a9-e1f8-4fdc-a4c3-c77c82c4cfdc', '3783e1da-cd74-423f-975c-6b89fe4c667c', 'Physics Topper', NULL, NULL, 'test', 1, NULL, NULL, '2021-05-16 10:51:22', '2021-05-16 10:51:22'),
('82a6da62-2dd1-400d-b880-1c039d4b6c15', '3007bbea-1719-4033-9492-fd958f2ca6b4', 'Atheltics', NULL, NULL, 'test', 1, NULL, NULL, '2021-06-03 03:32:40', '2021-06-03 03:32:40'),
('ed017adb-386b-4424-84a4-1692647a6f78', '3783e1da-cd74-423f-975c-6b89fe4c667c', 'Bhutan Topper', NULL, NULL, '', 1, NULL, NULL, '2021-05-16 10:52:12', '2021-05-16 10:49:25');

-- --------------------------------------------------------

--
-- Table structure for table `cea_award_school_level`
--

CREATE TABLE `cea_award_school_level` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaAwardId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgSchoolLevelId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_award_type`
--

CREATE TABLE `cea_award_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cea_award_type`
--

INSERT INTO `cea_award_type` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('3007bbea-1719-4033-9492-fd958f2ca6b4', 'Best Sports Person', 'SPorts', 1, NULL, NULL, '2021-06-03 03:32:18', '2021-06-03 03:32:18'),
('3783e1da-cd74-423f-975c-6b89fe4c667c', 'Academic Awards', 'Academic Awards', 1, NULL, NULL, '2021-05-16 05:49:09', '2021-05-16 05:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme`
--

CREATE TABLE `cea_programme` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Not null for a sub-programme',
  `Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Includes programme,club, etc.';

--
-- Dumping data for table `cea_programme`
--

INSERT INTO `cea_programme` (`id`, `CeaProgrammeTypeId`, `Name`, `CeaProgrammeId`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('4e855be1-01a2-4c05-9a44-703b4caa461f', '4af396b4-265f-4677-947c-a0e16d5f659b', 'Fire Fighting', NULL, 'Fire Fightings', 1, NULL, NULL, '2021-06-09 00:09:24', '2021-06-09 00:09:24'),
('a73eb2ad-0a1c-473f-af9b-9da8abe89e5d', 'e941ed19-7dca-47fb-b4ef-a424cc7b5e95', 'SAP', NULL, 'SAP Programme', 1, NULL, NULL, '2021-05-16 11:41:58', '2021-05-16 11:41:58'),
('aa787c01-4738-4bf2-8d54-9392fca1ec42', 'e941ed19-7dca-47fb-b4ef-a424cc7b5e95', 'SAP 2.0', NULL, 'SAP 2.0', 1, NULL, NULL, '2021-06-09 00:08:47', '2021-05-16 11:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_action_plan`
--

CREATE TABLE `cea_programme_action_plan` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgOrganizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FromDate` date NOT NULL,
  `ToDate` date NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_action_plan_detail`
--

CREATE TABLE `cea_programme_action_plan_detail` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeActionPlanId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Title` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_inventory`
--

CREATE TABLE `cea_programme_inventory` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgOrganizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ForMonth` date NOT NULL COMMENT 'Month of production (save yyyy-mm-01)',
  `Remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_inventory_detail`
--

CREATE TABLE `cea_programme_inventory_detail` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeInventoryId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeInventoryItemId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `IncreaseInQuantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `DecreaseInQuantity` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_inventory_expenditure`
--

CREATE TABLE `cea_programme_inventory_expenditure` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeInventoryId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Particular` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Amount` decimal(10,2) NOT NULL,
  `Remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_inventory_item`
--

CREATE TABLE `cea_programme_inventory_item` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnMeasurementUnitId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_inventory_production`
--

CREATE TABLE `cea_programme_inventory_production` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeInventoryId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeInventoryItemId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `QuantityProduced` decimal(10,2) NOT NULL,
  `NoOfVariety` tinyint(4) NOT NULL,
  `AmountGenerated` decimal(10,2) NOT NULL DEFAULT 0.00,
  `Remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_item`
--

CREATE TABLE `cea_programme_item` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 - Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cea_programme_item`
--

INSERT INTO `cea_programme_item` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('5e0f61e3-8efc-4ca4-ac32-0eb2d3ec6b08', 'Corn', 'Corn/Maize', 1, NULL, NULL, '2021-05-16 12:33:34', '2021-05-16 12:33:34'),
('9c151ff7-bc56-4a0e-b25b-ab10d4913e5b', 'Chillies', 'Chillies', 1, NULL, NULL, '2021-04-21 22:45:05', '2021-04-21 22:45:05'),
('f41c43ae-edf5-4d8a-853f-502ea8b11651', 'Potatoes', 'Potatoes', 1, NULL, NULL, '2021-04-16 12:50:13', '2021-04-16 12:50:13');

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_measurement`
--

CREATE TABLE `cea_programme_measurement` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 - Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cea_programme_measurement`
--

INSERT INTO `cea_programme_measurement` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('0b4ec15b-a47c-49ad-84e1-53435daf969c', 'Ltr', 'Liters', 1, NULL, NULL, '2021-04-21 22:45:44', '2021-04-21 22:45:44'),
('2e5493b0-03ae-41fc-8468-b9c9e927f54e', 'Nos', 'Numbers', 1, NULL, NULL, '2021-04-21 22:45:33', '2021-04-21 22:45:33'),
('3f83bbbe-f782-4074-be16-b01dd6fa4d78', 'Kgs', 'Kilogram', 1, NULL, NULL, '2021-04-16 13:05:29', '2021-04-16 13:05:29'),
('7e5f23dd-e811-4a94-876e-d798e7adc9a5', 'Units', 'Units', 1, NULL, NULL, '2021-05-16 12:33:21', '2021-05-16 12:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_membership`
--

CREATE TABLE `cea_programme_membership` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `JoiningDate` date NOT NULL,
  `Responsibility` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Achievement` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_school_level`
--

CREATE TABLE `cea_programme_school_level` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgSchoolLevelId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_supporter`
--

CREATE TABLE `cea_programme_supporter` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cea_programme_supporter`
--

INSERT INTO `cea_programme_supporter` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('067cef78-6e78-4188-b729-596108f2adec', 'BOC', 'Bhutan Olympic Committee', 1, NULL, NULL, '2021-05-16 11:45:44', '2021-05-16 11:45:44'),
('b5765d9c-a049-427e-8324-279de2e6d70e', 'IOC', 'IOC', 1, NULL, NULL, '2021-06-03 03:35:58', '2021-06-03 03:35:58');

-- --------------------------------------------------------

--
-- Table structure for table `cea_programme_type`
--

CREATE TABLE `cea_programme_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Co-curricular and extracurricular activities types';

--
-- Dumping data for table `cea_programme_type`
--

INSERT INTO `cea_programme_type` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('4af396b4-265f-4677-947c-a0e16d5f659b', 'Clubs', 'Clubs', 1, NULL, NULL, '2021-05-16 11:40:41', '2021-05-16 11:40:41'),
('e941ed19-7dca-47fb-b4ef-a424cc7b5e95', 'Programs', 'Programs', 1, NULL, NULL, '2021-05-16 11:40:04', '2021-05-16 11:40:04');

-- --------------------------------------------------------

--
-- Table structure for table `cea_project`
--

CREATE TABLE `cea_project` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgOrganizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProjectTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProjectId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CeaProgrammeId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `FromDate` date NOT NULL,
  `ToDate` date NOT NULL,
  `Place` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1 COMMENT '0 - Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_project_membership`
--

CREATE TABLE `cea_project_membership` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CaeProjectId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Task` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_project_type`
--

CREATE TABLE `cea_project_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 - Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cea_project_type`
--

INSERT INTO `cea_project_type` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('23fd4ba1-1c16-4c9c-b4f9-41a8ffbcb0d7', 'test', 'test', 1, NULL, NULL, '2021-05-25 09:47:11', '2021-05-25 09:47:11'),
('d40bb287-3209-457f-a64d-aa4bdeb8fbfe', 'Science Project', 'Science Project', 1, NULL, NULL, '2021-05-25 09:44:40', '2021-05-25 09:44:40'),
('e1004424-f8b8-4b4c-ac80-e468914330ba', 'Environmental Project', 'Sponsored by RSPN', 1, NULL, NULL, '2021-05-16 11:49:37', '2021-05-16 11:49:37'),
('fc195adb-f05a-4aa2-9327-549b3175599e', 'Maths Olympiad', 'Maths', 1, NULL, NULL, '2021-06-03 03:36:47', '2021-06-03 03:36:47');

-- --------------------------------------------------------

--
-- Table structure for table `cea_project_type_school_level`
--

CREATE TABLE `cea_project_type_school_level` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProjectTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgSchoolLevelId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_quarter_type`
--

CREATE TABLE `cea_quarter_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(4) NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cea_quarter_type`
--

INSERT INTO `cea_quarter_type` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('662095c5-6f92-464f-8f15-861079081b4d', '2nd Quarter', '2nd Quarter', 1, NULL, NULL, '2021-05-25 09:49:46', '2021-05-25 09:49:46'),
('6d8e32a3-3509-4fbb-992c-e48f1d64edd0', '1st Quarter', 'wuater', 1, NULL, NULL, '2021-05-17 05:05:47', '2021-05-17 05:05:47');

-- --------------------------------------------------------

--
-- Table structure for table `cea_role`
--

CREATE TABLE `cea_role` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `AssignedTo` tinyint(3) UNSIGNED NOT NULL COMMENT '1 - Staff; 2 - Student',
  `Remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 - Disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cea_role`
--

INSERT INTO `cea_role` (`id`, `CeaProgrammeId`, `Name`, `AssignedTo`, `Remarks`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1178c355-8a6d-472f-b974-8ec6c4e3edf7', 'a73eb2ad-0a1c-473f-af9b-9da8abe89e5d', 'President', 1, NULL, 1, NULL, NULL, '2021-05-16 11:47:56', '2021-05-16 11:47:33'),
('7bb12a36-ff4d-463f-bf46-c5d108622b38', '4e855be1-01a2-4c05-9a44-703b4caa461f', 'Member', 0, NULL, 1, NULL, NULL, '2021-06-09 03:15:52', '2021-06-09 03:15:52'),
('9b722968-9bcd-420c-baf8-6f8b8c47ea31', 'aa787c01-4738-4bf2-8d54-9392fca1ec42', 'Vice President', 1, NULL, 1, NULL, NULL, '2021-06-09 03:18:18', '2021-06-03 03:36:22');

-- --------------------------------------------------------

--
-- Table structure for table `cea_role_staff`
--

CREATE TABLE `cea_role_staff` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaRoleId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StfStaffId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_role_student`
--

CREATE TABLE `cea_role_student` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaRoleId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_school_programme`
--

CREATE TABLE `cea_school_programme` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgOrganizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaProgrammeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `EstablishmentYear` smallint(5) UNSIGNED NOT NULL,
  `CeaProgrammeSupporterId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Remarks` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Programmes that are there in a school';

--
-- Dumping data for table `cea_school_programme`
--

INSERT INTO `cea_school_programme` (`id`, `OrgOrganizationId`, `CeaProgrammeId`, `EstablishmentYear`, `CeaProgrammeSupporterId`, `Remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('3dafea30-8b3e-4415-bde5-0c502c613569', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'a73eb2ad-0a1c-473f-af9b-9da8abe89e5d', 0, '067cef78-6e78-4188-b729-596108f2adec', 'test', NULL, NULL, '2021-06-07 22:13:43', '2021-06-07 22:13:43'),
('8a10d262-feb8-4030-a96c-877e45ef4d82', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '4e855be1-01a2-4c05-9a44-703b4caa461f', 2009, '067cef78-6e78-4188-b729-596108f2adec', 'test', NULL, NULL, '2021-06-09 01:00:48', '2021-06-09 01:00:48'),
('9e97145c-7590-46d5-88c2-f3943a7d1262', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'a73eb2ad-0a1c-473f-af9b-9da8abe89e5d', 0, '067cef78-6e78-4188-b729-596108f2adec', 'test', NULL, NULL, '2021-06-07 22:13:44', '2021-06-07 22:13:44'),
('ea27d623-1907-42c3-9b1d-046339935658', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'aa787c01-4738-4bf2-8d54-9392fca1ec42', 1234, 'b5765d9c-a049-427e-8324-279de2e6d70e', 'test', NULL, NULL, '2021-06-07 22:17:00', '2021-06-07 22:17:00');

-- --------------------------------------------------------

--
-- Table structure for table `cea_scout_advancement_level`
--

CREATE TABLE `cea_scout_advancement_level` (
  `id` char(36) NOT NULL,
  `CeaScoutProficiencyBadgesId` char(36) NOT NULL,
  `StdStudentId` char(36) NOT NULL,
  `yearEarned` year(4) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cea_scout_leaders`
--

CREATE TABLE `cea_scout_leaders` (
  `id` char(36) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` tinyint(4) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cea_scout_leaders`
--

INSERT INTO `cea_scout_leaders` (`id`, `Name`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('47130738-404f-431f-9b34-8dd9ac9a29eb', 'LT', NULL, NULL, NULL, NULL, '2021-05-27 22:14:29.000000', '2021-05-27 22:14:29.000000'),
('630c146f-7e1c-4b23-91ed-9a861ba99e0c', 'Woodbadge', NULL, NULL, NULL, NULL, '2021-05-27 22:14:11.000000', '2021-05-27 22:14:11.000000'),
('6eedae12-5d0c-4305-81c2-8350e844978b', 'ALT', NULL, NULL, NULL, NULL, '2021-05-27 22:14:19.000000', '2021-05-27 22:14:19.000000'),
('8484ec8c-8ae6-486c-81b3-12c27c3de8b5', 'BULT', NULL, NULL, NULL, NULL, '2021-05-27 13:46:54.000000', '2021-05-27 13:46:54.000000');

-- --------------------------------------------------------

--
-- Table structure for table `cea_scout_membership`
--

CREATE TABLE `cea_scout_membership` (
  `id` char(36) NOT NULL,
  `CeaScoutSectionLevelId` char(36) NOT NULL,
  `StdStudentId` char(36) NOT NULL,
  `joiningDate` date DEFAULT NULL,
  `responsibility` varchar(99) DEFAULT NULL,
  `remarks` varchar(250) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cea_scout_proficiency_badges`
--

CREATE TABLE `cea_scout_proficiency_badges` (
  `id` char(36) NOT NULL,
  `CeaScoutSectionLevelId` char(36) NOT NULL,
  `name` varchar(99) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created_by` varchar(99) DEFAULT NULL,
  `updated_by` varchar(99) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `cea_scout_section`
--

CREATE TABLE `cea_scout_section` (
  `id` char(36) NOT NULL,
  `Name` varchar(45) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `Status` tinyint(4) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cea_scout_section`
--

INSERT INTO `cea_scout_section` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1af966a8-66ad-4328-bae1-7056638241dd', 'Nazhoen', 'Nazhoen', 1, NULL, NULL, '2021-05-27 22:15:29.000000', '2021-05-27 22:15:29.000000'),
('8ef729ef-0fab-409f-be01-ec01271a4953', 'Nachung', 'Nachung', 1, NULL, NULL, '2021-05-25 10:53:36.000000', '2021-05-25 10:53:36.000000'),
('f157b688-5d52-4676-be98-50f3104ccab4', 'CheyChey', 'CheyChey', 1, NULL, NULL, '2021-05-27 22:15:07.000000', '2021-05-27 22:15:07.000000');

-- --------------------------------------------------------

--
-- Table structure for table `cea_scout_section_level`
--

CREATE TABLE `cea_scout_section_level` (
  `id` char(36) NOT NULL,
  `CeaScoutSectionId` char(36) NOT NULL,
  `Name` varchar(99) DEFAULT NULL,
  `Description` varchar(250) DEFAULT NULL,
  `Status` tinyint(3) DEFAULT NULL,
  `created_by` varchar(99) DEFAULT NULL,
  `updated_by` varchar(99) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `cea_scout_section_level`
--

INSERT INTO `cea_scout_section_level` (`id`, `CeaScoutSectionId`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('a3d22229-0bb7-471a-9dc3-1a5761adb5ca', '8ef729ef-0fab-409f-be01-ec01271a4953', 'Dawa', NULL, 1, NULL, NULL, '2021-05-27 14:18:06.000000', '2021-05-27 14:18:06.000000'),
('a3d22229-0bb7-471a-9dc3-1a5761adb5ce', '8ef729ef-0fab-409f-be01-ec01271a4953', 'Karma', NULL, 1, NULL, NULL, '2021-05-27 14:18:06.000000', '2021-05-27 14:18:06.000000'),
('a3d22229-0bb7-471a-9dc3-1a5761adb5cf', '8ef729ef-0fab-409f-be01-ec01271a4953', 'Nima', NULL, 1, NULL, NULL, '2021-05-27 14:18:06.000000', '2021-05-27 14:18:06.000000'),
('a3d22229-0bb7-471a-9dc3-1a5761adb5de', '1af966a8-66ad-4328-bae1-7056638241dd', 'Kuengao', 'Kuengao', 1, NULL, NULL, NULL, NULL),
('a3d22229-0bb7-471a-9dc3-1a5761adb5fg', '1af966a8-66ad-4328-bae1-7056638241dd', 'Sharibu', 'Sharibu', 1, NULL, NULL, NULL, NULL),
('a3d22229-0bb7-471a-9dc3-1a5761adb5hi', '1af966a8-66ad-4328-bae1-7056638241dd', 'Maugalbu', 'Maugalbu', 1, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cea_student_award`
--

CREATE TABLE `cea_student_award` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaAwardId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `AwardedBy` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `AwardDate` date NOT NULL,
  `Place` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cea_student_award`
--

INSERT INTO `cea_student_award` (`id`, `StdStudentId`, `CeaAwardId`, `AwardedBy`, `AwardDate`, `Place`, `Remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('5d8140e8-2455-4644-8b10-76e60c31301f', '1', '4b492393-8401-42c0-9b48-925143084f6d', 'test', '2021-05-17', 'test', 'test', NULL, NULL, '2021-05-17 07:07:38', '2021-05-17 07:07:38'),
('65544cb1-e5e2-45ab-a8f9-7a786d7305c8', '1', '4b492393-8401-42c0-9b48-925143084f6d', 'test', '2021-05-17', 'test', 'test', NULL, NULL, '2021-05-17 07:07:38', '2021-05-17 07:07:38'),
('c2894d17-741f-4f67-9851-fea0aa16a0df', '1052', '4b492393-8401-42c0-9b48-925143084f6d', 'test', '2021-05-27', 'test', 'test', NULL, NULL, '2021-05-27 16:10:21', '2021-05-27 16:10:21');

-- --------------------------------------------------------

--
-- Table structure for table `cea_student_training`
--

CREATE TABLE `cea_student_training` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaTrainingId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `FromDate` date NOT NULL,
  `ToDate` date NOT NULL,
  `CmnCountryId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Place` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DetailsOfTraining` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_student_training_participant`
--

CREATE TABLE `cea_student_training_participant` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaStudentTrainingId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Remarks` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_training`
--

CREATE TABLE `cea_training` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaTrainingTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaTrainingId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL COMMENT 'Not null for training sub-types, e.g., batch under a training',
  `CeaProgrammeId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Description` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Includes all student development activities like exchange programme, workshop, seminar, camp, etc.';

--
-- Dumping data for table `cea_training`
--

INSERT INTO `cea_training` (`id`, `CeaTrainingTypeId`, `Name`, `CeaTrainingId`, `CeaProgrammeId`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('45b21dca-84ec-4877-a776-c3c3eac22ea4', '82a43590-cf4d-477f-8323-2f3eaa237071', 'Forest Plantation', NULL, 'a73eb2ad-0a1c-473f-af9b-9da8abe89e5d', 'etst', 1, NULL, NULL, '2021-05-16 12:28:02', '2021-05-16 12:28:02');

-- --------------------------------------------------------

--
-- Table structure for table `cea_training_school_level`
--

CREATE TABLE `cea_training_school_level` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CeaTrainingId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgSchoolLevelId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cea_training_type`
--

CREATE TABLE `cea_training_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cea_training_type`
--

INSERT INTO `cea_training_type` (`id`, `Name`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('04de0e38-476d-4d89-906c-feccb4d585ab', 'Ex Country', 1, NULL, NULL, '2021-05-25 10:00:01', '2021-05-25 10:00:01'),
('82a43590-cf4d-477f-8323-2f3eaa237071', 'In Country Training', 1, NULL, NULL, '2021-05-16 11:51:32', '2021-05-16 11:51:32'),
('83ac7169-0b53-4e39-9fbb-a1b8735e13fc', 'JICA Training', 1, NULL, NULL, '2021-05-25 10:09:24', '2021-05-25 10:09:24'),
('c6e865a5-0335-4715-abbc-b7fa92605323', 'Short Term', 1, NULL, NULL, '2021-05-25 10:02:09', '2021-05-25 10:02:09'),
('d69ad24d-35dd-41fb-99d1-7502a86fbf2e', 'Weekly Trainings', 1, NULL, NULL, '2021-05-25 10:03:51', '2021-05-25 10:03:51');

-- --------------------------------------------------------

--
-- Table structure for table `request_for_admissions`
--

CREATE TABLE `request_for_admissions` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `dzongkhag` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `school` char(255) COLLATE utf8_unicode_ci NOT NULL,
  `class` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stream` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateOfapply` date NOT NULL,
  `snationality` tinytext COLLATE utf8_unicode_ci DEFAULT NULL,
  `reasons` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(99) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `request_for_admissions`
--

INSERT INTO `request_for_admissions` (`id`, `dzongkhag`, `school`, `class`, `stream`, `dateOfapply`, `snationality`, `reasons`, `status`, `created_at`, `updated_at`) VALUES
('31fac666-0a86-42e3-bc9c-ce4edb4d3244', '8', '00311272-9395-436f-a955-23e67a7141cc', NULL, NULL, '2021-06-02', 'bhutaness', 'sdsadsad', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `std_admissions`
--

CREATE TABLE `std_admissions` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `application_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `OrgOrganizationId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `snationality` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_code` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CidNo` char(11) COLLATE utf8_unicode_ci DEFAULT NULL,
  `first_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `middle_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `DateOfBirth` varchar(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CmnSexId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dzongkhag` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `class_id` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `stream_id` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `student_type` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `dateOfapply` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CmnCountryId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CmnGewogId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CmnChiwogId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CmnLanguageId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `village_id` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Address` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `CmnParentsMaritalStatusId` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsNewAdmission` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsTransferred` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `IsRejoined` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `PhotoPath` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `attachments` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parent_marital_status` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `primary_contact` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `std_admissions`
--

INSERT INTO `std_admissions` (`id`, `application_id`, `OrgOrganizationId`, `snationality`, `student_code`, `CidNo`, `first_name`, `middle_name`, `last_name`, `DateOfBirth`, `CmnSexId`, `dzongkhag`, `class_id`, `stream_id`, `student_type`, `dateOfapply`, `CmnCountryId`, `CmnGewogId`, `CmnChiwogId`, `CmnLanguageId`, `village_id`, `Address`, `CmnParentsMaritalStatusId`, `IsNewAdmission`, `IsTransferred`, `IsRejoined`, `PhotoPath`, `attachments`, `Status`, `parent_marital_status`, `primary_contact`, `updated_by`, `created_at`, `updated_at`) VALUES
('00b3acd7-8837-43bb-9be2-bf251bacb6df', NULL, '0e663891-85f2-4a71-b11e-a74f6705b8f4', 'Bhutanese Under Process', NULL, '10905003999', 'Phuntsho', 'null', 'Ugyel', 'NaN-NaN-Na', '42b9a6e7-2752-4f77-b3b3-83b63a4c626a', '9', NULL, NULL, 'new', NULL, NULL, '90', NULL, NULL, '2133', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL),
('922b0e13-88a5-4339-8614-2dd80716445c', NULL, '0e663891-85f2-4a71-b11e-a74f6705b8f4', 'Bhutanese Under Process', NULL, '11305004499', 'Bishnu', 'Maya', 'Rai', '1980-01-01', '353db3f5-1b97-406b-88ba-a68dbe53b2aa', '13', NULL, NULL, 'new', NULL, NULL, '141', NULL, NULL, '3279', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `std_class_scholarship_type`
--

CREATE TABLE `std_class_scholarship_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgClassId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdScholarchipTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_class_student_type`
--

CREATE TABLE `std_class_student_type` (
  `Id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgClassId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_disciplinary_action_type`
--

CREATE TABLE `std_disciplinary_action_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_disciplinary_action_type`
--

INSERT INTO `std_disciplinary_action_type` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('b1a8f0b5-b58a-4fb1-aa32-cbb5c57a8923', 'Warning', 'Warning Issued', 1, NULL, NULL, '2021-05-16 11:19:04', '2021-05-16 11:19:04'),
('df02dcd0-4a86-4caa-bd91-d9d8ab0a9108', 'Suspended', 'Suspended', 1, NULL, NULL, '2021-06-03 03:33:21', '2021-06-03 03:33:21');

-- --------------------------------------------------------

--
-- Table structure for table `std_disciplinary_offence_type`
--

CREATE TABLE `std_disciplinary_offence_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_disciplinary_offence_type`
--

INSERT INTO `std_disciplinary_offence_type` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('a074437e-5544-45b8-b087-28deaba39d33', 'Drinking', 'drinking', 1, NULL, NULL, '2021-05-16 11:07:28', '2021-05-16 11:06:51'),
('a4250364-b7e4-4123-8be2-38412b4f3aba', 'Missing Class', 'Missing Class', 1, NULL, NULL, '2021-06-03 03:32:58', '2021-06-03 03:32:58'),
('b0e05843-d701-40d7-9430-975b6d981b19', 'Smoking', 'smoking', 1, NULL, NULL, '2021-05-16 11:06:51', '2021-05-16 11:06:51');

-- --------------------------------------------------------

--
-- Table structure for table `std_disciplinary_severity`
--

CREATE TABLE `std_disciplinary_severity` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_disciplinary_severity`
--

INSERT INTO `std_disciplinary_severity` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('700a18c3-f149-4dba-9114-d35162734e1f', 'Serious', 'Serious', 1, NULL, NULL, '2021-06-03 03:33:10', '2021-06-03 03:33:10'),
('9fc322d1-6425-4d79-a202-028ec0bc701b', 'Mild', 'Mild', 1, NULL, NULL, '2021-05-16 11:17:44', '2021-05-16 11:17:44');

-- --------------------------------------------------------

--
-- Table structure for table `std_dropout_case_type`
--

CREATE TABLE `std_dropout_case_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_health_bmi`
--

CREATE TABLE `std_health_bmi` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdHealthTermId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `height` decimal(5,2) NOT NULL,
  `weight` decimal(5,2) NOT NULL,
  `bmi` decimal(5,2) NOT NULL,
  `remarks` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_health_bmi`
--

INSERT INTO `std_health_bmi` (`id`, `StdStudentId`, `StdHealthTermId`, `date`, `height`, `weight`, `bmi`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('7a1e0b94-a955-4fdb-8a8e-03e7cf2ebd70', '10', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-04-18', '1.00', '1.00', '0.00', '1', NULL, NULL, '2021-04-18 14:40:20', '2021-04-18 14:40:20'),
('89e549c4-b763-4cde-b98b-55e5e88c34cc', '101', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-04-18', '1.00', '1.00', '0.00', '1', NULL, NULL, '2021-04-18 14:40:20', '2021-04-18 14:40:20'),
('a611305f-2071-48e3-a547-a07562e3f771', '100', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-04-18', '1.00', '1.00', '0.00', '1', NULL, NULL, '2021-04-18 14:40:20', '2021-04-18 14:40:20'),
('bb2f3502-ec0a-442b-9387-1963ad02d139', '102', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-04-18', '1.00', '1.00', '0.00', '1', NULL, NULL, '2021-04-18 14:40:20', '2021-04-18 14:40:20'),
('c2602e1e-2861-4f7f-aefe-447759a86ec0', '1', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-04-18', '1.00', '1.00', '0.00', '1', NULL, NULL, '2021-04-18 14:40:20', '2021-04-18 14:40:20');

-- --------------------------------------------------------

--
-- Table structure for table `std_health_deworming`
--

CREATE TABLE `std_health_deworming` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdHealthTermId` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `StdStudentId` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_health_deworming`
--

INSERT INTO `std_health_deworming` (`id`, `StdHealthTermId`, `date`, `StdStudentId`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('075ba4e9-7c99-4031-b5a8-35301fef98fb', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('1c0dccc0-0929-4103-a438-5e7f4900ee3d', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('2307d4cf-94fe-4bed-97f8-92918365d11f', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('2a7b9312-f0e1-411b-a131-5d7805b4d83f', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('3a4fa5eb-6d55-47fb-9b78-156fea2e1115', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:12', '2021-06-03 05:45:12'),
('4463f081-8d0e-47cb-b0ae-f9a95c5c030d', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('44e4dead-901a-44ac-9cb4-1cd12cecbcd1', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:12', '2021-06-03 05:45:12'),
('4f210aba-4f2a-4b0b-8930-ef0d1c3a4a62', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:12', '2021-06-03 05:45:12'),
('57e4f75d-8645-4720-84b2-bcd393cc1726', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('66d780bf-99a5-47e1-9dec-d68569956c47', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('687031ef-afe1-4434-a169-dc4a4eb4cd7f', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:12', '2021-06-03 05:45:12'),
('7a9bf9af-7678-4072-8967-bb5443657625', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('841a0d9d-5c71-442d-96f2-720208638ba2', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('8566430a-1e76-480a-9265-7f9bc9327385', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('881dcc63-7ca7-4a27-aadb-0e1f737ddfb6', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('8f7b2e9e-85c3-4e8e-8c05-46339ccaccb4', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('a1d45751-fd37-4da3-bc39-7946ca83a894', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('b170788f-3d5e-4a1a-abd5-6f528d50d8ef', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('b3c4f65b-3fea-4ea5-b2cf-f8c923f6d980', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:12', '2021-06-03 05:45:12'),
('be1375b2-cf4e-470a-be20-297595e5e5ef', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('bf4b4d6f-b125-4121-a459-3c61c7962c17', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:12', '2021-06-03 05:45:12'),
('c253ef9f-11d4-4da8-a0f7-ee356e560a96', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13'),
('c7968819-a63f-4eb7-b479-09ab527b66a1', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-06-03', '1140', 'not given', NULL, NULL, '2021-06-03 05:45:13', '2021-06-03 05:45:13');

-- --------------------------------------------------------

--
-- Table structure for table `std_health_not_screened`
--

CREATE TABLE `std_health_not_screened` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdHealthScreeningId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_health_referred`
--

CREATE TABLE `std_health_referred` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdHealthScreeningId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_health_referred`
--

INSERT INTO `std_health_referred` (`id`, `StdHealthScreeningId`, `StdStudentId`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('3fcc2a27-0be9-4cff-adee-be6d7704f4ca', '241dfd64-49a5-4e6f-a6cb-b25f545fd47e', '1140', NULL, NULL, '2021-05-31 21:35:57', '2021-05-31 21:35:57'),
('604fa199-aeae-43d7-898f-0f623875fb4e', 'd8ecd22c-4e06-4dd3-bfb2-dcb14c5fe339', '1385', NULL, NULL, '2021-06-03 03:10:07', '2021-06-03 03:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `std_health_screening`
--

CREATE TABLE `std_health_screening` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgOrganizationId` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdHealthScreeningTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdScreeningPositionTitleId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdScreeningEndorsedById` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prepared_by` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date NOT NULL,
  `class` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `section` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stream` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_health_screening`
--

INSERT INTO `std_health_screening` (`id`, `OrgOrganizationId`, `StdHealthScreeningTypeId`, `StdScreeningPositionTitleId`, `StdScreeningEndorsedById`, `prepared_by`, `date`, `class`, `section`, `stream`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('241dfd64-49a5-4e6f-a6cb-b25f545fd47e', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '53c4c4bb-1ce3-4b17-9ebc-61107e50437f', '007a3205-a2f7-4f3c-a85a-b350f9015cbb', '19a243ae-62cd-4da8-9fe5-b3d4e5b8614d', NULL, '2021-06-01', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', NULL, NULL, NULL, '2021-05-31 21:35:57', '2021-05-31 21:35:57'),
('d8ecd22c-4e06-4dd3-bfb2-dcb14c5fe339', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '38c64df8-a5f1-45f3-8845-6c1bb9a798be', '007a3205-a2f7-4f3c-a85a-b350f9015cbb', 'b0d7cb6a-683d-4838-aa37-928f86c65cf0', NULL, '2021-06-03', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', NULL, NULL, NULL, '2021-06-03 03:10:07', '2021-06-03 03:10:07');

-- --------------------------------------------------------

--
-- Table structure for table `std_health_screening_type`
--

CREATE TABLE `std_health_screening_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_health_screening_type`
--

INSERT INTO `std_health_screening_type` (`id`, `Name`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('38c64df8-a5f1-45f3-8845-6c1bb9a798be', 'Nose', 1, NULL, NULL, '2021-04-11 05:33:48', '2021-04-11 05:33:48'),
('53c4c4bb-1ce3-4b17-9ebc-61107e50437f', 'Eyes', 1, NULL, NULL, '2021-05-16 11:30:30', '2021-05-16 11:30:30'),
('b708d303-9842-4a5d-bec6-f1d1b86fe64b', 'Lungs', 1, NULL, NULL, '2021-06-03 03:34:40', '2021-06-03 03:34:40'),
('e718ca3a-9cf2-4fee-8db2-4dfbb39bcfdd', 'Ear Screening', 1, NULL, NULL, '2021-04-11 05:23:30', '2021-04-11 05:23:30');

-- --------------------------------------------------------

--
-- Table structure for table `std_health_supplementation`
--

CREATE TABLE `std_health_supplementation` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdHealthTermId` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `StdStudentId` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_health_supplementation`
--

INSERT INTO `std_health_supplementation` (`id`, `StdHealthTermId`, `date`, `StdStudentId`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('0072d891-0c03-405d-8601-e57dd1e80009', 'c0e3b0eb-013b-4b85-a0b1-4ff49b13bea7', '2021-05-29', '1052', 'not given', NULL, NULL, '2021-05-29 14:36:15', '2021-05-29 14:36:15'),
('27b0e121-9533-46f0-89cb-4bf8eac0fc5d', 'c0e3b0eb-013b-4b85-a0b1-4ff49b13bea7', '2021-05-29', '1052', 'not given', NULL, NULL, '2021-05-29 14:36:14', '2021-05-29 14:36:14'),
('28d747f8-3087-43f7-b9a3-88704b2184cf', 'c0e3b0eb-013b-4b85-a0b1-4ff49b13bea7', '2021-05-29', '1052', 'not given', NULL, NULL, '2021-05-29 14:36:15', '2021-05-29 14:36:15'),
('3d3f1185-a19c-45ba-ae53-ed567f5e1cb3', 'c0e3b0eb-013b-4b85-a0b1-4ff49b13bea7', '2021-05-29', '1052', 'not given', NULL, NULL, '2021-05-29 14:36:15', '2021-05-29 14:36:15'),
('4faffca8-288a-4a81-9971-fdc1630a4385', 'c0e3b0eb-013b-4b85-a0b1-4ff49b13bea7', '2021-05-29', '1052', 'not given', NULL, NULL, '2021-05-29 14:36:14', '2021-05-29 14:36:14'),
('8526590e-76e6-458f-a39e-8945eeb5f75f', 'c0e3b0eb-013b-4b85-a0b1-4ff49b13bea7', '2021-05-29', '1052', 'not given', NULL, NULL, '2021-05-29 14:36:14', '2021-05-29 14:36:14'),
('8888c466-7bc6-4d54-b09d-538f507e4742', 'c0e3b0eb-013b-4b85-a0b1-4ff49b13bea7', '2021-05-29', '1052', 'not given', NULL, NULL, '2021-05-29 14:36:15', '2021-05-29 14:36:15'),
('b5ab7e86-0126-41ac-9a19-282a3be51969', '47d488c6-f4ec-42b1-835e-6008ab6ebbe4', '2021-04-18', '101', 'not given', NULL, NULL, '2021-04-18 10:31:43', '2021-04-18 10:31:43'),
('bf67c4f2-0022-4f7c-804e-b0e548137ede', 'c0e3b0eb-013b-4b85-a0b1-4ff49b13bea7', '2021-05-29', '1052', 'not given', NULL, NULL, '2021-05-29 14:36:14', '2021-05-29 14:36:14'),
('f35889e0-2bdc-4191-acd8-0126dd2320d3', 'c0e3b0eb-013b-4b85-a0b1-4ff49b13bea7', '2021-05-29', '1052', 'not given', NULL, NULL, '2021-05-29 14:36:15', '2021-05-29 14:36:15');

-- --------------------------------------------------------

--
-- Table structure for table `std_health_term`
--

CREATE TABLE `std_health_term` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_health_term`
--

INSERT INTO `std_health_term` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('47d488c6-f4ec-42b1-835e-6008ab6ebbe4', 'Second Term', NULL, 1, NULL, NULL, '2021-04-11 05:44:56', '2021-04-11 05:44:56'),
('4a1f86ec-9434-458e-aa1e-a5df8aa5e4dd', 'Third Term', NULL, 1, NULL, NULL, '2021-05-17 04:51:35', '2021-05-17 04:51:35'),
('9c641205-43f7-43fb-a114-c7c89410e42e', 'Fifth Term', NULL, 1, NULL, NULL, '2021-06-03 03:35:32', '2021-06-03 03:35:32'),
('c0e3b0eb-013b-4b85-a0b1-4ff49b13bea7', 'First Term', NULL, 1, NULL, NULL, '2021-04-11 05:35:44', '2021-04-11 05:35:44'),
('e2ce749b-590f-4c5e-9d89-495d9b32808a', 'Fourth Term', NULL, 1, NULL, NULL, '2021-05-25 09:51:07', '2021-05-25 09:51:07');

-- --------------------------------------------------------

--
-- Table structure for table `std_health_vaccination`
--

CREATE TABLE `std_health_vaccination` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdVaccineTypeId` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` date NOT NULL,
  `class` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `td_vaccine_at6_boys` tinyint(3) DEFAULT NULL,
  `td_vaccine_at6_girls` tinyint(3) DEFAULT NULL,
  `td_vaccine_at12_boys` tinyint(3) DEFAULT NULL,
  `td_vaccine_at12_girls` tinyint(3) DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_reporting`
--

CREATE TABLE `std_reporting` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgOrganizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ReportingDate` date NOT NULL,
  `Remarks` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_role`
--

CREATE TABLE `std_role` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1 COMMENT '0 - disabled',
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci COMMENT='Roles like captains are defined here';

--
-- Dumping data for table `std_role`
--

INSERT INTO `std_role` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('40f5cbb1-5781-49f0-b823-6a855cd39ff1', 'Vice Captain', 'est', 1, NULL, NULL, '2021-06-03 03:26:54', '2021-06-03 03:26:54'),
('952a3ef3-1423-4b76-b902-616fcbb9f32d', 'Captain', 'Captain', 1, NULL, NULL, '2021-05-16 11:20:51', '2021-05-16 11:20:51');

-- --------------------------------------------------------

--
-- Table structure for table `std_role_school_level`
--

CREATE TABLE `std_role_school_level` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdRoleId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgSchoolLevelId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_role_student`
--

CREATE TABLE `std_role_student` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdRoleId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Remarks` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_role_student`
--

INSERT INTO `std_role_student` (`id`, `StdStudentId`, `StdRoleId`, `Remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('3f58e21d-789b-48ec-a437-5af65e4fc41a', '1053', '952a3ef3-1423-4b76-b902-616fcbb9f32d', 'test', NULL, NULL, '2021-05-27 16:05:19', '2021-05-27 16:05:19'),
('5111d1e9-2236-41bc-91a6-8ee5a5621cbb', '1053', '952a3ef3-1423-4b76-b902-616fcbb9f32d', 'test', NULL, NULL, '2021-05-27 16:09:31', '2021-05-27 16:09:31'),
('62da8df4-750e-42c6-9d7b-f10d3cb15f87', '1', '952a3ef3-1423-4b76-b902-616fcbb9f32d', 'test', NULL, NULL, '2021-05-17 07:02:40', '2021-05-17 07:02:40'),
('706f473e-8fba-4ded-9347-762b2fc3358b', '1057', '952a3ef3-1423-4b76-b902-616fcbb9f32d', 'test', NULL, NULL, '2021-06-02 21:32:21', '2021-06-02 21:32:21');

-- --------------------------------------------------------

--
-- Table structure for table `std_scholarship`
--

CREATE TABLE `std_scholarship` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `SchoolCategory` tinyint(3) UNSIGNED NOT NULL DEFAULT 0 COMMENT '0 - Both categories; 1 - Public schools; 2 - Private schools',
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_scholarship_school_level`
--

CREATE TABLE `std_scholarship_school_level` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdScholarshipId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgSchoolLevelId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_school_leaving_reason`
--

CREATE TABLE `std_school_leaving_reason` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_screening_endorsed_by`
--

CREATE TABLE `std_screening_endorsed_by` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_screening_endorsed_by`
--

INSERT INTO `std_screening_endorsed_by` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('19a243ae-62cd-4da8-9fe5-b3d4e5b8614d', 'BHU Admin', 'Admin officer', 1, NULL, NULL, '2021-05-16 11:34:36', '2021-05-16 11:34:36'),
('b0d7cb6a-683d-4838-aa37-928f86c65cf0', 'Doctor', 'Doctor of BHU', 1, NULL, NULL, '2021-04-11 08:49:55', '2021-04-11 08:49:55'),
('d5e9b922-a0ad-45dd-b7ec-5ac7a54db750', 'Health Assitant', 'HA of BHU', 1, NULL, NULL, '2021-04-11 08:49:46', '2021-04-11 08:49:46');

-- --------------------------------------------------------

--
-- Table structure for table `std_screening_position_title`
--

CREATE TABLE `std_screening_position_title` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Description` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_screening_position_title`
--

INSERT INTO `std_screening_position_title` (`id`, `Name`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('007a3205-a2f7-4f3c-a85a-b350f9015cbb', 'Principal', 'Principal of the school', 1, NULL, NULL, '2021-04-11 08:54:28', '2021-04-11 08:54:28'),
('468707bd-61d8-426b-b903-dacd845e427d', 'Vice Principal', 'Vice Principal', 1, NULL, NULL, '2021-04-11 08:55:49', '2021-04-11 08:55:49'),
('cfc30ae6-afa8-4f17-8742-90cd3f5094c7', 'Nurse', 'BHU Nurse', 1, NULL, NULL, '2021-06-03 03:34:54', '2021-06-03 03:34:54'),
('d150a85c-ea75-41e0-8b95-97abec9590c0', 'School Nurse', 'school nurse', 1, NULL, NULL, '2021-05-16 11:34:19', '2021-05-16 11:34:19'),
('fe11f726-c4a2-477f-aaa6-48113fdc4368', 'School HA', 'School Ha', 1, NULL, NULL, '2021-04-11 08:55:24', '2021-04-11 08:55:24');

-- --------------------------------------------------------

--
-- Table structure for table `std_special_benefit`
--

CREATE TABLE `std_special_benefit` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_special_benefit_school_level`
--

CREATE TABLE `std_special_benefit_school_level` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdSpecialBenefitId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgSchoolLevelId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_student`
--

CREATE TABLE `std_student` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgOrganizationId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CidNo` char(50) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_code` varchar(99) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnSexId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `DateOfBirth` date NOT NULL,
  `CmnCountryId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnGewogId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnChiwogId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CmnLanguageId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL COMMENT 'Mother tongue',
  `Remarks` varchar(200) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `IsNewAdmission` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `IsTransferred` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `IsRejoined` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `PhotoPath` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `PrimaryContact` tinyint(3) UNSIGNED DEFAULT NULL,
  `CmnParentsMaritalStatusId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Address` varchar(250) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `std_student`
--

INSERT INTO `std_student` (`id`, `OrgOrganizationId`, `CidNo`, `student_code`, `Name`, `CmnSexId`, `DateOfBirth`, `CmnCountryId`, `CmnGewogId`, `CmnChiwogId`, `CmnLanguageId`, `Remarks`, `IsNewAdmission`, `IsTransferred`, `IsRejoined`, `PhotoPath`, `PrimaryContact`, `CmnParentsMaritalStatusId`, `Address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312311', '12312312311', 'Tashi Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:23', '0000-00-00 00:00:00'),
('10', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312320', '12312312320', 'Tshewang Namdrul', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('100', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312410', '12312312410', 'Tsering Chophel', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-08-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('101', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312411', '12312312411', 'Sumdrup Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-24', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('102', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312412', '12312312412', 'Ugyen Namdrul', '4312b734-211d-4e33-9c4a-92fc89641144', '2013-05-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('103', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312413', '12312312413', 'Kinzang Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-12-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('104', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312414', '12312312414', 'Jamyang Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-29', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('105', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312415', '12312312415', 'Tshering Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1052', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10702002745', '10702002745', 'Sonam Deki Wangmo', 'Female', '2014-07-29', '20', '74', '', '20', '851500', 0, 1, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-31 22:44:30', '2021-05-31 22:44:30'),
('1053', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10702002754', '10702002754', 'Mingyur Dechen Palmo', 'Female', '2014-08-05', '20', '74', '', '20', '853540', 0, 1, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-06-01 00:29:50', '2021-06-01 00:29:50'),
('1054', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tilak Chhetri', 'Male', '2013-11-04', '20', '74', '', '20', '853567', 0, 1, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-06-01 00:26:34', '2021-06-01 00:26:34'),
('1055', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Ajay Rai', 'Male', '2014-05-21', '20', '74', '', '20', '853593', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1056', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10204003896', '10204003896', 'Tashi Tshering', 'Male', '2014-08-08', '20', '74', '', '20', '853627', 0, 1, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-30 17:15:44', '2021-05-30 17:15:44'),
('1057', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003370', '10811003370', 'Yeshey Tshogyal', 'Female', '2014-08-05', '20', '74', '', '20', '853642', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1058', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10301001622', '10301001622', 'Priya Mongar', 'Female', '2014-08-01', '20', '74', '', '20', '853660', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1059', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003386', '10811003386', 'Karma Norden', 'Female', '2014-07-30', '20', '74', '', '20', '853674', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('106', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312416', '12312312416', 'Pema Thangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2015-04-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1060', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10702002749', '10702002749', 'Pema Yeeyang Choki', 'Female', '2014-07-23', '20', '74', '', '20', '853697', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1061', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10307001312', '10307001312', 'Som Raj Gurung', 'Male', '2014-07-14', '20', '74', '', '20', '853726', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1062', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003413', '10811003413', 'Sonam Tshegyel', 'Male', '2014-07-08', '20', '74', '', '20', '853736', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1063', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11806002521', '11806002521', 'Desang Thaye Wangmo Bhandari', 'Female', '2014-07-02', '20', '74', '', '20', '853753', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1064', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502004575', '11502004575', 'Thukten Tashii Jamtsho', 'Male', '2014-07-01', '20', '74', '', '20', '853767', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1065', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10305004981', '10305004981', 'Eesel Nangsa Norbu', 'Female', '2014-06-24', '20', '74', '', '20', '853808', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1066', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10910000908', '10910000908', 'Ngawang Deki Choden', 'Female', '2014-06-16', '20', '74', '', '20', '853825', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1067', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606004347', '11606004347', 'Jamyang Chimi Selden', 'Female', '2014-05-11', '20', '74', '', '20', '853838', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1068', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11109004128', '11109004128', 'Dilip Kumar Timsina', 'Male', '2014-04-21', '20', '74', '', '20', '853844', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1069', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11503006317', '11503006317', 'TrashiRinchen', 'Male', '2014-03-19', '20', '74', '', '20', '853857', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('107', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312417', '12312312417', 'Pema Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-08', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1070', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003379', '10811003379', 'JigdrelJamtsho', 'Male', '2014-03-05', '20', '74', '', '20', '853867', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1071', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004981', '10605004981', 'Dorji Wangmo', 'Female', '2014-02-18', '20', '74', '', '20', '853880', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1072', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11107008937', '11107008937', 'Thukten Jigme Yoezer', 'Male', '2014-02-09', '20', '74', '', '20', '853899', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1073', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10309003955', '10309003955', 'Tenzin Namgyel Gurung', 'Male', '2014-02-08', '20', '74', '', '20', '853912', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1074', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11308005019', '11308005019', 'Rigyel Rabgay Tshering', 'Male', '2013-12-09', '20', '74', '', '20', '853927', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1075', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10211005411', '10211005411', 'Aruna Raini', 'Female', '2013-11-27', '20', '74', '', '20', '853939', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1076', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512006858', '11512006858', 'Sonam Pelden', 'Female', '2013-10-16', '20', '74', '', '20', '853958', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1077', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808002915', '10808002915', 'SeryangRinchen Tshoke', 'Female', '2014-03-15', '20', '74', '', '20', '854281', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1078', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003389', '10811003389', 'Jigwang Gawa', 'Male', '2014-04-04', '20', '74', '', '20', '807330', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1079', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11701004355', '11701004355', 'Rinzin Pema Selden', 'Female', '2014-12-27', '20', '74', '', '20', '823182', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('108', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312418', '12312312418', 'Chimi Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-03-10', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1080', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11515005364', '11515005364', 'Sangay Thinley Dorji', 'Male', '2014-06-14', '20', '74', '', '20', '828985', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1081', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11703004153', '11703004153', 'Jigme Tenzin', 'Male', '2012-08-12', '20', '74', '', '20', '834460', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1082', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11505006672', '11505006672', 'Ugyen Loday', 'Male', '2013-12-28', '20', '74', '', '20', '849178', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1083', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11107008977', '11107008977', 'Reegyal Pema Rabsel', 'Male', '2014-09-03', '20', '74', '', '20', '854008', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1084', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003542', '10811003542', 'ReegyalTashiLhendrup', 'Male', '2015-01-24', '20', '74', '', '20', '854017', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1085', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11501004232', '11501004232', 'Tenzin Choki', 'Female', '2014-12-31', '20', '74', '', '20', '854028', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1086', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510005871', '11510005871', 'Lhazin Kimtsho Pelmo', 'Female', '2014-10-28', '20', '74', '', '20', '854038', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1087', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11008003094', '11008003094', 'Tshering Wangyel', 'Male', '2014-08-28', '20', '74', '', '20', '854061', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1088', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502004581', '11502004581', 'Sherab Deysel Wangmo', 'Female', '2014-09-06', '20', '74', '', '20', '854095', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1089', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808002940', '10808002940', 'Lhasel Wangchuk Dema', 'Female', '2014-08-18', '20', '74', '', '20', '854102', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('109', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312419', '12312312419', 'Dechen Pelden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-10-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1090', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10503002164', '10503002164', 'Sonam Tshogyal Pema', 'Female', '2015-01-20', '20', '74', '', '20', '854115', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1091', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11513006493', '11513006493', 'Tshering Nangsel Dolma', 'Female', '2014-10-12', '20', '74', '', '20', '854123', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1092', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11504005628', '11504005628', 'Chogyel Tashi Wangyel', 'Male', '2014-09-10', '20', '74', '', '20', '854132', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1093', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805003285', '10805003285', 'Tandin Kinley Jamtsho', 'Male', '2014-10-28', '20', '74', '', '20', '854137', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1094', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003406', '10811003406', 'Jamyang Sherub Phuntsho', 'Male', '2015-01-18', '20', '74', '', '20', '854148', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1095', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003405', '10811003405', 'Gyembo Tshering', 'Male', '2015-01-27', '20', '74', '', '20', '854154', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1096', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10709006318', '10709006318', 'Yeshi Tshogyal', 'Female', '2015-02-02', '20', '74', '', '20', '854172', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1097', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11315003259', '11315003259', 'Kelden Gawa Jordhan', 'Male', '2015-02-03', '20', '74', '', '20', '854184', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1098', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11410011227', '11410011227', 'Zhensel Namdha Jigthub', 'Male', '2014-12-30', '20', '74', '', '20', '854198', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1099', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10203004138', '10203004138', 'Sonam Thinley Choden', 'Female', '2014-09-26', '20', '74', '', '20', '854208', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('11', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312321', '12312312321', 'Ugyen Ghalley', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('110', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312420', '12312312420', 'Namdren Tsheyang', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-05-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1100', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512006889', '11512006889', 'Thukten Wangyel Dorjee', 'Male', '2014-09-02', '20', '74', '', '20', '854227', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1101', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12001005575', '12001005575', 'Karma Dorji Eden', 'Female', '2014-11-03', '20', '74', '', '20', '855873', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1102', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11302004111', '11302004111', 'DhendupLhamo', 'Female', '2014-01-15', '20', '74', '', '20', '855882', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1103', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11102008371', '11102008371', 'Tshering Euden', 'Female', '2010-06-11', '20', '74', '', '20', '775600', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1104', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11102008370', '11102008370', 'Ugyen Dema', 'Female', '2010-06-11', '20', '74', '', '20', '775614', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1105', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11315003095', '11315003095', 'Thukten Kinchap Phuntsho', 'Male', '2013-04-10', '20', '74', '', '20', '781634', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1106', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003287', '10811003287', 'Dechen Pema Yangki', 'Female', '2013-08-02', '20', '74', '', '20', '796699', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1107', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003350', '10811003350', 'Lekey Selzom Dendup', 'Female', '2013-07-01', '20', '74', '', '20', '798944', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1108', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510005620', '11510005620', 'Tashi Chador Zangmo', 'Female', '2012-04-30', '20', '74', '', '20', '816902', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1109', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10211005589', '10211005589', 'sita Ghalley', 'Female', '2011-07-29', '20', '74', '', '20', '819673', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('111', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312421', '12312312421', 'Jamyang Phuntsho', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-02', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1110', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11312004218', '11312004218', 'Jamyang Nidup', 'Male', '2012-05-31', '20', '74', '', '20', '819797', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1111', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Aysha Hosen', 'Female', '2012-03-01', '20', '74', '', '20', '819806', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1112', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11308002313', '11308002313', 'Sonam Pelkee', 'Female', '2013-03-22', '20', '74', '', '20', '824568', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1113', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12004005930', '12004005930', 'Pema Thiya Wangyel', 'Male', '2013-11-15', '20', '74', '', '20', '824569', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1114', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11607001346', '11607001346', 'Tshering Yangchen Wangmo', 'Female', '2012-12-22', '20', '74', '', '20', '829353', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1115', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11607003752', '11607003752', 'SonamChoki', 'Female', '2013-10-22', '20', '74', '', '20', '831405', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1116', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10607001493', '10607001493', 'Sonam Tashi Norbu', 'Male', '2013-03-09', '20', '74', '', '20', '831406', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1117', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003227', '10811003227', 'Sonam Tsheyang Dorji', 'Female', '2012-11-14', '20', '74', '', '20', '831407', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1118', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003238', '10811003238', 'Phuntsho Choden', 'Female', '2012-10-21', '20', '74', '', '20', '831408', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1119', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10803001192', '10803001192', 'Dorji Yangchen', 'Female', '2013-05-25', '20', '74', '', '20', '831409', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('112', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312422', '12312312422', 'Ngawang Nima', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1120', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10901001971', '10901001971', 'Dorji Pema Tshogyal', 'Female', '2013-06-12', '20', '74', '', '20', '831410', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1121', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10709006180', '10709006180', 'Tenzin Uthra Lhamo', 'Female', '2013-01-22', '20', '74', '', '20', '831411', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1122', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003331', '10811003331', 'Rabsel Dawa Chophel', 'Male', '2013-03-06', '20', '74', '', '20', '831414', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1123', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003239', '10811003239', 'Sonam Gyeltshen Tenzin', 'Male', '2013-03-24', '20', '74', '', '20', '831422', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1124', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10903003853', '10903003853', 'Ugyen Namgyel Yoesel', 'Male', '2013-03-30', '20', '74', '', '20', '831424', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1125', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Jitshen Choeyang Lhazin', 'Female', '2013-06-09', '20', '74', '', '20', '831426', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1126', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Pema Seldon', 'Female', '2013-11-04', '20', '74', '', '20', '831428', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1127', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811001415', '10811001415', 'Sonam Tenzin Wangyal', 'Male', '2013-02-11', '20', '74', '', '20', '831429', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1128', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10706004060', '10706004060', 'NamgayTshering', 'Male', '2012-11-13', '20', '74', '', '20', '831430', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1129', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10907003090', '10907003090', 'Sonam Kinley Drodul', 'Male', '2012-09-17', '20', '74', '', '20', '831431', 0, 0, 1, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-06-01 00:26:15', '2021-06-01 00:26:15'),
('113', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312423', '12312312423', 'Pema Uden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1130', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003520', '10811003520', 'Ugyen Yezer', 'Male', '2013-05-24', '20', '74', '', '20', '831432', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1131', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11002002602', '11002002602', 'Ngawang Tshoki Wangmo', 'Female', '2013-04-16', '20', '74', '', '20', '831438', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1132', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Yogesh Pradhan', 'Male', '2013-05-01', '20', '74', '', '20', '831439', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1133', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003509', '10811003509', 'Jigme Dorji', 'Male', '2013-04-20', '20', '74', '', '20', '831443', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1134', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12008004028', '12008004028', 'DuechenTshomoDorji', 'Female', '2013-01-30', '20', '74', '', '20', '831444', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1135', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12008004025', '12008004025', 'Namsel Ongmo Dorji', 'Female', '2013-01-30', '20', '74', '', '20', '831446', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1136', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11904002154', '11904002154', 'Khenrab Phuntsho Norbu', 'Male', '2013-01-24', '20', '74', '', '20', '831447', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1137', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003310', '10811003310', 'Tandin Kinley Selden', 'Female', '2013-01-10', '20', '74', '', '20', '831449', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1138', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805003123', '10805003123', 'Sonam Thinley', 'Male', '2012-10-26', '20', '74', '', '20', '833018', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1139', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003357', '10811003357', 'Rinpal Choden Dorji', 'Female', '2013-12-19', '20', '74', '', '20', '835651', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('114', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312424', '12312312424', 'Yeshi Tshodon', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-19', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1140', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003371', '10811003371', 'Sherab Rigkhill Dorji', 'Male', '2014-02-18', '20', '74', '', '20', '835747', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1141', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10606003152', '10606003152', 'Tshewang Tashi Tshering', 'Male', '2013-06-19', '20', '74', '', '20', '839922', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1142', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10304003160', '10304003160', 'Sonam Jigme Yoezer', 'Male', '2013-05-08', '20', '74', '', '20', '845029', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1143', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805003241', '10805003241', 'Sonam Serchhen Penjor', 'Female', '2013-09-25', '20', '74', '', '20', '847606', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1144', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11904002211', '11904002211', 'TandinYesheyDorji', 'Male', '2013-12-30', '20', '74', '', '20', '847607', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1145', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11506008699', '11506008699', 'KinleyYangsel', 'Female', '2013-11-09', '20', '74', '', '20', '847753', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1146', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'RavikaRai', 'Female', '2014-01-04', '20', '74', '', '20', '847806', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1147', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510005225', '11510005225', 'Singye Namgyal', 'Male', '2010-04-09', '20', '74', '', '20', '774191', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1148', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11703004236', '11703004236', 'Dawa Leksel Pelmo', 'Female', '2013-03-17', '20', '74', '', '20', '782044', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1149', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003195', '10811003195', 'Gyeduen Tshephel', 'Male', '2012-07-30', '20', '74', '', '20', '784731', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('115', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312425', '12312312425', 'Jamyang Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-12-23', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1150', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002797', '10802002797', 'Sonam', 'Male', '2011-08-31', '20', '74', '', '20', '785496', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1151', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11004002403', '11004002403', 'SonamYangden ', 'Female', '2011-02-24', '20', '74', '', '20', '788774', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1152', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11810002525', '11810002525', 'Bishal Saru', 'Male', '2010-05-20', '20', '74', '', '20', '794592', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1153', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11316000002', '11316000002', 'KinleyPelden', 'Female', '2012-05-29', '20', '74', '', '20', '802903', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1154', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10707002863', '10707002863', 'Dorjee Nyima', 'Male', '2012-07-27', '20', '74', '', '20', '810379', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1155', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11806002351', '11806002351', 'Kinley Sithup Dhungyel', 'Male', '2012-08-27', '20', '74', '', '20', '810775', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1156', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10601005320', '10601005320', 'Jigme Tenzin Yoezer', 'Male', '2012-06-15', '20', '74', '', '20', '813377', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1157', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000316', '10809000316', 'Rigzin Zangpo', 'Male', '2012-08-03', '20', '74', '', '20', '815001', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1158', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10503002055', '10503002055', 'Sonam Dechog Wangmo', 'Female', '2012-09-15', '20', '74', '', '20', '815002', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1159', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10702002679', '10702002679', 'Ngawang Dhendup', 'Male', '2013-02-04', '20', '74', '', '20', '815925', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('116', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312426', '12312312426', 'Jetshen Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1160', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11805003250', '11805003250', 'Jambay Selden Samdrup', 'Female', '2012-11-21', '20', '74', '', '20', '816215', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1161', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10305001340', '10305001340', 'KinleyDrakpa Wangyel', 'Male', '2012-05-10', '20', '74', '', '20', '816612', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1162', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10713003619', '10713003619', 'Choney Wangmo', 'Female', '2012-07-18', '20', '74', '', '20', '819585', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1163', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Adash Pradhan', 'Male', '2012-03-31', '20', '74', '', '20', '819598', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1164', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tshering Wangmo', 'Female', '2012-02-20', '20', '74', '', '20', '819613', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1165', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11801001926', '11801001926', 'Yagen Neopaney', 'Male', '2011-09-06', '20', '74', '', '20', '819649', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1166', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Karma Dema', 'Female', '2011-09-03', '20', '74', '', '20', '819702', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1167', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11314000400', '11314000400', 'Ugyen Tenzin', 'Male', '2012-01-11', '20', '74', '', '20', '819757', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1168', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11511002914', '11511002914', 'Kezang Jigme Choden', 'Female', '2012-08-02', '20', '74', '', '20', '819777', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1169', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11701004104', '11701004104', 'JigselYoegi Namsey', 'Male', '2012-01-14', '20', '74', '', '20', '825180', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('117', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312427', '12312312427', 'Karma Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1170', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004410', '10605004410', 'TashiYangzom', 'Female', '2011-12-20', '20', '74', '', '20', '825544', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1171', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11005004142', '11005004142', 'Karma Dechen Gyelmo', 'Female', '2012-11-15', '20', '74', '', '20', '782061', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1172', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003499', '10811003499', 'Kelzang Phuntsho', 'Male', '2012-04-08', '20', '74', '', '20', '782096', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1173', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805003206', '10805003206', 'Kinley Phuntsho', 'Male', '2012-07-31', '20', '74', '', '20', '788049', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1174', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003116', '10811003116', 'Sonam Lhamo', 'Female', '2010-11-26', '20', '74', '', '20', '796490', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1175', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10807003112', '10807003112', 'Jampa Choki', 'Female', '2012-10-26', '20', '74', '', '20', '799227', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1176', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003271', '10811003271', 'Tshering Wangmo Khandu', 'Female', '2012-08-11', '20', '74', '', '20', '799661', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1177', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11312004282', '11312004282', 'Kinley Y Ongmo', 'Female', '2012-07-19', '20', '74', '', '20', '808043', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1178', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11513006082', '11513006082', 'Karma Jatsho Wosel', 'Male', '2012-06-25', '20', '74', '', '20', '810351', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1179', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11112000405', '11112000405', 'Yoezer Tobgay', 'Male', '2012-02-27', '20', '74', '', '20', '816374', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('118', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312428', '12312312428', 'Phuntsho Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1180', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10903003788', '10903003788', 'Pema Thukten', 'Male', '2012-07-18', '20', '74', '', '20', '816465', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1181', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11604002734', '11604002734', 'Ngawang Kinley Yangchen', 'Female', '2012-05-09', '20', '74', '', '20', '816629', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1182', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11513006322', '11513006322', 'Jamyang Tshering Dorji', 'Male', '2012-03-21', '20', '74', '', '20', '816745', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1183', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11602003188', '11602003188', 'Jamyang Phuntsho Wangdi', 'Male', '2012-10-07', '20', '74', '', '20', '817719', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1184', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Priteeka Sunwar', 'Female', '2012-11-03', '20', '74', '', '20', '819630', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1185', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11801002076', '11801002076', 'Sangay Tshoyang Zam', 'Female', '2012-08-31', '20', '74', '', '20', '819647', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1186', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510005618', '11510005618', 'Yoezer Pelden', 'Female', '2011-08-16', '20', '74', '', '20', '819689', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1187', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11807003254', '11807003254', 'AnishSanyasi', 'Male', '2011-12-03', '20', '74', '', '20', '819728', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1188', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003311', '10811003311', 'ChimmiKinley Selden', 'Female', '2012-01-13', '20', '74', '', '20', '819763', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1189', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11910003093', '11910003093', 'Jigme Sherub Yangzom', 'Female', '2013-02-19', '20', '74', '', '20', '819782', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('119', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312429', '12312312429', 'Thinley Zam', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1190', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11805003209', '11805003209', 'Jigme Kinga Gyeltshen', 'Male', '2012-02-21', '20', '74', '', '20', '819783', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1191', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002535', '10802002535', 'Pema Choden', 'Female', '2012-03-13', '20', '74', '', '20', '819785', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1192', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10910000685', '10910000685', 'Dechen Pem', 'Female', '2012-06-25', '20', '74', '', '20', '819799', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1193', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11206006955', '11206006955', 'Kishwor Adhikari', 'Male', '2011-11-23', '20', '74', '', '20', '819802', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1194', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Sashil Limboo', 'Male', '2011-12-02', '20', '74', '', '20', '820015', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1195', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001197', '10804001197', 'Jigme Namgyel', 'Male', '2012-04-12', '20', '74', '', '20', '821813', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1196', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Pema P Selrick', 'Female', '2011-02-28', '20', '74', '', '20', '773540', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1197', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11904002082', '11904002082', 'Tandin Jampal Wangmo', 'Female', '2011-12-09', '20', '74', '', '20', '782082', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1198', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11214002464', '11214002464', 'Binita Rai', 'Female', '2011-05-31', '20', '74', '', '20', '782103', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1199', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004398', '10605004398', 'Karma Damcho Wangchuk', 'Male', '2011-02-14', '20', '74', '', '20', '782179', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('12', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312322', '12312312322', 'Sangay Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('120', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312430', '12312312430', 'Leesha Uroan', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1200', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510005295', '11510005295', 'Rigden Singye', 'Male', '2011-03-19', '20', '74', '', '20', '791549', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1201', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003175', '10811003175', 'Chhime Tenzin Dema', 'Female', '2011-11-01', '20', '74', '', '20', '792659', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00');
INSERT INTO `std_student` (`id`, `OrgOrganizationId`, `CidNo`, `student_code`, `Name`, `CmnSexId`, `DateOfBirth`, `CmnCountryId`, `CmnGewogId`, `CmnChiwogId`, `CmnLanguageId`, `Remarks`, `IsNewAdmission`, `IsTransferred`, `IsRejoined`, `PhotoPath`, `PrimaryContact`, `CmnParentsMaritalStatusId`, `Address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1202', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10909000758', '10909000758', 'JigmeChoeying', 'Male', '2012-04-17', '20', '74', '', '20', '792818', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1203', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Saynam Choying Tshomo', 'Female', '2011-05-03', '20', '74', '', '20', '793881', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1204', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11410010385', '11410010385', 'YutshogYangden Tshering', 'Female', '2011-10-11', '20', '74', '', '20', '795171', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1205', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10910000507', '10910000507', 'Jigme Yeshey Lhawang', 'Male', '2010-12-20', '20', '74', '', '20', '795841', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1206', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11114000026', '11114000026', 'Namgay Wangchuk', 'Male', '2011-01-25', '20', '74', '', '20', '795855', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1207', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11104005172', '11104005172', 'Sonam Gyeltshen Namgyal', 'Male', '2012-01-25', '20', '74', '', '20', '795923', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1208', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10712003293', '10712003293', 'Sonam Tshering Wangchuk', 'Male', '2011-02-28', '20', '74', '', '20', '795930', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1209', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003517', '10811003517', 'Tshering Wangyel', 'Male', '2011-02-16', '20', '74', '', '20', '795949', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('121', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312431', '12312312431', 'Sahil Uroan', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1210', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11104005141', '11104005141', 'Chimmi Tshokey Lhamo', 'Female', '2011-01-07', '20', '74', '', '20', '795962', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1211', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Drodhule Nimatsho', 'Female', '2012-02-01', '20', '74', '', '20', '796259', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1212', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606004143', '11606004143', 'Tenzin Yewong', 'Female', '2011-05-21', '20', '74', '', '20', '796512', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1213', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11511002949', '11511002949', 'Dorji Tshomo', 'Female', '2010-11-30', '20', '74', '', '20', '796945', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1214', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12003003097', '12003003097', 'Yeezhin Norbu', 'Male', '2011-07-29', '20', '74', '', '20', '797235', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1215', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11313001019', '11313001019', 'SabichaRai', 'Female', '2012-03-12', '20', '74', '', '20', '799071', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1216', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002396', '10806002396', 'Jigme Rigsel Yangden', 'Female', '2012-06-30', '20', '74', '', '20', '800420', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1217', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Leki Choden', 'Female', '2012-09-06', '20', '74', '', '20', '800501', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1218', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11705002674', '11705002674', 'Pema Wangmo', 'Female', '2012-04-01', '20', '74', '', '20', '800717', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1219', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11002002113', '11002002113', 'Namgay Letho', 'Male', '2011-07-20', '20', '74', '', '20', '805170', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('122', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312432', '12312312432', 'Zomkee Lepcha', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1220', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10212000017', '10212000017', 'Dechen Lhatsho', 'Female', '2011-08-05', '20', '74', '', '20', '782083', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1221', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10810003222', '10810003222', 'Chencho Yeega Selden', 'Female', '2012-01-15', '20', '74', '', '20', '782105', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1222', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002337', '10806002337', 'Sonam Rakey Tshomo', 'Female', '2011-08-25', '20', '74', '', '20', '782113', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1223', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11505006214', '11505006214', 'Kuenchap Dorji', 'Male', '2011-03-09', '20', '74', '', '20', '782128', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1224', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805003149', '10805003149', 'Jigme T Namgyal', 'Male', '2011-02-07', '20', '74', '', '20', '789011', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1225', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11505006107', '11505006107', 'Ugyen Pema Tsheyang', 'Female', '2010-12-05', '20', '74', '', '20', '789151', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1226', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11803003134', '11803003134', 'Yumma Shongbhan Rai', 'Female', '2011-02-22', '20', '74', '', '20', '791288', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1227', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tenzin Drukdra Tshering', 'Male', '2011-02-14', '20', '74', '', '20', '791689', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1228', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10101006450', '10101006450', 'Rigdhen jangchuk', 'Male', '2011-12-27', '20', '74', '', '20', '792599', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1229', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11112000411', '11112000411', 'Karma Lakden', 'Female', '2011-02-03', '20', '74', '', '20', '792813', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('123', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312433', '12312312433', 'Thinley Yenten', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1230', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10705005939', '10705005939', 'Tshering Rigsel Deki', 'Female', '2011-12-16', '20', '74', '', '20', '793234', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1231', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11308005255', '11308005255', 'Rabsel Rabgay Tshering', 'Male', '2010-10-10', '20', '74', '', '20', '795193', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1232', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002510', '10802002510', 'Karma Rigzang Tenzin', 'Male', '2011-05-08', '20', '74', '', '20', '795848', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1233', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808002700', '10808002700', 'Pema Shayoen', 'Male', '2011-06-22', '20', '74', '', '20', '795897', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1234', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003160', '10811003160', 'Chimi Wangmo', 'Female', '2010-12-19', '20', '74', '', '20', '795966', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1235', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502004247', '11502004247', 'DEki Yangsel', 'Male', '2011-01-26', '20', '74', '', '20', '795972', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1236', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003199', '10811003199', 'Jigtshen Yangki Lhamo', 'Female', '2011-05-14', '20', '74', '', '20', '796384', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1237', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11509006095', '11509006095', 'Sonam Yuden', 'Female', '2010-09-14', '20', '74', '', '20', '796500', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1238', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10314000106', '10314000106', 'Lekself Soenam Lhaong Gurung', 'Female', '2011-01-21', '20', '74', '', '20', '798018', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1239', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12006002463', '12006002463', 'KelzangChoden Dorjee', 'Female', '2011-05-15', '20', '74', '', '20', '798984', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('124', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312434', '12312312434', 'Lhawang Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1240', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502004476', '11502004476', 'TashiChoden', 'Female', '2011-11-09', '20', '74', '', '20', '803795', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1241', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11213003744', '11213003744', 'Bishnu Maya Ghalley', 'Female', '2003-02-15', '20', '74', '', '20', '491887', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1242', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10506007920', '10506007920', 'Kinley Buddha', 'Female', '2005-08-07', '20', '74', '', '20', '491895', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1243', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11504002819', '11504002819', 'Sangay Thinley', 'Male', '2004-03-16', '20', '74', '', '20', '491909', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1244', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001100', '10804001100', 'Dechen Yangzom', 'Female', '2002-09-12', '20', '74', '', '20', '491925', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1245', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10714002222', '10714002222', 'Phuntsho Wangdi', 'Male', '2004-09-22', '20', '74', '', '20', '506719', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1246', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002566', '10806002566', 'Zimba Wangchuk', 'Male', '2006-01-26', '20', '74', '', '20', '507756', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1247', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002965', '10811002965', 'KINLEY GYELTSHEN', 'Male', '2007-02-25', '20', '74', '', '20', '517484', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1248', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11208002805', '11208002805', 'Tsheten Dorji', 'Male', '2005-03-21', '20', '74', '', '20', '578010', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1249', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tshering Lham', 'Female', '2005-05-07', '20', '74', '', '20', '591117', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('125', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312435', '12312312435', 'Sherub Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1250', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Ganga Maya Sharma', 'Female', '2003-10-18', '20', '74', '', '20', '600898', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1251', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11005000722', '11005000722', 'Karma Gyeltshen', 'Male', '2002-09-07', '20', '74', '', '20', '601113', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1252', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10207002134', '10207002134', 'Tandin Dorji', 'Male', '2004-10-09', '20', '74', '', '20', '601339', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1253', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606000498', '11606000498', 'Ugyen Phuntsho', 'Male', '2004-06-23', '20', '74', '', '20', '601342', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1254', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806001504', '10806001504', 'Kinley Denker', 'Female', '2005-01-30', '20', '74', '', '20', '601348', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1255', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002753', '10811002753', 'Thinley Kuenchap', 'Male', '2005-06-13', '20', '74', '', '20', '601369', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1256', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12008001648', '12008001648', 'Tashi Yangchen', 'Female', '2006-09-23', '20', '74', '', '20', '656734', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1257', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11509005165', '11509005165', 'Sangay Tshering', 'Male', '2005-08-02', '20', '74', '', '20', '660877', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1258', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Anil Subba', 'Male', '2004-07-21', '20', '74', '', '20', '662048', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1259', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11107008778', '11107008778', 'Sonam Yangki', 'Female', '2006-01-13', '20', '74', '', '20', '662057', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('126', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312436', '12312312436', 'Disha Uroan', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1260', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10311002653', '10311002653', 'Nima Dema', 'Female', '2006-07-31', '20', '74', '', '20', '662218', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1261', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11210002290', '11210002290', 'Devika Limbu', 'Female', '2005-11-15', '20', '74', '', '20', '662219', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1262', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11514005268', '11514005268', 'Sangay Finso Yangden', 'Female', '2006-04-19', '20', '74', '', '20', '662227', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1263', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10204003201', '10204003201', 'Ngawang Palden Jamtsho', 'Female', '2006-10-18', '20', '74', '', '20', '662229', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1264', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11204003833', '11204003833', 'Asan Chhetri', 'Female', '2006-10-07', '20', '74', '', '20', '663045', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1265', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Bishaka Biswa', 'Female', '2006-04-05', '20', '74', '', '20', '663524', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1266', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10711003428', '10711003428', 'JAMYANG PHUNTSHO DORJI', 'Male', '2006-10-22', '20', '74', '', '20', '666617', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1267', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12003002837', '12003002837', 'Sangay Yangdon', 'Female', '2007-04-30', '20', '74', '', '20', '676221', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1268', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003491', '10811003491', 'Riggsel Rigden Norbu', 'Male', '2007-01-26', '20', '74', '', '20', '682095', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1269', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10905006191', '10905006191', 'Kinphel Hingdup Dorji', 'Male', '2006-11-24', '20', '74', '', '20', '684066', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('127', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312437', '12312312437', 'Ugyen Chophel', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-05-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1270', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10607002644', '10607002644', 'Sonam Yangchen', 'Female', '2007-06-27', '20', '74', '', '20', '684082', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1271', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002390', '10802002390', 'Tenzin Deychong Dolkar', 'Female', '2007-08-26', '20', '74', '', '20', '684083', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1272', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003490', '10811003490', 'Namcha Yoezer Tobgay', 'Male', '2006-10-28', '20', '74', '', '20', '684093', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1273', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11202003493', '11202003493', 'Pelden Ghalley', 'Female', '2006-09-21', '20', '74', '', '20', '684106', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1274', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811000604', '10811000604', 'Pema Yuden Dorji', 'Female', '2007-05-19', '20', '74', '', '20', '684108', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1275', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11909001242', '11909001242', 'Sonam Chokied Wangchuk', 'Female', '2007-12-22', '20', '74', '', '20', '691342', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1276', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11002002021', '11002002021', 'Pema Yoezer', 'Male', '2005-11-24', '20', '74', '', '20', '395097', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1277', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10602001912', '10602001912', 'Dechen Cheki', 'Female', '2005-08-22', '20', '74', '', '20', '424326', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1278', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10503000048', '10503000048', 'Sangay Dorji', 'Male', '2004-11-09', '20', '74', '', '20', '491943', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1279', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003031', '10811003031', 'Kinley Namgay Wangchuk', 'Male', '2006-10-28', '20', '74', '', '20', '492492', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('128', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312438', '12312312438', 'Dendup Rangdol', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-31', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1280', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11102001963', '11102001963', 'Ugyen Nenda', 'Male', '2005-09-29', '20', '74', '', '20', '492520', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1281', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10902000218', '10902000218', 'Thinley Zangmo', 'Female', '2003-02-07', '20', '74', '', '20', '493485', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1282', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11107001347', '11107001347', 'KARMA CHODEN', 'Female', '2003-06-13', '20', '74', '', '20', '495653', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1283', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11505005719', '11505005719', 'Tshering Deki', 'Female', '2005-11-22', '20', '74', '', '20', '498974', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1284', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11104004754', '11104004754', 'Kinga Choden Lekdhen', 'Female', '2005-12-08', '20', '74', '', '20', '500910', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1285', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000278', '10809000278', 'Dawa Zangmo', 'Female', '2005-09-03', '20', '74', '', '20', '507306', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1286', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606003782', '11606003782', 'Phuntsho Norbu', 'Male', '2006-03-28', '20', '74', '', '20', '507768', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1287', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10810002516', '10810002516', 'Nidup Dorjee Wangchuk', 'Male', '2005-06-05', '20', '74', '', '20', '508821', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1288', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11608000970', '11608000970', 'Ugyen Dorji', 'Male', '2005-08-01', '20', '74', '', '20', '528548', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1289', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Sonam Choden', 'Female', '2007-09-28', '20', '74', '', '20', '535094', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('129', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312439', '12312312439', 'Jigme Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-24', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1290', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Sunil Darjee', 'Male', '2002-06-30', '20', '74', '', '20', '560371', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1291', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10608003821', '10608003821', 'Tshering Choden', 'Female', '2006-04-03', '20', '74', '', '20', '578021', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1292', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tshokey Wangmo', 'Female', '2004-08-21', '20', '74', '', '20', '582562', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:35', '0000-00-00 00:00:00'),
('1293', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502003650', '11502003650', 'Pema Lethro', 'Male', '2004-07-15', '20', '74', '', '20', '601331', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1294', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805002833', '10805002833', 'Sangay Lhendup', 'Male', '2006-01-12', '20', '74', '', '20', '662152', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1295', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11812002860', '11812002860', 'Pooja Maidali', 'Female', '2006-01-28', '20', '74', '', '20', '662258', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1296', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606003739', '11606003739', 'Pema Deki Choden', 'Female', '2006-02-21', '20', '74', '', '20', '662259', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1297', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003034', '10811003034', 'Karma Dechen', 'Female', '2006-07-24', '20', '74', '', '20', '662261', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1298', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11802001311', '11802001311', 'Sameer Hosen', 'Male', '2007-03-06', '20', '74', '', '20', '663520', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1299', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10211005605', '10211005605', 'Tika Ghallay', 'Female', '2006-02-12', '20', '74', '', '20', '663521', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('13', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312323', '12312312323', 'Sonam Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('130', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312440', '12312312440', 'Pema Dechen', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-05-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1300', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10501002189', '10501002189', 'Sonam Tshering Zam', 'Female', '2006-08-25', '20', '74', '', '20', '666607', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1301', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606003725', '11606003725', 'Karma Tshogyal', 'Female', '2006-11-26', '20', '74', '', '20', '669788', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1302', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10709005538', '10709005538', 'Karma Tobdhen', 'Male', '2006-06-13', '20', '74', '', '20', '684068', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1303', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11503005060', '11503005060', 'Deki Lhazom', 'Female', '2004-08-15', '20', '74', '', '20', '684076', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1304', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001138', '10804001138', 'Kuenlay Sonam', 'Male', '2007-03-13', '20', '74', '', '20', '684092', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1305', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11312003855', '11312003855', 'Namgay D Wangchuk', 'Male', '2007-03-19', '20', '74', '', '20', '684094', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1306', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11009002016', '11009002016', 'Tenzin Yangden Dorji', 'Female', '2007-04-17', '20', '74', '', '20', '684111', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1307', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11314000330', '11314000330', 'Tshewang Pelmo', 'Female', '2007-06-07', '20', '74', '', '20', '698322', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1308', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11604002416', '11604002416', 'PEMA CHOGYEL', 'Male', '2005-08-26', '20', '74', '', '20', '706827', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1309', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10707002597', '10707002597', 'sonam tshogyal', 'Female', '2006-09-14', '20', '74', '', '20', '761542', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('131', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312441', '12312312441', 'Yeshi Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-16', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1310', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Nisha Subba', 'Female', '2005-02-19', '20', '74', '', '20', '426500', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1311', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Sonam Choden', 'Female', '2005-03-30', '20', '74', '', '20', '469496', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1312', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11204005569', '11204005569', 'David Ghalley', 'Male', '2002-11-16', '20', '74', '', '20', '491889', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1313', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004064', '10605004064', 'Sonam Tashi', 'Male', '2005-09-20', '20', '74', '', '20', '492510', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1314', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Budha Raj Pradhan', 'Male', '2005-09-21', '20', '74', '', '20', '507745', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1315', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11214003578', '11214003578', 'Biswas Chhetri', 'Male', '2006-08-15', '20', '74', '', '20', '560353', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1316', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10705004950', '10705004950', 'Pema Yangzom', 'Female', '2006-12-23', '20', '74', '', '20', '569288', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1317', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002780', '10811002780', 'Chencho Dorji', 'Male', '2004-04-16', '20', '74', '', '20', '600926', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1318', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002803', '10811002803', 'Jigme Choda', 'Male', '2003-05-25', '20', '74', '', '20', '600980', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1319', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502004425', '11502004425', 'Tshering Dhendup', 'Male', '2005-08-06', '20', '74', '', '20', '601340', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('132', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312442', '12312312442', 'Yeshi Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-12-29', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1320', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10101005711', '10101005711', 'Ugyen Tshogey', 'Male', '2005-12-13', '20', '74', '', '20', '601370', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1321', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10702002369', '10702002369', 'Chencho Wangmo', 'Female', '2006-02-14', '20', '74', '', '20', '601371', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1322', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Rahul Rai', 'Male', '2002-03-20', '20', '74', '', '20', '637665', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1323', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10203005611', '10203005611', 'DEKI CHODEN', 'Female', '2006-10-04', '20', '74', '', '20', '655979', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1324', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11503005253', '11503005253', 'Jamyang Yoesel Tshering', 'Male', '2006-05-30', '20', '74', '', '20', '660875', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1325', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Sunil Subba', 'Male', '2005-11-20', '20', '74', '', '20', '662050', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1326', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11601003528', '11601003528', 'Karma Dorji', 'Male', '2005-07-10', '20', '74', '', '20', '662214', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1327', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11601003543', '11601003543', 'Karma Tenzin', 'Male', '2005-07-10', '20', '74', '', '20', '662215', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1328', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002935', '10811002935', 'Yangchen Lhamo', 'Female', '2006-05-02', '20', '74', '', '20', '662233', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1329', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003475', '10811003475', 'Norbu Tshering', 'Male', '2006-02-21', '20', '74', '', '20', '662241', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('133', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312443', '12312312443', 'Jharna Sharma', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1330', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002968', '10811002968', 'Sonam Dema Tobden', 'Female', '2007-10-02', '20', '74', '', '20', '662265', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1331', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11602001180', '11602001180', 'Pelden Dorji', 'Male', '2006-10-01', '20', '74', '', '20', '663557', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1332', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606003822', '11606003822', 'Yeshey Tshogyel Choden', 'Female', '2007-07-01', '20', '74', '', '20', '663574', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1333', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10910000331', '10910000331', 'Yiyang Lhasel Wangmo', 'Female', '2006-11-25', '20', '74', '', '20', '663598', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1334', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808002676', '10808002676', 'Tenzin Jigdrel Rigden Tshering', 'Male', '2006-12-24', '20', '74', '', '20', '676126', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1335', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512007436', '11512007436', 'YOESEL WANGCHUK', 'Male', '2006-03-22', '20', '74', '', '20', '681600', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1336', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000288', '10809000288', 'Jigme Yeshey Namgyel', 'Male', '2006-10-24', '20', '74', '', '20', '684061', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1337', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004089', '10605004089', 'Tshering Dorji', 'Male', '2007-02-09', '20', '74', '', '20', '684071', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1338', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002924', '10811002924', 'Kinley Pelden', 'Female', '2007-04-11', '20', '74', '', '20', '684078', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1339', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10203005773', '10203005773', 'Chhimi Seldon', 'Female', '2005-11-09', '20', '74', '', '20', '686067', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('134', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312444', '12312312444', 'Aditaya Thakur', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-31', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1340', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10202001785', '10202001785', 'Tenzin Dorji Sherpa', 'Male', '2006-11-07', '20', '74', '', '20', '735721', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1341', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10503001503', '10503001503', 'Pema Lhendup Dorji', 'Male', '2003-12-06', '20', '74', '', '20', '406252', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1342', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10807002638', '10807002638', 'Jigme Lhendup', 'Male', '2005-05-11', '20', '74', '', '20', '417096', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1343', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002704', '10811002704', 'Sangay Dorji', 'Male', '2004-07-08', '20', '74', '', '20', '469532', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1344', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002969', '10811002969', 'Pema Wangchen', 'Male', '2007-01-24', '20', '74', '', '20', '478703', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1345', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10205008119', '10205008119', 'Uttam Monger', 'Male', '2004-05-06', '20', '74', '', '20', '492502', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1346', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510004788', '11510004788', 'Jigme Gyelpo', 'Male', '2007-02-08', '20', '74', '', '20', '498937', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1347', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808002453', '10808002453', 'Yeshey Ngedup', 'Male', '2006-08-12', '20', '74', '', '20', '498993', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1348', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11705002285', '11705002285', 'Choying Palmo', 'Female', '2005-04-05', '20', '74', '', '20', '560422', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1349', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000322', '10809000322', 'Sonam Wangchuk', 'Male', '2003-08-15', '20', '74', '', '20', '600913', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('135', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312445', '12312312445', 'Tenzin Woedsel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-10', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1350', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002783', '10811002783', 'Nidup Tshering', 'Male', '2004-11-19', '20', '74', '', '20', '601363', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1351', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811000812', '10811000812', 'Jigme Namgyal', 'Male', '2005-11-15', '20', '74', '', '20', '662238', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1352', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10101005902', '10101005902', 'Sangay Lhamo', 'Female', '2007-04-13', '20', '74', '', '20', '662267', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1353', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510004668', '11510004668', 'Pema Chokey', 'Female', '2006-12-11', '20', '74', '', '20', '663509', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1354', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10701001926', '10701001926', 'Kinley Phuntsho', 'Male', '2007-04-26', '20', '74', '', '20', '663512', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1355', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10717000321', '10717000321', 'Jigme Wangchuk', 'Male', '2005-10-21', '20', '74', '', '20', '663516', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1356', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003545', '10811003545', 'Tandin Tshering', 'Male', '2006-02-06', '20', '74', '', '20', '663522', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1357', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510004696', '11510004696', 'Pema Norbu', 'Male', '2006-06-02', '20', '74', '', '20', '663525', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1358', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004080', '10605004080', 'Choki Dema Wangmo', 'Female', '2007-02-16', '20', '74', '', '20', '663527', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1359', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11811002595', '11811002595', 'Sangay Wangmo', 'Female', '2006-02-22', '20', '74', '', '20', '664881', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('136', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312446', '12312312446', 'Jamphel Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-16', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1360', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10711003439', '10711003439', 'TASHI GHAKHIL DORJI', 'Male', '2005-02-10', '20', '74', '', '20', '666544', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1361', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10101005964', '10101005964', 'Kelzang Youden', 'Female', '2007-07-16', '20', '74', '', '20', '673065', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1362', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510005445', '11510005445', 'Karma Lekden', 'Male', '2006-06-06', '20', '74', '', '20', '673499', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00');
INSERT INTO `std_student` (`id`, `OrgOrganizationId`, `CidNo`, `student_code`, `Name`, `CmnSexId`, `DateOfBirth`, `CmnCountryId`, `CmnGewogId`, `CmnChiwogId`, `CmnLanguageId`, `Remarks`, `IsNewAdmission`, `IsTransferred`, `IsRejoined`, `PhotoPath`, `PrimaryContact`, `CmnParentsMaritalStatusId`, `Address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1363', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11410009350', '11410009350', 'Pema Yangchen', 'Female', '2007-03-02', '20', '74', '', '20', '675838', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1364', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10807002689', '10807002689', 'Sonam Choki', 'Female', '2006-01-14', '20', '74', '', '20', '675839', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1365', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11505095530', '11505095530', 'Dorji Wangmo', 'Female', '2007-04-07', '20', '74', '', '20', '675911', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1366', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11211001439', '11211001439', 'Roshni Sharma', 'Female', '2006-04-24', '20', '74', '', '20', '681093', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1367', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11701003754', '11701003754', 'Wangyel Pema Jungney', 'Male', '2007-05-09', '20', '74', '', '20', '684072', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1368', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002930', '10811002930', 'Yeshey Choden', 'Female', '2007-05-31', '20', '74', '', '20', '684084', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1369', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Kinga Tobden', 'Male', '2007-05-02', '20', '74', '', '20', '698321', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('137', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312447', '12312312447', 'Dechen Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1370', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11705002268', '11705002268', 'JIGME DORJI', 'Male', '2004-10-30', '20', '74', '', '20', '762669', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1371', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10205006921', '10205006921', 'Yeewong Yetsho Gurung', 'Female', '2015-04-22', '20', '74', '', '20', '820155', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1372', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Snigdha Basu', 'Female', '2016-01-16', '20', '74', '', '20', '828986', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1373', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510005918', '11510005918', 'Karma Ngawang Kuenkhen', 'Male', '2015-12-01', '20', '74', '', '20', '848386', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1374', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002484', '10806002484', 'Yetsho Lhamo Drukdra', 'Female', '2015-09-17', '20', '74', '', '20', '874134', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1375', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11809002585', '11809002585', 'ChenchoDema Drukpa', 'Female', '2014-09-29', '20', '74', '', '20', '874336', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1376', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11002002744', '11002002744', 'TandinWangmo', 'Female', '2015-03-24', '20', '74', '', '20', '874412', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1377', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10907003315', '10907003315', 'Pema Kuenzang Dechen', 'Female', '2015-04-14', '20', '74', '', '20', '874413', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1378', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003415', '10811003415', 'Tenzin Zhuthrel Wangmo', 'Female', '2015-05-10', '20', '74', '', '20', '874491', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1379', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10903003960', '10903003960', 'Pema Choyang Tshomo', 'Female', '2015-07-04', '20', '74', '', '20', '875365', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('138', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312448', '12312312448', 'Tshewang Gyalpo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1380', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11006002137', '11006002137', 'NamgyelTshewangLhadon', 'Female', '2015-09-09', '20', '74', '', '20', '875951', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1381', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606004404', '11606004404', 'Kinzang Deki Selden', 'Female', '2015-12-11', '20', '74', '', '20', '875952', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1382', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11602003414', '11602003414', 'Yoesel Choying Tshomo', 'Female', '2015-12-18', '20', '74', '', '20', '875954', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1383', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10903004030', '10903004030', 'Deki Choeyang', 'Female', '2016-01-04', '20', '74', '', '20', '875956', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1384', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10309003442', '10309003442', 'Tandin Choetsho', 'Female', '2016-01-05', '20', '74', '', '20', '875957', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1385', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805003393', '10805003393', 'Tandin Pem', 'Female', '2015-10-22', '20', '74', '', '20', '875958', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1386', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512006966', '11512006966', 'Tshering Wangmo', 'Female', '2015-11-30', '20', '74', '', '20', '875959', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1387', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003422', '10811003422', 'Yetsho Kuenden Lhamo', 'Female', '2015-06-03', '20', '74', '', '20', '875960', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1388', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11206007252', '11206007252', 'Chencho Mindrel Wangmo', 'Female', '2015-11-17', '20', '74', '', '20', '875961', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1389', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tenzin Gakid', 'Female', '2015-10-20', '20', '74', '', '20', '875962', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('139', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312449', '12312312449', 'Tshering Samdrup', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-20', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1390', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10911000915', '10911000915', 'Kinga Regyal Wangchuk', 'Male', '2015-03-07', '20', '74', '', '20', '876118', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1391', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11506008320', '11506008320', 'Kuenga Choetshopel', 'Male', '2015-02-21', '20', '74', '', '20', '876121', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1392', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12003003342', '12003003342', 'Tandin Gawa Wangyal', 'Male', '2015-03-31', '20', '74', '', '20', '876126', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1393', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10910001034', '10910001034', 'Thukten Sherab Thaye', 'Male', '2015-04-09', '20', '74', '', '20', '876127', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1394', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10905007270', '10905007270', 'Tshering Tobgay', 'Male', '2015-04-18', '20', '74', '', '20', '876130', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1395', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11605004141', '11605004141', 'Sonam Jigme Yoezer', 'Male', '2015-06-27', '20', '74', '', '20', '876134', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1396', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11211002199', '11211002199', 'Rehan Sanyasi', 'Male', '2015-06-27', '20', '74', '', '20', '876204', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1397', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002713', '10802002713', 'Rigyel Tenzin Nordan', 'Male', '2015-07-07', '20', '74', '', '20', '876205', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1398', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10707003030', '10707003030', 'Samten Loday', 'Male', '2015-07-23', '20', '74', '', '20', '876206', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1399', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003433', '10811003433', 'Sherab Boon Phuntsho', 'Male', '2015-10-09', '20', '74', '', '20', '876207', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('14', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312324', '12312312324', 'Jamyang Khenrab', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('140', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312450', '12312312450', 'Kavin Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1400', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11806002550', '11806002550', 'Kinley Lhodan Dhungyel', 'Male', '2015-10-13', '20', '74', '', '20', '876208', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1401', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001308', '10804001308', 'Ugyen Jigme Gyelphen', 'Male', '2015-10-15', '20', '74', '', '20', '876209', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1402', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10503002191', '10503002191', 'JigselDorji Lhendrub', 'Male', '2016-01-28', '20', '74', '', '20', '876210', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1403', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11102009013', '11102009013', 'Karma Rigzeen Jurmay', 'Male', '2016-01-24', '20', '74', '', '20', '876211', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1404', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Jigme Namgyel Tenzin', 'Male', '2015-09-20', '20', '74', '', '20', '879849', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1405', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004728', '10605004728', 'Dorji Pema Yultsho', 'Female', '2015-03-11', '20', '74', '', '20', '880638', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1406', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Kinley Tenzin Dendup', 'Male', '2014-11-30', '20', '74', '', '20', '880888', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1407', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11514005206', '11514005206', 'Leki Wangmo', 'Female', '2007-10-05', '20', '74', '', '20', '691864', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1408', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tenzin Choden', 'Female', '2009-05-04', '20', '74', '', '20', '752049', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1409', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11315003451', '11315003451', 'Nawang Drukpa', 'Male', '2009-10-18', '20', '74', '', '20', '758572', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('141', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312451', '12312312451', 'Dremi Kuenden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-21', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1410', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002335', '10806002335', 'Pema Yangchen', 'Female', '2011-07-27', '20', '74', '', '20', '759862', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1411', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002275', '10806002275', 'Sonam Lhakey Drukdra', 'Female', '2010-08-08', '20', '74', '', '20', '769481', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1412', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11207002658', '11207002658', 'Partiktsheya Rai', 'Female', '2010-02-20', '20', '74', '', '20', '770191', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1413', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11501003874', '11501003874', 'Sangay Tenzin', 'Male', '2010-01-07', '20', '74', '', '20', '770906', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1414', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003104', '10811003104', 'Kuenga Tshering Rabden', 'Male', '2010-06-29', '20', '74', '', '20', '773601', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1415', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12002001987', '12002001987', 'Lhawang Tashi', 'Male', '2010-12-15', '20', '74', '', '20', '774724', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1416', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10708003918', '10708003918', 'Tshewang Nyenden Lhamo', 'Female', '2010-06-07', '20', '74', '', '20', '775015', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1417', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11410010870', '11410010870', 'NgawangSeldrup', 'Male', '2009-12-01', '20', '74', '', '20', '775127', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1418', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11202005642', '11202005642', 'AashikaRai', 'Female', '2011-03-22', '20', '74', '', '20', '775560', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1419', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802001150', '10802001150', 'Jamyang Lhagyal', 'Male', '2011-08-24', '20', '74', '', '20', '775662', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('142', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312452', '12312312452', 'Jamphel Rangdrol', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-10-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1420', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11203003487', '11203003487', 'Rohit Biswa', 'Male', '2009-09-09', '20', '74', '', '20', '775692', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1421', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11207002599', '11207002599', 'Rohi San Rai', 'Male', '2009-12-04', '20', '74', '', '20', '775709', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1422', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12008004223', '12008004223', 'Jamyang Yoezer', 'Male', '2011-03-09', '20', '74', '', '20', '775713', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1423', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11509006090', '11509006090', 'Sangay Kelden', 'Male', '2010-03-07', '20', '74', '', '20', '775733', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1424', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003114', '10811003114', 'Tshering Phuntshok', 'Male', '2010-05-25', '20', '74', '', '20', '775741', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1425', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11903001679', '11903001679', 'Zhinden Lhamo', 'Female', '2011-02-25', '20', '74', '', '20', '776392', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1426', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11904002085', '11904002085', 'Ugyen Lhendup', 'Male', '2010-09-01', '20', '74', '', '20', '778991', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1427', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Sonam Yangden', 'Female', '2008-05-27', '20', '74', '', '20', '779171', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1428', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12003003082', '12003003082', 'TsheltriumYangchen Delma', 'Female', '2010-11-02', '20', '74', '', '20', '779421', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1429', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003198', '10811003198', 'TandinDemaWangmo ', 'Female', '2011-04-24', '20', '74', '', '20', '780405', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('143', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312453', '12312312453', 'Namsel Yangsel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-24', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1430', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000312', '10809000312', 'Reegzin Sonam Chogyel', 'Male', '2010-07-14', '20', '74', '', '20', '781185', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1431', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10502001903', '10502001903', 'Tenzing Tshering Dema', 'Female', '2010-07-16', '20', '74', '', '20', '781290', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1432', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805003526', '10805003526', 'Phuntsho Wangmo', 'Female', '2010-12-01', '20', '74', '', '20', '781293', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1433', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002475', '10802002475', 'YidhenYangzomWangdi', 'Female', '2010-06-01', '20', '74', '', '20', '806254', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1434', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502004059', '11502004059', 'Tenzin Norbu', 'Male', '2007-10-08', '20', '74', '', '20', '692264', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1435', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10810002800', '10810002800', 'Sonam Tobgay', 'Male', '2009-01-21', '20', '74', '', '20', '733060', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1436', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '21205000118', '21205000118', 'Lantia Rin Chhetri', 'Female', '2009-03-06', '20', '74', '', '20', '749001', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1437', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11806002238', '11806002238', 'Chhimi Wangmo Bhandari', 'Female', '2009-07-22', '20', '74', '', '20', '751867', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1438', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003113', '10811003113', 'Pema Lhamo', 'Female', '2009-12-12', '20', '74', '', '20', '751948', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1439', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11806002239', '11806002239', 'Tandin Bidha Bhandari', 'Female', '2008-11-26', '20', '74', '', '20', '752001', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('144', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312454', '12312312454', 'Tshogyal Duckpa', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-24', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1440', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003101', '10811003101', 'Sherab Dorji', 'Male', '2009-11-24', '20', '74', '', '20', '752196', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1441', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11607003629', '11607003629', 'Pema Yangchen Tshomo', 'Female', '2011-06-05', '20', '74', '', '20', '767617', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1442', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805003028', '10805003028', 'Jamphel Selden Penjor', 'Female', '2010-10-30', '20', '74', '', '20', '769524', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1443', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11605004222', '11605004222', 'Yangsel Leksin', 'Female', '2009-11-09', '20', '74', '', '20', '771152', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1444', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10603003235', '10603003235', 'LhawangTashi Tshogyel', 'Female', '2011-01-13', '20', '74', '', '20', '771346', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1445', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11410010038', '11410010038', 'Somken Aizen Wangchuk', 'Male', '2010-06-17', '20', '74', '', '20', '771405', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1446', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10204003538', '10204003538', 'Deki Yangzom', 'Female', '2011-05-31', '20', '74', '', '20', '772590', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1447', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11410010037', '11410010037', 'Khetsuen Tshultrim Lhamo', 'Female', '2011-02-09', '20', '74', '', '20', '774008', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1448', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10810002895', '10810002895', 'TshokeeTshoyel ', 'Female', '2011-02-16', '20', '74', '', '20', '774949', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1449', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002537', '10802002537', 'ThinleyDorji Tshering', 'Male', '2010-02-20', '20', '74', '', '20', '775243', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('145', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312455', '12312312455', 'Yoesel Seldon', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1450', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11515004907', '11515004907', 'Kezang Deki Wangmo', 'Female', '2010-05-19', '20', '74', '', '20', '775508', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1451', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10713003463', '10713003463', 'Chimi Tshoki Pem', 'Female', '2010-03-02', '20', '74', '', '20', '775564', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1452', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10301001461', '10301001461', 'Sanjit Mongar', 'Female', '2009-06-27', '20', '74', '', '20', '775577', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1453', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808002647', '10808002647', 'Tsheyang Tshokey Namgyel', 'Female', '2010-11-12', '20', '74', '', '20', '775609', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1454', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10211005659', '10211005659', 'Amrita Raini', 'Male', '2010-01-12', '20', '74', '', '20', '775625', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1455', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10910000634', '10910000634', 'Gaydhen Rigdal', 'Male', '2010-04-17', '20', '74', '', '20', '775645', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1456', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11003000739', '11003000739', 'Ngawang Thinley Gyeltshen', 'Male', '2011-02-01', '20', '74', '', '20', '775678', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1457', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004386', '10605004386', 'Samten Dorji Sonam', 'Male', '2009-06-17', '20', '74', '', '20', '775717', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1458', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10901001830', '10901001830', 'Tshering Tenzin', 'Male', '2009-02-09', '20', '74', '', '20', '775745', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1459', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10702002606', '10702002606', 'Jamyang Tshewang Lhamo', 'Female', '2011-04-24', '20', '74', '', '20', '777702', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('146', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312456', '12312312456', 'Yeasun Kuenyang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-16', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1460', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10305001339', '10305001339', 'Kinley Phuntsho Wangchen', 'Male', '2010-05-20', '20', '74', '', '20', '780403', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1461', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502004261', '11502004261', 'Serab Nyindruk Palzom', 'Female', '2011-02-18', '20', '74', '', '20', '781218', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1462', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002256', '10806002256', 'Gyatsho Terchen Jigme', 'Male', '2010-05-10', '20', '74', '', '20', '790020', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1463', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11204005325', '11204005325', 'Praba Ghallay', 'Female', '2005-09-17', '20', '74', '', '20', '663515', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1464', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Rigzing Wangchuk', 'Male', '2008-08-25', '20', '74', '', '20', '725174', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1465', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11506007266', '11506007266', 'Tshering Pema Zangmo', 'Female', '2008-07-25', '20', '74', '', '20', '725246', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1466', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11513006194', '11513006194', 'Jambay Dorji Phuntsho', 'Male', '2008-09-17', '20', '74', '', '20', '744864', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1467', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10807002872', '10807002872', 'Ugyen Yozer', 'Male', '2009-02-17', '20', '74', '', '20', '747795', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1468', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10712003151', '10712003151', 'Kezang Nyendra', 'Male', '2009-02-21', '20', '74', '', '20', '751020', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1469', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510005206', '11510005206', 'Nindha Yoesel', 'Female', '2009-03-13', '20', '74', '', '20', '751807', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('147', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312457', '12312312457', 'Kinley Yangden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-01-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1470', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11506007337', '11506007337', 'Aakyed Dechen Peldon', 'Female', '2009-10-02', '20', '74', '', '20', '751879', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1471', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001189', '10804001189', 'Jigme Yangchen Dorji', 'Female', '2010-01-06', '20', '74', '', '20', '751883', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1472', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11410010195', '11410010195', 'Namdrel Pema Yangzin', 'Female', '2009-06-30', '20', '74', '', '20', '751924', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1473', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510004956', '11510004956', 'Pema Choki', 'Female', '2008-10-12', '20', '74', '', '20', '751938', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1474', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10702002443', '10702002443', 'Tashi Yangden', 'Female', '2008-11-14', '20', '74', '', '20', '752016', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1475', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11906001871', '11906001871', 'Tendel Tshering Zangmo', 'Female', '2008-09-20', '20', '74', '', '20', '752035', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1476', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003099', '10811003099', 'Ugyen Samphel', 'Male', '2010-01-23', '20', '74', '', '20', '752053', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1477', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11306002961', '11306002961', 'Shelkar Lhazin', 'Female', '2009-01-22', '20', '74', '', '20', '752126', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1478', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10709005550', '10709005550', 'Dhoden Choephel Gyatsho', 'Male', '2009-10-09', '20', '74', '', '20', '752134', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1479', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10710003228', '10710003228', 'Kelzang Gempo', 'Male', '2009-09-09', '20', '74', '', '20', '752164', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('148', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312458', '12312312458', 'Dorji Samdrup', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-16', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1480', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512006036', '11512006036', 'YoudcelTsheringWangchuk', 'Male', '2009-06-03', '20', '74', '', '20', '752173', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1481', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003069', '10811003069', 'Pema Kalzang', 'Male', '2009-06-01', '20', '74', '', '20', '752175', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1482', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11506007483', '11506007483', 'Sonam Phuntsho', 'Male', '2009-05-01', '20', '74', '', '20', '752202', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1483', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11315002828', '11315002828', 'Ugyen Rigyel Dendrup', 'Male', '2009-04-29', '20', '74', '', '20', '752226', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1484', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003036', '10811003036', 'Kuenzang Tshomo Wangchuk', 'Female', '2009-12-26', '20', '74', '', '20', '752231', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1485', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Yeeyang Semsel Dorjee', 'Female', '2009-03-02', '20', '74', '', '20', '752495', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1486', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10801003455', '10801003455', 'Ngalwang Lamdroun Wangmo', 'Female', '2010-03-27', '20', '74', '', '20', '752892', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1487', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002430', '10802002430', 'Tandin Norbu', 'Male', '2008-02-01', '20', '74', '', '20', '753462', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1488', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002371', '10806002371', 'Tshering Yangzom', 'Female', '2009-12-14', '20', '74', '', '20', '755003', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1489', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11109003550', '11109003550', 'Meera Regmi', 'Female', '2009-08-07', '20', '74', '', '20', '755027', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('149', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312459', '12312312459', 'Pema Lhazin', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-12-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1490', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12001004628', '12001004628', 'Ugyen Tshering Tshomo', 'Female', '2009-07-12', '20', '74', '', '20', '755125', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1491', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001184', '10804001184', 'Tenzin Pelzom', 'Female', '2010-05-07', '20', '74', '', '20', '755445', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1492', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11008002825', '11008002825', 'SamdoenYoselJigdra', 'Male', '2009-06-21', '20', '74', '', '20', '759894', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1493', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002299', '10806002299', 'Tenzin Yangchen', 'Female', '2009-10-11', '20', '74', '', '20', '759899', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1494', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11805002906', '11805002906', 'Ganesh Kumar Monger', 'Male', '2007-11-19', '20', '74', '', '20', '691640', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1495', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11704004433', '11704004433', 'Pema Yewong Selden', 'Female', '2007-12-28', '20', '74', '', '20', '722917', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1496', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10910000447', '10910000447', 'Chimi Tshogyel Choden', 'Female', '2009-04-09', '20', '74', '', '20', '725166', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1497', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11809002316', '11809002316', 'Choki Lhamo Drukpa', 'Female', '2009-02-06', '20', '74', '', '20', '744959', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1498', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003094', '10811003094', 'Gadhen Rigzine', 'Male', '2008-12-03', '20', '74', '', '20', '746749', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1499', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11602003084', '11602003084', 'Tshering Yangchen Wangdi', 'Female', '2010-03-16', '20', '74', '', '20', '746789', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('15', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312325', '12312312325', 'Rigsel Gurung', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-21', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('150', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312460', '12312312460', 'Tenzin Yewong', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-21', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1500', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Nima Gyeltshen', 'Male', '2009-06-26', '20', '74', '', '20', '747471', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1501', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805003682', '10805003682', 'TENZIN TSHERING DUKPA', 'Male', '2009-10-26', '20', '74', '', '20', '747785', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1502', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11215004773', '11215004773', 'Srijana Rai', 'Female', '2009-08-13', '20', '74', '', '20', '750865', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1503', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10905006455', '10905006455', 'Phuntsho Tobdhen Tshering', 'Male', '2009-11-12', '20', '74', '', '20', '751121', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1504', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11011000064', '11011000064', 'Tenzin Wangpo', 'Male', '2009-08-07', '20', '74', '', '20', '751134', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1505', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003080', '10811003080', 'Tenzin Yedtsho Tobgay', 'Female', '2009-09-21', '20', '74', '', '20', '751707', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1506', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003166', '10811003166', 'Damchoe Dolma Dendup', 'Female', '2010-04-23', '20', '74', '', '20', '751878', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1507', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Kinley Cheki', 'Female', '2009-12-10', '20', '74', '', '20', '751894', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1508', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11605003777', '11605003777', 'Shacha Seldon Wangmo', 'Female', '2010-06-23', '20', '74', '', '20', '751949', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1509', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502004426', '11502004426', 'Sonam Choki', 'Female', '2009-07-19', '20', '74', '', '20', '751983', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('151', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312461', '12312312461', 'Rabsel Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-21', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1510', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002279', '10806002279', 'Sonam Kuenga Wangchuk', 'Male', '2009-11-02', '20', '74', '', '20', '751996', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1511', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10901001836', '10901001836', 'Ugyen Lhamo', 'Female', '2008-09-28', '20', '74', '', '20', '752067', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1512', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11308002312', '11308002312', 'Chimi Gyembo', 'Male', '2010-02-12', '20', '74', '', '20', '752089', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1513', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11701003831', '11701003831', 'Sonam Yonten Yoezer', 'Male', '2009-12-09', '20', '74', '', '20', '752093', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1514', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510005051', '11510005051', 'Nindha Lhasel', 'Female', '2009-03-13', '20', '74', '', '20', '752160', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1515', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000300', '10809000300', 'Pema Rigzin Chogyal', 'Male', '2009-05-28', '20', '74', '', '20', '752187', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1516', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10503002182', '10503002182', 'Karma Choying Dolkar', 'Female', '2009-03-23', '20', '74', '', '20', '752716', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1517', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11702000347', '11702000347', 'Namgay Dorji', 'Male', '2009-04-25', '20', '74', '', '20', '753164', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1518', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11204003923', '11204003923', 'Nima Dorji Ghalley', 'Male', '2008-11-29', '20', '74', '', '20', '754948', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1519', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003111', '10811003111', 'Karma Yeshey Jamtsho', 'Male', '2009-02-22', '20', '74', '', '20', '755315', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('152', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312462', '12312312462', 'Sonam Rabzang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1520', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11308005254', '11308005254', 'Rigsel Rabgay Tshering', 'Male', '2009-02-11', '20', '74', '', '20', '755479', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1521', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10502001976', '10502001976', 'Sangay Tshering Tharchen', 'Male', '2009-12-06', '20', '74', '', '20', '757564', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00');
INSERT INTO `std_student` (`id`, `OrgOrganizationId`, `CidNo`, `student_code`, `Name`, `CmnSexId`, `DateOfBirth`, `CmnCountryId`, `CmnGewogId`, `CmnChiwogId`, `CmnLanguageId`, `Remarks`, `IsNewAdmission`, `IsTransferred`, `IsRejoined`, `PhotoPath`, `PrimaryContact`, `CmnParentsMaritalStatusId`, `Address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1522', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11803002189', '11803002189', 'Karma YeshiDolkar', 'Female', '2009-06-12', '20', '74', '', '20', '757626', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1523', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003067', '10811003067', 'Jetsen Yangzom Dorji', 'Female', '2009-06-06', '20', '74', '', '20', '757628', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1524', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11109000248', '11109000248', 'TulshiTimsina', 'Female', '2010-06-23', '20', '74', '', '20', '757866', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1525', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002370', '10806002370', 'Tenzin Choden', 'Female', '2006-09-06', '20', '74', '', '20', '662235', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1526', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001135', '10804001135', 'Tandin Nima', 'Male', '2007-01-21', '20', '74', '', '20', '662237', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1527', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11509005258', '11509005258', 'Tashi Dorji', 'Male', '2007-07-25', '20', '74', '', '20', '691641', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1528', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tshering Tashi', 'Male', '2007-08-13', '20', '74', '', '20', '692266', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1529', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11410009346', '11410009346', 'SONAM T CHODEN', 'Female', '2007-03-15', '20', '74', '', '20', '694112', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('153', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312463', '12312312463', 'Sonam Yangchen', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1530', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11907001157', '11907001157', 'Dechen Om', 'Female', '2007-01-08', '20', '74', '', '20', '694719', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1531', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11908001514', '11908001514', 'Tashi Dorji', 'Male', '2007-06-09', '20', '74', '', '20', '695602', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1532', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11210002485', '11210002485', 'Mon Rupa Rai', 'Female', '2006-02-14', '20', '74', '', '20', '704394', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1533', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10601004975', '10601004975', 'Chador Wangmo', 'Female', '2007-12-10', '20', '74', '', '20', '719209', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1534', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11605003703', '11605003703', 'Kinley Palden Wangmo', 'Female', '2009-02-17', '20', '74', '', '20', '721058', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1535', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12008003727', '12008003727', 'Kuenga Tshedren', 'Female', '2008-05-26', '20', '74', '', '20', '723716', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1536', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11410010036', '11410010036', 'Lhawang Sascha Tenzin', 'Male', '2009-05-15', '20', '74', '', '20', '724543', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1537', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510004954', '11510004954', 'Hingsel P Wangmo', 'Female', '2008-01-25', '20', '74', '', '20', '725014', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1538', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10907002816', '10907002816', 'Tshering Yoesel Lhamo', 'Female', '2008-03-15', '20', '74', '', '20', '725247', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1539', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11308004378', '11308004378', 'Som Raj Mongar', 'Male', '2007-06-11', '20', '74', '', '20', '725258', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('154', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312464', '12312312464', 'Tashi Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1540', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003680', '10811003680', 'Tandin Dorji', 'Male', '2008-01-17', '20', '74', '', '20', '725263', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1541', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805002926', '10805002926', 'Jigme Wangchuk', 'Male', '2008-03-09', '20', '74', '', '20', '725540', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1542', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11302003538', '11302003538', 'KARMA ZAYPA LHAMO', 'Female', '2008-06-25', '20', '74', '', '20', '726193', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1543', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10801003451', '10801003451', 'Sonam Dechen Pelzom', 'Female', '2009-06-06', '20', '74', '', '20', '727015', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1544', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003247', '10811003247', 'Kuenkhen Lhamo', 'Female', '2008-02-10', '20', '74', '', '20', '727024', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1545', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002057', '10806002057', 'Wangdi Tshering', 'Male', '2007-10-19', '20', '74', '', '20', '727028', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1546', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11301002961', '11301002961', 'Bisesh Rai', 'Male', '2006-10-02', '20', '74', '', '20', '727036', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1547', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11202003767', '11202003767', 'Aita Raj Subba', 'Male', '2007-07-01', '20', '74', '', '20', '727052', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1548', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512005925', '11512005925', 'Pema Dorji', 'Male', '2007-10-22', '20', '74', '', '20', '727058', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1549', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11809001133', '11809001133', 'Yeshi Wangchuk', 'Male', '2008-07-24', '20', '74', '', '20', '727066', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('155', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312465', '12312312465', 'Tsheyang Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-07', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1550', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10311002190', '10311002190', 'Jigme Dorji', 'Male', '2008-08-07', '20', '74', '', '20', '727087', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1551', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805003170', '10805003170', 'Jigme Tenzin Dukpa', 'Male', '2008-07-25', '20', '74', '', '20', '729490', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1552', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10203005808', '10203005808', 'Sangay Wangmo', 'Female', '2007-06-02', '20', '74', '', '20', '730188', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1553', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10905006231', '10905006231', 'Kingyel Wangchuk Dorji', 'Male', '2008-12-06', '20', '74', '', '20', '733072', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1554', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Sonam Kelzang Dolkar', 'Female', '2008-09-15', '20', '74', '', '20', '733079', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1555', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000302', '10809000302', 'Yeezang Lhyndrup Chokey', 'Female', '2008-07-27', '20', '74', '', '20', '733098', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1556', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10314000164', '10314000164', 'Lekden Rigsel Wangchen Gurung', 'Male', '2008-02-26', '20', '74', '', '20', '738346', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1557', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Lekden Tshephel', 'Male', '2008-11-15', '20', '74', '', '20', '738862', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1558', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11109003478', '11109003478', 'Tshering Yangzom', 'Female', '2008-01-19', '20', '74', '', '20', '740528', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1559', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10702002446', '10702002446', 'Pema Rixin Wangchuk', 'Male', '2008-11-03', '20', '74', '', '20', '754333', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('156', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312466', '12312312466', 'Tenzin Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1560', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10304002946', '10304002946', 'Namkha Thinley Yoezer', 'Male', '2009-06-19', '20', '74', '', '20', '755982', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1561', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510004764', '11510004764', 'Dorji Gyaltshen', 'Male', '2007-02-20', '20', '74', '', '20', '692253', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1562', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Sonam Dukpa', 'Male', '2007-08-25', '20', '74', '', '20', '692262', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1563', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Dhan Raj Biswa', 'Male', '2007-03-14', '20', '74', '', '20', '692280', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1564', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003479', '10811003479', 'Kinley Wangmo', 'Female', '2007-10-21', '20', '74', '', '20', '692296', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1565', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002213', '10806002213', 'Ngawang Sithup', 'Male', '2008-03-30', '20', '74', '', '20', '693575', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1566', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11205001900', '11205001900', 'Pooja Chapagai', 'Female', '2007-03-27', '20', '74', '', '20', '697887', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1567', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10102003029', '10102003029', 'Tashi Lhendrup Wangchuk', 'Male', '2007-11-01', '20', '74', '', '20', '699021', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1568', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11202005503', '11202005503', 'Neketa Rai', 'Female', '2008-01-19', '20', '74', '', '20', '704508', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1569', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000352', '10809000352', 'Tenzin Jamtsho', 'Male', '2007-10-25', '20', '74', '', '20', '716616', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('157', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312467', '12312312467', 'Tandin Wangyel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1570', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002992', '10811002992', 'Rinzin Dema', 'Female', '2008-10-20', '20', '74', '', '20', '724983', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1571', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11312003927', '11312003927', 'Yeewong Yeshe Tshogay', 'Female', '2008-07-18', '20', '74', '', '20', '725249', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1572', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003090', '10811003090', 'Jigsel Wangchuk', 'Male', '2008-08-25', '20', '74', '', '20', '725251', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1573', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Lhabab Dorji', 'Male', '2007-11-01', '20', '74', '', '20', '725253', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1574', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10903003532', '10903003532', 'Sonam Ugyen', 'Male', '2007-11-08', '20', '74', '', '20', '725259', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1575', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10504002437', '10504002437', 'Tandin Gyeltshen', 'Male', '2008-03-25', '20', '74', '', '20', '725264', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1576', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002306', '10806002306', 'Sazin Dorji', 'Male', '2009-02-20', '20', '74', '', '20', '725268', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1577', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11809002350', '11809002350', 'Namgay Choden Dorji', 'Female', '2009-01-21', '20', '74', '', '20', '727003', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1578', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11103001838', '11103001838', 'Yeshey Nangsa', 'Female', '2009-01-03', '20', '74', '', '20', '727020', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1579', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10710003073', '10710003073', 'Phuntsho Zangpo', 'Male', '2008-09-19', '20', '74', '', '20', '727060', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('158', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312468', '12312312468', 'Tenzin Chhozang Wangdi', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-29', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1580', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002982', '10811002982', 'Chencho Yangkey', 'Female', '2008-11-21', '20', '74', '', '20', '727068', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1581', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11703004011', '11703004011', 'Karma Lungrig', 'Male', '2008-01-28', '20', '74', '', '20', '727086', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1582', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tshering Haychen', 'Female', '2007-12-13', '20', '74', '', '20', '727093', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1583', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10212000099', '10212000099', 'Jigme Wangmo', 'Female', '2008-07-01', '20', '74', '', '20', '733024', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1584', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002997', '10811002997', 'Sonam Tshering Wangmo', 'Female', '2008-07-07', '20', '74', '', '20', '733025', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1585', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808002582', '10808002582', 'Dhuejom Namgyel Norbu', 'Male', '2009-02-03', '20', '74', '', '20', '733039', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1586', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004312', '10605004312', 'Jigme Terchen', 'Female', '2008-10-15', '20', '74', '', '20', '733048', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1587', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805002917', '10805002917', 'Ngawang Lhamo Dorji', 'Female', '2008-07-05', '20', '74', '', '20', '733052', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1588', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000335', '10809000335', 'Phuntshok Norbu', 'Male', '2008-03-10', '20', '74', '', '20', '733056', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1589', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001173', '10804001173', 'Tandin Yangchen Namgyal', 'Female', '2009-05-02', '20', '74', '', '20', '733062', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('159', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312469', '12312312469', 'Aishna Gurung', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-03-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1590', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003051', '10811003051', 'Tenzing Sherab Wangchuk', 'Male', '2009-05-08', '20', '74', '', '20', '733087', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1591', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003006', '10811003006', 'Pema Choki', 'Female', '2008-08-08', '20', '74', '', '20', '733106', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1592', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11704001481', '11704001481', 'Pema Yethro Seldon', 'Female', '2008-09-02', '20', '74', '', '20', '735239', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1593', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10910000254', '10910000254', 'Pema Lhamo', 'Female', '2008-03-11', '20', '74', '', '20', '735470', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1594', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11114000025', '11114000025', 'Ngawang Rabgay', 'Male', '2008-02-17', '20', '74', '', '20', '741544', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1595', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11011000426', '11011000426', 'Dorji Euden', 'Female', '2009-06-12', '20', '74', '', '20', '755522', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1596', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10606002451', '10606002451', 'Pema Yoezer Thinley', 'Male', '2006-08-13', '20', '74', '', '20', '560367', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1597', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002247', '10806002247', 'Sonam Wangyel', 'Male', '2006-06-25', '20', '74', '', '20', '662242', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1598', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10905005972', '10905005972', 'NIMA TSHERING', 'Male', '2006-02-04', '20', '74', '', '20', '665235', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1599', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502003842', '11502003842', 'Yeshi Tshering', 'Male', '2007-01-16', '20', '74', '', '20', '674874', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('16', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312326', '12312312326', 'Tenzeen Phunso', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('160', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312470', '12312312470', 'Benai Subba', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1600', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11506007923', '11506007923', 'Elzang Tenzin', 'Male', '2007-08-02', '20', '74', '', '20', '692282', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1601', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10101006239', '10101006239', 'Tenzin Jigdel Dorji', 'Male', '2009-01-17', '20', '74', '', '20', '699499', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1602', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10601005010', '10601005010', 'Karma Rigzin Wangda', 'Male', '2008-03-01', '20', '74', '', '20', '719062', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1603', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10501002320', '10501002320', 'Kelden Ongmo', 'Female', '2008-08-30', '20', '74', '', '20', '721213', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1604', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11504005117', '11504005117', 'Dechen Wangmo', 'Female', '2008-09-02', '20', '74', '', '20', '725167', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1605', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11104004830', '11104004830', 'Rigzin Choden Namgyal', 'Female', '2008-06-07', '20', '74', '', '20', '725244', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1606', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '20211001598', '20211001598', 'Manip Ghalley', 'Male', '2007-11-19', '20', '74', '', '20', '725254', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1607', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003000', '10811003000', 'Sonam Wangchuk', 'Male', '2008-07-24', '20', '74', '', '20', '725262', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1608', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003002', '10811003002', 'Passang Lhamo', 'Female', '2008-09-25', '20', '74', '', '20', '725267', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1609', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11513006130', '11513006130', 'Jetsuen Drolma Namgyel', 'Female', '2008-07-19', '20', '74', '', '20', '727021', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('161', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312471', '12312312471', 'Bebeka Gurung', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1610', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10501002252', '10501002252', 'Karma Samphel', 'Male', '2008-02-18', '20', '74', '', '20', '727027', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1611', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11303005515', '11303005515', 'Person Rai', 'Male', '2007-10-10', '20', '74', '', '20', '727029', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1612', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510005035', '11510005035', 'Kuenga Phuntsho Tobden', 'Male', '2008-03-30', '20', '74', '', '20', '727055', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1613', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11203005120', '11203005120', 'Saahil Yakha', 'Male', '2007-12-08', '20', '74', '', '20', '727061', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1614', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11601003617', '11601003617', 'Chimi Dema', 'Female', '2008-03-02', '20', '74', '', '20', '727084', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1615', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000298', '10809000298', 'Tenzin Tashi Choden', 'Female', '2009-01-19', '20', '74', '', '20', '727089', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1616', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11302003585', '11302003585', 'Bhumika Adhikari', 'Female', '2008-10-07', '20', '74', '', '20', '727090', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1617', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tandin Tshering', 'Male', '2008-06-04', '20', '74', '', '20', '727092', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1618', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11604002541', '11604002541', 'Kinley Dema', 'Female', '2008-07-28', '20', '74', '', '20', '733029', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1619', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10606002976', '10606002976', 'Thubten Norbu', 'Male', '2009-05-18', '20', '74', '', '20', '733038', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('162', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312472', '12312312472', 'Desha Rai', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1620', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11603005423', '11603005423', 'Seirgee Ueesall Oangmo', 'Female', '2009-01-27', '20', '74', '', '20', '733059', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1621', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606003890', '11606003890', 'Sonam Norbu', 'Male', '2007-10-01', '20', '74', '', '20', '733080', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1622', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10604002469', '10604002469', 'Tenzin Rabgay', 'Male', '2008-04-19', '20', '74', '', '20', '733085', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1623', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606003933', '11606003933', 'Tshering Wangmo', 'Female', '2008-03-30', '20', '74', '', '20', '733299', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1624', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003001', '10811003001', 'Thinley Jamtsho', 'Male', '2008-03-18', '20', '74', '', '20', '734077', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1625', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11410009910', '11410009910', 'Yuphel Choden Tshering', 'Female', '2009-08-04', '20', '74', '', '20', '735125', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1626', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003121', '10811003121', 'Thinley Lhaki', 'Female', '2009-01-26', '20', '74', '', '20', '736620', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1627', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003254', '10811003254', 'Karma Wangchen', 'Male', '2008-03-21', '20', '74', '', '20', '739151', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1628', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11810002334', '11810002334', 'SURAJ Mongar', 'Male', '2005-07-25', '20', '74', '', '20', '739226', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1629', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11206007716', '11206007716', 'Samjana Darjee', 'Female', '2007-12-09', '20', '74', '', '20', '742403', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('163', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312473', '12312312473', 'Esha Limbu', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1630', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805002867', '10805002867', 'Tshering Penjor', 'Male', '2005-12-13', '20', '74', '', '20', '560405', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1631', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11203004983', '11203004983', 'Som Bahadur Chhetri', 'Male', '2004-12-18', '20', '74', '', '20', '601335', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1632', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001215', '10804001215', 'Tandin Dawa', 'Male', '2007-01-21', '20', '74', '', '20', '662236', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1633', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Kinga Yoezer', 'Male', '2007-10-18', '20', '74', '', '20', '691649', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1634', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Hastey Ghalley', 'Male', '2006-09-26', '20', '74', '', '20', '692283', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1635', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10911000102', '10911000102', 'YezerDrukpa', 'Male', '2007-02-09', '20', '74', '', '20', '692292', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1636', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002380', '10806002380', 'Tshering Choden', 'Female', '2008-07-13', '20', '74', '', '20', '703142', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1637', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003282', '10811003282', 'Karma Yangchen Dolkar', 'Female', '2008-04-02', '20', '74', '', '20', '716656', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1638', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11511002658', '11511002658', 'Chimi Tshering Lhamo', 'Female', '2009-03-29', '20', '74', '', '20', '722454', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1639', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10705005024', '10705005024', 'Tashi Dorji', 'Male', '2006-12-06', '20', '74', '', '20', '723930', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('164', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312474', '12312312474', 'Isheak Limbu', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-21', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1640', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002351', '10802002351', 'NgawangPemaKhentse', 'Male', '2008-05-20', '20', '74', '', '20', '723989', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1641', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002226', '10806002226', 'Jamyang Dechen', 'Female', '2009-05-14', '20', '74', '', '20', '725240', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1642', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10911000304', '10911000304', 'Sangay Chophel', 'Male', '2008-03-17', '20', '74', '', '20', '725269', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1643', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tenzin Selden', 'Female', '2009-01-10', '20', '74', '', '20', '727017', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1644', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003059', '10811003059', 'Tenzin Drukdra Wangchuk', 'Male', '2009-02-10', '20', '74', '', '20', '727023', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1645', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11302003553', '11302003553', 'Jamyang Wangmo', 'Female', '2007-11-08', '20', '74', '', '20', '727071', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1646', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12001002763', '12001002763', 'Tshering Lhamo', 'Female', '2008-01-16', '20', '74', '', '20', '727073', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1647', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606003971', '11606003971', 'Chimi Lhamo', 'Female', '2008-06-16', '20', '74', '', '20', '727081', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1648', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11905002870', '11905002870', 'Tandin Dorji', 'Male', '2008-05-20', '20', '74', '', '20', '727083', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1649', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001172', '10804001172', 'Tandin Wangmo', 'Female', '2008-12-25', '20', '74', '', '20', '727088', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('165', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312475', '12312312475', 'Manesha Rai', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-19', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1650', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002964', '10811002964', 'Sonam Wangyel', 'Male', '2008-12-14', '20', '74', '', '20', '727097', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1651', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10502001829', '10502001829', 'Tenzin Wangmo', 'Female', '2008-11-13', '20', '74', '', '20', '732539', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1652', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11307003129', '11307003129', 'Ringlen Palden Rai', 'Female', '2009-02-26', '20', '74', '', '20', '733019', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1653', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10903003547', '10903003547', 'Tashi L Tshomo', 'Female', '2008-07-12', '20', '74', '', '20', '733026', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1654', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11904001980', '11904001980', 'KuenphenRigselDorjee', 'Male', '2008-06-01', '20', '74', '', '20', '733032', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1655', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002397', '10806002397', 'Euphel D Latsho', 'Female', '2008-12-07', '20', '74', '', '20', '733045', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1656', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808002550', '10808002550', 'Rigden Dorji Gyeltshen', 'Male', '2009-01-03', '20', '74', '', '20', '733057', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1657', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805002950', '10805002950', 'Tshering Dema', 'Female', '2008-09-05', '20', '74', '', '20', '733089', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1658', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11008002835', '11008002835', 'RigzangTshomo', 'Female', '2009-09-05', '20', '74', '', '20', '735775', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1659', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11011000004', '11011000004', 'Namgay Thinley Dorji', 'Male', '2008-05-21', '20', '74', '', '20', '741541', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('166', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312476', '12312312476', 'Nikita Gurung', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1660', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808002528', '10808002528', 'Sonam Yangchen Dorji', 'Female', '2008-09-21', '20', '74', '', '20', '750388', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1661', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11808002876', '11808002876', 'Yangtsho Dolma Tamang', 'Female', '2008-06-30', '20', '74', '', '20', '752407', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1662', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10502001834', '10502001834', 'Tenzin Zangmo', 'Female', '2008-11-29', '20', '74', '', '20', '752442', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1663', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805002900', '10805002900', 'Pema Seldon', 'Female', '2007-09-21', '20', '74', '', '20', '761812', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1664', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Heera Nath Roy', 'Male', '2005-07-17', '20', '74', '', '20', '492503', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1665', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004238', '10605004238', 'Kinley Bidha', 'Female', '2007-08-07', '20', '74', '', '20', '660410', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1666', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11202003513', '11202003513', 'Pujan Ghalley', 'Female', '2005-08-10', '20', '74', '', '20', '662206', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1667', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002786', '10811002786', 'Tshering Pem', 'Female', '2006-01-15', '20', '74', '', '20', '662252', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1668', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11009001915', '11009001915', 'Pema Chukey Wangmo', 'Female', '2006-04-14', '20', '74', '', '20', '663523', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1669', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502004455', '11502004455', 'Jigme Tobgay', 'Male', '2007-10-13', '20', '74', '', '20', '684088', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('167', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312477', '12312312477', 'Selden Tamang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1670', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002956', '10811002956', 'Tshering Gyeltshen', 'Male', '2006-12-08', '20', '74', '', '20', '684098', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1671', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10807002770', '10807002770', 'Jigme Dorji', 'Male', '2006-12-07', '20', '74', '', '20', '684680', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1672', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11501003538', '11501003538', 'NGAWANG CHODEN', 'Female', '2006-07-25', '20', '74', '', '20', '690603', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1673', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11211002106', '11211002106', 'Unish Ghalley', 'Female', '2007-11-26', '20', '74', '', '20', '691645', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1674', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10501002258', '10501002258', 'Thukten Wangchuk Dorji', 'Male', '2007-07-24', '20', '74', '', '20', '691646', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1675', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11204005712', '11204005712', 'Anumol Gurung', 'Male', '2007-07-06', '20', '74', '', '20', '691651', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1676', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10709005503', '10709005503', 'Kuenyang Yigsel', 'Female', '2008-05-07', '20', '74', '', '20', '691655', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1677', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Prakreti Chhetri', 'Female', '2007-11-24', '20', '74', '', '20', '692273', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1678', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11206007719', '11206007719', 'Mumta Rai', 'Female', '2007-06-05', '20', '74', '', '20', '692298', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1679', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Pema Tamang', 'Female', '2007-08-18', '20', '74', '', '20', '692300', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('168', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312478', '12312312478', 'Sital Subba', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1680', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606003682', '11606003682', 'Ugyen Lhadon', 'Female', '2006-10-23', '20', '74', '', '20', '692303', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1681', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Robin Subba', 'Male', '2007-06-01', '20', '74', '', '20', '694734', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1682', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11905002547', '11905002547', 'Karma Choki', 'Female', '2007-05-01', '20', '74', '', '20', '696316', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00');
INSERT INTO `std_student` (`id`, `OrgOrganizationId`, `CidNo`, `student_code`, `Name`, `CmnSexId`, `DateOfBirth`, `CmnCountryId`, `CmnGewogId`, `CmnChiwogId`, `CmnLanguageId`, `Remarks`, `IsNewAdmission`, `IsTransferred`, `IsRejoined`, `PhotoPath`, `PrimaryContact`, `CmnParentsMaritalStatusId`, `Address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1683', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004166', '10605004166', 'Jigme Norbu', 'Male', '2008-08-07', '20', '74', '', '20', '698481', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1684', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11705002467', '11705002467', 'SONAM NYENDA', 'Male', '2008-07-02', '20', '74', '', '20', '699525', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1685', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10101006255', '10101006255', 'Jamyang Dolma', 'Female', '2008-01-27', '20', '74', '', '20', '701491', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1686', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'INDRA Joti', 'Female', '2007-07-20', '20', '74', '', '20', '706896', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1687', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11008002692', '11008002692', 'JIGME WANGYEL', 'Male', '2007-05-28', '20', '74', '', '20', '707147', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1688', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11313000921', '11313000921', 'SABINA RAI', 'Female', '2006-07-13', '20', '74', '', '20', '707501', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1689', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Dibdyel Chogyel', 'Male', '2007-10-19', '20', '74', '', '20', '716601', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('169', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312479', '12312312479', 'Pretika Rai', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1690', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11208003196', '11208003196', 'Dorji Namgyel', 'Male', '2008-10-24', '20', '74', '', '20', '716634', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1691', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11604002538', '11604002538', 'Kelden Dondhen Yoezer', 'Male', '2008-03-13', '20', '74', '', '20', '716636', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1692', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11303005358', '11303005358', 'Siddhartha Palden', 'Male', '2007-10-16', '20', '74', '', '20', '716642', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1693', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Priyanka Biswa', 'Female', '2007-06-11', '20', '74', '', '20', '716657', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1694', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11911001650', '11911001650', 'Usel Palven Namgay', 'Female', '2007-08-14', '20', '74', '', '20', '733002', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1695', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000277', '10809000277', 'Nima Wangchuk', 'Male', '2005-09-03', '20', '74', '', '20', '734432', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1696', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11004002173', '11004002173', 'Sangay Dorji Tamang', 'Male', '2007-02-25', '20', '74', '', '20', '743849', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1697', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12001002764', '12001002764', 'Dechen Wangmo', 'Female', '2006-09-05', '20', '74', '', '20', '455203', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1698', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10203002460', '10203002460', 'Sangay Om', 'Female', '2004-06-07', '20', '74', '', '20', '559499', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1699', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Ngawang Kinley Rangdrol', 'Male', '2007-03-27', '20', '74', '', '20', '560397', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('17', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312327', '12312312327', 'Yoezer Chenma', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-08', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('170', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312480', '12312312480', 'Susal Subba', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1700', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '21210000105', '21210000105', 'Lucky Rin Chhetri', 'Female', '2006-10-13', '20', '74', '', '20', '569287', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1701', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12001004987', '12001004987', 'Tashi Tshering Wangyel', 'Male', '2007-02-19', '20', '74', '', '20', '656554', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1702', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10801003329', '10801003329', 'Pema Lhazin', 'Female', '2007-07-22', '20', '74', '', '20', '662061', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1703', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11606003935', '11606003935', 'Tandin Tshewang', 'Male', '2007-05-10', '20', '74', '', '20', '662212', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1704', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11202003405', '11202003405', 'Januka Subba', 'Female', '2006-03-24', '20', '74', '', '20', '662232', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1705', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002971', '10811002971', 'Kinley Yangden', 'Female', '2006-09-19', '20', '74', '', '20', '662262', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1706', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11511002820', '11511002820', 'Sonam Wangchuk', 'Male', '2005-10-20', '20', '74', '', '20', '663507', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1707', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002209', '10806002209', 'Jigme Wangyel', 'Male', '2008-02-09', '20', '74', '', '20', '663518', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1708', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10602002149', '10602002149', 'Kinley Buda', 'Female', '2007-08-01', '20', '74', '', '20', '671436', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1709', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Tenzin Jatsho', 'Male', '2007-01-07', '20', '74', '', '20', '691648', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('171', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312481', '12312312481', 'Jamyang Lhazom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-10', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1710', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10606002751', '10606002751', 'Tashi Deki', 'Female', '2007-10-28', '20', '74', '', '20', '691657', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1711', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10605004096', '10605004096', 'Tshering Phuntsho Wangyel', 'Male', '2007-03-17', '20', '74', '', '20', '691662', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1712', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Thinley Norbu Rinzin', 'Male', '2007-10-04', '20', '74', '', '20', '692265', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1713', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002990', '10811002990', 'Kelden Wangchuk', 'Male', '2007-08-28', '20', '74', '', '20', '692285', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1714', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001134', '10804001134', 'Sonam Wangchuk', 'Male', '2007-10-18', '20', '74', '', '20', '692289', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1715', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10606002799', '10606002799', 'Dechen Wangmo', 'Female', '2007-03-15', '20', '74', '', '20', '692294', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1716', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003041', '10811003041', 'Sonam Tshering Yoezer', 'Male', '2008-06-25', '20', '74', '', '20', '693302', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1717', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11602002972', '11602002972', 'Nima Tshering', 'Male', '2008-02-13', '20', '74', '', '20', '695030', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1718', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003262', '10811003262', 'Pema', 'Female', '2007-05-23', '20', '74', '', '20', '696315', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1719', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808002543', '10808002543', 'Jimmy Thinley Dorji', 'Male', '2008-10-29', '20', '74', '', '20', '697878', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('172', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312482', '12312312482', 'Jigme Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1720', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '21313000213', '21313000213', 'Neha Subba', 'Female', '2008-04-05', '20', '74', '', '20', '700405', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1721', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003012', '10811003012', 'Kuenden Tshokey Namgyel', 'Female', '2008-05-07', '20', '74', '', '20', '700748', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1722', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Pujan Rai', 'Male', '2007-01-03', '20', '74', '', '20', '703055', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1723', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512005803', '11512005803', 'Kinga Gyeltshen', 'Male', '2007-07-12', '20', '74', '', '20', '707988', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1724', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12004004818', '12004004818', 'YesheyKarma Selden', 'Female', '2007-05-04', '20', '74', '', '20', '710052', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1725', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12003003000', '12003003000', 'Phuentsho Tobjur', 'Male', '2008-11-30', '20', '74', '', '20', '711993', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1726', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10504002424', '10504002424', 'Jigme Yeshey Donden', 'Male', '2007-06-15', '20', '74', '', '20', '718415', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1727', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10504002425', '10504002425', 'Jigme Samden Tshomo', 'Female', '2007-06-15', '20', '74', '', '20', '718440', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1728', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002952', '10811002952', 'Jigme Tenzin Chogyel', 'Male', '2007-07-25', '20', '74', '', '20', '725485', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1729', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11911001673', '11911001673', 'Tenzen Yangden', 'Female', '2008-10-19', '20', '74', '', '20', '733003', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('173', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312483', '12312312483', 'Tenzin Norbu', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1730', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11509005164', '11509005164', 'SANGAY THINLEY', 'Male', '2004-08-19', '20', '74', '', '20', '408733', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1731', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000355', '10809000355', 'Tenzin Lhendup', 'Male', '2005-11-02', '20', '74', '', '20', '507265', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1732', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11602000606', '11602000606', 'Ugyen Pemo', 'Female', '2005-08-07', '20', '74', '', '20', '507770', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1733', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11102007869', '11102007869', 'Sonam Lhendup', 'Male', '2005-08-06', '20', '74', '', '20', '597433', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1734', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11803002051', '11803002051', 'Deepak Dulal', 'Male', '2007-04-16', '20', '74', '', '20', '662203', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1735', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11601003328', '11601003328', 'Beami Rinzin', 'Male', '2006-02-22', '20', '74', '', '20', '662213', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1736', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11203003014', '11203003014', 'Salena Rai', 'Female', '2006-09-17', '20', '74', '', '20', '662231', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1737', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10205008172', '10205008172', 'Krishna Bdr. Chhetri', 'Male', '2005-02-18', '20', '74', '', '20', '662249', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1738', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12001004484', '12001004484', 'Rigzen', 'Male', '2005-08-31', '20', '74', '', '20', '663599', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1739', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11104004904', '11104004904', 'Chimi Kinga Wangyel', 'Male', '2008-02-03', '20', '74', '', '20', '666504', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('174', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312484', '12312312484', 'Lhazin Dekar', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1740', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11204003818', '11204003818', 'Rufus Gurung', 'Male', '2007-10-10', '20', '74', '', '20', '673069', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1741', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805002969', '10805002969', 'Galley Wangmo', 'Female', '2008-02-27', '20', '74', '', '20', '673077', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1742', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002347', '10802002347', 'Tshering Zangmo', 'Female', '2008-02-26', '20', '74', '', '20', '674421', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1743', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002401', '10802002401', 'Kinley Gyeltshen', 'Male', '2006-07-24', '20', '74', '', '20', '684063', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1744', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510004585', '11510004585', 'Chimi Lhamo', 'Female', '2007-03-22', '20', '74', '', '20', '691643', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1745', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10704001987', '10704001987', 'Sangay Tobgay', 'Male', '2007-06-22', '20', '74', '', '20', '691652', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1746', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10803001019', '10803001019', 'Pema Wangyel', 'Male', '2007-09-14', '20', '74', '', '20', '691660', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1747', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003050', '10811003050', 'Yonten Thaye', 'Male', '2008-12-11', '20', '74', '', '20', '692180', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1748', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003488', '10811003488', 'Chencho Samdrup', 'Male', '2007-05-26', '20', '74', '', '20', '692252', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1749', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Ayesha Sunar', 'Female', '2007-06-18', '20', '74', '', '20', '692268', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('175', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312485', '12312312485', 'Namkha Pelzang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1750', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11812002858', '11812002858', 'Srijana Maidali', 'Female', '2006-12-30', '20', '74', '', '20', '692275', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1751', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11507002564', '11507002564', 'Rinchen Tenzin Wangmo', 'Female', '2008-10-30', '20', '74', '', '20', '693103', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1752', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11806002020', '11806002020', 'Sonam Yoezer', 'Male', '2006-01-04', '20', '74', '', '20', '694366', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1753', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10301001764', '10301001764', 'Rayal Rai', 'Female', '2007-12-22', '20', '74', '', '20', '694737', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1754', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10701001675', '10701001675', 'Jigdrel Dorji', 'Male', '2006-11-16', '20', '74', '', '20', '695496', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1755', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808002522', '10808002522', 'Pema Lham', 'Female', '2008-02-16', '20', '74', '', '20', '697820', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1756', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11007001856', '11007001856', 'Yegtsho Dema Dorji', 'Female', '2007-06-07', '20', '74', '', '20', '698499', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1757', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11909001345', '11909001345', 'Dorji Uden', 'Female', '2007-12-26', '20', '74', '', '20', '699349', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1758', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11004002187', '11004002187', 'Karma TenzinYangkee', 'Female', '2006-03-14', '20', '74', '', '20', '701459', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1759', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002253', '10806002253', 'Sonam Yeesel Tshering', 'Male', '2008-07-09', '20', '74', '', '20', '712107', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('176', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312486', '12312312486', 'Pema Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1760', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002577', '10802002577', 'Yeewang Selden Dorji', 'Female', '2008-03-28', '20', '74', '', '20', '713866', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1761', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10801102996', '10801102996', 'Tenzin Wangmo', 'Female', '2007-08-27', '20', '74', '', '20', '716631', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1762', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805002956', '10805002956', 'Kinley Namgay Palden', 'Female', '2008-12-18', '20', '74', '', '20', '718313', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1763', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001055', '10804001055', 'Tenzin Yoezer', 'Male', '2005-07-30', '20', '74', '', '20', '507267', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1764', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11213003745', '11213003745', 'Neeran Ghalley', 'Male', '2005-08-12', '20', '74', '', '20', '507758', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1765', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11602002803', '11602002803', 'Pelden Choda', 'Male', '2006-12-06', '20', '74', '', '20', '507769', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1766', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10604002237', '10604002237', 'Kelzang Choden', 'Female', '2006-12-01', '20', '74', '', '20', '534945', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1767', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11306002640', '11306002640', 'Samdrup Dolma', 'Female', '2008-07-17', '20', '74', '', '20', '569285', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1768', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10808001053', '10808001053', 'Tenzin Choki', 'Female', '2000-12-08', '20', '74', '', '20', '601145', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1769', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002768', '10811002768', 'Sherab Dorji', 'Male', '2004-12-28', '20', '74', '', '20', '601367', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('177', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312487', '12312312487', 'Tashi Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1770', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11705002372', '11705002372', 'Pema Norbu Thinley', 'Male', '2006-07-10', '20', '74', '', '20', '662209', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1771', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11310000536', '11310000536', 'Sirijana Biswa', 'Female', '2006-07-11', '20', '74', '', '20', '662224', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1772', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11601000801', '11601000801', 'Karma Choden', 'Female', '2004-09-29', '20', '74', '', '20', '662225', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1773', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10708003190', '10708003190', 'Sonam Yangchen', 'Female', '2005-10-01', '20', '74', '', '20', '662257', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1774', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001131', '10804001131', 'Chimmi Gyeltshen', 'Male', '2007-03-11', '20', '74', '', '20', '662340', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1775', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Prem Kumar Kuikel', 'Male', '2006-01-20', '20', '74', '', '20', '663510', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1776', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000290', '10809000290', 'Choki Nima', 'Male', '2006-08-20', '20', '74', '', '20', '663511', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1777', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11102001968', '11102001968', 'Nima Wangmo', 'Female', '2007-03-01', '20', '74', '', '20', '663514', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1778', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11514005264', '11514005264', 'Ugyen Tshering', 'Male', '2007-09-22', '20', '74', '', '20', '677111', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1779', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11811003838', '11811003838', 'Kim Kim Kepchaki', 'Female', '2007-07-16', '20', '74', '', '20', '677580', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('178', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312488', '12312312488', 'Ugyen Jamtsho', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1780', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11507002254', '11507002254', 'Dorji Tenzin', 'Male', '2006-07-31', '20', '74', '', '20', '691636', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1781', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11515004609', '11515004609', 'Nima Zangmo', 'Female', '2006-06-24', '20', '74', '', '20', '691638', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1782', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502004116', '11502004116', 'Sonam Youtsho', 'Female', '2007-10-11', '20', '74', '', '20', '691659', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1783', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11806002349', '11806002349', 'Sangay Dorji', 'Male', '2008-02-21', '20', '74', '', '20', '691663', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1784', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11208003141', '11208003141', 'Gagan Biswa', 'Male', '2007-11-17', '20', '74', '', '20', '692254', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1785', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11205002786', '11205002786', 'Heman Darjee', 'Male', '2007-06-17', '20', '74', '', '20', '692255', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1786', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Karma Seldon', 'Female', '2007-08-06', '20', '74', '', '20', '692270', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1787', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002937', '10811002937', 'Yeshi Penjor', 'Male', '2007-09-25', '20', '74', '', '20', '692293', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1788', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512005609', '11512005609', 'Ngawang Choden', 'Female', '2006-05-09', '20', '74', '', '20', '692299', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1789', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11607001345', '11607001345', 'UGYEN SINGYE WANGMO', 'Female', '2007-11-04', '20', '74', '', '20', '692900', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('179', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312489', '12312312489', 'Pema Lhadon', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-05-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1790', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512005911', '11512005911', 'Kinga Singye', 'Male', '2008-06-08', '20', '74', '', '20', '693130', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1791', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806001222', '10806001222', 'Tshering Lham', 'Female', '2007-12-23', '20', '74', '', '20', '698327', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1792', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11705002431', '11705002431', 'Kuenzii Pedma', 'Female', '2008-01-26', '20', '74', '', '20', '700779', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1793', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10709004822', '10709004822', 'SeryangLhadon', 'Female', '2007-04-11', '20', '74', '', '20', '706903', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1794', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512005859', '11512005859', 'Kinzang Wangchuk', 'Male', '2008-02-20', '20', '74', '', '20', '707929', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1795', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10302000769', '10302000769', 'Tshering Yangchen', 'Female', '2004-11-10', '20', '74', '', '20', '401157', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1796', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10501002095', '10501002095', 'Sonam Deki', 'Female', '2005-10-28', '20', '74', '', '20', '405032', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1797', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Suraj K', 'Male', '2006-08-10', '20', '74', '', '20', '413920', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1798', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11102007732', '11102007732', 'SANGAY CHODEN', 'Female', '2004-08-30', '20', '74', '', '20', '445198', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1799', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11701002737', '11701002737', 'Jigme Chogyal Wangchuk', 'Male', '2006-03-10', '20', '74', '', '20', '453176', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('18', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312328', '12312312328', 'Ugyen Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('180', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312490', '12312312490', 'Sangay Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-23', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1800', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11805002709', '11805002709', 'Sunil Kharka', 'Male', '2005-09-02', '20', '74', '', '20', '488394', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1801', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12008003315', '12008003315', 'Ngawang Choden', 'Female', '2005-12-27', '20', '74', '', '20', '491900', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1802', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002963', '10811002963', 'Leki Om', 'Female', '2006-11-01', '20', '74', '', '20', '492493', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1803', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10211005466', '10211005466', 'Narath Ghallay', 'Male', '2005-03-03', '20', '74', '', '20', '492505', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1804', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11608004300', '11608004300', 'Karma MelamZangmo', 'Female', '2005-08-09', '20', '74', '', '20', '492506', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1805', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10903004175', '10903004175', 'Rinchen Pelzang', 'Male', '2005-01-10', '20', '74', '', '20', '492518', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1806', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512005277', '11512005277', 'Tshering Dendup', 'Male', '2004-09-05', '20', '74', '', '20', '498291', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1807', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11002002178', '11002002178', 'Tshering Tshultrim Dorji', 'Male', '2005-11-01', '20', '74', '', '20', '507269', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1808', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000279', '10809000279', 'Namgay Zangmo', 'Female', '2006-01-13', '20', '74', '', '20', '507280', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1809', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11811003855', '11811003855', 'Nirmala Upreti', 'Female', '2004-07-18', '20', '74', '', '20', '526997', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('181', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312491', '12312312491', 'Tenzin Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1810', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11602002924', '11602002924', 'CHOKI DOLMA', 'Female', '2006-03-27', '20', '74', '', '20', '535069', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1811', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10603002969', '10603002969', 'Lhawang Choden', 'Female', '2006-04-28', '20', '74', '', '20', '535089', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1812', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10710002646', '10710002646', 'Tshering Yangden', 'Female', '2005-02-17', '20', '74', '', '20', '559560', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1813', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10805002876', '10805002876', 'Karma Tshering Rigzin', 'Male', '2006-12-22', '20', '74', '', '20', '574329', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1814', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11505005839', '11505005839', 'Ngawang Tenzin Zangpo', 'Male', '2006-09-17', '20', '74', '', '20', '574415', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1815', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11806002865', '11806002865', 'ROSHNI BISWA', 'Female', '2005-02-22', '20', '74', '', '20', '599811', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1816', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002009', '10806002009', 'Namgay Dorji', 'Male', '2004-11-17', '20', '74', '', '20', '600904', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1817', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11203004993', '11203004993', 'Reena Ghalley', 'Female', '2004-11-11', '20', '74', '', '20', '600909', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1818', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11202005440', '11202005440', 'Suk Bdr. Biswa', 'Male', '2004-01-23', '20', '74', '', '20', '600915', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1819', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11506006355', '11506006355', 'Ugyen Jigme', 'Male', '2004-08-22', '20', '74', '', '20', '600923', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('182', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312492', '12312312492', 'Tenzin Lhadon', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1820', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11514005286', '11514005286', 'Sherab Dorji', 'Male', '2005-03-01', '20', '74', '', '20', '601333', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1821', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11213003488', '11213003488', 'Esha Gurung', 'Female', '2004-11-09', '20', '74', '', '20', '601344', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1822', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11513005717', '11513005717', 'Pema YangcheTshokey', 'Female', '2005-01-02', '20', '74', '', '20', '601352', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1823', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11205002759', '11205002759', 'Hemanta Devi', 'Female', '2004-04-26', '20', '74', '', '20', '601373', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1824', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510004537', '11510004537', 'Pema Seldon', 'Female', '2005-05-06', '20', '74', '', '20', '601380', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1825', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11806002347', '11806002347', 'Tandin Wangchuk', 'Male', '2004-10-07', '20', '74', '', '20', '655634', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1826', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10603000636', '10603000636', 'Sonam Choden', 'Female', '2001-02-15', '20', '74', '', '20', '677081', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1827', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502003796', '11502003796', 'Rinzin Dawa', 'Male', '2005-03-11', '20', '74', '', '20', '405546', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1828', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510004528', '11510004528', 'Chimi Dema', 'Female', '2005-08-07', '20', '74', '', '20', '406598', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1829', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001117', '10804001117', 'Kelzang Euden Loday', 'Female', '2006-01-19', '20', '74', '', '20', '458326', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('183', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312493', '12312312493', 'Ugyen Zangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-29', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1830', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'laythro Dorjee', 'Male', '2004-03-24', '20', '74', '', '20', '469662', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1831', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '', 'Punam Rai', 'Female', '2002-06-05', '20', '74', '', '20', '469705', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:36:36', '0000-00-00 00:00:00'),
('1832', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806003054', '10806003054', 'Sonam Yangki', 'Female', '2006-10-14', '20', '74', '', '20', '489317', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1833', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002961', '10811002961', 'Yangchen Lhamo', 'Female', '2006-02-15', '20', '74', '', '20', '491919', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1834', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12002001814', '12002001814', 'Phintsho Dorji', 'Male', '2003-03-22', '20', '74', '', '20', '491938', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1835', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002761', '10811002761', 'Kinga Tshering', 'Male', '2005-11-04', '20', '74', '', '20', '492497', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1836', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11608004301', '11608004301', 'Karma ChoingZangmo', 'Female', '2005-08-09', '20', '74', '', '20', '492507', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1837', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002748', '10811002748', 'Phub Lham', 'Female', '2005-08-03', '20', '74', '', '20', '492512', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1838', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10708003361', '10708003361', 'Tshering Yuden', 'Female', '2006-04-06', '20', '74', '', '20', '492523', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1839', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11411003088', '11411003088', 'Thukten Youzer', 'Male', '2005-08-10', '20', '74', '', '20', '507268', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('184', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312494', '12312312494', 'Thinley Chodon', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1840', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000264', '10809000264', 'Kinley Pem', 'Female', '2006-01-21', '20', '74', '', '20', '507278', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1841', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11005003593', '11005003593', 'Sonam Pemo Dukpa', 'Female', '2006-05-15', '20', '74', '', '20', '507286', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1842', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002802', '10811002802', 'Rigsar Lhadon', 'Female', '2006-01-14', '20', '74', '', '20', '507312', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1843', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11006000187', '11006000187', 'Sonam Dorji', 'Male', '2003-05-10', '20', '74', '', '20', '542599', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00');
INSERT INTO `std_student` (`id`, `OrgOrganizationId`, `CidNo`, `student_code`, `Name`, `CmnSexId`, `DateOfBirth`, `CmnCountryId`, `CmnGewogId`, `CmnChiwogId`, `CmnLanguageId`, `Remarks`, `IsNewAdmission`, `IsTransferred`, `IsRejoined`, `PhotoPath`, `PrimaryContact`, `CmnParentsMaritalStatusId`, `Address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1844', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11307001523', '11307001523', 'Shekina Lungeli', 'Female', '2005-11-09', '20', '74', '', '20', '560381', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1845', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11079000264', '11079000264', 'Sangay Choden', 'Female', '2005-07-01', '20', '74', '', '20', '575648', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1846', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11208002807', '11208002807', 'Tshering Tenzin', 'Male', '2001-07-16', '20', '74', '', '20', '577421', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1847', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10715005535', '10715005535', 'Chogyal Tenzin Dorji', 'Male', '2002-01-10', '20', '74', '', '20', '587457', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1848', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002114', '10806002114', 'Jamyang Lhamo', 'Female', '2005-11-22', '20', '74', '', '20', '600899', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1849', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11313000333', '11313000333', 'Deepen Rai', 'Male', '2002-10-09', '20', '74', '', '20', '600975', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('185', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312495', '12312312495', 'Ngawang Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1850', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11806002018', '11806002018', 'Jigme Wangchuk', 'Male', '2003-08-23', '20', '74', '', '20', '601006', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1851', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11302003297', '11302003297', 'Pranit Majhi', 'Male', '2003-11-20', '20', '74', '', '20', '601037', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1852', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10503000488', '10503000488', 'Rinchen Pelzang', 'Male', '2002-09-30', '20', '74', '', '20', '601063', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1853', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11905002362', '11905002362', 'Kinley Yangden', 'Female', '2005-12-18', '20', '74', '', '20', '601377', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1854', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003485', '10811003485', 'Tshering Choden (A)', 'Female', '2006-06-07', '20', '74', '', '20', '601387', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1855', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11102007998', '11102007998', 'Ugyen Lhamo', 'Female', '2004-09-08', '20', '74', '', '20', '601388', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1856', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11513005640', '11513005640', 'THINLEY RIGZANG CHODEN', 'Female', '2006-07-20', '20', '74', '', '20', '606446', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1857', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510004723', '11510004723', 'Tshering Yeshi Lhadon', 'Female', '2006-05-10', '20', '74', '', '20', '615928', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1858', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002173', '10802002173', 'Tshetim Tobgay', 'Male', '2004-06-03', '20', '74', '', '20', '686483', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1859', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10709005390', '10709005390', 'Mipham Wangmo', 'Female', '2005-09-23', '20', '74', '', '20', '734087', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('186', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312496', '12312312496', 'Kinzang Gyeltshen', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1860', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11209002714', '11209002714', 'Yogash Ghalley', 'Male', '2011-03-29', '20', '74', '', '20', '798918', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1861', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11109003224', '11109003224', 'Megha Regmi', 'Female', '2005-09-29', '20', '74', '', '20', '406092', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1862', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000065', '10809000065', 'Tandin Kinley Penjor', 'Male', '2005-11-11', '20', '74', '', '20', '420271', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1863', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12005000314', '12005000314', 'Karma Wangchuk', 'Male', '2004-09-12', '20', '74', '', '20', '423832', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1864', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '12002001290', '12002001290', 'Norbu Zangmo', 'Female', '2003-01-01', '20', '74', '', '20', '455462', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1865', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11909001154', '11909001154', 'Samten Namgyel', 'Male', '2005-02-25', '20', '74', '', '20', '465947', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1866', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11704004305', '11704004305', 'Jurmey Choying Dorji', 'Male', '2006-08-06', '20', '74', '', '20', '470238', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1867', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10701001679', '10701001679', 'Pema Choda', 'Male', '2006-08-14', '20', '74', '', '20', '470260', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1868', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000289', '10809000289', 'Kenzang Denkar', 'Female', '2006-02-21', '20', '74', '', '20', '470270', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1869', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002327', '10802002327', 'Pema Yuden', 'Female', '2006-08-25', '20', '74', '', '20', '476351', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('187', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312497', '12312312497', 'Tshering Euden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-01-21', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1870', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510005536', '11510005536', 'Ugyen Cheki', 'Female', '2005-11-05', '20', '74', '', '20', '492495', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1871', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11510004583', '11510004583', 'Kinley Dema', 'Female', '2005-12-08', '20', '74', '', '20', '492515', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1872', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10806002373', '10806002373', 'Ozin Palden', 'Female', '2006-03-15', '20', '74', '', '20', '492527', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1873', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11107008081', '11107008081', 'Sonam Choki', 'Female', '2004-11-12', '20', '74', '', '20', '495662', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1874', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11601003268', '11601003268', 'Karma N Choden', 'Female', '2005-08-15', '20', '74', '', '20', '507275', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1875', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002962', '10811002962', 'Kinley Gyem', 'Female', '2006-06-18', '20', '74', '', '20', '507277', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1876', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804001106', '10804001106', 'Chimi Nidup', 'Male', '2006-06-06', '20', '74', '', '20', '507290', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1877', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000268', '10809000268', 'Tshering Dem', 'Female', '2005-08-22', '20', '74', '', '20', '507319', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1878', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10502001788', '10502001788', 'Tshering Bidha Yangzom', 'Female', '2006-05-23', '20', '74', '', '20', '507320', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1879', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11803001982', '11803001982', 'Rajesh Pradhan', 'Male', '2004-06-07', '20', '74', '', '20', '507744', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('188', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312498', '12312312498', 'Tashi Pelki', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1880', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11107007814', '11107007814', 'Sonam Yangel', 'Female', '2006-03-16', '20', '74', '', '20', '507763', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1881', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11915002066', '11915002066', 'Thinley Wangyel', 'Male', '2006-01-27', '20', '74', '', '20', '508890', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1882', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11704004302', '11704004302', 'Deki Yangden', 'Female', '2005-08-04', '20', '74', '', '20', '521769', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1883', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11602001170', '11602001170', 'Kinley Yangchen', 'Female', '2005-09-17', '20', '74', '', '20', '544703', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1884', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10802002404', '10802002404', 'Jamyang Seldon', 'Female', '2006-12-06', '20', '74', '', '20', '578026', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1885', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10713003190', '10713003190', 'Kinley Yangzom', 'Female', '2005-12-08', '20', '74', '', '20', '589930', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1886', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11601000825', '11601000825', 'Dawa', 'Male', '2003-03-15', '20', '74', '', '20', '600895', 0, 0, 0, 'Yes', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1887', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11214003802', '11214003802', 'Anil Chhetri', 'Male', '2003-10-19', '20', '74', '', '20', '600924', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1888', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10804000534', '10804000534', 'Kuenga Lhendup Lhagey', 'Male', '2005-08-05', '20', '74', '', '20', '600934', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1889', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11601000824', '11601000824', 'Nima', 'Male', '2003-03-15', '20', '74', '', '20', '600940', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('189', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312499', '12312312499', 'Tshewang Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1890', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11601000721', '11601000721', 'Tshering Lhadon', 'Female', '2003-08-07', '20', '74', '', '20', '600952', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1891', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811003494', '10811003494', 'Tshering Wangchuk', 'Male', '2003-08-05', '20', '74', '', '20', '601030', 0, 0, 0, 'No', 0, 'Yes', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1892', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11502004058', '11502004058', 'Sonam Tashi', 'Male', '2005-09-02', '20', '74', '', '20', '601336', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1893', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11214003577', '11214003577', 'Sunil Chhetri', 'Male', '2004-10-20', '20', '74', '', '20', '601338', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1894', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10811002765', '10811002765', 'Karma Selden', 'Female', '2006-01-10', '20', '74', '', '20', '601346', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1895', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11512006496', '11512006496', 'Kinley Bidha', 'Female', '2004-07-03', '20', '74', '', '20', '601347', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1896', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10807002640', '10807002640', 'Tshering Yangdon', 'Female', '2005-09-11', '20', '74', '', '20', '601357', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1897', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11515004510', '11515004510', 'Sangay Dorji', 'Male', '2004-12-12', '20', '74', '', '20', '601366', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1898', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10809000273', '10809000273', 'Lhazin Euphelma', 'Female', '2005-08-16', '20', '74', '', '20', '601378', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1899', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10101005664', '10101005664', 'Sangay Wangmo', 'Female', '2006-02-23', '20', '74', '', '20', '601385', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('19', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312329', '12312312329', 'Sonam Chokey', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-19', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('190', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312500', '12312312500', 'Tenzin Norbu', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('1900', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11411003203', '11411003203', 'Sonam Palden', 'Female', '2006-10-21', '20', '74', '', '20', '610984', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1901', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '10308002372', '10308002372', 'Jimmy Dorji', 'Male', '2004-06-22', '20', '74', '', '20', '612413', 0, 0, 0, 'No', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('1902', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11008002583', '11008002583', 'Nangsel Rigdhen', 'Male', '2006-07-18', '20', '74', '', '20', '735722', 0, 0, 0, 'Yes', 0, 'No', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, '2021-05-27 14:38:45', '0000-00-00 00:00:00'),
('191', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312501', '12312312501', 'Pema Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('192', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312502', '12312312502', 'Tshering Dendup', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('193', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312503', '12312312503', 'Kunzang Pema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-17', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('194', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312504', '12312312504', 'Cheki Uden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-17', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('195', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312505', '12312312505', 'Namgay Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('196', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312506', '12312312506', 'Melam Zangpo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-10', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('197', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312507', '12312312507', 'Chimmi Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-04', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('198', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312508', '12312312508', 'Passang Lhamo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-02', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('199', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312509', '12312312509', 'Sonam Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-01-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('2', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312312', '12312312312', 'Tshering Dechen', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-07', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('20', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312330', '12312312330', 'Tenzin Thinley', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('200', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312510', '12312312510', 'Chimi Delma', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-24', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('201', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312511', '12312312511', 'Jigme Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('202', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312512', '12312312512', 'Jetsun Tshering', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-16', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('203', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312513', '12312312513', 'Nima Delma', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-21', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('204', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312514', '12312312514', 'Puenday Chhoden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-07-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('205', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312515', '12312312515', 'Rigzin Sherab', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-21', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('206', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312516', '12312312516', 'Tenzin Youden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('207', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312517', '12312312517', 'Tashi Chhophel', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('208', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312518', '12312312518', 'Tshering Chezom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-02', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('209', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312519', '12312312519', 'Tenzin Tsheki', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('21', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312331', '12312312331', 'Tenzin Wangchuck', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-24', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('210', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312520', '12312312520', 'Tshering Zeba', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-08-21', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('211', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312521', '12312312521', 'Tsheiyang Lhaden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-07-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('212', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312522', '12312312522', 'Sangay Lhazom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('213', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312523', '12312312523', 'Tenzin Norzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('214', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312524', '12312312524', 'Lhamo Pelki', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('215', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312525', '12312312525', 'Pelden Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('216', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312526', '12312312526', 'Rinzin Lham', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('217', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312527', '12312312527', 'Kinley Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('218', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312528', '12312312528', 'Jigme Kuenzang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('219', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312529', '12312312529', 'Sangay Rigden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-17', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('22', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312332', '12312312332', 'Uki Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-04', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('220', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312530', '12312312530', 'Pema Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-03-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('221', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312531', '12312312531', 'Jigme Yoesel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('222', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312532', '12312312532', 'Ngawang Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('223', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312533', '12312312533', 'Tshering Euden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-03-08', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('224', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312534', '12312312534', 'Leki Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('225', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312535', '12312312535', 'Dorji Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('226', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312536', '12312312536', 'Rinchen Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('227', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312537', '12312312537', 'Sangay Phuntsho', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-04', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('228', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312538', '12312312538', 'Sangay Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-31', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('229', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312539', '12312312539', 'Jigdrel Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('23', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312333', '12312312333', 'Tenzin Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('230', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312540', '12312312540', 'Pema Jamtsho', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('231', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312541', '12312312541', 'Sonam Dekar', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('232', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312542', '12312312542', 'Dendup Gyeltshen', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-21', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('233', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312543', '12312312543', 'Lungten Thinley', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-11-16', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('234', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312544', '12312312544', 'Pema Lhamo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('235', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312545', '12312312545', 'Leki Chodrup', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-09-29', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('236', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312546', '12312312546', 'Sonam Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('237', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312547', '12312312547', 'Sonam Tshering', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('238', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312548', '12312312548', 'Karma Youden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('239', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312549', '12312312549', 'Kelzang Kinssang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('24', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312334', '12312312334', 'Sonam Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('240', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312550', '12312312550', 'Kinley Tshering', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('241', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312551', '12312312551', 'Uden Lhazeen', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-20', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('242', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312552', '12312312552', 'Yuphel Zangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('243', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312553', '12312312553', 'Rigzon Seday', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-10', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('244', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312554', '12312312554', 'Damcho Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-03-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('245', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312555', '12312312555', 'Nima Dorji(B)', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-02', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('246', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312556', '12312312556', 'Sonam Choki', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('247', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312557', '12312312557', 'Namgay Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('248', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312558', '12312312558', 'Kinley Yangki', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('249', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312559', '12312312559', 'Jigme Selden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-04', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('25', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312335', '12312312335', 'Jamyang Seldon', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-20', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('250', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312560', '12312312560', 'Kinley Gyem', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('251', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312561', '12312312561', 'Kinley Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-31', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('252', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312562', '12312312562', 'Cheki Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-20', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('253', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312563', '12312312563', 'Karma Rangdrel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('254', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312564', '12312312564', 'Karma Dupthop', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('255', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312565', '12312312565', 'Pema Kuenzang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('256', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312566', '12312312566', 'Sherab Gyeltshen', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-31', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('257', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312567', '12312312567', 'Deki Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-16', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('258', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312568', '12312312568', 'Tandin Zam', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('259', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312569', '12312312569', 'Chandra Ghalley', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('26', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312336', '12312312336', 'Jigme Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('260', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312570', '12312312570', 'Ambita Ghalley', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-01-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('261', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312571', '12312312571', 'Prenra Ghalley', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('262', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312572', '12312312572', 'Tika Ghalley', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('263', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312573', '12312312573', 'Kinley Gyeltshen', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-17', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('264', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312574', '12312312574', 'Namgay Dendrup', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-05-04', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('265', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312575', '12312312575', 'Tenzin Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('266', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312576', '12312312576', 'Kinley Lhindu', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-05-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('267', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312577', '12312312577', 'Tenzin Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('268', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312578', '12312312578', 'Kinley Gyeltshen', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-17', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('269', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312579', '12312312579', 'Namgay Dendup', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-05-04', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('27', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312337', '12312312337', 'Karma Tshokey', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-08', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('270', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312580', '12312312580', 'Kinley Lhindu', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-05-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('271', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312581', '12312312581', 'Thukten Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('272', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312582', '12312312582', 'Anisha Rai', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-29', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('273', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312583', '12312312583', 'Karma Yangdon', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-06-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('274', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312584', '12312312584', 'Dolma Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2013-02-20', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('275', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312585', '12312312585', 'Thukten Norbu', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00');
INSERT INTO `std_student` (`id`, `OrgOrganizationId`, `CidNo`, `student_code`, `Name`, `CmnSexId`, `DateOfBirth`, `CmnCountryId`, `CmnGewogId`, `CmnChiwogId`, `CmnLanguageId`, `Remarks`, `IsNewAdmission`, `IsTransferred`, `IsRejoined`, `PhotoPath`, `PrimaryContact`, `CmnParentsMaritalStatusId`, `Address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('276', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312586', '12312312586', 'Phurpa Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-16', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('277', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312587', '12312312587', 'Sangay Lhamo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('278', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312588', '12312312588', 'Sonam Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('279', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312589', '12312312589', 'Yezheen Seldeen', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('28', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312338', '12312312338', 'Lhazin Choki', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-19', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('280', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312590', '12312312590', 'Sonam Yangsel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('281', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312591', '12312312591', 'Kelzang Choeden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('282', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312592', '12312312592', 'Ugyen Phuntsho', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('283', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312593', '12312312593', 'Dorji Tamang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('284', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312594', '12312312594', 'Yethro Bumzang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-19', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('285', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312595', '12312312595', 'Chimi Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-23', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('286', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312596', '12312312596', 'Pema Pelbar', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-17', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('287', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312597', '12312312597', 'Rabsel Tshering', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('288', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312598', '12312312598', 'Karma Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('289', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312599', '12312312599', 'Anuja Chhetri', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('29', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312339', '12312312339', 'Sonam Tshering', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('290', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312600', '12312312600', 'Norbu Wangyel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('291', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312601', '12312312601', 'Jigme Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('292', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312602', '12312312602', 'Namgyal Pelzang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-08', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('293', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312603', '12312312603', 'Tshering Yangki', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('294', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312604', '12312312604', 'Kinley Rinzin', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-08', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('295', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312605', '12312312605', 'Jigme Mongar', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-08', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('296', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312606', '12312312606', 'Phuntsho Singye', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('297', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312607', '12312312607', 'Dorji Zangpo', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('298', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312608', '12312312608', 'Yoenten Kinjung', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('299', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312609', '12312312609', 'Druku Yangchen', '4312b734-211d-4e33-9c4a-92fc89641144', '2013-03-08', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('3', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312313', '12312312313', 'Tenzin Jamtsho', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('30', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312340', '12312312340', 'Yarub Rigyal', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-23', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('300', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312610', '12312312610', 'Lhaki Tshering', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-07', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('301', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312611', '12312312611', 'Ngawang Yuden', '4312b734-211d-4e33-9c4a-92fc89641144', '2013-02-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('302', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312612', '12312312612', 'Tsheltrim Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('303', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312613', '12312312613', 'Karma Yangchen', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-24', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('304', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312614', '12312312614', 'Cheki Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('305', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312615', '12312312615', 'Jamyang Rinzin', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('306', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312616', '12312312616', 'Tshering Penjor', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-04', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('307', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312617', '12312312617', 'Rinchen Rangdol', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('308', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312618', '12312312618', 'Sonam Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('309', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312619', '12312312619', 'Rinzin Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('31', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312341', '12312312341', 'Thupten Euphel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('310', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312620', '12312312620', 'Jetsun Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('311', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312621', '12312312621', 'Tandin Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-05-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('312', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312622', '12312312622', 'Phuntsho Jigme', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-07', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('313', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312623', '12312312623', 'Karma Rangdel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-16', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('314', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312624', '12312312624', 'Jigme Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('315', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312625', '12312312625', 'Dawa Eden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-10-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('316', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312626', '12312312626', 'Jightrul Drayang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('317', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312627', '12312312627', 'Jigme Lhendrup', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('318', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312628', '12312312628', 'Jigme Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('319', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312629', '12312312629', 'Rigzin Tenzin', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('32', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312342', '12312312342', 'Aayosh Dahal', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('320', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312630', '12312312630', 'Tshering Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-08', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('321', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312631', '12312312631', 'Dechen Tshomo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('322', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312632', '12312312632', 'Yeshi Jurmey', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('323', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312633', '12312312633', 'Rigphen Wangdi', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('324', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312634', '12312312634', 'Tashi Tobgay', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('325', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312635', '12312312635', 'Pema Yoesel', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-07-17', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('326', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312636', '12312312636', 'Rinchen Dawa', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-04', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('327', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312637', '12312312637', 'Tashi Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('328', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312638', '12312312638', 'Yonten Jamtsho', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-07-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('329', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312639', '12312312639', 'Tshering Eden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-01-31', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('33', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312343', '12312312343', 'Kuenzang Dolma', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('330', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312640', '12312312640', 'Kuenga Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-11-07', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('331', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312641', '12312312641', 'Pema Dechen', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('332', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312642', '12312312642', 'Tashi Dawa', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('333', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312643', '12312312643', 'Kinley Yangden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('334', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312644', '12312312644', 'Yewong Seldon', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('335', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312645', '12312312645', 'Kinzang Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('336', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312646', '12312312646', 'Sonam Gurung', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-07', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('337', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312647', '12312312647', 'Karma Therchen', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('338', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312648', '12312312648', 'Tenzin Seldon', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('339', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312649', '12312312649', 'Yangchen Lhamo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('34', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312344', '12312312344', 'Karma Pema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-04', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('340', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312650', '12312312650', 'Thukten Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('341', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312651', '12312312651', 'Jigtshuen Yangden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-20', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('342', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312652', '12312312652', 'Tashi Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('343', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312653', '12312312653', 'Kezang Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('344', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312654', '12312312654', 'Jigme Zangpo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('345', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312655', '12312312655', 'Yeshi Zangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2013-04-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('346', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312656', '12312312656', 'Ngawang Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2013-02-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('347', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312657', '12312312657', 'Sikha Tamang', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-09-23', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('348', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312658', '12312312658', 'Tshering Wangden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('349', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312659', '12312312659', 'Jeaden Jatsho', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-20', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('35', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312345', '12312312345', 'Sonam Moktan', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('350', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312660', '12312312660', 'Jigdrel Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('351', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312661', '12312312661', 'Jigmey Tenzin', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-24', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('352', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312662', '12312312662', 'Tshering Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-23', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('353', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312663', '12312312663', 'Zeedhen Darkpa', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('354', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312664', '12312312664', 'Kinley Tshering', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('355', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312665', '12312312665', 'Karma Zangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-24', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('356', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312666', '12312312666', 'Lakden Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('357', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312667', '12312312667', 'Thai Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('358', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312668', '12312312668', 'Sonam Pelzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-01-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('359', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312669', '12312312669', 'Tshewang Rigsel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-02', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('36', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312346', '12312312346', 'Sonam Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('360', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312670', '12312312670', 'Tenzin Yangden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('361', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312671', '12312312671', 'Jigme Lhamo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-23', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('362', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312672', '12312312672', 'Ugyen Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('363', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312673', '12312312673', 'Ngawang Thinley', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-23', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('364', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312674', '12312312674', 'Tenzin Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-19', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('365', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312675', '12312312675', 'Tashi Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-10-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('366', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312676', '12312312676', 'Kencho Wangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('37', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312347', '12312312347', 'Sangay Tenzin', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-10-19', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('38', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312348', '12312312348', 'Dawa Lhamo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('39', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312349', '12312312349', 'Sonam Zangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('4', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312314', '12312312314', 'Sonam Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-31', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('40', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312350', '12312312350', 'Tenzin Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('41', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312351', '12312312351', 'Tshering Jamtsho', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('42', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312352', '12312312352', 'Sonam Zangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('43', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312353', '12312312353', 'Karma Chokey', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('44', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312354', '12312312354', 'Tshering Phuntsho', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('45', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312355', '12312312355', 'Pema Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('46', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312356', '12312312356', 'Ugyen Lhadon', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('47', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312357', '12312312357', 'Jigdrel Gyalpo', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-07-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('48', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312358', '12312312358', 'Kinley Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-23', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('49', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312359', '12312312359', 'Sherab Dukpa', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('5', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312315', '12312312315', 'Deychen Dorjey', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('50', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312360', '12312312360', 'Tshering Eden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-01-31', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('51', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312361', '12312312361', 'Sangay Tamang', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('52', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312362', '12312312362', 'Pema Dechen', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('53', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312363', '12312312363', 'Dawa Penjor', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-02', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('54', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312364', '12312312364', 'Sonam Chophel', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('55', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312365', '12312312365', 'Kuenga Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-07', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('56', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312366', '12312312366', 'Dawa Penjor', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-02', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('57', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312367', '12312312367', 'Tashi Dawa', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('58', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312368', '12312312368', 'Thinley Jamtsho', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-03-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('59', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312369', '12312312369', 'Rinzin Singye', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-07', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('6', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312316', '12312312316', 'Chimi Tsheki', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('60', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312370', '12312312370', 'Ngawang Tshomo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('61', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312371', '12312312371', 'Kunzang Lhazom', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-21', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('62', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312372', '12312312372', 'Thinley Namgay', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-16', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('63', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312373', '12312312373', 'Tshewang Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('64', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312374', '12312312374', 'Norbu Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('65', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312375', '12312312375', 'Kunzang Rangdol', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('66', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312376', '12312312376', 'Chimi Rigzin', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('67', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312377', '12312312377', 'Karma Uden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('68', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312378', '12312312378', 'Jigme Jigda', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('69', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312379', '12312312379', 'Pema Yangzom', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-03-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('7', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312317', '12312312317', 'Lakzin Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-09', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('70', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312380', '12312312380', 'Jigme Chundu', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('71', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312381', '12312312381', 'Ugyen Chophel', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-06-05', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('72', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312382', '12312312382', 'Zaipa Choden', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-05-17', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('73', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312383', '12312312383', 'Jigme Namgyal', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-06-28', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('74', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312384', '12312312384', 'Loday Tempa', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-06-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('75', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312385', '12312312385', 'Tshering Choki', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('76', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312386', '12312312386', 'Kuenga Penjor', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('77', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312387', '12312312387', 'Tshogyal Yudon', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-24', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('78', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312388', '12312312388', 'Pem Zam', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('79', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312389', '12312312389', 'Leki Norbu', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-26', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('8', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312318', '12312312318', 'Saiyoung Monger', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-13', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('80', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312390', '12312312390', 'Chimi Sonam', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-16', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('81', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312391', '12312312391', 'Ugyen Jigme', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-01-12', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00');
INSERT INTO `std_student` (`id`, `OrgOrganizationId`, `CidNo`, `student_code`, `Name`, `CmnSexId`, `DateOfBirth`, `CmnCountryId`, `CmnGewogId`, `CmnChiwogId`, `CmnLanguageId`, `Remarks`, `IsNewAdmission`, `IsTransferred`, `IsRejoined`, `PhotoPath`, `PrimaryContact`, `CmnParentsMaritalStatusId`, `Address`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('82', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312392', '12312312392', 'Kinley Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-12-30', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('83', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312393', '12312312393', 'Jigme Wangchuk A', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-04-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('84', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312394', '12312312394', 'Rinchen Thaye', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-31', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('85', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312395', '12312312395', 'Jigme Wangchuk', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-15', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('86', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312396', '12312312396', 'Jigsel Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('87', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312397', '12312312397', 'Zhenphen Yangchen', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-29', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('88', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312398', '12312312398', 'Sherab Drugsel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-23', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('89', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312399', '12312312399', 'Tashi Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-03', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('9', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312319', '12312312319', 'Tenzin Zangmo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-18', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('90', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312400', '12312312400', 'Jigme Losel', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('91', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312401', '12312312401', 'Benita Limbu', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-04-20', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('92', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312402', '12312312402', 'Yeezhin Tharchen', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-09-27', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('93', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312403', '12312312403', 'Thukten Dorji', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-05-25', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('94', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312404', '12312312404', 'Ngawang Dema', '4312b734-211d-4e33-9c4a-92fc89641144', '2012-02-11', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('95', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312405', '12312312405', 'Tashi Lhamo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-11-01', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('96', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312406', '12312312406', 'Tandin Tshomo', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-08-20', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('97', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312407', '12312312407', 'Dorji Pema', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-02-14', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('98', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312408', '12312312408', 'Jamyang Chodra', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-10-22', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00'),
('99', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '12312312409', '12312312409', 'Chimi Dolma', '4312b734-211d-4e33-9c4a-92fc89641144', '2011-07-06', '20', '22', '25', '23', 'this is a test', 1, 0, 1, 'testpathofphoto.jpg', 1, '98723144-876d-4425-a4c1-51633353e252', NULL, NULL, NULL, '2021-05-17 06:54:46', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `std_student_class_stream`
--

CREATE TABLE `std_student_class_stream` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OrgClassStreamId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SectionDetailsId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academicYear` varchar(99) DEFAULT NULL,
  `created_by` varchar(99) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `std_student_class_stream`
--

INSERT INTO `std_student_class_stream` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `academicYear`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('001b217e-8a94-442a-bc7e-4a7efd492997', '1735', '096616cb-8984-4fcf-9c5e-07713aa1c231', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('01ae78ac-fb7b-42ad-91d0-0c68a14d6014', '1728', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('01c42d55-34f1-4f7d-b687-4a34ff240fbe', '1385', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('02b089e3-31de-4d2d-9a59-762c2d7f94e5', '1782', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0340dce1-f0c7-4d2b-b7b3-785f48fce933', '1377', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('03e2c753-cd12-4b26-9e2e-bb96f2ba067c', '1618', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('042f32f7-6e44-4e98-8b49-b72be0ca006f', '1261', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('043a3f85-d491-464a-b5ea-48c5e6ad1846', '1300', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('04b72b62-28f4-4a37-a8ca-2e7e7e7421e5', '1285', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('04e09114-444e-450e-b84a-747bd598d976', '1326', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('052366d3-9321-4838-b49a-410ec87bbac4', '1760', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('06171cbd-f6f4-43a8-97e3-ce927e8ec017', '1145', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('066699e9-3ef9-4773-b491-f8b8810ab455', '1199', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('073c0e40-a53c-4ca9-8818-04dec21a14b7', '1394', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0772038a-4368-4aeb-924f-e2ab7b884c16', '1436', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('07907578-4b14-4aa1-a02b-03b7ab9f8b5f', '1539', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('07b09bf3-9551-4c7e-b1b1-063fa9a235b9', '1615', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('07ef329a-886d-48e8-931b-c5a01096eb55', '1336', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('09a4362f-d168-4005-b1fc-648eb5497580', '1592', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('09b7330e-7aee-4b42-b709-55bd88d6bd3b', '1684', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('09b7ee1f-f25d-441b-995b-cd58aa903b13', '1867', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0a1ad8e4-c30c-4ea5-9487-e60f0a0e0347', '1726', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0a4e4b1e-5d56-4508-926c-9ddc06cf34a6', '1574', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0b1bced7-f636-4b5c-b6b5-b5ad8663aa92', '1316', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0b8f5f4e-7be4-4769-b203-eca7da0fd2e6', '1700', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0bab56a6-3c3c-4999-9e13-7bfbb92f4f67', '1414', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0c0cf5fc-65ab-485a-8ba2-605b26928e10', '1256', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0c31134e-6e55-47e4-85a6-75c526511336', '1287', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e074060-4551-4476-8767-264db9a2a81c', '1513', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e4c9253-a64e-408e-bc88-7c4781a17535', '1899', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e581d2b-6445-4351-bc0f-5f3944839f47', '1502', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e5c463c-294c-43fb-aa17-e8ade51f6141', '1703', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e784574-fe79-4d5f-b9fa-66ee7b014e29', '1597', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e9af89d-cc73-4df4-94cb-c825ce464d4f', '1348', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0ec459ef-f746-42ef-aacf-2d4efa4d7812', '1604', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0eec0c21-9726-46b2-a829-ad6868a37fac', '1810', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0ef67011-1576-4ce7-b8f1-ce5b7619a9eb', '1284', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0f603460-ccae-4fcc-a80b-6c02efeab22a', '1106', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1002e52e-9c67-4c5e-9141-921bb130ca66', '1357', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('101ceae7-9b0f-41f0-8724-895be7b2ca2c', '1828', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('10726a64-965b-4306-ad4d-6df52f65c2da', '1745', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('11dfde20-5990-4a01-8710-b1a3081a7c47', '1603', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('11f4a638-a82e-400f-8a5c-325ca5f88a4e', '1463', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1231c2bd-ca0b-4a98-b122-c9b801416a24', '1731', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1259a24d-a531-4dd0-b442-ac501198316e', '1382', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('135d3145-0b0f-429c-892c-f844960f8ac5', '1371', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('13b51f80-5ab6-4511-81f4-560c59d8455d', '1582', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('13c703d9-0640-4f50-a96d-005e648ffc5b', '1493', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('141fab67-3fb1-42fb-bdae-65451aca64c1', '1619', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('14429fa2-aeb8-4594-9546-66c13c7a28bd', '1888', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1535559a-6a66-48af-82ea-29554f046f76', '1598', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1590d067-aa28-42f2-b9b0-a6908874e615', '1724', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('159231b8-208a-4a5e-8e49-143ef804d679', '1524', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('15af2673-fc2d-441e-a335-2cc91a7cea50', '1327', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('15b61296-73a3-466e-9768-22e5ab7d0087', '1752', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('16a96310-bc41-48c2-b524-bae5ba9d6aa1', '1608', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('16c7e63a-126a-4e2a-837e-85b7eb0e3137', '1544', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('17056301-4773-4b33-9a67-6e61ad776fdc', '1346', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('173f5d78-8929-4ed6-84f1-e9cc60ae1325', '1176', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('17ef1c9c-c7b1-4f21-8acd-ea12f83ad183', '1232', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1823aae2-86c2-47dd-a18d-ab46582339fe', '1309', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('18ff5b37-ffcd-4fb4-b3f9-1dbdd64b6cd8', '1560', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1975b054-dace-46c6-afae-4cba372b3023', '1789', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('197e347b-23ab-403d-acf6-2dab1d2df555', '1362', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('19fe7da0-ea90-42a1-a3da-d07dd6a0609d', '1741', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1a355c53-733a-4dad-b4ea-6bcde1c5781e', '1314', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1aac2208-8435-4e02-b879-8d8d74618db9', '1750', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1ad50755-da92-4d6f-9bb9-72e81317ba95', '1687', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1aeee824-18d5-424c-be2a-9a230ed301d6', '1505', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1b5977bc-7622-4d88-83f5-feac0b9326b8', '1538', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1bc2f2db-069e-4c01-b629-7d75b906b29e', '1122', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1c2da722-49ec-49e6-a1e3-16b3ca4779d9', '1229', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1c3679d2-8432-4b5f-8294-a683d14d826a', '1857', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1cb4be8d-2c32-4bd6-ab91-4f02af5386f6', '1319', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1ce5f332-2975-455e-8525-dd04570faac4', '1638', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1cfb2c33-1a7b-49bf-b515-5236c032280d', '1733', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1d0fbbeb-0eb6-4032-89c5-5dbae0ad82a7', '1600', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1d5a3ea0-fef7-4ffd-b983-9128cf384ff8', '1521', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1d718c04-f070-4fbf-8674-a57633199f38', '1572', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1dca2a73-c195-488d-86f4-a3d0f5bb30e7', '1763', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1e3cac0f-d2b8-4b4c-8dba-87940d8dcd0a', '1129', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1f7b5a7c-68af-4693-8019-aaa73da018eb', '1169', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1f875709-c3a0-498f-b3f6-624240d145c4', '1669', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1f95bfa5-97c8-41f8-9bd6-0cd3cd39dd7a', '1519', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1fc363f1-377a-42cd-9b04-27986f14f799', '1471', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('200c2e90-6ef4-4818-8d72-7c7c0c6533ee', '1853', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('202d0aa1-b8ce-4631-860a-7ca88dbb8817', '1637', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('20549240-fd6f-46e2-818f-04d536cf5700', '1596', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('207f6e7f-ec1a-483f-a472-5922dba89e88', '1711', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2093caab-81c1-4c70-a9d2-d71b6c5ed394', '1324', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('209ff9d1-6326-4085-8e3b-a7b87c038e91', '1097', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('20eee4d4-7338-4d02-8b94-ee6a5ce06209', '1529', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('21207ef5-6668-4970-8c9a-6620d3b81e15', '1136', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('21aa5128-e7da-4bc8-93c4-f81eba1f77ab', '1835', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('21c17e64-d85e-4a34-b9d3-d8fb7c52255c', '1483', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('22161b09-dba3-40e0-9024-6f9dbd07a643', '1184', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('221b0c07-69f9-4ba5-ac0f-cce6574165a7', '1482', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('236a1322-e861-4779-8531-85f4d87aad95', '1181', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2385e47b-f0e1-4a22-955e-eb89b2ba17fb', '1528', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('23dc3954-e34e-4983-8c37-22827e089297', '1832', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('23dfdc18-d9ad-4dca-9662-cf8fa792997f', '1441', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2406b684-7ce9-4e52-9749-b07b6ee31f22', '1310', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('24097ca8-6e55-4a90-9724-b312b18cd3b2', '1220', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('240f4f35-596c-406a-81f2-828172176157', '1182', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('26445f55-dbad-4955-80ab-a45e7246943c', '1533', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('268c37a0-37ee-4e43-8244-b2fd1922c03e', '1264', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('26b0c42d-622f-4577-b899-91c9c9cefd88', '1226', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('27bd4bd8-d48c-45a0-9450-6f6dee1d3a6d', '1807', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2815cbff-0163-4a28-acf6-fa0314883cb0', '1522', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2816d50e-20bb-4f7e-9680-369afc545d43', '1751', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('28cc9a24-287f-4e5a-814c-cad37282a98c', '1688', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2945f2f3-7f9c-4f60-951a-5a9ecfb3999f', '1765', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2991ab08-9147-45bc-b8bb-0cf2ee8f45b8', '1054', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('29db32ed-4bc5-47e6-bd06-084675606bd8', '1878', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2afa240f-5691-4c19-b147-04c482aeff19', '1416', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c16052b-3213-4ea9-9ebe-bb39b24778d2', '1685', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c16fa6a-2ce9-4e0a-90ad-932cf801eb80', '1161', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c1988c7-32e7-4f68-b31a-5e81486f9e93', '1313', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c6ac560-2d3f-4fe0-8f46-b740289c96de', '1770', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c8e1c71-d01e-4193-b570-becdee0b0459', '1111', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2cb5bc44-8162-4714-bc47-b6a775a89415', '1127', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2cdd8efb-1051-4aac-b772-cbf3d58c067d', '1720', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2d0f3e89-4c26-4b38-8ca2-303e310ccf72', '1718', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2e5debcb-d4e3-49ac-9db7-05400e11fb29', '1556', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2f6c01a6-9e4e-45cf-b2ba-05d6517807b0', '1856', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('309f6422-467e-4264-97b1-fd8205c116b0', '1872', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3157401e-004c-47b6-8a61-cdad8af85fba', '1218', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3215fbb0-7563-46c6-af26-d55ff25504e3', '1387', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('323c9600-4fb0-442d-9567-feaf93adfa7e', '1141', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('327ef611-ea2b-4d26-9181-2c5ef0dc7b1a', '1701', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('34c50933-3312-413f-9de0-024d4d2d3236', '1635', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('350c2444-04c8-4d8f-b511-03a0d4c5a2a9', '1613', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3515bc25-6570-40e3-9a6b-546386a6ac11', '1388', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('351acf0e-9171-4790-abde-37439ed3b8fa', '1096', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('355e6025-d4f9-46cf-85df-3841c094abcc', '1418', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3607ff26-5e0c-4aaf-b42d-f5318f0df21d', '1526', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('36b5cee5-089b-4e71-af5d-8e589c119964', '1866', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('36f2e6f1-aef3-4744-a126-153cf056ed69', '1699', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3734305a-f202-4097-aea2-ca9326604d04', '1610', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('38e4567c-b982-4279-b065-9df5eacfcfeb', '1606', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('38e47171-bab7-4b03-8bed-2413a3c20ac6', '1217', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39212276-6660-4eb1-b4a7-f9f08e415a56', '1497', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39237f1d-e073-4a37-88fb-72bbdc8c854f', '1468', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39b3c1ae-fa92-43e1-abfd-21c269a015f1', '1472', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39b6a052-5fc9-4212-9c91-edba1871e465', '1813', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd8', '4da9d182-6f65-4d7c-a097-67c8924c8202', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39d73e8c-db70-4b64-9eec-3aff48ff158d', '1355', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39ef2d30-64c6-4262-97da-73e182b282db', '1268', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3a92bb3b-c8de-4ee7-bff6-c9157e33499f', '1269', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3ad3130a-319f-4a44-84c4-a0a33cdfd24f', '1511', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b286e87-8cdf-4cba-ab66-4069100b69ad', '1430', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b2c900a-6160-4925-b5e1-1c0b92d54eab', '1642', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b4d85af-a6e4-46d7-aae2-cf9977338652', '1885', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b594cd3-2e44-4bed-a818-4640370ce5aa', '1424', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b608951-e04b-4c8c-9736-096d27657373', '1194', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b6105c0-2bef-4f79-9742-896cf619252d', '1839', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3c7cf389-efed-4f15-ac9b-24b727841ea4', '1557', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3c7e7e62-a6cf-4e35-9f58-a6f621186ccb', '1263', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3d108a34-40c7-4d0b-ab9b-cd3b116e9dff', '1844', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3dbbb718-8775-4951-9ae6-e75603df24e7', '1706', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3df7a82d-bfc5-406d-b1f4-79c55eceb1d6', '1516', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3e1c2ca7-b61b-4339-81f1-29b36356fc6a', '1815', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3e2a04ad-3e77-41d6-8541-f63e1b549f44', '1474', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3eafcc27-8420-4214-b84d-ebc2ea79f694', '1695', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3f4b0bbc-9038-4a50-975e-5041bbd4dd9e', '1283', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3f53872c-73cc-49e7-a632-cbdd7c012cb1', '1554', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('40a7d7a6-22fe-4f36-836f-714d0cc01044', '1793', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4111105e-16b3-4e2e-b326-148c655981c8', '1473', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('411bc447-c7ca-4dd5-b8a3-bb9bf1252be0', '1455', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('41bcb209-ce37-4619-a122-3106adece002', '1692', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('41d92839-53b1-48c9-afd9-9e1a2fc9e577', '1773', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('429a1762-65f8-4143-b4f9-c3b5aaee14b8', '1621', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('42ade444-eedc-45c0-beef-9b18795c2f71', '1360', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('42ee23e6-dca3-4a3f-a869-65cb70fbf6f0', '1193', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('43b09dc7-8007-416a-bf9e-f0a2491d7b6c', '1443', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('43edeb13-bc57-4147-8609-0523e7569e1f', '1460', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('449cc9af-b9ce-443d-812a-3b2b2a241ec4', '1707', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('44f17f4c-c009-4de5-a6a1-0126a4c0697a', '1671', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4564f25a-04eb-4d60-aefa-a7416c29b587', '1495', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('457c0bbf-cffe-4d32-858c-bf4a78ea2046', '1657', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('45a56a83-7bdc-44b7-b8d9-1880db982673', '1374', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('465489f1-5102-468e-9639-488bade764bb', '1797', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('467d6d23-ab76-48b4-829a-a0dc01fa776a', '1579', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('46a90093-02e8-4767-9c34-208ad29722b3', '1466', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('46dbc2e0-d7aa-4747-9636-40ffd9067b4c', '1391', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('46ffdc69-4f66-47f2-9df0-e58478faa1bd', '1525', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('471ce607-43b8-48d2-be33-7c5d46ac9766', '1689', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4781be26-5666-4e01-82f4-cfb2365f061c', '1340', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4785a359-9793-4492-a5be-bfa522afc2bc', '1481', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('47fa9b31-c204-4564-b79a-ddd3c6ab6121', '1448', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('481d9eeb-70f3-4715-aaea-edb09a90946e', '1833', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('482b2f4a-d5b3-4e2b-893f-ecdec6b1f64e', '1440', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('488f3121-7c20-40e5-bd0d-57e983ab18dd', '1407', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('490b16d6-8e38-4149-af79-e3fb2b6effbd', '1109', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('490e4f33-4db8-418c-a8d2-89adfb015f6a', '1139', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('49295f76-b25e-43b1-b0bd-b3813f3c8620', '1205', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('49d4c369-7aeb-41a5-9333-d2609490f328', '1405', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('49dbf65d-99ce-4aa1-a4ab-8f624fe8f0c2', '1842', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4aa5efa4-b651-443f-a50d-f121d8b0220e', '1601', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4b1a0a51-08d6-4e8a-83a9-e4009b4eb276', '1249', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4b2650ff-d6cc-49cb-95a7-4e9338bfa1d9', '1082', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4c60dcc5-3053-4992-8a13-9ce3ae275ada', '1736', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4c722a3d-2c32-4018-9cd6-92339be6a7da', '1461', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4cb82278-4cba-43f1-8eb1-a7a4a9eab0c7', '1614', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4cdbd8c0-60c0-4abe-af27-4a5d338b4ed9', '1104', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4d37f79a-b239-4be9-af71-06bf523e45ef', '1650', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4d9828f8-d24e-4d52-a40b-d87ed57adcc0', '1366', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4d9a2705-0cda-4d76-bc4b-e73b257fa733', '1498', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4e042a0d-fade-4bfa-a131-9f0c05b8aa8d', '1166', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4e240cfe-15c2-4c2d-aa35-6061feb7afc3', '1147', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4e738246-6413-4909-9862-8f04bc815de3', '1800', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4ebf7f55-fa7d-4197-a941-f6a9e8d2a4e2', '1584', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4f493da7-4e12-4600-9060-9d401dfd9fc3', '1576', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4f522799-a357-4290-9d6d-864c8175459c', '1328', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4f6a4cb0-008c-44c5-922a-47676e74c746', '1260', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4fcd2455-ac1c-4e56-a928-f2c5ef08f652', '1758', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50079649-467e-4339-98df-028776d11f5b', '1607', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('503577fe-8f17-4134-ad06-791b6a096ce1', '1892', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50cbfb5d-79e8-4c17-b511-c38fd312acf7', '1084', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50e4e286-ea20-40d2-9ad7-c8fb68b344d6', '1787', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50edad06-a45b-4e76-8ab8-c56f51211ca1', '1299', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51392b55-d725-48cc-b65c-a54b7ac643cf', '1267', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('516035f3-7ebe-40aa-9065-06e15f9d0e06', '1503', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51b8d85f-d259-43dd-b4a0-9eeb45843a9f', '1433', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51d9b986-c70d-49b1-aae3-64da06359215', '1173', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51e763ef-35d0-4054-8935-c1a308b05096', '1490', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5248ae9c-3c84-4bda-a724-bab89096707d', '1105', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5298d4c1-3176-42ce-92b6-4fbe741d6f80', '1338', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('52a594df-f852-4a6f-8809-87ed97796fe4', '1739', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('532086b4-6944-459d-88be-8d5b4f2f910c', '1581', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('53260186-c501-4b3f-8b75-c2f61e85bc1e', '1532', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('535acb2d-11ca-4c20-b92f-8b4728cfe508', '1411', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('54240fd9-97b2-4e45-81e6-de9d0ddc83c7', '1183', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5424d908-a9cb-4a0c-91c5-ab0a3a7fd683', '1237', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('550092f2-053c-4f02-add6-164a0128ec60', '1777', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('552081df-c5a8-4580-8c80-f751410cedfb', '1437', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('55656a8e-5330-4f3c-8058-8b9421da64aa', '1150', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('556d4d49-3d0b-4fa2-b758-6f0f0a405739', '1112', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('55ab26a6-1801-4835-8dd6-a1b8cd3aa063', '1646', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5672ad8c-27b9-430a-900d-3d81ba48129f', '1491', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('567d2298-fd95-4a92-88b3-2518e080cb43', '1827', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('568dc0cd-61b0-43c6-aa1c-09f34352eaa5', '1520', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('572339ca-bc4f-4443-afa2-1d27d03e91e2', '1877', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5780312d-56ad-42c1-b592-8dd690118e06', '1791', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('57c0646b-f372-4c32-a155-3fd7af853699', '1075', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `std_student_class_stream` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `academicYear`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('57e039e1-314a-4f8e-ab70-42c181fde30f', '1116', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5816ccee-5211-415b-90f8-fd32647c287b', '1434', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('583cc260-2c51-4842-b1d5-d059c803942a', '1559', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58aa5323-dff6-4e15-92de-7d2d8e2ff48b', '1767', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58b032ae-2cbd-4c9d-a8b2-bbdd579303c3', '1476', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58c66e14-89b5-4f1c-a131-7c7a3d2b268e', '1277', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58caea2d-697d-4d7b-b73e-b6476a7e0380', '1137', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('591e7bc9-d058-429e-a359-bcff2d0529f6', '1390', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a05aafb-15a7-446c-9375-83d4ceb98190', '1152', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a107ee5-45a6-44c9-83ce-207d5ca28b84', '1710', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a314d0f-d3ce-4339-8dfd-876db5e56d01', '1742', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a9f3752-78b1-445b-9aed-506f1308cea6', '1242', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5afdece5-4a12-4b87-847b-08a3f6946ec4', '1216', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b1fc6ba-afce-421f-b85a-e017ef49d9d7', '1334', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b522642-f591-48f8-a2da-c97d84d70ca8', '1295', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b67cf32-5b03-4250-926c-1cafeff93b23', '1246', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b9e84ab-7e5c-4b0a-9545-f59029c706a2', '1884', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5bd47911-4cea-4c4f-9d18-f0501dd3f67f', '1713', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5c8aea99-4cad-494a-a482-459f5cfa15ec', '1515', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5ce2741c-c960-4853-a87a-0237b4253b27', '1727', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5d005902-9da8-4647-a9a2-6a1c57100083', '1409', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5d1eba98-d652-49e1-989e-a0be4d169d2d', '1248', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5e1a80fa-9cb0-4348-b08a-f63623a1aa69', '1445', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5e8f6810-6b8d-4762-be2b-ebde36be7fd8', '1664', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5e9dac36-8927-4d60-9bc9-a9f22fd3b35f', '1716', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5ecb0a06-eb1d-4ccb-99fb-efbea2912d86', '1898', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f03fd8c-3d73-4bf9-80e4-8c848d116a31', '1605', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f0721c8-bded-4fcd-9829-22c6184596dd', '1636', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f501a82-28f9-4695-9a58-7c241b1798d8', '1160', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f8a6f77-f52f-4cc7-88a8-79f72a40dd05', '1729', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5feda0a9-54c1-4a44-95fa-f62544bc26dc', '1130', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6005d1c5-8426-46f7-bc84-4ce8e6abb4f8', '1780', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('605c7609-607e-424a-9afc-75b5599facbc', '1410', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('612765f4-8359-4ff0-9a30-d4e112bed9df', '1413', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('615ae683-9819-44db-8490-ecdc666de279', '1508', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('622315be-cb20-4ab3-906c-3402d0175404', '1447', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('631a266c-6b15-4141-bc94-6b7ae423212e', '1255', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('63803d14-6127-4f75-a68a-2614c2191ead', '1321', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('639c6683-df6e-46b0-a764-208368ae9556', '1641', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('640b9f3e-b082-47d3-bda2-af47ce3e33b6', '1746', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('64187a3d-df2f-4ac7-a51e-3af675e1724c', '1179', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('64d7cc78-e83f-4d1b-88d5-f628abbdd9a6', '1585', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('653d0e34-5484-4958-ad9b-59c9bbff85f6', '1792', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('65c9bdd3-67f9-4885-ac71-6db3dc018693', '1467', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('66a8a369-5fac-423f-8b88-f305fde5e6ee', '1667', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('66d69df2-30e7-4de0-89d2-8f2c0989af55', '1144', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('66dd2801-d35f-4e5a-98cd-b158a48fbc62', '1721', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('673ba721-cf3b-4f1b-9b9e-a7bafe4ca01c', '1779', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('673d02ca-d70b-4b68-afeb-240353d4dae7', '1262', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('67905aaf-c5d1-4c61-9cc5-b5394fbfd152', '1185', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('67c11865-62b2-4eec-8303-2aa4dab4bf69', '1624', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('68032467-0aed-48fa-84c5-ae05221872bf', '1881', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('685a837a-5ae2-4f25-b3d2-c33ddff79309', '1329', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('68b0426a-ad8a-4184-80e9-754256b2ad22', '1550', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('695edbf7-c57e-469a-97f1-de56588e9795', '1379', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('697c6d70-9f23-42d3-aace-a8ccaca46442', '1117', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('69d5db92-3257-4bbd-8640-5995e7f08a93', '1401', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('69e10052-fa7c-448f-805f-54764d9e0b8f', '1134', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6a02aeb4-1f3f-4d00-98a6-e4b095bb210d', '1722', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6a53a2f0-a877-4fe2-b772-4379d67814f3', '1439', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6a6344ea-99b9-4e91-833b-26ece365a9fe', '1762', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6ab8bcf9-c8c9-4c00-9e1c-05395081c6a5', '1702', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6af80de2-3725-4716-9ab9-ca4f08ae721b', '1462', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6b5047dd-865c-4705-9174-91c1b09bfbcf', '1438', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6c1f7ecc-0e8a-4114-a1aa-9ff664433293', '1496', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6c587180-3745-47a1-a047-d894e72248f7', '1274', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6c6ba16c-9d74-4e73-b4a3-8a2b56f405cf', '1737', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6daf43e8-7e09-434e-9f3f-85272b3a922f', '1307', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6de273fa-3200-45a8-9c1c-200a9936fcfd', '1172', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6de7678f-a785-4ee8-9036-5a8a895414f1', '1219', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6df31b5d-a112-43b5-bbec-75f9c4d055a9', '1552', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6e17d1e6-9ca9-47e4-ae71-542ab59bbeb4', '1373', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6f104d27-135b-49c6-80a0-a7585e29fcaf', '1479', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6f95dae6-b9a6-4eee-a5b2-3329a952efad', '1235', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6f97405e-2a68-4199-a1c7-c56a420dbd02', '1331', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7001688f-c9ad-46b3-8927-70b0b73548a4', '1186', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('703d978f-9e88-495b-aaf1-d95562cc8b55', '1583', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7049e856-eac9-487b-8b28-1fdcb369200c', '1164', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('70a53a80-90c2-412e-9963-59bffdfa32dd', '1124', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('70ec6825-960a-4fdd-8880-ca6f27eba55b', '1417', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7153485b-b4f0-4ef2-9b2d-7019041bde16', '1342', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('71c26c01-1077-44f1-9f58-77a5669047fe', '1794', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('71d6c911-5346-4138-b12a-a4a030c7c8da', '1634', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('729a516d-4c96-4137-865c-b9cc95789cc2', '1882', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('736c7c74-17a4-48b9-9d5b-a40af20feac2', '1377', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', '6a430904-c901-47ad-b351-3b6cdd95617b', '2021', NULL, NULL, '2021-06-09 10:29:56.000000', '2021-06-09 10:29:56.000000'),
('73fb88d2-bfdc-4243-81c5-db22f4cc319a', '1133', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('743dfd2c-aa7f-4302-80d7-4ffcc292d1c0', '1198', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('744e1170-a027-48d7-a32d-f7685995739e', '1661', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('749358ed-0c8e-4b2f-a468-2340d5fb75ba', '1785', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('74a16c05-0703-47d4-b013-e21dfd06c17b', '1523', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('74c49725-a579-4ac0-a0d9-46d6365ac9b9', '1804', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('755a0fce-55b0-4cd3-bb46-42ccad992a78', '1279', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75839a04-b094-4b78-933c-13c619928910', '1868', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75844b2c-4ce0-44c3-96ec-011cee8f74b8', '1871', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75949488-38f2-4cbd-a2eb-13f9976b15b5', '1095', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('759c6b2a-08e5-43b8-b33c-6069d477355d', '1110', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75ec0d71-cf7c-4aef-9bbe-81631f2a3c33', '1676', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75ef4871-1251-400e-afe1-55f3bea04c72', '1705', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7626ba0f-2da6-4364-a3ed-128b13a23200', '1423', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('76f0c4f5-765c-4fcd-9512-24e5be976cd5', '1168', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('77c7d70b-e062-4281-a7f0-c8cd6568328b', '1778', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('786d77ec-6af6-4776-ae33-f346bc9af75e', '1643', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('78bdb8d0-af77-45dd-86c9-acb5376241e0', '1536', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('78ee91f3-47e4-41ae-a51c-14903c166746', '1775', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('795c9ee7-fae3-47e1-9c53-fbe848082d89', '1393', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('797e5928-7c1f-41f4-a6cc-dd8bdf3b95bc', '1653', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7a4e2868-48b7-4a51-add5-ec5184295a6c', '1398', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7b34c7d5-d057-4c86-bd5f-bc11a186b12a', '1191', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7c690ef4-5e7b-4aab-892c-888ab392bde5', '1347', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7c6a6d56-b771-492a-9ca2-aa590067d255', '1568', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7cc4306d-5bc1-43cd-8320-bfbaa5e80f4e', '1222', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7d3f7397-d391-4819-9f81-fcdd4c313aad', '1213', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7d7ce568-025a-4618-a213-8cb0e33be7d0', '1694', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7ddde03f-6356-4f49-8c99-20aa024a6b3b', '1639', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7df90339-91a7-4a47-8a30-b5e56ead713d', '1862', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7ebf90c0-2058-4a81-aee0-8aa576ef9cbb', '1311', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7ee6ec3b-1500-4378-a27d-39abab9d1a14', '1432', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7efd8b06-3322-47fe-bbb2-42fa66881b75', '1132', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7f0af6f8-bc5c-41ef-a2f3-5e3442dc2289', '1561', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7f326384-3098-40e2-8de7-76f9d9c8f472', '1369', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7f3f8aa5-5ea7-439e-8e44-6eaf5f0f087c', '1367', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('804e46e2-d18e-4f5a-9721-00b1ff88a804', '1478', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('80920309-8aa5-4b2c-bb42-f826562709eb', '1254', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('80b881ff-e7d6-4b58-bbbc-4c25b7072129', '1704', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('810ad00d-e838-46a0-bc9d-486cd13f5552', '1201', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('811af3af-b9de-4638-ac5a-ab25c8e53fa2', '1518', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('81204a51-cbbc-4d4f-a8cd-551b4c992887', '1626', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('81e699bc-9f63-4282-8726-447ef33fe237', '1534', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8212cfcc-c20a-4ba8-9d23-d655a46b245d', '1456', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8225565b-5e05-4642-a415-98ae87a71048', '1617', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('822e2db2-e603-4acd-93f3-39ea5fc2a224', '1540', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('82b4f6f6-3f2c-433b-b585-d2fdc2165a47', '1196', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('82d32161-03c4-40f8-8bca-02bff0d0e9be', '1900', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('82fdcb0a-9550-4feb-a509-603d84b2541f', '1484', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('83e2592f-2a67-4699-bd89-96998a4b0181', '1221', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('84448f9a-4f1d-4a23-9ae5-895bfe6ebdc2', '1510', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('846c0489-95f4-47b9-b9e4-28fe3b558036', '1620', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8471e324-67c2-41be-80c5-3cbd0d2a5915', '1894', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8490f66e-be32-4cca-a773-86dee5b24887', '1558', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('85495191-a4eb-486b-958e-453c55a30599', '1158', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('85b44688-a580-4c49-b3e9-a08514450ae3', '1211', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('85db5776-03cf-4894-a5df-8840ade69cd7', '1570', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8723febb-2f99-4a7b-8114-3df384afc55b', '1361', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('872c342b-286b-41bb-8462-aa185e8aa232', '1076', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('876aaa0a-192a-4984-b87c-35de8ceded3f', '1259', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('87e52219-a1f9-4795-940f-a7de6e854523', '1630', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('88224eec-cd88-470b-9f80-12913a6cccb5', '1453', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('88fb8094-ca23-4668-9862-266dae1e8f7f', '1837', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('89527914-ded7-4d18-9970-ceb4ab212c0c', '1747', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('89918f56-95aa-4b48-a210-db57a6290047', '1294', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8a006a56-8296-40dc-9725-0f8841144c0b', '1247', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b16afc4-ed81-4c13-8f1b-9e2c38afc6b6', '1593', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b4a4b1f-748d-43a4-87dc-426dd9dedd8d', '1368', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b6b90cd-68d6-4e53-a4c9-ffed07954faa', '1696', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b7f4646-1cbf-419b-b2c0-542d45203978', '1397', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8bbfdb50-7ffe-4797-affb-443abe48399c', '1119', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8c2f9756-d0ba-4a57-a8a6-22c38c96fa9b', '1276', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8c53c2f9-cff7-462a-8ed8-4768ee7108b8', '1154', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8cac67d2-80bf-4b3a-a578-e785b07e094b', '1719', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8d29aa7b-35fc-42d2-bc9a-8786902fb0ec', '1754', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8d344b09-8d71-499f-a7a4-b2ea1f5cd64f', '1623', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8d8329f2-f5b1-423b-a7fc-6ac7eb33845b', '1814', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8dc0edc8-bf27-4397-b97f-87f44b67aeaa', '1296', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8dce3ec2-dca4-4c68-a589-75bd3f0878fb', '1808', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8e2aceac-ca62-452f-914f-0be4d7b37a86', '1537', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8f101279-d5f1-4b2b-8884-e4b34f95ff41', '1157', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8f111de5-e91e-4d69-809e-9d2c963cef77', '1783', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9004a617-4d2b-4d04-8dbc-007ac8e2a7cb', '1200', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('907588c1-50b5-4906-ba05-b4aaa5928232', '1633', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9097c620-d948-4141-af2c-32f7823df5e7', '1609', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('90989667-7606-40b9-a6b3-1665b6879f2f', '1171', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('909ed0d5-aa40-4bf8-a61d-14af4d4d03a3', '1227', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('90cf469a-bd43-4862-bc45-dea3de13a9e5', '1715', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('916f9d43-b387-461b-b53c-1d13b9b6b353', '1786', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9184f60f-2109-47e8-88a6-f786e7a62417', '1870', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('91ab8ec3-8e33-400e-997e-09c78947f8df', '1378', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('925e0754-8061-43a5-b75c-ce41625ea3ef', '1165', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9291aab4-4183-4736-aca1-2286dc3d57ca', '1628', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('92c0ddc0-4f3e-4dd9-ab31-68109e4b37db', '1764', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('931103ad-acb9-4a16-aa31-6b55d3d820d8', '1799', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('931971e2-11a4-4457-b39e-b707009d28e0', '1682', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('93b01f00-4010-41df-85f7-68f3dc84f186', '1128', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('93fa08bb-148f-4998-ac23-6e8bc7a7ed7d', '1469', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('943a0768-aa0c-4d1b-94b4-0b33d2d1a8fd', '1587', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9452915b-99f5-4234-99d3-b4171310d891', '1674', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('94867e00-ffa4-40dd-aba2-b47c2a61ff76', '1845', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('948e6420-67d1-4d62-91fb-1adbab2a0cb1', '1564', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9512114f-3932-4c8a-969a-33e55203cf09', '1761', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9535e075-e8e6-4dca-9ae7-1ef6b9218bdc', '1678', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9580c845-c541-4017-9d2a-4c6ab4993195', '1389', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('968e5f11-3e8c-412b-bc13-6d88a1485245', '1192', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('96a9c556-01ce-4696-aa8d-2e62af82958a', '1308', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('96f082c6-94bf-41ff-974a-c6ff8f3433ac', '1861', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9785c54d-4096-4a51-b276-58258819458b', '1465', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('979335bf-b113-4aff-9d69-25a89af44685', '1709', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97a1f896-8179-46dc-babf-65f819af0aa1', '1547', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97c64c35-02da-4e12-8fdd-b20208f54263', '1670', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97d4a6bb-6201-474d-af78-df9d5dd830ec', '1488', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97f98d2a-3577-4d27-b26d-84bce20e66f4', '1507', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97fbd170-2459-4f92-b4e3-e858f022c144', '1683', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('98289d21-64e7-4083-a31a-39f2856face6', '1756', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('98818c03-cb20-4e62-9c58-934f828c7a50', '1225', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('98cd19f7-97b5-4be8-8090-05a0707b4b3c', '1450', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('99db430e-f001-4cbb-b159-615ec0c71af0', '1320', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('99ea0888-f64c-45f1-ba23-9c893aa3bbab', '1190', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('99f22ad8-380c-41e5-a51c-2d20f7024235', '1567', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9a0f2dc7-6e89-49e2-a716-35dfa1b4cc64', '1883', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9a765a09-6dc0-474b-8104-9c9cc7b231df', '1126', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9b2ed4c7-0296-4499-a1c1-1c0945a5e9eb', '1836', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9b95426c-e739-4c23-987e-49db8d71bd97', '1155', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9b9e956c-d21e-4ca7-88c7-ecc04f53fe96', '1691', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9bd247a2-f6c9-4084-af8d-9dc91387329f', '1594', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9be36904-5bd2-4ee3-9f9f-f5755123da90', '1796', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9c8cb255-4fcb-441e-8cab-92e81820d418', '1207', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9cbc1f8e-c770-440a-944c-97ea9ba09ebb', '1113', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9cd67e52-bbac-4674-be2d-f3d5dadc0fe1', '1400', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9d6b00ce-8326-4ae3-8494-229b14a9db55', '1233', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9d6f420a-bed2-4741-a98d-e12e7a36f7a6', '1228', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9dceaecb-e188-462d-ae6c-0038082a5ffe', '1677', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9dfa5498-1515-4549-8bbc-ef1f9d41674e', '1153', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9e06e105-de21-41aa-84d9-16ec0fa59e65', '1690', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9e5cf128-633e-4a0b-81d1-ff3ec56e15fc', '1865', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9eb07478-d095-4e98-a87d-209b3e0cbbff', '1545', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9ed98ec0-f1fd-443f-86fc-7b832fde5028', '1652', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9f29ee1c-e043-45cc-8d37-c4db0dff9323', '1659', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9f53ed49-5cbf-432b-b8a9-69b1a8f6a863', '1257', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9fab3f6f-6847-451b-9aa3-9dc61677aa7e', '1288', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a01a9ffb-dc29-4838-8581-b6fe2367faa8', '1590', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0358171-4400-4dbf-9ae4-b0ba606f539d', '1781', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0abbf02-42db-4ecc-867b-2acd58098af0', '1477', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0bcc285-b2ff-4fe7-86ff-fd9f88386c9a', '1551', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0d8d7f0-9720-4587-9679-174272102752', '1656', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0daf630-45db-43a9-a8ad-31349d4c0bd1', '1697', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1495693-8580-484c-9591-82f2cd78f74e', '1177', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a152c5d9-2171-4fff-9a8e-4fec4fe6023e', '1734', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1a372c1-4cc1-40e3-a2e4-819e5753dac4', '1776', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1c477e0-eb3b-4292-a1a2-3d995a7c80c7', '1755', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1ef5b96-d646-40d5-855a-ad17c36bed36', '1457', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a234a8a0-ed23-4552-863c-c0312e15feb5', '1395', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a3478075-e311-42aa-9b01-6b87e328bd9f', '1788', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a4220c17-ad65-4f85-9419-026f876c0dee', '1240', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a4366a0e-949a-4155-9239-8095dcf53cc5', '1359', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a437240b-ff37-4313-9a2a-f517a83862a9', '1549', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a48302d0-dbdf-4b4a-b051-b0bb7cdbdafe', '1859', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `std_student_class_stream` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `academicYear`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('a4ef767c-96ea-4011-b1ee-987ba5d48d5e', '1298', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a52160fc-2f19-47d5-8da4-93082cf89b4a', '1212', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a52fdce7-667b-4e0e-8865-2f8ac2601d47', '1458', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a6bc4cc6-55cd-4753-b301-22d3c2457242', '1802', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a6da9d40-48b6-404c-bb7a-902a27b835cf', '1426', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a6f07d4c-2439-4dc2-bcd4-a28b848a3d44', '1625', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a7b23916-6ee2-4424-bed9-1fc153d65e5c', '1504', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a7b63f86-b3fe-44f5-9d5c-cc19b7aca132', '1738', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a7e3a36a-efdc-4bdd-a371-57f45a12c935', '1896', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a808059e-fbc8-4ebe-b9fc-29a8af6670d5', '1148', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a90b8da3-19dd-48b0-a71f-624c0fb1161b', '1204', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a933a749-0219-43cb-8f72-0283d9c5f07c', '1352', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a9b1aedc-8db7-454b-bafe-4e388e29bb59', '1187', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a9c8befe-ee82-43d7-b544-bfef70fa8027', '1546', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('aa52e999-3a53-4ece-b218-0db96544936d', '1271', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('aadec016-f450-4221-a81f-1eb12a0b984e', '1470', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('abbc2227-0947-4b9e-a6cb-3f0c4bb8b921', '1425', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ac61d576-aa98-46c5-ade9-537715186eaa', '1131', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ad0c833a-9e6e-491e-960e-6674795ac56a', '1548', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('addf2600-5d5e-4bfb-89ef-e4c5759d2654', '1107', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('af2fd647-b67f-44fc-ae81-d0255363c395', '1175', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('afa82769-ad29-43e4-8dc5-ba270d7503c1', '1586', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('afeebe2b-d191-4c21-8365-b0caf684bf0e', '1149', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b0ae60cd-76da-43f4-8678-b6d36a5eaeaf', '1514', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b0ff275c-f41c-4958-89c2-07efa1e39488', '1645', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b12f5378-0928-4e66-980c-1f8f3152a4aa', '1238', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b15602c9-b4f6-4c61-a377-65eb4459b66f', '1446', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b204c929-b1e4-4eb8-a7ac-f00c62fdcaf8', '1654', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b2142737-c2ea-45c9-88b9-bc7e11ded9bb', '1784', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b260bd33-05ec-42f1-a905-0b4d1309e17c', '1270', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b27d34c2-4c6e-4a6c-a18e-09b0ba8d1da7', '1125', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b323088f-174a-44ed-bce3-ec71903b64e7', '1571', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b3961e79-c5f9-4b80-bd6e-489ce369af82', '1094', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b43347b0-51c6-4955-b26e-3ce7dcd568d4', '1744', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b514565f-2cea-4bdc-a6e7-5c77b057a052', '1725', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b59ebfca-7b04-4ca1-bfaa-a428fb42ad90', '1535', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b5c2b157-1734-4ea2-9a60-227121620571', '1203', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b8a28552-3c9b-4ccd-9dbe-0c8a2f9487a0', '1562', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b8d2aafb-b044-4b16-b7b5-e309d43a2185', '1647', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b8f76062-639f-4fd2-b348-f53d9a7fa2fe', '1811', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd7', '4da9d182-6f65-4d7c-a097-67c8924c8201', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b9a78d7a-5d46-4c4e-92ca-66fce764ff23', '1305', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ba08757e-d35e-44a1-a6d8-7d75ee9f5125', '1573', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bade03ad-4ad6-4ae8-a659-a310f5da5d80', '1801', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bb79c8c1-9952-4c20-9a52-3b52756e0aaa', '1208', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bb80b24f-7255-4ca7-a287-5a252c87f5f6', '1841', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bbd8f715-a3a1-4133-8116-f6f5df743e7d', '1743', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bc1be2d0-0ba8-4919-adeb-252ac25e0a20', '1444', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bc9e4d0e-7fe7-41c6-998e-9de38e8faa60', '1272', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bcaa0d31-715d-43ca-afcd-2a35101f9026', '1876', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bd10f4bb-05ba-4eaa-aa25-f89432a3caa0', '1616', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bd4a72a9-00ff-4e2f-a982-189a674c0278', '1108', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bdb01cdd-f585-4b08-b07e-cc9571184b36', '1223', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('be689b8c-5e0e-40e2-a172-8993c70847f3', '1485', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bf5d40eb-6d27-4257-8428-1de3e8ffe52d', '1595', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bf6aebe5-4419-471e-9208-3f3de77df83d', '1224', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bfc0451f-7a50-466c-92ee-eda5643fece0', '1566', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bff80dde-a2e0-4827-b896-d8c5bf4ad023', '1431', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bffe0377-5db0-4c6b-992b-97db5b2f7ad8', '1766', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c0605c5a-c083-46e6-b22b-6f3716921b7c', '1648', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c0ddc5c4-2eee-4525-9d81-f7bcf5749cbe', '1138', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c0fba405-ac3e-495e-a667-836156cfdb9e', '1376', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c140bac4-4801-45da-a84b-a63917d4d897', '1337', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c1a64788-df9f-467d-a23d-83f80f101ee8', '1506', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c1f705ac-45cc-47d4-9ef4-4d45d5c4489b', '1090', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c214591d-1b5e-4985-9cf2-ccf55a8157fa', '1358', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c225b758-051c-4222-875c-c8d50b5535ea', '1563', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c2b617ee-2ef6-4bb4-a90b-2307d86390bd', '1420', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c2e9af4a-0de0-4035-9c68-91cb2d2cbf6a', '1803', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c32487b4-5ece-4c30-bc6f-6cca5a836e69', '1189', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c3511f07-5e9e-43e3-9917-4d76d62016bc', '1323', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c35d469e-48b7-441f-ab30-2e5112669005', '1820', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c3b64ec1-a30c-43a5-b297-4cd0d2101f62', '1363', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c3cda3b1-b0ab-404f-a11f-af67139cc9e5', '1577', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c412e9d0-9e92-4a0e-a793-921565055e14', '1429', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c4369322-f31e-412c-8791-79b4df53f99e', '1712', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c44c5f3b-5824-496f-a112-8b27a82ccb72', '1499', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c4e9671f-b790-4fb7-ad2f-e641a2dd105f', '1824', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c53e3bb8-0ccd-4c05-83fd-ae64057b3deb', '1644', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c55d0a69-a164-4ecb-b8e6-b00f6daed19e', '1180', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c5762fd3-4853-4bf0-aa77-93c1b0b87213', '1489', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c596c862-e11b-4bfe-b6ff-20f587893aa6', '1500', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c5d48142-47b4-436e-acc2-9a6ef1c8a451', '1344', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c60329e4-a95f-4046-9bc4-870470ee773a', '1812', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c679e550-7cea-47d2-9376-f220c25fa00a', '1759', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c6ce9e38-7480-443f-b675-3cf4b3244be4', '1266', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c721fef8-82d0-4455-8484-ae720329d53f', '1381', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c73cf5f4-e1d5-4d71-85d5-a1e7b5bc321b', '1142', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c7633854-e318-416a-b0c8-404743aeea06', '1422', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c7a416e7-ebe3-41c3-b9d8-554ae6e5173d', '1325', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c7fc513d-aae0-4636-a945-7a8d656cc4f5', '1679', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c81f3829-5311-45de-8eb6-f3903382e55e', '1854', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c82b1523-cf85-45a0-8574-53125d32c57b', '1167', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c87e5e96-97d0-4c9f-a4ee-ec942b5cfcd7', '1565', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c8cee212-17de-430f-8b87-537208729aef', '1301', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c8d8c489-74ce-4538-b193-b3e31a0e3654', '1531', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c964aee7-a071-44ab-805c-3f1cd5b77a50', '1464', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c96a6c42-5577-4f43-ac97-3e2ae940463d', '1206', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c97ff95c-2081-49df-a6b5-bb4bf2e98f3d', '1451', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c9a03006-e9c9-4583-82a3-2d646405a401', '1364', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c9c828d1-c135-4931-b6ac-2dd987ebefdc', '1681', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ca3fd3c2-55ab-42fc-8a73-f532c73236a1', '1543', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ca8af109-b35c-4c2e-b199-97dd1b1b2a1f', '1822', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('caba66e5-becb-4a20-ada7-150d07862523', '1273', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cb9a6fc3-eb00-4de7-b20e-52c651abd8b5', '1748', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cc0d7385-9daa-40fd-98b0-60b0df16ddd8', '1662', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cc2107af-3e2f-42db-8930-50976afef190', '1541', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cc4a3094-8c4a-4cfe-89e5-51a308b17a29', '1304', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cca3c011-dcfa-4461-995e-62605c735e9e', '1749', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cd32c5f8-93fe-4e03-aa5f-8b725676c819', '1239', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cd5902c6-4275-46d6-b1ee-f4433a4c8827', '1339', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cdcf1989-9d67-4598-8015-715d0b657064', '1286', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ce513caa-fa0c-4790-8346-f13a309766cf', '1412', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ce52e6a2-7b37-4f79-88d7-d92163ff0dbf', '1663', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ce57ae11-8968-45e7-90fa-997548726955', '1120', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cfb1cc6d-3db7-4ae2-957d-eeb0f80880fe', '1197', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d05930df-6005-44db-a199-18d6a201d74d', '1512', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d067489a-d275-4eeb-b59e-25ad57b64310', '1660', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d08e1dcf-750f-4309-bb45-7e02f0d7e934', '1486', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d08f499a-a133-4fe2-804e-22cbe52ac453', '1732', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d097aca6-9e13-4e14-bcdf-863bbb7b2363', '1672', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d1004a16-91a5-40f5-a478-df4bd2648472', '1501', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d10b5eaf-9b1e-4e7d-9efa-b95542a359de', '1159', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d1a5b48d-7c46-4ea9-a9fb-41fb1412a5e9', '1612', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d1bd2188-f7ce-4f06-b4fa-14f15693c01f', '1680', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d2166fb0-34af-4869-926c-3050aee09161', '1542', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d216c329-d8ff-4544-8023-21debd22700e', '1530', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d21d4554-b265-466d-8c2c-b19da38128ef', '1686', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d28d3662-1f07-48fb-af98-642529d94d2d', '1527', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d2a283a1-e2ed-4074-ba99-f7758563c0e8', '1673', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d2f5ac83-29bf-474d-989a-7451684d9a75', '1875', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d3d56b55-a44f-4fb5-9708-3cc3ae204076', '1333', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d42eb9fa-6191-4340-a403-5e162ba37b16', '1602', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d50e10ac-2cd8-4512-9fd9-599db668a966', '1640', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5555b10-9bcf-4193-b675-93f96f136a7c', '1442', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5adc55b-ffb9-4fb9-bb54-79b125088221', '1236', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5ea89a8-ac75-4a4a-80ef-d73d6941115f', '1805', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5ec10d0-5b87-4e40-9567-2de8f97f9c44', '1103', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d6a31263-56d4-42c2-813d-31e869d7c3aa', '1666', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d6ad7b41-aa87-4bc9-a761-2bb1db35bcf7', '1353', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d6dece7c-e003-4de2-bc00-989c551d87e5', '1651', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d7678478-bfb1-48ac-b4f4-bf90e41fd60f', '1649', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d883ad7e-5bf1-45a0-b562-962f2fb43657', '1459', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d8db626c-d0f2-41a8-a071-9843c455221c', '1492', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d910a8d2-f48c-4136-b5f5-a35297ff58ce', '1118', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d93d5866-efea-4935-9ecd-a5ea4f44b83d', '1280', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d942a028-fca5-4384-9ea8-dfc1127ff76f', '1771', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d9b95853-e165-4d33-81a9-12883fc75233', '1115', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('da5a4145-a264-478a-ba1c-7d7064c6bc76', '1143', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dba2d664-d606-4294-bdfe-52cb00c03bd1', '1151', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dba89890-d613-4de2-8bde-103ef2528df1', '1753', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dc7e6c2d-fb5d-42d0-b950-593679777ce5', '1231', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dcf99d92-f861-4742-8a33-bf5d9740ef24', '1306', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ddd5a703-34f1-43fa-9b5e-839a3caf8091', '1081', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dde1ed49-f5c9-4f2a-8cf0-41a006fcaf02', '1665', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e2345f51-75c5-4fe9-bf18-d0ea63de9923', '1880', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e37eb995-e46a-4986-a63b-fbc40a15d40b', '1230', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e3c82832-1e2e-4cb6-a7ec-f2485ee9d552', '1509', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e4388c94-639f-4066-88e8-2a13135c13f2', '1421', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e46b3baa-7f72-4a60-bc01-4f00c28886e3', '1452', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e46d92ab-7507-406d-bbc3-9ada61fc2761', '1163', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e483d066-2cc3-4b6e-bce8-757f579eea70', '1289', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e4cd57f0-a17a-47ed-b8fe-2ada113a20ef', '1578', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e4e58063-b294-4c3d-8c49-29d2a5cc0755', '1380', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e5065944-1d74-46c3-8801-00297a9b3162', '1675', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e5103113-46bb-4b9b-9a76-714bb5866bf7', '1480', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e5fae2af-2ed5-4632-8cd9-9966fb2b07de', '1399', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e68fafc8-a7ff-4964-ae2f-268e367ebf51', '1365', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e692bc3d-50ef-4c5e-8384-269bd5c75a0b', '1123', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e6f7ed62-0eab-4350-9c4a-c4628c1a2e5c', '1717', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e6feb5af-dcf6-48a7-a249-36562e332ce6', '1302', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e7ae625e-83ee-4e39-8926-78f6f473efb8', '1195', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e7b7534f-508e-47ce-89a0-4042b4ba0303', '1840', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e8cb5a26-eb8c-420b-991e-4bd3ed9262e1', '1449', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e914e0ad-de09-4025-abbe-28917c60255b', '1475', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e93682b4-e206-47df-bc09-536527c879fa', '1655', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e966ddac-2629-4fe3-9718-fc052729f462', '1658', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e9f2de7e-1b16-4154-8610-d9a7321428a2', '1234', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ea280a50-e5ef-447e-ada3-33d951c5dbd6', '1330', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ea47a5fd-4cb9-4859-a82c-e2c66d729a13', '1714', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ea68f58c-6f35-4c3e-9191-c0942da3e815', '1622', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eaebb16e-596e-4717-87f9-242b1499c274', '1454', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eb332d98-41a2-4b72-ae86-e8fa99f530c8', '1178', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eba4ed2c-7068-466e-a48c-bc8bcc160903', '1356', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ebc8fd9e-5753-435e-8f0b-4b64ce0d09d7', '1589', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ec112607-648d-44dd-9b45-40f4585fff58', '1415', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ec9e9664-7464-480f-8950-22f8e98c743e', '1428', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ecb70cc5-46f5-4e00-ab8d-0133a31637a8', '1408', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ecb7f9e3-8c87-4350-9a11-976d778ae1d9', '1740', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ed43c4bc-4530-469b-9abe-ebb6f6004cb4', '1580', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('edd737bd-9fc7-4195-9139-d8b71b0e20d5', '1335', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ee05deab-b7da-47db-a157-d4c6b858d74f', '1790', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ee094173-8e7d-493e-90b7-4926f24e1cc8', '1265', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ee2842fb-aebb-4b15-a866-ebcb8d336848', '1275', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ef1c4f71-28e8-4b06-b4f0-82597addece4', '1693', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ef2abc33-6a29-48e3-b229-a09f6823cbce', '1723', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eff62583-b4d9-4d09-92b3-49f2a4e3562a', '1860', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f00f61a2-1bb5-48cf-b64d-1c48e55d7ab6', '1156', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f0914664-a064-4a1f-973a-6d17e9d407b7', '1494', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f097fe97-5b80-4623-a9bd-123e59483f7f', '1121', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f102afd5-788e-4fbc-921f-adc7ee48b0d5', '1569', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1331c81-53e6-471b-aeb5-6ac245ea50e3', '1074', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f14a8b2d-b0f7-4cb2-9a8e-b80036dca6cc', '1419', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1ad7a4f-44c6-4053-8df0-0ab23d602271', '1553', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1add0a0-262c-43a9-a381-2bb5daf83439', '1757', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1c37068-700b-4a4c-bc4b-89dbc479041f', '1838', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1c7f924-64a9-4038-af69-e95102b1cf49', '1297', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f20eac66-31e9-4173-964e-7c2012816fbb', '1588', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f2c73552-8ebe-4202-880a-bb192752d2ce', '1392', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f3772942-e41c-4ffd-96c7-1e97b3746d52', '1354', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f3ac7b35-a004-4814-b7a6-ecab231d7040', '1902', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f3d78d42-23fe-4d16-bb29-fed561d0970e', '1708', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f404acd3-d486-431e-bdf2-f49a9e9257c4', '1214', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f42aa8a2-2568-4dd0-bbd7-5b194c90869b', '1487', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f49bc2b0-5ead-41ed-8283-aaccefc40522', '1632', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f4a298ed-8de2-4956-ab8d-138402cb4654', '1332', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f4c510fa-5f72-4e42-9a34-705ea536e06e', '1210', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f540943d-7c45-4cb6-b121-828ba3ac370a', '1829', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f549bd9b-a3b6-4878-8438-be4c038dfb95', '1215', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f5ac36b4-3eab-48df-859e-053d14aba5f9', '1435', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f5d067dd-f5c5-40f9-8b79-9e9612db8576', '1396', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f5fc7ff0-65be-40ed-af76-65cd58f959dc', '1174', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f68af453-2cd5-4e26-97db-c3ea72e0b712', '1611', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f6dcd68f-621e-4d16-bb74-896f84578f2a', '1627', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f71edfc0-51a4-49a5-a840-c03bd03290a6', '1629', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f739711f-63a5-4a96-8dd6-005120804e78', '1869', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f7916185-818c-4451-ab6c-4395b5ba5b92', '1874', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f7a4d191-a927-431e-9765-5737dd62ffdf', '1114', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f819cde9-ce54-411d-9a02-d2341151b90d', '1427', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f862afbd-ef42-4247-bee2-c94c1d4183c6', '1386', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8b0d6be-01bb-4006-889a-d6b0f8daed4c', '1170', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8c7e455-e184-48e5-8517-4e146e869cbf', '1291', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8c8007d-1b0d-4ac1-a10f-94f5a4265256', '1599', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8eaea02-85de-4569-89a2-47345fc6d597', '1209', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f91de042-072d-4954-8da0-40afe2d7eb8f', '1774', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f9cc1c70-ea82-466d-845a-792db9cc4f7c', '1591', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f9ee4b54-2b89-4e35-9797-c5e9f764bd55', '1848', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f9fb0260-2fc9-409a-9af8-4aed045d3a55', '1162', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fa2b6b74-5cdd-4d12-99cf-54e1045f27c5', '1135', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fac48de8-5cd9-4bb0-8393-f99c54d8fba8', '1668', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fb94b19d-43f9-444d-a3c1-f7fab2416576', '1315', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fbae3890-1f34-48a0-ba5a-79e7a62743b2', '1555', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fcbd2004-83f0-4535-81de-7ff19efdce81', '1188', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fce76e54-cbad-4c37-9f15-678db87e09ef', '1404', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fd5c5bba-4193-4a40-a910-01add82ebd42', '1351', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `std_student_class_stream` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `academicYear`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('fe143cd1-413b-4c2e-bdaa-864e613dab60', '1575', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ff3b09b9-54f2-4313-921b-ef045ac69fed', '1202', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ff3cfc1c-8fac-4de4-a28e-811086bacd64', '1517', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `std_student_class_stream-beforeallocation`
--

CREATE TABLE `std_student_class_stream-beforeallocation` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OrgClassStreamId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SectionDetailsId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `academicYear` varchar(99) DEFAULT NULL,
  `created_by` varchar(99) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `std_student_class_stream-beforeallocation`
--

INSERT INTO `std_student_class_stream-beforeallocation` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `academicYear`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('001b217e-8a94-442a-bc7e-4a7efd492997', '1735', '096616cb-8984-4fcf-9c5e-07713aa1c231', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('01ae78ac-fb7b-42ad-91d0-0c68a14d6014', '1728', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('01c42d55-34f1-4f7d-b687-4a34ff240fbe', '1385', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('028d0b5d-6063-4fcf-8b1d-31f5aacbc9ac', '1140', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('02b089e3-31de-4d2d-9a59-762c2d7f94e5', '1782', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0340dce1-f0c7-4d2b-b7b3-785f48fce933', '1377', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('03e2c753-cd12-4b26-9e2e-bb96f2ba067c', '1618', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('042f32f7-6e44-4e98-8b49-b72be0ca006f', '1261', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('043a3f85-d491-464a-b5ea-48c5e6ad1846', '1300', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('04b72b62-28f4-4a37-a8ca-2e7e7e7421e5', '1285', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('04e09114-444e-450e-b84a-747bd598d976', '1326', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('052366d3-9321-4838-b49a-410ec87bbac4', '1760', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('06171cbd-f6f4-43a8-97e3-ce927e8ec017', '1145', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('066699e9-3ef9-4773-b491-f8b8810ab455', '1199', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('073c0e40-a53c-4ca9-8818-04dec21a14b7', '1394', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0772038a-4368-4aeb-924f-e2ab7b884c16', '1436', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('07907578-4b14-4aa1-a02b-03b7ab9f8b5f', '1539', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('07b09bf3-9551-4c7e-b1b1-063fa9a235b9', '1615', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('07ef329a-886d-48e8-931b-c5a01096eb55', '1336', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('09a4362f-d168-4005-b1fc-648eb5497580', '1592', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('09b7330e-7aee-4b42-b709-55bd88d6bd3b', '1684', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('09b7ee1f-f25d-441b-995b-cd58aa903b13', '1867', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('09d978a7-c38e-4330-a021-c6135fc76063', '1083', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0a1ad8e4-c30c-4ea5-9487-e60f0a0e0347', '1726', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0a4e4b1e-5d56-4508-926c-9ddc06cf34a6', '1574', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0b1bced7-f636-4b5c-b6b5-b5ad8663aa92', '1316', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0b7be1f2-2d13-4b16-9b69-3756134aabf0', '1089', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0b8f5f4e-7be4-4769-b203-eca7da0fd2e6', '1700', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0bab56a6-3c3c-4999-9e13-7bfbb92f4f67', '1414', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0c0cf5fc-65ab-485a-8ba2-605b26928e10', '1256', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0c31134e-6e55-47e4-85a6-75c526511336', '1287', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0d75a2f7-4c30-4ced-9118-1c5d81893f96', '1087', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e074060-4551-4476-8767-264db9a2a81c', '1513', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e4c9253-a64e-408e-bc88-7c4781a17535', '1899', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e581d2b-6445-4351-bc0f-5f3944839f47', '1502', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e5c463c-294c-43fb-aa17-e8ade51f6141', '1703', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e784574-fe79-4d5f-b9fa-66ee7b014e29', '1597', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e9af89d-cc73-4df4-94cb-c825ce464d4f', '1348', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0ec459ef-f746-42ef-aacf-2d4efa4d7812', '1604', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0eec0c21-9726-46b2-a829-ad6868a37fac', '1810', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0ef67011-1576-4ce7-b8f1-ce5b7619a9eb', '1284', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0f603460-ccae-4fcc-a80b-6c02efeab22a', '1106', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1002e52e-9c67-4c5e-9141-921bb130ca66', '1357', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('101ceae7-9b0f-41f0-8724-895be7b2ca2c', '1828', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('10726a64-965b-4306-ad4d-6df52f65c2da', '1745', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('11dfde20-5990-4a01-8710-b1a3081a7c47', '1603', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('11f4a638-a82e-400f-8a5c-325ca5f88a4e', '1463', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1231c2bd-ca0b-4a98-b122-c9b801416a24', '1731', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1259a24d-a531-4dd0-b442-ac501198316e', '1382', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('135d3145-0b0f-429c-892c-f844960f8ac5', '1371', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('13b51f80-5ab6-4511-81f4-560c59d8455d', '1582', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('13c703d9-0640-4f50-a96d-005e648ffc5b', '1493', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('141fab67-3fb1-42fb-bdae-65451aca64c1', '1619', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('14429fa2-aeb8-4594-9546-66c13c7a28bd', '1888', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1535559a-6a66-48af-82ea-29554f046f76', '1598', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1590d067-aa28-42f2-b9b0-a6908874e615', '1724', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('159231b8-208a-4a5e-8e49-143ef804d679', '1524', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('15af2673-fc2d-441e-a335-2cc91a7cea50', '1327', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('15b61296-73a3-466e-9768-22e5ab7d0087', '1752', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('16a96310-bc41-48c2-b524-bae5ba9d6aa1', '1608', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('16b9576d-e214-4422-aa23-9c876c38db2e', '1061', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('16c7e63a-126a-4e2a-837e-85b7eb0e3137', '1544', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('17056301-4773-4b33-9a67-6e61ad776fdc', '1346', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('173f5d78-8929-4ed6-84f1-e9cc60ae1325', '1176', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('17ef1c9c-c7b1-4f21-8acd-ea12f83ad183', '1232', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1823aae2-86c2-47dd-a18d-ab46582339fe', '1309', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('18ff5b37-ffcd-4fb4-b3f9-1dbdd64b6cd8', '1560', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1975b054-dace-46c6-afae-4cba372b3023', '1789', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('197e347b-23ab-403d-acf6-2dab1d2df555', '1362', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('19fe7da0-ea90-42a1-a3da-d07dd6a0609d', '1741', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1a355c53-733a-4dad-b4ea-6bcde1c5781e', '1314', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1aac2208-8435-4e02-b879-8d8d74618db9', '1750', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1ad50755-da92-4d6f-9bb9-72e81317ba95', '1687', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1aeee824-18d5-424c-be2a-9a230ed301d6', '1505', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1b5977bc-7622-4d88-83f5-feac0b9326b8', '1538', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1bc2f2db-069e-4c01-b629-7d75b906b29e', '1122', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1c2da722-49ec-49e6-a1e3-16b3ca4779d9', '1229', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1c3679d2-8432-4b5f-8294-a683d14d826a', '1857', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1cb4be8d-2c32-4bd6-ab91-4f02af5386f6', '1319', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1ce5f332-2975-455e-8525-dd04570faac4', '1638', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1cfb2c33-1a7b-49bf-b515-5236c032280d', '1733', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1d0fbbeb-0eb6-4032-89c5-5dbae0ad82a7', '1600', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1d5a3ea0-fef7-4ffd-b983-9128cf384ff8', '1521', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1d718c04-f070-4fbf-8674-a57633199f38', '1572', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1dca2a73-c195-488d-86f4-a3d0f5bb30e7', '1763', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1e3cac0f-d2b8-4b4c-8dba-87940d8dcd0a', '1129', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1e6dc62a-c79c-44b3-b54c-f93b489938f3', '1062', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1f7b5a7c-68af-4693-8019-aaa73da018eb', '1169', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1f875709-c3a0-498f-b3f6-624240d145c4', '1669', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1f95bfa5-97c8-41f8-9bd6-0cd3cd39dd7a', '1519', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1fc363f1-377a-42cd-9b04-27986f14f799', '1471', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('200c2e90-6ef4-4818-8d72-7c7c0c6533ee', '1853', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('202d0aa1-b8ce-4631-860a-7ca88dbb8817', '1637', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('20549240-fd6f-46e2-818f-04d536cf5700', '1596', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('207f6e7f-ec1a-483f-a472-5922dba89e88', '1711', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2093caab-81c1-4c70-a9d2-d71b6c5ed394', '1324', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('209ff9d1-6326-4085-8e3b-a7b87c038e91', '1097', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('20eee4d4-7338-4d02-8b94-ee6a5ce06209', '1529', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('21207ef5-6668-4970-8c9a-6620d3b81e15', '1136', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('21aa5128-e7da-4bc8-93c4-f81eba1f77ab', '1835', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('21c17e64-d85e-4a34-b9d3-d8fb7c52255c', '1483', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('22161b09-dba3-40e0-9024-6f9dbd07a643', '1184', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('221b0c07-69f9-4ba5-ac0f-cce6574165a7', '1482', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('236a1322-e861-4779-8531-85f4d87aad95', '1181', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2385e47b-f0e1-4a22-955e-eb89b2ba17fb', '1528', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('23dc3954-e34e-4983-8c37-22827e089297', '1832', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('23dfdc18-d9ad-4dca-9662-cf8fa792997f', '1441', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2406b684-7ce9-4e52-9749-b07b6ee31f22', '1310', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('24097ca8-6e55-4a90-9724-b312b18cd3b2', '1220', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('240f4f35-596c-406a-81f2-828172176157', '1182', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('247a196d-199c-430b-8323-44f2725c4904', '1088', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('26445f55-dbad-4955-80ab-a45e7246943c', '1533', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('268c37a0-37ee-4e43-8244-b2fd1922c03e', '1264', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('26b0c42d-622f-4577-b899-91c9c9cefd88', '1226', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('27bd4bd8-d48c-45a0-9450-6f6dee1d3a6d', '1807', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2815cbff-0163-4a28-acf6-fa0314883cb0', '1522', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2816d50e-20bb-4f7e-9680-369afc545d43', '1751', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('28cc9a24-287f-4e5a-814c-cad37282a98c', '1688', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('293fa855-0ef0-47ad-8ad3-3cf4c6ee6d07', '1065', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2945f2f3-7f9c-4f60-951a-5a9ecfb3999f', '1765', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2991ab08-9147-45bc-b8bb-0cf2ee8f45b8', '1054', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('29db32ed-4bc5-47e6-bd06-084675606bd8', '1878', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2afa240f-5691-4c19-b147-04c482aeff19', '1416', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c16052b-3213-4ea9-9ebe-bb39b24778d2', '1685', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c16fa6a-2ce9-4e0a-90ad-932cf801eb80', '1161', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c1988c7-32e7-4f68-b31a-5e81486f9e93', '1313', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c6ac560-2d3f-4fe0-8f46-b740289c96de', '1770', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c8e1c71-d01e-4193-b570-becdee0b0459', '1111', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2cb5bc44-8162-4714-bc47-b6a775a89415', '1127', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2cdd8efb-1051-4aac-b772-cbf3d58c067d', '1720', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2d0f3e89-4c26-4b38-8ca2-303e310ccf72', '1718', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2e5debcb-d4e3-49ac-9db7-05400e11fb29', '1556', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2f6c01a6-9e4e-45cf-b2ba-05d6517807b0', '1856', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('309f6422-467e-4264-97b1-fd8205c116b0', '1872', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3157401e-004c-47b6-8a61-cdad8af85fba', '1218', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('317dbf88-18e3-4d7b-8f2e-fb55e1590c31', '1058', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3215fbb0-7563-46c6-af26-d55ff25504e3', '1387', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('323c9600-4fb0-442d-9567-feaf93adfa7e', '1141', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('327ef611-ea2b-4d26-9181-2c5ef0dc7b1a', '1701', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('34c50933-3312-413f-9de0-024d4d2d3236', '1635', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('350c2444-04c8-4d8f-b511-03a0d4c5a2a9', '1613', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3515bc25-6570-40e3-9a6b-546386a6ac11', '1388', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('351acf0e-9171-4790-abde-37439ed3b8fa', '1096', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('355e6025-d4f9-46cf-85df-3841c094abcc', '1418', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('35a6f020-b1a0-4789-afd2-e1e587a44fcf', '1059', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3607ff26-5e0c-4aaf-b42d-f5318f0df21d', '1526', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('36b5cee5-089b-4e71-af5d-8e589c119964', '1866', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('36f2e6f1-aef3-4744-a126-153cf056ed69', '1699', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3734305a-f202-4097-aea2-ca9326604d04', '1610', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('38e4567c-b982-4279-b065-9df5eacfcfeb', '1606', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('38e47171-bab7-4b03-8bed-2413a3c20ac6', '1217', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39212276-6660-4eb1-b4a7-f9f08e415a56', '1497', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39237f1d-e073-4a37-88fb-72bbdc8c854f', '1468', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39b3c1ae-fa92-43e1-abfd-21c269a015f1', '1472', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39b6a052-5fc9-4212-9c91-edba1871e465', '1813', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd8', '4da9d182-6f65-4d7c-a097-67c8924c8202', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39d73e8c-db70-4b64-9eec-3aff48ff158d', '1355', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39ef2d30-64c6-4262-97da-73e182b282db', '1268', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3a92bb3b-c8de-4ee7-bff6-c9157e33499f', '1269', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3ad3130a-319f-4a44-84c4-a0a33cdfd24f', '1511', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b286e87-8cdf-4cba-ab66-4069100b69ad', '1430', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b2c900a-6160-4925-b5e1-1c0b92d54eab', '1642', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b4d85af-a6e4-46d7-aae2-cf9977338652', '1885', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b594cd3-2e44-4bed-a818-4640370ce5aa', '1424', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b608951-e04b-4c8c-9736-096d27657373', '1194', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b6105c0-2bef-4f79-9742-896cf619252d', '1839', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3c7cf389-efed-4f15-ac9b-24b727841ea4', '1557', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3c7e7e62-a6cf-4e35-9f58-a6f621186ccb', '1263', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3d108a34-40c7-4d0b-ab9b-cd3b116e9dff', '1844', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3dbbb718-8775-4951-9ae6-e75603df24e7', '1706', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3df7a82d-bfc5-406d-b1f4-79c55eceb1d6', '1516', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3e1c2ca7-b61b-4339-81f1-29b36356fc6a', '1815', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3e2a04ad-3e77-41d6-8541-f63e1b549f44', '1474', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3eafcc27-8420-4214-b84d-ebc2ea79f694', '1695', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3f4b0bbc-9038-4a50-975e-5041bbd4dd9e', '1283', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3f53872c-73cc-49e7-a632-cbdd7c012cb1', '1554', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3f6701bb-b047-411f-8a94-235e0315fb0c', '1092', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('40a7d7a6-22fe-4f36-836f-714d0cc01044', '1793', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4111105e-16b3-4e2e-b326-148c655981c8', '1473', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('411bc447-c7ca-4dd5-b8a3-bb9bf1252be0', '1455', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('41bcb209-ce37-4619-a122-3106adece002', '1692', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('41d92839-53b1-48c9-afd9-9e1a2fc9e577', '1773', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('429a1762-65f8-4143-b4f9-c3b5aaee14b8', '1621', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('42ade444-eedc-45c0-beef-9b18795c2f71', '1360', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('42ee23e6-dca3-4a3f-a869-65cb70fbf6f0', '1193', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('43b09dc7-8007-416a-bf9e-f0a2491d7b6c', '1443', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('43edeb13-bc57-4147-8609-0523e7569e1f', '1460', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('449cc9af-b9ce-443d-812a-3b2b2a241ec4', '1707', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('44f17f4c-c009-4de5-a6a1-0126a4c0697a', '1671', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4564f25a-04eb-4d60-aefa-a7416c29b587', '1495', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('457c0bbf-cffe-4d32-858c-bf4a78ea2046', '1657', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('45a56a83-7bdc-44b7-b8d9-1880db982673', '1374', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('465489f1-5102-468e-9639-488bade764bb', '1797', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('467d6d23-ab76-48b4-829a-a0dc01fa776a', '1579', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('46a90093-02e8-4767-9c34-208ad29722b3', '1466', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('46dbc2e0-d7aa-4747-9636-40ffd9067b4c', '1391', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('46ffdc69-4f66-47f2-9df0-e58478faa1bd', '1525', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('471ce607-43b8-48d2-be33-7c5d46ac9766', '1689', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4781be26-5666-4e01-82f4-cfb2365f061c', '1340', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4785a359-9793-4492-a5be-bfa522afc2bc', '1481', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('47fa9b31-c204-4564-b79a-ddd3c6ab6121', '1448', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('481d9eeb-70f3-4715-aaea-edb09a90946e', '1833', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('482b2f4a-d5b3-4e2b-893f-ecdec6b1f64e', '1440', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('488c4727-60d5-4e32-a7ca-3d24d6d55830', '1060', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('488f3121-7c20-40e5-bd0d-57e983ab18dd', '1407', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('49081b01-9dfe-41a3-b4c9-15d777c66b5c', '1079', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('490b16d6-8e38-4149-af79-e3fb2b6effbd', '1109', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('490e4f33-4db8-418c-a8d2-89adfb015f6a', '1139', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('49295f76-b25e-43b1-b0bd-b3813f3c8620', '1205', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('49d4c369-7aeb-41a5-9333-d2609490f328', '1405', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('49dbf65d-99ce-4aa1-a4ab-8f624fe8f0c2', '1842', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4a6a029d-bed3-4eb3-babe-a7e9be8a40f5', '1091', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4aa5efa4-b651-443f-a50d-f121d8b0220e', '1601', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4b1a0a51-08d6-4e8a-83a9-e4009b4eb276', '1249', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4b2650ff-d6cc-49cb-95a7-4e9338bfa1d9', '1082', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4c60dcc5-3053-4992-8a13-9ce3ae275ada', '1736', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4c623c37-1595-423c-9230-79e4aebdd5c6', '1375', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4c722a3d-2c32-4018-9cd6-92339be6a7da', '1461', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4cb82278-4cba-43f1-8eb1-a7a4a9eab0c7', '1614', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4cdbd8c0-60c0-4abe-af27-4a5d338b4ed9', '1104', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4d37f79a-b239-4be9-af71-06bf523e45ef', '1650', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4d9828f8-d24e-4d52-a40b-d87ed57adcc0', '1366', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4d9a2705-0cda-4d76-bc4b-e73b257fa733', '1498', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4e042a0d-fade-4bfa-a131-9f0c05b8aa8d', '1166', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4e240cfe-15c2-4c2d-aa35-6061feb7afc3', '1147', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4e738246-6413-4909-9862-8f04bc815de3', '1800', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4ebf7f55-fa7d-4197-a941-f6a9e8d2a4e2', '1584', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4f493da7-4e12-4600-9060-9d401dfd9fc3', '1576', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4f522799-a357-4290-9d6d-864c8175459c', '1328', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4f6a4cb0-008c-44c5-922a-47676e74c746', '1260', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4fcd2455-ac1c-4e56-a928-f2c5ef08f652', '1758', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50079649-467e-4339-98df-028776d11f5b', '1607', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('503577fe-8f17-4134-ad06-791b6a096ce1', '1892', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50cbfb5d-79e8-4c17-b511-c38fd312acf7', '1084', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50e4e286-ea20-40d2-9ad7-c8fb68b344d6', '1787', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50edad06-a45b-4e76-8ab8-c56f51211ca1', '1299', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51392b55-d725-48cc-b65c-a54b7ac643cf', '1267', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('516035f3-7ebe-40aa-9065-06e15f9d0e06', '1503', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51b8d85f-d259-43dd-b4a0-9eeb45843a9f', '1433', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51d9b986-c70d-49b1-aae3-64da06359215', '1173', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51e763ef-35d0-4054-8935-c1a308b05096', '1490', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51ee7f6f-34f0-4655-8faf-8777a8917c52', '1071', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5248ae9c-3c84-4bda-a724-bab89096707d', '1105', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5298d4c1-3176-42ce-92b6-4fbe741d6f80', '1338', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('52a594df-f852-4a6f-8809-87ed97796fe4', '1739', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `std_student_class_stream-beforeallocation` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `academicYear`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('532086b4-6944-459d-88be-8d5b4f2f910c', '1581', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('53260186-c501-4b3f-8b75-c2f61e85bc1e', '1532', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('535acb2d-11ca-4c20-b92f-8b4728cfe508', '1411', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('54240fd9-97b2-4e45-81e6-de9d0ddc83c7', '1183', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5424d908-a9cb-4a0c-91c5-ab0a3a7fd683', '1237', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('550092f2-053c-4f02-add6-164a0128ec60', '1777', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('552081df-c5a8-4580-8c80-f751410cedfb', '1437', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('55656a8e-5330-4f3c-8058-8b9421da64aa', '1150', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('556d4d49-3d0b-4fa2-b758-6f0f0a405739', '1112', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('55ab26a6-1801-4835-8dd6-a1b8cd3aa063', '1646', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5672ad8c-27b9-430a-900d-3d81ba48129f', '1491', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('567d2298-fd95-4a92-88b3-2518e080cb43', '1827', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('568dc0cd-61b0-43c6-aa1c-09f34352eaa5', '1520', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('572339ca-bc4f-4443-afa2-1d27d03e91e2', '1877', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5780312d-56ad-42c1-b592-8dd690118e06', '1791', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('57c0646b-f372-4c32-a155-3fd7af853699', '1075', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('57e039e1-314a-4f8e-ab70-42c181fde30f', '1116', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5816ccee-5211-415b-90f8-fd32647c287b', '1434', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('583cc260-2c51-4842-b1d5-d059c803942a', '1559', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58aa5323-dff6-4e15-92de-7d2d8e2ff48b', '1767', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58b032ae-2cbd-4c9d-a8b2-bbdd579303c3', '1476', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58c66e14-89b5-4f1c-a131-7c7a3d2b268e', '1277', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58caea2d-697d-4d7b-b73e-b6476a7e0380', '1137', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58fc5ee2-c01a-492d-a85d-bebc844a73a9', '1067', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('591e7bc9-d058-429e-a359-bcff2d0529f6', '1390', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a05aafb-15a7-446c-9375-83d4ceb98190', '1152', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a107ee5-45a6-44c9-83ce-207d5ca28b84', '1710', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a314d0f-d3ce-4339-8dfd-876db5e56d01', '1742', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a9f3752-78b1-445b-9aed-506f1308cea6', '1242', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5afdece5-4a12-4b87-847b-08a3f6946ec4', '1216', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b1fc6ba-afce-421f-b85a-e017ef49d9d7', '1334', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b522642-f591-48f8-a2da-c97d84d70ca8', '1295', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b67cf32-5b03-4250-926c-1cafeff93b23', '1246', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b9e84ab-7e5c-4b0a-9545-f59029c706a2', '1884', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5bd47911-4cea-4c4f-9d18-f0501dd3f67f', '1713', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5c8aea99-4cad-494a-a482-459f5cfa15ec', '1515', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5ce2741c-c960-4853-a87a-0237b4253b27', '1727', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5d005902-9da8-4647-a9a2-6a1c57100083', '1409', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5d1eba98-d652-49e1-989e-a0be4d169d2d', '1248', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5e1a80fa-9cb0-4348-b08a-f63623a1aa69', '1445', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5e8f6810-6b8d-4762-be2b-ebde36be7fd8', '1664', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5e9dac36-8927-4d60-9bc9-a9f22fd3b35f', '1716', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5ecb0a06-eb1d-4ccb-99fb-efbea2912d86', '1898', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f03fd8c-3d73-4bf9-80e4-8c848d116a31', '1605', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f0721c8-bded-4fcd-9829-22c6184596dd', '1636', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f501a82-28f9-4695-9a58-7c241b1798d8', '1160', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f8a6f77-f52f-4cc7-88a8-79f72a40dd05', '1729', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5feda0a9-54c1-4a44-95fa-f62544bc26dc', '1130', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6005d1c5-8426-46f7-bc84-4ce8e6abb4f8', '1780', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('603bf7c9-0ae3-4e30-bebe-7c20e433a51d', '1098', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('605c7609-607e-424a-9afc-75b5599facbc', '1410', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('612765f4-8359-4ff0-9a30-d4e112bed9df', '1413', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('615ae683-9819-44db-8490-ecdc666de279', '1508', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('622315be-cb20-4ab3-906c-3402d0175404', '1447', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('631a266c-6b15-4141-bc94-6b7ae423212e', '1255', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('63803d14-6127-4f75-a68a-2614c2191ead', '1321', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('639c6683-df6e-46b0-a764-208368ae9556', '1641', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('640b9f3e-b082-47d3-bda2-af47ce3e33b6', '1746', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('64187a3d-df2f-4ac7-a51e-3af675e1724c', '1179', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6424d286-4a52-4a4e-83da-fb81d0312347', '1055', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('64d7cc78-e83f-4d1b-88d5-f628abbdd9a6', '1585', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('653d0e34-5484-4958-ad9b-59c9bbff85f6', '1792', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('65c9bdd3-67f9-4885-ac71-6db3dc018693', '1467', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('66a8a369-5fac-423f-8b88-f305fde5e6ee', '1667', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('66d69df2-30e7-4de0-89d2-8f2c0989af55', '1144', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('66dd2801-d35f-4e5a-98cd-b158a48fbc62', '1721', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('673ba721-cf3b-4f1b-9b9e-a7bafe4ca01c', '1779', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('673d02ca-d70b-4b68-afeb-240353d4dae7', '1262', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('67905aaf-c5d1-4c61-9cc5-b5394fbfd152', '1185', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('67c11865-62b2-4eec-8303-2aa4dab4bf69', '1624', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('68032467-0aed-48fa-84c5-ae05221872bf', '1881', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('685a837a-5ae2-4f25-b3d2-c33ddff79309', '1329', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('68b0426a-ad8a-4184-80e9-754256b2ad22', '1550', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('695edbf7-c57e-469a-97f1-de56588e9795', '1379', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('697c6d70-9f23-42d3-aace-a8ccaca46442', '1117', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('69d5db92-3257-4bbd-8640-5995e7f08a93', '1401', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('69e10052-fa7c-448f-805f-54764d9e0b8f', '1134', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6a02aeb4-1f3f-4d00-98a6-e4b095bb210d', '1722', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6a53a2f0-a877-4fe2-b772-4379d67814f3', '1439', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6a6344ea-99b9-4e91-833b-26ece365a9fe', '1762', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6ab8bcf9-c8c9-4c00-9e1c-05395081c6a5', '1702', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6af80de2-3725-4716-9ab9-ca4f08ae721b', '1462', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6b0f7a8f-12fa-4846-99a7-0151f659c0e8', '1093', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6b5047dd-865c-4705-9174-91c1b09bfbcf', '1438', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6c1f7ecc-0e8a-4114-a1aa-9ff664433293', '1496', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6c587180-3745-47a1-a047-d894e72248f7', '1274', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6c6ba16c-9d74-4e73-b4a3-8a2b56f405cf', '1737', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6daf43e8-7e09-434e-9f3f-85272b3a922f', '1307', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6de273fa-3200-45a8-9c1c-200a9936fcfd', '1172', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6de7678f-a785-4ee8-9036-5a8a895414f1', '1219', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6df31b5d-a112-43b5-bbec-75f9c4d055a9', '1552', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6e17d1e6-9ca9-47e4-ae71-542ab59bbeb4', '1373', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6f104d27-135b-49c6-80a0-a7585e29fcaf', '1479', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6f95dae6-b9a6-4eee-a5b2-3329a952efad', '1235', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6f97405e-2a68-4199-a1c7-c56a420dbd02', '1331', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7001688f-c9ad-46b3-8927-70b0b73548a4', '1186', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('703d978f-9e88-495b-aaf1-d95562cc8b55', '1583', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7049e856-eac9-487b-8b28-1fdcb369200c', '1164', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('70a53a80-90c2-412e-9963-59bffdfa32dd', '1124', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('70ec6825-960a-4fdd-8880-ca6f27eba55b', '1417', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7153485b-b4f0-4ef2-9b2d-7019041bde16', '1342', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('71c26c01-1077-44f1-9f58-77a5669047fe', '1794', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('71d6c911-5346-4138-b12a-a4a030c7c8da', '1634', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('729a516d-4c96-4137-865c-b9cc95789cc2', '1882', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('73fb88d2-bfdc-4243-81c5-db22f4cc319a', '1133', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('743dfd2c-aa7f-4302-80d7-4ffcc292d1c0', '1198', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('744e1170-a027-48d7-a32d-f7685995739e', '1661', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('749358ed-0c8e-4b2f-a468-2340d5fb75ba', '1785', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('74a16c05-0703-47d4-b013-e21dfd06c17b', '1523', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('74c49725-a579-4ac0-a0d9-46d6365ac9b9', '1804', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('755a0fce-55b0-4cd3-bb46-42ccad992a78', '1279', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75839a04-b094-4b78-933c-13c619928910', '1868', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75844b2c-4ce0-44c3-96ec-011cee8f74b8', '1871', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75949488-38f2-4cbd-a2eb-13f9976b15b5', '1095', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('759c6b2a-08e5-43b8-b33c-6069d477355d', '1110', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75ec0d71-cf7c-4aef-9bbe-81631f2a3c33', '1676', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75ef4871-1251-400e-afe1-55f3bea04c72', '1705', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7626ba0f-2da6-4364-a3ed-128b13a23200', '1423', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('76f0c4f5-765c-4fcd-9512-24e5be976cd5', '1168', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('77c7d70b-e062-4281-a7f0-c8cd6568328b', '1778', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7819732e-ddef-4dd7-84d7-a82d88773af3', '1073', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('781b89a0-d9ce-4a95-b631-13dec1655c01', '1102', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('786d77ec-6af6-4776-ae33-f346bc9af75e', '1643', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('78bdb8d0-af77-45dd-86c9-acb5376241e0', '1536', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('78ee91f3-47e4-41ae-a51c-14903c166746', '1775', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('795c9ee7-fae3-47e1-9c53-fbe848082d89', '1393', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('797e5928-7c1f-41f4-a6cc-dd8bdf3b95bc', '1653', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7a4e2868-48b7-4a51-add5-ec5184295a6c', '1398', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7b0dbb3a-fbd7-4c63-b232-62f5888922f4', '1068', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7b34c7d5-d057-4c86-bd5f-bc11a186b12a', '1191', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7c690ef4-5e7b-4aab-892c-888ab392bde5', '1347', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7c6a6d56-b771-492a-9ca2-aa590067d255', '1568', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7cc4306d-5bc1-43cd-8320-bfbaa5e80f4e', '1222', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7d3f7397-d391-4819-9f81-fcdd4c313aad', '1213', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7d7ce568-025a-4618-a213-8cb0e33be7d0', '1694', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7d91ee56-c177-450d-9307-ee104317dc79', '1080', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7ddde03f-6356-4f49-8c99-20aa024a6b3b', '1639', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7df90339-91a7-4a47-8a30-b5e56ead713d', '1862', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7ebf90c0-2058-4a81-aee0-8aa576ef9cbb', '1311', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7ee6ec3b-1500-4378-a27d-39abab9d1a14', '1432', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7efd8b06-3322-47fe-bbb2-42fa66881b75', '1132', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7f0af6f8-bc5c-41ef-a2f3-5e3442dc2289', '1561', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7f326384-3098-40e2-8de7-76f9d9c8f472', '1369', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7f3f8aa5-5ea7-439e-8e44-6eaf5f0f087c', '1367', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('804e46e2-d18e-4f5a-9721-00b1ff88a804', '1478', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('80920309-8aa5-4b2c-bb42-f826562709eb', '1254', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('80b881ff-e7d6-4b58-bbbc-4c25b7072129', '1704', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('80f9e475-4309-43f4-a607-7d4b14cf95d9', '1069', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('810ad00d-e838-46a0-bc9d-486cd13f5552', '1201', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('811af3af-b9de-4638-ac5a-ab25c8e53fa2', '1518', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('81204a51-cbbc-4d4f-a8cd-551b4c992887', '1626', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('81e699bc-9f63-4282-8726-447ef33fe237', '1534', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8212cfcc-c20a-4ba8-9d23-d655a46b245d', '1456', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8225565b-5e05-4642-a415-98ae87a71048', '1617', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('822e2db2-e603-4acd-93f3-39ea5fc2a224', '1540', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('82b4f6f6-3f2c-433b-b585-d2fdc2165a47', '1196', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('82d32161-03c4-40f8-8bca-02bff0d0e9be', '1900', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('82fdcb0a-9550-4feb-a509-603d84b2541f', '1484', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('83e2592f-2a67-4699-bd89-96998a4b0181', '1221', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('84448f9a-4f1d-4a23-9ae5-895bfe6ebdc2', '1510', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('846c0489-95f4-47b9-b9e4-28fe3b558036', '1620', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8471e324-67c2-41be-80c5-3cbd0d2a5915', '1894', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8490f66e-be32-4cca-a773-86dee5b24887', '1558', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('85495191-a4eb-486b-958e-453c55a30599', '1158', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('85b44688-a580-4c49-b3e9-a08514450ae3', '1211', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('85db5776-03cf-4894-a5df-8840ade69cd7', '1570', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8723febb-2f99-4a7b-8114-3df384afc55b', '1361', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('872c342b-286b-41bb-8462-aa185e8aa232', '1076', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('876aaa0a-192a-4984-b87c-35de8ceded3f', '1259', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('87e52219-a1f9-4795-940f-a7de6e854523', '1630', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('88224eec-cd88-470b-9f80-12913a6cccb5', '1453', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('88fb8094-ca23-4668-9862-266dae1e8f7f', '1837', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('89527914-ded7-4d18-9970-ceb4ab212c0c', '1747', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('89918f56-95aa-4b48-a210-db57a6290047', '1294', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8a006a56-8296-40dc-9725-0f8841144c0b', '1247', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b16afc4-ed81-4c13-8f1b-9e2c38afc6b6', '1593', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b4a4b1f-748d-43a4-87dc-426dd9dedd8d', '1368', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b6b90cd-68d6-4e53-a4c9-ffed07954faa', '1696', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b7f4646-1cbf-419b-b2c0-542d45203978', '1397', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8bbfdb50-7ffe-4797-affb-443abe48399c', '1119', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8c2f9756-d0ba-4a57-a8a6-22c38c96fa9b', '1276', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8c53c2f9-cff7-462a-8ed8-4768ee7108b8', '1154', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8cac67d2-80bf-4b3a-a578-e785b07e094b', '1719', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8d29aa7b-35fc-42d2-bc9a-8786902fb0ec', '1754', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8d344b09-8d71-499f-a7a4-b2ea1f5cd64f', '1623', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8d8329f2-f5b1-423b-a7fc-6ac7eb33845b', '1814', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8dc0edc8-bf27-4397-b97f-87f44b67aeaa', '1296', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8dce3ec2-dca4-4c68-a589-75bd3f0878fb', '1808', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8e2aceac-ca62-452f-914f-0be4d7b37a86', '1537', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8f101279-d5f1-4b2b-8884-e4b34f95ff41', '1157', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8f111de5-e91e-4d69-809e-9d2c963cef77', '1783', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9004a617-4d2b-4d04-8dbc-007ac8e2a7cb', '1200', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('907588c1-50b5-4906-ba05-b4aaa5928232', '1633', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9097c620-d948-4141-af2c-32f7823df5e7', '1609', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('90989667-7606-40b9-a6b3-1665b6879f2f', '1171', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('909ed0d5-aa40-4bf8-a61d-14af4d4d03a3', '1227', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('90cf469a-bd43-4862-bc45-dea3de13a9e5', '1715', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('916f9d43-b387-461b-b53c-1d13b9b6b353', '1786', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9184f60f-2109-47e8-88a6-f786e7a62417', '1870', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('91ab8ec3-8e33-400e-997e-09c78947f8df', '1378', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('925e0754-8061-43a5-b75c-ce41625ea3ef', '1165', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9291aab4-4183-4736-aca1-2286dc3d57ca', '1628', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('92c0ddc0-4f3e-4dd9-ab31-68109e4b37db', '1764', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('931103ad-acb9-4a16-aa31-6b55d3d820d8', '1799', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('931971e2-11a4-4457-b39e-b707009d28e0', '1682', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('93b01f00-4010-41df-85f7-68f3dc84f186', '1128', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('93fa08bb-148f-4998-ac23-6e8bc7a7ed7d', '1469', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('943a0768-aa0c-4d1b-94b4-0b33d2d1a8fd', '1587', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9452915b-99f5-4234-99d3-b4171310d891', '1674', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('94867e00-ffa4-40dd-aba2-b47c2a61ff76', '1845', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('948e6420-67d1-4d62-91fb-1adbab2a0cb1', '1564', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9512114f-3932-4c8a-969a-33e55203cf09', '1761', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9535e075-e8e6-4dca-9ae7-1ef6b9218bdc', '1678', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9580c845-c541-4017-9d2a-4c6ab4993195', '1389', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('968e5f11-3e8c-412b-bc13-6d88a1485245', '1192', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('96a9c556-01ce-4696-aa8d-2e62af82958a', '1308', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('96f082c6-94bf-41ff-974a-c6ff8f3433ac', '1861', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9785c54d-4096-4a51-b276-58258819458b', '1465', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('979335bf-b113-4aff-9d69-25a89af44685', '1709', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97a1f896-8179-46dc-babf-65f819af0aa1', '1547', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97c64c35-02da-4e12-8fdd-b20208f54263', '1670', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97d4a6bb-6201-474d-af78-df9d5dd830ec', '1488', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97f98d2a-3577-4d27-b26d-84bce20e66f4', '1507', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97fbd170-2459-4f92-b4e3-e858f022c144', '1683', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('98289d21-64e7-4083-a31a-39f2856face6', '1756', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('98818c03-cb20-4e62-9c58-934f828c7a50', '1225', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('98cd19f7-97b5-4be8-8090-05a0707b4b3c', '1450', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('99db430e-f001-4cbb-b159-615ec0c71af0', '1320', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('99ea0888-f64c-45f1-ba23-9c893aa3bbab', '1190', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('99f22ad8-380c-41e5-a51c-2d20f7024235', '1567', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9a0f2dc7-6e89-49e2-a716-35dfa1b4cc64', '1883', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9a765a09-6dc0-474b-8104-9c9cc7b231df', '1126', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9b2ed4c7-0296-4499-a1c1-1c0945a5e9eb', '1836', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9b95426c-e739-4c23-987e-49db8d71bd97', '1155', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9b9e956c-d21e-4ca7-88c7-ecc04f53fe96', '1691', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9bd247a2-f6c9-4084-af8d-9dc91387329f', '1594', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9be36904-5bd2-4ee3-9f9f-f5755123da90', '1796', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9c8cb255-4fcb-441e-8cab-92e81820d418', '1207', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9cbc1f8e-c770-440a-944c-97ea9ba09ebb', '1113', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9cd67e52-bbac-4674-be2d-f3d5dadc0fe1', '1400', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9d6b00ce-8326-4ae3-8494-229b14a9db55', '1233', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9d6f420a-bed2-4741-a98d-e12e7a36f7a6', '1228', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9dceaecb-e188-462d-ae6c-0038082a5ffe', '1677', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9dfa5498-1515-4549-8bbc-ef1f9d41674e', '1153', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `std_student_class_stream-beforeallocation` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `academicYear`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('9e003ef4-4691-4f7d-9553-73cc91a5f4a0', '1066', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9e06e105-de21-41aa-84d9-16ec0fa59e65', '1690', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9e5cf128-633e-4a0b-81d1-ff3ec56e15fc', '1865', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9eb07478-d095-4e98-a87d-209b3e0cbbff', '1545', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9ed98ec0-f1fd-443f-86fc-7b832fde5028', '1652', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9f29ee1c-e043-45cc-8d37-c4db0dff9323', '1659', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9f53ed49-5cbf-432b-b8a9-69b1a8f6a863', '1257', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9fab3f6f-6847-451b-9aa3-9dc61677aa7e', '1288', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a01a9ffb-dc29-4838-8581-b6fe2367faa8', '1590', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0358171-4400-4dbf-9ae4-b0ba606f539d', '1781', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0abbf02-42db-4ecc-867b-2acd58098af0', '1477', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0bcc285-b2ff-4fe7-86ff-fd9f88386c9a', '1551', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0d8d7f0-9720-4587-9679-174272102752', '1656', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0daf630-45db-43a9-a8ad-31349d4c0bd1', '1697', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1495693-8580-484c-9591-82f2cd78f74e', '1177', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a152c5d9-2171-4fff-9a8e-4fec4fe6023e', '1734', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1a372c1-4cc1-40e3-a2e4-819e5753dac4', '1776', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1c477e0-eb3b-4292-a1a2-3d995a7c80c7', '1755', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1ef5b96-d646-40d5-855a-ad17c36bed36', '1457', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a234a8a0-ed23-4552-863c-c0312e15feb5', '1395', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a3478075-e311-42aa-9b01-6b87e328bd9f', '1788', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a4220c17-ad65-4f85-9419-026f876c0dee', '1240', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a4366a0e-949a-4155-9239-8095dcf53cc5', '1359', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a437240b-ff37-4313-9a2a-f517a83862a9', '1549', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a48302d0-dbdf-4b4a-b051-b0bb7cdbdafe', '1859', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a4ef767c-96ea-4011-b1ee-987ba5d48d5e', '1298', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a52160fc-2f19-47d5-8da4-93082cf89b4a', '1212', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a52fdce7-667b-4e0e-8865-2f8ac2601d47', '1458', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a6bc4cc6-55cd-4753-b301-22d3c2457242', '1802', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a6da9d40-48b6-404c-bb7a-902a27b835cf', '1426', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a6f07d4c-2439-4dc2-bcd4-a28b848a3d44', '1625', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a7b23916-6ee2-4424-bed9-1fc153d65e5c', '1504', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a7b63f86-b3fe-44f5-9d5c-cc19b7aca132', '1738', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a7e3a36a-efdc-4bdd-a371-57f45a12c935', '1896', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a808059e-fbc8-4ebe-b9fc-29a8af6670d5', '1148', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a90b8da3-19dd-48b0-a71f-624c0fb1161b', '1204', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a933a749-0219-43cb-8f72-0283d9c5f07c', '1352', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a9b1aedc-8db7-454b-bafe-4e388e29bb59', '1187', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a9c8befe-ee82-43d7-b544-bfef70fa8027', '1546', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('aa52e999-3a53-4ece-b218-0db96544936d', '1271', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('aadec016-f450-4221-a81f-1eb12a0b984e', '1470', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('abbc2227-0947-4b9e-a6cb-3f0c4bb8b921', '1425', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ac61d576-aa98-46c5-ade9-537715186eaa', '1131', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ad0c833a-9e6e-491e-960e-6674795ac56a', '1548', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('addf2600-5d5e-4bfb-89ef-e4c5759d2654', '1107', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('af2fd647-b67f-44fc-ae81-d0255363c395', '1175', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('afa82769-ad29-43e4-8dc5-ba270d7503c1', '1586', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('afeebe2b-d191-4c21-8365-b0caf684bf0e', '1149', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b0ae60cd-76da-43f4-8678-b6d36a5eaeaf', '1514', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b0ff275c-f41c-4958-89c2-07efa1e39488', '1645', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b12f5378-0928-4e66-980c-1f8f3152a4aa', '1238', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b13e0ab1-7ced-4420-b801-5be2622de818', '1085', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b15602c9-b4f6-4c61-a377-65eb4459b66f', '1446', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b204c929-b1e4-4eb8-a7ac-f00c62fdcaf8', '1654', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b2142737-c2ea-45c9-88b9-bc7e11ded9bb', '1784', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b260bd33-05ec-42f1-a905-0b4d1309e17c', '1270', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b27d34c2-4c6e-4a6c-a18e-09b0ba8d1da7', '1125', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b3021521-43df-4dab-86d1-02e4d4e70cab', '1064', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b323088f-174a-44ed-bce3-ec71903b64e7', '1571', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b3961e79-c5f9-4b80-bd6e-489ce369af82', '1094', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b43347b0-51c6-4955-b26e-3ce7dcd568d4', '1744', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b514565f-2cea-4bdc-a6e7-5c77b057a052', '1725', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b51f7155-2ca1-428f-aedf-80fbc745c5e4', '1063', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b59ebfca-7b04-4ca1-bfaa-a428fb42ad90', '1535', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b5c2b157-1734-4ea2-9a60-227121620571', '1203', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b755c1e3-1774-4618-8c7f-e9f92e15f873', '1078', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b8a28552-3c9b-4ccd-9dbe-0c8a2f9487a0', '1562', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b8d2aafb-b044-4b16-b7b5-e309d43a2185', '1647', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b8f76062-639f-4fd2-b348-f53d9a7fa2fe', '1811', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd7', '4da9d182-6f65-4d7c-a097-67c8924c8201', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b9a78d7a-5d46-4c4e-92ca-66fce764ff23', '1305', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ba08757e-d35e-44a1-a6d8-7d75ee9f5125', '1573', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bade03ad-4ad6-4ae8-a659-a310f5da5d80', '1801', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bae760f3-2ccb-4366-9f6e-d4d4231902f1', '1406', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bb79c8c1-9952-4c20-9a52-3b52756e0aaa', '1208', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bb80b24f-7255-4ca7-a287-5a252c87f5f6', '1841', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bbd8f715-a3a1-4133-8116-f6f5df743e7d', '1743', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bc1be2d0-0ba8-4919-adeb-252ac25e0a20', '1444', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bc9e4d0e-7fe7-41c6-998e-9de38e8faa60', '1272', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bcaa0d31-715d-43ca-afcd-2a35101f9026', '1876', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bd10f4bb-05ba-4eaa-aa25-f89432a3caa0', '1616', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bd4a72a9-00ff-4e2f-a982-189a674c0278', '1108', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bdb01cdd-f585-4b08-b07e-cc9571184b36', '1223', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('be689b8c-5e0e-40e2-a172-8993c70847f3', '1485', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('be77dc05-7b09-47b0-a6ef-af437992c103', '1086', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bf5d40eb-6d27-4257-8428-1de3e8ffe52d', '1595', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bf6aebe5-4419-471e-9208-3f3de77df83d', '1224', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bfc0451f-7a50-466c-92ee-eda5643fece0', '1566', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bff80dde-a2e0-4827-b896-d8c5bf4ad023', '1431', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bffe0377-5db0-4c6b-992b-97db5b2f7ad8', '1766', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c0605c5a-c083-46e6-b22b-6f3716921b7c', '1648', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c0ddc5c4-2eee-4525-9d81-f7bcf5749cbe', '1138', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c0fba405-ac3e-495e-a667-836156cfdb9e', '1376', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c140bac4-4801-45da-a84b-a63917d4d897', '1337', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c1a64788-df9f-467d-a23d-83f80f101ee8', '1506', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c1f705ac-45cc-47d4-9ef4-4d45d5c4489b', '1090', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c214591d-1b5e-4985-9cf2-ccf55a8157fa', '1358', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c225b758-051c-4222-875c-c8d50b5535ea', '1563', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c2b617ee-2ef6-4bb4-a90b-2307d86390bd', '1420', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c2e9af4a-0de0-4035-9c68-91cb2d2cbf6a', '1803', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c32487b4-5ece-4c30-bc6f-6cca5a836e69', '1189', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c3511f07-5e9e-43e3-9917-4d76d62016bc', '1323', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c35d469e-48b7-441f-ab30-2e5112669005', '1820', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c3b64ec1-a30c-43a5-b297-4cd0d2101f62', '1363', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c3cda3b1-b0ab-404f-a11f-af67139cc9e5', '1577', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c412e9d0-9e92-4a0e-a793-921565055e14', '1429', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c4369322-f31e-412c-8791-79b4df53f99e', '1712', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c44c5f3b-5824-496f-a112-8b27a82ccb72', '1499', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c4e9671f-b790-4fb7-ad2f-e641a2dd105f', '1824', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c53e3bb8-0ccd-4c05-83fd-ae64057b3deb', '1644', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c55d0a69-a164-4ecb-b8e6-b00f6daed19e', '1180', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c5762fd3-4853-4bf0-aa77-93c1b0b87213', '1489', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c596c862-e11b-4bfe-b6ff-20f587893aa6', '1500', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c5d48142-47b4-436e-acc2-9a6ef1c8a451', '1344', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c60329e4-a95f-4046-9bc4-870470ee773a', '1812', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c60c00cd-b8a0-44df-a896-0dd7f390d5ba', '1099', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c679e550-7cea-47d2-9376-f220c25fa00a', '1759', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c6ce9e38-7480-443f-b675-3cf4b3244be4', '1266', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c721fef8-82d0-4455-8484-ae720329d53f', '1381', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c73cf5f4-e1d5-4d71-85d5-a1e7b5bc321b', '1142', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c7633854-e318-416a-b0c8-404743aeea06', '1422', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c7a416e7-ebe3-41c3-b9d8-554ae6e5173d', '1325', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c7fc513d-aae0-4636-a945-7a8d656cc4f5', '1679', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c81f3829-5311-45de-8eb6-f3903382e55e', '1854', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c82b1523-cf85-45a0-8574-53125d32c57b', '1167', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c87e5e96-97d0-4c9f-a4ee-ec942b5cfcd7', '1565', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c8cee212-17de-430f-8b87-537208729aef', '1301', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c8d8c489-74ce-4538-b193-b3e31a0e3654', '1531', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c964aee7-a071-44ab-805c-3f1cd5b77a50', '1464', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c96a6c42-5577-4f43-ac97-3e2ae940463d', '1206', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c97ff95c-2081-49df-a6b5-bb4bf2e98f3d', '1451', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c9a03006-e9c9-4583-82a3-2d646405a401', '1364', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c9c828d1-c135-4931-b6ac-2dd987ebefdc', '1681', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ca3d9a47-2bd4-4e15-b5ec-bfe0fcbf5edc', '1100', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ca3fd3c2-55ab-42fc-8a73-f532c73236a1', '1543', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ca8af109-b35c-4c2e-b199-97dd1b1b2a1f', '1822', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('caba66e5-becb-4a20-ada7-150d07862523', '1273', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cb512a6a-b0c1-4c52-ac0d-99736bd247cb', '1077', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cb9a6fc3-eb00-4de7-b20e-52c651abd8b5', '1748', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cc0d7385-9daa-40fd-98b0-60b0df16ddd8', '1662', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cc2107af-3e2f-42db-8930-50976afef190', '1541', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cc4a3094-8c4a-4cfe-89e5-51a308b17a29', '1304', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cca3c011-dcfa-4461-995e-62605c735e9e', '1749', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cd32c5f8-93fe-4e03-aa5f-8b725676c819', '1239', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cd5902c6-4275-46d6-b1ee-f4433a4c8827', '1339', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cdcf1989-9d67-4598-8015-715d0b657064', '1286', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ce513caa-fa0c-4790-8346-f13a309766cf', '1412', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ce52e6a2-7b37-4f79-88d7-d92163ff0dbf', '1663', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ce57ae11-8968-45e7-90fa-997548726955', '1120', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cfb1cc6d-3db7-4ae2-957d-eeb0f80880fe', '1197', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d05930df-6005-44db-a199-18d6a201d74d', '1512', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d067489a-d275-4eeb-b59e-25ad57b64310', '1660', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d08e1dcf-750f-4309-bb45-7e02f0d7e934', '1486', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d08f499a-a133-4fe2-804e-22cbe52ac453', '1732', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d097aca6-9e13-4e14-bcdf-863bbb7b2363', '1672', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d1004a16-91a5-40f5-a478-df4bd2648472', '1501', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d10b5eaf-9b1e-4e7d-9efa-b95542a359de', '1159', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d1a5b48d-7c46-4ea9-a9fb-41fb1412a5e9', '1612', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d1bd2188-f7ce-4f06-b4fa-14f15693c01f', '1680', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d2166fb0-34af-4869-926c-3050aee09161', '1542', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d216c329-d8ff-4544-8023-21debd22700e', '1530', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d21d4554-b265-466d-8c2c-b19da38128ef', '1686', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d28d3662-1f07-48fb-af98-642529d94d2d', '1527', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d2a283a1-e2ed-4074-ba99-f7758563c0e8', '1673', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d2f5ac83-29bf-474d-989a-7451684d9a75', '1875', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d3d56b55-a44f-4fb5-9708-3cc3ae204076', '1333', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d42eb9fa-6191-4340-a403-5e162ba37b16', '1602', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d50e10ac-2cd8-4512-9fd9-599db668a966', '1640', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5555b10-9bcf-4193-b675-93f96f136a7c', '1442', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5adc55b-ffb9-4fb9-bb54-79b125088221', '1236', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5ea89a8-ac75-4a4a-80ef-d73d6941115f', '1805', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5ec10d0-5b87-4e40-9567-2de8f97f9c44', '1103', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d6a31263-56d4-42c2-813d-31e869d7c3aa', '1666', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d6ad7b41-aa87-4bc9-a761-2bb1db35bcf7', '1353', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d6dece7c-e003-4de2-bc00-989c551d87e5', '1651', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d7678478-bfb1-48ac-b4f4-bf90e41fd60f', '1649', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d883ad7e-5bf1-45a0-b562-962f2fb43657', '1459', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d8db626c-d0f2-41a8-a071-9843c455221c', '1492', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d910a8d2-f48c-4136-b5f5-a35297ff58ce', '1118', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d93d5866-efea-4935-9ecd-a5ea4f44b83d', '1280', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d942a028-fca5-4384-9ea8-dfc1127ff76f', '1771', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d964de1d-bbd8-4d49-b645-33e9685a1a33', '1101', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d9b95853-e165-4d33-81a9-12883fc75233', '1115', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('da5a4145-a264-478a-ba1c-7d7064c6bc76', '1143', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dba2d664-d606-4294-bdfe-52cb00c03bd1', '1151', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dba89890-d613-4de2-8bde-103ef2528df1', '1753', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dc7e6c2d-fb5d-42d0-b950-593679777ce5', '1231', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dcf99d92-f861-4742-8a33-bf5d9740ef24', '1306', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ddd5a703-34f1-43fa-9b5e-839a3caf8091', '1081', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dde1ed49-f5c9-4f2a-8cf0-41a006fcaf02', '1665', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e2345f51-75c5-4fe9-bf18-d0ea63de9923', '1880', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e37eb995-e46a-4986-a63b-fbc40a15d40b', '1230', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e3c82832-1e2e-4cb6-a7ec-f2485ee9d552', '1509', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e4388c94-639f-4066-88e8-2a13135c13f2', '1421', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e46b3baa-7f72-4a60-bc01-4f00c28886e3', '1452', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e46d92ab-7507-406d-bbc3-9ada61fc2761', '1163', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e483d066-2cc3-4b6e-bce8-757f579eea70', '1289', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e4cd57f0-a17a-47ed-b8fe-2ada113a20ef', '1578', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e4e58063-b294-4c3d-8c49-29d2a5cc0755', '1380', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e5065944-1d74-46c3-8801-00297a9b3162', '1675', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e5103113-46bb-4b9b-9a76-714bb5866bf7', '1480', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e5fae2af-2ed5-4632-8cd9-9966fb2b07de', '1399', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e68fafc8-a7ff-4964-ae2f-268e367ebf51', '1365', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e692bc3d-50ef-4c5e-8384-269bd5c75a0b', '1123', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e6f7ed62-0eab-4350-9c4a-c4628c1a2e5c', '1717', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e6feb5af-dcf6-48a7-a249-36562e332ce6', '1302', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e7ae625e-83ee-4e39-8926-78f6f473efb8', '1195', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e7b7534f-508e-47ce-89a0-4042b4ba0303', '1840', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e8cb5a26-eb8c-420b-991e-4bd3ed9262e1', '1449', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e8ec23d0-23dd-4125-ae61-27a440ad6ad3', '1057', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e914e0ad-de09-4025-abbe-28917c60255b', '1475', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e93682b4-e206-47df-bc09-536527c879fa', '1655', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e966ddac-2629-4fe3-9718-fc052729f462', '1658', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e9f2de7e-1b16-4154-8610-d9a7321428a2', '1234', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ea280a50-e5ef-447e-ada3-33d951c5dbd6', '1330', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ea47a5fd-4cb9-4859-a82c-e2c66d729a13', '1714', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ea68f58c-6f35-4c3e-9191-c0942da3e815', '1622', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eaebb16e-596e-4717-87f9-242b1499c274', '1454', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eb332d98-41a2-4b72-ae86-e8fa99f530c8', '1178', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eba4ed2c-7068-466e-a48c-bc8bcc160903', '1356', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ebc8fd9e-5753-435e-8f0b-4b64ce0d09d7', '1589', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ec112607-648d-44dd-9b45-40f4585fff58', '1415', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ec9e9664-7464-480f-8950-22f8e98c743e', '1428', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ecb70cc5-46f5-4e00-ab8d-0133a31637a8', '1408', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ecb7f9e3-8c87-4350-9a11-976d778ae1d9', '1740', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ed121efc-402c-47d6-9a4b-3d4996ac9091', '1052', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ed43c4bc-4530-469b-9abe-ebb6f6004cb4', '1580', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('edd737bd-9fc7-4195-9139-d8b71b0e20d5', '1335', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ee05deab-b7da-47db-a157-d4c6b858d74f', '1790', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ee094173-8e7d-493e-90b7-4926f24e1cc8', '1265', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ee2842fb-aebb-4b15-a866-ebcb8d336848', '1275', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ef1c4f71-28e8-4b06-b4f0-82597addece4', '1693', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ef2abc33-6a29-48e3-b229-a09f6823cbce', '1723', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eff62583-b4d9-4d09-92b3-49f2a4e3562a', '1860', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f00f61a2-1bb5-48cf-b64d-1c48e55d7ab6', '1156', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f0914664-a064-4a1f-973a-6d17e9d407b7', '1494', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f097fe97-5b80-4623-a9bd-123e59483f7f', '1121', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f102afd5-788e-4fbc-921f-adc7ee48b0d5', '1569', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1331c81-53e6-471b-aeb5-6ac245ea50e3', '1074', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f14a8b2d-b0f7-4cb2-9a8e-b80036dca6cc', '1419', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1ad7a4f-44c6-4053-8df0-0ab23d602271', '1553', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1add0a0-262c-43a9-a381-2bb5daf83439', '1757', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1c37068-700b-4a4c-bc4b-89dbc479041f', '1838', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1c7f924-64a9-4038-af69-e95102b1cf49', '1297', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f20eac66-31e9-4173-964e-7c2012816fbb', '1588', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `std_student_class_stream-beforeallocation` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `academicYear`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('f2c73552-8ebe-4202-880a-bb192752d2ce', '1392', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f3772942-e41c-4ffd-96c7-1e97b3746d52', '1354', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f3ac7b35-a004-4814-b7a6-ecab231d7040', '1902', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f3c12cdf-2b47-44b4-832c-d14e38e23d37', '1053', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f3d78d42-23fe-4d16-bb29-fed561d0970e', '1708', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f404acd3-d486-431e-bdf2-f49a9e9257c4', '1214', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f42aa8a2-2568-4dd0-bbd7-5b194c90869b', '1487', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f49bc2b0-5ead-41ed-8283-aaccefc40522', '1632', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f4a298ed-8de2-4956-ab8d-138402cb4654', '1332', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f4c510fa-5f72-4e42-9a34-705ea536e06e', '1210', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f4dce0cc-9516-48f7-916f-32f666825c09', '1146', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f540943d-7c45-4cb6-b121-828ba3ac370a', '1829', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f549bd9b-a3b6-4878-8438-be4c038dfb95', '1215', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f5ac36b4-3eab-48df-859e-053d14aba5f9', '1435', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f5d067dd-f5c5-40f9-8b79-9e9612db8576', '1396', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f5fc7ff0-65be-40ed-af76-65cd58f959dc', '1174', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f68af453-2cd5-4e26-97db-c3ea72e0b712', '1611', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f6dcd68f-621e-4d16-bb74-896f84578f2a', '1627', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f71edfc0-51a4-49a5-a840-c03bd03290a6', '1629', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f739711f-63a5-4a96-8dd6-005120804e78', '1869', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f7916185-818c-4451-ab6c-4395b5ba5b92', '1874', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f7a4d191-a927-431e-9765-5737dd62ffdf', '1114', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f819cde9-ce54-411d-9a02-d2341151b90d', '1427', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f862afbd-ef42-4247-bee2-c94c1d4183c6', '1386', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8b0d6be-01bb-4006-889a-d6b0f8daed4c', '1170', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8c7e455-e184-48e5-8517-4e146e869cbf', '1291', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8c8007d-1b0d-4ac1-a10f-94f5a4265256', '1599', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8eaea02-85de-4569-89a2-47345fc6d597', '1209', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f91de042-072d-4954-8da0-40afe2d7eb8f', '1774', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f9cc1c70-ea82-466d-845a-792db9cc4f7c', '1591', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f9ee4b54-2b89-4e35-9797-c5e9f764bd55', '1848', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f9fb0260-2fc9-409a-9af8-4aed045d3a55', '1162', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fa2b6b74-5cdd-4d12-99cf-54e1045f27c5', '1135', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fac48de8-5cd9-4bb0-8393-f99c54d8fba8', '1668', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fb3450f4-cd7c-4a39-af74-8adf66148a0b', '1056', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fb94b19d-43f9-444d-a3c1-f7fab2416576', '1315', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fbae3890-1f34-48a0-ba5a-79e7a62743b2', '1555', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fbc051af-8466-4b02-9745-e651b356600e', '1072', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fcbd2004-83f0-4535-81de-7ff19efdce81', '1188', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fce76e54-cbad-4c37-9f15-678db87e09ef', '1404', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fd5c5bba-4193-4a40-a910-01add82ebd42', '1351', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fe143cd1-413b-4c2e-bdaa-864e613dab60', '1575', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ff3b09b9-54f2-4313-921b-ef045ac69fed', '1202', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ff3cfc1c-8fac-4de4-a28e-811086bacd64', '1517', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ff4628c4-3462-4024-8893-fd8f63bf9034', '1070', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '2020', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `std_student_class_stream_bak`
--

CREATE TABLE `std_student_class_stream_bak` (
  `id` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OrgClassStreamId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `SectionDetailsId` char(36) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(99) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `std_student_class_stream_bak`
--

INSERT INTO `std_student_class_stream_bak` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('001b217e-8a94-442a-bc7e-4a7efd492997', '1735', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('01ae78ac-fb7b-42ad-91d0-0c68a14d6014', '1728', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('01c42d55-34f1-4f7d-b687-4a34ff240fbe', '1385', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('028d0b5d-6063-4fcf-8b1d-31f5aacbc9ac', '1140', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('02b089e3-31de-4d2d-9a59-762c2d7f94e5', '1782', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0340dce1-f0c7-4d2b-b7b3-785f48fce933', '1377', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('03e2c753-cd12-4b26-9e2e-bb96f2ba067c', '1618', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('042f32f7-6e44-4e98-8b49-b72be0ca006f', '1261', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('043a3f85-d491-464a-b5ea-48c5e6ad1846', '1300', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('04b72b62-28f4-4a37-a8ca-2e7e7e7421e5', '1285', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('04e09114-444e-450e-b84a-747bd598d976', '1326', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('052366d3-9321-4838-b49a-410ec87bbac4', '1760', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('06171cbd-f6f4-43a8-97e3-ce927e8ec017', '1145', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('066699e9-3ef9-4773-b491-f8b8810ab455', '1199', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('073c0e40-a53c-4ca9-8818-04dec21a14b7', '1394', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0772038a-4368-4aeb-924f-e2ab7b884c16', '1436', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('07907578-4b14-4aa1-a02b-03b7ab9f8b5f', '1539', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('07b09bf3-9551-4c7e-b1b1-063fa9a235b9', '1615', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('07ef329a-886d-48e8-931b-c5a01096eb55', '1336', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('09a4362f-d168-4005-b1fc-648eb5497580', '1592', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('09b7330e-7aee-4b42-b709-55bd88d6bd3b', '1684', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('09b7ee1f-f25d-441b-995b-cd58aa903b13', '1867', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('09d978a7-c38e-4330-a021-c6135fc76063', '1083', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0a1ad8e4-c30c-4ea5-9487-e60f0a0e0347', '1726', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0a4e4b1e-5d56-4508-926c-9ddc06cf34a6', '1574', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0b1bced7-f636-4b5c-b6b5-b5ad8663aa92', '1316', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0b7be1f2-2d13-4b16-9b69-3756134aabf0', '1089', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0b8f5f4e-7be4-4769-b203-eca7da0fd2e6', '1700', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0bab56a6-3c3c-4999-9e13-7bfbb92f4f67', '1414', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0c0cf5fc-65ab-485a-8ba2-605b26928e10', '1256', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0c31134e-6e55-47e4-85a6-75c526511336', '1287', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0d75a2f7-4c30-4ced-9118-1c5d81893f96', '1087', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e074060-4551-4476-8767-264db9a2a81c', '1513', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e4c9253-a64e-408e-bc88-7c4781a17535', '1899', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e581d2b-6445-4351-bc0f-5f3944839f47', '1502', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e5c463c-294c-43fb-aa17-e8ade51f6141', '1703', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e784574-fe79-4d5f-b9fa-66ee7b014e29', '1597', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0e9af89d-cc73-4df4-94cb-c825ce464d4f', '1348', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0ec459ef-f746-42ef-aacf-2d4efa4d7812', '1604', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0eec0c21-9726-46b2-a829-ad6868a37fac', '1810', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0ef67011-1576-4ce7-b8f1-ce5b7619a9eb', '1284', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('0f603460-ccae-4fcc-a80b-6c02efeab22a', '1106', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1002e52e-9c67-4c5e-9141-921bb130ca66', '1357', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('101ceae7-9b0f-41f0-8724-895be7b2ca2c', '1828', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('10726a64-965b-4306-ad4d-6df52f65c2da', '1745', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('11dfde20-5990-4a01-8710-b1a3081a7c47', '1603', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('11f4a638-a82e-400f-8a5c-325ca5f88a4e', '1463', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1231c2bd-ca0b-4a98-b122-c9b801416a24', '1731', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1259a24d-a531-4dd0-b442-ac501198316e', '1382', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('135d3145-0b0f-429c-892c-f844960f8ac5', '1371', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('13b51f80-5ab6-4511-81f4-560c59d8455d', '1582', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('13c703d9-0640-4f50-a96d-005e648ffc5b', '1493', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('141fab67-3fb1-42fb-bdae-65451aca64c1', '1619', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('14429fa2-aeb8-4594-9546-66c13c7a28bd', '1888', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1535559a-6a66-48af-82ea-29554f046f76', '1598', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1590d067-aa28-42f2-b9b0-a6908874e615', '1724', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('159231b8-208a-4a5e-8e49-143ef804d679', '1524', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('15af2673-fc2d-441e-a335-2cc91a7cea50', '1327', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('15b61296-73a3-466e-9768-22e5ab7d0087', '1752', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('16a96310-bc41-48c2-b524-bae5ba9d6aa1', '1608', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('16b9576d-e214-4422-aa23-9c876c38db2e', '1061', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('16c7e63a-126a-4e2a-837e-85b7eb0e3137', '1544', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('17056301-4773-4b33-9a67-6e61ad776fdc', '1346', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('173f5d78-8929-4ed6-84f1-e9cc60ae1325', '1176', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('17ef1c9c-c7b1-4f21-8acd-ea12f83ad183', '1232', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1823aae2-86c2-47dd-a18d-ab46582339fe', '1309', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('18ff5b37-ffcd-4fb4-b3f9-1dbdd64b6cd8', '1560', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1975b054-dace-46c6-afae-4cba372b3023', '1789', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('197e347b-23ab-403d-acf6-2dab1d2df555', '1362', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('19fe7da0-ea90-42a1-a3da-d07dd6a0609d', '1741', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1a355c53-733a-4dad-b4ea-6bcde1c5781e', '1314', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1aac2208-8435-4e02-b879-8d8d74618db9', '1750', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1ad50755-da92-4d6f-9bb9-72e81317ba95', '1687', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1aeee824-18d5-424c-be2a-9a230ed301d6', '1505', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1b5977bc-7622-4d88-83f5-feac0b9326b8', '1538', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1bc2f2db-069e-4c01-b629-7d75b906b29e', '1122', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1c2da722-49ec-49e6-a1e3-16b3ca4779d9', '1229', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1c3679d2-8432-4b5f-8294-a683d14d826a', '1857', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1cb4be8d-2c32-4bd6-ab91-4f02af5386f6', '1319', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1ce5f332-2975-455e-8525-dd04570faac4', '1638', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1cfb2c33-1a7b-49bf-b515-5236c032280d', '1733', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1d0fbbeb-0eb6-4032-89c5-5dbae0ad82a7', '1600', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1d5a3ea0-fef7-4ffd-b983-9128cf384ff8', '1521', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1d718c04-f070-4fbf-8674-a57633199f38', '1572', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1dca2a73-c195-488d-86f4-a3d0f5bb30e7', '1763', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1e3cac0f-d2b8-4b4c-8dba-87940d8dcd0a', '1129', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1e6dc62a-c79c-44b3-b54c-f93b489938f3', '1062', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1f7b5a7c-68af-4693-8019-aaa73da018eb', '1169', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1f875709-c3a0-498f-b3f6-624240d145c4', '1669', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1f95bfa5-97c8-41f8-9bd6-0cd3cd39dd7a', '1519', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('1fc363f1-377a-42cd-9b04-27986f14f799', '1471', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('200c2e90-6ef4-4818-8d72-7c7c0c6533ee', '1853', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('202d0aa1-b8ce-4631-860a-7ca88dbb8817', '1637', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('20549240-fd6f-46e2-818f-04d536cf5700', '1596', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('207f6e7f-ec1a-483f-a472-5922dba89e88', '1711', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2093caab-81c1-4c70-a9d2-d71b6c5ed394', '1324', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('209ff9d1-6326-4085-8e3b-a7b87c038e91', '1097', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('20eee4d4-7338-4d02-8b94-ee6a5ce06209', '1529', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('21207ef5-6668-4970-8c9a-6620d3b81e15', '1136', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('21aa5128-e7da-4bc8-93c4-f81eba1f77ab', '1835', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('21c17e64-d85e-4a34-b9d3-d8fb7c52255c', '1483', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('22161b09-dba3-40e0-9024-6f9dbd07a643', '1184', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('221b0c07-69f9-4ba5-ac0f-cce6574165a7', '1482', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('236a1322-e861-4779-8531-85f4d87aad95', '1181', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2385e47b-f0e1-4a22-955e-eb89b2ba17fb', '1528', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('23dc3954-e34e-4983-8c37-22827e089297', '1832', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('23dfdc18-d9ad-4dca-9662-cf8fa792997f', '1441', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2406b684-7ce9-4e52-9749-b07b6ee31f22', '1310', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('24097ca8-6e55-4a90-9724-b312b18cd3b2', '1220', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('240f4f35-596c-406a-81f2-828172176157', '1182', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('247a196d-199c-430b-8323-44f2725c4904', '1088', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('26445f55-dbad-4955-80ab-a45e7246943c', '1533', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('268c37a0-37ee-4e43-8244-b2fd1922c03e', '1264', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('26b0c42d-622f-4577-b899-91c9c9cefd88', '1226', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('27bd4bd8-d48c-45a0-9450-6f6dee1d3a6d', '1807', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2815cbff-0163-4a28-acf6-fa0314883cb0', '1522', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2816d50e-20bb-4f7e-9680-369afc545d43', '1751', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('28cc9a24-287f-4e5a-814c-cad37282a98c', '1688', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('293fa855-0ef0-47ad-8ad3-3cf4c6ee6d07', '1065', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2945f2f3-7f9c-4f60-951a-5a9ecfb3999f', '1765', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2991ab08-9147-45bc-b8bb-0cf2ee8f45b8', '1054', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('29db32ed-4bc5-47e6-bd06-084675606bd8', '1878', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2afa240f-5691-4c19-b147-04c482aeff19', '1416', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c16052b-3213-4ea9-9ebe-bb39b24778d2', '1685', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c16fa6a-2ce9-4e0a-90ad-932cf801eb80', '1161', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c1988c7-32e7-4f68-b31a-5e81486f9e93', '1313', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c6ac560-2d3f-4fe0-8f46-b740289c96de', '1770', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2c8e1c71-d01e-4193-b570-becdee0b0459', '1111', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2cb5bc44-8162-4714-bc47-b6a775a89415', '1127', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2cdd8efb-1051-4aac-b772-cbf3d58c067d', '1720', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2d0f3e89-4c26-4b38-8ca2-303e310ccf72', '1718', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2e5debcb-d4e3-49ac-9db7-05400e11fb29', '1556', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('2f6c01a6-9e4e-45cf-b2ba-05d6517807b0', '1856', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('309f6422-467e-4264-97b1-fd8205c116b0', '1872', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3157401e-004c-47b6-8a61-cdad8af85fba', '1218', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('317dbf88-18e3-4d7b-8f2e-fb55e1590c31', '1058', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3215fbb0-7563-46c6-af26-d55ff25504e3', '1387', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('323c9600-4fb0-442d-9567-feaf93adfa7e', '1141', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('327ef611-ea2b-4d26-9181-2c5ef0dc7b1a', '1701', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('34c50933-3312-413f-9de0-024d4d2d3236', '1635', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('350c2444-04c8-4d8f-b511-03a0d4c5a2a9', '1613', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3515bc25-6570-40e3-9a6b-546386a6ac11', '1388', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('351acf0e-9171-4790-abde-37439ed3b8fa', '1096', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('355e6025-d4f9-46cf-85df-3841c094abcc', '1418', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('35a6f020-b1a0-4789-afd2-e1e587a44fcf', '1059', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3607ff26-5e0c-4aaf-b42d-f5318f0df21d', '1526', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('36b5cee5-089b-4e71-af5d-8e589c119964', '1866', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('36f2e6f1-aef3-4744-a126-153cf056ed69', '1699', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3734305a-f202-4097-aea2-ca9326604d04', '1610', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('38e4567c-b982-4279-b065-9df5eacfcfeb', '1606', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('38e47171-bab7-4b03-8bed-2413a3c20ac6', '1217', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39212276-6660-4eb1-b4a7-f9f08e415a56', '1497', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39237f1d-e073-4a37-88fb-72bbdc8c854f', '1468', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39b3c1ae-fa92-43e1-abfd-21c269a015f1', '1472', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39b6a052-5fc9-4212-9c91-edba1871e465', '1813', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd8', '4da9d182-6f65-4d7c-a097-67c8924c8202', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39d73e8c-db70-4b64-9eec-3aff48ff158d', '1355', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('39ef2d30-64c6-4262-97da-73e182b282db', '1268', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3a92bb3b-c8de-4ee7-bff6-c9157e33499f', '1269', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3ad3130a-319f-4a44-84c4-a0a33cdfd24f', '1511', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b286e87-8cdf-4cba-ab66-4069100b69ad', '1430', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b2c900a-6160-4925-b5e1-1c0b92d54eab', '1642', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b4d85af-a6e4-46d7-aae2-cf9977338652', '1885', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b594cd3-2e44-4bed-a818-4640370ce5aa', '1424', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b608951-e04b-4c8c-9736-096d27657373', '1194', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3b6105c0-2bef-4f79-9742-896cf619252d', '1839', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3c7cf389-efed-4f15-ac9b-24b727841ea4', '1557', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3c7e7e62-a6cf-4e35-9f58-a6f621186ccb', '1263', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3d108a34-40c7-4d0b-ab9b-cd3b116e9dff', '1844', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3dbbb718-8775-4951-9ae6-e75603df24e7', '1706', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3df7a82d-bfc5-406d-b1f4-79c55eceb1d6', '1516', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3e1c2ca7-b61b-4339-81f1-29b36356fc6a', '1815', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3e2a04ad-3e77-41d6-8541-f63e1b549f44', '1474', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3eafcc27-8420-4214-b84d-ebc2ea79f694', '1695', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3f4b0bbc-9038-4a50-975e-5041bbd4dd9e', '1283', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3f53872c-73cc-49e7-a632-cbdd7c012cb1', '1554', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('3f6701bb-b047-411f-8a94-235e0315fb0c', '1092', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('40a7d7a6-22fe-4f36-836f-714d0cc01044', '1793', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4111105e-16b3-4e2e-b326-148c655981c8', '1473', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('411bc447-c7ca-4dd5-b8a3-bb9bf1252be0', '1455', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('41bcb209-ce37-4619-a122-3106adece002', '1692', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('41d92839-53b1-48c9-afd9-9e1a2fc9e577', '1773', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('429a1762-65f8-4143-b4f9-c3b5aaee14b8', '1621', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('42ade444-eedc-45c0-beef-9b18795c2f71', '1360', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('42ee23e6-dca3-4a3f-a869-65cb70fbf6f0', '1193', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('43b09dc7-8007-416a-bf9e-f0a2491d7b6c', '1443', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('43edeb13-bc57-4147-8609-0523e7569e1f', '1460', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('449cc9af-b9ce-443d-812a-3b2b2a241ec4', '1707', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('44f17f4c-c009-4de5-a6a1-0126a4c0697a', '1671', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4564f25a-04eb-4d60-aefa-a7416c29b587', '1495', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('457c0bbf-cffe-4d32-858c-bf4a78ea2046', '1657', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('45a56a83-7bdc-44b7-b8d9-1880db982673', '1374', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('465489f1-5102-468e-9639-488bade764bb', '1797', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('467d6d23-ab76-48b4-829a-a0dc01fa776a', '1579', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('46a90093-02e8-4767-9c34-208ad29722b3', '1466', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('46dbc2e0-d7aa-4747-9636-40ffd9067b4c', '1391', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('46ffdc69-4f66-47f2-9df0-e58478faa1bd', '1525', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('471ce607-43b8-48d2-be33-7c5d46ac9766', '1689', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4781be26-5666-4e01-82f4-cfb2365f061c', '1340', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4785a359-9793-4492-a5be-bfa522afc2bc', '1481', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('47fa9b31-c204-4564-b79a-ddd3c6ab6121', '1448', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('481d9eeb-70f3-4715-aaea-edb09a90946e', '1833', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('482b2f4a-d5b3-4e2b-893f-ecdec6b1f64e', '1440', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('488c4727-60d5-4e32-a7ca-3d24d6d55830', '1060', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('488f3121-7c20-40e5-bd0d-57e983ab18dd', '1407', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('49081b01-9dfe-41a3-b4c9-15d777c66b5c', '1079', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('490b16d6-8e38-4149-af79-e3fb2b6effbd', '1109', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('490e4f33-4db8-418c-a8d2-89adfb015f6a', '1139', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('49295f76-b25e-43b1-b0bd-b3813f3c8620', '1205', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('49d4c369-7aeb-41a5-9333-d2609490f328', '1405', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('49dbf65d-99ce-4aa1-a4ab-8f624fe8f0c2', '1842', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4a6a029d-bed3-4eb3-babe-a7e9be8a40f5', '1091', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4aa5efa4-b651-443f-a50d-f121d8b0220e', '1601', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4b1a0a51-08d6-4e8a-83a9-e4009b4eb276', '1249', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4b2650ff-d6cc-49cb-95a7-4e9338bfa1d9', '1082', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4c60dcc5-3053-4992-8a13-9ce3ae275ada', '1736', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4c623c37-1595-423c-9230-79e4aebdd5c6', '1375', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4c722a3d-2c32-4018-9cd6-92339be6a7da', '1461', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4cb82278-4cba-43f1-8eb1-a7a4a9eab0c7', '1614', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4cdbd8c0-60c0-4abe-af27-4a5d338b4ed9', '1104', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4d37f79a-b239-4be9-af71-06bf523e45ef', '1650', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4d9828f8-d24e-4d52-a40b-d87ed57adcc0', '1366', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4d9a2705-0cda-4d76-bc4b-e73b257fa733', '1498', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4e042a0d-fade-4bfa-a131-9f0c05b8aa8d', '1166', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4e240cfe-15c2-4c2d-aa35-6061feb7afc3', '1147', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4e738246-6413-4909-9862-8f04bc815de3', '1800', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4ebf7f55-fa7d-4197-a941-f6a9e8d2a4e2', '1584', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4f493da7-4e12-4600-9060-9d401dfd9fc3', '1576', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4f522799-a357-4290-9d6d-864c8175459c', '1328', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4f6a4cb0-008c-44c5-922a-47676e74c746', '1260', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('4fcd2455-ac1c-4e56-a928-f2c5ef08f652', '1758', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50079649-467e-4339-98df-028776d11f5b', '1607', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('503577fe-8f17-4134-ad06-791b6a096ce1', '1892', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50cbfb5d-79e8-4c17-b511-c38fd312acf7', '1084', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50e4e286-ea20-40d2-9ad7-c8fb68b344d6', '1787', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('50edad06-a45b-4e76-8ab8-c56f51211ca1', '1299', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51392b55-d725-48cc-b65c-a54b7ac643cf', '1267', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('516035f3-7ebe-40aa-9065-06e15f9d0e06', '1503', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51b8d85f-d259-43dd-b4a0-9eeb45843a9f', '1433', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51d9b986-c70d-49b1-aae3-64da06359215', '1173', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51e763ef-35d0-4054-8935-c1a308b05096', '1490', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('51ee7f6f-34f0-4655-8faf-8777a8917c52', '1071', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5248ae9c-3c84-4bda-a724-bab89096707d', '1105', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5298d4c1-3176-42ce-92b6-4fbe741d6f80', '1338', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('52a594df-f852-4a6f-8809-87ed97796fe4', '1739', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('532086b4-6944-459d-88be-8d5b4f2f910c', '1581', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('53260186-c501-4b3f-8b75-c2f61e85bc1e', '1532', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('535acb2d-11ca-4c20-b92f-8b4728cfe508', '1411', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('54240fd9-97b2-4e45-81e6-de9d0ddc83c7', '1183', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5424d908-a9cb-4a0c-91c5-ab0a3a7fd683', '1237', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('550092f2-053c-4f02-add6-164a0128ec60', '1777', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('552081df-c5a8-4580-8c80-f751410cedfb', '1437', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('55656a8e-5330-4f3c-8058-8b9421da64aa', '1150', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('556d4d49-3d0b-4fa2-b758-6f0f0a405739', '1112', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('55ab26a6-1801-4835-8dd6-a1b8cd3aa063', '1646', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `std_student_class_stream_bak` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('5672ad8c-27b9-430a-900d-3d81ba48129f', '1491', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('567d2298-fd95-4a92-88b3-2518e080cb43', '1827', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('568dc0cd-61b0-43c6-aa1c-09f34352eaa5', '1520', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('572339ca-bc4f-4443-afa2-1d27d03e91e2', '1877', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5780312d-56ad-42c1-b592-8dd690118e06', '1791', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('57c0646b-f372-4c32-a155-3fd7af853699', '1075', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('57e039e1-314a-4f8e-ab70-42c181fde30f', '1116', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5816ccee-5211-415b-90f8-fd32647c287b', '1434', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('583cc260-2c51-4842-b1d5-d059c803942a', '1559', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58aa5323-dff6-4e15-92de-7d2d8e2ff48b', '1767', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58b032ae-2cbd-4c9d-a8b2-bbdd579303c3', '1476', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58c66e14-89b5-4f1c-a131-7c7a3d2b268e', '1277', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58caea2d-697d-4d7b-b73e-b6476a7e0380', '1137', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('58fc5ee2-c01a-492d-a85d-bebc844a73a9', '1067', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('591e7bc9-d058-429e-a359-bcff2d0529f6', '1390', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a05aafb-15a7-446c-9375-83d4ceb98190', '1152', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a107ee5-45a6-44c9-83ce-207d5ca28b84', '1710', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a314d0f-d3ce-4339-8dfd-876db5e56d01', '1742', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5a9f3752-78b1-445b-9aed-506f1308cea6', '1242', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5afdece5-4a12-4b87-847b-08a3f6946ec4', '1216', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b1fc6ba-afce-421f-b85a-e017ef49d9d7', '1334', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b522642-f591-48f8-a2da-c97d84d70ca8', '1295', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b67cf32-5b03-4250-926c-1cafeff93b23', '1246', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5b9e84ab-7e5c-4b0a-9545-f59029c706a2', '1884', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5bd47911-4cea-4c4f-9d18-f0501dd3f67f', '1713', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5c8aea99-4cad-494a-a482-459f5cfa15ec', '1515', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5ce2741c-c960-4853-a87a-0237b4253b27', '1727', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5d005902-9da8-4647-a9a2-6a1c57100083', '1409', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5d1eba98-d652-49e1-989e-a0be4d169d2d', '1248', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5e1a80fa-9cb0-4348-b08a-f63623a1aa69', '1445', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5e8f6810-6b8d-4762-be2b-ebde36be7fd8', '1664', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5e9dac36-8927-4d60-9bc9-a9f22fd3b35f', '1716', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5ecb0a06-eb1d-4ccb-99fb-efbea2912d86', '1898', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f03fd8c-3d73-4bf9-80e4-8c848d116a31', '1605', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f0721c8-bded-4fcd-9829-22c6184596dd', '1636', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f501a82-28f9-4695-9a58-7c241b1798d8', '1160', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5f8a6f77-f52f-4cc7-88a8-79f72a40dd05', '1729', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('5feda0a9-54c1-4a44-95fa-f62544bc26dc', '1130', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6005d1c5-8426-46f7-bc84-4ce8e6abb4f8', '1780', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('603bf7c9-0ae3-4e30-bebe-7c20e433a51d', '1098', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('605c7609-607e-424a-9afc-75b5599facbc', '1410', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('612765f4-8359-4ff0-9a30-d4e112bed9df', '1413', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('615ae683-9819-44db-8490-ecdc666de279', '1508', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('622315be-cb20-4ab3-906c-3402d0175404', '1447', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('631a266c-6b15-4141-bc94-6b7ae423212e', '1255', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('63803d14-6127-4f75-a68a-2614c2191ead', '1321', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('639c6683-df6e-46b0-a764-208368ae9556', '1641', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('640b9f3e-b082-47d3-bda2-af47ce3e33b6', '1746', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('64187a3d-df2f-4ac7-a51e-3af675e1724c', '1179', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6424d286-4a52-4a4e-83da-fb81d0312347', '1055', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('64d7cc78-e83f-4d1b-88d5-f628abbdd9a6', '1585', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('653d0e34-5484-4958-ad9b-59c9bbff85f6', '1792', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('65c9bdd3-67f9-4885-ac71-6db3dc018693', '1467', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('66a8a369-5fac-423f-8b88-f305fde5e6ee', '1667', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('66d69df2-30e7-4de0-89d2-8f2c0989af55', '1144', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('66dd2801-d35f-4e5a-98cd-b158a48fbc62', '1721', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('673ba721-cf3b-4f1b-9b9e-a7bafe4ca01c', '1779', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('673d02ca-d70b-4b68-afeb-240353d4dae7', '1262', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('67905aaf-c5d1-4c61-9cc5-b5394fbfd152', '1185', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('67c11865-62b2-4eec-8303-2aa4dab4bf69', '1624', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('68032467-0aed-48fa-84c5-ae05221872bf', '1881', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('685a837a-5ae2-4f25-b3d2-c33ddff79309', '1329', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('68b0426a-ad8a-4184-80e9-754256b2ad22', '1550', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('695edbf7-c57e-469a-97f1-de56588e9795', '1379', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('697c6d70-9f23-42d3-aace-a8ccaca46442', '1117', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('69d5db92-3257-4bbd-8640-5995e7f08a93', '1401', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('69e10052-fa7c-448f-805f-54764d9e0b8f', '1134', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6a02aeb4-1f3f-4d00-98a6-e4b095bb210d', '1722', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6a53a2f0-a877-4fe2-b772-4379d67814f3', '1439', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6a6344ea-99b9-4e91-833b-26ece365a9fe', '1762', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6ab8bcf9-c8c9-4c00-9e1c-05395081c6a5', '1702', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6af80de2-3725-4716-9ab9-ca4f08ae721b', '1462', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6b0f7a8f-12fa-4846-99a7-0151f659c0e8', '1093', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6b5047dd-865c-4705-9174-91c1b09bfbcf', '1438', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6c1f7ecc-0e8a-4114-a1aa-9ff664433293', '1496', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6c587180-3745-47a1-a047-d894e72248f7', '1274', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6c6ba16c-9d74-4e73-b4a3-8a2b56f405cf', '1737', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6daf43e8-7e09-434e-9f3f-85272b3a922f', '1307', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6de273fa-3200-45a8-9c1c-200a9936fcfd', '1172', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6de7678f-a785-4ee8-9036-5a8a895414f1', '1219', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6df31b5d-a112-43b5-bbec-75f9c4d055a9', '1552', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6e17d1e6-9ca9-47e4-ae71-542ab59bbeb4', '1373', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6f104d27-135b-49c6-80a0-a7585e29fcaf', '1479', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6f95dae6-b9a6-4eee-a5b2-3329a952efad', '1235', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('6f97405e-2a68-4199-a1c7-c56a420dbd02', '1331', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7001688f-c9ad-46b3-8927-70b0b73548a4', '1186', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('703d978f-9e88-495b-aaf1-d95562cc8b55', '1583', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7049e856-eac9-487b-8b28-1fdcb369200c', '1164', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('70a53a80-90c2-412e-9963-59bffdfa32dd', '1124', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('70ec6825-960a-4fdd-8880-ca6f27eba55b', '1417', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7153485b-b4f0-4ef2-9b2d-7019041bde16', '1342', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('71c26c01-1077-44f1-9f58-77a5669047fe', '1794', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('71d6c911-5346-4138-b12a-a4a030c7c8da', '1634', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('729a516d-4c96-4137-865c-b9cc95789cc2', '1882', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('73fb88d2-bfdc-4243-81c5-db22f4cc319a', '1133', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('743dfd2c-aa7f-4302-80d7-4ffcc292d1c0', '1198', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('744e1170-a027-48d7-a32d-f7685995739e', '1661', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('749358ed-0c8e-4b2f-a468-2340d5fb75ba', '1785', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('74a16c05-0703-47d4-b013-e21dfd06c17b', '1523', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('74c49725-a579-4ac0-a0d9-46d6365ac9b9', '1804', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('755a0fce-55b0-4cd3-bb46-42ccad992a78', '1279', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75839a04-b094-4b78-933c-13c619928910', '1868', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75844b2c-4ce0-44c3-96ec-011cee8f74b8', '1871', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75949488-38f2-4cbd-a2eb-13f9976b15b5', '1095', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('759c6b2a-08e5-43b8-b33c-6069d477355d', '1110', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75ec0d71-cf7c-4aef-9bbe-81631f2a3c33', '1676', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('75ef4871-1251-400e-afe1-55f3bea04c72', '1705', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7626ba0f-2da6-4364-a3ed-128b13a23200', '1423', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('76f0c4f5-765c-4fcd-9512-24e5be976cd5', '1168', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('77c7d70b-e062-4281-a7f0-c8cd6568328b', '1778', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7819732e-ddef-4dd7-84d7-a82d88773af3', '1073', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('781b89a0-d9ce-4a95-b631-13dec1655c01', '1102', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('786d77ec-6af6-4776-ae33-f346bc9af75e', '1643', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('78bdb8d0-af77-45dd-86c9-acb5376241e0', '1536', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('78ee91f3-47e4-41ae-a51c-14903c166746', '1775', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('795c9ee7-fae3-47e1-9c53-fbe848082d89', '1393', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('797e5928-7c1f-41f4-a6cc-dd8bdf3b95bc', '1653', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7a4e2868-48b7-4a51-add5-ec5184295a6c', '1398', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7b0dbb3a-fbd7-4c63-b232-62f5888922f4', '1068', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7b34c7d5-d057-4c86-bd5f-bc11a186b12a', '1191', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7c690ef4-5e7b-4aab-892c-888ab392bde5', '1347', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7c6a6d56-b771-492a-9ca2-aa590067d255', '1568', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7cc4306d-5bc1-43cd-8320-bfbaa5e80f4e', '1222', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7d3f7397-d391-4819-9f81-fcdd4c313aad', '1213', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7d7ce568-025a-4618-a213-8cb0e33be7d0', '1694', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7d91ee56-c177-450d-9307-ee104317dc79', '1080', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7ddde03f-6356-4f49-8c99-20aa024a6b3b', '1639', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7df90339-91a7-4a47-8a30-b5e56ead713d', '1862', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7ebf90c0-2058-4a81-aee0-8aa576ef9cbb', '1311', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7ee6ec3b-1500-4378-a27d-39abab9d1a14', '1432', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7efd8b06-3322-47fe-bbb2-42fa66881b75', '1132', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7f0af6f8-bc5c-41ef-a2f3-5e3442dc2289', '1561', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7f326384-3098-40e2-8de7-76f9d9c8f472', '1369', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('7f3f8aa5-5ea7-439e-8e44-6eaf5f0f087c', '1367', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('804e46e2-d18e-4f5a-9721-00b1ff88a804', '1478', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('80920309-8aa5-4b2c-bb42-f826562709eb', '1254', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('80b881ff-e7d6-4b58-bbbc-4c25b7072129', '1704', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('80f9e475-4309-43f4-a607-7d4b14cf95d9', '1069', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('810ad00d-e838-46a0-bc9d-486cd13f5552', '1201', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('811af3af-b9de-4638-ac5a-ab25c8e53fa2', '1518', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('81204a51-cbbc-4d4f-a8cd-551b4c992887', '1626', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('81e699bc-9f63-4282-8726-447ef33fe237', '1534', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8212cfcc-c20a-4ba8-9d23-d655a46b245d', '1456', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8225565b-5e05-4642-a415-98ae87a71048', '1617', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('822e2db2-e603-4acd-93f3-39ea5fc2a224', '1540', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('82b4f6f6-3f2c-433b-b585-d2fdc2165a47', '1196', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('82d32161-03c4-40f8-8bca-02bff0d0e9be', '1900', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('82fdcb0a-9550-4feb-a509-603d84b2541f', '1484', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('83e2592f-2a67-4699-bd89-96998a4b0181', '1221', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('84448f9a-4f1d-4a23-9ae5-895bfe6ebdc2', '1510', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('846c0489-95f4-47b9-b9e4-28fe3b558036', '1620', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8471e324-67c2-41be-80c5-3cbd0d2a5915', '1894', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8490f66e-be32-4cca-a773-86dee5b24887', '1558', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('85495191-a4eb-486b-958e-453c55a30599', '1158', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('85b44688-a580-4c49-b3e9-a08514450ae3', '1211', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('85db5776-03cf-4894-a5df-8840ade69cd7', '1570', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8723febb-2f99-4a7b-8114-3df384afc55b', '1361', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('872c342b-286b-41bb-8462-aa185e8aa232', '1076', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('876aaa0a-192a-4984-b87c-35de8ceded3f', '1259', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('87e52219-a1f9-4795-940f-a7de6e854523', '1630', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('88224eec-cd88-470b-9f80-12913a6cccb5', '1453', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('88fb8094-ca23-4668-9862-266dae1e8f7f', '1837', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('89527914-ded7-4d18-9970-ceb4ab212c0c', '1747', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('89918f56-95aa-4b48-a210-db57a6290047', '1294', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8a006a56-8296-40dc-9725-0f8841144c0b', '1247', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b16afc4-ed81-4c13-8f1b-9e2c38afc6b6', '1593', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b4a4b1f-748d-43a4-87dc-426dd9dedd8d', '1368', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b6b90cd-68d6-4e53-a4c9-ffed07954faa', '1696', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8b7f4646-1cbf-419b-b2c0-542d45203978', '1397', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8bbfdb50-7ffe-4797-affb-443abe48399c', '1119', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8c2f9756-d0ba-4a57-a8a6-22c38c96fa9b', '1276', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8c53c2f9-cff7-462a-8ed8-4768ee7108b8', '1154', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8cac67d2-80bf-4b3a-a578-e785b07e094b', '1719', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8d29aa7b-35fc-42d2-bc9a-8786902fb0ec', '1754', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8d344b09-8d71-499f-a7a4-b2ea1f5cd64f', '1623', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8d8329f2-f5b1-423b-a7fc-6ac7eb33845b', '1814', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8dc0edc8-bf27-4397-b97f-87f44b67aeaa', '1296', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8dce3ec2-dca4-4c68-a589-75bd3f0878fb', '1808', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8e2aceac-ca62-452f-914f-0be4d7b37a86', '1537', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8f101279-d5f1-4b2b-8884-e4b34f95ff41', '1157', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('8f111de5-e91e-4d69-809e-9d2c963cef77', '1783', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9004a617-4d2b-4d04-8dbc-007ac8e2a7cb', '1200', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('907588c1-50b5-4906-ba05-b4aaa5928232', '1633', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9097c620-d948-4141-af2c-32f7823df5e7', '1609', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('90989667-7606-40b9-a6b3-1665b6879f2f', '1171', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('909ed0d5-aa40-4bf8-a61d-14af4d4d03a3', '1227', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('90cf469a-bd43-4862-bc45-dea3de13a9e5', '1715', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('916f9d43-b387-461b-b53c-1d13b9b6b353', '1786', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9184f60f-2109-47e8-88a6-f786e7a62417', '1870', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('91ab8ec3-8e33-400e-997e-09c78947f8df', '1378', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('925e0754-8061-43a5-b75c-ce41625ea3ef', '1165', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9291aab4-4183-4736-aca1-2286dc3d57ca', '1628', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('92c0ddc0-4f3e-4dd9-ab31-68109e4b37db', '1764', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('931103ad-acb9-4a16-aa31-6b55d3d820d8', '1799', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('931971e2-11a4-4457-b39e-b707009d28e0', '1682', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('93b01f00-4010-41df-85f7-68f3dc84f186', '1128', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('93fa08bb-148f-4998-ac23-6e8bc7a7ed7d', '1469', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('943a0768-aa0c-4d1b-94b4-0b33d2d1a8fd', '1587', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9452915b-99f5-4234-99d3-b4171310d891', '1674', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('94867e00-ffa4-40dd-aba2-b47c2a61ff76', '1845', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('948e6420-67d1-4d62-91fb-1adbab2a0cb1', '1564', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9512114f-3932-4c8a-969a-33e55203cf09', '1761', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9535e075-e8e6-4dca-9ae7-1ef6b9218bdc', '1678', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9580c845-c541-4017-9d2a-4c6ab4993195', '1389', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('968e5f11-3e8c-412b-bc13-6d88a1485245', '1192', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('96a9c556-01ce-4696-aa8d-2e62af82958a', '1308', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('96f082c6-94bf-41ff-974a-c6ff8f3433ac', '1861', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9785c54d-4096-4a51-b276-58258819458b', '1465', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('979335bf-b113-4aff-9d69-25a89af44685', '1709', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97a1f896-8179-46dc-babf-65f819af0aa1', '1547', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97c64c35-02da-4e12-8fdd-b20208f54263', '1670', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97d4a6bb-6201-474d-af78-df9d5dd830ec', '1488', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97f98d2a-3577-4d27-b26d-84bce20e66f4', '1507', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('97fbd170-2459-4f92-b4e3-e858f022c144', '1683', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('98289d21-64e7-4083-a31a-39f2856face6', '1756', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('98818c03-cb20-4e62-9c58-934f828c7a50', '1225', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('98cd19f7-97b5-4be8-8090-05a0707b4b3c', '1450', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('99db430e-f001-4cbb-b159-615ec0c71af0', '1320', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('99ea0888-f64c-45f1-ba23-9c893aa3bbab', '1190', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('99f22ad8-380c-41e5-a51c-2d20f7024235', '1567', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9a0f2dc7-6e89-49e2-a716-35dfa1b4cc64', '1883', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9a765a09-6dc0-474b-8104-9c9cc7b231df', '1126', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9b2ed4c7-0296-4499-a1c1-1c0945a5e9eb', '1836', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9b95426c-e739-4c23-987e-49db8d71bd97', '1155', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9b9e956c-d21e-4ca7-88c7-ecc04f53fe96', '1691', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9bd247a2-f6c9-4084-af8d-9dc91387329f', '1594', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9be36904-5bd2-4ee3-9f9f-f5755123da90', '1796', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9c8cb255-4fcb-441e-8cab-92e81820d418', '1207', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9cbc1f8e-c770-440a-944c-97ea9ba09ebb', '1113', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9cd67e52-bbac-4674-be2d-f3d5dadc0fe1', '1400', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9d6b00ce-8326-4ae3-8494-229b14a9db55', '1233', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9d6f420a-bed2-4741-a98d-e12e7a36f7a6', '1228', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9dceaecb-e188-462d-ae6c-0038082a5ffe', '1677', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9dfa5498-1515-4549-8bbc-ef1f9d41674e', '1153', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9e003ef4-4691-4f7d-9553-73cc91a5f4a0', '1066', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9e06e105-de21-41aa-84d9-16ec0fa59e65', '1690', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9e5cf128-633e-4a0b-81d1-ff3ec56e15fc', '1865', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9eb07478-d095-4e98-a87d-209b3e0cbbff', '1545', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9ed98ec0-f1fd-443f-86fc-7b832fde5028', '1652', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9f29ee1c-e043-45cc-8d37-c4db0dff9323', '1659', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9f53ed49-5cbf-432b-b8a9-69b1a8f6a863', '1257', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('9fab3f6f-6847-451b-9aa3-9dc61677aa7e', '1288', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a01a9ffb-dc29-4838-8581-b6fe2367faa8', '1590', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0358171-4400-4dbf-9ae4-b0ba606f539d', '1781', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0abbf02-42db-4ecc-867b-2acd58098af0', '1477', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0bcc285-b2ff-4fe7-86ff-fd9f88386c9a', '1551', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0d8d7f0-9720-4587-9679-174272102752', '1656', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a0daf630-45db-43a9-a8ad-31349d4c0bd1', '1697', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1495693-8580-484c-9591-82f2cd78f74e', '1177', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a152c5d9-2171-4fff-9a8e-4fec4fe6023e', '1734', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1a372c1-4cc1-40e3-a2e4-819e5753dac4', '1776', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1c477e0-eb3b-4292-a1a2-3d995a7c80c7', '1755', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a1ef5b96-d646-40d5-855a-ad17c36bed36', '1457', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a234a8a0-ed23-4552-863c-c0312e15feb5', '1395', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `std_student_class_stream_bak` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('a3478075-e311-42aa-9b01-6b87e328bd9f', '1788', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a4220c17-ad65-4f85-9419-026f876c0dee', '1240', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a4366a0e-949a-4155-9239-8095dcf53cc5', '1359', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a437240b-ff37-4313-9a2a-f517a83862a9', '1549', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a48302d0-dbdf-4b4a-b051-b0bb7cdbdafe', '1859', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a4ef767c-96ea-4011-b1ee-987ba5d48d5e', '1298', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a52160fc-2f19-47d5-8da4-93082cf89b4a', '1212', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a52fdce7-667b-4e0e-8865-2f8ac2601d47', '1458', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a6bc4cc6-55cd-4753-b301-22d3c2457242', '1802', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a6da9d40-48b6-404c-bb7a-902a27b835cf', '1426', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a6f07d4c-2439-4dc2-bcd4-a28b848a3d44', '1625', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a7b23916-6ee2-4424-bed9-1fc153d65e5c', '1504', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a7b63f86-b3fe-44f5-9d5c-cc19b7aca132', '1738', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a7e3a36a-efdc-4bdd-a371-57f45a12c935', '1896', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a808059e-fbc8-4ebe-b9fc-29a8af6670d5', '1148', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a90b8da3-19dd-48b0-a71f-624c0fb1161b', '1204', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a933a749-0219-43cb-8f72-0283d9c5f07c', '1352', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a9b1aedc-8db7-454b-bafe-4e388e29bb59', '1187', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('a9c8befe-ee82-43d7-b544-bfef70fa8027', '1546', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('aa52e999-3a53-4ece-b218-0db96544936d', '1271', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('aadec016-f450-4221-a81f-1eb12a0b984e', '1470', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('abbc2227-0947-4b9e-a6cb-3f0c4bb8b921', '1425', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ac61d576-aa98-46c5-ade9-537715186eaa', '1131', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ad0c833a-9e6e-491e-960e-6674795ac56a', '1548', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('addf2600-5d5e-4bfb-89ef-e4c5759d2654', '1107', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('af2fd647-b67f-44fc-ae81-d0255363c395', '1175', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('afa82769-ad29-43e4-8dc5-ba270d7503c1', '1586', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('afeebe2b-d191-4c21-8365-b0caf684bf0e', '1149', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b0ae60cd-76da-43f4-8678-b6d36a5eaeaf', '1514', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b0ff275c-f41c-4958-89c2-07efa1e39488', '1645', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b12f5378-0928-4e66-980c-1f8f3152a4aa', '1238', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b13e0ab1-7ced-4420-b801-5be2622de818', '1085', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b15602c9-b4f6-4c61-a377-65eb4459b66f', '1446', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b204c929-b1e4-4eb8-a7ac-f00c62fdcaf8', '1654', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b2142737-c2ea-45c9-88b9-bc7e11ded9bb', '1784', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b260bd33-05ec-42f1-a905-0b4d1309e17c', '1270', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b27d34c2-4c6e-4a6c-a18e-09b0ba8d1da7', '1125', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b3021521-43df-4dab-86d1-02e4d4e70cab', '1064', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b323088f-174a-44ed-bce3-ec71903b64e7', '1571', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b3961e79-c5f9-4b80-bd6e-489ce369af82', '1094', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b43347b0-51c6-4955-b26e-3ce7dcd568d4', '1744', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b514565f-2cea-4bdc-a6e7-5c77b057a052', '1725', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b51f7155-2ca1-428f-aedf-80fbc745c5e4', '1063', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b59ebfca-7b04-4ca1-bfaa-a428fb42ad90', '1535', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b5c2b157-1734-4ea2-9a60-227121620571', '1203', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b755c1e3-1774-4618-8c7f-e9f92e15f873', '1078', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b8a28552-3c9b-4ccd-9dbe-0c8a2f9487a0', '1562', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b8d2aafb-b044-4b16-b7b5-e309d43a2185', '1647', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b8f76062-639f-4fd2-b348-f53d9a7fa2fe', '1811', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd7', '4da9d182-6f65-4d7c-a097-67c8924c8201', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('b9a78d7a-5d46-4c4e-92ca-66fce764ff23', '1305', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ba08757e-d35e-44a1-a6d8-7d75ee9f5125', '1573', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bade03ad-4ad6-4ae8-a659-a310f5da5d80', '1801', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bae760f3-2ccb-4366-9f6e-d4d4231902f1', '1406', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bb79c8c1-9952-4c20-9a52-3b52756e0aaa', '1208', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bb80b24f-7255-4ca7-a287-5a252c87f5f6', '1841', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bbd8f715-a3a1-4133-8116-f6f5df743e7d', '1743', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bc1be2d0-0ba8-4919-adeb-252ac25e0a20', '1444', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bc9e4d0e-7fe7-41c6-998e-9de38e8faa60', '1272', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bcaa0d31-715d-43ca-afcd-2a35101f9026', '1876', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bd10f4bb-05ba-4eaa-aa25-f89432a3caa0', '1616', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bd4a72a9-00ff-4e2f-a982-189a674c0278', '1108', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bdb01cdd-f585-4b08-b07e-cc9571184b36', '1223', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('be689b8c-5e0e-40e2-a172-8993c70847f3', '1485', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('be77dc05-7b09-47b0-a6ef-af437992c103', '1086', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bf5d40eb-6d27-4257-8428-1de3e8ffe52d', '1595', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bf6aebe5-4419-471e-9208-3f3de77df83d', '1224', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bfc0451f-7a50-466c-92ee-eda5643fece0', '1566', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bff80dde-a2e0-4827-b896-d8c5bf4ad023', '1431', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('bffe0377-5db0-4c6b-992b-97db5b2f7ad8', '1766', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c0605c5a-c083-46e6-b22b-6f3716921b7c', '1648', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c0ddc5c4-2eee-4525-9d81-f7bcf5749cbe', '1138', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c0fba405-ac3e-495e-a667-836156cfdb9e', '1376', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c140bac4-4801-45da-a84b-a63917d4d897', '1337', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c1a64788-df9f-467d-a23d-83f80f101ee8', '1506', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c1f705ac-45cc-47d4-9ef4-4d45d5c4489b', '1090', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c214591d-1b5e-4985-9cf2-ccf55a8157fa', '1358', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c225b758-051c-4222-875c-c8d50b5535ea', '1563', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c2b617ee-2ef6-4bb4-a90b-2307d86390bd', '1420', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c2e9af4a-0de0-4035-9c68-91cb2d2cbf6a', '1803', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c32487b4-5ece-4c30-bc6f-6cca5a836e69', '1189', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c3511f07-5e9e-43e3-9917-4d76d62016bc', '1323', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c35d469e-48b7-441f-ab30-2e5112669005', '1820', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c3b64ec1-a30c-43a5-b297-4cd0d2101f62', '1363', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c3cda3b1-b0ab-404f-a11f-af67139cc9e5', '1577', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c412e9d0-9e92-4a0e-a793-921565055e14', '1429', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c4369322-f31e-412c-8791-79b4df53f99e', '1712', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c44c5f3b-5824-496f-a112-8b27a82ccb72', '1499', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c4e9671f-b790-4fb7-ad2f-e641a2dd105f', '1824', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c53e3bb8-0ccd-4c05-83fd-ae64057b3deb', '1644', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c55d0a69-a164-4ecb-b8e6-b00f6daed19e', '1180', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c5762fd3-4853-4bf0-aa77-93c1b0b87213', '1489', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c596c862-e11b-4bfe-b6ff-20f587893aa6', '1500', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c5d48142-47b4-436e-acc2-9a6ef1c8a451', '1344', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c60329e4-a95f-4046-9bc4-870470ee773a', '1812', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c60c00cd-b8a0-44df-a896-0dd7f390d5ba', '1099', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c679e550-7cea-47d2-9376-f220c25fa00a', '1759', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c6ce9e38-7480-443f-b675-3cf4b3244be4', '1266', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c721fef8-82d0-4455-8484-ae720329d53f', '1381', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c73cf5f4-e1d5-4d71-85d5-a1e7b5bc321b', '1142', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c7633854-e318-416a-b0c8-404743aeea06', '1422', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c7a416e7-ebe3-41c3-b9d8-554ae6e5173d', '1325', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c7fc513d-aae0-4636-a945-7a8d656cc4f5', '1679', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c81f3829-5311-45de-8eb6-f3903382e55e', '1854', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c82b1523-cf85-45a0-8574-53125d32c57b', '1167', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c87e5e96-97d0-4c9f-a4ee-ec942b5cfcd7', '1565', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c8cee212-17de-430f-8b87-537208729aef', '1301', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c8d8c489-74ce-4538-b193-b3e31a0e3654', '1531', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c964aee7-a071-44ab-805c-3f1cd5b77a50', '1464', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c96a6c42-5577-4f43-ac97-3e2ae940463d', '1206', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c97ff95c-2081-49df-a6b5-bb4bf2e98f3d', '1451', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c9a03006-e9c9-4583-82a3-2d646405a401', '1364', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('c9c828d1-c135-4931-b6ac-2dd987ebefdc', '1681', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ca3d9a47-2bd4-4e15-b5ec-bfe0fcbf5edc', '1100', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ca3fd3c2-55ab-42fc-8a73-f532c73236a1', '1543', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ca8af109-b35c-4c2e-b199-97dd1b1b2a1f', '1822', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('caba66e5-becb-4a20-ada7-150d07862523', '1273', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cb512a6a-b0c1-4c52-ac0d-99736bd247cb', '1077', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cb9a6fc3-eb00-4de7-b20e-52c651abd8b5', '1748', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cc0d7385-9daa-40fd-98b0-60b0df16ddd8', '1662', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cc2107af-3e2f-42db-8930-50976afef190', '1541', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cc4a3094-8c4a-4cfe-89e5-51a308b17a29', '1304', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cca3c011-dcfa-4461-995e-62605c735e9e', '1749', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cd32c5f8-93fe-4e03-aa5f-8b725676c819', '1239', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cd5902c6-4275-46d6-b1ee-f4433a4c8827', '1339', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cdcf1989-9d67-4598-8015-715d0b657064', '1286', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ce513caa-fa0c-4790-8346-f13a309766cf', '1412', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ce52e6a2-7b37-4f79-88d7-d92163ff0dbf', '1663', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ce57ae11-8968-45e7-90fa-997548726955', '1120', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('cfb1cc6d-3db7-4ae2-957d-eeb0f80880fe', '1197', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d05930df-6005-44db-a199-18d6a201d74d', '1512', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d067489a-d275-4eeb-b59e-25ad57b64310', '1660', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d08e1dcf-750f-4309-bb45-7e02f0d7e934', '1486', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d08f499a-a133-4fe2-804e-22cbe52ac453', '1732', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d097aca6-9e13-4e14-bcdf-863bbb7b2363', '1672', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d1004a16-91a5-40f5-a478-df4bd2648472', '1501', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d10b5eaf-9b1e-4e7d-9efa-b95542a359de', '1159', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d1a5b48d-7c46-4ea9-a9fb-41fb1412a5e9', '1612', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d1bd2188-f7ce-4f06-b4fa-14f15693c01f', '1680', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d2166fb0-34af-4869-926c-3050aee09161', '1542', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d216c329-d8ff-4544-8023-21debd22700e', '1530', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d21d4554-b265-466d-8c2c-b19da38128ef', '1686', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d28d3662-1f07-48fb-af98-642529d94d2d', '1527', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d2a283a1-e2ed-4074-ba99-f7758563c0e8', '1673', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d2f5ac83-29bf-474d-989a-7451684d9a75', '1875', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d3d56b55-a44f-4fb5-9708-3cc3ae204076', '1333', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d42eb9fa-6191-4340-a403-5e162ba37b16', '1602', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d50e10ac-2cd8-4512-9fd9-599db668a966', '1640', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5555b10-9bcf-4193-b675-93f96f136a7c', '1442', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5adc55b-ffb9-4fb9-bb54-79b125088221', '1236', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5ea89a8-ac75-4a4a-80ef-d73d6941115f', '1805', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d5ec10d0-5b87-4e40-9567-2de8f97f9c44', '1103', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d6a31263-56d4-42c2-813d-31e869d7c3aa', '1666', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d6ad7b41-aa87-4bc9-a761-2bb1db35bcf7', '1353', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d6dece7c-e003-4de2-bc00-989c551d87e5', '1651', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d7678478-bfb1-48ac-b4f4-bf90e41fd60f', '1649', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d883ad7e-5bf1-45a0-b562-962f2fb43657', '1459', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d8db626c-d0f2-41a8-a071-9843c455221c', '1492', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d910a8d2-f48c-4136-b5f5-a35297ff58ce', '1118', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d93d5866-efea-4935-9ecd-a5ea4f44b83d', '1280', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'bd481b88-2257-413f-b273-4de795150231', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d942a028-fca5-4384-9ea8-dfc1127ff76f', '1771', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d964de1d-bbd8-4d49-b645-33e9685a1a33', '1101', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('d9b95853-e165-4d33-81a9-12883fc75233', '1115', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('da5a4145-a264-478a-ba1c-7d7064c6bc76', '1143', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dba2d664-d606-4294-bdfe-52cb00c03bd1', '1151', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dba89890-d613-4de2-8bde-103ef2528df1', '1753', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dc7e6c2d-fb5d-42d0-b950-593679777ce5', '1231', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dcf99d92-f861-4742-8a33-bf5d9740ef24', '1306', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ddd5a703-34f1-43fa-9b5e-839a3caf8091', '1081', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('dde1ed49-f5c9-4f2a-8cf0-41a006fcaf02', '1665', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e2345f51-75c5-4fe9-bf18-d0ea63de9923', '1880', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e37eb995-e46a-4986-a63b-fbc40a15d40b', '1230', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e3c82832-1e2e-4cb6-a7ec-f2485ee9d552', '1509', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e4388c94-639f-4066-88e8-2a13135c13f2', '1421', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e46b3baa-7f72-4a60-bc01-4f00c28886e3', '1452', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e46d92ab-7507-406d-bbc3-9ada61fc2761', '1163', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e483d066-2cc3-4b6e-bce8-757f579eea70', '1289', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e4cd57f0-a17a-47ed-b8fe-2ada113a20ef', '1578', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e4e58063-b294-4c3d-8c49-29d2a5cc0755', '1380', '74217e56-f58b-4aef-a976-6277bae06d58', '6a430904-c901-47ad-b351-3b6cdd95617b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e5065944-1d74-46c3-8801-00297a9b3162', '1675', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e5103113-46bb-4b9b-9a76-714bb5866bf7', '1480', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e5fae2af-2ed5-4632-8cd9-9966fb2b07de', '1399', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e68fafc8-a7ff-4964-ae2f-268e367ebf51', '1365', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e692bc3d-50ef-4c5e-8384-269bd5c75a0b', '1123', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e6f7ed62-0eab-4350-9c4a-c4628c1a2e5c', '1717', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e6feb5af-dcf6-48a7-a249-36562e332ce6', '1302', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e7ae625e-83ee-4e39-8926-78f6f473efb8', '1195', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e7b7534f-508e-47ce-89a0-4042b4ba0303', '1840', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e8cb5a26-eb8c-420b-991e-4bd3ed9262e1', '1449', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e8ec23d0-23dd-4125-ae61-27a440ad6ad3', '1057', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e914e0ad-de09-4025-abbe-28917c60255b', '1475', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e93682b4-e206-47df-bc09-536527c879fa', '1655', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e966ddac-2629-4fe3-9718-fc052729f462', '1658', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('e9f2de7e-1b16-4154-8610-d9a7321428a2', '1234', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ea280a50-e5ef-447e-ada3-33d951c5dbd6', '1330', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ea47a5fd-4cb9-4859-a82c-e2c66d729a13', '1714', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ea68f58c-6f35-4c3e-9191-c0942da3e815', '1622', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eaebb16e-596e-4717-87f9-242b1499c274', '1454', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', '6d3c4fa9-ed90-4628-a818-dd107e4f5bde', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eb332d98-41a2-4b72-ae86-e8fa99f530c8', '1178', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eba4ed2c-7068-466e-a48c-bc8bcc160903', '1356', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ebc8fd9e-5753-435e-8f0b-4b64ce0d09d7', '1589', '755bb014-859b-4c7c-b194-8a134fd059eb', 'bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ec112607-648d-44dd-9b45-40f4585fff58', '1415', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ec9e9664-7464-480f-8950-22f8e98c743e', '1428', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ecb70cc5-46f5-4e00-ab8d-0133a31637a8', '1408', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ecb7f9e3-8c87-4350-9a11-976d778ae1d9', '1740', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ed121efc-402c-47d6-9a4b-3d4996ac9091', '1052', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ed43c4bc-4530-469b-9abe-ebb6f6004cb4', '1580', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('edd737bd-9fc7-4195-9139-d8b71b0e20d5', '1335', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ee05deab-b7da-47db-a157-d4c6b858d74f', '1790', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'd438b6a7-4ba1-4b87-bb97-fe400029dd9f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ee094173-8e7d-493e-90b7-4926f24e1cc8', '1265', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ee2842fb-aebb-4b15-a866-ebcb8d336848', '1275', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ef1c4f71-28e8-4b06-b4f0-82597addece4', '1693', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ef2abc33-6a29-48e3-b229-a09f6823cbce', '1723', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('eff62583-b4d9-4d09-92b3-49f2a4e3562a', '1860', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f00f61a2-1bb5-48cf-b64d-1c48e55d7ab6', '1156', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f0914664-a064-4a1f-973a-6d17e9d407b7', '1494', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f097fe97-5b80-4623-a9bd-123e59483f7f', '1121', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f102afd5-788e-4fbc-921f-adc7ee48b0d5', '1569', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1331c81-53e6-471b-aeb5-6ac245ea50e3', '1074', '780d917c-ed3e-4157-b8c3-146039118805', 'a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f14a8b2d-b0f7-4cb2-9a8e-b80036dca6cc', '1419', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'a9206f1b-5a18-40fb-bf99-31ef94458ed4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1ad7a4f-44c6-4053-8df0-0ab23d602271', '1553', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1add0a0-262c-43a9-a381-2bb5daf83439', '1757', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1c37068-700b-4a4c-bc4b-89dbc479041f', '1838', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f1c7f924-64a9-4038-af69-e95102b1cf49', '1297', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f20eac66-31e9-4173-964e-7c2012816fbb', '1588', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f2c73552-8ebe-4202-880a-bb192752d2ce', '1392', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f3772942-e41c-4ffd-96c7-1e97b3746d52', '1354', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f3ac7b35-a004-4814-b7a6-ecab231d7040', '1902', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f3c12cdf-2b47-44b4-832c-d14e38e23d37', '1053', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f3d78d42-23fe-4d16-bb29-fed561d0970e', '1708', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f404acd3-d486-431e-bdf2-f49a9e9257c4', '1214', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f42aa8a2-2568-4dd0-bbd7-5b194c90869b', '1487', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f49bc2b0-5ead-41ed-8283-aaccefc40522', '1632', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f4a298ed-8de2-4956-ab8d-138402cb4654', '1332', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '797809f0-1189-478b-b293-fa030715d37a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f4c510fa-5f72-4e42-9a34-705ea536e06e', '1210', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f4dce0cc-9516-48f7-916f-32f666825c09', '1146', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a2c7bab2-278c-42c7-a630-d44d6cbd4349', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f540943d-7c45-4cb6-b121-828ba3ac370a', '1829', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f549bd9b-a3b6-4878-8438-be4c038dfb95', '1215', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f5ac36b4-3eab-48df-859e-053d14aba5f9', '1435', '755bb014-859b-4c7c-b194-8a134fd059eb', '3f706abc-3063-4fd4-803f-a63897dded97', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f5d067dd-f5c5-40f9-8b79-9e9612db8576', '1396', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f5fc7ff0-65be-40ed-af76-65cd58f959dc', '1174', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'ddb4ff90-218d-4921-9ae6-ca0239c344a5', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f68af453-2cd5-4e26-97db-c3ea72e0b712', '1611', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f6dcd68f-621e-4d16-bb74-896f84578f2a', '1627', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f71edfc0-51a4-49a5-a840-c03bd03290a6', '1629', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f739711f-63a5-4a96-8dd6-005120804e78', '1869', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4da9d182-6f65-4d7c-a097-67c8924c8200', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f7916185-818c-4451-ab6c-4395b5ba5b92', '1874', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f7a4d191-a927-431e-9765-5737dd62ffdf', '1114', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f819cde9-ce54-411d-9a02-d2341151b90d', '1427', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f862afbd-ef42-4247-bee2-c94c1d4183c6', '1386', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8b0d6be-01bb-4006-889a-d6b0f8daed4c', '1170', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8c7e455-e184-48e5-8517-4e146e869cbf', '1291', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8c8007d-1b0d-4ac1-a10f-94f5a4265256', '1599', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '0aa5072d-00ff-4b06-93e9-8259bf148bfb', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f8eaea02-85de-4569-89a2-47345fc6d597', '1209', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f91de042-072d-4954-8da0-40afe2d7eb8f', '1774', '6fc68168-937b-4d24-80b9-3d2a241e10c4', '2a32c940-523e-40ed-9f4d-856fd678051a', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f9cc1c70-ea82-466d-845a-792db9cc4f7c', '1591', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');
INSERT INTO `std_student_class_stream_bak` (`id`, `StdStudentId`, `OrgClassStreamId`, `SectionDetailsId`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('f9ee4b54-2b89-4e35-9797-c5e9f764bd55', '1848', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '36f9fee5-b30d-4e47-bab2-31ac38bac352', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('f9fb0260-2fc9-409a-9af8-4aed045d3a55', '1162', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'ca96a7e2-d708-44d0-8865-7b0bdb838691', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fa2b6b74-5cdd-4d12-99cf-54e1045f27c5', '1135', '780d917c-ed3e-4157-b8c3-146039118805', '9316a24d-15ad-446d-abd5-edcf544c2a39', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fac48de8-5cd9-4bb0-8393-f99c54d8fba8', '1668', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '7ebcce72-a667-43e1-8023-653cf9cf08db', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fb3450f4-cd7c-4a39-af74-8adf66148a0b', '1056', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fb94b19d-43f9-444d-a3c1-f7fab2416576', '1315', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '38801fbd-5f49-4b83-8204-ed42bbc47ccd', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fbae3890-1f34-48a0-ba5a-79e7a62743b2', '1555', '6c2ca46d-e630-401d-8a2e-a25d303841d1', '173152e5-f129-4877-ae71-205336f2879b', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fbc051af-8466-4b02-9745-e651b356600e', '1072', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fcbd2004-83f0-4535-81de-7ff19efdce81', '1188', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fce76e54-cbad-4c37-9f15-678db87e09ef', '1404', '74217e56-f58b-4aef-a976-6277bae06d58', '8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fd5c5bba-4193-4a40-a910-01add82ebd42', '1351', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4838b1c6-f11a-4772-944e-b01da75b4fce', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('fe143cd1-413b-4c2e-bdaa-864e613dab60', '1575', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'b112e5bc-1cc9-4974-a09f-35b851042587', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ff3b09b9-54f2-4313-921b-ef045ac69fed', '1202', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ff3cfc1c-8fac-4de4-a28e-811086bacd64', '1517', '755bb014-859b-4c7c-b194-8a134fd059eb', 'c7da1bf6-4af9-49f3-8331-e71209f95dbf', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000'),
('ff4628c4-3462-4024-8893-fd8f63bf9034', '1070', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'a1205069-70af-4cca-88a4-7e1d973e22a2', '', '', '0000-00-00 00:00:00.000000', '0000-00-00 00:00:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `std_student_disciplinary`
--

CREATE TABLE `std_student_disciplinary` (
  `Id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgOrganizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdDisciplinaryOffenceTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdDisciplinarySeverityId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OffenceDate` date NOT NULL,
  `OffenceDescription` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StdDisciplinaryActionTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ActionDescription` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_student_disciplinary`
--

INSERT INTO `std_student_disciplinary` (`Id`, `OrgOrganizationId`, `StdStudentId`, `StdDisciplinaryOffenceTypeId`, `StdDisciplinarySeverityId`, `OffenceDate`, `OffenceDescription`, `StdDisciplinaryActionTypeId`, `ActionDescription`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('99adb86b-0f6d-4a91-b5c1-4401dd8dfc0d', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '1', 'a074437e-5544-45b8-b087-28deaba39d33', '9fc322d1-6425-4d79-a202-028ec0bc701b', '2021-05-17', 'test', 'b1a8f0b5-b58a-4fb1-aa32-cbb5c57a8923', 'test', NULL, NULL, '2021-05-17 10:49:01', '2021-05-17 10:49:01'),
('bb8ddb94-caeb-4fcc-907b-0e2852964ac1', 'd77x1e56-1b24-4b1d-bc18-2b9anmn20w23', '1', 'a074437e-5544-45b8-b087-28deaba39d33', '9fc322d1-6425-4d79-a202-028ec0bc701b', '2021-05-17', 'test', 'b1a8f0b5-b58a-4fb1-aa32-cbb5c57a8923', 'test', NULL, NULL, '2021-05-17 10:49:01', '2021-05-17 10:49:01'),
('f6d3ce28-9de3-4c4c-9e74-70794b01f249', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1053', 'a074437e-5544-45b8-b087-28deaba39d33', '9fc322d1-6425-4d79-a202-028ec0bc701b', '2021-05-27', 'test', 'b1a8f0b5-b58a-4fb1-aa32-cbb5c57a8923', 'test', NULL, NULL, '2021-05-27 16:16:02', '2021-05-27 16:16:02');

-- --------------------------------------------------------

--
-- Table structure for table `std_student_father`
--

CREATE TABLE `std_student_father` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnNationalityId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CidNo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnPermanentGewogId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnPermanentChiwogId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CmnPresentGewogId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnPresentChiwogId` int(36) DEFAULT NULL,
  `WorkAddress` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ResidenceAddress` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CmnOccupationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactNo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_student_guardian`
--

CREATE TABLE `std_student_guardian` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnRelationshipId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `WorkAddress` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ResidenceAddress` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnOccupationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactNo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_student_mother`
--

CREATE TABLE `std_student_mother` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnNationalityId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CidNo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnPermanentGewogId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnPermanentChiwogId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CmnPresentGewogId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CmnPresentChiwogId` int(36) DEFAULT NULL,
  `WorkAddress` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ResidenceAddress` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `CmnOccupationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ContactNo` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Email` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_student_scholarship`
--

CREATE TABLE `std_student_scholarship` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdScholarshipId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_student_school_detail`
--

CREATE TABLE `std_student_school_detail` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StudentCode` varchar(50) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OrgClassId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgStreamId` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OrgClassSectionId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StdStudentTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `NoOfMeals` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `IsSenStudent` tinyint(3) UNSIGNED NOT NULL DEFAULT 0,
  `Email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_student_school_leaving`
--

CREATE TABLE `std_student_school_leaving` (
  `id` varchar(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgOrganizationId` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `LeavingDate` date NOT NULL,
  `Reasons` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_student_school_leaving`
--

INSERT INTO `std_student_school_leaving` (`id`, `OrgOrganizationId`, `StdStudentId`, `LeavingDate`, `Reasons`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('afce9da3-198e-4767-b456-8dd08804df2c', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1053', '2021-05-28', 'test', NULL, NULL, '2021-05-28 01:32:19', '2021-05-28 01:32:19'),
('e2640dc4-733b-4e3c-8639-859409f969ce', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1054', '2021-05-30', 'rsrser', NULL, NULL, '2021-05-30 16:55:01', '2021-05-30 16:55:01'),
('b60d02b0-2fd1-46ea-b4b1-984d03a25020', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1055', '2021-05-30', 'rewawr', NULL, NULL, '2021-05-30 17:02:15', '2021-05-30 17:02:15'),
('6fe6d5d3-99e8-44cf-ba27-1e45c8265e37', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1052', '2021-05-30', 'test', NULL, NULL, '2021-05-30 17:05:49', '2021-05-30 17:05:49'),
('ef8c4b8b-5bf0-4887-8c29-ce49b5066384', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1053', '2021-05-30', 'test', NULL, NULL, '2021-05-30 17:07:07', '2021-05-30 17:07:07'),
('74012cc9-b6f6-458f-be73-e4e09f8d2644', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1052', '2021-05-30', 'test', NULL, NULL, '2021-05-30 17:08:01', '2021-05-30 17:08:01'),
('d3ba3040-0160-4bc2-8365-6ae98ce20f0d', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1056', '2021-05-30', 'test', NULL, NULL, '2021-05-30 17:09:39', '2021-05-30 17:09:39'),
('676e9804-d18a-4d31-8810-b4c1d2cd8309', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1056', '2021-05-30', 'test', NULL, NULL, '2021-05-30 17:10:11', '2021-05-30 17:10:11'),
('f8d4e46a-1600-454f-aae4-e5074043a1ac', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1056', '2021-05-30', 'test', NULL, NULL, '2021-05-30 17:11:25', '2021-05-30 17:11:25'),
('ca670a05-02ff-408f-9382-fdbc54ca6087', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1056', '2021-05-30', 'test', NULL, NULL, '2021-05-30 17:14:19', '2021-05-30 17:14:19'),
('eaea1e12-4f2b-4395-b3e3-65d33b997ceb', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1056', '2021-05-30', 'test', NULL, NULL, '2021-05-30 17:14:50', '2021-05-30 17:14:50'),
('7ae4f803-a1ed-423b-923a-eac6f2638306', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1056', '2021-05-30', 'test', NULL, NULL, '2021-05-30 17:15:44', '2021-05-30 17:15:44'),
('fdb1d3ee-b3ec-467a-aa0a-cf53f58c7e65', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1052', '2021-06-01', 'test', NULL, NULL, '2021-05-31 22:44:30', '2021-05-31 22:44:30'),
('af32eb11-03fa-4aa9-b083-0e4d5e6dcbce', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1054', '2021-06-01', 'test', NULL, NULL, '2021-06-01 00:26:34', '2021-06-01 00:26:34'),
('683e57a5-3d67-4c97-99fd-842e91910395', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1053', '2021-06-01', 'test', NULL, NULL, '2021-06-01 00:29:50', '2021-06-01 00:29:50');

-- --------------------------------------------------------

--
-- Table structure for table `std_student_separated_whereabout`
--

CREATE TABLE `std_student_separated_whereabout` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OrgOrganizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `DropoutReason` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `StdDropoutCaseTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CurrentEngagement` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `CurrentAddress` varchar(200) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_student_separated_whereabout`
--

INSERT INTO `std_student_separated_whereabout` (`id`, `OrgOrganizationId`, `StdStudentId`, `DropoutReason`, `StdDropoutCaseTypeId`, `CurrentEngagement`, `CurrentAddress`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('29fa5069-c46c-4169-bcc9-c5c09f75d2ae', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1053', NULL, '', 'test', 'test', NULL, NULL, '2021-06-01 00:37:21', '2021-06-01 00:37:21'),
('92fa31c2-9a9e-4088-a55e-42689df84db8', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1053', NULL, '', 'test', 'test', NULL, NULL, '2021-05-28 01:25:11', '2021-05-28 01:25:11');

-- --------------------------------------------------------

--
-- Table structure for table `std_student_special_benefit`
--

CREATE TABLE `std_student_special_benefit` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdStudentId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `StdSpecialBenefitId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_student_type`
--

CREATE TABLE `std_student_type` (
  `Id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `std_vaccine_type`
--

CREATE TABLE `std_vaccine_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `Name` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `vaccineFor` tinyint(3) NOT NULL,
  `Description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `Status` tinyint(3) UNSIGNED NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `std_vaccine_type`
--

INSERT INTO `std_vaccine_type` (`id`, `Name`, `vaccineFor`, `Description`, `Status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('32abba18-889d-4018-ba66-c9b8d7ef7385', 'HPV', 2, 'GIrls', 1, NULL, NULL, '2021-06-03 05:04:09', '2021-06-03 05:04:09'),
('c12f4b26-d1dc-4432-bdf4-d8783f405a0a', 'TD', 0, 'TD Vaccine', 1, NULL, NULL, '2021-06-03 05:20:29', '2021-06-03 05:20:29');

-- --------------------------------------------------------

--
-- Table structure for table `student_aboards`
--

CREATE TABLE `student_aboards` (
  `id` char(36) NOT NULL,
  `organizationId` varchar(45) DEFAULT NULL,
  `cid_passport` varchar(45) DEFAULT NULL,
  `first_name` varchar(45) DEFAULT NULL,
  `middle_name` varchar(45) DEFAULT NULL,
  `last_name` varchar(45) DEFAULT NULL,
  `sex_id` varchar(45) DEFAULT NULL,
  `dob` date NOT NULL,
  `mother_tongue` varchar(45) DEFAULT NULL,
  `status` varchar(45) DEFAULT NULL,
  `full_address` varchar(45) DEFAULT NULL,
  `country` varchar(45) DEFAULT NULL,
  `city` varchar(45) DEFAULT NULL,
  `created_by` varchar(45) DEFAULT NULL,
  `updated_by` varchar(45) DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cea_award`
--
ALTER TABLE `cea_award`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`),
  ADD KEY `CeaAwardTypeId` (`CeaAwardTypeId`),
  ADD KEY `CeaProgrammeId` (`CeaProgrammeId`),
  ADD KEY `CeaAwardId` (`CeaAwardId`);

--
-- Indexes for table `cea_award_school_level`
--
ALTER TABLE `cea_award_school_level`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `CeaAwardId` (`CeaAwardId`),
  ADD KEY `OrgSchoolLevelId` (`OrgSchoolLevelId`);

--
-- Indexes for table `cea_award_type`
--
ALTER TABLE `cea_award_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `cea_programme`
--
ALTER TABLE `cea_programme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`),
  ADD KEY `CeaActivityTypeId` (`CeaProgrammeTypeId`),
  ADD KEY `CeaProgrammeId` (`CeaProgrammeId`);

--
-- Indexes for table `cea_programme_action_plan`
--
ALTER TABLE `cea_programme_action_plan`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaProgrammeId` (`CeaProgrammeId`),
  ADD KEY `OrgOrganizationId` (`OrgOrganizationId`);

--
-- Indexes for table `cea_programme_action_plan_detail`
--
ALTER TABLE `cea_programme_action_plan_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaProgrammeActionPlanId` (`CeaProgrammeActionPlanId`);

--
-- Indexes for table `cea_programme_inventory`
--
ALTER TABLE `cea_programme_inventory`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaProgrammeId` (`CeaProgrammeId`),
  ADD KEY `ForMonth` (`ForMonth`),
  ADD KEY `OrgOrganizationId` (`OrgOrganizationId`);

--
-- Indexes for table `cea_programme_inventory_detail`
--
ALTER TABLE `cea_programme_inventory_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaProgrammeInventoryItemId` (`CeaProgrammeInventoryItemId`),
  ADD KEY `CeaProgrammeInventoryId` (`CeaProgrammeInventoryId`);

--
-- Indexes for table `cea_programme_inventory_expenditure`
--
ALTER TABLE `cea_programme_inventory_expenditure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaProgrammeInventoryId` (`CeaProgrammeInventoryId`);

--
-- Indexes for table `cea_programme_inventory_item`
--
ALTER TABLE `cea_programme_inventory_item`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CmnMeasurementUnitId` (`CmnMeasurementUnitId`),
  ADD KEY `CeaProgrammeId` (`CeaProgrammeId`);

--
-- Indexes for table `cea_programme_inventory_production`
--
ALTER TABLE `cea_programme_inventory_production`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaProgrammeInventoryId` (`CeaProgrammeInventoryId`),
  ADD KEY `CeaProgrammeInventoryItemId` (`CeaProgrammeInventoryItemId`);

--
-- Indexes for table `cea_programme_item`
--
ALTER TABLE `cea_programme_item`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cea_programme_measurement`
--
ALTER TABLE `cea_programme_measurement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cea_programme_membership`
--
ALTER TABLE `cea_programme_membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StdStudentId` (`StdStudentId`),
  ADD KEY `CaeActivityId` (`CeaProgrammeId`),
  ADD KEY `JoiningDate` (`JoiningDate`);

--
-- Indexes for table `cea_programme_school_level`
--
ALTER TABLE `cea_programme_school_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaProgrammeId` (`CeaProgrammeId`),
  ADD KEY `OrgSchoolLevelId` (`OrgSchoolLevelId`) USING BTREE;

--
-- Indexes for table `cea_programme_supporter`
--
ALTER TABLE `cea_programme_supporter`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `cea_programme_type`
--
ALTER TABLE `cea_programme_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `cea_project`
--
ALTER TABLE `cea_project`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`),
  ADD KEY `CeaProjectTypeId` (`CeaProjectTypeId`),
  ADD KEY `CeaProgrammeId` (`CeaProgrammeId`),
  ADD KEY `CeaProjectId` (`CeaProjectId`),
  ADD KEY `OrgOrganizationId` (`OrgOrganizationId`),
  ADD KEY `FromDate` (`FromDate`),
  ADD KEY `ToDate` (`ToDate`);

--
-- Indexes for table `cea_project_membership`
--
ALTER TABLE `cea_project_membership`
  ADD PRIMARY KEY (`id`) USING BTREE,
  ADD KEY `StdStudentId` (`StdStudentId`),
  ADD KEY `CaeProjectId` (`CaeProjectId`);

--
-- Indexes for table `cea_project_type`
--
ALTER TABLE `cea_project_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `cea_project_type_school_level`
--
ALTER TABLE `cea_project_type_school_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaProjectTypeId` (`CeaProjectTypeId`),
  ADD KEY `OrgSchoolLevelId` (`OrgSchoolLevelId`);

--
-- Indexes for table `cea_quarter_type`
--
ALTER TABLE `cea_quarter_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `cea_role`
--
ALTER TABLE `cea_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `AssignedTo` (`AssignedTo`),
  ADD KEY `Status` (`Status`),
  ADD KEY `CeaActivityId` (`CeaProgrammeId`);

--
-- Indexes for table `cea_role_staff`
--
ALTER TABLE `cea_role_staff`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CaeRoleId` (`CeaRoleId`),
  ADD KEY `StfStaffId` (`StfStaffId`);

--
-- Indexes for table `cea_role_student`
--
ALTER TABLE `cea_role_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CaeRoleId` (`CeaRoleId`),
  ADD KEY `StdStudentId` (`StdStudentId`);

--
-- Indexes for table `cea_school_programme`
--
ALTER TABLE `cea_school_programme`
  ADD PRIMARY KEY (`id`),
  ADD KEY `OrgOrganizationId` (`OrgOrganizationId`),
  ADD KEY `CeaActivityId` (`CeaProgrammeId`),
  ADD KEY `EstablishmentYear` (`EstablishmentYear`),
  ADD KEY `CeaProgrammerSupporterId` (`CeaProgrammeSupporterId`);

--
-- Indexes for table `cea_scout_advancement_level`
--
ALTER TABLE `cea_scout_advancement_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cea_scout_advancement_level_cea_scout_proficiency_badges_idx` (`CeaScoutProficiencyBadgesId`);

--
-- Indexes for table `cea_scout_leaders`
--
ALTER TABLE `cea_scout_leaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cea_scout_membership`
--
ALTER TABLE `cea_scout_membership`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cea_scout_membership_cea_scout_section_level1_idx` (`CeaScoutSectionLevelId`);

--
-- Indexes for table `cea_scout_proficiency_badges`
--
ALTER TABLE `cea_scout_proficiency_badges`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cea_scout_proficiency_badges_cea_scout_section_level1_idx` (`CeaScoutSectionLevelId`);

--
-- Indexes for table `cea_scout_section`
--
ALTER TABLE `cea_scout_section`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cea_scout_section_level`
--
ALTER TABLE `cea_scout_section_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_cea_scout_section_level_cea_scout_section_idx` (`CeaScoutSectionId`);

--
-- Indexes for table `cea_student_award`
--
ALTER TABLE `cea_student_award`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StdStudentId` (`StdStudentId`),
  ADD KEY `CeaAwardId` (`CeaAwardId`),
  ADD KEY `AwardDate` (`AwardDate`);

--
-- Indexes for table `cea_student_training`
--
ALTER TABLE `cea_student_training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaTrainingId` (`CeaTrainingId`),
  ADD KEY `CmnCountryId` (`CmnCountryId`);

--
-- Indexes for table `cea_student_training_participant`
--
ALTER TABLE `cea_student_training_participant`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaStudentTrainingId` (`CeaStudentTrainingId`),
  ADD KEY `StdStudentId` (`StdStudentId`);

--
-- Indexes for table `cea_training`
--
ALTER TABLE `cea_training`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaProgrammeId` (`CeaProgrammeId`),
  ADD KEY `Status` (`Status`),
  ADD KEY `CeaTrainingId` (`CeaTrainingId`),
  ADD KEY `CeaTrainingTypeId` (`CeaTrainingTypeId`);

--
-- Indexes for table `cea_training_school_level`
--
ALTER TABLE `cea_training_school_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CeaTrainingId` (`CeaTrainingId`),
  ADD KEY `OrgSchoolLevelId` (`OrgSchoolLevelId`);

--
-- Indexes for table `cea_training_type`
--
ALTER TABLE `cea_training_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `std_class_scholarship_type`
--
ALTER TABLE `std_class_scholarship_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `OrgClassId` (`OrgClassId`),
  ADD KEY `StdScholarchipTypeId` (`StdScholarchipTypeId`);

--
-- Indexes for table `std_class_student_type`
--
ALTER TABLE `std_class_student_type`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OrgClassId` (`OrgClassId`),
  ADD KEY `StdStudentTypeId` (`StdStudentTypeId`);

--
-- Indexes for table `std_disciplinary_action_type`
--
ALTER TABLE `std_disciplinary_action_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `std_disciplinary_offence_type`
--
ALTER TABLE `std_disciplinary_offence_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `std_disciplinary_severity`
--
ALTER TABLE `std_disciplinary_severity`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `std_dropout_case_type`
--
ALTER TABLE `std_dropout_case_type`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `std_health_bmi`
--
ALTER TABLE `std_health_bmi`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_health_deworming`
--
ALTER TABLE `std_health_deworming`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_health_not_screened`
--
ALTER TABLE `std_health_not_screened`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_health_referred`
--
ALTER TABLE `std_health_referred`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_health_screening`
--
ALTER TABLE `std_health_screening`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_health_screening_type`
--
ALTER TABLE `std_health_screening_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_health_supplementation`
--
ALTER TABLE `std_health_supplementation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_health_term`
--
ALTER TABLE `std_health_term`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_health_vaccination`
--
ALTER TABLE `std_health_vaccination`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_reporting`
--
ALTER TABLE `std_reporting`
  ADD PRIMARY KEY (`id`),
  ADD KEY `OrgOrganizationId` (`OrgOrganizationId`),
  ADD KEY `StdStudentId` (`StdStudentId`),
  ADD KEY `ReportingDate` (`ReportingDate`);

--
-- Indexes for table `std_role`
--
ALTER TABLE `std_role`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `std_role_school_level`
--
ALTER TABLE `std_role_school_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StdRoleId` (`StdRoleId`),
  ADD KEY `OrgSchoolLevelId` (`OrgSchoolLevelId`);

--
-- Indexes for table `std_role_student`
--
ALTER TABLE `std_role_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StdStudentId` (`StdStudentId`),
  ADD KEY `StdLeaderId` (`StdRoleId`);

--
-- Indexes for table `std_scholarship`
--
ALTER TABLE `std_scholarship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`),
  ADD KEY `SchoolCategory` (`SchoolCategory`);

--
-- Indexes for table `std_scholarship_school_level`
--
ALTER TABLE `std_scholarship_school_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StdScholarshipId` (`StdScholarshipId`),
  ADD KEY `OrgSchoolLevelId` (`OrgSchoolLevelId`);

--
-- Indexes for table `std_school_leaving_reason`
--
ALTER TABLE `std_school_leaving_reason`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `std_screening_endorsed_by`
--
ALTER TABLE `std_screening_endorsed_by`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_screening_position_title`
--
ALTER TABLE `std_screening_position_title`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_special_benefit`
--
ALTER TABLE `std_special_benefit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `std_special_benefit_school_level`
--
ALTER TABLE `std_special_benefit_school_level`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StdSpecialBenefitId` (`StdSpecialBenefitId`),
  ADD KEY `OrgSchoolLevelId` (`OrgSchoolLevelId`);

--
-- Indexes for table `std_student`
--
ALTER TABLE `std_student`
  ADD PRIMARY KEY (`id`),
  ADD KEY `OrgOrganizationId` (`OrgOrganizationId`),
  ADD KEY `CidNo` (`CidNo`),
  ADD KEY `CmnSexId` (`CmnSexId`),
  ADD KEY `CmnNationalityId` (`CmnCountryId`),
  ADD KEY `DateOfBirth` (`DateOfBirth`),
  ADD KEY `CmnGewogId` (`CmnGewogId`),
  ADD KEY `CmnChiwogId` (`CmnChiwogId`),
  ADD KEY `CmnLanguageId` (`CmnLanguageId`),
  ADD KEY `IsNewAdmission` (`IsNewAdmission`),
  ADD KEY `IsTransfer` (`IsTransferred`),
  ADD KEY `IsRejoined` (`IsRejoined`),
  ADD KEY `PhotoPath` (`PhotoPath`(191)),
  ADD KEY `PrimaryContact` (`PrimaryContact`),
  ADD KEY `CmnParentsMaritalStatusId` (`CmnParentsMaritalStatusId`);

--
-- Indexes for table `std_student_class_stream`
--
ALTER TABLE `std_student_class_stream`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_student_class_stream-beforeallocation`
--
ALTER TABLE `std_student_class_stream-beforeallocation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_student_class_stream_bak`
--
ALTER TABLE `std_student_class_stream_bak`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `std_student_disciplinary`
--
ALTER TABLE `std_student_disciplinary`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `OrgOrganizationId` (`OrgOrganizationId`),
  ADD KEY `StdStudentId` (`StdStudentId`),
  ADD KEY `StdDisciplinaryOffenceTypeId` (`StdDisciplinaryOffenceTypeId`),
  ADD KEY `StdDisciplinarySeverityId` (`StdDisciplinarySeverityId`),
  ADD KEY `StdDisciplinaryActionTypeId` (`StdDisciplinaryActionTypeId`);

--
-- Indexes for table `std_student_father`
--
ALTER TABLE `std_student_father`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CmnNationalityId` (`CmnNationalityId`),
  ADD KEY `CidNo` (`CidNo`),
  ADD KEY `CmnPermanentGewogId` (`CmnPermanentGewogId`),
  ADD KEY `CmnPermanentChiwogId` (`CmnPermanentChiwogId`),
  ADD KEY `CmnPresentGewogId` (`CmnPresentGewogId`),
  ADD KEY `CmnPresentChiwogId` (`CmnPresentChiwogId`),
  ADD KEY `CmnOccupationId` (`CmnOccupationId`),
  ADD KEY `StdStudentId` (`StdStudentId`);

--
-- Indexes for table `std_student_guardian`
--
ALTER TABLE `std_student_guardian`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CmnRelationshipId` (`CmnRelationshipId`),
  ADD KEY `CmnOccupationId` (`CmnOccupationId`),
  ADD KEY `StdStudentId` (`StdStudentId`);

--
-- Indexes for table `std_student_mother`
--
ALTER TABLE `std_student_mother`
  ADD PRIMARY KEY (`id`),
  ADD KEY `CmnNationalityId` (`CmnNationalityId`),
  ADD KEY `CidNo` (`CidNo`),
  ADD KEY `CmnPermanentGewogId` (`CmnPermanentGewogId`),
  ADD KEY `CmnPermanentChiwogId` (`CmnPermanentChiwogId`),
  ADD KEY `CmnPresentGewogId` (`CmnPresentGewogId`),
  ADD KEY `CmnPresentChiwogId` (`CmnPresentChiwogId`),
  ADD KEY `CmnOccupationId` (`CmnOccupationId`),
  ADD KEY `StdStudentId` (`StdStudentId`);

--
-- Indexes for table `std_student_scholarship`
--
ALTER TABLE `std_student_scholarship`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StdStudentId` (`StdStudentId`),
  ADD KEY `StdScholarchipTypeId` (`StdScholarshipId`);

--
-- Indexes for table `std_student_school_detail`
--
ALTER TABLE `std_student_school_detail`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StdStudentId` (`StdStudentId`),
  ADD KEY `StudentCode` (`StudentCode`),
  ADD KEY `OrgClassId` (`OrgClassId`),
  ADD KEY `OrgClassSectionId` (`OrgClassSectionId`),
  ADD KEY `StdStudentTypeId` (`StdStudentTypeId`),
  ADD KEY `NoOfMeals` (`NoOfMeals`),
  ADD KEY `IsSenStudent` (`IsSenStudent`),
  ADD KEY `OrgStreamId` (`OrgStreamId`);

--
-- Indexes for table `std_student_separated_whereabout`
--
ALTER TABLE `std_student_separated_whereabout`
  ADD PRIMARY KEY (`id`),
  ADD KEY `OrgOrganizationId` (`OrgOrganizationId`),
  ADD KEY `StdStudentId` (`StdStudentId`);

--
-- Indexes for table `std_student_special_benefit`
--
ALTER TABLE `std_student_special_benefit`
  ADD PRIMARY KEY (`id`),
  ADD KEY `StdStudentId` (`StdStudentId`),
  ADD KEY `StdSpecialBenefitId` (`StdSpecialBenefitId`);

--
-- Indexes for table `std_student_type`
--
ALTER TABLE `std_student_type`
  ADD PRIMARY KEY (`Id`),
  ADD KEY `Status` (`Status`);

--
-- Indexes for table `std_vaccine_type`
--
ALTER TABLE `std_vaccine_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_aboards`
--
ALTER TABLE `student_aboards`
  ADD PRIMARY KEY (`id`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cea_award`
--
ALTER TABLE `cea_award`
  ADD CONSTRAINT `cea_award_ibfk_1` FOREIGN KEY (`CeaAwardTypeId`) REFERENCES `cea_award_type` (`Id`),
  ADD CONSTRAINT `cea_award_ibfk_2` FOREIGN KEY (`CeaProgrammeId`) REFERENCES `cea_programme` (`Id`),
  ADD CONSTRAINT `cea_award_ibfk_3` FOREIGN KEY (`CeaAwardId`) REFERENCES `cea_award` (`Id`);

--
-- Constraints for table `cea_award_school_level`
--
ALTER TABLE `cea_award_school_level`
  ADD CONSTRAINT `cea_award_school_level_ibfk_1` FOREIGN KEY (`CeaAwardId`) REFERENCES `cea_award` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `cea_programme`
--
ALTER TABLE `cea_programme`
  ADD CONSTRAINT `cea_programme_ibfk_1` FOREIGN KEY (`CeaProgrammeTypeId`) REFERENCES `cea_programme_type` (`Id`);

--
-- Constraints for table `cea_programme_action_plan`
--
ALTER TABLE `cea_programme_action_plan`
  ADD CONSTRAINT `cea_programme_action_plan_ibfk_1` FOREIGN KEY (`CeaProgrammeId`) REFERENCES `cea_programme` (`Id`);

--
-- Constraints for table `cea_programme_action_plan_detail`
--
ALTER TABLE `cea_programme_action_plan_detail`
  ADD CONSTRAINT `cea_programme_action_plan_detail_ibfk_1` FOREIGN KEY (`CeaProgrammeActionPlanId`) REFERENCES `cea_programme_action_plan` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `cea_programme_inventory`
--
ALTER TABLE `cea_programme_inventory`
  ADD CONSTRAINT `cea_programme_inventory_ibfk_1` FOREIGN KEY (`CeaProgrammeId`) REFERENCES `cea_programme` (`Id`);

--
-- Constraints for table `cea_programme_inventory_detail`
--
ALTER TABLE `cea_programme_inventory_detail`
  ADD CONSTRAINT `cea_programme_inventory_detail_ibfk_1` FOREIGN KEY (`CeaProgrammeInventoryId`) REFERENCES `cea_programme_inventory` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cea_programme_inventory_detail_ibfk_2` FOREIGN KEY (`CeaProgrammeInventoryItemId`) REFERENCES `cea_programme_inventory_item` (`Id`);

--
-- Constraints for table `cea_programme_inventory_expenditure`
--
ALTER TABLE `cea_programme_inventory_expenditure`
  ADD CONSTRAINT `cea_programme_inventory_expenditure_ibfk_1` FOREIGN KEY (`CeaProgrammeInventoryId`) REFERENCES `cea_programme_inventory` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `cea_programme_inventory_item`
--
ALTER TABLE `cea_programme_inventory_item`
  ADD CONSTRAINT `cea_programme_inventory_item_ibfk_1` FOREIGN KEY (`CeaProgrammeId`) REFERENCES `cea_programme` (`Id`);

--
-- Constraints for table `cea_programme_inventory_production`
--
ALTER TABLE `cea_programme_inventory_production`
  ADD CONSTRAINT `cea_programme_inventory_production_ibfk_1` FOREIGN KEY (`CeaProgrammeInventoryId`) REFERENCES `cea_programme_inventory` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cea_programme_inventory_production_ibfk_2` FOREIGN KEY (`CeaProgrammeInventoryItemId`) REFERENCES `cea_programme_inventory_item` (`Id`);

--
-- Constraints for table `cea_programme_membership`
--
ALTER TABLE `cea_programme_membership`
  ADD CONSTRAINT `cea_programme_membership_ibfk_1` FOREIGN KEY (`CeaProgrammeId`) REFERENCES `cea_programme` (`Id`),
  ADD CONSTRAINT `cea_programme_membership_ibfk_2` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`Id`);

--
-- Constraints for table `cea_programme_school_level`
--
ALTER TABLE `cea_programme_school_level`
  ADD CONSTRAINT `cea_programme_school_level_ibfk_1` FOREIGN KEY (`CeaProgrammeId`) REFERENCES `cea_programme` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `cea_project`
--
ALTER TABLE `cea_project`
  ADD CONSTRAINT `cea_project_ibfk_1` FOREIGN KEY (`CeaProjectTypeId`) REFERENCES `cea_project_type` (`Id`),
  ADD CONSTRAINT `cea_project_ibfk_2` FOREIGN KEY (`CeaProgrammeId`) REFERENCES `cea_programme` (`Id`),
  ADD CONSTRAINT `cea_project_ibfk_3` FOREIGN KEY (`CeaProjectId`) REFERENCES `cea_project` (`Id`);

--
-- Constraints for table `cea_project_membership`
--
ALTER TABLE `cea_project_membership`
  ADD CONSTRAINT `cea_project_membership_ibfk_1` FOREIGN KEY (`CaeProjectId`) REFERENCES `cea_project` (`Id`),
  ADD CONSTRAINT `cea_project_membership_ibfk_2` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`Id`);

--
-- Constraints for table `cea_project_type_school_level`
--
ALTER TABLE `cea_project_type_school_level`
  ADD CONSTRAINT `cea_project_type_school_level_ibfk_1` FOREIGN KEY (`CeaProjectTypeId`) REFERENCES `cea_project_type` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `cea_role`
--
ALTER TABLE `cea_role`
  ADD CONSTRAINT `cea_role_ibfk_1` FOREIGN KEY (`CeaProgrammeId`) REFERENCES `cea_programme` (`Id`);

--
-- Constraints for table `cea_role_staff`
--
ALTER TABLE `cea_role_staff`
  ADD CONSTRAINT `cea_role_staff_ibfk_1` FOREIGN KEY (`CeaRoleId`) REFERENCES `cea_role` (`Id`);

--
-- Constraints for table `cea_role_student`
--
ALTER TABLE `cea_role_student`
  ADD CONSTRAINT `cea_role_student_ibfk_1` FOREIGN KEY (`CeaRoleId`) REFERENCES `cea_role` (`Id`);

--
-- Constraints for table `cea_school_programme`
--
ALTER TABLE `cea_school_programme`
  ADD CONSTRAINT `cea_school_programme_ibfk_1` FOREIGN KEY (`CeaProgrammeId`) REFERENCES `cea_programme` (`Id`),
  ADD CONSTRAINT `cea_school_programme_ibfk_2` FOREIGN KEY (`CeaProgrammeSupporterId`) REFERENCES `cea_programme_supporter` (`Id`);

--
-- Constraints for table `cea_scout_advancement_level`
--
ALTER TABLE `cea_scout_advancement_level`
  ADD CONSTRAINT `fk_cea_scout_advancement_level_cea_scout_proficiency_badges1` FOREIGN KEY (`CeaScoutProficiencyBadgesId`) REFERENCES `cea_scout_proficiency_badges` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cea_scout_membership`
--
ALTER TABLE `cea_scout_membership`
  ADD CONSTRAINT `fk_cea_scout_membership_cea_scout_section_level1` FOREIGN KEY (`CeaScoutSectionLevelId`) REFERENCES `cea_scout_section_level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cea_scout_proficiency_badges`
--
ALTER TABLE `cea_scout_proficiency_badges`
  ADD CONSTRAINT `fk_cea_scout_proficiency_badges_cea_scout_section_level1` FOREIGN KEY (`CeaScoutSectionLevelId`) REFERENCES `cea_scout_section_level` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cea_scout_section_level`
--
ALTER TABLE `cea_scout_section_level`
  ADD CONSTRAINT `fk_cea_scout_section_level_cea_scout_section` FOREIGN KEY (`CeaScoutSectionId`) REFERENCES `cea_scout_section` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cea_student_award`
--
ALTER TABLE `cea_student_award`
  ADD CONSTRAINT `cea_student_award_ibfk_1` FOREIGN KEY (`CeaAwardId`) REFERENCES `cea_award` (`Id`);

--
-- Constraints for table `cea_student_training`
--
ALTER TABLE `cea_student_training`
  ADD CONSTRAINT `cea_student_training_ibfk_1` FOREIGN KEY (`CeaTrainingId`) REFERENCES `cea_training` (`Id`);

--
-- Constraints for table `cea_student_training_participant`
--
ALTER TABLE `cea_student_training_participant`
  ADD CONSTRAINT `cea_student_training_participant_ibfk_1` FOREIGN KEY (`CeaStudentTrainingId`) REFERENCES `cea_student_training` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `cea_student_training_participant_ibfk_2` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`Id`);

--
-- Constraints for table `cea_training`
--
ALTER TABLE `cea_training`
  ADD CONSTRAINT `cea_training_ibfk_1` FOREIGN KEY (`CeaProgrammeId`) REFERENCES `cea_programme` (`Id`),
  ADD CONSTRAINT `cea_training_ibfk_2` FOREIGN KEY (`CeaTrainingTypeId`) REFERENCES `cea_training_type` (`Id`);

--
-- Constraints for table `cea_training_school_level`
--
ALTER TABLE `cea_training_school_level`
  ADD CONSTRAINT `cea_training_school_level_ibfk_1` FOREIGN KEY (`CeaTrainingId`) REFERENCES `cea_training` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `std_class_scholarship_type`
--
ALTER TABLE `std_class_scholarship_type`
  ADD CONSTRAINT `std_class_scholarship_type_ibfk_1` FOREIGN KEY (`StdScholarchipTypeId`) REFERENCES `std_scholarship` (`Id`);

--
-- Constraints for table `std_class_student_type`
--
ALTER TABLE `std_class_student_type`
  ADD CONSTRAINT `std_class_student_type_ibfk_1` FOREIGN KEY (`StdStudentTypeId`) REFERENCES `std_student_type` (`Id`);

--
-- Constraints for table `std_reporting`
--
ALTER TABLE `std_reporting`
  ADD CONSTRAINT `std_reporting_ibfk_1` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`Id`);

--
-- Constraints for table `std_role_school_level`
--
ALTER TABLE `std_role_school_level`
  ADD CONSTRAINT `std_role_school_level_ibfk_1` FOREIGN KEY (`StdRoleId`) REFERENCES `std_role` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `std_role_student`
--
ALTER TABLE `std_role_student`
  ADD CONSTRAINT `std_role_student_ibfk_1` FOREIGN KEY (`StdRoleId`) REFERENCES `std_role` (`Id`);

--
-- Constraints for table `std_scholarship_school_level`
--
ALTER TABLE `std_scholarship_school_level`
  ADD CONSTRAINT `std_scholarship_school_level_ibfk_1` FOREIGN KEY (`StdScholarshipId`) REFERENCES `std_scholarship` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `std_special_benefit_school_level`
--
ALTER TABLE `std_special_benefit_school_level`
  ADD CONSTRAINT `std_special_benefit_school_level_ibfk_1` FOREIGN KEY (`StdSpecialBenefitId`) REFERENCES `std_special_benefit` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `std_student_disciplinary`
--
ALTER TABLE `std_student_disciplinary`
  ADD CONSTRAINT `std_student_disciplinary_ibfk_1` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`id`),
  ADD CONSTRAINT `std_student_disciplinary_ibfk_2` FOREIGN KEY (`StdDisciplinaryOffenceTypeId`) REFERENCES `std_disciplinary_offence_type` (`id`),
  ADD CONSTRAINT `std_student_disciplinary_ibfk_3` FOREIGN KEY (`StdDisciplinarySeverityId`) REFERENCES `std_disciplinary_severity` (`id`),
  ADD CONSTRAINT `std_student_disciplinary_ibfk_4` FOREIGN KEY (`StdDisciplinaryActionTypeId`) REFERENCES `std_disciplinary_action_type` (`id`);

--
-- Constraints for table `std_student_father`
--
ALTER TABLE `std_student_father`
  ADD CONSTRAINT `std_student_father_ibfk_1` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `std_student_guardian`
--
ALTER TABLE `std_student_guardian`
  ADD CONSTRAINT `std_student_guardian_ibfk_1` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `std_student_mother`
--
ALTER TABLE `std_student_mother`
  ADD CONSTRAINT `std_student_mother_ibfk_1` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`Id`) ON DELETE CASCADE;

--
-- Constraints for table `std_student_scholarship`
--
ALTER TABLE `std_student_scholarship`
  ADD CONSTRAINT `std_student_scholarship_ibfk_1` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `std_student_scholarship_ibfk_2` FOREIGN KEY (`StdScholarshipId`) REFERENCES `std_scholarship` (`Id`);

--
-- Constraints for table `std_student_school_detail`
--
ALTER TABLE `std_student_school_detail`
  ADD CONSTRAINT `std_student_school_detail_ibfk_1` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `std_student_school_detail_ibfk_2` FOREIGN KEY (`StdStudentTypeId`) REFERENCES `std_student_type` (`Id`);

--
-- Constraints for table `std_student_separated_whereabout`
--
ALTER TABLE `std_student_separated_whereabout`
  ADD CONSTRAINT `std_student_separated_whereabout_ibfk_1` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`Id`),
  ADD CONSTRAINT `std_student_separated_whereabout_ibfk_2` FOREIGN KEY (`StdDropoutCaseTypeId`) REFERENCES `std_dropout_case_type` (`Id`);

--
-- Constraints for table `std_student_special_benefit`
--
ALTER TABLE `std_student_special_benefit`
  ADD CONSTRAINT `std_student_special_benefit_ibfk_1` FOREIGN KEY (`StdStudentId`) REFERENCES `std_student` (`Id`) ON DELETE CASCADE,
  ADD CONSTRAINT `std_student_special_benefit_ibfk_2` FOREIGN KEY (`StdSpecialBenefitId`) REFERENCES `std_student_special_benefit` (`Id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
