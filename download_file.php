<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'db.php';  // Include database connection

// Get the logged-in user's ID
$user_id = $_SESSION['user_id'];

// Define the upload directory
$uploadDir = 'uploads/';

// Fetch bookings for the logged-in user
$sql = "SELECT b.booking_id, b.user_id, r.room_id, h.hotel_id, h.hotel_name
        FROM bookings b
        JOIN rooms r ON b.room_id = r.room_id
        JOIN hotels h ON r.hotel_id = h.hotel_id
        WHERE b.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();

$bookingReports = [];

// Fetch the booking reports
while ($row = $result->fetch_assoc()) {
    // Use the booking_id and hotel_id to create the filename or report
    $reportFilename = $row['booking_id'] . '_' . $row['hotel_id'] . '.pdf';  // Example filename format
    if (file_exists($uploadDir . $reportFilename)) {
        $bookingReports[] = $reportFilename;
    }
}

// If a file is specified for download
if (isset($_GET['file'])) {
    $file = $_GET['file'];
    $filePath = $uploadDir . $file;

    // Check if the file exists and if it belongs to the user (check against the booking reports)
    if (in_array($file, $bookingReports)) {
        // Force the browser to download the file
        if (file_exists($filePath)) {
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename="' . basename($file) . '"');
            header('Content-Length: ' . filesize($filePath));
            readfile($filePath);
            exit();
        } else {
            echo "File does not exist.";
        }
    } else {
        echo "You do not have permission to download this file.";
    }
    exit();
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Download Reports</title>
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>

<div class="container">
    <h2>Download Your Booking Reports</h2>

    <?php if (empty($bookingReports)): ?>
        <p>No reports available for download.</p>
    <?php else: ?>
        <ul>
            <?php foreach ($bookingReports as $file): ?>
                <li><a href="download_file.php?file=<?= urlencode($file) ?>"><?= htmlspecialchars($file) ?></a></li>
            <?php endforeach; ?>
        </ul>
    <?php endif; ?>
</div>

</body>
</html>
