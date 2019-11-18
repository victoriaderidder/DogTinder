CREATE TABLE `Dog_Profile` (
  `Phone_Number` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Gender` varchar(2) NOT NULL, 
  `Fixed` bit(1) NOT NULL, 
  `Description` varchar(500) DEFAULT NULL,
  `Dog_ID` int(11) NOT NULL
);

CREATE TABLE `User` (
  `Name` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL, 
  `Password` varchar(20) NOT NULL, 
);

CREATE TABLE `Location` (
  `Name` varchar(50) NOT NULL,
  `Zip` int(5) NOT NULL, 
  `City` varchar(20) NOT NULL,
  `State` varchar(2) NOT NULL,
  `Address` varchar(50) NOT NULL, 
);

CREATE TABLE `Hates` (
  `Dog ID_1` int(11) NOT NULL, 
  `HatesDog ID_2` int(11) NOT NULL
);

CREATE TABLE `Loves` (
  `Dog ID_1` int(11) NOT NULL, 
  `LovesDog ID_2` int(11) NOT NULL
);
