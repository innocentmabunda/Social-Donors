-- phpMyAdmin SQL Dump
-- version 4.9.5
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Sep 27, 2021 at 06:40 PM
-- Server version: 10.3.16-MariaDB
-- PHP Version: 7.3.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id14954189_scibono`
--

-- --------------------------------------------------------

--
-- Table structure for table `logs_in`
--

CREATE TABLE `logs_in` (
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `id` varchar(200) DEFAULT NULL,
  `ipaddress` varchar(200) DEFAULT NULL,
  `device` varchar(200) DEFAULT NULL,
  `datetime` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `logs_in`
--

INSERT INTO `logs_in` (`name`, `email`, `surname`, `id`, `ipaddress`, `device`, `datetime`) VALUES
('alec', 'ashelembe96@gmail.com', 'shelembe', '84785', 'Johannesburg Gauteng South Africa ZA Africa AF', '0', 'Date 2021-09-27 @ 06:33:38 pm');

-- --------------------------------------------------------

--
-- Table structure for table `logs_out`
--

CREATE TABLE `logs_out` (
  `name` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `id` varchar(200) DEFAULT NULL,
  `ipaddress` varchar(200) DEFAULT NULL,
  `device` varchar(200) DEFAULT NULL,
  `datetime` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `register_time` timestamp NOT NULL DEFAULT current_timestamp(),
  `course` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `gender` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `surname` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `number` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `last_login` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `account_status` varchar(200) COLLATE utf8_unicode_ci DEFAULT 'active',
  `image` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `email`, `password`, `register_time`, `course`, `gender`, `surname`, `number`, `last_login`, `account_status`, `image`) VALUES
('alec', 'ashelembe96@gmail.com', '$2y$10$Ou5PHTax89oqzGnLbD5Tnef4GqWCdiK4sSoT0Vixk0qxrUXqcVFMy', '2021-09-27 17:12:39', 'website development', 'on', 'shelembe', '*123#', 'Date 2021-09-27 @ 06:33:38 pm', 'active', 'IMG_2646.JPG'),
('Retshidisitswe', 'moko3na.r@gmail.com', '$2y$10$wwnfalyA1inmvLWHTGpswOP6JdoQBseum7XpsL1daXfcLmV/hlAa6', '2021-09-14 08:57:21', 'website development', 'on', 'Mokoena', '0788812942', 'Date 2021-09-14 @ 08:57:40 am', NULL, '20201221162423_IMG_9982.JPG'),
('tay', 'tay@gmail.com', '$2y$10$S5m1PK3NyNMdt4AVzXWICuV7A/gBd..cInD7NrtdJj9N/BA.DUBUe', '2021-09-21 08:39:04', 'website development', 'on', 'milli', '0123123', 'Date 2021-09-21 @ 08:39:22 am', 'active', 'FullColor_TextOnly_1280x1024_72dpi.jpg'),
('THembi', 'Thembelihle', '$2y$10$TjGPrZOvbQbCUH6R/PdtaO2TrQEAdyPxNLPa4tH7CmxqHORIK52Cm', '2021-09-21 08:19:02', 'website development', 'on', 'Mfaba', '0968745366', NULL, 'active', 'website_logo_transparent_background site icon.png'),
('Precious', 'thembelihle@gmail.com', '$2y$10$LVPxp41p4r5BqPk1TEdy.uuMgrUrh15VQQKLp/nj/5XY7yenBRAiG', '2021-09-21 08:21:53', 'website development', 'on', 'Mfaba', '0968745366', 'Date 2021-09-21 @ 08:23:51 am', 'active', 'Grayscale_1280x1024_72dpi.png');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`email`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
