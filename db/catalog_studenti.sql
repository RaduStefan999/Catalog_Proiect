-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: apr. 26, 2021 la 12:21 AM
-- Versiune server: 10.4.13-MariaDB
-- Versiune PHP: 7.4.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Bază de date: `catalog_studenti`
--

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `materii`
--

CREATE TABLE `materii` (
  `id` int(50) NOT NULL,
  `nume_materie` varchar(50) NOT NULL,
  `nr_credite` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `materii`
--

INSERT INTO `materii` (`id`, `nume_materie`, `nr_credite`) VALUES
(1, 'matematica', 10),
(2, 'inginerie', 8),
(3, 'Istorie', 12),
(4, 'analiza', 6),
(5, 'robotica', 12);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `profesori`
--

CREATE TABLE `profesori` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `profesori`
--

INSERT INTO `profesori` (`id`, `name`, `email`, `password`) VALUES
(1, 'Mihalache Radu Stefan', 'radustefan1302@gmail.com', '$1$39yfdfNQ$Z4KqpNCApLH1tM0F3alLX0');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `profil_an`
--

CREATE TABLE `profil_an` (
  `id` int(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `profil_an`
--

INSERT INTO `profil_an` (`id`, `name`) VALUES
(1, 'an1'),
(3, 'an2'),
(4, 'an3_electronica_aplicata'),
(5, 'an3_microelectronica'),
(6, 'an3_telecomunicatii');

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `profil_an_has_materii`
--

CREATE TABLE `profil_an_has_materii` (
  `id` int(50) NOT NULL,
  `profil_an_id` int(50) NOT NULL,
  `materie_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `profil_an_has_materii`
--

INSERT INTO `profil_an_has_materii` (`id`, `profil_an_id`, `materie_id`) VALUES
(5, 1, 3),
(6, 1, 4);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `studenti`
--

CREATE TABLE `studenti` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `an` tinyint(50) NOT NULL,
  `profil_an_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `studenti`
--

INSERT INTO `studenti` (`id`, `name`, `an`, `profil_an_id`) VALUES
(30, 'Mihalache Radu Stefan', 1, 1);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `student_has_note`
--

CREATE TABLE `student_has_note` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `materie_id` int(11) NOT NULL,
  `nota` double NOT NULL,
  `promovat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `student_has_note`
--

INSERT INTO `student_has_note` (`id`, `student_id`, `materie_id`, `nota`, `promovat`) VALUES
(5, 30, 3, 0, 0),
(6, 30, 4, 0, 0);

--
-- Indexuri pentru tabele eliminate
--

--
-- Indexuri pentru tabele `materii`
--
ALTER TABLE `materii`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `profesori`
--
ALTER TABLE `profesori`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `profil_an`
--
ALTER TABLE `profil_an`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `profil_an_has_materii`
--
ALTER TABLE `profil_an_has_materii`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materie_id` (`materie_id`),
  ADD KEY `profil_an_id` (`profil_an_id`);

--
-- Indexuri pentru tabele `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studenti_ibfk_1` (`profil_an_id`);

--
-- Indexuri pentru tabele `student_has_note`
--
ALTER TABLE `student_has_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materie_id` (`materie_id`),
  ADD KEY `student_has_note_ibfk_2` (`student_id`);

--
-- AUTO_INCREMENT pentru tabele eliminate
--

--
-- AUTO_INCREMENT pentru tabele `materii`
--
ALTER TABLE `materii`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pentru tabele `profesori`
--
ALTER TABLE `profesori`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pentru tabele `profil_an`
--
ALTER TABLE `profil_an`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pentru tabele `profil_an_has_materii`
--
ALTER TABLE `profil_an_has_materii`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pentru tabele `studenti`
--
ALTER TABLE `studenti`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pentru tabele `student_has_note`
--
ALTER TABLE `student_has_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constrângeri pentru tabele eliminate
--

--
-- Constrângeri pentru tabele `profil_an_has_materii`
--
ALTER TABLE `profil_an_has_materii`
  ADD CONSTRAINT `profil_an_has_materii_ibfk_1` FOREIGN KEY (`materie_id`) REFERENCES `materii` (`id`),
  ADD CONSTRAINT `profil_an_has_materii_ibfk_2` FOREIGN KEY (`profil_an_id`) REFERENCES `profil_an` (`id`);

--
-- Constrângeri pentru tabele `studenti`
--
ALTER TABLE `studenti`
  ADD CONSTRAINT `studenti_ibfk_1` FOREIGN KEY (`profil_an_id`) REFERENCES `profil_an` (`id`) ON DELETE CASCADE;

--
-- Constrângeri pentru tabele `student_has_note`
--
ALTER TABLE `student_has_note`
  ADD CONSTRAINT `student_has_note_ibfk_1` FOREIGN KEY (`materie_id`) REFERENCES `materii` (`id`),
  ADD CONSTRAINT `student_has_note_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `studenti` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
