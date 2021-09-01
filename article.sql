-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 27, 2021 at 02:57 PM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `php_cms`
--

-- --------------------------------------------------------

--
-- Table structure for table `article`
--

CREATE TABLE `article` (
  `id` int(11) NOT NULL,
  `title` varchar(128) COLLATE utf8mb4_unicode_ci NOT NULL,
  `content` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `published_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `article`
--

INSERT INTO `article` (`id`, `title`, `content`, `published_at`) VALUES
(1, 'First post', 'this is the first of many posts', '2021-08-18 08:52:05'),
(2, 'Second post', 'The is some more post content', '2021-08-19 08:52:05'),
(3, 'More posts', 'Yet more content', '2021-08-19 08:32:48'),
(4, 'How many post now!', 'Yada yada yada', '2021-08-19 06:36:48'),
(5, 'Many posts later', 'Here is some posts added in from the back end.', '2021-08-19 09:01:58'),
(6, 'Posting is the shizniz', 'Here are some of my awesome thoughts ', '2021-08-19 13:27:09'),
(7, 'Posting is the best', 'We like to post things so that people can read', '2021-08-21 10:24:25'),
(8, 'Sql insert', 'Will it work?', NULL),
(9, 'dolor sit', 'amet consectetur adipisicing elit.', NULL),
(10, 'Delectus saepe', 'doloribus eveniet voluptates, veniam rerum sapiente distinctio facere magni soluta.', NULL),
(11, 'Spiderman PS5', 'Can I buy this game. Please ', '2021-08-05 14:41:00'),
(12, '\r\n                New day game!', 'Just some random content', '2021-08-23 09:33:00'),
(13, '12 o\'Clock Meeting', 'To pick up a game', '2021-08-23 10:36:00'),
(14, 'Server side validation test', 'This is a test to see if my server side validation works', '2021-08-24 10:40:00'),
(15, 'One more', 'For the road', '2021-08-24 10:44:00'),
(17, 'Farcry 6', 'Cant wait for this game', '0000-00-00 00:00:00'),
(41, 'This is working nicely', 'Content is important', '0000-00-00 00:00:00'),
(42, 'Escaping special characters', 'Adding HTML special char will help stop cross-site scripting attacts', '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `article`
--
ALTER TABLE `article`
  ADD PRIMARY KEY (`id`),
  ADD KEY `title` (`title`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `article`
--
ALTER TABLE `article`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
