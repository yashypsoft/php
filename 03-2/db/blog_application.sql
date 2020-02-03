-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 03, 2020 at 05:40 PM
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
-- Database: `blog_application`
--

-- --------------------------------------------------------

--
-- Table structure for table `blog_post`
--

CREATE TABLE `blog_post` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `category` varchar(50) NOT NULL,
  `image` varchar(80) NOT NULL,
  `published_at` datetime NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blog_post`
--

INSERT INTO `blog_post` (`id`, `user_id`, `title`, `url`, `content`, `category`, `image`, `published_at`, `created_at`, `updated_at`) VALUES
(1, 7, 'aa', 'http://www.gmail.com', 'a', 'fashion', '', '2020-02-08 11:11:00', '2020-02-03 05:00:58', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `id` int(11) NOT NULL,
  `parent_category_id` int(11) NOT NULL,
  `title` varchar(50) NOT NULL,
  `meta_title` varchar(50) NOT NULL,
  `url` varchar(50) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`id`, `parent_category_id`, `title`, `meta_title`, `url`, `content`, `created_at`, `updated_at`) VALUES
(1, 0, 'a', 'a', 'http://gmail.com', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 0, 'a', 'a', 'http://gmail.com', 'a', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `parent_category`
--

CREATE TABLE `parent_category` (
  `id` int(11) NOT NULL,
  `parent_category` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent_category`
--

INSERT INTO `parent_category` (`id`, `parent_category`) VALUES
(1, 'fashion,tech');

-- --------------------------------------------------------

--
-- Table structure for table `post_category`
--

CREATE TABLE `post_category` (
  `post_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `prefix` varchar(25) NOT NULL,
  `first_name` varchar(25) NOT NULL,
  `last_name` varchar(25) NOT NULL,
  `mobile` bigint(100) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL,
  `last_login_at` datetime NOT NULL,
  `information` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `prefix`, `first_name`, `last_name`, `mobile`, `email`, `password`, `last_login_at`, `information`, `created_at`, `updated_at`) VALUES
(4, 'Miss', 'Yash', 'Prajapati', 7016838413, 'yashypsoft@gmail.com', '123', '0000-00-00 00:00:00', 'hello', '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Miss', 'Yash', 'Prajapati', 7016838413, 'yashypsoft@gmail.com', '123', '0000-00-00 00:00:00', 'hello', '2020-02-03 02:55:16', '0000-00-00 00:00:00'),
(6, 'Miss', 'Yash', 'Prajapati', 7016838413, 'yashypsoft@gmail.com', '123', '0000-00-00 00:00:00', 'hello', '2020-02-03 02:57:43', '0000-00-00 00:00:00'),
(7, 'Mrs', 'yash', 'prajapati', 9574391670, 'yashypso1ft@gmail.com', '202cb962ac59075b964b07152d234b70', '0000-00-00 00:00:00', 'hello', '2020-02-03 03:31:14', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `blog_post`
--
ALTER TABLE `blog_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parent_category`
--
ALTER TABLE `parent_category`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `blog_post`
--
ALTER TABLE `blog_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `parent_category`
--
ALTER TABLE `parent_category`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
