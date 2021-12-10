-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2019 at 03:30 PM
-- Server version: 10.1.36-MariaDB
-- PHP Version: 7.2.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sua_appeal`
--

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `stud_reg_no` varchar(40) NOT NULL,
  `comment` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`id`, `user_id`, `stud_reg_no`, `comment`) VALUES
(7, 1, 'CIT/D/2017/0044', 'This book will be used by Agricultural extension workers, Researchers, Managers, Teachers and Students in degree/diploma courses at Universities and Agricultural'),
(9, 1, 'CIT/D/2017/0013', 'Agricultural extension workers, Researchers, Managers, Teachers and Students in degree/diploma courses at Universities and Agricultural'),
(11, 2, 'CIT/D/2017/0044', 'This book will be used by Agricultural extension workers, Researchers and Managers.'),
(12, 2, 'CIT/D/2017/0013', 'Teachers and Students in degree/diploma courses at Universities and Agricultural'),
(18, 1, 'DIT/E/2016/0108', 'Testing................................'),
(19, 2, 'DIT/E/2016/0108', 'Testing........22222222222222222222222'),
(20, 3, 'DIT/E/2016/0108', 'Testing........33333333333333333333333'),
(21, 4, 'DIT/E/2016/0108', 'Testing complete............................!!!!!!!!!!!!!!!\r\n with no documents');

-- --------------------------------------------------------

--
-- Table structure for table `comment_doc`
--

CREATE TABLE `comment_doc` (
  `id` int(11) NOT NULL,
  `comment_id` int(11) NOT NULL,
  `document` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `comment_doc`
--

INSERT INTO `comment_doc` (`id`, `comment_id`, `document`) VALUES
(3, 7, 'admission1.pdf'),
(4, 9, 'admission.pdf'),
(5, 11, 'developer.jpg'),
(6, 12, 'php-code.jpg'),
(10, 19, 'developer1.jpg'),
(11, 19, 'php-code1.jpg'),
(12, 20, 'developer2.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `form`
--

CREATE TABLE `form` (
  `id` int(11) NOT NULL,
  `stud_reg_no` varchar(40) NOT NULL,
  `appeal_against` varchar(40) NOT NULL,
  `appeal_reason` varchar(40) NOT NULL,
  `reason_summary` text NOT NULL,
  `date` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form`
--

INSERT INTO `form` (`id`, `stud_reg_no`, `appeal_against`, `appeal_reason`, `reason_summary`, `date`) VALUES
(1, 'CIT/D/2016/0024', 'Result', 'Academic', 'This is reason appeal summary', 1538580498),
(2, 'CIT/D/2017/0013', 'Result', 'Social', 'I passed my examination', 1538580765),
(3, 'DIT/D/2016/0121', 'Repeating a year of study', 'Academic', 'Under the General University Examination Regulation No. 20.1, a candidate is allowed to appeal against examination results within one academic unit from the date of publication of results. Much as it is the right of every candidate to appeal against examination results, the following procedure will be followed in loging appeals against examination results.', 1538942026),
(4, 'DIT/E/2016/0108', 'Discontinuation', 'Academic', 'This is reason appeal summary', 1539099136),
(5, 'DIT/E/2016/0102', 'Repeating a year of study', 'Academic', 'This is reason appeal summary', 1539099649),
(6, 'CIT/E/2016/0052', 'Discontinuation', 'Social', 'This is reason appeal summary', 1539769630),
(7, 'CIT/E/2016/0050', 'Discontinuation', 'Medical', 'This is reason appeal summary', 1539804317),
(8, 'CIT/D/2017/0044', 'Supplementing', 'Medical', 'This is reason appeal summary', 1539848616),
(9, 'CIT/D/2017/0035', 'Supplementing', 'Social', 'This is reason appeal summary', 1539893159),
(10, 'DIT/E/2016/0086', 'Repeating a year of study', 'Medical', 'This is reason appeal summary', 1539970029),
(11, 'DIT/E/2016/0119', 'Discontinuation', 'Others', 'This is reason appeal summary', 1539972803),
(12, 'EGM/D/2016/0013', 'Result', 'Others', 'This is reason appeal summary', 1540046288),
(13, 'CIT/D/2016/0024', 'Supplementing', 'Medical', 'This is reason appeal summary', 1540101559);

-- --------------------------------------------------------

--
-- Table structure for table `form_doc`
--

CREATE TABLE `form_doc` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `document` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `form_doc`
--

