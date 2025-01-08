-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 05, 2025 at 04:23 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12
SET
  SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";

START TRANSACTION;

SET
  time_zone = "+00:00";

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */
;

/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */
;

/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */
;

/*!40101 SET NAMES utf8mb4 */
;

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `insurance_packages`
--
CREATE TABLE `insurance_packages` (
  `id` int(11) NOT NULL,
  `package_name` varchar(100) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `coverage_amount` decimal(10, 2) DEFAULT NULL,
  `premium` decimal(10, 2) DEFAULT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `policies`
--
CREATE TABLE `policies` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `description` text NOT NULL,
  `premium` decimal(10, 2) NOT NULL,
  `coverage` varchar(100) NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `policies`
--
INSERT INTO
  `policies` (
    `id`,
    `user_id`,
    `name`,
    `description`,
    `premium`,
    `coverage`
  )
VALUES
  (
    1,
    0,
    'Basic Plan',
    'Covers minimal accidents and injuries',
    100.00,
    'Up to ₦5,000'
  ),
  (
    2,
    0,
    'Standard Plan',
    'Covers accidents and property damage',
    200.00,
    'Up to ₦15,000'
  ),
  (
    3,
    0,
    'Premium Plan',
    'Covers all risks including theft and fire',
    500.00,
    'Up to ₦50,000'
  );

-- --------------------------------------------------------
--
-- Table structure for table `policy_applications`
--
CREATE TABLE `policy_applications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `policy_id` int(11) NOT NULL,
  `application_date` datetime NOT NULL
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `purchase_policy`
--
CREATE TABLE `purchase_policy` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

-- --------------------------------------------------------
--
-- Table structure for table `transactions`
--
CREATE TABLE `transactions` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `transaction_id` varchar(255) NOT NULL,
  `amount` decimal(10, 2) NOT NULL,
  `currency` varchar(10) NOT NULL,
  `customer_email` varchar(255) NOT NULL,
  `status` varchar(50) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--
INSERT INTO
  `transactions` (
    `id`,
    `user_id`,
    `transaction_id`,
    `amount`,
    `currency`,
    `customer_email`,
    `status`,
    `created_at`
  )
VALUES
  (
    1,
    1,
    '8307598',
    100.00,
    'NGN',
    'kabriacid01@gmail.com',
    'paid',
    '2025-01-05 02:46:04'
  ),
  (
    2,
    0,
    '8307612',
    500.00,
    'NGN',
    'mysix@gmail.com',
    'paid',
    '2025-01-05 03:21:44'
  );

-- --------------------------------------------------------
--
-- Table structure for table `users`
--
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Dumping data for table `users`
--
INSERT INTO
  `users` (
    `user_id`,
    `first_name`,
    `last_name`,
    `password`,
    `date_of_birth`,
    `address`,
    `email`,
    `phone_number`,
    `make`,
    `model`,
    `year_of_manufacture`,
    `vin`,
    `license_plate_number`,
    `current_mileage`,
    `drivers_license_number`,
    `driving_experience`,
    `created_at`
  )
VALUES
  (
    1,
    'Grace',
    'Chan',
    '$2y$10$d5AQYfwICP/uQcIY7p81p.VMebUX.IA3L55VKuZzk3Y438wVCFCwW',
    '1970-12-26',
    '27 Oak Court',
    'user@gmail.com',
    '08065518095',
    'Ut officia consequat',
    'At amet necessitati',
    1986,
    'Nihil qui fuga Repe',
    '6841600',
    58,
    '3017608',
    0,
    '2025-01-01 01:12:16'
  ),
  (
    2,
    'Abraham',
    'Powers',
    '$2y$10$P.FqSdT26Hy5M.Z34V.2mOaor7ufvtK6N7q6j073KVXQcC1Eg/Uua',
    '1991-09-19',
    '38 Oak Extension',
    'deko@gmail.com',
    '08094991761',
    'Alias ex incididunt',
    'Dicta repudiandae re',
    2002,
    'Et dolorem mollitia',
    '7795194',
    60,
    '6986393',
    0,
    '2025-01-01 04:19:37'
  ),
  (
    3,
    '',
    '',
    '$2y$10$Yi3gfq7i7UvTT4Vm7oljN.AS8t2Xq4.NenXq1O11pF6h4Si6n/nWG',
    '0000-00-00',
    '',
    '',
    '',
    '',
    '',
    0,
    '',
    '',
    0,
    '',
    0,
    '2025-01-01 05:11:53'
  ),
  (
    4,
    '',
    '',
    '$2y$10$eT3AgIp2tJm7PhDEZ7ZsUOaylP9N.8akxJ/Nxrpl16srHJ.GN0fAu',
    '0000-00-00',
    '',
    '',
    '',
    '',
    '',
    0,
    '',
    '',
    0,
    '',
    0,
    '2025-01-01 05:12:00'
  ),
  (
    5,
    'Abdullahi',
    'Kabri',
    '$2y$10$wbi6KiMqKGu7xYbD8JeEh.HakxE8Rd35B9K2LG9TUsVOHQMDetu.W',
    '1987-06-03',
    '724 Old Freeway',
    'kabriacid01@gmail.com',
    '08063749441',
    'Dolor iusto sed dele',
    'Dolorem et tenetur o',
    2019,
    'Officia dolores maio',
    '2000627',
    58,
    '9998494',
    0,
    '2025-01-02 15:29:33'
  ),
  (
    6,
    'Norman',
    'Hanson',
    '$2y$10$MoIPV0K0XsaJhFK1abvyr.OzVnH1/NQ3KJ8toQOdAi728hSkeRoD2',
    '1982-02-24',
    '14 Nobel Extension',
    'mysix@gmail.com',
    '08067369894',
    'Quia fugit aliqua',
    'Aut laborum natus li',
    2013,
    'Veritatis dignissimo',
    '9947709',
    23,
    '8749505',
    0,
    '2025-01-05 03:20:59'
  );

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

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
) ENGINE = InnoDB DEFAULT CHARSET = utf8mb4 COLLATE = utf8mb4_general_ci;

--
-- Indexes for dumped tables
--
--
-- Indexes for table `driving_info`
--
ALTER TABLE
  `driving_info`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `driving_info_ibfk_1` (`user_id`);

--
-- Indexes for table `insurance_packages`
--
ALTER TABLE
  `insurance_packages`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `policies`
--
ALTER TABLE
  `policies`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `policy_applications`
--
ALTER TABLE
  `policy_applications`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `user_id` (`user_id`),
ADD
  KEY `policy_id` (`policy_id`);

--
-- Indexes for table `purchase_policy`
--
ALTER TABLE
  `purchase_policy`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `transactions`
--
ALTER TABLE
  `transactions`
ADD
  PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE
  `users`
ADD
  PRIMARY KEY (`user_id`);

--
-- Indexes for table `user_policies`
--
ALTER TABLE
  `user_policies`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `user_policies_ibfk_1` (`user_id`),
ADD
  KEY `user_policies_ibfk_2` (`package_id`);

--
-- Indexes for table `vehicles`
--
ALTER TABLE
  `vehicles`
ADD
  PRIMARY KEY (`id`),
ADD
  KEY `vehicles_ibfk_1` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--
--
-- AUTO_INCREMENT for table `driving_info`
--
ALTER TABLE
  `driving_info`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `insurance_packages`
--
ALTER TABLE
  `insurance_packages`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `policies`
--
ALTER TABLE
  `policies`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 4;

--
-- AUTO_INCREMENT for table `policy_applications`
--
ALTER TABLE
  `policy_applications`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `purchase_policy`
--
ALTER TABLE
  `purchase_policy`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE
  `transactions`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE
  `users`
MODIFY
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  AUTO_INCREMENT = 7;

--
-- AUTO_INCREMENT for table `user_policies`
--
ALTER TABLE
  `user_policies`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `vehicles`
--
ALTER TABLE
  `vehicles`
MODIFY
  `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--
--
-- Constraints for table `driving_info`
--
ALTER TABLE
  `driving_info`
ADD
  CONSTRAINT `driving_info_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `policy_applications`
--
ALTER TABLE
  `policy_applications`
ADD
  CONSTRAINT `policy_applications_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
ADD
  CONSTRAINT `policy_applications_ibfk_2` FOREIGN KEY (`policy_id`) REFERENCES `policies` (`id`);

--
-- Constraints for table `user_policies`
--
ALTER TABLE
  `user_policies`
ADD
  CONSTRAINT `user_policies_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE,
ADD
  CONSTRAINT `user_policies_ibfk_2` FOREIGN KEY (`package_id`) REFERENCES `insurance_packages` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `vehicles`
--
ALTER TABLE
  `vehicles`
ADD
  CONSTRAINT `vehicles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */
;

/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */
;

/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */
;
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
( 'Basic Plan', 'Covers minimal accidents and injuries', 100.00, 'Up to ₦5,000'),
( 'Standard Plan', 'Covers accidents and property damage', 200.00, 'Up to ₦15,000'),
( 'Premium Plan', 'Covers all risks including theft and fire', 500.00, 'Up to ₦50,000');

CREATE TABLE policy_applications (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    policy_id INT NOT NULL,
    application_date DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (policy_id) REFERENCES policies(id)
);
CREATE TABLE claims (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT NOT NULL,
    policy_number VARCHAR(50) NOT NULL,
    description TEXT NOT NULL,
    claim_date DATETIME NOT NULL,
    FOREIGN KEY (user_id) REFERENCES users(id)
);
ALTER TABLE users ADD COLUMN role ENUM('user', 'admin') DEFAULT 'user',
INSERT INTO users (name, email, password, role) 
VALUES ('Admin User', 'admin123@gmail.com', MD5('password123'), 'admin');
