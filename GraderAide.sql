-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Sep 21, 2013 at 11:22 PM
-- Server version: 5.1.66
-- PHP Version: 5.3.3

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `gpas`
--

-- --------------------------------------------------------

--
-- Table structure for table `Classroom`
--

CREATE TABLE IF NOT EXISTS `Classroom` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `TeacherIdentifier` int(11) NOT NULL,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Identifier`),
  UNIQUE KEY `Identifier_UNIQUE` (`Identifier`),
  KEY `TeacherIdentifier_idx` (`TeacherIdentifier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Score`
--

CREATE TABLE IF NOT EXISTS `Score` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `ClassroomIdentifier` int(11) DEFAULT NULL,
  `StudentIdentifier` int(11) DEFAULT NULL,
  `Subject` varchar(45) DEFAULT NULL,
  `ExpectedScore` float DEFAULT NULL,
  `CompletedScore` float DEFAULT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `LetterGrade` varchar(45) DEFAULT NULL,
  `Week` datetime DEFAULT NULL,
  PRIMARY KEY (`Identifier`),
  UNIQUE KEY `Identifier_UNIQUE` (`Identifier`),
  KEY `ClassroomIdentifier_idx` (`ClassroomIdentifier`),
  KEY `StudentIdentifier_idx` (`StudentIdentifier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--

CREATE TABLE IF NOT EXISTS `Student` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `GradeLevel` int(11) DEFAULT NULL,
  `DateOfBirth` datetime DEFAULT NULL,
  `Male` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Identifier`),
  UNIQUE KEY `Identifier_UNIQUE` (`Identifier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `Teacher`
--

CREATE TABLE IF NOT EXISTS `Teacher` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Identifier`),
  UNIQUE KEY `Identifier_UNIQUE` (`Identifier`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
