-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 07, 2024 at 05:21 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ics_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `account_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`account_id`, `user_id`, `user_password`, `role_id`) VALUES
(1, 'ICS-PDO6001', '$2y$10$dl1ntaVjOuhqSfJ4K4WpFeqdVcuigCGcm5xVXO.4i8xveCGJ8Y.Vm', 6),
(2, 'ICS-PRI5001', '$2y$10$QKNp82g47r0oFSx5oqLUve1ZOnrdFa26jhMV24kaoaO/e3Owp26rC', 5),
(3, 'ICS-GUI4001', '$2y$10$6uIqfq6B2ERsVCcyK5Co4.yv7Wx0iB8DNrv35HHLq1pfcY1/9gKL2', 4),
(4, 'ICS-TCH3001', '$2y$10$4sotJRcLVZg7xI1EJQzvWefgIIAjAlt7Kw2K7/7ceyAaDawZ27GHO', 3),
(5, 'ICS-TCH3002', '$2y$10$mZG81yqcD9csKnDlhnmxIOVVg8tSDdbJRLmKq6TcjIIcN0oRHmmNm', 3),
(6, 'ICS-TCH3003', '$2y$10$Zp6bPOTMxyNQjDft2wr7Qu3Zy86.egxp47RHetTyEi5FI7ShTgtAS', 3),
(7, 'ICS-TCH3004', '$2y$10$QCcJdujOHF4crENg9i/dEepp2amjjm5o38ZjCxRopTlAamy9jP4xi', 3),
(8, 'ICS-TCH3005', '$2y$10$c60lc9sm2z3xrcrmOFrjk.V/IUORvtuuWVuz.2g75PHau1G6TSjha', 3),
(9, 'ICS-TCH3006', '$2y$10$Du6wOwYMyQ83X97W64OHtuGOAelIRE6md2KqvoPygXIWLah.Mm1ge', 3),
(10, 'ICS-TCH3007', '$2y$10$vDgq3Nq0NAwVfAaZuT.PYexJ0Dy6EhN.InlrYJGvwhDHLh3f2SA0W', 3),
(11, 'ICS-TCH3008', '$2y$10$6PaHkHFIs3gqqeddt.svHO1v9bRwZuM79oSnP7bZPgI5G7XUoRTOO', 3),
(12, 'ICS-TCH3009', '$2y$10$YNfMLgovsTLjFBJe.Kad6eEPgiqCPEnNFrNwK9hjXIAnBsmlhNVQi', 3),
(13, 'ICS-TCH3010', '$2y$10$4iU1j0WlVZtSKyWtQW2kbevJ5wPViIYJ0TjsmAgX02hXOhUwQBABa', 3),
(14, 'ICS-TCH3011', '$2y$10$iG./1O7BUXgFJAeL5Jvrm.fvHuS2U5cajWwNsPzN/jJ5j5Lj0/1qS', 3),
(15, 'ICS-TCH3012', '$2y$10$KX.brFXCPfQogw2LFwxmTOkDtHptAuTVCqaC6z1ob.R1/5ByrpNPS', 3),
(16, 'ICS-TCH3013', '$2y$10$JpneWxzL2Ca1Dg4oT3TPNOWdwMmGd3WeqsBrl1uUJhRnDkI7KauKq', 3),
(17, 'ICS-TCH3014', '$2y$10$HfaZSdLZ0i.7JTL0aRv5je7sAyiUztoAmOOfRRcYlbzIdzYYcr4dO', 3),
(18, 'ICS-TCH3015', '$2y$10$WBI8iBq4egCBBTzcM4ye0Ol5gh.Apdg/xLeo2S3853j7mG0B.RZZW', 3),
(19, 'ICS-TCH3016', '$2y$10$4V3fkM7SWT9iXHPpz7BAzuF7OOsBSQFYE3vU8mP1nygoDfplCPTBi', 3),
(20, 'ICS-TCH3017', '$2y$10$yFBsfhPlwTOU0FSPzq0Pq.i/s05HD9rLl/sgXtxeU4aL1bk4o3ZCy', 3),
(21, 'ICS-TCH3018', '$2y$10$siBq0djeirXKtMCABudr5.CcAnx4QJEGwXgv001bdwJtgnrGd0huW', 3),
(22, '100000000001', '$2y$10$BhMG8S84gjHmebYEbZ9AQuaXDHvLZLLGyAJDz4tauSJzeeRuoq4Xe', 1),
(23, '100000000002', '$2y$10$eQloFsQklPTfBk7IF.n1Ae3./ZBTi64BGMG5HTL21gkTYjofE7VG.', 1),
(24, '100000000003', '$2y$10$PE7nvIMAQBVMko0frEBV.OzhuBTSB.vB6.UymkW.Kn986M25wmu22', 1),
(25, '100000000004', '$2y$10$aQppQqkupyVgsgG0SC./I.v1LdhUCba9N1qib28VqRLw7hergbuOS', 1),
(26, '100000000005', '$2y$10$MRcbDqKsDt2INcS71pd1veFWfABnICthbD2hPmiZvk031pP7upU96', 1),
(27, '100000000006', '$2y$10$6FKuim6pxUAHw4I3qNP9uOMd9mMV.VvOfKNIkOo74m9lathq2t3Nu', 1),
(28, '100000000007', '$2y$10$pjwaMjodXZomKybnuHzvCOYnfvmf3bIDO.UM4jJz2Btq4GNMh0R/2', 1),
(29, '100000000008', '$2y$10$/o9m.2OmvJ/KXlVM6yH86e0e2CDPfnAMLukohMkMg.6odFkTLEFnO', 1),
(30, '100000000009', '$2y$10$EEFsbsxV3Uy1Bvh2w4rxRe16nMm0lbk8P83QQ4MTSpYpqaunkNfVW', 1),
(31, '100000000010', '$2y$10$dUlE9tklddCbBx1cuPB5qOh0LA.hb21fqDw/1/PJSmEDUZiIfP9Jm', 1),
(32, '100000000011', '$2y$10$zPos4pYcQh5c0hFcPN5DbuDljpkuxnxmQHhpoS4t7QccromFCma9K', 1),
(33, '100000000012', '$2y$10$YQ90Nd/0bkBM4JforGNXHu8m9CFLb27H.3SogYJ/b5nm3hNWPuzXK', 1),
(34, '100000000013', '$2y$10$vk3lkKTwWTWR0/i1xsy3meNPNt8F2fEzzvAjNt./BhS81MG6Nt6ou', 1),
(35, '100000000014', '$2y$10$okIqUHL2lO/4CF7wh8.YSuZNb12bxmgAVLPCyCwbQuglLENooBVf2', 1),
(36, '100000000015', '$2y$10$dePjILm2lDxfVKjT.lwHPeisv44HflBLu4iPlHT/REj/s116PNmZe', 1),
(37, '100000000016', '$2y$10$ABSC6Rgat7FcJg3oplasnuFrNOGVxhbJn.QCQqCWAZoAaAgyLD99.', 1),
(38, '100000000017', '$2y$10$aqTHCo8VrzkpzEN8isbaa.YK3pB783tGtf8wivhiZscm2EqgujntS', 1),
(39, '100000000018', '$2y$10$sgFadQ6gs36KlFfvvAWduex0hJ5bX0/Zjj1O2DbDTFnh/3U48jKoW', 1),
(40, '100000000019', '$2y$10$uZiNHcmeR4J0Mbaby/7I2eiHISAEbtBTCwVsFaIhPC62fURyISQFG', 1),
(41, '100000000020', '$2y$10$bu/n/gi2pXhhNEz5F7.es.d9uoMuf9dQlhwAKL.GyWtVENr8meqvi', 1),
(42, '100000000021', '$2y$10$cvvsf5A5EPay8ICZkU.7Iuzskq9DtA9AtFlowZikk3xzG2PZiCqsm', 1),
(43, '100000000022', '$2y$10$zKu/MOEpYcPLCbrHmNWer.uLmM6uaETkd5ncwo3HatLlSr/5gzNja', 1),
(44, '100000000023', '$2y$10$jwV6iCE3ucGdtUR.WWVkmOJ5AP8f6u4uTrdC1.7Mn5YpFvGGyxytu', 1),
(45, '100000000024', '$2y$10$fY.jzQ3Vs1MeGv6VymrhXOTy9GrA98FvvsPT7hdEbf505Few2a4Nq', 1),
(46, '100000000025', '$2y$10$xX7LmRkYh9f6TyoT408dHekskSqH9XvPLXiKWL.G9vu4QD.GTiOPC', 1),
(47, '100000000026', '$2y$10$sBHanhwxh0aeC55ea7UWuOluaQzo64uybZ0jGYnsc/IzwByuNdNhC', 1),
(48, '100000000027', '$2y$10$pgX/HddPugKuoSpfEpiPh.WaBKtRRzTolWyZ7HGDi/tsTuFQA5ZXm', 1),
(49, '100000000028', '$2y$10$zZUltvElh35GJF.e35PUE.YQt0rMVWgxbClGl.DiD7cgBWF7ep8gO', 1),
(50, '100000000029', '$2y$10$8dypi4iFnHg3IPfL1QzV0OUPXA9Lc7fgc8E.pahdCu8UMw4Wiyb/O', 1),
(51, '100000000030', '$2y$10$ZF9dMZR//UzQmy4glWsHxOASyNbDtWGaNVS8NbGviMMt/PkXp677W', 1),
(52, '100000000031', '$2y$10$YShVS6aTyueEBQX4D6fp8OMjxc8d8EIKIf9XC/Fy5E5YJyH6bllUq', 1),
(53, '100000000032', '$2y$10$cNkpVLIj8NVETJ/NTTX9NeUvC/B0pHqfT6e7WLchMI8BgREvwGKqW', 1),
(54, '100000000033', '$2y$10$vkgPPKcLQIanaovkGpCxfepRFpW9roYob.pnorBNUPH0qCpxmbhLy', 1),
(55, '100000000034', '$2y$10$w//W6l1Qo.OSAzENZWxJoOJSofoNXRMuutqIyt1hdJsid49nxjRKW', 1),
(56, '100000000035', '$2y$10$UoHgYK9eTOG3Sx44r8gFo.c66u8SwSJXC6Zuqn1sXIjxNorVsnrwe', 1),
(57, '100000000036', '$2y$10$FOlOYIVAbAXc2LjY6D/PReGKrfN0pTQAL.NrbWt4z7DnnZxMGCavC', 1),
(58, '100000000037', '$2y$10$arRbVVLHwjqYYh/En16wLeOLwB7Rg2JtWohQGROOJeFdn8DSiYgqe', 1),
(59, '100000000038', '$2y$10$2tP6W9z70JauT5qpWux.gOo.ZnWDHFmuUZ5p8xP/HhiV7YUo9LSgK', 1),
(60, '100000000039', '$2y$10$SWFJMj.6GKYgfb4ZAbxG6eAvsUt20lN3iBcJKeyoZq93pspHPCE8m', 1),
(61, '100000000040', '$2y$10$7dihSO0h8nNvgPzJ4Fe6HuCHyLoPLHw.Xs.WZB4WBj6B92YP6SGBm', 1),
(62, '100000000041', '$2y$10$YVOBrFzVFMfdmIWG5gAXzubN5zZTL4EQoqJ0crUjF0pL3OAFqwFBi', 1),
(63, '100000000042', '$2y$10$gvzAcatf4E2E8b0z06pQf.W.wsx4hknvNauTxT4WTLVUehACsUU1e', 1),
(64, '100000000043', '$2y$10$0oAFEgqehkYfPbMw/Bm3WucvcBxmZ5ZP59so764S7zQO77GI2vi2S', 1),
(65, '100000000044', '$2y$10$UWEm.fyw2uM7wsxPMt1/F.2sxF2WLGABQg8r.jNyyWN/WqZrJujvC', 1),
(66, '100000000045', '$2y$10$xsjOtbZfVzvj1DntnrDea./tK.AndIdGakLtAebyWEdp9z3ndMmm2', 1),
(67, '100000000046', '$2y$10$6EB1Xby5rhY6xmaSLX2jKuEvTypU2fn2OK9JCghbqB/lbJk9pzgoe', 1),
(68, '100000000047', '$2y$10$E40L3s/FnG6wSj7RdJeji.zUTeGvTtbfToFqBiwnDGACafmTHKc3.', 1),
(69, '100000000048', '$2y$10$UJwlioS8V/FIGSwuF5kpFupjxMTqevQIM7dh3xMMyYLQubHcKoDJK', 1),
(70, '100000000049', '$2y$10$1bsAlz5wzZPxWp2hzJloGuyB79izFqVK.zdNmoKHaDJNxVPfOZd8K', 1),
(71, '100000000050', '$2y$10$Sh5bOn17JSvxlwxjKyXzKub7DpDVaLa/UWt8RCMlI566HbCX33gdq', 1),
(72, '100000000051', '$2y$10$/Br9tmCAg4ldUeARw.5VOOiKgXb1omx1PdlXAQx4/0lQ8g1BlhKAi', 1),
(73, '100000000052', '$2y$10$eaIG5BuU97THViwXq7xy8elisu0oeO2zUdfXmbggRXhi8HnSPWZ/S', 1),
(74, '100000000053', '$2y$10$gIOgEQc8nUtR3uy0UXmsB.t.sJ5uwhbVN.K7VgAeGBFvrHUkZFuOa', 1),
(75, '100000000054', '$2y$10$BeHlvQ9V31LLAbN4VQ39cOUtts1.Kd6M2TAjS4uneqTybZupiiI8e', 1);

-- --------------------------------------------------------

--
-- Table structure for table `announcements`
--

CREATE TABLE `announcements` (
  `announcement_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `announcement_text` text NOT NULL,
  `announcement_file` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `full_name` varchar(100) NOT NULL,
  `rank_name` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `announcements`
