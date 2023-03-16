-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Mar 05, 2023 at 01:06 PM
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
-- Table structure for table `dance_artists`
--

CREATE TABLE `dance_artists` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `picture` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dance_artists`
--

INSERT INTO `dance_artists` (`id`, `name`, `description`, `genre`, `picture`) VALUES
(2, 'Martin Garrix', 'Dutch DJ', 'House', '/images/garrix.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `dance_event`
--

CREATE TABLE `dance_event` (
  `id` int(11) NOT NULL,
  `date` date NOT NULL,
  `location` int(11) NOT NULL,
  `price` varchar(255) NOT NULL,
  `start_time` time NOT NULL,
  `artist` int(11) NOT NULL,
  `end_time` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `dance_event`
--

INSERT INTO `dance_event` (`id`, `date`, `location`, `price`, `start_time`, `artist`, `end_time`) VALUES
(2, '2023-03-10', 1, '100', '12:17:00', 2, '15:16:00');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` varchar(255) NOT NULL,
  `ticketBooked` int(3) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`id`, `name`, `description`, `ticketBooked`) VALUES
(1, 'Restaurant ML', 'Restaurant ML is located in the heart of the charming national monument at Klokhuisplein. The elegant cuisine of chefs Mark Gratama is daring due to the exciting combination of flavors.', NULL),
(2, 'French Bistro Toujours ', 'For an intimate, cosy and beautiful dinner with friends or family, take a seat in our beautiful restaurant area. With radiant daylight thanks to the domes on our roof.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `eventPhotos`
--

CREATE TABLE `eventPhotos` (
  `photo` varchar(255) NOT NULL,
  `type` varchar(100) NOT NULL,
  `referenceId` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `eventPhotos`
--

INSERT INTO `eventPhotos` (`photo`, `type`, `referenceId`) VALUES
('<img class=\"card-img-top\" src=\"doge.jpg\" alt=\"\" width=\"400\" height=\"296\">', 'homePage', NULL);

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
-- Table structure for table `restaurant`
--

CREATE TABLE `restaurant` (
  `address` varchar(255) NOT NULL,
  `cuisines` varchar(100) NOT NULL,
  `dietary` varchar(255) NOT NULL,
  `restaurantId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `restaurant`
--

INSERT INTO `restaurant` (`address`, `cuisines`, `dietary`, `restaurantId`) VALUES
('Klokhuisplein 9, 2011 HK Haarlem', 'Dutch, Fish and Seafood, European', 'Vegetarian Friendly, Vegan Options, Gluten Free Options', 1);

-- --------------------------------------------------------

--
-- Table structure for table `sessionRestaurant`
--

CREATE TABLE `sessionRestaurant` (
  `sessionId` int(11) NOT NULL,
  `startTime` time(6) NOT NULL,
  `endTime` time(6) NOT NULL,
  `capacity` int(11) NOT NULL,
  `date` date NOT NULL,
  `reservationPrice` int(2) NOT NULL,
  `restaurantId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `sessionRestaurant`
--

INSERT INTO `sessionRestaurant` (`sessionId`, `startTime`, `endTime`, `capacity`, `date`, `reservationPrice`, `restaurantId`) VALUES
(1, '17:00:00.000000', '19:00:00.000000', 20, '2023-07-21', 0, 1),
(2, '19:00:00.000000', '21:00:00.000000', 20, '2023-07-21', 0, 1);

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
(3, 'rares.simion08@gmail.com', '$2y$10$Zb8zxK5yjJHEP8AMjC74w.32jaB3Vp8SEkkJcUNv5BhyGM5EioUvK', 'dasdas', '2023-02-13', ' ', '2023-02-22', 'Rares Simion');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id` (`id`),
  ADD KEY `id_2` (`id`);

--
-- Indexes for table `eventPhotos`
--
ALTER TABLE `eventPhotos`
  ADD KEY `referenceId` (`referenceId`);

--
-- Indexes for table `homePage`
--
ALTER TABLE `homePage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD UNIQUE KEY `restaurantId` (`restaurantId`);

--
-- Indexes for table `sessionRestaurant`
--
ALTER TABLE `sessionRestaurant`
  ADD PRIMARY KEY (`sessionId`),
  ADD KEY `restaurantId` (`restaurantId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `homePage`
--
ALTER TABLE `homePage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `sessionRestaurant`
--
ALTER TABLE `sessionRestaurant`
  MODIFY `sessionId` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `restaurant`
--
ALTER TABLE `restaurant`
  ADD CONSTRAINT `restaurant_ibfk_1` FOREIGN KEY (`restaurantId`) REFERENCES `event` (`id`);

--
-- Constraints for table `sessionRestaurant`
--
ALTER TABLE `sessionRestaurant`
  ADD CONSTRAINT `sessionRestaurant_ibfk_1` FOREIGN KEY (`restaurantId`) REFERENCES `event` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
