<?php
// delete_user.php
session_start();
require 'db.php';

// Check if the user is logged in and is an admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: index.php');
    exit();
}

// Connect to the database (replace with your own DB connection)
include('db.php');

// Get user ID from query parameter
$user_id = $_GET['id'];

// Delete user from the database
$sql = "DELETE FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();

header('Location: manage_users.php'); // Redirect back to manage users page
exit();
?>
