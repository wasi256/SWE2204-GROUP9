<?php
require 'db.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Ensure the hotel_id is passed in the URL
if (isset($_GET['hotel_id'])) {
    $hotel_id = (int) $_GET['hotel_id'];  // Sanitize the hotel_id
} else {
    die("Hotel ID is required.");
}

// Fetch rooms for the selected hotel
$sql = "SELECT room_id, room_number, room_type, price, availability FROM rooms WHERE hotel_id = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Failed to prepare the query: " . $conn->error); // Handle preparation failure
}

$stmt->bind_param('i', $hotel_id);
$stmt->execute();
$result = $stmt->get_result();

// Check for errors in the query
if (!$result) {
    die("Query failed: " . $conn->error);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rooms Page</title>
    <link rel="stylesheet" href="css/rooms.css">
    <script>
        function toggleAvailability(row) {
            row.classList.toggle('highlight');
        }
    </script>
</head>
<!-- header Include -->
<?php include 'header.php'; ?>
<body>
    <div class="container">
        <h1>Available Rooms</h1>
        
        <?php if ($result->num_rows > 0): ?>
            <table>
                <tr>
                    <th>Room Number</th>
                    <th>Room Type</th>
                    <th>Price</th>
                    <th>Availability</th>
                    <th>Action</th>
                </tr>
                <?php while ($room = $result->fetch_assoc()): ?>
                    <tr onclick="toggleAvailability(this)">
                        <td><?= htmlspecialchars($room['room_number']) ?></td>
                        <td><?= htmlspecialchars($room['room_type']) ?></td>
                        <td><?= htmlspecialchars(number_format($room['price'], 2)) ?></td>
                        <td><?= $room['availability'] ? 'Available' : 'Not Available' ?></td>
                        <td>
                            <?php if ($room['availability']): ?>
                                <!-- Include room_id in the link to select the room -->
                                <a href="room_selection.php?hotel_id=<?= $hotel_id ?>&room_id=<?= htmlspecialchars($room['room_id']) ?>" class="book-now">Select Room</a>
                            <?php endif; ?>
                        </td>
                    </tr>
                <?php endwhile; ?>
            </table>
        <?php else: ?>
            <p>No rooms available at the moment.</p>
        <?php endif; ?>

        <nav>
            <p><a href="hotels.php">Back to Hotels</a></p>
            <p><a href="dashboard.php">Go to Dashboard</a></p>
        </nav>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
