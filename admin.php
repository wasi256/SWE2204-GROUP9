<?php
// admin.php
session_start();
require 'db.php';


// Check if the user is logged in and has an 'admin' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: homepage.php');
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
 <!-- header Include -->
 <?php include 'header.php'; ?>
<body>

    <div class="admin-container">
        <h1>Welcome to the Admin Dashboard</h1>

        <!-- Admin options -->
        <div class="admin-options">
            <ul>
                <li><a href="manage_users.php">Manage Users</a></li>
                <li><a href="manage_bookings.php">Manage Bookings</a></li>
                <li><a href="manage_rooms.php">Manage Rooms</a></li>
                <li><a href="delete_user.php">Delete Users</a></li>
            </ul>
        </div>

    </div>

    <?php include 'footer.php'; ?>
</body>
</html>
