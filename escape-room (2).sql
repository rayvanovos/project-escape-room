-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 01, 2025 at 10:06 AM
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
-- Database: `escape-room`
--

-- --------------------------------------------------------

--
-- Table structure for table `gebruikers`
--

CREATE TABLE `gebruikers` (
  `id` int(11) NOT NULL,
  `gebruikersnaam` varchar(50) NOT NULL,
  `wachtwoord` varchar(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `aangemaakt_op` timestamp NOT NULL DEFAULT current_timestamp(),
  `Rol` enum('player','admin') NOT NULL DEFAULT 'player'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `gebruikersnaam`, `wachtwoord`, `email`, `aangemaakt_op`, `Rol`) VALUES
(1, 'Pancake', '$2y$10$8v0q3pWamMJH8zVI3/sRp.QnKb8r/XYLRN74ClM7X92owWtwvvNWe', '07matthie@gmail.com', '2025-06-15 18:34:26', 'admin'),
(2, 'Henk', '$2y$10$Nof.1ihRzZGyYa3K473wrej/lydDffQqXWzO8mPveUyzEih9uPHTa', 'gmail@gmail.com', '2025-06-30 19:00:24', 'player'),
(3, 'Bert', '$2y$10$DVCSy70qeJVh7G5HPAhjg.RLP99mLxykc7ZGQzZMlqFrfI.wD2ii2', 'bert@gmail.com', '2025-07-01 07:29:53', 'player'),
(4, 'Test', '$2y$10$aMM5tE3Ngns4DuiYuBO5oulAaAmJsGtzGtJVmoX29McJeyrdu0MbC', 'Test@gmail.com', '2025-07-01 07:56:47', 'player');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `roomId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`id`, `question`, `answer`, `hint`, `roomId`) VALUES
(1, '\"I’m a space traveler with a tail, rarely seen but never stale. What am I?\"', 'comet', 'rock that moves', 1),
(2, 'Use this clue to find a number code: \"Count the number of planets in the solar system and multiply it by the number of Earth’s moons.\"', '8', '1 moon', 1),
(3, 'What spacecraft carried the first humans to the Moon?', 'Apollo 11', 'the number 11 belongs to it', 1),
(4, 'Which planet is known as the \"Red Planet\"?', 'mars', 'close to earth', 2),
(5, 'If Mercury is the 1st planet from the Sun and Neptune is the 8th, what planet is 4th?', 'mars', 'one before Jupiter', 2),
(6, '\"I light up the night, but I’m not a star. I pull the oceans from afar. What am I?\"', 'the moon', '\"You see me most nights, and sometimes I’m full, sometimes I hide.', 2),
(7, 'Wat is de naam van de professor in de eerste Pokémon-games?', 'Professor Oak', 'Hij deelt je eerste Pokémon uit.', 3),
(8, 'Welke kleur heeft shiny Charizard?', 'Zwart', 'Anders dan zijn originele oranje kleur.', 3),
(9, 'Wat gebruik je om een wilde Pokémon te vangen?', 'Pokéball', 'Je gooit het naar een Pokémon.', 3),
(13, 'What is big hot and yellow?', 'the sun', 'its visible during day', 0);

-- --------------------------------------------------------

--
-- Table structure for table `team`
--

CREATE TABLE `team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naam` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team`
--

INSERT INTO `team` (`id`, `naam`) VALUES
(11, 'Test4'),
(12, 'Test5'),
(13, 'Test Timer'),
(14, 'Test Timer 2'),
(15, 'Test Timer 3'),
(16, 'Timer test 5'),
(17, 'Test win+times'),
(18, 'Test win+times2'),
(19, 'Testroom1'),
(20, 'Testroom1'),
(21, 'Testroom1'),
(22, 'test'),
(23, 'timertest'),
(24, 'bert team'),
(25, 'bert team'),
(26, 'berg'),
(27, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `teamlid`
--

CREATE TABLE `teamlid` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `naam` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `teamlid`
--

INSERT INTO `teamlid` (`id`, `team_id`, `naam`) VALUES
(18, 11, 'Henk'),
(19, 12, 'Mike'),
(20, 13, 'Timer'),
(21, 14, 'Henk'),
(22, 15, 'twest'),
(23, 16, 'timer'),
(24, 17, 'Henk'),
(25, 18, 'Henk'),
(26, 19, 'room1'),
(27, 20, 'room1'),
(28, 21, 'room1'),
(29, 22, 'test'),
(30, 23, 'jksdgs'),
(31, 24, '1'),
(32, 25, '1'),
(33, 26, '2'),
(34, 27, 'Test');

-- --------------------------------------------------------

--
-- Table structure for table `team_times`
--

CREATE TABLE `team_times` (
  `id` int(11) NOT NULL,
  `team_name` varchar(100) NOT NULL,
  `start_time` datetime NOT NULL,
  `end_time` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `team_times`
--

INSERT INTO `team_times` (`id`, `team_name`, `start_time`, `end_time`) VALUES
(12, 'Onbekend', '2025-07-01 08:33:13', '2025-07-01 09:46:30'),
(13, 'nr1', '2025-07-01 08:33:13', '2025-07-01 09:57:57');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gebruikersnaam` (`gebruikersnaam`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `teamlid`
--
ALTER TABLE `teamlid`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `team_times`
--
ALTER TABLE `team_times`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `team`
--
ALTER TABLE `team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `teamlid`
--
ALTER TABLE `teamlid`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT for table `team_times`
--
ALTER TABLE `team_times`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
