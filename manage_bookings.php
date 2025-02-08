<?php
// manage_bookings.php
session_start();
require 'db.php';

// Check if the user is logged in and has an 'admin' role
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 'admin') {
    header('Location: homepage.php');
    exit();
}

// Query to fetch all bookings
$sql = "SELECT booking_id, user_id, hotel_id, room_id, booking_date FROM bookings";
$result = $conn->query($sql);

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Bookings</title>
    <link rel="stylesheet" href="css/admin.css">
</head>
 <!-- header Include -->
 <?php include 'header.php'; ?>
<body>

<div class="admin-container">
    <h1>Manage Bookings</h1>
    <table>
        <thead>
            <tr>
                <th>Booking ID</th>
                <th>User ID</th>
                <th>Hotel ID</th>
                <th>Room ID</th>
                <th>Booking Date</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
            <tr>
                <td><?= htmlspecialchars($row['booking_id']); ?></td>
                <td><?= htmlspecialchars($row['user_id']); ?></td>
                <td><?= htmlspecialchars($row['hotel_id']); ?></td>
                <td><?= htmlspecialchars($row['room_id']); ?></td>
                <td><?= htmlspecialchars($row['booking_date']); ?></td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>

<?php include 'footer.php'; ?>
</body>
</html>
