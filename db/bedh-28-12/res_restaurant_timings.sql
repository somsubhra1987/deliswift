-- phpMyAdmin SQL Dump
-- version 4.7.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 27, 2018 at 07:48 PM
-- Server version: 10.1.30-MariaDB
-- PHP Version: 5.6.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `deliswift`
--

-- --------------------------------------------------------

--
-- Table structure for table `res_restaurant_timings`
--

CREATE TABLE `res_restaurant_timings` (
  `restaurantTimingID` bigint(20) NOT NULL,
  `restaurantID` bigint(20) NOT NULL,
  `dayID` int(11) NOT NULL,
  `openingTime` time DEFAULT NULL,
  `closingTime` time DEFAULT NULL,
  `isActive` tinyint(1) NOT NULL DEFAULT '1',
  `createdDatetime` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `createdByUserID` int(11) NOT NULL,
  `modifiedDatetime` datetime DEFAULT NULL,
  `modifiedByUserID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `res_restaurant_timings`
--

INSERT INTO `res_restaurant_timings` (`restaurantTimingID`, `restaurantID`, `dayID`, `openingTime`, `closingTime`, `isActive`, `createdDatetime`, `createdByUserID`, `modifiedDatetime`, `modifiedByUserID`) VALUES
(1, 1, 1, '07:15:00', '21:15:00', 1, '2018-12-27 23:42:54', 1, NULL, NULL),
(2, 1, 2, '07:15:00', '21:15:00', 1, '2018-12-27 23:42:54', 1, NULL, NULL),
(3, 1, 5, '09:15:00', '20:15:00', 1, '2018-12-27 23:42:54', 1, NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `res_restaurant_timings`
--
ALTER TABLE `res_restaurant_timings`
  ADD PRIMARY KEY (`restaurantTimingID`),
  ADD UNIQUE KEY `restaurantID` (`restaurantID`,`dayID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `res_restaurant_timings`
--
ALTER TABLE `res_restaurant_timings`
  MODIFY `restaurantTimingID` bigint(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
