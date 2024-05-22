-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2024 at 09:43 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project`
--

-- --------------------------------------------------------

--
-- Table structure for table `branch`
--

CREATE TABLE `branch` (
  `id` int(11) NOT NULL,
  `building` varchar(45) NOT NULL,
  `city` varchar(45) NOT NULL,
  `state` varchar(45) NOT NULL,
  `zip` int(11) NOT NULL,
  `country` varchar(45) NOT NULL,
  `contact` bigint(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `branch`
--

INSERT INTO `branch` (`id`, `building`, `city`, `state`, `zip`, `country`, `contact`) VALUES
(1, 'Balaji Nagar,Pune', 'Pune', 'Maharashtra', 323232, 'India', 1111111111),
(2, 'Balaji Nagar,Pune', 'Mumbai', 'Maharashtra', 323232, 'India', 1111111121);

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `id` int(11) NOT NULL,
  `email` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `name` varchar(45) NOT NULL,
  `user` varchar(45) NOT NULL,
  `address` varchar(45) NOT NULL,
  `address1` varchar(45) DEFAULT NULL,
  `contact` bigint(11) NOT NULL,
  `otp` int(11) DEFAULT NULL,
  `isAdmin` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`id`, `email`, `password`, `name`, `user`, `address`, `address1`, `contact`, `otp`, `isAdmin`) VALUES
(2, 'admin@gmail.com', 'Shreyas@123', 'Admin Name', 'Admin@123', 'Address', NULL, 1234567890, NULL, 1),
(3, 'shreyasdhale100@gmail.com', 'EgVcmAJovKzmkg==', 'Mane Ajay', 'Nikita@123', 'sdsad', '', 9403461153, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `parcelform`
--

CREATE TABLE `parcelform` (
  `id` int(11) NOT NULL,
  `sname` varchar(45) NOT NULL,
  `saddr` varchar(70) NOT NULL,
  `scont` bigint(11) NOT NULL,
  `rname` varchar(45) NOT NULL,
  `raddr` varchar(70) NOT NULL,
  `rcont` bigint(11) NOT NULL,
  `frombr` varchar(45) NOT NULL,
  `tobr` varchar(45) NOT NULL,
  `bill` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `parcel_info`
--

CREATE TABLE `parcel_info` (
  `id` int(11) NOT NULL,
  `sname` varchar(45) NOT NULL,
  `scont` varchar(70) NOT NULL,
  `rcont` bigint(11) NOT NULL,
  `rname` varchar(45) NOT NULL,
  `trackid` int(11) NOT NULL,
  `height` float NOT NULL,
  `width` float NOT NULL,
  `length` float NOT NULL,
  `weight` float NOT NULL,
  `price` float NOT NULL,
  `flag` int(11) DEFAULT 0,
  `cust_id` int(11) DEFAULT NULL,
  `bdate` date NOT NULL,
  `ddate` date DEFAULT NULL,
  `btime` time NOT NULL,
  `dtime` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `staff`
--

CREATE TABLE `staff` (
  `id` int(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `user` varchar(50) NOT NULL,
  `branch_id` varchar(50) NOT NULL,
  `Salary` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `staff`
--

INSERT INTO `staff` (`id`, `email`, `name`, `password`, `user`, `branch_id`, `Salary`) VALUES
(1, 'shreyasdhale100@gmail.com', 'Shreyas Dhale ', '7249502642', 'pd@123', 'Mumbai', 2222);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch`
--
ALTER TABLE `branch`
  ADD PRIMARY KEY (`id`,`contact`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`id`,`user`);

--
-- Indexes for table `parcelform`
--
ALTER TABLE `parcelform`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `parcel_info`
--
ALTER TABLE `parcel_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `staff`
--
ALTER TABLE `staff`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch`
--
ALTER TABLE `branch`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `parcelform`
--
ALTER TABLE `parcelform`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `parcel_info`
--
ALTER TABLE `parcel_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `staff`
--
ALTER TABLE `staff`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
