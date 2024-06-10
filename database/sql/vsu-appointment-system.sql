-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 10, 2024 at 04:47 AM
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
-- Database: `vsu-appointment-system`
--

-- --------------------------------------------------------

--
-- Table structure for table `blocked_dates`
--

CREATE TABLE `blocked_dates` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `date` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `credentials`
--

CREATE TABLE `credentials` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_email_id` bigint(20) UNSIGNED DEFAULT NULL,
  `requester_name` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `file_id` varchar(255) NOT NULL,
  `file_name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `credentials`
--

INSERT INTO `credentials` (`id`, `user_id`, `verified_email_id`, `requester_name`, `school_id`, `file_id`, `file_name`, `created_at`, `updated_at`) VALUES
(2, 6, NULL, 'Eli Daniel', '18-1-00482', '1486Q2cogd3arh4qM6d-i5Xu155KpVGos', 'VSU LOGO.jpg', '2024-05-15 18:53:51', '2024-05-15 18:53:51'),
(6, NULL, 2, 'Eli Daniel Monteroso', '18-1-00907', '1BM6kZCLTPAjKaSEFOIfI67nNxmyW47GG', 'IMG_0243.jpeg', '2024-05-16 20:06:02', '2024-05-16 20:06:02'),
(7, NULL, 2, 'Eli Daniel Monteroso', '18-1-00907', '1ytF1keNRSbs3EGD6bzf7xkc_HZrrgemZ', '83F3FE2B-4180-434B-9725-9925684C47EA.jpeg', '2024-05-16 20:06:05', '2024-05-16 20:06:05'),
(8, 7, NULL, 'Eli Daniel Monteroso', '18-1-00999', '1twVq3otkGboMRU0S3TZO1VqUqfOtvPg4', 'image.jpg', '2024-05-16 20:09:09', '2024-05-16 20:09:09'),
(9, 8, NULL, 'hello', '18-1-00508', '1-8x6XNlIkDO8k3jEV1Fnzg6C8ZcqfbJj', '439832138_434531602667162_2342303600400131800_n.jpg', '2024-05-16 20:40:23', '2024-05-16 20:40:23'),
(11, NULL, 3, 'Joshua Mhel Boncalon', '10-1-00689', '1r3tftojLJVUNVj5CZhGB-hiTXR56Minz', 'Screenshot_2024-05-19-06-00-16-69_92b64b2a7aa6eb3771ed6e18d0029815.jpg', '2024-05-21 17:08:36', '2024-05-21 17:08:36'),
(14, NULL, 4, 'Clyde Xavier Salar', '21-1-01025', '1_OaDaiFO8w7JtGO7jXUpoG5rVa0pr_Kd', 'Untitled.png', '2024-05-21 23:23:14', '2024-05-21 23:23:14');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `document_type_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `soft_copy_available` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `name`, `document_type_id`, `price`, `created_at`, `updated_at`, `soft_copy_available`) VALUES
(1, 'Graduate TOR', 1, 200.00, '2024-05-14 18:43:49', '2024-05-21 19:36:03', 1),
(2, 'GWA/GPA', 2, 60.00, '2024-05-15 18:42:59', '2024-05-19 17:57:17', 1),
(3, 'GRADES (Certification of acquired grade)', 2, 60.00, '2024-05-15 18:44:19', '2024-05-15 18:44:19', 0),
(4, 'Course Description', 2, 60.00, '2024-05-15 18:46:35', '2024-05-15 18:46:35', 0),
(5, 'Units Earned', 2, 60.00, '2024-05-15 18:47:31', '2024-05-15 18:47:31', 0),
(6, 'Undergraduate Official TOR', 1, 430.00, '2024-05-15 18:48:02', '2024-05-15 18:48:02', 0);

-- --------------------------------------------------------

--
-- Table structure for table `document_processes`
--

CREATE TABLE `document_processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_processes`
--

INSERT INTO `document_processes` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'Signature of the President', '2024-05-14 18:42:19', '2024-05-14 18:42:19'),
(2, 'Documentary Stamp', '2024-05-15 18:43:14', '2024-05-15 18:43:14');

-- --------------------------------------------------------

--
-- Table structure for table `document_process_pivot`
--

CREATE TABLE `document_process_pivot` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `document_process_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_process_pivot`
--

INSERT INTO `document_process_pivot` (`id`, `document_id`, `document_process_id`, `created_at`, `updated_at`) VALUES
(1, 1, 1, NULL, NULL),
(2, 2, 1, NULL, NULL),
(3, 4, 1, NULL, NULL),
(4, 4, 2, NULL, NULL),
(5, 5, 1, NULL, NULL),
(6, 5, 2, NULL, NULL),
(7, 6, 1, NULL, NULL),
(8, 6, 2, NULL, NULL),
(9, 2, 2, NULL, NULL),
(11, 1, 2, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `document_types`
--

CREATE TABLE `document_types` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `document_types`
--

INSERT INTO `document_types` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'N/A', '2024-05-14 18:41:56', '2024-05-14 18:41:56'),
(2, 'Certificates', '2024-05-15 18:42:00', '2024-05-15 18:42:00');

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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(8, '2024_03_01_154143_create_document_document_process_table', 2),
(74, '2024_02_26_051925_add_role_to_users_table', 3),
(75, '2024_03_01_133927_create_document_types_table', 3),
(76, '2024_03_01_133928_create_documents_table', 3),
(77, '2024_03_01_133948_create_document_processes_table', 3),
(78, '2024_03_01_154143_create_document_process_pivot_table', 3),
(79, '2024_03_06_184438_create_verified_emails_table', 3),
(80, '2024_03_07_133928_create_requests_table', 3),
(81, '2024_03_07_134545_create_request_documents_table', 3),
(82, '2024_04_09_102740_create_request_document_processes_table', 3),
(83, '2024_04_10_133928_create_transactions_table', 3),
(84, '2024_05_01_170251_create_blocked_dates_table', 3),
(85, '2024_05_01_171639_create_schedules_table', 3),
(86, '2024_05_05_150656_create_notifications_table', 3),
(87, '2024_05_09_071320_create_system_logs_table', 3),
(88, '2024_05_14_160328_create_credentials_table', 3),
(89, '2024_05_15_145629_add_school_id_to_users_table', 4),
(90, '2024_05_17_084344_add_soft_copy_available_to_documents_table', 5),
(94, '2024_05_21_030000_create_rejected_requests_table', 6),
(95, '2024_05_21_042414_add_rejected_status_and_rejected_at_to_requests_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`content`)),
  `read_at` datetime DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `title`, `content`, `read_at`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 'Request #...ca9452 Created', '[\"request\",\"664422ec952ca9452\",\"pending for approval.\"]', NULL, 1, '2024-05-14 18:50:20', '2024-05-14 18:50:20'),
(2, 'User Account Confirmation', '[\"user\",6,\"pending for confirmation.\"]', NULL, 1, '2024-05-15 18:53:39', '2024-05-15 18:53:39'),
(3, 'Request #...d56763 Created', '[\"request\",\"6645758d354d56763\",\"pending for approval.\"]', NULL, 6, '2024-05-15 18:55:09', '2024-05-15 18:55:09'),
(4, 'Request #...d56763 Created', '[\"request\",\"6645758d354d56763\",\"pending for approval.\"]', NULL, 1, '2024-05-15 18:55:09', '2024-05-15 18:55:09'),
(5, 'Transaction Complete', '[\"transaction\",\"cs_Zt2EnGSg9DqCEbWwJ8bGabM6\",\"6645762c10096519\"]', NULL, 1, '2024-05-15 18:58:30', '2024-05-15 18:58:30'),
(6, 'Request #...af2097 Created', '[\"request\",\"664576bfe7daf2097\",\"pending for approval.\"]', NULL, 1, '2024-05-15 19:00:15', '2024-05-15 19:00:15'),
(7, 'Transaction Complete', '[\"transaction\",\"cs_B3iUNRQGZJ1yg3bmKFQQcXeg\",\"664577463a948274\"]', NULL, 1, '2024-05-15 19:02:53', '2024-05-15 19:02:53'),
(8, 'Transaction Complete', '[\"transaction\",\"cs_B3iUNRQGZJ1yg3bmKFQQcXeg\",\"664577463a948274\"]', NULL, 1, '2024-05-15 19:02:53', '2024-05-15 19:02:53'),
(9, 'Request #...224802 Created', '[\"request\",\"6645777427c224802\",\"pending for approval.\"]', NULL, 1, '2024-05-15 19:03:16', '2024-05-15 19:03:16'),
(10, 'Request #...224802 Created', '[\"request\",\"6645777427c224802\",\"pending for approval.\"]', NULL, 1, '2024-05-15 19:03:16', '2024-05-15 19:03:16'),
(11, 'Request #...b94760 Created', '[\"request\",\"664577b25cab94760\",\"pending for approval.\"]', NULL, 1, '2024-05-15 19:04:18', '2024-05-15 19:04:18'),
(12, 'Request #...b94760 Created', '[\"request\",\"664577b25cab94760\",\"pending for approval.\"]', NULL, 1, '2024-05-15 19:04:18', '2024-05-15 19:04:18'),
(13, 'Request #...642954 Created', '[\"request\",\"664577f06d0642954\",\"pending for approval.\"]', NULL, 6, '2024-05-15 19:05:20', '2024-05-15 19:05:20'),
(14, 'Request #...642954 Created', '[\"request\",\"664577f06d0642954\",\"pending for approval.\"]', NULL, 1, '2024-05-15 19:05:20', '2024-05-15 19:05:20'),
(15, 'Request #...145701 Created', '[\"request\",\"66457834e3d145701\",\"pending for approval.\"]', NULL, 6, '2024-05-15 19:06:28', '2024-05-15 19:06:28'),
(16, 'Request #...145701 Created', '[\"request\",\"66457834e3d145701\",\"pending for approval.\"]', NULL, 1, '2024-05-15 19:06:28', '2024-05-15 19:06:28'),
(17, 'Request #...f15417 Created', '[\"request\",\"664578a260cf15417\",\"pending for approval.\"]', NULL, 6, '2024-05-15 19:08:18', '2024-05-15 19:08:18'),
(18, 'Request #...f15417 Created', '[\"request\",\"664578a260cf15417\",\"pending for approval.\"]', '2024-05-16 06:48:50', 1, '2024-05-15 19:08:18', '2024-05-15 22:48:50'),
(19, 'Request #...dc6494 Created', '[\"request\",\"664578a8c41dc6494\",\"pending for approval.\"]', NULL, 6, '2024-05-15 19:08:24', '2024-05-15 19:08:24'),
(20, 'Request #...dc6494 Created', '[\"request\",\"664578a8c41dc6494\",\"pending for approval.\"]', NULL, 1, '2024-05-15 19:08:24', '2024-05-15 19:08:24'),
(21, 'Request #...d07233 Created', '[\"request\",\"664578e61e4d07233\",\"pending for approval.\"]', '2024-05-16 07:13:40', 6, '2024-05-15 19:09:26', '2024-05-15 23:13:40'),
(22, 'Request #...d07233 Created', '[\"request\",\"664578e61e4d07233\",\"pending for approval.\"]', NULL, 1, '2024-05-15 19:09:26', '2024-05-15 19:09:26'),
(23, 'Request #...224802 Status Update', '[\"request\",\"6645777427c224802\",\"Ready for Collection\"]', NULL, 1, '2024-05-15 19:23:43', '2024-05-15 19:23:43'),
(24, 'Transaction Complete', '[\"transaction\",\"cs_Apz55Qr6gn1idmz7znebDbs8\",\"66459595d1c62443\"]', '2024-05-16 07:13:35', 6, '2024-05-15 21:13:06', '2024-05-15 23:13:35'),
(25, 'Transaction Complete', '[\"transaction\",\"cs_Apz55Qr6gn1idmz7znebDbs8\",\"66459595d1c62443\"]', NULL, 1, '2024-05-15 21:13:06', '2024-05-15 21:13:06'),
(26, 'Transaction Complete', '[\"transaction\",\"cs_GQk7RjwWnygwn1ADdSUPCxtS\",\"6645b02805bd6309\"]', NULL, 1, '2024-05-15 23:06:26', '2024-05-15 23:06:26'),
(27, 'Request #...903389 Created', '[\"request\",\"6645b0b9ebc903389\",\"pending for approval.\"]', NULL, 1, '2024-05-15 23:07:37', '2024-05-15 23:07:37'),
(28, 'Transaction Complete', '[\"transaction\",\"cs_vs19yW1mnahHkAL5ExUKhQmx\",\"6645b13c1bcbf220\"]', NULL, 1, '2024-05-15 23:10:33', '2024-05-15 23:10:33'),
(29, 'Request #...a45647 Created', '[\"request\",\"6645b17fccaa45647\",\"pending for approval.\"]', NULL, 1, '2024-05-15 23:10:55', '2024-05-15 23:10:55'),
(30, 'Request #...476991 Created', '[\"request\",\"6646b37d47a476991\",\"pending for approval.\"]', '2024-05-17 01:31:53', 1, '2024-05-16 17:31:41', '2024-05-16 17:31:53'),
(31, 'Request #...476991 Created', '[\"request\",\"6646b37d47a476991\",\"pending for approval.\"]', NULL, 1, '2024-05-16 17:31:41', '2024-05-16 17:31:41'),
(32, 'Transaction Complete', '[\"transaction\",\"cs_BXDVP6w4RQPAa9h8Yxc5dPRE\",\"6646d7569f31b108\"]', NULL, 1, '2024-05-16 20:05:29', '2024-05-16 20:05:29'),
(33, 'Request #...e28332 Created', '[\"request\",\"6646d796394e28332\",\"pending for approval.\"]', NULL, 1, '2024-05-16 20:05:42', '2024-05-16 20:05:42'),
(34, 'Account Confirmation', '[\"user\",7,\"requester\"]', NULL, 7, '2024-05-16 20:14:54', '2024-05-16 20:14:54'),
(35, 'User Account Confirmation', '[\"user\",8,\"pending for confirmation.\"]', NULL, 1, '2024-05-16 20:40:19', '2024-05-16 20:40:19'),
(36, 'Account Confirmation', '[\"user\",8,\"requester\"]', '2024-05-17 04:41:57', 8, '2024-05-16 20:41:12', '2024-05-16 20:41:57'),
(37, 'Request #...023833 Created', '[\"request\",\"6646e51025c023833\",\"pending for approval.\"]', '2024-05-17 05:03:39', 8, '2024-05-16 21:03:12', '2024-05-16 21:03:39'),
(38, 'Request #...023833 Created', '[\"request\",\"6646e51025c023833\",\"pending for approval.\"]', NULL, 1, '2024-05-16 21:03:12', '2024-05-16 21:03:12'),
(39, 'Transaction Complete', '[\"transaction\",\"cs_yG5tkaCiERbLEjoNZLgF8vaj\",\"664aa2631cff8167\"]', NULL, 1, '2024-05-19 17:08:26', '2024-05-19 17:08:26'),
(40, 'Transaction Complete', '[\"transaction\",\"cs_yG5tkaCiERbLEjoNZLgF8vaj\",\"664aa2631cff8167\"]', NULL, 7, '2024-05-19 17:08:26', '2024-05-19 17:08:26'),
(41, 'Request #...974679 Created', '[\"request\",\"664aa2ac298974679\",\"pending for approval.\"]', NULL, 1, '2024-05-19 17:09:00', '2024-05-19 17:09:00'),
(42, 'Request #...974679 Status Update', '[\"request\",\"664aa2ac298974679\",\"Payment Approval\"]', NULL, 1, '2024-05-19 17:12:37', '2024-05-19 17:12:37'),
(43, 'Request #...974679 Status Update', '[\"request\",\"664aa2ac298974679\",\"Payment Approval\"]', NULL, 7, '2024-05-19 17:12:37', '2024-05-19 17:12:37'),
(44, 'Request #...e28332 Status Update', '[\"request\",\"6646d796394e28332\",\"Payment Approval\"]', NULL, 1, '2024-05-19 17:54:17', '2024-05-19 17:54:17'),
(45, 'Request #...e28332 Status Update', '[\"request\",\"6646d796394e28332\",\"Payment Approval\"]', NULL, 7, '2024-05-19 17:54:17', '2024-05-19 17:54:17'),
(46, 'Transaction Complete', '[\"transaction\",\"cs_PYU3WWiHymDvb91Fmcmmg1eP\",\"664af3d3dcc6b414\"]', NULL, 1, '2024-05-19 22:56:00', '2024-05-19 22:56:00'),
(47, 'Transaction Complete', '[\"transaction\",\"cs_PYU3WWiHymDvb91Fmcmmg1eP\",\"664af3d3dcc6b414\"]', NULL, 1, '2024-05-19 22:56:00', '2024-05-19 22:56:00'),
(48, 'Transaction Complete', '[\"transaction\",\"cs_PYU3WWiHymDvb91Fmcmmg1eP\",\"664af3d3dcc6b414\"]', NULL, 7, '2024-05-19 22:56:00', '2024-05-19 22:56:00'),
(49, 'Request #...d16519 Created', '[\"request\",\"664af436dcbd16519\",\"pending for approval.\"]', NULL, 1, '2024-05-19 22:56:54', '2024-05-19 22:56:54'),
(51, 'Request #...d16519 Status Update', '[\"request\",\"664af436dcbd16519\",\"Rejected\"]', NULL, 1, '2024-05-20 20:31:29', '2024-05-20 20:31:29'),
(52, 'Request #...d07233 Status Update', '[\"request\",\"664578e61e4d07233\",\"Rejected\"]', NULL, 6, '2024-05-20 23:17:50', '2024-05-20 23:17:50'),
(53, 'Request #...b94760 Status Update', '[\"request\",\"664577b25cab94760\",\"Rejected\"]', NULL, 1, '2024-05-20 23:21:15', '2024-05-20 23:21:15'),
(54, 'Request #...476991 Status Update', '[\"request\",\"6646b37d47a476991\",\"Rejected\"]', NULL, 1, '2024-05-20 23:21:38', '2024-05-20 23:21:38'),
(55, 'Request #...476991 Status Update', '[\"request\",\"6646b37d47a476991\",\"Rejected\"]', NULL, 1, '2024-05-20 23:33:26', '2024-05-20 23:33:26'),
(56, 'Request #...023833 Status Update', '[\"request\",\"6646e51025c023833\",\"Rejected\"]', NULL, 8, '2024-05-20 23:41:20', '2024-05-20 23:41:20'),
(57, 'Request #...2a8481 Created', '[\"request\",\"664d4583a232a8481\",\"pending for approval.\"]', '2024-05-22 01:09:59', 1, '2024-05-21 17:08:27', '2024-05-21 17:09:59'),
(58, 'Request #...2a8481 Status Update', '[\"request\",\"664d4583a232a8481\",\"Awaiting Payment\"]', NULL, 1, '2024-05-21 17:11:58', '2024-05-21 17:11:58'),
(59, 'Request #...2a8481 Status Update', '[\"request\",\"664d4583a232a8481\",\"Awaiting Payment\"]', NULL, 7, '2024-05-21 17:11:58', '2024-05-21 17:11:58'),
(60, 'Request #...2a8481 Status Update', '[\"request\",\"664d4583a232a8481\",\"Awaiting Payment\"]', NULL, 1, '2024-05-21 17:13:03', '2024-05-21 17:13:03'),
(61, 'Request #...2a8481 Status Update', '[\"request\",\"664d4583a232a8481\",\"Awaiting Payment\"]', NULL, 7, '2024-05-21 17:13:03', '2024-05-21 17:13:03'),
(62, 'Transaction Complete', '[\"transaction\",\"cs_AW1gQhXmRdYufooHdaMpdmAH\",\"664d47e9991b9285\"]', NULL, 1, '2024-05-21 17:19:21', '2024-05-21 17:19:21'),
(63, 'Transaction Complete', '[\"transaction\",\"cs_AW1gQhXmRdYufooHdaMpdmAH\",\"664d47e9991b9285\"]', NULL, 1, '2024-05-21 17:19:21', '2024-05-21 17:19:21'),
(64, 'Transaction Complete', '[\"transaction\",\"cs_AW1gQhXmRdYufooHdaMpdmAH\",\"664d47e9991b9285\"]', NULL, 7, '2024-05-21 17:19:21', '2024-05-21 17:19:21'),
(65, 'Request #...d81815 Status Update', '[\"request\",\"664d48399c7d81815\",\"Payment Approval\"]', NULL, 1, '2024-05-21 17:19:53', '2024-05-21 17:19:53'),
(66, 'Request #...d81815 Status Update', '[\"request\",\"664d48399c7d81815\",\"Payment Approval\"]', NULL, 1, '2024-05-21 17:19:53', '2024-05-21 17:19:53'),
(67, 'Request #...d81815 Status Update', '[\"request\",\"664d48399c7d81815\",\"Payment Approval\"]', NULL, 7, '2024-05-21 17:19:53', '2024-05-21 17:19:53'),
(68, 'Request #...d81815 Created', '[\"request\",\"664d48399c7d81815\",\"pending for approval.\"]', NULL, 1, '2024-05-21 17:19:53', '2024-05-21 17:19:53'),
(69, 'Request #...d81815 Created', '[\"request\",\"664d48399c7d81815\",\"pending for approval.\"]', NULL, 1, '2024-05-21 17:19:53', '2024-05-21 17:19:53'),
(70, 'Request #...b81382 Status Update', '[\"request\",\"664d61dfb8eb81382\",\"Pending Approval\"]', NULL, 6, '2024-05-21 19:09:19', '2024-05-21 19:09:19'),
(71, 'Request #...b81382 Created', '[\"request\",\"664d61dfb8eb81382\",\"pending for approval.\"]', '2024-05-22 03:11:18', 6, '2024-05-21 19:09:19', '2024-05-21 19:11:18'),
(72, 'Request #...b81382 Created', '[\"request\",\"664d61dfb8eb81382\",\"pending for approval.\"]', NULL, 1, '2024-05-21 19:09:19', '2024-05-21 19:09:19'),
(73, 'Request #...b81382 Status Update', '[\"request\",\"664d61dfb8eb81382\",\"In Progress\"]', NULL, 6, '2024-05-21 19:30:42', '2024-05-21 19:30:42'),
(74, 'Request #...b81382 Status Update', '[\"request\",\"664d61dfb8eb81382\",\"Awaiting Payment\"]', NULL, 6, '2024-05-21 19:31:31', '2024-05-21 19:31:31'),
(75, 'Request #...b81382 Status Update', '[\"request\",\"664d61dfb8eb81382\",\"Awaiting Payment\"]', NULL, 7, '2024-05-21 19:31:31', '2024-05-21 19:31:31'),
(76, 'Transaction Complete', '[\"transaction\",\"cs_bwQJzb22y6qmRYLq2Df36JQ4\",\"664d6b80d0bd7220\"]', NULL, 1, '2024-05-21 19:51:35', '2024-05-21 19:51:35'),
(77, 'Transaction Complete', '[\"transaction\",\"cs_bwQJzb22y6qmRYLq2Df36JQ4\",\"664d6b80d0bd7220\"]', NULL, 7, '2024-05-21 19:51:35', '2024-05-21 19:51:35'),
(78, 'Request #...0f7760 Status Update', '[\"request\",\"664d6bf13540f7760\",\"Payment Approval\"]', NULL, 1, '2024-05-21 19:52:17', '2024-05-21 19:52:17'),
(79, 'Request #...0f7760 Status Update', '[\"request\",\"664d6bf13540f7760\",\"Payment Approval\"]', NULL, 7, '2024-05-21 19:52:17', '2024-05-21 19:52:17'),
(80, 'Request #...bc4876 Status Update', '[\"request\",\"664d7fb61b7bc4876\",\"Pending Approval\"]', NULL, 1, '2024-05-21 21:16:38', '2024-05-21 21:16:38'),
(81, 'Request #...bc4876 Created', '[\"request\",\"664d7fb61b7bc4876\",\"pending for approval.\"]', NULL, 1, '2024-05-21 21:16:38', '2024-05-21 21:16:38'),
(82, 'Request #...bc4876 Created', '[\"request\",\"664d7fb61b7bc4876\",\"pending for approval.\"]', NULL, 1, '2024-05-21 21:16:38', '2024-05-21 21:16:38'),
(83, 'Transaction Complete', '[\"transaction\",\"cs_AgsjEVF4fGSgUoHwzT33Bffj\",\"664d998bf2fd7202\"]', NULL, 1, '2024-05-21 23:07:46', '2024-05-21 23:07:46'),
(84, 'Transaction Complete', '[\"transaction\",\"cs_AgsjEVF4fGSgUoHwzT33Bffj\",\"664d998bf2fd7202\"]', NULL, 7, '2024-05-21 23:07:46', '2024-05-21 23:07:46'),
(85, 'Request #...0f6947 Status Update', '[\"request\",\"664d9a046830f6947\",\"Payment Approval\"]', NULL, 1, '2024-05-21 23:08:52', '2024-05-21 23:08:52'),
(86, 'Request #...0f6947 Status Update', '[\"request\",\"664d9a046830f6947\",\"Payment Approval\"]', NULL, 7, '2024-05-21 23:08:52', '2024-05-21 23:08:52'),
(87, 'Request #...0f6947 Created', '[\"request\",\"664d9a046830f6947\",\"pending for approval.\"]', NULL, 1, '2024-05-21 23:08:56', '2024-05-21 23:08:56'),
(88, 'Request #...469198 Created', '[\"request\",\"664d9d59089469198\",\"pending for approval.\"]', NULL, 1, '2024-05-21 23:23:08', '2024-05-21 23:23:08'),
(89, 'Transaction Complete', '[\"transaction\",\"cs_YHCS4VvbNtMJ6dNKezZzY4Cb\",\"664ffaa429af1794\"]', NULL, 1, '2024-05-23 18:28:25', '2024-05-23 18:28:25'),
(90, 'Transaction Complete', '[\"transaction\",\"cs_YHCS4VvbNtMJ6dNKezZzY4Cb\",\"664ffaa429af1794\"]', NULL, 7, '2024-05-23 18:28:25', '2024-05-23 18:28:25'),
(91, 'Request #...916176 Status Update', '[\"request\",\"664ffbfae80916176\",\"Payment Approval\"]', NULL, 1, '2024-05-23 18:31:22', '2024-05-23 18:31:22'),
(92, 'Request #...916176 Status Update', '[\"request\",\"664ffbfae80916176\",\"Payment Approval\"]', NULL, 7, '2024-05-23 18:31:22', '2024-05-23 18:31:22'),
(93, 'Request #...916176 Created', '[\"request\",\"664ffbfae80916176\",\"pending for approval.\"]', NULL, 1, '2024-05-23 18:31:28', '2024-05-23 18:31:28');

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
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rejected_requests`
--

