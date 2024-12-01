-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 23, 2024 at 09:49 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `agrivet_db`
--
CREATE DATABASE IF NOT EXISTS `agrivet_db` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `agrivet_db`;

-- --------------------------------------------------------

--
-- Table structure for table `branch_tb`
--

CREATE TABLE `branch_tb` (
  `branch_id` int(255) NOT NULL,
  `branch_name` varchar(255) NOT NULL,
  `branch_location` varchar(255) NOT NULL,
  `branch_status` enum('Active','Inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `branch_tb`
--

INSERT INTO `branch_tb` (`branch_id`, `branch_name`, `branch_location`, `branch_status`) VALUES
(1, 'Babag', 'Lapu-Lapu', 'Active'),
(2, 'Pakpakan', 'Lapu-Lapu', 'Active'),
(3, 'All', 'All', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `employees_tb`
--

CREATE TABLE `employees_tb` (
  `employee_id` int(255) NOT NULL,
  `employee_fname` varchar(100) NOT NULL,
  `employee_lname` varchar(100) NOT NULL,
  `employee_position` varchar(100) NOT NULL,
  `employee_status` enum('Active','Inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees_tb`
--

INSERT INTO `employees_tb` (`employee_id`, `employee_fname`, `employee_lname`, `employee_position`, `employee_status`) VALUES
(1, 'Khalel Ace', 'Vega', 'Employee', 'Inactive'),
(2, 'admin fname', 'admin lname', 'Owner', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `itemspurchased_tb`
--

CREATE TABLE `itemspurchased_tb` (
  `itempurchased_id` int(255) NOT NULL,
  `material_id` int(255) NOT NULL,
  `purchased_quantity` int(255) NOT NULL,
  `total_price` float(255,2) NOT NULL,
  `transaction_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `login_tb`
--

CREATE TABLE `login_tb` (
  `login_id` int(255) NOT NULL,
  `login_name` varchar(255) NOT NULL,
  `login_password` varchar(255) NOT NULL,
  `employee_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_tb`
--

INSERT INTO `login_tb` (`login_id`, `login_name`, `login_password`, `employee_id`) VALUES
(1, 'Ace', '$2y$10$A3ozvy9QqsJ8.vGnjIKsrO8j2r0IaNPkREWFkmnw4laynSBKC8L3G', 1),
(2, 'Admin', '$2y$10$vkG6eaKNNdmuQpjKhywbPuBd2BK0ubxzb4LIIb8BP6cH4QtwETZIO', 2);

-- --------------------------------------------------------

--
-- Table structure for table `materials_tb`
--

CREATE TABLE `materials_tb` (
  `material_id` int(255) NOT NULL,
  `material_name` varchar(255) NOT NULL,
  `material_price` float(255,2) NOT NULL,
  `material_quantity` float(255,2) NOT NULL,
  `lowstock_indicator` int(255) NOT NULL,
  `date_restocked` date NOT NULL,
  `material_status` enum('Active','Inactive','','') NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `materials_tb`
--

INSERT INTO `materials_tb` (`material_id`, `material_name`, `material_price`, `material_quantity`, `lowstock_indicator`, `date_restocked`, `material_status`) VALUES
(1, 'Enermax', 41.00, 53.50, 5, '2024-07-30', 'Active'),
(3, 'Slasher', 38.00, 47.00, 5, '2024-07-21', 'Active'),
(4, '7 Kinds', 28.00, 30.00, 5, '2024-08-01', 'Active'),
(5, 'Readymix', 40.00, 29.00, 5, '2024-08-01', 'Active'),
(6, 'GF2K', 35.00, 25.00, 5, '2024-08-01', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `transactiondetails_tb`
--

CREATE TABLE `transactiondetails_tb` (
  `transaction_id` int(255) NOT NULL,
  `transaction_date` datetime NOT NULL DEFAULT current_timestamp(),
  `transaction_totalprice` float(255,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactiondetails_tb`
--

INSERT INTO `transactiondetails_tb` (`transaction_id`, `transaction_date`, `transaction_totalprice`) VALUES
(1, '2024-10-23 15:47:33', 82.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branch_tb`
--
ALTER TABLE `branch_tb`
  ADD PRIMARY KEY (`branch_id`);

--
-- Indexes for table `employees_tb`
--
ALTER TABLE `employees_tb`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `itemspurchased_tb`
--
ALTER TABLE `itemspurchased_tb`
  ADD PRIMARY KEY (`itempurchased_id`),
  ADD KEY `product_id` (`material_id`),
  ADD KEY `transaction_id` (`transaction_id`);

--
-- Indexes for table `login_tb`
--
ALTER TABLE `login_tb`
  ADD PRIMARY KEY (`login_id`),
  ADD KEY `employee_id` (`employee_id`);

--
-- Indexes for table `materials_tb`
--
ALTER TABLE `materials_tb`
  ADD PRIMARY KEY (`material_id`);

--
-- Indexes for table `transactiondetails_tb`
--
ALTER TABLE `transactiondetails_tb`
  ADD PRIMARY KEY (`transaction_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branch_tb`
--
ALTER TABLE `branch_tb`
  MODIFY `branch_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees_tb`
--
ALTER TABLE `employees_tb`
  MODIFY `employee_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `itemspurchased_tb`
--
ALTER TABLE `itemspurchased_tb`
  MODIFY `itempurchased_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `login_tb`
--
ALTER TABLE `login_tb`
  MODIFY `login_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `materials_tb`
--
ALTER TABLE `materials_tb`
  MODIFY `material_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `transactiondetails_tb`
--
ALTER TABLE `transactiondetails_tb`
  MODIFY `transaction_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `itemspurchased_tb`
--
ALTER TABLE `itemspurchased_tb`
  ADD CONSTRAINT `itemspurchased_tb_ibfk_1` FOREIGN KEY (`transaction_id`) REFERENCES `transactiondetails_tb` (`transaction_id`),
  ADD CONSTRAINT `itemspurchased_tb_ibfk_2` FOREIGN KEY (`material_id`) REFERENCES `materials_tb` (`material_id`);

--
-- Constraints for table `login_tb`
--
ALTER TABLE `login_tb`
  ADD CONSTRAINT `login_tb_ibfk_1` FOREIGN KEY (`employee_id`) REFERENCES `employees_tb` (`employee_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