--

INSERT INTO `announcements` (`announcement_id`, `title`, `announcement_text`, `announcement_file`, `created_at`, `updated_at`, `full_name`, `rank_name`) VALUES
(1, 'Test 1', 'Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.', '../announcement/Sisig.jpg', '2024-09-28 09:36:30', '2024-10-21 14:13:18', 'Maranan, Bien Q.', 'Principal IV'),
(2, 'School Year 2024 Enrollment Scheduledsada', 'We are pleased to inform you that enrollment for the School Year 2024-2025 is now open! Key Dates: October 1: Start of Early Enrollment for returning students  October 15: Regular Enrollment for new students  November 5: Classes begin Please ensure to submit all the necessary requirements before the deadline. You can access the enrollment portal via the school’s website. Jelo\\\'s Sari-sari storernrnrnjfgjfgjf', '../announcement/', '2024-09-28 10:42:19', '2024-10-21 14:13:21', 'Maranan, Bien Q.', 'Principal IV'),
(10, 'asdsadad', 'dsadad', '../announcement/', '2024-09-29 12:25:06', '2024-10-21 14:13:23', 'Maranan, Bien Q.', 'Principal IV'),
(11, 'asdada', 'dasdadasd', '../announcement/Sisig.jpg', '2024-09-29 12:25:20', '2024-10-21 14:13:25', 'Maranan, Bien Q.', 'Principal IV'),
(12, 'sdasdasd', 'GASFAJISFNAskLF\r\n\r\nASDASDSA\r\n\r\n\r\nSDASDA', '../announcement/', '2024-09-29 12:25:41', '2024-10-21 14:13:27', 'Maranan, Bien Q.', 'Principal IV'),
(14, 'Lamangan 1', 'Nanlalamang na naman i2ng dalawa like wtF!!..\r\n\r\n\r\n#whenULIT\r\n#FKLEZZGo', '../announcement/', '2024-10-01 14:38:56', '2024-10-21 14:13:30', 'Maranan, Bien Q.', 'Principal IV'),
(15, 'Hello', 'This is my announcement', '../announcement/', '2024-10-21 14:33:34', '2024-10-21 14:33:34', 'Bartolome, John Joshua C.', 'Guidance Counselor');

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule`
--

CREATE TABLE `class_schedule` (
  `class_schedule_id` int(11) NOT NULL,
  `class_time` varchar(10) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `weekday` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `class_schedule`
--

INSERT INTO `class_schedule` (`class_schedule_id`, `class_time`, `subject_name`, `weekday`, `section_id`) VALUES
(1, '9:00 AM', 'Math', 'Monday', 1),
(2, '9:00 AM', 'Science', 'Tuesday', 1),
(3, '9:00 AM', 'History', 'Wednesday', 1),
(4, '9:00 AM', 'Literature', 'Thursday', 1),
(5, '9:00 AM', 'Art', 'Friday', 1),
(6, '10:00 AM', 'Chemistry', 'Monday', 1),
(7, '10:00 AM', 'Math', 'Tuesday', 1),
(8, '10:00 AM', 'Science', 'Wednesday', 1),
(9, '10:00 AM', 'History', 'Thursday', 1),
(10, '10:00 AM', 'Literature', 'Friday', 1),
(11, '11:00 AM', 'English', 'Monday', 1),
(12, '11:00 AM', 'Chemistry', 'Tuesday', 1),
(13, '11:00 AM', 'Math', 'Wednesday', 1),
(14, '11:00 AM', 'Science', 'Thursday', 1),
(15, '11:00 AM', 'History', 'Friday', 1),
(16, '12:00 PM', 'Physics', 'Monday', 1),
(17, '12:00 PM', 'English', 'Tuesday', 1),
(18, '12:00 PM', 'Chemistry', 'Wednesday', 1),
(19, '12:00 PM', 'Math', 'Thursday', 1),
(20, '12:00 PM', 'Science', 'Friday', 1),
(21, '1:00 PM', 'Literature', 'Monday', 1),
(22, '1:00 PM', 'Physics', 'Tuesday', 1),
(23, '1:00 PM', 'English', 'Wednesday', 1),
(24, '1:00 PM', 'Chemistry', 'Thursday', 1),
(25, '1:00 PM', 'Math', 'Friday', 1),
(26, '2:00 PM', 'Music', 'Monday', 1),
(27, '2:00 PM', 'Literature', 'Tuesday', 1),
(28, '2:00 PM', 'Physics', 'Wednesday', 1),
(29, '2:00 PM', 'English', 'Thursday', 1),
(30, '2:00 PM', 'Chemistry', 'Friday', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_schedule_archive`
--

