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
-- Database: `emis_organization`
--

-- --------------------------------------------------------

--
-- Table structure for table `application_attachments`
--

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
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_attachments`
--

INSERT INTO `application_attachments` (`id`, `ApplicationDetailsId`, `ApplicationVerificationId`, `name`, `user_defined_file_name`, `path`, `upload_type`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('3e8faa82-3134-4013-9a26-05796ceb1e24', 'bd28eb1f-c41f-43da-a03d-386831dde456', NULL, '1622177699_newedgezoo.png', 'sdfsdfs', '/tmp/file_store/Organization', NULL, NULL, NULL, '2021-05-28 04:54:59.000000', '2021-05-28 04:54:59.000000'),
('9114d7cb-0272-46e0-931e-7ad2daefa661', '8ff2d656-bf12-4821-b051-81b3b5f86a46', NULL, '1622177283_newedgezoo.png', 'sdfsdfs', 'opt/file_store/Organization', NULL, NULL, NULL, '2021-05-28 04:48:03.000000', '2021-05-28 04:48:03.000000'),
('fcdd02c2-9d2c-4927-a33f-235ebd775fa6', 'd737d1a5-f312-4543-bb31-7c86873548bb', NULL, '1622177901_newedgezoo.png', 'ddddd', '/tmp/file_store/Organization', NULL, NULL, NULL, '2021-05-28 04:58:21.000000', '2021-05-28 04:58:21.000000');

-- --------------------------------------------------------

--
-- Table structure for table `application_class_stream`
--

CREATE TABLE `application_class_stream` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreignKeyFor` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ApplicationDetailsId` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `classId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `streamId` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_details`
--

CREATE TABLE `application_details` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `application_no` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `registered_org_code` char(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `establishment_type` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `category` tinyint(4) DEFAULT NULL,
  `dzongkhagId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gewogId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `chiwogId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `application_type` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `year` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_details`
--

