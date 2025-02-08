<?php
require 'db.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $message = $_POST['message'];

    $sql = "INSERT INTO contacts (name, email, message) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);

    if (!$stmt) {
        die("Prepare failed: " . $conn->error); // Debugging output
    }

    $stmt->bind_param("sss", $name, $email, $message);

    if ($stmt->execute()) {
        $success_message = "Message sent successfully!";
    } else {
        $error_message = "Error: " . $stmt->error;
    }
    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <!-- header Include -->
<?php include 'header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us</title>
    <link rel="stylesheet" href="css/contact.css">
    <script>
        function validateForm() {
            const name = document.getElementById('name').value;
            const email = document.getElementById('email').value;
            const message = document.getElementById('message').value;
            let valid = true;

            if (name === '') {
                alert('Please enter your name.');
                valid = false;
            }

            if (email === '') {
                alert('Please enter your email.');
                valid = false;
            }

            if (message === '') {
                alert('Please enter a message.');
                valid = false;
            }

            return valid;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Contact Us</h1>
        <?php if (isset($success_message)) echo "<p>$success_message</p>"; ?>
        <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>

        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="message">Message:</label>
                <textarea id="message" name="message" required></textarea>
            </div>
            <div class="buttons">
                <button type="submit">Send Message</button>
            </div>
        </form>
        <p><a href="homepage.php">Go to Homepage</a></p>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
