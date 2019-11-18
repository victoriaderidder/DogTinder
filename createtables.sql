CREATE TABLE `Dog_Profile` (
  `Phone_Number` int(11) NOT NULL,
  `Name` varchar(20) NOT NULL,
  `Gender` varchar(2) NOT NULL, 
  `Fixed` bit(1) NOT NULL, 
  `Description` varchar(500) DEFAULT NULL,
  `Dog_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
INSERT INTO `Dog_Profile` (`Phone_Number`, `Name`, `Gender`, `Fixed`, `Description`, `Dog_ID`) VALUES
(5036666666, 'Santa', 'M', 1, 'A Maltese Male anger issues with a jolly disposition. Blake in Color with hair tufts that make it appear as it has horns.' , 56456563811),
(7577577577, 'Impulse', 'M', 1, 'He love to jump and bark', 10177554545),
(70380480505, 'Hero', 'M', 1, 'Really bad dog', 10177422958),
(5034564567, 'Angel', 'F', 1, 'A wonderful dog that acts like a grandmother to baby dogs.', 53424613513),
(3842901767, 'Kaylee', 'F', 1, 'Just the worst', 88876129012),
(9998887777, 'Sunny', 'F', 1, 'She will eat your socks', 12345678920),
(3456781234, 'Jeremiah', 'M', 0, 'He was a bullfrog', 98734510392),
(1982934012, 'Pluto', 'M', 0, 'Mickeys best friend', 30303030303),
(5034564560, 'Lily', 'F', 0, 'A cute hyper dog that loves to bark as much as she loves cheese', 53424613514),
(5034564567, 'Elijah', 'M', 0, 'A Dog who looks and acts like a stuff animal.', 53424613515);
 
CREATE TABLE `User` (
  `Name` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL, 
  `Password` varchar(20) NOT NULL 
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

 
CREATE TABLE `Location` (
  `Name` varchar(50) NOT NULL,
  `Zip` int(5) NOT NULL, 
  `City` varchar(20) NOT NULL,
  `State` varchar(2) NOT NULL,
  `Address` varchar(50) NOT NULL 
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
INSERT INTO `Location` (`Name`, `Zip`,  `City`, `State`, `Address`) VALUES
('Pilgrim Bark Park', '227 US-6','Provincetown', 'MA', '227 US-6'),
('Central Park', '54545', 'New York', 'NY', '1800 Central Park Dr'),
('Harbour View', '23435', 'Suffolk', 'VA', '5111 N Kemper Lakes Ct'),
('Maymont', '23112', 'Richmond', 'VA', '15520 Fox Gate Ct'),
('Public Garden', '02134', 'Boston', 'MA', '751 Tremont St'),
('Boston Common', '02134', 'Boston', 'MA', '791 Boylston St'),
('Creekside and Spring Creek Dog Park', '97333', 'Corvallis', 'OR', '1613 SW 49th St'),
('Albany Dog Park at Timber Linn Park', '97332', 'Albany', 'OR', 'Price Rd SE'),
('Woodland Meadow Park', '97333', 'Corvallis', 'OR', '3540 NW Circle Blvd'),
('Corvallis Fenced Dog Park', '97333', 'Corvallis', 'OR', '205 SW B Ave');
 
 
CREATE TABLE `Hates` (
  `Dog ID_1` int(11) NOT NULL, 
  `HatesDog ID_2` int(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
INSERT INTO `Hates` (`Dog ID_1`, `HatesDog ID_2`) VALUES
(10177554545, 88876129012),
(88876129012, 10177554545),
(98734510392, 10177554545),
(10177554545, 98734510392),
(98734510392, 88876129012),
(53424613515, 7577577577),
(30303030303, 10177554545),
(10177554545, 30303030303),
(98734510392, 10177554545),
(12345678920, 53424613513);


CREATE TABLE `Loves` (
  `Dog ID_1` int(11) NOT NULL, 
  `LovesDog ID_2` int(11) NOT NULL
)ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
INSERT INTO `Loves` (`Dog ID_1`, `LovesDog ID_2`) VALUES
(10177554545, 88876129012),
(88876129012, 10177554545),
(98734510392, 10177554545),
(10177554545, 98734510392),
(98734510392, 88876129012),
(53424613515, 7577577577),
(30303030303, 10177554545),
(10177554545, 30303030303),
(98734510392, 10177554545),
(12345678920, 53424613513);
