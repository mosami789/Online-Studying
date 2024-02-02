-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 02, 2024 at 10:07 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cee_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_acc`
--

CREATE TABLE `admin_acc` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(250) NOT NULL,
  `admin_user` varchar(1000) NOT NULL,
  `admin_pass` varchar(1000) NOT NULL,
  `admin_img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin_acc`
--

INSERT INTO `admin_acc` (`admin_id`, `admin_name`, `admin_user`, `admin_pass`, `admin_img`) VALUES
(1, 'Mohamed Sami', 'mosami', 'admin', '71537faa0df6c81e.png');

-- --------------------------------------------------------

--
-- Table structure for table `assi_answers`
--

CREATE TABLE `assi_answers` (
  `order_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `assi_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question_answer` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assi_answers`
--

INSERT INTO `assi_answers` (`order_id`, `stu_id`, `assi_id`, `question_id`, `question_answer`) VALUES
(29, 4, 2, 2, '20'),
(30, 4, 2, 4, 'Dennis Ritchie & Ken Thompson'),
(31, 4, 2, 12, 'd'),
(32, 4, 2, 14, 'qwew'),
(33, 23, 2, 2, '20'),
(34, 23, 2, 4, 'Steve Case & Jeff Bezos'),
(35, 23, 2, 12, 'd'),
(36, 23, 2, 14, 'qwew');

-- --------------------------------------------------------

--
-- Table structure for table `assi_check`
--

CREATE TABLE `assi_check` (
  `order_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `assi_id` int(11) NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assi_check`
--

INSERT INTO `assi_check` (`order_id`, `stu_id`, `assi_id`, `created_time`) VALUES
(9, 4, 2, '2023-05-04 20:07:42'),
(10, 23, 2, '2023-05-05 03:51:57');

-- --------------------------------------------------------

--
-- Table structure for table `assi_question_header`
--

CREATE TABLE `assi_question_header` (
  `que_id` int(11) NOT NULL,
  `title` text NOT NULL,
  `assi_id` int(11) NOT NULL,
  `que_text` text NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assi_question_header`
--

INSERT INTO `assi_question_header` (`que_id`, `title`, `assi_id`, `que_text`, `img`) VALUES
(1, 'Choose from the given answers', 2, '2.2.1. Test facility means the persons, premises and operational unit(s) that are necessary for conducting the non-clinical health and environmental safety study. For multi-site studies, those which are conducted at more than one site, the test facility comprises the site at which the Study Director is located and all individual test sites, which individually or collectively can be considered to be test facilities.\r\n', '160bd88f57094239.png'),
(8, 'test124', 3, 'test', '8b465d62c4e03aff.png'),
(9, 'ttest', 3, '', '4559a752603806da.PNG'),
(10, 'xx', 2, 'xx', '6a8d81adc3f74a79.png');

-- --------------------------------------------------------

--
-- Table structure for table `assi_question_tbl`
--

