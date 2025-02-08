<?php
session_start();
require 'db.php'; // Database connection

// Check if booking information exists in session
if (!isset($_SESSION['booking'])) {
    echo "No booking information found.";
    exit();
}

// Get booking details from session
$booking = $_SESSION['booking'];
$booking_id = $booking['booking_id'];
$room_number = $booking['room_number'];
$check_in_date = $booking['check_in_date'];
$check_out_date = $booking['check_out_date'];
$amount = $booking['amount'];
$hotel_id = $_SESSION['hotel_id']; // Retrieve hotel_id from session

// Retrieve hotel name from the database
$sql = "SELECT hotel_name FROM hotels WHERE hotel_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $hotel_id);
$stmt->execute();
$result = $stmt->get_result();
$hotel = $result->fetch_assoc();
$hotel_name = $hotel['hotel_name'] ?? 'Hotel name not found';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
    <link rel="stylesheet" href="css/confirmation.css"> <!-- External CSS -->
</head>
<body>

<div class="confirmation-container">
    <div class="confirmation-message">
        <p class="message-heading">Thank you for your booking!</p>
        <p><strong>Hotel Name:</strong> <?= htmlspecialchars($hotel_name) ?></p>
        <p><strong>Room Number:</strong> <?= htmlspecialchars($room_number) ?></p>
        <p><strong>Check-in Date:</strong> <?= htmlspecialchars($check_in_date) ?></p>
        <p><strong>Check-out Date:</strong> <?= htmlspecialchars($check_out_date) ?></p>
        <p><strong>Total Amount:</strong> $<?= number_format($amount, 2) ?></p>
    </div>
    <p>Your payment has been successfully processed. You will receive an email confirmation shortly.</p>
</div>

<script>
    // Set a timeout to redirect after 5 seconds
    setTimeout(function() {
        window.location.href = 'dashboard.php'; // Redirect to dashboard after 5 seconds
    }, 5000); // 5000 milliseconds = 5 seconds
</script>

<!-- Include the footer -->
<?php include 'footer.php'; ?>

</body>
</html>
