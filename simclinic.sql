-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 13 Gru 2015, 20:47
-- Wersja serwera: 10.1.9-MariaDB
-- Wersja PHP: 5.6.15

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `simclinic`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `analyzes`
--

CREATE TABLE `analyzes` (
  `id` int(11) NOT NULL,
  `examination_id` int(11) NOT NULL,
  `doctor_id` int(11) NOT NULL,
  `date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `analyzes_parameters`
--

CREATE TABLE `analyzes_parameters` (
  `id` int(11) NOT NULL,
  `analysis_id` int(11) NOT NULL,
  `parameter_id` int(11) NOT NULL,
  `value` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `examinations`
--

CREATE TABLE `examinations` (
  `id` int(11) NOT NULL,
  `technican_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `eye_side` tinyint(4) NOT NULL COMMENT '0-left, 1-right',
  `image_path` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `parameters`
--

CREATE TABLE `parameters` (
  `id` int(11) NOT NULL,
  `name` int(11) NOT NULL,
  `measureUnit` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `personal_data`
--

CREATE TABLE `personal_data` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(20) NOT NULL,
  `last_name` varchar(20) NOT NULL,
  `birth_date` date NOT NULL,
  `sex` tinyint(4) NOT NULL COMMENT '0-female; 1-male',
  `phone_no` varchar(25) NOT NULL,
  `address` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `login` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(20) NOT NULL,
  `creation_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indeksy dla zrzutów tabel
--

--
-- Indexes for table `analyzes`
--
ALTER TABLE `analyzes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `examination_id` (`examination_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `analyzes_parameters`
--
ALTER TABLE `analyzes_parameters`
  ADD PRIMARY KEY (`id`),
  ADD KEY `analysis_id` (`analysis_id`),
  ADD KEY `parameter_id` (`parameter_id`);

--
-- Indexes for table `examinations`
--
ALTER TABLE `examinations`
  ADD PRIMARY KEY (`id`),
  ADD KEY `technican_id` (`technican_id`),
  ADD KEY `patient_id` (`patient_id`);

--
-- Indexes for table `parameters`
--
ALTER TABLE `parameters`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `personal_data`
--
ALTER TABLE `personal_data`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT dla tabeli `analyzes_parameters`
--
ALTER TABLE `analyzes_parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `personal_data`
--
ALTER TABLE `personal_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `analyzes`
--
ALTER TABLE `analyzes`
  ADD CONSTRAINT `analyzes_dector_fk` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `analyzes_exam_fk` FOREIGN KEY (`examination_id`) REFERENCES `examinations` (`id`);

--
-- Ograniczenia dla tabeli `analyzes_parameters`
--
ALTER TABLE `analyzes_parameters`
  ADD CONSTRAINT `analyzes_paramval_fk` FOREIGN KEY (`analysis_id`) REFERENCES `analyzes` (`id`),
  ADD CONSTRAINT `paramval_param_fk` FOREIGN KEY (`parameter_id`) REFERENCES `parameters` (`id`);

--
-- Ograniczenia dla tabeli `examinations`
--
ALTER TABLE `examinations`
  ADD CONSTRAINT `exam_patient_fk` FOREIGN KEY (`patient_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `exam_technican_fk` FOREIGN KEY (`technican_id`) REFERENCES `users` (`id`);

--
-- Ograniczenia dla tabeli `personal_data`
--
ALTER TABLE `personal_data`
  ADD CONSTRAINT `user_personaldata_fk` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
