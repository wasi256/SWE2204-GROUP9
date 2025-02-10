-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 09, 2024 at 08:10 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hotel_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `booking_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `hotel_id` int(11) DEFAULT NULL,
  `check_in_date` date DEFAULT NULL,
  `check_out_date` date DEFAULT NULL,
  `booking_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `status` enum('pending','confirmed','canceled') NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`booking_id`, `user_id`, `room_id`, `hotel_id`, `check_in_date`, `check_out_date`, `booking_date`, `status`) VALUES
(0, 14, 1, 1, '2024-11-07', '2024-11-09', '2024-11-05 23:17:32', 'pending'),
(1, 1, 1, NULL, '2024-10-24', '2024-10-26', '2024-10-23 16:22:55', 'pending'),
(2, 1, 4, NULL, '2024-10-26', '2024-10-29', '2024-10-23 16:25:52', 'pending'),
(3, 1, 3, NULL, '2024-10-26', '2024-10-27', '2024-10-24 05:27:54', 'pending'),
(4, 6, 4, NULL, '2024-10-28', '2024-10-31', '2024-10-27 17:55:18', 'pending'),
(5, 6, 3, NULL, '2024-10-29', '2024-10-31', '2024-10-27 18:35:10', 'pending'),
(6, 6, 2, NULL, '2024-10-30', '2024-10-31', '2024-10-27 18:39:38', 'pending'),
(7, 6, 3, NULL, NULL, NULL, '2024-10-27 18:52:36', 'pending'),
(8, 6, 1, NULL, NULL, NULL, '2024-10-27 18:56:32', 'pending'),
(9, 6, 1, NULL, NULL, NULL, '2024-10-27 18:56:58', 'pending'),
(10, 6, 6, NULL, NULL, NULL, '2024-10-27 19:06:04', 'pending'),
(11, 6, 1, NULL, '2024-10-28', '2024-10-31', '2024-10-27 19:07:23', 'pending'),
(12, 6, 6, NULL, '2024-10-28', '2024-10-31', '2024-10-27 19:22:35', 'pending'),
(13, 6, 4, NULL, NULL, NULL, '2024-10-27 19:23:08', 'pending'),
(14, 6, 3, NULL, '2024-10-30', '2024-10-31', '2024-10-27 19:23:46', 'pending'),
(15, 7, 4, NULL, NULL, NULL, '2024-10-27 19:45:00', 'pending'),
(16, 7, 6, NULL, '2024-10-29', '2024-10-31', '2024-10-27 19:48:54', 'pending'),
(17, 6, 1, NULL, '2024-10-18', '2024-10-31', '2024-10-30 02:18:06', 'pending'),
(18, 6, 4, NULL, '2024-10-30', '2024-11-02', '2024-10-30 02:24:35', 'pending'),
(19, 6, 1, NULL, '2024-10-31', '2024-11-02', '2024-10-30 02:32:49', 'pending'),
(20, 6, 3, NULL, '2024-10-31', '2024-11-05', '2024-10-30 02:45:24', 'pending'),
(21, 6, 3, NULL, '2024-10-31', '2024-11-02', '2024-10-30 02:49:02', 'pending'),
(22, 6, 2, NULL, '2024-10-31', '2024-11-03', '2024-10-30 02:49:35', 'pending'),
(23, 6, 1, NULL, '2024-11-01', '2024-11-03', '2024-10-30 02:58:30', 'pending'),
(24, 6, 3, NULL, '2024-10-31', '2024-11-02', '2024-10-30 03:23:28', 'pending'),
(25, 6, 1, NULL, '2024-11-13', '2024-11-15', '2024-11-01 13:15:44', 'pending'),
(26, 10, 4, NULL, '2024-11-04', '2024-11-07', '2024-11-03 11:34:16', 'pending'),
(27, 11, 4, NULL, '2024-11-12', '2024-11-14', '2024-11-03 13:02:21', 'pending'),
(28, 11, 1, NULL, '2024-11-07', '2024-11-08', '2024-11-03 13:29:22', 'pending'),
(29, 13, 3, NULL, '2024-11-05', '2024-11-08', '2024-11-04 14:13:05', 'pending'),
(30, 14, 1, NULL, '2024-11-10', '2024-11-22', '2024-11-05 10:05:43', 'pending'),
(31, 14, 4, NULL, '2024-11-07', '2024-11-08', '2024-11-05 14:48:48', 'pending'),
(32, 14, 4, NULL, '2024-11-07', '2024-11-09', '2024-11-05 15:49:39', 'pending'),
(33, 14, 4, 1, '2024-11-05', '2024-11-07', '2024-11-05 16:21:49', 'pending'),
(34, 14, 3, 2, '2024-11-06', '2024-11-08', '2024-11-05 16:22:11', 'pending'),
(35, 14, 1, 1, '2024-11-05', '2024-11-08', '2024-11-05 16:37:17', 'pending'),
(36, 14, 2, 1, '2024-11-06', '2024-11-09', '2024-11-05 16:37:44', 'pending'),
(37, 14, 3, NULL, '2024-11-06', '2024-11-09', '2024-11-05 16:38:29', 'pending'),
(38, 14, 3, 2, '2024-11-06', '2024-11-15', '2024-11-05 16:40:10', 'pending'),
(39, 14, 1, NULL, '2024-11-06', '2024-11-08', '2024-11-05 17:18:02', 'pending'),
(42, 14, 1, 1, '2024-11-07', '2024-11-09', '2024-11-05 23:21:56', 'pending'),
(43, 14, 1, 1, '2024-11-07', '2024-11-09', '2024-11-05 23:27:45', 'confirmed'),
(44, 14, 1, 1, '2024-11-07', '2024-11-09', '2024-11-05 23:42:16', 'confirmed'),
(45, 14, 1, 1, '2024-11-07', '2024-11-09', '2024-11-05 23:49:56', 'pending'),
(46, 14, 1, 1, '2024-11-07', '2024-11-10', '2024-11-06 00:14:37', 'pending'),
(47, 14, 3, 1, '2024-11-07', '2024-11-09', '2024-11-06 00:20:30', 'confirmed'),
(48, 14, 1, 1, '2024-11-07', '2024-11-10', '2024-11-06 00:24:43', 'confirmed'),
(49, 14, 3, 1, '2024-11-07', '2024-11-10', '2024-11-06 00:27:52', 'confirmed'),
(50, 14, 1, 1, '2024-11-08', '2024-11-14', '2024-11-06 00:29:58', 'pending'),
(51, 14, 1, 1, '2024-11-08', '2024-11-10', '2024-11-06 00:30:29', 'pending'),
(52, 14, 1, 1, '2024-11-08', '2024-11-10', '2024-11-06 00:34:26', 'pending'),
(53, 14, 1, 1, '2024-11-08', '2024-11-10', '2024-11-06 00:36:02', 'pending'),
(54, 14, 6, 1, '2024-11-07', '2024-11-08', '2024-11-06 00:52:06', 'confirmed'),
(55, 14, 14, 1, '2024-11-07', '2024-11-10', '2024-11-06 07:10:00', 'confirmed'),
(56, 14, 5, 1, '2024-11-07', '2024-11-10', '2024-11-06 09:39:21', 'confirmed'),
(57, 14, 1, 1, '2024-11-06', '2024-11-09', '2024-11-06 14:19:30', 'confirmed'),
(58, 14, 1, 1, '2024-11-06', '2024-11-09', '2024-11-06 14:22:05', 'confirmed'),
(59, 14, 3, 1, '2024-11-08', '2024-11-15', '2024-11-06 17:08:45', 'confirmed'),
(60, 14, 3, 1, '2024-11-08', '2024-11-15', '2024-11-06 17:09:28', 'confirmed'),
(61, 14, 1, 1, '2024-11-08', '2024-11-09', '2024-11-06 17:18:50', 'confirmed'),
(62, 14, 1, 1, '2024-11-07', '2024-11-09', '2024-11-06 17:22:56', 'confirmed'),
(63, 14, 1, 1, '2024-11-07', '2024-11-09', '2024-11-06 17:25:11', 'confirmed'),
(64, 14, 1, 1, '2024-11-06', '2024-11-09', '2024-11-06 17:37:21', 'pending'),
(65, 14, 1, 1, '2024-11-06', '2024-11-09', '2024-11-06 17:45:00', 'pending'),
(66, 14, 14, 1, '2024-11-08', '2024-11-30', '2024-11-06 17:47:54', 'pending'),
(67, 21, 12, 2, '2024-11-08', '2024-11-10', '2024-11-07 22:19:32', 'confirmed'),
(68, 21, 12, 2, '2024-11-07', '2024-11-10', '2024-11-07 22:36:15', 'confirmed'),
(69, 21, 12, 2, '2024-11-08', '2024-11-10', '2024-11-07 22:42:59', 'confirmed'),
(70, 21, 16, 3, '2024-11-08', '2024-11-10', '2024-11-07 22:46:17', 'confirmed'),
(71, 22, 14, 2, '2024-11-08', '2024-11-10', '2024-11-07 22:56:30', 'confirmed'),
(72, 21, 6, 6, '2024-11-08', '2024-11-10', '2024-11-08 04:47:28', 'confirmed'),
(73, 21, 6, 6, '2024-11-08', '2024-11-10', '2024-11-08 04:48:05', 'pending'),
(74, 14, 9, 1, '2024-11-08', '2024-11-10', '2024-11-08 04:52:13', 'pending'),
(75, 14, 7, 1, '2024-11-08', '2024-11-10', '2024-11-08 14:35:17', 'confirmed'),
(76, 14, 6, 6, '2024-11-08', '2024-11-10', '2024-11-08 19:28:17', 'pending'),
(77, 14, 15, 3, '2024-11-08', '2024-11-10', '2024-11-08 19:38:57', 'confirmed'),
(78, 14, 15, 3, '2024-11-08', '2024-11-10', '2024-11-08 19:47:46', 'pending'),
(79, 14, 11, 2, '2024-11-09', '2024-11-10', '2024-11-08 21:02:02', 'pending'),
(80, 14, 8, 1, '2024-11-09', '2024-11-13', '2024-11-09 04:54:57', 'confirmed'),
(81, 14, 4, 1, '2024-11-09', '2024-11-16', '2024-11-09 11:20:21', 'confirmed'),
(82, 23, 7, 1, '2024-11-11', '2024-11-16', '2024-11-09 11:22:53', 'confirmed');

