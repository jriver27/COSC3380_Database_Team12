--
-- MySQL 5.6.17
-- Sat, 18 Apr 2015 22:27:13 +0000
--

CREATE DATABASE `dbteam12` DEFAULT CHARSET latin1;

USE `dbteam12`;

CREATE TABLE `allergy_lookup` (
   `SKU` int(10) not null,
   `LATEX` tinyint(1),
   `PEANUTS` tinyint(1),
   `ASPIRIN` tinyint(1),
   `PENECILLIN` tinyint(1),
   `INSULIN` tinyint(1),
   PRIMARY KEY (`SKU`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- [Table `allergy_lookup` is empty]

CREATE TABLE `item` (
   `SKU` int(10) not null auto_increment,
   `Serial_number` int(11) not null,
   `Description` tinytext,
   `Manufacturer` int(11),
   `Stock_Count` int(4),
   PRIMARY KEY (`SKU`,`Serial_number`),
   KEY `Item_fk1` (`Manufacturer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1000000000;

INSERT INTO `item` (`SKU`, `Serial_number`, `Description`, `Manufacturer`, `Stock_Count`) VALUES ('1', '990435', 'Insulin Syringes, U-100', '1', '1000');
INSERT INTO `item` (`SKU`, `Serial_number`, `Description`, `Manufacturer`, `Stock_Count`) VALUES ('2', '9001', 'Patient Bed', '3', '');
INSERT INTO `item` (`SKU`, `Serial_number`, `Description`, `Manufacturer`, `Stock_Count`) VALUES ('2', '9002', 'Patient Bed', '3', '');
INSERT INTO `item` (`SKU`, `Serial_number`, `Description`, `Manufacturer`, `Stock_Count`) VALUES ('3', '8001', 'Patient Table', '3', '');
INSERT INTO `item` (`SKU`, `Serial_number`, `Description`, `Manufacturer`, `Stock_Count`) VALUES ('3', '8002', 'Patient Table', '3', '');
INSERT INTO `item` (`SKU`, `Serial_number`, `Description`, `Manufacturer`, `Stock_Count`) VALUES ('4', '645', 'Surgical Gloves, Non-Latex', '2', '1000');
INSERT INTO `item` (`SKU`, `Serial_number`, `Description`, `Manufacturer`, `Stock_Count`) VALUES ('5', '75928437', 'PCA Nebulizer', '2', '');
INSERT INTO `item` (`SKU`, `Serial_number`, `Description`, `Manufacturer`, `Stock_Count`) VALUES ('5', '75928438', 'PCA Nebulizer', '2', '');
INSERT INTO `item` (`SKU`, `Serial_number`, `Description`, `Manufacturer`, `Stock_Count`) VALUES ('6', '2943587', 'CareFusion Alaris PC', '3', '');
INSERT INTO `item` (`SKU`, `Serial_number`, `Description`, `Manufacturer`, `Stock_Count`) VALUES ('7', '832865', 'Alaris Pump', '', '');
INSERT INTO `item` (`SKU`, `Serial_number`, `Description`, `Manufacturer`, `Stock_Count`) VALUES ('999999999', '1', 'Insulin Syringes', '1', '500');

CREATE TABLE `item_manufacturer` (
   `ID` int(11) not null auto_increment,
   `Manufacturer` text,
   PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=4;

INSERT INTO `item_manufacturer` (`ID`, `Manufacturer`) VALUES ('1', 'MedCo');
INSERT INTO `item_manufacturer` (`ID`, `Manufacturer`) VALUES ('2', 'MedSys');
INSERT INTO `item_manufacturer` (`ID`, `Manufacturer`) VALUES ('3', 'LifeAssist');

CREATE TABLE `purchase_order_log` (
   `PONumber` int(9) not null auto_increment,
   `SKU` int(10) not null,
   `DATETIME` int(11) not null,
   `Count` int(11) not null,
   `Purchaser` varchar(20) not null,
   'Open_PO' boolean(1) NOT NULL,
   PRIMARY KEY (`PONumber`),
   KEY `Purchase_Order_Log_fk1` (`SKU`),
   KEY `Purchase_Order_Log_fk2` (`Purchaser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=2;

INSERT INTO `purchase_order_log` (`PONumber`, `SKU`, `DATETIME`, `Count`, `Purchaser`) VALUES ('1', '6', '1429395755', '2', 'Admin');

CREATE TABLE `room_type` (
   `ID` int(11) not null auto_increment,
   `Room type` text,
   PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- [Table `room_type` is empty]

CREATE TABLE `rooms` (
   `Room_Number` int(3) not null auto_increment,
   `Type` int(4),
   PRIMARY KEY (`Room_Number`),
   KEY `Rooms_fk1` (`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- [Table `rooms` is empty]

CREATE TABLE `transaction_log` (
   `Transaction ID` int(9) not null auto_increment,
   `SKU` int(10) not null,
   `User_ID` varchar(20) not null,
   `Count` int(11) not null,
   `Room Number` int(11) not null,
   `DATETIME` datetime not null,
   PRIMARY KEY (`Transaction ID`),
   KEY `Transaction_Log_fk1` (`SKU`),
   KEY `Transaction_Log_fk2` (`User_ID`),
   KEY `Transaction_Log_fk3` (`Room Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1;

-- [Table `transaction_log` is empty]

CREATE TABLE `user_position` (
   `ID` int(11) not null auto_increment,
   `Position` text,
   PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=6;

INSERT INTO `user_position` (`ID`, `Position`) VALUES ('1', 'Nurse');
INSERT INTO `user_position` (`ID`, `Position`) VALUES ('2', 'Doctor');
INSERT INTO `user_position` (`ID`, `Position`) VALUES ('3', 'Medical_Admin');
INSERT INTO `user_position` (`ID`, `Position`) VALUES ('4', 'Admin');
INSERT INTO `user_position` (`ID`, `Position`) VALUES ('5', 'SuperAdmin');

CREATE TABLE `users` (
   `Username` varchar(20) not null,
   `Password` varchar(64) not null,
   `FirstName` text not null,
   `LastName` text not null,
   `Position` int(2) not null,
   `HasAccess` tinyint(1) not null default '1',
   PRIMARY KEY (`Username`),
   KEY `Users_fk1` (`Position`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

INSERT INTO `users` (`Username`, `Password`, `FirstName`, `LastName`, `Position`, `HasAccess`) VALUES ('Admin', '123', 'admin', 'admin', '4', '1');
INSERT INTO `users` (`Username`, `Password`, `FirstName`, `LastName`, `Position`, `HasAccess`) VALUES ('bbanner', 'hulk', 'Bruce', 'Banner', '5', '1');
INSERT INTO `users` (`Username`, `Password`, `FirstName`, `LastName`, `Position`, `HasAccess`) VALUES ('Doctor', '123', 'F_name', 'L_Name', '1', '1');
INSERT INTO `users` (`Username`, `Password`, `FirstName`, `LastName`, `Position`, `HasAccess`) VALUES ('Medical_admin', '123', 'medical_admin', 'medical_admin', '3', '1');
INSERT INTO `users` (`Username`, `Password`, `FirstName`, `LastName`, `Position`, `HasAccess`) VALUES ('Nurse', '123', 'D_nurse', '_nurse', '1', '1');