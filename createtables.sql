
CREATE TABLE `User` (
  `Name` varchar(20) NOT NULL,
  `Username` varchar(32) NOT NULL,
  `Password` varchar(256) NOT NULL,
  `LoggedIn` tinyint(1) DEFAULT NULL,
  Primary Key(Username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;


INSERT INTO `User` (`Name`, `Username`, `Password`, `LoggedIn`) VALUES
('Tiara', 'Clipper', '$2y$10$Hiw6mLeygVC9maJ/aq18D.NCW0e9mRbXvJAqfQUR3fumc7CIVvmeG', 0),
('Ruth', 'DogLover42', '$2y$10$Kz0Er/Oy2U3Xy7XH9lxRT.6Qnfyu9SAbCNdmEG1TRTRe5RQhjF0cu', 0),
('Amber', 'DogLover63', '$2y$10$PyK4cH3I/rpJDFHaKvYGwe0Vg.TDEbbMDIYxiQS8oFP2Q8Yi.UE2e', 0),
('James', 'HandsomeManonHorse', '$2y$10$LFhq1d.r3B64XFbbyUbP8eKX2VSMD6X8lFgTfJs6M.C5DPppfPIPe', 0),
('Mars', 'IhateAnimals32', '$2y$10$xakr7354XYfAds71TBeOwuqOeCc3RD92lsSR4sjQ35KYQXJmMTacm', 0),
('Jessie', 'ilovecatslol', '$2y$10$3jI0ebd/74QHsqjHNUNhmumrFp3LYFEEaHJbNoJesieatvxY8mSMu', 0),
('Audrey', 'PalaceDog', '$2y$10$hqZrMa9.iE7WLx0BCGZOh.cADN1Hf9bWtNuDN34Z/HFbgTAMkVhWa', 0),
('Greg', 'PumpkinButt', '$2y$10$sDmA9Tl1HM0CXpwfAxIcXuu6pi.VQ4VjqOjuC7pV8gnQ0mRqCoaT.', 0),
('Johnny', 'shadethegreat', '$2y$10$cKJxbwpw3/CifwgMHhuto..9VhFlbPMIogRYVy/uqHCyM139dNHF.', 0),
('Juli', 'TheGreatProfessor', '$2y$10$YUKtoacQBfTLB2JB6iekQ.oEC9bkiRd8jlH1wGiPqTYfR1FKhvEAm', 0);


CREATE TABLE `UserID` (
  `id` int AUTO_INCREMENT NOT NULL,
  `Username` varchar(32) NOT NULL,
  `TruePassword` varchar(20) NOT NULL,
     PRIMARY KEY (id),
    FOREIGN KEY (Username) REFERENCES User(Username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `UserID` (`id`, `Username`, `TruePassword`) VALUES
(2, 'Clipper', 'greenBabiesDog12'),
(5, 'HandsomeManonHorse', 'Pile10carup'),
(6, 'PalaceDog', 'MaltesAretheBestDog'),
(7, 'DogLover42', '20FileOnaDay'),
(8, 'TheGreatProfessor', 'CS340RocksOn'),
(10, 'PumpkinButt', 'HalloweenCostume2017'),
(12, 'shadethegreat', 'shadowsImtheN1ght'),
(13, 'ilovecatslol', 'catSaReBesT8'),
(14, 'DogLover63', 'MyGreatBabushka12'),
(15, 'IhateAnimals32', 'AllAnimalsAnnoying');


CREATE TABLE `Dog_Profile` (
  `Phone_Number` bigint(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Gender` varchar(2) NOT NULL, 
  `Fixed` bit(1) NOT NULL, 
  `Description` varchar(500) DEFAULT NULL,
  `Dog_ID` int(9) NOT NULL, 
   `Username` varchar(32) NOT NULL,
  `HateCount` int(11) NOT NULL DEFAULT 0,
  `LoveCount` int(11) NOT NULL DEFAULT 0,
   PRIMARY KEY (Dog_ID),
    FOREIGN KEY (Username) REFERENCES User(Username)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
 
INSERT INTO `Dog_Profile` (`Phone_Number`, `Name`, `Gender`, `Fixed`, `Description`, `Dog_ID`, `Username`) VALUES
(5036666666, 'Santa', 'M', 1, 'A Maltese Male anger issues with a jolly disposition. Blake in Color with hair tufts that make it appear as it has horns.' , 564565638, 'PalaceDog'),
(7577577577, 'Impulse', 'M', 1, 'He love to jump and bark', 101775545, 'Clipper'),
(7038048505, 'Hero', 'M', 1, 'Really bad dog', 101774229, 'ilovecatslol'),
(5034564567, 'Angel', 'F', 1, 'A wonderful dog that acts like a grandmother to baby dogs.', 534246136, 'DogLover63'),
(3842901767, 'Kaylee', 'F', 1, 'Just the worst', 888761290, 'IhateAnimals32'),
(9998887777, 'Sunny', 'F', 1, 'She will eat your socks', 123456789, 'DogLover42'),
(3456781234, 'Jeremiah', 'M', 0, 'He was a bullfrog', 987345103, 'shadethegreat'),
(1982934012, 'Pluto', 'M', 0, 'Mickeys best friend', 303030303, 'PumpkinButt'),
(5034564560, 'Lily', 'F', 0, 'A cute hyper dog that loves to bark as much as she loves cheese', 534246137, 'HandsomeManonHorse'),
(5034564567, 'Elijah', 'M', 0, 'A Dog who looks and acts like a stuff animal.', 534246139, 'TheGreatProfessor');



CREATE TABLE `ImgUpload` (
  `id` int(11) AUTO_INCREMENT NOT NULL,
  `Dog_ID` int(9) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 0,
  `ImgName` varchar(32) NOT NULL,
    PRIMARY KEY (`id`),
    FOREIGN KEY (`Dog_ID`) REFERENCES `Dog_Profile` (`Dog_ID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
CREATE TABLE `Location` (
  `Location_ID` int(9) NOT NULL, 
  `Name` varchar(50) NOT NULL,
  `Zip` int(5) NOT NULL, 
  `City` varchar(20) NOT NULL,
  `State` varchar(2) NOT NULL,
  `Address` varchar(50) NOT NULL, 
   PRIMARY KEY (`Location_ID`)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
INSERT INTO `Location` ( `Location_ID`, `Name`, `Zip`,  `City`, `State`, `Address`) VALUES
(227020001, 'Pilgrim Bark Park', '22702','Provincetown', 'MA', '227 US-6'),
(545450001, 'Central Park', '54545', 'New York', 'NY', '1800 Central Park Dr'),
(234350001, 'Harbour View', '23435', 'Suffolk', 'VA', '5111 N Kemper Lakes Ct'),
(231120001, 'Maymont', '23112', 'Richmond', 'VA', '15520 Fox Gate Ct'),
(121340001, 'Public Garden', '12134', 'Boston', 'MA', '751 Tremont St'),
(121340002, 'Boston Common', '12134', 'Boston', 'MA', '791 Boylston St'),
(973330001, 'Creekside and Spring Creek Dog Park', '97333', 'Corvallis', 'OR', '1613 SW 49th St'),
(973320001, 'Albany Dog Park at Timber Linn Park', '97332', 'Albany', 'OR', 'Price Rd SE'),
(973330002, 'Woodland Meadow Park', '97333', 'Corvallis', 'OR', '3540 NW Circle Blvd'),
(973330003, 'Corvallis Fenced Dog Park', '97333', 'Corvallis', 'OR', '205 SW B Ave');
 
 
 CREATE TABLE `Visited` (
  `Username` varchar(32) NOT NULL, 
  `Location_ID` int(9) NOT NULL, 
   `VisitedKey` varchar(29) NOT NULL,
   PRIMARY KEY (VisitedKey),
    FOREIGN KEY (Username) REFERENCES User(Username),
  FOREIGN KEY (Location_ID) REFERENCES Location(Location_ID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `Visited` (`Username`, `Location_ID`, `VisitedKey`) VALUES
('HandsomeManonHorse', 973330001, CONCAT(`Username`, `Location_ID`)),
('HandsomeManonHorse', 973330002, CONCAT(`Username`, `Location_ID`)),
('HandsomeManonHorse', 973330003, CONCAT(`Username`, `Location_ID`)),
('PumpkinButt', 121340001, CONCAT(`Username`, `Location_ID`)),
('PumpkinButt', 121340002, CONCAT(`Username`, `Location_ID`)),
('IhateAnimals32', 234350001, CONCAT(`Username`, `Location_ID`)),
('ilovecatslol', 231120001, CONCAT(`Username`, `Location_ID`)),
('Clipper', 227020001, CONCAT(`Username`, `Location_ID`)),
('TheGreatProfessor', 973330002, CONCAT(`Username`, `Location_ID`)),
('DogLover42', 545450001, CONCAT(`Username`, `Location_ID`)),
('DogLover63', 545450001, CONCAT(`Username`, `Location_ID`));

                                 
CREATE TABLE `Hates`(
  `Dog_ID` int(9) NOT NULL, 
  `HatesDog_ID_2` int(9) NOT NULL,
  `HateKey` bigint(18) NOT NULL,
    PRIMARY KEY (HateKey),
  INDEX `Dog_ID_key_idx` (`Dog_ID` ASC),
  INDEX `HatesDog_ID_2_key_idx` (`HatesDog_ID_2` ASC),
  CONSTRAINT `Dog_ID_key`
    FOREIGN KEY (`Dog_ID`)
    REFERENCES Dog_Profile(Dog_ID)
    ON DELETE NO ACTION,
  CONSTRAINT `HatesDog_ID_2_key`
    FOREIGN KEY (`HatesDog_ID_2`)
    REFERENCES Dog_Profile(Dog_ID)
    ON DELETE NO ACTION); 
                                 
 
INSERT INTO `Hates` (`Dog_ID`, `HatesDog_ID_2`, `HateKey`) VALUES
(101775545, 888761290, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(888761290, 101775545, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(987345103, 101775545, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(101775545, 987345103, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(987345103, 888761290, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(534246137, 123456789, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(123456789, 101775545, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(101775545, 303030303, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(303030303, 101775545, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(123456789, 534246137, CONCAT(`Dog_ID`, `HatesDog_ID_2`));


 
CREATE TABLE `Loves`(
  `Dog_ID` int(9) NOT NULL, 
  `LovesDog_ID_2` int(9) NOT NULL,
  `LoveKey` bigint(18) NOT NULL,
    PRIMARY KEY (LoveKey),
  INDEX `Dog_ID_key_idx` (`Dog_ID` ASC),
  INDEX `LovesDog_ID_2_key_idx` (`LovesDog_ID_2` ASC),
  CONSTRAINT `Dog_ID2_key`
    FOREIGN KEY (`Dog_ID`)
    REFERENCES Dog_Profile(Dog_ID)
    ON DELETE NO ACTION,
  CONSTRAINT `LovesDog_ID_2_key`
    FOREIGN KEY (`LovesDog_ID_2`)
    REFERENCES Dog_Profile(Dog_ID)
    ON DELETE NO ACTION); 

 
INSERT INTO `Loves` (`Dog_ID`, `LovesDog_ID_2`, `LoveKey`) VALUES
(101775545, 888761290, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(888761290, 101775545, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(987345103, 101775545, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(101775545, 987345103, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(987345103, 888761290, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(534246137, 303030303, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(303030303, 123456789, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(101775545, 303030303, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(303030303, 101775545, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(123456789, 534246137, CONCAT(`Dog_ID`, `LovesDog_ID_2`));
