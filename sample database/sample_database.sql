-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host : 127.0.0.1:3306
-- Généré le : mar. 01 juil. 2025 à 14:48
-- Version du serveur : 8.2.0
-- Version de PHP : 8.2.14

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database : `sample_database`
--

-- --------------------------------------------------------

--
-- Structure of table `country_x`
--

DROP TABLE IF EXISTS `country_x`;
CREATE TABLE IF NOT EXISTS `country_x` (
  `ip_range_start` bigint DEFAULT NULL,
  `ip_range_end` bigint DEFAULT NULL,
  `country_code` char(10) DEFAULT NULL,
  `city` char(100) DEFAULT NULL,
  `departement` char(100) DEFAULT NULL,
  `municipality` char(100) DEFAULT NULL,
  `postcode` char(20) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `timezone` char(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure of table `country_2`
--

DROP TABLE IF EXISTS `country_2`;
CREATE TABLE IF NOT EXISTS `country_2` (
  `ip_range_start` bigint DEFAULT NULL,
  `ip_range_end` bigint DEFAULT NULL,
  `country_code` char(10) DEFAULT NULL,
  `city` char(100) DEFAULT NULL,
  `departement` char(100) DEFAULT NULL,
  `municipality` char(100) DEFAULT NULL,
  `postcode` char(20) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `timezone` char(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------


--
-- Structure of table `country_1`
--

DROP TABLE IF EXISTS `country_1`;
CREATE TABLE IF NOT EXISTS `country_1` (
  `ip_range_start` bigint DEFAULT NULL,
  `ip_range_end` bigint DEFAULT NULL,
  `country_code` char(10) DEFAULT NULL,
  `city` char(100) DEFAULT NULL,
  `departement` char(100) DEFAULT NULL,
  `municipality` char(100) DEFAULT NULL,
  `postcode` char(20) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `timezone` char(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

-- --------------------------------------------------------

--
-- Structure of table `users` with password in tiger 160,3 encryption. There is no user login update system, so please edit your user directly in the database.
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` bigint NOT NULL AUTO_INCREMENT,
  `user_id` bigint NOT NULL,
  `user_name` varchar(60) NOT NULL,
  `password` varchar(60) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`),
  KEY `user_name` (`user_name`),
  KEY `date` (`date`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3;

-- --------------------------------------------------------

--
-- Structure of table `country_3`
--

DROP TABLE IF EXISTS `country_3`;
CREATE TABLE IF NOT EXISTS `country_3` (
  `ip_range_start` bigint DEFAULT NULL,
  `ip_range_end` bigint DEFAULT NULL,
  `country_code` char(10) DEFAULT NULL,
  `city` char(100) DEFAULT NULL,
  `departement` char(100) DEFAULT NULL,
  `municipality` char(100) DEFAULT NULL,
  `postcode` char(20) DEFAULT NULL,
  `latitude` double DEFAULT NULL,
  `longitude` double DEFAULT NULL,
  `timezone` char(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