CREATE TABLE `class_schedule_archive` (
  `archive_schedule_id` int(11) NOT NULL,
  `class_time` varchar(10) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `weekday` enum('Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday') NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `e_cert`
--

CREATE TABLE `e_cert` (
  `e_cert_id` int(11) NOT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL,
  `e_cert` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `e_cert`
--

INSERT INTO `e_cert` (`e_cert_id`, `subject_id`, `student_id`, `e_cert`) VALUES
(3, 0, 1010, 'ecert_672cdc11363ae.pdf');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `grade_id` int(11) NOT NULL,
  `student_id` int(11) DEFAULT NULL,
  `subject_id` int(11) DEFAULT NULL,
  `teacher_id` int(11) DEFAULT NULL,
  `academic_year` varchar(10) DEFAULT NULL,
  `first_quarter` decimal(5,2) DEFAULT NULL,
  `second_quarter` decimal(5,2) DEFAULT NULL,
  `third_quarter` decimal(5,2) DEFAULT NULL,
  `fourth_quarter` decimal(5,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`grade_id`, `student_id`, `subject_id`, `teacher_id`, `academic_year`, `first_quarter`, `second_quarter`, `third_quarter`, `fourth_quarter`) VALUES
(1, 1001, 6, 3006, '2024', '95.00', '85.00', '80.00', '83.00'),
(2, 1002, 6, 3006, '2024', '98.00', '85.00', '96.00', '88.00'),
(3, 1003, 6, 3006, '2024', '88.00', '97.00', '89.00', '97.00');

-- --------------------------------------------------------

--
-- Table structure for table `grade_level`
--

CREATE TABLE `grade_level` (
  `grade_level_id` int(11) NOT NULL,
  `grade_level` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `grade_level`
--

INSERT INTO `grade_level` (`grade_level_id`, `grade_level`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6);

-- --------------------------------------------------------

--
-- Table structure for table `guidance`
--

CREATE TABLE `guidance` (
  `guidance_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `guidance`
--

INSERT INTO `guidance` (`guidance_id`, `first_name`, `middle_name`, `last_name`, `email`, `role_id`, `rank_id`) VALUES
(4001, 'ken', 'mercado', 'mercado', 'ken@gmail.com', 4, 18);

-- --------------------------------------------------------

--
-- Table structure for table `ics_credential`
--

CREATE TABLE `ics_credential` (
  `account_id` int(11) NOT NULL,
  `user_id` varchar(20) NOT NULL,
  `user_password` varchar(50) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `parent`
--

CREATE TABLE `parent` (
  `parent_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `address` varchar(100) DEFAULT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `parent`
--

INSERT INTO `parent` (`parent_id`, `first_name`, `middle_name`, `last_name`, `email`, `phone_number`, `address`, `role_id`) VALUES
(2001, 'Juan', 'Andres', 'Dela Cruz', 'juan.delacruz@example.com', '09123456789', 'Brgy. Batangas City, Batangas', 2),
(2002, 'Maria', 'Santos', 'Reyes', 'maria.reyes@example.com', '09123456780', 'Brgy. San Jose, Batangas City', 2),
(2003, 'Jose', 'Lopez', 'Flores', 'jose.flores@example.com', '09123456781', 'Brgy. Wawa, Batangas City', 2),
(2004, 'Ana', 'Dela Torre', 'Mendoza', 'ana.mendoza@example.com', '09123456782', 'Brgy. Alangilan, Batangas City', 2),
(2005, 'David', 'Mercado', 'Gonzalez', 'david.gonzalez@example.com', '09123456783', 'Brgy. San Luis, Batangas City', 2),
(2006, 'Jessica', 'Luna', 'Torres', 'jessica.torres@example.com', '09123456784', 'Brgy. Pallocan, Batangas City', 2),
(2007, 'Robert', 'Salvador', 'Bautista', 'robert.bautista@example.com', '09123456785', 'Brgy. Gulod, Batangas City', 2),
(2008, 'Laura', 'Buenaventura', 'Aquino', 'laura.aquino@example.com', '09123456786', 'Brgy. Libjo, Batangas City', 2),
(2009, 'James', 'Cabrera', 'Ramos', 'james.ramos@example.com', '09123456787', 'Brgy. Sta. Clara, Batangas City', 2),
(2010, 'Linda', 'Garcia', 'Villanueva', 'linda.villanueva@example.com', '09123456788', 'Brgy. Balagtas, Batangas City', 2),
(2011, 'Mark', 'Diaz', 'Delos Santos', 'mark.delossantos@example.com', '09123456789', 'Brgy. San Pascual, Batangas City', 2),
(2012, 'Anna', 'Pascual', 'Gomez', 'anna.gomez@example.com', '09123456790', 'Brgy. Calicanto, Batangas City', 2),
(2013, 'Brian', 'Manalang', 'Padilla', 'brian.padilla@example.com', '09123456791', 'Brgy. Concepcion, Batangas City', 2),
(2014, 'Elizabeth', 'Soriano', 'Castro', 'elizabeth.castro@example.com', '09123456792', 'Brgy. San Carlos, Batangas City', 2),
(2015, 'Steven', 'Navarro', 'Rivera', 'steven.rivera@example.com', '09123456793', 'Brgy. Loma, Batangas City', 2),
(2016, 'Amy', 'Fernandez', 'Ortega', 'amy.ortega@example.com', '09123456794', 'Brgy. Mataasnakahoy, Batangas City', 2),
(2017, 'Joshua', 'Marasigan', 'Lazaro', 'joshua.lazaro@example.com', '09123456795', 'Brgy. Sico, Batangas City', 2),
(2018, 'Sophia', 'Ramos', 'Santiago', 'sophia.santiago@example.com', '09123456796', 'Brgy. Taal, Batangas City', 2),
(2019, 'Carlos', 'Ocampo', 'Alvarez', 'carlos.alvarez@example.com', '09123456797', 'Brgy. Libis, Batangas City', 2),
(2020, 'Rebecca', 'Ibarra', 'Cruz', 'rebecca.cruz@example.com', '09123456798', 'Brgy. Bagong Silang, Batangas City', 2),
(2021, 'Michael', 'Cuenca', 'Bautista', 'michael.bautista@example.com', '09123456799', 'Brgy. Ilijan, Batangas City', 2),
(2022, 'Nina', 'Llamas', 'Magsaysay', 'nina.magsaysay@example.com', '09123456800', 'Brgy. San Isidro, Batangas City', 2),
(2023, 'Rafael', 'Velasco', 'Cordero', 'rafael.cordero@example.com', '09123456801', 'Brgy. San Antonio, Batangas City', 2),
(2024, 'Julia', 'Alcantara', 'Morales', 'julia.morales@example.com', '09123456802', 'Brgy. Bolbok, Batangas City', 2),
(2025, 'Pedro', 'Bacani', 'Diokno', 'pedro.diokno@example.com', '09123456803', 'Brgy. San Vicente, Batangas City', 2),
(2026, 'Claudia', 'Cruz', 'Nieves', 'claudia.nieves@example.com', '09123456804', 'Brgy. Banay-Banay, Batangas City', 2),
(2027, 'Victor', 'Estrada', 'Salvador', 'victor.salvador@example.com', '09123456805', 'Brgy. Malitam, Batangas City', 2),
(2028, 'Isabel', 'Marquez', 'Paz', 'isabel.paz@example.com', '09123456806', 'Brgy. Marawoy, Batangas City', 2),
(2029, 'Leo', 'Tan', 'Pascual', 'leo.pascual@example.com', '09123456807', 'Brgy. San Juan, Batangas City', 2),
(2030, 'Carmen', 'Aguilar', 'Sison', 'carmen.sison@example.com', '09123456808', 'Brgy. Batangas, Batangas City', 2),
(2031, 'Wendy', 'Bautista', 'Ferrer', 'wendy.ferrer@example.com', '09123456809', 'Brgy. Buli, Batangas City', 2),
(2032, 'Evelyn', 'Lim', 'Pineda', 'evelyn.pineda@example.com', '09123456810', 'Brgy. Biga, Batangas City', 2),
(2033, 'Ramon', 'Quinto', 'Toribio', 'ramon.toribio@example.com', '09123456811', 'Brgy. Lower Bicutan, Batangas City', 2),
(2034, 'Ella', 'Rosales', 'Alfaro', 'ella.alfaro@example.com', '09123456812', 'Brgy. Banga, Batangas City', 2),
(2035, 'Carlos', 'Rizal', 'Quintero', 'carlos.quintero@example.com', '09123456813', 'Brgy. San Miguel, Batangas City', 2),
(2036, 'Nina', 'De Guzman', 'Guevarra', 'nina.guevarra@example.com', '09123456814', 'Brgy. Sitio Pook, Batangas City', 2),
(2037, 'Marco', 'Manalo', 'Castro', 'marco.castro@example.com', '09123456815', 'Brgy. Brgy. 6, Batangas City', 2),
(2038, 'Bela', 'Padua', 'Manalaysay', 'bela.manalaysay@example.com', '09123456816', 'Brgy. San Luis, Batangas City', 2),
(2039, 'Lara', 'Almoite', 'Alcantara', 'lara.alcantara@example.com', '09123456817', 'Brgy. 11, Batangas City', 2),
(2040, 'Gina', 'Dizon', 'Bongat', 'gina.bongat@example.com', '09123456818', 'Brgy. 4, Batangas City', 2),
(2041, 'Henry', 'Cruz', 'Bilaro', 'henry.bilaro@example.com', '09123456819', 'Brgy. 2, Batangas City', 2),
(2042, 'Daisy', 'Aguilar', 'Lalangan', 'daisy.lalangan@example.com', '09123456820', 'Brgy. 9, Batangas City', 2),
(2043, 'Joey', 'Enriquez', 'Gamboa', 'joey.gamboa@example.com', '09123456821', 'Brgy. 10, Batangas City', 2),
(2044, 'Flora', 'Resurreccion', 'Anacore', 'flora.anacore@example.com', '09123456822', 'Brgy. 3, Batangas City', 2),
(2045, 'Tina', 'Sabino', 'Ocampo', 'tina.ocampo@example.com', '09123456823', 'Brgy. 1, Batangas City', 2),
(2046, 'Henry', 'Soriano', 'De Vera', 'henry.devera@example.com', '09123456824', 'Brgy. 5, Batangas City', 2),
(2047, 'Ronald', 'Ferrer', 'Manalo', 'ronald.manalo@example.com', '09123456825', 'Brgy. 8, Batangas City', 2),
(2048, 'Christine', 'Bautista', 'Alvarado', 'christine.alvarado@example.com', '09123456826', 'Brgy. Manggahan, Batangas City', 2),
(2049, 'Arnel', 'Riviera', 'Pablo', 'arnel.pablo@example.com', '09123456827', 'Brgy. Maricaban, Batangas City', 2),
(2050, 'Sharon', 'Valdez', 'Delos Santos', 'sharon.delossantos@example.com', '09123456828', 'Brgy. As-Is, Batangas City', 2),
(2051, 'Greg', 'Tan', 'Quezada', 'greg.quezada@example.com', '09123456829', 'Brgy. San Pedro, Batangas City', 2),
(2052, 'Grace', 'Gonzalez', 'Martinez', 'grace.martinez@example.com', '09123456830', 'Brgy. Pook, Batangas City', 2),
(2053, 'Ferdinand', 'Cruz', 'Alarcon', 'ferdinand.alarcon@example.com', '09123456831', 'Brgy. Santo Niño, Batangas City', 2),
(2054, 'Angelica', 'Bautista', 'Pineda', 'angelica.pineda@example.com', '09123456832', 'Brgy. Tinga Labac, Batangas City', 2),
(2055, 'Burnik', '', 'Panaligan', 'jannangelodimaano@gmail.com', '9454210467', 'Wawa, Batangas City', 2);

-- --------------------------------------------------------

--
-- Table structure for table `pdo`
--

CREATE TABLE `pdo` (
  `pdo_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `pdo`
--

INSERT INTO `pdo` (`pdo_id`, `first_name`, `middle_name`, `last_name`, `email`, `role_id`, `rank_id`) VALUES
(6001, 'john', 'Zara', 'juan', 'juan@gmail.com', 6, 19);

-- --------------------------------------------------------

--
-- Table structure for table `principal`
--

CREATE TABLE `principal` (
  `principal_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `role_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `principal`
--

INSERT INTO `principal` (`principal_id`, `first_name`, `middle_name`, `last_name`, `email`, `role_id`, `rank_id`) VALUES
(5001, 'drake', 'Quintano', 'dimagiba', 'dimagiba@gmail.com', 5, 17);

-- --------------------------------------------------------

--
-- Table structure for table `rank`
--

CREATE TABLE `rank` (
  `rank_id` int(11) NOT NULL,
  `rank_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `rank`
--

INSERT INTO `rank` (`rank_id`, `rank_name`) VALUES
(1, 'Teacher I'),
(2, 'Teacher II'),
(3, 'Teacher III'),
(4, 'Teacher IV'),
(5, 'Teacher V'),
(6, 'Teacher VI'),
(7, 'Teacher VII'),
(8, 'Teacher VIII'),
(9, 'Master Teacher I'),
(10, 'Master Teacher II'),
(11, 'Master Teacher III'),
(12, 'Master Teacher IV'),
(13, 'Master Teacher V'),
(14, 'Principal I'),
(15, 'Principal II'),
(16, 'Principal III'),
(17, 'Principal IV'),
(18, 'Guidance Counselor'),
(19, 'Project Development Office');

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`role_id`, `role_name`) VALUES
(1, 'Student'),
(2, 'Parent'),
(3, 'Teacher'),
(4, 'Guidance'),
(5, 'Principal'),
(6, 'PDO');

-- --------------------------------------------------------

--
-- Table structure for table `schedule_list`
--

CREATE TABLE `schedule_list` (
  `id` int(30) NOT NULL,
  `title` text NOT NULL,
  `description` text NOT NULL,
  `start_datetime` datetime NOT NULL,
  `end_datetime` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule_list`
--

INSERT INTO `schedule_list` (`id`, `title`, `description`, `start_datetime`, `end_datetime`) VALUES
(7, 'dasdada', 'dadadacadaa', '2024-09-27 21:50:00', '2024-09-29 23:51:00'),
(8, 'dasdadadada', 'dadadacadaadasdad', '2024-09-27 21:50:00', '2024-09-29 23:51:00'),
(9, 'dasda', 'dasfasfxacac', '2024-09-23 22:15:00', '2024-09-23 12:15:00'),
(10, 'midterm_exam', 'bagsakan na', '2024-10-28 15:47:00', '2024-10-30 15:47:00');

-- --------------------------------------------------------

--
-- Table structure for table `school_materials`
--

CREATE TABLE `school_materials` (
  `school_materials_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `school_materials` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `section`
--

CREATE TABLE `section` (
  `section_id` int(11) NOT NULL,
  `section_name` varchar(100) DEFAULT NULL,
  `grade_level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `section`
--

INSERT INTO `section` (`section_id`, `section_name`, `grade_level_id`) VALUES
(1, 'Emerald', 1),
(2, 'Ruby', 1),
(3, 'Sapphire', 1),
(4, 'Diamond', 2),
(5, 'Topaz', 2),
(6, 'Garnet', 2),
(7, 'Amethyst', 3),
(8, 'Opal', 3),
(9, 'Quartz', 3),
(10, 'Peridot', 4),
(11, 'Jade', 4),
(12, 'Aquamarine', 4),
(13, 'Onyx', 5),
(14, 'Amber', 5),
(15, 'Pearl', 5),
(16, 'Coral', 6),
(17, 'Ivory', 6),
(18, 'Obsidian', 6);

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(11) NOT NULL,
  `lrn` bigint(12) DEFAULT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `sex` varchar(10) NOT NULL,
  `date_of_birth` date NOT NULL,
  `current_status` varchar(20) NOT NULL,
  `academic_year` varchar(9) NOT NULL,
  `parent_id` int(11) NOT NULL,
  `grade_level_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `lrn`, `first_name`, `middle_name`, `last_name`, `sex`, `date_of_birth`, `current_status`, `academic_year`, `parent_id`, `grade_level_id`, `section_id`, `role_id`) VALUES
(1001, 100000000001, 'Luis', 'Dela Cruz', 'Dela Cruz', 'male', '2013-01-15', 'enrolled', '2024-2025', 2001, 1, 1, 1),
(1002, 100000000002, 'Maria', 'Dela Cruz', 'Dela Cruz', 'female', '2013-02-20', 'enrolled', '2024-2025', 2002, 1, 1, 1),
(1003, 100000000003, 'Andres', 'Dela Cruz', 'Dela Cruz', 'male', '2013-03-12', 'enrolled', '2024-2025', 2003, 1, 1, 1),
(1004, 100000000004, 'Carmen', 'Dela Cruz', 'Dela Cruz', 'female', '2013-04-05', 'enrolled', '2024-2025', 2004, 1, 2, 1),
(1005, 100000000005, 'Jose', 'Dela Cruz', 'Dela Cruz', 'male', '2013-05-10', 'enrolled', '2024-2025', 2005, 1, 2, 1),
(1006, 100000000006, 'Elena', 'Dela Cruz', 'Dela Cruz', 'female', '2013-06-25', 'enrolled', '2024-2025', 2006, 1, 2, 1),
(1007, 100000000007, 'Fernando', 'Dela Cruz', 'Dela Cruz', 'male', '2013-07-30', 'enrolled', '2024-2025', 2007, 1, 3, 1),
(1008, 100000000008, 'Raquel', 'Dela Cruz', 'Dela Cruz', 'female', '2013-08-15', 'enrolled', '2024-2025', 2008, 1, 3, 1),
(1009, 100000000009, 'Gabriel', 'Dela Cruz', 'Dela Cruz', 'male', '2013-09-05', 'enrolled', '2024-2025', 2009, 1, 3, 1),
(1010, 100000000010, 'Pedro', 'Delos Reyes', 'Delos Reyes', 'male', '2014-01-11', 'enrolled', '2024-2025', 2010, 2, 4, 1),
(1011, 100000000011, 'Sofia', 'Delos Reyes', 'Delos Reyes', 'female', '2014-02-14', 'enrolled', '2024-2025', 2011, 2, 4, 1),
(1012, 100000000012, 'Rico', 'Delos Reyes', 'Delos Reyes', 'male', '2014-03-20', 'enrolled', '2024-2025', 2012, 2, 4, 1),
(1013, 100000000013, 'Lia', 'Delos Reyes', 'Delos Reyes', 'female', '2014-04-18', 'enrolled', '2024-2025', 2013, 2, 5, 1),
(1014, 100000000014, 'Samuel', 'Delos Reyes', 'Delos Reyes', 'male', '2014-05-25', 'enrolled', '2024-2025', 2014, 2, 5, 1),
(1015, 100000000015, 'Nina', 'Delos Reyes', 'Delos Reyes', 'female', '2014-06-30', 'enrolled', '2024-2025', 2015, 2, 5, 1),
(1016, 100000000016, 'Miguel', 'Delos Reyes', 'Delos Reyes', 'male', '2014-07-15', 'enrolled', '2024-2025', 2016, 2, 6, 1),
(1017, 100000000017, 'Marisol', 'Delos Reyes', 'Delos Reyes', 'female', '2014-08-10', 'enrolled', '2024-2025', 2017, 2, 6, 1),
(1018, 100000000018, 'Hector', 'Delos Reyes', 'Delos Reyes', 'male', '2014-09-25', 'enrolled', '2024-2025', 2018, 2, 6, 1),
(1019, 100000000019, 'Daniel', 'Bautista', 'Bautista', 'male', '2015-01-19', 'enrolled', '2024-2025', 2019, 3, 7, 1),
(1020, 100000000020, 'Liza', 'Bautista', 'Bautista', 'female', '2015-02-22', 'enrolled', '2024-2025', 2020, 3, 7, 1),
(1021, 100000000021, 'Jorge', 'Bautista', 'Bautista', 'male', '2015-03-15', 'enrolled', '2024-2025', 2021, 3, 7, 1),
(1022, 100000000022, 'Vivian', 'Bautista', 'Bautista', 'female', '2015-04-08', 'enrolled', '2024-2025', 2022, 3, 8, 1),
(1023, 100000000023, 'Eric', 'Bautista', 'Bautista', 'male', '2015-05-23', 'enrolled', '2024-2025', 2023, 3, 8, 1),
(1024, 100000000024, 'Raquel', 'Bautista', 'Bautista', 'female', '2015-06-30', 'enrolled', '2024-2025', 2024, 3, 8, 1),
(1025, 100000000025, 'Alvin', 'Bautista', 'Bautista', 'male', '2015-07-15', 'enrolled', '2024-2025', 2025, 3, 9, 1),
(1026, 100000000026, 'Giselle', 'Bautista', 'Bautista', 'female', '2015-08-12', 'enrolled', '2024-2025', 2026, 3, 9, 1),
(1027, 100000000027, 'Felipe', 'Bautista', 'Bautista', 'male', '2015-09-11', 'enrolled', '2024-2025', 2027, 3, 9, 1),
(1028, 100000000028, 'Carlos', 'Cruz', 'Cruz', 'male', '2016-01-01', 'enrolled', '2024-2025', 2028, 4, 10, 1),
(1029, 100000000029, 'Daisy', 'Cruz', 'Cruz', 'female', '2016-02-10', 'enrolled', '2024-2025', 2029, 4, 10, 1),
(1030, 100000000030, 'Antonio', 'Cruz', 'Cruz', 'male', '2016-03-22', 'enrolled', '2024-2025', 2030, 4, 10, 1),
(1031, 100000000031, 'Cecilia', 'Cruz', 'Cruz', 'female', '2016-04-12', 'enrolled', '2024-2025', 2031, 4, 11, 1),
(1032, 100000000032, 'Greg', 'Cruz', 'Cruz', 'male', '2016-05-30', 'enrolled', '2024-2025', 2032, 4, 11, 1),
(1033, 100000000033, 'Lia', 'Cruz', 'Cruz', 'female', '2016-06-15', 'enrolled', '2024-2025', 2033, 4, 11, 1),
(1034, 100000000034, 'Alvin', 'Cruz', 'Cruz', 'male', '2016-07-21', 'enrolled', '2024-2025', 2034, 4, 12, 1),
(1035, 100000000035, 'Ivy', 'Cruz', 'Cruz', 'female', '2016-08-11', 'enrolled', '2024-2025', 2035, 4, 12, 1),
(1036, 100000000036, 'Nico', 'Cruz', 'Cruz', 'male', '2016-09-18', 'enrolled', '2024-2025', 2036, 4, 12, 1),
(1037, 100000000037, 'David', 'Santos', 'Santos', 'male', '2017-01-14', 'enrolled', '2024-2025', 2037, 5, 13, 1),
(1038, 100000000038, 'Rita', 'Santos', 'Santos', 'female', '2017-02-20', 'enrolled', '2024-2025', 2038, 5, 13, 1),
(1039, 100000000039, 'Hugo', 'Santos', 'Santos', 'male', '2017-03-05', 'enrolled', '2024-2025', 2039, 5, 13, 1),
(1040, 100000000040, 'Tina', 'Santos', 'Santos', 'female', '2017-04-27', 'enrolled', '2024-2025', 2040, 5, 14, 1),
(1041, 100000000041, 'Paul', 'Santos', 'Santos', 'male', '2017-05-17', 'enrolled', '2024-2025', 2041, 5, 14, 1),
(1042, 100000000042, 'Clara', 'Santos', 'Santos', 'female', '2017-06-21', 'enrolled', '2024-2025', 2042, 5, 14, 1),
(1043, 100000000043, 'Ben', 'Santos', 'Santos', 'male', '2017-07-10', 'enrolled', '2024-2025', 2043, 5, 15, 1),
(1044, 100000000044, 'Ella', 'Santos', 'Santos', 'female', '2017-08-16', 'enrolled', '2024-2025', 2044, 5, 15, 1),
(1045, 100000000045, 'Ramon', 'Santos', 'Santos', 'male', '2017-09-15', 'enrolled', '2024-2025', 2045, 5, 15, 1),
(1046, 100000000046, 'Faye', 'Luna', 'Luna', 'female', '2018-01-25', 'enrolled', '2024-2025', 2046, 6, 16, 1),
(1047, 100000000047, 'Manny', 'Luna', 'Luna', 'male', '2018-02-13', 'enrolled', '2024-2025', 2047, 6, 16, 1),
(1048, 100000000048, 'Lily', 'Luna', 'Luna', 'female', '2018-03-14', 'enrolled', '2024-2025', 2048, 6, 16, 1),
(1049, 100000000049, 'Marco', 'Luna', 'Luna', 'male', '2018-04-22', 'enrolled', '2024-2025', 2049, 6, 17, 1),
(1050, 100000000050, 'Zara', 'Luna', 'Luna', 'female', '2018-05-30', 'enrolled', '2024-2025', 2050, 6, 17, 1),
(1051, 100000000051, 'Leo', 'Luna', 'Luna', 'male', '2018-06-15', 'enrolled', '2024-2025', 2051, 6, 17, 1),
(1052, 100000000052, 'Cathy', 'Luna', 'Luna', 'female', '2018-08-18', 'enrolled', '2024-2025', 2052, 6, 18, 1),
(1053, 100000000053, 'Jay', 'Luna', 'Luna', 'male', '2018-09-27', 'enrolled', '2024-2025', 2053, 6, 18, 1),
(1054, 100000000054, 'Nina', 'Luna', 'Luna', 'female', '2018-10-05', 'enrolled', '2024-2025', 2054, 6, 18, 1),
(1055, NULL, 'Laurence', 'Mendoza', 'Panaligan', 'male', '2002-10-21', 'enrolled', '2024-2025', 2055, 6, 17, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_archives`
--

CREATE TABLE `student_archives` (
  `archive_id` int(11) NOT NULL,
  `lrn` bigint(12) DEFAULT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `date_of_birth` date DEFAULT NULL,
  `current_status` varchar(20) DEFAULT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `section_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_archives`
--

INSERT INTO `student_archives` (`archive_id`, `lrn`, `first_name`, `last_name`, `date_of_birth`, `current_status`, `parent_id`, `section_id`) VALUES
(1, 2147483647, 'Pedro', 'Delos Reyes', '2014-01-11', 'enrolled', 2010, 4),
(2, 2147483647, 'Pedro', 'Delos Reyes', '2014-01-11', 'passed', 2010, 4),
(3, 2147483647, 'Pedro', 'Delos Reyes', '2014-01-11', 'enrolled', 2010, 4),
(5, 2147483647, 'Pedro', 'Delos Reyes', '2014-01-11', 'enrolled', 2010, 4),
(7, 2147483647, 'Rico', 'Delos Reyes', '2014-03-20', 'enrolled', 2012, 4),
(8, 2147483647, 'Rico', 'Delos Reyes', '2014-03-20', 'retained', 2012, 4),
(9, 2147483647, 'Rico', 'Delos Reyes', '2014-03-20', 'retained', 2012, 4),
(10, 2147483647, 'Hector', 'Delos Reyes', '2014-09-25', 'retained', 2018, 6),
(11, 2147483647, 'Pedro', 'Delos Reyes', '2014-01-11', 'retained', 2010, 4),
(12, 100000000010, 'Pedro', 'Delos Reyes', '2014-01-11', 'retained', 2010, 4);

-- --------------------------------------------------------

--
-- Table structure for table `student_file`
--

CREATE TABLE `student_file` (
  `student_file_id` int(11) NOT NULL,
  `student_picture` varchar(100) NOT NULL,
  `psa_birth_certificate` varchar(100) DEFAULT NULL,
  `progress_report_card` varchar(100) DEFAULT NULL,
  `medical_assessment` varchar(100) DEFAULT NULL,
  `student_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `student_file`
--

INSERT INTO `student_file` (`student_file_id`, `student_picture`, `psa_birth_certificate`, `progress_report_card`, `medical_assessment`, `student_id`) VALUES
(1, '../uploads/casual_white.jpg', '../uploads/DIMAANO-IT-413-Laboratory-Activity-3 CVSS.pdf', '../uploads/DIMAANO-IT-413-Laboratory-Activity-3 CVSS.pdf', '../uploads/DIMAANO-IT-413-Laboratory-Activity-3 CVSS.pdf', 1055);

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `subject_id` int(11) NOT NULL,
  `subject_name` varchar(100) DEFAULT NULL,
  `grade_level_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`subject_id`, `subject_name`, `grade_level_id`) VALUES
(1, 'Basic Math', 1),
(2, 'Introduction to Algebra', 2),
(3, 'Geometry Fundamentals', 3),
(4, 'Advanced Algebra', 4),
(5, 'Pre-Calculus', 5),
(6, 'Calculus', 6),
(7, 'Phonics and Reading', 1),
(8, 'Grammar and Composition', 2),
(9, 'Literature Studies', 3),
(10, 'Creative Writing', 4),
(11, 'Essay Writing', 5),
(12, 'Advanced Literature', 6),
(13, 'Introduction to Science', 1),
(14, 'Life Science', 2),
(15, 'Earth Science', 3),
(16, 'Physical Science', 4),
(17, 'Biology', 5),
(18, 'Chemistry', 6);

-- --------------------------------------------------------

--
-- Table structure for table `teacher`
--

CREATE TABLE `teacher` (
  `teacher_id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `middle_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `section_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `rank_id` int(11) NOT NULL,
  `account_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher`
--

INSERT INTO `teacher` (`teacher_id`, `first_name`, `middle_name`, `last_name`, `email`, `section_id`, `subject_id`, `role_id`, `rank_id`, `account_id`) VALUES
(3001, 'Jann', 'Naruto', 'Uzumaki', 'naruto@gmail.com', 1, 1, 3, 10, 1),
(3002, 'Emily', 'Santos', 'Reyes', 'emily.reyes@example.com', 2, 2, 3, 1, 2),
(3003, 'Michael', 'Lopez', 'Flores', 'michael.flores@example.com', 3, 3, 3, 3, 3),
(3004, 'Sarah', 'Dela Cruz', 'Mendoza', 'sarah.mendoza@example.com', 4, 4, 3, 9, 4),
(3005, 'David', 'Mercado', 'Gonzalez', 'david.gonzalez@example.com', 5, 5, 3, 11, 5),
(3006, 'Jessica', 'Luna', 'Torres', 'jessica.torres@example.com', 6, 6, 3, 3, 6),
(3007, 'Robert', 'Salvador', 'Bautista', 'robert.bautista@example.com', 7, 7, 3, 5, 7),
(3008, 'Laura', 'Buenaventura', 'Aquino', 'laura.aquino@example.com', 8, 8, 3, 3, 8),
(3009, 'James', 'Cabrera', 'Ramos', 'james.ramos@example.com', 9, 9, 3, 13, 9),
(3010, 'Linda', 'Garcia', 'Villanueva', 'linda.villanueva@example.com', 10, 10, 3, 3, 10),
(3011, 'Mark', 'Diaz', 'Delos Santos', 'mark.delossantos@example.com', 11, 11, 3, 13, 11),
(3012, 'Anna', 'Pascual', 'Gomez', 'anna.gomez@example.com', 12, 12, 3, 4, 12),
(3013, 'Brian', 'Manalang', 'Padilla', 'brian.padilla@example.com', 13, 13, 3, 6, 13),
(3014, 'Elizabeth', 'Soriano', 'Castro', 'elizabeth.castro@example.com', 14, 14, 3, 5, 14),
(3015, 'Steven', 'Navarro', 'Rivera', 'steven.rivera@example.com', 15, 15, 3, 7, 15),
(3016, 'Amy', 'Fernandez', 'Ortega', 'amy.ortega@example.com', 16, 16, 3, 7, 16),
(3017, 'Joshua', 'Marasigan', 'Lazaro', 'joshua.lazaro@example.com', 17, 17, 3, 1, 17),
(3018, 'Sophia', 'Ramos', 'Santiago', 'sophia.santiago@example.com', 18, 18, 3, 7, 18);

-- --------------------------------------------------------

--
-- Table structure for table `teacher_section`
--

CREATE TABLE `teacher_section` (
  `teacher_section_id` int(11) NOT NULL,
  `teacher_id` int(11) NOT NULL,
  `section_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `teacher_section`
--

INSERT INTO `teacher_section` (`teacher_section_id`, `teacher_id`, `section_id`) VALUES
(1, 3001, 1),
(2, 3001, 2),
(3, 3001, 3),
(4, 3002, 1),
(5, 3002, 2),
(6, 3002, 3),
(7, 3003, 1),
(8, 3003, 2),
(9, 3003, 3),
(10, 3004, 4),
(11, 3004, 5),
(12, 3004, 6),
(13, 3005, 4),
(14, 3005, 5),
(15, 3005, 6),
(16, 3006, 4),
(17, 3006, 5),
(18, 3006, 6),
(19, 3007, 7),
(20, 3007, 8),
(21, 3007, 9),
(22, 3008, 7),
(23, 3008, 8),
(24, 3008, 9),
(25, 3009, 7),
(26, 3009, 8),
(27, 3009, 9),
(28, 3010, 10),
(29, 3010, 11),
(30, 3010, 12),
(31, 3011, 10),
(32, 3011, 11),
(33, 3011, 12),
(34, 3012, 10),
(35, 3012, 11),
(36, 3012, 12),
(37, 3013, 13),
(38, 3013, 14),
(39, 3013, 15),
(40, 3014, 13),
(41, 3014, 14),
(42, 3014, 15),
(43, 3015, 13),
(44, 3015, 14),
(45, 3015, 15),
(46, 3016, 16),
(47, 3016, 17),
(48, 3016, 18),
(49, 3017, 16),
(50, 3017, 17),
(51, 3017, 18),
(52, 3018, 16),
(53, 3018, 17),
(54, 3018, 18);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `announcements`
--
ALTER TABLE `announcements`
  ADD PRIMARY KEY (`announcement_id`);

--
-- Indexes for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD PRIMARY KEY (`class_schedule_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `class_schedule_archive`
--
ALTER TABLE `class_schedule_archive`
  ADD PRIMARY KEY (`archive_schedule_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `e_cert`
--
ALTER TABLE `e_cert`
  ADD PRIMARY KEY (`e_cert_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`grade_id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `subject_id` (`subject_id`),
  ADD KEY `teacher_id` (`teacher_id`);

--
-- Indexes for table `grade_level`
--
ALTER TABLE `grade_level`
  ADD PRIMARY KEY (`grade_level_id`);

--
-- Indexes for table `guidance`
--
ALTER TABLE `guidance`
  ADD PRIMARY KEY (`guidance_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `ics_credential`
--
ALTER TABLE `ics_credential`
  ADD PRIMARY KEY (`account_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `parent`
--
ALTER TABLE `parent`
  ADD PRIMARY KEY (`parent_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `pdo`
--
ALTER TABLE `pdo`
  ADD PRIMARY KEY (`pdo_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `principal`
--
ALTER TABLE `principal`
  ADD PRIMARY KEY (`principal_id`),
  ADD KEY `role_id` (`role_id`);

--
-- Indexes for table `rank`
--
ALTER TABLE `rank`
  ADD PRIMARY KEY (`rank_id`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `schedule_list`
--
ALTER TABLE `schedule_list`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `school_materials`
--
ALTER TABLE `school_materials`
  ADD PRIMARY KEY (`school_materials_id`);

--
-- Indexes for table `section`
--
ALTER TABLE `section`
  ADD PRIMARY KEY (`section_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `section_id` (`section_id`),
  ADD KEY `parent_id` (`parent_id`);

--
-- Indexes for table `student_archives`
--
ALTER TABLE `student_archives`
  ADD PRIMARY KEY (`archive_id`),
  ADD KEY `parent_id` (`parent_id`),
  ADD KEY `section_id` (`section_id`);

--
-- Indexes for table `student_file`
--
ALTER TABLE `student_file`
  ADD PRIMARY KEY (`student_file_id`),
  ADD KEY `student_id` (`student_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`subject_id`);

--
-- Indexes for table `teacher`
--
ALTER TABLE `teacher`
  ADD PRIMARY KEY (`teacher_id`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `subject_id` (`section_id`),
  ADD KEY `fk_teacher_account` (`account_id`);

--
-- Indexes for table `teacher_section`
--
ALTER TABLE `teacher_section`
  ADD PRIMARY KEY (`teacher_section_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account`
--
ALTER TABLE `account`
  MODIFY `account_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `announcements`
--
ALTER TABLE `announcements`
  MODIFY `announcement_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `class_schedule`
--
ALTER TABLE `class_schedule`
  MODIFY `class_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `class_schedule_archive`
--
ALTER TABLE `class_schedule_archive`
  MODIFY `archive_schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `e_cert`
--
ALTER TABLE `e_cert`
  MODIFY `e_cert_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `grade_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `grade_level`
--
ALTER TABLE `grade_level`
  MODIFY `grade_level_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `guidance`
--
ALTER TABLE `guidance`
  MODIFY `guidance_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4002;

--
-- AUTO_INCREMENT for table `parent`
--
ALTER TABLE `parent`
  MODIFY `parent_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2056;

--
-- AUTO_INCREMENT for table `pdo`
--
ALTER TABLE `pdo`
  MODIFY `pdo_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6002;

--
-- AUTO_INCREMENT for table `principal`
--
ALTER TABLE `principal`
  MODIFY `principal_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5002;

--
-- AUTO_INCREMENT for table `rank`
--
ALTER TABLE `rank`
  MODIFY `rank_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `schedule_list`
--
ALTER TABLE `schedule_list`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `school_materials`
--
ALTER TABLE `school_materials`
  MODIFY `school_materials_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `section`
--
ALTER TABLE `section`
  MODIFY `section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1056;

--
-- AUTO_INCREMENT for table `student_archives`
--
ALTER TABLE `student_archives`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `student_file`
--
ALTER TABLE `student_file`
  MODIFY `student_file_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `subject_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `teacher`
--
ALTER TABLE `teacher`
  MODIFY `teacher_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3019;

--
-- AUTO_INCREMENT for table `teacher_section`
--
ALTER TABLE `teacher_section`
  MODIFY `teacher_section_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `account`
--
ALTER TABLE `account`
  ADD CONSTRAINT `account_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `class_schedule`
--
ALTER TABLE `class_schedule`
  ADD CONSTRAINT `class_schedule_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);

--
-- Constraints for table `class_schedule_archive`
--
ALTER TABLE `class_schedule_archive`
  ADD CONSTRAINT `class_schedule_archive_ibfk_1` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);

--
-- Constraints for table `e_cert`
--
ALTER TABLE `e_cert`
  ADD CONSTRAINT `e_cert_ibfk_1` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `e_cert_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `grade_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`),
  ADD CONSTRAINT `grade_ibfk_2` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`subject_id`),
  ADD CONSTRAINT `grade_ibfk_3` FOREIGN KEY (`teacher_id`) REFERENCES `teacher` (`teacher_id`);

--
-- Constraints for table `guidance`
--
ALTER TABLE `guidance`
  ADD CONSTRAINT `guidance_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `ics_credential`
--
ALTER TABLE `ics_credential`
  ADD CONSTRAINT `ics_credential_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `parent`
--
ALTER TABLE `parent`
  ADD CONSTRAINT `parent_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `pdo`
--
ALTER TABLE `pdo`
  ADD CONSTRAINT `pdo_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `principal`
--
ALTER TABLE `principal`
  ADD CONSTRAINT `principal_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`),
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`parent_id`) REFERENCES `parent` (`parent_id`);

--
-- Constraints for table `student_archives`
--
ALTER TABLE `student_archives`
  ADD CONSTRAINT `student_archives_ibfk_1` FOREIGN KEY (`parent_id`) REFERENCES `parent` (`parent_id`),
  ADD CONSTRAINT `student_archives_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `section` (`section_id`);

--
-- Constraints for table `student_file`
--
ALTER TABLE `student_file`
  ADD CONSTRAINT `student_file_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`student_id`);

--
-- Constraints for table `teacher`
--
ALTER TABLE `teacher`
  ADD CONSTRAINT `teacher_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `role` (`role_id`),
  ADD CONSTRAINT `teacher_ibfk_2` FOREIGN KEY (`section_id`) REFERENCES `subject` (`subject_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
