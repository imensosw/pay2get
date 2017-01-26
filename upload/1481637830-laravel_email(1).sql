-- phpMyAdmin SQL Dump
-- version 4.0.10.14
-- http://www.phpmyadmin.net
--
-- Host: localhost:3306
-- Generation Time: Dec 13, 2016 at 02:30 AM
-- Server version: 5.6.33-cll-lve
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `laravel_email`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `fname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `lname` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `send_by` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` text COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` enum('expert','inquirer') COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `paid_status` int(1) NOT NULL DEFAULT '0',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=9 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `fname`, `lname`, `email`, `send_by`, `message`, `password`, `role`, `remember_token`, `paid_status`, `created_at`, `updated_at`) VALUES
(1, '1481558489-DeactivateProfile.png', 'jay', 'parihar', 'jparihar69@gmail.com', 'mahicoolparihar@gmail.com', 'test', NULL, NULL, NULL, 1, '2016-12-12 22:57:24', '2016-12-12 23:01:29'),
(2, '1481558877-TeamViewerQJ.dmg', 'Damir', 'Bodor', 'damir@niceworkdone.com', 'ddd@Ff.cc', 'test', NULL, NULL, NULL, 1, '2016-12-12 23:08:16', '2016-12-12 23:11:03'),
(3, '1481615163-Besabriyaan (MS Dhoni - The Untold Story) (HD Android).mp4', 'mahesh', 'parihar', 'mahicoolparihar@gmail.com', 'mahesh.imenso@gmail.com', 'testfsdf ', NULL, NULL, NULL, 0, '2016-12-13 14:46:15', '2016-12-13 14:46:15'),
(4, '1481616516-Screens.xlsx', 'mahesh', 'parihar', 'mahicoolparihar@gmail.com', 'mahesh.imenso@gmail.com', 'dfsfs', NULL, NULL, NULL, 0, '2016-12-13 15:08:36', '2016-12-13 15:08:36'),
(5, '1481617048-Besabriyaan (MS Dhoni - The Untold Story) (HD Android).mp4', 'mahesh', 'parihar', 'mahicoolparihar@gmail.com', 'mahesh.imenso@gmail.com', 'dfsfs dgfdgdfg', NULL, NULL, NULL, 0, '2016-12-13 15:17:44', '2016-12-13 15:17:44'),
(6, '1481617459-Screens.xlsx', 'mahesh', 'parihar', 'mahicoolparihar@gmail.com', 'mahesh.imenso@gmail.com', 'dfsdfsdf', NULL, NULL, NULL, 0, '2016-12-13 15:24:19', '2016-12-13 15:24:19'),
(7, '1481617621-ABTSBill_7021704858_632856180_ (1).pdf', 'Test', 'test', 'jparihar69@gmail.com', 'jparihar@imensosoftware.com', 'test', NULL, NULL, NULL, 0, '2016-12-13 15:27:01', '2016-12-13 15:27:01'),
(8, '1481617895-zuruuna.rar', 'Test', 'test', 'jparihar69@gmail.com', 'jparihar@imensosoftware.com', 'hjbjh', NULL, NULL, NULL, 0, '2016-12-13 15:31:47', '2016-12-13 15:31:47');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
