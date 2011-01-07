-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Jan 02, 2011 at 06:14 PM
-- Server version: 5.1.41
-- PHP Version: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

--
-- Database: `shop`
--

-- --------------------------------------------------------

--
-- Table structure for table `deposit`a
--

CREATE TABLE IF NOT EXISTS `deposit` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `deposit_by` varchar(40) NOT NULL,
  `checked_by` varchar(40) NOT NULL,
  `transaction_id` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Dumping data for table `deposit`
--


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
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=6 ;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `amount`, `user`, `date`) VALUES
(1, 15, 1, '2011-01-02 14:33:07'),
(2, -1, 1, '2011-01-02 17:09:08'),
(3, -1.5, 1, '2011-01-02 17:09:08'),
(4, 5, 2, '2011-01-02 17:12:01'),
(5, -1, 2, '2011-01-02 17:12:01');

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
(1, 'Hans F', '3333'),
(2, 'Sandb', '232455');

-- --------------------------------------------------------

--
-- Table structure for table `withdraw`
--

CREATE TABLE IF NOT EXISTS `withdraw` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Dumping data for table `withdraw`
--

INSERT INTO `withdraw` (`id`, `time`) VALUES
(1, '2010-01-02 17:34:56'),
(2, '2011-01-02 17:39:47'),
(3, '2011-01-02 17:40:03');
