<?php
session_start();
require 'db.php'; // Database connection

// Enable error reporting for debugging
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Prepare the query to fetch user from the database
    $sql = "SELECT * FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        
        // Verify the password
        if (password_verify($password, $user['password'])) {
            // Set session variables for user_id and role
            $_SESSION['user_id'] = $user['user_id']; // Use user_id from table
            $_SESSION['username'] = $user['username']; // Set the username in session
            
            // Check and set the user's role
            if ($user['role'] == 'admin') {
                $_SESSION['role'] = 'admin';
            } else {
                $_SESSION['role'] = 'user';
            }

            // Redirect to the appropriate dashboard based on the role
            if ($_SESSION['role'] == 'admin') {
                header("Location: admin.php"); // Admin dashboard
            } else {
                header("Location: dashboard.php"); // User dashboard
            }
            exit();
        } else {
            // Invalid password
            $error = "Invalid password.";
        }
    } else {
        // No user found
        $error = "No user found.";
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="css/login.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;600&display=swap" rel="stylesheet">
</head>
<!-- header Include -->
<?php include 'header.php'; ?>
<body>
    
    <div class="container">
        <h1>Login</h1>
        <?php if (isset($error)): ?>
            <p class="error"><?= htmlspecialchars($error); ?></p>
        <?php endif; ?>
        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" required>
            </div>
            <div class="form-group">
                <label for="password">Password:</label>
                <input type="password" id="password" name="password" required>
            </div>
            <div class="buttons">
                <button type="submit" class="login-button">Login</button>
            </div>
        </form>
        <p><a href="register.php">Don't have an account? Register here.</a></p>
    </div>
    <!-- Footer at the bottom -->
    <div class="footer">
        <?php include 'footer.php'; ?>
    </div>

    <!-- Inline JavaScript for form validation -->
    <script>
        function validateForm() {
            const username = document.getElementById("username").value.trim();
            const password = document.getElementById("password").value.trim();

            if (username === "") {
                alert("Username is required.");
                return false;
            }
            if (password === "") {
                alert("Password is required.");
                return false;
            }
            return true;
        }
    </script>
</body>
</html>
