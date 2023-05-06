-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 06 Maj 2023, 15:30
-- Wersja serwera: 10.4.25-MariaDB
-- Wersja PHP: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `quiz`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `login`
--

CREATE TABLE `login` (
  `ID` int(11) NOT NULL,
  `Imie` varchar(20) NOT NULL,
  `Login` varchar(20) NOT NULL,
  `Haslo` varchar(20) NOT NULL,
  `Rola` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `login`
--

INSERT INTO `login` (`ID`, `Imie`, `Login`, `Haslo`, `Rola`) VALUES
(1, 'Gustaw', 'gustaw', '1234', 'admin'),
(2, 'Andrzej', 'andrzejek', '1234', 'user');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `odpowiedzi`
--

CREATE TABLE `odpowiedzi` (
  `ID_odp` int(11) NOT NULL,
  `Tresc` longtext NOT NULL,
  `ID_Pyt` int(11) NOT NULL,
  `Poprawna` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `odpowiedzi`
--

INSERT INTO `odpowiedzi` (`ID_odp`, `Tresc`, `ID_Pyt`, `Poprawna`) VALUES
(1, 'Warszawa', 1, 1),
(2, 'Poznań', 1, 0),
(3, 'Amsterdam', 1, 0),
(4, 'Kraków', 1, 0),
(5, 'Koszalin', 2, 0),
(6, 'Berlin', 2, 1),
(7, 'Bążur', 3, 0),
(8, 'Paryż', 3, 1),
(9, 'Białołęka', 4, 1),
(10, 'Centrum', 4, 0),
(11, 'Szuper Szypki dysk', 5, 0),
(12, 'Solid State Drive', 5, 1),
(13, 'Komputr', 6, 0),
(14, 'Jednostka centralna', 6, 1);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania`
--

CREATE TABLE `pytania` (
  `ID_Pyt` int(11) NOT NULL,
  `ID_testu` int(11) NOT NULL,
  `tresc` longtext NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `pytania`
--

INSERT INTO `pytania` (`ID_Pyt`, `ID_testu`, `tresc`) VALUES
(1, 1, 'Jaka jest stolica Polski?'),
(2, 1, 'Jaka jest stolica Niemiec?'),
(3, 1, 'Jaka jest stolica Francji?'),
(4, 1, 'Jaka jest stolica Warszawy?'),
(5, 2, 'SSD to skrót od?'),
(6, 2, 'Kontuter oznacza:');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `pytania_testy`
--

CREATE TABLE `pytania_testy` (
  `ID` int(11) DEFAULT NULL,
  `ID_Pyt` int(11) NOT NULL,
  `ID_Testu` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `rozwiazania`
--

CREATE TABLE `rozwiazania` (
  `id` int(11) NOT NULL,
  `id_testu` int(11) NOT NULL,
  `id_login` int(11) NOT NULL,
  `wynik` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `rozwiazania`
--

INSERT INTO `rozwiazania` (`id`, `id_testu`, `id_login`, `wynik`) VALUES
(1, 1, 1, 10),
(2, 1, 1, 8);

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `testy`
--

CREATE TABLE `testy` (
  `ID_Testu` int(11) NOT NULL,
  `Nazwa` text NOT NULL,
  `opis` longtext NOT NULL,
  `kategoria` varchar(20) NOT NULL,
  `Czas_trwania_w_min` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Zrzut danych tabeli `testy`
--

INSERT INTO `testy` (`ID_Testu`, `Nazwa`, `opis`, `kategoria`, `Czas_trwania_w_min`) VALUES
(1, 'Stolice państw', 'Stolice państ to rewolucyjny quiz pozwalający testować Tobie Twoją wiedzę na temat stolic państw. TOP 10 stolic będzie Twoje!', 'geografia', 5),
(2, 'Komputery i podzespoły', 'Dowiedz się i sprawdź się w dziedzinie konkuterów i ich podzespołów!', 'komputery', 8);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`ID`);

--
-- Indeksy dla tabeli `odpowiedzi`
--
ALTER TABLE `odpowiedzi`
  ADD PRIMARY KEY (`ID_odp`);

--
-- Indeksy dla tabeli `pytania`
--
ALTER TABLE `pytania`
  ADD PRIMARY KEY (`ID_Pyt`);

--
-- Indeksy dla tabeli `rozwiazania`
--
ALTER TABLE `rozwiazania`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `testy`
--
ALTER TABLE `testy`
  ADD PRIMARY KEY (`ID_Testu`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `login`
--
ALTER TABLE `login`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `odpowiedzi`
--
ALTER TABLE `odpowiedzi`
  MODIFY `ID_odp` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT dla tabeli `pytania`
--
ALTER TABLE `pytania`
  MODIFY `ID_Pyt` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT dla tabeli `rozwiazania`
--
ALTER TABLE `rozwiazania`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT dla tabeli `testy`
--
ALTER TABLE `testy`
  MODIFY `ID_Testu` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
