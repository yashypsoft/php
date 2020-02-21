-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 21, 2020 at 06:56 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `vehicle_registration`
--

-- --------------------------------------------------------

--
-- Table structure for table `service_registrations`
--

CREATE TABLE `service_registrations` (
  `service_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `vehicle_number` varchar(50) NOT NULL,
  `licence_number` varchar(50) NOT NULL,
  `date` date NOT NULL,
  `time_slot` varchar(50) NOT NULL,
  `vehicle_issue` text NOT NULL,
  `service_center` varchar(50) NOT NULL,
  `status` varchar(50) NOT NULL DEFAULT 'Pending',
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_registrations`
--

INSERT INTO `service_registrations` (`service_id`, `user_id`, `title`, `vehicle_number`, `licence_number`, `date`, `time_slot`, `vehicle_issue`, `service_center`, `status`, `created_at`, `updated_at`) VALUES
(4, 2, 'werfr1wwww', 'GJ 05 2221', '5965562', '2020-02-22', '11-12', 'frgb    ', '1', 'Pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 2, 'werfrq', 'GJ 05 2221', '955595555', '2020-02-29', '5-6', ' sgdhr', '1', 'Pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 2, 'title', 'GJ 05 2226', '123453456', '2020-02-29', '12-1', ' efrbgds', '4', 'Pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 2, 'title', 'GJ 05 2223', '59655621', '2020-02-22', '11-12', ' 2w3er', '1', 'Pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(8, 2, 'title', 'GJ 05 2224', '35336234', '2020-02-22', '11-12', ' fesdeaF', '1', 'Pending', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone_number` bigint(80) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `first_name`, `last_name`, `email`, `password`, `phone_number`, `created_at`, `updated_at`) VALUES
(1, 'yash', 'Prajapati', 'yash@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', 2147483647, '2020-02-21 14:44:06', '0000-00-00 00:00:00'),
(2, 'Mustafa', 'Bharmal', 'admin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 9773222318, '2020-02-21 14:46:37', '0000-00-00 00:00:00'),
(3, 'Yash', 'P', 'admina@admin.com', '21232f297a57a5a743894a0e4a801fc3', 16838413, '2020-02-21 14:48:36', '0000-00-00 00:00:00'),
(4, 'Yash', 'P', 'admin2@admin.com', '21232f297a57a5a743894a0e4a801fc3', 7016838413, '2020-02-21 14:51:37', '0000-00-00 00:00:00'),
(5, 'Yash', 'P', 'admsin@admin.com', '21232f297a57a5a743894a0e4a801fc3', 7016838413, '2020-02-21 14:52:20', '0000-00-00 00:00:00'),
(6, 'Mustafa', 'Bharmal', 'adminqq@admin.com', '21232f297a57a5a743894a0e4a801fc3', 16838413, '2020-02-21 14:53:16', '0000-00-00 00:00:00'),
(7, 'Mustafa', 'Bharmal', 'adminww@admin.com', '21232f297a57a5a743894a0e4a801fc3', 9723710646, '2020-02-21 14:53:40', '0000-00-00 00:00:00'),
(8, 'Yash', 'P', 'dehus@sfamo.com', '5306276b1e7c2314e4b0b2f76858c041', 7016838413, '2020-02-21 16:56:27', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `user_addresses`
--

CREATE TABLE `user_addresses` (
  `address_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `street` text NOT NULL,
  `city` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `zipcode` int(11) NOT NULL,
  `country` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_addresses`
--

INSERT INTO `user_addresses` (`address_id`, `user_id`, `street`, `city`, `state`, `zipcode`, `country`, `created_at`, `updated_at`) VALUES
(1, 1, '', '', '', 0, '', '2020-02-21 14:44:06', '0000-00-00 00:00:00'),
(2, 2, '', '', '', 0, '', '2020-02-21 14:46:37', '0000-00-00 00:00:00'),
(3, 4, '', '', '', 0, '', '2020-02-21 14:51:37', '0000-00-00 00:00:00'),
(4, 0, '302 Taheri flats, Opp Voras gate,', 'Bhavnagar', 'Gujarat', 364002, 'India', '2020-02-21 14:53:16', '0000-00-00 00:00:00'),
(5, 7, '302 Taheri flats, Opp Voras gate,', 'Bhavnagar', 'Gujarat', 364002, 'India', '2020-02-21 14:53:40', '0000-00-00 00:00:00'),
(6, 8, 'Prajapativas,chhelpati,sundhiya', 'Sundhiya', 'Gujarat', 384345, 'India', '2020-02-21 16:56:27', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `service_registrations`
--
ALTER TABLE `service_registrations`
  ADD PRIMARY KEY (`service_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_addresses`
--
ALTER TABLE `user_addresses`
  ADD PRIMARY KEY (`address_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `service_registrations`
--
ALTER TABLE `service_registrations`
  MODIFY `service_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `user_addresses`
--
ALTER TABLE `user_addresses`
  MODIFY `address_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
