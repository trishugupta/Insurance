-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2017 at 04:17 PM
-- Server version: 5.6.21
-- PHP Version: 5.6.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `insurance`
--

-- --------------------------------------------------------

--
-- Table structure for table `healthrisk`
--

CREATE TABLE IF NOT EXISTS `healthrisk` (
`riskid` int(11) NOT NULL,
  `planFor` varchar(20) NOT NULL,
  `plan10` varchar(20) NOT NULL,
  `plan20` varchar(20) NOT NULL,
  `plan40` varchar(20) NOT NULL,
  `lifetime` varchar(20) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `healthrisk`
--

INSERT INTO `healthrisk` (`riskid`, `planFor`, `plan10`, `plan20`, `plan40`, `lifetime`) VALUES
(1, 'Self', '0.2', '0.3', '0.4', '0.7'),
(2, 'Family', '0.15', '0.2', '0.3', '0.4');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `healthrisk`
--
ALTER TABLE `healthrisk`
 ADD PRIMARY KEY (`riskid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `healthrisk`
--
ALTER TABLE `healthrisk`
MODIFY `riskid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
