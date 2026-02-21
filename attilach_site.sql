-- phpMyAdmin SQL Dump
-- version 5.2.2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Feb 18, 2026 at 12:36 PM
-- Server version: 10.11.14-MariaDB-cll-lve
-- PHP Version: 8.4.17

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attilach_site`
--

-- --------------------------------------------------------

--
-- Table structure for table `bank_accounts`
--

CREATE TABLE `bank_accounts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `bank_name` varchar(255) NOT NULL,
  `bank_address` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) NOT NULL,
  `account_number` varchar(255) NOT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `branch_name` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `bank_accounts`
--

INSERT INTO `bank_accounts` (`id`, `investor_id`, `bank_name`, `bank_address`, `account_name`, `account_number`, `swift_code`, `branch_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'STANDARD CHARTERED BANK', 'WESTLANDS RD', 'ALEX GACHANJA NYAGAH', '0100347074800', 'SCBLKENX', 'TRM BRANCH', NULL, NULL),
(2, 2, 'EQUITY BANK LTD', 'NAIROBI, KENYA', 'WILLY KYENGO MUTUKU', '0240163759495', 'EQBLKENAXXX', 'OTC BRANCH', NULL, NULL),
(3, 3, 'FAMILY BANK', 'NAIROBI, KENYA', 'BEATRICE WANGARE', '001000078559', 'FABLKENAXXX', 'KIAMBU', NULL, NULL),
(4, 4, 'FAULU MICROFINANCE BANK', 'NAIROBI, KENYA', 'JANEFRANCES MWIKALI MULWA', '1008367236', 'FAUMKENAXXX', 'KIMATHI STREET', NULL, NULL),
(5, 5, 'COOPERATIVE BANK OF KENYA', 'NAIROBI KENYA', 'SAMUEL K NJAKAI', '01100069433200', 'KCOOKENA', 'BURU BURU', NULL, NULL),
(6, 6, 'FAMILY BANK', 'NAIROBI KENYA', 'ESTHER WAMBUI NG\'ANG\'A', '024000007995', 'FABLKENAXXX', 'RUIRU', NULL, NULL),
(7, 7, 'NCBA', 'NAIROBI, KENYA', 'VINCENT GITAU MUNIU', '5451590016', 'CBAFKENX', 'HARAMBEE', NULL, NULL),
(8, 8, 'KINGDOM BANK', 'NAIROBI, KENYA', 'PAUL WAWERU MBURU', '3081901367004', 'CIFIKENA', 'KIAMBU', NULL, NULL),
(9, 9, 'CBK', 'CBD', 'SAMPLE INVESTOR', '1234567890', 'CBKENXXX', 'CBD', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `cache`
--

CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `cache_locks`
--

CREATE TABLE `cache_locks` (
  `key` varchar(255) NOT NULL,
  `owner` varchar(255) NOT NULL,
  `expiration` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `start_date` datetime NOT NULL,
  `end_date` datetime NOT NULL,
  `banner_url` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `dates` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`dates`))
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `venue`, `start_date`, `end_date`, `banner_url`, `description`, `created_at`, `updated_at`, `dates`) VALUES
(1, 'Attila Chicken Launch Event', 'Thika Greens Golf Resort', '2025-11-28 10:00:00', '2025-11-29 18:00:00', '/images/attila-banner.jpg', 'Join us for the grand launch of Attila — innovation meets excellence.', '2025-10-13 03:14:59', '2025-10-13 03:14:59', '[\"2025-11-28\", \"2025-11-29\"]');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `guest_carts`
--

CREATE TABLE `guest_carts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `session_id` varchar(255) NOT NULL,
  `items` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL CHECK (json_valid(`items`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `investments`
--

CREATE TABLE `investments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `investment_package` varchar(255) NOT NULL,
  `contract_number` varchar(255) NOT NULL,
  `initial_investment_date` date NOT NULL,
  `total_amount_invested` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investments`
--

INSERT INTO `investments` (`id`, `investor_id`, `investment_package`, `contract_number`, `initial_investment_date`, `total_amount_invested`, `created_at`, `updated_at`) VALUES
(1, 1, 'SILVER', 'APF001', '2024-12-19', 4055760, '2025-12-17 04:03:01', '2025-12-17 04:03:01'),
(2, 1, 'SILVER', 'APF002', '2025-04-17', 4055760, NULL, NULL),
(3, 2, 'BRONZE', 'APF003', '2025-06-21', 2027835, '2025-12-17 04:03:01', '2025-12-17 04:03:01'),
(4, 3, 'BRONZE', 'APF004', '2025-07-02', 2027835, '2025-12-17 04:03:01', '2025-12-17 04:03:01'),
(5, 4, 'BRONZE', 'APF005', '2025-08-25', 2036644, '2025-12-17 04:03:01', '2025-12-17 04:03:01'),
(6, 5, 'BRONZE', 'APF006', '2025-10-07', 2036644, NULL, NULL),
(7, 6, 'BRONZE', 'APF007', '2025-10-08', 2036644, NULL, NULL),
(8, 7, 'SILVER', 'APF008', '2025-10-07', 4072747, NULL, NULL),
(9, 8, 'BRONZE', 'APF009', '2025-11-19', 2036644, NULL, NULL),
(10, 9, 'GOLD', 'SAMPLE001', '2024-12-31', 8146458, NULL, NULL),
(11, 10, 'BRONZE', 'APF010', '2025-02-28', 2036644, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `investors`
--

CREATE TABLE `investors` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `id_number` varchar(255) NOT NULL,
  `kra_pin` varchar(255) DEFAULT NULL,
  `phone` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `postal_address` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `investors`
--

INSERT INTO `investors` (`id`, `full_name`, `id_number`, `kra_pin`, `phone`, `email`, `postal_address`, `created_at`, `updated_at`) VALUES
(1, 'ALEX GACHANJA NYAGAH', '22867421', 'A002804124M', '0721232658', 'anyagah49@gmail.com', '', NULL, NULL),
(2, 'WILLY KYENGO MUTUKU', '10488327', 'A002194149L', '0712144429', 'willymutuku.047@gmail.com', '', NULL, NULL),
(3, 'BEATRICE WANGARI', '22282605', NULL, '0722447715', 'bnkare@gmail.com', '', NULL, NULL),
(4, 'JANEFRANCES MWIKALI MULWA', '35579289', NULL, '0722327254', 'florencemulwa@gmail.com', '', NULL, NULL),
(5, 'SAMUEL KARUHI NJAKAI', '21939764', 'A003420784R', '0722634392', 'snjakai@yahoo.com', '', NULL, NULL),
(6, 'ESTHER WAMBUI NG\'ANG\'A', '24529731', 'A0044657841', '0721122136', 'wambui86nganga@gmail.com', '', NULL, NULL),
(7, 'VINCENT GITAU MUNIU', '25188110', NULL, '0724681968', 'vincent.gitau30@gmail.com', '', NULL, NULL),
(8, 'PAUL WAWERU MBURU', '22217681', NULL, '0721794281', 'paul.mburu1@gmail.com', '', NULL, NULL),
(9, 'SAMPLE INVESTOR', '12345678', 'A0000000B', '1234567890', 'anne@attilachicken.com', '12345-10001', NULL, NULL),
(10, 'BERNICE WANGUI NG\'INJA', '10905633', 'A001706790H', '0722523446', 'bmnginja@gmail.com', '876-00606', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invitations`
--

CREATE TABLE `invitations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `event_id` bigint(20) UNSIGNED NOT NULL,
  `guest_name` varchar(255) NOT NULL,
  `guest_email` varchar(255) NOT NULL,
  `guest_mobile` varchar(20) DEFAULT NULL,
  `token` char(36) NOT NULL,
  `status` enum('pending','accepted','declined','attended') NOT NULL DEFAULT 'pending',
  `meta` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`meta`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invitations`
--

INSERT INTO `invitations` (`id`, `event_id`, `guest_name`, `guest_email`, `guest_mobile`, `token`, `status`, `meta`, `created_at`, `updated_at`) VALUES
(1, 1, 'Mary Wangui', 'john@example.com', '254715567371', '9116c8a2-25e8-47a8-8d2a-af7f55aa3b2f', 'pending', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-10-13 03:14:59', '2025-12-01 10:50:48'),
(3, 1, 'Ann Kanyori', 'jane@example.com', '254722253539', '11916098-dc3d-4d40-8e28-b97bda30e7b8', 'pending', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-10-13 03:25:14', '2025-12-01 10:50:27'),
(6, 1, 'Philip', 'jack@example.com', '25472633101', '9116c8a2-25e8-47a8-8d2a-af7f55aa3b2g', 'pending', NULL, NULL, '2025-10-27 11:53:06'),
(20, 1, 'George My Credit', 'jane@example.com', '254722435168', 'f2631cc5-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:28:48'),
(21, 1, 'Beatrice Wangari', 'm@example.com', '254722447415', 'f2632640-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', NULL, '2025-12-01 10:00:25'),
(22, 1, 'Willy Mutuku', 'm@example.com', '254712144429', 'f26327b1-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', NULL, '2025-12-01 10:01:00'),
(23, 1, 'Janefrances', '', '254722327254', 'f263283d-b33b-11f0-b56d-48df37c6695a', 'declined', '\"{\\n    \\\"event_dates\\\": [],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-11-20 09:48:55'),
(24, 1, 'Samuel Njakai', '', '254722634392', 'f26328b6-b33b-11f0-b56d-48df37c6695a', 'declined', '\"{\\n    \\\"event_dates\\\": [],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-11-20 09:04:22'),
(25, 1, 'Esther Wambui', 'm@example.com', '254721122136', 'f263292d-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"3\\\"\\n}\"', NULL, '2025-12-01 10:01:39'),
(26, 1, 'Vincent Muniu', 'm@example.com', '254724681968', 'f2632a07-b33b-11f0-b56d-48df37c6695a', 'pending', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', NULL, '2025-12-01 10:44:27'),
(27, 1, 'Philip Kago', '', '254726331061', 'f2632a6f-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(28, 1, 'John Bogani', 'm@example.com', '254720830544', 'f2632add-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', NULL, '2025-12-01 10:02:10'),
(29, 1, 'Muriu SNV', '', '254722369156', 'f2632b4c-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(30, 1, 'Maina Ruo', 'jane@example.com', '254716901066', 'f2632bac-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:51:07'),
(31, 1, 'George Feed Supplier', 'm@example.com', '254721446688', 'f2632c06-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"3\\\"\\n}\"', NULL, '2025-12-01 10:03:40'),
(32, 1, 'Mbuyu Kamau', '', '254722322077', 'f2632c6f-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(33, 1, 'David Muita NCBA', '', '254721814330', 'f2632cce-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(34, 1, 'Caro Kibanya', '', '254723706514', 'f2632d2c-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(35, 1, 'Bernice Ngija', '', '254711523446', 'f2632d94-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(36, 1, 'Amos Kamau', '', '254727435252', 'f2632e02-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(37, 1, 'Lee Munene', 'm@example.com', '254725499719', 'f2632e62-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:51:26'),
(39, 1, 'Lucy CDR Recruitment', '', '254722207197', 'f2632f26-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(40, 1, 'Kimani', 'm@example.com', '254722418875', 'f2632f7d-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, '2025-11-20 06:39:46'),
(41, 1, 'Steve Kaguchia', '', '254722352669', 'f2632fd9-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(42, 1, 'James Mwangi H.', 'm@example.com', '254703236700', 'f2633029-b33b-11f0-b56d-48df37c6695a', 'pending', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:38:37'),
(43, 1, 'Patrick Thece', '', NULL, 'f263307d-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(44, 1, 'Cathreen Thika Greens Golf', 'm@example.com', '254722354870', 'f26330ed-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:51:46'),
(45, 1, 'Captain Kinyua', 'm@example.com', '254700652027', 'f2633166-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:43:16'),
(46, 1, 'Kimani', 'm@example.com', '254722524058', 'f26331c2-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, '2025-11-20 06:57:24'),
(47, 1, 'Irungu', 'm@example.com', '254721606262', 'f2633227-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, '2025-11-20 06:59:20'),
(48, 1, 'Jecinta Muthini Mugo', 'm@example.com', '254723561133', 'f263328e-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-02 03:01:57'),
(49, 1, 'Fr. William', '', '254722302192', 'f26332ee-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(50, 1, 'Benson', 'm@example.com', '243890299699', 'f263334f-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, '2025-11-20 07:20:57'),
(51, 1, 'Joseph Getuno', '', '254702909098', 'f26333bc-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(52, 1, 'Wairimu', 'm@example.com', '254722833924', 'f263341e-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"5\\\"\\n}\"', NULL, '2025-12-01 10:05:09'),
(53, 1, 'Muniu Mungai', 'm@example.com', '254722584463', 'f263346e-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', NULL, '2025-12-01 10:52:16'),
(54, 1, 'Davis Njoka', 'm@example.com', '254722530609', 'f26334cf-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:52:40'),
(55, 1, 'Maggie Burser', 'm@example.com', '254720402594', 'f2633531-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"3\\\"\\n}\"', NULL, '2025-12-01 10:52:57'),
(56, 1, 'Bedith Equity', '', '254722167532', 'f2633592-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(57, 1, 'George Equity', '', '254729749093', 'f26335f8-b33b-11f0-b56d-48df37c6695a', 'pending', NULL, NULL, NULL),
(58, 1, 'Leah Thanji', 'm@example.com', '254711832074', 'f2633657-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', NULL, '2025-12-01 10:33:28'),
(59, 1, 'Mary Mwangi', 'm@example.com', '254722573776', 'f26336c5-b33b-11f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:53:13'),
(60, 1, 'Alex Nyaga', 'm@example.com', '254721232658', 'f26336c5-b33b-12f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"4\\\"\\n}\"', NULL, '2025-12-01 10:34:04'),
(61, 1, 'Winnie Muriuki', 'm@example.com', '254715763814', '11916098-dc3d-4y40-8e28-b97bda30e7b8', 'pending', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:44:52'),
(62, 1, 'Kamau', 'm@example.com', '254722260452', 'f26336v5-b33b-12f0-b56d-48df37c6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', NULL, '2025-12-01 10:53:32'),
(63, 1, 'Andre', 'andre@example.com', '254721831613', 'f2631cc5-b33b-11f0-b56d-48df37yu695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:53:51'),
(64, 1, 'Martin', 'martin@example.com', '254724319134', 'f2631cc5-b33b-11f0-b56d-48df37z6695a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', NULL, '2025-12-01 10:54:04'),
(68, 1, 'Muita', 'muita@example.com', '254723993877', '8116c8a2-25e8-47a8-8d2a-af7f55aa3b2f', 'pending', NULL, NULL, NULL),
(69, 1, 'Kiboti', 'kiboti@example.com', '254722795509', '7116c8a2-25e8-47a8-8d2a-af7f55aa3b2f', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:47:39'),
(70, 1, 'Elizabeth', 'liz@example.com', '254725411726', '6116c8a2-25e8-47a8-8d2a-af7f55aa3b2f', 'declined', '\"{\\n    \\\"event_dates\\\": [],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-11-03 02:24:06'),
(71, 1, 'Mercy Wanjiku', 'mary@example.com', '254723290641', '5216c8a2-25e8-47a8-8d2a-af7f55aa3b2f', 'pending', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"4\\\"\\n}\"', NULL, '2025-12-01 10:47:05'),
(72, 1, 'Rev. Paul Kibiro', 'paul@example.com', '254720997586', '6216c8a2-25e8-47a8-8d2a-af7f55aa3b2f', 'attended', '\"{\\n    \\\"event_dates\\\": [],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', NULL, '2025-12-01 10:27:06'),
(73, 1, 'Joel Gatibi', 'joel@example.com', '254723443755', '7216c8a2-25e8-47a8-8d2a-af7f55aa3b2f', 'pending', NULL, NULL, '2025-11-04 07:52:36'),
(74, 1, 'Susan', 'susan@example.com', '254722516966', '4316c8a2-25e8-47a8-8d2a-af7f55aa3b2f', 'pending', NULL, NULL, NULL),
(75, 1, 'Wachiuri', 'wachiuri@example.con', '254725999469', '3316c8a2-25e8-47a8-8d2a-af7f55aa3b2f', 'pending', NULL, NULL, NULL),
(76, 1, 'Spenza', 'spenza@example.com', '254721740528', '2216c8a2-25e8-47a8-8d2a-af7f55aa3b2f', 'pending', NULL, NULL, NULL),
(77, 1, 'Agnes Wairimu', 'm@example.com', '254722600047', '30d10a40-2edf-4eb0-93bc-23d41361bafd', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"4\\\"\\n}\"', '2025-11-03 07:03:00', '2025-12-01 10:04:53'),
(78, 1, 'Ben Mugambi', 'm@example.com', '254725789742', '463a58e1-7ecd-4818-96cd-c619e2af6fec', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-03 07:03:39', '2025-12-01 10:49:58'),
(79, 1, 'Grace', 'm@example.com', '254725510645', 'a1f75ab3-5f62-4550-9a71-fa3762364d97', 'pending', NULL, '2025-11-03 07:09:33', '2025-11-03 07:09:33'),
(80, 1, 'Frank', 'm@example.com', '254710563649', '7d31e8b0-83a9-4e0b-b328-195c0573c129', 'pending', NULL, '2025-11-03 07:21:35', '2025-11-03 07:21:35'),
(81, 1, 'Rachael', 'm@example.com', '254722700140', '78a3af85-67ce-4dd5-a68b-75c6b96ac01f', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"3\\\"\\n}\"', '2025-11-03 07:46:23', '2025-12-01 10:49:40'),
(82, 1, 'Lucy Maina', 'm@example.com', '254722420559', 'd6b582d8-90cc-4f32-bfa9-fd032079b810', 'pending', NULL, '2025-11-03 07:47:13', '2025-11-04 02:48:03'),
(83, 1, 'Martin', 'm@example.com', '254720380733', '0a41703b-fea3-4c92-ae3f-245fd4e91998', 'pending', NULL, '2025-11-03 07:47:47', '2025-11-03 07:47:47'),
(84, 1, 'Steve Muitari', 'm@example.com', '254722788145', 'e3cf8ddb-ff48-4a44-9541-e1b9c0eca58f', 'pending', NULL, '2025-11-03 07:48:23', '2025-11-03 07:48:23'),
(85, 1, 'Muriithi', 'm@example.com', '254722495490', '214fe62e-aa21-4451-aded-000d15c6af7e', 'pending', NULL, '2025-11-03 08:00:55', '2025-11-03 08:00:55'),
(86, 1, 'Judy Nyambura', 'm@example.com', '254722645232', '35984d05-0ab5-4abf-af84-7d144e7ad429', 'pending', NULL, '2025-11-03 08:01:37', '2025-11-03 08:01:37'),
(87, 1, 'Judy Waihenya', 'm@example.com', '254722250695', '69432f40-33ba-4a10-92ba-df8d251cbae4', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-03 08:03:56', '2025-12-01 10:41:22'),
(88, 1, 'Kibira', 'm@example.com', '254725582239', '74fb6b4f-9b2a-4318-b689-905565a4486e', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-03 08:04:41', '2025-12-01 10:41:42'),
(89, 1, 'Kimani', 'm@example.com', '254722777133', 'f852dca4-81da-4286-81ff-8020ade65e86', 'pending', NULL, '2025-11-03 08:06:53', '2025-11-03 08:06:53'),
(90, 1, 'Wathuku', 'm@example.com', '254722517289', 'dc678e10-0afc-4168-aebe-8c00d9ac1215', 'pending', NULL, '2025-11-03 08:07:25', '2025-11-03 08:07:25'),
(91, 1, 'Rafael', 'm@example.com', '254711661960', '57a6fffb-edae-4717-bc1c-3acfc33cc060', 'pending', NULL, '2025-11-03 08:08:01', '2025-11-03 08:08:01'),
(92, 1, 'Sally Kamau', 'm@example.com', '254722587193', '0006e589-a2c2-4b73-b2cc-f06fdf84befb', 'pending', NULL, '2025-11-03 08:08:34', '2025-11-03 08:08:34'),
(93, 1, 'Maria Muthee', 'm@example.com', '254722717524', '13aa9d47-54ad-427b-864d-4b5f531fc053', 'pending', NULL, '2025-11-03 08:24:19', '2025-11-03 08:24:19'),
(94, 1, 'Kogi', 'm@example.com', '254718768558', 'f4183cbc-9cb2-4f6f-8ace-fb0ef286de0a', 'pending', NULL, '2025-11-03 08:24:53', '2025-11-03 08:24:53'),
(95, 1, 'Wachira', 'm@example.com', '254722774389', '6fe8a77d-c805-42b8-98ad-4f661011a414', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-03 08:25:22', '2025-12-01 10:49:26'),
(96, 1, 'Isaac', 'm@example.com', '254720685077', 'c80da226-136c-4f39-90c3-d829d0f0bda4', 'pending', NULL, '2025-11-03 08:25:59', '2025-11-03 08:25:59'),
(97, 1, 'Stephen Gathai', 'm@example.com', '254721799390', '56c5e3ef-d531-40d7-b64e-7fda26aa9c62', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-03 11:40:12', '2025-12-01 10:07:28'),
(98, 1, 'Rhoda', 'm@example.com', '254721811087', '695ce082-4086-40a0-b019-8fe267e2cc7b', 'pending', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-04 04:04:31', '2025-12-01 10:44:09'),
(99, 1, 'Ciiru', 'm@example.com', '254733891309', '895ce574-f0c9-45e8-b7ad-f93836d3a6d0', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": \\\"4\\\"\\n}\"', '2025-11-04 04:05:13', '2025-12-01 10:45:53'),
(100, 1, 'Chris', 'm@example.com', '254722705813', '91af8e6d-7c8d-4d12-8744-48b8cbf47fa1', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-04 04:05:43', '2025-12-01 10:45:22'),
(101, 1, 'Peter M', 'm@example.com', '254719406246', '93252cfe-1b0e-49b3-ad97-075d144b0c55', 'pending', NULL, '2025-11-04 04:06:13', '2025-11-04 04:06:13'),
(102, 1, 'Wesonga', 'm@example.com', '254726469708', '7e0bdab7-7369-41ec-9ed2-40cb931073ea', 'pending', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-04 04:07:32', '2025-12-01 10:43:53'),
(103, 1, 'Ng\'ang\'a', 'm@example.com', '254721752518', '777c5de9-8405-4e18-8642-c91a9992a1a9', 'pending', NULL, '2025-11-04 04:08:04', '2025-11-04 04:08:04'),
(104, 1, 'Johnson', 'm@example.com', '254722841606', '46abe118-2354-448b-af0a-4df7e4756c94', 'pending', NULL, '2025-11-04 04:08:40', '2025-11-04 04:08:40'),
(105, 1, 'Dr. Naomi', 'm@example.com', '254724496326', '58a563a5-edf0-4c7d-82d4-236a2266f186', 'pending', NULL, '2025-11-04 04:09:13', '2025-11-04 04:09:13'),
(106, 1, 'Morgan', 'm@example.com', '254745665344', '32b934ea-eb8f-4365-a736-3bfaa2d1d5b0', 'pending', NULL, '2025-11-04 04:09:50', '2025-11-04 04:09:50'),
(107, 1, 'Wanjiru', 'm@example.com', '254722879597', '8959f480-e3d1-467e-b993-0ffa46b668db', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-04 04:10:25', '2025-12-01 10:40:37'),
(108, 1, 'Mike', 'm@example.com', '254790825285', 'da9c0e48-6bd2-455f-836a-460e797d2c2c', 'pending', NULL, '2025-11-04 04:11:30', '2025-11-04 04:11:30'),
(109, 1, 'Gathara', 'm@example.com', '254722761900', '3a5b70d3-4e78-4ffc-9b83-ee204cd74545', 'pending', NULL, '2025-11-04 04:12:20', '2025-11-04 04:12:20'),
(110, 1, 'Karoki', 'm@example.com', '254721344131', '4ecc4c81-6f20-4d35-b661-b708fdd84078', 'pending', NULL, '2025-11-04 04:13:40', '2025-11-04 04:13:40'),
(111, 1, 'Agrikima', 'm@example.com', '254721208918', '97fe6bfa-ea49-4f19-90df-0fcb2aa65caf', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-04 04:14:15', '2025-12-01 10:40:10'),
(112, 1, 'Liz', 'm@example.com', '254721412071', 'f89db14f-0ace-47ae-a110-096a1e462e44', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"3\\\"\\n}\"', '2025-11-04 04:14:52', '2025-12-01 10:39:54'),
(113, 1, 'Mathenge', 'm@example.com', '254724113933', '8d9261ef-ab78-4cb4-b595-348e25794029', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-04 04:15:22', '2025-12-01 10:37:38'),
(114, 1, 'Betty Mutua', 'm@example.com', '254720611239', '4a1629d6-b5fe-4e61-80ff-1558d5516622', 'pending', NULL, '2025-11-04 04:16:41', '2025-11-04 04:16:41'),
(115, 1, 'Frank Gathu', 'm@example.com', '254720088368', 'ed576f33-eed6-4e49-a85a-f1bdcd82efb4', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-04 04:17:23', '2025-12-01 10:37:09'),
(116, 1, 'Emma', 'm@example.com', '254722101403', 'e637f2bd-53ca-4356-877b-bf95d2ab9ace', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"5\\\"\\n}\"', '2025-11-04 04:17:56', '2025-12-01 10:36:50'),
(117, 1, 'George Mbogo', 'm@example.com', '254721694700', '157e68e6-d390-40a6-8135-030e6b51fb08', 'attended', NULL, '2025-11-04 04:18:33', '2025-12-01 10:27:53'),
(118, 1, 'Allan', 'm@example.com', '254729213890', 'd48ad89f-26a3-49f6-8bd9-026f30034f75', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-04 04:19:10', '2025-12-01 10:24:21'),
(119, 1, 'Anthony', 'm@example.com', '254722704367', '8a07cb52-5108-4454-95cf-d24e36b5c557', 'pending', NULL, '2025-11-04 04:19:39', '2025-11-04 04:19:39'),
(120, 1, 'Fay', 'm@example.com', '254729215719', '46757c5e-05ce-4c0a-8f5e-601acbc672cb', 'pending', NULL, '2025-11-04 04:20:08', '2025-11-04 04:20:08'),
(121, 1, 'George', 'm@example.com', '254717607585', '0211fea7-1f3c-470a-9f62-7bb4859d212f', 'pending', NULL, '2025-11-04 04:20:52', '2025-11-04 04:20:52'),
(122, 1, 'Carol', 'm@example.com', '254722107632', '3ca7dfd6-d36e-4a59-bcb0-ab4402de30f2', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-04 04:21:20', '2025-12-01 10:24:03'),
(123, 1, 'Hamisi', 'm@example.com', '254722572651', 'dd16c1ab-c8d5-4b03-88e9-b74101b5eae6', 'pending', NULL, '2025-11-04 04:21:57', '2025-11-04 04:21:57'),
(124, 1, 'Simon Makau', 'm@example.com', '254722209886', '21c6cf6f-12d1-48f5-9a71-4d88f05ff1d6', 'pending', NULL, '2025-11-04 04:22:39', '2025-11-04 04:22:39'),
(125, 1, 'Frank', 'm@example.com', '12818401629', 'f136d69f-5ae5-4b30-8d4f-8c04b710b4d7', 'pending', NULL, '2025-11-04 04:23:17', '2025-11-04 04:23:17'),
(126, 1, 'Ndung\'u', 'm@example.com', '254724535062', 'af6c1d01-7205-4bde-9459-15d72f85f4fc', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-04 04:24:00', '2025-12-01 10:23:37'),
(127, 1, 'Obiero', 'm@example.com', '254722896752', '86830c34-72dd-48a4-a496-1647df9ccf5d', 'pending', NULL, '2025-11-04 04:24:29', '2025-11-04 04:24:29'),
(128, 1, 'Karanja', 'm@example.com', '254722610797', '84d0bc18-7e3c-4f6e-99c1-7f21d9d8866a', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-04 04:26:25', '2025-12-01 10:23:11'),
(129, 1, 'Victoria', 'm@example.com', '254763300092', 'c1512794-ea9e-4b8c-adc2-fac9609af570', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-04 05:20:06', '2025-12-01 10:22:44'),
(130, 1, 'Patrick T.', 'm@example.com', '254722137217', '58a6f559-c5f5-422f-aa02-8b88fb903bc6', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-06 08:12:58', '2025-12-01 10:22:20'),
(131, 1, 'Tabitha', 'm@example.com', '254722787366', '8e9b0fca-6c71-4b8f-b624-4e1ee31a7616', 'pending', NULL, '2025-11-07 07:49:54', '2025-11-07 07:49:54'),
(132, 1, 'Eng. Githere', 'm@example.com', '254722874952', '6ea94f44-5ff3-40a1-b74b-a5098ea7f7cf', 'pending', NULL, '2025-11-08 04:55:10', '2025-11-08 04:55:10'),
(133, 1, 'Gicheru', 'm@example.com', '254722765933', '71317efc-f47a-4f63-b080-7ad28c8d11f9', 'pending', NULL, '2025-11-10 04:31:04', '2025-11-10 04:31:04'),
(134, 1, 'Felister', 'm@example.com', '254722514363', '1e25b49e-1796-43fb-a78c-68f5515852a2', 'pending', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-10 04:32:31', '2025-12-01 10:36:33'),
(135, 1, 'Faith Njeri', 'm@example.com', '254727500622', 'efe557e1-4ba3-4e7a-99fe-9b4594afd95c', 'declined', '\"{\\n    \\\"event_dates\\\": [],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-10 05:50:53', '2025-11-20 05:01:32'),
(136, 1, 'Titus', 'm@example.com', '254795641594', 'd5ed1652-aa79-4188-8c40-f3a71b07d80f', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-11 02:54:48', '2025-12-01 10:21:40'),
(137, 1, 'John', 'm@example.com', '254711114353', '2d4f2eeb-33d5-4180-b926-652a1a3f8a5e', 'pending', NULL, '2025-11-11 02:55:44', '2025-11-11 02:55:44'),
(138, 1, 'Lucy Kingdom Bank Manager', 'm@example.com', '254721709951', 'a185d3ab-a100-488d-aec5-b8e996e44fb5', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-11 02:57:14', '2025-12-01 10:08:07'),
(139, 1, 'Paul Mburu', 'm@example.com', '254721794281', '91bcdf4d-efd6-45a2-aba8-0e88b592fd57', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-11 02:57:59', '2025-12-01 10:06:59'),
(140, 1, 'John', 'm@example.com', '254763810964', '855927ac-5481-4b32-afe6-6982d95d48e4', 'pending', NULL, '2025-11-11 03:13:19', '2025-11-11 03:13:19'),
(141, 1, 'Patrick Wandeto', 'm@example.com', '254701507442', 'd6dfbd28-5436-4071-9837-e05bcbdc8f83', 'pending', NULL, '2025-11-11 03:13:58', '2025-11-11 03:15:13'),
(142, 1, 'Fred', 'm@example.com', '254723531540', '9b55e51e-ffab-4386-9474-3bce0a2474ad', 'pending', NULL, '2025-11-12 04:42:42', '2025-11-12 04:42:42'),
(143, 1, 'Simon', 'm@example.com', '254712175188', 'b2db255f-fff5-4b18-8958-8ff032d3a533', 'pending', NULL, '2025-11-12 05:55:15', '2025-11-12 05:55:15'),
(144, 1, 'Karanja', 'm@example.com', '254720013122', 'e0c476fe-c2dc-45c0-9643-7ab698272fdf', 'pending', NULL, '2025-11-12 09:53:44', '2025-11-12 09:53:44'),
(145, 1, 'Lydia', 'm@example.com', '254743913808', '0a155d46-3a99-4b40-b9b4-7ad118e6a756', 'pending', NULL, '2025-11-13 02:19:31', '2025-11-13 02:19:31'),
(146, 1, 'Caleb', 'm@example.com', '254723703856', 'a736550c-1b03-4748-9f85-63e9f7b0cb4f', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-18 05:04:27', '2025-12-01 10:06:32'),
(147, 1, 'Robert', 'm@example.com', '254722354036', 'f78471ba-9c00-4848-984c-695ef243326f', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 28\\\",\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-19 05:02:03', '2025-12-01 10:06:12'),
(148, 1, 'Esther', 'm@example.com', '254718399599', '17f7d3d4-668b-42a6-bfa6-495664441d84', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"2\\\"\\n}\"', '2025-11-20 08:18:11', '2025-12-01 08:23:31'),
(149, 1, 'Benson K', 'm@example.com', '254724431141', 'eed702c2-e2ba-4b5a-ade2-67c5c4483255', 'pending', NULL, '2025-11-20 11:12:41', '2025-11-20 11:12:41'),
(150, 1, 'Robert Kagika', 'm@example.com', '254724740275', 'b1453472-31ec-446b-aec2-0ba6001e2c5f', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"4\\\"\\n}\"', '2025-11-23 11:56:17', '2025-12-01 08:23:15'),
(151, 1, 'Eugene Kyale', 'm@example.com', '254714430043', '6bdf9634-1738-4d24-9a14-585516c014b3', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-23 11:57:42', '2025-12-01 08:23:01'),
(152, 1, 'Mercy Ndunge', 'm@example.com', '254722150917', '4041a635-066b-48d4-8fb0-5f411ef025f8', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"group\\\",\\n    \\\"group_size\\\": \\\"4\\\"\\n}\"', '2025-11-23 11:59:04', '2025-12-01 08:05:38'),
(153, 1, 'Arvid Quashire', 'm@example.com', '254719164923', '63dbba6d-45ac-45d7-9934-0711a4afb1d6', 'pending', NULL, '2025-11-23 12:00:25', '2025-11-23 12:00:25'),
(154, 1, 'Omar Garagr', 'm@example.com', '254700088088', '48685a19-b400-478e-9bad-d8bf09637175', 'pending', NULL, '2025-11-23 12:01:59', '2025-11-23 12:01:59'),
(155, 1, 'Dr. Ngugi', 'm@example.com', '254722521064', 'd3c5a2d3-12fe-4ec8-972d-c423bdd8ee1c', 'pending', NULL, '2025-11-23 12:04:14', '2025-11-23 12:04:14'),
(156, 1, 'Ben', 'm@example.com', '254722635778', '069e6de2-72e0-4a1e-8366-a1a855c95329', 'pending', NULL, '2025-11-24 05:24:13', '2025-11-24 05:24:13'),
(157, 1, 'Antony Maina', 'm@example.com', '254707869120', '2099ca0e-70d0-4d47-a483-3980b5898b85', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-26 02:53:00', '2025-12-01 08:07:13'),
(158, 1, 'Caroline Mbogo', 'm@example.com', '254728999035', '1963c732-0a3d-4fba-9744-3e136e4511ca', 'attended', '\"{\\n    \\\"event_dates\\\": [\\n        \\\"October 29\\\"\\n    ],\\n    \\\"attendance_type\\\": \\\"alone\\\",\\n    \\\"group_size\\\": null\\n}\"', '2025-11-26 02:54:35', '2025-12-01 08:05:11'),
(159, 1, 'Martin Kimondo', 'm@example.com', '254713184777', '4cb101a7-435e-439d-b32d-fd2b6c7a1b78', 'pending', NULL, '2025-11-26 09:00:05', '2025-11-26 09:00:05'),
(160, 1, 'Nyoro Ndung\'u', 'm@example.com', '254722447358', '14317929-37a5-45fe-9736-bdd2b66ed4df', 'pending', NULL, '2025-11-26 09:01:01', '2025-11-26 09:01:01'),
(161, 1, 'Allan Ochwangi FFF', 'm@example.com', '254720245253', '31a360d2-b679-429a-9468-4b3f389ce6ad', 'attended', NULL, '2025-12-01 09:53:38', '2025-12-01 09:56:32'),
(162, 1, 'Nicky Agrikima', 'm@example.com', '254726398128', '8477a47e-3def-4811-a574-085afd9d2ae2', 'attended', NULL, '2025-12-01 09:58:35', '2025-12-01 09:58:35'),
(163, 1, 'Wilberforce NCBA', 'm@example.com', '254790674204', 'f887c7b5-7cb2-4005-95cc-848f9c1e018b', 'attended', NULL, '2025-12-01 09:59:56', '2025-12-01 09:59:56'),
(164, 1, 'Faith Akinyi', 'm@example.com', '254791050907', '2f1cb690-93c0-429d-ba4c-076a2c50024e', 'attended', NULL, '2025-12-01 10:03:10', '2025-12-01 10:03:10'),
(165, 1, 'George Muiga', 'm@example.com', '254722602476', '99be97d5-a313-4bb8-8ed2-8eba09989c01', 'attended', NULL, '2025-12-01 10:32:36', '2025-12-01 10:32:36'),
(166, 1, 'Charles', 'm@example.com', '254722337433', '5541b990-cec6-40b8-ac99-c4e9734ca07f', 'attended', NULL, '2025-12-01 10:35:20', '2025-12-01 10:35:20'),
(167, 1, 'Purity', 'm@example.com', '254722887371', '4328d078-0dee-4cd3-80f3-519a37462266', 'attended', NULL, '2025-12-02 03:00:14', '2025-12-02 03:00:14'),
(168, 1, 'Grace', 'm@example.com', '254711747320', '01f17404-c008-4294-abc7-11f85001250a', 'attended', NULL, '2025-12-02 03:00:56', '2025-12-02 03:00:56'),
(169, 1, 'Moses', 'm@example.com', '254720624698', 'df946b5b-b7c0-4611-9867-7e966cec57c8', 'attended', NULL, '2025-12-02 03:02:48', '2025-12-02 03:02:48'),
(170, 1, 'Wanjiku Gitau', 'm@example.com', '254707270477', 'fee769b3-85ab-4eaf-82a8-e498b09248a5', 'attended', NULL, '2025-12-02 03:03:38', '2025-12-02 03:03:38'),
(171, 1, 'Robert Kago', 'm@example.com', '254711557614', '68a1e405-f17e-41c7-83db-380127f9956b', 'attended', NULL, '2025-12-02 03:04:13', '2025-12-02 03:04:13'),
(172, 1, 'Kenneth Machaga', 'm@example.com', '254721955800', '8ec69d12-682a-4cd0-aab0-d02c49cd5c61', 'attended', NULL, '2025-12-02 03:04:49', '2025-12-02 03:04:49'),
(173, 1, 'George Kinyua', 'm@example.com', '254722657051', '1cce37b3-99e6-4146-8cce-b00c2e1f5707', 'attended', NULL, '2025-12-02 03:05:21', '2025-12-02 03:05:21'),
(174, 1, 'Willy Gitau', 'm@example.com', '254724834518', '810124be-ea39-415e-88d3-ea3bf0df5d66', 'attended', NULL, '2025-12-02 03:06:00', '2025-12-02 03:06:00'),
(175, 1, 'J Muhoro', 'm@example.com', '254722303032', '105c132e-235a-479d-94b9-89c4504163b6', 'attended', NULL, '2025-12-02 03:06:34', '2025-12-02 03:06:34'),
(176, 1, 'Christine Gachanga', 'm@example.com', '254722842422', '6a558067-6a4b-4848-be93-01946aca5b63', 'attended', NULL, '2025-12-02 03:07:29', '2025-12-02 03:07:29'),
(177, 1, 'Sylvia Mbogo', 'm@example.com', '254727265616', 'd7b01ccc-fb36-40e2-a29c-4db82c5dbd0c', 'attended', NULL, '2025-12-02 03:08:24', '2025-12-02 03:08:24'),
(178, 1, 'Martina Sikawa', 'm@example.com', '254714728711', '78ab2be7-db20-43e9-be3d-e5be4a26d170', 'attended', NULL, '2025-12-02 03:10:12', '2025-12-02 03:10:12'),
(179, 1, 'Meja Augustine', 'm@example.com', '254711715292', '2ccef75d-f8e9-4184-a196-5fa10f1e4793', 'attended', NULL, '2025-12-02 03:11:41', '2025-12-02 03:11:41'),
(180, 1, 'Bico', 'm@example.com', '254722716868', 'c33f8e19-bd7c-47e1-b103-fd9c5e91f569', 'attended', NULL, '2025-12-02 03:12:17', '2025-12-02 03:12:17'),
(181, 1, 'Steve', 'm@example.com', '254753596283', '874574c5-a7c4-4c15-8739-95e3ef63fd3c', 'attended', NULL, '2025-12-02 06:39:06', '2025-12-02 06:39:06'),
(182, 1, 'Wamai', 'm@example.com', '254728522676', '189637a3-617f-4184-a216-b0a73fff6e05', 'attended', NULL, '2025-12-02 06:39:49', '2025-12-02 06:39:49'),
(183, 1, 'Waruchu', 'm@example.com', '254720528474', '35c182dc-8ace-460f-b281-194da8ed24de', 'attended', NULL, '2025-12-02 06:40:31', '2025-12-02 06:40:31'),
(184, 1, 'Lucie Maina', 'm@example.com', '254746067799', '61ae6a01-a672-4348-9a30-8fac2b3abf0a', 'attended', NULL, '2025-12-02 06:53:28', '2025-12-02 06:53:28');

-- --------------------------------------------------------

--
-- Table structure for table `jobs`
--

CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_batches`
--

CREATE TABLE `job_batches` (
  `id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_jobs` int(11) NOT NULL,
  `pending_jobs` int(11) NOT NULL,
  `failed_jobs` int(11) NOT NULL,
  `failed_job_ids` longtext NOT NULL,
  `options` mediumtext DEFAULT NULL,
  `cancelled_at` int(11) DEFAULT NULL,
  `created_at` int(11) NOT NULL,
  `finished_at` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '0001_01_01_000000_create_users_table', 1),
(2, '0001_01_01_000001_create_cache_table', 1),
(3, '0001_01_01_000002_create_jobs_table', 1),
(4, '2025_09_13_191025_create_products_table', 1),
(5, '2025_09_13_191136_create_orders_table', 1),
(6, '2025_09_15_052757_create_order_items_table', 1),
(7, '2025_09_15_052912_create_order_audits_table', 1),
(8, '2025_09_15_105337_create_routes_table', 2),
(9, '2025_09_16_082828_add_mpesa_checkout_id_to_orders_table', 3),
(10, '2025_09_17_091230_add_role_to_users_table', 4),
(11, '2025_09_18_062839_add_customer_email_and_fields_to_orders_table', 5),
(12, '2025_09_18_095938_add_payment_type_to_orders_table', 6),
(15, '2025_09_21_124619_create_product_variants_table', 7),
(16, '2025_09_29_061856_add_slug_column_to_products_table', 8),
(17, '2025_09_29_121145_create_subscriptions_table', 9),
(18, '2025_10_13_000001_create_events_table', 10),
(19, '2025_10_13_000002_create_invitations_table', 10),
(20, '2025_10_15_061319_add_meta_to_invitations_table', 11),
(21, '2025_12_01_110056_update_status_enum_in_invitations_table', 12),
(22, '2025_12_17_060002_create_investors_table', 13),
(23, '2025_12_17_060013_create_withdrawal_requests_table', 13),
(24, '2025_12_17_063637_create_investments_table', 14),
(25, '2025_12_17_072443_remove_investment_columns_from_investors_table', 15),
(26, '2025_12_17_080915_create_bank_accounts_table', 16),
(27, '2025_12_19_091000_add_signature_path_to_withdrawal_requests_table', 17),
(28, '2025_12_19_091425_add_signature_path_to_withdrawal_requests_table', 18),
(29, '2025_12_31_070318_create_guest_carts_table', 19),
(31, '2026_01_08_094018_add_pickup_location_to_orders_table', 20);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `customer_name` varchar(255) NOT NULL,
  `customer_phone` varchar(255) NOT NULL,
  `payment_phone` varchar(20) DEFAULT NULL,
  `customer_email` varchar(255) DEFAULT NULL,
  `guest_token` char(36) DEFAULT NULL,
  `payment_token` varchar(255) DEFAULT NULL,
  `payment_link_sent_at` datetime DEFAULT NULL,
  `customer_address` varchar(255) DEFAULT NULL,
  `route_id` bigint(20) UNSIGNED DEFAULT NULL,
  `pickup_location` varchar(255) DEFAULT NULL,
  `order_type` varchar(255) NOT NULL DEFAULT 'delivery',
  `payment_type` enum('deposit','full') NOT NULL DEFAULT 'full',
  `total_amount` decimal(12,2) NOT NULL,
  `paid_amount` decimal(12,2) NOT NULL DEFAULT 0.00,
  `delivery_fee` decimal(12,2) NOT NULL DEFAULT 300.00,
  `balance` decimal(12,2) NOT NULL,
  `status` varchar(255) NOT NULL DEFAULT 'pending',
  `mpesa_checkout_id` varchar(255) DEFAULT NULL,
  `timed_out` tinyint(1) NOT NULL DEFAULT 0,
  `payment_gateway` varchar(255) DEFAULT NULL,
  `payment_method` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `customer_name`, `customer_phone`, `payment_phone`, `customer_email`, `guest_token`, `payment_token`, `payment_link_sent_at`, `customer_address`, `route_id`, `pickup_location`, `order_type`, `payment_type`, `total_amount`, `paid_amount`, `delivery_fee`, `balance`, `status`, `mpesa_checkout_id`, `timed_out`, `payment_gateway`, `payment_method`, `created_at`, `updated_at`) VALUES
(320, 'Attila farm', '0722253539', '0722253539', 'ann.kanyori@gmail.com', NULL, 'NvarUMtoFSnliomBYh2BxYTtTg3WVwwp936pFHVl', NULL, NULL, NULL, NULL, 'delivery', 'deposit', 2800.00, 0.00, 0.00, 2800.00, 'failed', 'ws_CO_13012026200149962722253539', 0, 'mpesa', 'mpesa', '2026-01-13 14:01:48', '2026-01-13 14:01:51'),
(321, 'Chicken Necks', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'xbjBT7iRDipQ54KlN7zd0DnOgV9InE7fr2atTmd0', NULL, NULL, NULL, NULL, 'delivery', 'full', 275.00, 275.00, 0.00, 0.00, 'pending', NULL, 0, 'mpesa', 'mpesa', '2026-01-14 02:57:39', '2026-01-14 02:57:39'),
(322, 'Jane', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'lhWH8EczByunZ4f7UYHznLgMq6lCUphdLgp1I7Tr', NULL, NULL, NULL, NULL, 'delivery', 'deposit', 275.00, 0.00, 0.00, 275.00, 'pending', NULL, 0, 'mpesa', 'mpesa', '2026-01-14 03:06:22', '2026-01-14 03:06:22'),
(323, 'WINROSYLINE', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, '4whDCTxX3n4FGqkXfLKP3hxuXSrM18JMpwp1hwgE', NULL, NULL, NULL, NULL, 'delivery', 'deposit', 275.00, 0.00, 0.00, 275.00, 'failed', 'ws_CO_14012026101010078794302073', 0, 'mpesa', 'mpesa', '2026-01-14 04:10:08', '2026-01-14 04:10:11'),
(324, 'Chicken Necks', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'dhUDGR2oSzORRUF5UyIBUYyd3KcPpuXrfy6EjRzZ', NULL, NULL, NULL, NULL, 'delivery', 'full', 1.00, 1.00, 0.00, 0.00, 'failed', 'ws_CO_14012026102325120794302073', 0, 'mpesa', 'mpesa', '2026-01-14 04:23:24', '2026-01-14 04:23:26'),
(325, 'WINROSYLINE', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'nRJcEGXK7qQ26XmazFP4yLYpdFYzxnaCZJosJDUW', NULL, NULL, NULL, NULL, 'delivery', 'full', 1.00, 1.00, 0.00, 0.00, 'failed', 'ws_CO_14012026103012540794302073', 0, 'mpesa', 'mpesa', '2026-01-14 04:30:11', '2026-01-14 04:30:13'),
(326, 'WINROSYLINE', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'IQ6iX1qhS7RrwXu0rGoaQouz11Hp3107EYrj9auY', NULL, NULL, NULL, NULL, 'delivery', 'full', 1.00, 1.00, 0.00, 0.00, 'failed', 'ws_CO_14012026103531498794302073', 0, 'mpesa', 'mpesa', '2026-01-14 04:35:30', '2026-01-14 04:35:32'),
(327, 'WINROSYLINE', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'TTXQhfzoP1fZMJffOLAFhLn6XRpAMDhdz3NQzFDE', NULL, NULL, NULL, NULL, 'delivery', 'full', 1.00, 1.00, 0.00, 0.00, 'paid', 'ws_CO_14012026104912331794302073', 0, 'mpesa', 'mpesa', '2026-01-14 04:49:10', '2026-01-14 04:49:26'),
(328, 'Chicken Necks', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'vuxC42gcbkOCRmE237Ew8ELyAzAg3IW734kP5mBl', NULL, NULL, NULL, NULL, 'delivery', 'full', 1.00, 1.00, 0.00, 0.00, 'failed', 'ws_CO_14012026105551823794302073', 0, 'mpesa', 'mpesa', '2026-01-14 04:55:50', '2026-01-14 04:55:52'),
(329, 'WINROSYLINE', '+254715763814', '+254715763814', 'wnnmax@gmail.com', NULL, 'fWFsuwk9fkEwNeqEAGVMnaPiC7HojagOq8uqf6JA', NULL, NULL, NULL, NULL, 'delivery', 'full', 275.00, 275.00, 0.00, 0.00, 'paid', 'ws_CO_14012026110032032715763814', 0, 'mpesa', 'mpesa', '2026-01-14 05:00:31', '2026-01-14 06:13:58'),
(330, 'WINROSYLINE', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'lzZuEGEOu1yiHW0jkSXZf7lCcsufQK32e6YtjOi1', NULL, NULL, NULL, NULL, 'delivery', 'full', 800.00, 0.00, 0.00, 800.00, 'failed', 'ws_CO_14012026115354499794302073', 0, 'mpesa', 'mpesa', '2026-01-14 05:53:53', '2026-01-14 05:53:55'),
(331, 'WINROSYLINE', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'b1ocYpfkCKPsBzq73a4WKn8K0RT8PKGE1gI7lTOK', NULL, NULL, NULL, NULL, 'delivery', 'full', 275.00, 0.00, 0.00, 275.00, 'failed', 'ws_CO_14012026122125638794302073', 0, 'mpesa', 'mpesa', '2026-01-14 06:21:24', '2026-01-14 06:21:26'),
(332, 'WINROSYLINE', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'b0HAlq9GjEi65dSRejNc3TbKEYo121NW1BMTHQUs', NULL, NULL, NULL, NULL, 'delivery', 'full', 1.00, 1.00, 0.00, 0.00, 'failed', 'ws_CO_14012026124823198794302073', 0, 'mpesa', 'mpesa', '2026-01-14 06:48:22', '2026-01-14 06:48:24'),
(333, 'Joy', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, '1cuyqx0VPxcjIlo3UFRA8k191E2oa06HX4mXzmJy', NULL, NULL, NULL, NULL, 'delivery', 'full', 1.00, 1.00, 0.00, 0.00, 'failed', 'ws_CO_14012026130402070794302073', 0, 'mpesa', 'mpesa', '2026-01-14 07:04:01', '2026-01-14 07:04:06'),
(334, 'WINROSYLINE', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'DOE5mJHW7UafhxZ6UXZAGIxTMysgzLF8cKsdCInm', NULL, NULL, NULL, NULL, 'delivery', 'full', 275.00, 0.00, 0.00, 275.00, 'failed', 'ws_CO_14012026131449106794302073', 0, 'mpesa', 'mpesa', '2026-01-14 07:14:48', '2026-01-14 07:14:51'),
(335, 'Jane', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'PcC7lyff8S1uS1Om0wdUSiehMUJvpc9EkGcMb4hu', NULL, NULL, NULL, NULL, 'delivery', 'full', 1.00, 1.00, 0.00, 0.00, 'failed', 'ws_CO_14012026131929990794302073', 0, 'mpesa', 'mpesa', '2026-01-14 07:19:28', '2026-01-14 07:19:30'),
(336, 'Attila farm', '0722253539', '0722253539', 'ann.kanyori@gmail.com', NULL, 'pFA0RrmTbEos5crdXoZpRa0uFbmm6aj0ZKcnnL0f', NULL, NULL, NULL, NULL, 'delivery', 'full', 2800.00, 0.00, 0.00, 2800.00, 'failed', 'ws_CO_14012026151251621722253539', 0, 'mpesa', 'mpesa', '2026-01-14 09:12:50', '2026-01-14 09:12:52'),
(337, 'WINROSYLINE', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'KMZTFYk6Jem2dltWLf6qArrbgZUUFABwDrMSqA0C', NULL, NULL, NULL, NULL, 'delivery', 'full', 1.00, 1.00, 0.00, 0.00, 'paid', 'ws_CO_14012026163748920794302073', 0, 'mpesa', 'mpesa', '2026-01-14 10:37:47', '2026-01-14 10:38:07'),
(338, 'WINROSYLINE', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, '8oJmtMrZh3GZSAr1pQ6EIABqBUwXEi9P5iTofv9i', NULL, NULL, NULL, NULL, 'delivery', 'full', 275.00, 275.00, 0.00, 0.00, 'paid', 'ws_CO_14012026163932819794302073', 0, 'mpesa', 'mpesa', '2026-01-14 10:39:31', '2026-01-14 10:39:42'),
(339, 'WINROSYLINE', '+254715763814', '0794302073', 'wnnmax@gmail.com', NULL, 'IDkwd3dxdcC2pT7LeTS21f6JVnxCD3pWMfDfe48q', NULL, NULL, NULL, NULL, 'delivery', 'full', 300.00, 300.00, 0.00, 0.00, 'paid', 'ws_CO_14012026165304689794302073', 0, 'mpesa', 'mpesa', '2026-01-14 10:53:02', '2026-01-14 10:53:15'),
(340, 'Faith', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'Kj7b2xuYy0BdELG9VxIi62b7FBLEiMf5XsCTxZqT', NULL, NULL, NULL, NULL, 'delivery', 'full', 275.00, 275.00, 0.00, 0.00, 'paid', 'ws_CO_14012026201001530794302073', 0, 'mpesa', 'mpesa', '2026-01-14 14:10:00', '2026-01-14 14:10:15'),
(341, 'Attila farm', '0722253539', '0722253539', 'ann.kanyori@gmail.com', NULL, 'myN3TaQ7LLUhrAmlzudhX6OgIbWfIZMl3pFZJMpW', NULL, NULL, NULL, NULL, 'delivery', 'full', 2564.00, 0.00, 0.00, 2564.00, 'pending', 'ws_CO_14012026201655940722253539', 0, 'mpesa', 'mpesa', '2026-01-14 14:16:54', '2026-01-14 14:17:24'),
(342, 'testing', '0712345678', '0712345678', 'testing@gmail.com', NULL, 'KpFp9ZF1RxlF0ZgEGnziIJtbOHnYHv5rncxqep8s', NULL, NULL, NULL, NULL, 'delivery', 'full', 576.00, 0.00, 0.00, 576.00, 'failed', 'ws_CO_14012026220319847712345678', 0, 'mpesa', 'mpesa', '2026-01-14 16:03:18', '2026-01-14 16:03:20'),
(343, 'Chicken Necks', '0794302073', '0794302073', 'wnnmax@gmail.com', NULL, 'nZ8voti7XtK9NMuNZioWQZKNCEKxRp523bWyB8XJ', NULL, NULL, NULL, NULL, 'delivery', 'full', 1.00, 1.00, 0.00, 0.00, 'paid', 'ws_CO_15012026083228991794302073', 0, 'mpesa', 'mpesa', '2026-01-15 02:32:27', '2026-01-15 02:32:45'),
(344, 'munyua v', '0748754850', '0748754850', NULL, NULL, 'xR6bs88CGSyClhZSBfrGF1eOCJgBMoFcY1JvjrG7', NULL, NULL, NULL, NULL, 'delivery', 'full', 2324.00, 2324.00, 0.00, 0.00, 'failed', 'ws_CO_18012026232310078748754850', 0, 'mpesa', 'mpesa', '2026-01-18 17:23:09', '2026-01-18 17:23:14'),
(345, 'Lucy Maina', '0746067799', '0746067799', 'lucy.maina45@gmail.com', NULL, 'oBZvuowus8mMM5nVU0vJBoZ2ewXGfR6NrpLHdkuF', NULL, NULL, NULL, NULL, 'delivery', 'full', 2340.00, 2340.00, 0.00, 0.00, 'failed', 'ws_CO_19012026073712629746067799', 0, 'mpesa', 'mpesa', '2026-01-19 01:37:11', '2026-01-19 01:37:16'),
(346, 'lizy', '0700009988', '0700009988', 'lizy@gmail.com', NULL, 'c5Wsg5SyhpQr2GLs51Tqvzm3MlnK3A9gHoVj84Iu', NULL, NULL, NULL, NULL, 'delivery', 'full', 3668.00, 3668.00, 0.00, 0.00, 'pending', 'ws_CO_05022026154803154700009988', 0, 'mpesa', 'mpesa', '2026-02-05 15:48:01', '2026-02-05 15:48:06'),
(347, 'testing', '0712345678', '0712345678', 'testing@gmail.com', NULL, '6MlUBGBSx89vv0JhHUFKAfjzjQ0r3iT6YhrtlB9k', NULL, NULL, NULL, NULL, 'delivery', 'full', 3216.00, 3216.00, 0.00, 0.00, 'failed', 'ws_CO_10022026082940855712345678', 0, 'mpesa', 'mpesa', '2026-02-10 08:29:39', '2026-02-10 08:29:42'),
(348, 'mary', '0722950719', '0722950719', 'mary@gmail.com', NULL, 'wnsxGIfLEAcWcjpzfqBFiD5TM5UsQuLFx69WV4fV', NULL, NULL, NULL, NULL, 'delivery', 'full', 5040.00, 5040.00, 0.00, 0.00, 'pending', 'ws_CO_10022026130515001722950719', 0, 'mpesa', 'mpesa', '2026-02-10 13:05:13', '2026-02-10 13:05:43'),
(349, 'james testing', '0748754849', '0748754849', 'james@gmail.com', NULL, 'ZZ8luYU79jLe8eshQpg77tHYCIWZVutloCLfIRZu', NULL, NULL, NULL, NULL, 'delivery', 'full', 5040.00, 5040.00, 0.00, 0.00, 'pending', 'ws_CO_10022026130558188748754849', 0, 'mpesa', 'mpesa', '2026-02-10 13:05:57', '2026-02-10 13:06:01');

-- --------------------------------------------------------

--
-- Table structure for table `order_audits`
--

CREATE TABLE `order_audits` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `admin_id` bigint(20) UNSIGNED NOT NULL,
  `action` varchar(255) NOT NULL,
  `notes` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `order_id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `product_variant_id` varchar(20) DEFAULT NULL,
  `quantity_kg` int(11) NOT NULL,
  `price_per_kg` decimal(10,2) NOT NULL,
  `subtotal` decimal(12,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `product_variant_id`, `quantity_kg`, `price_per_kg`, `subtotal`, `created_at`, `updated_at`) VALUES
(574, 320, 2, NULL, 4, 700.00, 2800.00, '2026-01-13 14:01:48', '2026-01-13 14:01:48'),
(575, 321, 43, NULL, 1, 275.00, 275.00, '2026-01-14 02:57:39', '2026-01-14 02:57:39'),
(576, 322, 43, NULL, 1, 275.00, 275.00, '2026-01-14 03:06:22', '2026-01-14 03:06:22'),
(577, 323, 43, NULL, 1, 275.00, 275.00, '2026-01-14 04:10:08', '2026-01-14 04:10:08'),
(578, 324, 51, NULL, 1, 1.00, 1.00, '2026-01-14 04:23:24', '2026-01-14 04:23:24'),
(579, 325, 51, NULL, 1, 1.00, 1.00, '2026-01-14 04:30:11', '2026-01-14 04:30:11'),
(580, 326, 51, NULL, 1, 1.00, 1.00, '2026-01-14 04:35:30', '2026-01-14 04:35:30'),
(581, 327, 51, NULL, 1, 1.00, 1.00, '2026-01-14 04:49:10', '2026-01-14 04:49:10'),
(582, 328, 51, NULL, 1, 1.00, 1.00, '2026-01-14 04:55:50', '2026-01-14 04:55:50'),
(583, 329, 43, NULL, 1, 275.00, 275.00, '2026-01-14 05:00:31', '2026-01-14 05:00:31'),
(584, 330, 44, NULL, 1, 800.00, 800.00, '2026-01-14 05:53:53', '2026-01-14 05:53:53'),
(585, 331, 43, NULL, 1, 275.00, 275.00, '2026-01-14 06:21:24', '2026-01-14 06:21:24'),
(586, 332, 51, NULL, 1, 1.00, 1.00, '2026-01-14 06:48:22', '2026-01-14 06:48:22'),
(587, 333, 51, NULL, 1, 1.00, 1.00, '2026-01-14 07:04:01', '2026-01-14 07:04:01'),
(588, 334, 43, NULL, 1, 275.00, 275.00, '2026-01-14 07:14:48', '2026-01-14 07:14:48'),
(589, 335, 51, NULL, 1, 1.00, 1.00, '2026-01-14 07:19:28', '2026-01-14 07:19:28'),
(590, 336, 2, NULL, 4, 700.00, 2800.00, '2026-01-14 09:12:50', '2026-01-14 09:12:50'),
(591, 337, 51, NULL, 1, 1.00, 1.00, '2026-01-14 10:37:47', '2026-01-14 10:37:47'),
(592, 338, 43, NULL, 1, 275.00, 275.00, '2026-01-14 10:39:31', '2026-01-14 10:39:31'),
(593, 339, 41, NULL, 1, 300.00, 300.00, '2026-01-14 10:53:02', '2026-01-14 10:53:02'),
(594, 340, 43, NULL, 1, 275.00, 275.00, '2026-01-14 14:10:00', '2026-01-14 14:10:00'),
(595, 341, 1, NULL, 1, 864.00, 864.00, '2026-01-14 14:16:54', '2026-01-14 14:16:54'),
(596, 341, 3, NULL, 1, 800.00, 800.00, '2026-01-14 14:16:54', '2026-01-14 14:16:54'),
(597, 341, 4, NULL, 1, 900.00, 900.00, '2026-01-14 14:16:54', '2026-01-14 14:16:54'),
(598, 342, 1, NULL, 1, 576.00, 576.00, '2026-01-14 16:03:18', '2026-01-14 16:03:18'),
(599, 343, 51, NULL, 1, 1.00, 1.00, '2026-01-15 02:32:27', '2026-01-15 02:32:27'),
(600, 344, 1, NULL, 1, 624.00, 624.00, '2026-01-18 17:23:09', '2026-01-18 17:23:09'),
(601, 344, 4, NULL, 1, 900.00, 900.00, '2026-01-18 17:23:09', '2026-01-18 17:23:09'),
(602, 344, 44, NULL, 1, 800.00, 800.00, '2026-01-18 17:23:09', '2026-01-18 17:23:09'),
(603, 345, 1, NULL, 1, 576.00, 576.00, '2026-01-19 01:37:11', '2026-01-19 01:37:11'),
(604, 345, 1, NULL, 1, 864.00, 864.00, '2026-01-19 01:37:11', '2026-01-19 01:37:11'),
(605, 345, 4, NULL, 1, 900.00, 900.00, '2026-01-19 01:37:11', '2026-01-19 01:37:11'),
(606, 346, 3, NULL, 1, 800.00, 800.00, '2026-02-05 15:48:01', '2026-02-05 15:48:01'),
(607, 346, 4, NULL, 1, 900.00, 900.00, '2026-02-05 15:48:01', '2026-02-05 15:48:01'),
(608, 346, 2, NULL, 1, 700.00, 700.00, '2026-02-05 15:48:01', '2026-02-05 15:48:01'),
(609, 346, 1, NULL, 1, 768.00, 768.00, '2026-02-05 15:48:01', '2026-02-05 15:48:01'),
(610, 346, 12, NULL, 1, 500.00, 500.00, '2026-02-05 15:48:01', '2026-02-05 15:48:01'),
(611, 347, 3, NULL, 1, 800.00, 800.00, '2026-02-10 08:29:39', '2026-02-10 08:29:39'),
(612, 347, 1, NULL, 1, 816.00, 816.00, '2026-02-10 08:29:39', '2026-02-10 08:29:39'),
(613, 347, 2, NULL, 1, 700.00, 700.00, '2026-02-10 08:29:39', '2026-02-10 08:29:39'),
(614, 347, 4, NULL, 1, 900.00, 900.00, '2026-02-10 08:29:39', '2026-02-10 08:29:39'),
(615, 348, 1, NULL, 1, 576.00, 576.00, '2026-02-10 13:05:14', '2026-02-10 13:05:14'),
(616, 348, 1, NULL, 1, 624.00, 624.00, '2026-02-10 13:05:14', '2026-02-10 13:05:14'),
(617, 348, 1, NULL, 1, 672.00, 672.00, '2026-02-10 13:05:14', '2026-02-10 13:05:14'),
(618, 348, 1, NULL, 1, 720.00, 720.00, '2026-02-10 13:05:14', '2026-02-10 13:05:14'),
(619, 348, 1, NULL, 1, 768.00, 768.00, '2026-02-10 13:05:14', '2026-02-10 13:05:14'),
(620, 348, 1, NULL, 1, 816.00, 816.00, '2026-02-10 13:05:14', '2026-02-10 13:05:14'),
(621, 348, 1, NULL, 1, 864.00, 864.00, '2026-02-10 13:05:14', '2026-02-10 13:05:14'),
(622, 349, 1, NULL, 1, 576.00, 576.00, '2026-02-10 13:05:57', '2026-02-10 13:05:57'),
(623, 349, 1, NULL, 1, 624.00, 624.00, '2026-02-10 13:05:57', '2026-02-10 13:05:57'),
(624, 349, 1, NULL, 1, 672.00, 672.00, '2026-02-10 13:05:57', '2026-02-10 13:05:57'),
(625, 349, 1, NULL, 1, 720.00, 720.00, '2026-02-10 13:05:57', '2026-02-10 13:05:57'),
(626, 349, 1, NULL, 1, 768.00, 768.00, '2026-02-10 13:05:57', '2026-02-10 13:05:57'),
(627, 349, 1, NULL, 1, 816.00, 816.00, '2026-02-10 13:05:57', '2026-02-10 13:05:57'),
(628, 349, 1, NULL, 1, 864.00, 864.00, '2026-02-10 13:05:57', '2026-02-10 13:05:57');

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `price_per_kg` decimal(8,2) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `stock` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `slug`, `description`, `price_per_kg`, `image`, `created_at`, `updated_at`, `stock`) VALUES
(1, 'Whole Chicken (Capon)', 'whole-chicken', 'Fresh, farm-raised Attila Whole Chicken (Capon), carefully nurtured on our sustainable Kenyan farm for premium quality and flavor. This whole chicken is naturally tender, juicy, and rich in protein, making it perfect for roasting, grilling, baking, or your favorite homemade recipes. \r\n\r\nWhy You’ll Love It:\r\nTender and juicy meat, full of natural flavor\r\nAntibiotic-free and raised with care\r\nSustainably farmed on Attila’s Kenyan poultry farm\r\nPerfect for family meals, special occasions, or festive cooking\r\nHigh-quality protein, rich in essential nutrients\r\nEasy to prepare and cook for various dishes\r\n\r\nEnjoy a wholesome and delicious chicken experience with Attila Whole Chicken (Capon), ideal for those seeking fresh, healthy, and flavorful poultry in Kenya.\r\n', 480.00, 'product-images/whole_chicken.png', '2025-09-15 03:22:45', '2025-09-29 03:44:03', NULL),
(2, 'Chicken Thighs', 'chicken-thighs', 'Fresh, farm-raised Attila Chicken Thighs, tender and juicy pieces sourced from our sustainable Kenyan farm. Perfect for grilling, baking, frying, or adding to your favorite chicken recipes.\r\n\r\nWhy You’ll Love It:\r\nTender and flavorful thigh meat full of natural taste\r\nAntibiotic-free and naturally raised on Kenyan farms\r\nHigh in protein and essential nutrients\r\nPerfect for family meals, special occasions, or festive cooking\r\nEasy to cook: grill, roast, bake, or fry\r\n', 700.00, 'product-images/chicken_thighs.png', '2025-09-15 03:22:45', '2025-09-29 03:44:03', NULL),
(3, 'Chicken Drumsticks', 'chicken-drumsticks', 'Savor the rich taste of our farm-fresh Chicken Drumsticks! Known for their juicy, tender meat and bold flavor, these drumsticks are perfect for roasting, grilling, frying, or baking. Each piece is carefully selected to ensure consistent quality, making every meal a delicious experience.\r\n\r\nWhy You’ll Love Our Chicken Drumsticks:\r\n\r\nPremium, farm-fresh quality\r\n\r\nJuicy, tender, and full of flavor\r\n\r\nIdeal for roasting, grilling, frying, or baking\r\n\r\nConvenient and ready to cook\r\n\r\nBring home our Chicken Drumsticks and turn any meal into a hearty, satisfying feast!', 800.00, 'product-images/chicken_drums.png', '2025-09-15 03:22:45', '2025-09-29 03:44:03', NULL),
(4, 'Chicken Wings', 'chicken-wings', 'Treat yourself to our fresh Chicken Wings, perfect for frying, baking, or grilling! These tender, flavorful wings are ideal for snacks, appetizers, or main dishes, delivering that irresistible taste every chicken lover craves. Hand-selected and carefully prepared, our wings bring convenience and premium quality to your kitchen.\r\n\r\nWhy You’ll Love Our Chicken Wings:\r\n\r\nFarm-fresh, high-quality chicken\r\n\r\nJuicy, tender, and full of flavor\r\n\r\nPerfect for frying, baking, or grilling\r\n\r\nReady to cook and enjoy\r\n\r\nEnjoy the ultimate chicken experience with our Chicken Wings – perfect for game days, gatherings, or everyday meals!', 900.00, 'product-images/chicken_wing.png', '2025-09-15 03:22:45', '2025-09-29 03:44:03', NULL),
(5, 'Chicken Breast Fillet', 'chicken-breast-fillet', 'Enjoy the premium taste of our fresh Chicken Breast Fillets! Lean, tender, and full of flavor, these fillets are perfect for grilling, baking, sautéing, or adding to salads and sandwiches. Hand-selected and carefully prepared, they offer convenience without compromising on quality or taste.\r\n\r\nWhy You’ll Love Our Chicken Breast Fillets:\r\n\r\nFarm-fresh, high-quality chicken\r\n\r\nLean, tender, and juicy\r\n\r\nPerfect for grilling, baking, or sautéing\r\n\r\nReady to cook and versatile for many recipes\r\n\r\nUpgrade your meals with our Chicken Breast Fillets – a healthy, delicious choice for any dish!', 1000.00, 'product-images/chicken_tenders.png', '2025-09-15 03:22:45', '2025-09-29 03:44:03', NULL),
(12, 'Chicken Backs', 'chicken-backs', 'Add rich, savory flavor to your soups, stocks, and stews with our fresh Chicken Backs! Packed with natural taste and nutrients, these backs are ideal for slow-cooked dishes, delivering a hearty, wholesome base for any recipe. Carefully cleaned and prepared, they make cooking homemade meals easy and delicious.\r\n\r\nWhy You’ll Love Our Chicken Backs:\r\n\r\nFarm-fresh and high-quality\r\n\r\nPerfect for soups, stocks, and stews\r\n\r\nRich in natural flavor and nutrients\r\n\r\nCarefully cleaned and ready to cook\r\n\r\nEnhance your cooking with our Chicken Backs – a versatile ingredient for deep, savory flavors in every dish!', 500.00, 'product-images/chicken_back.png', '2025-09-16 10:18:55', '2025-09-29 03:44:03', NULL),
(39, 'Assorted Pack', 'assorted-pack', 'Discover the ultimate convenience and flavor with our Assorted Chicken Pack! Perfect for families, meal preppers, or anyone who loves variety, this pack brings together a handpicked selection of our freshest cuts. From succulent drumsticks and tender thighs to juicy breasts and wings, every piece is carefully prepared to deliver unbeatable taste and quality.\r\n\r\nWhether you’re planning a hearty family dinner, a quick stir-fry, or grilling with friends, our Assorted Pack has you covered. Fresh, versatile, and ready to elevate any meal – it’s chicken, done your way.\r\n\r\nWhy You’ll Love It:\r\n\r\nPremium quality, farm-fresh chicken\r\n\r\nPerfect mix of cuts for all your recipes\r\n\r\nConvenient and ready to cook\r\n\r\nIdeal for families, meal prep, or gatherings\r\n\r\nExperience variety without compromise – order your Assorted Chicken Pack today!', 500.00, 'product-images/chickenassortedpack.jpg', NULL, NULL, NULL),
(40, 'Chicken Necks', 'chicken-necks', 'Unlock the rich taste and versatility of our fresh Chicken Necks! Perfect for making hearty broths, soups, and stews, these necks are packed with natural flavor and nutrients that elevate any dish. Carefully selected and cleaned, they’re a favorite among home cooks and chefs looking to add depth and richness to their recipes.\r\n\r\nWhy You’ll Love Our Chicken Necks:\r\n\r\nFarm-fresh and high quality\r\n\r\nIdeal for soups, stocks, and slow-cooked dishes\r\n\r\nPacked with natural protein and flavor\r\n\r\nCarefully cleaned and ready to cook\r\n\r\nTransform your meals with the savory goodness of our Chicken Necks – order now and taste the difference!', 350.00, 'product-images/chicken_necks.png', NULL, NULL, NULL),
(41, 'Chicken Legs/Feet', 'chicken-legs', 'Savor the rich taste of our farm-fresh Chicken Legs! Known for their juicy, tender meat and full flavor, these legs are perfect for roasting, grilling, frying, or slow-cooking. Each piece is carefully selected to ensure quality and consistency, making every meal a delicious experience.\r\n\r\nWhy You’ll Love Our Chicken Legs:\r\n\r\nPremium, farm-fresh quality\r\n\r\nJuicy, tender, and flavorful\r\n\r\nIdeal for grilling, roasting, frying, or stews\r\n\r\nConvenient and ready to cook\r\n\r\nBring home our Chicken Legs and turn any meal into a hearty, satisfying feast!', 300.00, 'product-images/chicken_feet.png', NULL, NULL, NULL),
(42, 'Chicken Gizzards', 'chicken-gizzards', 'Discover the rich taste and satisfying texture of our fresh Chicken Gizzards! Perfect for frying, stewing, or grilling, these protein-packed delicacies bring bold flavor to any meal. Carefully cleaned and hand-selected, our gizzards are ideal for traditional recipes, snacks, or hearty dishes.\r\n\r\nWhy You’ll Love Our Chicken Gizzards:\r\n\r\nFarm-fresh and high-quality\r\n\r\nRich in protein and nutrients\r\n\r\nPerfect for frying, stews, or grilling\r\n\r\nCarefully cleaned and ready to cook\r\n\r\nAdd our Chicken Gizzards to your kitchen and enjoy a delicious, versatile ingredient that elevates every dish!', 500.00, 'product-images/chicken_gizzards.png', NULL, NULL, NULL),
(43, 'Chicken Liver', 'chicken-liver', 'Elevate your meals with our fresh Chicken Liver! Packed with flavor and nutrients, these tender livers are perfect for frying, sautéing, grilling, or making classic pâtés and sauces. Hand-selected and carefully cleaned, they deliver a rich, savory taste that’s a favorite in many cuisines.\r\n\r\nWhy You’ll Love Our Chicken Liver:\r\n\r\nFarm-fresh, premium quality\r\n\r\nHigh in protein, iron, and essential nutrients\r\n\r\nIdeal for frying, sautéing, or specialty recipes\r\n\r\nCarefully cleaned and ready to cook\r\n\r\nBring home our Chicken Liver and enjoy a delicious, nutrient-rich ingredient that adds depth and flavor to every dish!', 275.00, 'product-images/chicken_liver.png', NULL, NULL, NULL),
(44, 'Chicken Winglets', 'chicken-winglets', 'Bring flavor-packed goodness to your table with our fresh Chicken Winglets! Ideal for frying, grilling, or baking, these tender, juicy pieces are perfect for snacks, appetizers, or main dishes. Hand-selected and carefully prepared, our winglets deliver that irresistible taste every chicken lover craves.\r\n\r\nWhy You’ll Love Our Chicken Winglets:\r\n\r\nFarm-fresh and premium quality\r\n\r\nJuicy, tender, and full of flavor\r\n\r\nPerfect for frying, grilling, or baking\r\n\r\nReady to cook and enjoy\r\n\r\nTreat yourself to our Chicken Winglets and turn every meal or snack time into a deliciously satisfying experience!', 800.00, 'product-images/chicken_wingettes.jpg', NULL, NULL, NULL),
(45, 'Chicken Bones', 'chicken-bones', 'Unlock rich, savory flavor with our fresh Chicken Bones! Ideal for making hearty soups, stews, and stocks, these bones are carefully selected to provide maximum taste and nutrition. Packed with natural gelatin and flavor, they’re a must-have for any home cook looking to create wholesome, homemade meals.\r\n\r\nWhy You’ll Love Our Chicken Bones:\r\n\r\nFarm-fresh and high-quality\r\n\r\nPerfect for soups, stews, and stocks\r\n\r\nRich in natural flavor and nutrients\r\n\r\nCarefully cleaned and ready to use\r\n\r\nTransform your cooking with our Chicken Bones and enjoy deep, savory flavors in every dish!', 250.00, 'product-images/chicken_bones.jpg', NULL, NULL, NULL),
(46, 'Chicken Stir Fry Strips', 'chicken-stirfrystrips', 'Make fast, delicious meals with our Chicken Stir Fry Strips. Thinly sliced for quick cooking, these strips are perfect for stir-fries, sautéed dishes, and Asian-inspired recipes, delivering tender, juicy chicken in minutes.\r\n\r\nWhy You’ll Love Our Chicken Stir Fry Strips:\r\n\r\nThin, bite-sized pieces for fast cooking\r\n\r\nIdeal for stir-fries, sautés, and quick meals\r\n\r\nTender, juicy, and full of flavor\r\n\r\nFarm-fresh, premium chicken\r\n\r\nThis way, your customers can clearly see the difference and choose the right product for their meal needs.', 900.00, 'product-images/chickenfrystrips.jpg', NULL, NULL, NULL),
(47, 'Chicken Sausages', 'chicken-sausages', 'Enjoy the delicious taste of our Chicken Sausages, crafted from high-quality chicken for a juicy, savory bite every time. Perfect for grilling, frying, or adding to your favorite dishes, these sausages bring convenience and flavor to any meal. Hand-prepared and ready to cook, they’re ideal for breakfast, lunch, dinner, or quick snacks.\r\n\r\nWhy You’ll Love Our Chicken Sausages:\r\n\r\nMade from farm-fresh, high-quality chicken\r\n\r\nJuicy, flavorful, and perfectly seasoned\r\n\r\nVersatile – great for grilling, frying, or cooking in recipes\r\n\r\nReady to cook and enjoy\r\n\r\nBring home our Chicken Sausages and elevate your meals with a tasty, protein-packed option!', 650.00, 'product-images/chicken_sausages.png', NULL, NULL, NULL),
(48, 'Eggs', 'eggs', 'Start your day with the wholesome goodness of our farm-fresh eggs! Perfect for boiling, frying, scrambling, baking, or adding to your favorite recipes, these eggs are packed with protein, essential nutrients, and rich flavor. Carefully sourced from healthy, free-range chickens, they deliver quality you can trust in every shell.\r\n\r\nWhy You’ll Love Our Eggs:\r\n\r\nFarm-fresh and high-quality\r\n\r\nPacked with protein and essential nutrients\r\n\r\nPerfect for cooking, baking, or enjoying on their own\r\n\r\nSourced from healthy, well-cared-for chickens\r\n\r\nEnjoy the simple, natural goodness of our eggs – a staple ingredient for healthy, delicious meals every day!', 350.00, 'product-images/eggs.png', NULL, NULL, NULL),
(49, 'Chicken Samosas', 'chicken-samosas', 'Satisfy your cravings with our freshly made Chicken Samosas! Filled with tender, flavorful chicken and perfectly seasoned spices, these golden, crispy pastries are ideal as snacks, appetizers, or party treats. Hand-prepared for quality and taste, they bring a burst of flavor in every bite.\r\n\r\nWhy You’ll Love Our Chicken Samosas:\r\n\r\nMade with farm-fresh, high-quality chicken\r\n\r\nCrispy, golden, and packed with flavor\r\n\r\nPerfect for snacks, appetizers, or gatherings\r\n\r\nReady to fry or bake for ultimate convenience\r\n\r\nTreat yourself to our Chicken Samosas – the perfect combination of savory, crispy, and irresistible!', 1500.00, 'product-images/chicken_samosas.jpg', NULL, NULL, NULL),
(50, 'Chicken Nuggets', 'chicken-nuggets', 'Enjoy the perfect snack or meal with our fresh Chicken Nuggets! Made from high-quality chicken and coated for a golden, crispy exterior, these nuggets are tender, juicy, and packed with flavor. Ideal for frying, baking, or serving with your favorite sauces, they’re a hit with kids and adults alike.\r\n\r\nWhy You’ll Love Our Chicken Nuggets:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nCrispy on the outside, juicy on the inside\r\n\r\nPerfect for snacks, meals, or party platters\r\n\r\nReady to cook and enjoy in minutes\r\n\r\nTreat yourself to our Chicken Nuggets – a convenient, delicious, and family-friendly option!', 850.00, 'product-images/chicken_nuggets.png', NULL, NULL, NULL),
(51, 'Chicken Meatballs', 'chicken-meatballs', 'Enjoy the delicious taste of our fresh Chicken Meatballs! Made from high-quality chicken and seasoned to perfection, these tender, juicy meatballs are ideal for pasta dishes, soups, sandwiches, or as a tasty snack. Hand-prepared for quality and flavor, they make meal prep quick, easy, and satisfying.\r\n\r\nWhy You’ll Love Our Chicken Meatballs:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nTender, juicy, and packed with flavor\r\n\r\nPerfect for pasta, soups, sandwiches, or appetizers\r\n\r\nReady to cook and enjoy in minutes\r\n\r\nBring home our Chicken Meatballs and elevate your meals with a convenient, protein-packed, and delicious option!', 1000.00, 'product-images/chicken_meatballs.jpg', NULL, '2026-02-07 10:39:47', NULL),
(52, 'Chicken Burger', 'chicken-burger', 'Satisfy your cravings with our fresh Chicken Burgers! Made from high-quality chicken and perfectly seasoned, these patties are juicy, tender, and full of flavor. Ideal for grilling, frying, or baking, they’re perfect for a quick meal, lunch, or dinner. Hand-prepared for quality and convenience, they make every burger experience delicious.\r\n\r\nWhy You’ll Love Our Chicken Burgers:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nJuicy, tender, and full of flavor\r\n\r\nPerfect for grilling, frying, or baking\r\n\r\nReady to cook and enjoy in minutes\r\n\r\nBring home our Chicken Burgers and enjoy a tasty, convenient, and satisfying meal anytime!', 875.00, 'product-images/chicken_burger.jpg', NULL, NULL, NULL),
(53, 'Chicken Patty', 'chicken-patty', 'Enjoy the delicious taste of our fresh Chicken Patties! Made from high-quality chicken and perfectly seasoned, these tender patties are ideal for sandwiches, burgers, or quick meals. Hand-prepared for quality and convenience, they bring juicy flavor and protein-packed goodness to every bite.\r\n\r\nWhy You’ll Love Our Chicken Patties:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nJuicy, tender, and full of flavor\r\n\r\nPerfect for sandwiches, burgers, or quick meals\r\n\r\nReady to cook and enjoy in minutes\r\n\r\nBring home our Chicken Patties and elevate your meals with a convenient, tasty, and protein-rich option!', 850.00, 'product-images/chicken_patty.jpg', NULL, NULL, NULL),
(54, 'Chicken Hot Dogs', 'chicken-hotdogs', 'Enjoy the classic taste of our Chicken Hot Dogs! Made from high-quality chicken, these hot dogs are juicy, savory, and perfectly seasoned for a satisfying bite every time. Ideal for grilling, boiling, or frying, they’re perfect for quick meals, snacks, or gatherings.\r\n\r\nWhy You’ll Love Our Chicken Hot Dogs:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nJuicy, flavorful, and perfectly seasoned\r\n\r\nGreat for grilling, boiling, or frying\r\n\r\nReady to cook and enjoy in minutes\r\n\r\nBring home our Chicken Hot Dogs and elevate your meals with a convenient, tasty, and protein-packed option!', 750.00, 'product-images/chicken_hotdogs.jpg', NULL, NULL, NULL),
(55, 'Chicken Fingers', 'chicken-fingers', 'Enjoy our Chicken Fingers, long, uniform strips made from premium chicken and coated for a golden, crispy finish. Perfect as a snack, appetizer, or kids’ favorite, they’re ready to fry or bake for a quick, delicious meal.\r\n\r\nWhy You’ll Love Our Chicken Fingers:\r\n\r\nCrispy on the outside, tender and juicy inside\r\n\r\nIdeal for snacking, party platters, or quick meals\r\n\r\nPerfect for frying or baking\r\n\r\nFarm-fresh, premium chicken', 850.00, 'product-images/chicken_fingers.jpg', NULL, NULL, NULL),
(56, 'Chicken Ham', 'chicken-ham', 'Enjoy the delicious taste of our Chicken Ham, made from high-quality chicken for a tender, juicy, and flavorful experience. Perfect for sandwiches, salads, breakfast dishes, or as a protein-packed snack, our ham is ready to eat or cook according to your favorite recipes.\r\n\r\nWhy You’ll Love Our Chicken Ham:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nTender, juicy, and full of flavor\r\n\r\nPerfect for sandwiches, salads, or snacks\r\n\r\nReady to eat or cook\r\n\r\nAdd our Chicken Ham to your meals for a convenient, tasty, and versatile protein option!', 1050.00, 'product-images/chicken_ham.jpg', NULL, NULL, NULL),
(57, 'Chicken Strips', 'chicken-strips', 'Our Chicken Strips are thick, tender pieces perfect for versatile cooking. Ideal for sandwiches, salads, wraps, or quick stir-fries, they make meal prep effortless while delivering juicy, flavorful chicken every time.\r\n\r\nWhy You’ll Love Our Chicken Strips:\r\n\r\nTender, juicy, and packed with flavor\r\n\r\nGreat for sandwiches, salads, or sautéed dishes\r\n\r\nPerfect for frying, baking, or pan-cooking\r\n\r\nFarm-fresh, high-quality chicken', 1050.00, 'product-images/chickenfrystrips.jpg', NULL, NULL, NULL),
(58, 'Chicken Salamis', 'chicken-salamis', 'Savor the rich taste of our Chicken Salamis, made from high-quality chicken for a tender, flavorful, and protein-packed treat. Perfect for sandwiches, pizzas, charcuterie boards, or as a convenient snack, our salamis are ready to eat and guaranteed to satisfy your cravings.\r\n\r\nWhy You’ll Love Our Chicken Salamis:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nSavory, tender, and full of flavor\r\n\r\nPerfect for sandwiches, pizzas, or snacks\r\n\r\nReady to eat and convenient for any meal\r\n\r\nAdd our Chicken Salamis to your pantry and enjoy a versatile, delicious, and protein-rich option anytime!', 1000.00, 'product-images/b.jpg', NULL, NULL, NULL),
(59, 'Chicken Spring Drums', 'chicken-springdrums', 'Enjoy the delicious taste of our Chicken Spring Drums! These small, tender drumettes are packed with juicy flavor and perfect for frying, grilling, baking, or roasting. Ideal as appetizers, party snacks, or part of a hearty meal, they’re hand-selected and ready to cook for your convenience.\r\n\r\nWhy You’ll Love Our Chicken Spring Drums:\r\n\r\nFarm-fresh, premium-quality chicken\r\n\r\nTender, juicy, and full of flavor\r\n\r\nPerfect for frying, grilling, baking, or roasting\r\n\r\nIdeal as snacks, appetizers, or main dishes\r\n\r\nTreat yourself to our Chicken Spring Drums and bring a flavorful, convenient, and satisfying option to your table!', 1050.00, 'product-images/chicken_springdrums.jpg', NULL, NULL, NULL),
(61, 'Chicken Brawn', 'chicken-brawn', 'Experience the rich taste of our Chicken Brawn, made from high-quality chicken for a tender, flavorful, and protein-packed treat. Perfect for sandwiches, snacks, or as part of a hearty meal, this ready-to-eat delicacy brings convenience and delicious flavor to your table.\r\n\r\nWhy You’ll Love Our Chicken Brawn:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nTender, flavorful, and packed with protein\r\n\r\nIdeal for sandwiches, snacks, or quick meals\r\n\r\nReady to eat and convenient\r\n\r\nAdd our Chicken Brawn to your pantry and enjoy a versatile, delicious, and easy-to-serve chicken product anytime!', 520.00, 'product-images/chicken_brawnies.jpg', NULL, NULL, NULL),
(62, 'Chicken Rolls', 'chicken-rolls', 'Treat yourself to our freshly made Chicken Rolls! Filled with tender, flavorful chicken and perfectly seasoned, these rolls are ideal as snacks, appetizers, or quick meals. Hand-prepared for quality and taste, they’re ready to fry, bake, or enjoy as-is for a convenient, delicious option anytime.\r\n\r\nWhy You’ll Love Our Chicken Rolls:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nTender, juicy, and packed with flavor\r\n\r\nPerfect for snacks, appetizers, or quick meals\r\n\r\nReady to cook or enjoy immediately\r\n\r\nEnjoy the convenience and taste of our Chicken Rolls – a satisfying, versatile option for any occasion!', 1100.00, 'product-images/chicken_rolls.jpg', NULL, NULL, NULL),
(64, 'Chicken Mini Bites', 'chicken-mini-bites', 'Enjoy the perfect snack or appetizer with our Chicken Mini Bites! Made from premium chicken and perfectly seasoned, these small, tender pieces are ideal for frying, baking, or adding to your favorite dishes. Quick, convenient, and delicious, they’re perfect for parties, snacks, or anytime you crave a tasty protein-packed bite.\r\n\r\nWhy You’ll Love Our Chicken Mini Bites:\r\n\r\nMade from farm-fresh, high-quality chicken\r\n\r\nBite-sized, tender, and packed with flavor\r\n\r\nPerfect for snacks, appetizers, or quick meals\r\n\r\nReady to cook and enjoy in minutes\r\n\r\nTreat yourself to our Chicken Mini Bites – convenient, flavorful, and irresistible for every occasion!', 750.00, 'product-images/chicken_bites.jpg', NULL, NULL, NULL),
(65, 'Chicken Polony', 'chicken-polony', 'Enjoy the smooth, flavorful taste of our Chicken Polony! Made from high-quality chicken, this versatile product is perfect for sandwiches, snacks, breakfast dishes, or quick meals. Convenient and ready to eat or cook, it delivers a tasty, protein-packed option for any occasion.\r\n\r\nWhy You’ll Love Our Chicken Polony:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nSmooth, tender, and full of flavor\r\n\r\nPerfect for sandwiches, snacks, or quick meals\r\n\r\nReady to eat or cook\r\n\r\nAdd our Chicken Polony to your kitchen for a convenient, delicious, and versatile chicken product that everyone will love!', 500.00, 'product-images/chicken_polonies.jpg', NULL, NULL, NULL),
(66, 'Chicken Viena', 'chicken-viena', 'Savor the delicious taste of our Chicken Viennas! Made from high-quality chicken, these juicy, tender sausages are perfect for quick meals, snacks, or breakfast. Convenient and versatile, they’re ideal for boiling, frying, or grilling, bringing flavor and protein to every meal.\r\n\r\nWhy You’ll Love Our Chicken Viennas:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nJuicy, tender, and full of flavor\r\n\r\nPerfect for boiling, frying, or grilling\r\n\r\nReady to cook and enjoy in minutes\r\n\r\nBring home our Chicken Viennas and enjoy a convenient, tasty, and protein-packed option for any occasion!', 800.00, 'product-images/chicken_viena.jpg', NULL, NULL, NULL),
(67, 'Smoked Chicken Sausages', 'smoked-chicken-sausages', 'Experience the bold, smoky taste of our Smoked Chicken Sausages! Made from high-quality chicken and carefully smoked for a rich, savory flavor, these sausages are perfect for grilling, frying, or adding to your favorite recipes. Convenient and ready to cook, they bring a delicious, protein-packed option to any meal.\r\n\r\nWhy You’ll Love Our Smoked Chicken Sausages:\r\n\r\nMade from farm-fresh, premium chicken\r\n\r\nRich, smoky, and full of flavor\r\n\r\nPerfect for grilling, frying, or cooking in recipes\r\n\r\nReady to cook and enjoy in minutes\r\n\r\nAdd our Smoked Chicken Sausages to your meals and enjoy a convenient, tasty, and protein-rich option anytime!', 550.00, 'product-images/smoked_sausages.jpg', NULL, NULL, NULL),
(69, 'Spring Chicken', 'spring-kitchen', 'Enjoy the natural taste and tenderness of our farm-fresh Spring Chicken! Perfect for roasting, grilling, or braising, this young chicken delivers juicy, flavorful meat that’s ideal for family meals, special occasions, or everyday cooking. Carefully selected for quality, it ensures a wholesome and satisfying dining experience.\r\n\r\nWhy You’ll Love Our Spring Chicken:\r\n\r\nFarm-fresh, high-quality chicken\r\n\r\nTender, juicy, and naturally flavorful\r\n\r\nPerfect for roasting, grilling, or braising\r\n\r\nIdeal for family meals, gatherings, or everyday cooking\r\n\r\nBring home our Spring Chicken and enjoy a versatile, premium-quality option for all your delicious meals!', 700.00, 'product-images/spring_chicken.jpg', NULL, NULL, NULL),
(70, 'Lemon & Herb Marinated Chicken', 'lemon-herb-marinated-chicken', 'Elevate your meals with our Lemon & Herb Marinated Chicken! Carefully marinated with fresh herbs and zesty lemon, this tender chicken is bursting with flavor and ready to grill, bake, or roast. Perfect for quick, delicious meals, it brings a refreshing twist to any dish.\r\n\r\nWhy You’ll Love Our Lemon & Herb Marinated Chicken:\r\n\r\nFarm-fresh, premium-quality chicken\r\n\r\nTender, juicy, and perfectly marinated\r\n\r\nBursting with zesty lemon and aromatic herbs\r\n\r\nReady to cook and enjoy\r\n\r\nBring home our Lemon & Herb Marinated Chicken and enjoy a convenient, flavorful, and succulent option for any meal!', 750.00, 'product-images/herblemonmarinated.jpg', NULL, NULL, NULL),
(71, 'Barbeque Marinated Chicken', 'barbeque-marinated-chicken', 'Bring the taste of the grill to your kitchen with our Barbeque Marinated Chicken! Carefully marinated in a rich, smoky BBQ sauce, this tender chicken is bursting with flavor and perfect for grilling, baking, or roasting. Ideal for quick meals, family dinners, or weekend feasts, it’s a convenient way to enjoy mouthwatering BBQ at home.\r\n\r\nWhy You’ll Love Our Barbeque Marinated Chicken:\r\n\r\nFarm-fresh, premium-quality chicken\r\n\r\nTender, juicy, and perfectly marinated\r\n\r\nRich, smoky BBQ flavor in every bite\r\n\r\nReady to cook and enjoy\r\n\r\nElevate your meals with our Barbeque Marinated Chicken – a delicious, hassle-free way to enjoy BBQ anytime!', 600.00, 'product-images/marinatedbbqchicken.jpg', NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `product_variants`
--

CREATE TABLE `product_variants` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `product_id` bigint(20) UNSIGNED NOT NULL,
  `weight` decimal(4,2) NOT NULL,
  `price` decimal(8,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `product_variants`
--

INSERT INTO `product_variants` (`id`, `product_id`, `weight`, `price`, `created_at`, `updated_at`) VALUES
(1, 1, 1.20, 576.00, '2025-09-29 03:51:27', '2025-09-29 03:51:27'),
(2, 1, 1.30, 624.00, '2025-09-29 03:51:27', '2025-09-29 03:51:27'),
(3, 1, 1.40, 672.00, '2025-09-29 03:51:27', '2025-09-29 03:51:27'),
(4, 1, 1.50, 720.00, '2025-09-29 03:51:27', '2025-09-29 03:51:27'),
(5, 1, 1.60, 768.00, '2025-09-29 03:51:27', '2025-09-29 03:51:27'),
(6, 1, 1.70, 816.00, '2025-09-29 03:51:27', '2025-09-29 03:51:27'),
(7, 1, 1.80, 864.00, '2025-09-29 03:51:27', '2025-09-29 03:51:27');

-- --------------------------------------------------------

--
-- Table structure for table `routes`
--

CREATE TABLE `routes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `delivery_day` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `routes`
--

INSERT INTO `routes` (`id`, `name`, `delivery_day`, `created_at`, `updated_at`) VALUES
(16, 'Ngong Road - Community to Kiserian', 'Monday', NULL, NULL),
(17, 'Thika Road - Globe Cinema Roundabout to Kenol', 'Tuesday', NULL, NULL),
(18, 'CBD, Upper Hill, Westlands, Kilimani, Kileleshwa, Lavington', 'Wednesday', NULL, NULL),
(19, 'Eastern Bypass - Kamakis to Athi River', 'Thursday', NULL, NULL),
(20, 'Northern Bypass - Ruiru town to Limuru town', 'Friday', NULL, NULL),
(21, 'Southern Bypass - Likoni Rd to Kikuyu Town', 'Saturday', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('6nKyLJc8UbQvJHY8S6gJPa6WkRz9HBEYskQXZQTb', NULL, '105.161.171.227', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) SamsungBrowser/28.0 Chrome/130.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoidU1MMHAwZG52dUQxOG5QaDVQcTl4STRYbXhEdlYzVEtnNHY3NU1GRiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTIyOiJodHRwczovL2Vjb21tZXJjZS53aW5uaWVtdXJpdWtpLmNvLmtlLz9fdG9rZW49dU1MMHAwZG52dUQxOG5QaDVQcTl4STRYbXhEdlYzVEtnNHY3NU1GRiZwcm9kdWN0X2lkPTEmcXVhbnRpdHk9MSZ2YXJpYW50X2lkPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758790035),
('8Yru6aJZ0vIS3csKVSj8UDfe8lVTxiLhuS772L9Z', NULL, '52.159.249.111', 'Mozilla/5.0 AppleWebKit/537.36 (KHTML, like Gecko); compatible; ChatGPT-User/1.0; +https://openai.com/bot', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWXdLMHpQblRGWnZMTGJpTTNJNjk1cjAwc3hZcjdTSkxSa2R0V09pWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTIyOiJodHRwczovL2Vjb21tZXJjZS53aW5uaWVtdXJpdWtpLmNvLmtlLz9fdG9rZW49Q2h1T0RLaDN3UG45cnFKTGpMdFN1VW1xUzNLVk9ZYlBHeFhJRVRBOCZwcm9kdWN0X2lkPTEmcXVhbnRpdHk9MiZ2YXJpYW50X2lkPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758792528),
('hINjrZS0Yxr6BVTByQPwqw33RbSehcovOnvGFGQp', NULL, '197.248.196.227', 'WhatsApp/2.2535.3 W', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoieVJXRWREQVo0V2lYUkRvc1h5WUZ2NEwwNWwwZFNlQWVzWm1qdFZSTiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6Mzc6Imh0dHBzOi8vZWNvbW1lcmNlLndpbm5pZW11cml1a2kuY28ua2UiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1758789212),
('IsPORISPGxvz8fTK6jaYw8tJTCQ7Zc4XLL1RCBSf', NULL, '74.125.210.168', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiaW5tN2VYNjFZVzZXU083MFRYZ2JGSlhVdFJTMFNvaDEweGdUNE1YNyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTIyOiJodHRwczovL2Vjb21tZXJjZS53aW5uaWVtdXJpdWtpLmNvLmtlLz9fdG9rZW49NnB5akNOSFVCbUtwQm9IZzdmNEJjS1BGdHZhWnNBV3d4M0pLS2l1eiZwcm9kdWN0X2lkPTImcXVhbnRpdHk9MSZ2YXJpYW50X2lkPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758793758),
('ivNDbTt1xbJl35eKpRbBQJ8uFHg6qxj6Z2TsrtDp', NULL, '74.125.210.167', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoicnJVRTU4TE4xY2RRdk5qamJlQlBwcmV6WHNXUGN4amc0bWdHcHZFZiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTIyOiJodHRwczovL2Vjb21tZXJjZS53aW5uaWVtdXJpdWtpLmNvLmtlLz9fdG9rZW49NnB5akNOSFVCbUtwQm9IZzdmNEJjS1BGdHZhWnNBV3d4M0pLS2l1eiZwcm9kdWN0X2lkPTImcXVhbnRpdHk9MSZ2YXJpYW50X2lkPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758793757),
('KtJZD0ijhwM6dhzePfn57WSbd91hp09TBxuhohjq', NULL, '105.160.72.54', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQ2h1T0RLaDN3UG45cnFKTGpMdFN1VW1xUzNLVk9ZYlBHeFhJRVRBOCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTIyOiJodHRwczovL2Vjb21tZXJjZS53aW5uaWVtdXJpdWtpLmNvLmtlLz9fdG9rZW49Q2h1T0RLaDN3UG45cnFKTGpMdFN1VW1xUzNLVk9ZYlBHeFhJRVRBOCZwcm9kdWN0X2lkPTEmcXVhbnRpdHk9MSZ2YXJpYW50X2lkPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758794411),
('MJE9uUH1aSfnKCJkqIiIOpMpjgwuifGHKHXJfXQs', NULL, '105.160.72.54', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Mobile Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiNnB5akNOSFVCbUtwQm9IZzdmNEJjS1BGdHZhWnNBV3d4M0pLS2l1eiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vZWNvbW1lcmNlLndpbm5pZW11cml1a2kuY28ua2UvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758793815),
('QanQFkdQXqsxByj8P9J8M3iRMfESXDkJ38Jd99jK', NULL, '66.249.93.36', 'Mozilla/5.0 (Linux; Android 10; K) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/138.0.0.0 Mobile Safari/537.36 (compatible; Google-Read-Aloud; +https://support.google.com/webmasters/answer/1061943)', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiQXZZQlhWUW1ydXlWdWo5ZDZna1luSjI0RWtxNk5sdHB4OXFFWGg1RiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MTIyOiJodHRwczovL2Vjb21tZXJjZS53aW5uaWVtdXJpdWtpLmNvLmtlLz9fdG9rZW49NnB5akNOSFVCbUtwQm9IZzdmNEJjS1BGdHZhWnNBV3d4M0pLS2l1eiZwcm9kdWN0X2lkPTImcXVhbnRpdHk9MSZ2YXJpYW50X2lkPSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758793757),
('S5qrNGrmNkogDAAGYsNTQWGmrtIx0gebjMophGtm', NULL, '197.248.196.227', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/140.0.0.0 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiWE83cnk0SHRYTWkxVWJ0NnVsbEc1cXRmc3Y3TEpqRzAzTHlqbkxMWiI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6NDI6Imh0dHBzOi8vZWNvbW1lcmNlLndpbm5pZW11cml1a2kuY28ua2UvaG9tZSI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fX0=', 1758786793);

-- --------------------------------------------------------

--
-- Table structure for table `subscriptions`
--

CREATE TABLE `subscriptions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `subscriptions`
--

INSERT INTO `subscriptions` (`id`, `email`, `created_at`, `updated_at`) VALUES
(1, 'wnnmax@gmail.com', '2025-09-29 10:34:45', '2025-09-29 10:34:45');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'customer',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Test User', 'test@example.com', '2025-09-15 03:22:45', '$2y$12$IncsXCENcaspIDWfMJ1Q7OLWRSMNzaJM/B/Yjg2e2Io1RJHKbQLG2', 'customer', 'DzsBS1mOFB', '2025-09-15 03:22:46', '2025-09-15 03:22:46'),
(3, 'Admin', 'admin@ecommerce.test', NULL, '$2y$12$7irlet7.IdOPpF4N32RP1eJVQh2dKDBiP7hr8CzY9c/Np6zK8/Ama', 'admin', NULL, '2025-09-17 06:31:30', '2025-09-17 06:31:30');

-- --------------------------------------------------------

--
-- Table structure for table `withdrawal_requests`
--

CREATE TABLE `withdrawal_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `investor_id` bigint(20) UNSIGNED NOT NULL,
  `type_of_withdrawal` enum('full','partial') NOT NULL,
  `amount_requested` decimal(15,2) NOT NULL,
  `reason` text DEFAULT NULL,
  `preferred_payment_date` date NOT NULL,
  `bank_name` varchar(255) DEFAULT NULL,
  `branch` varchar(255) DEFAULT NULL,
  `account_name` varchar(255) DEFAULT NULL,
  `account_number` varchar(255) DEFAULT NULL,
  `swift_code` varchar(255) DEFAULT NULL,
  `bank_address` varchar(255) DEFAULT NULL,
  `signature` varchar(255) DEFAULT NULL,
  `signature_date` date DEFAULT NULL,
  `application_received_by` varchar(255) DEFAULT NULL,
  `date_received` date DEFAULT NULL,
  `approved_amount` decimal(15,2) DEFAULT NULL,
  `approval_status` enum('pending','approved','deferred','declined') NOT NULL DEFAULT 'pending',
  `comments` text DEFAULT NULL,
  `authorized_by` varchar(255) DEFAULT NULL,
  `authorized_signature` varchar(255) DEFAULT NULL,
  `authorized_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `investment_id` bigint(20) UNSIGNED DEFAULT NULL,
  `signature_path` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `withdrawal_requests`
--

INSERT INTO `withdrawal_requests` (`id`, `investor_id`, `type_of_withdrawal`, `amount_requested`, `reason`, `preferred_payment_date`, `bank_name`, `branch`, `account_name`, `account_number`, `swift_code`, `bank_address`, `signature`, `signature_date`, `application_received_by`, `date_received`, `approved_amount`, `approval_status`, `comments`, `authorized_by`, `authorized_signature`, `authorized_date`, `created_at`, `updated_at`, `investment_id`, `signature_path`) VALUES
(6, 8, 'full', 1957500.00, 'SDRFTYGHJ', '2026-01-01', 'KINGDOM BANK', NULL, 'PAUL WAWERU MBURU', '3081901367004', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pending', NULL, NULL, NULL, NULL, '2025-12-17 10:02:32', '2025-12-17 10:02:32', 9, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `bank_accounts_investor_id_foreign` (`investor_id`);

--
-- Indexes for table `cache`
--
ALTER TABLE `cache`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `cache_locks`
--
ALTER TABLE `cache_locks`
  ADD PRIMARY KEY (`key`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `guest_carts`
--
ALTER TABLE `guest_carts`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guest_carts_session_id_unique` (`session_id`);

--
-- Indexes for table `investments`
--
ALTER TABLE `investments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `investments_contract_number_unique` (`contract_number`),
  ADD KEY `investments_investor_id_foreign` (`investor_id`);

--
-- Indexes for table `investors`
--
ALTER TABLE `investors`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `investors_id_number_unique` (`id_number`),
  ADD UNIQUE KEY `investors_email_unique` (`email`);

--
-- Indexes for table `invitations`
--
ALTER TABLE `invitations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invitations_token_unique` (`token`),
  ADD KEY `invitations_event_id_foreign` (`event_id`);

--
-- Indexes for table `jobs`
--
ALTER TABLE `jobs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `jobs_queue_index` (`queue`);

--
-- Indexes for table `job_batches`
--
ALTER TABLE `job_batches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `guest_token` (`guest_token`),
  ADD UNIQUE KEY `payment_token` (`payment_token`);

--
-- Indexes for table `order_audits`
--
ALTER TABLE `order_audits`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_audits_order_id_foreign` (`order_id`),
  ADD KEY `order_audits_admin_id_foreign` (`admin_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_items_order_id_foreign` (`order_id`),
  ADD KEY `order_items_product_id_foreign` (`product_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD PRIMARY KEY (`id`),
  ADD KEY `product_variants_product_id_foreign` (`product_id`);

--
-- Indexes for table `routes`
--
ALTER TABLE `routes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `subscriptions`
--
ALTER TABLE `subscriptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subscriptions_email_unique` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `withdrawal_requests_investor_id_foreign` (`investor_id`),
  ADD KEY `investment_id` (`investment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `guest_carts`
--
ALTER TABLE `guest_carts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `investments`
--
ALTER TABLE `investments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `investors`
--
ALTER TABLE `investors`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `invitations`
--
ALTER TABLE `invitations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=185;

--
-- AUTO_INCREMENT for table `jobs`
--
ALTER TABLE `jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=350;

--
-- AUTO_INCREMENT for table `order_audits`
--
ALTER TABLE `order_audits`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=629;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=74;

--
-- AUTO_INCREMENT for table `product_variants`
--
ALTER TABLE `product_variants`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `routes`
--
ALTER TABLE `routes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `subscriptions`
--
ALTER TABLE `subscriptions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bank_accounts`
--
ALTER TABLE `bank_accounts`
  ADD CONSTRAINT `bank_accounts_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `investments`
--
ALTER TABLE `investments`
  ADD CONSTRAINT `investments_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `invitations`
--
ALTER TABLE `invitations`
  ADD CONSTRAINT `invitations_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_audits`
--
ALTER TABLE `order_audits`
  ADD CONSTRAINT `order_audits_admin_id_foreign` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_audits_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_order_id_foreign` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `order_items_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `product_variants`
--
ALTER TABLE `product_variants`
  ADD CONSTRAINT `product_variants_product_id_foreign` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `withdrawal_requests`
--
ALTER TABLE `withdrawal_requests`
  ADD CONSTRAINT `fk_withdrawal_investment` FOREIGN KEY (`investment_id`) REFERENCES `investments` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `withdrawal_requests_investor_id_foreign` FOREIGN KEY (`investor_id`) REFERENCES `investors` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
