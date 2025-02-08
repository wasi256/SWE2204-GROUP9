<?php
require 'db.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Fetch user details
$user_id = $_SESSION['user_id'];
$sql = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $email = $_POST['email'];

    $update_sql = "UPDATE users SET username = ?, email = ? WHERE user_id = ?";
    $update_stmt = $conn->prepare($update_sql);
    $update_stmt->bind_param("ssi", $username, $email, $user_id);

    if ($update_stmt->execute()) {
        $success_message = "Profile updated successfully.";
    } else {
        $error_message = "Error updating profile: " . $update_stmt->error;
    }
    $update_stmt->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Profile</title>
    <link rel="stylesheet" href="css/profile.css">
    <script>
        function validateForm() {
            const username = document.getElementById('username').value;
            const email = document.getElementById('email').value;
            let valid = true;

            if (username === '') {
                alert('Please enter a username.');
                valid = false;
            }

            if (email === '') {
                alert('Please enter an email address.');
                valid = false;
            }

            return valid;
        }
    </script>
</head>
<body>
    <!-- header Include -->
<?php include 'header.php'; ?>
    <div class="container">
        <h1>Your Profile</h1>
        <?php if (isset($success_message)) echo "<p>$success_message</p>"; ?>
        <?php if (isset($error_message)) echo "<p>$error_message</p>"; ?>

        <form action="" method="POST" onsubmit="return validateForm()">
            <div class="form-group">
                <label for="username">Username:</label>
                <input type="text" id="username" name="username" value="<?= htmlspecialchars($user['username']) ?>" required>
            </div>
            <div class="form-group">
                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?= htmlspecialchars($user['email']) ?>" required>
            </div>
            <div class="buttons">
                <button type="submit">Update Profile</button>
            </div>
        </form>
        <p><a href="dashboard.php">Go to Dashboard</a></p>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
