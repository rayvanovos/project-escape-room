-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Gegenereerd op: 27 jun 2025 om 17:02
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
(1, 'Pancake', '$2y$10$8v0q3pWamMJH8zVI3/sRp.QnKb8r/XYLRN74ClM7X92owWtwvvNWe', '07matthie@gmail.com', '2025-06-15 18:34:26', 'admin');

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
(1, 'in what game began an demonic invasion on mars?', 'DOOM', 'the main character is an super soldier.', 1),
(2, 'what is the alien called from the alien movie?', 'xenomorph', 'it has a long tail, its black and has a long head.', 1),
(3, 'what do you call the giant space ship from the imperials in star wars.', 'star destroyer', 'its the main ship of the imperials in star wars and is always used by the stormtroopers', 1),
(4, 'What happens if you fall in space?', 'nothing', 'its \'\'space\'\'', 2),
(5, 'What do austronauts eat?', 'They don\'t eat', 'do they have solid food?', 2),
(6, 'is space dangerous?', 'yes', 'astroids?', 2),
(7, 'Wat is de naam van de professor in de eerste Pokémon-games?', 'Professor Oak', 'Hij deelt je eerste Pokémon uit.', 3),
(8, 'Welke kleur heeft shiny Charizard?', 'Zwart', 'Anders dan zijn originele oranje kleur.', 3),
(9, 'Wat gebruik je om een wilde Pokémon te vangen?', 'Pokéball', 'Je gooit het naar een Pokémon.', 3);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `team`
--

CREATE TABLE `team` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `naam` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT voor een tabel `questions`
--
ALTER TABLE `questions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT voor een tabel `team`
--
ALTER TABLE `team`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT voor een tabel `teamlid`
--
ALTER TABLE `teamlid`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
