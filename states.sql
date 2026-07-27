-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 22, 2026 at 09:38 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mgm_my`
--

-- --------------------------------------------------------

--
-- Table structure for table `states`
--

CREATE TABLE `states` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `country_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `code` varchar(3) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `meta_title` varchar(255) DEFAULT NULL,
  `meta_description` text DEFAULT NULL,
  `heading` varchar(255) DEFAULT NULL,
  `content` longtext DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `states`
--

INSERT INTO `states` (`id`, `country_id`, `name`, `code`, `created_at`, `updated_at`, `slug`, `meta_title`, `meta_description`, `heading`, `content`, `is_active`) VALUES
(1, 1, 'Alabama', 'AL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(2, 1, 'Alaska', 'AK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(3, 1, 'Arizona', 'AZ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(4, 1, 'Arkansas', 'AR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(5, 1, 'California', 'CA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(6, 1, 'Colorado', 'CO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(7, 1, 'Connecticut', 'CT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(8, 1, 'Delaware', 'DE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(9, 1, 'Florida', 'FL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(10, 1, 'Georgia', 'GA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(11, 1, 'Hawaii', 'HI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(12, 1, 'Idaho', 'ID', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(13, 1, 'Illinois', 'IL', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(14, 1, 'Indiana', 'IN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(15, 1, 'Iowa', 'IA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(16, 1, 'Kansas', 'KS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(17, 1, 'Kentucky', 'KY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(18, 1, 'Louisiana', 'LA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(19, 1, 'Maine', 'ME', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(20, 1, 'Maryland', 'MD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(21, 1, 'Massachusetts', 'MA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(22, 1, 'Michigan', 'MI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(23, 1, 'Minnesota', 'MN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(24, 1, 'Mississippi', 'MS', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(25, 1, 'Missouri', 'MO', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(26, 1, 'Montana', 'MT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(27, 1, 'Nebraska', 'NE', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(28, 1, 'Nevada', 'NV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(29, 1, 'New Hampshire', 'NH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(30, 1, 'New Jersey', 'NJ', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(31, 1, 'New Mexico', 'NM', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(32, 1, 'New York', 'NY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(33, 1, 'North Carolina', 'NC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(34, 1, 'North Dakota', 'ND', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(35, 1, 'Ohio', 'OH', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(36, 1, 'Oklahoma', 'OK', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(37, 1, 'Oregon', 'OR', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(38, 1, 'Pennsylvania', 'PA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(39, 1, 'Rhode Island', 'RI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(40, 1, 'South Carolina', 'SC', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(41, 1, 'South Dakota', 'SD', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(42, 1, 'Tennessee', 'TN', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(43, 1, 'Texas', 'TX', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(44, 1, 'Utah', 'UT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(45, 1, 'Vermont', 'VT', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(46, 1, 'Virginia', 'VA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(47, 1, 'Washington', 'WA', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(48, 1, 'West Virginia', 'WV', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(49, 1, 'Wisconsin', 'WI', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1),
(50, 1, 'Wyoming', 'WY', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `states`
--
ALTER TABLE `states`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `states_slug_unique` (`slug`),
  ADD KEY `states_country_id_foreign` (`country_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `states`
--
ALTER TABLE `states`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=51;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `states`
--
ALTER TABLE `states`
  ADD CONSTRAINT `states_country_id_foreign` FOREIGN KEY (`country_id`) REFERENCES `countries` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
