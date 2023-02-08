-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Jan 11, 2023 at 01:24 PM
-- Server version: 10.9.4-MariaDB-1:10.9.4+maria~ubu2204
-- PHP Version: 8.0.25

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `developmentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `type` int(11) NOT NULL,
  `google_token` varchar(255) DEFAULT NULL,
  `google_refresh_token` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `firstname`, `email`, `type`, `google_token`, `google_refresh_token`) VALUES
(1, 'Mirko', 'praticissimoissimo@gmail.com', 1, 'ya29.a0AX9GBdU-p0SazaCWKN_RDHZYkv1izS7AQu6MnBrsK0PDlbmS5v44ok_Bjbv-ANIdoLIeqlA-W326Ynu1iJZHPU20Vc4Mue-bVBXpg-WSyjeJ_XqIzaARol_3TLpqxwFQaTREPJEdVrWU0wMavZlYN1_fvFsEaCgYKARUSARASFQHUCsbCcbs8cIfsSM9U44QDH1OSKA0163', ' ');

-- --------------------------------------------------------

--
-- Table structure for table `employee_type`
--

CREATE TABLE `employee_type` (
  `type_id` int(11) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_type`
--

INSERT INTO `employee_type` (`type_id`, `description`) VALUES
(1, 'Criminal'),
(2, 'Public'),
(3, 'Civil');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `client_name` varchar(255) NOT NULL,
  `lawyer_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `time_from` time NOT NULL,
  `time_to` time NOT NULL,
  `google_calendar_event_id` varchar(255) DEFAULT NULL,
  `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `client_name`, `lawyer_id`, `date`, `time_from`, `time_to`, `google_calendar_event_id`, `created`) VALUES
