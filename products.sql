-- phpMyAdmin SQL Dump
-- version 4.7.9
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Dec 09, 2018 at 04:55 PM
-- Server version: 5.7.21
-- PHP Version: 5.6.35

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `products`
--

-- --------------------------------------------------------

--
-- Table structure for table `devices`
--

DROP TABLE IF EXISTS `devices`;
CREATE TABLE IF NOT EXISTS `devices` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `device_name` varchar(256) COLLATE utf8_unicode_ci NOT NULL,
  `device_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_devices_device_type_idx` (`device_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=136 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `devices`
--

INSERT INTO `devices` (`id`, `device_name`, `device_type_id`) VALUES
(119, 'ASUS ROG', 1),
(120, 'DELL VOSTRO', 1),
(121, 'Lenovo Legion Y530', 2),
(122, 'DELL Inspiron 15', 2),
(123, 'Apple', 3);

-- --------------------------------------------------------

--
-- Table structure for table `device_properties`
--

DROP TABLE IF EXISTS `device_properties`;
CREATE TABLE IF NOT EXISTS `device_properties` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `OS` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `processor` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `ram_memory` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  `screen_size` varchar(24) COLLATE utf8_unicode_ci DEFAULT NULL,
  `touch_screen` tinyint(1) DEFAULT NULL,
  `devices_id` int(11) NOT NULL,
  `device_type_id` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `fk_device_properties_devices1_idx` (`devices_id`),
  KEY `fk_device_properties_device_type1_idx` (`device_type_id`)
) ENGINE=InnoDB AUTO_INCREMENT=91 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `device_properties`
--

INSERT INTO `device_properties` (`id`, `OS`, `processor`, `ram_memory`, `screen_size`, `touch_screen`, `devices_id`, `device_type_id`) VALUES
(77, 'Windows 8', ' Intel i5-5200U', '8 Gb', NULL, NULL, 119, 1),
(78, 'Windows 10 Pro', ' Intel Pentium N3700', '4 Gb', NULL, NULL, 120, 1),
(79, 'Windows 10', 'Intel i5-8300H', '8 Gb', '15.6', NULL, 121, 2),
(80, 'Linux', 'Intel i5-8250U', '8Gb', '15.6', NULL, 122, 2),
(81, 'iOS 10', 'A9', '2Gb', '9.7', 1, 123, 3);

-- --------------------------------------------------------

--
-- Table structure for table `device_type`
--

DROP TABLE IF EXISTS `device_type`;
CREATE TABLE IF NOT EXISTS `device_type` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `type_name` varchar(45) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `device_type`
--

INSERT INTO `device_type` (`id`, `type_name`) VALUES
(1, 'Desktop'),
(2, 'Laptop'),
(3, 'Tablet');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `devices`
--
ALTER TABLE `devices`
  ADD CONSTRAINT `fk_devices_device_type` FOREIGN KEY (`device_type_id`) REFERENCES `device_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `device_properties`
--
ALTER TABLE `device_properties`
  ADD CONSTRAINT `fk_device_properties_device_type1` FOREIGN KEY (`device_type_id`) REFERENCES `device_type` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_device_properties_devices1` FOREIGN KEY (`devices_id`) REFERENCES `devices` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