CREATE TABLE `rejected_requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `reason` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `rejected_requests`
--

INSERT INTO `rejected_requests` (`id`, `request_id`, `user_id`, `reason`, `created_at`, `updated_at`) VALUES
(2, 13, 1, NULL, '2024-05-20 23:33:26', '2024-05-20 23:33:26'),
(3, 13, 1, NULL, '2024-05-20 23:33:30', '2024-05-20 23:33:30'),
(4, 15, 1, 'This request did not meet the requirements', '2024-05-20 23:41:20', '2024-05-20 23:41:20');

-- --------------------------------------------------------

--
-- Table structure for table `requests`
--

CREATE TABLE `requests` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tracking_code` varchar(255) DEFAULT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `verified_email_id` bigint(20) UNSIGNED DEFAULT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `payment_type` enum('Walk in','Online') NOT NULL DEFAULT 'Walk in',
  `appointment_date` datetime NOT NULL,
  `canceled_at` datetime DEFAULT NULL,
  `approved_at` datetime DEFAULT NULL,
  `completed_at` datetime DEFAULT NULL,
  `claimed_at` datetime DEFAULT NULL,
  `paid_at` datetime DEFAULT NULL,
  `status` enum('Pending Approval','In Progress','Payment Approval','Awaiting Payment','Ready for Collection','Completed','Canceled','Rejected') NOT NULL DEFAULT 'Pending Approval',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `rejected_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `requests`
--

INSERT INTO `requests` (`id`, `tracking_code`, `user_id`, `verified_email_id`, `price`, `payment_type`, `appointment_date`, `canceled_at`, `approved_at`, `completed_at`, `claimed_at`, `paid_at`, `status`, `created_at`, `updated_at`, `rejected_at`) VALUES
(2, '6645758d354d56763', 6, NULL, 260.00, 'Walk in', '2022-05-11 09:00:00', NULL, NULL, NULL, NULL, '2024-05-15 11:24:47', 'Completed', '2024-05-15 18:55:09', '2024-05-15 18:55:09', NULL),
(4, '6645777427c224802', 1, NULL, 490.00, 'Online', '2023-05-17 09:30:00', NULL, NULL, NULL, NULL, '2024-05-16 03:23:43', 'Completed', '2024-05-15 19:03:16', '2024-05-15 19:23:43', NULL),
(5, '664577b25cab94760', 1, NULL, 240.00, 'Walk in', '2020-05-13 09:30:00', NULL, NULL, NULL, NULL, NULL, 'Canceled', '2024-05-15 19:04:18', '2024-05-20 23:21:15', NULL),
(6, '664577f06d0642954', 6, NULL, 490.00, 'Walk in', '2022-05-12 09:30:00', NULL, NULL, NULL, NULL, NULL, 'Canceled', '2024-05-15 19:05:20', '2024-05-15 19:05:20', NULL),
(7, '66457834e3d145701', 6, NULL, 690.00, 'Walk in', '2021-05-19 09:00:00', NULL, NULL, NULL, NULL, NULL, 'Canceled', '2024-05-15 19:06:28', '2024-05-15 19:06:28', NULL),
(8, '664578a260cf15417', 6, NULL, 490.00, 'Walk in', '2024-05-13 08:30:00', NULL, NULL, NULL, NULL, NULL, 'In Progress', '2024-05-15 19:08:18', '2024-05-15 19:08:18', NULL),
(9, '664578a8c41dc6494', 6, NULL, 490.00, 'Walk in', '2024-05-09 08:30:00', NULL, NULL, NULL, NULL, '2024-05-15 11:24:54', 'Ready for Collection', '2024-05-15 19:08:24', '2024-05-15 19:08:24', NULL),
(10, '664578e61e4d07233', 6, NULL, 490.00, 'Walk in', '2024-05-22 09:30:00', NULL, NULL, NULL, NULL, NULL, 'Canceled', '2024-05-15 19:09:26', '2024-05-20 23:17:50', NULL),
(13, '6646b37d47a476991', 1, NULL, 200.00, 'Walk in', '2024-05-22 09:30:00', NULL, NULL, NULL, NULL, NULL, 'Rejected', '2024-05-16 17:31:41', '2024-05-20 23:33:30', '2024-05-21 07:33:30'),
(14, '6646d796394e28332', NULL, 2, 6310.00, 'Online', '2024-05-24 08:30:00', NULL, '2024-05-20 01:53:15', '2024-05-20 01:55:52', NULL, '2024-05-20 01:55:04', 'Canceled', '2024-05-16 20:05:42', '2024-05-20 23:18:53', NULL),
(15, '6646e51025c023833', 8, NULL, 430.00, 'Walk in', '2024-05-22 08:30:00', NULL, NULL, NULL, NULL, NULL, 'Rejected', '2024-05-16 21:03:12', '2024-05-20 23:41:20', '2024-05-21 07:41:20'),
(17, '664af436dcbd16519', 1, NULL, 490.00, 'Online', '2024-05-24 11:00:00', NULL, NULL, NULL, NULL, NULL, 'Canceled', '2024-05-19 22:56:54', '2024-05-20 22:37:21', NULL),
(18, '664d4583a232a8481', NULL, 3, 260.00, 'Walk in', '2024-05-27 08:00:00', NULL, '2024-05-22 01:11:18', NULL, NULL, '2024-05-22 01:14:08', 'Ready for Collection', '2024-05-21 17:08:19', '2024-05-21 17:14:26', NULL),
(19, '664d48399c7d81815', 1, NULL, 430.00, 'Online', '2024-05-27 09:30:00', NULL, NULL, NULL, NULL, NULL, 'Payment Approval', '2024-05-21 17:19:53', '2024-05-21 17:19:53', NULL),
(20, '664d61dfb8eb81382', 6, NULL, 430.00, 'Walk in', '2024-05-28 11:07:00', NULL, '2024-05-22 03:30:42', NULL, NULL, NULL, 'Awaiting Payment', '2024-05-21 19:09:19', '2024-05-21 19:31:31', NULL),
(22, '664d7fb61b7bc4876', 1, NULL, 60.00, 'Walk in', '2024-05-29 09:30:00', NULL, NULL, NULL, NULL, NULL, 'Pending Approval', '2024-05-21 21:16:38', '2024-05-21 21:16:38', NULL),
(24, '664d9d59089469198', NULL, 4, 60.00, 'Walk in', '2024-05-29 08:00:00', NULL, NULL, NULL, NULL, NULL, 'Pending Approval', '2024-05-21 23:23:05', '2024-05-21 23:23:05', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request_documents`
--

