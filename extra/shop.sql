-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Machine: localhost
-- Genereertijd: 07 Jan 2011 om 17:47
-- Serverversie: 5.1.41
-- PHP-Versie: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `actioncodes`
--

CREATE TABLE IF NOT EXISTS `actioncodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(250) NOT NULL,
  `ean` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `actioncodes`
--

INSERT INTO `actioncodes` (`id`, `action`, `ean`) VALUES
(1, 'delete', '1000'),
(2, 'deposit', '1001');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `deposit`
--

CREATE TABLE IF NOT EXISTS `deposit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deposit_by` varchar(40) NOT NULL,
  `checked_by` varchar(40) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=16 ;

--
-- Gegevens worden uitgevoerd voor tabel `deposit`
--

INSERT INTO `deposit` (`id`, `deposit_by`, `checked_by`, `transaction_id`) VALUES
(1, '2', '3', 4),
(2, '1', '2', 7),
(3, '1', '2', 8),
(4, '1', '2', 9),
(5, '1', '2', 10),
(6, '1', '2', 11),
(7, '1', '2', 12),
(8, '1', '2', 13),
(9, '', '2', 14),
(10, '', '2', 15),
(11, '1', '2', 31),
(12, '1', '2', 33),
(13, '1', '2', 34),
(14, '1', '2', 37),
(15, '1', '2', 39);

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  `price` float NOT NULL,
  `ean` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Gegevens worden uitgevoerd voor tabel `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `ean`) VALUES
(5, 'Club-Mate', 1.5, '1111'),
(6, 'Duvel', 1.5, '2222'),
(7, 'Bier', 1, '3333'),
(8, 'Cola-light', 1, '4444');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` float NOT NULL,
  `user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=40 ;

--
-- Gegevens worden uitgevoerd voor tabel `transactions`
--

INSERT INTO `transactions` (`id`, `amount`, `user`, `date`) VALUES
(1, 15, 1, '2011-01-02 14:33:07'),
(2, -1, 1, '2011-01-02 17:09:08'),
(3, -1.5, 1, '2011-01-02 17:09:08'),
(4, 5, 2, '2011-01-02 17:12:01'),
(5, -1, 2, '2011-01-02 17:12:01'),
(6, 2, 3, '2011-01-05 20:16:07'),
(7, 10, 1, '2011-01-05 20:26:31'),
(8, 23, 1, '2011-01-05 21:00:04'),
(9, 23, 1, '2011-01-05 21:47:28'),
(10, 10, 1, '2011-01-05 21:55:06'),
(11, 10, 1, '2011-01-05 22:06:47'),
(12, 10, 1, '2011-01-05 22:16:18'),
(13, 10, 1, '2011-01-05 22:19:31'),
(14, 10, 0, '2011-01-05 22:20:17'),
(15, 10, 0, '2011-01-05 22:21:17'),
(16, 1, 1, '2011-01-05 22:33:23'),
(17, 7.5, 1, '2011-01-05 22:47:59'),
(18, 7, 1, '2011-01-05 22:48:49'),
(19, 9.5, -1, '2011-01-05 22:50:18'),
(20, -11, 1, '2011-01-05 22:51:10'),
(21, -1.5, 1, '2011-01-05 22:51:40'),
(22, -1.5, 1, '2011-01-05 22:59:06'),
(23, -1.5, 2, '2011-01-05 22:59:21'),
(24, -10, 1, '2011-01-05 23:00:49'),
(25, -1.5, 1, '2011-01-05 23:01:46'),
(26, -1.5, 1, '2011-01-05 23:04:28'),
(27, -6, 1, '2011-01-05 23:29:01'),
(28, -1.5, 1, '2011-01-05 23:30:01'),
(29, -1.5, 1, '2011-01-05 23:31:36'),
(30, -3, 1, '2011-01-06 17:15:27'),
(31, 10, 1, '2011-01-06 17:15:52'),
(32, -3, 1, '2011-01-06 17:22:58'),
(33, 10, 1, '2011-01-06 17:23:41'),
(34, 10, 1, '2011-01-06 17:24:21'),
(35, -3, 1, '2011-01-06 17:24:54'),
(36, -4, 1, '2011-01-06 21:05:26'),
(37, 10, 1, '2011-01-06 21:05:46'),
(38, -3, 1, '2011-01-06 22:00:14'),
(39, 10, 1, '2011-01-06 22:01:39');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `ean` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Gegevens worden uitgevoerd voor tabel `users`
--

INSERT INTO `users` (`id`, `name`, `ean`) VALUES
(1, 'Hans F', '4242'),
(2, 'Sandb', '4343');

-- --------------------------------------------------------

--
-- Tabelstructuur voor tabel `withdraw`
--

CREATE TABLE IF NOT EXISTS `withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Gegevens worden uitgevoerd voor tabel `withdraw`
--

INSERT INTO `withdraw` (`id`, `time`) VALUES
(1, '2010-01-02 17:34:56'),
(2, '2011-01-02 17:39:47'),
(3, '2011-01-02 17:40:03');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
