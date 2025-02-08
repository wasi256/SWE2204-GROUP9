<?php
session_start();
require 'db.php'; // Database connection

// Redirect to login if user is not logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch hotel_id from the URL
$hotel_id = $_GET['hotel_id'] ?? null;
if (!$hotel_id) {
    die("Hotel ID is required.");
}

// Fetch hotel details for the selected hotel
$sql = "SELECT * FROM hotels WHERE hotel_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $hotel_id);
$stmt->execute();
$hotel_result = $stmt->get_result();

// Check if the hotel exists
if ($hotel_result->num_rows > 0) {
    $hotel = $hotel_result->fetch_assoc();
} else {
    die("Hotel not found.");
}

// Fetch rooms for the selected hotel
$sql = "SELECT * FROM rooms WHERE hotel_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $hotel_id);
$stmt->execute();
$rooms_result = $stmt->get_result();

// Handle room selection
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $room_id = $_POST['room_id'] ?? null;

    // Save selected room and hotel ID to session
    if ($room_id && $hotel_id) {
        $_SESSION['room_id'] = $room_id;
        $_SESSION['hotel_id'] = $hotel_id;

        // Redirect to booking page
        header("Location: booking.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Select Room</title>
    <link rel="stylesheet" href="css/room_selection.css">
</head>

<body>
    
    <div class="container">
        
        <header>
            <h1>Select a Room</h1>
            <p>Choose your room in <strong><?= htmlspecialchars($hotel['hotel_name']) ?></strong> and proceed to booking.</p>
        </header>

        <form action="room_selection.php?hotel_id=<?= $hotel_id ?>" method="POST" class="selection-form">
            <div class="form-group">
                <label for="hotel_name">Hotel</label>
                <input type="text" id="hotel_name" name="hotel_name" value="<?= htmlspecialchars($hotel['hotel_name']) ?>" disabled class="select-box">
            </div>

            <div class="form-group">
                <label for="room_id">Room</label>
                <select name="room_id" id="room_id" required class="select-box">
                    <option value="" disabled selected>Select a Room</option>
                    <?php while ($room = $rooms_result->fetch_assoc()): ?>
                        <option value="<?= $room['room_id'] ?>">
                            <?= htmlspecialchars($room['room_number']) ?> - <?= htmlspecialchars($room['room_type']) ?> - <?= htmlspecialchars($room['price']) ?> USD
                        </option>
                    <?php endwhile; ?>
                </select>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-primary">Proceed to Booking</button>
            </div>
        </form>

        <!-- Chatbot Section -->
        <div id="chatbot" class="chatbot">
            <div class="chatbot-header">
                <h3>Assistant Bot</h3>
                <button onclick="toggleChatbot()">Close</button>
            </div>
            <div class="chatbot-body" id="chatbot-body">
                <p class="bot-message">Hello! How can I assist you today?</p>
            </div>
            <div class="chatbot-input">
                <input type="text" id="user-input" placeholder="Type your message here..." onkeypress="if(event.key === 'Enter') sendMessage()">
                <button onclick="sendMessage()">Send</button>
            </div>
        </div>

        <button id="chatbot-toggle" onclick="toggleChatbot()">Chat with Assistant</button>
    </div>

    <?php include 'footer.php'; ?>

    <script>
        function toggleChatbot() {
            const chatbot = document.getElementById('chatbot');
            chatbot.style.display = chatbot.style.display === 'none' ? 'block' : 'none';
        }

        function sendMessage() {
            const userInput = document.getElementById('user-input').value;
            const chatbotBody = document.getElementById('chatbot-body');

            if (!userInput.trim()) return; // Prevent empty messages

            // Display user's message
            const userMessage = document.createElement('p');
            userMessage.className = 'user-message';
            userMessage.textContent = userInput;
            chatbotBody.appendChild(userMessage);

            // Clear the input field
            document.getElementById('user-input').value = '';

            // Simulated bot response
            const botMessage = document.createElement('p');
            botMessage.className = 'bot-message';

            if (userInput.toLowerCase().includes('translate')) {
                botMessage.textContent = "I can help translate for you! Please specify the text you'd like translated.";
            } else if (userInput.toLowerCase().includes('forex') || userInput.toLowerCase().includes('exchange')) {
                botMessage.textContent = "Today's forex rate is approximately 1 USD = 0.85 EUR. Please specify the currencies you need details on.";
            } else {
                botMessage.textContent = "I'm here to help! Please ask about translation or forex exchange rates.";
            }
            chatbotBody.appendChild(botMessage);
            chatbotBody.scrollTop = chatbotBody.scrollHeight; // Scroll to the bottom
        }

        document.getElementById('chatbot').style.display = 'none'; // Start with chatbot hidden
    </script>
</body>
</html>
