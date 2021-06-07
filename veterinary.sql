-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 07, 2021 at 03:21 AM
-- Server version: 10.1.26-MariaDB
-- PHP Version: 7.1.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `veterinary`
--

-- --------------------------------------------------------

--
-- Table structure for table `tblowners`
--

CREATE TABLE `tblowners` (
  `ownerID` varchar(13) NOT NULL,
  `nameSurname` varchar(60) NOT NULL,
  `phoneNum` varchar(10) NOT NULL,
  `emailAdd` varchar(100) NOT NULL,
  `postalAdd` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblowners`
--

INSERT INTO `tblowners` (`ownerID`, `nameSurname`, `phoneNum`, `emailAdd`, `postalAdd`) VALUES
('7306305017085', 'Mr Jeff', '0147541258', 'jeff@dunham.co.za', '36 Jeff Road'),
('8704020632084', 'Mrs Margaret Wilson', '0654789521', 'margaret@knights.com', '34 Cherry Lane, Westmead'),
('9602150014085', 'Mrs Bokomo', '0846575124', 'bokomo@weetbix.co.za', '14 Sugar Lane, Northcliff');

-- --------------------------------------------------------

--
-- Table structure for table `tblpets`
--

CREATE TABLE `tblpets` (
  `name` varchar(30) NOT NULL,
  `animalType` varchar(30) NOT NULL,
  `breed` varchar(30) NOT NULL,
  `ownerID` varchar(13) NOT NULL,
  `birthdate` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tblpets`
--

INSERT INTO `tblpets` (`name`, `animalType`, `breed`, `ownerID`, `birthdate`) VALUES
('Leigh', 'Cat', 'Persian', '9602150014085', '2016/04/15'),
('Pippet', 'Parrot', 'N/A', '8704020632084', '2000/02/04'),
('Fletcher', 'Dog', 'Labrador', '7306305017085', '2014/09/09'),
('Karen', 'Cat', 'Tubby', '9602150014085', '2016/07/03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tblowners`
--
ALTER TABLE `tblowners`
  ADD PRIMARY KEY (`ownerID`);

--
-- Indexes for table `tblpets`
--
ALTER TABLE `tblpets`
  ADD KEY `ownerID` (`ownerID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
