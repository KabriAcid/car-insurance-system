<?php
require __DIR__ . '/vendor/autoload.php';

// Load environment variables from the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Access environment variables
$publicKey = $_ENV['PUBLIC_KEY'];
$secretKey = $_ENV['SECRET_KEY'];
$encryptionKey = $_ENV['ENCRYPTION_KEY'];

$dbHost = $_ENV['DATABASE_HOST'];
$dbUser = $_ENV['DATABASE_USER'];
$dbName = $_ENV['DATABASE_NAME'];
$dbPassword = $_ENV['DATABASE_PASSWORD'];

// Example: Use the variables to connect to a database
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}
