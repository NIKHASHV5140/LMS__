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
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `stud_id` int(11) NOT NULL,
  `student_id` varchar(100) NOT NULL,
  `first_name` varchar(200) DEFAULT NULL,
  `middle_name` varchar(200) NOT NULL,
  `last_name` varchar(200) DEFAULT NULL,
  `email` varchar(150) NOT NULL,
  `dob` date NOT NULL,
  `address` varchar(200) NOT NULL,
  `city` varchar(200) NOT NULL,
  `state` varchar(200) NOT NULL,
  `zip_code` int(11) NOT NULL,
  `phone` bigint(20) NOT NULL,
  `grade` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`stud_id`, `student_id`, `first_name`, `middle_name`, `last_name`, `email`, `dob`, `address`, `city`, `state`, `zip_code`, `phone`, `grade`) VALUES
(9, '1001', 'Ponnaiyan', 'X', 'Kandasamy', 'ponnaiyan.k@gmail.com', '0000-00-00', '9100 Independence Pkwy', 'Plano', 'TX', 75025, 3345345345, 3),
(11, '1002', 'Ponnaiyan', 'X', 'Kandasamy', 'ponnaiyan.k@gmail.com', '1977-11-16', '9100 Independence Pkwy', 'Plano', 'TX', 75025, 3345345345, 4),
(13, '297177', 'Nikhash', 'Ponnaiyan ', 'Sowmiya', 'ponnaiyan.k@gmail.com', '2009-08-01', '9100 Independence Pkwy', 'Plano', 'TX', 75025, 9452372192, 10);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`stud_id`),
  ADD UNIQUE KEY `student_id` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `stud_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
