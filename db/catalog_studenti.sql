-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 10, 2021 at 09:36 AM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 7.3.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catalog_studenti`
--

-- --------------------------------------------------------

--
-- Table structure for table `materii`
--

CREATE TABLE `materii` (
  `id` int(50) NOT NULL,
  `nume_materie` varchar(100) NOT NULL,
  `nr_credite` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `materii`
--

INSERT INTO `materii` (`id`, `nume_materie`, `nr_credite`) VALUES
(6, 'Educatie Fizica', 5),
(7, 'Algebra Liniara', 5),
(8, 'Informatica Aplicata 1', 5),
(9, 'Bazele Electrotehnicii 1', 5),
(10, 'Analiza Matematica', 5),
(11, 'Grafica pe Calculator', 5),
(12, 'Matematici Speciale 1', 5),
(14, 'Programarea Calculatoarelor si Limbaje de Programare', 5);

-- --------------------------------------------------------

--
-- Table structure for table `profesori`
--

CREATE TABLE `profesori` (
  `id` int(10) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profesori`
--

INSERT INTO `profesori` (`id`, `name`, `email`, `password`) VALUES
(1, 'Andreea', 'andreea@gmail.com', '$1$1Kq1Q8Jr$yWsRWI5/bguOopLCSJHK9/');

-- --------------------------------------------------------

--
-- Table structure for table `profil_an`
--

CREATE TABLE `profil_an` (
  `id` int(50) NOT NULL,
  `name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil_an`
--

INSERT INTO `profil_an` (`id`, `name`) VALUES
(7, 'Anul I semestrul 1');

-- --------------------------------------------------------

--
-- Table structure for table `profil_an_has_materii`
--

CREATE TABLE `profil_an_has_materii` (
  `id` int(50) NOT NULL,
  `profil_an_id` int(50) NOT NULL,
  `materie_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profil_an_has_materii`
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
-- Table structure for table `studenti`
--

CREATE TABLE `studenti` (
  `id` int(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `an` tinyint(50) NOT NULL,
  `profil_an_id` int(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `student_has_note`
--

CREATE TABLE `student_has_note` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `materie_id` int(11) NOT NULL,
  `nota` double NOT NULL,
  `promovat` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `materii`
--
ALTER TABLE `materii`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profesori`
--
ALTER TABLE `profesori`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_an`
--
ALTER TABLE `profil_an`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `profil_an_has_materii`
--
ALTER TABLE `profil_an_has_materii`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materie_id` (`materie_id`),
  ADD KEY `profil_an_id` (`profil_an_id`);

--
-- Indexes for table `studenti`
--
ALTER TABLE `studenti`
  ADD PRIMARY KEY (`id`),
  ADD KEY `studenti_ibfk_1` (`profil_an_id`);

--
-- Indexes for table `student_has_note`
--
ALTER TABLE `student_has_note`
  ADD PRIMARY KEY (`id`),
  ADD KEY `materie_id` (`materie_id`),
  ADD KEY `student_has_note_ibfk_2` (`student_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `materii`
--
ALTER TABLE `materii`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `profesori`
--
ALTER TABLE `profesori`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `profil_an`
--
ALTER TABLE `profil_an`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `profil_an_has_materii`
--
ALTER TABLE `profil_an_has_materii`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `studenti`
--
ALTER TABLE `studenti`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `student_has_note`
--
ALTER TABLE `student_has_note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `profil_an_has_materii`
--
ALTER TABLE `profil_an_has_materii`
  ADD CONSTRAINT `profil_an_has_materii_ibfk_1` FOREIGN KEY (`materie_id`) REFERENCES `materii` (`id`),
  ADD CONSTRAINT `profil_an_has_materii_ibfk_2` FOREIGN KEY (`profil_an_id`) REFERENCES `profil_an` (`id`);

--
-- Constraints for table `studenti`
--
ALTER TABLE `studenti`
  ADD CONSTRAINT `studenti_ibfk_1` FOREIGN KEY (`profil_an_id`) REFERENCES `profil_an` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `student_has_note`
--
ALTER TABLE `student_has_note`
  ADD CONSTRAINT `student_has_note_ibfk_1` FOREIGN KEY (`materie_id`) REFERENCES `materii` (`id`),
  ADD CONSTRAINT `student_has_note_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `studenti` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
