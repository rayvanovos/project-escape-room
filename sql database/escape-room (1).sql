-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 01 jul 2025 om 07:05
-- Serverversie: 10.4.32-MariaDB
-- PHP-versie: 8.2.12

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
-- Tabelstructuur voor tabel `gebruikers`
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
-- Gegevens worden geëxporteerd voor tabel `gebruikers`
--

INSERT INTO `gebruikers` (`id`, `gebruikersnaam`, `wachtwoord`, `email`, `aangemaakt_op`, `Rol`) VALUES
(1, 'Pancake', '$2y$10$8v0q3pWamMJH8zVI3/sRp.QnKb8r/XYLRN74ClM7X92owWtwvvNWe', '07matthie@gmail.com', '2025-06-15 18:34:26', 'admin'),
(2, 'Henk', '$2y$10$Nof.1ihRzZGyYa3K473wrej/lydDffQqXWzO8mPveUyzEih9uPHTa', 'gmail@gmail.com', '2025-06-30 19:00:24', 'player');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `questions`
--

CREATE TABLE `questions` (
  `id` int(11) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(100) NOT NULL,
  `hint` varchar(255) DEFAULT NULL,
  `roomId` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `questions`
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
(12, 'what is hot and big?', 'the sun', 'its a planet that seems white or yellow', 0);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `team`
--

CREATE TABLE `team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naam` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `team`
--

INSERT INTO `team` (`id`, `naam`) VALUES
(1, 'Nr1'),
(11, 'Test4'),
(12, 'Test5'),
(13, 'Test Timer'),
(14, 'Test Timer 2'),
(15, 'Test Timer 3');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `teamlid`
--

CREATE TABLE `teamlid` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `team_id` int(11) DEFAULT NULL,
  `naam` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Gegevens worden geëxporteerd voor tabel `teamlid`
--

INSERT INTO `teamlid` (`id`, `team_id`, `naam`) VALUES
(1, 1, 'Gert'),
(18, 11, 'Henk'),
(19, 12, 'Mike'),
(20, 13, 'Timer'),
(21, 14, 'Henk'),
(22, 15, 'twest');

--
-- Indexen voor geëxporteerde tabellen
--

--
-- Indexen voor tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `gebruikersnaam` (`gebruikersnaam`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexen voor tabel `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `team`
--
ALTER TABLE `team`
  ADD PRIMARY KEY (`id`);

--
-- Indexen voor tabel `teamlid`
--
ALTER TABLE `teamlid`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT voor geëxporteerde tabellen
--

--
-- AUTO_INCREMENT voor een tabel `gebruikers`
--
ALTER TABLE `gebruikers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT voor een tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT voor een tabel `team`
--
ALTER TABLE `team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT voor een tabel `teamlid`
--
ALTER TABLE `teamlid`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
