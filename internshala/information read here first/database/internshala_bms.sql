-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 17, 2024 at 02:28 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 8.1.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `internshala_bms`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_internshala`
--

CREATE TABLE `admin_internshala` (
  `admin_id` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `creation_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin_internshala`
--

INSERT INTO `admin_internshala` (`admin_id`, `admin_username`, `hospital_name`, `email`, `password`, `creation_time`) VALUES
(3, 'ritwik1234', 'dalmia hospital', 'dalmiaritwik@gmail.com', '$2y$10$i3RbCRjnb9KxL3si65eQsOs7jWpd0k46mzoJkpgK2dolTjU23AV6m', '2024-03-16 20:38:51'),
(4, 'ritwik4321', 'ritwik hospital', 'ritwikesports@gmail.com', '$2y$10$i3RbCRjnb9KxL3si65eQsOs7jWpd0k46mzoJkpgK2dolTjU23AV6m', '2024-03-16 20:38:51');

-- --------------------------------------------------------

--
-- Table structure for table `application_request`
--

CREATE TABLE `application_request` (
  `application_request_id` int(11) NOT NULL,
  `blood_id` int(11) NOT NULL,
  `login_username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `application_time` date NOT NULL,
  `acceptance` varchar(255) NOT NULL DEFAULT 'pending',
  `permission` int(11) NOT NULL DEFAULT 2
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `application_request`
--

INSERT INTO `application_request` (`application_request_id`, `blood_id`, `login_username`, `full_name`, `blood_type`, `hospital_name`, `quantity`, `application_time`, `acceptance`, `permission`) VALUES
(51, 979579, 'ritwikdalmia', 'Ritwik Dalmia', 'A+', 'dalmia hospital', 1, '2024-03-17', 'Accepted', 0),
(52, 979512, 'ritwikdalmia', 'Ritwik Dalmia', 'B+', 'ritwik hospital', 1, '2024-03-17', 'pending', 1),
(53, 979573, 'ritwikdalmia', 'Ritwik Dalmia', 'AB+', 'dalmia hospital', 1, '2024-03-17', 'pending', 2);

-- --------------------------------------------------------

--
-- Table structure for table `blood_type`
--

CREATE TABLE `blood_type` (
  `id` int(11) NOT NULL,
  `blood_id` int(11) NOT NULL,
  `blood_type` varchar(255) NOT NULL,
  `hospital_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `admin_username` varchar(255) NOT NULL,
  `timestamp` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `blood_type`
--

INSERT INTO `blood_type` (`id`, `blood_id`, `blood_type`, `hospital_name`, `quantity`, `admin_username`, `timestamp`) VALUES
(3, 979579, 'A+', 'dalmia hospital', 3, 'ritwik1234', '2023-01-19 19:06:43'),
(5, 473041, 'O+', 'dalmia hospital', 1, 'ritwik1234', '2023-01-20 03:11:07'),
(7, 979571, 'B+', 'dalmia hospital', 5, 'ritwik1234', '2023-01-20 03:11:07'),
(8, 979573, 'AB+', 'dalmia hospital', 10, 'ritwik1234', '2023-01-20 03:11:07'),
(9, 979512, 'B+', 'ritwik hospital', 5, 'ritwik4321', '2023-01-20 03:11:07'),
(17, 801651, 'P', 'dalmia hospital', 10, 'ritwik1234', '2024-03-17 18:54:46');

-- --------------------------------------------------------

--
-- Table structure for table `profile_internshala`
--

CREATE TABLE `profile_internshala` (
  `login_username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Mno` bigint(15) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `blood_group` varchar(6) NOT NULL,
  `address` varchar(255) NOT NULL DEFAULT 'NULL',
  `state` varchar(255) NOT NULL DEFAULT 'NULL',
  `city` varchar(255) NOT NULL DEFAULT 'NULL',
  `zip` int(6) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `profile_internshala`
--

INSERT INTO `profile_internshala` (`login_username`, `full_name`, `email`, `Mno`, `age`, `gender`, `blood_group`, `address`, `state`, `city`, `zip`) VALUES
('ritwikdalmia', 'Ritwik Dalmia', 'dalmiaritwik@gmail.com', 9971655508, 21, 'male', 'A+', '1320', 'Haryana', 'Gurugram', 122002);

-- --------------------------------------------------------

--
-- Table structure for table `users_internshala`
--

CREATE TABLE `users_internshala` (
  `user_id` int(11) NOT NULL,
  `login_username` varchar(255) NOT NULL,
  `full_name` varchar(255) NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(6) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Mno` bigint(15) NOT NULL,
  `password` varchar(255) NOT NULL,
  `blood_group` varchar(255) NOT NULL,
  `creation_time` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users_internshala`
--

INSERT INTO `users_internshala` (`user_id`, `login_username`, `full_name`, `age`, `gender`, `email`, `Mno`, `password`, `blood_group`, `creation_time`) VALUES
(6, 'ritwikdalmia', 'Ritwik Dalmia', 21, 'male', 'dalmiaritwik@gmail.com', 9971655508, '$2y$10$Xf7Cs7TlQRtrn2Ekdh.U/OAjYNE0RH004ZnI0rqYJWqmgIQkGwF/.', 'A+', '2024-03-16 13:36:20');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_internshala`
--
ALTER TABLE `admin_internshala`
  ADD PRIMARY KEY (`admin_id`),
  ADD UNIQUE KEY `admin_username` (`admin_username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `application_request`
--
ALTER TABLE `application_request`
  ADD PRIMARY KEY (`application_request_id`);

--
-- Indexes for table `blood_type`
--
ALTER TABLE `blood_type`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `blood` (`blood_type`,`hospital_name`);

--
-- Indexes for table `profile_internshala`
--
ALTER TABLE `profile_internshala`
  ADD PRIMARY KEY (`login_username`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `Mno` (`Mno`);

--
-- Indexes for table `users_internshala`
--
ALTER TABLE `users_internshala`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `Mno` (`Mno`),
  ADD UNIQUE KEY `login_username` (`login_username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_internshala`
--
ALTER TABLE `admin_internshala`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `application_request`
--
ALTER TABLE `application_request`
  MODIFY `application_request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;

--
-- AUTO_INCREMENT for table `blood_type`
--
ALTER TABLE `blood_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users_internshala`
--
ALTER TABLE `users_internshala`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
