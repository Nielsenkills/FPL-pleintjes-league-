-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Machine: 127.0.0.1
-- Gegenereerd op: 09 aug 2015 om 23:07
-- Serverversie: 5.6.17
-- PHP-versie: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Databank: `fpl`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `fixtures`
--

CREATE TABLE IF NOT EXISTS `fixtures` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `home_team_id` int(50) NOT NULL,
  `away_team_id` int(50) NOT NULL,
  `gameweek` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=193 ;

--
-- Gegevens worden geëxporteerd voor tabel `fixtures`
--

INSERT INTO `fixtures` (`id`, `home_team_id`, `away_team_id`, `gameweek`) VALUES
(1, 22840, 31151, 1),
(2, 1355632, 17583, 1),
(3, 1381770, 304862, 1),
(4, 17583, 22840, 2),
(5, 31151, 1381770, 2),
(6, 304862, 1355632, 2),
(8, 22840, 1355632, 3),
(9, 31151, 304862, 3),
(10, 1381770, 17583, 3),
(102, 17583, 31151, 4),
(103, 304862, 22840, 4),
(104, 1355632, 1381770, 4),
(105, 304862, 17583, 5),
(106, 1355632, 31151, 5),
(107, 1381770, 22840, 5),
(108, 22840, 31151, 6),
(109, 1355632, 17583, 6),
(110, 1381770, 304862, 6),
(111, 17583, 22840, 7),
(112, 31151, 1381770, 7),
(113, 304862, 1355632, 7),
(114, 22840, 1355632, 8),
(115, 31151, 304862, 8),
(116, 1381770, 17583, 8),
(117, 17583, 31151, 9),
(118, 304862, 22840, 9),
(119, 1355632, 1381770, 9),
(120, 304862, 17583, 10),
(121, 1355632, 31151, 10),
(122, 1381770, 22840, 10),
(123, 22840, 31151, 11),
(124, 1355632, 17583, 11),
(125, 1381770, 304862, 11),
(126, 17583, 22840, 12),
(127, 31151, 1381770, 12),
(128, 304862, 1355632, 12),
(129, 22840, 1355632, 13),
(130, 31151, 304862, 13),
(131, 1381770, 17583, 13),
(132, 17583, 31151, 14),
(133, 304862, 22840, 14),
(134, 1355632, 1381770, 14),
(135, 304862, 17583, 15),
(136, 1355632, 31151, 15),
(137, 1381770, 22840, 15),
(138, 22840, 31151, 16),
(139, 1355632, 17583, 16),
(140, 1381770, 304862, 16),
(141, 17583, 22840, 17),
(142, 31151, 1381770, 17),
(143, 304862, 1355632, 17),
(144, 22840, 1355632, 18),
(145, 31151, 304862, 18),
(146, 1381770, 17583, 18),
(147, 17583, 31151, 19),
(148, 304862, 22840, 19),
(149, 1355632, 1381770, 19),
(150, 304862, 17583, 20),
(151, 1355632, 31151, 20),
(152, 1381770, 22840, 20),
(153, 22840, 31151, 21),
(154, 1355632, 17583, 21),
(155, 1381770, 304862, 21),
(156, 17583, 22840, 22),
(157, 31151, 1381770, 22),
(158, 304862, 1355632, 22),
(159, 22840, 1355632, 23),
(160, 31151, 304862, 23),
(161, 1381770, 17583, 23),
(162, 17583, 31151, 24),
(163, 304862, 22840, 24),
(164, 1355632, 1381770, 24),
(165, 304862, 17583, 25),
(166, 1355632, 31151, 25),
(167, 1381770, 22840, 25),
(168, 22840, 31151, 26),
(169, 1355632, 17583, 26),
(170, 1381770, 304862, 26),
(171, 17583, 22840, 27),
(172, 31151, 1381770, 27),
(173, 304862, 1355632, 27),
(174, 22840, 1355632, 28),
(175, 31151, 304862, 28),
(176, 1381770, 17583, 28),
(177, 17583, 31151, 29),
(178, 304862, 22840, 29),
(179, 1355632, 1381770, 29),
(180, 304862, 17583, 30),
(181, 1355632, 31151, 30),
(182, 1381770, 22840, 30),
(183, 22840, 31151, 31),
(184, 1355632, 17583, 31),
(185, 1381770, 304862, 31),
(186, 17583, 22840, 32),
(187, 31151, 1381770, 32),
(188, 304862, 1355632, 32),
(189, 22840, 1355632, 33),
(190, 31151, 304862, 33),
(191, 1381770, 17583, 33),
(192, 17583, 31151, 34);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `managers`
--

CREATE TABLE IF NOT EXISTS `managers` (
  `team_id` int(50) NOT NULL,
  `first_name` varchar(150) NOT NULL,
  `last_name` varchar(150) NOT NULL,
  PRIMARY KEY (`team_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Gegevens worden geëxporteerd voor tabel `managers`
--

INSERT INTO `managers` (`team_id`, `first_name`, `last_name`) VALUES
(17583, 'Robin', 'Verhulst'),
(22840, 'Sven', 'Stassyns'),
(31151, 'Nielsen', 'Stassyns'),
(304862, 'Philip', 'Hermans'),
(1355632, 'Mitch', 'De Lauwer'),
(1381770, 'Yinan', 'Ma');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `matches`
--

CREATE TABLE IF NOT EXISTS `matches` (
  `id` int(50) NOT NULL AUTO_INCREMENT,
  `home_team_id` int(50) NOT NULL,
  `home_team_score` int(4) NOT NULL,
  `away_team_id` int(50) NOT NULL,
  `away_team_score` int(4) NOT NULL,
  `gameweek` int(4) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