CREATE TABLE `request_documents` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED NOT NULL,
  `document_id` bigint(20) UNSIGNED NOT NULL,
  `quantity` int(10) UNSIGNED NOT NULL,
  `price` decimal(8,2) NOT NULL DEFAULT 0.00,
  `completed_at` datetime DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_documents`
--

INSERT INTO `request_documents` (`id`, `request_id`, `document_id`, `quantity`, `price`, `completed_at`, `created_at`, `updated_at`) VALUES
(2, 2, 1, 1, 200.00, NULL, NULL, NULL),
(3, 2, 3, 1, 60.00, NULL, NULL, NULL),
(5, 4, 3, 1, 60.00, NULL, NULL, NULL),
(6, 4, 6, 1, 430.00, NULL, NULL, NULL),
(7, 5, 3, 1, 60.00, NULL, NULL, NULL),
(8, 5, 5, 3, 60.00, NULL, NULL, NULL),
(9, 6, 3, 1, 60.00, NULL, NULL, NULL),
(10, 6, 6, 1, 430.00, NULL, NULL, NULL),
(11, 7, 1, 1, 200.00, NULL, NULL, NULL),
(12, 7, 4, 1, 60.00, NULL, NULL, NULL),
(13, 7, 6, 1, 430.00, NULL, NULL, NULL),
(14, 8, 3, 1, 60.00, NULL, NULL, NULL),
(15, 8, 6, 1, 430.00, NULL, NULL, NULL),
(16, 9, 3, 1, 60.00, NULL, NULL, NULL),
(17, 9, 6, 1, 430.00, NULL, NULL, NULL),
(18, 10, 3, 1, 60.00, NULL, NULL, NULL),
(19, 10, 6, 1, 430.00, NULL, NULL, NULL),
(23, 13, 1, 1, 200.00, NULL, NULL, NULL),
(24, 14, 2, 1, 60.00, NULL, NULL, NULL),
(25, 14, 3, 10, 60.00, NULL, NULL, NULL),
(26, 14, 4, 1, 60.00, NULL, NULL, NULL),
(27, 14, 6, 13, 430.00, NULL, NULL, NULL),
(28, 15, 6, 1, 430.00, NULL, NULL, NULL),
(31, 17, 3, 1, 60.00, NULL, NULL, NULL),
(32, 17, 6, 1, 430.00, NULL, NULL, NULL),
(33, 18, 1, 1, 200.00, NULL, NULL, NULL),
(34, 18, 3, 1, 60.00, NULL, NULL, NULL),
(35, 19, 6, 1, 430.00, NULL, NULL, NULL),
(36, 20, 6, 1, 430.00, NULL, NULL, NULL),
(38, 22, 2, 1, 60.00, NULL, NULL, NULL),
(40, 24, 2, 1, 60.00, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `request_document_processes`
--

CREATE TABLE `request_document_processes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `document_process_id` bigint(20) UNSIGNED NOT NULL,
  `request_document_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `request_document_processes`
--

INSERT INTO `request_document_processes` (`id`, `document_process_id`, `request_document_id`, `created_at`, `updated_at`) VALUES
(4, 1, 24, '2024-05-19 17:53:49', '2024-05-19 17:53:49'),
(5, 1, 26, '2024-05-19 17:54:06', '2024-05-19 17:54:06'),
(6, 2, 26, '2024-05-19 17:54:06', '2024-05-19 17:54:06'),
(7, 1, 27, '2024-05-19 17:54:17', '2024-05-19 17:54:17'),
(8, 2, 27, '2024-05-19 17:54:17', '2024-05-19 17:54:17'),
(9, 1, 33, '2024-05-21 17:11:57', '2024-05-21 17:11:57'),
(10, 2, 33, '2024-05-21 17:11:57', '2024-05-21 17:11:57'),
(11, 1, 36, '2024-05-21 19:31:31', '2024-05-21 19:31:31'),
(12, 2, 36, '2024-05-21 19:31:31', '2024-05-21 19:31:31');

-- --------------------------------------------------------

--
-- Table structure for table `schedules`
--

CREATE TABLE `schedules` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `enabled_days` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`enabled_days`)),
  `daily_limit` int(11) NOT NULL DEFAULT 50,
  `min` int(11) NOT NULL DEFAULT 0,
  `max` int(11) NOT NULL DEFAULT 0,
  `min_time` time DEFAULT NULL,
  `max_time` time DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `schedules`
--

INSERT INTO `schedules` (`id`, `enabled_days`, `daily_limit`, `min`, `max`, `min_time`, `max_time`, `created_at`, `updated_at`) VALUES
(1, '[\"1\",\"2\",\"3\",\"5\"]', 50, 3, 7, '08:00:00', '17:00:00', '2024-05-14 18:39:29', '2024-05-19 17:59:24');

-- --------------------------------------------------------

--
-- Table structure for table `system_logs`
--

CREATE TABLE `system_logs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `activity` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`activity`)),
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `system_logs`
--

