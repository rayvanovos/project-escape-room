-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 30, 2025 at 04:21 PM
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
(1, 'in what game began an demonic invasion on mars?', 'DOOM', 'the main character is an super soldier.', 1),
(2, 'what is the alien called from the alien movie?', 'xenomorph', 'it has a long tail, its black and has a long head.', 1),
(3, 'what do you call the giant space ship from the imperials in star wars.', 'star destroyer', 'its the main ship of the imperials in star wars and is always used by the stormtroopers', 1),
(4, 'Wat gebeurt er als Magikarp level 20 bereikt?', 'Gyarados', 'Van nutteloos naar legendarisch!', 2),
(5, 'Wat is super effectief tegen een water-type Pokémon?', 'Gras', 'Denk aan elementaire logica: wat groeit in water?', 2),
(6, 'Welke legendarische vogel hoort bij het element ijs?', 'Articuno', 'Zijn naam begint met \"Arti...\".', 2),
(7, 'Wat is de naam van de professor in de eerste Pokémon-games?', 'Professor Oak', 'Hij deelt je eerste Pokémon uit.', 3),
(8, 'Welke kleur heeft shiny Charizard?', 'Zwart', 'Anders dan zijn originele oranje kleur.', 3),
(9, 'Wat gebruik je om een wilde Pokémon te vangen?', 'Pokéball', 'Je gooit het naar een Pokémon.', 3);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
