-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 10, 2024 at 06:39 PM
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
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `name` varchar(191) NOT NULL,
  `slug` varchar(191) NOT NULL,
  `description` mediumtext NOT NULL,
  `status` tinyint(4) NOT NULL DEFAULT 0,
  `popular` tinyint(4) NOT NULL DEFAULT 0,
  `image` varchar(191) NOT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `name`, `slug`, `description`, `status`, `popular`, `image`, `meta_title`, `meta_description`, `meta_keywords`, `created_at`) VALUES
(10, 'Biochemistry', 'biochemistry', '', 0, 0, '1707967592.png', '', '', '', '2024-02-15 03:26:32'),
(11, 'Biology', 'biology', '', 0, 0, '1707967631.png', '', '', '', '2024-02-15 03:27:11'),
(12, 'Biophysics', 'biophysics', '', 0, 0, '1707967644.png', '', '', '', '2024-02-15 03:27:24'),
(13, 'Chemistry', 'chemistry', '', 0, 0, '1707967679.png', '', '', '', '2024-02-15 03:27:59'),
(14, 'Civil Engineering', 'civilengineering', '', 0, 0, '1707967725.png', '', '', '', '2024-02-15 03:28:45'),
(15, 'Mechanical Engineering', 'mechanicalengineering', '', 0, 0, '1707967756.png', '', '', '', '2024-02-15 03:29:16'),
(16, 'Physics', 'physics', '', 0, 0, '1707967774.png', '', '', '', '2024-02-15 03:29:34'),
(17, 'Robotics', 'robotics', '', 0, 0, '1707967811.png', '', '', '', '2024-02-15 03:30:11'),
(18, 'Software and Websites', 'softwareandwebsites', '', 0, 0, '1707967845.png', '', '', '', '2024-02-15 03:30:45'),
(19, 'Technical Engineering', 'technicalengineering', '', 0, 0, '1707967871.png', '', '', '', '2024-02-15 03:31:11');

-- --------------------------------------------------------

--
-- Table structure for table `login_data`
--

CREATE TABLE `login_data` (
  `login_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `login_otp` int(6) NOT NULL,
  `last_activity` datetime NOT NULL,
  `login_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `login_data`
--

INSERT INTO `login_data` (`login_id`, `user_id`, `login_otp`, `last_activity`, `login_datetime`) VALUES
(27, 33, 483435, '2023-02-24 05:22:26', '2024-02-23 16:22:26'),

-- --------------------------------------------------------

--
-- Table structure for table `register_user`
--

CREATE TABLE `register_user` (
  `register_user_id` int(11) NOT NULL,
  `user_name` varchar(250) NOT NULL,
  `user_email` varchar(250) NOT NULL,
  `user_password` varchar(250) NOT NULL,
  `user_activation_code` varchar(250) NOT NULL,
  `user_email_status` enum('not verified','verified') NOT NULL,
  `user_otp` int(11) NOT NULL,
  `user_datetime` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `lrn` int(11) NOT NULL,
  `user_role` varchar(10) NOT NULL DEFAULT 'user',
  `agree_to_terms` tinyint(1) NOT NULL DEFAULT 0,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0,
  `otp` int(11) NOT NULL,
  `research_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `register_user`
--

INSERT INTO `register_user` (`register_user_id`, `user_name`, `user_email`, `user_password`, `user_activation_code`, `user_email_status`, `user_otp`, `user_datetime`, `lrn`, `user_role`, `agree_to_terms`, `is_verified`, `otp`, `research_id`) VALUES
(32, 'Anita Max Wynn', 'longenou1231@gmail.com', '$2y$10$TsZ6KtcIa7GtFvHAoUj3QOq4DKwVPJJfAwDfb8PvpiiQfG9rjDLdq', '4f6981aa615042a56bcd7fc90b898f93', 'verified', 666421, '2024-03-10 17:36:33', 2147483647, 'admin', 1, 1, 0, 39);

-- --------------------------------------------------------

--
-- Table structure for table `researches`
--

CREATE TABLE `researches` (
  `id` int(11) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `file` varchar(255) NOT NULL,
  `authors` varchar(255) NOT NULL,
  `language` varchar(255) NOT NULL,
  `chapters` int(11) NOT NULL,
  `school_year` int(11) NOT NULL,
  `abstract` varchar(255) NOT NULL,
  `category_id` int(11) NOT NULL,
  `meta_title` varchar(191) NOT NULL,
  `meta_keywords` mediumtext NOT NULL,
  `meta_description` mediumtext NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `featured` tinyint(4) NOT NULL,
  `is_verified` tinyint(4) NOT NULL DEFAULT 0,
  `register_user_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `researches`
--

INSERT INTO `researches` (`id`, `name`, `file`, `authors`, `language`, `chapters`, `school_year`, `abstract`, `category_id`, `meta_title`, `meta_keywords`, `meta_description`, `created_at`, `featured`, `is_verified`, `register_user_id`) VALUES
(39, 'Chemistry Sample 2', 'Contents and Front Matter.pdf', 'Cristiano Ronaldo, Lionel Messi, Andres Iniesta, Radamel Falcao', 'Tagalog', 5, 2021, 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor i', 13, '', '', '', '2024-02-15 16:33:00', 0, 1, 32);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `login_data`
--
ALTER TABLE `login_data`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `register_user`
--
ALTER TABLE `register_user`
  ADD PRIMARY KEY (`register_user_id`);

--
-- Indexes for table `researches`
--
ALTER TABLE `researches`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `login_data`
--
ALTER TABLE `login_data`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `register_user`
--
ALTER TABLE `register_user`
  MODIFY `register_user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `researches`
--
ALTER TABLE `researches`
  MODIFY `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
