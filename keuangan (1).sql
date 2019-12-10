-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2019 at 04:00 AM
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
-- Database: `keuangan`
--

-- --------------------------------------------------------

--
-- Table structure for table `a_accounts`
--

CREATE TABLE `a_accounts` (
  `id` int(11) NOT NULL,
  `kode` varchar(4) DEFAULT NULL,
  `asset` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `a_accounts`
--

INSERT INTO `a_accounts` (`id`, `kode`, `asset`) VALUES
(1, '1111', 'Kas'),
(2, '1112', 'Bank BNI'),
(3, '1113', 'Bank BCA'),
(4, '1114', 'Bank DBS'),
(5, '1115', 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `incomes`
--

CREATE TABLE `incomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assets` int(11) DEFAULT NULL,
  `i_accounts` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

--
-- Dumping data for table `incomes`
--

INSERT INTO `incomes` (`id`, `assets`, `i_accounts`, `total`, `info`, `created_at`, `updated_at`, `date`) VALUES
(1, 2, 3, 123456789, 'waresdtfyuhio', '2019-12-10 00:16:39', '2019-12-10 00:16:39', '2019-12-12 00:16:39'),
(2, 2, 2, 23456788, 'werty', '2019-12-10 02:47:10', '2019-12-10 02:47:10', '2019-12-25 02:47:10'),
(3, 2, 3, 8756432, 'tes 3', '2019-12-10 02:48:46', '2019-12-10 02:48:46', '2019-12-21 02:48:46');

-- --------------------------------------------------------

--
-- Table structure for table `i_accounts`
--

CREATE TABLE `i_accounts` (
  `id` int(11) NOT NULL,
  `kode` varchar(4) DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `i_accounts`
--

INSERT INTO `i_accounts` (`id`, `kode`, `account`) VALUES
(1, '2111', 'Hasil Usaha'),
(2, '2112', 'Gaji'),
(3, '2113', 'Uang Saku'),
(4, '2114', 'Lain-lain');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `outcomes`
--

CREATE TABLE `outcomes` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `assets` int(11) DEFAULT NULL,
  `o_accounts` int(11) DEFAULT NULL,
  `total` int(11) NOT NULL,
  `info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL,
  `date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci ROW_FORMAT=DYNAMIC;

-- --------------------------------------------------------

--
-- Table structure for table `o_accounts`
--

CREATE TABLE `o_accounts` (
  `id` int(11) NOT NULL,
  `kode` varchar(4) DEFAULT NULL,
  `account` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `o_accounts`
--

INSERT INTO `o_accounts` (`id`, `kode`, `account`) VALUES
(1, '3111', 'Pengeluaran 1'),
(2, '3112', 'Pengeluaran 2'),
(3, '3113', 'Pengeluaran 3'),
(4, '3114', 'Pengeluaran 4');

-- --------------------------------------------------------

--
-- Stand-in structure for view `v_incomes`
-- (See below for the actual view)
--
CREATE TABLE `v_incomes` (
`id` bigint(20) unsigned
,`id_a_asset` int(11)
,`assets` varchar(50)
,`id_i_account` int(11)
,`i_kode` varchar(4)
,`i_account` varchar(50)
,`total` int(11)
,`info` varchar(255)
,`created_at` datetime
,`updated_at` datetime
,`date` varchar(10)
);

-- --------------------------------------------------------

--
-- Structure for view `v_incomes`
--
DROP TABLE IF EXISTS `v_incomes`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `v_incomes`  AS  select `i`.`id` AS `id`,`i`.`assets` AS `id_a_asset`,`a`.`asset` AS `assets`,`i`.`i_accounts` AS `id_i_account`,`ia`.`kode` AS `i_kode`,`ia`.`account` AS `i_account`,`i`.`total` AS `total`,`i`.`info` AS `info`,`i`.`created_at` AS `created_at`,`i`.`updated_at` AS `updated_at`,(select date_format(`i`.`date`,'%d/%m/%Y')) AS `date` from ((`incomes` `i` join `a_accounts` `a`) join `i_accounts` `ia`) where `i`.`i_accounts` = `ia`.`id` and `i`.`assets` = `a`.`id` ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `a_accounts`
--
ALTER TABLE `a_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `incomes`
--
ALTER TABLE `incomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_INCOMES_TO_A_ACCOUNTS` (`assets`),
  ADD KEY `FK_INCOMES_TO_I_ACCOUNTS` (`i_accounts`);

--
-- Indexes for table `i_accounts`
--
ALTER TABLE `i_accounts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `outcomes`
--
ALTER TABLE `outcomes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_OUTCOMES_TO_A_ACCOUNTS` (`assets`),
  ADD KEY `FK_OUTCOMES_TO_O_ACCOUNTS` (`o_accounts`);

--
-- Indexes for table `o_accounts`
--
ALTER TABLE `o_accounts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `a_accounts`
--
ALTER TABLE `a_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `incomes`
--
ALTER TABLE `incomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `i_accounts`
--
ALTER TABLE `i_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `outcomes`
--
ALTER TABLE `outcomes`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `o_accounts`
--
ALTER TABLE `o_accounts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `incomes`
--
ALTER TABLE `incomes`
  ADD CONSTRAINT `FK_INCOMES_TO_A_ACCOUNTS` FOREIGN KEY (`assets`) REFERENCES `a_accounts` (`id`),
  ADD CONSTRAINT `FK_INCOMES_TO_I_ACCOUNTS` FOREIGN KEY (`i_accounts`) REFERENCES `i_accounts` (`id`);

--
-- Constraints for table `outcomes`
--
ALTER TABLE `outcomes`
  ADD CONSTRAINT `FK_OUTCOMES_TO_A_ACCOUNTS` FOREIGN KEY (`assets`) REFERENCES `a_accounts` (`id`),
  ADD CONSTRAINT `FK_OUTCOMES_TO_O_ACCOUNTS` FOREIGN KEY (`o_accounts`) REFERENCES `o_accounts` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
