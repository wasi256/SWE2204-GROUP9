<?php
session_start();
require 'db.php'; // Database connection

$message = ''; // Initialize the message variable

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // CSRF Token validation
    if ($_POST['csrf_token'] !== $_SESSION['csrf_token']) {
        die('Invalid CSRF token');
    }

    // User input processing
    $username = $_POST['username'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash the password
    $email = $_POST['email'];
    $role = $_POST['role'] ?? 'user'; // Get role from form, default to 'user'

    // Database query to insert the user
    $sql = "INSERT INTO users (username, password, email, role) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $username, $password, $email, $role);

    if ($stmt->execute()) {
        $message = "Registration successful! You can now login.";
        header("Location: login.php");
        exit();
    } else {
        $message = "Error: " . $stmt->error;
    }

    $stmt->close();
}

// CSRF token generation
if (empty($_SESSION['csrf_token'])) {
    $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration Page</title>
    <link rel="stylesheet" href="css/register.css">
</head>
<!-- header Include -->
<?php include 'header.php'; ?>
<body>
 
    <div class="container">
        <h1>REGISTER</h1>
        <?php if ($message): ?>
            <p class="message"><?= htmlspecialchars($message); ?></p>
        <?php endif; ?>
        <form action="" method="POST" onsubmit="return validateForm()">
            <input type="hidden" name="csrf_token" value="<?= htmlspecialchars($_SESSION['csrf_token']); ?>">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="form-group">
                <label for="role">Role:</label>
                <select id="role" name="role">
                    <option value="user" selected>User</option>
                    <option value="admin">Admin</option>
                </select>
            </div>
            <div>
                <input type="checkbox" id="terms" name="terms" required>
                <label for="terms">I accept <a href="#">Terms of service</a> and <a href="#">Privacy policy.</a></label>
            </div>
            <div class="buttons">
                <button type="submit">Register</button>
            </div>
        </form>
        <p><a href="login.php">Already have an account? Login here.</a></p>
    </div>
    
    <!-- Inline JavaScript for form validation -->
    <script>
        function validateForm() {
            const username = document.getElementById("username").value.trim();
            const email = document.getElementById("email").value.trim();
            const password = document.getElementById("password").value.trim();
            const terms = document.getElementById("terms").checked;

            if (username === "") {
                alert("Username is required.");
                return false;
            }
            if (email === "") {
                alert("Email is required.");
                return false;
            }
            if (!/^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email)) {
                alert("Please enter a valid email address.");
                return false;
            }
            if (password === "") {
                alert("Password is required.");
                return false;
            }
            if (!terms) {
                alert("You must accept the Terms of Service and Privacy Policy.");
                return false;
            }
            return true;
        }
    </script>
    <?php include 'footer.php'; ?>
</body>
</html>
