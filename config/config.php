<?php
require __DIR__ . '/vendor/autoload.php';

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Access database credentials
$dbHost = getenv('DATABASE_HOST');
$dbName = getenv('DATABASE_NAME');
$dbUser = getenv('DATABASE_USER');
$dbPassword = getenv('DATABASE_PASSWORD');

// Check if any required environment variables are missing
if (!$dbHost || !$dbName || !$dbUser || !$dbPassword) {
    die("Missing required environment variables.");
}

// Example: Use the variables to connect to a database
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

