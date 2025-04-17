-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 17, 2025 at 02:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gradtrack_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `gradtrack`
--

CREATE TABLE `gradtrack` (
  `id` int(10) UNSIGNED NOT NULL,
  `profile_picture` varchar(255) DEFAULT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `total_mark` decimal(5,2) NOT NULL,
  `percentage` decimal(5,2) NOT NULL,
  `grade` varchar(5) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `gradtrack`
--

INSERT INTO `gradtrack` (`id`, `profile_picture`, `name`, `email`, `total_mark`, `percentage`, `grade`, `created_at`) VALUES
(4, '67c833025ec2d.jpg', 'bheemulallll', 'vsd43@jhr.vo', 222.00, 77.00, 'B', '2025-03-05 11:18:26'),
(7, '67d80cb6b68cf.jpg', 'Krishan Kumar', 'endlessdabby74787@gmail.com', 344.00, 66.00, 'c', '2025-03-17 11:51:18'),
(8, '67f223ae95ed3.png', 'Ajay1', 'ajay56@gmail.com', 400.00, 87.00, 'B', '2025-04-06 06:48:15'),
(9, '67fa9360644fd.jpg', 'Caro', 'carol123@gmail.com1', 473.00, 78.00, 'c', '2025-04-12 16:22:56');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `created_at`) VALUES
(1, 'loocha', 'loocha12@gmail.com', '$2y$10$93sd8F0DQIEgH1ZSbD.1zewQamZtwwgmcUeZauntbwboGFnY3rXHO', '2025-03-03 16:24:46'),
(2, 'krish', 'vsd43@jhr.vo', '$2y$10$OnMw275htoLHaj.tnE6yBe0ZigR5Blk2WeI9d0GXibNDOPR73EmQe', '2025-03-03 16:24:46'),
(3, 'olly', 'olly12@gmail.com', '$2y$10$8gTxPM8YR/DPDTbsqAizhey4SeN16N.0BOgJehao2cWhZPnZenQtG', '2025-03-03 16:25:23'),
(4, 'happy', 'happy123@gmail.com', '$2y$10$ca8DqCs8JvvxeKrsKN95YugICVtxiQ/VatV89KY0sNPYWh4j1p8pa', '2025-03-03 16:28:33'),
(5, 'holi', 'holi2@a.com', '$2y$10$ftnXtpeheKbcI18rBk0tOOj7yHtZ4QSz2E1tpG7tSZnf49BDARu6q', '2025-03-03 16:39:01'),
(6, 'nani', 'nani@1.coj', '$2y$10$0owXlmNJWpadjaLkQLap6uqpGjW9ThaT1VucnBiY7k5SRCVxWhc4i', '2025-03-03 16:52:27'),
(7, 'raaju', 'raaju12@gmail.com', '$2y$10$dH9Gx/bmlIN/c.DDGA6eJutjrwE/IBifNJZBW557ry8kuYEZZUzP6', '2025-03-03 16:55:45'),
(8, 'om', 'om1@gmil.cl', '$2y$10$kevkI8mBzzb7iygc2ugQj.CaBEV4qX/TqAsBcTMeWO4eVs6kw1urO', '2025-03-03 17:12:48'),
(9, 'honey', 'honey1@gmial.com', '$2y$10$dsuoN7BbD3ZyFccMlAvjhOnsu0Gl4d4OrvDD7kj9iTaf2kMtTZytW', '2025-03-03 17:37:09'),
(10, 'mandy', 'mandy12@gmail.com', '$2y$10$RN689ShpOlJWFU8uJ9VFzuUOa3x.D5N1uBFIQhns3jdCCrTbdITnG', '2025-03-04 14:31:00'),
(11, 'hulk', 'hulk12@gmail.com', '$2y$10$AplKv6e7oZIQsQE39FBhz.0q6howMx.V4ScdS0Q2afmwSdsfg6uBi', '2025-03-04 14:31:32'),
(12, 'Tony', 'tony12@gmail.com', '$2y$10$5XaXoGHMNpR3CuvQrB162.UIm3OSmZZU0Q9ZtGp133T63hvU.F0JO', '2025-03-04 15:40:15'),
(13, 'Gooofy', 'Goofy1234@gmail.com', '$2y$10$GUGywWSj0prrF.wuC1UKMeMmkzxG12HiW1UWexkTUsX9TbDLHGrsG', '2025-03-04 16:50:56'),
(14, 'harry', 'harry12@gmail.com', '$2y$10$hvzZ2/Hlma0yWFKVD.NjTum1venjpCHinERwZqaYgVNm0I1SkKLga', '2025-03-04 16:52:26'),
(15, 'kenny', 'kenny2@am.pcm', '$2y$10$6HwkC5.d5RrcSxoWYVsXku8srGB0C7RNtnWNMtmRtx1qyCxhVdmaS', '2025-03-05 15:27:11'),
(16, 'gone', 'gone12@gmail.com', '$2y$10$KvdTFyHp1nB/icor6zEyh.1ZYWqKo3hrN0P3CHWZ5NSosR1ZNrbui', '2025-03-05 15:27:52'),
(17, 'Moly', 'moly12@gmail.com', '$2y$10$sp.IEeqz17vzmzk7PSGppOdY1sMz0rwAH1OYoWYdhejt5AfcSqQdG', '2025-03-05 16:26:13'),
(18, 'Dony', 'Dony1234@gmail.com', '$2y$10$Q.dNvYLJY0Y2dvFytlUNcej8bm/j7rJ87iscYsS86stMISfZVdw7m', '2025-03-17 17:20:01');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gradtrack`
--
ALTER TABLE `gradtrack`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gradtrack`
--
ALTER TABLE `gradtrack`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