CREATE TABLE `assi_question_tbl` (
  `que_assi_id` int(10) NOT NULL,
  `assi_id` int(10) NOT NULL,
  `assi_que` varchar(10000) NOT NULL,
  `assi_ch1` varchar(1000) NOT NULL,
  `assi_ch2` varchar(1000) NOT NULL,
  `assi_ch3` varchar(1000) NOT NULL,
  `assi_ch4` varchar(1000) NOT NULL,
  `assI_qu_asnwer` varchar(1000) NOT NULL,
  `assi_header` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assi_question_tbl`
--

INSERT INTO `assi_question_tbl` (`que_assi_id`, `assi_id`, `assi_que`, `assi_ch1`, `assi_ch2`, `assi_ch3`, `assi_ch4`, `assI_qu_asnwer`, `assi_header`) VALUES
(2, 2, '2+10', '12', '20', '30', '50', '12', 1),
(4, 2, 'Who developed Yahoo?', 'Dennis Ritchie & Ken Thompson', 'David Filo & Jerry Yang', 'Vint Cerf & Robert Kahn', 'Steve Case & Jeff Bezos', 'David Filo & Jerry Yang', 1),
(12, 2, 'x', 's', 'd', 'd', 's', 'd', 1),
(14, 2, 'ewqe', 'qwew', 'qwqewq', 'eweqw', 'ewqeqw', 'eweqw', 10),
(15, 3, 'xx', 'xx', 'xxx', 'xx', 'xx', 'xxx', 9),
(16, 3, 'xz', 'zxzxz', 'xzxzx', 'zxzxzx', 'zxzxzx', 'zxzxzx', 8);

-- --------------------------------------------------------

--
-- Table structure for table `assi_tbl`
--

CREATE TABLE `assi_tbl` (
  `assi_id` int(255) NOT NULL,
  `assi_name` varchar(1000) NOT NULL,
  `cou_id` int(11) NOT NULL,
  `assi_description` varchar(1000) NOT NULL,
  `assi_deadline` timestamp NOT NULL DEFAULT current_timestamp(),
  `assi_created` datetime NOT NULL DEFAULT current_timestamp(),
  `post` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `assi_tbl`
--

INSERT INTO `assi_tbl` (`assi_id`, `assi_name`, `cou_id`, `assi_description`, `assi_deadline`, `assi_created`, `post`) VALUES
(2, 'test123', 132, 'ddd', '2023-05-26 22:00:00', '2023-03-30 03:08:21', 'yes'),
(3, 'Test 1', 132, '1111', '2023-05-01 01:06:24', '2023-03-30 03:41:49', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `course_check`
--

CREATE TABLE `course_check` (
  `coustu_id` int(255) NOT NULL,
  `student_id` int(255) NOT NULL,
  `course_id` int(255) NOT NULL,
  `joining_time` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course_check`
--

INSERT INTO `course_check` (`coustu_id`, `student_id`, `course_id`, `joining_time`) VALUES
(5, 5, 132, '2023-04-12'),
(6, 6, 132, '2023-04-12'),
(7, 7, 132, '2023-04-12'),
(8, 8, 132, '2023-04-12'),
(9, 10, 231, '2023-04-12'),
(14, 18, 231, '2023-04-12'),
(24, 8, 231, '2023-04-12'),
(25, 8, 232, '2023-04-12'),
(26, 8, 230, '2023-04-12'),
(27, 18, 232, '2023-04-12'),
(28, 18, 230, '2023-04-12'),
(30, 7, 230, '2023-04-12'),
(31, 7, 232, '2023-04-12'),
(40, 20, 230, '2023-04-12'),
(41, 20, 231, '2023-04-12'),
(42, 20, 232, '2023-04-12'),
(43, 20, 132, '2023-04-12'),
(60, 23, 132, '2023-04-12'),
(68, 23, 230, '2023-04-21'),
(69, 23, 231, '2023-04-21'),
(71, 24, 132, '2023-04-23'),
(74, 234, 132, '2023-04-29'),
(86, 23, 233, '2023-05-01'),
(87, 23, 232, '2023-05-01'),
(102, 26, 132, '2023-05-03'),
(103, 4, 132, '2023-05-04'),
(104, 4, 231, '2023-05-05');

-- --------------------------------------------------------

--
-- Table structure for table `course_req`
--

CREATE TABLE `course_req` (
  `order_id` int(11) NOT NULL,
  `cou_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `course_tbl`
--

CREATE TABLE `course_tbl` (
  `cou_id` int(11) NOT NULL,
  `cou_name` varchar(1000) NOT NULL,
  `admin_created` varchar(100) NOT NULL,
  `cou_description` varchar(10000) NOT NULL,
  `cou_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `course_tbl`
--

INSERT INTO `course_tbl` (`cou_id`, `cou_name`, `admin_created`, `cou_description`, `cou_created`, `img`) VALUES
(132, 'ENGLISH', '1', 'Cambridge English Qualifications are in-depth exams that make learning English enjoyable, effective and rewarding. Our unique approach encourages continuous progression with a clear path to improve language skills. We have qualifications for schools, general and higher education, and business.', '2023-03-31 22:00:00', '86cb41211e0fb6bd.jpg'),
(230, 'Dynamics', '1', 'xxx', '2023-04-01 22:00:00', '780bb461d296650f.jpg'),
(231, 'Chemistry', '1', 'xxxx', '2023-04-01 22:00:00', 'a3f82c785075c3ab.jpg'),
(232, 'Maths', '1', 'test course for testing website course panel student', '2023-04-01 22:00:00', 'cf7780208f5e3360.jpg'),
(233, 'France', '1', 'test course for testing website course panel studenttest course for testing website course panel studenttest course for testing website course panel studenttest course for testing website course panel studenttest course for testing website course panel studenttest course for testing website course panel student', '2023-04-08 22:00:00', '74be77fd7855c17a.png');

-- --------------------------------------------------------

--
-- Table structure for table `exam_answers`
--

CREATE TABLE `exam_answers` (
  `order_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `question_id` int(11) NOT NULL,
  `question_answer` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_answers`
--

INSERT INTO `exam_answers` (`order_id`, `stu_id`, `exam_id`, `question_id`, `question_answer`) VALUES
(798, 23, 37, 14, 'Order of Significance'),
(799, 23, 37, 15, 'Dennis Ritchie & Ken Thompson'),
(800, 23, 37, 16, 'Data Block'),
(801, 23, 37, 17, 'Image file'),
(802, 23, 37, 18, 'Program List Control'),
(803, 23, 37, 19, 'LAN (Local Area Network)'),
(804, 23, 37, 20, 'Stimulated emission'),
(805, 23, 37, 21, 'Audio file'),
(806, 23, 37, 22, 'Interanet'),
(807, 23, 37, 24, '1972'),
(808, 23, 37, 25, 'Pointer, diode, CD'),
(809, 23, 37, 46, '20'),
(810, 23, 37, 48, '3'),
(811, 23, 37, 87, 'asda'),
(812, 4, 37, 14, 'Open Software'),
(813, 4, 37, 15, 'Dennis Ritchie & Ken Thompson'),
(814, 4, 37, 16, 'Double Byte'),
(815, 4, 37, 17, 'System file'),
(816, 4, 37, 18, 'Programmable Lift Computer'),
(817, 4, 37, 19, 'URL (Universal Resource Locator)'),
(818, 4, 37, 20, 'Stimulated emission'),
(819, 4, 37, 21, 'Image file'),
(820, 4, 37, 22, 'Wide Area Network'),
(821, 4, 37, 24, '1984'),
(822, 4, 37, 25, 'Gas, metal vapor, rock'),
(823, 4, 37, 46, '15'),
(824, 4, 37, 48, '3'),
(825, 4, 37, 87, 'asdas'),
(826, 4, 57, 67, '2'),
(827, 4, 57, 68, '14'),
(828, 4, 57, 69, 'requiredrequired44'),
(829, 23, 57, 67, '2'),
(830, 23, 57, 68, '14'),
(831, 23, 57, 69, 'required3'),
(832, 4, 60, 44, 'Not_Selected'),
(833, 4, 60, 45, 'Not_Selected'),
(834, 4, 60, 49, 'Not_Selected'),
(835, 4, 60, 50, 'Not_Selected'),
(836, 4, 60, 85, 'a'),
(837, 23, 60, 85, 's');

-- --------------------------------------------------------

--
-- Table structure for table `exam_check`
--

CREATE TABLE `exam_check` (
  `order_Id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime NOT NULL,
  `exam_degree` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_check`
--

INSERT INTO `exam_check` (`order_Id`, `stu_id`, `exam_id`, `start_time`, `end_time`, `exam_degree`) VALUES
(124, 23, 37, '2023-05-04 21:05:31', '2023-05-04 21:06:05', '3'),
(125, 4, 37, '2023-05-04 21:35:07', '2023-05-04 21:35:30', '4'),
(126, 4, 57, '2023-05-04 21:52:44', '2023-05-04 21:57:15', '3'),
(127, 23, 57, '2023-05-05 05:35:43', '2023-05-05 05:39:06', '2'),
(128, 4, 60, '2023-05-05 05:45:40', '2023-05-05 05:45:48', '0'),
(129, 23, 60, '2023-05-06 19:07:13', '2023-05-06 19:30:14', '0');

-- --------------------------------------------------------

--
-- Table structure for table `exam_question_header`
--

CREATE TABLE `exam_question_header` (
  `que_id` int(11) NOT NULL,
  `title` varchar(1000) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `Que_Text` text NOT NULL,
  `img` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `exam_question_header`
--

INSERT INTO `exam_question_header` (`que_id`, `title`, `exam_id`, `Que_Text`, `img`) VALUES
(1, 'Choose from the given answers', 37, '3.2.1. Test facility means the persons, premises and operational unit(s) that are necessary for conducting the non-clinical health and environmental safety study. For multi-site studies, those which are conducted at more than one site, the test facility comprises the site at which the Study Director is located and all individual test sites, which individually or collectively can be considered to be test facilities.\r\n', 'f1c25d1a7f71c1d6.png'),
(13, 'Test123', 57, 'test 123', '85741fe3559f7bc1.png'),
(60, 'test', 59, 'test', '9d77b7b383c20e1d.png'),
(63, 'xx', 60, 'xx', '8b41613488d9b911.png'),
(64, 'cxc', 60, 'xcxcx', 'a72c413c7b366dd7.jpg'),
(65, 'xx', 37, 'xx', '9148927c312f4aca.png'),
(67, 'xx', 37, 'xx', 'ef7cf6ebdf9c0057.png'),
(68, 'xx', 37, 'xx', '');

-- --------------------------------------------------------

--
-- Table structure for table `exam_question_tbl`
--

CREATE TABLE `exam_question_tbl` (
  `eqt_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `exam_question` varchar(1000) NOT NULL,
  `exam_ch1` varchar(1000) NOT NULL,
  `exam_ch2` varchar(1000) NOT NULL,
  `exam_ch3` varchar(1000) NOT NULL,
  `exam_ch4` varchar(1000) NOT NULL,
  `exam_answer` varchar(1000) NOT NULL,
  `exam_header` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam_question_tbl`
--

INSERT INTO `exam_question_tbl` (`eqt_id`, `exam_id`, `exam_question`, `exam_ch1`, `exam_ch2`, `exam_ch3`, `exam_ch4`, `exam_answer`, `exam_header`) VALUES
(14, 37, 'OS computer abbreviation usually means ?', 'Order of Significance', 'Open Software', 'Operating System', 'Optical Sensor', 'Operating System', 1),
(15, 37, 'Who developed Yahoo?', 'Dennis Ritchie & Ken Thompson', 'David Filo & Jerry Yang', 'Vint Cerf & Robert Kahn', 'Steve Case & Jeff Bezos', 'David Filo & Jerry Yang', 1),
(16, 37, 'DB computer abbreviation usually means ?', 'Database', 'Double Byte', 'Data Block', 'Driver Boot', 'Database', 1),
(17, 37, '.INI extension refers usually to what kind of file?', 'Image file', 'System file', 'Hypertext related file', 'Image Color Matching Profile file', 'System file', 1),
(18, 37, 'What does the term PLC stand for?', 'Programmable Lift Computer', 'Program List Control', 'Programmable Logic Controller', 'Piezo Lamp Connector', 'Programmable Logic Controller', 1),
(19, 37, 'What do we call a network whose elements may be separated by some distance? It usually involves two or more small networks and dedicated high-speed telephone lines.', 'URL (Universal Resource Locator)', 'LAN (Local Area Network)', 'WAN (Wide Area Network)', 'World Wide Web', 'WAN (Wide Area Network)', 1),
(20, 37, 'After the first photons of light are produced, which process is responsible for amplification of the light?', 'Blackbody radiation', 'Stimulated emission', 'Plancks radiation', 'Einstein oscillation', 'Stimulated emission', 1),
(21, 37, '.TMP extension refers usually to what kind of file?', 'Compressed Archive file', 'Image file', 'Temporary file', 'Audio file', 'Temporary file', 1),
(22, 37, 'What do we call a collection of two or more computers that are located within a limited distance of each other and that are connected to each other directly or indirectly?', 'Inernet', 'Interanet', 'Local Area Network', 'Wide Area Network', 'Local Area Network', 1),
(24, 37, '	 In what year was the \"@\" chosen for its use in e-mail addresses?', '1976', '1972', '1980', '1984', '1972', 1),
(25, 37, 'What are three types of lasers?', 'Gas, metal vapor, rock', 'Pointer, diode, CD', 'Diode, inverted, pointer', 'Gas, solid state, diode', 'Gas, solid state, diode', 1),
(41, 27, 'test7', '', '', '', '', '', 0),
(46, 37, '5+10', '20', '15', '30', '50', '15', 1),
(48, 37, '1+2=', '2', '3', '4', '5', '3', 1),
(67, 57, '1+1', '2', '3', '4', '5', '2', 13),
(68, 57, '4+10', '13', '14', '151', '66', '14', 13),
(69, 57, 'required2', 'required3', 'required4', '44', 'requiredrequired44', 'requiredrequired44', 13),
(81, 59, 'czxcz', 'zxczx', 'zxczx', 'zxc', 'zczc', 'zxc', 60),
(85, 60, 'xxxx', 'a', 's', '23', 'as', '23', 63),
(87, 37, 'asdsa', 'asda', 'asdas', 'swewq', 'asdas', 'swewq', 65);

-- --------------------------------------------------------

--
-- Table structure for table `exam_tbl`
--

CREATE TABLE `exam_tbl` (
  `ex_id` int(11) NOT NULL,
  `cou_id` int(100) NOT NULL,
  `ex_title` varchar(1000) NOT NULL,
  `ex_time_limit` varchar(1000) NOT NULL,
  `ex_description` varchar(1000) NOT NULL,
  `ex_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `ex_deadline` datetime NOT NULL,
  `show_result` text NOT NULL,
  `posted` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `exam_tbl`
--

INSERT INTO `exam_tbl` (`ex_id`, `cou_id`, `ex_title`, `ex_time_limit`, `ex_description`, `ex_created`, `ex_deadline`, `show_result`, `posted`) VALUES
(37, 132, 'Lesson 2', '60', 'ecccc', '2023-03-31 20:00:00', '2023-06-10 00:00:00', 'yes', 'yes'),
(57, 132, 'Lesson 1', '40', 'TEST 1', '2023-04-01 20:00:00', '2023-05-12 00:00:00', 'yes', 'yes'),
(59, 230, 'Lesson 3', '60', 'test2', '2023-04-04 20:00:00', '2023-04-01 00:00:00', 'yes', 'no'),
(60, 132, 'Lesson 3', '10', 'test', '2023-04-13 20:00:00', '2023-05-19 00:00:00', 'yes', 'yes'),
(62, 132, 'xxx', '11', 'xx', '2023-04-28 21:49:04', '2023-04-17 00:00:00', 'yes', 'yes');

-- --------------------------------------------------------

--
-- Table structure for table `feedbacks_tbl`
--

CREATE TABLE `feedbacks_tbl` (
  `fb_id` int(11) NOT NULL,
  `exmne_id` int(11) NOT NULL,
  `fb_exmne_as` varchar(1000) NOT NULL,
  `fb_feedbacks` varchar(1000) NOT NULL,
  `fb_date` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `feedbacks_tbl`
--

INSERT INTO `feedbacks_tbl` (`fb_id`, `exmne_id`, `fb_exmne_as`, `fb_feedbacks`, `fb_date`) VALUES
(4, 6, 'Glenn Duerme', 'Gwapa kay Miss Pam', 'December 05, 2019'),
(5, 6, 'Anonymous', 'Lageh, idol na nako!', 'December 05, 2019'),
(6, 4, 'Rogz Nunezsss', 'Yes', 'December 08, 2019'),
(7, 4, '', '', 'December 08, 2019'),
(8, 4, '', '', 'December 08, 2019'),
(9, 8, 'Anonymous', 'dfsdf', 'January 05, 2020'),
(10, 9, 'warren dalaoyan', 'haah', 'January 12, 2020'),
(11, 5, 'Anonymous', '33', 'March 12, 2023'),
(12, 5, 'Jane Rivera', '44', 'March 12, 2023');

-- --------------------------------------------------------

--
-- Table structure for table `lec_tbl`
--

CREATE TABLE `lec_tbl` (
  `lec_id` int(11) NOT NULL,
  `lec_name` varchar(1000) CHARACTER SET latin1 COLLATE latin1_swedish_ci NOT NULL,
  `cou_id` int(11) NOT NULL,
  `video_link` varchar(1000) NOT NULL,
  `lec_description` text NOT NULL,
  `img` text NOT NULL,
  `admin_created` int(255) NOT NULL,
  `lec_created` timestamp NOT NULL DEFAULT current_timestamp(),
  `lec_time` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lec_tbl`
--

INSERT INTO `lec_tbl` (`lec_id`, `lec_name`, `cou_id`, `video_link`, `lec_description`, `img`, `admin_created`, `lec_created`, `lec_time`) VALUES
(17, 'Lecture 1 - chapter 1', 132, 'Youtube/9lbowDVSI9k', 'CHAPTER 1 ', '53c75242832d6761.jpg', 1, '2023-04-12 22:00:00', 7),
(19, 'Lecture 2 - chapter 2', 132, 'Youtube/j02OZRjf2d8', 'test124', 'b9fccd3a10565de6.jpg', 1, '2023-04-12 22:00:00', 0),
(20, 'Lecture 3 - chapter 3', 132, 'Youtube/YnTEXW7RaYY', 'test description2', '0a432654b0bc4130.jpg', 1, '2023-04-12 22:00:00', 7),
(26, 'xx', 208, 'Youtube/SJdgNvE49Es', ' xx', 'e8bfa1a9184e1008.jpg', 1, '2023-04-12 22:00:00', 7),
(27, 'xxx', 209, 'xxx', ' xx', '', 1, '2023-04-12 22:00:00', 7),
(50, 'Lecture 4 - chapter 4', 132, 'vi2X8TwnanZeQtX0cZBxqYDN', ' xxxx', '6ecf7a465614deb7.png', 1, '2023-04-12 22:00:00', 7),
(52, 'testtest', 232, 'Youtube/9lbowDVSI9k', ' test', '', 1, '2023-04-12 22:00:00', 7),
(81, 'Ctest1', 132, 'https://www.youtube.com/watch?v=YnTEXW7RaYY', ' ccc', 'd4e77f1479220942.jpg', 0, '2023-04-24 16:04:10', 10),
(83, '', 0, '', ' ', 'index.png', 0, '2023-04-28 22:05:34', 0);

-- --------------------------------------------------------

--
-- Table structure for table `lec_timecount`
--

CREATE TABLE `lec_timecount` (
  `order_id` int(255) NOT NULL,
  `lec_id` int(255) NOT NULL,
  `stu_id` int(255) NOT NULL,
  `start_time` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `end_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `lec_timecount`
--

INSERT INTO `lec_timecount` (`order_id`, `lec_id`, `stu_id`, `start_time`, `end_time`) VALUES
(21, 20, 23, '2023-04-13 15:15:50', '2023-04-20 15:15:50'),
(22, 17, 23, '2023-04-14 04:41:42', '2023-04-01 15:29:34'),
(38, 50, 23, '2023-04-21 20:29:47', '2023-04-28 20:29:47'),
(39, 50, 24, '2023-04-23 15:24:59', '2023-04-30 15:24:59'),
(40, 52, 23, '2023-04-27 21:46:11', '2023-05-04 21:46:11'),
(42, 81, 23, '2023-05-05 03:32:52', '2023-05-15 03:32:52'),
(43, 81, 4, '2023-05-05 03:44:29', '2023-05-15 03:44:29'),
(44, 50, 4, '2023-05-05 03:46:37', '2023-05-12 03:46:37');

-- --------------------------------------------------------

--
-- Table structure for table `student_tbl`
--

CREATE TABLE `student_tbl` (
  `stu_id` int(11) NOT NULL,
  `stu_fullname` varchar(1000) NOT NULL,
  `stu_gender` varchar(1000) NOT NULL,
  `stu_birthdate` varchar(1000) NOT NULL,
  `stu_email` varchar(1000) NOT NULL,
  `stu_password` varchar(1000) NOT NULL,
  `stu_phone` text NOT NULL,
  `stu_status` varchar(1000) NOT NULL DEFAULT 'active',
  `created_time` date NOT NULL DEFAULT current_timestamp(),
  `stu_profile` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `student_tbl`
--

INSERT INTO `student_tbl` (`stu_id`, `stu_fullname`, `stu_gender`, `stu_birthdate`, `stu_email`, `stu_password`, `stu_phone`, `stu_status`, `created_time`, `stu_profile`) VALUES
(4, 'Rogz Nune', 'Female', '2019-11-15', 'nunezs2013@gmail.com', 'rogz', '0135789', 'active', '2023-04-06', '6efab49af29ae62c.jpg'),
(6, 'Glenn Duerme', 'Female', '2019-12-24', 'glenn@gmail.com', 'glenn', '0', 'active', '2023-04-06', 'defult.jpg'),
(7, 'Maria Duerme', 'Female', '2018-11-25', 'maria@gmail.com', 'maria', '0', 'active', '2023-04-06', 'defult.jpg'),
(8, 'Dave Limasac', 'Female', '2019-12-21', 'dave@gmail.com', 'dave', '0', 'active', '2023-04-06', 'defult.jpg'),
(11, 'rodina mohamed', 'Female', '2023-03-12', 'test1232@gmail.com', 'test@gmail.com', '0', 'active', '2023-04-06', 'defult.jpg'),
(23, 'MoSami', 'Male', '2023-05-31', 'cf.egypt789@gmail.com', 'admin', '01152952255', 'active', '2023-04-07', 'a9359a6180a9cf4f.png'),
(24, 'Mohamed Sayed', 'Male', '2023-04-29', 'mosami@gmail.com', 'admin', '0', 'pending', '2023-04-08', 'defult.jpg'),
(26, 'mosami', 'Male', '2023-04-08', 'fed@gmail.com', 'admin', '0', 'active', '2023-04-08', 'defult.jpg'),
(234, 'testname312312', 'Male', '2023-04-28', 't789@gmail.com', 'admin', '0', 'Active', '2023-04-29', 'defult.jpg'),
(235, 'test', 'Male', '2023-05-26', 'cf.egypt7849@gmail.com', 'admin', '', 'active', '2023-05-05', '');

-- --------------------------------------------------------

--
-- Table structure for table `stu_questions`
--

CREATE TABLE `stu_questions` (
  `order_id` int(11) NOT NULL,
  `stu_id` int(11) NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `question` text NOT NULL,
  `img` text NOT NULL,
  `answer` text NOT NULL,
  `created_time` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `replied_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `stu_questions`
--

INSERT INTO `stu_questions` (`order_id`, `stu_id`, `lecturer_id`, `question`, `img`, `answer`, `created_time`, `replied_time`) VALUES
(1, 23, 1, 'Text linguistics refers to a form of discourse analysis—a method of studying written or spoken language—that is concerned with the description and analysis of extended texts (those beyond the level of the single sentence). A text can be any example of written or spoken language, from something as complex as a book or legal document to something as simple as the body of an email or the words on the back of a cereal box.\n\n', '09u09as0909890s67906as96d98a698698.png', 'In the humani0ties, different fields of study concern themselves with different forms of texts. Literary theorists, for example, focus primarily on literary texts—novels, essays, stories, and poems. Legal scholars focus on legal texts such as laws, contracts, decrees, and regulations. Cultural theorists work with a wide variety of texts, including those that may not typically be the subject of studies, such as advertisements, signage, instruction manuals, and other ephemera', '2023-05-05 18:48:35', '2023-05-05 07:17:05'),
(56, 4, 1, 'xx', '1155503803600dff.png', 'xxxxxxxxxxxxxx', '2023-05-05 19:25:24', '2023-05-05 07:17:05'),
(58, 23, 1, 'xxxxxxxxxx', '066f7405928e2d18.PNG', 'test123', '2023-05-05 19:17:57', '2023-05-05 07:17:05'),
(66, 23, 1, 'xxx', '', 'xxx', '2023-05-05 19:36:16', '2023-05-05 19:36:16');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_acc`
--
ALTER TABLE `admin_acc`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `assi_answers`
--
ALTER TABLE `assi_answers`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `assi_check`
--
ALTER TABLE `assi_check`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `assi_question_header`
--
ALTER TABLE `assi_question_header`
  ADD PRIMARY KEY (`que_id`);

--
-- Indexes for table `assi_question_tbl`
--
ALTER TABLE `assi_question_tbl`
  ADD PRIMARY KEY (`que_assi_id`);

--
-- Indexes for table `assi_tbl`
--
ALTER TABLE `assi_tbl`
  ADD PRIMARY KEY (`assi_id`);

--
-- Indexes for table `course_check`
--
ALTER TABLE `course_check`
  ADD PRIMARY KEY (`coustu_id`);

--
-- Indexes for table `course_req`
--
ALTER TABLE `course_req`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `course_tbl`
--
ALTER TABLE `course_tbl`
  ADD PRIMARY KEY (`cou_id`);

--
-- Indexes for table `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `exam_check`
--
ALTER TABLE `exam_check`
  ADD PRIMARY KEY (`order_Id`);

--
-- Indexes for table `exam_question_header`
--
ALTER TABLE `exam_question_header`
  ADD PRIMARY KEY (`que_id`);

--
-- Indexes for table `exam_question_tbl`
--
ALTER TABLE `exam_question_tbl`
  ADD PRIMARY KEY (`eqt_id`);

--
-- Indexes for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  ADD PRIMARY KEY (`ex_id`);

--
-- Indexes for table `feedbacks_tbl`
--
ALTER TABLE `feedbacks_tbl`
  ADD PRIMARY KEY (`fb_id`);

--
-- Indexes for table `lec_tbl`
--
ALTER TABLE `lec_tbl`
  ADD PRIMARY KEY (`lec_id`);

--
-- Indexes for table `lec_timecount`
--
ALTER TABLE `lec_timecount`
  ADD PRIMARY KEY (`order_id`);

--
-- Indexes for table `student_tbl`
--
ALTER TABLE `student_tbl`
  ADD PRIMARY KEY (`stu_id`);

--
-- Indexes for table `stu_questions`
--
ALTER TABLE `stu_questions`
  ADD PRIMARY KEY (`order_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_acc`
--
ALTER TABLE `admin_acc`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assi_answers`
--
ALTER TABLE `assi_answers`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=37;

--
-- AUTO_INCREMENT for table `assi_check`
--
ALTER TABLE `assi_check`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assi_question_header`
--
ALTER TABLE `assi_question_header`
  MODIFY `que_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `assi_question_tbl`
--
ALTER TABLE `assi_question_tbl`
  MODIFY `que_assi_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `assi_tbl`
--
ALTER TABLE `assi_tbl`
  MODIFY `assi_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `course_check`
--
ALTER TABLE `course_check`
  MODIFY `coustu_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=105;

--
-- AUTO_INCREMENT for table `course_req`
--
ALTER TABLE `course_req`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=70;

--
-- AUTO_INCREMENT for table `course_tbl`
--
ALTER TABLE `course_tbl`
  MODIFY `cou_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=264;

--
-- AUTO_INCREMENT for table `exam_answers`
--
ALTER TABLE `exam_answers`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=838;

--
-- AUTO_INCREMENT for table `exam_check`
--
ALTER TABLE `exam_check`
  MODIFY `order_Id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=130;

--
-- AUTO_INCREMENT for table `exam_question_header`
--
ALTER TABLE `exam_question_header`
  MODIFY `que_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `exam_question_tbl`
--
ALTER TABLE `exam_question_tbl`
  MODIFY `eqt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=88;

--
-- AUTO_INCREMENT for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  MODIFY `ex_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=66;

--
-- AUTO_INCREMENT for table `feedbacks_tbl`
--
ALTER TABLE `feedbacks_tbl`
  MODIFY `fb_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `lec_tbl`
--
ALTER TABLE `lec_tbl`
  MODIFY `lec_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=92;

--
-- AUTO_INCREMENT for table `lec_timecount`
--
ALTER TABLE `lec_timecount`
  MODIFY `order_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `student_tbl`
--
ALTER TABLE `student_tbl`
  MODIFY `stu_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=236;

--
-- AUTO_INCREMENT for table `stu_questions`
--
ALTER TABLE `stu_questions`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=67;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
