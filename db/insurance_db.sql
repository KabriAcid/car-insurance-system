-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 01, 2025 at 02:13 AM
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
-- Database: `insurance_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `driving_info`
--

CREATE TABLE `driving_info` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `drivers_license_number` varchar(20) DEFAULT NULL,
  `driving_experience` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `insurance_packages`
--

CREATE TABLE `insurance_packages` (
  `id` int(11) NOT NULL,
  `package_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `coverage_amount` decimal(10,2) DEFAULT NULL,
  `premium` decimal(10,2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date DEFAULT NULL,
  `address` varchar(255) DEFAULT NULL,
  `email` varchar(100) NOT NULL,
  `phone_number` varchar(15) DEFAULT NULL,
  `make` varchar(50) NOT NULL,
  `model` varchar(50) NOT NULL,
  `year_of_manufacture` int(11) NOT NULL,
  `vin` varchar(50) NOT NULL,
  `license_plate_number` varchar(50) NOT NULL,
  `current_mileage` int(11) NOT NULL,
  `drivers_license_number` varchar(50) NOT NULL,
  `driving_experience` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `password`, `date_of_birth`, `address`, `email`, `phone_number`, `make`, `model`, `year_of_manufacture`, `vin`, `license_plate_number`, `current_mileage`, `drivers_license_number`, `driving_experience`, `created_at`) VALUES
(1, 'Grace', 'Chan', '$2y$10$d5AQYfwICP/uQcIY7p81p.VMebUX.IA3L55VKuZzk3Y438wVCFCwW', '1970-12-26', '27 Oak Court', 'user@gmail.com', '08065518095', 'Ut officia consequat', 'At amet necessitati', 1986, 'Nihil qui fuga Repe', '6841600', 58, '3017608', 0, '2025-01-01 01:12:16');

-- --------------------------------------------------------

--
-- Table structure for table `user_policies`
--

CREATE TABLE `user_policies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `package_id` int(11) DEFAULT NULL,
  `start_date` date DEFAULT NULL,
  `end_date` date DEFAULT NULL,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `vehicles`
--

CREATE TABLE `vehicles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `make` varchar(50) DEFAULT NULL,
  `model` varchar(50) DEFAULT NULL,
  `year_of_manufacture` int(11) DEFAULT NULL,
  `vin` varchar(50) DEFAULT NULL,
  `license_plate_number` varchar(20) DEFAULT NULL,
  `current_mileage` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `driving_info`
--
ALTER TABLE `driving_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `driving_info_ibfk_1` (`user_id`);

--
-- Indexes for table `insurance_packages`
--
ALTER TABLE `insurance_packages`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_policies`
--
ALTER TABLE `user_policies`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_policies_ibfk_1` (`user_id`),
  ADD KEY `user_policies_ibfk_2` (`package_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `vehicles_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `driving_info`
--
ALTER TABLE `driving_info`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance_packages`
--
ALTER TABLE `insurance_packages`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_policies`
--
ALTER TABLE `user_policies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE `vehicles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `driving_info`
--
ALTER TABLE `driving_info`
  ADD CONSTRAINT `driving_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `user_policies`
--
ALTER TABLE `user_policies`
  ADD CONSTRAINT `user_policies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `user_policies_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `insurance_packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE `vehicles`
  ADD CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;

CREATE TABLE policies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    description TEXT NOT NULL,
    premium DECIMAL(10, 2) NOT NULL,
    coverage VARCHAR(100) NOT NULL
);
CREATE TABLE purchase_policy (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
INSERT INTO policies ( name, description, premium, coverage) VALUES
(1, 'Basic Plan', 'Covers minimal accidents and injuries', 100.00, 'Up to ₦5,000'),
(1, 'Standard Plan', 'Covers accidents and property damage', 200.00, 'Up to ₦15,000'),
(2, 'Premium Plan', 'Covers all risks including theft and fire', 500.00, 'Up to ₦50,000');

