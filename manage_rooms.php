<?php
// manage_rooms.php
session_start();
require 'db.php';

// Check if the user is logged in and has an 'admin' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: homepage.php');
    exit();
}

// Query to fetch all rooms
$sql = "SELECT room_id, room_number, room_type, price, availability FROM rooms";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Rooms</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
 <!-- header Include -->
 <?php include 'header.php'; ?>
<body>

<div class="admin-container">
    <h1>Manage Rooms</h1>
    <table>
        <thead>
            <tr>
                <th>Room Number</th>
                <th>Room Type</th>
                <th>Price</th>
                <th>Availability</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['room_number']); ?></td>
                <td><?= htmlspecialchars($row['room_type']); ?></td>
                <td><?= htmlspecialchars($row['price']); ?></td>
                <td><?= htmlspecialchars($row['availability']); ?></td>
                <td>
                    <a href="edit_room.php?id=<?= $row['room_id']; ?>">Edit</a> |
                    <a href="delete_room.php?id=<?= $row['room_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
