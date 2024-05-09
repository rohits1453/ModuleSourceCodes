-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 09, 2024 at 11:08 AM
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
-- Database: `drscareapp`
--

-- --------------------------------------------------------

--
-- Table structure for table `checkboxes_values`
--

CREATE TABLE `checkboxes_values` (
  `s_no` int(5) NOT NULL,
  `patient_score` int(20) NOT NULL,
  `total_score` int(11) NOT NULL,
  `outcome` varchar(200) NOT NULL,
  `patient_name` varchar(200) NOT NULL,
  `patient_id` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `checkboxes_values`
--

INSERT INTO `checkboxes_values` (`s_no`, `patient_score`, `total_score`, `outcome`, `patient_name`, `patient_id`) VALUES
(8, 10, 0, '', '', 14),
(11, 2, 26, 'Unlikely', '', 14),
(12, 10, 30, 'Unlikely', '', 0),
(13, 27, 30, 'Need for Immediate Intervention', '', 0),
(14, 18, 30, 'Need for Observation and Further Evaluation', '', 0),
(15, 10, 30, 'Unlikely', '', 0),
(16, 15, 26, 'Need for Observation and Further Evaluation', '', 0),
(17, 0, 0, 'Need for Immediate Intervention', '', 0),
(18, 0, 0, '', '', 0),
(19, 15, 15, 'need for intervention', '', 0),
(20, 4, 30, 'Wait & Watch', '', 0),
(21, 0, 0, 'Need for Immediate Intervention', '', 0),
(22, 2, 30, 'Wait & Watch', '', 0),
(23, 9, 26, 'Plan for Conservative Management', '', 0),
(24, 9, 26, 'Plan for Conservative Management', '', 0),
(25, 10, 26, 'Plan for Conservative Management', '', 0),
(26, 8, 30, 'Wait & Watch', '', 0),
(27, 8, 30, 'Wait & Watch', '', 0),
(28, 12, 30, 'Need to Proceed With Conservative management', '', 0),
(29, 12, 26, 'Plan for Conservative Management', '', 0),
(30, 13, 26, 'Plan for Conservative Management', '', 0),
(31, 0, 0, 'Need for Immediate Intervention', '', 0),
(32, 0, 0, 'Need for Immediate Intervention', '', 0),
(33, 0, 0, 'Need for Immediate Intervention', '', 0),
(34, 12, 26, 'Plan for Conservative Management', '', 0),
(35, 12, 26, 'Plan for Conservative Management', '', 0),
(36, 12, 26, 'Plan for Conservative Management', '', 0),
(37, 12, 26, 'Plan for Conservative Management', '', 0),
(38, 0, 0, 'Need for Immediate Intervention', '', 0),
(39, 20, 30, 'Need for Observation and Further Evaluation', '', 0);

-- --------------------------------------------------------

--
-- Table structure for table `doctor_table`
--

CREATE TABLE `doctor_table` (
  `s_no` int(5) NOT NULL,
  `doctor_id` varchar(50) NOT NULL,
  `password` varchar(13) NOT NULL,
  `doctor_name` varchar(50) NOT NULL,
  `doctor_email` varchar(50) NOT NULL,
  `doctor_specification` varchar(50) NOT NULL,
  `doctor_mobilenumber` varchar(10) NOT NULL,
  `doctor_qualification` varchar(50) NOT NULL,
  `doctor_experience` varchar(50) NOT NULL,
  `doctor_education` varchar(50) NOT NULL,
  `doctor_location` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `doctor_table`
--

INSERT INTO `doctor_table` (`s_no`, `doctor_id`, `password`, `doctor_name`, `doctor_email`, `doctor_specification`, `doctor_mobilenumber`, `doctor_qualification`, `doctor_experience`, `doctor_education`, `doctor_location`) VALUES
(15, '112230012', 'welcome', 'Dr. Prasna S', 'sprasna7@gmail.com', 'General Surgery', '9582299096', 'MBBS,MS', '2 Years', 'SMC,SRMC', 'Saveetha Hospital,Chennai');

-- --------------------------------------------------------

--
-- Table structure for table `patient_table`
--

CREATE TABLE `patient_table` (
  `s_no` int(5) NOT NULL,
  `patient_id` int(20) NOT NULL,
  `patient_name` varchar(50) NOT NULL,
  `patient_password` varchar(25) NOT NULL,
  `patient_reenter_password` varchar(50) NOT NULL,
  `patient_age` int(5) NOT NULL,
  `patient_email` varchar(50) NOT NULL,
  `patient_mobile_number` varchar(12) NOT NULL,
  `patient_gender` varchar(50) NOT NULL,
  `marital_status` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `patient_table`
--

INSERT INTO `patient_table` (`s_no`, `patient_id`, `patient_name`, `patient_password`, `patient_reenter_password`, `patient_age`, `patient_email`, `patient_mobile_number`, `patient_gender`, `marital_status`) VALUES
(36, 19, 'Rohit', '004', '004', 20, 'rohitshankar827@gmail.com', '8778393218', 'Male', 'No Marriage'),
(116, 443, 'Kiruba', '', '', 45, 'kiruba@gmail.com', '9876543210', 'Male', '');

-- --------------------------------------------------------

--
-- Table structure for table `profile_photo`
--

CREATE TABLE `profile_photo` (
  `s_no` int(5) NOT NULL,
  `name` longtext CHARACTER SET utf8mb4 COLLATE utf8mb4_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `checkboxes_values`
--
ALTER TABLE `checkboxes_values`
  ADD PRIMARY KEY (`s_no`),
  ADD KEY `fk_patient_id` (`patient_id`);

--
-- Indexes for table `doctor_table`
--
ALTER TABLE `doctor_table`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `patient_table`
--
ALTER TABLE `patient_table`
  ADD PRIMARY KEY (`patient_id`),
  ADD UNIQUE KEY `s_no` (`s_no`);

--
-- Indexes for table `profile_photo`
--
ALTER TABLE `profile_photo`
  ADD PRIMARY KEY (`s_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `checkboxes_values`
--
ALTER TABLE `checkboxes_values`
  MODIFY `s_no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `doctor_table`
--
ALTER TABLE `doctor_table`
  MODIFY `s_no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patient_table`
--
ALTER TABLE `patient_table`
  MODIFY `s_no` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=117;

--
-- AUTO_INCREMENT for table `profile_photo`
--
ALTER TABLE `profile_photo`
  MODIFY `s_no` int(5) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
