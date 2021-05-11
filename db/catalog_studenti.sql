-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Gazdă: 127.0.0.1
-- Timp de generare: mai 12, 2021 la 01:37 AM
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
  `nume_materie` varchar(100) NOT NULL,
  `nr_credite` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `materii`
--

INSERT INTO `materii` (`id`, `nume_materie`, `nr_credite`) VALUES
(6, 'Educatie Fizica', 1),
(7, 'Algebra Liniara', 1),
(8, 'Informatica Aplicata 1', 1),
(9, 'Bazele Electrotehnicii 1', 1),
(10, 'Analiza Matematica', 1),
(11, 'Grafica pe Calculator', 1),
(12, 'Matematici Speciale 1', 3),
(14, 'Programarea Calculatoarelor si Limbaje de Programare', 3);

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
(1, 'Andreea', 'andreea@gmail.com', '$1$1Kq1Q8Jr$yWsRWI5/bguOopLCSJHK9/');

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
(7, 'Anul I semestrul 1');

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
(7, 7, 7),
(8, 7, 10),
(9, 7, 9),
(10, 7, 6),
(11, 7, 11),
(12, 7, 8),
(13, 7, 12),
(14, 7, 14);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `specializari`
--

CREATE TABLE `specializari` (
  `id` int(50) NOT NULL,
  `nume` varchar(100) DEFAULT NULL,
  `numar_locuri` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `specializari`
--

INSERT INTO `specializari` (`id`, `nume`, `numar_locuri`) VALUES
(1, 'Electronica Aplicata', 2),
(2, 'TST', 3),
(3, 'MON', 3);

-- --------------------------------------------------------

--
-- Structură tabel pentru tabel `studenti`
--

CREATE TABLE `studenti` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `an` tinyint(50) NOT NULL,
  `profil_an_id` int(50) NOT NULL,
  `specializare` int(11) DEFAULT NULL,
  `optiunea_1` int(11) DEFAULT NULL,
  `optiunea_2` int(11) DEFAULT NULL,
  `optiunea_3` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Eliminarea datelor din tabel `studenti`
--

INSERT INTO `studenti` (`id`, `name`, `an`, `profil_an_id`, `specializare`, `optiunea_1`, `optiunea_2`, `optiunea_3`) VALUES
(35, 'George', 2, 7, 1, 1, 2, 3),
(36, 'Teo', 2, 7, 3, 1, 3, 2),
(37, 'Maria', 2, 7, 1, 1, 3, 2),
(38, 'Radu', 2, 7, 2, 1, 2, 3);

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
(39, 35, 7, 9, 1),
(40, 35, 10, 9, 1),
(41, 35, 9, 9, 1),
(42, 35, 6, 9, 0),
(43, 35, 11, 9, 1),
(44, 35, 8, 9, 1),
(45, 35, 12, 9, 1),
(46, 35, 14, 9, 1),
(47, 36, 7, 5, 1),
(48, 36, 10, 5, 1),
(49, 36, 9, 5, 1),
(50, 36, 6, 5, 1),
(51, 36, 11, 5, 1),
(52, 36, 8, 5, 1),
(53, 36, 12, 5, 1),
(54, 36, 14, 5, 1),
(55, 37, 7, 8, 1),
(56, 37, 10, 9, 1),
(57, 37, 9, 10, 1),
(58, 37, 6, 7, 1),
(59, 37, 11, 7, 1),
(60, 37, 8, 6, 1),
(61, 37, 12, 9, 1),
(62, 37, 14, 8, 1),
(63, 38, 7, 5, 1),
(64, 38, 10, 0, 1),
(65, 38, 9, 0, 1),
(66, 38, 6, 0, 1),
(67, 38, 11, 0, 1),
(68, 38, 8, 0, 1),
(69, 38, 12, 0, 1),
(70, 38, 14, 0, 1);

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
-- Indexuri pentru tabele `specializari`
--
ALTER TABLE `specializari`
  ADD PRIMARY KEY (`id`);

--
-- Indexuri pentru tabele `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studenti_ibfk_1` (`profil_an_id`),
  ADD KEY `specializare` (`specializare`),
  ADD KEY `optiunea_1` (`optiunea_1`),
  ADD KEY `optiunea_2` (`optiunea_2`),
  ADD KEY `optiunea_3` (`optiunea_3`);

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
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pentru tabele `profesori`
--
ALTER TABLE `profesori`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pentru tabele `profil_an`
--
ALTER TABLE `profil_an`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pentru tabele `profil_an_has_materii`
--
ALTER TABLE `profil_an_has_materii`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT pentru tabele `specializari`
--
ALTER TABLE `specializari`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pentru tabele `studenti`
--
ALTER TABLE `studenti`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT pentru tabele `student_has_note`
--
ALTER TABLE `student_has_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=71;

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
  ADD CONSTRAINT `studenti_ibfk_1` FOREIGN KEY (`profil_an_id`) REFERENCES `profil_an` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `studenti_ibfk_2` FOREIGN KEY (`specializare`) REFERENCES `specializari` (`id`),
  ADD CONSTRAINT `studenti_ibfk_3` FOREIGN KEY (`optiunea_1`) REFERENCES `specializari` (`id`),
  ADD CONSTRAINT `studenti_ibfk_4` FOREIGN KEY (`optiunea_2`) REFERENCES `specializari` (`id`),
  ADD CONSTRAINT `studenti_ibfk_5` FOREIGN KEY (`optiunea_3`) REFERENCES `specializari` (`id`);

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
