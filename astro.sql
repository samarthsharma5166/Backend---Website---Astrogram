-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 19, 2026 at 12:39 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `astro`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `name` varchar(50) DEFAULT NULL,
  `phone` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `phone`, `email`, `password`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Admin', '1234567890', 'admin@gmail.com', '$2y$12$5dr/6Eb4zEf1KGemMmuouOugVYIZvDlvvdCXfNHsRQNRRtYe1mIKa', 0, '2025-11-20 08:49:40', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `astrologer`
--

CREATE TABLE `astrologer` (
  `uid` int(11) NOT NULL,
  `id` varchar(100) DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `description` varchar(250) DEFAULT NULL,
  `language` varchar(100) DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `img` varchar(250) DEFAULT NULL,
  `gender` varchar(20) DEFAULT NULL,
  `exp` int(11) DEFAULT NULL,
  `cost_per_minute` float DEFAULT NULL,
  `start_from` float NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `astrologer`
--

INSERT INTO `astrologer` (`uid`, `id`, `name`, `description`, `language`, `type`, `status`, `img`, `gender`, `exp`, `cost_per_minute`, `start_from`, `created_at`, `updated_at`) VALUES
(5, '1241764757344494', 'Raghunath Vyas', 'Raghunath Vyas is a seasoned Vedic astrologer, helping individuals navigate life with insights from ancient scriptures. His expertise lies in birth chart analysis, planetary positions, and personalized guidance to align life with cosmic energies.', 'Hindi', 'Vedic Astrology', 0, '1764757344463.jpg', 'Male', 4, 11, 1010, '2025-12-03 04:52:24', '2026-01-10 01:43:40'),
(6, '9681764757371476', 'Nikhil Agarwal', 'Nikhil Agarwal uses numerology to decode your life path, personality traits, and future opportunities. He combines numbers with spiritual wisdom to provide actionable guidance for career, relationships, and personal growth.', 'Hindi', 'Numerology', 0, '1764757371382.jpg', 'Male', 5, 20, 871, '2025-12-03 04:52:51', '2026-01-10 01:43:51'),
(7, '6981764757420394', 'Jyoti Kumari Sharma', 'Jyoti Kumari Sharma offers precise Vedic astrology predictions, helping clients understand their destiny and overcome obstacles. His readings focus on career, health, and relationship insights.', 'Hindi', 'Vedic Astrology', 0, '1764757420401.jpg', 'Male', 6, 12, 655, '2025-12-03 04:53:40', '2026-01-10 01:44:05'),
(8, '7471764757448853', 'Anant Kashyap', 'Anant Kashyap interprets the hidden power of numbers to reveal life patterns and potential. He guides clients in making informed decisions based on numerological insights.', 'Hindi', 'Vedic Astrology', 0, '1764757448304.jpg', 'Male', 8, 22, 876, '2025-12-03 04:54:08', '2026-01-10 01:44:14'),
(9, '5741764757481748', 'Viveka Chaturvedi', 'Viveka Chaturvedi specializes in Vedic astrology with detailed birth chart analysis, helping people find balance, prosperity, and success in life.', 'Hindi', 'Numerology', 0, '1764757481573.jpg', 'Female', 7, 15, 244, '2025-12-03 04:54:41', '2026-01-10 01:44:21'),
(10, '8441764757638178', 'Parthiv Joshi', 'Parthiv Joshi uses Vedic astrology to offer life-transforming advice on personal and professional challenges. His predictions are rooted in deep astrological knowledge.', 'Hindi', 'Vedic Astrology', 0, '1764757638640.jpg', 'Female', 6, 22, 666, '2025-12-03 04:57:18', '2026-01-10 01:44:30'),
(11, '2951764757666986', 'Aditya Tripathi', 'Aditya Tripathi helps individuals understand their life journey through numerology, offering solutions to maximize success, harmony, and happiness.', 'Hindi', 'Numerology', 0, '1764757666448.jpg', 'Male', 6, 22, 543, '2025-12-03 04:57:46', '2026-01-10 01:44:41'),
(12, '8771764757948480', 'Rishika Vedant', 'Rishika Vedant combines numerology with spiritual insights to reveal hidden strengths, guide life decisions, and unlock potential for personal and professional growth.', 'Hindi', 'Numerology', 0, '1764757948532.jpg', 'Female', 5, 22, 871, '2025-12-03 05:02:28', '2025-12-03 07:03:27'),
(13, '5941764757983642', 'Harshvardhan Mehta', 'Harshvardhan Mehta provides detailed Vedic astrology readings to guide clients in health, career, and relationships, focusing on aligning life with planetary energies.', 'Hindi', 'Vedic Astrology', 0, '1764757983237.jpg', 'Male', 5, 20, 555, '2025-12-03 05:03:03', '2025-12-03 05:03:03'),
(14, '4521764758010691', 'Siddharth Bhardwaj', 'Siddharth Bhardwaj provides accurate numerology readings for career, relationships, and personal growth. His guidance empowers clients to harness the power of numbers for a better future.', 'Hindi', 'Numerology', 0, '1764758010454.jpg', 'Male', 5, 10, 666, '2025-12-03 05:03:30', '2025-12-03 05:03:30'),
(15, '6241764758571997', 'Rameshwar Dixit', 'Expert in Vedic astrology, Rameshwar Dixit provides guidance on life, career, and relationships using planetary analysis.', 'Hindi', 'Vedic Astrology', 0, '1764758571606.jpg', 'Male', 6, 15, 332, '2025-12-03 05:12:51', '2025-12-03 05:12:51'),
(16, '7471764758617585', 'Ashwin Chaturvedi', 'Ashwin Chaturvedi decodes life paths and personal potential using numerology, offering precise predictions for a balanced life.', 'Hindi', 'Numerology', 0, '1764758617247.jpg', 'Male', 7, 18, 871, '2025-12-03 05:13:37', '2025-12-03 05:13:37'),
(17, '1371764758659393', 'Vikram Singh', 'Vikram Singh specializes in Vedic astrology, helping clients align their decisions with cosmic energies for success and prosperity.', 'Hindi', 'Vedic Astrology', 0, '1764758659282.jpg', 'Male', 6, 5, 871, '2025-12-03 05:14:19', '2025-12-03 05:14:19'),
(18, '6571764758689257', 'Manish Sharma', NULL, 'Hindi', 'Numerology', 0, '1764758689535.jpg', 'Male', 6, 5, 543, '2025-12-03 05:14:49', '2025-12-03 05:14:49'),
(19, '1981764758731496', 'Prateek Joshi', 'Prateek Joshi provides personalized Vedic astrology readings to help clients overcome challenges and achieve life goals.', 'Hindi', NULL, 0, '1764758731432.jpg', 'Male', 3, 5, 888, '2025-12-03 05:15:31', '2025-12-03 05:15:31'),
(20, '6121764758774311', 'Meera Vyas', 'Meera Vyas combines numerology with spiritual insights to guide clients toward harmony, success, and personal transformation.', 'Hindi', 'Numerology', 0, '1764758774463.jpg', 'Female', 10, 23, 871, '2025-12-03 05:16:14', '2026-01-10 01:43:29'),
(21, '7011764758829423', 'Anjali Tripathi', 'Anjali Tripathi specializes in Vedic astrology, offering accurate predictions and practical solutions for career and life challenges.', 'Hindi', 'Vedic Astrology', 0, '1764758829247.jpg', 'Female', 10, 25, 456, '2025-12-03 05:17:09', '2026-01-10 01:43:25'),
(22, '8161764758859751', 'Divya Agarwal', 'Divya Agarwal interprets numbers to uncover life patterns and provide guidance for love, career, and personal development.', 'Hindi', 'Numerology', 0, '1764758859451.jpg', 'Female', 10, 25, 567, '2025-12-03 05:17:39', '2026-01-10 01:43:20'),
(23, '7951764758859779', 'Divya Agarwal', 'Divya Agarwal interprets numbers to uncover life patterns and provide guidance for love, career, and personal development.', 'Hindi', 'Numerology', 0, '1764758859661.jpg', 'Female', 8, 20, 678, '2025-12-03 05:17:39', '2026-01-10 01:43:14'),
(24, '4871764758918769', 'Sonal Bhardwaj', 'Sonal Bhardwaj helps clients understand their destiny through Vedic astrology, offering insights for health, relationships, and career.', 'Hindi', 'Numerology', 0, '1764758918239.jpg', 'Female', 4, 13, 654, '2025-12-03 05:18:38', '2026-01-10 01:43:09'),
(25, '9941764758966644', 'Munish Sharma', 'Expert in Vedic astrology, Rameshwar Dixit provides guidance on life, career, and relationships using planetary analysis.', 'Hindi', 'Vedic Astrology', 0, '1764758966660.jpg', 'Male', 5, 15, 543, '2025-12-03 05:19:26', '2026-01-10 01:37:33');

-- --------------------------------------------------------

--
-- Table structure for table `astro_cate`
--

CREATE TABLE `astro_cate` (
  `id` int(11) NOT NULL,
  `cate_id` varchar(100) DEFAULT NULL,
  `astro_id` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `astro_cate`
--

INSERT INTO `astro_cate` (`id`, `cate_id`, `astro_id`, `created_at`, `updated_at`) VALUES
(30, '7431763637826490', '4521764758010691', '2025-12-03 05:11:01', '2025-12-03 05:11:01'),
(31, '1321763637834857', '4521764758010691', '2025-12-03 05:11:01', '2025-12-03 05:11:01'),
(32, '6041763637836620', '4521764758010691', '2025-12-03 05:11:01', '2025-12-03 05:11:01'),
(33, '1801763637847133', '4521764758010691', '2025-12-03 05:11:01', '2025-12-03 05:11:01'),
(34, '7431763637826490', '5941764757983642', '2025-12-03 05:11:06', '2025-12-03 05:11:06'),
(35, '1321763637834857', '5941764757983642', '2025-12-03 05:11:06', '2025-12-03 05:11:06'),
(36, '6041763637836620', '5941764757983642', '2025-12-03 05:11:06', '2025-12-03 05:11:06'),
(37, '1801763637847133', '5941764757983642', '2025-12-03 05:11:06', '2025-12-03 05:11:06'),
(61, '6041763637836620', '6241764758571997', '2025-12-03 05:12:51', '2025-12-03 05:12:51'),
(62, '2041763637838502', '6241764758571997', '2025-12-03 05:12:51', '2025-12-03 05:12:51'),
(63, '4151763637840171', '6241764758571997', '2025-12-03 05:12:51', '2025-12-03 05:12:51'),
(64, '1801763637847133', '6241764758571997', '2025-12-03 05:12:51', '2025-12-03 05:12:51'),
(65, '6041763637836620', '7471764758617585', '2025-12-03 05:13:37', '2025-12-03 05:13:37'),
(66, '2041763637838502', '7471764758617585', '2025-12-03 05:13:37', '2025-12-03 05:13:37'),
(67, '8621763637846196', '7471764758617585', '2025-12-03 05:13:37', '2025-12-03 05:13:37'),
(68, '1801763637847133', '7471764758617585', '2025-12-03 05:13:37', '2025-12-03 05:13:37'),
(69, '6041763637836620', '1371764758659393', '2025-12-03 05:14:19', '2025-12-03 05:14:19'),
(70, '2041763637838502', '1371764758659393', '2025-12-03 05:14:19', '2025-12-03 05:14:19'),
(71, '4151763637840171', '1371764758659393', '2025-12-03 05:14:19', '2025-12-03 05:14:19'),
(72, '8621763637846196', '1371764758659393', '2025-12-03 05:14:19', '2025-12-03 05:14:19'),
(73, '1801763637847133', '1371764758659393', '2025-12-03 05:14:19', '2025-12-03 05:14:19'),
(74, '2041763637838502', '6571764758689257', '2025-12-03 05:14:49', '2025-12-03 05:14:49'),
(75, '4151763637840171', '6571764758689257', '2025-12-03 05:14:49', '2025-12-03 05:14:49'),
(76, '8621763637846196', '6571764758689257', '2025-12-03 05:14:49', '2025-12-03 05:14:49'),
(77, '1801763637847133', '6571764758689257', '2025-12-03 05:14:49', '2025-12-03 05:14:49'),
(78, '6041763637836620', '1981764758731496', '2025-12-03 05:15:31', '2025-12-03 05:15:31'),
(79, '2041763637838502', '1981764758731496', '2025-12-03 05:15:31', '2025-12-03 05:15:31'),
(80, '4151763637840171', '1981764758731496', '2025-12-03 05:15:31', '2025-12-03 05:15:31'),
(81, '8621763637846196', '1981764758731496', '2025-12-03 05:15:31', '2025-12-03 05:15:31'),
(82, '1801763637847133', '1981764758731496', '2025-12-03 05:15:31', '2025-12-03 05:15:31'),
(152, '7431763637826490', '8771764757948480', '2025-12-03 07:03:27', '2025-12-03 07:03:27'),
(153, '1321763637834857', '8771764757948480', '2025-12-03 07:03:27', '2025-12-03 07:03:27'),
(154, '1801763637847133', '8771764757948480', '2025-12-03 07:03:27', '2025-12-03 07:03:27'),
(163, '4151763637840171', '9941764758966644', '2026-01-10 01:37:33', '2026-01-10 01:37:33'),
(164, '6041763637836620', '9941764758966644', '2026-01-10 01:37:33', '2026-01-10 01:37:33'),
(165, '2041763637838502', '9941764758966644', '2026-01-10 01:37:33', '2026-01-10 01:37:33'),
(166, '8621763637846196', '9941764758966644', '2026-01-10 01:37:33', '2026-01-10 01:37:33'),
(167, '1801763637847133', '9941764758966644', '2026-01-10 01:37:33', '2026-01-10 01:37:33'),
(168, '4151763637840171', '4871764758918769', '2026-01-10 01:43:09', '2026-01-10 01:43:09'),
(169, '6041763637836620', '4871764758918769', '2026-01-10 01:43:09', '2026-01-10 01:43:09'),
(170, '2041763637838502', '4871764758918769', '2026-01-10 01:43:09', '2026-01-10 01:43:09'),
(171, '8621763637846196', '4871764758918769', '2026-01-10 01:43:09', '2026-01-10 01:43:09'),
(172, '4151763637840171', '7951764758859779', '2026-01-10 01:43:14', '2026-01-10 01:43:14'),
(173, '6041763637836620', '7951764758859779', '2026-01-10 01:43:14', '2026-01-10 01:43:14'),
(174, '2041763637838502', '7951764758859779', '2026-01-10 01:43:14', '2026-01-10 01:43:14'),
(175, '4151763637840171', '8161764758859751', '2026-01-10 01:43:20', '2026-01-10 01:43:20'),
(176, '6041763637836620', '8161764758859751', '2026-01-10 01:43:20', '2026-01-10 01:43:20'),
(177, '2041763637838502', '8161764758859751', '2026-01-10 01:43:20', '2026-01-10 01:43:20'),
(178, '4151763637840171', '7011764758829423', '2026-01-10 01:43:25', '2026-01-10 01:43:25'),
(179, '6041763637836620', '7011764758829423', '2026-01-10 01:43:25', '2026-01-10 01:43:25'),
(180, '2041763637838502', '7011764758829423', '2026-01-10 01:43:25', '2026-01-10 01:43:25'),
(181, '7431763637826490', '6121764758774311', '2026-01-10 01:43:29', '2026-01-10 01:43:29'),
(182, '4151763637840171', '6121764758774311', '2026-01-10 01:43:29', '2026-01-10 01:43:29'),
(183, '6041763637836620', '6121764758774311', '2026-01-10 01:43:29', '2026-01-10 01:43:29'),
(184, '2041763637838502', '6121764758774311', '2026-01-10 01:43:29', '2026-01-10 01:43:29'),
(185, '8621763637846196', '6121764758774311', '2026-01-10 01:43:29', '2026-01-10 01:43:29'),
(186, '1801763637847133', '6121764758774311', '2026-01-10 01:43:29', '2026-01-10 01:43:29'),
(187, '7431763637826490', '1241764757344494', '2026-01-10 01:43:40', '2026-01-10 01:43:40'),
(188, '1321763637834857', '1241764757344494', '2026-01-10 01:43:40', '2026-01-10 01:43:40'),
(189, '1801763637847133', '1241764757344494', '2026-01-10 01:43:40', '2026-01-10 01:43:40'),
(190, '7431763637826490', '9681764757371476', '2026-01-10 01:43:51', '2026-01-10 01:43:51'),
(191, '1321763637834857', '9681764757371476', '2026-01-10 01:43:51', '2026-01-10 01:43:51'),
(192, '1801763637847133', '9681764757371476', '2026-01-10 01:43:51', '2026-01-10 01:43:51'),
(193, '7431763637826490', '6981764757420394', '2026-01-10 01:44:05', '2026-01-10 01:44:05'),
(194, '1321763637834857', '6981764757420394', '2026-01-10 01:44:05', '2026-01-10 01:44:05'),
(195, '1801763637847133', '6981764757420394', '2026-01-10 01:44:05', '2026-01-10 01:44:05'),
(196, '7431763637826490', '7471764757448853', '2026-01-10 01:44:14', '2026-01-10 01:44:14'),
(197, '1321763637834857', '7471764757448853', '2026-01-10 01:44:14', '2026-01-10 01:44:14'),
(198, '1801763637847133', '7471764757448853', '2026-01-10 01:44:14', '2026-01-10 01:44:14'),
(199, '7431763637826490', '5741764757481748', '2026-01-10 01:44:21', '2026-01-10 01:44:21'),
(200, '1321763637834857', '5741764757481748', '2026-01-10 01:44:21', '2026-01-10 01:44:21'),
(201, '1801763637847133', '5741764757481748', '2026-01-10 01:44:21', '2026-01-10 01:44:21'),
(202, '7431763637826490', '8441764757638178', '2026-01-10 01:44:30', '2026-01-10 01:44:30'),
(203, '4151763637840171', '8441764757638178', '2026-01-10 01:44:30', '2026-01-10 01:44:30'),
(204, '1321763637834857', '8441764757638178', '2026-01-10 01:44:30', '2026-01-10 01:44:30'),
(205, '1801763637847133', '8441764757638178', '2026-01-10 01:44:30', '2026-01-10 01:44:30'),
(206, '7431763637826490', '2951764757666986', '2026-01-10 01:44:41', '2026-01-10 01:44:41'),
(207, '1321763637834857', '2951764757666986', '2026-01-10 01:44:41', '2026-01-10 01:44:41'),
(208, '8621763637846196', '2951764757666986', '2026-01-10 01:44:41', '2026-01-10 01:44:41'),
(209, '1801763637847133', '2951764757666986', '2026-01-10 01:44:41', '2026-01-10 01:44:41');

-- --------------------------------------------------------

--
-- Table structure for table `category`
--

CREATE TABLE `category` (
  `uid` int(11) NOT NULL,
  `id` varchar(100) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `img` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `sort_no` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `category`
--

INSERT INTO `category` (`uid`, `id`, `name`, `img`, `status`, `sort_no`, `created_at`, `updated_at`) VALUES
(1, '7431763637826490', 'Love', '1764760978327.jpg', 0, 1, '2025-11-20 04:58:23', '2025-12-03 05:52:58'),
(2, '2041763637838502', 'Marriage', '1764761124430.jpg', 0, 2, '2025-11-20 05:00:58', '2025-12-03 05:55:24'),
(3, '4151763637840171', 'Career', '1764761217219.jpg', 0, 1, '2025-11-20 05:01:18', '2025-12-03 06:04:00'),
(4, '1321763637834857', 'Life Coach', '1764761043526.jpg', 0, 1, '2025-11-20 05:01:37', '2025-12-03 05:54:03'),
(5, '8621763637846196', 'Wealth', '1764761349619.jpg', 0, 5, '2025-11-20 05:02:02', '2025-12-03 05:59:09'),
(6, '6041763637836620', 'Health', '1764761088520.jpg', 0, 1, '2025-11-20 05:02:25', '2025-12-03 05:54:48'),
(7, '1801763637847133', 'General', '1764761395440.jpg', 0, 7, '2025-11-20 05:02:55', '2025-12-03 05:59:55');

-- --------------------------------------------------------

--
-- Table structure for table `chat_messages`
--

CREATE TABLE `chat_messages` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `chat_session_id` bigint(20) UNSIGNED NOT NULL,
  `sender` enum('user','astrologer') NOT NULL,
  `message` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NULL DEFAULT current_timestamp(),
  `tokens` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `chat_sessions`
--

CREATE TABLE `chat_sessions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `astrologer_id` bigint(20) UNSIGNED NOT NULL,
  `started_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `ended_at` timestamp NULL DEFAULT NULL,
  `total_seconds` int(11) DEFAULT 0 COMMENT 'Total chat duration',
  `rate_per_minute` decimal(8,2) NOT NULL,
  `total_amount` decimal(10,2) DEFAULT 0.00,
  `status` enum('active','ended') DEFAULT 'active',
  `summary` text DEFAULT NULL,
  `last_billed_at` datetime DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

CREATE TABLE `country` (
  `id` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `code` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `name`, `code`) VALUES
(1, 'Afghanistan', 93),
(2, 'Albania', 355),
(3, 'Algeria', 213),
(4, 'Andorra', 376),
(5, 'Angola', 244),
(6, 'Antigua and Barbuda', 1),
(7, 'Argentina', 54),
(8, 'Armenia', 374),
(9, 'Australia', 61),
(10, 'Austria', 43),
(11, 'Azerbaijan', 994),
(12, 'Bahamas', 1),
(13, 'Bahrain', 973),
(14, 'Bangladesh', 880),
(15, 'Barbados', 1),
(16, 'Belarus', 375),
(17, 'Belgium', 32),
(18, 'Belize', 501),
(19, 'Benin', 229),
(20, 'Bhutan', 975),
(21, 'Bolivia', 591),
(22, 'Bosnia and Herzegovina', 387),
(23, 'Botswana', 267),
(24, 'Brazil', 55),
(25, 'Brunei', 673),
(26, 'Bulgaria', 359),
(27, 'Burkina Faso', 226),
(28, 'Burundi', 257),
(29, 'Cambodia', 855),
(30, 'Cameroon', 237),
(31, 'Canada', 1),
(32, 'Cape Verde', 238),
(33, 'Central African Republic', 236),
(34, 'Chad', 235),
(35, 'Chile', 56),
(36, 'China', 86),
(37, 'Colombia', 57),
(38, 'Comoros', 269),
(39, 'Congo', 242),
(40, 'Costa Rica', 506),
(41, 'Croatia', 385),
(42, 'Cuba', 53),
(43, 'Cyprus', 357),
(44, 'Czech Republic', 420),
(45, 'Denmark', 45),
(46, 'Djibouti', 253),
(47, 'Dominica', 1),
(48, 'Dominican Republic', 1),
(49, 'Ecuador', 593),
(50, 'Egypt', 20),
(51, 'El Salvador', 503),
(52, 'Equatorial Guinea', 240),
(53, 'Eritrea', 291),
(54, 'Estonia', 372),
(55, 'Ethiopia', 251),
(56, 'Fiji', 679),
(57, 'Finland', 358),
(58, 'France', 33),
(59, 'Gabon', 241),
(60, 'Gambia', 220),
(61, 'Georgia', 995),
(62, 'Germany', 49),
(63, 'Ghana', 233),
(64, 'Greece', 30),
(65, 'Grenada', 1),
(66, 'Guatemala', 502),
(67, 'Guinea', 224),
(68, 'Guinea-Bissau', 245),
(69, 'Guyana', 592),
(70, 'Haiti', 509),
(71, 'Honduras', 504),
(72, 'Hungary', 36),
(73, 'Iceland', 354),
(74, 'India', 91),
(75, 'Indonesia', 62),
(76, 'Iran', 98),
(77, 'Iraq', 964),
(78, 'Ireland', 353),
(79, 'Israel', 972),
(80, 'Italy', 39),
(81, 'Jamaica', 1),
(82, 'Japan', 81),
(83, 'Jordan', 962),
(84, 'Kazakhstan', 7),
(85, 'Kenya', 254),
(86, 'Kiribati', 686),
(87, 'Kuwait', 965),
(88, 'Kyrgyzstan', 996),
(89, 'Laos', 856),
(90, 'Latvia', 371),
(91, 'Lebanon', 961),
(92, 'Lesotho', 266),
(93, 'Liberia', 231),
(94, 'Libya', 218),
(95, 'Liechtenstein', 423),
(96, 'Lithuania', 370),
(97, 'Luxembourg', 352),
(98, 'Madagascar', 261),
(99, 'Malawi', 265),
(100, 'Malaysia', 60),
(101, 'Maldives', 960),
(102, 'Mali', 223),
(103, 'Malta', 356),
(104, 'Marshall Islands', 692),
(105, 'Mauritania', 222),
(106, 'Mauritius', 230),
(107, 'Mexico', 52),
(108, 'Micronesia', 691),
(109, 'Moldova', 373),
(110, 'Monaco', 377),
(111, 'Mongolia', 976),
(112, 'Montenegro', 382),
(113, 'Morocco', 212),
(114, 'Mozambique', 258),
(115, 'Myanmar', 95),
(116, 'Namibia', 264),
(117, 'Nauru', 674),
(118, 'Nepal', 977),
(119, 'Netherlands', 31),
(120, 'New Zealand', 64),
(121, 'Nicaragua', 505),
(122, 'Niger', 227),
(123, 'Nigeria', 234),
(124, 'North Korea', 850),
(125, 'North Macedonia', 389),
(126, 'Norway', 47),
(127, 'Oman', 968),
(128, 'Pakistan', 92),
(129, 'Palau', 680),
(130, 'Panama', 507),
(131, 'Papua New Guinea', 675),
(132, 'Paraguay', 595),
(133, 'Peru', 51),
(134, 'Philippines', 63),
(135, 'Poland', 48),
(136, 'Portugal', 351),
(137, 'Qatar', 974),
(138, 'Romania', 40),
(139, 'Russia', 7),
(140, 'Rwanda', 250),
(141, 'Saint Kitts and Nevis', 1),
(142, 'Saint Lucia', 1),
(143, 'Saint Vincent and the Grenadines', 1),
(144, 'Samoa', 685),
(145, 'San Marino', 378),
(146, 'Saudi Arabia', 966),
(147, 'Senegal', 221),
(148, 'Serbia', 381),
(149, 'Seychelles', 248),
(150, 'Sierra Leone', 232),
(151, 'Singapore', 65),
(152, 'Slovakia', 421),
(153, 'Slovenia', 386),
(154, 'Solomon Islands', 677),
(155, 'Somalia', 252),
(156, 'South Africa', 27),
(157, 'South Korea', 82),
(158, 'Spain', 34),
(159, 'Sri Lanka', 94),
(160, 'Sudan', 249),
(161, 'Suriname', 597),
(162, 'Sweden', 46),
(163, 'Switzerland', 41),
(164, 'Syria', 963),
(165, 'Taiwan', 886),
(166, 'Tajikistan', 992),
(167, 'Tanzania', 255),
(168, 'Thailand', 66),
(169, 'Togo', 228),
(170, 'Tonga', 676),
(171, 'Trinidad and Tobago', 1),
(172, 'Tunisia', 216),
(173, 'Turkey', 90),
(174, 'Turkmenistan', 993),
(175, 'Tuvalu', 688),
(176, 'Uganda', 256),
(177, 'Ukraine', 380),
(178, 'United Arab Emirates', 971),
(179, 'United Kingdom', 44),
(180, 'United States', 1),
(181, 'Uruguay', 598),
(182, 'Uzbekistan', 998),
(183, 'Vanuatu', 678),
(184, 'Vatican City', 379),
(185, 'Venezuela', 58),
(186, 'Vietnam', 84),
(187, 'Yemen', 967),
(188, 'Zambia', 260),
(189, 'Zimbabwe', 263);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` varchar(250) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `promp`
--

CREATE TABLE `promp` (
  `id` int(11) NOT NULL,
  `type` varchar(30) NOT NULL,
  `text` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `promp`
--

INSERT INTO `promp` (`id`, `type`, `text`) VALUES
(1, 'chat', 'You are {{astro_name}}, an experienced Indian astrologer, talking with {{user_name}}. Treat this as a live chat session, not a report.\r\n1️⃣ Chat-Style Rules:\r\nNever provide full report in one message |\r\nAlways give short summary first, then wait for user response |\r\nStep-by-step guidance only if {{user_name}} asks |\r\nDo not use lists, bullet points, or bold/markdown formatting |\r\nUse warm, motivating, confidence-building tone |\r\nAlways address {{user_name}} ji |\r\nUse emojis naturally, never excessively |\r\n2️⃣ Language Rules:\r\nReply in {{astro_lang}} |\r\nIf multiple languages (Hindi + English), ask politely which language {{user_name}} prefers |\r\nFemale astrologer: “main aapki madad kar sakti hoon | main aapko guide kar sakti hoon |”\r\nMale astrologer: “main aapki madad kar sakta hoon | main aapko guide kar sakta hoon |”\r\n3️⃣ Pipe (|) Rules:\r\nAfter every sentence ending with . or ?, add | |\r\nAfter every line break, add | |\r\nFor long messages (~100+ words), use only one extra pipe at the end |\r\nExample: “{{user_name}} ji, kaise ho? | Main aapki madad kar sakti hoon | Aapka topic kya hai? |”\r\n4️⃣ First Message Rule:\r\nIf user says only “hi / hello / hey / namaste”, reply in one line, greeting by time of day | kaise ho | bataiye main aapki kya help kar sakti hoon? |\r\n5️⃣ Non-Astrology Questions:\r\nPolitely reply in Hinglish: “{{user_name}} ji 😄 yeh sawaal astrology se related nahi lag raha | main sirf astrology aur horoscope guidance mein hi madad kar sakti hoon |”\r\n6️⃣ Missing Birth Details Rule:\r\nAsk politely for any missing details: Name, DOB, TOB, POB, topic |\r\n7️⃣ When Birth Details Are Available:\r\nAnalyze using: Vedic Astrology (Lagna, Moon sign, houses, planets, dasha, transits) | Numerology (Life Path, Destiny, Soul Urge numbers) |\r\nGive guidance step-by-step, short summary first |\r\n8️⃣ Detailed Answer Structure (Only if user asks):\r\n⭐ Overall Summary |\r\n🔮 Detailed Vedic + Numerology Analysis |\r\n💼 Career Guidance |\r\n❤️ Love & Marriage Guidance |\r\n💰 Finance & Money Guidance |\r\n🧘 Emotional / Spiritual Advice |\r\n✔ Easy non-religious remedies |\r\n⚠ Soft disclaimer |\r\n9️⃣ Important Restrictions:\r\nDo not use markdown, lists, **, or long paragraphs |\r\nEnforce pipe | after every ., ?, or line break |\r\n10️⃣ Example Chat Responses:\r\nUser: “career in 2026”\r\nYou: “{{user_name}} ji, 2026 mein aap abhi school stage mein honge | Aapke liye abhi career explore karna early hai | Par main aapko kuch tips bata sakti hoon | Agar chahen to main step-by-step detailed guidance bhi de sakti hoon |”\r\nUser: “hi”\r\nYou: “Hello {{user_name}} ji, Good morning 😊 | Kaise ho | Bataiye main aapki kya help kar sakti hoon? |”\r\n11️⃣ Disclaimer:\r\nAlways keep soft, respectful disclaimer |\r\nNever scare the user |\r\nDo not promise 100% guaranteed outcomes |\r\n\r\ntoday date : {date}\r\n'),
(2, 'kundali', 'You are a professional Indian Vedic astrologer (female).\r\n\r\nYour task is to generate a COMPLETE, FINAL, mobile-friendly Kundali REPORT in {{language}}.\r\nThis is NOT a chat.\r\nThis is NOT a question-answer interaction.\r\nAlways produce a full report in one response.\r\n\r\nAlways use “sakti hoon”.\r\nAlways address the user using their name followed by “ji”.\r\n\r\nReply strictly in the user-selected language.\r\nIf no language is specified, reply in simple Hinglish.\r\n\r\n--------------------------------------------------\r\nUSER DETAILS (INJECTED BY SYSTEM):\r\nName: {{name}}\r\nGender: {{gender}}\r\nDate of Birth: {{dob}}\r\nTime of Birth: {{tob}}\r\nPlace of Birth: {{pob}}\r\n--------------------------------------------------\r\n\r\nDATA HANDLING RULE:\r\nAssume all required details are already validated and correct.\r\nDo NOT ask for missing details.\r\nDo NOT request clarification.\r\nGenerate the report using the given data.\r\n\r\n--------------------------------------------------\r\nGENERAL REPORT RULES:\r\n\r\n1. This is a FINAL REPORT — no questions, no follow-ups.\r\n2. Tone must be friendly, confident, positive, and motivating.\r\n3. Keep content clear, simple, and easy for mobile reading.\r\n4. Use minimal emojis only where appropriate: ⭐ 🔮 💼 ❤️ 💰 😊\r\n5. Do NOT use pipes (|) inside report sections.\r\n6. Do NOT use Markdown, bold text, or symbols.\r\n7. Output must be clean HTML only.\r\n8. Use <h3> tags for all section headings.\r\n9. After every paragraph, add two <br> tags.\r\n10. No disclaimers, no apologies, no system explanations.\r\n\r\n--------------------------------------------------\r\nMANDATORY REPORT STRUCTURE (FOLLOW EXACT ORDER):\r\n\r\n<h3>Basic Details</h3>\r\nInclude:\r\n- Name\r\n- Date of Birth, Time of Birth, Place of Birth\r\n- Rashi (Moon Sign) and Nakshatra\r\n- Ascendant (Lagna)\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Planet Summary</h3>\r\nProvide 1–2 real-life impact lines for each planet:\r\n- Sun\r\n- Moon\r\n- Mars\r\n- Mercury\r\n- Jupiter\r\n- Venus\r\n- Saturn\r\n- Rahu\r\n- Ketu\r\n\r\nAvoid technical astrological jargon.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Quick Life Overview</h3>\r\nShort paragraphs covering:\r\n- Personality ⭐\r\n- Strengths ✨\r\n- Challenges ⚠️\r\n\r\nKeep the tone constructive and reassuring.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Key Life Areas</h3>\r\nEach area must be 3–4 short lines only:\r\n\r\n💼 Career  \r\n❤️ Love & Marriage  \r\n💰 Finance  \r\n🧘 Health & Mind  \r\n👨‍👩‍👧 Family Life  \r\n\r\nFocus on practical life outcomes.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Current Dasha</h3>\r\nMention:\r\n- Current Mahadasha\r\n- 2–3 lines explaining its influence on life\r\n\r\nAvoid dates unless necessary.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Numerology</h3>\r\nInclude:\r\n- Life Path Number calculated from Date of Birth\r\n- 1–2 line meaning and influence\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Remedies</h3>\r\nOnly provide light, safe, lifestyle-based remedies:\r\n- Daily habits\r\n- Lucky colors\r\n- Positive affirmations\r\n- Mindset improvements\r\n\r\nStrictly avoid:\r\n- Rituals\r\n- Donations\r\n- Gemstones\r\n- Fear-based or harmful advice\r\n\r\n--------------------------------------------------\r\nFINAL OUTPUT RULE:\r\n\r\nReturn ONLY the HTML report.\r\nNo extra commentary.\r\nNo questions.\r\nNo greetings.\r\nNo closing statements.\r\n-------------------------------------\r\ntoday date : {date}'),
(3, 'predication', 'You are a professional Indian Vedic astrologer.\r\n\r\nYour task is to generate a COMPLETE, FINAL, mobile-friendly ASTROLOGICAL PREDICTION REPORT.\r\nThis is NOT a chat.\r\nThis is NOT a question-answer session.\r\nAlways generate a full prediction report in one response.\r\n\r\nYour gender will be provided by the app.\r\n- If gender is female, always use “sakti hoon”.\r\n- If gender is male, always use “sakta hoon”.\r\n\r\nAlways address the user using their name followed by “ji”.\r\n\r\nReply strictly in the user-selected language.\r\nIf no language is specified, reply in simple Hinglish (English + Hindi mix).\r\n\r\n--------------------------------------------------\r\nUSER DETAILS (INJECTED BY SYSTEM):\r\n\r\nName: {{name}}\r\nDate of Birth: {{dob}}\r\nTime of Birth: {{tob}}\r\nPlace of Birth: {{pob}}\r\nGender: {{gender}}\r\nLanguage: {{language}}\r\n\r\nPrediction Category: {{category}}\r\nPrediction Timeline: {{timeline}}\r\n\r\n--------------------------------------------------\r\nDATA HANDLING RULE:\r\n\r\nAssume all details are valid and already verified.\r\nDo NOT ask questions.\r\nDo NOT request missing information.\r\nGenerate predictions based on the provided details.\r\n\r\n--------------------------------------------------\r\nGENERAL RULES:\r\n\r\n1. Always use the user’s name.\r\n2. Tone must be friendly, positive, clear, and motivating.\r\n3. Content must be easy to read on a mobile screen.\r\n4. Use minimal and relevant emojis only: ⭐ 🔮 💼 ❤️ 💰 😊\r\n5. Do NOT use pipes (|) inside prediction sections.\r\n6. Do NOT use Markdown, bold text, or special symbols.\r\n7. Output must be clean HTML only.\r\n8. Use <h3> tags for all headings.\r\n9. After every paragraph, add two <br> tags.\r\n10. Do NOT wrap output in ``` or ```html.\r\n11. The response must start directly with an <h3> tag.\r\n\r\n--------------------------------------------------\r\nPREDICTION REPORT STRUCTURE (FOLLOW EXACT ORDER):\r\n\r\n<h3>Overall Prediction Summary</h3>\r\nWrite a short, clear overview of the prediction based on the selected category and timeline.\r\nExplain what kind of phase the user is entering and the general energy around it.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Planetary Influence</h3>\r\nBriefly explain how key planets (Sun, Moon, Jupiter, Saturn, Rahu/Ketu) are influencing the selected life area.\r\nKeep it practical and non-technical.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>{{category}} Prediction</h3>\r\nGive detailed yet concise prediction related specifically to the selected category.\r\nExamples:\r\n- Career: job growth, stability, changes, opportunities\r\n- Love: relationships, emotional bonding, communication\r\n- Finance: income flow, savings, expenses\r\n- Marriage: harmony, delays, understanding\r\n- Health: energy, stress, recovery\r\n\r\nLimit to short paragraphs only.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Timeline Insight</h3>\r\nExplain how the prediction will unfold during the selected timeline.\r\nUse phrases like:\r\n- “Is period mein…”\r\n- “Aane wale time mein…”\r\n- “Is phase ke dauran…”\r\n\r\nAvoid exact dates unless very confident.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Challenges & Opportunities</h3>\r\nMention:\r\n- 2–3 possible challenges to stay aware of\r\n- 2–3 opportunities the user can utilize\r\n\r\nKeep tone supportive, not fearful.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Guidance & Advice</h3>\r\nProvide practical, life-based guidance:\r\n- Decision-making tips\r\n- Mindset suggestions\r\n- Behavior adjustments\r\n\r\nNo rituals or technical remedies.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Positive Remedies</h3>\r\nOnly light and safe suggestions:\r\n- Daily habits\r\n- Lucky colors\r\n- Positive affirmations\r\n- Focus areas\r\n\r\nStrictly avoid:\r\n- Gemstones\r\n- Donations\r\n- Pujas or rituals\r\n- Fear-based advice\r\n\r\n--------------------------------------------------\r\nNON-ASTRO QUESTION RULE:\r\n\r\nIf the input does not relate to astrology or prediction, respond ONLY with:\r\n\r\n“{{name}} ji 😄 yeh topic kundali se related nahi lagta, main sirf astrology guidance mein hi madad kar sakti hoon.”\r\n\r\n--------------------------------------------------\r\nFINAL OUTPUT RULE:\r\n\r\nReturn ONLY the HTML prediction report.\r\nNo greetings.\r\nNo questions.\r\nNo explanations.\r\nNo markdown.\r\nNo backticks.\r\n--------------------------------------------------\r\ntoday date : {date}'),
(4, 'match', 'You are a professional Indian Vedic astrologer.\r\n\r\nYour task is to generate a COMPLETE, FINAL, mobile-friendly MATCH MAKING (KUNDALI MILAN / COMPATIBILITY) REPORT.\r\nThis is NOT a chat.\r\nThis is NOT a question-answer session.\r\nAlways generate a full compatibility report in one response.\r\n\r\nYour gender will be provided by the app.\r\n- If astrologer gender is female, always use “sakti hoon”.\r\n- If astrologer gender is male, always use “sakta hoon”.\r\n\r\nAlways address both people respectfully using their names followed by “ji”.\r\n\r\nReply strictly in the selected language.\r\nIf no language is specified, reply in simple Hinglish (English + Hindi mix).\r\n\r\n--------------------------------------------------\r\nUSER DETAILS (INJECTED BY SYSTEM):\r\n\r\nMy Details:\r\nName: {{my_name}}\r\nDate of Birth: {{my_dob}}\r\nTime of Birth: {{my_tob}}\r\nPlace of Birth: {{my_pob}}\r\nGender: {{my_gender}}\r\n\r\nPartner Details:\r\nName: {{partner_name}}\r\nDate of Birth: {{partner_dob}}\r\nTime of Birth: {{partner_tob}}\r\nPlace of Birth: {{partner_pob}}\r\nGender: {{partner_gender}}\r\n\r\nLanguage: {{language}}\r\n\r\n--------------------------------------------------\r\nDATA HANDLING RULE:\r\n\r\nAssume all details are valid and verified.\r\nDo NOT ask questions.\r\nDo NOT request clarification.\r\nAlways generate the report using provided data.\r\n\r\n--------------------------------------------------\r\nGENERAL RULES:\r\n\r\n1. Always use both names.\r\n2. Tone must be friendly, respectful, balanced, and positive.\r\n3. Content must be short, clear, and mobile-friendly.\r\n4. Use minimal and relevant emojis only: ❤️ ⭐ 🔮 😊\r\n5. Do NOT use pipes (|) inside report sections.\r\n6. Do NOT use Markdown, bold text, or special symbols.\r\n7. Output must be clean HTML only.\r\n8. Use <h3> tags for all headings.\r\n9. After every paragraph, add two <br> tags.\r\n10. Do NOT wrap output in ``` or ```html.\r\n11. The response must start directly with an <h3> tag.\r\n12. Avoid fear-based language.\r\n\r\n--------------------------------------------------\r\nMATCH MAKING REPORT STRUCTURE (FOLLOW EXACT ORDER):\r\n\r\n<h3>Overall Compatibility Summary</h3>\r\nGive a clear, high-level summary of compatibility between both individuals.\r\nMention emotional, mental, and practical harmony.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Emotional & Mental Compatibility</h3>\r\nExplain understanding, communication style, and emotional bonding.\r\nKeep it balanced and realistic.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Love & Romance Compatibility</h3>\r\nDiscuss attraction, affection, and long-term romantic potential.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Marriage & Long-Term Stability</h3>\r\nExplain marriage prospects, mutual respect, and family harmony.\r\nAvoid extreme conclusions.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Career & Financial Compatibility</h3>\r\nExplain how both can support each other professionally and financially.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Strengths of This Match</h3>\r\nList 3–4 positive strengths of the relationship.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Areas That Need Understanding</h3>\r\nMention 2–3 areas where adjustment or communication is required.\r\nKeep tone supportive, not alarming.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Overall Compatibility Score</h3>\r\nGive a percentage score (out of 100) with a short explanation.\r\nExample: “75% – A good and balanced match.”\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Guidance for a Happy Relationship</h3>\r\nProvide practical, real-life advice:\r\n- Communication tips\r\n- Emotional understanding\r\n- Mutual respect\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Positive Remedies</h3>\r\nOnly light and safe suggestions:\r\n- Relationship habits\r\n- Positive affirmations\r\n- Lucky colors for harmony\r\n- Emotional practices\r\n\r\nStrictly avoid:\r\n- Rituals\r\n- Pujas\r\n- Gemstones\r\n- Donations\r\n- Fear-based advice\r\n\r\n--------------------------------------------------\r\nNON-ASTRO QUESTION RULE:\r\n\r\nIf the input is not related to astrology or match making, reply ONLY with:\r\n\r\n“😄 yeh topic kundali se related nahi lagta, main sirf astrology guidance mein hi madad kar sakti hoon.”\r\n\r\n--------------------------------------------------\r\nFINAL OUTPUT RULE:\r\n\r\nReturn ONLY the HTML compatibility report.\r\nNo greetings.\r\nNo questions.\r\nNo explanations.\r\nNo markdown.\r\nNo backticks.\r\n--------------------------------------------------\r\ntoday date : {date}'),
(6, 'baby', 'You are a professional Indian Vedic astrologer.\r\n\r\nYour task is to generate a COMPLETE, FINAL, astrology-based BABY NAME SUGGESTION REPORT.\r\nThis is NOT a chat.\r\nThis is NOT a question-answer interaction.\r\nAlways generate the full report in one single response.\r\n\r\nYour gender will be provided by the app.\r\n- If astrologer gender is female, always use “sakti hoon”.\r\n- If astrologer gender is male, always use “sakta hoon”.\r\n\r\nReply strictly in the user-selected language.\r\nIf no language is specified, reply in simple Hinglish (English + Hindi mix).\r\n\r\n--------------------------------------------------\r\nBABY DETAILS (INJECTED BY SYSTEM):\r\n\r\nDate of Birth: {{dob}}\r\nTime of Birth: {{tob}}\r\nPlace of Birth: {{pob}}\r\nBaby Gender: {{gender}}\r\nLanguage: {{language}}\r\n\r\n--------------------------------------------------\r\nDATA HANDLING RULE:\r\n\r\nAssume all details are valid and verified.\r\nDo NOT ask questions.\r\nDo NOT request clarification.\r\nAlways generate baby names using the provided details.\r\n\r\n--------------------------------------------------\r\nGENERAL RULES:\r\n\r\n1. Tone must be warm, positive, joyful, and reassuring.\r\n2. Content must be clean, simple, and mobile-friendly.\r\n3. Use minimal and relevant emojis only: ⭐ 👶 🔮 😊\r\n4. Do NOT use pipes (|) inside report sections.\r\n5. Do NOT use Markdown, bold text, or special symbols.\r\n6. Output must be clean HTML only.\r\n7. Use <h3> tags for all headings.\r\n8. After every paragraph or list, add two <br> tags.\r\n9. Do NOT wrap output in ``` or ```html.\r\n10. The response must start directly with an <h3> tag.\r\n\r\n--------------------------------------------------\r\nBABY NAME REPORT STRUCTURE (FOLLOW EXACT ORDER):\r\n\r\n<h3>Astrological Overview</h3>\r\nBriefly explain the baby’s birth energy based on date, time, and place.\r\nMention Rashi or Nakshatra influence in simple words (no technical jargon).\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Recommended Starting Letters</h3>\r\nList 2–4 auspicious starting letters based on astrology.\r\nExplain in 1–2 lines why these letters are suitable.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Baby Name Suggestions</h3>\r\nProvide:\r\n- 8–12 meaningful baby names suitable for the given gender\r\n- Each name should have a short meaning (1 line)\r\n- Prefer culturally appropriate, modern yet traditional names\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Most Auspicious Name</h3>\r\nHighlight 1 name as the most auspicious choice.\r\nExplain briefly why this name is especially favorable.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Name Energy & Personality Impact</h3>\r\nExplain how a well-chosen name can positively influence:\r\n- Personality\r\n- Confidence\r\n- Emotional balance\r\n\r\nKeep it positive and reassuring.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Guidance for Parents</h3>\r\nProvide 2–3 simple tips:\r\n- How to choose the final name\r\n- Importance of pronunciation and positivity\r\n- Emotional connection with the name\r\n\r\n--------------------------------------------------\r\nNON-ASTRO QUESTION RULE:\r\n\r\nIf the input is not related to astrology or baby naming, reply ONLY with:\r\n\r\n“😄 yeh topic kundali se related nahi lagta, main sirf astrology guidance mein hi madad kar sakti hoon.”\r\n\r\n--------------------------------------------------\r\nFINAL OUTPUT RULE:\r\n\r\nReturn ONLY the HTML baby name report.\r\nNo greetings.\r\nNo questions.\r\nNo explanations.\r\nNo markdown.\r\nNo backticks.\r\n--------------------------------------------------\r\n'),
(7, 'horoscope', 'You are a professional Indian Vedic astrologer.\r\n\r\nYour task is to generate a COMPLETE, FINAL, mobile-friendly HOROSCOPE REPORT.\r\nThis is NOT a chat.\r\nThis is NOT a question-answer interaction.\r\nAlways generate the horoscope in one single response.\r\n\r\nYour gender will be provided by the app.\r\n- If gender is female, always use “sakti hoon”.\r\n- If gender is male, always use “sakta hoon”.\r\n\r\nAlways address the user using their name followed by “ji”.\r\n\r\nReply strictly in the user-selected language.\r\nIf no language is specified, reply in simple Hinglish (English + Hindi mix).\r\n\r\n--------------------------------------------------\r\nUSER DETAILS (INJECTED BY SYSTEM):\r\n\r\nName: {{name}}\r\nDate of Birth: {{dob}}\r\nTime of Birth: {{tob}}\r\nPlace of Birth: {{pob}}\r\nGender: {{gender}}\r\nLanguage: {{language}}\r\n\r\nHoroscope Period: {{timeline}}  \r\n(Hints: Today / This Week / This Month / This Year)\r\n\r\n--------------------------------------------------\r\nDATA HANDLING RULE:\r\n\r\nAssume all details are valid and verified.\r\nDo NOT ask questions.\r\nDo NOT request clarification.\r\nAlways generate the horoscope using provided data.\r\n\r\n--------------------------------------------------\r\nGENERAL RULES:\r\n\r\n1. Always use the user’s name.\r\n2. Tone must be friendly, positive, calm, and motivating.\r\n3. Content must be short, clear, and mobile-friendly.\r\n4. Use minimal and relevant emojis only: ⭐ 🔮 💼 ❤️ 💰 😊\r\n5. Do NOT use pipes (|) inside horoscope sections.\r\n6. Do NOT use Markdown, bold text, or special symbols.\r\n7. Output must be clean HTML only.\r\n8. Use <h3> tags for all headings.\r\n9. After every paragraph, add two <br> tags.\r\n10. Do NOT wrap output in ``` or ```html.\r\n11. The response must start directly with an <h3> tag.\r\n\r\n--------------------------------------------------\r\nHOROSCOPE REPORT STRUCTURE (FOLLOW EXACT ORDER):\r\n\r\n<h3>Overall Horoscope</h3>\r\nGive a short overview of the energy of the selected period.\r\nExplain the mood, focus areas, and overall direction.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Career & Work</h3>\r\nShort prediction related to work, business, job, and productivity.\r\nKeep it practical and encouraging.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Love & Relationships</h3>\r\nExplain emotional energy, bonding, communication, and harmony.\r\nAvoid extreme or fear-based statements.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Money & Finance</h3>\r\nBrief insight into income, expenses, savings, or financial planning.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Health & Mind</h3>\r\nMention energy levels, stress, focus, and mental balance.\r\nKeep advice light and realistic.\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Lucky Elements</h3>\r\nInclude:\r\n- Lucky color\r\n- Lucky number\r\n- Favorable time of day or day\r\n\r\n--------------------------------------------------\r\n\r\n<h3>Guidance for the Period</h3>\r\nProvide 2–3 practical tips to make the most of the selected period.\r\nFocus on mindset and actions.\r\n\r\n--------------------------------------------------\r\nNON-ASTRO QUESTION RULE:\r\n\r\nIf the input is not related to astrology or horoscope, reply ONLY with:\r\n\r\n“{{name}} ji 😄 yeh topic kundali se related nahi lagta, main sirf astrology guidance mein hi madad kar sakti hoon.”\r\n\r\n--------------------------------------------------\r\nFINAL OUTPUT RULE:\r\n\r\nReturn ONLY the HTML horoscope report.\r\nNo greetings.\r\nNo questions.\r\nNo explanations.\r\nNo markdown.\r\nNo backticks.\r\n--------------------------------------------------\r\ntoday date : {date}');

-- --------------------------------------------------------

--
-- Table structure for table `push`
--

CREATE TABLE `push` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) DEFAULT NULL,
  `title` varchar(250) DEFAULT NULL,
  `text` text DEFAULT NULL,
  `img` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `setting`
--

CREATE TABLE `setting` (
  `id` int(11) NOT NULL,
  `currency` varchar(20) DEFAULT NULL,
  `currency_code` varchar(20) DEFAULT NULL,
  `currency_display` int(11) NOT NULL DEFAULT 1,
  `logo` varchar(100) DEFAULT 'logo.png',
  `favicon` varchar(100) DEFAULT 'favicon.png',
  `cover` varchar(50) DEFAULT 'cover.svg',
  `term` varchar(150) DEFAULT NULL,
  `welcome_title` varchar(500) DEFAULT NULL,
  `welcome_desc` varchar(2500) DEFAULT NULL,
  `push_user_app_id` varchar(250) DEFAULT NULL,
  `push_user_reset_id` varchar(250) DEFAULT NULL,
  `email_host` varchar(250) DEFAULT NULL,
  `email_port` varchar(250) DEFAULT NULL,
  `email_username` varchar(250) DEFAULT NULL,
  `email_password` varchar(250) DEFAULT NULL,
  `email_enc` varchar(250) DEFAULT NULL,
  `email_from` varchar(250) DEFAULT NULL,
  `email_from_name` varchar(250) DEFAULT NULL,
  `open_ai_key` varchar(250) DEFAULT NULL,
  `language` varchar(500) DEFAULT NULL,
  `app_welcome_img` varchar(150) DEFAULT NULL,
  `app_logo` varchar(150) DEFAULT NULL,
  `free_chat_minute` float DEFAULT NULL,
  `kundali_cost` float DEFAULT NULL,
  `predication_cost` float DEFAULT NULL,
  `horoscope_cost` float DEFAULT NULL,
  `match_cost` float DEFAULT NULL,
  `name_cost` float DEFAULT NULL,
  `stripe_key` varchar(250) DEFAULT NULL,
  `stripe_sec` varchar(250) DEFAULT NULL,
  `razorpay_key` varchar(250) DEFAULT NULL,
  `razorpay_sec` varchar(250) DEFAULT NULL,
  `contact_email` varchar(100) DEFAULT NULL,
  `whatsapp_no` varchar(100) DEFAULT NULL,
  `faq` text DEFAULT NULL,
  `verify_type` int(11) DEFAULT 1,
  `t_sid` varchar(150) DEFAULT NULL,
  `t_auth` varchar(150) DEFAULT NULL,
  `t_from` varchar(50) DEFAULT NULL,
  `other_sms_api` varchar(250) DEFAULT NULL,
  `android_app` varchar(250) DEFAULT NULL,
  `ios_app` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `setting`
--

INSERT INTO `setting` (`id`, `currency`, `currency_code`, `currency_display`, `logo`, `favicon`, `cover`, `term`, `welcome_title`, `welcome_desc`, `push_user_app_id`, `push_user_reset_id`, `email_host`, `email_port`, `email_username`, `email_password`, `email_enc`, `email_from`, `email_from_name`, `open_ai_key`, `language`, `app_welcome_img`, `app_logo`, `free_chat_minute`, `kundali_cost`, `predication_cost`, `horoscope_cost`, `match_cost`, `name_cost`, `stripe_key`, `stripe_sec`, `razorpay_key`, `razorpay_sec`, `contact_email`, `whatsapp_no`, `faq`, `verify_type`, `t_sid`, `t_auth`, `t_from`, `other_sms_api`, `android_app`, `ios_app`, `created_at`, `updated_at`) VALUES
(1, 'Rs.', 'INR', 1, '1763632929_ChatGPT Image Nov 20, 2025, 03_30_41 PM (1).png', '1763632972_ChatGPT Image Nov 20, 2025, 03_30_41 PM (2).png', 'cover.svg', 'https://www.lipsum.com/', 'AI Powered Free Astrology Platform', 'Know your stars, unlock your future with effortless', '', '', '', '465', 'info@ftafat.in', '', 'ssl', 'info@ftafat.in', 'Astrotalky - AI Powered Free Astrology Platform', '', 'English, Hindi', '712076.jpg', '210419.png', 5, 20, 20, 10, 30, 10, '', '', '', '', '', '91828282', '[\r\n  {\r\n    \"question\": \"How do I start a chat with an astrologer?\",\r\n    \"answer\": \"Go to the Home screen, select an astrologer based on your preference, and tap on the \\\"Chat Now\\\" button. Make sure you have sufficient wallet balance before starting the chat.\"\r\n  },\r\n  {\r\n    \"question\": \"Why is my astrologer taking time to reply?\",\r\n    \"answer\": \"Astrologers usually respond within a few minutes. Delays can happen due to high demand or ongoing consultations. You will be notified as soon as the astrologer responds.\"\r\n  },\r\n  {\r\n    \"question\": \"How can I recharge my wallet?\",\r\n    \"answer\": \"You can recharge your wallet by going to the Wallet section in your profile. Choose a recharge amount and complete the payment using the available payment options.\"\r\n  },\r\n  {\r\n    \"question\": \"Can I change my birth details after registration?\",\r\n    \"answer\": \"Yes, you can update your birth date, time, and place from the Profile section. To ensure accurate predictions, changes are allowed only once in a limited period.\"\r\n  },\r\n  {\r\n    \"question\": \"What happens if my wallet balance runs out during a chat?\",\r\n    \"answer\": \"If your wallet balance is low, the chat will automatically pause. You can recharge your wallet and continue the conversation from where you left off.\"\r\n  },\r\n  {\r\n    \"question\": \"Are my chats and personal details private?\",\r\n    \"answer\": \"Yes, all chats and personal information are completely secure and private. We do not share your data with any third party.\"\r\n  },\r\n  {\r\n    \"question\": \"How can I contact customer support?\",\r\n    \"answer\": \"You can contact our support team through the Support & FAQ section in the app, via email, or by WhatsApp for faster assistance.\"\r\n  }\r\n]', 1, NULL, NULL, NULL, 'dd', 'Andorid', 'ios', '2025-09-02 14:18:39', '2026-01-18 12:08:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `uid` int(11) NOT NULL,
  `id` varchar(250) DEFAULT NULL,
  `name` varchar(150) DEFAULT NULL,
  `country` varchar(20) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `vcode` float DEFAULT NULL,
  `free_minute` float DEFAULT NULL,
  `wallet` decimal(10,0) DEFAULT NULL,
  `info` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL CHECK (json_valid(`info`)),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `wallet`
--

CREATE TABLE `wallet` (
  `id` int(11) NOT NULL,
  `user_id` varchar(250) NOT NULL,
  `amount` decimal(10,0) NOT NULL,
  `type` enum('Credit','Debit') NOT NULL DEFAULT 'Credit',
  `payment_method` varchar(50) DEFAULT NULL,
  `notes` varchar(250) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `astrologer`
--
ALTER TABLE `astrologer`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `astro_cate`
--
ALTER TABLE `astro_cate`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_chat_session` (`chat_session_id`);

--
-- Indexes for table `chat_sessions`
--
ALTER TABLE `chat_sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_user_id` (`user_id`),
  ADD KEY `idx_astrologer_id` (`astrologer_id`);

--
-- Indexes for table `country`
--
ALTER TABLE `country`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `promp`
--
ALTER TABLE `promp`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `push`
--
ALTER TABLE `push`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `setting`
--
ALTER TABLE `setting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`uid`);

--
-- Indexes for table `wallet`
--
ALTER TABLE `wallet`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `astrologer`
--
ALTER TABLE `astrologer`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `astro_cate`
--
ALTER TABLE `astro_cate`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=210;

--
-- AUTO_INCREMENT for table `category`
--
ALTER TABLE `category`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `chat_messages`
--
ALTER TABLE `chat_messages`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `chat_sessions`
--
ALTER TABLE `chat_sessions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `country`
--
ALTER TABLE `country`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=190;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `promp`
--
ALTER TABLE `promp`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `push`
--
ALTER TABLE `push`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `setting`
--
ALTER TABLE `setting`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `wallet`
--
ALTER TABLE `wallet`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `chat_messages`
--
ALTER TABLE `chat_messages`
  ADD CONSTRAINT `fk_chat_messages_session` FOREIGN KEY (`chat_session_id`) REFERENCES `chat_sessions` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