(111, '2 trial', 1, '2023-01-17', '19:42:00', '20:42:00', 'tc80ekgqalqansn4obkmrob76s', '2023-01-09 13:47:01'),
(112, 'hello', 1, '2023-01-10', '18:54:00', '20:54:00', 'rhddpkicf97k2ciuld4if1e42c', '2023-01-09 13:55:01'),
(113, 'hey', 1, '2023-01-10', '18:59:00', '20:59:00', NULL, '2023-01-09 14:00:03'),
(114, 'ejf', 1, '2023-01-10', '18:08:00', '20:08:00', 'qe4acj9s26a23upv9cgesf4d84', '2023-01-09 14:08:43'),
(115, 'pijgssoijgd', 1, '2023-01-18', '20:11:00', '21:11:00', 'scl29fnafntiblo1oum3en02lg', '2023-01-09 14:11:50'),
(116, 'uzftu', 1, '2023-01-10', '19:13:00', '21:13:00', '8m0lgk7m8ome8rf80rpq5a0fgo', '2023-01-09 14:13:11'),
(117, 'poi', 1, '2023-02-07', '20:14:00', '21:14:00', '8mud49cj4jf5ojrkp6lditdd80', '2023-01-09 14:14:49'),
(118, 'uggzu', 1, '2023-01-03', '20:18:00', '21:18:00', 'cvl1n04itu8urb94bhuuq26vl8', '2023-01-09 14:18:13'),
(119, 'hibsviubwv', 1, '2023-01-10', '18:19:00', '20:19:00', '1qok53fei55oah2dpqcisrqvnk', '2023-01-09 14:19:23'),
(132, '2 trial', 1, '2023-01-10', '12:20:00', '14:20:00', NULL, '2023-01-09 19:20:50'),
(133, 'hello', 1, '2023-01-10', '23:22:00', '12:22:00', NULL, '2023-01-09 19:22:31'),
(134, 'hello', 1, '2023-01-10', '13:22:00', '14:22:00', 'rnap3vuehh5rlfg342djovftn4', '2023-01-09 19:22:59'),
(136, 'Valerio Compleanno', 1, '2023-02-02', '22:24:00', '13:24:00', NULL, '2023-01-09 19:25:56'),
(138, 'Valerio Compleanno', 1, '2023-02-02', '23:30:00', '14:30:00', NULL, '2023-01-09 19:30:06'),
(139, 'Valerio Compleanno', 1, '2023-02-02', '22:24:00', '13:24:00', NULL, '2023-01-09 19:30:28'),
(140, 'Valerio Compleanno', 1, '2023-02-02', '22:24:00', '13:24:00', NULL, '2023-01-09 19:31:12'),
(141, 'Valerio Compleanno', 1, '2023-01-10', '12:34:00', '14:34:00', '6hh1qu7arhu5haeadjgi812skk', '2023-01-09 19:34:22'),
(142, 'Valerio Compleanno', 1, '2023-02-02', '21:35:00', '17:35:00', NULL, '2023-01-09 19:35:32'),
(143, 'Valerio Compleanno', 1, '2023-02-02', '12:36:00', '14:37:00', '3nkauc3mut59t3igdq758vb6fo', '2023-01-09 19:37:04'),
(144, '2 trial', 1, '2023-01-11', '12:37:00', '13:37:00', 'ffdas0n9o7os2cvg1t3c52k0q4', '2023-01-09 19:37:26'),
(145, 'Valerio Compleanno', 1, '2023-02-02', '10:39:00', '14:39:00', 'vs5u1e4jc2inorrnkd80vtgdh0', '2023-01-09 19:39:52'),
(146, 'Valerio Compleanno', 1, '2023-02-02', '11:42:00', '20:42:00', 'be8eie798tf0k8rjf3s9e7as5c', '2023-01-09 19:42:37'),
(147, '2 trial', 1, '2023-01-10', '15:01:00', '16:01:00', 'aphmil1m61vfab43eedr0n4glk', '2023-01-09 21:01:49'),
(148, 'Valerio Compleanno', 1, '2023-01-10', '14:04:00', '16:04:00', 'sqsgsj0aut9tbu1i2jev8145v0', '2023-01-09 21:05:01'),
(149, 'hello', 1, '2023-01-11', '00:37:00', '02:37:00', NULL, '2023-01-10 08:37:16'),
(150, '2 trial', 1, '2023-01-11', '12:38:00', '14:38:00', NULL, '2023-01-10 08:38:56'),
(151, 'Test no auth', 1, '2023-01-11', '00:41:00', '03:41:00', NULL, '2023-01-10 08:41:45'),
(152, 'Test appointment', 1, '2023-01-11', '12:44:00', '02:44:00', NULL, '2023-01-10 08:44:57'),
(153, 'Test no auth', 1, '2023-01-24', '11:46:00', '14:46:00', 'bubp65nmdkniq9h8h907t8saf0', '2023-01-10 08:46:35'),
(154, 'hello', 1, '2023-01-11', '14:10:00', '04:10:00', NULL, '2023-01-10 09:10:27'),
(155, '2 trial', 1, '2023-01-11', '16:32:00', '17:32:00', NULL, '2023-01-10 11:32:20'),
(156, 'qwdfghj', 1, '2023-01-11', '15:34:00', '17:34:00', NULL, '2023-01-10 11:34:29'),
(157, 'sdf', 1, '2023-01-11', '15:34:00', '16:34:00', NULL, '2023-01-10 11:35:01'),
(158, 'asdvb', 1, '2023-01-10', '15:35:00', '15:35:00', NULL, '2023-01-10 11:35:42'),
(159, 'asdvb', 1, '2023-01-10', '15:35:00', '15:35:00', NULL, '2023-01-10 11:36:27'),
(160, 'asdcvb', 1, '2023-01-10', '14:38:00', '17:38:00', NULL, '2023-01-10 11:38:08'),
(161, 'Rares', 1, '2023-01-29', '02:40:00', '18:40:00', '18a55c03t159ea5ns2b98bj890', '2023-01-10 11:40:14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `firstname`, `email`, `password`) VALUES
(4, 'mirko', 'mirko@email.com', '$2y$10$Ni9wQD3Rw3c/j/tsQNkFYu9yMIKY8QZ8V1isHJ8gMw1Xz4q8z3Lau'),
(5, 'rebecca', 'rebecca@email.com', '$2y$10$D5UtoQdcyrqkl.sMWDznVueLH8FpmpQ5Ijyb3ybfR65im7bR3HTBi');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employee_type`
--
ALTER TABLE `employee_type`
  ADD PRIMARY KEY (`type_id`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employee_type`
--
ALTER TABLE `employee_type`
  MODIFY `type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=162;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