INSERT INTO `application_details` (`id`, `application_no`, `registered_org_code`, `establishment_type`, `category`, `dzongkhagId`, `gewogId`, `chiwogId`, `application_type`, `year`, `status`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('5e2b9a4c-5e84-444c-9361-f9b907d46e8c', 'Estb-202105-0003', NULL, 'Public School', 1, '14', '151', '3426', '4320bce9-b47e-4f07-8049-15972560aa28', NULL, 'pending', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', NULL, '2021-05-28 04:56:59.000000', '2021-05-28 04:56:59.000000'),
('8ff2d656-bf12-4821-b051-81b3b5f86a46', 'Estb-202105-0001', NULL, 'Public School', 1, '14', '151', '3426', '4320bce9-b47e-4f07-8049-15972560aa28', NULL, 'pending', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', NULL, '2021-05-28 04:44:55.000000', '2021-05-28 04:44:55.000000'),
('bd28eb1f-c41f-43da-a03d-386831dde456', 'Estb-202105-0002', NULL, 'Public School', 1, '14', '151', '3426', '4320bce9-b47e-4f07-8049-15972560aa28', NULL, 'pending', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', NULL, '2021-05-28 04:50:41.000000', '2021-05-28 04:50:41.000000'),
('d737d1a5-f312-4543-bb31-7c86873548bb', 'Estb-202105-0004', NULL, 'Public School', 1, '14', '151', '3426', '4320bce9-b47e-4f07-8049-15972560aa28', NULL, 'pending', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', NULL, '2021-05-28 04:58:10.000000', '2021-05-28 04:58:10.000000');

-- --------------------------------------------------------

--
-- Table structure for table `application_est_bifurcation`
--

CREATE TABLE `application_est_bifurcation` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApplicationDetailsId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initiated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateOfBifurcation` date DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_est_bifurcation_details`
--

CREATE TABLE `application_est_bifurcation_details` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApplicationEstBifurcationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposedName` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `levelId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locationId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isGeoPoliticallyLocated` tinyint(4) DEFAULT NULL,
  `isSenSchool` tinyint(4) DEFAULT NULL,
  `isFeedingSchool` tinyint(4) DEFAULT NULL,
  `locationTypeId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposedLocation` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_est_closure`
--

CREATE TABLE `application_est_closure` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApplicationDetailsId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarksForClosure` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateOfClosure` date DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_est_details_change`
--

CREATE TABLE `application_est_details_change` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApplicationDetailsId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `change_type` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposedChange` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `changeInDetails` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initiatedBy` varchar(200) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_est_merger`
--

CREATE TABLE `application_est_merger` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApplicationDetailsId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `OldOrganizationId` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `OldOrganizationId2` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposedName` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initiated_by` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `levelId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locationId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isGeoPoliticallyLocated` tinyint(4) DEFAULT NULL,
  `isSenSchool` tinyint(4) DEFAULT NULL,
  `isFeedingSchool` tinyint(4) DEFAULT NULL,
  `locationTypeId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_est_private`
--

CREATE TABLE `application_est_private` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApplicationDetailsId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposedName` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `levelId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proprietorName` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proprietorCid` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proprietorPhone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proprietorMobile` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proprietorEmail` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `totalLand` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enrollmentBoys` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `enrollmentGirls` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposedLocation` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposedInfrastructure` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `typeOfSchool` tinyint(4) DEFAULT NULL,
  `created_by` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_est_public`
--

CREATE TABLE `application_est_public` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApplicationDetailsId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposedName` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `initiated_by` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `levelId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `locationId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isGeoPoliticallyLocated` tinyint(4) DEFAULT NULL,
  `isSenSchool` tinyint(4) DEFAULT NULL,
  `isFeedingSchool` tinyint(4) DEFAULT NULL,
  `locationTypeId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proposedLocation` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `coLocatedParent` tinyint(4) DEFAULT NULL,
  `parentSchool` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_est_public`
--

INSERT INTO `application_est_public` (`id`, `ApplicationDetailsId`, `proposedName`, `initiated_by`, `levelId`, `locationId`, `isGeoPoliticallyLocated`, `isSenSchool`, `isFeedingSchool`, `locationTypeId`, `proposedLocation`, `coLocatedParent`, `parentSchool`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('69b971ab-b16c-4430-88bb-15a3c210dac5', '8ff2d656-bf12-4821-b051-81b3b5f86a46', 'name of the proposed school', 'BABBB', '4320bce9-b47e-4f07-8049-15972560aa28', 'e5dcc28e-e8ad-4ee3-816e-90d66082800c', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-28 04:44:55.000000', '2021-05-28 04:44:55.000000'),
('808dc63e-a2d1-4165-bc03-78c513d2418e', '5e2b9a4c-5e84-444c-9361-f9b907d46e8c', 'name of the proposed school', 'BABBB', '4320bce9-b47e-4f07-8049-15972560aa28', 'e5dcc28e-e8ad-4ee3-816e-90d66082800c', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-28 04:56:59.000000', '2021-05-28 04:56:59.000000'),
('a4bc8d84-5514-4048-8afb-ae3a0337f2ef', 'bd28eb1f-c41f-43da-a03d-386831dde456', 'name of the proposed school', 'BABBB', '4320bce9-b47e-4f07-8049-15972560aa28', 'e5dcc28e-e8ad-4ee3-816e-90d66082800c', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-28 04:50:41.000000', '2021-05-28 04:50:41.000000'),
('ec06f07e-87cf-4ae2-b4b2-bd42fd9d6857', 'd737d1a5-f312-4543-bb31-7c86873548bb', 'asdfsad', 'sadfasdf', '4320bce9-b47e-4f07-8049-15972560aa28', '63176e8b-f0fa-4d97-ae8d-ab391dc7ab03', 0, 0, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2021-05-28 04:58:10.000000', '2021-05-28 04:58:10.000000');

-- --------------------------------------------------------

--
-- Table structure for table `application_no_meals`
--

CREATE TABLE `application_no_meals` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreignKeyFor` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foreignKeyId` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noOfMeals` tinyint(4) DEFAULT NULL,
  `created_by` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `application_no_meals`
--

INSERT INTO `application_no_meals` (`id`, `foreignKeyFor`, `foreignKeyId`, `noOfMeals`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('79f13e23-44d3-4216-ac0e-a79aa225cb67', 'application_est_public', '69b971ab-b16c-4430-88bb-15a3c210dac5', 1, NULL, NULL, '2021-05-28 04:44:55.000000', '2021-05-28 04:44:55.000000'),
('bf91ae7a-33d4-4e68-9913-4ba5f73d160d', 'application_est_public', '69b971ab-b16c-4430-88bb-15a3c210dac5', 2, NULL, NULL, '2021-05-28 04:44:55.000000', '2021-05-28 04:44:55.000000'),
('683af9d2-3bed-44b7-913f-7f227168c2e7', 'application_est_public', 'a4bc8d84-5514-4048-8afb-ae3a0337f2ef', 1, NULL, NULL, '2021-05-28 04:50:41.000000', '2021-05-28 04:50:41.000000'),
('8d17a690-dcfb-4f11-a762-ea266e2ed24c', 'application_est_public', 'a4bc8d84-5514-4048-8afb-ae3a0337f2ef', 2, NULL, NULL, '2021-05-28 04:50:41.000000', '2021-05-28 04:50:41.000000'),
('f574dd6c-b1d5-444e-8cb9-83ebb2620621', 'application_est_public', '808dc63e-a2d1-4165-bc03-78c513d2418e', 1, NULL, NULL, '2021-05-28 04:56:59.000000', '2021-05-28 04:56:59.000000'),
('f42be27a-01fa-4e54-a621-c88bbc46219f', 'application_est_public', '808dc63e-a2d1-4165-bc03-78c513d2418e', 2, NULL, NULL, '2021-05-28 04:56:59.000000', '2021-05-28 04:56:59.000000');

-- --------------------------------------------------------

--
-- Table structure for table `application_proprietor_details`
--

CREATE TABLE `application_proprietor_details` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApplicationEstDetailsChangeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `proposedName` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proprietorCid` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proprietorMobile` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proprietorPhone` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `proprietorEmail` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_sequence`
--

CREATE TABLE `application_sequence` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `service_name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `last_sequence` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `application_sequence`
--

INSERT INTO `application_sequence` (`id`, `service_name`, `last_sequence`) VALUES
('f8fa55f4-454f-4a6f-8da7-649845c532d1', 'New Establishment', 4);

-- --------------------------------------------------------

--
-- Table structure for table `application_verification`
--

CREATE TABLE `application_verification` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApplicationDetailsId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `verifyingAgency` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tentativeDate` date DEFAULT NULL,
  `remarks` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `application_verification_team`
--

CREATE TABLE `application_verification_team` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `ApplicationVerificationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `agency` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teamMember` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `verificationDate` date DEFAULT NULL,
  `remarks` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `attachments`
--

CREATE TABLE `attachments` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attachments`
--

INSERT INTO `attachments` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('1ee13b10-29d2-451e-b6c2-fe3286a8e8ee', 'Report Proposal', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:05:13', '2021-05-19 07:05:13', NULL),
('694c0d55-4986-4f64-b8a9-8baeae78ca9b', 'Lag thram', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:04:58', '2021-05-19 07:04:58', NULL),
('c9d300d2-d5c1-49f7-98b9-7dac48e8117b', 'Clearances', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:05:19', '2021-05-19 07:05:19', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `attachment_files`
--

CREATE TABLE `attachment_files` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `orgRecordId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `filePath` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attachment_files`
--

INSERT INTO `attachment_files` (`id`, `orgRecordId`, `filePath`, `title`, `remark`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('57b5579e-1d1a-4fd4-83f7-4cb1a9ff9f12', 'Estb-202105-0037', 'Organization', '1621840948_test upload file', NULL, NULL, NULL, '2021-05-24 07:22:28', '2021-05-24 07:22:28'),
('d487bafa-1462-4b4e-a3bb-ce94adedbacd', 'Estb-202105-0037', 'Organization', '1621840948_test upload file', NULL, NULL, NULL, '2021-05-24 07:22:28', '2021-05-24 07:22:28');

-- --------------------------------------------------------

--
-- Table structure for table `bifurcations`
--

CREATE TABLE `bifurcations` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `applicationNo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parentOrgId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `new1Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new1Level` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `new1Category` tinyint(4) NOT NULL,
  `new1Dzongkhag` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `new1Gewog` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `new1Chiwog` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `new1Location` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `new1IsGeoLocated` tinyint(4) DEFAULT NULL,
  `new1IsSenSchool` tinyint(4) NOT NULL,
  `new1IsCoLocated` tinyint(4) DEFAULT NULL,
  `new1ParentSchool` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `new2Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `new2Level` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `new2Category` tinyint(4) NOT NULL,
  `new2Dzongkhag` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `new2Gewog` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `new2Chiwog` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `new2Location` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `new2IsGeoLocated` tinyint(4) DEFAULT NULL,
  `new2IsSenSchool` tinyint(4) NOT NULL,
  `new2IsCoLocated` tinyint(4) DEFAULT NULL,
  `new2ParentSchool` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL COMMENT 'Pending->Submitted->Under Process or Rejectd->Approved ->Registered',
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `classes`
--

CREATE TABLE `classes` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `class` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `displayOrder` tinyint(4) NOT NULL,
  `category` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classes`
--

INSERT INTO `classes` (`id`, `class`, `displayOrder`, `category`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('086a0c39-f2a2-41ab-b643-ca0f689a57aa', 'XI', 12, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:54:09', '2021-05-19 06:54:09', NULL),
('0f150274-91e4-4fc1-906e-79bd1b3a1734', 'VI', 7, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:53:36', '2021-05-19 06:53:36', NULL),
('17b8e2ba-aeaa-4e87-a2ae-cf6bc13cd446', 'II', 3, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:51:02', '2021-05-19 06:51:02', NULL),
('1e4d1886-afeb-4161-bb8b-49cdca0e50a1', 'VIII', 9, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:53:48', '2021-05-19 06:53:48', NULL),
('327adec4-fb7d-40fb-b351-9924c9d05562', 'V', 6, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:53:30', '2021-05-19 06:53:30', NULL),
('37e6a4d1-ad28-4902-a524-2c176c90a2c9', 'IV', 5, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:51:16', '2021-05-19 06:51:16', NULL),
('4e28295d-a18f-46a1-8af2-6b79f6276176', 'III', 4, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:51:09', '2021-05-19 06:51:09', NULL),
('88449356-ede4-42b2-a449-ce6561d86bc0', 'I', 2, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:50:54', '2021-05-19 06:50:54', NULL),
('8930ec7a-b690-4f43-a4d2-d9a8dce162b2', 'VII', 8, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:53:42', '2021-05-19 06:53:42', NULL),
('9972cd84-4343-4171-a049-f55d11da201e', 'Age 3', 3, 'eccd', 1, '13a568b8-d019-4da6-8c19-878ad276591e', NULL, '2021-05-25 16:05:06', '2021-05-25 16:05:06', NULL),
('b25d7be2-1237-45e5-ab7f-4a0214e044ae', 'PP', 1, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:50:38', '2021-05-19 06:50:38', NULL),
('dbdc53f4-0185-4fdc-8092-43798cc1de70', 'XII', 13, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:54:15', '2021-05-19 06:54:15', NULL),
('ea6fe1b1-3b3e-4489-abc0-5ab9af1ce8b3', 'IX', 10, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:53:53', '2021-05-19 06:53:53', NULL),
('efc535b3-dda4-4dba-8f4f-6e0fc01521c1', 'Age 2', 2, 'eccd', 1, NULL, NULL, NULL, NULL, NULL),
('efc535b3-dda4-4dba-8f4f-6e0fc0155612', 'Age 1', 1, 'eccd', 1, NULL, NULL, NULL, NULL, NULL),
('efc535b3-dda4-4dba-8f4f-6e0fc01556c1', 'X', 11, 'school', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:54:01', '2021-05-19 06:54:01', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `class_mappings`
--

CREATE TABLE `class_mappings` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `classId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_mappings-to-delete`
--

CREATE TABLE `class_mappings-to-delete` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `classId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `class_stream_mappings`
--

CREATE TABLE `class_stream_mappings` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `classId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `streamId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class_stream_mappings`
--

INSERT INTO `class_stream_mappings` (`id`, `classId`, `streamId`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('000484d2-326e-4348-a023-9b97461ec504', 'dbdc53f4-0185-4fdc-8092-43798cc1de70', '4157a2f3-a64c-4a53-af76-0ff968d69c87', NULL, NULL, '2021-05-21 09:29:28', '2021-05-21 09:29:28'),
('365bc229-b311-48fb-ab19-ad36341b9bda', '086a0c39-f2a2-41ab-b643-ca0f689a57aa', '4157a2f3-a64c-4a53-af76-0ff968d69c87', NULL, NULL, '2021-05-21 09:29:28', '2021-05-21 09:29:28'),
('568e130e-b8ce-4e89-a7a7-b804e72dd6de', 'dbdc53f4-0185-4fdc-8092-43798cc1de70', '1ee005c0-6ac8-4478-b178-c1982e87dfa4', NULL, NULL, '2021-05-21 09:29:28', '2021-05-21 09:29:28'),
('689c0094-6fbc-45d8-b00c-0ff16fcd48d3', 'dbdc53f4-0185-4fdc-8092-43798cc1de70', '77ad4ebc-64af-465d-99d9-7f79d7314892', NULL, NULL, '2021-05-21 09:29:28', '2021-05-21 09:29:28'),
('958d5d0c-bd73-44cf-9f8d-94312e4b3bf4', '086a0c39-f2a2-41ab-b643-ca0f689a57aa', '77ad4ebc-64af-465d-99d9-7f79d7314892', NULL, NULL, '2021-05-21 09:29:28', '2021-05-21 09:29:28'),
('b3244128-34a7-4771-a766-549026eee237', '086a0c39-f2a2-41ab-b643-ca0f689a57aa', '1ee005c0-6ac8-4478-b178-c1982e87dfa4', NULL, NULL, '2021-05-21 09:29:28', '2021-05-21 09:29:28');

-- --------------------------------------------------------

--
-- Table structure for table `closures`
--

CREATE TABLE `closures` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `level` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `dzongkhag` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `gewog` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `chiwog` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `location` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `geoPoliticallyLocated` tinyint(4) NOT NULL,
  `senSchool` tinyint(4) NOT NULL,
  `reason` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remark` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `connectivities`
--

CREATE TABLE `connectivities` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `roadTypeId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `distanceFromRoad` decimal(8,2) DEFAULT NULL,
  `daysFromRoad` decimal(8,2) DEFAULT NULL,
  `hoursFromRoad` decimal(8,2) DEFAULT NULL,
  `electricitySourceId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `electricitySupplyId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `hasElectricalSubstation` int(11) NOT NULL,
  `telephoneServiceProvoderId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `internetServiceProviderId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `mbps` char(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `drukRenConnection` int(11) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `contactTypeId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `phone` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contact_types`
--

CREATE TABLE `contact_types` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `contact_types`
--

INSERT INTO `contact_types` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('17f0596c-1cff-4e9f-bc56-46fba678eb92', 'email', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:04:12', '2021-05-19 07:04:12', NULL),
('d1169016-4e82-4f2e-ace7-4590e1c18199', 'Phone', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:04:07', '2021-05-19 07:04:07', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `disaster`
--

CREATE TABLE `disaster` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `disaster`
--

INSERT INTO `disaster` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('a4de6bf4-edc4-41ef-8555-6d6039195b73', 'Landslide', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:55:22', '2021-05-19 06:55:22', NULL),
('aa973b7c-7b7b-45e0-aeea-486a66a83d9b', 'Flood', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:55:29', '2021-05-19 06:55:29', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `electricity_sources`
--

CREATE TABLE `electricity_sources` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `electricity_sources`
--

INSERT INTO `electricity_sources` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('44135fcf-421f-4b46-8df7-7787f84761bf', 'Wind', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:04:35', '2021-05-19 07:04:35', NULL),
('6be69e8c-b933-4b68-a4ec-a3724495b3ed', 'Solar', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:04:31', '2021-05-19 07:04:31', NULL),
('71c19da3-9101-4b7c-ad5a-7824e5a0e304', 'GRID', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:04:22', '2021-05-19 07:04:22', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `electricity_supplies`
--

CREATE TABLE `electricity_supplies` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `electricity_supplies`
--

INSERT INTO `electricity_supplies` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('7a677fac-6c20-4496-bf9a-587c487b8f3a', 'Sub Station', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:04:44', '2021-05-19 07:04:44', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `equipment_and_furniture`
--

CREATE TABLE `equipment_and_furniture` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `type` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `item` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `location` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipment_items`
--

CREATE TABLE `equipment_items` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `equipmentItem` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `equipmentType` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `equipment_items`
--

INSERT INTO `equipment_items` (`id`, `equipmentItem`, `equipmentType`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('72328283-9ad7-47c4-94e6-f48b2ddde7a2', 'Testtubes', 'd0ebbe61-669b-4de0-878d-6a3cc971ef7b', 'testtubes', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:03:33', '2021-05-19 07:03:33'),
('857c8903-21f7-4ee3-a440-814288def2bf', 'Projector', '5e575479-188a-4432-a482-8e285fa45c47', 'projectors', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:03:55', '2021-05-19 07:03:55');

-- --------------------------------------------------------

--
-- Table structure for table `equipment_type`
--

CREATE TABLE `equipment_type` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `equipment_type`
--

INSERT INTO `equipment_type` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('5e575479-188a-4432-a482-8e285fa45c47', 'ICT Equipment', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:59:00', '2021-05-19 06:59:00', NULL),
('d0ebbe61-669b-4de0-878d-6a3cc971ef7b', 'Lab Equipments', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:59:13', '2021-05-19 06:59:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `head_quater_details`
--

CREATE TABLE `head_quater_details` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `departmentId` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zestAgencyCode` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `agencyName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `organizationType` tinyint(4) NOT NULL,
  `chiwogId` tinyint(4) NOT NULL,
  `dzongkhagId` tinyint(4) NOT NULL,
  `gewogId` tinyint(4) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `head_quater_details`
--

INSERT INTO `head_quater_details` (`id`, `departmentId`, `zestAgencyCode`, `agencyName`, `organizationType`, `chiwogId`, `dzongkhagId`, `gewogId`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('0387cc80-f231-4cb8-a0ca-9e40e023f393', 'e38fc067-f486-4327-aefc-5e1eb506f781', 'RCSC_Code63', 'Trashigang Dzongkhag', 0, 127, 15, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0685ee51-7b8b-41af-b4e2-11178ae18a88', 'b72052a8-eb3d-4023-a894-265c28f1c323', 'RCSC_Code15', 'Career Education & Counselling Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('076cc09a-4416-4723-91be-91fb2923652f', '5324c8d1-f407-460c-9556-cd519289e601', 'RCSC_Code70', 'Samdrupjongkhar Thromde', 0, 127, 11, 110, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('078f178e-0838-41e8-a33d-ad223ba2ba05', '7132abb0-bccf-4676-a3bb-83a168b2017f', 'RCSC_Code65', 'Tsirang Dzongkhag', 0, 127, 18, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('08e52ed7-641c-4e87-b138-e7655af497c3', '0ed72e75-a751-4d80-9187-a2849f43abb8', 'RCSC_Code22', 'Human Resource Division ', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0b38b068-83a6-4307-8d12-a518d34ff7c5', 'b72052a8-eb3d-4023-a894-265c28f1c323', 'RCSC_Code13', 'Youth Centre Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('18a35824-b8c0-4e68-ab8c-50624199fbe0', 'b72052a8-eb3d-4023-a894-265c28f1c323', 'RCSC_Code17', 'Games & Sports Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('18befefd-1f54-4d86-bed8-d50460881b22', '0ed72e75-a751-4d80-9187-a2849f43abb8', 'RCSC_Code21', 'Legal Services', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1a260846-0ab3-427f-970e-742a83185ca7', '70d82386-a4f2-4854-8ded-5450ff33499e', 'RCSC_Code68', 'Gelephu Thromde', 0, 127, 13, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1a8de140-d5e5-4e98-8cf1-b155fddbd9e7', 'bb77c793-25d2-426a-8858-fc824c499d29', 'RCSC_Code53', 'Lhuntse Dzongkhag', 0, 127, 6, 47, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1cc33857-b91d-4f13-a0dd-007c5b8fa80f', '66099723-8e10-4354-88d9-ba3d442bbe3f', 'RCSC_Code56', 'Pemagatsel Dzongkhag', 0, 127, 9, 86, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1e496aab-7c38-433b-9077-a4ee504b9980', '56601aee-9ef2-4fd1-9816-70f3325298d5', 'RCSC_Code51', 'Gasa Dzongkhag', 0, 127, 4, 35, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2130fdcc-0af5-48a3-9356-f1af68b9ed06', '557cc0b7-881a-49e7-835c-83f38d75f981', 'RCSC_Code44', 'Dorokha Dungkhag', 0, 127, 12, 122, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('25f81025-719d-40f0-9f6b-a36349b832e3', '0f1e06ae-d833-44ae-aab8-06837df65b0c', 'RCSC_Code38', 'Overseas Mission & Embassies', 2, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('277540cd-29e7-4f4f-a4bd-528da447e2a7', '569f477e-b103-438b-860f-9ed3ac7f1cf2', 'RCSC_Code31', 'Secretariat Services', 0, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2c08a8a5-7a81-4c08-9300-3ada9ad2eba4', '145e354d-6770-4ae9-9c5b-b41b64de8ef6', 'RCSC_Code42', 'Curriculum Development Centre', 0, 127, 8, 74, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2ccd7730-a8b8-4761-9076-e874e448610f', 'e020217d-6fec-4b8c-b6ba-278184fbad4e', 'RCSC_Code41', 'Engineering Sector', 0, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2dcdc73d-b4ee-4a17-8d15-55d5a50f6c0e', '4f80e627-7685-4ad2-b4d1-d25394dca244', 'RCSC_Code6', 'ECCD and Special Education Needs Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3301c77d-91ca-46ff-a487-437d9ef33edb', '0ed72e75-a751-4d80-9187-a2849f43abb8', 'RCSC_Code23', 'Office of the Director', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('33269f11-7ce7-40d5-ac6b-a61665e69841', 'b72052a8-eb3d-4023-a894-265c28f1c323', 'RCSC_Code14', 'Scouts & Culture Education Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3a81c241-c969-422a-b423-679be7ba0592', 'bcd9e22d-2956-4bef-8e98-c470526fefe9', 'RCSC_Code59', 'Samtse Dzongkhag', 0, 127, 12, 122, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3d11b8cc-d448-49d8-b709-2da567131207', '0ed72e75-a751-4d80-9187-a2849f43abb8', 'RCSC_Code18', 'Finance Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('407665a9-0d47-4442-b5c7-64aeb61c742f', '4f80e627-7685-4ad2-b4d1-d25394dca244', 'RCSC_Code10', 'Teacher Professional Support Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4549a3a2-ca3b-43be-bfd2-4e19b667a9b6', 'cbf3d1f1-6b3b-493f-8003-f9e63b2e64ff', 'RCSC_Code43', 'Department of Business & Finance', 0, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('472dda32-e225-4af3-9f31-72e315a80eea', '5e480a4c-3a0f-4afe-8453-76c27d3cacdc', 'RCSC_Code32', 'Human Settlement Sector', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('48cc41b3-e7d0-4e7c-9d44-56ba5de000c2', 'c0821afc-9e44-42b9-88b7-a0cf3af69e18', 'RCSC_Code33', 'Office of the Gyalpoi Zimpon', 0, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4c0117fc-378a-4e1e-a257-b4831ab00b83', '2019b335-a14a-4e0d-83e2-76a6b9a5b201', 'RCSC_Code52', 'Haa Dzongkhag', 0, 127, 5, 40, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4cecef7a-2965-41de-8f96-1735c673866a', '1dd43348-f093-4888-884c-ae24185854ad', 'RCSC_Code36', 'Royal Academy Construction Project,Pangbisa, Paro', 0, 127, 8, 74, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4dc176d9-88a6-47d5-b707-7467949f19af', '4f80e627-7685-4ad2-b4d1-d25394dca244', 'RCSC_Code12', 'Private School Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('567563a8-edd6-4621-87d2-81aa5cf64c74', 'b72052a8-eb3d-4023-a894-265c28f1c323', 'RCSC_Code16', 'Office of the Director', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5a677b31-9ed3-4a9a-94f5-6ab771e03801', '64362807-7008-45d4-be6c-54569ae97f65', 'RCSC_Code34', 'Office of De-Suung', 0, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5a90c0ba-3a30-4dbe-8d87-b2b484b3263b', '82280eae-3efa-4a2c-b49d-dfd56efe5f63', 'RCSC_Code39', 'Department of Culture', 2, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5b02f4a5-a6f6-4cad-9a44-0e848ae4291d', '12d0e247-fe28-4d59-9804-05772204d9a1', 'RCSC_Code69', 'Phuentsholing Thromde', 0, 114, 2, 6, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5de64830-fbaa-4f01-84e6-233b159836ec', '54c777a0-7eab-4872-8171-8a5d90401cc2', 'RCSC_Code47', 'Pangbang Dungkhag', 0, 127, 13, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('60250135-0647-4431-89db-5a5569ca2577', '4f80e627-7685-4ad2-b4d1-d25394dca244', 'RCSC_Code8', 'School Health and Nutrition Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('62a61b1e-0dd9-45a4-a658-ab8ae60eee2e', '35590b2e-2ac3-4d83-89a3-6179999b73bb', 'RCSC_Code50', 'Dagana Dzongkhag', 0, 127, 3, 19, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('742860f4-5aa2-40f6-ba20-d30065ea8ce4', 'e0fd5a06-0d38-4cb0-97ef-f91f6b76b98e', 'RCSC_Code26', 'Office of the Secretary', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('78fa6a35-52e1-42d8-81ae-513a47960cf5', '4f80e627-7685-4ad2-b4d1-d25394dca244', 'RCSC_Code7', 'School Planning and Coordination Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7b9f07a2-91d9-4b01-91f3-b63af80ccb3f', '6a3df311-0b3c-4bfd-952c-bb00d7a6e99b', 'RCSC_Code66', 'Wangdue Dzongkhag', 0, 127, 19, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7e12a0e3-0137-472e-a353-ffa5d4e2a91d', '6514dadf-704f-4944-9fc5-2b3f4af690a5', 'RCSC_Code5', 'Office of the Director', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('813d38bf-e392-44d0-ad94-60173229d101', 'fa46bdea-0159-48ec-b0d5-bb8930b8fc7c', 'RCSC_Code30', 'Phuntsholing Dungkhag', 0, 114, 2, 6, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('813db0f7-990b-4fa1-b246-61ba68f74d67', '4f80e627-7685-4ad2-b4d1-d25394dca244', 'RCSC_Code11', 'Education Monitoring Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('849b2c29-f248-46c4-9632-e6ae9b424456', '768ed45f-4934-4638-9a74-abf04bfe0a74', 'RCSC_Code45', 'Wamrong Dungkhag', 0, 127, 15, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8b252bab-b923-4e35-bcd3-2fac59add551', '80cbd86f-c01f-436c-86c1-f7735e344814', 'RCSC_Code60', 'Sarpang Dzongkhag', 0, 127, 13, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9185d790-372d-4a30-b698-b181e43cc3e4', '6514dadf-704f-4944-9fc5-2b3f4af690a5', 'RCSC_Code3', 'Non Formal & Continuing Education  Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('968ad0bd-1416-4777-b321-355e6ac6d2f6', 'ffb4ed5e-2aaf-456a-84d6-e084118ac14c', 'RCSC_Code57', 'Punakha Dzongkhag', 0, 127, 10, 98, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9cc12bed-6f7d-479b-941a-94316c69c92f', '32c739de-e0dc-4ee7-8725-8cdf2fa5052e', 'RCSC_Code35', 'People Project', 0, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a069eb88-7e32-4630-98e9-88b37608653a', '2f4dce99-0f18-4940-9c84-bc46a43beb4a', 'RCSC_Code49', 'Chukha Dzongkhag', 0, 114, 2, 6, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a24fdd88-abd3-410b-995e-68170c93c91e', 'ed062170-a82e-45da-b71f-bc6634d91233', 'RCSC_Code64', 'Trongsa Dzongkhag', 0, 127, 17, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a85afcf3-6ab6-4e1d-8c73-f4cfa188b49f', 'ab39f071-f7c1-49fb-b628-3333a63db99a', 'RCSC_Code29', 'Demand Reduction Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a8c3a6bf-1b6b-4f89-bdf2-31503d631bc7', '0a8c667e-fbf5-4167-b553-91510e7c704e', 'RCSC_Code37', 'Bhutan National Commission for UNESCO', 2, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b8b4d452-c96f-48e4-addb-b3293302879c', '0ed72e75-a751-4d80-9187-a2849f43abb8', 'RCSC_Code20', 'School Planning and Building Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b9cfec1a-dd92-4ef0-add0-9866013c5039', '6514dadf-704f-4944-9fc5-2b3f4af690a5', 'RCSC_Code2', 'Scholarship and Student Support Division ', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c05a22e8-46b9-4c46-9961-996658972a97', '0ed72e75-a751-4d80-9187-a2849f43abb8', 'RCSC_Code19', 'ICT Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c15e095b-050c-4a64-a2dd-e03f44777077', '4ae7f2a2-a63f-4ff4-8307-6d33edd6de4e', 'RCSC_Code61', 'Thimphu Dzongkhag', 0, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c43a9b73-0ae6-4519-97e7-2af9fcd99e07', '724c0b11-e9ed-4bbc-83f9-6f918f3469ea', 'RCSC_Code46', 'Sakteng Dungkhag', 0, 127, 15, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c8eaceb6-ab95-4c2e-b62d-dc71adbe1ba4', '4c900829-7cee-461f-a528-57fe0feb684e', 'RCSC_Code48', 'Bumthang Dzongkhag', 0, 1, 1, 1, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c963336c-e533-4926-ab64-e70fbccdca29', '47686df4-e013-452e-b771-223aec1e5925', 'RCSC_Code25', 'Office of the Minister', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c9966c2c-7614-4848-8bf4-ce29c4c88189', '6514dadf-704f-4944-9fc5-2b3f4af690a5', 'RCSC_Code1', 'Higher Education Planning Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cbf27f55-a322-411b-8a4a-c1f9b58289e4', 'e629f2d5-62ac-49d1-8acc-69e293342faa', 'RCSC_Code55', 'Paro Dzongkhag', 0, 127, 8, 74, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d27bd930-d75b-4d97-b975-35353de86812', '54f20ee0-251c-4646-a1c4-a658d2fe3bd9', 'RCSC_Code54', 'Mongar Dzongkhag', 0, 127, 7, 56, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d3a772b8-4f93-4135-bda3-956538e31d0a', '32be31cf-bd13-40ea-a202-993faaaa7c21', 'RCSC_Code27', 'Policy and Planning Division (PPD)', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d829c194-2138-45cf-9408-cbd73d74cbae', '4f80e627-7685-4ad2-b4d1-d25394dca244', 'RCSC_Code9', 'Office of the Director', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e010968f-5ddc-4a8a-a906-b5483d75a4d9', '8ee8a973-c052-47de-991e-6fcac7413b12', 'RCSC_Code28', 'Secondary School Examinations Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e4644ef6-897d-4050-bd3c-6eb7a27ca906', '6514dadf-704f-4944-9fc5-2b3f4af690a5', 'RCSC_Code4', 'Quality Assurance & Accreditation Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e962d0ca-4291-4e4f-9f90-f9c714cec411', '6746f161-16c8-41d1-91fb-3eb9d1b281e4', 'RCSC_Code58', 'Samdrup Jongkhar Dzongkhag', 0, 127, 11, 110, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ecb1b04f-e6d9-4f55-89be-202e3ae1656b', '8f65f977-0d5d-4848-9190-a01c798e0c36', 'RCSC_Code71', 'Thimphu Thromde', 0, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ed63f88d-a2f2-4221-9b39-da3a576a85d5', '7e4a43c1-0ab6-4536-8124-8d7c2d5c1c58', 'RCSC_Code24', 'Internal Audit Division', 1, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f58b4190-c048-42d2-80ea-28c4d1f31820', '06d91a1f-c1b8-4016-855e-2b510b6e5993', 'RCSC_Code62', 'Trashi Yangtse Dzongkhag', 0, 127, 16, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fcaca2dc-b00a-413f-965b-b046b80f4219', '52f36399-d09a-43c2-83d8-eb78f52e8edb', 'RCSC_Code40', 'Hospitals/BHU I', 0, 127, 14, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fdbc7a27-692e-4130-bd67-c3b8308f6302', '794fd5b3-9d7d-4b64-999f-40a2cae2519b', 'RCSC_Code67', 'Zhemgang Dzongkhag', 0, 127, 20, 127, '1', '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `infrastructures`
--

CREATE TABLE `infrastructures` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `categoryId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `subCategoryId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `structureNo` int(11) DEFAULT NULL,
  `yearOfConstruction` int(11) NOT NULL,
  `plintchArea` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `noOfFloor` int(11) DEFAULT NULL,
  `totalCapacity` int(11) DEFAULT NULL,
  `rampAccess` tinyint(4) NOT NULL,
  `presentCondition` int(11) NOT NULL,
  `design` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `infrastructure_facilities`
--

CREATE TABLE `infrastructure_facilities` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `infrastructureId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `facilityTypeId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `facilityName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `capacity` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `noOfFacility` int(11) NOT NULL,
  `noAccessibleToDisabled` int(11) NOT NULL,
  `noWithInternetConnection` int(11) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `level`
--

CREATE TABLE `level` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `level`
--

INSERT INTO `level` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('4320bce9-b47e-4f07-8049-15972560aa28', 'Middle Secondary School', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-18 06:06:48', '2021-05-18 06:06:48', NULL),
('77123e10-a2af-4a74-8b0d-6908e1ddcbf8', 'Higher Secondary', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 00:54:36', '2021-05-19 00:54:36', NULL),
('863de9d9-6f6b-406e-82dc-591311d7f6e2', 'Primary', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-18 06:06:27', '2021-05-18 06:06:27', NULL),
('faaf3118-c21a-490d-a853-1abdc688a253', 'Community', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 00:54:42', '2021-05-19 00:54:42', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `location`
--

CREATE TABLE `location` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `location`
--

INSERT INTO `location` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('63176e8b-f0fa-4d97-ae8d-ab391dc7ab03', 'Rural', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:55:05', '2021-05-19 06:55:05', NULL),
('e5dcc28e-e8ad-4ee3-816e-90d66082800c', 'Urban', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:54:58', '2021-05-19 06:54:58', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `landOwnership` int(11) NOT NULL,
  `compoundFencing` int(11) NOT NULL,
  `entranceGate` int(11) NOT NULL,
  `longitude` decimal(8,2) DEFAULT NULL,
  `latitude` decimal(8,2) DEFAULT NULL,
  `altitude` decimal(8,2) DEFAULT NULL,
  `thramNo` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cid` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `compoundArea` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `location_disaster_risks`
--

CREATE TABLE `location_disaster_risks` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `locationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `disasterTypeId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_department`
--

CREATE TABLE `master_department` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) NOT NULL DEFAULT 1,
  `created_by` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `master_department`
--

INSERT INTO `master_department` (`id`, `name`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('06d91a1f-c1b8-4016-855e-2b510b6e5993', 'Trashi Yangtse Dzongkhag', 'Trashi Yangtse Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0a8c667e-fbf5-4167-b553-91510e7c704e', 'Bhutan National Commission for UNESCO', 'Bhutan National Commission for UNESCO', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0ed72e75-a751-4d80-9187-a2849f43abb8', 'Directorate', 'Directorate', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0f1e06ae-d833-44ae-aab8-06837df65b0c', 'Overseas Mission & Embassies', 'Overseas Mission & Embassies', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('12d0e247-fe28-4d59-9804-05772204d9a1', 'Phuentsholing Thromde', 'Phuentsholing Thromde', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('145e354d-6770-4ae9-9c5b-b41b64de8ef6', 'Curriculum Development Centre', 'Curriculum Development Centre', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1dd43348-f093-4888-884c-ae24185854ad', 'Royal Academy Construction Project,Pangbisa, Paro', 'Royal Academy Construction Project,Pangbisa, Paro', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2019b335-a14a-4e0d-83e2-76a6b9a5b201', 'Haa Dzongkhag', 'Haa Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2f4dce99-0f18-4940-9c84-bc46a43beb4a', 'Chukha Dzongkhag', 'Chukha Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('32be31cf-bd13-40ea-a202-993faaaa7c21', 'Policy and Planning Division (PPD)', 'Policy and Planning Division (PPD)', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('32c739de-e0dc-4ee7-8725-8cdf2fa5052e', 'People Project', 'People Project', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('35590b2e-2ac3-4d83-89a3-6179999b73bb', 'Dagana Dzongkhag', 'Dagana Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('47686df4-e013-452e-b771-223aec1e5925', 'Office of the Minister', 'Office of the Minister', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4ae7f2a2-a63f-4ff4-8307-6d33edd6de4e', 'Thimphu Dzongkhag', 'Thimphu Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4c900829-7cee-461f-a528-57fe0feb684e', 'Bumthang Dzongkhag', 'Bumthang Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4f80e627-7685-4ad2-b4d1-d25394dca244', 'Department of School Education', 'Department of School Education', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('52f36399-d09a-43c2-83d8-eb78f52e8edb', 'Hospitals/BHU I', 'Hospitals/BHU I', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5324c8d1-f407-460c-9556-cd519289e601', 'Samdrupjongkhar Thromde', 'Samdrupjongkhar Thromde', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('54c777a0-7eab-4872-8171-8a5d90401cc2', 'Pangbang Dungkhag', 'Pangbang Dungkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('54f20ee0-251c-4646-a1c4-a658d2fe3bd9', 'Mongar Dzongkhag', 'Mongar Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('557cc0b7-881a-49e7-835c-83f38d75f981', 'Dorokha Dungkhag', 'Dorokha Dungkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('56601aee-9ef2-4fd1-9816-70f3325298d5', 'Gasa Dzongkhag', 'Gasa Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('569f477e-b103-438b-860f-9ed3ac7f1cf2', 'Secretariat Services', 'Secretariat Services', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5e480a4c-3a0f-4afe-8453-76c27d3cacdc', 'Human Settlement Sector', 'Human Settlement Sector', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('64362807-7008-45d4-be6c-54569ae97f65', 'Office of De-Suung', 'Office of De-Suung', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6514dadf-704f-4944-9fc5-2b3f4af690a5', 'Department of Adult & Higher Education', 'Department of Adult & Higher Education', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('66099723-8e10-4354-88d9-ba3d442bbe3f', 'Pemagatsel Dzongkhag', 'Pemagatsel Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6746f161-16c8-41d1-91fb-3eb9d1b281e4', 'Samdrup Jongkhar Dzongkhag', 'Samdrup Jongkhar Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6a3df311-0b3c-4bfd-952c-bb00d7a6e99b', 'Wangdue Dzongkhag', 'Wangdue Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('70d82386-a4f2-4854-8ded-5450ff33499e', 'Gelephu Thromde', 'Gelephu Thromde', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7132abb0-bccf-4676-a3bb-83a168b2017f', 'Tsirang Dzongkhag', 'Tsirang Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('724c0b11-e9ed-4bbc-83f9-6f918f3469ea', 'Sakteng Dungkhag', 'Sakteng Dungkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('768ed45f-4934-4638-9a74-abf04bfe0a74', 'Wamrong Dungkhag', 'Wamrong Dungkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('794fd5b3-9d7d-4b64-999f-40a2cae2519b', 'Zhemgang Dzongkhag', 'Zhemgang Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7e4a43c1-0ab6-4536-8124-8d7c2d5c1c58', 'Internal Audit Division', 'Internal Audit Division', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('80cbd86f-c01f-436c-86c1-f7735e344814', 'Sarpang Dzongkhag', 'Sarpang Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('82280eae-3efa-4a2c-b49d-dfd56efe5f63', 'Department of Culture', 'Department of Culture', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8ee8a973-c052-47de-991e-6fcac7413b12', 'Secondary School Examinations Division', 'Secondary School Examinations Division', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8f65f977-0d5d-4848-9190-a01c798e0c36', 'Thimphu Thromde', 'Thimphu Thromde', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ab39f071-f7c1-49fb-b628-3333a63db99a', 'Demand Reduction Division', 'Demand Reduction Division', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b72052a8-eb3d-4023-a894-265c28f1c323', 'Department of Youth & Sports', 'Department of Youth & Sports', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('bb77c793-25d2-426a-8858-fc824c499d29', 'Lhuntse Dzongkhag', 'Lhuntse Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('bcd9e22d-2956-4bef-8e98-c470526fefe9', 'Samtse Dzongkhag', 'Samtse Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c0821afc-9e44-42b9-88b7-a0cf3af69e18', 'Office of the Gyalpoi Zimpon', 'Office of the Gyalpoi Zimpon', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cbf3d1f1-6b3b-493f-8003-f9e63b2e64ff', 'Department of Business & Finance', 'Department of Business & Finance', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e020217d-6fec-4b8c-b6ba-278184fbad4e', 'Engineering Sector', 'Engineering Sector', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e0fd5a06-0d38-4cb0-97ef-f91f6b76b98e', 'Office of the Secretary', 'Office of the Secretary', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e38fc067-f486-4327-aefc-5e1eb506f781', 'Trashigang Dzongkhag', 'Trashigang Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e629f2d5-62ac-49d1-8acc-69e293342faa', 'Paro Dzongkhag', 'Paro Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ed062170-a82e-45da-b71f-bc6634d91233', 'Trongsa Dzongkhag', 'Trongsa Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fa46bdea-0159-48ec-b0d5-bb8930b8fc7c', 'Phuntsholing Dungkhag', 'Phuntsholing Dungkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ffb4ed5e-2aaf-456a-84d6-e084118ac14c', 'Punakha Dzongkhag', 'Punakha Dzongkhag', 1, '', '', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `master_disaster_type`
--

CREATE TABLE `master_disaster_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(45) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_document_type`
--

CREATE TABLE `master_document_type` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicableTo` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_financial_information`
--

CREATE TABLE `master_financial_information` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `applicableTo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `master_income_facilities`
--

CREATE TABLE `master_income_facilities` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(99) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2021_02_19_053727_create_disaster_table', 1),
(2, '2021_02_20_090321_create_location_table', 1),
(3, '2021_02_24_044850_create_structure_category_table', 1),
(4, '2021_02_24_134446_create_level_table', 1),
(5, '2021_02_24_145855_create_structure_facility_table', 1),
(6, '2021_02_24_173601_create_equipment_type_table', 1),
(7, '2021_02_24_175425_create_equipment_usage_table', 1),
(8, '2021_02_24_181853_create_sport_facility_type_table', 1),
(9, '2021_02_24_184154_create_sport_supporter_table', 1),
(10, '2021_02_25_051659_create_structure_sub_categories_table', 1),
(11, '2021_02_25_092015_create_equipment_items_table', 1),
(12, '2021_03_01_030108311_create_organization_class_streams_table', 1),
(13, '2021_03_01_030108312_create_organization_details_table', 1),
(14, '2021_03_01_030108313_create_classes_table', 1),
(15, '2021_03_01_030108314_create_streams_table', 1),
(16, '2021_03_01_083112_create_sections_table', 1),
(17, '2021_03_01_091244_create_equipment_and_furniture_table', 1),
(18, '2021_03_03_041700_create_section_details_table', 1),
(19, '2021_03_03_041701_create_service_providers_table', 1),
(20, '2021_03_03_041702_create_electricity_supplies_table', 1),
(21, '2021_03_03_041703_create_electricity_sources_table', 1),
(22, '2021_03_03_041704_create_road_types_table', 1),
(23, '2021_03_16_091332_create_connectivities_table', 1),
(24, '2021_03_16_091333_create_contact_types_table', 1),
(25, '2021_03_16_105921_create_contact_details_table', 1),
(26, '2021_03_16_190506_create_locations_table', 1),
(27, '2021_03_18_111905_create_infrastructures_table', 1),
(28, '2021_03_19_105629_create_structure_facilities_table', 1),
(29, '2021_03_22_183255_create_establishments_table', 1),
(30, '2021_03_23_103045_create_establishment_class_streams_table', 1),
(31, '2021_03_27_143244_create_closures_table', 1),
(32, '2021_03_31_062719_create_bifurcations_table', 1),
(33, '2021_04_02_192302_create_location_disaster_risks_table', 1),
(34, '2021_04_06_064229_create_application_proprietor_details_table', 1),
(35, '2021_04_06_065706_create_organization_proprietor_details_table', 1),
(36, '2021_04_06_082450_create_school_feedings_table', 1),
(37, '2021_04_08_012450_create_structure_designers_table', 1),
(38, '2021_04_08_090013_create_class_mappings_table', 1),
(39, '2021_04_08_124017_application_sequence', 1),
(40, '2021_04_09_064952_create_head_quater_details_table', 1),
(41, '2021_04_13_172909_create_attachments_table', 1),
(42, '2021_04_17_041034_create_attachment_files_table', 1),
(43, '2021_04_19_000921_create_sport_facility_subtypes_table', 1),
(44, '2021_04_19_130048_wash_feeding', 1),
(45, '2021_04_20_042705_create_sports_table', 1),
(46, '2021_05_09_100328_org_profile', 2);

-- --------------------------------------------------------

--
-- Table structure for table `organization_child_facilities`
--

CREATE TABLE `organization_child_facilities` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `hasNapRoom` tinyint(3) NOT NULL,
  `noNapRoom` int(3) DEFAULT NULL,
  `hasIndoorPlaySpace` tinyint(3) NOT NULL,
  `noIndoorPlaySpace` int(3) DEFAULT NULL,
  `hasOutDoorPlayground` tinyint(3) NOT NULL,
  `noOutDoorPlayground` int(3) DEFAULT NULL,
  `sizeOutDoorPlayground` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `hasAdequateVentilation` tinyint(3) NOT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_class_streams`
--

CREATE TABLE `organization_class_streams` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `classId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `streamId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organization_class_streams`
--

INSERT INTO `organization_class_streams` (`id`, `organizationId`, `classId`, `streamId`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '88449356-ede4-42b2-a449-ce6561d86bc0', 'Null', 'null', 'null', '0000-00-00 00:00:00', NULL),
('5f1553b2-ed0b-4b50-b9ea-83b193042de5', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'efc535b3-dda4-4dba-8f4f-6e0fc01556c1', 'Null', 'null', 'null', '0000-00-00 00:00:00', NULL),
('6c2ca46d-e630-401d-8a2e-a25d303841d1', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '8930ec7a-b690-4f43-a4d2-d9a8dce162b2', 'Null', 'null', 'null', '0000-00-00 00:00:00', NULL),
('6fc68168-937b-4d24-80b9-3d2a241e10c4', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '1e4d1886-afeb-4161-bb8b-49cdca0e50a1', 'Null', 'null', 'null', '0000-00-00 00:00:00', NULL),
('74217e56-f58b-4aef-a976-6277bae06d58', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'b25d7be2-1237-45e5-ab7f-4a0214e044ae', 'Null', 'null', 'null', '0000-00-00 00:00:00', NULL),
('755bb014-859b-4c7c-b194-8a134fd059eb', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '0f150274-91e4-4fc1-906e-79bd1b3a1734', 'Null', 'null', 'null', '0000-00-00 00:00:00', NULL),
('780d917c-ed3e-4157-b8c3-146039118805', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '17b8e2ba-aeaa-4e87-a2ae-cf6bc13cd446', 'Null', 'null', 'null', '0000-00-00 00:00:00', NULL),
('7daac690-94d1-409e-86b3-d07fa1522b9c', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '37e6a4d1-ad28-4902-a524-2c176c90a2c9', 'Null', 'null', 'null', '0000-00-00 00:00:00', NULL),
('a9aba5bb-22a2-4622-b253-9fc48ddeedd6', '4184f12c-a7fc-40c3-b038-013e242d8ef6', 'ea6fe1b1-3b3e-4489-abc0-5ab9af1ce8b3', 'Null', 'null', 'null', '0000-00-00 00:00:00', NULL),
('e5c58728-9412-4b0d-b498-7f174dd4ad4b', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '4e28295d-a18f-46a1-8af2-6b79f6276176', 'Null', 'null', 'null', '0000-00-00 00:00:00', NULL),
('ecfa0f9a-5820-4797-a79f-499d2598bfb6', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '327adec4-fb7d-40fb-b351-9924c9d05562', 'Null', 'null', 'null', '0000-00-00 00:00:00', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organization_class_streams_history`
--

CREATE TABLE `organization_class_streams_history` (
  `record_id` int(11) NOT NULL,
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `classId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `streamId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `recorded_on` timestamp NULL DEFAULT NULL,
  `recorded_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_compound_details`
--

CREATE TABLE `organization_compound_details` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `thramNo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `plotNo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pegInformation` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `compoundArea` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `playgroundArea` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `playgroundAreaUsable` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agricultureArea` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `agricultureAreaUsed` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_details`
--

CREATE TABLE `organization_details` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `levelId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `dzongkhagId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `gewogId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `chiwogId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `locationId` char(200) COLLATE utf8_unicode_ci NOT NULL,
  `isGeopoliticallyLocated` tinyint(4) NOT NULL,
  `isSenSchool` tinyint(4) NOT NULL,
  `isFeedingSchool` tinyint(1) DEFAULT NULL,
  `parentSchoolId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isColocated` tinyint(4) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `yearOfEstablishment` int(11) NOT NULL,
  `organizationType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zestAgencyCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `typeOfSchool` char(10) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organization_details`
--

INSERT INTO `organization_details` (`id`, `name`, `code`, `category`, `levelId`, `dzongkhagId`, `gewogId`, `chiwogId`, `locationId`, `isGeopoliticallyLocated`, `isSenSchool`, `isFeedingSchool`, `parentSchoolId`, `isColocated`, `status`, `yearOfEstablishment`, `organizationType`, `zestAgencyCode`, `remarks`, `typeOfSchool`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('00311272-9395-436f-a955-23e67a7141cc', 'Gonyetsawa', '028.201.00177', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00177', 'Gonyetsawa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('013c3599-a526-4d09-b168-9463c9278db6', 'Tshaphel', '028.201.00082', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '5', '40', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00082', 'Tshaphel Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('01b36128-44c8-452e-ba48-cb746a359344', 'Logchina', '028.201.00029', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00029', 'Logchina Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('029ea6d0-a328-45f2-9dee-b9c7c6aa35b1', 'Phegpari', '028.201.00362', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00362', 'Phegpari Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('02bab20a-0b43-4831-bf61-9e9c37493632', 'Drukgyel Central School', '028.201.00165', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00165', 'Drukgyel Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('02f8b22e-0dc0-49a3-89b8-2c8d88967d00', 'Mendhagang', '028.201.00229', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00229', 'Mendhagang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0352d565-f345-469a-941d-df2e901a4197', 'Thongsa', '028.201.00211', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00211', 'Thongsa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('045c16ec-cecc-4870-b264-d0a718b0b688', 'The Royal Academy', '028.201.00546', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00546', 'The Royal Academy Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('04a287bd-ebeb-4d07-8554-a609ee8cf077', 'Dungtse central school', '028.201.00510', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00510', 'Dungtse central school Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0509bfbb-eb2a-490a-8649-2d2fc70a7a7c', 'Sarjung', '028.201.00255', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00255', 'Sarjung Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('05154937-079f-4e87-b922-0235e575d1ca', 'Jungshina', '028.201.00540', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00540', 'Jungshina Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('054345eb-22ba-4a57-b134-398277a0b876', 'Bhoteykharka', '028.204.00122', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00122', 'Bhoteykharka Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0560be33-a4e4-4043-b969-e0e48040f5e6', 'Dechen Perli', '028.201.00288', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00288', 'Dechen Perli Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0672790e-47e7-4698-a223-bc00730813b4', 'Sarpang central school', '028.201.00278', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00278', 'Sarpang central school Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0784a581-12d0-45da-9f25-a732b9588670', 'Mendregang Central School', '028.201.00432', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00432', 'Mendregang Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('07fc9ad3-7471-45a2-9f02-4fb9058bc44f', 'Tashidingkha Central School', '028.201.00216', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00216', 'Tashidingkha Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0846b6a7-b43c-4538-848f-6eefa00b9f49', 'Lungtenzampa', '028.201.00298', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00298', 'Lungtenzampa Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0852bc93-ed9e-4fd9-81c9-5d8a8a554b55', 'Gashari', '028.204.00003', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00003', 'Gashari Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('086869b2-b5a4-408b-9f70-7b809c92dee2', 'Trashidingkha', '028.201.00430', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00430', 'Trashidingkha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('08edc7af-e149-42f7-871f-6463ca3428cb', 'Bumdeling', '028.201.00381', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00381', 'Bumdeling Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('08ff6ca0-8868-4531-8a32-6b5e3bb0d9a0', 'Gakiling', '028.201.00514', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00514', 'Gakiling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('095246c4-8d1e-496a-a74e-a183f5df4eb5', 'Khangma', '028.201.00201', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00201', 'Khangma Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0a8e822a-40d0-4ab7-9edd-afe86df08424', 'Muhung', '028.201.00147', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00147', 'Muhung Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0ab0305e-c840-46a3-a205-c1245d9e0531', 'Bagla', '028.201.00135', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00135', 'Bagla Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0ac80af6-dad8-4d06-89cd-daf1a03b0d57', 'Yangchenphug', '028.201.00294', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00294', 'Yangchenphug Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0b0c2dab-bf80-4ac1-b4fa-316a1c611919', 'Sha Tasha', '028.201.00451', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00451', 'Sha Tasha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0b34dfca-ff53-437e-a8fc-2ca67715a117', 'Tongshuna', '028.204.00074', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00074', 'Tongshuna Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0cdc2992-63d8-49c2-858f-9267eff98412', 'Chapcha', '028.201.00035', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00035', 'Chapcha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0d0d7da9-3be9-42cb-b659-3287c318fae4', 'Etho Metho', '028.202.00018', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00018', 'Etho Metho Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0d5c3ed1-984d-4704-a836-816c5768c2bc', 'Khothakpa', '028.201.00204', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00204', 'Khothakpa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0d675577-246d-40e9-8c06-06cacffcffbe', 'Kheni', '028.201.00392', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00392', 'Kheni Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0d9185c7-c507-4610-b1fb-23261e651c37', 'Thimyul', '028.201.00092', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00092', 'Thimyul Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0d9a2b69-cca2-449e-9ade-ae161fbbc50c', 'Shengana', '028.201.00221', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00221', 'Shengana Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0e663891-85f2-4a71-b11e-a74f6705b8f4', 'Tang Central School', '028.201.00004', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00004', 'Tang Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0f0d7a28-aed6-4582-bdea-168827c4a56e', 'Karma Academy', '028.202.00042', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00042', 'Karma Academy Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0f1b72f2-7efb-4042-a82c-e64c9d7adcb9', 'Dungna', '028.201.00027', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00027', 'Dungna Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0f63403c-a644-4451-aefe-3901221caf54', 'Chimong', '028.201.00192', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00192', 'Chimong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('0f989ee8-658a-4983-bf16-436f70a0fd66', 'Simphu', '028.201.00428', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00428', 'Simphu Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('100ac08d-6f20-4200-8d0b-6e952029985a', 'Lungtengang', '028.201.00065', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00065', 'Lungtengang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('10d98fd8-dad8-4c75-a8ed-12a1ee1b338f', 'Thimphu', '028.202.00024', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00024', 'Thimphu Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1109ff8c-bbdd-44a8-9902-b7f0ab49f777', 'Karmaling', '028.201.00538', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00538', 'Karmaling Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('112b6ae5-8bf7-4e8e-92b3-fd501a604ac7', 'Orong central school', '028.201.00238', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00238', 'Orong central school Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1164df19-345b-4cdd-9777-21b9606b04d8', 'Tsangphuchen', '028.201.00394', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00394', 'Tsangphuchen Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1214d11b-00ad-4fb3-b08b-3f22fe71ad3b', 'Devitar', '028.204.00054', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00054', 'Devitar Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('128580a9-3563-42bc-8cf4-7705428a6e96', 'Malbasey', '028.204.00039', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00039', 'Malbasey Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('13586f94-c13d-425e-b0e8-f01a409ac75d', 'Nima', '028.202.00014', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00014', 'Nima Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('13dabb8f-c313-417c-8b5a-1c0c628dd051', 'Desi', '028.202.00031', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '151', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00031', 'Desi Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('13ff24dc-dc0f-417c-875d-927795811b43', 'Tshaluna', '028.201.00318', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '', '', '', '', 0, 0, NULL, NULL, NULL, '1', 2005, '1', '028.201.00318', 'Tshaluna Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'c97b408f-f515-4388-98aa-7dbf3b5aeee3', '0000-00-00 00:00:00', '2021-05-05 10:03:34'),
('142a0306-81ed-4645-8e6e-7c268254e810', 'Ngatshang', '028.201.00149', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00149', 'Ngatshang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('146730da-8f08-4213-b548-05cd18fe0c7f', 'Zungnye', '028.201.00018', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00018', 'Zungnye Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('14926b11-8517-465c-b64e-7431e7bf4fa5', 'Jigmecholing', '028.201.00289', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00289', 'Jigmecholing Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('149b1ed4-97f0-4584-a018-0a9743fedb95', 'Tsakaling', '028.201.00131', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00131', 'Tsakaling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('14d43ed5-6508-4773-ba9f-6d793bd14ef6', 'Tsimakha', '028.201.00053', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00053', 'Tsimakha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('15393335-2f54-48bc-8c5b-32971d49f035', 'Yadi Central School', '028.201.00119', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00119', 'Yadi Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1579bd39-c3e7-4e69-91e6-5bc1007ac068', 'Sangkama', '028.204.00083', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00083', 'Sangkama Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1627693c-a93c-49ce-9d78-a44905affc36', 'Gangphel', '028.204.00051', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00051', 'Gangphel Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('162ee927-a1fe-4e8b-bc7b-c07b0b6c5f25', 'Rabtey', '028.201.00404', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00404', 'Rabtey Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('16b4bfe1-62cd-451b-b3c3-37a072eb1734', 'Rangjung', '028.201.00329', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00329', 'Rangjung Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('16cb5d39-0a13-49f3-9cbb-d050025ed21a', 'Tokshingmang', '028.201.00370', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00370', 'Tokshingmang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('177c916a-1966-496c-bd35-83c9407429af', 'Sinchula', '028.201.00036', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00036', 'Sinchula Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1798d57d-5722-4810-be2b-9af427584a92', 'Bayta', '028.201.00454', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00454', 'Bayta Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('17b04cda-310c-4c2b-a930-4d59548e87bb', 'Thanza ', '028.204.00157', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '4', '35', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00157', 'Thanza  Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('17b4f165-b698-46a2-920d-b685d0bc4a6e', 'Nobding', '028.201.00445', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00445', 'Nobding Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1838e289-aa9a-4f33-8212-73bc36284fed', 'Panbari', '028.201.00499', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00499', 'Panbari Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1840f9df-fc38-40ea-9191-0cb167cb17e4', 'Sergithang', '028.201.00440', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00440', 'Sergithang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1886f8f7-0044-49c3-b6c9-beaa51ab66dc', 'Tading', '028.204.00040', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00040', 'Tading Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('18945dda-ac9f-40ff-8ed6-7594948d30fb', 'Khaling', '028.201.00327', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00327', 'Khaling Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('18ee4017-e02e-417b-b016-28081f4885fd', 'Zunglen', '028.201.00133', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00133', 'Zunglen Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('18f8b085-e2f7-4eae-bb3e-a06152599cf1', 'Nimshong', '028.201.00481', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00481', 'Nimshong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('19e019ba-b14b-484b-a30f-34a5023b4a53', 'Baylling central school', '028.201.00402', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00402', 'Baylling central school Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1a141941-89f2-4b3c-9440-fa3ba0d999a3', 'Minjiwoong Central School', '028.201.00243', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00243', 'Minjiwoong Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1b594f91-dac0-437a-8b5c-73568ffdb954', 'Metakha', '028.201.00047', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00047', 'Metakha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1bb621ef-844b-459b-bc50-2cde214a1d76', 'Damphu', '028.201.00433', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00433', 'Damphu Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1c0fb4c3-b961-4d09-98b8-284145f0bc3f', 'Nimshong', '028.201.00426', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00426', 'Nimshong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1e62454b-5846-4cd9-b050-c29aaace2672', 'Tongzhang', '028.201.00395', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00395', 'Tongzhang Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1e643027-08f5-4726-970d-b16996908b22', 'Drukjegang Central School', '028.201.00055', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00055', 'Drukjegang Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1ea66e5c-e624-4aa6-abd4-dbe2cee99314', 'ELC High School', '028.202.00041', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00041', 'ELC High School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1f2feb0e-8ecb-4c8e-b06f-41ccae1c8cb1', 'Kangpar', '028.201.00326', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00326', 'Kangpar Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1f3de03b-7de6-444a-a6c6-7001d99c6da3', 'Muenselling Institute', '028.205.00001', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.205.00001', 'Muenselling Institute Special Institute', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('1f57a750-e1eb-461a-abf9-a2bb21ebcefb', 'Phuentsholing', '028.201.00020', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '22', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00020', 'Phuentsholing Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2012c540-3002-4c1c-9f95-3b5e08591707', 'Tarphel', '028.201.00380', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00380', 'Tarphel Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('205ca73b-a03e-4cdd-85be-7a70d40d6026', 'Gaupey', '028.201.00173', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00173', 'Gaupey Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('20b8cc18-058e-4692-b416-2f70399d9e63', 'Deothang', '028.201.00235', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '23', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00235', 'Deothang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('20cc9146-68cc-4d6a-94f8-eb43459435e3', 'Tshaidang', '028.201.00479', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00479', 'Tshaidang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2178f5b6-c663-4aed-a548-40f5895ece94', 'Chaskhar Pam', '028.201.00139', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00139', 'Chaskhar Pam Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2228a7d9-ff90-4562-add6-d955926edcce', 'Chendebji', '028.201.00419', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00419', 'Chendebji Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('22c4c94e-28d5-4e29-a2f3-28c01c5f28d5', 'Khatoeykha', '028.201.00536', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00536', 'Khatoeykha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('230e0cee-c575-4ccc-97e1-34c5c34b3662', 'Chumigthang', '028.201.00030', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00030', 'Chumigthang Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2327e643-dc45-48f5-ad82-044c66295070', 'Digala', '028.201.00484', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00484', 'Digala Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('235f948e-88ba-4af3-8683-7ee6c9ed4bd1', 'Nigurey', '028.204.00097', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00097', 'Nigurey Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('239ed864-d6fa-4f0f-bcdd-7a86d628e4cc', 'Tsholingkhar', '028.201.00507', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00507', 'Tsholingkhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('23b1c44b-5c2e-479a-a43e-105265edc261', 'Jampel', '028.202.00034', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '5', '40', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00034', 'Jampel Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2428d04e-0d6f-46f9-a33c-efd52695ea94', 'Jyenkhana', '028.201.00084', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '5', '40', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00084', 'Jyenkhana Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2491f86e-2105-4f52-bb70-20eccd753e5e', 'Chukha Central School', '028.201.00019', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00019', 'Chukha Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('251efe6d-7df5-41e3-8a49-e5e70b8af507', 'Tashibi', '028.201.00488', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00488', 'Tashibi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('25b1c8dc-997c-4536-8e70-1adf30dd6735', 'Gomdar Central School', '028.201.00241', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00241', 'Gomdar Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('263a0927-7e05-422b-a0ae-1b336651b813', 'Lamitar', '028.204.00063', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00063', 'Lamitar Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('26b5c950-4727-4ba5-8292-4bbc20e83c53', 'Langmadung', '028.201.00408', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00408', 'Langmadung Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('26de53c4-3270-4dd9-8d0f-f567ae3e7c91', 'Jaringay', '028.204.00008', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00008', 'Jaringay Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('271bd269-e4af-44ec-9654-52be991f2f17', 'Arekha', '028.201.00033', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00033', 'Arekha Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('27798856-1437-4847-b607-19b4e7057069', 'Gyelpozhing Central School', '028.201.00116', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00116', 'Gyelpozhing Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('279dede0-2217-451b-b360-f044d35eca61', 'Babesa', '028.201.00308', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00308', 'Babesa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('27da6888-56c5-4404-ae25-3fc78aed90fc', 'Ura Central School', '028.201.00003', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00003', 'Ura Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('27eba876-1402-4e90-95dc-27b2fe1bda33', 'Lakhu', '028.201.00227', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00227', 'Lakhu Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('28da4ceb-5a16-4dbd-b49b-aba68ced7282', 'Rinchen Kuenphen', '028.201.00312', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00312', 'Rinchen Kuenphen Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('29d0cfa7-ffc6-4752-9e16-062e34785970', 'Gomtu', '028.201.00262', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00262', 'Gomtu Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2a28c483-a6b5-41e1-9074-c56da925c0a5', 'Nahi', '028.201.00448', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00448', 'Nahi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2a47fee0-98cf-446e-baff-0ac67898e3d7', 'Yum Thuji Zam Charity', '028.202.00027', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '151', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00027', 'Yum Thuji Zam Charity Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2a6d4993-c569-41be-a902-901eda7edf4e', 'Yangnyeer', '028.201.00375', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00375', 'Yangnyeer Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2ae9e328-0039-45f4-ada8-30e53dfe5f65', 'Chakzom', '028.201.00103', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00103', 'Chakzom Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2b413a5b-2dbb-4f11-9ac1-e19b12b926db', 'Sombek', '028.204.00095', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00095', 'Sombek Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2d6c64ad-6f2d-4112-a019-af6dcebf9d6d', 'Rangshikhar', '028.201.00363', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00363', 'Rangshikhar Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2e4358c6-e680-4846-ab52-701db296358a', 'Lapsakha', '028.201.00228', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00228', 'Lapsakha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2e825e14-6562-47ce-92eb-4fa574cc5a22', 'Tashilakha', '028.201.00509', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00509', 'Tashilakha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2f41825c-bc45-4f6f-adf0-ada4f603bf56', 'Gortshom', '028.201.00094', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00094', 'Gortshom Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2f4fc323-1421-4c79-a035-78ab300ff517', 'Kilkhorthang PS', '028.201.00436', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00436', 'Kilkhorthang PS Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2f681f96-7745-4c24-bc52-f4f5cbdc13f2', 'Zhemgang Central School', '028.201.00468', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00468', 'Zhemgang Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('2f705df3-d7c7-4e15-aa2f-f8fdbe4d2cb9', 'Umling', '028.201.00292', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00292', 'Umling Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('300a9f0e-b9bc-4190-afc1-4480e60a372b', 'Jurmey', '028.201.00129', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00129', 'Jurmey Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('30302e41-c800-48cf-b4ea-c74b6f17be5d', 'Phekoma', '028.201.00069', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00069', 'Phekoma Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3061d08c-b0ac-46c0-bed5-d315b55a4592', 'Sakhu', '028.204.00067', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00067', 'Sakhu Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3069b040-9db8-49fa-a4a5-8362727cbaf9', 'Jonkhar', '028.201.00356', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00356', 'Jonkhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('307313eb-c167-46b3-a62c-5eec8304b2a0', 'Namgaycholing', '028.201.00274', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00274', 'Namgaycholing Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('30a27640-004c-462b-8814-30da4f3c0e78', 'Tsangkha', '028.201.00072', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00072', 'Tsangkha Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('30b14110-9c61-4e2f-b876-e04191e50a6d', 'Sherubling central school', '028.201.00409', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00409', 'Sherubling central school Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3166dba7-3c26-4e6d-9d55-f9bdbb355d68', 'Daliphangma', '028.201.00351', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00351', 'Daliphangma Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `organization_details` (`id`, `name`, `code`, `category`, `levelId`, `dzongkhagId`, `gewogId`, `chiwogId`, `locationId`, `isGeopoliticallyLocated`, `isSenSchool`, `isFeedingSchool`, `parentSchoolId`, `isColocated`, `status`, `yearOfEstablishment`, `organizationType`, `zestAgencyCode`, `remarks`, `typeOfSchool`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('326d5b2a-9362-4cec-806a-eb2a4aae03ea', 'Doonglagang PS', '028.201.00438', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00438', 'Doonglagang PS Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('32f441e9-a80d-4ae4-80ba-354070bb871e', 'Phaytekha', '028.201.00548', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00548', 'Phaytekha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('33b4edae-bc1b-48ed-b477-8a597756c937', 'Motithang', '028.201.00293', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00293', 'Motithang Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('34342fbd-4861-4a18-8a4a-4124641cd13f', 'Dungmin', '028.201.00193', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00193', 'Dungmin Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('34426779-5319-43f9-80b8-2045d370b604', 'Minjey', '028.201.00097', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00097', 'Minjey Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('345a3b15-4bd6-4b3b-8773-0edf988890d7', 'Nganglam Central School', '028.201.00184', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00184', 'Nganglam Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3484b9c7-6a21-4806-b621-453472c2d489', 'Bajo', '028.201.00442', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00442', 'Bajo Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('356bb0af-83e4-4a82-9f7a-316fedd046ff', 'Drukgyel', '028.201.00172', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00172', 'Drukgyel Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3678f48d-6c72-4a21-aae4-88140310287a', 'SamdrupJongkhar', '028.201.00248', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '23', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00248', 'SamdrupJongkhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3748fa0a-90e6-4d11-96ed-075912fadcd4', 'Kikhar', '028.201.00496', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00496', 'Kikhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('37cdd1f6-49a1-45eb-8194-f6942cc7c49e', 'Ongar', '028.201.00109', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00109', 'Ongar Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('39cff3ae-6109-4564-9715-024ab3d8370e', 'Sengor', '028.201.00154', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00154', 'Sengor Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('39e2970d-b532-48c5-a50c-b824bbbed175', 'Tshogonpa', '028.201.00373', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00373', 'Tshogonpa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3a687035-62fa-4dc4-aac2-33e85cdc4f85', 'Thrindangbi', '028.201.00159', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00159', 'Thrindangbi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3b61b8ac-c841-48e2-bee7-c508e6e71467', 'Sunshine', '028.202.00022', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00022', 'Sunshine Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3b987dc1-5bef-40c6-aa48-cf5e8d23cd64', 'Rishore', '028.204.00154', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00154', 'Rishore Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3bc166f3-819d-49df-93a7-2a21761357d0', 'Shali', '028.201.00407', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00407', 'Shali Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3bf58d61-cad3-481a-9805-293f8ce4efe4', 'Garpawoong', '028.201.00236', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00236', 'Garpawoong Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3ca3cfb2-b09b-47db-9d8b-b81fa557af5b', 'Singye', '028.201.00521', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00521', 'Singye Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3ccacbab-20e5-4da1-9198-acfa41cac40d', 'Tsebar', '028.201.00190', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00190', 'Tsebar Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3d34eeaa-9807-4872-8dab-1f28145676b4', 'Changzamtog', '028.201.00301', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00301', 'Changzamtog Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3d504fc3-dbaf-40dc-ac0e-414e76ccb959', 'Bongo', '028.201.00034', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00034', 'Bongo Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('3e9f2c49-c78f-4fd9-9cc0-ecbbed8c2b94', 'Shingkhar', '028.201.00482', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00482', 'Shingkhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('40d43207-7486-4683-8ada-a65af34d48a2', 'Jangphutse', '028.201.00393', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00393', 'Jangphutse Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4184f12c-a7fc-40c3-b038-013e242d8ef6', 'Khangkhu', '028.201.00167', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1628', '', 0, 0, NULL, NULL, NULL, '1', 2005, '1', '028.201.00167', 'Khangkhu Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '633e0a9a-aa14-4b12-b661-ca120eb3bbf6', '0000-00-00 00:00:00', '2021-05-06 05:53:43'),
('4218d138-c224-4921-9e10-7a44e656c045', 'Mongar', '028.201.00117', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00117', 'Mongar Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('42d5191d-30bd-4d2a-8ec6-c913bd92f592', 'Jigme Losel', '028.201.00310', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00310', 'Jigme Losel Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('42d8ca5d-fa78-431d-b142-3f83128607f0', 'Pelkhil', '028.202.00028', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00028', 'Pelkhil Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('42dd2ddf-aab8-45b7-9b29-9a9e103564c0', 'Saling', '028.201.00153', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00153', 'Saling Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('42e00396-6db4-4992-aa20-f3902adf4e86', 'Thrakthrik', '028.201.00368', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00368', 'Thrakthrik Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4330ab00-569a-4e6a-a776-6ccb68ff329f', 'Wokuna', '028.204.00075', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00075', 'Wokuna Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('43491f23-8366-40d0-a08c-5ba0ba18d72f', 'Barpong', '028.201.00492', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00492', 'Barpong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('43b00dab-1923-458b-84e1-9a8941aab106', 'Woongchiloo', '028.201.00212', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00212', 'Woongchiloo Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('43bf4e84-cd01-4c6b-ac88-039f6e4dc662', 'Tashitse', '028.201.00321', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00321', 'Tashitse Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('43c2bfb1-4266-4e58-88ec-adab21fe48a5', 'Meretsemo', '028.201.00046', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00046', 'Meretsemo Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('43cf2492-4eef-45bf-a28a-c3c559aa9218', 'Waichur', '028.201.00161', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00161', 'Waichur Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('446d7aad-3a91-4de2-8c8c-2e0a7374434c', 'Panbang', '028.201.00470', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00470', 'Panbang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4501b429-d956-4e43-8ce4-3089f1393fdb', 'Nimtola', '028.201.00067', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00067', 'Nimtola Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('45ae4a8b-cd3d-46cd-991a-c640f045a916', 'Tsangpo', '028.201.00344', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00344', 'Tsangpo Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('45af4e2f-5de8-4f88-9c5f-3b69a5522266', 'Daleythang', '028.201.00061', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00061', 'Daleythang Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('46819975-ffd8-4df4-9d93-cca4e04e3b01', 'Tshochasa', '028.201.00224', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00224', 'Tshochasa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4768ada3-42a1-44e4-9e48-8e44048aec52', 'Chongaykha', '028.201.00040', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00040', 'Chongaykha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('482df04d-3f7b-4edb-81a0-7c657743f53b', 'Chimuna', '028.201.00039', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00039', 'Chimuna Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4876e497-cb31-46be-b359-d2f113ddb987', 'Baikunza', '028.201.00038', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00038', 'Baikunza Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('487ea89c-17bd-4179-af1f-0d956ab0e399', 'Silambi', '028.201.00156', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00156', 'Silambi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('48a856c2-269d-4de9-8c90-f6806f19004f', 'Choekhorling', '028.201.00196', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00196', 'Choekhorling Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('48b4f105-1823-41e2-a127-ed13dc9fa097', 'Pangtokha', '028.201.00397', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00397', 'Pangtokha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4933e1ec-771d-4175-953c-4e5488305a18', 'Bjimthangkha', '028.201.00543', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00543', 'Bjimthangkha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('49579ad7-511d-4cb4-82a5-d0633d76cc88', 'Langdurbi', '028.201.00475', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00475', 'Langdurbi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('498c9e10-8622-4fc1-80e2-de7245e515d6', 'Nichula', '028.204.00055', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00055', 'Nichula Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('49d17fc0-34b3-4847-aadd-5eaf5a3ad016', 'Hebesa', '028.201.00457', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00457', 'Hebesa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4a7f6933-e512-43cb-9264-dec23fc37131', 'Gosaling', '028.201.00439', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00439', 'Gosaling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4ac49399-d016-4e02-95f0-16d1052332ad', 'Jangsa', '028.201.00535', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00535', 'Jangsa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4b164970-f5d1-42f3-9c33-3bd7c664d4c9', 'Woop', '028.201.00529', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00529', 'Woop Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4c06abe3-e6e6-4a51-b51f-c407e6e7a206', 'Phuntshopelri', '028.204.00081', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00081', 'Phuntshopelri Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4c1163f4-01b2-49c2-ae04-735042e5390b', 'Chali', '028.201.00121', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00121', 'Chali Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4cfe2bbd-d7ef-4364-9448-c5ba6f302b11', 'Wangchu', '028.201.00025', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00025', 'Wangchu Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4d1feeb1-eb39-452e-80eb-ffeaa6f350ec', 'Kuzhugchen', '028.201.00315', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '', '', '', '', 0, 0, NULL, NULL, NULL, '1', 2005, '1', '028.201.00315', 'Kuzhugchen Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '633e0a9a-aa14-4b12-b661-ca120eb3bbf6', '0000-00-00 00:00:00', '2021-05-04 04:07:39'),
('4e16cb78-4ccc-4fbc-9ad2-afe2ff12a7c8', 'Chuzagang', '028.201.00287', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00287', 'Chuzagang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4e2754b6-fb6b-42b7-85de-cd11127ce014', 'Jala', '028.201.00458', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00458', 'Jala Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4faa18fc-f6a8-422e-ad60-a2c9c5492c4c', 'Changmey', '028.201.00336', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00336', 'Changmey Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('4fe92cfd-b2f6-46ce-b974-aa237efa4eeb', 'Soenakhar', '028.201.00157', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00157', 'Soenakhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5043159a-8836-4359-bdce-287a877fe180', 'Domkhar', '028.201.00105', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00105', 'Domkhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5057c23d-7587-43fd-b1b5-59cfaffe3c29', 'Womanang', '028.201.00382', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00382', 'Womanang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('507cc83a-997a-4f94-a367-3c4c7bba1f0a', 'Kazhi', '028.201.00459', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00459', 'Kazhi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('50801f0d-015a-45a0-a121-b497170705f6', 'Pakchina', '028.204.00068', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00068', 'Pakchina Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('508b7aae-fcd7-4f17-bbc3-9da0e052d4a5', 'Khenadang', '028.204.00057', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00057', 'Khenadang Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('50ac4871-a9c6-4ad8-998c-e4bed8ea9fa8', 'Domchoethang', '028.204.00113', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00113', 'Domchoethang Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5147fb24-ac81-4b2f-b2be-12c1e39fbaf7', 'Lunana', '028.201.00078', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '4', '35', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00078', 'Lunana Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('515607d8-a91d-4286-9459-7221c0ce5691', 'Soeltapsa', '028.204.00107', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00107', 'Soeltapsa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5172ad0c-c774-4f10-a6a4-9804fea595a9', 'Ramchetsekha', '028.201.00182', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00182', 'Ramchetsekha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('518b9c1f-41a7-4c80-a2e1-a7210cf2a0ec', 'Yabrang', '028.201.00374', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00374', 'Yabrang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('51985b77-b120-4269-a654-413a802c7e29', 'Zilukha', '028.201.00307', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00307', 'Zilukha Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('53050bd5-7ef1-43a3-a370-fc2b08fbbceb', 'Tashithang', '028.204.00032', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00032', 'Tashithang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5334e3e3-80aa-4086-a67b-9994a41663e9', 'Nabji', '028.201.00424', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00424', 'Nabji Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5529e164-f8ff-429b-816b-0d28ff63f9dc', 'Chhoekhor Toe', '028.201.00006', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00006', 'Chhoekhor Toe Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('558ce796-cd81-4688-abf9-e79e264067ea', 'Pangserpo', '028.201.00534', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00534', 'Pangserpo Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('55a68b73-95df-422d-ae88-11e0b46759e9', 'Tsimalakha', '028.201.00032', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00032', 'Tsimalakha Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('56af258e-8ded-495c-bcf8-025764a53f0c', 'Druk', '028.202.00016', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00016', 'Druk Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5761ca71-5e94-4448-b60f-b2c279f4b020', 'Gelephu', '028.201.00277', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '24', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00277', 'Gelephu Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('57d60d38-5f83-44df-83d5-d448abdcf797', 'Mandranay', '028.204.00034', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00034', 'Mandranay Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('59ff4dc8-d8c5-4d0c-ac66-a551989cbb47', 'Gonpasingma', '028.201.00187', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00187', 'Gonpasingma Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5a5441e7-4422-4e16-b5d4-447cc529fb0a', 'Gomphu', '028.201.00473', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00473', 'Gomphu Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5b5d8244-4e93-4c2d-9060-9dc47608872f', 'Singye Namgyal', '028.201.00461', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00461', 'Singye Namgyal Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5bac127f-3086-43e1-9b2b-d7a90a68164d', 'Thika', '028.204.00069', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00069', 'Thika Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5bd544d2-3214-4b32-800f-f267a83e7359', 'Zangthi', '028.201.00259', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00259', 'Zangthi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5c5fce62-2fc2-413f-9a1d-b363c8e304b8', 'Denchukha', '028.201.00268', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00268', 'Denchukha Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5d74d16a-3697-4c49-be4d-4c3093f2c073', 'Chakidemi', '028.201.00388', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00388', 'Chakidemi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5dd07fcf-ffe2-4239-a4ff-49304871777b', 'Yangbari', '028.201.00163', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00163', 'Yangbari Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5dde7f5f-9b0a-4e3e-a9e5-7a551f740f3e', 'Khomsher', '028.201.00483', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00483', 'Khomsher Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5e6b1996-7e60-4bc3-ab0e-82166b88acae', 'Bebzur', '028.204.00119', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00119', 'Bebzur Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5ecff8c9-9d8a-416e-927f-a499729239bc', 'Gaselo', '028.201.00447', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00447', 'Gaselo Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('5f9ddef5-4fd7-406f-8262-68fbbe5ce79f', 'Zangtherpo', '028.201.00017', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00017', 'Zangtherpo Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6062b931-bc2a-4caf-adfd-777c842c841f', 'Dzongsar', '028.204.00011', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00011', 'Dzongsar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('60bba5e3-0429-418e-96c2-45da241e00ce', 'Nimazor', '028.204.00056', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00056', 'Nimazor Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('60d30ca5-4866-4d6f-867e-3c50d1541fd4', 'Jangchubling', '028.201.00501', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00501', 'Jangchubling Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6188440e-d958-437a-9576-f675339dcc66', 'Kesari', '028.201.00042', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00042', 'Kesari Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('61969280-4dc9-458e-ab65-edc5ce2a0f72', 'Trashiyangtse', '028.201.00403', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00403', 'Trashiyangtse Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('61a5ef1f-5dbf-4d4e-b5cb-7649c55b17f0', 'Samtse', '028.201.00260', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00260', 'Samtse Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6218b2bd-29a5-4401-8a3c-80a457fd86d6', 'Pemathang', '028.201.00245', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00245', 'Pemathang Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('62abf7ec-e122-4260-8d75-29dfcb3e0687', 'Chungphel', '028.201.00007', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00007', 'Chungphel Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('62c20004-961e-4741-888c-451a0b1853d4', 'Chang Rigphel', '028.201.00306', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00306', 'Chang Rigphel Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('632308ce-800e-465c-b75f-ba0f1dc5468e', 'Yelchen Central School', '028.201.00213', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00213', 'Yelchen Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('639fe51b-cba9-49a3-a61f-6d8b637a2161', 'Saling', '028.201.00365', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00365', 'Saling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('63b6cfa0-2b31-4fb8-994c-89dfea35f91b', 'Depheling', '028.204.00106', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00106', 'Depheling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6435e2cf-798c-4b01-9e9c-f56fa1a0179d', 'Jampeling Central School', '028.201.00322', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00322', 'Jampeling Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('64ea6479-188d-4af1-9a61-98abbd508c93', 'Tseykha', '028.204.00121', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00121', 'Tseykha Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('65a88d70-c7f2-43b0-acf7-399042707876', 'Gesarling Central School', '028.201.00057', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00057', 'Gesarling Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('65aa9c32-6a36-45bf-9885-ed2ff320aee1', 'Repati', '028.201.00497', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00497', 'Repati Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('65af6c7e-2f40-4d36-af4f-8cf007b2943b', 'Gedu', '028.201.00023', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00023', 'Gedu Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('669411aa-4dd2-4501-b1cb-07458ee24fa0', 'Kachin', '028.204.00100', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00100', 'Kachin Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('669f4c54-22bf-4cae-9ca2-b2cfd90ce518', 'Kanglung', '028.201.00338', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00338', 'Kanglung Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('66a02e45-a6e2-46aa-b0f9-171615531862', 'Drametse Central School', '028.201.00118', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00118', 'Drametse Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('66b88793-9fc9-47c3-a9a5-cf8a5938f3aa', 'Khoma', '028.201.00091', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00091', 'Khoma Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6746b1b8-3649-4b14-b105-fd2d5092f69d', 'Rubesa', '028.201.00465', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00465', 'Rubesa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('679bc074-c9c7-4300-b1ae-fc6f856fa0fd', 'Thungkhar', '028.201.00330', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00330', 'Thungkhar Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('680a3a45-2701-4db0-9437-2f7b5a973d1c', 'Bumpazor', '028.201.00128', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00128', 'Bumpazor Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6aeb2c69-eff2-4d08-977c-e0139e8ef036', 'Pam', '028.201.00361', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00361', 'Pam Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6b16ea9c-6a5a-4b00-bed9-59e8895b52b5', 'Dranghal', '028.204.00078', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00078', 'Dranghal Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6b4f0775-9f85-4182-8813-04b2473fdf42', 'Deki', '028.202.00039', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00039', 'Deki Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6b6e5a05-05e2-45fa-ad44-968167fc1cf0', 'Lhuentse', '028.201.00096', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00096', 'Lhuentse Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6b9c51b3-e20f-43d2-b645-655a210305a2', 'Ney', '028.201.00108', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00108', 'Ney Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6bbb15b5-18e0-436f-8362-7f29ece0a4c1', 'Barzor', '028.201.00251', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00251', 'Barzor Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6c10fb7d-ad87-45fa-ae42-36ca75ac29fa', 'Sersang', '028.202.00032', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00032', 'Sersang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6c21eaef-036d-4d61-baf2-df165480a9b2', 'Phuensum', '028.202.00021', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00021', 'Phuensum Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6c32c798-7376-40e8-a1be-822ecc74e196', 'Gaselo central school', '028.201.00443', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00443', 'Gaselo central school Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6c9cdb04-78e8-48b4-b0c2-6bf1febd5177', 'Semjong', '028.201.00441', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00441', 'Semjong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6cc68323-4332-4bad-972f-8a81d7ce8ff3', 'Dukti', '028.201.00401', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00401', 'Dukti Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `organization_details` (`id`, `name`, `code`, `category`, `levelId`, `dzongkhagId`, `gewogId`, `chiwogId`, `locationId`, `isGeopoliticallyLocated`, `isSenSchool`, `isFeedingSchool`, `parentSchoolId`, `isColocated`, `status`, `yearOfEstablishment`, `organizationType`, `zestAgencyCode`, `remarks`, `typeOfSchool`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('6cef24c1-e218-4e50-8139-83e2496a4071', 'Uma', '028.201.00467', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00467', 'Uma Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6d74a63d-d7b7-42cc-9e92-0612a1621068', 'Wangdigatshel', '028.201.00051', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00051', 'Wangdigatshel Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6e3c8959-34ea-4f89-aae6-072dbe0c412a', 'Baging', '028.201.00134', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00134', 'Baging Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6f139bd7-c0b1-4479-9786-15115901fd56', 'Jigme Namgyel', '028.201.00304', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00304', 'Jigme Namgyel Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('6f222c8c-0f53-4ef0-b1ef-36acaf4a2e22', 'Kuenselphodrang', '028.201.00532', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00532', 'Kuenselphodrang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('707c25bc-6704-4170-94a6-ee64010aa07b', 'Jerelemi', '028.201.00355', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00355', 'Jerelemi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('70f9789d-aaf0-41c8-b424-0288a8e52aa3', 'Yoezerling', '028.202.00008', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00008', 'Yoezerling Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('71076dc8-55ef-4d89-9dcb-dcc7487d65e3', 'Taju', '028.201.00180', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '', '', '', '', 0, 0, NULL, NULL, NULL, '1', 2005, '1', '028.201.00180', 'Taju Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'e3d7393c-e450-48de-b339-0ea12f6e85b0', '0000-00-00 00:00:00', '2021-05-04 07:00:51'),
('71fccb62-3b07-4230-bac6-b7713973e7a2', 'Baling', '028.201.00417', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00417', 'Baling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('721c579f-059b-486b-9a94-90e6dd6415fb', 'Mendrelgang', '028.204.00073', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00073', 'Mendrelgang Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('722e1ebc-6323-4a94-92d1-9cc8cfcd1e21', 'Shemagangkha', '028.201.00050', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00050', 'Shemagangkha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('730dfc78-0a3f-4bf6-934b-5a04a6ebc0c5', 'Mongar Sherub Reldri', '028.202.00026', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00026', 'Mongar Sherub Reldri Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('732483e2-6886-45c5-8b81-ff6ed9a801bf', 'Rinchengang', '028.201.00464', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00464', 'Rinchengang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7387af74-b99c-4fec-8c0f-1b8610c7c092', 'Uzorong Central School', '028.201.00331', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00331', 'Uzorong Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('75232cfe-3b72-4d50-87ff-97edd5ea84a5', 'Wooling', '028.201.00257', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00257', 'Wooling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('755521f8-4dda-4485-84d7-ed9b1462276b', 'Dagapela', '028.201.00056', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00056', 'Dagapela Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('75981c5a-0f57-438a-8c92-2e69268ca765', 'Chilauney', '028.204.00153', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00153', 'Chilauney Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('766ce89d-3a26-4830-94f2-41d75f4cab59', 'Zilnon Namgyeling', '028.201.00313', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00313', 'Zilnon Namgyeling Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('771db232-5721-4e87-a623-822c160426c5', 'Jigme Sherubling central school', '028.201.00319', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00319', 'Jigme Sherubling central school Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7741bb3d-a6e3-4f73-b523-ae9a64b3b59e', 'Yurung central school', '028.201.00191', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00191', 'Yurung central school Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('77c36731-ab6f-4826-a470-c4c91ac8656a', 'Yobinang', '028.201.00377', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00377', 'Yobinang Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('784aa96a-3a6b-49a4-b647-d4deccb5128b', 'Rangjung central school', '028.201.00320', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00320', 'Rangjung central school Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('787a55c7-2e43-488c-bafb-418dc72dcfa5', 'Wamrong', '028.201.00332', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00332', 'Wamrong Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('78bf9f5f-e5da-4c01-8111-357d0635218e', 'Serzhong', '028.201.00291', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00291', 'Serzhong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7a47fbd9-63d1-4735-9704-d47c7893c96b', 'Gelephu', '028.201.00547', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '24', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00547', 'Gelephu Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7a79271e-8789-4f1d-8052-4a152b3dcbf9', 'Walathang', '028.201.00234', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00234', 'Walathang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7b2a7eeb-6c80-46ea-986f-5c16a357e20d', 'Kelki', '028.202.00013', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00013', 'Kelki Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7caee1c3-57d7-481f-a6e6-2a8adc822d39', 'Ganglakhema', '028.201.00106', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00106', 'Ganglakhema Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7cca571b-c978-49e4-954d-2b054bbf67c2', 'Bjokha', '028.201.00476', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00476', 'Bjokha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7d20861d-01a0-4b1f-976a-31b93792e059', 'Phensum', '028.201.00512', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00512', 'Phensum Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7d79739e-0c37-4410-886b-274fb79773c6', 'Radi', '028.201.00328', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00328', 'Radi Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7dbe9d42-2966-4410-84b7-6fc9732c168c', 'Konbar', '028.201.00144', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00144', 'Konbar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7dfed673-2f21-47a7-bbe7-bd1b067a0b61', 'Dungkarling', '028.204.00149', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00149', 'Dungkarling Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7e76f45c-f9d4-46a4-bf3a-04e16195f14d', 'Daga Central School', '028.201.00054', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00054', 'Daga Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7f1f024a-4fe1-4bb5-a8f5-15cccec8f608', 'Kaktong', '028.201.00486', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00486', 'Kaktong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7f255f25-4aa8-4911-8b32-5fe7fe76d48d', 'Broksar', '028.201.00138', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00138', 'Broksar Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7f7e277a-b5ab-4816-82ef-a59075d6f2b8', 'Thrisa', '028.201.00489', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00489', 'Thrisa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7fbd150a-765c-4e6d-a2ef-b7eb4ea5d49b', 'Lumang', '028.201.00339', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00339', 'Lumang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7fd72439-369e-4649-8699-299cf5f5888d', 'Shaba', '028.201.00179', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00179', 'Shaba Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('7fdb6151-e9e6-43bd-9363-4214318da22f', 'Lingkhar', '028.201.00145', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00145', 'Lingkhar Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8108d25b-a49e-4947-8dd5-0fb274485b4e', 'Martshala Central School', '028.201.00237', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00237', 'Martshala Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('81af29b2-df68-439e-a8fd-8539638cebad', 'Birutar', '028.204.00029', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00029', 'Birutar Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('82d603eb-1fed-49ab-8649-f0ea6913fadd', 'Namshigang', '028.204.00082', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00082', 'Namshigang Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('835fe2e5-2838-4dca-b28a-325b39188d4d', 'Dashiding', '028.201.00519', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00519', 'Dashiding Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('83815b33-949c-4920-8ed3-548375f63c70', 'Zhemgang', '028.201.00472', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00472', 'Zhemgang Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('83b39e4c-3e63-487e-a0e9-426dc0454d0e', 'Khamdhang', '028.201.00390', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00390', 'Khamdhang Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('83c4ab21-68d6-4eb2-8188-4cbb415a058a', 'Patshaling PS', '028.201.00435', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00435', 'Patshaling PS Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('847f02b9-9a73-414d-915a-bc98df142fee', 'Gogona', '028.204.00058', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00058', 'Gogona Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('849fa730-135d-4416-99e4-171a3b937b3c', 'Dawakha', '028.201.00170', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00170', 'Dawakha Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('857680fc-69cf-4919-b438-c6024817d3f5', 'Shari', '028.201.00166', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '', '', '', '', 0, 0, NULL, NULL, NULL, '1', 2005, '1', '028.201.00166', 'Shari Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'e3d7393c-e450-48de-b339-0ea12f6e85b0', '0000-00-00 00:00:00', '2021-05-04 08:17:53'),
('85b5ec1a-fba2-4a17-838f-dc5970a29d38', 'Gayshing Goan', '028.201.00523', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00523', 'Gayshing Goan Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('85e9f288-a9b9-4fa5-a42c-db3f6efeadb6', 'Zamtari', '028.201.00258', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00258', 'Zamtari Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8635f60b-6e00-4a67-99ad-9d98596a375c', 'Retey', '028.201.00290', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00290', 'Retey Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('864d77a2-a3c1-4e92-a9fc-6f0a9bc82581', 'Yebilaptsa Central School', '028.201.00469', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00469', 'Yebilaptsa Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('87763108-c3a8-46df-b9e6-9c90e08e0c0f', 'Dungmanma', '028.201.00252', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00252', 'Dungmanma Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('879af92f-74d6-4da1-acb3-9ad19e887620', 'Mongar', '028.201.00125', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00125', 'Mongar Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8890fcfb-e6bf-4260-9db6-3513adf103b7', 'Early Learning Centre', '028.202.00023', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00023', 'Early Learning Centre Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('88c81abd-c2d2-470d-bce9-35a3a47a916e', 'Yonphula', '028.201.00333', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00333', 'Yonphula Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('88f92135-64df-49ca-b353-4eec7bfdf0f6', 'Chapcha', '028.201.00021', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00021', 'Chapcha Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('892a6817-1bf5-4a55-9566-9ec64c0d0596', 'Buli central school', '028.201.00478', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00478', 'Buli central school Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('89c86276-d019-4e0c-86a9-8814290736e0', 'Paga', '028.201.00048', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00048', 'Paga Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8aa332cd-5d5e-4c82-9736-dfac4e56c300', 'Pakaling', '028.201.00360', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00360', 'Pakaling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8ac39155-ae6b-44a3-9660-0beb7bad0c88', 'Loseling', '028.201.00305', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00305', 'Loseling Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8b057305-a096-4b38-9718-4a6244dd8fa6', 'Shingkhar', '028.201.00386', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00386', 'Shingkhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8b1df217-a44c-45a9-a533-e4abdbaa2238', 'Tingtibi', '028.201.00471', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00471', 'Tingtibi Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8b635b93-f17d-43b3-af00-4c51906824b5', 'Tareythang', '028.201.00522', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00522', 'Tareythang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8bf3c315-fcec-4793-986c-d19c8cdb3dc6', 'Narang', '028.201.00148', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00148', 'Narang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8c42844e-8555-4f43-9dda-b2805cb33def', 'Yudrungcholing', '028.201.00504', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00504', 'Yudrungcholing Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8c59ffab-ee61-4e70-8639-02867ef30bdd', 'Ganglapong', '028.201.00141', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00141', 'Ganglapong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8c847082-b4c9-47ec-a372-9ce07667a3d3', 'Rongthung', '028.201.00364', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00364', 'Rongthung Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8d52e655-929e-4ad0-8922-771a5c09bf3d', 'Langthel', '028.201.00412', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00412', 'Langthel Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8e30867b-4a8c-4d1b-b4c6-b9bdcd333e25', 'Shaba', '028.201.00168', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00168', 'Shaba Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8e962f68-e994-46ed-87c0-9fdf287281e2', 'Lungtenphu', '028.201.00311', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00311', 'Lungtenphu Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8fc759ef-4fae-4750-a595-e6881191b45c', 'Pangna', '028.201.00068', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00068', 'Pangna Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('8fdf137e-8bc0-492a-9a2b-3bff4d6615a5', 'Gumla', '028.201.00074', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00074', 'Gumla Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('90134ace-46bf-4f11-b353-44eb59c44b90', 'Khar', '028.201.00199', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00199', 'Khar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('90624dd0-676b-4d3b-b02f-c16f82f32481', 'Taba', '028.201.00533', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00533', 'Taba Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('91038b8a-2774-4c0b-84e4-395c5d13b133', 'Khasadrapchu', '028.201.00297', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '', '', '', '', 0, 0, NULL, NULL, NULL, '1', 2005, '1', '028.201.00297', 'Khasadrapchu Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '633e0a9a-aa14-4b12-b661-ca120eb3bbf6', '0000-00-00 00:00:00', '2021-05-06 05:53:24'),
('910e8dfc-5d51-40a2-82c9-3c61636a569c', 'Chundu Armed Forces Public Central School', '028.201.00083', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '5', '40', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00083', 'Chundu Armed Forces Public Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('919fa54d-b169-4928-bf22-3c2f48b98eb5', 'Peljorling', '028.201.00263', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00263', 'Peljorling Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('91bed26c-1166-4b9a-97fb-887b96d219f8', 'Nagor', '028.201.00126', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00126', 'Nagor Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('921714e2-eab3-4960-868b-ffd665ffb4c5', 'TabaDramtoe', '028.201.00275', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00275', 'TabaDramtoe Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('921bd8fa-e46d-4004-94ae-f97c6b1e7a41', 'Sang-Ngag Choeling', '028.201.00271', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00271', 'Sang-Ngag Choeling Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('92f7cfca-5c8b-4229-8f66-1120fee8a5b6', 'Kela', '028.201.00423', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00423', 'Kela Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('93973fed-198f-4c5a-a726-e5e1f655c0f9', 'Samtenling', '028.201.00286', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00286', 'Samtenling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('93c26467-9462-4585-9347-c1e274291bc7', 'Jigmeling', '028.201.00011', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00011', 'Jigmeling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('94609d63-6a04-431b-b478-5a9b1f98a9cc', 'Bjemina', '028.201.00314', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '151', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00314', 'Bjemina Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('94d46fc9-9d49-4ebc-9ee7-415f6abe6afe', 'Ridaza', '028.201.00152', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00152', 'Ridaza Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('956108b1-1ff3-4968-8765-3609b68a7584', 'Yin Gom', '028.201.00376', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00376', 'Yin Gom Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('95f22e7c-b32a-4ec5-b1dc-dbc929359aa1', 'Yoezerling', '028.202.00037', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00037', 'Yoezerling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9611bc0e-c577-432d-b9b8-0929783fb321', 'Thragom', '028.201.00398', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00398', 'Thragom Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('961e418c-6ddf-4bc5-acab-e9451d6cbf02', 'Samkhara', '028.204.00042', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00042', 'Samkhara Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('962e741a-cb9f-4e41-b0b1-3ef54d0772e9', 'Thongrong', '028.201.00367', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00367', 'Thongrong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('96853f5f-95ba-40b0-a109-6efd04d81472', 'Samcholing', '028.201.00427', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00427', 'Samcholing Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9688d545-3dc6-4dd4-a2f1-3e58adee255a', 'Tshaling', '028.201.00383', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00383', 'Tshaling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('96c7a49f-175b-47f9-9b31-6b9f7aa32734', 'Soe', '028.204.00014', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '151', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00014', 'Soe Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('96dde311-bf5d-422d-9984-bf28139a6871', 'Sonam Kuenphen', '028.202.00001', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00001', 'Sonam Kuenphen Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('96eac6c9-c43c-43b5-8e24-4022768452ae', 'Khoyar', '028.201.00520', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00520', 'Khoyar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('96fc88e9-162d-4528-9e87-aca9c123e237', 'Lingden', '028.201.00527', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00527', 'Lingden Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('97e035fc-356a-437a-a882-dd8249e47a4d', 'Bjishong Central School', '028.201.00075', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '4', '35', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00075', 'Bjishong Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('981298cc-4e76-49a5-b519-72e47c827515', 'Banjar', '028.201.00137', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00137', 'Banjar Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('988b2246-e38b-4c66-85a1-c91c9b3eb6ee', 'Phuensum Deki', '028.201.00462', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00462', 'Phuensum Deki Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('98e154b6-78fa-4e22-9118-1833e84ecafe', 'Rameychen', '028.201.00463', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00463', 'Rameychen Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('98f6cd6c-83b2-425e-af4b-6691f66cdc50', 'Jamkhar', '028.201.00384', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00384', 'Jamkhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('994cad08-73f5-4a83-a606-e2355bcab1cf', 'Dungsam Academy', '028.202.00033', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '23', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00033', 'Dungsam Academy Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('99da078e-4609-4679-b631-c7af8598a4d9', 'Lingzhi', '028.201.00316', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '151', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00316', 'Lingzhi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9a5363a5-fc30-4cf2-a4f1-d23af2ae2007', 'Kabesa Central School', '028.201.00219', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00219', 'Kabesa Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9aed41d8-194d-4f23-9438-1ca33c7ff106', 'Orong', '028.201.00244', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00244', 'Orong Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9b753d4b-49d3-4dd0-9d42-83d77c18b46e', 'Nangladang', '028.204.00037', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00037', 'Nangladang Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9bd3925f-c0f8-43cf-b9de-fe3e6983911b', 'Getena', '028.201.00041', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00041', 'Getena Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9bdb99f1-ec86-488b-a855-7f417423c39a', 'Bjibjokha', '028.201.00218', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00218', 'Bjibjokha Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9bf82b2d-0196-4f26-97b0-276ea5e90577', 'Babesa', '028.201.00295', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00295', 'Babesa Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9c0083aa-e27d-4cac-8918-3d1bc9c9f2fa', 'Phuentsholing', '028.201.00031', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '22', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00031', 'Phuentsholing Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9ca4707b-24fa-4637-a613-3d8f48d08347', 'Damthang', '028.201.00080', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '5', '40', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00080', 'Damthang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9ca7e71c-b7e8-40dc-827b-8ae01c7dc746', 'Hontsho', '028.201.00226', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '151', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00226', 'Hontsho Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9cb9851d-dc30-4ddf-8996-b88495619d00', 'Rinchenling', '028.201.00049', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00049', 'Rinchenling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9cd67880-9002-4ce8-81b5-59cd7971bf2b', 'Phuentenchu', '028.201.00502', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00502', 'Phuentenchu Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9cfc152b-97d1-4acf-ab79-a12c30242747', 'Samarchen', '028.204.00026', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00026', 'Samarchen Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9d21f20f-0f15-4caa-a2ca-fbc88852254e', 'Utpal', '028.202.00038', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00038', 'Utpal Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9d6c530c-2305-4907-83d6-d310e2d03c6f', 'Norbugang Central School', '028.201.00267', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00267', 'Norbugang Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9d7a95e3-e620-4fbf-841f-ee886de3a211', 'Dechencholing', '028.201.00296', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00296', 'Dechencholing Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9dd8f7e3-ce7c-48b8-aad7-d92fa8abd31f', 'Dorokha Central School', '028.201.00261', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00261', 'Dorokha Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9e0f69dc-0185-4e87-9178-52e812ffa95a', 'Gangzor', '028.201.00063', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00063', 'Gangzor Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9ee54d41-ce38-478e-a808-7a8d8efeec9b', 'Jaibab', '028.201.00142', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00142', 'Jaibab Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('9fc36c50-46a6-414a-bf50-c4b787ca27c5', 'Rangaytong', '028.201.00526', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00526', 'Rangaytong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a0555d3e-00df-43b1-8059-053f5fbdacab', 'Serzhong', '028.201.00127', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00127', 'Serzhong Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a0917138-9bda-42e0-878e-894c6f74a2b0', 'Rangthangling', '028.201.00531', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00531', 'Rangthangling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `organization_details` (`id`, `name`, `code`, `category`, `levelId`, `dzongkhagId`, `gewogId`, `chiwogId`, `locationId`, `isGeopoliticallyLocated`, `isSenSchool`, `isFeedingSchool`, `parentSchoolId`, `isColocated`, `status`, `yearOfEstablishment`, `organizationType`, `zestAgencyCode`, `remarks`, `typeOfSchool`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('a0987e76-9be1-4927-83ad-1162fdc5ee8e', 'Yarphu', '028.201.00250', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00250', 'Yarphu Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a2131014-b1f3-4002-afad-4620e52ddf51', 'Kunzangling central school', '028.201.00545', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00545', 'Kunzangling central school Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a2e618f3-8273-4593-8a20-69cc73e7f866', 'Rigzom Academy', '028.202.00007', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00007', 'Rigzom Academy Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a3dfe171-61b7-441d-9baf-26e563513c67', 'Tashiding', '028.201.00071', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00071', 'Tashiding Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a41c455c-a494-4c12-8a8a-d00823af17e9', 'Phuntshothang', '028.201.00239', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00239', 'Phuntshothang Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a4bf282a-0e94-46a0-a87b-9148615db7ec', 'Dipojora', '028.204.00035', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00035', 'Dipojora Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a4e915c4-4472-42e9-b1f3-fa15d1275ad1', 'Bikhar', '028.201.00334', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00334', 'Bikhar Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a5a23b42-4b55-4e3b-9a74-29e136f6d976', 'Goling', '028.201.00485', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00485', 'Goling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a5c5259b-6596-443f-b132-f5cf649a49e6', 'Karmaling', '028.201.00515', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00515', 'Karmaling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a5c5fbe2-b7c9-45f2-8955-6cf953e2a460', 'Wangdi', '028.201.00446', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00446', 'Wangdi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a5ec3198-a7bf-4e27-ab25-0857e8fa343d', 'Lhaling', '028.201.00064', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00064', 'Lhaling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a69220c7-1165-4035-b592-ffce53f82a4f', 'Trashi Gatshel', '028.201.00045', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00045', 'Trashi Gatshel Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a6f5ef6b-657f-4219-80a5-d38acb386824', 'Mikuri', '028.201.00194', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00194', 'Mikuri Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a76a5449-6c25-4bfa-8f12-f51fb50a133a', 'Melongkhar', '028.201.00399', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00399', 'Melongkhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a778bd79-3314-4d15-b924-d310f352327d', 'Norbuling Central School', '028.201.00279', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00279', 'Norbuling Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a7c98701-f67c-41d0-814e-c32699cbaaa0', 'Phuentsholing', '028.201.00024', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '22', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00024', 'Phuentsholing Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a85dd5fd-3704-48b9-a126-e3eee48c965c', 'Lobnekha', '028.201.00044', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00044', 'Lobnekha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a91a4d44-0b31-449b-bd19-7a2ad19f8835', 'Tradijong', '028.201.00487', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00487', 'Tradijong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a91c986d-b882-4f1e-92f4-00cc3b201d7d', 'Wangdicholing', '028.201.00005', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00005', 'Wangdicholing Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a9730e78-42e7-4ede-8622-3aa9eace5cc3', ' Daga', '028.201.00058', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00058', ' Daga Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a995920f-7e0a-4dee-aa29-589924e76b17', 'Darla', '028.201.00022', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00022', 'Darla Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a9d1cc8a-8e13-47cd-a2f3-a8ffffe1cbcf', 'Chokhorling', '028.201.00537', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00537', 'Chokhorling Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('a9e42d02-6ba7-409b-96f7-73ca62f32a9f', 'Khangrab', '028.201.00012', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00012', 'Khangrab Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('aa084b64-78bb-471a-b8c2-a930530ab419', 'Ramjar', '028.201.00391', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00391', 'Ramjar Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('aa66d1d6-86e9-4d42-af68-bc287e7b0f35', 'Norbu Academy', '028.202.00003', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '22', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00003', 'Norbu Academy Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('aae69149-1203-4233-8b6d-58a8d3f30cb6', 'Lingmethang', '028.201.00146', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00146', 'Lingmethang Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('aae7f8d8-fcad-4927-afee-c987f3cb9f1b', 'Ridha', '028.204.00124', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00124', 'Ridha Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('aafa62cb-f3a3-470a-a7ce-e461989b527f', 'Tshanglajong', '028.201.00491', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00491', 'Tshanglajong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ab5b2bd5-1b3f-4992-aa3f-7f0a17a2b369', 'Wanakha Central School', '028.201.00175', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00175', 'Wanakha Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('acd02fab-ac34-4d8d-a194-f6f1550c25e1', 'Doteng', '028.201.00171', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00171', 'Doteng Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('acd8cffe-8f6a-4dea-b857-d1b89f9ca7c7', 'Norbugang', '028.201.00549', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00549', 'Norbugang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ad1470b8-1d33-4db2-8d8b-0ce59018463d', 'Lharing', '028.201.00500', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00500', 'Lharing Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ad22a3cd-28ad-4fdd-84bf-d99d6fac1124', 'Samcholing', '028.201.00525', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00525', 'Samcholing Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('adc3c7fd-2aff-4bb6-97ef-d097fa2ce77e', 'Dechentsemo Central School', '028.201.00217', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00217', 'Dechentsemo Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ae4a8da1-6cb0-4e2e-a864-a898bedf9189', 'Samtengang', '028.201.00505', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00505', 'Samtengang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ae662bfe-4a5e-4402-ad7d-9ea78ba5046e', 'Tshochen', '028.201.00113', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00113', 'Tshochen Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ae66eb3f-31a2-4c5c-af31-c7ccbc4551b4', 'Doksum', '028.201.00389', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00389', 'Doksum Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('aea1e753-2fd0-4a01-a3c1-c75a1ddd9d44', 'Tangmachu Central School', '028.201.00090', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00090', 'Tangmachu Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('affcb0ce-aeaa-4b1e-aab2-f6589084fd67', 'UgyenAcademy', '028.202.00009', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00009', 'UgyenAcademy Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b00097a2-fe6d-404a-9dda-0bd4d9e971d3', 'Little Dragon', '028.202.00020', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00020', 'Little Dragon Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b0118348-0d09-41e4-a5e2-357f32e3511a', 'Benshingmo', '028.201.00346', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00346', 'Benshingmo Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b02eef4d-0e68-4e38-a9fb-6054a590ea17', 'Isuna', '028.201.00178', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00178', 'Isuna Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b0e181d0-6fcb-498f-aee0-d014ab4e33db', 'Dungmanba', '028.201.00352', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00352', 'Dungmanba Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b157fa8b-d13a-43f8-9153-7f3f5cad9647', 'Yebesa', '028.204.00071', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00071', 'Yebesa Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b1b280f2-f092-4274-8d54-22fa3a21e239', 'Namchalla', '028.201.00066', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00066', 'Namchalla Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b1d80198-0ef1-410c-9318-0ae478ddbb24', 'Barshong', '028.201.00345', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00345', 'Barshong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b3403a09-0098-4c66-857c-bd72280bd160', 'Thrimshing Central School', '028.201.00372', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00372', 'Thrimshing Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b35e843b-8a63-4983-aef4-f5d1bd606f29', 'Tashicholing', '028.204.00141', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00141', 'Tashicholing Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b3708914-71fb-4bbb-9201-db4d8521b61d', 'Chaskhar Central School', '028.201.00120', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00120', 'Chaskhar Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b3acf5fe-c655-437c-a28c-6aa4ad4f2621', 'Thongling', '028.204.00156', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00156', 'Thongling Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b3c01774-3498-4025-8316-f695131a655e', 'Nganglam', '028.201.00188', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00188', 'Nganglam Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b3d60792-4396-493a-b397-6a8874458c8a', 'Zangkhar', '028.201.00100', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00100', 'Zangkhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b45967e3-fb43-43e1-b19d-ceeeeaca1ad9', 'Udaric', '028.201.00160', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00160', 'Udaric Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b4b060dc-93d4-4f2f-a745-02e64abd65c6', 'Tshangkha Central School', '028.201.00413', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00413', 'Tshangkha Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b54f84be-c63c-471a-b790-7352158556e0', 'Tsamang', '028.201.00132', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00132', 'Tsamang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b5ff622a-bed6-46c0-bbce-69e66824153a', 'Balam', '028.201.00136', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00136', 'Balam Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b7202729-adff-4c0c-b1a8-e05ffbca5040', 'Gasa', '028.201.00076', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '4', '35', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00076', 'Gasa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b7399616-43bc-419d-ac81-d8a757830e24', 'Pangthang', '028.201.00150', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00150', 'Pangthang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b73c6a59-5ac9-4ea5-a163-7c76b016d577', 'Pakshika Central School', '028.201.00530', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00530', 'Pakshika Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b7927e53-1881-496e-ba5f-68e257ef0806', 'Barshong', '028.201.00437', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00437', 'Barshong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b80e5916-31aa-4de8-9423-9081b5368da3', 'Berdungma', '028.201.00348', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00348', 'Berdungma Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b87382fb-fe01-4749-9dae-d66bfe6bfc05', 'Dr. Tobgyel School', '028.202.00017', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00017', 'Dr. Tobgyel School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b8d104b6-2fba-41cd-8e52-ff404810b1d9', 'Tendruk central school', '028.201.00264', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00264', 'Tendruk central school Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b8d9f2a2-340f-41aa-938e-087b5d701319', 'Kuengarabten', '028.201.00411', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00411', 'Kuengarabten Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b92c05aa-8ac8-43d2-9f8e-44bfd411f0c7', 'Taktse Central School', '028.201.00410', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00410', 'Taktse Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b92c3fb4-917c-4373-a6e6-f33d6bb95be3', 'Kurichilo', '028.201.00358', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00358', 'Kurichilo Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b936e25d-acad-44db-939b-41a512d487a2', 'Balleygang', '028.201.00060', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00060', 'Balleygang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('b9c47bdb-1ec0-4ba3-bece-554e37a537da', 'Bukkay', '028.204.00123', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00123', 'Bukkay Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ba2efced-93d5-424b-b154-a92b0fdfa580', 'Betikha', '028.201.00169', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00169', 'Betikha Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('bb200fc4-078d-4e91-8438-b69e45eb22a5', 'Trashigang', '028.201.00323', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00323', 'Trashigang Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('bb91d68a-6bea-49a9-be7b-bf21ae68bd12', 'Sarpang', '028.201.00285', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00285', 'Sarpang Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('bb9a3437-a6fb-4791-830f-48caa18c60d2', 'Jomotsangkha', '028.201.00242', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00242', 'Jomotsangkha Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('bbd91c23-3eb1-46de-88ad-f8ac00b94180', 'Monmola', '028.201.00253', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00253', 'Monmola Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('bd5194fb-9c96-415f-a9fb-64a2bf6a238e', 'Kuendrup', '028.202.00011', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '24', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00011', 'Kuendrup Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('be697d35-3298-471d-95ca-899230958db3', 'Mindruling', '028.201.00273', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00273', 'Mindruling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('be911f44-6cb7-42b3-9a86-2a3c7cde36d2', 'Lhuentse', '028.201.00089', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00089', 'Lhuentse Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('beedaa3b-4832-476f-bc7f-9624bd47a3c5', 'Sakteng', '028.201.00343', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00343', 'Sakteng Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('beef2076-3d04-46b4-97fc-0719da342f2f', 'Mendrelthang', '028.204.00148', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '4', '35', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00148', 'Mendrelthang Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('bf27af11-513c-4773-926a-70de99bf7092', 'Kharsat', '028.201.00013', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00013', 'Kharsat Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('bfcb592a-4d0e-4812-ad04-f54e5bc44415', 'Yoeseltse', '028.201.00265', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00265', 'Yoeseltse Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c06604aa-8d6a-485b-bc0f-73400b5c1ef7', 'Mendrelgang', '028.201.00524', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00524', 'Mendrelgang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c072d360-7800-4f27-b602-37cd62a98b1d', 'Gangrithang', '028.201.00010', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00010', 'Gangrithang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c134c79f-beba-4226-b821-090803667644', 'Tencholing', '028.201.00452', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00452', 'Tencholing Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c1a4d4ae-9907-4d96-a44f-e1870edbc572', 'Rukubji', '028.201.00450', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00450', 'Rukubji Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c273c5e7-51e5-453e-88e1-8ca9808bffca', 'Bjena', '028.201.00455', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00455', 'Bjena Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c39f34ca-0fa1-4ba5-9037-a09cd77f34de', 'Pemagatshel', '028.201.00185', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00185', 'Pemagatshel Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c3e338af-621b-47fa-9680-7ec1c8d44ca6', 'Lhamoyzingkha Central School', '028.201.00284', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00284', 'Lhamoyzingkha Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c40507e2-2740-4509-8ac6-553e27c87095', 'Budashi', '028.201.00493', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00493', 'Budashi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c4c7d8e3-d234-493d-bcc3-2f2de36a09b0', 'Sertana', '028.204.00002', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '5', '40', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00002', 'Sertana Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c4e31cf6-a343-46ce-81a9-e65420aa5bae', 'Logodama', '028.201.00222', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00222', 'Logodama Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c5285c54-3e4a-44a0-b89b-aad5eff7e9d9', 'Shingnyer', '028.201.00015', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00015', 'Shingnyer Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c557a65a-45b0-4094-8b2c-259c24924c8f', 'Dorokha', '028.201.00550', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00550', 'Dorokha Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c5da44fa-d678-4d79-b2e8-eb36eba7eb3e', 'Jomtshang', '028.201.00357', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00357', 'Jomtshang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c6659512-2247-4e73-b30f-595323a0c86d', 'Phobjikha central school', '028.201.00449', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00449', 'Phobjikha central school Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c75609d5-1e3a-4908-8be6-01799b090da8', 'Yangchen Gatshel', '028.201.00299', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '151', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00299', 'Yangchen Gatshel Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c7562128-8733-4080-a193-e192f699565b', 'Khuruthang', '028.201.00215', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00215', 'Khuruthang Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c7b63b48-53a2-4ffd-927a-a74cbffc1114', 'Tahogang', '028.201.00233', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00233', 'Tahogang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c80a47a5-14e2-4865-a99d-963ca6aac685', 'Laya Central School', '028.201.00077', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '4', '35', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00077', 'Laya Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c8558c31-976f-41a7-ab88-553536e2d9cf', 'Gongzim Ugyen Dorji Central School', '028.201.00079', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '5', '40', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00079', 'Gongzim Ugyen Dorji Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c8be6a6d-dfd1-49b2-bf6a-505dcff51dbc', 'Jakar', '028.201.00001', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00001', 'Jakar Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('c93018d4-9a4e-4917-b42c-d7db24ad0f28', 'Goshing', '028.201.00477', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00477', 'Goshing Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ca3c413f-97a8-4150-973f-76de513ad92a', 'Autsho Central School', '028.201.00101', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00101', 'Autsho Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ca67a951-894e-4fd8-953d-73d6849b7409', 'Shali', '028.201.00210', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00210', 'Shali Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ca998730-1c8a-4fde-b83b-0f453b444542', 'Pantang', '028.201.00480', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00480', 'Pantang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cb2d494f-8853-40ab-9a1b-dfbe0562f1d8', 'Bartsham central school', '028.201.00324', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00324', 'Bartsham central school Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cbbf7d55-d252-4c1f-baf4-b825e6cbce8c', 'Chhumey Central School', '028.201.00002', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00002', 'Chhumey Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cc9da3a2-7da1-4fd0-a596-44a6c6244fbc', 'Punakha central school', '028.201.00214', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00214', 'Punakha central school Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cccb8442-1aec-405e-918c-c4efda1b4d85', 'Shumar', '028.201.00189', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00189', 'Shumar Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ccd51d0c-029a-4d9c-bf93-cb62ddf2ab5e', 'Khanduthang', '028.201.00272', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00272', 'Khanduthang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cce9e85a-2e6d-4927-ac4b-a54b998e1cb8', 'Samtengang Central School', '028.201.00444', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00444', 'Samtengang Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ccecb141-87cf-4c83-a1f9-75acfbaaca8c', 'Martshala', '028.201.00247', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00247', 'Martshala Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ce8be310-d2c2-4c0c-a8c5-c06eac05e44a', 'Trongsa', '028.201.00416', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00416', 'Trongsa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ceaef9d5-30e7-4c01-972e-65edb79ebe63', 'Wangphu', '028.201.00249', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00249', 'Wangphu Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cec4ab82-a130-4cdb-9231-00861c0ae2d3', 'Phuensumgang ', '028.201.00070', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00070', 'Phuensumgang  Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cf2add2a-d1ab-404d-93ec-b534fbb0fa4f', 'Zinchella', '028.201.00073', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00073', 'Zinchella Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cf604c49-7b37-45c1-b993-726dca464c2d', 'Bardo', '028.201.00474', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00474', 'Bardo Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cf8f7f5b-4213-4874-8119-d3d6222e1af0', 'Galing', '028.201.00337', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00337', 'Galing Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('cfd7e9e1-6a64-411b-bde9-c3dcaada2b86', 'Jigmeling', '028.201.00283', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00283', 'Jigmeling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d0437ac8-02ff-4f48-bc37-bd5f9d039863', 'Ketokha', '028.201.00043', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00043', 'Ketokha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d0eaa8db-3893-4bbc-8d8b-7c52cea457d4', 'Sisina', '028.201.00317', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '151', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00317', 'Sisina Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d11b730d-2741-484e-b525-14bff0edd240', 'Chiya', '028.201.00350', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00350', 'Chiya Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d177ca83-d175-4467-9359-59c701a63929', 'Bebji', '028.204.00134', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '5', '40', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00134', 'Bebji Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d188fa08-e8ff-4f05-bca8-44bab088e08c', 'Sombekha', '028.201.00088', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '5', '40', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00088', 'Sombekha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d1975a08-ecf6-41f9-b64c-f9cfdee8a2cd', 'Tongtongphey', '028.201.00429', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00429', 'Tongtongphey Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d1e1585a-33af-4c16-b1b2-1b57ceb1df50', 'Norbugang', '028.201.00206', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00206', 'Norbugang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d21eed70-e15a-47d9-ae8d-2f6e8c651013', 'Samdrupjongkhar', '028.201.00240', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '23', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00240', 'Samdrupjongkhar Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00');
INSERT INTO `organization_details` (`id`, `name`, `code`, `category`, `levelId`, `dzongkhagId`, `gewogId`, `chiwogId`, `locationId`, `isGeopoliticallyLocated`, `isSenSchool`, `isFeedingSchool`, `parentSchoolId`, `isColocated`, `status`, `yearOfEstablishment`, `organizationType`, `zestAgencyCode`, `remarks`, `typeOfSchool`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('d2a52017-1ffc-4ce3-970d-86a00950bfdc', 'Wangbama Central School', '028.201.00542', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '151', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00542', 'Wangbama Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d30ea9be-6d9d-4404-b1b3-04700fd9515d', 'Matalungchu', '028.204.00012', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00012', 'Matalungchu Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d356abc0-fca5-4c13-ad72-1842f26bb810', 'Phongmey', '028.201.00342', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00342', 'Phongmey Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d39c1e3e-5135-4d5f-99eb-0bc173b7633c', 'Phulingsum', '028.201.00232', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00232', 'Phulingsum Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d41a4c21-f14f-4034-bac8-89541d9b5380', 'Lungo', '028.204.00060', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '4', '35', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00060', 'Lungo Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d6d5838c-3a2e-467e-802a-ca50b59ee211', 'Pachu', '028.201.00506', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00506', 'Pachu Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d798f0d3-e647-49f1-a9d0-4845856909a8', 'Rashigang', '028.201.00528', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00528', 'Rashigang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d79e881b-ab43-42ba-b433-64da6b40384d', 'Lamgong', '028.201.00174', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00174', 'Lamgong Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d8dbdc1b-1202-4f1c-b962-789e4bf62f42', 'Dechheling', '028.201.00186', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00186', 'Dechheling Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d930455c-6195-4b2c-9528-a4599c3e8d3c', 'Thangrong', '028.201.00130', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00130', 'Thangrong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d987f613-3ef7-4aa8-81c3-1cb62610abe6', 'Brekha', '028.201.00349', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00349', 'Brekha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('d9f67bab-ca79-45af-9885-e9422f15abe9', 'Olathang', '028.204.00061', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00061', 'Olathang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('da664ada-63a8-4e03-ad1f-26e9347f54cb', 'Dechen', '028.202.00010', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '23', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00010', 'Dechen Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('daa54f6b-e9aa-4bf2-914f-67eb3b78c27f', 'Damphu central school', '028.201.00431', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00431', 'Damphu central school Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('dacd691a-0575-4eba-9c2f-be761793a08b', 'Philuma', '028.204.00023', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00023', 'Philuma Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('db0883fa-fc26-4b41-afc3-701c506fe272', 'Dangchu', '028.201.00456', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00456', 'Dangchu Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('dc1b8bcd-e751-41f0-aa7c-517696562fa4', 'Nangkor Central School', '028.201.00183', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00183', 'Nangkor Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('dc310a2f-c4a4-4c6a-bd04-61bb9e20c7c3', 'Karma Leksheyling', '028.202.00043', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00043', 'Karma Leksheyling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('dc356ba2-dc2f-4ed9-b9b2-56a469d57f86', 'Kyidsa', '028.204.00038', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00038', 'Kyidsa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('dcc21946-c6d4-46ba-94c3-dcdd31180f7e', 'Ladrong', '028.201.00095', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00095', 'Ladrong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('dd8a4477-fb5f-44f8-aea1-3d6f5ccc65ee', 'Chongzhu', '028.204.00030', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00030', 'Chongzhu Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('de8b74bc-75c8-4f05-9693-bd3d0d83ada2', 'Ugyentse', '028.201.00276', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00276', 'Ugyentse Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('de945fa4-9ba3-4d22-9f12-2381c924f0f8', 'Lobesa', '028.201.00220', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00220', 'Lobesa Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('decd9ce7-b142-4226-bb9e-3887e28871d0', 'Tshenzibee', '028.204.00066', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00066', 'Tshenzibee Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('deeb12d4-1010-4b76-b69d-55148f4fc284', 'Sherubgatshel', '028.201.00270', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00270', 'Sherubgatshel Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('def82595-888a-4cc5-87c8-9966fb429d76', 'Wangsel', '028.201.00544', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00544', 'Wangsel Special Institute', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('df45921a-24b9-4095-8490-0cb876a74506', 'Pelrithang', '028.201.00280', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00280', 'Pelrithang Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e07abab2-f500-4ea5-801d-b8dd84aead7c', 'Sephu', '028.201.00466', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00466', 'Sephu Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e112a094-e5a2-4a37-9c3a-204317a2ccdd', 'Bemji', '028.201.00414', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00414', 'Bemji Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e14e210d-287b-4e34-a206-91d79cf35bbd', 'Kencholing', '028.204.00144', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00144', 'Kencholing Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e15f3c92-8c9d-47fb-80cf-6f458c3c4ab3', 'Changangkha', '028.201.00300', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00300', 'Changangkha Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e2ecef18-705e-4354-bc92-44688eec54e0', 'Yallang', '028.201.00400', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00400', 'Yallang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e3838b56-bcec-4ce5-b502-640046b41802', 'Kidheykhar Central School', '028.201.00123', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00123', 'Kidheykhar Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e3c43818-6419-4a2f-8f97-dd3090435662', 'Dekiling', '028.201.00281', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00281', 'Dekiling Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e4926627-1e29-4b0e-a446-0c378dfb9fc6', 'Kamji Central School', '028.201.00028', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00028', 'Kamji Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e5428f03-0616-4440-b221-91b18890fa29', 'UTPAL Academy', '028.202.00030', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00030', 'UTPAL Academy Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e7cf9501-b1ae-4e4e-8c1a-49cbd6172fd7', 'Dunmang', '028.201.00494', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00494', 'Dunmang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e7ec2198-4d9e-4602-8727-ec9f8583e368', 'Tshenden', '028.202.00036', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00036', 'Tshenden Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e88b9c94-32f5-4f56-bd9c-fcc46c2add85', 'Gawaling', '028.204.00007', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00007', 'Gawaling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e94296d6-3998-4b3f-9264-ae46bd55f764', 'Genekha', '028.201.00303', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '151', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00303', 'Genekha Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e96f5053-8ec3-41e8-bcc8-7282b54fe7ff', 'Ritshangdung', '028.201.00379', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00379', 'Ritshangdung Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e9b0efc5-fad9-47ca-adb1-9e8461d5a90d', 'Chaling', '028.201.00335', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00335', 'Chaling Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e9b56029-0bd5-43e2-b748-51ed02f0492f', 'Rangtse', '028.201.00086', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '5', '40', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00086', 'Rangtse Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e9bcb2a0-442e-4386-8b14-cd2969423fe2', 'Nawakha', '028.201.00230', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00230', 'Nawakha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e9f7a144-11ff-4662-bb90-120d9790a680', 'Paro Elementary School', '028.202.00040', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '8', '74', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00040', 'Paro Elementary School Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('e9fa4a3b-43b0-4cd2-9e2a-37acbb5a7d9d', 'SonamThang Central School', '028.201.00511', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00511', 'SonamThang Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('eb231dcb-8576-475e-a7e4-6551028512e4', 'Lichen', '028.201.00406', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00406', 'Lichen Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('eb39d67f-74cb-4b2e-9af1-e7454f260f66', 'Lauri', '028.201.00246', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00246', 'Lauri Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ebbc7f0d-6c3a-4b41-bd4f-0fbc9535b1a1', 'Khenzore', '028.201.00202', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00202', 'Khenzore Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ebbde006-a121-4328-85c8-3581934475d2', 'Samey', '028.201.00059', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '3', '19', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00059', 'Samey Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ecfe02a1-ee07-43fd-8113-05a34d7f44c3', 'Bidung', '028.201.00325', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00325', 'Bidung Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ed9b7e68-79e7-41e1-b1cc-58bb0c90e41e', 'Woochhu', '028.201.00176', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '1', '1', '95ad884e-7d6b-4d74-a0c6-ce38156d91ef', 0, 0, NULL, NULL, NULL, '1', 2005, '1', '028.201.00176', 'Woochhu Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'e3d7393c-e450-48de-b339-0ea12f6e85b0', '0000-00-00 00:00:00', '2021-05-06 05:51:44'),
('edceca94-a0ef-4947-bc7a-9f7a499643e2', 'Resa', '028.201.00151', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00151', 'Resa Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('edd8be38-625c-46c7-9bfb-0a6760709d7d', 'Tsenkharla Central School', '028.201.00387', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00387', 'Tsenkharla Central School Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ee404f24-d89c-46bc-a30a-5c8178d66ee3', 'Merak', '028.201.00340', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00340', 'Merak Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ee66305d-bc9f-462c-9eb2-e5fa33aef5f7', 'Gongthung', '028.201.00353', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00353', 'Gongthung Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f000bceb-45c6-479e-bdea-3f81808548a8', 'Moshi', '028.201.00359', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00359', 'Moshi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f04f3529-6155-4c05-86ce-28dc2be164df', 'Dhaksa', '028.201.00140', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00140', 'Dhaksa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f0823aab-3a21-4f9d-ae22-1ee5327559a1', 'Chungkha', '028.201.00026', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00026', 'Chungkha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f08fec89-f460-477b-b8a8-a5a2dcd47020', 'Gangkhar PS', '028.201.00405', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00405', 'Gangkhar PS Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f095f2b0-2788-49ff-afad-8db475537877', 'Lhayul', '028.201.00513', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00513', 'Lhayul Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f0c28309-8b3b-4b29-89ef-02849c4ef4ba', 'Pemathang', '028.201.00541', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00541', 'Pemathang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f1706402-9ea2-49a1-8afd-93f0f3cf34fa', 'Thinleygang', '028.201.00223', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00223', 'Thinleygang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f1b6b14b-8581-4ce7-9173-f2dfd64316db', 'Kherigonpa', '028.201.00203', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00203', 'Kherigonpa Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f2f658a8-91e1-4e67-8542-1d2d0b18a981', 'Rinchen', '028.202.00015', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '21', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00015', 'Rinchen Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f33c80bb-d72a-496a-95ba-dd4f8eedf7d4', 'Khameythang', '028.204.00136', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00136', 'Khameythang Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f389108d-2425-4413-aafb-2243ce67b300', 'Tali', '028.201.00490', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '20', '221', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00490', 'Tali Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f3adcec0-2357-4865-baa7-dfc2555413d5', 'Tsirang Toe Central School', '028.201.00434', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '18', '192', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00434', 'Tsirang Toe Central School Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f4443469-c626-4199-8a31-a2bbf3a90ec9', 'Tshatse', '028.201.00195', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '9', '86', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00195', 'Tshatse Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f4bc81f0-9805-4ad4-8767-495fbd0d2b58', 'Bjeezam', '028.201.00418', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00418', 'Bjeezam Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f537b671-747b-440d-86a3-709d0e4e7c1c', 'Goenshari', '028.201.00225', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '10', '98', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00225', 'Goenshari Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f5b7f71e-5888-4297-897b-7959eecb1a16', 'Gangthok', '028.204.00109', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00109', 'Gangthok Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f6e7fcce-1b1d-4f4c-8ec7-6c59f9a8fdb7', 'Kalapang', '028.201.00143', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00143', 'Kalapang Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f70abee7-a9a5-43dd-8446-90e4d4d928dc', 'Wambur', '028.201.00099', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00099', 'Wambur Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f7176d82-ece6-4880-93e9-c2a51b081b9d', 'Sonamgang', '028.201.00539', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '22', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00539', 'Sonamgang Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f76f32d0-6c99-4b67-97c7-1a90397b0fd5', 'Gytesa', '028.201.00009', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00009', 'Gytesa Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f7d201ff-017c-4259-9e66-cdbd26b2c5e2', 'Katsho', '028.201.00081', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '5', '40', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00081', 'Katsho Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f869c15e-1149-401a-b49f-2a7fab731faa', 'Losel Gyatsho Academy', '028.202.00035', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '13', '138', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00035', 'Losel Gyatsho Academy Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f89be296-da72-410a-b563-0aa9e829881b', 'Jangbi', '028.201.00420', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00420', 'Jangbi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f8e097c4-afdb-4559-8b9e-26d0c69ada73', 'Dur', '028.201.00008', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00008', 'Dur Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f90feb82-65a6-4770-a20c-30a07cf60ff9', 'Yonten Kuenjung Academy', '028.202.00002', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '22', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.202.00002', 'Yonten Kuenjung Academy Higher Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f912031b-8e81-431b-9eaa-f9f89d495010', 'Dungkhar', '028.201.00093', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '6', '47', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00093', 'Dungkhar Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f919b47a-1a4f-4df6-882f-1b96930904be', 'Samtse', '028.201.00266', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00266', 'Samtse Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('f9eea0de-6ec1-47bf-85b1-b80e50f9af77', 'Martang', '028.204.00135', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00135', 'Martang Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fac2c033-8c07-4ed2-841b-8759841146c1', 'Barishong', '028.204.00043', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '14', '151', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.204.00043', 'Barishong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fb934dd9-62ba-49f4-adf7-d96190c7158a', 'Kengkhar', '028.201.00122', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00122', 'Kengkhar Middle Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fc726ed0-ee53-451c-9760-93688ffa761e', 'Tangsibi', '028.201.00016', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '1', '1', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00016', 'Tangsibi Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fce66323-a840-47be-aa05-f55d985cd855', 'Sengdhyen', '028.201.00269', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '12', '122', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00269', 'Sengdhyen Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fd0f10c8-5aeb-4ee7-9b38-2f83b110622b', 'Yaragla', '028.201.00164', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '7', '56', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00164', 'Yaragla Extended Classroom', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fd7a72c0-9c4a-4c57-b582-9cc83046ef2f', 'Bartsham', '028.201.00516', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00516', 'Bartsham Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fe257644-98a8-4b83-bf5e-dc8533328c49', 'Alaykha', '028.201.00037', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '2', '6', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00037', 'Alaykha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fe8b6bef-46a9-402e-a848-e2caaed6ed44', 'Khotokha', '028.201.00460', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '19', '205', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00460', 'Khotokha Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fec75922-046b-4828-8755-892f8c506625', 'Tokaphu', '028.201.00396', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '16', '177', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00396', 'Tokaphu Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fec93940-3e84-40a5-b969-6b9e7f905f69', 'Karshong', '028.201.00422', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '17', '186', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00422', 'Karshong Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('fef5de7c-c9e0-498b-94dc-7de8eb399aad', 'Rikhey', '028.201.00254', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '11', '110', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00254', 'Rikhey Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ff7881e8-af0f-47bc-932a-876b5adc50f5', 'Zordung', '028.201.00378', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '15', '161', '1', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00378', 'Zordung Primary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
('ffb89210-2f9b-463d-a382-5e50aadb845c', 'Gelephu', '028.201.00282', '0', '1e5e2020-160c-4f6b-a126-f092f12ed8fd', '24', '', '', '5b355af2-a433-4d51-93eb-1178d5c26624', 0, 0, NULL, '0', 1, '1', 2005, '1', '028.201.00282', 'Gelephu Lower Secondary School', NULL, 'd77d1e56-2b24-4b16-bc18-2b947d62018f', 'd77d1e56-2b24-4b16-bc18-2b947d62018f', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `organization_details_history`
--

CREATE TABLE `organization_details_history` (
  `record_id` int(11) NOT NULL,
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `category` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `levelId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `dzongkhagId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `gewogId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `chiwogId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `locationId` char(200) COLLATE utf8_unicode_ci NOT NULL COMMENT 'location for private will be text',
  `typeOfSchool` tinyint(1) DEFAULT NULL COMMENT '1-boarding, 0 - for days',
  `isGeopoliticallyLocated` tinyint(4) NOT NULL,
  `isSenSchool` tinyint(4) NOT NULL,
  `isFeedingSchool` tinyint(1) DEFAULT NULL,
  `parentSchoolId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `isColocated` tinyint(4) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `yearOfEstablishment` int(11) NOT NULL,
  `organizationType` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zestAgencyCode` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remarks` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `recorded_on` timestamp NULL DEFAULT NULL,
  `recorded_for` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `recorded_by` varchar(36) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_disasters`
--

CREATE TABLE `organization_disasters` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disasterTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cid` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `contactNo` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `servingAs` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `placeOfWork` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_disasters`
--

INSERT INTO `organization_disasters` (`id`, `organizationId`, `disasterTypeId`, `name`, `cid`, `email`, `contactNo`, `servingAs`, `placeOfWork`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('098a2d3d-dd7b-4ec2-9602-f340196cd0c1', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', 'Bhuan', '11', '11', '11', NULL, '11', NULL, NULL, '2021-06-02 05:56:39.000000', '2021-06-02 05:56:39.000000'),
('6de1aec1-73c1-44b7-9781-e4c6a1914799', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '11', '11', '11', '11', NULL, 'test', NULL, NULL, '2021-06-02 05:58:01.000000', '2021-06-02 05:58:01.000000'),
('72f8dfd7-9050-41b5-935f-c44147aec8c9', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', '11', '11', '11', '11', NULL, 'test', NULL, NULL, '2021-06-02 05:58:01.000000', '2021-06-02 05:58:01.000000'),
('86314eba-5939-4c9e-944a-f6ac2835276f', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', 'working agency', '11', '11', '11', NULL, '11', NULL, NULL, '2021-06-02 05:58:23.000000', '2021-06-02 05:58:23.000000'),
('d049c19e-b282-4f1b-8b57-a8e800fb68cd', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', 'Bhuan', '11', '11', '11', NULL, '11', NULL, NULL, '2021-06-02 05:56:39.000000', '2021-06-02 05:56:39.000000'),
('dea90668-3d55-4b98-99d0-915760b708cc', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '', 'working agency', '11', '11', '11', NULL, '11', NULL, NULL, '2021-06-02 05:58:23.000000', '2021-06-02 05:58:23.000000');

-- --------------------------------------------------------

--
-- Table structure for table `organization_documents`
--

CREATE TABLE `organization_documents` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `documentName` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `documentPath` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `remarks` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_equipment`
--

CREATE TABLE `organization_equipment` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `type` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `item` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `cost` decimal(5,2) NOT NULL,
  `condition` tinyint(2) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organization_equipment`
--

INSERT INTO `organization_equipment` (`id`, `organizationId`, `type`, `item`, `cost`, `condition`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('2c36c825-c573-444e-8835-650a61b94e37', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '5e575479-188a-4432-a482-8e285fa45c47', '857c8903-21f7-4ee3-a440-814288def2bf', '11.00', 1, 'f3731473-5005-4573-abf5-9b153911d69f', NULL, '2021-06-03 11:51:52', '2021-06-03 11:51:52'),
('f12cbf42-ef5f-4916-9f18-1e4b3aea5518', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '5e575479-188a-4432-a482-8e285fa45c47', '857c8903-21f7-4ee3-a440-814288def2bf', '11.00', 1, 'f3731473-5005-4573-abf5-9b153911d69f', NULL, '2021-06-03 11:51:52', '2021-06-03 11:51:52');

-- --------------------------------------------------------

--
-- Table structure for table `organization_feeding_detials`
--

CREATE TABLE `organization_feeding_detials` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `foreignKeyFor` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `foreignKeyId` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `noOfMeals` tinyint(4) DEFAULT NULL,
  `created_by` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` char(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_furniture`
--

CREATE TABLE `organization_furniture` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `type` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `item` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `location` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `number` int(11) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_furniture_category`
--

CREATE TABLE `organization_furniture_category` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organization_furniture_category`
--

INSERT INTO `organization_furniture_category` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('25241458-ae8c-458c-8fc2-d3d53075cc65', 'Laboratory', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:59:22', '2021-05-19 06:59:22', NULL),
('a0b84c9d-20bb-4f5d-a6fd-0f536812b3e3', 'Classroom', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:01:52', '2021-05-19 07:01:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `organization_general_facilities`
--

CREATE TABLE `organization_general_facilities` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `description` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_income_facilities`
--

CREATE TABLE `organization_income_facilities` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organization_details_id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `incomeFacilitiesId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amountGenerated` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `remarks` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_locations`
--

CREATE TABLE `organization_locations` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `altitude` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `latitude` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `longitude` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `climateType` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `googleMapPath` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `distanceFromDzongkhag` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_profile`
--

CREATE TABLE `organization_profile` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `org_id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `mission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `vission` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `logo_path` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `organization_profile`
--

INSERT INTO `organization_profile` (`id`, `org_id`, `mission`, `vission`, `logo_path`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('36b68c55-1388-4638-88e6-b10123f2b411', 'd2a52017-1ffc-4ce3-970d-86a00950bfdc', 'asdfasdf', 'asdfasf', 'orgProfile/1621885820_download.jfif', '119dcda3-bae3-4b01-aa56-2fc453c13e80', NULL, '2021-05-24 19:50:20', '2021-05-24 19:50:20'),
('5a2c5376-8f8e-41e9-8c52-ee85914175ae', 'd2a52017-1ffc-4ce3-970d-86a00950bfdc', 'asdfasdf', 'asdfasf', 'orgProfile/1621885720_frame1.jpg', '119dcda3-bae3-4b01-aa56-2fc453c13e80', NULL, '2021-05-24 19:48:40', '2021-05-24 19:48:40');

-- --------------------------------------------------------

--
-- Table structure for table `organization_projections`
--

CREATE TABLE `organization_projections` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `projections` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stream` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remarks` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_projections`
--

INSERT INTO `organization_projections` (`id`, `organizationId`, `projections`, `class`, `stream`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('350c6ca4-224d-480d-ab1f-3e701a96aba1', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', NULL, 'test', NULL, NULL, '2021-06-02 06:29:48.000000', '2021-06-02 06:29:48.000000'),
('3ace96bd-6123-4a7c-b48e-2846807fc364', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11', '780d917c-ed3e-4157-b8c3-146039118805', NULL, 'test khang', NULL, NULL, '2021-06-02 22:29:58.000000', '2021-06-02 22:29:58.000000'),
('9d5f1cd8-94af-4e01-9e05-7c9719dbeaf8', '4184f12c-a7fc-40c3-b038-013e242d8ef6', '11', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', NULL, 'test', NULL, NULL, '2021-06-02 06:38:43.000000', '2021-06-02 06:38:43.000000'),
('e4189fd8-9892-4164-a469-26ab49b4dbfa', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', NULL, 'test', NULL, NULL, '2021-06-02 06:29:48.000000', '2021-06-02 06:29:48.000000');

-- --------------------------------------------------------

--
-- Table structure for table `organization_proprietor_details`
--

CREATE TABLE `organization_proprietor_details` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `cid` int(11) NOT NULL,
  `fullName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNo` int(11) NOT NULL,
  `mobileNo` int(8) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_proprietor_details_history`
--

CREATE TABLE `organization_proprietor_details_history` (
  `record_id` int(11) NOT NULL,
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `cid` int(11) NOT NULL,
  `fullName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `phoneNo` int(11) NOT NULL,
  `mobileNo` int(11) DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `recorded_on` timestamp NULL DEFAULT NULL,
  `recorded_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_sports`
--

CREATE TABLE `organization_sports` (
  `idorganization_sports` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facilityTypeId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `facilitySubTypeId` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `yearOfEstablishment` date DEFAULT NULL,
  `supportedById` char(36) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `usable` tinyint(3) DEFAULT NULL,
  `totalNoFacilities` int(3) DEFAULT NULL,
  `noAcessibleToDisabled` int(3) DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `organization_visitor`
--

CREATE TABLE `organization_visitor` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `visitor` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dateOfVisit` date DEFAULT NULL,
  `remarks` varchar(250) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `organization_visitor`
--

INSERT INTO `organization_visitor` (`id`, `organizationId`, `visitor`, `dateOfVisit`, `remarks`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('a17bd6bd-c9d5-45eb-a5c9-7608430902af', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, 'test', NULL, NULL, '2021-06-02 04:43:14.000000', '2021-06-02 04:43:14.000000'),
('f4a484a7-449b-43ed-b91d-c6f113604a62', '4184f12c-a7fc-40c3-b038-013e242d8ef6', NULL, NULL, 'test', NULL, NULL, '2021-06-02 04:43:14.000000', '2021-06-02 04:43:14.000000');

-- --------------------------------------------------------

--
-- Table structure for table `orgnization_financial_information`
--

CREATE TABLE `orgnization_financial_information` (
  `id` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `financialInformationId` char(36) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(99) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date` date DEFAULT NULL,
  `status` tinyint(3) DEFAULT NULL,
  `created_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `updated_by` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp(6) NULL DEFAULT NULL,
  `updated_at` timestamp(6) NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `road_types`
--

CREATE TABLE `road_types` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `road_types`
--

INSERT INTO `road_types` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('0084b3e6-f97f-4261-9cb6-9e185cce3d97', 'Paved', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:57:09', '2021-05-19 06:57:09', NULL),
('24c4125f-8f0b-4eb4-bfa4-84bf7c00b58b', 'Footpath', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:57:35', '2021-05-19 06:57:35', NULL),
('4e5edb59-49e8-4c0b-8066-7c801396f12d', 'Farm Road', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:57:21', '2021-05-19 06:57:21', NULL),
('d1a880f7-b26a-40ba-8d63-e4823d025144', 'Un-Paved', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:57:15', '2021-05-19 06:57:15', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `school_feedings`
--

CREATE TABLE `school_feedings` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `value` tinyint(4) NOT NULL,
  `status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sections-to-delete`
--

CREATE TABLE `sections-to-delete` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `classId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `streamId` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `section_details`
--

CREATE TABLE `section_details` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `classSectionId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `section` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `section_details`
--

INSERT INTO `section_details` (`id`, `classSectionId`, `section`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('0aa5072d-00ff-4b06-93e9-8259bf148bfb', '6fc68168-937b-4d24-80b9-3d2a241e10c4', 'B', NULL, NULL, NULL, NULL),
('173152e5-f129-4877-ae71-205336f2879b', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'A', NULL, NULL, NULL, NULL),
('2a32c940-523e-40ed-9f4d-856fd678051a', '6fc68168-937b-4d24-80b9-3d2a241e10c4', 'C', NULL, NULL, NULL, NULL),
('36f9fee5-b30d-4e47-bab2-31ac38bac352', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'C', NULL, NULL, NULL, NULL),
('38801fbd-5f49-4b83-8204-ed42bbc47ccd', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', 'A', NULL, NULL, NULL, NULL),
('3e640f02-9f16-4821-9934-5297aa1f2765', '74217e56-f58b-4aef-a976-6277bae06d58', 'C', NULL, NULL, NULL, NULL),
('3f706abc-3063-4fd4-803f-a63897dded97', '755bb014-859b-4c7c-b194-8a134fd059eb', 'A', NULL, NULL, NULL, NULL),
('4838b1c6-f11a-4772-944e-b01da75b4fce', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'B', NULL, NULL, NULL, NULL),
('4da9d182-6f65-4d7c-a097-67c8924c8200', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', 'C', NULL, NULL, NULL, NULL),
('6a430904-c901-47ad-b351-3b6cdd95617b', '74217e56-f58b-4aef-a976-6277bae06d58', 'A', NULL, NULL, NULL, NULL),
('6d3c4fa9-ed90-4628-a818-dd107e4f5bde', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'B', NULL, NULL, NULL, NULL),
('797809f0-1189-478b-b293-fa030715d37a', '6fc68168-937b-4d24-80b9-3d2a241e10c4', 'A', NULL, NULL, NULL, NULL),
('7cc00f86-71d6-471e-9d9a-adadb2b6a475', '780d917c-ed3e-4157-b8c3-146039118805', 'C', NULL, NULL, NULL, NULL),
('7ebcce72-a667-43e1-8023-653cf9cf08db', 'a9aba5bb-22a2-4622-b253-9fc48ddeedd6', 'B', NULL, NULL, NULL, NULL),
('8ea93bd7-0589-46f7-a5bf-df537dea0a9c', '74217e56-f58b-4aef-a976-6277bae06d58', 'B', NULL, NULL, NULL, NULL),
('9316a24d-15ad-446d-abd5-edcf544c2a39', '780d917c-ed3e-4157-b8c3-146039118805', 'B', NULL, NULL, NULL, NULL),
('a1205069-70af-4cca-88a4-7e1d973e22a2', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'B', NULL, NULL, NULL, NULL),
('a1cdaf0d-78dd-4e7a-96ef-4975697c37d0', '780d917c-ed3e-4157-b8c3-146039118805', 'A', NULL, NULL, NULL, NULL),
('a2c7bab2-278c-42c7-a630-d44d6cbd4349', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'A', NULL, NULL, NULL, NULL),
('a5288db0-79d3-4674-b84a-186b5bdb5dbe', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'C', NULL, NULL, NULL, NULL),
('a9206f1b-5a18-40fb-bf99-31ef94458ed4', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'B', NULL, NULL, NULL, NULL),
('b0fc9ec5-8231-4e37-82bc-a273b24ce4a4', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'B', NULL, NULL, NULL, NULL),
('b112e5bc-1cc9-4974-a09f-35b851042587', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'B', NULL, NULL, NULL, NULL),
('bd481b88-2257-413f-b273-4de795150231', '5f1553b2-ed0b-4b50-b9ea-83b193042de5', 'A', NULL, NULL, NULL, NULL),
('bedbdc9f-7ee8-4d00-a769-f2925d287fd6', '755bb014-859b-4c7c-b194-8a134fd059eb', 'C', NULL, NULL, NULL, NULL),
('c7da1bf6-4af9-49f3-8331-e71209f95dbf', '755bb014-859b-4c7c-b194-8a134fd059eb', 'B', NULL, NULL, NULL, NULL),
('ca96a7e2-d708-44d0-8865-7b0bdb838691', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'A', NULL, NULL, NULL, NULL),
('d438b6a7-4ba1-4b87-bb97-fe400029dd9f', '6c2ca46d-e630-401d-8a2e-a25d303841d1', 'C', NULL, NULL, NULL, NULL),
('d617cdbf-0817-417e-a3ea-abce63ede097', 'e5c58728-9412-4b0d-b498-7f174dd4ad4b', 'C', NULL, NULL, NULL, NULL),
('dd8f3ced-a903-415b-bf63-139bbcf672f8', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'C', NULL, NULL, NULL, NULL),
('ddb4ff90-218d-4921-9ae6-ca0239c344a5', 'ecfa0f9a-5820-4797-a79f-499d2598bfb6', 'A', NULL, NULL, NULL, NULL),
('e89b9344-03df-4e8e-9543-908db89415a1', '5c73f001-61fc-4326-9b16-cb1ad6a7fd3f', 'C', NULL, NULL, NULL, NULL),
('fb0a13ff-3b7c-4068-9a0e-34b4d4afc80f', '7daac690-94d1-409e-86b3-d07fa1522b9c', 'A', NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `service_providers`
--

CREATE TABLE `service_providers` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `serviceType` tinyint(4) NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `service_providers`
--

INSERT INTO `service_providers` (`id`, `serviceType`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('a0227d59-b174-4231-beb6-9b54f445397e', 1, 'Bhutan Telecom', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:56:35', '2021-05-19 06:56:35', NULL),
('b62b26ac-fc5f-4792-bb5f-8403ced1e013', 1, 'Tashi Internet', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:56:46', '2021-05-19 06:56:46', NULL),
('c25a283f-408e-40ab-bb75-540915616ee1', 2, 'Bhutan Telecom', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:56:54', '2021-05-19 06:56:54', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sports`
--

CREATE TABLE `sports` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `organizationId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `facility` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `type` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `yearOfEstablishment` int(11) NOT NULL,
  `supportedBy` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `noOfFacility` int(11) NOT NULL,
  `accessibleToDisabled` int(11) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sport_facility_subtypes`
--

CREATE TABLE `sport_facility_subtypes` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `sportFacilityId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sport_facility_type`
--

CREATE TABLE `sport_facility_type` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sport_facility_type`
--

INSERT INTO `sport_facility_type` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('431d857b-d07b-4e90-a3fd-218d26c57293', 'Football field', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:02:18', '2021-05-19 07:02:18', NULL),
('768f34a7-eefb-477e-bcae-ae3736f79987', 'Archery ground', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:02:25', '2021-05-19 07:02:25', NULL),
('d9ebde1c-c744-49c9-bd07-f9d24bca1291', 'Basketball court', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:02:06', '2021-05-19 07:02:06', NULL),
('ee0e5842-f222-482c-a2c2-e053703880dc', 'Badminton court', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:02:13', '2021-05-19 07:02:13', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sport_supporter`
--

CREATE TABLE `sport_supporter` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `sport_supporter`
--

INSERT INTO `sport_supporter` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('04a7a797-6857-4eb9-91d5-c19dd97719cc', 'IOC', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:02:45', '2021-05-19 07:02:45', NULL),
('820bdc29-c16f-4850-a7c5-eb33a2ac00d6', 'BOC', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:02:41', '2021-05-19 07:02:41', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `streams`
--

CREATE TABLE `streams` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `stream` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `streams`
--

INSERT INTO `streams` (`id`, `stream`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('1ee005c0-6ac8-4478-b178-c1982e87dfa4', 'Science', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:55:52', '2021-05-19 06:55:52', NULL),
('4157a2f3-a64c-4a53-af76-0ff968d69c87', 'Arts', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:55:58', '2021-05-19 06:55:58', NULL),
('77ad4ebc-64af-465d-99d9-7f79d7314892', 'Commerce', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:56:04', '2021-05-19 06:56:04', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `structure_category`
--

CREATE TABLE `structure_category` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `structure_category`
--

INSERT INTO `structure_category` (`id`, `name`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('15cdcd09-2f42-44a4-aae8-281252b8e327', 'Academic Building', 'Academic Building', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:58:17', '2021-05-19 06:58:17'),
('360e4d9f-96b5-4637-b050-e0e132f2f91a', 'Hostels', 'Hostels', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:58:26', '2021-05-19 06:58:26'),
('fabb7a09-869f-4d43-8646-f49b72d0a510', 'Residential Building', 'Residential Building', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:58:37', '2021-05-19 06:58:37'),
('fabb7a09-869f-4d43-8646-f49b72d0a515', 'Recreational Building', 'Recreational Building', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:58:37', '2021-05-19 06:58:37');

-- --------------------------------------------------------

--
-- Table structure for table `structure_designers`
--

CREATE TABLE `structure_designers` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `structure_designers`
--

INSERT INTO `structure_designers` (`id`, `name`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`, `description`) VALUES
('3c9c47ac-bb5b-4f68-9ae8-a8ae23c99a63', 'SPBD', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:57:52', '2021-05-19 06:57:52', NULL),
('3c9c47ac-bb5b-4f68-9ae8-a8ae23c99a64', 'Dzongkhag', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:57:52', '2021-05-19 06:57:52', NULL),
('3c9c47ac-bb5b-4f68-9ae8-a8ae23c99a65', 'Thromde', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:57:52', '2021-05-19 06:57:52', NULL),
('3c9c47ac-bb5b-4f68-9ae8-a8ae23c99a66', 'Others', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:57:52', '2021-05-19 06:57:52', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `structure_facility`
--

CREATE TABLE `structure_facility` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `structure_facility`
--

INSERT INTO `structure_facility` (`id`, `name`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('1de75cf8-da5b-43fb-89a8-5b3d932e32ac', 'Community Building', 'Community Building', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:59:50', '2021-05-19 06:59:50'),
('2e834fe1-78b1-4553-b716-b1a0285edd55', 'Load Bearing', 'Load Bearing', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:59:41', '2021-05-19 06:59:41'),
('aac98b69-6e1e-4efe-bfc4-b94d983ab04c', 'LGSF', 'LGSF', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 06:59:59', '2021-05-19 06:59:59'),
('f7283fbb-4c22-49aa-bde0-f8cfccd6a5fe', 'RCC Frame Structure', 'RCC Frame Structure', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:00:11', '2021-05-19 07:00:11'),
('f822eaf5-11c7-4533-b5c5-aea532759f6b', 'Temporary Structure', 'Temporary Structure', 1, '20118206-4d98-48f3-b2db-cf1c94ada0dd', NULL, '2021-05-19 07:00:22', '2021-05-19 07:00:22');

-- --------------------------------------------------------

--
-- Table structure for table `structure_sub_categories`
--

CREATE TABLE `structure_sub_categories` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `structureCategory` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `subCategoryName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `structure_sub_categories`
--

INSERT INTO `structure_sub_categories` (`id`, `structureCategory`, `subCategoryName`, `description`, `status`, `created_by`, `updated_by`, `created_at`, `updated_at`) VALUES
('09fc180c-27fb-4ac5-b365-3721a9125707', '15cdcd09-2f42-44a4-aae8-281252b8e327', '8 Classroom Block', '8 Classroom Block', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('0e2457c3-b012-44b7-851b-17d8f205a1a9', '15cdcd09-2f42-44a4-aae8-281252b8e327', '4 Laboratory Block', '4 Laboratory Block', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('10b8bcd2-c965-4cf7-a47d-959702582fba', 'fabb7a09-869f-4d43-8646-f49b72d0a510', 'Staff Quarters - 4 units', 'Staff Quarters - 4 units', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('15b11e3a-fcc0-41f6-94ef-8bf29d00b055', '15cdcd09-2f42-44a4-aae8-281252b8e327', '6 Classroom Block (internal stair)', '6 Classroom Block (internal stair)', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('1681d3bc-becb-4f26-a227-25c8a6434cf4', '360e4d9f-96b5-4637-b050-e0e132f2f91a', '32 Bedded Hostel', '32 Bedded Hostel', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('16dd2688-524e-402e-9d4d-2fd631006f7b', '15cdcd09-2f42-44a4-aae8-281252b8e327', 'Other', 'Other', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('24172d85-e8d0-4097-92a9-1e96f18f568b', '360e4d9f-96b5-4637-b050-e0e132f2f91a', '64 Bedded Hostel', '64 Bedded Hostel', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('320290fb-5dc7-4d4d-a615-f29fdc47364e', '15cdcd09-2f42-44a4-aae8-281252b8e327', 'Administration with Library Block', 'Administration with Library Block', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('3362408f-5174-4537-88bf-c382f28a9cc3', 'fabb7a09-869f-4d43-8646-f49b72d0a510', 'Class IV Staff Quarters (3 storey)', 'Class IV Staff Quarters (3 storey)', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('33b81434-bd1f-4988-86ed-93dadcae0aad', '15cdcd09-2f42-44a4-aae8-281252b8e327', '4 Classroom Block', '4 Classroom Block', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('3401af12-f4fe-4f4b-82dc-90ec5ea11f99', 'fabb7a09-869f-4d43-8646-f49b72d0a510', 'Principal Quarter', 'Principal Quarter', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('4276254a-cfdd-43a5-ab74-db5af61c7290', '360e4d9f-96b5-4637-b050-e0e132f2f91a', '180 Bedded Hostel', '180 Bedded Hostel', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('45231828-4d0d-4435-b830-b49fa96431ca', 'fabb7a09-869f-4d43-8646-f49b72d0a510', 'Staff Quarters - 6 units', 'Staff Quarters - 6 units', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('45e88a67-0de3-42f2-ad09-b6bce8e30290', '360e4d9f-96b5-4637-b050-e0e132f2f91a', 'Others', 'Others', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('53810e0b-9d7b-49d0-80fa-bb8f66cfe59f', '15cdcd09-2f42-44a4-aae8-281252b8e327', 'Administration with HSS Lab', 'Administration with HSS Lab', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('54201d80-8900-4552-99b3-1feae809711f', '15cdcd09-2f42-44a4-aae8-281252b8e327', 'Academic Toilet', 'Academic Toilet', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('54f6b305-26f8-4be9-b554-a8bf0449d6c7', 'fabb7a09-869f-4d43-8646-f49b72d0a515', 'Multi-purpose Hall – 800', 'Multi-purpose Hall – 800', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('5717ab3f-6f81-4aa0-a5e9-1df62b1f7f88', 'fabb7a09-869f-4d43-8646-f49b72d0a510', 'Others', 'Others', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('57bd43bf-f53d-4f3c-8124-3a2713d2bfd9', '360e4d9f-96b5-4637-b050-e0e132f2f91a', '180 Bedded Hostel with WMQ', '180 Bedded Hostel with WMQ', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('64f01c79-bac5-4e3e-b96e-8f0980907cca', '15cdcd09-2f42-44a4-aae8-281252b8e327', '8 Classroom with Administration Block', '8 Classroom with Administration Block', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('710a0e77-482e-427d-9508-51d7342459c2', 'fabb7a09-869f-4d43-8646-f49b72d0a515', 'Others', 'Others', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('731e32a7-f1bf-4dad-9894-b965e2bd15cc', '15cdcd09-2f42-44a4-aae8-281252b8e327', 'Lab & Library Block', 'Lab & Library Block', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('789d415a-4b0d-4488-9aa2-e134153c780d', '360e4d9f-96b5-4637-b050-e0e132f2f91a', '96 Bedded Hostel', '96 Bedded Hostel', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('7c6b995f-7e5a-4e37-9e8a-45ed14640e22', '15cdcd09-2f42-44a4-aae8-281252b8e327', '6 Classroom Block', '6 Classroom Block', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('801624db-68b2-4e71-b2b3-0269e76faee9', '15cdcd09-2f42-44a4-aae8-281252b8e327', 'Administration with 4 Classroom Block', 'Administration with 4 Classroom Block', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('8d48c1d5-f094-4fa7-b7cb-2fbb265e9b24', '360e4d9f-96b5-4637-b050-e0e132f2f91a', '120 Bedded Hostel with WMQ', '120 Bedded Hostel with WMQ', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('8ef55135-35b4-4d17-9da2-96d852308bd4', '15cdcd09-2f42-44a4-aae8-281252b8e327', 'Integrated Academic Block 16 CL', 'Integrated Academic Block 16 CL', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('8f4730ab-ed98-4bc5-89aa-065570e97c67', '15cdcd09-2f42-44a4-aae8-281252b8e327', '8 Classroom with Lab/Library Block', '8 Classroom with Lab/Library Block', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('922514a0-1bc9-4e01-b975-9a90b7e68e99', 'fabb7a09-869f-4d43-8646-f49b72d0a515', 'Dining Hall', 'Dining Hall', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('968302c7-6bf5-4236-b6aa-d68ed115dcb5', '15cdcd09-2f42-44a4-aae8-281252b8e327', 'Administration Block (new)', 'Administration Block (new)', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('bf37b28b-33fd-4bd2-bc95-3a5ec93a7664', 'fabb7a09-869f-4d43-8646-f49b72d0a515', 'Kitchen-store with Toilet', 'Kitchen-store with Toilet', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('c01450c7-2ea0-46fe-a3ce-05585a69f455', '15cdcd09-2f42-44a4-aae8-281252b8e327', 'Administration with LSS Lab', 'Administration with LSS Lab', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('c33572d8-d5d5-447b-9ddd-10dec27d8793', 'fabb7a09-869f-4d43-8646-f49b72d0a515', 'Kitchen cum Dining Hall', 'Kitchen cum Dining Hall', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('c4b57a3a-1d0f-4732-b9d2-b05d58d14997', '15cdcd09-2f42-44a4-aae8-281252b8e327', 'Integrated Academic Block 15 CL', 'Integrated Academic Block 15 CL', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('c4f5baf6-fac0-455c-be56-a697e47376ef', '15cdcd09-2f42-44a4-aae8-281252b8e327', 'Administration Block (2 storey)', 'Administration Block (2 storey)', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('c8a9bb75-203f-4286-b970-2d33e9faa194', '360e4d9f-96b5-4637-b050-e0e132f2f91a', '200 Bedded Hostel with WMQ', '200 Bedded Hostel with WMQ', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('cd67e5ef-e93a-4a7f-88b2-6c791cf7e74c', 'fabb7a09-869f-4d43-8646-f49b72d0a510', 'Warden/Matron Quarter', 'Warden/Matron Quarter', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('f695fc59-76be-4896-94b9-95c207987307', '15cdcd09-2f42-44a4-aae8-281252b8e327', '12 Classroom Block', '12 Classroom Block', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('f8acc7e5-c74b-4b0d-8a82-74675eb4f281', 'fabb7a09-869f-4d43-8646-f49b72d0a510', 'Principals and Staff Quarters (3 storey)', 'Principals and Staff Quarters (3 storey)', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('f9cc9aa0-7f31-47cf-9012-d2da26185696', 'fabb7a09-869f-4d43-8646-f49b72d0a515', 'Academic Toilet (2019)', 'Academic Toilet (2019)', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06'),
('ff7bb8f6-ef2a-44b5-be2f-5bfff9ef45a9', 'fabb7a09-869f-4d43-8646-f49b72d0a515', 'Kitchen-store', 'Kitchen-store', 1, '', '', '2021-05-19 07:01:06', '2021-05-19 07:01:06');

-- --------------------------------------------------------

--
-- Table structure for table `wash_feeding`
--

CREATE TABLE `wash_feeding` (
  `id` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `orgId` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `questionId` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `answer` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `type` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `ans_type` char(36) COLLATE utf8_unicode_ci NOT NULL,
  `created_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `updated_by` char(36) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `application_attachments`
--
ALTER TABLE `application_attachments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_app_attachments_application_details1_idx` (`ApplicationDetailsId`);

--
-- Indexes for table `application_class_stream`
--
ALTER TABLE `application_class_stream`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_details`
--
ALTER TABLE `application_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_est_bifurcation`
--
ALTER TABLE `application_est_bifurcation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_application_est_bifurcation_application_details1_idx` (`ApplicationDetailsId`);

--
-- Indexes for table `application_est_bifurcation_details`
--
ALTER TABLE `application_est_bifurcation_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_application_est_bifurcation_details_application_est_bifu_idx` (`ApplicationEstBifurcationId`);

--
-- Indexes for table `application_est_closure`
--
ALTER TABLE `application_est_closure`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_application_est_merger_application_details1_idx` (`ApplicationDetailsId`);

--
-- Indexes for table `application_est_details_change`
--
ALTER TABLE `application_est_details_change`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_application_est_expansion_application_details1_idx` (`ApplicationDetailsId`);

--
-- Indexes for table `application_est_merger`
--
ALTER TABLE `application_est_merger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_application_est_merger_application_details1_idx` (`ApplicationDetailsId`);

--
-- Indexes for table `application_est_private`
--
ALTER TABLE `application_est_private`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_app_new_private_school_application_details1_idx` (`ApplicationDetailsId`);

--
-- Indexes for table `application_est_public`
--
ALTER TABLE `application_est_public`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_app_new_public_school_application_details_idx` (`ApplicationDetailsId`);

--
-- Indexes for table `application_no_meals`
--
ALTER TABLE `application_no_meals`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_proprietor_details`
--
ALTER TABLE `application_proprietor_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_application_proprietor_details_application_est_details_c_idx` (`ApplicationEstDetailsChangeId`);

--
-- Indexes for table `application_sequence`
--
ALTER TABLE `application_sequence`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `application_verification`
--
ALTER TABLE `application_verification`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_application_verification_application_details1_idx` (`ApplicationDetailsId`);

--
-- Indexes for table `application_verification_team`
--
ALTER TABLE `application_verification_team`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_application_verification_team_application_verification1_idx` (`ApplicationVerificationId`);

--
-- Indexes for table `attachments`
--
ALTER TABLE `attachments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attachment_files`
--
ALTER TABLE `attachment_files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bifurcations`
--
ALTER TABLE `bifurcations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bifurcations_new1level_foreign` (`new1Level`),
  ADD KEY `bifurcations_new1location_foreign` (`new1Location`),
  ADD KEY `bifurcations_new2level_foreign` (`new2Level`),
  ADD KEY `bifurcations_new2location_foreign` (`new2Location`);

--
-- Indexes for table `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_mappings`
--
ALTER TABLE `class_mappings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_mappings-to-delete`
--
ALTER TABLE `class_mappings-to-delete`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_stream_mappings`
--
ALTER TABLE `class_stream_mappings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `closures`
--
ALTER TABLE `closures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `closures_level_foreign` (`level`),
  ADD KEY `closures_location_foreign` (`location`);

--
-- Indexes for table `connectivities`
--
ALTER TABLE `connectivities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `connectivities_organizationid_foreign` (`organizationId`),
  ADD KEY `connectivities_roadtypeid_foreign` (`roadTypeId`),
  ADD KEY `connectivities_electricitysourceid_foreign` (`electricitySourceId`),
  ADD KEY `connectivities_electricitysupplyid_foreign` (`electricitySupplyId`),
  ADD KEY `connectivities_telephoneserviceprovoderid_foreign` (`telephoneServiceProvoderId`),
  ADD KEY `connectivities_internetserviceproviderid_foreign` (`internetServiceProviderId`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `contact_details_organizationid_foreign` (`organizationId`),
  ADD KEY `contact_details_contacttypeid_foreign` (`contactTypeId`);

--
-- Indexes for table `contact_types`
--
ALTER TABLE `contact_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `disaster`
--
ALTER TABLE `disaster`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electricity_sources`
--
ALTER TABLE `electricity_sources`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `electricity_supplies`
--
ALTER TABLE `electricity_supplies`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `equipment_and_furniture`
--
ALTER TABLE `equipment_and_furniture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_and_furniture_organizationid_foreign` (`organizationId`);

--
-- Indexes for table `equipment_items`
--
ALTER TABLE `equipment_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_items_equipmenttype_foreign` (`equipmentType`);

--
-- Indexes for table `equipment_type`
--
ALTER TABLE `equipment_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `head_quater_details`
--
ALTER TABLE `head_quater_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `infrastructures`
--
ALTER TABLE `infrastructures`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infrastructures_organizationid_foreign` (`organizationId`),
  ADD KEY `infrastructures_categoryid_foreign` (`categoryId`),
  ADD KEY `infrastructures_subcategoryid_foreign` (`subCategoryId`);

--
-- Indexes for table `infrastructure_facilities`
--
ALTER TABLE `infrastructure_facilities`
  ADD PRIMARY KEY (`id`),
  ADD KEY `infrastructure_facilities_infrastructureid_foreign` (`infrastructureId`),
  ADD KEY `infrastructure_facilities_facilitytypeid_foreign` (`facilityTypeId`);

--
-- Indexes for table `level`
--
ALTER TABLE `level`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `location`
--
ALTER TABLE `location`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `locations_organizationid_foreign` (`organizationId`);

--
-- Indexes for table `location_disaster_risks`
--
ALTER TABLE `location_disaster_risks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `location_disaster_risks_locationid_foreign` (`locationId`),
  ADD KEY `location_disaster_risks_disastertypeid_foreign` (`disasterTypeId`);

--
-- Indexes for table `master_department`
--
ALTER TABLE `master_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_disaster_type`
--
ALTER TABLE `master_disaster_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_document_type`
--
ALTER TABLE `master_document_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_financial_information`
--
ALTER TABLE `master_financial_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `master_income_facilities`
--
ALTER TABLE `master_income_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_child_facilities`
--
ALTER TABLE `organization_child_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_class_streams`
--
ALTER TABLE `organization_class_streams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_class_streams_history`
--
ALTER TABLE `organization_class_streams_history`
  ADD PRIMARY KEY (`record_id`,`id`);

--
-- Indexes for table `organization_compound_details`
--
ALTER TABLE `organization_compound_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_details`
--
ALTER TABLE `organization_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_details_history`
--
ALTER TABLE `organization_details_history`
  ADD PRIMARY KEY (`record_id`,`id`);

--
-- Indexes for table `organization_disasters`
--
ALTER TABLE `organization_disasters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_documents`
--
ALTER TABLE `organization_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_equipment`
--
ALTER TABLE `organization_equipment`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_and_furniture_organizationid_foreign` (`organizationId`);

--
-- Indexes for table `organization_feeding_detials`
--
ALTER TABLE `organization_feeding_detials`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_furniture`
--
ALTER TABLE `organization_furniture`
  ADD PRIMARY KEY (`id`),
  ADD KEY `equipment_and_furniture_organizationid_foreign` (`organizationId`);

--
-- Indexes for table `organization_furniture_category`
--
ALTER TABLE `organization_furniture_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_general_facilities`
--
ALTER TABLE `organization_general_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_income_facilities`
--
ALTER TABLE `organization_income_facilities`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_locations`
--
ALTER TABLE `organization_locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_profile`
--
ALTER TABLE `organization_profile`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_projections`
--
ALTER TABLE `organization_projections`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_proprietor_details`
--
ALTER TABLE `organization_proprietor_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `organization_proprietor_details_history`
--
ALTER TABLE `organization_proprietor_details_history`
  ADD PRIMARY KEY (`record_id`,`id`);

--
-- Indexes for table `organization_sports`
--
ALTER TABLE `organization_sports`
  ADD PRIMARY KEY (`idorganization_sports`);

--
-- Indexes for table `organization_visitor`
--
ALTER TABLE `organization_visitor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orgnization_financial_information`
--
ALTER TABLE `orgnization_financial_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `road_types`
--
ALTER TABLE `road_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_feedings`
--
ALTER TABLE `school_feedings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `school_feedings_organizationid_foreign` (`organizationId`);

--
-- Indexes for table `sections-to-delete`
--
ALTER TABLE `sections-to-delete`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sections_organizationid_foreign` (`organizationId`),
  ADD KEY `sections_classid_foreign` (`classId`),
  ADD KEY `sections_streamid_foreign` (`streamId`);

--
-- Indexes for table `section_details`
--
ALTER TABLE `section_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `section_details_classsectionid_foreign` (`classSectionId`);

--
-- Indexes for table `service_providers`
--
ALTER TABLE `service_providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sports`
--
ALTER TABLE `sports`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sports_organizationid_foreign` (`organizationId`),
  ADD KEY `sports_facility_foreign` (`facility`),
  ADD KEY `sports_type_foreign` (`type`),
  ADD KEY `sports_supportedby_foreign` (`supportedBy`);

--
-- Indexes for table `sport_facility_subtypes`
--
ALTER TABLE `sport_facility_subtypes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sport_facility_type`
--
ALTER TABLE `sport_facility_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sport_supporter`
--
ALTER TABLE `sport_supporter`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `streams`
--
ALTER TABLE `streams`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `structure_category`
--
ALTER TABLE `structure_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `structure_designers`
--
ALTER TABLE `structure_designers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `structure_facility`
--
ALTER TABLE `structure_facility`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `structure_sub_categories`
--
ALTER TABLE `structure_sub_categories`
  ADD PRIMARY KEY (`id`),
  ADD KEY `structure_sub_categories_structurecategory_foreign` (`structureCategory`);

--
-- Indexes for table `wash_feeding`
--
ALTER TABLE `wash_feeding`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `organization_class_streams_history`
--
ALTER TABLE `organization_class_streams_history`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `organization_details_history`
--
ALTER TABLE `organization_details_history`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `organization_proprietor_details_history`
--
ALTER TABLE `organization_proprietor_details_history`
  MODIFY `record_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `application_est_bifurcation`
--
ALTER TABLE `application_est_bifurcation`
  ADD CONSTRAINT `fk_application_est_bifurcation_application_details1` FOREIGN KEY (`ApplicationDetailsId`) REFERENCES `application_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_est_bifurcation_details`
--
ALTER TABLE `application_est_bifurcation_details`
  ADD CONSTRAINT `fk_application_est_bifurcation_details_application_est_bifurc1` FOREIGN KEY (`ApplicationEstBifurcationId`) REFERENCES `application_est_bifurcation` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_est_closure`
--
ALTER TABLE `application_est_closure`
  ADD CONSTRAINT `fk_application_est_merger_application_details10` FOREIGN KEY (`ApplicationDetailsId`) REFERENCES `application_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_est_details_change`
--
ALTER TABLE `application_est_details_change`
  ADD CONSTRAINT `fk_application_est_expansion_application_details1` FOREIGN KEY (`ApplicationDetailsId`) REFERENCES `application_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_est_merger`
--
ALTER TABLE `application_est_merger`
  ADD CONSTRAINT `fk_application_est_merger_application_details1` FOREIGN KEY (`ApplicationDetailsId`) REFERENCES `application_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_est_private`
--
ALTER TABLE `application_est_private`
  ADD CONSTRAINT `fk_app_new_private_school_application_details1` FOREIGN KEY (`ApplicationDetailsId`) REFERENCES `application_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_est_public`
--
ALTER TABLE `application_est_public`
  ADD CONSTRAINT `fk_app_new_public_school_application_details` FOREIGN KEY (`ApplicationDetailsId`) REFERENCES `application_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_proprietor_details`
--
ALTER TABLE `application_proprietor_details`
  ADD CONSTRAINT `fk_application_proprietor_details_application_est_details_cha1` FOREIGN KEY (`ApplicationEstDetailsChangeId`) REFERENCES `application_est_details_change` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_verification`
--
ALTER TABLE `application_verification`
  ADD CONSTRAINT `fk_application_verification_application_details1` FOREIGN KEY (`ApplicationDetailsId`) REFERENCES `application_details` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `application_verification_team`
--
ALTER TABLE `application_verification_team`
  ADD CONSTRAINT `fk_application_verification_team_application_verification1` FOREIGN KEY (`ApplicationVerificationId`) REFERENCES `application_verification` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `bifurcations`
--
ALTER TABLE `bifurcations`
  ADD CONSTRAINT `bifurcations_new1level_foreign` FOREIGN KEY (`new1Level`) REFERENCES `level` (`id`),
  ADD CONSTRAINT `bifurcations_new1location_foreign` FOREIGN KEY (`new1Location`) REFERENCES `location` (`id`),
  ADD CONSTRAINT `bifurcations_new2level_foreign` FOREIGN KEY (`new2Level`) REFERENCES `level` (`id`),
  ADD CONSTRAINT `bifurcations_new2location_foreign` FOREIGN KEY (`new2Location`) REFERENCES `location` (`id`);

--
-- Constraints for table `closures`
--
ALTER TABLE `closures`
  ADD CONSTRAINT `closures_level_foreign` FOREIGN KEY (`level`) REFERENCES `level` (`id`),
  ADD CONSTRAINT `closures_location_foreign` FOREIGN KEY (`location`) REFERENCES `location` (`id`);

--
-- Constraints for table `connectivities`
--
ALTER TABLE `connectivities`
  ADD CONSTRAINT `connectivities_electricitysourceid_foreign` FOREIGN KEY (`electricitySourceId`) REFERENCES `electricity_sources` (`id`),
  ADD CONSTRAINT `connectivities_electricitysupplyid_foreign` FOREIGN KEY (`electricitySupplyId`) REFERENCES `electricity_supplies` (`id`),
  ADD CONSTRAINT `connectivities_internetserviceproviderid_foreign` FOREIGN KEY (`internetServiceProviderId`) REFERENCES `service_providers` (`id`),
  ADD CONSTRAINT `connectivities_organizationid_foreign` FOREIGN KEY (`organizationId`) REFERENCES `organization_details` (`id`),
  ADD CONSTRAINT `connectivities_roadtypeid_foreign` FOREIGN KEY (`roadTypeId`) REFERENCES `road_types` (`id`),
  ADD CONSTRAINT `connectivities_telephoneserviceprovoderid_foreign` FOREIGN KEY (`telephoneServiceProvoderId`) REFERENCES `service_providers` (`id`);

--
-- Constraints for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD CONSTRAINT `contact_details_contacttypeid_foreign` FOREIGN KEY (`contactTypeId`) REFERENCES `contact_types` (`id`),
  ADD CONSTRAINT `contact_details_organizationid_foreign` FOREIGN KEY (`organizationId`) REFERENCES `organization_details` (`id`);

--
-- Constraints for table `equipment_and_furniture`
--
ALTER TABLE `equipment_and_furniture`
  ADD CONSTRAINT `equipment_and_furniture_organizationid_foreign` FOREIGN KEY (`organizationId`) REFERENCES `organization_details` (`id`);

--
-- Constraints for table `equipment_items`
--
ALTER TABLE `equipment_items`
  ADD CONSTRAINT `equipment_items_equipmenttype_foreign` FOREIGN KEY (`equipmentType`) REFERENCES `equipment_type` (`id`);

--
-- Constraints for table `infrastructures`
--
ALTER TABLE `infrastructures`
  ADD CONSTRAINT `infrastructures_categoryid_foreign` FOREIGN KEY (`categoryId`) REFERENCES `structure_category` (`id`),
  ADD CONSTRAINT `infrastructures_organizationid_foreign` FOREIGN KEY (`organizationId`) REFERENCES `organization_details` (`id`),
  ADD CONSTRAINT `infrastructures_subcategoryid_foreign` FOREIGN KEY (`subCategoryId`) REFERENCES `structure_sub_categories` (`id`);

--
-- Constraints for table `infrastructure_facilities`
--
ALTER TABLE `infrastructure_facilities`
  ADD CONSTRAINT `infrastructure_facilities_facilitytypeid_foreign` FOREIGN KEY (`facilityTypeId`) REFERENCES `structure_facility` (`id`),
  ADD CONSTRAINT `infrastructure_facilities_infrastructureid_foreign` FOREIGN KEY (`infrastructureId`) REFERENCES `infrastructures` (`id`);

--
-- Constraints for table `locations`
--
ALTER TABLE `locations`
  ADD CONSTRAINT `locations_organizationid_foreign` FOREIGN KEY (`organizationId`) REFERENCES `organization_details` (`id`);

--
-- Constraints for table `location_disaster_risks`
--
ALTER TABLE `location_disaster_risks`
  ADD CONSTRAINT `location_disaster_risks_disastertypeid_foreign` FOREIGN KEY (`disasterTypeId`) REFERENCES `disaster` (`id`),
  ADD CONSTRAINT `location_disaster_risks_locationid_foreign` FOREIGN KEY (`locationId`) REFERENCES `locations` (`id`);

--
-- Constraints for table `school_feedings`
--
ALTER TABLE `school_feedings`
  ADD CONSTRAINT `school_feedings_organizationid_foreign` FOREIGN KEY (`organizationId`) REFERENCES `organization_details` (`id`);

--
-- Constraints for table `sections-to-delete`
--
ALTER TABLE `sections-to-delete`
  ADD CONSTRAINT `sections_classid_foreign` FOREIGN KEY (`classId`) REFERENCES `classes` (`id`),
  ADD CONSTRAINT `sections_organizationid_foreign` FOREIGN KEY (`organizationId`) REFERENCES `organization_details` (`id`),
  ADD CONSTRAINT `sections_streamid_foreign` FOREIGN KEY (`streamId`) REFERENCES `streams` (`id`);

--
-- Constraints for table `section_details`
--
ALTER TABLE `section_details`
  ADD CONSTRAINT `section_details_classsectionid_foreign` FOREIGN KEY (`classSectionId`) REFERENCES `organization_class_streams` (`id`);

--
-- Constraints for table `sports`
--
ALTER TABLE `sports`
  ADD CONSTRAINT `sports_facility_foreign` FOREIGN KEY (`facility`) REFERENCES `sport_facility_type` (`id`),
  ADD CONSTRAINT `sports_organizationid_foreign` FOREIGN KEY (`organizationId`) REFERENCES `organization_details` (`id`),
  ADD CONSTRAINT `sports_supportedby_foreign` FOREIGN KEY (`supportedBy`) REFERENCES `sport_supporter` (`id`),
  ADD CONSTRAINT `sports_type_foreign` FOREIGN KEY (`type`) REFERENCES `sport_facility_subtypes` (`id`);

--
-- Constraints for table `structure_sub_categories`
--
ALTER TABLE `structure_sub_categories`
  ADD CONSTRAINT `structure_sub_categories_structurecategory_foreign` FOREIGN KEY (`structureCategory`) REFERENCES `structure_category` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
