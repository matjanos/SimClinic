-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Czas generowania: 15 Gru 2015, 03:31
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

--
-- Zrzut danych tabeli `analyzes`
--

INSERT INTO `analyzes` (`id`, `examination_id`, `doctor_id`, `date`) VALUES
(0, 1, 2, '2015-12-15');

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

--
-- Zrzut danych tabeli `analyzes_parameters`
--

INSERT INTO `analyzes_parameters` (`id`, `analysis_id`, `parameter_id`, `value`) VALUES
(8, 0, 1, 1),
(9, 0, 2, 2),
(10, 0, 3, 3),
(11, 0, 4, 3),
(12, 0, 5, 2),
(13, 0, 6, 1),
(14, 0, 7, 3);

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

--
-- Zrzut danych tabeli `examinations`
--

INSERT INTO `examinations` (`id`, `technican_id`, `patient_id`, `date`, `eye_side`, `image_path`) VALUES
(1, 3, 5, '2015-12-13', 1, 'uploads/566df9f2af0d2-ss6.jpg'),
(2, 3, 5, '2015-12-14', 0, 'uploads/566ee888d2ae1-Koala.jpg'),
(3, 3, 7, '2015-12-14', 1, 'uploads/566f4070e0c32-Chrysanthemum.jpg');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `parameters`
--

CREATE TABLE `parameters` (
  `id` int(11) NOT NULL,
  `name` varchar(25) NOT NULL,
  `maxParameterValue` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `parameters`
--

INSERT INTO `parameters` (`id`, `name`, `maxParameterValue`) VALUES
(1, 'Drusen', 5),
(2, 'Artery Color', 4),
(3, 'Vein Color', 3),
(4, 'Artery Diameter', 7),
(5, 'Vein Diameter', 6),
(6, 'AV Change', 2),
(7, 'Cotton Wool Spot', 3);

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

--
-- Zrzut danych tabeli `personal_data`
--

INSERT INTO `personal_data` (`id`, `user_id`, `first_name`, `last_name`, `birth_date`, `sex`, `phone_no`, `address`) VALUES
(2, 2, 'Super', 'Admin', '2015-12-13', 1, '111 111 111', 'Lisboa'),
(3, 3, 'Jack', 'Smith', '2010-05-13', 1, '999 999 999', 'Baker Street 5, London'),
(4, 4, 'Jan', 'Nowak', '2010-02-04', 1, '111 222 333', 'Pozna?ska 20, 87-100 Toru?'),
(5, 5, 'Miguel', 'Rodriguez', '2017-05-04', 1, '888 888 888', 'Rua Oliveira Martines 100-00 Lisboa'),
(6, 6, 'Gregory', 'House', '1964-08-12', 1, '888', 'California'),
(7, 7, 'Tom', 'Riddle', '1970-06-01', 1, '1112 3', 'Hogwart');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `users`
--

CREATE TABLE `users` (
  `id` int(7) NOT NULL,
  `username` varchar(30) NOT NULL,
  `password` varchar(128) NOT NULL,
  `role` varchar(20) NOT NULL,
  `creation_date` date NOT NULL,
  `active` tinyint(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Zrzut danych tabeli `users`
--

INSERT INTO `users` (`id`, `username`, `password`, `role`, `creation_date`, `active`) VALUES
(2, 'admin', '$2y$10$KZgcyiecnDgamyfta3e5O.HyVsSrgMtcvjllDk.anxDTqvJBjJ6v.', 'admin', '2015-12-13', 1),
(3, 'smith', '$2y$10$HvJ9s4JpyCn70iP.nTjkfetFB8AOA9nDIEi.n0IBCXIxg0CYEFYUS', 'technican', '2015-12-13', 1),
(4, 'nowak', '$2y$10$1m9k/jacO1tC4.DIwPAmruk3DdIuZb2H.tDTFUlUKiW/O0gBJG3FK', 'doctor', '2015-12-13', 1),
(5, 'rodriguez', '$2y$10$u9iFN8JQY1Mut/98tehlcufcVFRU7FxbMfc356/141iAUi8boRYK6', 'patient', '2015-12-13', 1),
(6, 'house', '$2y$10$u1RBUzAqvvz3AX/lP9TfEuRMtE0qVYV9Mg0oGZ8SleMESWyFt1dwO', 'doctor', '2015-12-14', 1),
(7, 'pac', '$2y$10$f6bOuTbNRzKoR6ETIW35XuPaYUoGVrzLds27zw3i2uX1dx3ZoLIfO', 'patient', '2015-12-14', 1);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT dla tabeli `examinations`
--
ALTER TABLE `examinations`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT dla tabeli `parameters`
--
ALTER TABLE `parameters`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
--
-- AUTO_INCREMENT dla tabeli `personal_data`
--
ALTER TABLE `personal_data`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT dla tabeli `users`
--
ALTER TABLE `users`
  MODIFY `id` int(7) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `analyzes`
--
ALTER TABLE `analyzes`
  ADD CONSTRAINT `analyzes_doctor_fk` FOREIGN KEY (`doctor_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `analyzes_exam_fk` FOREIGN KEY (`examination_id`) REFERENCES `examinations` (`id`);

--
-- Ograniczenia dla tabeli `analyzes_parameters`
--
ALTER TABLE `analyzes_parameters`
  ADD CONSTRAINT `analyzes_paramval_fk` FOREIGN KEY (`analysis_id`) REFERENCES `analyzes` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `paramval_param_fk` FOREIGN KEY (`parameter_id`) REFERENCES `parameters` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;

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
