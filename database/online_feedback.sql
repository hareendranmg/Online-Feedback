-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Apr 30, 2020 at 01:45 PM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.2.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `online_feedback`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  PRIMARY KEY (`admin_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_id`, `username`, `password`) VALUES
(1, 'admin', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `answers`
--

DROP TABLE IF EXISTS `answers`;
CREATE TABLE IF NOT EXISTS `answers` (
  `answer_id` int(11) NOT NULL AUTO_INCREMENT,
  `student_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `faculty_id` int(11) NOT NULL,
  `qn_id` int(11) NOT NULL,
  `answer` int(11) NOT NULL,
  `answered_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  PRIMARY KEY (`answer_id`)
) ENGINE=InnoDB AUTO_INCREMENT=49 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `answers`
--

INSERT INTO `answers` (`answer_id`, `student_id`, `department_id`, `faculty_id`, `qn_id`, `answer`, `answered_time`) VALUES
(1, 1, 1, 1, 1, 1, '2020-04-02 07:16:13'),
(2, 1, 1, 1, 2, 1, '2020-04-02 07:16:13'),
(3, 1, 1, 1, 3, 1, '2020-04-02 07:16:13'),
(4, 1, 1, 1, 4, 1, '2020-04-02 07:16:13'),
(5, 2, 1, 1, 1, 5, '2020-04-02 07:18:20'),
(6, 2, 1, 1, 2, 5, '2020-04-02 07:18:20'),
(7, 2, 1, 1, 3, 5, '2020-04-02 07:18:20'),
(8, 2, 1, 1, 4, 5, '2020-04-02 07:18:20'),
(9, 3, 1, 1, 1, 4, '2020-04-04 16:53:48'),
(10, 3, 1, 1, 2, 2, '2020-04-04 16:53:48'),
(11, 3, 1, 1, 3, 3, '2020-04-04 16:53:48'),
(12, 3, 1, 1, 4, 1, '2020-04-04 16:53:48'),
(13, 3, 1, 2, 1, 4, '2020-04-05 11:17:46'),
(14, 3, 1, 2, 2, 5, '2020-04-05 11:17:46'),
(15, 3, 1, 2, 3, 5, '2020-04-05 11:17:46'),
(16, 3, 1, 2, 4, 5, '2020-04-05 11:17:46'),
(17, 3, 1, 3, 1, 4, '2020-04-05 11:18:27'),
(18, 3, 1, 3, 2, 5, '2020-04-05 11:18:27'),
(19, 3, 1, 3, 3, 5, '2020-04-05 11:18:27'),
(20, 3, 1, 3, 4, 5, '2020-04-05 11:18:27'),
(21, 4, 1, 1, 1, 1, '2020-04-05 11:20:17'),
(22, 4, 1, 1, 2, 2, '2020-04-05 11:20:17'),
(23, 4, 1, 1, 3, 1, '2020-04-05 11:20:17'),
(24, 4, 1, 1, 4, 1, '2020-04-05 11:20:18'),
(25, 4, 1, 2, 1, 4, '2020-04-05 11:22:42'),
(26, 4, 1, 2, 2, 5, '2020-04-05 11:22:42'),
(27, 4, 1, 2, 3, 5, '2020-04-05 11:22:42'),
(28, 4, 1, 2, 4, 5, '2020-04-05 11:22:43'),
(29, 4, 1, 3, 1, 5, '2020-04-05 11:23:13'),
(30, 4, 1, 3, 2, 5, '2020-04-05 11:23:13'),
(31, 4, 1, 3, 3, 5, '2020-04-05 11:23:13'),
(32, 4, 1, 3, 4, 5, '2020-04-05 11:23:13'),
(33, 6, 2, 13, 1, 4, '2020-04-05 11:37:58'),
(34, 6, 2, 13, 2, 5, '2020-04-05 11:37:58'),
(35, 6, 2, 13, 3, 4, '2020-04-05 11:37:58'),
(36, 6, 2, 13, 4, 5, '2020-04-05 11:37:58'),
(37, 6, 2, 14, 1, 5, '2020-04-05 11:41:17'),
(38, 6, 2, 14, 2, 5, '2020-04-05 11:41:18'),
(39, 6, 2, 14, 3, 5, '2020-04-05 11:41:18'),
(40, 6, 2, 14, 4, 5, '2020-04-05 11:41:18'),
(41, 9, 2, 13, 1, 1, '2020-04-05 11:42:14'),
(42, 9, 2, 13, 2, 5, '2020-04-05 11:42:14'),
(43, 9, 2, 13, 3, 5, '2020-04-05 11:42:14'),
(44, 9, 2, 13, 4, 1, '2020-04-05 11:42:14'),
(45, 1, 1, 2, 1, 5, '2020-04-30 13:40:56'),
(46, 1, 1, 2, 2, 4, '2020-04-30 13:40:56'),
(47, 1, 1, 2, 3, 4, '2020-04-30 13:40:56'),
(48, 1, 1, 2, 4, 3, '2020-04-30 13:40:56');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

DROP TABLE IF EXISTS `department`;
CREATE TABLE IF NOT EXISTS `department` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `name`) VALUES
(1, 'Computer Engineering'),
(2, 'Civil Engineering'),
(3, 'Mechanical Engineering'),
(4, 'Electronics Engineering');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

