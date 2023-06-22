-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 14 Gru 2022, 20:14
-- Wersja serwera: 10.4.24-MariaDB
-- Wersja PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `dziennik`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `administration`
--

CREATE TABLE `administration` (
  `id_person` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `haslo` varchar(40) NOT NULL,
  `id_industry` varchar(40) DEFAULT NULL,
  `permision` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `administration`
--

INSERT INTO `administration` (`id_person`, `name`, `surname`, `mail`, `haslo`, `id_industry`, `permision`) VALUES
(2, 'kamil', 'kubik', 'kamilk120@wp.pl', 'limak', NULL, 'admin'),
(4, 'andrej', 'mak', 'makapaka@wp.pl', 'lol', 'ZSZIP', 'headteacher'),
(5, 'sdftgt', 'dfg', 'fsdd@wp.pl', 'qwe', 'ZSZIP', 'teacher');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `class`
--

CREATE TABLE `class` (
  `id_class` int(11) NOT NULL,
  `name_class` varchar(40) NOT NULL,
  `opiekun` int(11) DEFAULT NULL,
  `id_industry` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `class`
--

INSERT INTO `class` (`id_class`, `name_class`, `opiekun`, `id_industry`) VALUES
(11, '4J', NULL, 'ZSZIP'),
(12, '4I', NULL, 'ZSZIP');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `day_leson`
--

CREATE TABLE `day_leson` (
  `id_day_leson` int(11) NOT NULL,
  `id_class` int(11) DEFAULT NULL,
  `id_subject` int(11) DEFAULT NULL,
  `start_haur` int(11) NOT NULL,
  `stop_hour` int(11) NOT NULL,
  `weekday` varchar(40) DEFAULT NULL,
  `data_day` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `day_leson`
--

INSERT INTO `day_leson` (`id_day_leson`, `id_class`, `id_subject`, `start_haur`, `stop_hour`, `weekday`, `data_day`) VALUES
(1, 11, 3, 800, 845, NULL, '2022-12-14');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `industry`
--

CREATE TABLE `industry` (
  `name_industry` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `industry`
--

INSERT INTO `industry` (`name_industry`) VALUES
('ZSZIP');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `marks`
--

CREATE TABLE `marks` (
  `id_mark` int(11) NOT NULL,
  `id_student` int(11) DEFAULT NULL,
  `id_subject` int(11) DEFAULT NULL,
  `value_mark` varchar(40) NOT NULL,
  `note` varchar(255) NOT NULL,
  `improvment` int(11) DEFAULT NULL,
  `id_teacher` int(11) DEFAULT NULL,
  `date_mark` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `obiections`
--

CREATE TABLE `obiections` (
  `id_obiection` int(11) NOT NULL,
  `id_student` int(11) DEFAULT NULL,
  `id_person` int(11) DEFAULT NULL,
  `thema` varchar(40) NOT NULL,
  `whats_going_on` varchar(255) NOT NULL,
  `date_obiection` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `presence`
--

CREATE TABLE `presence` (
  `id_presence` int(11) NOT NULL,
  `id_subject` int(11) NOT NULL,
  `id_student` int(11) DEFAULT NULL,
  `id_teacher` int(11) DEFAULT NULL,
  `presence` int(11) DEFAULT NULL,
  `justyfication` int(11) DEFAULT NULL,
  `leate` int(11) DEFAULT NULL,
  `id_day_leson` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `students`
--

CREATE TABLE `students` (
  `id_student` int(11) NOT NULL,
  `name` varchar(40) NOT NULL,
  `surname` varchar(40) NOT NULL,
  `mail` varchar(40) NOT NULL,
  `haslo` varchar(40) NOT NULL,
  `id_class` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `students`
--

INSERT INTO `students` (`id_student`, `name`, `surname`, `mail`, `haslo`, `id_class`) VALUES
(3, 'name', 'nazwisko    ', 'fsd@wp.pl', 'dfs', 11),
(6, 'kamil', 'kubik', 'kamilk120@wp.pl', 'lol', 11),
(7, 'kamil', 'kubik ', 'fsdd@wp.pl', 'liga', 12),
(8, 'rebik', 'bik', 'rebik@wp.pl', 'lol', 11),
(9, 'sd', 'kubik', 'fswdd@wp.pl', 'qwe', NULL);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `subject`
--

CREATE TABLE `subject` (
  `id_subject` int(11) NOT NULL,
  `name_subject` varchar(40) NOT NULL,
  `id_teacher` int(11) DEFAULT NULL,
  `id_industry` varchar(40) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `subject`
--

INSERT INTO `subject` (`id_subject`, `name_subject`, `id_teacher`, `id_industry`) VALUES
(3, 'przyroda', NULL, 'ZSZIP');

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `administration`
--
ALTER TABLE `administration`
  ADD PRIMARY KEY (`id_person`),
  ADD KEY `id_industry` (`id_industry`);

--
-- Indeksy dla tabeli `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`id_class`),
  ADD KEY `id_industry` (`id_industry`),
  ADD KEY `opiekun` (`opiekun`);

--
-- Indeksy dla tabeli `day_leson`
--
ALTER TABLE `day_leson`
  ADD PRIMARY KEY (`id_day_leson`),
  ADD KEY `id_class` (`id_class`),
  ADD KEY `id_subject` (`id_subject`);

--
-- Indeksy dla tabeli `industry`
--
ALTER TABLE `industry`
  ADD PRIMARY KEY (`name_industry`);

--
-- Indeksy dla tabeli `marks`
--
ALTER TABLE `marks`
  ADD PRIMARY KEY (`id_mark`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_subject` (`id_subject`),
  ADD KEY `id_teacher` (`id_teacher`);

--
-- Indeksy dla tabeli `obiections`
--
ALTER TABLE `obiections`
  ADD PRIMARY KEY (`id_obiection`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_person` (`id_person`);

--
-- Indeksy dla tabeli `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`id_presence`),
  ADD KEY `id_student` (`id_student`),
  ADD KEY `id_day_leson` (`id_day_leson`),
  ADD KEY `id_teacher` (`id_teacher`),
  ADD KEY `presence_ibfk_2` (`id_subject`);

--
-- Indeksy dla tabeli `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id_student`),
  ADD KEY `id_class` (`id_class`);

--
-- Indeksy dla tabeli `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id_subject`),
  ADD KEY `id_teacher` (`id_teacher`),
  ADD KEY `id_industry` (`id_industry`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `administration`
--
ALTER TABLE `administration`
  MODIFY `id_person` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT dla tabeli `class`
--
ALTER TABLE `class`
  MODIFY `id_class` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT dla tabeli `day_leson`
--
ALTER TABLE `day_leson`
  MODIFY `id_day_leson` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT dla tabeli `marks`
--
ALTER TABLE `marks`
  MODIFY `id_mark` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `obiections`
--
ALTER TABLE `obiections`
  MODIFY `id_obiection` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `presence`
--
ALTER TABLE `presence`
  MODIFY `id_presence` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT dla tabeli `students`
--
ALTER TABLE `students`
  MODIFY `id_student` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT dla tabeli `subject`
--
ALTER TABLE `subject`
  MODIFY `id_subject` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `administration`
--
ALTER TABLE `administration`
  ADD CONSTRAINT `administration_ibfk_1` FOREIGN KEY (`id_industry`) REFERENCES `industry` (`name_industry`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ograniczenia dla tabeli `class`
--
ALTER TABLE `class`
  ADD CONSTRAINT `class_ibfk_1` FOREIGN KEY (`id_industry`) REFERENCES `industry` (`name_industry`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `class_ibfk_2` FOREIGN KEY (`opiekun`) REFERENCES `administration` (`id_person`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ograniczenia dla tabeli `day_leson`
--
ALTER TABLE `day_leson`
  ADD CONSTRAINT `day_leson_ibfk_1` FOREIGN KEY (`id_class`) REFERENCES `class` (`id_class`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `day_leson_ibfk_2` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id_subject`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ograniczenia dla tabeli `marks`
--
ALTER TABLE `marks`
  ADD CONSTRAINT `marks_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `marks_ibfk_2` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id_subject`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `marks_ibfk_3` FOREIGN KEY (`id_teacher`) REFERENCES `administration` (`id_person`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ograniczenia dla tabeli `obiections`
--
ALTER TABLE `obiections`
  ADD CONSTRAINT `obiections_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `obiections_ibfk_2` FOREIGN KEY (`id_person`) REFERENCES `administration` (`id_person`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ograniczenia dla tabeli `presence`
--
ALTER TABLE `presence`
  ADD CONSTRAINT `presence_ibfk_1` FOREIGN KEY (`id_student`) REFERENCES `students` (`id_student`),
  ADD CONSTRAINT `presence_ibfk_2` FOREIGN KEY (`id_subject`) REFERENCES `subject` (`id_subject`),
  ADD CONSTRAINT `presence_ibfk_3` FOREIGN KEY (`id_day_leson`) REFERENCES `day_leson` (`id_day_leson`),
  ADD CONSTRAINT `presence_ibfk_4` FOREIGN KEY (`id_teacher`) REFERENCES `administration` (`id_person`);

--
-- Ograniczenia dla tabeli `students`
--
ALTER TABLE `students`
  ADD CONSTRAINT `students_ibfk_1` FOREIGN KEY (`id_class`) REFERENCES `class` (`id_class`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `students_ibfk_2` FOREIGN KEY (`id_class`) REFERENCES `class` (`id_class`) ON DELETE SET NULL ON UPDATE SET NULL;

--
-- Ograniczenia dla tabeli `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`id_teacher`) REFERENCES `administration` (`id_person`) ON DELETE SET NULL ON UPDATE SET NULL,
  ADD CONSTRAINT `subject_ibfk_2` FOREIGN KEY (`id_industry`) REFERENCES `industry` (`name_industry`) ON DELETE SET NULL ON UPDATE SET NULL;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
