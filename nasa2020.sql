-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 30, 2020 at 06:45 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `nasa2020`
--

-- --------------------------------------------------------

--
-- Table structure for table `cookies`
--

CREATE TABLE `cookies` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `text` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `browser` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `tstamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `cookies`
--

INSERT INTO `cookies` (`id`, `text`, `browser`, `tstamp`) VALUES
(3, 'noPlveckqeOd4mfae5ha7lGb7ep.48D689J0J1v014V3658', 'Mozilla/5.0 (Windows NT 10.0; Win64; x64; rv:81.0) Gecko/20100101 Firefox/81.0', 1601453658);

-- --------------------------------------------------------

--
-- Table structure for table `discussions`
--

CREATE TABLE `discussions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `title` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `text` mediumtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `thumb` bigint(20) UNSIGNED NOT NULL,
  `tstamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `discussions`
--

INSERT INTO `discussions` (`id`, `title`, `uid`, `text`, `thumb`, `tstamp`) VALUES
(1, 'This is the title', 5, 'This is the text!', 0, 1601465412);

-- --------------------------------------------------------

--
-- Table structure for table `dis_cmms`
--

CREATE TABLE `dis_cmms` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `dis_id` bigint(20) UNSIGNED NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `reply` bigint(20) UNSIGNED NOT NULL,
  `text` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `tstamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dis_cmms`
--

INSERT INTO `dis_cmms` (`id`, `dis_id`, `uid`, `reply`, `text`, `tstamp`) VALUES
(1, 1, 5, 1, 'This is the comment', 1601470839);

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `url` tinytext NOT NULL,
  `mime` varchar(50) NOT NULL,
  `ext` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ulogins`
--

CREATE TABLE `ulogins` (
  `uid` bigint(20) UNSIGNED NOT NULL,
  `pswd` bigint(20) UNSIGNED NOT NULL,
  `lang` smallint(5) UNSIGNED NOT NULL,
  `theme` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cookie` bigint(20) UNSIGNED NOT NULL,
  `logged` tinyint(1) NOT NULL,
  `saved` tinyint(1) NOT NULL,
  `tstamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `ulogins`
--

INSERT INTO `ulogins` (`uid`, `pswd`, `lang`, `theme`, `cookie`, `logged`, `saved`, `tstamp`) VALUES
(5, 5, 0, 'default', 3, 1, 0, 1601455363);

-- --------------------------------------------------------

--
-- Table structure for table `upswds`
--

CREATE TABLE `upswds` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `pswd` tinytext COLLATE utf8mb4_unicode_ci NOT NULL,
  `perms` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `active` tinyint(1) NOT NULL,
  `tstamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `upswds`
--

INSERT INTO `upswds` (`id`, `uid`, `pswd`, `perms`, `active`, `tstamp`) VALUES
(5, 5, '$argon2i$v=19$m=65536,t=4,p=1$Lk9jNGVmYkJZSlJiUHg0RQ$wKCsTmHMfvcRXcy4fx0wD5uR20Am5EJaImuf2KGMvF0', '', 1, 1601455363);

-- --------------------------------------------------------

--
-- Table structure for table `urecover`
--

CREATE TABLE `urecover` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `rkey` varchar(10) COLLATE utf8mb4_unicode_ci NOT NULL,
  `cookie` bigint(20) UNSIGNED NOT NULL,
  `uid` bigint(20) UNSIGNED NOT NULL,
  `tstamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(60) COLLATE utf8mb4_unicode_ci NOT NULL,
  `link` varchar(100) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` bigint(20) UNSIGNED NOT NULL,
  `cover` bigint(20) UNSIGNED NOT NULL,
  `birth` date NOT NULL,
  `click` bigint(20) UNSIGNED NOT NULL,
  `lref` bigint(20) UNSIGNED NOT NULL,
  `tstamp` bigint(20) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `link`, `photo`, `cover`, `birth`, `click`, `lref`, `tstamp`) VALUES
(5, 'Saad', 'alor_pretatma', 1, 1, '0000-00-00', 1601455363, 1601455363, 1601455363);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cookies`
--
ALTER TABLE `cookies`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `cookie` (`text`);

--
-- Indexes for table `discussions`
--
ALTER TABLE `discussions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dis_cmms`
--
ALTER TABLE `dis_cmms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ulogins`
--
ALTER TABLE `ulogins`
  ADD UNIQUE KEY `Unique` (`uid`,`pswd`,`cookie`),
  ADD KEY `User` (`uid`),
  ADD KEY `Cookie` (`cookie`),
  ADD KEY `Is Logged` (`logged`);

--
-- Indexes for table `upswds`
--
ALTER TABLE `upswds`
  ADD PRIMARY KEY (`id`),
  ADD KEY `User` (`uid`);

--
-- Indexes for table `urecover`
--
ALTER TABLE `urecover`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `Link` (`link`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cookies`
--
ALTER TABLE `cookies`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `discussions`
--
ALTER TABLE `discussions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dis_cmms`
--
ALTER TABLE `dis_cmms`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `upswds`
--
ALTER TABLE `upswds`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `urecover`
--
ALTER TABLE `urecover`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