INSERT INTO `system_logs` (`id`, `activity`, `created_at`, `updated_at`) VALUES
(1, '[{\"type\":\"document\",\"time\":\"2024-05-15T02:43:49.434013Z\",\"description\":\"New Document Created Graduate TOR by User ID No: 1\"},{\"type\":\"verfied_email\",\"time\":\"2024-05-15T02:44:35.203690Z\",\"description\":\"New Email Verified monteroso.eli@gmail.com\"},{\"type\":\"request\",\"time\":\"2024-05-15T02:50:20.632069Z\",\"description\":\"New Request by: monteroso.eli@gmail.com\"}]', '2024-05-14 18:43:49', '2024-05-14 18:50:20'),
(2, '[{\"type\":\"document\",\"time\":\"2024-05-16T02:42:59.877415Z\",\"description\":\"New Document Created GWA\\/GPA by User ID No: 1\"},{\"type\":\"document\",\"time\":\"2024-05-16T02:44:19.998239Z\",\"description\":\"New Document Created GRADES (Certification of acquired grade) by User ID No: 1\"},{\"type\":\"document\",\"time\":\"2024-05-16T02:46:35.752928Z\",\"description\":\"New Document Created Course Description by User ID No: 1\"},{\"type\":\"document\",\"time\":\"2024-05-16T02:47:31.928119Z\",\"description\":\"New Document Created Units Earned by User ID No: 1\"},{\"type\":\"document\",\"time\":\"2024-05-16T02:48:02.588402Z\",\"description\":\"New Document Created Undergraduate Official TOR by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-16T02:51:53.705089Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-16T02:53:39.805002Z\",\"description\":\"New User, ID No: 6\"},{\"type\":\"request\",\"time\":\"2024-05-16T02:55:09.240729Z\",\"description\":\"New Request by User ID: 6\"},{\"type\":\"transaction\",\"time\":\"2024-05-16T02:58:30.835567Z\",\"description\":\"Transaction Created, Reference No: 6645762c10096519\"},{\"type\":\"request\",\"time\":\"2024-05-16T03:00:15.980678Z\",\"description\":\"New Request by: monteroso.eli@gmail.com\"},{\"type\":\"transaction\",\"time\":\"2024-05-16T03:02:53.107984Z\",\"description\":\"Transaction Created, Reference No: 664577463a948274\"},{\"type\":\"request\",\"time\":\"2024-05-16T03:03:16.215339Z\",\"description\":\"New Request by User ID: 1\"},{\"type\":\"request\",\"time\":\"2024-05-16T03:04:18.408283Z\",\"description\":\"New Request by User ID: 1\"},{\"type\":\"request\",\"time\":\"2024-05-16T03:05:20.473736Z\",\"description\":\"New Request by User ID: 6\"},{\"type\":\"request\",\"time\":\"2024-05-16T03:06:28.981979Z\",\"description\":\"New Request by User ID: 6\"},{\"type\":\"request\",\"time\":\"2024-05-16T03:08:18.412191Z\",\"description\":\"New Request by User ID: 6\"},{\"type\":\"request\",\"time\":\"2024-05-16T03:08:24.813058Z\",\"description\":\"New Request by User ID: 6\"},{\"type\":\"request\",\"time\":\"2024-05-16T03:09:26.140336Z\",\"description\":\"New Request by User ID: 6\"},{\"type\":\"request\",\"time\":\"2024-05-16T03:23:43.128643Z\",\"description\":\"Request No: 4 updated to Ready for Collection, by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-16T05:04:52.121983Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"transaction\",\"time\":\"2024-05-16T05:13:06.278575Z\",\"description\":\"Transaction Created, Reference No: 66459595d1c62443\"},{\"type\":\"user\",\"time\":\"2024-05-16T06:31:06.084557Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-16T07:04:01.134989Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"transaction\",\"time\":\"2024-05-16T07:06:26.588541Z\",\"description\":\"Transaction Created, Reference No: 6645b02805bd6309\"},{\"type\":\"request\",\"time\":\"2024-05-16T07:07:37.992857Z\",\"description\":\"New Request by: monteroso.eli@gmail.com\"},{\"type\":\"transaction\",\"time\":\"2024-05-16T07:10:33.083087Z\",\"description\":\"Transaction Created, Reference No: 6645b13c1bcbf220\"},{\"type\":\"request\",\"time\":\"2024-05-16T07:10:55.881050Z\",\"description\":\"New Request by: monteroso.eli@gmail.com\"},{\"type\":\"user\",\"time\":\"2024-05-16T08:19:33.235748Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-16T08:22:46.829755Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"}]', '2024-05-15 18:42:59', '2024-05-16 00:22:46'),
(3, '[{\"type\":\"request\",\"time\":\"2024-05-17T01:31:41.363122Z\",\"description\":\"New Request by User ID: 1\"},{\"type\":\"user\",\"time\":\"2024-05-17T01:32:15.700867Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"verfied_email\",\"time\":\"2024-05-17T04:02:09.873746Z\",\"description\":\"New Email Verified mipiho1591@mfyax.com\"},{\"type\":\"transaction\",\"time\":\"2024-05-17T04:05:29.216765Z\",\"description\":\"Transaction Created, Reference No: 6646d7569f31b108\"},{\"type\":\"request\",\"time\":\"2024-05-17T04:05:42.257337Z\",\"description\":\"New Request by: mipiho1591@mfyax.com\"},{\"type\":\"user\",\"time\":\"2024-05-17T04:07:49.971788Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-17T04:08:58.269116Z\",\"description\":\"New User, ID No: 7\"},{\"type\":\"user\",\"time\":\"2024-05-17T04:13:07.597595Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-17T04:14:54.685544Z\",\"description\":\"User ID No: 7 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-17T04:16:44.580490Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-17T04:18:15.503282Z\",\"description\":\"User ID No: 7 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-17T04:40:19.342026Z\",\"description\":\"New User, ID No: 8\"},{\"type\":\"user\",\"time\":\"2024-05-17T04:41:12.099100Z\",\"description\":\"User ID No: 8 Updated by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-17T05:03:12.180691Z\",\"description\":\"New Request by User ID: 8\"}]', '2024-05-16 17:31:41', '2024-05-16 21:03:12'),
(4, '[{\"type\":\"transaction\",\"time\":\"2024-05-20T01:08:26.196837Z\",\"description\":\"Transaction Created, Reference No: 664aa2631cff8167\"},{\"type\":\"request\",\"time\":\"2024-05-20T01:09:00.189292Z\",\"description\":\"New Request by: monteroso.eli@gmail.com\"},{\"type\":\"schedule\",\"time\":\"2024-05-20T01:10:09.461535Z\",\"description\":\"Schedule Settings Updated by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-20T01:11:11.937651Z\",\"description\":\"Request No: 16 updated to In Progress, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-20T01:12:37.764669Z\",\"description\":\"Request No: 16 updated to Payment Approval, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-20T01:53:15.305284Z\",\"description\":\"Request No: 14 updated to In Progress, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-20T01:54:17.347787Z\",\"description\":\"Request No: 14 updated to Payment Approval, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-20T01:55:04.884682Z\",\"description\":\"Request No: 14 updated to Ready for Collection, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-20T01:55:52.626148Z\",\"description\":\"Request No: 14 updated to Completed, by User ID No: 1\"},{\"type\":\"document\",\"time\":\"2024-05-20T01:57:17.699969Z\",\"description\":\"Document GWA\\/GPA Updated by User ID No: 1\"},{\"type\":\"schedule\",\"time\":\"2024-05-20T01:59:24.393918Z\",\"description\":\"Schedule Settings Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-20T02:03:00.816137Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-20T02:18:23.952464Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"transaction\",\"time\":\"2024-05-20T06:56:00.515733Z\",\"description\":\"Transaction Created, Reference No: 664af3d3dcc6b414\"},{\"type\":\"request\",\"time\":\"2024-05-20T06:56:54.930742Z\",\"description\":\"New Request by User ID: 1\"}]', '2024-05-19 17:08:26', '2024-05-19 22:56:54'),
(5, '[{\"type\":\"request\",\"time\":\"2024-05-21T04:31:29.678284Z\",\"description\":\"Request No: 17 updated to Rejected, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-21T07:17:32.455977Z\",\"description\":\"Request No: 16 updated to Rejected, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-21T07:17:50.749795Z\",\"description\":\"Request No: 10 updated to Rejected, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-21T07:18:49.554503Z\",\"description\":\"Request No: 14 updated to Rejected, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-21T07:18:59.977453Z\",\"description\":\"Request No: 11 updated to Rejected, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-21T07:20:11.618260Z\",\"description\":\"Request No: 3 updated to Rejected, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-21T07:21:15.890906Z\",\"description\":\"Request No: 5 updated to Rejected, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-21T07:21:38.060643Z\",\"description\":\"Request No: 13 updated to Rejected, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-21T07:31:44.634914Z\",\"description\":\"Request No: 12 updated to Rejected, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-21T07:33:26.615754Z\",\"description\":\"Request No: 13 updated to Rejected, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-21T07:41:20.302118Z\",\"description\":\"Request No: 15 updated to Rejected, by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-21T07:50:15.693285Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"}]', '2024-05-20 20:31:29', '2024-05-20 23:50:15'),
(6, '[{\"type\":\"verfied_email\",\"time\":\"2024-05-22T01:02:28.968277Z\",\"description\":\"New Email Verified jboncalon@vsu.edu.ph\"},{\"type\":\"request\",\"time\":\"2024-05-22T01:08:19.706746Z\",\"description\":\"Request No: 18 updated to Pending Approval, by Requester \"},{\"type\":\"request\",\"time\":\"2024-05-22T01:08:27.570178Z\",\"description\":\"New Request by: jboncalon@vsu.edu.ph\"},{\"type\":\"document\",\"time\":\"2024-05-22T01:10:55.720532Z\",\"description\":\"Document Graduate TOR Updated by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-22T01:11:18.713333Z\",\"description\":\"Request No: 18 updated to In Progress, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-22T01:11:58.041815Z\",\"description\":\"Request No: 18 updated to Awaiting Payment, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-22T01:13:03.142117Z\",\"description\":\"Request No: 18 updated to Awaiting Payment, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-22T01:14:08.463502Z\",\"description\":\"Request No: 18 updated to Ready for Collection, by User ID No: 1\"},{\"type\":\"transaction\",\"time\":\"2024-05-22T01:19:21.147860Z\",\"description\":\"Transaction Created, Reference No: 664d47e9991b9285\"},{\"type\":\"request\",\"time\":\"2024-05-22T01:19:53.718992Z\",\"description\":\"Request No: 19 updated to Payment Approval, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-22T01:19:53.747843Z\",\"description\":\"New Request by User ID: 1\"},{\"type\":\"user\",\"time\":\"2024-05-22T02:55:49.267109Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-22T03:09:19.771915Z\",\"description\":\"Request No: 20 updated to Pending Approval, by User ID No: 6\"},{\"type\":\"request\",\"time\":\"2024-05-22T03:09:19.784425Z\",\"description\":\"New Request by User ID: 6\"},{\"type\":\"request\",\"time\":\"2024-05-22T03:30:42.294312Z\",\"description\":\"Request No: 20 updated to In Progress, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-22T03:31:31.671445Z\",\"description\":\"Request No: 20 updated to Awaiting Payment, by User ID No: 1\"},{\"type\":\"document\",\"time\":\"2024-05-22T03:35:46.836886Z\",\"description\":\"Document Graduate TOR Updated by User ID No: 1\"},{\"type\":\"document\",\"time\":\"2024-05-22T03:36:03.561939Z\",\"description\":\"Document Graduate TOR Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-22T03:48:55.144188Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"transaction\",\"time\":\"2024-05-22T03:51:35.084395Z\",\"description\":\"Transaction Created, Reference No: 664d6b80d0bd7220\"},{\"type\":\"request\",\"time\":\"2024-05-22T03:52:17.279773Z\",\"description\":\"Request No: 21 updated to Payment Approval, by Requester \"},{\"type\":\"request\",\"time\":\"2024-05-22T03:52:20.646130Z\",\"description\":\"New Request by: monteroso.eli@gmail.com\"},{\"type\":\"request\",\"time\":\"2024-05-22T05:16:38.123632Z\",\"description\":\"Request No: 22 updated to Pending Approval, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-22T05:16:38.134001Z\",\"description\":\"New Request by User ID: 1\"},{\"type\":\"user\",\"time\":\"2024-05-22T05:17:27.888528Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-22T05:39:04.502675Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"transaction\",\"time\":\"2024-05-22T07:07:46.532690Z\",\"description\":\"Transaction Created, Reference No: 664d998bf2fd7202\"},{\"type\":\"request\",\"time\":\"2024-05-22T07:08:52.454881Z\",\"description\":\"Request No: 23 updated to Payment Approval, by Requester \"},{\"type\":\"request\",\"time\":\"2024-05-22T07:08:56.258652Z\",\"description\":\"New Request by: monteroso.eli@gmail.com\"},{\"type\":\"verfied_email\",\"time\":\"2024-05-22T07:19:53.882169Z\",\"description\":\"New Email Verified salarclydexavier@gmail.com\"},{\"type\":\"request\",\"time\":\"2024-05-22T07:23:05.057513Z\",\"description\":\"Request No: 24 updated to Pending Approval, by Requester \"},{\"type\":\"request\",\"time\":\"2024-05-22T07:23:08.557369Z\",\"description\":\"New Request by: salarclydexavier@gmail.com\"},{\"type\":\"user\",\"time\":\"2024-05-22T07:29:56.261290Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-22T14:35:32.102676Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-22T15:57:48.703503Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"}]', '2024-05-21 17:02:28', '2024-05-22 07:57:48'),
(7, '[{\"type\":\"verfied_email\",\"time\":\"2024-05-24T02:18:39.781510Z\",\"description\":\"New Email Verified monteroso.eli@gmail.com\"},{\"type\":\"transaction\",\"time\":\"2024-05-24T02:28:25.615623Z\",\"description\":\"Transaction Created, Reference No: 664ffaa429af1794\"},{\"type\":\"request\",\"time\":\"2024-05-24T02:31:22.993575Z\",\"description\":\"Request No: 25 updated to Payment Approval, by Requester \"},{\"type\":\"request\",\"time\":\"2024-05-24T02:31:28.105533Z\",\"description\":\"New Request by: monteroso.eli@gmail.com\"},{\"type\":\"request\",\"time\":\"2024-05-24T02:38:11.257577Z\",\"description\":\"Request No: 25 updated to Pending Approval, by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-24T02:39:15.337159Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-24T02:40:41.085170Z\",\"description\":\"Request No: 25 updated to In Progress, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-24T02:41:53.631731Z\",\"description\":\"Request No: 25 updated to Ready for Collection, by User ID No: 1\"},{\"type\":\"request\",\"time\":\"2024-05-24T02:42:56.794958Z\",\"description\":\"Request No: 25 updated to Completed, by User ID No: 1\"}]', '2024-05-23 18:18:39', '2024-05-23 18:42:56'),
(8, '[{\"type\":\"user\",\"time\":\"2024-05-29T05:14:05.826219Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-29T05:19:57.158996Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"}]', '2024-05-28 21:14:05', '2024-05-28 21:19:57'),
(9, '[{\"type\":\"user\",\"time\":\"2024-05-30T07:15:06.358658Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-30T07:16:27.137723Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"},{\"type\":\"user\",\"time\":\"2024-05-30T08:28:30.474927Z\",\"description\":\"User ID No: 1 Updated by User ID No: 1\"}]', '2024-05-29 23:15:06', '2024-05-30 00:28:30');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `request_id` bigint(20) UNSIGNED DEFAULT NULL,
  `checkout_id` varchar(255) NOT NULL,
  `reference_no` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `request_id`, `checkout_id`, `reference_no`, `created_at`, `updated_at`) VALUES
