-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: classmysql.engr.oregonstate.edu:3306
-- Generation Time: Dec 08, 2019 at 12:32 AM
-- Server version: 10.3.13-MariaDB-log
-- PHP Version: 7.0.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cs340_massonit`
--

-- --------------------------------------------------------


--
-- Table structure for table `User`
--

CREATE TABLE `User` (
  `Name` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `LoggedIn` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `User`
--

INSERT INTO `User` (`Name`, `Username`, `Password`, `LoggedIn`) VALUES
('Tiara', 'Clipper', '$2y$10$Hiw6mLeygVC9maJ/aq18D.NCW0e9mRbXvJAqfQUR3fumc7CIVvmeG', 0),
('Ruth', 'DogLover42', '$2y$10$Kz0Er/Oy2U3Xy7XH9lxRT.6Qnfyu9SAbCNdmEG1TRTRe5RQhjF0cu', 0),
('James', 'HandsomeManonHorse', '$2y$10$LFhq1d.r3B64XFbbyUbP8eKX2VSMD6X8lFgTfJs6M.C5DPppfPIPe', 0),
('Audrey', 'PalaceDog', '$2y$10$hqZrMa9.iE7WLx0BCGZOh.cADN1Hf9bWtNuDN34Z/HFbgTAMkVhWa', 0),
('Greg', 'PumpkinButt', '$2y$10$sDmA9Tl1HM0CXpwfAxIcXuu6pi.VQ4VjqOjuC7pV8gnQ0mRqCoaT.', 0),
('Juli', 'TheGreatProfessor', '$2y$10$YUKtoacQBfTLB2JB6iekQ.oEC9bkiRd8jlH1wGiPqTYfR1FKhvEAm', 0);

-- --------------------------------------------------------


--
-- Table structure for table `Dog_Profile`
--

CREATE TABLE `Dog_Profile` (
  `Phone_Number` bigint(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Gender` varchar(2) NOT NULL,
  `Fixed` tinyint(4) NOT NULL,
  `Description` varchar(500) DEFAULT NULL,
  `Dog_ID` int(11) NOT NULL,
  `Username` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Dog_Profile`
--

INSERT INTO `Dog_Profile` (`Phone_Number`, `Name`, `Gender`, `Fixed`, `Description`, `Dog_ID`, `Username`) VALUES
(5036666666, 'Santa', 'M', 1, 'A Maltese Male anger issues with a jolly disposition. Blake in Color with hair tufts that make it appear as it has horns.', 1, 'PalaceDog'),
(7577577577, 'Impulse', 'M', 1, 'He love to jump and bark', 2, 'Clipper'),
(9998887777, 'Sunny', 'F', 1, 'She will eat your socks', 3, 'DogLover42'),
(1982934012, 'Pluto', 'M', 0, 'Mickeys best friend', 4, 'PumpkinButt'),
(5034564560, 'Lily', 'F', 0, 'A cute hyper dog that loves to bark as much as she loves cheese', 5, 'HandsomeManonHorse'),
(5034564567, 'Elijah', 'M', 0, 'A Dog who looks and acts like a stuff animal.', 6, 'TheGreatProfessor');

-- --------------------------------------------------------

--
-- Table structure for table `UserID`
--

CREATE TABLE `UserID` (
  `id` mediumint(9) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `TruePassword` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `UserID`
--

INSERT INTO `UserID` (`id`, `Username`, `TruePassword`) VALUES
(2, 'Clipper', 'greenBabiesDog12'),
(5, 'HandsomeManonHorse', 'Pile10carup'),
(6, 'PalaceDog', 'MaltesAretheBestDog'),
(7, 'DogLover42', '20FileOnaDay'),
(8, 'TheGreatProfessor', 'CS340RocksOn'),
(10, 'PumpkinButt', 'HalloweenCostume2017');

-- --------------------------------------------------------
-- Indexes for dumped tables
--

--
-- Indexes for table `User`
--
ALTER TABLE `User`
  ADD PRIMARY KEY (`Username`);


--
-- Indexes for table `Dog_Profile`
--
ALTER TABLE `Dog_Profile`
  ADD PRIMARY KEY (`Dog_ID`),
  ADD KEY `Username` (`Username`);


--
-- Indexes for table `UserID`
--
ALTER TABLE `UserID`
  ADD PRIMARY KEY (`id`),
  ADD KEY `Username` (`Username`);


--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Dog_Profile`
--
ALTER TABLE `Dog_Profile`
  MODIFY `Dog_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `UserID`
--
ALTER TABLE `UserID`
  MODIFY `id` mediumint(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
--
-- Constraints for dumped tables
--

--
-- Constraints for table `Dog_Profile`
-- Constraints for table `UserID`
--
ALTER TABLE `UserID`
  ADD CONSTRAINT `UserID_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `User` (`Username`);
--
ALTER TABLE `Dog_Profile`
  ADD CONSTRAINT `Dog_Profile_ibfk_1` FOREIGN KEY (`Username`) REFERENCES `User` (`Username`);

--
--
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
