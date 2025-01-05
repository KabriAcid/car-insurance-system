<?php
require __DIR__ . '/vendor/autoload.php';

// Load environment variables from the .env file
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

// Access environment variables
$publicKey = getenv('PUBLIC_KEY');
$secretKey = getenv('SECRET_KEY');
$encryptionKey = getenv('ENCRYPTION_KEY');

$dbHost = getenv('DATABASE_HOST');
$dbUser = getenv('DATABASE_USER');
$dbName = getenv('DATABASE_NAME');
$dbPassword = getenv('DATABASE_PASSWORD');

// Example: Use the variables to connect to a database
$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Use API keys as needed
echo "Public Key: " . $publicKey;
