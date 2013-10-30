-- phpMyAdmin SQL Dump
-- version 3.5.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 30, 2013 at 07:01 AM
-- Server version: 5.5.29
-- PHP Version: 5.4.10

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";

--
-- Database: `GraderAide`
--

-- --------------------------------------------------------

--
-- Table structure for table `Classroom`
--

CREATE TABLE `Classroom` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `Name` varchar(50) NOT NULL,
  `TeacherIdentifier` int(11) NOT NULL,
  `StartDate` datetime DEFAULT NULL,
  `EndDate` datetime DEFAULT NULL,
  PRIMARY KEY (`Identifier`),
  UNIQUE KEY `Identifier_UNIQUE` (`Identifier`),
  KEY `TeacherIdentifier_idx` (`TeacherIdentifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `Classroom`
--

INSERT INTO `Classroom` (`Identifier`, `Name`, `TeacherIdentifier`, `StartDate`, `EndDate`) VALUES
(1, 'Best Class Ever', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(2, 'Best Class Ever', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(3, 'Best Class Ever', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(4, 'Best Class Ever', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(5, 'Best Class Ever', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(6, 'Best Class Ever', 1, '0000-00-00 00:00:00', '0000-00-00 00:00:00'),
(7, 'New class', 1, '2001-01-12 00:00:00', '2001-01-13 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `Score`
--

CREATE TABLE `Score` (
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

CREATE TABLE `Student` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  `GradeLevel` int(11) DEFAULT NULL,
  `DateOfBirth` datetime DEFAULT NULL,
  `Male` bit(1) DEFAULT NULL,
  PRIMARY KEY (`Identifier`),
  UNIQUE KEY `Identifier_UNIQUE` (`Identifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=31 ;

--
-- Dumping data for table `Student`
--

INSERT INTO `Student` (`Identifier`, `FirstName`, `LastName`, `GradeLevel`, `DateOfBirth`, `Male`) VALUES
(13, 'Shawn', 'Jones', 8, '1989-01-06 00:00:00', '');

-- --------------------------------------------------------

--
-- Table structure for table `Teacher`
--

CREATE TABLE `Teacher` (
  `Identifier` int(11) NOT NULL AUTO_INCREMENT,
  `FirstName` varchar(45) DEFAULT NULL,
  `LastName` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Identifier`),
  UNIQUE KEY `Identifier_UNIQUE` (`Identifier`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Dumping data for table `Teacher`
--

INSERT INTO `Teacher` (`Identifier`, `FirstName`, `LastName`) VALUES
(1, 'Shawn', 'Jones'),
(2, 'Brandyn', 'Thornton');
