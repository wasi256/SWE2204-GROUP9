<?php
session_start();
require 'db.php'; // Database connection

// Check if booking information exists in session
if (!isset($_SESSION['booking'])) {
    echo "No booking information found.";
    exit();
}

// Ensure session variables for user and hotel are set
if (!isset($_SESSION['user_id']) || !isset($_SESSION['hotel_id'])) {
    echo "User or hotel information is missing.";
    exit();
}

// Retrieve booking details from session
$booking = $_SESSION['booking'];
$booking_id = $booking['booking_id'];
$room_id = $booking['room_id'];
$hotel_id = $_SESSION['hotel_id'];
$check_in = $booking['check_in_date'];
$check_out = $booking['check_out_date'];
$amount = $booking['amount'];

// Handle form submission for payment
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $user_id = $_SESSION['user_id'];
    $payment_method = "Credit Card"; // Placeholder; could be expanded to dynamic input
    $cardholder_name = $_POST['cardholder-name'];
    $card_number = $_POST['card-number'];
    $expiry_date = $_POST['expiry-date'];
    $cvv = $_POST['cvv'];

    // Insert payment into payments table
    $sql = "INSERT INTO payments (user_id, booking_id, amount, payment_method, status) 
            VALUES (?, ?, ?, ?, 'pending')";
    $stmt = $conn->prepare($sql);
    if ($stmt === false) {
        echo "Error preparing the statement: " . $conn->error;
        exit();
    }

    $stmt->bind_param("iids", $user_id, $booking_id, $amount, $payment_method);

    if ($stmt->execute()) {
        $payment_id = $stmt->insert_id;

        // Simulate payment gateway response
        $payment_status = 'completed'; // This could be 'completed', 'failed', or 'pending' based on real processing

        // Update payment status in payments table
        $sql_update_payment = "UPDATE payments SET status = ? WHERE payment_id = ?";
        $stmt_update_payment = $conn->prepare($sql_update_payment);
        $stmt_update_payment->bind_param("si", $payment_status, $payment_id);
        $stmt_update_payment->execute();

        // Only update booking status if payment is successful
        if ($payment_status == 'completed') {
            $sql_update_booking = "UPDATE bookings SET status = 'confirmed' WHERE booking_id = ?";
            $stmt_update_booking = $conn->prepare($sql_update_booking);
            $stmt_update_booking->bind_param("i", $booking_id);
            $stmt_update_booking->execute();

            // Redirect to confirmation page
            header("Location: confirmation.php");
            exit();
        } else {
            echo "Payment failed. Please try again.";
            exit();
        }
    } else {
        echo "Payment failed. MySQL Error: " . $conn->error;
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Payment Information</title>
    <link rel="stylesheet" href="css/payment.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/cleave.js/1.6.0/cleave.min.js"></script> <!-- Cleave.js for input masking -->
</head>
<body>
    <!-- header Include -->
<?php include 'header.php'; ?>
    
    <div class="container">
        <h1>Payment Information</h1>
        
        <form action="payment.php" method="POST" id="payment-form">
            <div class="form-group">
                <label for="cardholder-name">Cardholder Name</label>
                <input type="text" id="cardholder-name" name="cardholder-name" required>
            </div>
            <div class="form-group">
                <label for="card-number">Card Number</label>
                <input type="text" id="card-number" name="card-number" required maxlength="19" placeholder="1234 5678 9012 3456">
            </div>
            <div class="form-group">
                <label for="expiry-date">Expiry Date (MM/YY)</label>
                <input type="text" id="expiry-date" name="expiry-date" required maxlength="5" placeholder="MM/YY">
            </div>
            <div class="form-group">
                <label for="cvv">CVV</label>
                <input type="text" id="cvv" name="cvv" required maxlength="3">
            </div>

            <div class="form-group">
                <label>Total Amount: $<?= number_format($amount, 2) ?></label>
            </div>

            <button type="submit">Pay Now</button>
        </form>

        <br>
        <a href="booking.php" class="cancel-link">Cancel and Return to Booking</a>
    </div>

    <script>
        // Input masking using Cleave.js
        new Cleave('#card-number', {
            creditCard: true,
            blocks: [4, 4, 4, 4],
            delimiter: ' '
        });

        new Cleave('#expiry-date', {
            date: true,
            datePattern: ['m', 'y']
        });

        // Form validation before submission
        document.getElementById('payment-form').addEventListener('submit', function(event) {
            var cardholderName = document.getElementById('cardholder-name').value;
            var cardNumber = document.getElementById('card-number').value;
            var expiryDate = document.getElementById('expiry-date').value;
            var cvv = document.getElementById('cvv').value;

            if (!cardholderName || !cardNumber || !expiryDate || !cvv) {
                alert('Please fill in all the fields.');
                event.preventDefault(); // Prevent form submission
            } else {
                var confirmPayment = confirm('Are you sure you want to proceed with the payment?');
                if (!confirmPayment) {
                    event.preventDefault(); // Prevent form submission if user cancels
                }
            }
        });
    </script>

    <?php include 'footer.php'; ?>
</body>
</html>
