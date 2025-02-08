<?php
// manage_users.php
session_start();
require 'db.php';

// Check if the user is logged in and has an 'admin' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: homepage.php');
    exit();
}

// Query to fetch all users
$sql = "SELECT user_id, username, email, role FROM users";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Users</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
 <!-- header Include -->
 <?php include 'header.php'; ?>
<body>

<div class="admin-container">
    <h1>Manage Users</h1>
    <table>
        <thead>
            <tr>
                <th>Username</th>
                <th>Email</th>
                <th>Role</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['username']); ?></td>
                <td><?= htmlspecialchars($row['email']); ?></td>
                <td><?= htmlspecialchars($row['role']); ?></td>
                <td>
                    <a href="edit_user.php?id=<?= $row['user_id']; ?>">Edit</a> |
                    <a href="delete_user.php?id=<?= $row['user_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
