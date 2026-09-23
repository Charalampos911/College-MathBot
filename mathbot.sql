-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Φιλοξενητής: 127.0.0.1:3306
-- Χρόνος δημιουργίας: 03 Μαρ 2021 στις 17:11:53
-- Έκδοση διακομιστή: 5.7.26
-- Έκδοση PHP: 7.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Βάση δεδομένων: `mathbot`
--

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `misc`
--

DROP TABLE IF EXISTS `misc`;
CREATE TABLE IF NOT EXISTS `misc` (
  `Misc` varchar(100) COLLATE utf8_bin NOT NULL,
  PRIMARY KEY (`Misc`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `operators`
--

DROP TABLE IF EXISTS `operators`;
CREATE TABLE IF NOT EXISTS `operators` (
  `Symbol` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `Name_EN` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`Name_EN`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Άδειασμα δεδομένων του πίνακα `operators`
--

INSERT INTO `operators` (`Symbol`, `Name_EN`) VALUES
('*', ' times '),
('+', ' plus '),
('-', ' minus '),
('/', ' div '),
('+', ' and ');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `specials`
--

DROP TABLE IF EXISTS `specials`;
CREATE TABLE IF NOT EXISTS `specials` (
  `Regex` varchar(200) NOT NULL,
  `NewStr` varchar(100) NOT NULL,
  PRIMARY KEY (`Regex`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `specials`
--

INSERT INTO `specials` (`Regex`, `NewStr`) VALUES
('\\b(\\w*divided by\\w*)\\b', 'div'),
('\\b(\\w*multiplied by\\w*)\\b', 'times');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `stats`
--

DROP TABLE IF EXISTS `stats`;
CREATE TABLE IF NOT EXISTS `stats` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `MissCor` varchar(100) COLLATE utf8_bin NOT NULL,
  `User` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `day` int(100) NOT NULL,
  `month` int(100) NOT NULL,
  `year` int(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `stats`
--

INSERT INTO `stats` (`id`, `MissCor`, `User`, `day`, `month`, `year`) VALUES
(1, 'wrong', '123456', 29, 10, 2020),
(2, 'wrong', '123456', 29, 10, 2020),
(3, 'correct', '123456', 29, 10, 2020),
(4, 'correct', '123456', 29, 10, 2020),
(5, 'wrong', '123456', 29, 10, 2020),
(6, 'wrong', '123456', 29, 10, 2020),
(7, 'wrong', '123456', 29, 10, 2020),
(8, 'correct', '123456', 29, 10, 2020),
(9, 'correct', '123456', 29, 10, 2020),
(10, 'wrong', '123456', 29, 10, 2020),
(11, 'correct', '123456', 29, 10, 2020),
(12, 'correct', '123456', 7, 11, 2020),
(13, 'wrong', '123456', 7, 11, 2020),
(14, 'wrong', '123456', 7, 11, 2020),
(15, 'wrong', '123456', 7, 11, 2020),
(16, 'wrong', '12345', 18, 11, 2020),
(17, 'wrong', '12345', 18, 11, 2020),
(18, 'wrong', '12345', 18, 11, 2020),
(19, 'wrong', '12345', 7, 1, 2021),
(20, 'wrong', '12345', 7, 1, 2021),
(21, 'wrong', '12345', 7, 1, 2021),
(22, 'wrong', '', 23, 2, 2021);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `transnumbers`
--

DROP TABLE IF EXISTS `transnumbers`;
CREATE TABLE IF NOT EXISTS `transnumbers` (
  `Grammaric` text NOT NULL,
  `Numerico` int(100) NOT NULL,
  PRIMARY KEY (`Numerico`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `transnumbers`
--

INSERT INTO `transnumbers` (`Grammaric`, `Numerico`) VALUES
('nin', 99),
('zero', 0),
('one', 1),
('two', 2),
('three', 3),
('four', 4),
('five', 5),
('six', 6),
('seven', 7),
('eight', 8),
('nine', 9),
('ten', 10),
('eleven', 11),
('twelve', 12),
('thirteen', 13),
('fourteen', 14),
('fifteen', 15),
('sixteen', 16),
('seventeen', 17),
('eighteen', 18),
('nineteen', 19),
('twenty', 20),
('thirty', 30),
('fourty', 40),
('fifty', 50),
('sixty', 60),
('seventy', 70),
('eighty', 80),
('ninety', 90),
('one hundred', 100),
('two hundred', 200),
('three hundred', 300),
('four hundred', 400),
('five hundred', 500),
('six hundred', 600),
('seven hundred', 700),
('eight hundred', 800),
('nine hundred', 900),
('one thousand', 1000),
('two thousand', 2000);

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `usermisstakes`
--

DROP TABLE IF EXISTS `usermisstakes`;
CREATE TABLE IF NOT EXISTS `usermisstakes` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `NumA` int(100) NOT NULL,
  `Oper` varchar(100) COLLATE utf8_bin NOT NULL,
  `NumB` int(100) NOT NULL,
  `MissUser` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=79 DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

--
-- Άδειασμα δεδομένων του πίνακα `usermisstakes`
--

INSERT INTO `usermisstakes` (`id`, `NumA`, `Oper`, `NumB`, `MissUser`) VALUES
(70, 6, 'minus', 8, '123456'),
(71, 3, 'divy', 2, '123456'),
(69, 9, 'divy', 5, '123456'),
(68, 3, 'divy', 9, 'nikos66'),
(67, 7, 'divy', 1, 'nikos66'),
(66, 6, 'multy', 3, 'nikos66'),
(78, 1, 'divy', 2, ''),
(21, 5, 'plus', 10, '25330415'),
(72, 7, 'multy', 20, '12345'),
(73, 5, 'plus', 19, '12345'),
(74, 7, 'multy', 10, '12345'),
(75, 4, 'minus', 1, '12345'),
(76, 2, 'multy', 10, '12345'),
(77, 4, 'minus', 3, '12345');

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `userrates`
--

DROP TABLE IF EXISTS `userrates`;
CREATE TABLE IF NOT EXISTS `userrates` (
  `User` varchar(11) COLLATE utf8_bin NOT NULL,
  `Que1` varchar(10) COLLATE utf8_bin NOT NULL,
  `Que2` varchar(10) COLLATE utf8_bin NOT NULL,
  `Que3` varchar(10) COLLATE utf8_bin NOT NULL,
  `Que4` varchar(10) COLLATE utf8_bin NOT NULL,
  `Que5` varchar(10) COLLATE utf8_bin NOT NULL,
  `Que6` varchar(10) COLLATE utf8_bin NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_bin;

-- --------------------------------------------------------

--
-- Δομή πίνακα για τον πίνακα `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(100) NOT NULL AUTO_INCREMENT,
  `Pin` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `Nick` varchar(100) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `ScorePlus` int(100) NOT NULL DEFAULT '0',
  `ScoreMinus` int(100) NOT NULL DEFAULT '0',
  `ScoreMulty` int(100) NOT NULL DEFAULT '0',
  `ScoreDivy` int(100) NOT NULL DEFAULT '0',
  `Rated` int(100) NOT NULL DEFAULT '0',
  `Activity` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;

--
-- Άδειασμα δεδομένων του πίνακα `users`
--

INSERT INTO `users` (`id`, `Pin`, `Nick`, `ScorePlus`, `ScoreMinus`, `ScoreMulty`, `ScoreDivy`, `Rated`, `Activity`) VALUES
(1, '12345', 'HOPE4', 0, 0, 0, 0, 0, 0),
(2, 'HARIS44', 'HARIS', 0, 0, 0, 0, 0, 0),
(3, 'JOJO', 'HARIS', 0, 0, 0, 0, 0, 0),
(4, '5656', 'JOJO', 0, 0, 0, 0, 0, 0),
(5, '123', 'rgerg', 0, 0, 0, 0, 0, 0);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
