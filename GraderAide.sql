-- phpMyAdmin SQL Dump
-- version 4.0.6
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 08, 2013 at 10:24 AM
-- Server version: 5.5.33
-- PHP Version: 5.5.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `GraderAide`
--

-- --------------------------------------------------------

--
-- Table structure for table `Assignment`
--
DROP TABLE IF EXISTS `Assignment`;
CREATE TABLE `Assignment` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `IntervalIdentifier` int(11) NOT NULL,
  `SubjectIdentifier` int(11) NOT NULL,
  `ExpectedScore` float DEFAULT NULL,
  `CompletedScore` float DEFAULT NULL,
  `Description` varchar(45) DEFAULT NULL,
  `LetterGrade` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`IntervalIdentifier`,`SubjectIdentifier`),
  UNIQUE KEY `Identifier_UNIQUE` (`Identifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `Classroom`
--
DROP TABLE IF EXISTS `Classroom`;

CREATE TABLE `Classroom` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `TeacherIdentifier` int(11) NOT NULL,
  `StartDate` date DEFAULT NULL,
  `EndDate` date DEFAULT NULL,
  PRIMARY KEY (`Identifier`),
  UNIQUE KEY `Identifier_UNIQUE` (`Identifier`),
  KEY `TeacherIdentifier_idx` (`TeacherIdentifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=19 ;

-- --------------------------------------------------------

--
-- Table structure for table `ClassroomSubject`
--
DROP TABLE IF EXISTS `ClassroomSubject`;

CREATE TABLE `ClassroomSubject` (
  `ClassroomIdentifier` int(11) NOT NULL,
  `SubjectIdentifier` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `Interval`
--
DROP TABLE IF EXISTS `Interval`;

CREATE TABLE `Interval` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `ClassroomIdentifier` int(11) NOT NULL,
  `StudentIdentifier` int(11) NOT NULL,
  `Date` date NOT NULL,
  PRIMARY KEY (`Identifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `Student`
--
DROP TABLE IF EXISTS `Student`;

CREATE TABLE `Student` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `GradeLevel` int(11) DEFAULT NULL,
  `DateOfBirth` datetime DEFAULT NULL,
  `Male` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Identifier`),
  UNIQUE KEY `Identifier_UNIQUE` (`Identifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=32 ;

-- --------------------------------------------------------

--
-- Table structure for table `Subject`
--
DROP TABLE IF EXISTS `Subject`;

CREATE TABLE `Subject` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `DisplayName` varchar(20) NOT NULL,
  PRIMARY KEY (`Identifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

-- --------------------------------------------------------

--
-- Table structure for table `Teacher`
--
DROP TABLE IF EXISTS `Teacher`;

CREATE TABLE `Teacher` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Identifier`),
  UNIQUE KEY `Identifier_UNIQUE` (`Identifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
