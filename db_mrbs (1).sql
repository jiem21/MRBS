-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 13, 2019 at 09:26 AM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `db_mrbs`
--

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE `booking` (
  `id` int(11) NOT NULL,
  `date_reserve` date NOT NULL,
  `time_start` time NOT NULL,
  `time_end` time NOT NULL,
  `room_id` int(12) NOT NULL,
  `reserved_by` int(50) NOT NULL,
  `purpose` varchar(500) NOT NULL,
  `contact_no` varchar(12) NOT NULL,
  `status` int(1) NOT NULL,
  `remarks` varchar(255) NOT NULL,
  `date_transacted` datetime NOT NULL,
  `cancellation_remarks` varchar(500) NOT NULL,
  `date_cancellation` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`id`, `date_reserve`, `time_start`, `time_end`, `room_id`, `reserved_by`, `purpose`, `contact_no`, `status`, `remarks`, `date_transacted`, `cancellation_remarks`, `date_cancellation`, `created_at`, `updated_at`) VALUES
(4, '2019-12-11', '15:30:00', '17:00:00', 1, 1, 'test', '6206', 1, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2019-12-11 09:04:18', '2019-12-11 09:11:55'),
(5, '2019-12-12', '08:00:00', '10:00:00', 2, 1, 'test1', '6203', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2019-12-11 09:06:06', '2019-12-11 09:06:06'),
(13, '2019-12-12', '16:30:00', '17:00:00', 2, 1, 'Test', '6204', 1, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2019-12-12 16:23:02', '2019-12-12 08:23:02'),
(14, '2019-12-13', '08:00:00', '09:00:00', 2, 1, 'test 2', '6203', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2019-12-12 16:43:41', '2019-12-12 08:43:41'),
(15, '2019-12-13', '13:00:00', '14:30:00', 2, 1, 'Test2', '6203', 2, 'test Approval 2', '2019-12-13 12:07:46', '', '2000-02-13 00:00:00', '2019-12-13 10:27:48', '2019-12-13 04:07:46'),
(16, '2019-12-13', '13:00:00', '15:00:00', 1, 1, 'test3', '6203', 3, '', '0000-00-00 00:00:00', 'Test of Cancellation of reservation', '0000-00-00 00:00:00', '2019-12-13 10:28:15', '2019-12-13 03:50:14'),
(17, '2019-12-14', '08:00:00', '10:00:00', 2, 1, 'test', '6203', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2019-12-13 12:13:40', '2019-12-13 04:13:40'),
(18, '2019-12-14', '13:00:00', '17:00:00', 2, 1, 'test', '6203', 0, '', '0000-00-00 00:00:00', '', '0000-00-00 00:00:00', '2019-12-13 13:30:11', '2019-12-13 05:30:11');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2014_10_12_000000_create_users_table', 1),
('2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `room_name` varchar(255) NOT NULL,
  `room_status` int(1) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `created_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `room_name`, `room_status`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'Meeting Room 1', 1, '2019-12-11 06:10:56', '2019-12-11 06:10:56', 'jiem21'),
(2, 'Guest Room 1', 1, '2019-12-11 06:11:22', '2019-12-11 06:11:22', 'jiem21');

-- --------------------------------------------------------

--
-- Table structure for table `tbl_time`
--

CREATE TABLE `tbl_time` (
  `id` int(11) NOT NULL,
  `Time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_time`
--

INSERT INTO `tbl_time` (`id`, `Time`) VALUES
(1, '08:00:00'),
(2, '08:15:00'),
(3, '08:30:00'),
(4, '08:45:00'),
(5, '09:00:00'),
(6, '09:15:00'),
(7, '09:30:00'),
(8, '09:45:00'),
(9, '10:00:00'),
(10, '10:15:00'),
(11, '10:30:00'),
(12, '10:45:00'),
(13, '11:00:00'),
(14, '11:15:00'),
(15, '11:30:00'),
(16, '11:45:00'),
(17, '12:00:00'),
(18, '12:15:00'),
(19, '12:30:00'),
(20, '12:45:00'),
(21, '13:00:00'),
(22, '13:15:00'),
(23, '13:30:00'),
(24, '13:45:00'),
(25, '14:00:00'),
(26, '14:15:00'),
(27, '14:30:00'),
(28, '14:45:00'),
(29, '15:00:00'),
(30, '15:15:00'),
(31, '15:30:00'),
(32, '15:45:00'),
(33, '16:00:00'),
(34, '16:15:00'),
(35, '16:30:00'),
(36, '16:45:00'),
(37, '17:00:00'),
(38, '17:15:00'),
(39, '17:30:00'),
(40, '17:45:00'),
(41, '18:00:00'),
(42, '18:15:00'),
(43, '18:30:00'),
(44, '18:45:00'),
(45, '19:00:00'),
(46, '19:15:00'),
(47, '19:30:00'),
(48, '19:45:00'),
(49, '20:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(1) NOT NULL,
  `role` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `created_by` varchar(255) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `username`, `password`, `status`, `role`, `remember_token`, `created_at`, `updated_at`, `created_by`) VALUES
(1, 'Jiem Macasadia', 'jiem_m@ibiden.com.ph', 'jiem21', '$2y$10$KA8ScD51DnTOoBNmCDJvzOwMY.bPpB2T8kdAFbJMKXbDp/drnAY9G', 1, '1', 'MLU1IMBG99rz3W7eBjttkFZTKxKncB3BUvPTM92Cltvch8haOSPGfXcY7RiV', '2019-12-08 21:24:58', '2019-12-13 05:32:52', 'admin'),
(2, 'Menard Canoy', 'menard_c@ibiden.com.ph', 'ga_account', '$2y$10$KA8ScD51DnTOoBNmCDJvzOwMY.bPpB2T8kdAFbJMKXbDp/drnAY9G', 1, '2', NULL, '2019-12-11 16:00:00', '2019-12-11 16:00:00', 'ADMIN'),
(7, 'Jiem Macasadia', 'm_jiem@ibiden.com.ph', '15267', '$2y$10$ZRaL8T.Z0/e/.yO9e/BxN.nWc7qnRe9WmLcr5MVD0NfyhsljUl322', 1, '1', NULL, '2019-12-13 08:26:23', NULL, 'Menard Canoy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `booking`
--
ALTER TABLE `booking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`),
  ADD KEY `password_resets_token_index` (`token`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tbl_time`
--
ALTER TABLE `tbl_time`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_username_unique` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `booking`
--
ALTER TABLE `booking`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbl_time`
--
ALTER TABLE `tbl_time`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
