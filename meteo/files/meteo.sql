-- phpMyAdmin SQL Dump
-- version 4.7.7
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 22, 2018 at 12:28 AM
-- Server version: 5.6.37
-- PHP Version: 7.1.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `qzc948`
--

-- --------------------------------------------------------

--
-- Table structure for table `barometre`
--

CREATE TABLE `barometre` (
  `id` int(11) NOT NULL,
  `modelSensor` text,
  `mesura` int(11) DEFAULT NULL,
  `presio` double DEFAULT NULL,
  `altitud` double DEFAULT NULL,
  `nivellmar` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `humitat`
--

CREATE TABLE `humitat` (
  `id` int(11) NOT NULL,
  `modelSensor` text,
  `mesura` int(11) DEFAULT NULL,
  `humitat` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `llum`
--

CREATE TABLE `llum` (
  `int` int(11) NOT NULL,
  `spectre` double NOT NULL DEFAULT '0',
  `infrared` double NOT NULL DEFAULT '0',
  `visible` double NOT NULL DEFAULT '0',
  `mesura` int(11) NOT NULL DEFAULT '0',
  `modelSensor` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `mesura`
--

CREATE TABLE `mesura` (
  `id` int(11) NOT NULL,
  `lloc` text,
  `data` datetime DEFAULT NULL,
  `sensor` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `sensor`
--

CREATE TABLE `sensor` (
  `id` int(11) NOT NULL,
  `descripcio` text,
  `lat` varchar(40) NOT NULL,
  `lon` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `temperatura`
--

CREATE TABLE `temperatura` (
  `int` int(11) NOT NULL,
  `modelSensor` text,
  `mesura` int(11) DEFAULT NULL,
  `temperatura` double DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `barometre`
--
ALTER TABLE `barometre`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_barometre_mesura` (`mesura`);

--
-- Indexes for table `humitat`
--
ALTER TABLE `humitat`
  ADD PRIMARY KEY (`id`),
  ADD KEY `FK_humitat_mesura` (`mesura`);

--
-- Indexes for table `llum`
--
ALTER TABLE `llum`
  ADD PRIMARY KEY (`int`),
  ADD KEY `FK_llum_mesura` (`mesura`);

--
-- Indexes for table `mesura`
--
ALTER TABLE `mesura`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sensor` (`sensor`);

--
-- Indexes for table `sensor`
--
ALTER TABLE `sensor`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `temperatura`
--
ALTER TABLE `temperatura`
  ADD PRIMARY KEY (`int`),
  ADD KEY `FK_temperatura_mesura` (`mesura`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `barometre`
--
ALTER TABLE `barometre`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1668;

--
-- AUTO_INCREMENT for table `humitat`
--
ALTER TABLE `humitat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1673;

--
-- AUTO_INCREMENT for table `llum`
--
ALTER TABLE `llum`
  MODIFY `int` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1670;

--
-- AUTO_INCREMENT for table `mesura`
--
ALTER TABLE `mesura`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1684;

--
-- AUTO_INCREMENT for table `sensor`
--
ALTER TABLE `sensor`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `temperatura`
--
ALTER TABLE `temperatura`
  MODIFY `int` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=1663;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `barometre`
--
ALTER TABLE `barometre`
  ADD CONSTRAINT `FK_barometre_mesura` FOREIGN KEY (`mesura`) REFERENCES `mesura` (`id`);

--
-- Constraints for table `humitat`
--
ALTER TABLE `humitat`
  ADD CONSTRAINT `FK_humitat_mesura` FOREIGN KEY (`mesura`) REFERENCES `mesura` (`id`);

--
-- Constraints for table `llum`
--
ALTER TABLE `llum`
  ADD CONSTRAINT `FK_llum_mesura` FOREIGN KEY (`mesura`) REFERENCES `mesura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `mesura`
--
ALTER TABLE `mesura`
  ADD CONSTRAINT `FK_mesura_sensor` FOREIGN KEY (`sensor`) REFERENCES `sensor` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `temperatura`
--
ALTER TABLE `temperatura`
  ADD CONSTRAINT `FK_temperatura_mesura` FOREIGN KEY (`mesura`) REFERENCES `mesura` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
