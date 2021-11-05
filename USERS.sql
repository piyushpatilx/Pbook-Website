-- phpMyAdmin SQL Dump
-- version 5.0.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 13, 2020 at 04:30 PM
-- Server version: 5.6.38
-- PHP Version: 7.4.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `USERS`
--

-- --------------------------------------------------------

--
-- Table structure for table `Chats`
--

CREATE TABLE `Chats` (
  `time` varchar(20) NOT NULL,
  `sender` varchar(13) NOT NULL,
  `receiver` varchar(13) NOT NULL,
  `chat` varchar(400) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Posts`
--

CREATE TABLE `Posts` (
  `Date` varchar(20) NOT NULL,
  `From` varchar(12) NOT NULL,
  `Post` varchar(500) NOT NULL,
  `Photo` varchar(40) DEFAULT NULL,
  `id` int(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `Profile`
--

CREATE TABLE `Profile` (
  `Username` varchar(15) NOT NULL,
  `Birthdate` date DEFAULT NULL,
  `Gender` varchar(10) DEFAULT NULL,
  `Relationship` varchar(10) DEFAULT NULL,
  `Interest` varchar(100) DEFAULT NULL,
  `Photo` varchar(40) DEFAULT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Profile`
--



-- --------------------------------------------------------

--
-- Table structure for table `Userdata`
--

CREATE TABLE `Userdata` (
  `Username` varchar(30) NOT NULL,
  `Email` varchar(30) NOT NULL,
  `Password` varchar(30) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `Userdata`
--



--
-- Indexes for dumped tables
--

--
-- Indexes for table `Posts`
--
ALTER TABLE `Posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `Profile`
--
ALTER TABLE `Profile`
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `Userdata`
--
ALTER TABLE `Userdata`
  ADD UNIQUE KEY `Username` (`Username`,`Email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `Posts`
--
ALTER TABLE `Posts`
  MODIFY `id` int(30) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
