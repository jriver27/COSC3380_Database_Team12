-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Mar 02, 2015 at 08:16 PM
-- Server version: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `dbteam12`
--

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

CREATE TABLE IF NOT EXISTS `item` (
  `SKU` int(10) NOT NULL AUTO_INCREMENT,
  `Serial_number` int(11) NOT NULL,
  `Description` tinytext,
  `Manufacturer` int(11) DEFAULT NULL,
  `Stock_Count` int(4) DEFAULT NULL,
  PRIMARY KEY (`SKU`,`Serial_number`),
  KEY `Item_fk1` (`Manufacturer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `item_manufacturer`
--

CREATE TABLE IF NOT EXISTS `item_manufacturer` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Manufacturer` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `purchase_order_log`
--

CREATE TABLE IF NOT EXISTS `purchase_order_log` (
  `PONumber` int(9) NOT NULL AUTO_INCREMENT,
  `SKU` int(10) NOT NULL,
  `DATETIME` int(11) NOT NULL,
  `Count` int(11) NOT NULL,
  `Purchaser` varchar(20) NOT NULL,
  PRIMARY KEY (`PONumber`),
  KEY `Purchase_Order_Log_fk1` (`SKU`),
  KEY `Purchase_Order_Log_fk2` (`Purchaser`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `room_type`
--

CREATE TABLE IF NOT EXISTS `room_type` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Room type` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `Room_Number` int(3) NOT NULL AUTO_INCREMENT,
  `Type` int(4) DEFAULT NULL,
  PRIMARY KEY (`Room_Number`),
  KEY `Rooms_fk1` (`Type`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `transaction_log`
--

CREATE TABLE IF NOT EXISTS `transaction_log` (
  `Transaction ID` int(9) NOT NULL AUTO_INCREMENT,
  `SKU` int(10) NOT NULL,
  `User_ID` varchar(20) NOT NULL,
  `Count` int(11) NOT NULL,
  `Room Number` int(11) NOT NULL,
  `DATETIME` datetime NOT NULL,
  PRIMARY KEY (`Transaction ID`),
  KEY `Transaction_Log_fk1` (`SKU`),
  KEY `Transaction_Log_fk2` (`User_ID`),
  KEY `Transaction_Log_fk3` (`Room Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `user_position`
--

CREATE TABLE IF NOT EXISTS `user_position` (
  `ID` int(11) NOT NULL AUTO_INCREMENT,
  `Position` text,
  PRIMARY KEY (`ID`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `Username` varchar(20) NOT NULL,
  `Password` varchar(64) NOT NULL,
  `First Name` text NOT NULL,
  `Last Name` text NOT NULL,
  `Position` int(2) NOT NULL,
  PRIMARY KEY (`Username`),
  KEY `Users_fk1` (`Position`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `Item_fk1` FOREIGN KEY (`Manufacturer`) REFERENCES `item_manufacturer` (`ID`);

--
-- Constraints for table `purchase_order_log`
--
ALTER TABLE `purchase_order_log`
  ADD CONSTRAINT `Purchase_Order_Log_fk2` FOREIGN KEY (`Purchaser`) REFERENCES `users` (`Username`),
  ADD CONSTRAINT `Purchase_Order_Log_fk1` FOREIGN KEY (`SKU`) REFERENCES `item` (`SKU`);

--
-- Constraints for table `rooms`
--
ALTER TABLE `rooms`
  ADD CONSTRAINT `Rooms_fk1` FOREIGN KEY (`Type`) REFERENCES `room_type` (`ID`);

--
-- Constraints for table `transaction_log`
--
ALTER TABLE `transaction_log`
  ADD CONSTRAINT `Transaction_Log_fk3` FOREIGN KEY (`Room Number`) REFERENCES `rooms` (`Room_Number`),
  ADD CONSTRAINT `Transaction_Log_fk1` FOREIGN KEY (`SKU`) REFERENCES `item` (`SKU`),
  ADD CONSTRAINT `Transaction_Log_fk2` FOREIGN KEY (`User_ID`) REFERENCES `users` (`Username`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `Users_fk1` FOREIGN KEY (`Position`) REFERENCES `user_position` (`ID`);
--
-- Database: `test`
--
--
-- Database: `yes`
--

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE IF NOT EXISTS `rooms` (
  `Room_Number` int(3) NOT NULL AUTO_INCREMENT,
  `Type` int(4) DEFAULT NULL,
  PRIMARY KEY (`Room_Number`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
