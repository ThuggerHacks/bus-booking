-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 25, 2023 at 08:46 PM
-- Server version: 10.4.25-MariaDB
-- PHP Version: 8.1.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `bus_ticket`
--

-- --------------------------------------------------------

--
-- Table structure for table `buses`

CREATE DATABASE IF NOT EXISTS bus_ticket;
USE bus_ticket;
--

CREATE TABLE `buses` (
  `id` int(5) NOT NULL,
  `bname` varchar(25) NOT NULL,
  `bus_no` varchar(25) NOT NULL,
  `owner_id` int(5) NOT NULL,
  `from_loc` varchar(20) NOT NULL,
  `from_time` varchar(8) NOT NULL,
  `to_loc` varchar(20) NOT NULL,
  `to_time` varchar(8) NOT NULL,
  `fare` int(5) NOT NULL,
  `approved` tinyint(1) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `buses`
--

INSERT INTO `buses` (`id`, `bname`, `bus_no`, `owner_id`, `from_loc`, `from_time`, `to_loc`, `to_time`, `fare`, `approved`) VALUES
(7, 'Transporte 1', '1', 11, 'Nampula', '10:30', 'Beira', '21:30', 2900, 1),
(8, 'Transporte 2', '2', 11, 'Maputo', '04:30', 'Beira', '12:30', 1500, 1);

-- --------------------------------------------------------

--
-- Table structure for table `earnings`
--

CREATE TABLE `earnings` (
  `id` int(5) NOT NULL,
  `bus_id` int(5) NOT NULL,
  `date` varchar(10) NOT NULL,
  `ssold` int(3) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `locations`
--

CREATE TABLE `locations` (
  `id` int(5) NOT NULL,
  `name` varchar(25) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `locations`
--

INSERT INTO `locations` (`id`, `name`) VALUES
(5, 'Beira'),
(6, 'Nampula'),
(7, 'Maputo'),
(8, 'Pemba'),
(9, 'Quelimane'),
(10, 'Chimoio'),
(11, 'Lichinga'),
(12, 'Cuamba'),
(13, 'Dondo'),
(14, 'Nacala'),
(15, 'Matola'),
(16, 'Xai-Xai'),
(17, 'Inhambane'),
(18, 'Tete');

-- --------------------------------------------------------

--
-- Table structure for table `notices`
--

CREATE TABLE `notices` (
  `id` int(5) NOT NULL,
  `recep` int(5) NOT NULL,
  `message` varchar(120) NOT NULL,
  `from` int(5) NOT NULL,
  `title` varchar(30) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(5) NOT NULL,
  `passenger_id` int(5) NOT NULL,
  `bus_id` int(5) NOT NULL,
  `jdate` varchar(25) NOT NULL,
  `seats` varchar(120) NOT NULL,
  `fare` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `passenger_id`, `bus_id`, `jdate`, `seats`, `fare`) VALUES
(30, 12, 7, '26/10/2023', 'a:1:{i:0;s:2:\"D3\";}', 2950);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(5) NOT NULL,
  `uname` varchar(20) NOT NULL,
  `name` varchar(25) NOT NULL,
  `email` varchar(40) NOT NULL,
  `password` varchar(25) NOT NULL,
  `gender` enum('Male','Female','Other') NOT NULL,
  `utype` enum('Admin','Owner','Passenger') NOT NULL,
  `address` varchar(120) NOT NULL,
  `mobile` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uname`, `name`, `email`, `password`, `gender`, `utype`, `address`, `mobile`) VALUES
(10, 'admin', 'Admin', 'admin@gmail.com', '123456', 'Female', 'Admin', 'Beira,Matacuane', '848499111'),
(11, 'proprietario', 'Teste', 'proprietario@gmail.com', '123456', 'Male', 'Owner', 'Beira,Macuti', '878799140'),
(12, 'passageiro', 'teste', 'passageiro@gmail.com', '123456', 'Female', 'Passenger', 'Nampula', '848499142');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `buses`
--
ALTER TABLE `buses`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usr_bus` (`owner_id`);

--
-- Indexes for table `earnings`
--
ALTER TABLE `earnings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ear_bus` (`bus_id`);

--
-- Indexes for table `locations`
--
ALTER TABLE `locations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notices`
--
ALTER TABLE `notices`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usrf_not` (`from`),
  ADD KEY `fk_usrt_not` (`recep`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_usr_tic` (`passenger_id`),
  ADD KEY `fk_bus_tic` (`bus_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`uname`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `buses`
--
ALTER TABLE `buses`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `earnings`
--
ALTER TABLE `earnings`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `locations`
--
ALTER TABLE `locations`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `notices`
--
ALTER TABLE `notices`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(5) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `buses`
--
ALTER TABLE `buses`
  ADD CONSTRAINT `fk_usr_bus` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `earnings`
--
ALTER TABLE `earnings`
  ADD CONSTRAINT `fk_ear_bus` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`);

--
-- Constraints for table `notices`
--
ALTER TABLE `notices`
  ADD CONSTRAINT `fk_usrf_not` FOREIGN KEY (`from`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `fk_usrt_not` FOREIGN KEY (`recep`) REFERENCES `users` (`id`);

--
-- Constraints for table `tickets`
--
ALTER TABLE `tickets`
  ADD CONSTRAINT `fk_bus_tic` FOREIGN KEY (`bus_id`) REFERENCES `buses` (`id`),
  ADD CONSTRAINT `fk_usr_tic` FOREIGN KEY (`passenger_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
