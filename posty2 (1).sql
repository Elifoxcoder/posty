-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Erstellungszeit: 30. Okt 2024 um 13:56
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
(15, 1, '2024-10-28 22:16:48', 'asd', '[\".\\/uploads\\/9505763-intelcore.png\",\".\\/uploads\\/9180246-OIG.CZdEcP (1).jpg\"]'),
(16, 1, '2024-10-29 17:49:04', 'Video', '[\".\\/uploads\\/2692240-file_example_MP4_480_1_5MG.mp4\"]'),
(17, 1, '2024-10-29 17:50:06', 'Hört euch das an!', '[\".\\/uploads\\/4919991-file_example_MP3_1MG.mp3\"]'),
(18, 1, '2024-10-29 17:50:54', 'asdasd', '[\".\\/uploads\\/9501593-file-example_PDF_1MB.pdf\"]'),
(19, 1, '2024-10-29 17:51:48', 'Multimedia', '[\".\\/uploads\\/8258700-file-example_PDF_1MB.pdf\",\".\\/uploads\\/2381003-file_example_MP3_1MG.mp3\",\".\\/uploads\\/1697897-file_example_MP4_480_1_5MG.mp4\"]');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT für Tabelle `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
