-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 27, 2021 at 02:19 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.4.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `scibonostream`
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
  `country` varchar(200) DEFAULT NULL,
  `datetime` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
  `country` varchar(200) DEFAULT NULL,
  `datetime` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `name` varchar(200) DEFAULT NULL,
  `surname` varchar(200) DEFAULT NULL,
  `number` varchar(200) DEFAULT NULL,
  `email` varchar(200) DEFAULT NULL,
  `password` varchar(200) DEFAULT NULL,
  `image` varchar(200) DEFAULT NULL,
  `id` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`name`, `surname`, `number`, `email`, `password`, `image`, `id`) VALUES
('bob', 'Shelembe', '0727237808', 'newemail@gmail.com', '$2y$10$Cujq94I4sPhRjVkWwOtY.u8vatrZKFjYUUU6JpP.cKBZ42Q1msFjW', 'IMG_2759.JPG', '12478'),
('Bluetooth Earphones', 'Shelembe', '*123#', 'newemail2@gmail.com', '$2y$10$xoLS1PZ/EeK11d9puEyuy.uAnCSbo2o4OJvlf5r0EshLvo5YKNvx6', 'WIN_20210629_12_56_05_Pro.jpg', '32672'),
('Alec', 'Shelembe', '0727237808', 'alecshelembe@gmail.com', '$2y$10$ettBB3hY.m51iXdgcgRvl.OEzASyG84rDwvW0o2uoyTLaZTmx4FVi', 'IMG_2646.JPG', '50588');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
