-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Aug 04, 2026 at 11:42 PM
-- Server version: 8.4.3
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Database: `parking_reservation`
--
CREATE DATABASE IF NOT EXISTS `parking_reservation` DEFAULT CHARACTER SET utf8mb3 COLLATE utf8mb3_hungarian_ci;
USE `parking_reservation`;

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `id` int NOT NULL,
  `space` varchar(120) COLLATE utf8mb3_hungarian_ci NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `reserver` varchar(255) COLLATE utf8mb3_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_hungarian_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`id`, `space`, `start_time`, `end_time`, `reserver`) VALUES
(1, 'A2', '2026-08-04 18:30:00', '2026-08-04 20:30:00', 'László'),
(2, 'B1', '2026-08-04 18:30:00', '2026-08-04 19:20:00', 'Anna'),
(3, 'B3', '2026-08-04 17:20:00', '2026-08-04 18:10:00', 'Anna'),
(4, 'A2', '2026-08-04 08:30:00', '2026-08-04 09:00:00', 'Márk'),
(5, 'A11', '2026-08-04 21:00:00', '2026-08-04 23:00:00', 'Réka'),
(6, 'B1', '2026-08-04 19:30:00', '2026-08-04 22:05:00', 'Péter'),
(7, 'C4', '2026-08-05 10:30:00', '2026-08-05 12:00:00', 'Sára'),
(8, 'C4', '2026-08-06 16:10:00', '2026-08-07 09:00:00', 'Lajos'),
(9, 'C4', '2026-08-06 10:30:00', '2026-08-06 12:00:00', 'Sára'),
(10, 'A5', '2026-08-04 23:59:00', '2026-08-5 07:50:00', 'Marci');

--
-- Table structure for table `spaces`
--

CREATE TABLE `spaces` (
  `id` int NOT NULL,
  `name` varchar(120) COLLATE utf8mb3_hungarian_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_hungarian_ci;

--
-- Dumping data for table `spaces`
--

INSERT INTO `spaces` (`id`, `name`) VALUES
(1, 'A1'),
(2, 'A2'),
(3, 'A3'),
(5, 'A4'),
(6, 'A5'),
(7, 'A6'),
(8, 'A7'),
(9, 'A8'),
(10, 'A9'),
(11, 'A10'),
(12, 'A11'),
(13, 'A12'),
(14, 'A13'),
(15, 'A14'),
(16, 'A15'),
(17, 'B1'),
(18, 'B2'),
(19, 'B3'),
(20, 'B4'),
(21, 'B5'),
(22, 'B6'),
(23, 'B7'),
(24, 'B8'),
(25, 'B9'),
(26, 'B10'),
(27, 'C1'),
(28, 'C2'),
(29, 'C3'),
(30, 'C4'),
(31, 'C5');

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `spaces`
--
ALTER TABLE `spaces`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `spaces`
--
ALTER TABLE `spaces`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;
COMMIT;
