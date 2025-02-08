<?php  
require 'db.php';
session_start();

// Ensure the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch all hotels
$sql = "SELECT * FROM hotels";
$result = $conn->query($sql);

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
    <title>Available Hotels</title>
    <link rel="stylesheet" href="css/hotels.css">
</head>

<body>
    <div class="container">
        <h1>Available Hotels</h1>
        
        <?php if ($result->num_rows > 0): ?>
            <ul>
                <?php while ($hotel = $result->fetch_assoc()): ?>
                    <li class="hotel-card">
                        <h2><?= htmlspecialchars($hotel['hotel_name']) ?></h2>
                        <div class="hotel-info">
                            <p><strong>Location:</strong> <?= htmlspecialchars($hotel['location']) ?></p>
                            <p><strong>Rating:</strong> <?= htmlspecialchars($hotel['rating']) ? htmlspecialchars($hotel['rating']) : 'Not Available' ?></p>
                            <p><strong>Amenities:</strong> <?= htmlspecialchars($hotel['amenities']) ? nl2br(htmlspecialchars($hotel['amenities'])) : 'No amenities listed' ?></p>
                            <p><strong>Contact Info:</strong> <?= htmlspecialchars($hotel['contact_info']) ? htmlspecialchars($hotel['contact_info']) : 'Not Provided' ?></p>
                            <p><strong>Created On:</strong> <?= htmlspecialchars($hotel['created_at']) ?></p>
                        </div>
                        <a href="rooms.php?hotel_id=<?= htmlspecialchars($hotel['hotel_id']) ?>" class="view-rooms-btn">View Rooms</a>
                    </li>
                <?php endwhile; ?>
            </ul>
        <?php else: ?>
            <p>No hotels available at the moment.</p>
        <?php endif; ?>

        <p><a href="dashboard.php">Go to Dashboard</a></p>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