INSERT INTO `form_doc` (`id`, `form_id`, `document`) VALUES
(1, 1, 'Pay Slip.jpg'),
(2, 1, 'examticket.pdf'),
(3, 2, 'Pay Slip.jpg'),
(4, 2, 'examticket.pdf'),
(5, 3, 'Pay Slip.jpg'),
(6, 3, 'examticket.pdf'),
(7, 4, 'Pay Slip.jpg'),
(8, 4, 'examticket.pdf'),
(9, 5, 'Pay Slip.jpg'),
(10, 5, 'examticket.pdf'),
(11, 6, 'Pay Slip.jpg'),
(12, 6, 'examticket.pdf'),
(13, 7, 'Pay Slip.jpg'),
(14, 7, 'examticket.pdf'),
(15, 8, 'Pay Slip.jpg'),
(16, 8, 'examticket.pdf'),
(17, 9, 'Pay Slip.jpg'),
(18, 9, 'examticket.pdf'),
(19, 10, 'Pay Slip.jpg'),
(20, 10, 'examticket.pdf'),
(21, 11, 'Pay Slip.jpg'),
(22, 11, 'examticket.pdf'),
(23, 12, 'Pay Slip.jpg'),
(24, 12, 'examticket.pdf'),
(25, 13, 'Pay Slip.jpg'),
(26, 13, 'examticket.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `progress`
--

CREATE TABLE `progress` (
  `id` int(11) NOT NULL,
  `form_id` int(11) NOT NULL,
  `academic_advisor` int(2) NOT NULL,
  `head_department` int(2) NOT NULL,
  `dean_faculty` int(2) NOT NULL,
  `dean_students` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `progress`
--

INSERT INTO `progress` (`id`, `form_id`, `academic_advisor`, `head_department`, `dean_faculty`, `dean_students`) VALUES
(7, 8, 1, 1, 0, 0),
(9, 2, 1, 1, 0, 0),
(26, 4, 1, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `f_name` varchar(40) NOT NULL,
  `m_name` varchar(40) NOT NULL,
  `s_name` varchar(40) NOT NULL,
  `sex` varchar(6) NOT NULL,
  `reg_no` varchar(40) NOT NULL,
  `exm_no` varchar(40) NOT NULL,
  `programme` varchar(40) NOT NULL,
  `start_year` int(4) NOT NULL,
  `end_year` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`f_name`, `m_name`, `s_name`, `sex`, `reg_no`, `exm_no`, `programme`, `start_year`, `end_year`) VALUES
('Isaka', 'Z', 'Mabagala', 'M', 'CIT/D/2016/0024', 'CIT2736836', 'CIT', 2016, 2017),
('Wende', 'Gaitan', 'Lupenza', 'F', 'CIT/D/2017/0013', 'CIT2736836', 'CIT', 2017, 2018),
('Judith', 'Silayo', 'Albin', 'F', 'CIT/D/2017/0035', 'CIT2736836', 'CIT', 2016, 2018),
('Elias', 'Elvin', 'Mrindoko', 'M', 'CIT/D/2017/0044', 'CIT2736836', 'CIT', 2017, 2018),
('Lydia', '', 'Nagabona', 'F', 'CIT/E/2016/0050', 'CIT2736836', 'CIT', 2016, 2017),
('Noreen', '', 'Emanuel', 'F', 'CIT/E/2016/0052', 'CIT2736836', 'CIT', 2016, 2017),
('Kelvin', 'Denis', 'Lymo', 'M', 'DIT/D/2016/0121', 'DIT2736836', 'DIT', 2016, 2018),
('Onesmo', '', 'Joseph', 'M', 'DIT/E/2016/0086', 'DIT2736836', 'DIT', 2016, 2018),
('Patric', 'P', 'Nachenga', 'M', 'DIT/E/2016/0102', 'DIT2736836', 'DIT', 2016, 2018),
('Catherine', 'Candidus', 'Kulaya', 'F', 'DIT/E/2016/0108', 'DIT2736836', 'DIT', 2016, 2018),
('Prisca', 'K', 'Johnson', 'F', 'DIT/E/2016/0119', 'DIT2736836', 'DIT', 2016, 2018),
('Beni', '', 'Elieza', 'M', 'EGM/D/2016/0013', 'EGM2736836', 'EGM', 2016, 2019);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `f_name` varchar(40) NOT NULL,
  `s_name` varchar(40) NOT NULL,
  `position` varchar(40) NOT NULL,
  `email` varchar(40) NOT NULL,
  `image` varchar(40) NOT NULL,
  `password` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `f_name`, `s_name`, `position`, `email`, `image`, `password`) VALUES
(1, 'Kelvin', 'Denis', 'Academic Advisor', 'kelvindenis@suanet.co.tz', '20180917_165055.jpg', 'MTIzNDU2'),
(2, 'Emmanuel', 'Deusdedit', 'Head of Department', 'emmanueldeusdedit@suanet.co.tz', '20180719_160343.jpg', 'MTIzNDU2'),
(3, 'Jabir', 'Jabir', 'Dean of the Faculty', 'jabirjabir@suanet.co.tz', 'mr_-jabir.jpg', 'MTIzNDU2'),
(4, 'Isaka', 'Mabagala', 'Dean of Students', 'isakamabagala@suanet.co.tz', '20181210_104609.jpg', 'MTIzNDU2');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `stud_reg_no` (`stud_reg_no`);

--
-- Indexes for table `comment_doc`
--
ALTER TABLE `comment_doc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `comment_id` (`comment_id`);

--
-- Indexes for table `form`
--
ALTER TABLE `form`
  ADD PRIMARY KEY (`id`),
  ADD KEY `stud_reg_no` (`stud_reg_no`);

--
-- Indexes for table `form_doc`
--
ALTER TABLE `form_doc`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `progress`
--
ALTER TABLE `progress`
  ADD PRIMARY KEY (`id`),
  ADD KEY `form_id` (`form_id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`reg_no`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `comment_doc`
--
ALTER TABLE `comment_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `form`
--
ALTER TABLE `form`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `form_doc`
--
ALTER TABLE `form_doc`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `progress`
--
ALTER TABLE `progress`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comments`
--
ALTER TABLE `comments`
  ADD CONSTRAINT `comments_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `comments_ibfk_2` FOREIGN KEY (`stud_reg_no`) REFERENCES `students` (`reg_no`);

--
-- Constraints for table `comment_doc`
--
ALTER TABLE `comment_doc`
  ADD CONSTRAINT `comment_doc_ibfk_1` FOREIGN KEY (`comment_id`) REFERENCES `comments` (`id`);

--
-- Constraints for table `form`
--
ALTER TABLE `form`
  ADD CONSTRAINT `form_ibfk_1` FOREIGN KEY (`stud_reg_no`) REFERENCES `students` (`reg_no`);

--
-- Constraints for table `form_doc`
--
ALTER TABLE `form_doc`
  ADD CONSTRAINT `form_doc_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`);

--
-- Constraints for table `progress`
--
ALTER TABLE `progress`
  ADD CONSTRAINT `progress_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `form` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
