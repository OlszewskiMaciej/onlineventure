-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Czas generowania: 24 Lut 2023, 19:35
-- Wersja serwera: 10.4.14-MariaDB
-- Wersja PHP: 7.4.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Baza danych: `onlineventure`
--

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `author`
--

CREATE TABLE `author` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `author`
--

INSERT INTO `author` (`id`, `name`) VALUES
(1, 'John'),
(2, 'Chris'),
(3, 'Martha'),
(4, 'Lisa');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news`
--

CREATE TABLE `news` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `text` text NOT NULL,
  `creation_date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `news`
--

INSERT INTO `news` (`id`, `title`, `text`, `creation_date`) VALUES
(1, 'The Benefits of Yoga Practice', 'Yoga can improve flexibility, reduce stress, and promote relaxation.', '2023-02-24 18:28:44'),
(2, 'How to Improve Your Memory', 'Regular exercise, good sleep, and a balanced diet can help improve memory.', '2023-02-24 18:29:13'),
(3, 'The Dangers of Smoking', 'Smoking can cause lung cancer, heart disease, and other health problems.', '2023-02-24 18:29:24'),
(4, 'The Importance of Drinking Water', 'Drinking enough water can help keep the body hydrated and promote good health.', '2023-02-24 18:29:36'),
(5, 'The Benefits of Meditation', 'Meditation can reduce anxiety, improve focus, and promote overall well-being.', '2023-02-24 18:29:49'),
(6, 'How to Stay Motivated', 'Setting goals, seeking support, and staying positive can help maintain motivation.', '2023-02-24 18:30:01'),
(7, 'The Benefits of Reading', 'Reading can improve vocabulary, enhance creativity, and reduce stress.', '2023-02-24 18:30:20'),
(8, 'The Importance of Time Management', 'Good time management can increase productivity, reduce stress, and improve overall quality of life.', '2023-02-24 18:30:40'),
(9, 'How to Reduce Stress', 'Exercise, relaxation techniques, and healthy coping mechanisms can help reduce stress.', '2023-02-24 18:30:59'),
(10, 'The Benefits of a Balanced Diet', 'Eating a balanced diet can provide the body with essential nutrients, improve digestion, and promote overall health.', '2023-02-24 18:31:17');

-- --------------------------------------------------------

--
-- Struktura tabeli dla tabeli `news_author`
--

CREATE TABLE `news_author` (
  `news_id` int(11) NOT NULL,
  `author_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Zrzut danych tabeli `news_author`
--

INSERT INTO `news_author` (`news_id`, `author_id`) VALUES
(1, 1),
(1, 2),
(1, 3),
(2, 1),
(3, 2),
(4, 4),
(5, 1),
(6, 1),
(6, 3),
(7, 1),
(7, 2),
(8, 2),
(8, 3),
(9, 3),
(9, 4),
(10, 1);

--
-- Indeksy dla zrzutów tabel
--

--
-- Indeksy dla tabeli `author`
--
ALTER TABLE `author`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `news`
--
ALTER TABLE `news`
  ADD PRIMARY KEY (`id`);

--
-- Indeksy dla tabeli `news_author`
--
ALTER TABLE `news_author`
  ADD PRIMARY KEY (`news_id`,`author_id`),
  ADD KEY `author_id` (`author_id`);

--
-- AUTO_INCREMENT dla zrzuconych tabel
--

--
-- AUTO_INCREMENT dla tabeli `author`
--
ALTER TABLE `author`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT dla tabeli `news`
--
ALTER TABLE `news`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Ograniczenia dla zrzutów tabel
--

--
-- Ograniczenia dla tabeli `news_author`
--
ALTER TABLE `news_author`
  ADD CONSTRAINT `news_author_ibfk_1` FOREIGN KEY (`news_id`) REFERENCES `news` (`id`),
  ADD CONSTRAINT `news_author_ibfk_2` FOREIGN KEY (`author_id`) REFERENCES `author` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
