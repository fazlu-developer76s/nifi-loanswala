-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Jul 29, 2025 at 06:33 PM
-- Server version: 8.0.43
-- PHP Version: 8.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nerasoft_dsa`
--

-- --------------------------------------------------------

--
-- Table structure for table `assignroutes`
--

CREATE TABLE `assignroutes` (
  `id` bigint UNSIGNED NOT NULL,
  `route_id` int NOT NULL,
  `user_id` int NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `assign_lead`
--

CREATE TABLE `assign_lead` (
  `id` int NOT NULL,
  `lead_id` int NOT NULL COMMENT 'loan_requests.id',
  `current_user_id` int NOT NULL COMMENT 'users.id',
  `assign_user_id` int NOT NULL COMMENT 'users.id',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assign_lead`
--

INSERT INTO `assign_lead` (`id`, `lead_id`, `current_user_id`, `assign_user_id`, `status`, `created_at`) VALUES
(1, 1, 145, 145, 1, '2025-01-11 17:16:03'),
(2, 1, 145, 144, 1, '2025-01-11 17:16:17'),
(3, 2, 145, 145, 1, '2025-01-26 15:03:41'),
(4, 3, 146, 146, 3, '2025-01-26 15:09:19'),
(5, 2, 145, 148, 1, '2025-01-26 15:13:30'),
(6, 3, 1, 145, 3, '2025-01-26 15:26:00'),
(7, 3, 1, 144, 3, '2025-01-26 15:26:14'),
(8, 3, 1, 148, 3, '2025-01-26 15:26:40'),
(9, 3, 146, 148, 1, '2025-02-11 17:24:17'),
(10, 3, 1, 150, 1, '2025-05-15 13:56:15');

-- --------------------------------------------------------

--
-- Table structure for table `cms_settings`
--

CREATE TABLE `cms_settings` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `logo` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `favicon` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` text COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `facebook` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `twitter` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `instagram` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `linkedin` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cms_settings`
--

