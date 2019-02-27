-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 27, 2019 at 12:58 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.0.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `parking55`
--

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `id` bigint(100) UNSIGNED NOT NULL,
  `userid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `xcord` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ycord` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `zeitpunkt` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parkplatz` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `grund` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tarif` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`id`, `userid`, `xcord`, `ycord`, `zeitpunkt`, `parkplatz`, `grund`, `tarif`, `telefon`, `image`, `created_at`, `updated_at`) VALUES
(1, '112', 'wefwefwef', 'qwdqwdqw', 'refgwref', 'dwqd', 'wefwef', 'weff', 'wefwf', 'parking_images/20190227_523561/34V542738954748.jpg', '2019-02-27 04:23:11', '2019-02-27 04:23:11'),
(3, '112', 'wefwefwef', 'qwdqwdqw', 'refgwref', 'dwqd', 'wefwef', 'weff', 'wefwf', 'parking_images/20190227_266923/0398420699701D6.jpg', '2019-02-27 04:23:44', '2019-02-27 04:23:44'),
(4, '112', 'wefwefwef', 'qwdqwdqw', 'refgwref', 'dwqd', 'wefwef', 'weff', 'wefwf', 'parking_images/20190227_670043/48403537046983U.jpg', '2019-02-27 04:23:46', '2019-02-27 04:23:46'),
(5, '112', 'wefwefwef', 'qwdqwdqw', 'refgwref', 'dwqd', 'wefwef', 'weff dara', 'wefwf', 'parking_images/20190227_209913/K27486072960731.jpg', '2019-02-27 04:27:24', '2019-02-27 04:27:24'),
(6, '112', 'wefwefwef dara', 'qwdqwdqw', 'refgwref', 'dwqd', 'wefwef', 'weff dara', 'wefwf', 'parking_images/20190227_924439/7361135987V8150.jpg', '2019-02-27 04:27:39', '2019-02-27 04:27:39');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_02_24_064911_parking', 1),
(4, '2019_02_24_065859_complaints', 1);

-- --------------------------------------------------------

--
-- Table structure for table `parking`
--

CREATE TABLE `parking` (
  `id` bigint(100) UNSIGNED NOT NULL,
  `userid` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `xcord` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ycord` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `parkplatz` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `strab` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `haus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plz` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ort` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_enc` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `parking`
--

INSERT INTO `parking` (`id`, `userid`, `xcord`, `ycord`, `parkplatz`, `strab`, `haus`, `plz`, `ort`, `image`, `image_enc`, `created_at`, `updated_at`) VALUES
(1, '112', 'qddqwd', 'qwdqwdqw', 'dwqd', 'dwqd', 'wqdq', 'qwdqd', 'qwdqw', 'parking_images/20190227_392106/974777769U97690.jpg', NULL, '2019-02-27 02:31:59', '2019-02-27 02:31:59'),
(3, '112', 'qddqwd', 'qwdqwdqw', 'dwqd', 'dwqd', 'wqdq', 'qwdqd', 'qwdqw', 'parking_images/20190227_383331/754459W23554630.jpg', NULL, '2019-02-27 02:32:41', '2019-02-27 02:32:41');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `image` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nutzung` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `anrede` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `firma` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `vorname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nachname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `strabe` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `haus` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `plz` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `ort` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefon` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `image`, `nutzung`, `anrede`, `firma`, `vorname`, `nachname`, `strabe`, `haus`, `plz`, `ort`, `telefon`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'dara', 'superadmin@parking.com', NULL, '$2y$10$aBZqxZjAKQXNgPXJuEZ0Huk2ELwGFHLDYcyDP/5I82p8FEVc4oASa', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'pjssGzwAcDlkLirAOx4sGU7YxyQFzBiLHR9eiKzYCh7Zy6ydG1tHs2B04QFV', '2019-02-26 23:33:32', '2019-02-27 03:02:17'),
(2, 'dara', 'dara@gmail.com', NULL, '$2y$10$co9KgEBuzz8hEbUE5UB0UujLcBPC8iI4bZoVGCjaRPFP2JC03Pz1y', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'rQoRZrtHzuWlUt0EhPhUnluZAMpvTwSOWWlYYu1LjwMhmuOg7YBV3OD8qceD', '2019-02-27 03:01:15', '2019-02-27 06:08:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parking`
--
ALTER TABLE `parking`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `id` bigint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `parking`
--
ALTER TABLE `parking`
  MODIFY `id` bigint(100) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