DROP TABLE IF EXISTS `faculty`;
CREATE TABLE IF NOT EXISTS `faculty` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(30) NOT NULL,
  `emp_code` int(10) NOT NULL,
  `department_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `mobile` bigint(20) NOT NULL,
  `image` varchar(500) NOT NULL DEFAULT '../img/no_image.jpg',
  PRIMARY KEY (`id`),
  UNIQUE KEY `emp_code` (`emp_code`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`id`, `name`, `emp_code`, `department_id`, `email`, `mobile`, `image`) VALUES
(1, 'Mohanan', 100001, 1, 'mohanan@gmail.com', 1231231233, '../img/100001_faculty.jpg'),
(2, 'Shaiju', 100002, 1, 'khh@sds.dgs', 1111111110, '../img/999222.jpg'),
(3, 'Manoj', 100003, 1, 'stud1@gmail.com', 9999999999, '../img/545457.jpg'),
(4, 'Prashanth', 100004, 1, 'jg@ee.rg', 6688688787, '../img/no_image.jpg'),
(5, 'Gopakumar', 100005, 1, 'll@ll.ck', 1111111111, '../img/000000.jpg'),
(13, 'civil1', 200001, 2, 'stud1@gmail.com', 9999999999, '../img/no_image.jpg'),
(14, 'civil2', 200002, 2, 'civil@gmail.com', 9876543210, '../img/no_image.jpg'),
(15, 'civil3', 200003, 2, 'civil@gmail.com', 9876543210, '../img/no_image.jpg'),
(16, 'civil4', 200004, 2, 'civil@gmail.com', 9876543210, '../img/no_image.jpg'),
(17, 'civil5', 200005, 2, 'civil@gmail.com', 9876543210, '../img/no_image.jpg'),
(18, 'mech1', 300001, 3, 'mech@gmail.com', 9876543210, '../img/no_image.jpg'),
(19, 'mech2', 300002, 3, 'mech@gmail.com', 9876543210, '../img/no_image.jpg'),
(20, 'mech3', 300003, 3, 'mech@gmail.com', 9876543210, '../img/no_image.jpg'),
(21, 'mech4', 300004, 3, 'mech@gmail.com', 9876543210, '../img/no_image.jpg'),
(22, 'mech5', 300005, 3, 'mech@gmail.com', 9876543210, '../img/no_image.jpg'),
(23, 'elect1', 400001, 4, 'elect@gmail.com', 9876543210, '../img/no_image.jpg'),
(24, 'elect2', 400002, 4, 'elect@gmail.com', 9876543210, '../img/no_image.jpg'),
(25, 'elect3', 400003, 4, 'elect@gmail.com', 9876543210, '../img/no_image.jpg'),
(26, 'elect4', 400004, 4, 'elect@gmail.com', 9876543210, '../img/no_image.jpg'),
(27, 'elect5', 400005, 4, 'elect@gmail.com', 9876543210, '../img/no_image.jpg'),
(28, 'jhhhhgghghjjjjjjj', 10101, 3, 'hareendran.keltron@gmail.com', 202020202, '../img/010101.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

DROP TABLE IF EXISTS `grades`;
CREATE TABLE IF NOT EXISTS `grades` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `name`) VALUES
(1, 'Poor'),
(2, 'Average'),
(3, 'Good'),
(4, 'Very Good'),
(5, 'Excellent');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

DROP TABLE IF EXISTS `questions`;
CREATE TABLE IF NOT EXISTS `questions` (
  `qn_id` int(11) NOT NULL AUTO_INCREMENT,
  `qn_name` varchar(500) NOT NULL,
  PRIMARY KEY (`qn_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`qn_id`, `qn_name`) VALUES
(1, 'Teacher is good at explaining subject?'),
(2, 'Teacher is punctual?'),
(3, 'Teacher regularly takes class?'),
(4, 'Teacher clears doubt?');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

DROP TABLE IF EXISTS `semester`;
CREATE TABLE IF NOT EXISTS `semester` (
  `id` int(11) NOT NULL,
  `name` varchar(250) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `name`) VALUES
