<?php
session_start();
require 'db.php'; // Database connection

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Initialize variables and check for session values
$error_message = '';
$room_id = $_SESSION['room_id'] ?? null;
$hotel_id = $_SESSION['hotel_id'] ?? null;

if (!$room_id || !$hotel_id) {
    die("Hotel ID and Room ID are required.");
}

// Fetch room details
$sql = "SELECT room_number, price FROM rooms WHERE room_id = ?";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die('MySQL prepare error: ' . $conn->error);
}
$stmt->bind_param("i", $room_id);
$stmt->execute();
$result = $stmt->get_result();
$room = $result->fetch_assoc();
$room_number = $room['room_number'];
$price_per_night = $room['price'];

// Handle form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $check_in = $_POST['check_in'] ?? null;
    $check_out = $_POST['check_out'] ?? null;

    if (empty($check_in) || empty($check_out)) {
        $error_message = "Please fill in all fields.";
    } elseif ($check_in >= $check_out) {
        $error_message = "Check-out date must be after check-in date.";
    } else {
        $current_date = date("Y-m-d");
        if ($check_in < $current_date || $check_out < $current_date) {
            $error_message = "Check-in and check-out dates must be in the future.";
        } else {
            $check_in_date = new DateTime($check_in);
            $check_out_date = new DateTime($check_out);
            $night_count = $check_in_date->diff($check_out_date)->days;
            $amount = $price_per_night * $night_count;

            $user_id = $_SESSION['user_id'];

            // Insert booking into database
            $sql = "INSERT INTO bookings (user_id, room_id, hotel_id, check_in_date, check_out_date, status) 
                    VALUES (?, ?, ?, ?, ?, 'pending')";
            $stmt = $conn->prepare($sql);
            if ($stmt === false) {
                die('MySQL prepare error: ' . $conn->error);
            }

            $stmt->bind_param("iiiss", $user_id, $room_id, $hotel_id, $check_in, $check_out);

            if ($stmt->execute()) {
                $booking_id = $stmt->insert_id;

                // Store booking information in the session
                $_SESSION['booking'] = [
                    'booking_id' => $booking_id,
                    'room_id' => $room_id,
                    'room_number' => $room_number,
                    'check_in_date' => $check_in,
                    'check_out_date' => $check_out,
                    'amount' => $amount,
                ];

                // Redirect to payment page
                header("Location: payment.php");
                exit();
            } else {
                $error_message = "Error with your booking. Please try again.";
            }
        }
    }
}
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking</title>
    <link rel="stylesheet" href="css/booking.css">
</head>
<!-- header Include -->
<?php include 'header.php'; ?>
<body>
    <div class="container">
        <h1>Booking Details</h1>

        <?php if ($error_message): ?>
            <p class="error"><?= $error_message ?></p>
        <?php endif; ?>

        <form action="booking.php" method="POST">
            <div class="form-group">
                <label for="check_in">Check-In Date</label>
                <input type="date" id="check_in" name="check_in" required min="<?= date('Y-m-d') ?>">
            </div>
            <div class="form-group">
                <label for="check_out">Check-Out Date</label>
                <input type="date" id="check_out" name="check_out" required min="<?= date('Y-m-d') ?>">
            </div>
            <input type="hidden" name="room_id" value="<?= htmlspecialchars($room_id) ?>">
            <input type="hidden" name="hotel_id" value="<?= htmlspecialchars($hotel_id) ?>">

            <button type="submit">Proceed to Payment</button>
        </form>

        <!-- Forex & Translation Bot -->
        <div class="bot-container">
            <h2>Ask Our Bot</h2>
            <input type="text" id="bot_input" placeholder="Ask about Forex or translations...">
            <button id="bot_submit">Ask Bot</button>
            <p id="bot_response"></p>
        </div>

        <nav>
            <a href="rooms.php" class="cancel-link">Back to Rooms</a>
        </nav>
    </div>
    <?php include 'footer.php'; ?>

    <script>
        // Bot functionality
        document.getElementById('bot_submit').addEventListener('click', function() {
            const userInput = document.getElementById('bot_input').value.trim().toLowerCase();
            const responseElement = document.getElementById('bot_response');

            if (!userInput) {
                responseElement.textContent = "Please type a question.";
                return;
            }

            // Simulated responses
            if (userInput.includes('forex')) {
                responseElement.textContent = "Today's exchange rate: 1 USD = 0.85 EUR.";
            } else if (userInput.includes('translate')) {
                responseElement.textContent = "Translation help: type the phrase you want translated.";
            } else {
                responseElement.textContent = "Sorry, I don't understand. Try asking about Forex rates or translations.";
            }
        });

        // Date validation for check-in/check-out
        const checkInDate = document.getElementById('check_in');
        const checkOutDate = document.getElementById('check_out');

        checkInDate.addEventListener('change', function() {
            checkOutDate.min = checkInDate.value;
        });
    </script>
</body>
</html>
