-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 08, 2025 at 09:15 PM
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
-- Database: `task_manager`
--

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `status` enum('Pending','In Progress','Completed') DEFAULT 'Pending',
  `priority` enum('Low','Medium','High') DEFAULT 'Medium',
  `due_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `title`, `description`, `status`, `priority`, `due_date`) VALUES
(1, 1, 'Web', 'need to finish it quickly and properly', 'Completed', 'High', '2025-04-06'),
(4, 1, 'Design project complete', 'complete design project as soon as possible', 'In Progress', 'High', '2025-04-16'),
(6, 1, 'Go to airport', 'Need to pick up sister', 'Pending', 'High', '2025-04-10'),
(7, 1, 'CN Lab Open ended ', 'work 3 days in a week to complete it', 'In Progress', 'Medium', '2025-04-12'),
(8, 1, 'Buy gifts ', 'buy a good gift for sisters baby for his birthday', 'Pending', 'Medium', '2025-04-17'),
(10, 1, 'exercise', 'daily 2 hour exercise is needed. eat healthy food and sleep well. also do daily work properly.', 'In Progress', 'High', '2025-04-17'),
(12, 7, 'Office meeting', 'Preparation of meeting', 'In Progress', 'Medium', '2025-04-21'),
(13, 7, 'Complete design', 'Architectural design need to be completed for presentation', 'Pending', 'High', '2025-04-24'),
(14, 7, 'Attend marriage', 'Marriage ceremony of friend.', 'Pending', 'Low', '2025-04-11'),
(15, 8, 'Doctor appointment', 'need to check up for health issue', 'Pending', 'High', '2025-04-09'),
(16, 19, 'exercise', 'exercise  3 days', 'Completed', 'Low', '2025-04-12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'Nehan', 'nehan@gmail.com', '$2y$10$WQgegmBUhZjyMDqclk4C.upJG0U0RtqfkRB5QbJwa73fobYuVt2lK'),
(7, 'Arjina Akter Ela', 'ela@gmail.com', '$2y$10$owziNJ0fkr3yB.6vyFnSNe6nIuKQb9XgqYsm/ATPqsfkBNHWlLAq2'),
(8, 'Amir Hossain', 'amir@gmail.com', '$2y$10$u3fT9zd9Auhz4xQjRAAS6.hAKMp2KEWb/E5rx0gFEhCDtnqYVZ7MK'),
(10, 'Ayesha', 'ayesha@gmail.com', '$2y$10$STQYKwBcGgooXHQLU3MQXO4OuWiYjmrmHtN03X3T9XRniaoUK01Cu'),
(12, 'e', 'a@gmail.com', '$2y$10$QWubkDpYFXUpcN1KRpzwXei1Cfr0CHcgvxI0S59g/MJA9.lf.n8L6'),
(18, 'e', 'tttt@gmail.com', '$2y$10$CMcv.Rr1Kv.ELXc7DVbjMOAridKVH5sFCawAI7fQabttG4fKXoJhi'),
(19, 'Alif', 'Alif@gmail.com', '$2y$10$WYrM9oKVSc0eXDthUP9EROxSq5XsYm90LqkgQH1mFDMzskNLO.cB6');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `unique_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
