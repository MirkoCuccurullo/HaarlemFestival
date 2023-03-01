-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 01, 2023 at 05:21 PM
-- Server version: 10.11.2-MariaDB-1:10.11.2+maria~ubu2204
-- PHP Version: 8.1.16

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
-- Table structure for table `dance_artists`
--

CREATE TABLE `dance_artists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `descirption` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dance_artists`
--

INSERT INTO `dance_artists` (`id`, `name`, `descirption`, `genre`, `picture`) VALUES
(1, 'Martin Garrix', 'house dj from netherlands', 'house', '/images/garrix.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dance_event`
--

CREATE TABLE `dance_event` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `location` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `duration` varchar(255) NOT NULL,
  `artist` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dance_event`
--

INSERT INTO `dance_event` (`id`, `date`, `location`, `price`, `duration`, `artist`) VALUES
(1, '1997-10-05', 1, '100', '30min', 1);

-- --------------------------------------------------------

--
-- Table structure for table `homePage`
--

CREATE TABLE `homePage` (
  `id` int(11) NOT NULL,
  `title` varchar(200) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `content` varchar(400) NOT NULL,
  `prompt` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homePage`
--

INSERT INTO `homePage` (`id`, `title`, `image`, `content`, `prompt`) VALUES
(21, '<h2 class=\"card-title\">History Tours in Haarlem</h2>', '<img class=\"card-img-top\" src=\"doge.jpg\" alt=\"\" width=\"400\" height=\"296\">', '<p class=\"card-text\">Explore the historical sites of Haarlem. It is one of the oldest cities of the Netherlands, dating back to the 10th century. Join the history events taking place in Haarlem. These events are gearedtowards everyone, whether they are history enthusiasts, researchers, historians, families, and so forth. Visit us and broaden your horizons.</p>', '<a class=\"btn-primary\" href=\"History\" aria-invalid=\"true\">History</a>'),
(22, '<h2 class=\"card-title\">Music clubs in Haarlem</h2>', '<img class=\"card-img-top\" src=\"doge.jpg\" alt=\"\" width=\"369\" height=\"273\">', '<p class=\"card-text\">Haarlem is a young, bold and very alive city. The vicinity with Amsterdam influences a lot&nbsp;the musical culture of the people here. Although the dimension are smaller as the Dutch capital, in&nbsp;Haarlem it is possible to find the right event for every musical taste, from blues to techno.</p>', '<a class=\"btn-primary\" href=\"Music\" aria-invalid=\"true\">Music</a>'),
(23, '<h2 class=\"card-title\">Kids events in Haarlem</h2>', '<img class=\"card-img-top\" src=\"doge.jpg\" alt=\"\" width=\"369\" height=\"273\">', '<p class=\"card-text\">Haarlem is a young, bold and very alive city. The vicinity with Amsterdam influences a lot&nbsp;the musical culture of the people here. Although the dimension are smaller as the Dutch capital, in&nbsp;Haarlem it is possible to find the right event for every musical taste, from blues to techno.</p>', '<a class=\"btn-primary\" href=\"Kids\" aria-invalid=\"true\">Kids</a>'),
(24, '<h2 class=\"card-title\">Culinary events in Haarlem</h2>', '<img class=\"card-img-top\" src=\"doge.jpg\" alt=\"\" width=\"369\" height=\"273\">', '<p class=\"card-text\">Haarlem is a young, bold and very alive city. The vicinity with Amsterdam influences a lot&nbsp;the musical culture of the people here. Although the dimension are smaller as the Dutch capital, in&nbsp;Haarlem it is possible to find the right event for every musical taste, from blues to techno.</p>', '<a class=\"btn-primary\" href=\"Culinary\" aria-invalid=\"true\">Culinary</a>');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `picture` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_bin DEFAULT NULL,
  `registration_date` date NOT NULL,
  `role` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `picture`, `registration_date`, `role`, `date_of_birth`, `name`) VALUES
(3, 'rares.simion08@gmail.com', '$2y$10$Zb8zxK5yjJHEP8AMjC74w.32jaB3Vp8SEkkJcUNv5BhyGM5EioUvK', 'dasdas', '2023-02-13', ' ', '2023-02-22', 'Rares Simion'),
(4, 'mirkocuccurullo@outlook.com', '$2y$10$0h5kiOVhifV.yRC69n9XSOlAIKA5KH8XwrUkA.Ees6iRWOy0127FC', NULL, '2023-02-28', ' ', '1997-10-05', 'Mirko');

-- --------------------------------------------------------

--
-- Table structure for table `venues`
--

CREATE TABLE `venues` (
  `id` int(11) NOT NULL,
  `address` varchar(255) NOT NULL,
  `capacity` int(11) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `venues`
--

INSERT INTO `venues` (`id`, `address`, `capacity`, `picture`, `name`, `description`) VALUES
(1, 'Haarlem', 100, '/images/jopen.jpg', 'jopenkerk', 'ex church now brewery');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `dance_artists`
--
ALTER TABLE `dance_artists`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dance_event`
--
ALTER TABLE `dance_event`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `homePage`
--
ALTER TABLE `homePage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `venues`
--
ALTER TABLE `venues`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `dance_artists`
--
ALTER TABLE `dance_artists`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `dance_event`
--
ALTER TABLE `dance_event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `homePage`
--
ALTER TABLE `homePage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `venues`
--
ALTER TABLE `venues`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
