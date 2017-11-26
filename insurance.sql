-- phpMyAdmin SQL Dump
-- version 4.2.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 06, 2017 at 04:02 AM
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
-- Table structure for table `carpolicydetails`
--

CREATE TABLE IF NOT EXISTS `carpolicydetails` (
`cpid` int(11) NOT NULL,
  `quoteref` varchar(50) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `purchasedate` date NOT NULL,
  `vehicleno` varchar(50) NOT NULL,
  `vRegistLocation` varchar(50) NOT NULL,
  `isAccidentCoverage` tinyint(1) NOT NULL,
  `AccCoverageAmount` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `idtype` varchar(50) NOT NULL,
  `idno` varchar(50) NOT NULL,
  `photopath` varchar(100) NOT NULL,
  `policyno` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carpolicydetails`
--

INSERT INTO `carpolicydetails` (`cpid`, `quoteref`, `manufacturer`, `model`, `purchasedate`, `vehicleno`, `vRegistLocation`, `isAccidentCoverage`, `AccCoverageAmount`, `fname`, `lname`, `email`, `dob`, `idtype`, `idno`, `photopath`, `policyno`) VALUES
(1, 'QRef20178618834', 'Chevrolet', 'Corvette', '2015-02-22', 'de2d1231', 'allahabad', 0, '30000', '', '', '', '0000-00-00', 'dl', '', 'images/', '1338265837'),
(2, 'QRef20179791888', 'Chevrolet', 'Corvette', '2015-12-22', 'de2d1231', 'Allahabad', 0, '123444', '', '', '', '0000-00-00', 'dl', '', 'images/', '1295149558');

-- --------------------------------------------------------

--
-- Table structure for table `carquote`
--

CREATE TABLE IF NOT EXISTS `carquote` (
`quoteid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `carrisk`
--

CREATE TABLE IF NOT EXISTS `carrisk` (
`carid` int(11) NOT NULL,
  `manufacturer` varchar(50) NOT NULL,
  `modelno` varchar(50) NOT NULL,
  `riskfactor` varchar(20) NOT NULL,
  `accidentrisk` varchar(20) NOT NULL DEFAULT '0.1'
) ENGINE=InnoDB AUTO_INCREMENT=16 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `carrisk`
--

INSERT INTO `carrisk` (`carid`, `manufacturer`, `modelno`, `riskfactor`, `accidentrisk`) VALUES
(1, 'Ford', 'Model T', '0.53', '0.63'),
(2, 'Chevrolet', 'Corvette', '0.53', '0.63'),
(3, 'Ford', 'Thunderbird', '0.53', '0.63'),
(4, 'BMW', '600', '0.44', '0.63'),
(5, 'Chevrolet', 'Corvair', '0.53', '0.63'),
(6, 'Ford', 'E-Series', '0.53', '0.63'),
(7, 'Ford', 'Mustang', '0.53', '0.63'),
(8, 'Chevrolet', 'Corvair 500', '0.53', '0.63'),
(9, 'Volkswagen', 'Beetle', '0.53', '0.63'),
(10, 'Volkswagen', 'Golf', '0.53', '0.63'),
(11, 'BMW', '3 Series', '0.44', '0.63'),
(12, 'BMW', '5 Series', '0.44', '0.63'),
(13, 'BMW', '7 Series', '0.44', '0.63'),
(14, 'BMW', '8 Series', '0.44', '0.63'),
(15, 'BMW', 'M5', '0.44', '0.63');

-- --------------------------------------------------------

--
-- Table structure for table `claims`
--

CREATE TABLE IF NOT EXISTS `claims` (
`claimId` int(11) NOT NULL,
  `claimamount` varchar(50) NOT NULL,
  `policyno` varchar(50) NOT NULL,
  `claimedby` int(11) NOT NULL,
  `Approved` tinyint(1) NOT NULL DEFAULT '0',
  `Rejected` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `claims`
--

INSERT INTO `claims` (`claimId`, `claimamount`, `policyno`, `claimedby`, `Approved`, `Rejected`) VALUES
(1, '240000', '1295149558', 4, 1, 0);

-- --------------------------------------------------------

--
-- Table structure for table `healthpolicydetails`
--

CREATE TABLE IF NOT EXISTS `healthpolicydetails` (
`hpid` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `idtype` varchar(50) NOT NULL,
  `idno` varchar(50) NOT NULL,
  `relation` varchar(50) NOT NULL,
  `photopath` varchar(100) NOT NULL,
  `policyno` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `healthpolicydetails`
--

INSERT INTO `healthpolicydetails` (`hpid`, `fname`, `lname`, `email`, `dob`, `idtype`, `idno`, `relation`, `photopath`, `policyno`) VALUES
(2, 'Trishna', 'Gupta', 'trishnagupta56@gmail.com', '1993-12-22', 'Aadhaar', '0987654356', 'Self', '', '1305670962'),
(37, 'Trishna', 'Gupta', 'trishnagupta56@gmail.com', '1993-12-22', 'Aadhaar', '76213456789', 'Self', 'images/WhatsApp Image 2017-10-19 at 4.39.22 AM.jpeg', '1115896469'),
(43, '', '', '', '1993-12-22', 'dl', '', 'Self', 'images/', '1224080147'),
(44, 'Trishna', 'Tripathi', 'trishnagupta56@gmail.com', '1997-07-08', 'Aadhaar', '675432123345', 'Spouse', 'images/vendetta_07.jpg', '1224080147'),
(45, 'Shubhanshut1', 'Gupta', '', '2001-12-22', 'Aadhaar', '2342342343', 'Kids', 'images/1604491_930614630380000_3925529721356506746_n.jpg', '1224080147');

-- --------------------------------------------------------

--
-- Table structure for table `healthquote`
--

CREATE TABLE IF NOT EXISTS `healthquote` (
`quoteid` int(11) NOT NULL,
  `UserId` int(11) DEFAULT NULL,
  `QuoteRef` varchar(100) NOT NULL,
  `ValidFrom` date NOT NULL,
  `ValidTo` date NOT NULL,
  `Premium` varchar(100) NOT NULL,
  `planfor` int(11) NOT NULL,
  `dob` date NOT NULL,
  `coverage` varchar(50) NOT NULL,
  `term` int(11) NOT NULL,
  `frequency` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=94 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `healthquote`
--

INSERT INTO `healthquote` (`quoteid`, `UserId`, `QuoteRef`, `ValidFrom`, `ValidTo`, `Premium`, `planfor`, `dob`, `coverage`, `term`, `frequency`) VALUES
(19, 0, 'QRef65889857', '2017-11-04', '2018-08-31', '5079.08', 1, '1993-12-22', '400000', 10, 1),
(20, 0, 'QRef12100411', '2017-11-04', '2018-08-31', '0', 1, '1993-12-22', '', 10, 1),
(21, 0, 'QRef43386976', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(22, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '0', 0, '0000-00-00', '', 0, 0),
(23, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '0', 0, '0000-00-00', '', 0, 0),
(24, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '0', 0, '0000-00-00', '', 0, 0),
(25, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '0', 0, '0000-00-00', '', 0, 0),
(26, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '0', 0, '0000-00-00', '', 0, 0),
(27, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '0', 0, '0000-00-00', '', 0, 0),
(28, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '0', 0, '0000-00-00', '', 0, 0),
(29, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '0', 0, '0000-00-00', '', 0, 0),
(30, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '0', 0, '0000-00-00', '', 0, 0),
(31, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '', 0, '0000-00-00', '', 0, 0),
(32, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '', 0, '0000-00-00', '', 0, 0),
(33, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '', 0, '0000-00-00', '', 0, 0),
(34, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '', 0, '0000-00-00', '', 0, 0),
(35, 4, 'QRef60170014', '2017-11-04', '2018-08-31', '', 0, '0000-00-00', '', 0, 0),
(36, 0, 'QRef52838705', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(37, 0, 'QRef77970430', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(38, 0, 'QRef78076434', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(39, 0, 'QRef26253004', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(40, 0, 'QRef16142577', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(41, 0, 'QRef60103281', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(42, 0, 'QRef36391890', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(43, 0, 'QRef93067989', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(44, 0, 'QRef73950969', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(45, 0, 'QRef55254441', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(46, 0, 'QRef80712593', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(47, 0, 'QRef72712901', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(48, 0, 'QRef71573392', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(49, 0, 'QRef45746553', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(50, 0, 'QRef80198031', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(51, 0, 'QRef19547532', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(52, 0, 'QRef69495009', '2017-11-04', '2018-08-31', '0', 4, '0000-00-00', '', 10, 1),
(53, 0, 'QRef31866805', '2017-11-04', '2018-08-31', '0', 4, '0000-00-00', '', 10, 1),
(54, 0, 'QRef32934163', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(55, 0, 'QRef43437196', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(56, 0, 'QRef39594474', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(57, 0, 'QRef88382414', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(58, 0, 'QRef59582232', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(59, 0, 'QRef51911491', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(60, 0, 'QRef84476594', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(61, 0, 'QRef91187743', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(62, 0, 'QRef94297776', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(63, 0, 'QRef94392780', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(64, 0, 'QRef77284745', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(65, 0, 'QRef27341699', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(66, 0, 'QRef67965060', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(67, 0, 'QRef28015390', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(68, 0, 'QRef57493407', '2017-11-04', '2018-08-31', '0', 1, '0000-00-00', '', 10, 1),
(69, 0, 'QRef15521754', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(70, 0, 'QRef73685416', '2017-11-04', '2018-08-31', '0', 4, '0000-00-00', '', 10, 1),
(71, 0, 'QRef92221485', '2017-11-04', '2018-08-31', '0', 3, '0000-00-00', '', 10, 1),
(72, 0, 'QRef24163630', '2017-11-04', '2018-08-31', '0', 3, '0000-00-00', '', 10, 1),
(73, 0, 'QRef41553877', '2017-11-04', '2018-08-31', '0', 3, '0000-00-00', '', 10, 1),
(74, 0, 'QRef91947945', '2017-11-04', '2018-08-31', '2975.38', 1, '1993-12-22', '234324', 10, 1),
(75, 0, 'QRef80548640', '2017-11-04', '2018-08-31', '2975.38', 1, '1993-12-22', '234324', 10, 1),
(76, 0, 'QRef22859212', '2017-11-04', '2018-08-31', '2975.38', 1, '1993-12-22', '234324', 10, 1),
(77, 0, 'QRef22569867', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(78, 0, 'QRef16854497', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(79, 0, 'QRef68781257', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(80, 0, 'QRef81233051', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(81, 0, 'QRef40156081', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(82, 0, 'QRef98799288', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(83, 0, 'QRef40896453', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(84, 0, 'QRef90135763', '2017-11-04', '2018-08-31', '0', 2, '0000-00-00', '', 10, 1),
(85, 0, 'QRef99987063', '2017-11-04', '2018-08-31', '0', 3, '1993-12-22', '', 10, 1),
(86, 0, 'QRef36354158', '2017-11-05', '2018-09-01', '6348.85', 1, '1993-12-22', '500000', 10, 1),
(87, 0, 'QRef83354219', '2017-11-05', '2018-09-01', '6348.85', 1, '1993-12-22', '500000', 10, 1),
(88, 4, 'QRef14620434', '2017-11-05', '2018-09-01', '5713.97', 1, '1993-12-22', '450000', 10, 1),
(89, 4, 'QRef19361550', '2017-11-05', '2018-09-01', '5079.08', 1, '1993-12-22', '400000', 10, 1),
(90, 4, 'QRef20175344136', '2017-11-05', '2018-09-01', '2974.23', 4, '1993-12-22', '234234', 10, 1),
(91, 4, 'QRef20173948262', '2017-11-05', '2018-09-01', '2974.23', 4, '1993-12-22', '234234', 10, 1),
(92, 4, 'QRef20175821313', '2017-11-05', '2018-09-01', '5079.08', 3, '1993-12-22', '400000', 10, 1),
(93, 4, 'QRef20174375159', '2017-11-05', '2018-09-01', '5079.08', 1, '1993-12-22', '400000', 10, 1);

-- --------------------------------------------------------

--
-- Table structure for table `healthrisk`
--

CREATE TABLE IF NOT EXISTS `healthrisk` (
  `pAmount` varchar(50) NOT NULL,
  `upto18` varchar(50) NOT NULL,
  `18to30` varchar(50) NOT NULL,
  `30to40` varchar(50) NOT NULL,
  `40to50` varchar(50) NOT NULL,
  `50to60` varchar(50) NOT NULL,
  `60to70` varchar(50) NOT NULL,
  `70to80` varchar(50) NOT NULL,
  `80to90` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `healthrisk`
--

INSERT INTO `healthrisk` (`pAmount`, `upto18`, `18to30`, `30to40`, `40to50`, `50to60`, `60to70`, `70to80`, `80to90`) VALUES
('200000', '440', '4860', '5200', '5500', '5900', '6300', '6700', '7200');

-- --------------------------------------------------------

--
-- Table structure for table `homepolicydetails`
--

CREATE TABLE IF NOT EXISTS `homepolicydetails` (
`homepid` int(11) NOT NULL,
  `quoteref` varchar(50) NOT NULL,
  `pincode` varchar(50) NOT NULL,
  `buildyear` varchar(50) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(50) NOT NULL,
  `idtype` varchar(50) NOT NULL,
  `idno` varchar(50) NOT NULL,
  `state` varchar(50) NOT NULL,
  `address` varchar(100) NOT NULL,
  `photopath` varchar(100) NOT NULL,
  `policyno` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homepolicydetails`
--

INSERT INTO `homepolicydetails` (`homepid`, `quoteref`, `pincode`, `buildyear`, `fname`, `lname`, `dob`, `email`, `idtype`, `idno`, `state`, `address`, `photopath`, `policyno`) VALUES
(1, 'QRef20175891481', '737139', '', 'Shubhanshu', 'Tripathi', '1993-12-22', 'shubhanshutripathi.88@gmail.com', 'Aadhaar', '123123', 'ARP', 'asdad\r\nsda\r\ns', 'images/22550456_494483867583479_3570358989253503393_o.png', '1392152027'),
(2, 'QRef20172015401', '737139', '2014', 'Trishna', 'Gupta', '1993-12-22', 'trishnagupta56@gmail.com', 'Aadhaar', '24234123', 'ARP', 'asa\r\nasdsad', 'images/22323883_707363212803177_1474478321_o.png', '1216074624'),
(3, 'QRef20172015401', '737139', '2014', 'Trishna', 'Gupta', '1993-12-22', 'trishnagupta56@gmail.com', 'Aadhaar', '24234123', 'ARP', 'asa\r\nasdsad', 'images/22323883_707363212803177_1474478321_o.png', '1216074624'),
(4, 'QRef20172015401', '737139', '2014', 'Trishna', 'Gupta', '1993-12-22', 'trishnagupta56@gmail.com', 'Aadhaar', '24234123', 'ARP', 'asa\r\nasdsad', 'images/22323883_707363212803177_1474478321_o.png', '1216074624'),
(5, 'QRef20172015401', '737139', '2014', 'Trishna', 'Gupta', '1993-12-22', 'trishnagupta56@gmail.com', 'Aadhaar', '24234123', 'ARP', 'asa\r\nasdsad', 'images/22323883_707363212803177_1474478321_o.png', '1216074624'),
(6, 'QRef20172015401', '737139', '2014', 'Trishna', 'Gupta', '1993-12-22', 'trishnagupta56@gmail.com', 'Aadhaar', '24234123', 'ARP', 'asa\r\nasdsad', 'images/22323883_707363212803177_1474478321_o.png', '1216074624'),
(7, 'QRef20174947751', '737139', '2013', 'Trishna', 'Gupta', '1993-12-22', 'trishnagupta56@gmail.com', 'Aadhaar', '35434543', 'BIH', 'sdfsd\r\nsdfsd\r\n', 'images/22323883_707363212803177_1474478321_o.png', '1179355398'),
(8, 'QRef20174947751', '737139', '2013', 'Trishna', 'Gupta', '1993-12-22', 'trishnagupta56@gmail.com', 'Aadhaar', '35434543', 'BIH', 'sdfsd\r\nsdfsd\r\n', 'images/22323883_707363212803177_1474478321_o.png', '1179355398'),
(9, 'QRef20174947751', '737139', '2013', 'Trishna', 'Gupta', '1993-12-22', 'trishnagupta56@gmail.com', 'Aadhaar', '35434543', 'BIH', 'sdfsd\r\nsdfsd\r\n', 'images/22323883_707363212803177_1474478321_o.png', '1179355398'),
(10, 'QRef20172296595', '737139', '2013', 'Trishna', 'Gupta', '1997-07-08', 'trishnagupta56@gmail.com', 'Aadhaar', '234342', 'ARP', 'sdfdf\r\nsdfds\r\n', 'images/13913938_1041527859265480_7616866172783051428_o.jpg', '1279817832'),
(11, 'QRef20172296595', '737139', '2013', 'Trishna', 'Gupta', '1997-07-08', 'trishnagupta56@gmail.com', 'Aadhaar', '234342', 'ARP', 'sdfdf\r\nsdfds\r\n', 'images/13913938_1041527859265480_7616866172783051428_o.jpg', '1279817832'),
(12, 'QRef20172296595', '737139', '2013', 'Trishna', 'Gupta', '1997-07-08', 'trishnagupta56@gmail.com', 'Aadhaar', '234342', 'ARP', 'sdfdf\r\nsdfds\r\n', 'images/13913938_1041527859265480_7616866172783051428_o.jpg', '1279817832'),
(13, 'QRef20172296595', '737139', '2013', 'Trishna', 'Gupta', '1997-07-08', 'trishnagupta56@gmail.com', 'Aadhaar', '234342', 'ARP', 'sdfdf\r\nsdfds\r\n', 'images/13913938_1041527859265480_7616866172783051428_o.jpg', '1279817832'),
(14, 'QRef20172296595', '737139', '2013', 'Trishna', 'Gupta', '1997-07-08', 'trishnagupta56@gmail.com', 'Aadhaar', '234342', 'ARP', 'sdfdf\r\nsdfds\r\n', 'images/13913938_1041527859265480_7616866172783051428_o.jpg', '1279817832'),
(15, 'QRef20172296595', '737139', '2013', 'Trishna', 'Gupta', '1997-07-08', 'trishnagupta56@gmail.com', 'Aadhaar', '234342', 'ARP', 'sdfdf\r\nsdfds\r\n', 'images/13913938_1041527859265480_7616866172783051428_o.jpg', '1279817832'),
(16, 'QRef20172296595', '737139', '2013', 'Trishna', 'Gupta', '1997-07-08', 'trishnagupta56@gmail.com', 'Aadhaar', '234342', 'ARP', 'sdfdf\r\nsdfds\r\n', 'images/13913938_1041527859265480_7616866172783051428_o.jpg', '1279817832'),
(17, 'QRef20172296595', '737139', '2013', 'Trishna', 'Gupta', '1997-07-08', 'trishnagupta56@gmail.com', 'Aadhaar', '234342', 'ARP', 'sdfdf\r\nsdfds\r\n', 'images/13913938_1041527859265480_7616866172783051428_o.jpg', '1279817832');

-- --------------------------------------------------------

--
-- Table structure for table `homequote`
--

CREATE TABLE IF NOT EXISTS `homequote` (
`quoteid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `homerisk`
--

CREATE TABLE IF NOT EXISTS `homerisk` (
`LriskId` int(11) NOT NULL,
  `Pincode` varchar(100) NOT NULL,
  `buildingrate` varchar(100) NOT NULL,
  `contentrate` varchar(20) NOT NULL,
  `buildingRiskFactor` varchar(10) NOT NULL,
  `contentRiskFactor` varchar(10) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `homerisk`
--

INSERT INTO `homerisk` (`LriskId`, `Pincode`, `buildingrate`, `contentrate`, `buildingRiskFactor`, `contentRiskFactor`) VALUES
(2, '737139', '0.33', '0.012', '3', '1.5'),
(3, '212601', '0.5', '0.020', '2.3', '0.8');

-- --------------------------------------------------------

--
-- Table structure for table `policy`
--

CREATE TABLE IF NOT EXISTS `policy` (
`PolicyId` int(11) NOT NULL,
  `QuoteRef` varchar(50) NOT NULL,
  `PolicyNo` varchar(100) NOT NULL,
  `EffectFrom` date NOT NULL,
  `EffectTo` date NOT NULL,
  `Premium` varchar(100) NOT NULL,
  `InsuredSum` varchar(50) NOT NULL,
  `addInsured` varchar(50) NOT NULL,
  `userid` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `policy`
--

INSERT INTO `policy` (`PolicyId`, `QuoteRef`, `PolicyNo`, `EffectFrom`, `EffectTo`, `Premium`, `InsuredSum`, `addInsured`, `userid`) VALUES
(1, '1', '102100', '2017-11-18', '2035-11-18', '102000', '', '', 4),
(2, '1', '102101', '2017-11-18', '2035-11-18', '102000', '', '', 4),
(3, '1', '102105', '2017-11-18', '2035-11-18', '102000', '', '', 3),
(11, 'QRef20172296595', '1279817832', '2017-11-06', '2017-11-06', '2492.31', '200000', '200000', 4),
(12, 'QRef20179791888', '1295149558', '2017-11-06', '2017-11-06', '2210.53', '200000', '200000', 4);

-- --------------------------------------------------------

--
-- Table structure for table `queries`
--

CREATE TABLE IF NOT EXISTS `queries` (
`queryid` int(11) NOT NULL,
  `name` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `message` varchar(255) NOT NULL,
  `isfeedback` tinyint(1) NOT NULL DEFAULT '0'
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `queries`
--

INSERT INTO `queries` (`queryid`, `name`, `email`, `message`, `isfeedback`) VALUES
(2, 'Trishna Gupta', 'trishnagupta56@gmail.com', 'Hi,\r\n\r\nThis is a test query.', 0),
(3, 'Trishna Gupta', 'trishnagupta56@gmail.com', 'Hi,\r\n\r\nThis is a test query.', 1),
(4, 'Trishna Gupta', 'trishnagupta56@gmail.com', 'Hi,\r\n\r\nThis is a test query.', 0);

-- --------------------------------------------------------

--
-- Table structure for table `renewals`
--

CREATE TABLE IF NOT EXISTS `renewals` (
`renewalid` int(11) NOT NULL,
  `policyno` varchar(50) NOT NULL,
  `revisedpremium` varchar(50) NOT NULL,
  `revisedexpiry` date NOT NULL,
  `renewedby` int(11) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `renewals`
--

INSERT INTO `renewals` (`renewalid`, `policyno`, `revisedpremium`, `revisedexpiry`, `renewedby`) VALUES
(1, '1295149558', '2460.68', '2040-11-06', 4);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
`RoleId` int(11) NOT NULL,
  `RoleName` varchar(50) NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`RoleId`, `RoleName`) VALUES
(1, 'Admin'),
(2, 'Customer');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
`userid` int(11) NOT NULL,
  `fname` varchar(100) NOT NULL,
  `lname` varchar(100) NOT NULL,
  `emailid` varchar(100) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(50) NOT NULL,
  `photopath` varchar(100) NOT NULL,
  `roleid` int(11) NOT NULL DEFAULT '2',
  `lastlogin` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`userid`, `fname`, `lname`, `emailid`, `dob`, `password`, `photopath`, `roleid`, `lastlogin`) VALUES
(2, 'Admin', '', 'admin@gmail.com', '1997-07-08', 'admin', '', 1, '2017-11-06 03:15:36'),
(3, 'trishna', 'gupta', 'trishna@nit.in', '1997-07-08', '', '', 2, '0000-00-00 00:00:00'),
(4, 'Trishna', 'Gupta', 'trishnagupta56@gmail.com', '1997-07-08', '12345', 'images/WhatsApp Image 2017-10-19 at 4.39.22 AM.jpeg', 2, '0000-00-00 00:00:00'),
(7, 'Shubhanshu', 'Tripathi', 'shubhanshutripathi.88@gmail.com', '1993-12-22', 'vubygy5x5y6izxfqmwkb', 'images/WhatsApp Image 2017-10-19 at 4.39.22 AM.jpeg', 2, '0000-00-00 00:00:00'),
(8, '', '', '', '0000-00-00', 'Txn2017nyzw10a3xgh', 'images/22323883_707363212803177_1474478321_o.png', 2, '0000-00-00 00:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `carpolicydetails`
--
ALTER TABLE `carpolicydetails`
 ADD PRIMARY KEY (`cpid`);

--
-- Indexes for table `carquote`
--
ALTER TABLE `carquote`
 ADD PRIMARY KEY (`quoteid`);

--
-- Indexes for table `carrisk`
--
ALTER TABLE `carrisk`
 ADD PRIMARY KEY (`carid`);

--
-- Indexes for table `claims`
--
ALTER TABLE `claims`
 ADD PRIMARY KEY (`claimId`);

--
-- Indexes for table `healthpolicydetails`
--
ALTER TABLE `healthpolicydetails`
 ADD PRIMARY KEY (`hpid`);

--
-- Indexes for table `healthquote`
--
ALTER TABLE `healthquote`
 ADD PRIMARY KEY (`quoteid`);

--
-- Indexes for table `homepolicydetails`
--
ALTER TABLE `homepolicydetails`
 ADD PRIMARY KEY (`homepid`);

--
-- Indexes for table `homequote`
--
ALTER TABLE `homequote`
 ADD PRIMARY KEY (`quoteid`);

--
-- Indexes for table `homerisk`
--
ALTER TABLE `homerisk`
 ADD PRIMARY KEY (`LriskId`), ADD UNIQUE KEY `Pincode` (`Pincode`);

--
-- Indexes for table `policy`
--
ALTER TABLE `policy`
 ADD PRIMARY KEY (`PolicyId`), ADD KEY `userid` (`userid`);

--
-- Indexes for table `queries`
--
ALTER TABLE `queries`
 ADD PRIMARY KEY (`queryid`);

--
-- Indexes for table `renewals`
--
ALTER TABLE `renewals`
 ADD PRIMARY KEY (`renewalid`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
 ADD PRIMARY KEY (`RoleId`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
 ADD PRIMARY KEY (`userid`), ADD UNIQUE KEY `emailid` (`emailid`), ADD KEY `roleid` (`roleid`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `carpolicydetails`
--
ALTER TABLE `carpolicydetails`
MODIFY `cpid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `carquote`
--
ALTER TABLE `carquote`
MODIFY `quoteid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `carrisk`
--
ALTER TABLE `carrisk`
MODIFY `carid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=16;
--
-- AUTO_INCREMENT for table `claims`
--
ALTER TABLE `claims`
MODIFY `claimId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `healthpolicydetails`
--
ALTER TABLE `healthpolicydetails`
MODIFY `hpid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=46;
--
-- AUTO_INCREMENT for table `healthquote`
--
ALTER TABLE `healthquote`
MODIFY `quoteid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=94;
--
-- AUTO_INCREMENT for table `homepolicydetails`
--
ALTER TABLE `homepolicydetails`
MODIFY `homepid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=18;
--
-- AUTO_INCREMENT for table `homequote`
--
ALTER TABLE `homequote`
MODIFY `quoteid` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `homerisk`
--
ALTER TABLE `homerisk`
MODIFY `LriskId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `policy`
--
ALTER TABLE `policy`
MODIFY `PolicyId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `queries`
--
ALTER TABLE `queries`
MODIFY `queryid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `renewals`
--
ALTER TABLE `renewals`
MODIFY `renewalid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
MODIFY `RoleId` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
MODIFY `userid` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=9;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `policy`
--
ALTER TABLE `policy`
ADD CONSTRAINT `fk_policy_user` FOREIGN KEY (`userid`) REFERENCES `users` (`userid`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
ADD CONSTRAINT `fk_user_role` FOREIGN KEY (`roleid`) REFERENCES `roles` (`RoleId`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
