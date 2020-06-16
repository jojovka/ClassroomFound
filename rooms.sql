-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 28, 2020 at 12:09 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rooms`
--

-- --------------------------------------------------------

--
-- Table structure for table `calendar`
--

CREATE TABLE `calendar` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp(),
  `room_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `calendar`
--

INSERT INTO `calendar` (`id`, `date`, `room_id`, `user_id`) VALUES
(1, '2020-05-26', 12, 3),
(2, '2020-05-26', 21, 1),
(3, '2020-05-26', 25, 3),
(4, '2020-05-26', 31, 1),
(12, '2020-05-26', 14, 1),
(13, '2020-05-26', 14, 1),
(14, '2020-05-26', 14, 1),
(15, '2020-05-26', 15, 1),
(16, '2020-05-26', 14, 1),
(17, '2020-05-26', 15, 1),
(18, '2020-05-26', 16, 1),
(19, '2020-05-26', 12, 1),
(20, '2020-05-26', 13, 1),
(21, '2020-05-26', 17, 1),
(22, '2020-05-26', 22, 1),
(23, '2020-05-26', 20, 1),
(24, '2020-05-26', 12, 1),
(25, '2020-06-26', 12, 1),
(26, '2020-06-26', 13, 1),
(27, '2020-06-26', 14, 1),
(28, '2020-06-26', 15, 1),
(29, '2020-05-26', 18, 1),
(30, '2020-05-26', 18, 1),
(31, '2020-06-26', 16, 1),
(32, '2020-06-26', 17, 1),
(33, '2020-06-26', 18, 1),
(34, '2020-04-26', 12, 1),
(35, '2020-04-26', 14, 1),
(36, '2020-04-26', 16, 1),
(37, '2020-05-26', 19, 1),
(38, '2020-05-27', 12, 1),
(39, '2020-05-27', 15, 1),
(40, '2020-05-27', 15, 1),
(41, '2020-05-27', 15, 1),
(42, '2020-05-27', 15, 1),
(43, '2020-05-28', 15, 5),
(44, '2020-05-28', 20, 5),
(45, '2020-05-28', 23, 5),
(46, '2020-05-28', 17, 1),
(47, '2020-05-28', 25, 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_rooms`
--

CREATE TABLE `class_rooms` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `projector` tinyint(1) NOT NULL,
  `mountain` tinyint(1) NOT NULL,
  `intdesk` tinyint(1) NOT NULL,
  `capacity` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_rooms`
--

INSERT INTO `class_rooms` (`id`, `name`, `projector`, `mountain`, `intdesk`, `capacity`) VALUES
(15, 14, 1, 0, 1, 11),
(17, 16, 0, 1, 1, 10),
(18, 17, 0, 1, 0, 10),
(19, 18, 0, 0, 1, 10),
(20, 20, 1, 1, 1, 20),
(21, 21, 1, 1, 0, 20),
(22, 22, 1, 0, 1, 20),
(23, 23, 1, 0, 0, 20),
(24, 24, 0, 1, 1, 20),
(25, 25, 0, 1, 0, 20),
(26, 26, 0, 0, 1, 20),
(27, 27, 0, 0, 0, 20),
(28, 30, 1, 1, 1, 30),
(29, 31, 1, 1, 0, 30),
(30, 32, 1, 0, 1, 30),
(31, 33, 1, 0, 0, 30),
(32, 34, 0, 1, 1, 30),
(33, 35, 0, 1, 0, 30),
(34, 36, 0, 0, 1, 30),
(35, 37, 0, 0, 0, 30),
(36, 11, 1, 0, 1, 5),
(37, 12, 1, 1, 1, 30),
(38, 222, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) UNSIGNED NOT NULL,
  `login` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `isadmin` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `login`, `email`, `password`, `isadmin`) VALUES
(1, '123', '123@123.ru', '$2y$10$glkQApk0wgIBbB6AA4iCCe6uOabiay/YffsPrw.ssWcH48DNQGqrW', 0),
(3, '4321', '321@321.ru', '$2y$10$1Z3LwuYVZoI.s6sQ5dflMOgkAG4c.U.S3rwWbDIMyMCpCG./HB7d6', 0),
(4, 'admin', 'admin@admin.com', '$2y$10$xmhLLDOnxwHG5Ugn5Zmq1uXY/FlLwgCwfpwAQ3hBzHYbvU38enzS.', 1),
(5, 'user1', 'user1@mail.com', '$2y$10$F2vd1ygDLjfquvTwjgAaqOHKTzE8vJr4InuhQeVBs3KNUQ6uwUjOK', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `calendar`
--
ALTER TABLE `calendar`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `class_rooms`
--
ALTER TABLE `class_rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `calendar`
--
ALTER TABLE `calendar`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `class_rooms`
--
ALTER TABLE `class_rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
