-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 16, 2021 at 11:41 PM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `onlinecourse`
--

-- --------------------------------------------------------

--
-- Table structure for table `addtable`
--

CREATE TABLE `addtable` (
  `id` int(11) NOT NULL,
  `teacher` varchar(75) NOT NULL,
  `class` varchar(75) NOT NULL,
  `subject` varchar(75) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `addtable`
--

INSERT INTO `addtable` (`id`, `teacher`, `class`, `subject`) VALUES
(271, '1000050', '1', '10'),
(272, '1000051', '1', '11'),
(273, '1000052', '1', '7'),
(274, '1000051', '1', '8'),
(275, '1000053', '1', '9'),
(276, '1000054', '1', '2'),
(277, '1000050', '2', '10'),
(278, '1000051', '2', '11'),
(279, '1000052', '2', '7'),
(280, '1000053', '2', '9'),
(281, '1000054', '2', '2'),
(283, '1000055', '2', '8'),
(284, '1000050', '3', '10'),
(285, '1000051', '3', '11'),
(286, '1000052', '3', '7'),
(287, '1000053', '3', '9'),
(288, '1000054', '3', '2'),
(289, '1000055', '3', '8'),
(291, '1000056', '8', '9');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creationDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`, `creationDate`, `updationDate`) VALUES
(1, 'admin', 'e6e061838856bf47e1de730719fb2609', '2017-01-24 16:21:18', '16-06-2021 07:43:40 PM');

-- --------------------------------------------------------

--
-- Table structure for table `ajaxsave`
--

CREATE TABLE `ajaxsave` (
  `id` int(200) NOT NULL,
  `id_student` varchar(75) NOT NULL,
  `type` varchar(50) NOT NULL,
  `id_hom` varchar(50) NOT NULL,
  `tr` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ajaxsave`
--

INSERT INTO `ajaxsave` (`id`, `id_student`, `type`, `id_hom`, `tr`) VALUES
(75, '111146', '2', '108', '2');

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(10) NOT NULL,
  `student_id` varchar(50) NOT NULL,
  `class` varchar(20) NOT NULL,
  `subject` varchar(50) NOT NULL,
  `date` varchar(25) NOT NULL DEFAULT '0000-00-00',
  `attendance` int(1) NOT NULL DEFAULT 0
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `student_id`, `class`, `subject`, `date`, `attendance`) VALUES
(106, '111121', '1', '10', '2021-6-12', 0),
(107, '111136', '1', '10', '2021-6-12', 0),
(108, '111137', '1', '10', '2021-6-12', 1),
(109, '111138', '1', '10', '2021-6-12', 1),
(118, '111121', '1', '10', '2021-6-13', 1),
(119, '111136', '1', '10', '2021-6-13', 1),
(120, '111137', '1', '10', '2021-6-13', 1),
(121, '111138', '1', '10', '2021-6-13', 1),
(122, '111139', '2', '7', '2021-6-14', 0),
(123, '111140', '2', '7', '2021-6-14', 0),
(124, '111141', '2', '7', '2021-6-14', 1),
(125, '111142', '2', '7', '2021-6-14', 1),
(126, '111143', '3', '7', '2021-6-16', 1),
(127, '111144', '3', '7', '2021-6-16', 1),
(128, '111145', '3', '7', '2021-6-16', 0),
(129, '111146', '3', '7', '2021-6-16', 0),
(130, '111143', '3', '7', '2021-6-17', 1),
(131, '111144', '3', '7', '2021-6-17', 1),
(132, '111145', '3', '7', '2021-6-17', 1),
(133, '111146', '3', '7', '2021-6-17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `competition`
--

CREATE TABLE `competition` (
  `id` int(11) NOT NULL,
  `class` varchar(15) NOT NULL,
  `compName` varchar(50) NOT NULL,
  `link` varchar(100) NOT NULL,
  `details` varchar(200) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `competition`
--

INSERT INTO `competition` (`id`, `class`, `compName`, `link`, `details`) VALUES
(124, '3', 'سؤال وجواب', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596	', ''),
(122, '3', 'مسابقة دينيه', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596	', ''),
(123, '3', 'مسابقة تعليميه', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596	', ''),
(121, '3', 'مسابقة دينيه', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596_1615389177359', ''),
(120, '1', 'مسابقة ترفيهيه', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596_1615389177359', ''),
(118, '1', 'مسابقة دينيه', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596_1615389177359', ''),
(119, '2', 'مسابقة ترفيهيه', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596	', ''),
(125, '3', 'سؤال وجواب', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596_1615389177359', '');

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `id` int(11) NOT NULL,
  `className` varchar(50) DEFAULT NULL,
  `numOfSection` varchar(10) DEFAULT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`id`, `className`, `numOfSection`, `creationDate`, `updationDate`) VALUES
(1, 'الصف الاول', 'أ', '2021-06-03 20:50:06', NULL),
(2, 'الصف الاول', 'ب', '2021-06-03 20:50:12', NULL),
(3, 'الصف الثاني', 'أ', '2021-06-03 20:50:19', NULL),
(4, 'الصف الثاني', 'ب', '2021-06-03 20:50:23', NULL),
(5, 'الصف الثالث', 'أ', '2021-06-03 20:50:27', NULL),
(6, 'الصف الثالث', 'ب', '2021-06-03 20:50:31', NULL),
(7, 'الصف الرابع', 'أ', '2021-06-03 20:50:38', NULL),
(8, 'الصف الرابع', 'ب', '2021-06-03 20:50:43', NULL),
(9, 'الصف الخامس', 'أ', '2021-06-13 15:12:45', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `exam_answers`
--

CREATE TABLE `exam_answers` (
  `exans_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `quest_id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `exans_answer` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `exans_status` varchar(1000) NOT NULL DEFAULT 'new',
  `exans_created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_answers`
--

INSERT INTO `exam_answers` (`exans_id`, `student_id`, `exam_id`, `quest_id`, `mark`, `exans_answer`, `exans_status`, `exans_created`) VALUES
(197, 111146, 107, 41, 20, 'له لون وله رائحه وله طعم', 'new', '2021-06-16 19:49:17'),
(198, 111146, 109, 42, 20, 'اسد', 'new', '2021-06-16 19:49:29'),
(199, 111146, 110, 43, 20, 'احمر', 'new', '2021-06-16 19:49:38'),
(200, 111146, 111, 44, 20, 'الاسد', 'new', '2021-06-16 19:41:00');

-- --------------------------------------------------------

--
-- Table structure for table `exam_attempt`
--

CREATE TABLE `exam_attempt` (
  `examat_id` int(11) NOT NULL,
  `exmne_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `mark` int(11) NOT NULL,
  `markExam` int(11) NOT NULL,
  `examat_status` varchar(1000) NOT NULL DEFAULT 'used'
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_attempt`
--

INSERT INTO `exam_attempt` (`examat_id`, `exmne_id`, `exam_id`, `mark`, `markExam`, `examat_status`) VALUES
(123, 111146, 109, 20, 20, 'used'),
(124, 111146, 110, 20, 20, 'used'),
(125, 111146, 111, 20, 20, 'used');

-- --------------------------------------------------------

--
-- Table structure for table `exam_question_tbl`
--

CREATE TABLE `exam_question_tbl` (
  `eqt_id` int(11) NOT NULL,
  `exam_id` int(11) NOT NULL,
  `exam_question` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `exam_ch1` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `exam_ch2` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `exam_ch3` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `exam_ch4` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `exam_answer` varchar(1000) CHARACTER SET utf8 NOT NULL,
  `exam_status` varchar(1000) CHARACTER SET utf8 NOT NULL DEFAULT 'active',
  `eq_mark` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_question_tbl`
--

INSERT INTO `exam_question_tbl` (`eqt_id`, `exam_id`, `exam_question`, `exam_ch1`, `exam_ch2`, `exam_ch3`, `exam_ch4`, `exam_answer`, `exam_status`, `eq_mark`) VALUES
(40, 106, 'من خصائص الماء؟', 'لونه ابيض', 'له رائحه', 'لا لون ولا رائحه ولا طعم', 'جميع ما ذكر', 'لا لون ولا رائحه ولا طعم', 'active', 20),
(42, 109, 'من هو ملك الغابه', 'اسد', 'قرد', 'نتتن', 'نن', 'اسد', 'active', 20),
(43, 110, 'تنا', 'وتل', 'تل', 'تا', 'اا', 'تا', 'active', 20),
(44, 111, 'من هو ملك الغابه؟', 'الاسد', 'القرد', 'فهد', 'لاشي', 'الاسد', 'active', 20);

-- --------------------------------------------------------

--
-- Table structure for table `exam_tbl`
--

CREATE TABLE `exam_tbl` (
  `exam_id` int(11) NOT NULL,
  `teacher_id` varchar(75) CHARACTER SET utf8mb4 NOT NULL,
  `class_id` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `sub_id` varchar(250) CHARACTER SET utf8mb4 NOT NULL,
  `start_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `end_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `ex_title` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `ex_questlimit_display` int(11) NOT NULL,
  `ex_description` varchar(1000) CHARACTER SET utf8mb4 NOT NULL,
  `ex_created` varchar(300) CHARACTER SET utf8mb4 NOT NULL,
  `ex_mark` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `exam_tbl`
--

INSERT INTO `exam_tbl` (`exam_id`, `teacher_id`, `class_id`, `sub_id`, `start_time`, `end_time`, `ex_title`, `ex_questlimit_display`, `ex_description`, `ex_created`, `ex_mark`) VALUES
(106, '1000052', '3', '7', '2021-06-14 19:06:00.000000', '2021-06-14 20:06:00.000000', 'امتحان اول', 1, 'يرجى قراءه الاسئله بتمعن', '2021-06-16 22:07:50PM', 20),
(109, '1000052', '3', '7', '2021-06-16 19:27:00.000000', '2021-06-16 19:29:00.000000', 'اختبار', 1, '', '2021-06-16 22:27:59PM', 20),
(108, '1000052', '3', '7', '2021-06-22 19:13:00.000000', '2021-06-22 20:13:00.000000', 'اختبار قصير', 0, '', '2021-06-16 22:14:02PM', 20),
(110, '1000052', '3', '7', '2021-06-16 19:32:00.000000', '2021-06-16 19:34:00.000000', 'تل', 1, '', '2021-06-16 22:32:23PM', 20),
(111, '1000052', '3', '7', '2021-06-16 19:39:00.000000', '2021-06-16 19:41:00.000000', 'تا', 1, '', '2021-06-16 22:40:04PM', 20);

-- --------------------------------------------------------

--
-- Table structure for table `homework`
--

CREATE TABLE `homework` (
  `id` int(150) NOT NULL,
  `teacher` varchar(75) NOT NULL,
  `class` varchar(250) NOT NULL,
  `subject` varchar(75) NOT NULL,
  `start_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `end_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6),
  `file` varchar(500) NOT NULL,
  `type` varchar(150) NOT NULL,
  `size` varchar(150) NOT NULL,
  `details` text NOT NULL,
  `sumbitbate` varchar(300) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `homework`
--

INSERT INTO `homework` (`id`, `teacher`, `class`, `subject`, `start_time`, `end_time`, `file`, `type`, `size`, `details`, `sumbitbate`) VALUES
(156, '1000052', '3', '7', '2021-06-09 19:53:00.000000', '2021-06-10 19:53:00.000000', '../homework/maiqamaj_cv_2021.pdf', 'application/pdf', '615.6259765625', '', '2021-06-16 22:55:27PM'),
(157, '1000052', '3', '7', '2021-06-16 19:56:00.000000', '2021-06-17 19:55:00.000000', '../homework/maiqamaj_cv_2021.pdf', 'application/pdf', '615.6259765625', '', '2021-06-16 22:56:49PM');

-- --------------------------------------------------------

--
-- Table structure for table `lesson`
--

CREATE TABLE `lesson` (
  `id` int(11) NOT NULL,
  `teacher` varchar(75) NOT NULL,
  `class` int(11) NOT NULL,
  `subject` int(11) NOT NULL,
  `video_name` varchar(100) CHARACTER SET utf8 NOT NULL,
  `location` varchar(100) CHARACTER SET utf8 NOT NULL,
  `details` text NOT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `lesson`
--

INSERT INTO `lesson` (`id`, `teacher`, `class`, `subject`, `video_name`, `location`, `details`, `creationDate`) VALUES
(98, '1000052', 3, 7, 'العلوم.mp4', '../lesson/العلوم.mp4.mp4', '', '2021-06-16 20:08:56');

-- --------------------------------------------------------

--
-- Table structure for table `mark`
--

CREATE TABLE `mark` (
  `id` int(15) NOT NULL,
  `id_student` int(15) NOT NULL,
  `id_section` int(15) NOT NULL,
  `id_subject` int(15) NOT NULL,
  `first_mark` int(15) NOT NULL,
  `sec_mark` int(15) NOT NULL,
  `third_mark` int(15) NOT NULL,
  `final_mark` int(15) NOT NULL,
  `total` int(15) NOT NULL,
  `status` int(2) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `mark`
--

INSERT INTO `mark` (`id`, `id_student`, `id_section`, `id_subject`, `first_mark`, `sec_mark`, `third_mark`, `final_mark`, `total`, `status`) VALUES
(26, 111121, 1, 10, 15, 0, 0, 0, 15, 0),
(27, 111143, 3, 7, 20, 0, 0, 0, 20, 0);

-- --------------------------------------------------------

--
-- Table structure for table `meeting`
--

CREATE TABLE `meeting` (
  `id` int(15) NOT NULL,
  `teacher` varchar(75) NOT NULL,
  `class` varchar(15) NOT NULL,
  `link` varchar(100) NOT NULL,
  `subject` varchar(20) NOT NULL,
  `start_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6),
  `end_time` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `meeting`
--

INSERT INTO `meeting` (`id`, `teacher`, `class`, `link`, `subject`, `start_time`, `end_time`) VALUES
(60, '1000054', '1', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596_1615389177359', '2', '2021-06-12 15:29:00.000000', '2021-06-12 16:29:00.000000'),
(62, '1000054', '7', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596_1615559177359', '2', '2021-06-12 15:35:00.000000', '2021-06-12 16:35:00.000000'),
(65, '1000054', '1', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596_1615389557359', '2', '2021-06-12 15:51:00.000000', '2021-06-12 16:51:00.000000'),
(66, '1000054', '2', 'https://kahoot.it/challenge/08218129?challenge-id=3ef2b223-2f2a-499b-91ce-b69fe9f63596_1615389177559', '2', '2021-06-12 16:01:00.000000', '2021-06-12 17:01:00.000000'),
(67, '1000052', '1', 'https://zoom.us/wc/join/91731102037?wpk=wcpkd5c645779166639349458cfb59510b81', '7', '2021-06-16 23:11:00.000000', '2021-06-17 00:11:00.000000'),
(68, '1000052', '2', 'https://zoom.us/wc/join/91731102037?wpk=wcpkd5c645	', '7', '2021-06-14 23:12:00.000000', '2021-06-15 00:12:00.000000'),
(69, '1000052', '3', 'https://zoom.us/wc/join/91731102037?wpk=wcp	', '7', '2021-06-17 23:13:00.000000', '2021-06-18 00:13:00.000000');

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) DEFAULT NULL,
  `recipient_id` int(11) DEFAULT NULL,
  `message` text DEFAULT NULL,
  `type` varchar(100) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `sender_id`, `recipient_id`, `message`, `type`) VALUES
(101, 1, 10000000, 'hi', 'text'),
(102, 1, 10000000, '/storage/6071e9a129d94Screenshot from 2021-04-02 17-13-31.png', 'image'),
(103, 1, 10000000, '/storage/6071ea4a56a3dScreenshot from 2021-04-02 07-07-49.png', 'image'),
(104, 1, 10000000, 'hi', 'text'),
(105, 1, 10000000, 'y', 'text'),
(106, 1, 10000000, 'y', 'text'),
(107, 1, 10000000, '/storage/6072009fc46bdScreenshot from 2021-04-02 17-13-19.png', 'image'),
(108, 1, 111111, 'l', 'text'),
(109, 1, 111112, 'hi', 'text'),
(110, 111112, 1, 'hi', 'text'),
(111, 1, 111112, '/storage/60733aef3b419Screenshot from 2021-04-02 07-05-49.png', 'image'),
(112, 111112, 1, '/storage/60733b02b5a0dScreenshot from 2021-04-03 05-00-24.png', 'image'),
(113, 111112, 1, 'nj', 'text'),
(114, 1, 111112, 'hhhhhhhhhhhhhhhh', 'text'),
(115, 1, 111112, 'hi', 'text'),
(116, 1, 111112, 'jjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjjj', 'text'),
(117, 111112, 1, 'dfgyuhijokpl', 'text'),
(118, 1, 111112, 'kjhgfd', 'text'),
(119, 111112, 1, 'jjj', 'text'),
(120, 1, 111111, 'jkjkj', 'text'),
(121, 111112, 1, 'حلو ', 'text'),
(123, 1, 111111, 'تتت', 'text'),
(124, 1, 111112, 'اه', 'text'),
(125, 111112, 10000000, 'مرحبا', 'text'),
(126, 1, 111112, '/storage/6074b16593b4cScreenshot from 2021-04-05 10-33-31.png', 'image'),
(127, 1, 111112, '', 'text'),
(128, 1, 111112, 'مكككك', 'text'),
(129, 111112, 10000000, 'تنتنت', 'text'),
(130, 111112, 10000000, 'مكنتالب', 'text'),
(131, 111112, 10000000, '/storage/60784ee7756e6Screenshot from 2021-04-08 16-15-43.png', 'image'),
(132, 111112, 10000000, '/storage/6078502a5129aScreenshot from 2021-04-08 16-21-25.png', 'image'),
(133, 111112, 10000000, '/storage/607850423b723Screenshot from 2021-04-04 06-34-55.png', 'image'),
(134, 1, 111112, '15-4', 'text'),
(135, 111112, 1, '/storage/6078509d2fd4fScreenshot from 2021-04-04 03-23-02.png', 'image'),
(136, 1, 111112, 'حلو ... طيب والطالب ؟', 'text'),
(137, 10000000, 111111, 'test', 'text'),
(138, 10000000, 111112, 'test', 'text'),
(139, 1, 111112, 'مرحبا', 'text'),
(140, 1, 111112, '/storage/607890a1a8cebScreenshot from 2021-04-03 02-30-06.png', 'image'),
(141, 10000000, 111112, 'كيفك مس', 'text'),
(142, 111112, 10000000, 'اهلين يا مس ', 'text'),
(143, 111112, 1, 'مرحبا ', 'text'),
(144, 1, 111112, 'اهلين', 'text'),
(145, 111112, 1, '/storage/607892c672010Screenshot from 2021-04-02 17-13-35.png', 'image'),
(146, 111112, 10000000, 'مرحبا', 'text'),
(147, 10000000, 111112, 'اهلين', 'text'),
(148, 10000000, 111111, 'hi', 'text'),
(149, 111111, 10000000, '/storage/6078bb3234845Screenshot from 2021-04-05 02-53-49.png', 'image'),
(150, 111112, 111112, 'kjhg', 'text'),
(151, 111112, 111112, 'hhghh', 'text'),
(152, 111112, 111112, 'gh', 'text'),
(153, 111112, 1, 'kjhghj', 'text'),
(154, 111112, 1, 'jhhj', 'text'),
(155, 1, 111112, 'كيفك', 'text'),
(156, 111112, 10000000, 'jhhgh', 'text');

-- --------------------------------------------------------

--
-- Table structure for table `notification`
--

CREATE TABLE `notification` (
  `id` int(11) NOT NULL,
  `teacher` varchar(300) NOT NULL,
  `num_notification` varchar(300) NOT NULL,
  `id_note` int(200) NOT NULL,
  `class` varchar(300) NOT NULL,
  `subject` varchar(300) NOT NULL,
  `currentdate` timestamp(6) NULL DEFAULT current_timestamp(6) ON UPDATE current_timestamp(6)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `notification`
--

INSERT INTO `notification` (`id`, `teacher`, `num_notification`, `id_note`, `class`, `subject`, `currentdate`) VALUES
(111, '1000052', '1', 157, '3', '7', '2021-06-16 19:56:49.000000'),
(106, '1000052', '2', 108, '3', '7', '2021-06-16 19:14:02.000000');

-- --------------------------------------------------------

--
-- Table structure for table `sendbirds`
--

CREATE TABLE `sendbirds` (
  `id` int(10) NOT NULL,
  `user` int(50) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sendbirds`
--

INSERT INTO `sendbirds` (`id`, `user`) VALUES
(3, 1),
(4, 111112),
(5, 10000000),
(6, 111111),
(7, 111125),
(8, 1000048),
(9, 1000052);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `section_id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `third_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `mother_name` varchar(15) NOT NULL,
  `guardian` varchar(15) NOT NULL,
  `identity_number` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `religion` varchar(15) NOT NULL,
  `address` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `date_of_birth` date NOT NULL,
  `place_of_birth` varchar(15) NOT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `password`, `section_id`, `first_name`, `second_name`, `third_name`, `last_name`, `mother_name`, `guardian`, `identity_number`, `gender`, `phone`, `religion`, `address`, `nationality`, `date_of_birth`, `place_of_birth`, `creationDate`, `updationDate`) VALUES
(111121, 'cd41287b93a9317b6b2d1da8bec1def1', 1, 'يارا', 'سلطي', 'رجا', 'صوافطه', 'عسل', 'الاب', '2147483642', 'أنثى', '0781234554', 'الاسلام', 'الحصن', 'أردني', '2021-05-07', 'اربد', '2021-04-06 19:16:30', '09-06-2021 08:02:51 PM'),
(111136, 'cd41287b93a9317b6b2d1da8bec1def1', 1, 'مها', 'احمد', 'حسن', 'فوزي', 'رهف', 'الاب', '2003657896', 'أنثى', '0772799034', 'الاسلام', 'اربد', 'أردني', '2014-05-09', 'اربد', '2021-06-09 19:11:15', '10-06-2021 12:46:59 AM'),
(111137, 'cd41287b93a9317b6b2d1da8bec1def1', 1, 'ريم', 'حمد', 'عبد الرحمن', 'صوافطه', 'يارا', 'الاب', '2004587963', 'أنثى', '0779525013', 'الاسلام', 'اربد', 'أردني', '2015-12-15', 'اربد', '2021-06-09 19:12:21', NULL),
(111138, 'cd41287b93a9317b6b2d1da8bec1def1', 1, 'ماريا', 'علي', 'احمد', 'عبدالله', 'مي', 'الاب', '2001478523', 'أنثى', '0779525013', 'الاسلام', 'اربد', 'أردني', '2015-06-17', 'اربد', '2021-06-09 19:13:18', NULL),
(111139, 'cd41287b93a9317b6b2d1da8bec1def1', 2, 'مي', 'على', 'احمد', 'هاشم', 'نسرين', 'الاب', '2005823694', 'أنثى', '0772799034', 'الاسلام', 'اربد', 'أردني', '2015-01-01', 'اربد', '2021-06-09 19:18:28', NULL),
(111140, 'cd41287b93a9317b6b2d1da8bec1def1', 2, 'نسرين', 'كرم', 'علاء', 'ربايعه', 'ماري', 'الاب', '2006431978', 'أنثى', '0781235554', 'الاسلام', 'اربد', 'أردني', '2016-05-10', 'اربد', '2021-06-09 19:19:44', NULL),
(111141, 'cd41287b93a9317b6b2d1da8bec1def1', 2, 'يارا', 'محمد', 'سلطي', 'هاشم', 'نسرين', 'الاب', '2007391582', 'أنثى', '0772799034', 'الاسلام', 'اربد', 'أردني', '2015-06-16', 'اربد', '2021-06-09 19:21:09', NULL),
(111142, 'cd41287b93a9317b6b2d1da8bec1def1', 2, 'شهد', 'علي', 'ماجد', 'العمايره', 'رهف', 'الاب', '2004628417', 'أنثى', '0772799034', 'الاسلام', 'اربد', '', '2015-06-09', 'اربد', '2021-06-09 19:22:27', NULL),
(111143, 'cd41287b93a9317b6b2d1da8bec1def1', 3, 'ايه', 'احمد', 'محمد', 'الزعبي', 'مها', 'الاب', '2008130841', 'أنثى', '0779525013', 'الاسلام', 'الحصن', 'أردني', '2014-12-24', 'اربد', '2021-06-09 19:24:23', NULL),
(111144, 'cd41287b93a9317b6b2d1da8bec1def1', 3, 'اسماء', 'علي', 'عبدالله', 'العمايره', 'رهف', 'الاب', '2001804709', 'أنثى', '0781235554', 'الاسلام', 'الحصن', 'أردني', '2015-01-04', 'اربد', '2021-06-09 19:25:51', NULL),
(111145, 'cd41287b93a9317b6b2d1da8bec1def1', 3, 'ماريا', 'احمد', 'جميل', 'قماج', 'رهف', 'الاب', '2004442517', 'أنثى', '0772799034', 'الاسلام', 'اربد', 'أردني', '2015-06-09', 'اربد', '2021-06-09 19:27:05', NULL),
(111146, 'cd41287b93a9317b6b2d1da8bec1def1', 3, 'دلال', 'محمد', 'احمد', 'قماج', 'يارا', 'الاب', '2004662185', 'أنثى', '0781235754', 'الاسلام', 'اربد', 'أردني', '2015-04-09', 'اربد', '2021-06-09 19:31:14', '13-06-2021 08:57:42 PM'),
(111147, 'cd41287b93a9317b6b2d1da8bec1def1', 8, 'عدي', 'حسين', 'علي', 'قماج', 'نور', 'حسين', '2002052436', 'ذكر', '0779228301', 'مسلم', 'Irbid', 'أردني', '2004-09-09', 'اربد', '2021-06-13 15:12:16', '16-06-2021 06:05:24 PM'),
(111148, 'cd41287b93a9317b6b2d1da8bec1def1', 5, 'ريم', 'على', 'عبدالله', 'هاشم', 'مها', 'علي', '9995415265', 'أنثى', '0772799034', 'الاسلام', 'اربد', 'أردني', '2021-06-09', 'اربد', '2021-06-16 20:52:21', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int(11) NOT NULL,
  `subjectName` varchar(75) DEFAULT NULL,
  `cretionData` timestamp NULL DEFAULT current_timestamp(),
  `updationData` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `subjectName`, `cretionData`, `updationData`) VALUES
(1, 'الفن', '2021-04-09 07:40:47', NULL),
(2, 'الرياضيات', '2021-03-31 08:34:55', NULL),
(7, 'العلوم', '2021-03-31 08:39:03', NULL),
(8, 'التربيه الاسلاميه', '2021-03-31 08:39:07', NULL),
(9, 'اللغه العربيه', '2021-03-31 08:39:13', NULL),
(10, 'اللغه الانجليزيه', '2021-03-31 08:39:17', NULL),
(11, 'الاجتماعيات', '2021-03-31 08:39:20', NULL),
(12, 'وطنيه', '2021-06-13 15:12:57', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `submithomework`
--

CREATE TABLE `submithomework` (
  `id` int(11) NOT NULL,
  `teacher` varchar(75) NOT NULL,
  `class` varchar(50) NOT NULL,
  `idstudent` varchar(20) NOT NULL,
  `subject` varchar(75) NOT NULL,
  `homework` varchar(50) NOT NULL,
  `submithomework` varchar(150) NOT NULL,
  `type` varchar(150) NOT NULL,
  `size` varchar(75) NOT NULL,
  `details` varchar(150) NOT NULL,
  `sumbitbate` timestamp(6) NOT NULL DEFAULT current_timestamp(6)
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `submithomework`
--

INSERT INTO `submithomework` (`id`, `teacher`, `class`, `idstudent`, `subject`, `homework`, `submithomework`, `type`, `size`, `details`, `sumbitbate`) VALUES
(46, '1000052', '3', '111146', '7', '157', '../homework/maiqamaj_cv_2021.pdf', 'application/pdf', '615.6259765625', '', '2021-06-16 21:21:36.000000');

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `id` int(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `second_name` varchar(50) NOT NULL,
  `third_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `identity_number` varchar(50) NOT NULL,
  `gender` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `address` varchar(50) NOT NULL,
  `nationality` varchar(50) NOT NULL,
  `specialization` varchar(50) NOT NULL,
  `appointment_year` date NOT NULL,
  `date_of_birth` date NOT NULL,
  `creationDate` timestamp NULL DEFAULT current_timestamp(),
  `updationDate` varchar(255) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`id`, `password`, `first_name`, `second_name`, `third_name`, `last_name`, `identity_number`, `gender`, `phone`, `Email`, `address`, `nationality`, `specialization`, `appointment_year`, `date_of_birth`, `creationDate`, `updationDate`) VALUES
(1000050, 'ea62920343f2ea175f749d7da6ab3792', 'مها', 'محمد', 'عبد الرحمن', 'العمايره', '9993657896', 'أنثى', '0772799034', 'mahaalamayreh99@gmail.com', 'اربد', 'أردني', '8', '2021-06-20', '2021-06-03', '2021-06-08 21:25:24', '14-06-2021 03:07:15 AM'),
(1000051, 'ea62920343f2ea175f749d7da6ab3792', 'ريم', 'حمد', 'احمد', 'فوزي', '2005843971', 'أنثى', '0772799035', 'nesrennn77@gmail.com', 'اربد', 'أردني', '9', '2021-06-07', '2021-07-07', '2021-06-08 21:58:09', '14-06-2021 03:08:22 AM'),
(1000052, 'ea62920343f2ea175f749d7da6ab3792', 'مي', 'احمد', 'محمد', 'قماج', '9995132574', 'أنثى', '0772709033', 'maiqamaj952@gmail.com', 'اربد', 'أردني', '10', '2021-06-07', '2021-06-06', '2021-06-08 21:58:49', '16-06-2021 03:40:34 PM'),
(1000053, 'ea62920343f2ea175f749d7da6ab3792', 'يارا', 'احمد', 'علي', 'صوافطه', '9992135468', 'أنثى', '0771799035', 'yarasawafta34@gmail.com', 'الحصن', 'أردني', '2', '2021-06-06', '1994-06-09', '2021-06-09 19:34:30', '14-06-2021 03:08:00 AM'),
(1000054, 'ea62920343f2ea175f749d7da6ab3792', 'نسرين', 'علي', 'احمد', 'الربايعه', '9995147621', 'أنثى', '0772799525', 'nesrennn77@gmail.com', 'الرمثا', 'أردني', '8', '2017-06-06', '2003-06-09', '2021-06-09 19:36:52', '14-06-2021 03:07:48 AM'),
(1000055, 'ea62920343f2ea175f749d7da6ab3792', 'ماريا', 'احمد', 'سلطي', 'هاشم', '9995147852', 'أنثى', '0772795435', 'yarasawafta34@gmail.com', 'ايدون', 'أردني', '7', '2020-02-05', '1985-05-05', '2021-06-09 19:38:59', '14-06-2021 03:07:39 AM'),
(1000056, 'ea62920343f2ea175f749d7da6ab3792', 'اسامه', 'احمد', 'عيسى', 'محمد', '9702052436', 'ذكر', '0779228301', 'mhmd@gmail.com', 'Irbid', 'أردني', '9', '2021-05-30', '1970-05-05', '2021-06-13 15:10:58', '16-06-2021 06:05:08 PM');

-- --------------------------------------------------------

--
-- Table structure for table `video`
--

CREATE TABLE `video` (
  `video_id` int(11) NOT NULL,
  `video_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video`
--

INSERT INTO `video` (`video_id`, `video_name`, `location`) VALUES
(29, 'عد الارقام.mp4', '../video/عد الارقام.mp4.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `videotea`
--

CREATE TABLE `videotea` (
  `video_id` int(11) NOT NULL,
  `video_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `videotea`
--

INSERT INTO `videotea` (`video_id`, `video_name`, `location`) VALUES
(7, 'عد الارقام.mp4', '../video/عد الارقام.mp4.mp4');

-- --------------------------------------------------------

--
-- Table structure for table `video_lesson`
--

CREATE TABLE `video_lesson` (
  `id` int(11) NOT NULL,
  `teacher` varchar(75) NOT NULL,
  `class` varchar(15) NOT NULL,
  `video_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `video_lesson`
--

INSERT INTO `video_lesson` (`id`, `teacher`, `class`, `video_name`, `location`) VALUES
(198, '1000052', '3', 'عد الارقام.mp4', '../corsatstudent/عد الارقام.mp4.mp4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `addtable`
--
ALTER TABLE `addtable`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `teacher` (`teacher`,`class`,`subject`),
  ADD UNIQUE KEY `teacher_2` (`teacher`,`class`,`subject`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ajaxsave`
--
ALTER TABLE `ajaxsave`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_student` (`id_student`,`type`,`id_hom`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `student_id` (`student_id`,`class`,`subject`,`date`);

--
-- Indexes for table `competition`
--
ALTER TABLE `competition`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `className` (`className`,`numOfSection`);

--
-- Indexes for table `exam_answers`
--
ALTER TABLE `exam_answers`
  ADD PRIMARY KEY (`exans_id`);

--
-- Indexes for table `exam_attempt`
--
ALTER TABLE `exam_attempt`
  ADD PRIMARY KEY (`examat_id`);

--
-- Indexes for table `exam_question_tbl`
--
ALTER TABLE `exam_question_tbl`
  ADD PRIMARY KEY (`eqt_id`);

--
-- Indexes for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  ADD PRIMARY KEY (`exam_id`);

--
-- Indexes for table `homework`
--
ALTER TABLE `homework`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lesson`
--
ALTER TABLE `lesson`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `mark`
--
ALTER TABLE `mark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `meeting`
--
ALTER TABLE `meeting`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notification`
--
ALTER TABLE `notification`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sendbirds`
--
ALTER TABLE `sendbirds`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identity_number` (`identity_number`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `subjectName` (`subjectName`);

--
-- Indexes for table `submithomework`
--
ALTER TABLE `submithomework`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `class` (`class`,`idstudent`,`subject`,`homework`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `identity_number` (`identity_number`);

--
-- Indexes for table `video`
--
ALTER TABLE `video`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `videotea`
--
ALTER TABLE `videotea`
  ADD PRIMARY KEY (`video_id`);

--
-- Indexes for table `video_lesson`
--
ALTER TABLE `video_lesson`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `addtable`
--
ALTER TABLE `addtable`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=293;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ajaxsave`
--
ALTER TABLE `ajaxsave`
  MODIFY `id` int(200) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- AUTO_INCREMENT for table `competition`
--
ALTER TABLE `competition`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `exam_answers`
--
ALTER TABLE `exam_answers`
  MODIFY `exans_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=201;

--
-- AUTO_INCREMENT for table `exam_attempt`
--
ALTER TABLE `exam_attempt`
  MODIFY `examat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=126;

--
-- AUTO_INCREMENT for table `exam_question_tbl`
--
ALTER TABLE `exam_question_tbl`
  MODIFY `eqt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `exam_tbl`
--
ALTER TABLE `exam_tbl`
  MODIFY `exam_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `homework`
--
ALTER TABLE `homework`
  MODIFY `id` int(150) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=158;

--
-- AUTO_INCREMENT for table `lesson`
--
ALTER TABLE `lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `mark`
--
ALTER TABLE `mark`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `meeting`
--
ALTER TABLE `meeting`
  MODIFY `id` int(15) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=157;

--
-- AUTO_INCREMENT for table `notification`
--
ALTER TABLE `notification`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=112;

--
-- AUTO_INCREMENT for table `sendbirds`
--
ALTER TABLE `sendbirds`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=111149;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `submithomework`
--
ALTER TABLE `submithomework`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1000057;

--
-- AUTO_INCREMENT for table `video`
--
ALTER TABLE `video`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `videotea`
--
ALTER TABLE `videotea`
  MODIFY `video_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `video_lesson`
--
ALTER TABLE `video_lesson`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=199;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
