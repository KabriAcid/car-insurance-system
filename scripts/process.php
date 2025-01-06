<?php
session_start();
require '../config.php';

// Sanitize and validate input
function sanitize_input($data)
{
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}


// Process form data
if (isset($_POST['register'])) {
    $first_name = sanitize_input($_POST["first_name"]);
    $last_name = sanitize_input($_POST["last_name"]);
    $date_of_birth = sanitize_input($_POST["date_of_birth"]);
    $address = sanitize_input($_POST["address"]);
    $email = sanitize_input($_POST["email"]);
    $phone_number = sanitize_input($_POST["phone_number"]);
    $make = sanitize_input($_POST["make"]);
    $model = sanitize_input($_POST["model"]);
    $year_of_manufacture = sanitize_input($_POST["year_of_manufacture"]);
    $vin = sanitize_input($_POST["vin"]);
    $license_plate_number = sanitize_input($_POST["license_plate_number"]);
    $current_mileage = sanitize_input($_POST["current_mileage"]);
    $drivers_license_number = sanitize_input($_POST["drivers_license_number"]);
    $driving_experience = sanitize_input($_POST["driving_experience"]);
    $password = sanitize_input($_POST["password"]);
    $confirm_password = sanitize_input($_POST["confirm_password"]);

    // Password validation
    if ($password !== $confirm_password) {
        $_SESSION['message'] = "Passwords do not match.";
        header("Location: " . $_SERVER['PHP_SELF']); // Corrected typo: SERVER_SELF to PHP_SELF
        exit();
    }

    // Hash password
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Prepare SQL statement
    $sql = "INSERT INTO users (first_name, last_name, date_of_birth, address, email, phone_number, make, model, year_of_manufacture, vin, license_plate_number, current_mileage, drivers_license_number, driving_experience, password) 
            VALUES ('$first_name', '$last_name', '$date_of_birth', '$address', '$email', '$phone_number', '$make', '$model', '$year_of_manufacture', '$vin', '$license_plate_number', '$current_mileage', '$drivers_license_number', '$driving_experience', '$hashed_password')";

    // Execute statement
    if ($conn->query($sql) === TRUE) {
        $_SESSION['message'] = "Registration successful!";
        header("Location: ../public/index.php");
    } else {
        $_SESSION['message'] = "Error: " . $conn->error; // Corrected typo: $stmt to $conn
        header("Location: " . $_SERVER['PHP_SELF']); // Corrected typo: SERVER_SELF to PHP_SELF
        exit();
    }
}
