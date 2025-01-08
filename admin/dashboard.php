<?php
session_start();
include '../connection.php';

// Check if the user is logged in as an admin
if (!isset($_SESSION['admin_id'])) {
    header("Location: login.php"); // Redirect to login if not logged in
    exit();
}

// Fetching counts for dashboard
$users_count = $conn->query("SELECT COUNT(*) FROM users")->fetch_row()[0];
$policies_count = $conn->query("SELECT COUNT(*) FROM policies")->fetch_row()[0];
$claims_count = $conn->query("SELECT COUNT(*) FROM claims")->fetch_row()[0];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f9;
            margin: 0;
            padding: 0;
        }
        .sidebar {
            background-color: #343a40;
            color: white;
            width: 220px;
            height: 100vh;
            position: fixed;
            padding-top: 20px;
            padding-left: 10px;
        }
        .sidebar a {
            color: white;
            text-decoration: none;
            display: block;
            padding: 10px;
            margin: 10px 0;
            border-radius: 4px;
        }
        .sidebar a:hover {
            background-color: #007bff;
        }
        .main-content {
            margin-left: 240px;
            padding: 20px;
        }
        .card {
            display: inline-block;
            width: 200px;
            padding: 20px;
            margin: 10px;
            background-color: #fff;
            border-radius: 8px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .card h3 {
            margin: 0;
        }
        .card p {
            color: #888;
        }
        .card:hover {
            background-color: #f7f7f7;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding-bottom: 20px;
        }
        .header h1 {
            margin: 0;
        }
        .header a {
            color: #007bff;
            text-decoration: none;
            font-size: 16px;
        }
    </style>
</head>
<body>
    <div class="sidebar">
        <h2 style="color: white; text-align: center;">Admin Panel</h2>
       
        <a href="manage_policies.php">Manage Policies</a>
        <a href="manage_users.php">Manage Users</a>
        <a href="manage_claims.php">Manage Claims</a>
        <a href="logout.php">Logout</a>
    </div>
    <div class="main-content">
        <div class="header">
            <h1>Admin Dashboard</h1>
            <a href="logout.php">Logout</a>
        </div>
        <div>
            <div class="card">
                <h3><?= $users_count ?></h3>
                <p>Total Users</p>
            </div>
            <div class="card">
                <h3><?= $policies_count ?></h3>
                <p>Total Policies</p>
            </div>
            <div class="card">
                <h3><?= $claims_count ?></h3>
                <p>Total Claims</p>
            </div>
        </div>
    </div>
</body>
</html>