(2, 4, 'cs_B3iUNRQGZJ1yg3bmKFQQcXeg', '664577463a948274', '2024-05-15 19:02:53', '2024-05-15 19:03:16'),
(6, 14, 'cs_BXDVP6w4RQPAa9h8Yxc5dPRE', '6646d7569f31b108', '2024-05-16 20:05:24', '2024-05-16 20:05:46'),
(8, 17, 'cs_PYU3WWiHymDvb91Fmcmmg1eP', '664af3d3dcc6b414', '2024-05-19 22:56:00', '2024-05-19 22:56:55'),
(9, 19, 'cs_AW1gQhXmRdYufooHdaMpdmAH', '664d47e9991b9285', '2024-05-21 17:19:21', '2024-05-21 17:19:53');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `school_id` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role` enum('admin','registrar','cashier','requester','confirmation') NOT NULL DEFAULT 'confirmation'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `school_id`, `email_verified_at`, `password`, `remember_token`, `created_at`, `updated_at`, `role`) VALUES
(1, 'Admin', 'admin@vsuas.com', '', NULL, '$2y$12$bPTRThLwYZGQHM.efDeQcOpgkto6hAwXOQI/vDe9hRyS3xna4pVl.', 'aszTx5mr1uMElLa3kmNdmKLY5pNeAtx5wliMYcpJ5IrKdl8uZTS5vySwkkRx', '2024-02-21 18:49:24', '2024-05-16 20:07:49', 'admin'),
(6, 'Eli Daniel', 'monteroso.eli@gmail.com', '18-1-00482', NULL, '$2y$12$PhIEOR9t9gNyU5T.aa6f.eOAVEuirhl2uvCATYgv6ss3BUSZNnYzy', NULL, '2024-05-15 18:53:39', '2024-05-15 18:53:39', 'requester'),
(7, 'Eli Daniel Monteroso', 'hjmonteroso.eli@gmail.com', '18-1-00999', NULL, '$2y$12$.vQ7sYo4XRDxwJWxQQHk4O4I66ZYNpQY/X0pGCAaFVh.aFtn3/Yx.', NULL, '2024-05-16 20:08:58', '2024-05-16 20:18:15', 'cashier'),
(8, 'hello', 'jakealbero1@gmail.com', '18-1-00508', NULL, '$2y$12$0cDZDF.1pWDuDB2Az0lRiu9OtnEXDQXmZ5BKaHZQL286P5uqDQPbG', NULL, '2024-05-16 20:40:19', '2024-05-16 20:41:12', 'requester');

-- --------------------------------------------------------

--
-- Table structure for table `verified_emails`
--

CREATE TABLE `verified_emails` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `email` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `verified_emails`
--

INSERT INTO `verified_emails` (`id`, `email`, `created_at`, `updated_at`) VALUES
(2, 'mipiho1591@mfyax.com', '2024-05-16 20:02:09', '2024-05-16 20:02:09'),
(3, 'jboncalon@vsu.edu.ph', '2024-05-21 17:02:28', '2024-05-21 17:02:28'),
(4, 'salarclydexavier@gmail.com', '2024-05-21 23:19:53', '2024-05-21 23:19:53');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blocked_dates`
--
ALTER TABLE `blocked_dates`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `credentials`
--
ALTER TABLE `credentials`
  ADD PRIMARY KEY (`id`),
  ADD KEY `credentials_user_id_foreign` (`user_id`),
  ADD KEY `credentials_verified_email_id_foreign` (`verified_email_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `documents_name_unique` (`name`),
  ADD KEY `documents_document_type_id_foreign` (`document_type_id`);

--
-- Indexes for table `document_processes`
--
ALTER TABLE `document_processes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `document_process_pivot`
--
ALTER TABLE `document_process_pivot`
  ADD PRIMARY KEY (`id`),
  ADD KEY `document_process_pivot_document_id_foreign` (`document_id`),
  ADD KEY `document_process_pivot_document_process_id_foreign` (`document_process_id`);

--
-- Indexes for table `document_types`
--
ALTER TABLE `document_types`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`),
  ADD KEY `notifications_user_id_foreign` (`user_id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `rejected_requests`
--
ALTER TABLE `rejected_requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rejected_requests_request_id_foreign` (`request_id`),
  ADD KEY `rejected_requests_user_id_foreign` (`user_id`);

--
-- Indexes for table `requests`
--
ALTER TABLE `requests`
  ADD PRIMARY KEY (`id`),
  ADD KEY `requests_user_id_foreign` (`user_id`),
  ADD KEY `requests_verified_email_id_foreign` (`verified_email_id`);

--
-- Indexes for table `request_documents`
--
ALTER TABLE `request_documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_documents_request_id_foreign` (`request_id`),
  ADD KEY `request_documents_document_id_foreign` (`document_id`);

--
-- Indexes for table `request_document_processes`
--
ALTER TABLE `request_document_processes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `request_document_processes_document_process_id_foreign` (`document_process_id`),
  ADD KEY `request_document_processes_request_document_id_foreign` (`request_document_id`);

--
-- Indexes for table `schedules`
--
ALTER TABLE `schedules`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `system_logs`
--
ALTER TABLE `system_logs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `transactions_request_id_foreign` (`request_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `verified_emails`
--
ALTER TABLE `verified_emails`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `verified_emails_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blocked_dates`
--
ALTER TABLE `blocked_dates`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `credentials`
--
ALTER TABLE `credentials`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `document_processes`
--
ALTER TABLE `document_processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `document_process_pivot`
--
ALTER TABLE `document_process_pivot`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `document_types`
--
ALTER TABLE `document_types`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=96;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=94;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rejected_requests`
--
ALTER TABLE `rejected_requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `requests`
--
ALTER TABLE `requests`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `request_documents`
--
ALTER TABLE `request_documents`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `request_document_processes`
--
ALTER TABLE `request_document_processes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `schedules`
--
ALTER TABLE `schedules`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `system_logs`
--
ALTER TABLE `system_logs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `verified_emails`
--
ALTER TABLE `verified_emails`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `credentials`
--
ALTER TABLE `credentials`
  ADD CONSTRAINT `credentials_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `credentials_verified_email_id_foreign` FOREIGN KEY (`verified_email_id`) REFERENCES `verified_emails` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_document_type_id_foreign` FOREIGN KEY (`document_type_id`) REFERENCES `document_types` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `document_process_pivot`
--
ALTER TABLE `document_process_pivot`
  ADD CONSTRAINT `document_process_pivot_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `document_process_pivot_document_process_id_foreign` FOREIGN KEY (`document_process_id`) REFERENCES `document_processes` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `notifications`
--
ALTER TABLE `notifications`
  ADD CONSTRAINT `notifications_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rejected_requests`
--
ALTER TABLE `rejected_requests`
  ADD CONSTRAINT `rejected_requests_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `rejected_requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `requests`
--
ALTER TABLE `requests`
  ADD CONSTRAINT `requests_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `requests_verified_email_id_foreign` FOREIGN KEY (`verified_email_id`) REFERENCES `verified_emails` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `request_documents`
--
ALTER TABLE `request_documents`
  ADD CONSTRAINT `request_documents_document_id_foreign` FOREIGN KEY (`document_id`) REFERENCES `documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `request_documents_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `request_document_processes`
--
ALTER TABLE `request_document_processes`
  ADD CONSTRAINT `request_document_processes_document_process_id_foreign` FOREIGN KEY (`document_process_id`) REFERENCES `document_processes` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `request_document_processes_request_document_id_foreign` FOREIGN KEY (`request_document_id`) REFERENCES `request_documents` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `transactions`
--
ALTER TABLE `transactions`
  ADD CONSTRAINT `transactions_request_id_foreign` FOREIGN KEY (`request_id`) REFERENCES `requests` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
