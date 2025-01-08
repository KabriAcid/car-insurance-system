<?php
$publicKey = "FLWPUBK_TEST-a869fb233e0ad455be16b348a4ef4394-X";
$secretKey = 'FLWSECK_TEST-84cf2876f8ae59732c2e8de209991d84-X';
$encryptionKey = 'FLWSECK_TESTe18775b64e08';

$dbHost = 'localhost';
$dbUser = 'root';
$dbName = 'scheema';
$dbPassword = 'Moussamj9$';

$conn = new mysqli($dbHost, $dbUser, $dbPassword, $dbName);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

