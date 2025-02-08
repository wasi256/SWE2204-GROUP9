<?php
session_start();
require 'db.php'; // Ensure you include your database connection

// Check if user is logged in, if not redirect to login page
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Assume user information is fetched from the database based on the user_id in the session
$user_id = $_SESSION['user_id'];

// Prepare and execute the query to fetch user information
$sql = "SELECT username, email FROM users WHERE user_id = ?"; // Use user_id to fetch data
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id); // "i" for integer type
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $username = $user['username'];
    $email = $user['email'];
} else {
    // Handle case where user is not found
    $username = "User";
    $email = "user@example.com"; // Default value
}

$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="css/dashboard.css">
    <script>
        function confirmLogout() {
            return confirm("Are you sure you want to logout?");
        }
    </script>
</head>
<!-- header Include -->
<?php include 'header.php'; ?>
<body>
    <div class="container">
        <header>
            <h1>Welcome to Your Dashboard</h1>
            <p class="welcome-message">Hello, <?= htmlspecialchars($username); ?>!</p>
            <p class="email"><?= htmlspecialchars($email); ?></p>
        </header>
        <nav>
            <ul class="nav-menu">
                <li><a href="hotels.php">Hotels</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="about.php">About Us</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="logout.php" onclick="return confirmLogout()">Logout</a></li>
            </ul>
        </nav>

        <!-- Related Information Panel (Above Quick Links) -->
        <section class="info-panel modern-panel">
            <h3>Stay Connected and Explore</h3>
            <p>Find the best hotels and rooms tailored to your preferences.</p>
            <p>Track and manage your bookings easily.</p>
            <p>Personalize your experience by updating your profile.</p>
            <p>Check out our latest offers and deals available exclusively for you.</p>
            <p>Feel free to contact us for any inquiries or support.</p>
            <a href="image-link.php" class="image-link">View Image</a> <!-- Link for Image -->
        </section>

        <section>
           <h2>Explore more information</h2>
            <iframe 
            src="https://www.googleadservices.com/pagead/aclk?sa=L&ai=DChcSEwjJv_iLzs-JAxWyg4MHHbyhI9wYABADGgJlZg&ae=2&aspm=1&co=1&ase=2&gclid=Cj0KCQiArby5BhCDARIsAIJvjISqRtDDZM5-j6dWbWNxRXmAPDVZAL7Ob60bL1foT3swM8FZ34lroKwaAlcrEALw_wcB&ohost=www.google.com&cid=CAESVuD2WMdf3qjoQ2O7DweV6YH_kzzbY2BxzOEm1wy3-UtEeDjomqOXxY40c6EIYr2ZEu0Eg6Z5ifilUUuwQ_kzkT0lOI-Ysjh6MZsuTkEnlSZq0Bbl42lH&sig=AOD64_3ZZlrweg5b1n4UCKX7ktAHyC_9Eg&q&nis=4&adurl&ved=2ahUKEwj44POLzs-JAxXv7AIHHSpNL_0Q0Qx6BAgMEAM" title="Web View"
            width="100%"
            height="600"
            frameborder="0"
            allowfullscreen
            title="Embedded information">
        </iframe>
        </section>
        
        <!-- Quick Links Section -->
        <section>
            <h2>Quick Links</h2>
            <div class="quick-links">
                <a href="booking.php" class="quick-link">My Bookings</a>
                <a href="profile.php" class="quick-link">Edit Profile</a>
                <a href="hotels.php" class="quick-link">Browse Hotels</a>
                <a href="upload_hotel.php" class="quick-link">Add new hotels Hotels</a>
                <a href="download_file.php" class="quick-link">Download report</a>
            </div>
        </section>

        <!-- Related Information Panel (Below Quick Links) -->
        <section class="info-panel hover-panel">
            <h3>Need Help? Explore More!</h3>
            <p>Explore our hotels and rooms to find the best deals.</p>
            <p>Your booking information is always accessible in the "My Bookings" section.</p>
            <p>Keep your profile up to date to get personalized offers and notifications.</p>
            <p>Contact our support team for any assistance during your stay.</p>
            <p>We value your feedback! Let us know how we can improve your experience.</p>
        </section>
    </div>
    <?php include 'footer.php'; ?>
</body>
</html>