-- --------------------------------------------------------

--
-- Table structure for table `contacts`
--

CREATE TABLE `contacts` (
  `contact_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contacts`
--

INSERT INTO `contacts` (`contact_id`, `name`, `email`, `message`, `created_at`) VALUES
(1, 'joel', 'osbert@gmail.com', 'best hotels', '2024-10-30 10:10:47'),
(2, 'joel', 'osbert@gmail.com', 'hello', '2024-11-03 11:36:53'),
(3, 'ddddd', 'atuhejoel112@gmail.com', 'good', '2024-11-05 14:51:51');

-- --------------------------------------------------------

--
-- Table structure for table `hotels`
--

CREATE TABLE `hotels` (
  `hotel_id` int(11) NOT NULL,
  `hotel_name` varchar(255) NOT NULL,
  `location` varchar(255) NOT NULL,
  `rating` decimal(2,1) DEFAULT NULL,
  `amenities` text DEFAULT NULL,
  `contact_info` varchar(255) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `hotels`
--

INSERT INTO `hotels` (`hotel_id`, `hotel_name`, `location`, `rating`, `amenities`, `contact_info`, `created_at`) VALUES
(1, 'Speke Resort Munyonyo', 'Kampala, Uganda', 4.7, 'Lake View, Pool, Spa, Conference Facilities', 'info@spekeresort.com', '2024-10-30 09:38:27'),
(2, 'Sheraton Kampala Hotel', 'Kampala, Uganda', 4.5, 'Gym, Restaurant, Free WiFi, Pool', 'reservations@sheratonkampala.com', '2024-10-30 09:38:27'),
(3, 'Munyonyo Commonwealth Resort', 'Kampala, Uganda', 4.6, 'Private Beach, Spa, Tennis Courts', 'info@munyonyoresort.com', '2024-10-30 09:38:27'),
(4, 'Acacia Lodge', 'Kampala, Uganda', 4.4, 'Garden, Restaurant, Free Breakfast', 'info@acacialodge.com', '2024-10-30 09:38:27'),
(5, 'Lake View Hotel', 'Mbarara, Uganda', 4.2, 'Lake Access, Restaurant, Conference Rooms', 'contact@lakeviewmbarara.com', '2024-10-30 09:38:27'),
(6, 'Agip Motel Mbarara', 'Mbarara, Uganda', 4.1, 'Free WiFi, Restaurant, Conference Facilities', 'info@agipmbarara.com', '2024-10-30 09:38:27');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `payment_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `booking_id` int(11) NOT NULL,
  `amount` decimal(10,2) NOT NULL,
  `payment_method` varchar(50) NOT NULL,
  `status` enum('pending','completed','failed') NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`payment_id`, `user_id`, `booking_id`, `amount`, `payment_method`, `status`, `created_at`, `updated_at`) VALUES
(1, 6, 67219, 100.00, 'Credit Card', 'pending', '2024-10-30 02:33:24', '2024-10-30 02:33:24'),
(2, 6, 67219, 100.00, 'Credit Card', 'pending', '2024-10-30 02:50:11', '2024-10-30 02:50:11'),
(3, 6, 6721, 100.00, 'Credit Card', 'pending', '2024-10-30 02:59:09', '2024-10-30 02:59:09'),
(4, 6, 6724, 100.00, 'Credit Card', 'pending', '2024-11-01 13:16:47', '2024-11-01 13:16:47'),
(5, 10, 67275, 100.00, 'Credit Card', 'pending', '2024-11-03 11:34:45', '2024-11-03 11:34:45'),
(6, 11, 6727747, 100.00, 'Credit Card', 'pending', '2024-11-03 13:02:53', '2024-11-03 13:02:53'),
(7, 13, 6728, 100.00, 'Credit Card', 'pending', '2024-11-04 14:13:30', '2024-11-04 14:13:30'),
(8, 14, 6729, 100.00, 'Credit Card', 'pending', '2024-11-05 10:06:42', '2024-11-05 10:06:42'),
(9, 14, 672, 100.00, 'Credit Card', 'pending', '2024-11-05 14:51:20', '2024-11-05 14:51:20'),
(10, 14, 672, 100.00, 'Credit Card', 'pending', '2024-11-05 15:50:05', '2024-11-05 15:50:05'),
(11, 14, 672, 100.00, 'Credit Card', 'pending', '2024-11-05 16:22:47', '2024-11-05 16:22:47'),
(12, 14, 41, 100.00, '', 'pending', '2024-11-05 23:18:13', '2024-11-05 23:18:13'),
(13, 14, 41, 100.00, '', 'pending', '2024-11-05 23:20:12', '2024-11-05 23:20:12'),
(14, 14, 41, 100.00, '', 'pending', '2024-11-05 23:21:42', '2024-11-05 23:21:42'),
(15, 14, 42, 100.00, '', 'pending', '2024-11-05 23:22:27', '2024-11-05 23:22:27'),
(16, 14, 43, 100.00, '', 'pending', '2024-11-05 23:28:10', '2024-11-05 23:28:10'),
(17, 14, 43, 100.00, '6547 6474 6363 8888', 'pending', '2024-11-05 23:33:37', '2024-11-05 23:33:37'),
(18, 14, 43, 100.00, '6547 6474 6363 8888', 'pending', '2024-11-05 23:39:44', '2024-11-05 23:39:44'),
(19, 14, 43, 100.00, '6547 6474 6363 8888', 'pending', '2024-11-05 23:39:55', '2024-11-05 23:39:55'),
(20, 14, 43, 100.00, '6547 6474 6363 8888', 'pending', '2024-11-05 23:41:55', '2024-11-05 23:41:55'),
(21, 14, 44, 100.00, '5434 7777 9995 6565', 'pending', '2024-11-05 23:43:04', '2024-11-05 23:43:04'),
(22, 14, 47, 100.00, '2222 3333 4444 5555', 'pending', '2024-11-06 00:20:56', '2024-11-06 00:20:56'),
(23, 14, 48, 100.00, '5434 7777 9995 6565', 'pending', '2024-11-06 00:24:58', '2024-11-06 00:24:58'),
(24, 14, 49, 100.00, '1111 4444 3333 6666', 'pending', '2024-11-06 00:28:20', '2024-11-06 00:28:20'),
(25, 14, 54, 100.00, '4444 2222 5555 5555', 'pending', '2024-11-06 00:54:27', '2024-11-06 00:54:27'),
(26, 14, 55, 100.00, '2222 3332 4444 5555', 'pending', '2024-11-06 07:10:36', '2024-11-06 07:10:36'),
(27, 14, 56, 100.00, '1111 4444 5555 3333', 'pending', '2024-11-06 09:39:46', '2024-11-06 09:39:46'),
(28, 14, 57, 100.00, '2345 4321 3456 7654', 'pending', '2024-11-06 14:19:52', '2024-11-06 14:19:52'),
(29, 14, 58, 100.00, '1111 2222 4444 6666', 'pending', '2024-11-06 14:22:24', '2024-11-06 14:22:24'),
(30, 14, 59, 100.00, '1234567', 'pending', '2024-11-06 17:09:19', '2024-11-06 17:09:19'),
(31, 14, 60, 100.00, '3456', 'pending', '2024-11-06 17:10:22', '2024-11-06 17:10:22'),
(32, 14, 61, 100.00, '5678', 'pending', '2024-11-06 17:19:06', '2024-11-06 17:19:06'),
(33, 14, 62, 100.00, '2232424', 'pending', '2024-11-06 17:23:10', '2024-11-06 17:23:10'),
(34, 14, 63, 100.00, '1234', 'pending', '2024-11-06 17:25:35', '2024-11-06 17:25:35'),
(35, 14, 65, 100.00, '3456', 'pending', '2024-11-06 17:45:19', '2024-11-06 17:45:19'),
(36, 14, 65, 100.00, '345', 'pending', '2024-11-06 17:47:02', '2024-11-06 17:47:02'),
(37, 14, 66, 100.00, '5666', 'pending', '2024-11-06 17:48:13', '2024-11-06 17:48:13'),
(38, 14, 66, 100.00, '5666', 'pending', '2024-11-06 17:57:06', '2024-11-06 17:57:06'),
(39, 14, 66, 100.00, '5666', 'pending', '2024-11-06 17:57:45', '2024-11-06 17:57:45'),
(40, 14, 66, 100.00, '5666', 'pending', '2024-11-06 17:57:51', '2024-11-06 17:57:51'),
(41, 14, 66, 100.00, '5666', 'pending', '2024-11-06 17:57:58', '2024-11-06 17:57:58'),
(42, 14, 66, 100.00, '5666', 'pending', '2024-11-06 17:58:33', '2024-11-06 17:58:33'),
(43, 21, 67, 300.00, 'Credit Card', 'completed', '2024-11-07 22:27:30', '2024-11-07 22:27:30'),
(44, 21, 68, 450.00, 'Credit Card', 'completed', '2024-11-07 22:36:34', '2024-11-07 22:36:34'),
(45, 21, 69, 300.00, 'Credit Card', 'completed', '2024-11-07 22:43:23', '2024-11-07 22:43:23'),
(46, 21, 70, 340.00, 'Credit Card', 'completed', '2024-11-07 22:46:29', '2024-11-07 22:46:29'),
(47, 22, 71, 1400.00, 'Credit Card', 'completed', '2024-11-07 22:56:44', '2024-11-07 22:56:44'),
(48, 21, 72, 600.00, 'Credit Card', 'completed', '2024-11-08 04:47:55', '2024-11-08 04:47:55'),
(49, 14, 75, 400.00, 'Credit Card', 'completed', '2024-11-08 14:35:33', '2024-11-08 14:35:33'),
(50, 14, 77, 200.00, 'Credit Card', 'completed', '2024-11-08 19:39:30', '2024-11-08 19:39:30'),
(51, 14, 80, 1400.00, 'Credit Card', 'completed', '2024-11-09 04:55:42', '2024-11-09 04:55:42'),
(52, 14, 80, 1400.00, 'Credit Card', 'completed', '2024-11-09 05:02:50', '2024-11-09 05:02:50'),
(53, 14, 80, 1400.00, 'Credit Card', 'completed', '2024-11-09 05:09:15', '2024-11-09 05:09:15'),
(54, 14, 80, 1400.00, 'Credit Card', 'completed', '2024-11-09 05:11:14', '2024-11-09 05:11:14'),
(55, 14, 80, 1400.00, 'Credit Card', 'completed', '2024-11-09 05:12:00', '2024-11-09 05:12:00'),
(56, 14, 81, 1400.00, 'Credit Card', 'completed', '2024-11-09 11:20:47', '2024-11-09 11:20:47'),
(57, 14, 81, 1400.00, 'Credit Card', 'completed', '2024-11-09 11:21:10', '2024-11-09 11:21:10'),
(58, 23, 82, 1000.00, 'Credit Card', 'completed', '2024-11-09 11:23:15', '2024-11-09 11:23:15');

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

CREATE TABLE `reviews` (
  `review_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `room_id` int(11) DEFAULT NULL,
  `rating` int(11) DEFAULT NULL CHECK (`rating` >= 1 and `rating` <= 5),
  `comment` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reviews`
--

INSERT INTO `reviews` (`review_id`, `user_id`, `room_id`, `rating`, `comment`, `created_at`) VALUES
(1, 1, 16, 4, 'Excellent stay, the room was clean and well-maintained!', '2024-11-07 17:23:11'),
(2, 9, 26, 4, 'Good room, but a bit noisy at night.', '2024-11-05 17:23:11'),
(3, 19, 17, 4, 'Average experience, could use some improvements.', '2024-11-04 17:24:48');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `room_id` int(11) NOT NULL,
  `room_number` varchar(10) NOT NULL,
  `room_type` varchar(50) DEFAULT NULL,
  `price` decimal(10,2) DEFAULT NULL,
  `availability` tinyint(1) DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `hotel_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`room_id`, `room_number`, `room_type`, `price`, `availability`, `created_at`, `hotel_id`) VALUES
(1, '101', 'Single', 100.00, 1, '2024-10-23 16:22:17', 3),
(2, '102', 'Double', 150.00, 1, '2024-10-23 16:22:17', 5),
(3, '103', 'Suite', 250.00, 1, '2024-10-23 16:22:17', 2),
(4, '104', 'Deluxe', 200.00, 1, '2024-10-23 16:22:17', 1),
(5, '105', 'Standard', 120.00, 0, '2024-10-23 16:22:17', 4),
(6, '106', 'Family', 300.00, 1, '2024-10-23 16:22:17', 6),
(7, '104', 'Deluxe', 200.00, 1, '2024-11-06 06:59:21', 1),
(8, '107', 'Executive', 350.00, 1, '2024-11-06 06:59:21', 1),
(9, '108', 'Suite', 500.00, 1, '2024-11-06 06:59:21', 1),
(10, '109', 'Family Suite', 600.00, 1, '2024-11-06 06:59:21', 1),
(11, '103', 'Suite', 250.00, 1, '2024-11-06 06:59:21', 2),
(12, '110', 'Double', 150.00, 1, '2024-11-06 06:59:21', 2),
(13, '111', 'Deluxe', 200.00, 1, '2024-11-06 06:59:21', 2),
(14, '112', 'Presidential', 700.00, 1, '2024-11-06 06:59:21', 2),
(15, '101', 'Single', 100.00, 1, '2024-11-06 06:59:21', 3),
(16, '102', 'Double', 170.00, 1, '2024-11-06 06:59:21', 3),
(17, '103', 'Family', 300.00, 1, '2024-11-06 06:59:21', 3),
(18, '104', 'Honeymoon Suite', 500.00, 1, '2024-11-06 06:59:21', 3),
(19, '105', 'Standard', 120.00, 0, '2024-11-06 06:59:21', 4),
(20, '106', 'Deluxe', 190.00, 1, '2024-11-06 06:59:21', 4),
(21, '107', 'Suite', 250.00, 1, '2024-11-06 06:59:21', 4),
(22, '102', 'Double', 150.00, 1, '2024-11-06 06:59:21', 5),
(23, '103', 'Executive', 250.00, 1, '2024-11-06 06:59:21', 5),
(24, '104', 'Deluxe', 300.00, 1, '2024-11-06 06:59:21', 5),
(25, '105', 'Suite', 400.00, 1, '2024-11-06 06:59:21', 5),
(26, '106', 'Family', 300.00, 1, '2024-11-06 06:59:21', 6),
(27, '107', 'Double', 150.00, 1, '2024-11-06 06:59:21', 6),
(28, '108', 'Suite', 250.00, 1, '2024-11-06 06:59:21', 6);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `role` enum('user','admin') DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `password`, `email`, `created_at`, `role`) VALUES
(1, 'joel', '$2y$10$1.MBKMDrGo/DgklMOMCXg.qN1AGPSDCndMH.2NxgHCm3Twm3m9D1G', 'atuhejoel112@gmail.com', '2024-10-23 16:13:32', 'user'),
(2, 'jane', 'qwerty', 'jane@gmail.com', '2024-11-04 18:09:49', 'admin'),
(3, 'Shian', '12345678', 'shian@gmail.com', '2024-11-07 18:09:49', 'admin'),
(5, 'osb', '$2y$10$BHGMLfs79/7ySfJC150sAufb8putCJgyjv8urZ59e2XkJSLyH9nGW', 'osbert@gmail.com', '2024-10-24 05:14:03', 'user'),
(6, 'Peter', '$2y$10$wAK4mqSBcQExP/5HSGTl1eHaDXZhvYaQKTEicvCGnxpOTjK1RVbOu', 'peter112@gmail.com', '2024-10-27 17:54:21', 'user'),
(7, 'simon', '$2y$10$RJW8IMaYY7G6Yzpotl97FulfXUIuMBUi36WD133XDkGWnd52d.3GS', 'simon@gmail.com', '2024-10-27 19:44:26', 'user'),
(8, 'Shallon', '$2y$10$o9pQa6GaFWDYex3b2vbdQukegF33Woq9/XPTzqyZl86zwQWM/GEyW', 'shallon11@gmail.com', '2024-10-30 11:36:35', 'user'),
(9, 'sheila', '$2y$10$F6SL6eQXBNwAbsEeXzAnmOF3LPKiTrF7YqnxiwSpY746FJWluOBze', 'shila@gmail.com', '2024-11-01 13:12:32', 'user'),
(10, 'Martha', '$2y$10$G7sXkitJ/NCRFlIOlDI8Be2T2LnPAgElQLnAm5XLXR/WZwQpw8PtO', 'martha3@gmail.com', '2024-11-03 11:33:21', 'user'),
(11, 'davis', '$2y$10$csm8F5FWQ64zDdTLmZsAt.BGVM90gwrD3UUpPQWxJHhKQ5nIL/dJG', 'davis@gmail.com', '2024-11-03 13:01:13', 'user'),
(12, 'davise', '$2y$10$joZnoPV1ADXniYBfItAK2eVSrOSptFI/vFHjvd9hLTEexJqsKSOge', 'davis@gmail.com', '2024-11-04 13:32:45', 'user'),
(13, 'john', '$2y$10$Fl0oftsiijdrQhHD9xTD6uHK8QzJO8H6EUqRy7qLh.heEELpnhDua', 'john@gmail.com', '2024-11-04 13:49:53', 'user'),
(14, 'feza', '$2y$10$Iz5KliFuEeKktqcMa7xqZOei34hD8vtDUcVN890TdlH458Qbvzfba', 'feza@gmail.com', '2024-11-05 09:33:08', 'user'),
(18, 'johnson', '$2y$10$PV87ytGRqcCE8TYwUx4rU.ptzPnFEOIhCmsFeDOyZXQTT.j.H//h.', 'johnson@gmail.com', '2024-11-07 19:17:20', 'user'),
(19, 'derrick', '$2y$10$GkJroHAIGFKhQC8aoSw4h.a0RX7TkvZX8ybbRwfqHmreaYCZ7hOP2', 'derrick@gmail.com', '2024-11-07 20:45:11', 'user'),
(20, 'ron', '$2y$10$r3sabdVaj/zj1MY2SGXhX.mBhJXICr6caIypCye2FE97.oYWMDPGm', 'ron@gmail.com', '2024-11-07 20:52:10', 'user'),
(21, 'she', '$2y$10$LuIv1rHZA0LkfWWnYWUehO4ohJ8O4M14aQ3H/41qVfEEbuPlOAFSG', 'she@gmail.com', '2024-11-07 20:58:49', 'user'),
(22, 'jo', '$2y$10$FqW8KIXp6oAAQuYwGpH48Ofj5wEK0YwdwUFO34n4yyicdIs5rjGB.', 'joel11@gmail.com', '2024-11-07 22:55:25', 'user'),
(23, 'mmeee', '$2y$10$YrLTH5NdwfZgvikRcf0tRuweTzsZHE/cebnT2FBzxWQuhjZShlQ6q', 'atuhejoel112@gmail.com', '2024-11-09 11:22:16', 'user'),
(24, 'denis', '$2y$10$jj7uXdJmcQpzA/ypev9bNeo3PqvoeZTkGQgavwX1XF7PRjPUXfyee', 'denis@gmail.com', '2024-11-09 18:21:53', 'admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`booking_id`),
  ADD KEY `fk_bookings_user_id` (`user_id`),
  ADD KEY `fk_bookings_room_id` (`room_id`),
  ADD KEY `fk_bookings_hotel_id` (`hotel_id`);

--
-- Indexes for table `contacts`
--
ALTER TABLE `contacts`
  ADD PRIMARY KEY (`contact_id`);

--
-- Indexes for table `hotels`
--
ALTER TABLE `hotels`
  ADD PRIMARY KEY (`hotel_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`payment_id`);

--
-- Indexes for table `reviews`
--
ALTER TABLE `reviews`
  ADD PRIMARY KEY (`review_id`),
  ADD KEY `fk_reviews_user_id` (`user_id`),
  ADD KEY `fk_reviews_room_id` (`room_id`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `fk_rooms_hotel_id` (`hotel_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=83;

--
-- AUTO_INCREMENT for table `contacts`
--
ALTER TABLE `contacts`
  MODIFY `contact_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `hotels`
--
ALTER TABLE `hotels`
  MODIFY `hotel_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `payment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

--
-- AUTO_INCREMENT for table `reviews`
--
ALTER TABLE `reviews`
  MODIFY `review_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `fk_bookings_hotel_id` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`),
  ADD CONSTRAINT `fk_bookings_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `fk_bookings_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `reviews`
--
ALTER TABLE `reviews`
  ADD CONSTRAINT `fk_reviews_room_id` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`),
  ADD CONSTRAINT `fk_reviews_user_id` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reviews_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `reviews_ibfk_2` FOREIGN KEY (`room_id`) REFERENCES `rooms` (`room_id`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `fk_rooms_hotel_id` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`),
  ADD CONSTRAINT `rooms_ibfk_1` FOREIGN KEY (`hotel_id`) REFERENCES `hotels` (`hotel_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
