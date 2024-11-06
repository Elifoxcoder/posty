-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 06. Nov 2024 um 06:56
-- Server-Version: 10.4.32-MariaDB
-- PHP-Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Datenbank: `posty2`
--

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `poster` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `description` text NOT NULL,
  `images` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `posts`
--

INSERT INTO `posts` (`id`, `poster`, `created_at`, `description`, `images`) VALUES
(20, 1, '2024-11-03 12:16:47', 'So Sigma', '[\".\\/uploads\\/6128653-PXL_20241103_105513072-min.jpg\"]'),
(21, 1, '2024-11-03 12:16:48', 'So Sigma', '[\".\\/uploads\\/8552720-PXL_20241103_105513072-min.jpg\"]'),
(22, 1, '2024-11-03 12:26:03', 'Hallo', '[\".\\/uploads\\/2264739-file_example_MP3_1MG.mp3\"]'),
(23, 1, '2024-11-04 10:51:10', 'AURA', '[\".\\/uploads\\/9481303-Ogryzek - AURA (Official Visualiser).mp3\"]'),
(24, 1, '2024-11-04 11:08:39', 'AURA Visualizer', '[\".\\/uploads\\/8065824-Ogryzek - AURA (Official Visualiser).mp4\"]'),
(25, 1, '2024-11-04 11:34:23', 'Sigma', '[\".\\/uploads\\/7978576-Ogryzek - AURA (Official Visualiser).mp3\",\".\\/uploads\\/5524934-Ogryzek - AURA (Official Visualiser).mp4\",\".\\/uploads\\/3034215-PXL_20241103_105513072-min.jpg\",\".\\/uploads\\/8933675-PXL_20241103_105513072.jpg\"]'),
(26, 1, '2024-11-05 21:13:12', 'Luna', 'none');

-- --------------------------------------------------------

--
-- Tabellenstruktur für Tabelle `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email_confirmed` int(11) NOT NULL DEFAULT 0,
  `pfp` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Daten für Tabelle `users`
--

INSERT INTO `users` (`user_id`, `email`, `password`, `username`, `name`, `email_confirmed`, `pfp`) VALUES
(6, 'mail@elifox.ch', '$2y$10$m52Obx9au/MhmPrWUTByhOvAumzCAJKamm3na7sYPiOYLBHa15Loq', 'Elifox', 'Eliasd Fuchs', 0, '');

--
-- Indizes der exportierten Tabellen
--

--
-- Indizes für die Tabelle `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indizes für die Tabelle `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT für exportierte Tabellen
--

--
-- AUTO_INCREMENT für Tabelle `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
