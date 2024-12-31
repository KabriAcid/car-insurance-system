CREATE DATABASE insurance_db;
USE db;

CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    date_of_birth DATE,
    address VARCHAR(255),
    email VARCHAR(100) UNIQUE,
    phone_number VARCHAR(15)
);

CREATE TABLE vehicles (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    make VARCHAR(50),
    model VARCHAR(50),
    year_of_manufacture INT,
    vin VARCHAR(50),
    license_plate_number VARCHAR(20),
    current_mileage INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE driving_info (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    drivers_license_number VARCHAR(20),
    driving_experience INT,
    FOREIGN KEY (user_id) REFERENCES users(id)
);

CREATE TABLE insurance_packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    package_name VARCHAR(100),
    description TEXT,
    coverage_amount DECIMAL(10, 2),
    premium DECIMAL(10, 2)
);

CREATE TABLE user_policies (
    id INT AUTO_INCREMENT PRIMARY KEY,
    user_id INT,
    package_id INT,
    start_date DATE,
    end_date DATE,
    status VARCHAR(20),
    FOREIGN KEY (user_id) REFERENCES users(id),
    FOREIGN KEY (package_id) REFERENCES insurance_packages(id)
);