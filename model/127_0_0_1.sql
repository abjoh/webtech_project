-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 21, 2026 at 05:24 PM
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
-- Database: `ums`
--
CREATE DATABASE IF NOT EXISTS `ums` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `ums`;

-- --------------------------------------------------------

--
-- Table structure for table `courses`
--

CREATE TABLE `courses` (
  `course_id` int(11) NOT NULL,
  `course_name` varchar(50) NOT NULL,
  `section` varchar(5) NOT NULL,
  `time` varchar(10) NOT NULL,
  `day` varchar(10) NOT NULL,
  `room` varchar(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_assignment`
--

CREATE TABLE `course_assignment` (
  `section` varchar(5) NOT NULL,
  `time` varchar(11) NOT NULL,
  `course_id` int(11) NOT NULL,
  `day` varchar(10) NOT NULL,
  `room` varchar(8) NOT NULL,
  `faculty_id` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_assignment`
--

INSERT INTO `course_assignment` (`section`, `time`, `course_id`, `day`, `room`, `faculty_id`) VALUES
('c', '1pm', 5, 'saturday', '555', ''),
('c', '1pm', 5, 'saturday', '555', ''),
('c', '1pm', 5, 'saturday', '555', ''),
('c', '1pm', 5, 'saturday', '555', ''),
('c', '1pm', 5, 'saturday', '555', ''),
('c', '1pm', 5, 'saturday', '555', ''),
('L', '11:00am-12', 5566, 'Sunday', '4478', 'f_1'),
('G', '9:30am-11:', 4456, 'Sunday', '4489', 'f_2');

-- --------------------------------------------------------

--
-- Table structure for table `enrolled_students`
--

CREATE TABLE `enrolled_students` (
  `student_id` varchar(50) NOT NULL,
  `course_id` varchar(10) NOT NULL,
  `section` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `enrolled_students`
--

INSERT INTO `enrolled_students` (`student_id`, `course_id`, `section`) VALUES
('abrar', '5', 'c'),
('abrar', '5', 'c'),
('s_1', '5566', 'L'),
('s_1', '4456', 'G');

-- --------------------------------------------------------

--
-- Table structure for table `marks`
--

CREATE TABLE `marks` (
  `course_id` int(100) NOT NULL,
  `quiz1` int(50) NOT NULL,
  `quiz2` int(50) NOT NULL,
  `mid` int(50) NOT NULL,
  `final` varchar(10) NOT NULL,
  `grade` varchar(10) NOT NULL,
  `student_id` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `marks`
--

INSERT INTO `marks` (`course_id`, `quiz1`, `quiz2`, `mid`, `final`, `grade`, `student_id`) VALUES
(5566, 14, 40, 14, '41', 'C+', 's_1'),
(5566, 14, 40, 14, '41', 'C+', 's_1'),
(5566, 14, 40, 14, '41', 'C+', 's_1');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_name` text NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `role` varchar(100) NOT NULL,
  `status` varchar(20) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `blood_group` varchar(4) NOT NULL,
  `department` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_name`, `email`, `password`, `role`, `status`, `user_id`, `blood_group`, `department`) VALUES
('mir', 'mir@gmail.com', '4567', 'admin', 'active', 'a_1', '', ''),
('tihan', 'abrarjohan1234@gmail.com', 'asdasd', 'faculty', '', 'f_1', 'O-', 'CSE'),
('johan', 'abrarjohan123@gmail.com', 'abr', 'faculty', '', 'f_2', 'A-', 'CSE'),
('shiju', 'shiju4568@gmail.com', 'lkj', 'student', '', 's_1', 'A-', 'CSE'),
('mehedi', 'mehedi123@gmail.com', '5621', 'student', '', 's_2', '', 'EEE');

--
-- Triggers `users`
--
DELIMITER $$
CREATE TRIGGER `before_user_insert` BEFORE INSERT ON `users` FOR EACH ROW BEGIN
    DECLARE next_id INT;

    -- Find the current maximum number for the role
    SELECT IFNULL(MAX(CAST(SUBSTRING(user_id, 3) AS UNSIGNED)), 0) + 1
    INTO next_id
    FROM users
    WHERE role = NEW.role;

    -- Assign the prefixed user_id
    IF NEW.role = 'student' THEN
        SET NEW.user_id = CONCAT('s_', next_id);
    ELSEIF NEW.role = 'faculty' THEN
        SET NEW.user_id = CONCAT('f_', next_id);
    ELSEIF NEW.role = 'admin' THEN
        SET NEW.user_id = CONCAT('a_', next_id);
    END IF;
END
$$
DELIMITER ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `courses`
--
ALTER TABLE `courses`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `course_assignment`
--
ALTER TABLE `course_assignment`
  ADD KEY `course_id` (`course_id`);

--
-- Indexes for table `marks`
--
ALTER TABLE `marks`
  ADD KEY `course_id` (`course_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `courses`
--
ALTER TABLE `courses`
  MODIFY `course_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5567;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