INSERT INTO `cms_settings` (`id`, `name`, `logo`, `favicon`, `address`, `email`, `mobile`, `facebook`, `twitter`, `instagram`, `linkedin`, `created_at`, `updated_at`, `status`) VALUES
(1, 'LoansWala.com', 'logos/NdVOuUJCRWbJQ4w3LsV9IdDSc9vaJQhkNhuUctwN.jpg', 'favicons/j9catDecbR4GNuMudaJIq3AvT9qM21a2AVKeRdBY.jpg', 'Sahinoor ki Pahadi, Near BSNL office, Warispura Road,  Jhunjhunu 333001', 'info@loanswala.com', '9024262167', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', 'https://www.facebook.com/', '2024-10-16 10:32:37', '2025-05-15 15:35:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `copy`
--

CREATE TABLE `copy` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_request_id` int NOT NULL COMMENT 'loan_requests.id',
  `user_id` int DEFAULT NULL COMMENT 'user.id',
  `route_id` int NOT NULL COMMENT 'routes.id',
  `agent_id` int DEFAULT NULL COMMENT 'users.id',
  `file_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `son_of` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_work` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_address` text COLLATE utf8mb4_unicode_ci,
  `shop_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_address` text COLLATE utf8mb4_unicode_ci,
  `home_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_1_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_1_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_1_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_2_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_2_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_2_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processing_fees` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_docs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_docs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elec_bill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gurn_docs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `side_verify` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rc_vehicle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_status` tinyint NOT NULL DEFAULT '1' COMMENT '1-pending,2-submitd,3-approved,4-rejected',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-InActive,3-Deleted,4-Permanent deleted',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `dynamic_url`
--

CREATE TABLE `dynamic_url` (
  `id` int NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dynamic_url`
--

INSERT INTO `dynamic_url` (`id`, `url`, `name`, `created_at`, `updated_at`, `status`) VALUES
(1, 'lead.create', 'Add Lead', '2024-10-11 12:00:11', '2024-10-11 12:00:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `enquiry`
--

CREATE TABLE `enquiry` (
  `id` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `address` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `service_id` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `message` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enquiry`
--

INSERT INTO `enquiry` (`id`, `name`, `email`, `mobile`, `address`, `service_id`, `message`, `created_at`, `updated_at`, `status`) VALUES
(1, 'rahul kumar', 'rajbirsinghrs2002@gmail.com', '8677912595', 'noida', '1', '5 lakh', '2024-12-25 12:40:19', '2024-12-25 12:40:19', 1),
(2, 'TEST', 'test@gmail.com', '9929101621', 'sikar', '1', 'ok', '2024-12-25 13:10:39', '2024-12-25 13:10:39', 1),
(3, 'Ayush Gupta', 'first@gmail.com', '7428059960', '9/10 Shyam Nagar  Ambala Cantt', '1', 'sfsdfsdf', '2024-12-26 08:26:38', '2024-12-26 08:26:38', 1),
(4, 'dummy', 'test@gmail.com', '8742085506', 'sikar', '1', 'required 10 lakh', '2025-01-06 11:19:47', '2025-01-06 11:19:47', 1),
(5, 'Abhijit Dutta', 'abhijitdutta916@gmail.com', '6370202163', 'Bhimpura balasore,756019', '1', 'Aprove my home loan', '2025-03-11 01:18:34', '2025-03-11 01:18:34', 1),
(6, 'NISHANT SINGH TANWAR', 'Ksp2001nishant@gmail.com', '8742085506', 'KSP Consultancy Services', '5', 'Ok', '2025-05-11 09:20:40', '2025-05-11 09:20:40', 1),
(7, 'TEST', 'test@gmail.com', '6375757246', 'wfhvi', '7', 'iyhvj', '2025-05-15 12:49:37', '2025-05-15 12:49:37', 1),
(8, 'sarthak', 'sarthak.nerasoft@gmail.com', '8700682075', 'noida', '1', 'test', '2025-05-15 13:09:55', '2025-05-15 13:09:55', 1),
(9, 'fazlu', 'fazlu.developer@gmail.com', '7428059960', '9/10 Shyam Nagar Ambala Cantt', '1', 'test', '2025-05-15 13:26:36', '2025-05-15 13:26:36', 1),
(10, 'fazlu', 'fazlu.developer@gmail.com', '7428059960', '9/10 Shyam Nagar Ambala Cantt', '1', 'test', '2025-05-15 13:26:52', '2025-05-15 13:26:52', 1),
(11, 'Ttgg', 'Hvvbh@gmail.com', '6350298090', 'Jvvb', '5', 'Uhhvb', '2025-05-15 14:29:45', '2025-05-15 14:29:45', 1),
(12, 'Ttgg', 'Hvvbh@gmail.com', '6350298090', 'Jvvb', '5', 'Uhhvb', '2025-05-15 14:29:49', '2025-05-15 14:29:49', 1);

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kycs`
--

CREATE TABLE `kycs` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int NOT NULL COMMENT 'users.id',
  `loan_request_id` int NOT NULL COMMENT 'loan_request.id',
  `aadhar_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `pan_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `kyc_status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Pending,2-InProgress,3-Completed,4-Approved,5-Rejected',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Deactive,3-delete,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kyc_leads`
--

CREATE TABLE `kyc_leads` (
  `id` bigint UNSIGNED NOT NULL,
  `loan_request_id` int NOT NULL COMMENT 'loan_requests.id',
  `user_id` int DEFAULT NULL COMMENT 'user.id',
  `route_id` int NOT NULL COMMENT 'routes.id',
  `agent_id` int DEFAULT NULL COMMENT 'users.id',
  `file_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `customer_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `son_of` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type_of_work` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `shop_address` text COLLATE utf8mb4_unicode_ci,
  `shop_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `home_address` text COLLATE utf8mb4_unicode_ci,
  `home_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `material_status` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `sms_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_1_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_1_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_1_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_2_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_2_mobile` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `reference_2_relation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `processing_fees` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emi` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cheque` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_docs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_docs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `elec_bill` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_pic` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gurn_docs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `side_verify` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `rc_vehicle` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kyc_status` tinyint NOT NULL DEFAULT '1' COMMENT '1-pending,2-submitd,3-approved,4-rejected',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-InActive,3-Deleted,4-Permanent deleted',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `kyc_leads_guarantor`
--

CREATE TABLE `kyc_leads_guarantor` (
  `id` int NOT NULL,
  `kyc_id` int NOT NULL COMMENT 'kyc_leads.id',
  `name` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `son_of` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `type_of_work` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `shop_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `shop_type` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile_no_1` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `mobile_no_2` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `home_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `land_load` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `kyc_leads_guarantor`
--

INSERT INTO `kyc_leads_guarantor` (`id`, `kyc_id`, `name`, `son_of`, `type_of_work`, `shop_address`, `shop_type`, `mobile_no_1`, `mobile_no_2`, `home_address`, `land_load`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, 'first_g', 'first_p', 'full_tim_1', 'test', '1', 'te', 'tets', 'test', 'test', '2024-10-14 06:48:57', '2024-10-14 06:48:57', 1),
(2, 1, 'first_g', 'first_p', 'full_tim_1', 'test', '2', 'te', 'tets', 'test', 'test', '2024-10-14 06:48:57', '2024-10-14 06:48:57', 1);

-- --------------------------------------------------------

--
-- Table structure for table `kyc_reject_reasons`
--

CREATE TABLE `kyc_reject_reasons` (
  `id` int NOT NULL,
  `kyc_id` int NOT NULL COMMENT 'kyc_leads.id',
  `reason` text COLLATE utf8mb4_general_ci,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loans`
--

CREATE TABLE `loans` (
  `id` bigint UNSIGNED NOT NULL,
  `kyc_id` int NOT NULL COMMENT 'kyc_leads.id',
  `user_id` int DEFAULT NULL COMMENT 'users.id',
  `route_id` int DEFAULT NULL COMMENT 'route.id',
  `loan_number` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `amount` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rate_of_interest` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `frequency` tinyint NOT NULL DEFAULT '3' COMMENT '1-Day,2-Weekly,3-Monthly,4-Yearly',
  `tenure` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `process_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `file_charge` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_charges_1` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_charges_2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_charges_3` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_charges_4` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `other_charges_5` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disbrused_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `emi_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pending_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Pending,2-Approvad but not disbursed,3-Disbursed,4-Reject,5-Closed',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-InActive,3-Deleted,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `loan_requests`
--

CREATE TABLE `loan_requests` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int DEFAULT NULL COMMENT 'user.id',
  `created_user_id` int NOT NULL COMMENT 'users.id',
  `service_id` int NOT NULL COMMENT 'routes.id',
  `full_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `father_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_of_birth` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `residence_address` text COLLATE utf8mb4_unicode_ci,
  `state_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tehsil_taluka` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_amount` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `income` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `income_proof_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `res_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `res_long` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_lat` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_long` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_address` text COLLATE utf8mb4_unicode_ci,
  `business_state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_tehsil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_pin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `business_mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_lead_duplicate` tinyint NOT NULL DEFAULT '0' COMMENT '1-Duplicate , 0- original\r\n',
  `aadhar_front_docs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_back_docs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_card_docs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `voter_card_docs` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cibil_score` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cibil_doc_upload` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remark` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `loan_status` tinyint NOT NULL DEFAULT '1' COMMENT '1-pending,\r\n2-viewed,\r\n3-Under Process,\r\n4-Move to Lender,\r\n5-Sanction,\r\n6-Disbursed,\r\n7-rejected',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-InActive,3-Deleted,4-Permanent deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `loan_requests`
--

INSERT INTO `loan_requests` (`id`, `user_id`, `created_user_id`, `service_id`, `full_name`, `father_name`, `email`, `date_of_birth`, `residence_address`, `state_name`, `district_name`, `tehsil_taluka`, `pin_code`, `loan_amount`, `income`, `income_proof_name`, `res_lat`, `res_long`, `business_lat`, `business_long`, `business_address`, `business_state`, `business_district`, `business_tehsil`, `business_pin_code`, `business_mobile_no`, `is_lead_duplicate`, `aadhar_front_docs`, `aadhar_back_docs`, `pan_card_docs`, `voter_card_docs`, `cibil_score`, `cibil_doc_upload`, `remark`, `loan_status`, `created_at`, `updated_at`, `status`) VALUES
(1, 144, 145, 5, 'TEST', 'TEST', NULL, '2025-12-30', 'TEST', 'Andhra Pradesh', 'TEST', 'TEST', '333001', '1000000', '50000', 'SALARY SLIP', NULL, NULL, NULL, NULL, 'LOCAL', 'Meghalaya', 'TEST', 'TEST', '111222', '9809890980', 0, 'uploads/docs/D3MJCG7ygY9rM73ObXDbg9ZsADuL51UBiRVfpQkF.jpg', 'uploads/docs/BgPdaAbwhlQOUcMY9hPc4dwqa3KrU1L89zFTnEfG.jpg', 'uploads/docs/kZDnagydpAqIfIYN3331IcTSOdVqWL3xhkYXvvOE.jpg', 'uploads/docs/M0dtnWvwMn5DfEsFhD46QOZtYlbRduML41Wp56Np.jpg', 'NA', 'uploads/docs/CChiLA3aRsXJ84rR0KLvTSsxPvKTnpKVUJQxzk1q.jpg', 'OK', 7, '2025-01-11 17:16:03', '2025-01-11 17:18:09', 1),
(2, 148, 145, 1, 'chhirpola', 'asadad', NULL, '2001-03-12', 'Jhunjhunu', 'Rajasthan', 'Jhunjhunu', 'Jhunjhunu', '333001', '1000000', '30000', 'Salary Slip', NULL, NULL, NULL, NULL, 'Jhunjhunu', 'Rajasthan', 'Jhunjhunu', 'Jhunjhunu', '333001', '9876567890', 0, 'uploads/docs/PLpw0HniIJk42SwsR2ihaeN4nc0Dg8a8NNh9Qfl5.pdf', 'uploads/docs/igocPVVLRONNgKZWizG1bVPdm10MXHce1dGclQvH.pdf', 'uploads/docs/FdwirL3LA2L9xXxNzwrQsWvT7IOZBvv7yJWEfMu7.pdf', 'uploads/docs/Vo7rg6oR5WyJKOXk8055SMq4cFIs0Jse0nzJAOdG.pdf', '700', 'uploads/docs/btiIpEIFexxvQgxcYS2WRdV0j6AAWmbu0DWQTEkf.pdf', 'ok', 6, '2025-01-26 15:03:41', '2025-01-26 15:17:56', 1),
(3, 148, 146, 1, 'TESt', 'test', NULL, '1011-10-10', 'iusdhzj', 'Rajasthan', 'jhunjy', 'uhbscd', '333011', '1000000', '90', 'docs', NULL, NULL, NULL, NULL, 'jhhunjuh', 'Rajasthan', 'junjuhnu', 'jhhuhnuh', '300100', '9878987900', 0, 'uploads/docs/j0L4NY2gOMrvlZyWMGfRcwo6p5Gl39BzZ8Y9mQAZ.jpg', 'uploads/docs/RFDPSzX6gseQvCGEzb7bLehFQTgANsA9bKvyFidS.jpg', 'uploads/docs/KVRqJYN3mEpEjqoV5pxdF4ssNlfZY6WXoWZnzpHG.jpg', 'uploads/docs/M7lqGz83avVEtWuZIqV61kwGCTa0umU2EjoCZueL.jpg', 'na', 'uploads/docs/SW4tzWS4TtmtHETaqaubnZGSKIvPgaJ4E1bMD3JR.jpg', 'ok', 2, '2025-01-26 15:09:19', '2025-05-15 14:27:38', 1);

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2014_10_12_100000_create_password_resets_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2024_10_01_093153_create_role_models_table', 1),
(7, '2024_10_01_093231_create_roles_table', 1),
(8, '2024_10_03_174248_create_loan_requests_table', 2),
(9, '2024_10_07_170956_create_loans_table', 3);

-- --------------------------------------------------------

--
-- Table structure for table `notes`
--

CREATE TABLE `notes` (
  `id` int NOT NULL,
  `loan_request_id` int NOT NULL COMMENT 'loan_requests.id',
  `provider_id` int DEFAULT NULL,
  `user_id` int NOT NULL COMMENT 'users.id\r\n',
  `loan_status` tinyint NOT NULL DEFAULT '1' COMMENT '	1-pending,2-viewed,3-Under Discussion,4-pending for kyc,5-qualified,6-rejected,7-Lead Assign',
  `title` text COLLATE utf8mb4_general_ci NOT NULL,
  `loan_amount` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `file` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notes`
--

INSERT INTO `notes` (`id`, `loan_request_id`, `provider_id`, `user_id`, `loan_status`, `title`, `loan_amount`, `file`, `created_at`, `updated_at`, `status`) VALUES
(1, 1, NULL, 145, 1, 'Create Lead', NULL, NULL, '2025-01-11 17:16:03', '2025-01-11 17:16:03', 1),
(2, 1, NULL, 145, 8, 'Lead Assign To Fazlu Rehman', NULL, NULL, '2025-01-11 17:16:17', '2025-01-11 17:16:17', 1),
(3, 1, NULL, 145, 2, 'View Lead', NULL, NULL, '2025-01-11 17:16:35', '2025-01-11 17:16:35', 1),
(4, 1, NULL, 145, 3, 'Under Processing', NULL, NULL, '2025-01-11 17:16:43', '2025-01-11 17:16:43', 1),
(5, 1, NULL, 1, 2, 'View Lead', NULL, NULL, '2025-01-11 17:18:09', '2025-01-11 17:18:09', 1),
(6, 1, NULL, 1, 3, 'Under Processing', NULL, NULL, '2025-01-11 17:18:32', '2025-01-11 17:18:32', 1),
(7, 1, 2, 1, 5, 'OK', '1000000', NULL, '2025-01-11 17:20:27', '2025-01-11 17:20:27', 1),
(8, 2, NULL, 145, 1, 'Create Lead', NULL, NULL, '2025-01-26 15:03:41', '2025-01-26 15:03:41', 1),
(9, 3, NULL, 146, 1, 'Create Lead', NULL, NULL, '2025-01-26 15:09:19', '2025-01-26 15:09:19', 3),
(10, 3, NULL, 146, 2, 'View Lead', NULL, NULL, '2025-01-26 15:10:03', '2025-01-26 15:10:03', 3),
(11, 2, NULL, 145, 2, 'View Lead', NULL, NULL, '2025-01-26 15:12:12', '2025-01-26 15:12:12', 1),
(12, 2, NULL, 145, 3, 'Under Processing', NULL, NULL, '2025-01-26 15:12:21', '2025-01-26 15:12:21', 1),
(13, 2, 4, 145, 4, 'jkhgf mb', '1000000', NULL, '2025-01-26 15:12:56', '2025-01-26 15:12:56', 1),
(14, 2, NULL, 145, 8, 'Lead Assign To Jhandu', NULL, NULL, '2025-01-26 15:13:30', '2025-01-26 15:13:30', 1),
(15, 2, NULL, 148, 2, 'View Lead', NULL, NULL, '2025-01-26 15:14:26', '2025-01-26 15:14:26', 1),
(16, 2, NULL, 148, 3, 'Under Processing', NULL, NULL, '2025-01-26 15:14:36', '2025-01-26 15:14:36', 1),
(17, 2, 1, 148, 5, 'ok', '1000000', 'notes/T9CS6SToBBn5yhu1vZNYCjXDSIjmkzpzcw2lAEAi.jpg', '2025-01-26 15:15:03', '2025-01-26 15:15:03', 1),
(18, 2, 1, 148, 5, 'ok', '1000000', 'notes/yx9407IJj61uQwbT6MTzBm6GOZ8sRV89nLjei0Lg.jpg', '2025-01-26 15:15:03', '2025-01-26 15:15:03', 1),
(19, 2, 1, 148, 7, 'ok', '1000000', NULL, '2025-01-26 15:16:01', '2025-01-26 15:16:01', 1),
(20, 2, NULL, 1, 2, 'View Lead', NULL, NULL, '2025-01-26 15:17:56', '2025-01-26 15:17:56', 1),
(21, 2, NULL, 1, 3, 'Under Processing', NULL, NULL, '2025-01-26 15:18:01', '2025-01-26 15:18:01', 1),
(22, 2, 1, 148, 6, 'ok', '1000000', 'notes/JyBJbSHj6uefLS2z6gknq7xcRjnJHQDQ0osEyUMY.jpg', '2025-01-26 15:21:02', '2025-01-26 15:21:02', 1),
(23, 3, NULL, 1, 2, 'View Lead', NULL, NULL, '2025-01-26 15:23:25', '2025-01-26 15:23:25', 3),
(24, 3, NULL, 1, 3, 'Under Processing', NULL, NULL, '2025-01-26 15:23:31', '2025-01-26 15:23:31', 3),
(25, 3, NULL, 1, 8, 'Lead Assign To Pooja', NULL, NULL, '2025-01-26 15:26:00', '2025-01-26 15:26:00', 3),
(26, 3, NULL, 1, 8, 'Lead Assign To Fazlu Rehman', NULL, NULL, '2025-01-26 15:26:14', '2025-01-26 15:26:14', 3),
(27, 3, NULL, 1, 8, 'Lead Assign To Jhandu', NULL, NULL, '2025-01-26 15:26:40', '2025-01-26 15:26:40', 3),
(28, 3, NULL, 148, 2, 'View Lead', NULL, NULL, '2025-01-26 15:27:34', '2025-01-26 15:27:34', 3),
(29, 3, NULL, 148, 3, 'Under Processing', NULL, NULL, '2025-01-26 15:27:43', '2025-01-26 15:27:43', 3),
(30, 3, 1, 148, 6, 'ok', '1000000', 'notes/VBlVKDBhRuTotRBnNSpylaEdkmscqVM8MJnczs8Y.jpg', '2025-01-26 15:28:41', '2025-01-26 15:28:41', 3),
(31, 3, 1, 1, 7, 'ok', '1000000', NULL, '2025-02-11 17:23:58', '2025-02-11 17:23:58', 3),
(32, 3, NULL, 146, 8, 'Lead Assign To Jhandu', NULL, NULL, '2025-02-11 17:24:17', '2025-02-11 17:24:17', 1),
(33, 1, 1, 1, 7, 're', '1000000', NULL, '2025-05-15 12:58:11', '2025-05-15 12:58:11', 1),
(34, 8, NULL, 1, 1, 'Create Lead', NULL, NULL, '2025-05-15 13:10:01', '2025-05-15 13:10:01', 1),
(35, 10, NULL, 1, 1, 'Create Lead', NULL, NULL, '2025-05-15 13:26:56', '2025-05-15 13:26:56', 1),
(36, 3, NULL, 1, 8, 'Lead Assign To dummy', NULL, NULL, '2025-05-15 13:56:15', '2025-05-15 13:56:15', 1),
(37, 3, NULL, 1, 2, 'View Lead', NULL, NULL, '2025-05-15 14:27:38', '2025-05-15 14:27:38', 1),
(38, 11, NULL, 1, 1, 'Create Lead', NULL, NULL, '2025-05-15 14:29:50', '2025-05-15 14:29:50', 1),
(39, 12, NULL, 1, 1, 'Create Lead', NULL, NULL, '2025-05-15 14:29:53', '2025-05-15 14:29:53', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `password_reset_tokens`
--

INSERT INTO `password_reset_tokens` (`email`, `token`, `created_at`) VALUES
('Ksp2001nishant@gmail.com', '$2y$10$iYyejd12IDN11InTZoQSTOShVJQFKVGLxeLFPG9rKjF7fH6Kj.oga', '2024-11-29 16:01:47'),
('kspsmartindia@gmail.com', '$2y$10$5gnYNtl93vdMqilK8gyCUO4ndCKSBK7c6y3wPndqp7pz5AOA8aghC', '2025-05-15 14:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Create User', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(2, 'Edit User', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(3, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(4, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(5, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(6, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(7, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(8, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(9, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(10, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(11, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(12, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(13, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(14, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(15, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(16, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(17, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(18, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(19, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(20, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(21, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(22, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21'),
(23, 'Create Lead', 1, '2024-10-03 10:26:18', '2024-10-03 10:26:21');

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `providers`
--

CREATE TABLE `providers` (
  `id` bigint UNSIGNED NOT NULL,
  `route` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `providers`
--

INSERT INTO `providers` (`id`, `route`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, NULL, 'HDFC', 1, '2024-11-08 06:41:14', '2024-11-08 06:41:14'),
(2, NULL, 'KOTAK', 1, '2024-11-08 06:41:18', '2024-11-08 06:41:18'),
(3, NULL, 'SBI', 1, '2024-11-18 10:23:51', '2024-11-18 10:23:56'),
(4, NULL, 'HDFC', 1, '2024-11-18 10:24:00', '2024-11-18 10:24:00'),
(5, NULL, 'ICICI', 1, '2024-11-18 10:24:06', '2024-11-18 10:24:06'),
(6, NULL, 'PNB', 1, '2024-11-18 10:24:40', '2024-11-18 10:24:40'),
(7, NULL, 'AXIS', 1, '2025-01-09 15:31:01', '2025-01-09 15:31:01');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, '2024-10-11 13:49:34', '2024-11-07 05:42:51'),
(5, 'Lead Manager', 1, '2024-10-11 13:49:34', '2024-11-07 05:42:51'),
(6, 'Freelancer', 1, '2024-11-28 11:46:45', '2024-11-28 11:46:49'),
(7, 'Banker', 1, '2024-11-28 11:46:54', '2024-11-28 11:46:51');

-- --------------------------------------------------------

--
-- Table structure for table `role_models`
--

CREATE TABLE `role_models` (
  `id` bigint UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_permission`
--

CREATE TABLE `role_permission` (
  `id` int NOT NULL,
  `role_id` int NOT NULL COMMENT 'roles.id',
  `permission_id` int DEFAULT NULL COMMENT 'permission.id',
  `permission_status` tinyint NOT NULL DEFAULT '2' COMMENT '1-True,2-False',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_permission`
--

INSERT INTO `role_permission` (`id`, `role_id`, `permission_id`, `permission_status`, `created_at`, `status`) VALUES
(1, 4, 1, 1, '2024-10-03 12:43:37', 1),
(2, 4, 2, 1, '2024-10-03 12:43:37', 1),
(3, 4, 3, 1, '2024-10-03 12:43:37', 1),
(4, 4, 4, 1, '2024-10-03 12:43:37', 1),
(5, 4, 5, 1, '2024-10-03 12:43:37', 1),
(6, 4, 6, 1, '2024-10-03 12:43:37', 1),
(7, 4, 7, 1, '2024-10-03 12:43:37', 1),
(8, 4, 8, 1, '2024-10-03 12:43:37', 1),
(9, 4, 9, 1, '2024-10-03 12:43:37', 1),
(10, 4, 10, 1, '2024-10-03 12:43:37', 1),
(11, 4, 11, 1, '2024-10-03 12:43:37', 1),
(12, 4, 12, 1, '2024-10-03 12:43:37', 1),
(13, 4, 13, 1, '2024-10-03 12:43:37', 1),
(14, 4, 14, 1, '2024-10-03 12:43:37', 1),
(15, 4, 15, 1, '2024-10-03 12:43:37', 1),
(16, 4, 16, 1, '2024-10-03 12:43:37', 1),
(17, 4, 17, 1, '2024-10-03 12:43:37', 1),
(18, 4, 18, 1, '2024-10-03 12:43:37', 1),
(19, 4, 19, 1, '2024-10-03 12:43:37', 1),
(20, 4, 20, 2, '2024-10-03 12:43:37', 1),
(21, 4, 21, 1, '2024-10-03 12:43:37', 1),
(22, 4, 22, 1, '2024-10-03 12:43:37', 1),
(23, 4, 23, 1, '2024-10-03 12:43:37', 1);

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `title`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Home Loan', 1, '2024-11-08 06:41:02', '2024-11-08 06:41:02'),
(2, 'Business Loan', 1, '2024-11-08 06:41:06', '2024-11-08 06:41:06'),
(3, 'Car Loan', 1, '2024-11-18 10:06:18', '2024-11-18 10:23:42'),
(4, 'Mortgage Loan', 3, '2024-11-18 10:24:58', '2024-12-09 04:44:29'),
(5, 'Loan Against Property', 1, '2024-12-09 04:45:06', '2024-12-09 04:45:06'),
(6, 'Commercial Vehicle Loan', 1, '2024-12-09 04:45:45', '2025-01-09 16:39:33'),
(7, 'Industrial Loan', 1, '2024-12-09 04:46:38', '2025-01-09 16:39:34'),
(8, 'Overdraft Limit', 1, '2024-12-09 04:46:54', '2025-01-09 16:39:36'),
(9, 'Credit Card', 1, '2024-12-09 04:47:01', '2025-01-09 16:39:37');

-- --------------------------------------------------------

--
-- Table structure for table `routezips`
--

CREATE TABLE `routezips` (
  `id` bigint UNSIGNED NOT NULL,
  `route_id` int NOT NULL COMMENT 'routes.id',
  `zip_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Deleted,4-Permanent Deleted',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routezips`
--

INSERT INTO `routezips` (`id`, `route_id`, `zip_code`, `status`, `created_at`, `updated_at`) VALUES
(1, 2, '110094', 1, '2024-10-14 05:09:11', '2024-10-14 05:09:11'),
(2, 2, '110095', 1, '2024-10-14 05:09:18', '2024-10-14 05:09:18'),
(3, 1, '110006', 1, '2024-10-14 05:09:23', '2024-10-14 05:09:23'),
(4, 1, '110001', 1, '2024-10-14 05:09:28', '2024-10-14 05:09:28'),
(5, 1, '110002', 1, '2024-10-14 06:24:38', '2024-10-14 06:24:38');

-- --------------------------------------------------------

--
-- Table structure for table `route_logs`
--

CREATE TABLE `route_logs` (
  `id` bigint UNSIGNED NOT NULL,
  `route_assign_id` int NOT NULL COMMENT 'assignroutes.id',
  `user_id` int NOT NULL COMMENT 'users.id',
  `route_id` int NOT NULL COMMENT 'routes.id',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `status` tinyint DEFAULT '1' COMMENT '1-Active,2-Inactive,3-Delete,4-Permanent Delete'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_logs`
--

CREATE TABLE `tbl_logs` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL COMMENT 'users.id',
  `subject` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `data` text COLLATE utf8mb4_general_ci NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `method` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `ip_address` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` int NOT NULL COMMENT '1-Active,2-DeActive,3-Deleted,4-Permanent Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_otp`
--

CREATE TABLE `tbl_otp` (
  `id` int NOT NULL,
  `user_id` int DEFAULT NULL COMMENT 'user.id',
  `otp` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` int NOT NULL DEFAULT '1' COMMENT '1-Active,2-Expired',
  `module_type` tinyint NOT NULL DEFAULT '1' COMMENT '1-Login,3-register,2-enquiry',
  `otp_type` tinyint NOT NULL DEFAULT '1' COMMENT '1-Mobile, 2-Email',
  `field_value` varchar(255) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_otp`
--

INSERT INTO `tbl_otp` (`id`, `user_id`, `otp`, `status`, `module_type`, `otp_type`, `field_value`, `created_at`, `updated_at`) VALUES
(1, NULL, '5067', 2, 2, 1, '7428059960', '2024-12-25 12:23:38', '2024-12-25 12:23:38'),
(2, 119, '1940', 1, 2, 1, '8585858585', '2024-12-25 12:24:24', '2024-12-25 12:24:24'),
(3, 120, '5577', 2, 2, 1, '7428059960', '2024-12-25 12:29:13', '2024-12-25 12:29:13'),
(4, NULL, '5372', 1, 2, 1, '8677912595', '2024-12-25 12:38:38', '2024-12-25 12:38:38'),
(5, NULL, '1478', 2, 2, 1, '8677912595', '2024-12-25 12:40:09', '2024-12-25 12:40:09'),
(6, 121, '4094', 2, 2, 1, '8677912595', '2024-12-25 12:41:34', '2024-12-25 12:41:34'),
(7, NULL, '2079', 2, 2, 1, '9929101621', '2024-12-25 13:09:23', '2024-12-25 13:09:23'),
(8, 122, '3603', 2, 2, 1, '9929101621', '2024-12-25 13:12:52', '2024-12-25 13:12:52'),
(9, 123, '1493', 1, 2, 1, '7428059960', '2024-12-25 13:52:07', '2024-12-25 13:52:07'),
(10, 124, '9826', 1, 2, 1, '7428059960', '2024-12-25 13:52:32', '2024-12-25 13:52:32'),
(11, 125, '2616', 1, 2, 1, '7428059960', '2024-12-25 13:53:15', '2024-12-25 13:53:15'),
(12, NULL, '8317', 2, 2, 1, '7428059960', '2024-12-26 08:26:26', '2024-12-26 08:26:26'),
(13, 128, '6634', 2, 2, 1, '7428059960', '2024-12-26 08:27:00', '2024-12-26 08:27:00'),
(14, 130, '9897', 2, 2, 1, '9929101621', '2024-12-27 07:23:46', '2024-12-27 07:23:46'),
(15, NULL, '5910', 1, 2, 1, '8742085506', '2025-01-06 11:19:05', '2025-01-06 11:19:05'),
(16, NULL, '3931', 2, 2, 1, '8742085506', '2025-01-06 11:19:06', '2025-01-06 11:19:06'),
(17, 131, '4463', 2, 2, 1, '7428059960', '2025-01-07 07:29:01', '2025-01-07 07:29:01'),
(18, 133, '8909', 2, 2, 1, '6375757246', '2025-01-07 12:54:06', '2025-01-07 12:54:06'),
(19, 139, '9379', 2, 2, 1, '7428059960', '2025-01-08 12:20:18', '2025-01-08 12:20:18'),
(20, 144, '1952', 2, 2, 1, '7428059960', '2025-01-09 13:17:57', '2025-01-09 13:17:57'),
(21, 145, '4447', 2, 2, 1, '9929101621', '2025-01-11 17:09:15', '2025-01-11 17:09:15'),
(22, 146, '4938', 2, 2, 1, '6350298090', '2025-01-16 15:17:37', '2025-01-16 15:17:37'),
(23, NULL, '3023', 1, 2, 1, '6370202163', '2025-03-11 01:16:59', '2025-03-11 01:16:59'),
(24, NULL, '3307', 1, 2, 1, '6370202163', '2025-03-11 01:18:32', '2025-03-11 01:18:32'),
(25, NULL, '7340', 1, 2, 1, '8742085506', '2025-05-11 09:20:25', '2025-05-11 09:20:25'),
(26, 150, '4047', 2, 2, 1, '6375757246', '2025-05-15 12:42:21', '2025-05-15 12:42:21'),
(27, NULL, '1606', 1, 2, 1, '6375757246', '2025-05-15 12:48:29', '2025-05-15 12:48:29'),
(28, NULL, '7631', 1, 2, 1, '6375757246', '2025-05-15 12:49:25', '2025-05-15 12:49:25'),
(29, NULL, '7391', 1, 2, 1, '1010101010', '2025-05-15 13:09:01', '2025-05-15 13:09:01'),
(30, NULL, '5953', 2, 2, 1, '8700682075', '2025-05-15 13:09:38', '2025-05-15 13:09:38'),
(31, NULL, '3310', 2, 2, 1, '7428059960', '2025-05-15 13:25:58', '2025-05-15 13:25:58'),
(32, NULL, '8456', 1, 2, 1, '9929101621', '2025-05-15 14:28:35', '2025-05-15 14:28:35'),
(33, NULL, '9034', 2, 2, 1, '6350298090', '2025-05-15 14:29:31', '2025-05-15 14:29:31'),
(34, 151, '5743', 2, 2, 1, '6350298090', '2025-05-15 14:31:15', '2025-05-15 14:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_token`
--

CREATE TABLE `tbl_token` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'users.id',
  `token` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-Expire',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_token`
--

INSERT INTO `tbl_token` (`id`, `user_id`, `token`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3Mjc5NTI3NTQsImV4cCI6MTcyNzk1NjM1NH0.GBcIca3ONLCsKR2O1zgVtouOKyXH5PG9NTh432fqeEc', 2, '2024-10-03 10:52:34', '2024-10-03 10:52:34'),
(2, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3Mjc5NTM0MjIsImV4cCI6MTcyNzk1NzAyMn0.OmImpidh3vYKwORRSuHlg0qBXwc5shjdeG2UyXo-ld4', 2, '2024-10-03 11:03:42', '2024-10-03 11:03:42'),
(3, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3Mjc5NTU1OTAsImV4cCI6MTcyNzk1OTE5MH0.kTkpGkQypRvPTjV4y6GpjEzkle1eJ37XIWbfIChZa2A', 2, '2024-10-03 11:39:50', '2024-10-03 11:40:09'),
(4, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3Mjc5NTYyNTMsImV4cCI6MTcyNzk1OTg1M30.r4UK9s6AO4ieP4zyUyvw83rFUn1Q76VQKn0TGN-S_aw', 2, '2024-10-03 11:50:53', '2024-10-03 13:04:49'),
(5, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3Mjc5NjA2ODksImV4cCI6MTcyNzk2NDI4OX0.wX3tTJm2ihuooaDRH75THI1wZoXqcUa5aUCIfKSKQzc', 2, '2024-10-03 13:04:49', '2024-10-04 10:09:37'),
(6, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgwMzY1NzcsImV4cCI6MTcyODA0MDE3N30.FABgodaEJXMIeV000-5WQtkMDOSzp9tvc-8HY9oj_iI', 2, '2024-10-04 10:09:37', '2024-10-04 11:43:49'),
(7, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgwNDIyMjksImV4cCI6MTcyODA0NTgyOX0.Y7PFuv3kTudcAyyxSSfvnQHPZGrGyI-nJSscyvC_vLw', 2, '2024-10-04 11:43:49', '2024-10-04 13:36:55'),
(8, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgwNDkwMTUsImV4cCI6MTcyODA1MjYxNX0.0tk4FKpYWjOaRt5y6qlF5knDADZRW3-KH4YNMNRnqrc', 2, '2024-10-04 13:36:55', '2024-10-07 05:26:43'),
(9, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgyNzg4MDMsImV4cCI6MTcyODI4MjQwM30.9gYq4taDnn2kFCsKTsGr8YOLkAbmBySlU76LLCHQLDI', 2, '2024-10-07 05:26:43', '2024-10-07 06:35:18'),
(10, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgyODI5MTgsImV4cCI6MTcyODI4NjUxOH0.gHg4FINvNkZNvgWXFZ7E8V4hdnELJ416aFKO4R7Utsk', 2, '2024-10-07 06:35:18', '2024-10-07 07:45:39'),
(11, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgyODcxMzksImV4cCI6MTcyODI5MDczOX0.cVfXOH4rF1wHWO8o4A9PaVUTYmRBPT2jwuAjhNDcCz4', 2, '2024-10-07 07:45:39', '2024-10-07 09:06:07'),
(12, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgyOTE5NjcsImV4cCI6MTcyODI5NTU2N30.Yyx7T5APDnlg2DnrBJwdrWx2pFmuXj1P_WJy0xut4qU', 2, '2024-10-07 09:06:07', '2024-10-07 10:12:08'),
(13, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgyOTU5MjgsImV4cCI6MTcyODI5OTUyOH0.dXmmIiIDlMw1-EKjKufbAkPGZx-Ny0V5LN8LvOzfNoQ', 2, '2024-10-07 10:12:08', '2024-10-07 11:22:46'),
(14, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgzMDAxNjYsImV4cCI6MTcyODMwMzc2Nn0.NAAcm9OMQPJ2jcha34VbeJhYKhYoNp6Kt7iaF0FUybc', 2, '2024-10-07 11:22:46', '2024-10-07 12:24:09'),
(15, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjoxLCJpYXQiOjE3MjgzMDM4NDksImV4cCI6MTcyODMwNzQ0OX0.fbzx6CdLV8Vm9s4qvOf-iuEGSOGBpF0qTjDUpS3ESlg', 2, '2024-10-07 12:24:09', '2024-10-09 10:34:02'),
(16, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpc3MiOiJ5b3VyLWFwcGxpY2F0aW9uIiwic3ViIjozLCJpYXQiOjE3MjgzNzIyNzgsImV4cCI6MTcyODM3NTg3OH0.I-_xiFH-GtEf8u-CFU7nCpocWS0-z1Fo8Wp2zYKki-Q', 2, '2024-10-08 07:24:38', '2024-10-08 07:36:56'),
(17, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3MzAxNiwiZXhwIjoxNzI4Mzc2NjE2fQ.lnp5qVM_KyOz0rqPgU3INExmcB580Tg32_6-pXXFCE0', 2, '2024-10-08 07:36:56', '2024-10-08 07:39:11'),
(18, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3MzE1MSwiZXhwIjoxNzI4Mzc2NzUxfQ.iMAJxSESjyTYjsfVOlRgG_JgtCvalKWFE-SrPITw75M', 2, '2024-10-08 07:39:11', '2024-10-08 07:46:55'),
(19, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3MzYxNSwiZXhwIjoxNzI4Mzc3MjE1fQ.wI5nO2elMcttMhiOEkjzAbOfBBA7tvLv5nAVM7DDmhk', 2, '2024-10-08 07:46:55', '2024-10-08 07:51:51'),
(20, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3MzkxMSwiZXhwIjoxNzI4Mzc3NTExfQ.nIcxr03wujbXGtoqlHyN45M8iq3q225BmGTCf5JNTNw', 2, '2024-10-08 07:51:51', '2024-10-08 07:59:56'),
(21, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3NDM5NiwiZXhwIjoxNzI4Mzc3OTk2fQ.Wnm6g1jamdFkhk3tVSmV6WMwr39lCORctq0ZXwN9hF4', 2, '2024-10-08 07:59:56', '2024-10-08 08:50:24'),
(22, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3NzQyNCwiZXhwIjoxNzI4MzgxMDI0fQ.mBrTvLiIQnGq5M1nErcBbnLhP6_x4suvDf5LXk8zYoE', 2, '2024-10-08 08:50:24', '2024-10-08 08:52:36'),
(23, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3NzU1NiwiZXhwIjoxNzI4MzgxMTU2fQ.-LOGAPHk77mFo-Il-aVUD84H5nacRQ_SaSkSL74Fn_k', 2, '2024-10-08 08:52:36', '2024-10-08 08:58:07'),
(24, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3Nzg4NywiZXhwIjoxNzI4MzgxNDg3fQ.jbhjEkqWrDG5QVBGuhBSoSBP-A6eQoO92QNUACZ-wYg', 2, '2024-10-08 08:58:07', '2024-10-08 08:59:30'),
(25, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3Nzk3MCwiZXhwIjoxNzI4MzgxNTcwfQ.LtlmcedO61-VdfrITwGQAxN-ybBqTTSBIWrXse5Uh3c', 2, '2024-10-08 08:59:30', '2024-10-08 09:19:43'),
(26, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTE4MywiZXhwIjoxNzI4MzgyNzgzfQ.tF_2K2cd8jO_ad3V1KaoACfPzogT37mVvwsqc8MY1OE', 2, '2024-10-08 09:19:43', '2024-10-08 09:20:13'),
(27, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTIxMywiZXhwIjoxNzI4MzgyODEzfQ.A4qCEHEu2FguhhDXwu2FLzQMohvwjWRJr7J8sMBA5HE', 2, '2024-10-08 09:20:13', '2024-10-08 09:22:02'),
(28, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTMyMiwiZXhwIjoxNzI4MzgyOTIyfQ.SOEA4t6_hAqpvT8IeMx-ilf4uXOGOMYUUr5vs2TEzpQ', 2, '2024-10-08 09:22:02', '2024-10-08 09:22:21'),
(29, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTM0MSwiZXhwIjoxNzI4MzgyOTQxfQ.yamV7X9EeMKWQh9mjrQbONqjbVOpXc425butegq90GM', 2, '2024-10-08 09:22:21', '2024-10-08 09:23:57'),
(30, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTQzNywiZXhwIjoxNzI4MzgzMDM3fQ.fH5Nk0Ry6LetXpQ6IsqZbIadhnrXicI0tR1CQrkuaKs', 2, '2024-10-08 09:23:57', '2024-10-08 09:25:05'),
(31, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTUwNSwiZXhwIjoxNzI4MzgzMTA1fQ.snUApfRdLeWXHWX8e3PljCKlRwgz4OetUx-pERl5Hqc', 2, '2024-10-08 09:25:05', '2024-10-08 09:28:11'),
(32, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTY5MSwiZXhwIjoxNzI4MzgzMjkxfQ.KNdrL3FT4vYDGtZtZqiN_3MHv4CpoLETNqB85fnuYYs', 2, '2024-10-08 09:28:11', '2024-10-08 09:30:34'),
(33, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTgzNCwiZXhwIjoxNzI4MzgzNDM0fQ.HZin7Zglup4sFa_lfRTGukrNFhp5oVr_Sxh8AcGlLQI', 2, '2024-10-08 09:30:34', '2024-10-08 09:31:50'),
(34, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTkxMCwiZXhwIjoxNzI4MzgzNTEwfQ.b6qZIY_pR59kzRiqdvcdlXmhqH7WnEGeoxS0HsLorik', 2, '2024-10-08 09:31:50', '2024-10-08 09:32:30'),
(35, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTk1MCwiZXhwIjoxNzI4MzgzNTUwfQ.OPYzv7_FAm24dWr6Vs4J9E3fSXG0ooo690GudEAzoIc', 2, '2024-10-08 09:32:30', '2024-10-08 09:32:42'),
(36, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM3OTk2MiwiZXhwIjoxNzI4MzgzNTYyfQ.RsKIVgqSo0reK9Qx3yvAaGrS38EcD0ZEO0XE6EArwpU', 2, '2024-10-08 09:32:42', '2024-10-08 09:47:28'),
(37, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4MDg0OCwiZXhwIjoxNzI4Mzg0NDQ4fQ.ZbpGgYBDPM5xxqWS9GPQItf5SI-oPQceEALAEx4oIpE', 2, '2024-10-08 09:47:28', '2024-10-08 10:04:48'),
(38, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4MTg4OCwiZXhwIjoxNzI4Mzg1NDg4fQ.RRSthqfRCTAx1ufAk3gjbhm1tbuoEnN52YDH84g8KvU', 2, '2024-10-08 10:04:48', '2024-10-08 11:05:20'),
(39, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4NTUyMCwiZXhwIjoxNzI4Mzg5MTIwfQ.vwB8a34KgC7ynvANOdk37ZjhnRQ4SKisa2nZgrsh1sc', 2, '2024-10-08 11:05:20', '2024-10-08 11:50:08'),
(40, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4ODMwOCwiZXhwIjoxNzI4MzkxOTA4fQ.snB6JGWEmlJXVgx1oPNF7YAXDuYVHkeaYX5kRAphzf4', 2, '2024-10-08 11:51:48', '2024-10-08 12:04:10'),
(41, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4OTA1MCwiZXhwIjoxNzI4MzkyNjUwfQ.lbi0O5Yb073U-hNiGWZNegp9nr6qq9DM6no0AOVkPEs', 2, '2024-10-08 12:04:10', '2024-10-08 12:04:52'),
(42, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4OTA5MiwiZXhwIjoxNzI4MzkyNjkyfQ.0CyppAxpTGpVmnvznVie3ngkdctpi2jfYUpK1mNKfbE', 2, '2024-10-08 12:04:52', '2024-10-08 12:06:13'),
(43, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM4OTE3MywiZXhwIjoxNzI4MzkyNzczfQ.zfe0TuoaUjdM3zsYWf1nBKSwRzLM8T7RJcWjR2Ihnc8', 2, '2024-10-08 12:06:13', '2024-10-08 12:20:32'),
(44, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MDQxOCwiZXhwIjoxNzI4Mzk0MDE4fQ.A1nhzbLRSw6XY_WFl4anv22aOEVnG4fkH7zykCY4-l8', 2, '2024-10-08 12:26:58', '2024-10-08 12:28:26'),
(45, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MDUwNiwiZXhwIjoxNzI4Mzk0MTA2fQ.v-XCzE4l12XCpdNp7-VMyT37rYuMsKMmZWUTRKlnLSg', 2, '2024-10-08 12:28:26', '2024-10-08 12:29:43'),
(46, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MDU4MywiZXhwIjoxNzI4Mzk0MTgzfQ.ChXsZUn6ILug8IM6impCdBu1yVjAp7HNz9pvT0ZRcEA', 2, '2024-10-08 12:29:43', '2024-10-08 12:37:07'),
(47, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTAyNywiZXhwIjoxNzI4Mzk0NjI3fQ.xaoymZOnVYQCELVN7YVNUSzSoTu2VzGgYVEXaR62NRg', 2, '2024-10-08 12:37:07', '2024-10-08 12:37:38'),
(48, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTA4NCwiZXhwIjoxNzI4Mzk0Njg0fQ.HuOlv_83OMPFuQJjpCXpBPXZk8jMSXSUrX-MyyxAFf8', 2, '2024-10-08 12:38:04', '2024-10-08 12:39:12'),
(49, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTE3MSwiZXhwIjoxNzI4Mzk0NzcxfQ.bDqDF8Bc_vUDOe-1SKgvmhq-pxT0jZgeZRqwfGwPkJk', 2, '2024-10-08 12:39:31', '2024-10-08 12:40:45'),
(50, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTI1OSwiZXhwIjoxNzI4Mzk0ODU5fQ.SlQVKo25LwYenZrdpMW4HMpQj0q0oy0cSUFGZD9y9ng', 2, '2024-10-08 12:40:59', '2024-10-08 12:45:23'),
(51, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTU4NywiZXhwIjoxNzI4Mzk1MTg3fQ.4WNjudCstDXBxfAydJKkjjV6VLI1kZl3hBOClNx5DPs', 2, '2024-10-08 12:46:27', '2024-10-08 12:47:06'),
(52, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTYzNiwiZXhwIjoxNzI4Mzk1MjM2fQ.h_77J0TXdhvCPEp1rJhI6W_sg3usoqW5eehGpaDl9cE', 2, '2024-10-08 12:47:16', '2024-10-08 12:48:03'),
(53, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTY5MywiZXhwIjoxNzI4Mzk1MjkzfQ.9dWebJJZ1zIB2_SdExJErqstcT0Ub4Xkmn7JBw9WU4c', 2, '2024-10-08 12:48:13', '2024-10-08 12:48:33'),
(54, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTc1OCwiZXhwIjoxNzI4Mzk1MzU4fQ.1yDRUeLs-_j7c_ZCvmlRXiuQrV6ZuZkx9uzsHwRZzYE', 2, '2024-10-08 12:49:18', '2024-10-08 12:50:03'),
(55, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTgwMywiZXhwIjoxNzI4Mzk1NDAzfQ.ESxivPgms584HO3CA1IffCw08FQiDQMb_pL6CmmRHlM', 2, '2024-10-08 12:50:03', '2024-10-08 12:50:53'),
(56, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MTg1MywiZXhwIjoxNzI4Mzk1NDUzfQ.e8m8lOZCmyZM_avFOa5cfgL6ncbUOQSj3p9c5X7ZzXI', 2, '2024-10-08 12:50:53', '2024-10-08 12:53:54'),
(57, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MjAzNCwiZXhwIjoxNzI4Mzk1NjM0fQ.4suYMqo_IH0ftVgSX3X9F1bARknK-5if9dgQ8phUaHA', 2, '2024-10-08 12:53:54', '2024-10-08 12:58:34'),
(58, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MjMyOCwiZXhwIjoxNzI4Mzk1OTI4fQ.BcV1J7y_A644UXTEAB5lggJPYTSkCDuHZNE2mv_pBDw', 2, '2024-10-08 12:58:48', '2024-10-08 13:25:02'),
(59, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODM5MzkxNywiZXhwIjoxNzI4Mzk3NTE3fQ.XPJiT4o3O_OhhqaUXFIo5fVXpvAUng4gS4muO89mYl4', 2, '2024-10-08 13:25:17', '2024-10-09 04:45:44'),
(60, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQwMDg1NSwiZXhwIjoxNzI4NDA0NDU1fQ.eW6SnnklD3iU0BAgg2uHp2zeWm_-GJgYIS1SGnZ4n0E', 2, '2024-10-08 15:20:55', '2024-10-08 18:04:24'),
(61, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQxMDY2NCwiZXhwIjoxNzI4NDE0MjY0fQ.z-HsgOLrw_BwoWDH9jk1Ir10SQ72Hru2JRwr2Obrvjk', 2, '2024-10-08 18:04:24', '2024-10-09 06:13:27'),
(62, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODQ0OTE0NCwiZXhwIjoxNzI4NDUyNzQ0fQ.47UdQq2UhguWftJsJQt1n0wnSXuni9D0HSsQwuQbbeA', 2, '2024-10-09 04:45:44', '2024-10-09 04:46:02'),
(63, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODQ0OTE2MiwiZXhwIjoxNzI4NDUyNzYyfQ.pIx3Jau56qRjqjWZKkDoT2wZEYprYfV7cvayJFO6p44', 2, '2024-10-09 04:46:02', '2024-10-09 05:17:58'),
(64, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODQ1MTEwMywiZXhwIjoxNzI4NDU0NzAzfQ.z3dC8iSZzs5O6brKXuIfZkWffzS1SpadvdZxjjFvvrQ', 2, '2024-10-09 05:18:23', '2024-10-09 06:03:29'),
(65, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1NDQwNywiZXhwIjoxNzI4NDU4MDA3fQ.OT84rs8f9jARDEWW8kQWitO4yyF0CIgoRjRHEgwjG7A', 2, '2024-10-09 06:13:27', '2024-10-09 06:13:38'),
(66, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1NDQxOCwiZXhwIjoxNzI4NDU4MDE4fQ.EoXBao_SLFsg48JPuwlpe2LDBAOJ25YqaTqRaVRuWSI', 2, '2024-10-09 06:13:38', '2024-10-09 06:13:51'),
(67, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1NDQzMSwiZXhwIjoxNzI4NDU4MDMxfQ.Wq0jc1A0AyJRU8vluNk-aNaBNJKpXb3GAMGekUAh0vk', 2, '2024-10-09 06:13:51', '2024-10-09 06:14:12'),
(68, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1NDQ4MywiZXhwIjoxNzI4NDU4MDgzfQ.0HsBWAiVOhijSdKQ5LBwxeCy9I5GQ2ieula26CqC_4s', 2, '2024-10-09 06:14:43', '2024-10-09 06:29:30'),
(69, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1NTM3OSwiZXhwIjoxNzI4NDU4OTc5fQ.JvoAk648IElgMm9jlPJe58KPko9xtkiWlzZgsH9R7us', 2, '2024-10-09 06:29:39', '2024-10-09 07:45:34'),
(70, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ1OTkzNCwiZXhwIjoxNzI4NDYzNTM0fQ.BhwQAvt_MocQc2VInJNb4crjwo7wqeY7AG5Zte7RmqM', 2, '2024-10-09 07:45:34', '2024-10-09 07:46:43'),
(71, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2MDAyOSwiZXhwIjoxNzI4NDYzNjI5fQ.mU-kmgr3-jHyMIWYPGlO7JxvN3QCZ1AebuCq2sipcSI', 2, '2024-10-09 07:47:09', '2024-10-09 09:56:41'),
(72, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2NzgwMSwiZXhwIjoxNzI4NDcxNDAxfQ.fb-pn08Bj-76tyR2In8blZg2fN_ks1t-FQPw6wXCKKM', 2, '2024-10-09 09:56:41', '2024-10-09 09:57:36'),
(73, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2Nzg1NiwiZXhwIjoxNzI4NDcxNDU2fQ.MytQ8Uh5Rfs7B2AErQYrZHwC7SRS7A8oo2I5Wq2YDFc', 2, '2024-10-09 09:57:36', '2024-10-09 10:00:09'),
(74, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2ODE1MywiZXhwIjoxNzI4NDcxNzUzfQ.O39tK7WKMMhHwBCyT2XvoysRbQ2yioky0oUHoc816e0', 2, '2024-10-09 10:02:33', '2024-10-09 10:06:49'),
(75, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2ODQwOSwiZXhwIjoxNzI4NDcyMDA5fQ.MAH_GzExQ58k_Gd6IqY5_J2whLnX6QHfE6fg9NkSXSY', 2, '2024-10-09 10:06:49', '2024-10-09 10:11:21'),
(76, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ2ODY4MSwiZXhwIjoxNzI4NDcyMjgxfQ.b9cqlw8uHVp9NOKNL76n0XF9YwnK68-KwafSkKSoQ1w', 2, '2024-10-09 10:11:21', '2024-10-09 10:50:11'),
(77, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODQ2ODgxOCwiZXhwIjoxNzI4NDcyNDE4fQ.FS72nWO9wBRLuKwxF10OIJcIApd1UoQOz4k8AA5rIhI', 2, '2024-10-09 10:13:38', '2024-10-09 10:40:12'),
(78, 1, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjEsImlhdCI6MTcyODQ3MDA0MiwiZXhwIjoxNzI4NDczNjQyfQ.lPQtaqWWIkUz_Cx5dbm2yEH6d2ULf8ocLSkdOmq5_8c', 1, '2024-10-09 10:34:02', '2024-10-09 10:34:02'),
(79, 3, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWRtaW4iLCJzdWIiOjMsImlhdCI6MTcyODQ3MDQxMiwiZXhwIjoxNzI4NDc0MDEyfQ.hni4tSXMZZUSUe0Dj4Q6Sg0VcV45L50csExj2sVMKb4', 1, '2024-10-09 10:40:12', '2024-10-09 10:40:12'),
(80, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ3MTAxMSwiZXhwIjoxNzI4NDc0NjExfQ.SIl46zhpxwshdZi_OrPguWH2nKYsU1UJrdQ9v6W53ZQ', 2, '2024-10-09 10:50:11', '2024-10-09 10:50:29'),
(81, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ3MTAyOSwiZXhwIjoxNzI4NDc0NjI5fQ.z9m_PMVBW3waQ2OzVYIQV8kcoEt3-eekqRGCc7xdYKk', 2, '2024-10-09 10:50:29', '2024-10-09 12:29:06'),
(82, 6, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQm9ycm93ZXIiLCJzdWIiOjYsImlhdCI6MTcyODQ3MjcwNiwiZXhwIjoxNzI4NDc2MzA2fQ.6n-hF2CPseApTaEIgYjXf9c7co2w3mt7yuSNgkGnAcc', 1, '2024-10-09 11:18:26', '2024-10-09 11:18:26'),
(83, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ3NzAxNywiZXhwIjoxNzI4NDgwNjE3fQ.cbt51weNgddF9JNRET0FUIUNGL2TXPKpXD7qsalTU6Q', 2, '2024-10-09 12:30:17', '2024-10-09 13:11:15'),
(84, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ3OTQ3NSwiZXhwIjoxNzI4NDgzMDc1fQ.vUcgIhcB63U0YGxeKUeQVKaElC2d8bJxHtnVYn3UuTs', 2, '2024-10-09 13:11:15', '2024-10-09 13:50:04'),
(85, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ4MTgwNCwiZXhwIjoxNzI4NDg1NDA0fQ.A8KWPVR0mpL5IbekwnPQn3HC51COAT8SBG8KGzeqTWY', 2, '2024-10-09 13:50:04', '2024-10-09 15:39:42'),
(86, 4, 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJyb2xlIjoiQWdlbnQiLCJzdWIiOjQsImlhdCI6MTcyODQ4ODM4MiwiZXhwIjoxNzI4NDkxOTgyfQ.047c211I7yhKHoCbSQkIsCZboeVaQxaNGm6xyqy3TIs', 1, '2024-10-09 15:39:42', '2024-10-09 15:39:42');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_update_profile_request`
--

CREATE TABLE `tbl_update_profile_request` (
  `id` int NOT NULL,
  `user_id` int NOT NULL COMMENT 'users.id',
  `field_value` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `field_type` int NOT NULL COMMENT '1-Mobile,2-Email',
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Pending, 2-Approval,3-Reject',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbl_update_profile_request`
--

INSERT INTO `tbl_update_profile_request` (`id`, `user_id`, `field_value`, `field_type`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '9756188580', 1, 2, '2024-10-07 10:50:49', NULL),
(2, 1, 'shadab.nerasoft@gmail.com', 2, 2, '2024-10-07 11:24:33', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `provider_id` int DEFAULT NULL COMMENT 'providers.id\r\n',
  `member_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `aadhar_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pan_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `is_mobile_verified` tinyint NOT NULL DEFAULT '2' COMMENT '1-Verified,2-Non Verified',
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `occupation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ifsc_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `bank_statement` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `id_card_upload` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `office_address` text COLLATE utf8mb4_unicode_ci,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `district` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `tehsil` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `town` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin_code` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `alt_mobile_no` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `security_pin` varchar(55) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role_id` int NOT NULL COMMENT 'roles.id',
  `is_user_verified` tinyint NOT NULL DEFAULT '2' COMMENT '1-Verified,2-Non Verified',
  `is_loggedin` enum('0','1') COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `status` tinyint NOT NULL DEFAULT '1' COMMENT '1-Active,2-InActive,3-Deleted, 4- Permanent Deleted'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `provider_id`, `member_id`, `name`, `email`, `aadhar_no`, `pan_no`, `mobile_no`, `is_mobile_verified`, `email_verified_at`, `occupation`, `company_name`, `account_name`, `account_no`, `ifsc_code`, `bank_statement`, `id_card_upload`, `office_photo`, `office_address`, `state`, `district`, `tehsil`, `town`, `pin_code`, `alt_mobile_no`, `password`, `remember_token`, `security_pin`, `role_id`, `is_user_verified`, `is_loggedin`, `created_at`, `updated_at`, `status`) VALUES
(1, NULL, '000001', 'Admin', 'kspsmartindia@gmail.com', NULL, NULL, '8742085506', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$1jcQB6M7odxXC9UFdBixUOStVH/7uC2tvkLIHZD2U5bCdK7wtAfkK', '4Q0gB5C04uFCknIcwxreJx2JZnPbp0NC5iErZs5sFlYZ7i8lTGb2kqObpcoV', NULL, 1, 1, '0', '2024-11-08 11:42:19', '2025-07-18 11:02:07', 1),
(144, 6, '112521', 'Fazlu Rehman', 'fazlu.developer@gmail.com', NULL, NULL, '7428059960', 1, '2025-01-09 13:18:45', NULL, NULL, '8742085506', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '7428059960', '$2y$10$m0p2KV0u2iQPd/R.Ehg9xOIJnv.C8d6wh3rK6aPMQziiWvvikUryC', NULL, NULL, 5, 1, '0', '2025-01-09 13:17:57', '2025-05-15 12:40:36', 1),
(145, 5, '292410', 'Pooja', 'pooja@gmail.com', NULL, NULL, '9929101621', 1, '2025-01-11 17:09:36', NULL, NULL, '8742085506', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$rc4TVE2HOoLxZ1nm5RS8Ped62kBT7pVW6wS3/KRAFRvazviiekgzi', NULL, NULL, 7, 1, '0', '2025-01-11 17:09:15', '2025-05-15 12:41:39', 3),
(146, NULL, '399658', 'Machu', 'Machu@gmail.com', NULL, NULL, '6350298090', 1, '2025-01-16 15:17:54', NULL, NULL, '8742085506', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$PncKrrFIDXqGH51K6d4OsuwyVJJ0SQ73628cx92qUY.7NMDnU9Ssq', NULL, NULL, 6, 1, '0', '2025-01-16 15:17:37', '2025-01-31 11:21:20', 3),
(147, 1, '600125', 'asdfsadf', 'fazsadflu.developer@gmail.com', NULL, NULL, '7065876175', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$slas8wQwHuOxMgF7Ii/S.ObdvDKXVOPszIbTEjxeI6VGC5j0.uUG6', NULL, NULL, 7, 1, '0', '2025-01-22 11:18:15', '2025-01-22 11:18:24', 3),
(148, 1, '994520', 'Jhandu', 'jhandu@gmail.com', NULL, NULL, '8239404726', 1, NULL, NULL, NULL, '8742085506', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$O2pLIiltDGpE94dyTrrXNO9FwCtGJ.D0LvPboA/25u7/X2hG30dKq', NULL, NULL, 7, 1, '0', '2025-01-26 14:55:04', '2025-05-15 12:41:31', 3),
(150, 2, '986793', 'dummy', 'dummy@gmail.com', NULL, NULL, '6375757246', 1, '2025-05-15 12:42:46', NULL, NULL, '8742085506', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$YiGAM/dkHfnd9fjlNALmruuD.SdzQDHejQNevZNWKoyNBgKntDwyi', NULL, NULL, 5, 1, '0', '2025-05-15 12:42:21', '2025-05-15 13:57:06', 1),
(151, NULL, '778170', 'Tappu', 'tappu@gmail.com', NULL, NULL, '6350298090', 1, '2025-05-15 14:31:25', 'Salaried', 'Ok', 'Ok', '89065', 'Ijvjb', NULL, NULL, NULL, NULL, 'Haryana', 'Vg', 'Ub', 'Gvv', '345678', NULL, '$2y$10$Sk0F2KBvsp6aBH/f2MgWYew8q2qWYFI6x1kssiOwEZ1bY5rO9ZRMW', NULL, NULL, 5, 1, '0', '2025-05-15 14:31:15', '2025-05-15 14:33:32', 1),
(152, NULL, '468810', 'test', 'test@gmail.com', NULL, NULL, '9876543219', 1, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '$2y$10$XAIG3P7WHoHmwFp8kKzSnuk1pdSUoGQC9Nj3FE/It241tusHcXT/.', NULL, NULL, 6, 1, '0', '2025-05-16 06:48:09', '2025-05-16 06:48:30', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assignroutes`
--
ALTER TABLE `assignroutes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assign_lead`
--
ALTER TABLE `assign_lead`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `cms_settings`
--
ALTER TABLE `cms_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `copy`
--
ALTER TABLE `copy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dynamic_url`
--
ALTER TABLE `dynamic_url`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `enquiry`
--
ALTER TABLE `enquiry`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `kycs`
--
ALTER TABLE `kycs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_leads`
--
ALTER TABLE `kyc_leads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_leads_guarantor`
--
ALTER TABLE `kyc_leads_guarantor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `kyc_reject_reasons`
--
ALTER TABLE `kyc_reject_reasons`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loans`
--
ALTER TABLE `loans`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `loan_requests`
--
ALTER TABLE `loan_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notes`
--
ALTER TABLE `notes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `providers`
--
ALTER TABLE `providers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_models`
--
ALTER TABLE `role_models`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `role_permission`
--
ALTER TABLE `role_permission`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `routezips`
--
ALTER TABLE `routezips`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `route_logs`
--
ALTER TABLE `route_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_token`
--
ALTER TABLE `tbl_token`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_update_profile_request`
--
ALTER TABLE `tbl_update_profile_request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `assignroutes`
--
ALTER TABLE `assignroutes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assign_lead`
--
ALTER TABLE `assign_lead`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `cms_settings`
--
ALTER TABLE `cms_settings`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `copy`
--
ALTER TABLE `copy`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `dynamic_url`
--
ALTER TABLE `dynamic_url`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `enquiry`
--
ALTER TABLE `enquiry`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kycs`
--
ALTER TABLE `kycs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kyc_leads`
--
ALTER TABLE `kyc_leads`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kyc_leads_guarantor`
--
ALTER TABLE `kyc_leads_guarantor`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `kyc_reject_reasons`
--
ALTER TABLE `kyc_reject_reasons`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loans`
--
ALTER TABLE `loans`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `loan_requests`
--
ALTER TABLE `loan_requests`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `notes`
--
ALTER TABLE `notes`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `providers`
--
ALTER TABLE `providers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `role_models`
--
ALTER TABLE `role_models`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_permission`
--
ALTER TABLE `role_permission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `routezips`
--
ALTER TABLE `routezips`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `route_logs`
--
ALTER TABLE `route_logs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_otp`
--
ALTER TABLE `tbl_otp`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `tbl_token`
--
ALTER TABLE `tbl_token`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=87;

--
-- AUTO_INCREMENT for table `tbl_update_profile_request`
--
ALTER TABLE `tbl_update_profile_request`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=153;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
