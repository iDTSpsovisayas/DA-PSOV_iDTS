-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: Oct 27, 2021 at 04:41 AM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `prdpdts`
--

-- --------------------------------------------------------

--
-- Table structure for table `document logs`
--

CREATE TABLE `document logs` (
  `DID Number` varchar(500) NOT NULL,
  `Document Type` varchar(50) NOT NULL,
  `Component/Unit` varchar(20) NOT NULL,
  `Creation Date & Time` varchar(50) NOT NULL,
  `Completion Date & Time` varchar(50) NOT NULL,
  `No. of Days Processed` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `query logs`
--

CREATE TABLE `query logs` (
  `Component/Unit` varchar(20) NOT NULL,
  `Received Date` varchar(20) NOT NULL,
  `Received Time` varchar(20) NOT NULL,
  `Released Date` varchar(20) NOT NULL,
  `Released Time` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user database`
--

CREATE TABLE `user database` (
  `User ID` varchar(10) NOT NULL,
  `Component/Unit` varchar(20) NOT NULL,
  `Username` varchar(20) NOT NULL,
  `Password` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user logs`
--

CREATE TABLE `user logs` (
  `User ID` varchar(20) NOT NULL,
  `Component/Unit` varchar(20) NOT NULL,
  `Login Date & Time` varchar(50) NOT NULL,
  `Duration (hrs)` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
