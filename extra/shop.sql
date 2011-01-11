-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 11, 2011 at 04:11 
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `actioncodes`
--

CREATE TABLE IF NOT EXISTS `actioncodes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `action` varchar(250) NOT NULL,
  `ean` varchar(13) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `actioncodes`
--

INSERT INTO `actioncodes` (`id`, `action`, `ean`) VALUES
(1, 'delete', '1000'),
(2, 'deposit', '1001'),
(3, 'empty', '1002');

-- --------------------------------------------------------

--
-- Table structure for table `deposit`
--

CREATE TABLE IF NOT EXISTS `deposit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deposit_by` varchar(40) NOT NULL,
  `checked_by` varchar(40) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `deposit`
--

INSERT INTO `deposit` (`id`, `deposit_by`, `checked_by`, `transaction_id`) VALUES
(1, '1', '2', 1),
(2, '1', '1', 3),
(3, '1', '1', 4),
(4, '1', '1', 5),
(5, '', '', 6),
(6, '1', '1', 7),
(7, '1', '2', 9),
(8, '2', '1', 10);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE IF NOT EXISTS `products` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(11) NOT NULL,
  `price` float NOT NULL,
  `ean` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=9 ;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `ean`) VALUES
(5, 'Club-Mate', 1.5, '1111'),
(6, 'Duvel', 1.5, '2222'),
(7, 'Bier', 1, '3333'),
(8, 'Cola-light', 1, '4444');

-- --------------------------------------------------------

--
-- Table structure for table `transactions`
--

CREATE TABLE IF NOT EXISTS `transactions` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `amount` float NOT NULL,
  `user` int(11) NOT NULL,
  `date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `amount`, `user`, `date`) VALUES
(1, 10, 1, '2011-01-11 15:55:19'),
(2, -3, 1, '2011-01-11 15:55:40'),
(3, 10, 1, '2011-01-11 15:58:57'),
(4, 10, 1, '2011-01-11 15:59:12'),
(5, 10, 1, '2011-01-11 16:00:30'),
(6, 0, 0, '2011-01-11 16:00:59'),
(7, 20, 1, '2011-01-11 16:01:12'),
(8, -7, 1, '2011-01-11 16:04:37'),
(9, 10, 1, '2011-01-11 16:04:51'),
(10, 10, 2, '2011-01-11 16:05:27'),
(11, -1.5, 2, '2011-01-11 16:06:00');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(75) NOT NULL,
  `ean` varchar(40) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `ean`) VALUES
(1, 'Hans F', '4242'),
(2, 'Sandb', '4343');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE IF NOT EXISTS `withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Dumping data for table `withdraw`
--

INSERT INTO `withdraw` (`id`, `time`) VALUES
(1, '2010-01-02 17:34:56'),
(2, '2011-01-02 17:39:47'),
(3, '2011-01-02 17:40:03'),
(4, '2011-01-11 16:10:21');