(1, 'First Semester'),
(2, 'Second Semester'),
(3, 'Third Semester'),
(4, 'Fourth Semester'),
(5, 'Fifth Semester'),
(6, 'Sixth Semester');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

DROP TABLE IF EXISTS `student`;
CREATE TABLE IF NOT EXISTS `student` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` char(40) NOT NULL,
  `gender` int(11) NOT NULL,
  `email` varchar(40) NOT NULL,
  `mobile` bigint(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `semester_id` int(10) NOT NULL,
  `image` varchar(50) NOT NULL DEFAULT '../img/no_image.jpg',
  `dob` date NOT NULL,
  `regid` int(11) NOT NULL,
  `feedback_submitted` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  UNIQUE KEY `regid` (`regid`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `gender`, `email`, `mobile`, `department_id`, `semester_id`, `image`, `dob`, `regid`, `feedback_submitted`) VALUES
(1, 'com_stud_1', 1, 'stud@gmail.com', 9876543210, 1, 1, '../img/100001.jpg', '2000-01-01', 100001, 1),
(2, 'com_stud_2', 1, 'stud@gmail.com', 9876543210, 1, 1, '../img/no_image.jpg', '2000-01-01', 100002, 0),
(3, 'com_stud_3', 1, 'stud@gmail.com', 9876543210, 1, 1, '../img/no_image.jpg', '2000-01-01', 100003, 0),
(4, 'com_stud_4', 1, 'stud@gmail.com', 9876543210, 1, 1, '../img/no_image.jpg', '2000-01-01', 100004, 0),
(5, 'com_stud_5', 1, 'stud@gmail.com', 9876543210, 1, 1, '../img/no_image.jpg', '2000-01-01', 100005, 0),
(6, 'civil_stud_1', 1, 'stud@gmail.com', 9876543210, 2, 1, '../img/no_image.jpg', '2000-01-01', 200001, 0),
(9, 'civil_stud_2', 1, 'stud@gmail.com', 9876543210, 2, 1, '../img/no_image.jpg', '2000-01-01', 200002, 0),
(10, 'civil_stud_3', 1, 'stud@gmail.com', 9876543210, 2, 1, '../img/no_image.jpg', '2000-01-01', 200003, 0),
(11, 'civil_stud_4', 1, 'stud@gmail.com', 9876543210, 2, 1, '../img/no_image.jpg', '2000-01-01', 200004, 0),
(12, 'civil_stud_5', 1, 'stud@gmail.com', 9876543210, 2, 1, '../img/no_image.jpg', '2000-01-01', 200005, 0),
(13, 'mech_stud_1', 1, 'stud@gmail.com', 9876543210, 3, 1, '../img/no_image.jpg', '2000-01-01', 300001, 0),
(14, 'mech_stud_2', 1, 'stud@gmail.com', 9876543210, 3, 1, '../img/no_image.jpg', '2000-01-01', 300002, 0),
(15, 'mech_stud_3', 1, 'stud@gmail.com', 9876543210, 3, 1, '../img/no_image.jpg', '2000-01-01', 300003, 0),
(16, 'mech_stud_4', 1, 'stud@gmail.com', 9876543210, 3, 1, '../img/no_image.jpg', '2000-01-01', 300004, 0),
(17, 'mech_stud_5', 1, 'stud@gmail.com', 9876543210, 3, 1, '../img/no_image.jpg', '2000-01-01', 300005, 0),
(18, 'elect_stud_1', 1, 'stud@gmail.com', 9876543210, 4, 1, '../img/no_image.jpg', '2000-01-01', 400001, 0),
(19, 'elect_stud_2', 1, 'stud@gmail.com', 9876543210, 4, 1, '../img/no_image.jpg', '2000-01-01', 400002, 0),
(20, 'elect_stud_3', 1, 'stud@gmail.com', 9876543210, 4, 1, '../img/no_image.jpg', '2000-01-01', 400003, 0),
(21, 'elect_stud_4', 1, 'stud@gmail.com', 9876543210, 4, 1, '../img/no_image.jpg', '2000-01-01', 400004, 0),
(22, 'elect_stud_5', 1, 'stud@gmail.com', 9876543210, 4, 1, '../img/no_image.jpg', '2000-01-01', 400005, 0),
(23, 'com_stud_6', 2, 'stud@gmail.com', 9876543210, 1, 1, '../img/765454.jpg', '2019-02-27', 765454, 0),
(24, 'jhvhjv hchf bcc', 2, 'hjvgj@jvh.bbbbbbbb', 201201522, 3, 3, '../img/321232.jpg', '2021-05-31', 321232, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `student`
--
ALTER TABLE `student` ADD FULLTEXT KEY `name` (`name`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
