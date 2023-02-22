-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: mysql
-- Generation Time: Feb 21, 2023 at 05:43 PM
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
-- Table structure for table `editor`
--

CREATE TABLE `editor` (
                          `id` int(11) NOT NULL,
                          `content` text NOT NULL,
                          `created` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Dumping data for table `editor`
--

INSERT INTO `editor` (`id`, `content`, `created`) VALUES
                                                      (9, '&lt;p&gt;&lt;strong&gt;Welcome to TinyMCE!&lt;/strong&gt;&lt;/p&gt;', '2023-02-19 17:55:24'),
                                                      (10, '&lt;p&gt;&lt;strong&gt;Welcome to TinyMCE!&lt;/strong&gt;&lt;/p&gt;', '2023-02-19 17:55:51'),
                                                      (11, '&lt;p&gt;&lt;strong&gt;Welcome to TinyMCE!&lt;/strong&gt;&lt;/p&gt;', '2023-02-19 18:05:55'),
                                                      (12, '&lt;p&gt;&lt;strong&gt;Welcome to TinyMCE!&lt;/strong&gt;&lt;/p&gt;', '2023-02-19 18:06:07'),
                                                      (13, '&lt;p&gt;&lt;strong&gt;Welcome to TinyMCE!&lt;/strong&gt;&lt;/p&gt;', '2023-02-19 18:06:12'),
                                                      (14, '&lt;p&gt;&lt;em&gt;Welcome to TinyMCE! bruh&lt;/em&gt;&lt;/p&gt;', '2023-02-19 18:06:43'),
                                                      (15, '&lt;p&gt;Welcome to TinyMCE!&lt;/p&gt;\n&lt;p&gt;my name is jeff&lt;/p&gt;\n&lt;p&gt;&lt;s&gt;yeet&lt;/s&gt;&lt;/p&gt;', '2023-02-19 18:06:57'),
                                                      (16, '&lt;p&gt;bruh&lt;/p&gt;', '2023-02-19 18:22:24');

-- --------------------------------------------------------

--
-- Table structure for table `homePage`
--

CREATE TABLE `homePage` (
                            `title` varchar(200) NOT NULL,
                            `image` varchar(150) DEFAULT NULL,
                            `content` varchar(400) NOT NULL,
                            `prompt` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `homePage`
--

INSERT INTO `homePage` (`title`, `image`, `content`, `prompt`) VALUES
                                                                   ('History Tours in Haarlem', NULL, 'Explore the historical sites of Haarlem. It is one of the oldest cities of the Netherlands, dating back to the 10th century. Join the history events taking place in Haarlem. These events are geared towards everyone, whether they are history enthusiasts, researchers, historians, families, and so forth. Visit us and broaden your horizons.', 'History'),
                                                                   ('Music clubs in Haarlem', NULL, 'Haarlem is a young, bold and very alive city. The vicinity with Amsterdam influences a lot the musical culture of the people here. Although the dimension are smaller as the Dutch capital, in Haarlem it is possible to find the right event for every musical taste, from blues to techno.', 'Music'),
                                                                   ('Kids events in Haarlem', NULL, 'Haarlem is a beautiful city, full of parks and playgrounds of all shapes and sizes. Combining a relaxing afternoon in a park with a couple of hours in a playground and a few sweet treats would be the perfect holiday for your children. Every family is welcome here!', 'Kids'),
                                                                   ('Culinary events in Haarlem', NULL, 'Haarlem is a young, bold and very alive city, the vicinity of Amsterdam influences a lot the culinary culture of the people here, and although the dimension is smaller than the Dutch capital, in Haarlem is possible to find a restaurant to satisfy your cravings.', 'Culinary');

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
    (3, 'rares.simion08@gmail.com', '$2y$10$djE9pAOExwX29V5XRG6xe.rCKESWKmA7o1kRQxYXOpp81SzAk5.wa', 'dasdas', '2023-02-13', ' ', '2023-02-22', 'Rares Simion');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `editor`
--
ALTER TABLE `editor`
    ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
    ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `editor`
--
ALTER TABLE `editor`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
    MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
