 CREATE TABLE `User` (
  `Name` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL, 
  `Password` varchar(20) NOT NULL, 
    PRIMARY KEY (Username)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;

INSERT INTO `User` (`Name`, `Username`, `Password`) VALUES
('James', 'HandsomeManonHorse', 'Pile10carup'),
('Ruth', 'DogLover42', '20FileOnaDay'),
('Tiara', 'Clipper', 'greenBabiesDog12'),
('Juli', 'TheGreatProfessor', 'CS340RocksOn'),
('Audrey', 'PalaceDog', 'MaltesAretheBestDog'),
('Greg', 'PumpkinButt', 'HalloweenCostumeContest2017'),
('Mars', 'IhateAnimals32', 'AllAnimalsareannoying12'),
('Johnny', 'shadethegreat', 'shadowsImtheN1ght'),
('Jessie', 'ilovecatslol', 'catSaReBesT8'),
('Amber', 'DogLover63', 'MyGreatBabushka12');

CREATE TABLE `Dog_Profile` (
  `Phone_Number` bigint(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Gender` varchar(2) NOT NULL, 
  `Fixed` bit(1) NOT NULL, 
  `Description` varchar(500) DEFAULT NULL,
  `Dog_ID` int(9) NOT NULL, 
   `Username` varchar(20) NOT NULL,
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
(3456781234, 'Jeremiah', 'M', 0, 'He was a bullfrog', 987345103, 'DogLover42'),
(1982934012, 'Pluto', 'M', 0, 'Mickeys best friend', 303030303, 'PumpkinButt'),
(5034564560, 'Lily', 'F', 0, 'A cute hyper dog that loves to bark as much as she loves cheese', 534246137, 'HandsomeManonHorse'),
(5034564567, 'Elijah', 'M', 0, 'A Dog who looks and acts like a stuff animal.', 534246139, 'HandsomeManonHorse');


 
CREATE TABLE `Location` (
  `Name` varchar(50) NOT NULL,
  `Zip` int(5) NOT NULL, 
  `City` varchar(20) NOT NULL,
  `State` varchar(2) NOT NULL,
  `Address` varchar(50) NOT NULL 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
INSERT INTO `Location` (`Name`, `Zip`,  `City`, `State`, `Address`) VALUES
('Pilgrim Bark Park', '22702','Provincetown', 'MA', '227 US-6'),
('Central Park', '54545', 'New York', 'NY', '1800 Central Park Dr'),
('Harbour View', '23435', 'Suffolk', 'VA', '5111 N Kemper Lakes Ct'),
('Maymont', '23112', 'Richmond', 'VA', '15520 Fox Gate Ct'),
('Public Garden', '12134', 'Boston', 'MA', '751 Tremont St'),
('Boston Common', '12134', 'Boston', 'MA', '791 Boylston St'),
('Creekside and Spring Creek Dog Park', '97333', 'Corvallis', 'OR', '1613 SW 49th St'),
('Albany Dog Park at Timber Linn Park', '97332', 'Albany', 'OR', 'Price Rd SE'),
('Woodland Meadow Park', '97333', 'Corvallis', 'OR', '3540 NW Circle Blvd'),
('Corvallis Fenced Dog Park', '97333', 'Corvallis', 'OR', '205 SW B Ave');
 
 
CREATE TABLE `Hates` (
  `Dog_ID` int(9) NOT NULL, 
  `HatesDog_ID_2` int(9) NOT NULL,
  `HateKey` bigint(18) NOT NULL,
    PRIMARY KEY (HatesDog_ID_2),
    FOREIGN KEY (Dog_ID) REFERENCES Dog_Profile(Dog_ID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
INSERT INTO `Hates` (`Dog_ID`, `HatesDog_ID_2`, `HateKey`) VALUES
(101775545, 888761290, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(888761290, 101775545, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(987345103, 101775545, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(101775545, 987345103, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(987345103, 888761290, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(534246135, 757757775, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(303030303, 101775545, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(101775545, 303030303, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(987345103, 101775545, CONCAT(`Dog_ID`, `HatesDog_ID_2`)),
(123456789, 534246135, CONCAT(`Dog_ID`, `HatesDog_ID_2`));


CREATE TABLE `Loves` (
  `Dog_ID` int(9) NOT NULL, 
  `LovesDog_ID_2` int(9) NOT NULL,
  `LoveKey` bigint(18) NOT NULL,
    PRIMARY KEY (LovesDog_ID_2),
    FOREIGN KEY (Dog_ID) REFERENCES Dog_Profile(Dog_ID)
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
INSERT INTO `Loves` (`Dog_ID`, `LovesDog_ID_2`, `LoveKey`) VALUES
(101775545, 888761290, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(888761290, 101775545, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(987345103, 101775545, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(101775545, 987345103, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(987345103, 888761290, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(534246135, 757757775, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(303030303, 101775545, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(101775545, 303030303, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(987345103, 101775545, CONCAT(`Dog_ID`, `LovesDog_ID_2`)),
(123456789, 534246135, CONCAT(`Dog_ID`, `LovesDog_ID_2`));
