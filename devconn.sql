-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2021 at 06:31 PM
-- Server version: 10.4.13-MariaDB
-- PHP Version: 7.2.32

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `devconn`
--

-- --------------------------------------------------------

--
-- Table structure for table `friends`
--

CREATE TABLE `friends` (
  `id` int(11) NOT NULL,
  `user` varchar(256) NOT NULL,
  `friend` varchar(256) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `friends`
--

INSERT INTO `friends` (`id`, `user`, `friend`) VALUES
(1, 'monkey@gmail.com', 'bishwa@gmail.com'),
(2, 'monkey@gmail.com', 'mark@gmail.com'),
(3, 'bishwa@gmail.com', 'anna@gmail.com'),
(4, 'anna@gmail.com', 'bishwa@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `likes`
--

CREATE TABLE `likes` (
  `id` int(255) NOT NULL,
  `post_like` int(255) NOT NULL,
  `post` int(11) NOT NULL,
  `liked_by` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `likes`
--

INSERT INTO `likes` (`id`, `post_like`, `post`, `liked_by`) VALUES
(11, 1, 2, 'anna@gmail.com'),
(12, 1, 1, 'anna@gmail.com'),
(13, 1, 2, 'bishwa@gmail.com'),
(14, 1, 2, 'monkey@gmail.com'),
(15, 1, 4, 'monkey@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `members`
--

CREATE TABLE `members` (
  `id` int(16) NOT NULL,
  `username` varchar(256) DEFAULT NULL,
  `email` varchar(256) DEFAULT NULL,
  `password` varchar(256) DEFAULT NULL,
  `profession` varchar(255) DEFAULT NULL,
  `bio` varchar(2000) DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `github` varchar(255) DEFAULT NULL,
  `education` varchar(256) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `profile_pic` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `members`
--

INSERT INTO `members` (`id`, `username`, `email`, `password`, `profession`, `bio`, `address`, `github`, `education`, `dob`, `profile_pic`) VALUES
(4, 'Bissi', 'bishwa@gmail.com', '12345', 'Software', 'Hi ! My Name Is Bishwahang Dewan . I\'m A Front-End Developer At Google. I love listening to music', 'Silicon', 'Bishwahangdewan', 'Stanford', NULL, '04profile.png'),
(8, 'Monkey D luffy', 'monkey@gmail.com', '12345', 'Pirate King', 'I am Monkey D Luffy . I will be the greatest Pirate King.', 'East Blue', 'sdfsdfsdf', 'sdfsdfsdfsdf', NULL, '44001d.jpg'),
(9, 'Mark Johnson', 'mark@gmail.com', '12345', 'DevOps Engineer', 'I am a Devops engineer', NULL, NULL, NULL, NULL, NULL),
(10, 'Anna Stewart', 'anna@gmail.com', '12345', 'Graphic Designer / Front-End Developer', 'I\'m a Graphic Designer at XYS . I also do some Front End Stuffs.', 'Boston , MA', 'anna564', 'University of Waterloo', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `messages`
--

CREATE TABLE `messages` (
  `id` int(11) NOT NULL,
  `message` longtext NOT NULL,
  `sender` varchar(255) NOT NULL,
  `receiver` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `messages`
--

INSERT INTO `messages` (`id`, `message`, `sender`, `receiver`, `created_at`) VALUES
(9, 'Hi', 'anna@gmail.com', 'bishwa@gmail.com', '2021-08-21 10:08:14'),
(10, 'How r you ?', 'anna@gmail.com', 'bishwa@gmail.com', '2021-08-21 10:09:39'),
(22, 'Hi Anna , I\'m fine What about you ?', 'bishwa@gmail.com', 'anna@gmail.com', '2021-08-21 15:11:19'),
(23, 'Are You in town right now??', 'bishwa@gmail.com', 'anna@gmail.com', '2021-08-21 15:22:36'),
(24, 'Lets meet up...', 'bishwa@gmail.com', 'anna@gmail.com', '2021-08-21 15:36:29'),
(25, 'If you are free...', 'bishwa@gmail.com', 'anna@gmail.com', '2021-08-21 15:36:41'),
(26, 'Okay sure Lets meet up tomorrow..', 'anna@gmail.com', 'bishwa@gmail.com', '2021-08-21 15:37:37');

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(255) NOT NULL,
  `caption` varchar(255) DEFAULT NULL,
  `post_pic` varchar(255) DEFAULT NULL,
  `likes` int(11) NOT NULL,
  `posted_by` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `caption`, `post_pic`, `likes`, `posted_by`, `created_at`) VALUES
(1, 'I\'m stuck in this project.', '', 1, 'bishwa@gmail.com', '2021-08-20 06:51:23'),
(2, 'sdfsdf', '50001c.jpg', 3, 'bishwa@gmail.com', '2021-08-20 07:09:50'),
(3, 'I feel sick right now', '', 0, 'monkey@gmail.com', '2021-08-21 15:59:12'),
(4, 'I WANT TO BREAK FREE !!!!', '', 1, 'monkey@gmail.com', '2021-08-21 16:02:09');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `friends`
--
ALTER TABLE `friends`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `likes`
--
ALTER TABLE `likes`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `members`
--
ALTER TABLE `members`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `messages`
--
ALTER TABLE `messages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `friends`
--
ALTER TABLE `friends`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `likes`
--
ALTER TABLE `likes`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `members`
--
ALTER TABLE `members`
  MODIFY `id` int(16) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `messages`
--
ALTER TABLE `messages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
