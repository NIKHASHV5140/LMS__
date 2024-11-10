-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 11, 2024 at 12:07 AM
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
-- Database: `lms`
--

-- --------------------------------------------------------

--
-- Table structure for table `book_trans`
--

CREATE TABLE `book_trans` (
  `bt_id` int(11) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `book_id` varchar(100) DEFAULT NULL,
  `checkout_ts` timestamp NOT NULL DEFAULT current_timestamp(),
  `checkin_ts` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `status` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `book_trans`
--

INSERT INTO `book_trans` (`bt_id`, `student_id`, `book_id`, `checkout_ts`, `checkin_ts`, `status`) VALUES
(2, '1001', '2222', '2024-11-10 04:31:44', '2024-11-10 22:05:27', 'closed'),
(3, '297177', '2222', '2024-11-10 05:13:35', '2024-11-10 22:05:27', 'closed'),
(4, '297177', '1234', '2024-11-10 05:13:47', '2024-11-10 22:13:50', 'closed'),
(5, '1001', '2222', '2024-11-10 13:56:47', '2024-11-10 22:05:27', 'closed'),
(6, '297177', '2222', '2024-11-10 14:05:07', '2024-11-10 22:05:27', 'closed'),
(7, '297177', '2222', '2024-11-10 14:19:43', '2024-11-10 22:05:27', 'closed'),
(8, '1001', '1234', '2024-11-10 14:21:05', '2024-11-10 22:13:50', 'closed'),
(9, '297177', '2222', '2024-11-10 14:41:48', '2024-11-10 22:05:27', 'closed'),
(10, '297177', '1234', '2024-11-10 22:13:30', '2024-11-10 22:13:50', 'closed'),
(11, '297177', '1234', '2024-11-10 22:14:40', '2024-11-10 22:14:40', 'Open');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `book_trans`
--
ALTER TABLE `book_trans`
  ADD PRIMARY KEY (`bt_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `book_trans`
--
ALTER TABLE `book_trans`
  MODIFY `bt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
