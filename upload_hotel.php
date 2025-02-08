<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['user_id'])) {
    header('Location: login.php');
    exit();
}

require 'db.php';  // Include database connection

// Directory where files will be uploaded
$uploadDir = 'uploads/';

// Initialize success and error messages
$message = '';

// Check if form is submitted
if (isset($_POST['submit'])) {
    // Get hotel details from the form
    $hotel_name = $_POST['hotel_name'];
    $location = $_POST['location'];
    $rating = $_POST['rating'] ?? null;
    $amenities = $_POST['amenities'] ?? null;
    $contact_info = $_POST['contact_info'] ?? null;

    // Get file details
    $fileName = $_FILES['file']['name'];
    $fileTmpName = $_FILES['file']['tmp_name'];
    $fileSize = $_FILES['file']['size'];
    $fileError = $_FILES['file']['error'];
    $fileType = $_FILES['file']['type'];

    // Define allowed file types (e.g., image, PDF)
    $allowedTypes = ['image/jpeg', 'image/png', 'image/jpg', 'application/pdf', 'application/msword'];

    // Check if file type is allowed
    if (in_array($fileType, $allowedTypes)) {
        // Check if there was an error during upload
        if ($fileError === 0) {
            // Check file size (limit to 5MB)
            if ($fileSize <= 5242880) {
                // Create unique file name
                $fileNewName = uniqid('', true) . '.' . pathinfo($fileName, PATHINFO_EXTENSION);
                // Set destination path
                $fileDestination = $uploadDir . $fileNewName;

                // Move the uploaded file to the destination folder
                if (move_uploaded_file($fileTmpName, $fileDestination)) {
                    // Insert hotel details into database
                    $sql = "INSERT INTO hotels (hotel_name, location, rating, amenities, contact_info, created_at) 
                            VALUES (?, ?, ?, ?, ?, NOW())";
                    $stmt = $conn->prepare($sql);
                    $stmt->bind_param('sssss', $hotel_name, $location, $rating, $amenities, $contact_info);
                    $stmt->execute();
                    $hotel_id = $stmt->insert_id;  // Get the hotel ID of the inserted hotel

                    // Insert room details
                    $room_number = $_POST['room_number'];
                    $room_type = $_POST['room_type'];
                    $price = $_POST['price'];
                    $availability = $_POST['availability'];

                    $sql_room = "INSERT INTO rooms (room_number, room_type, price, availability, hotel_id, created_at) 
                                 VALUES (?, ?, ?, ?, ?, NOW())";
                    $stmt_room = $conn->prepare($sql_room);
                    $stmt_room->bind_param('ssdis', $room_number, $room_type, $price, $availability, $hotel_id);
                    $stmt_room->execute();

                    $message = "Hotel and room details uploaded successfully!";
                } else {
                    $message = "Error uploading the file.";
                }
            } else {
                $message = "File is too large. Maximum size is 5MB.";
            }
        } else {
            $message = "Error uploading the file.";
        }
    } else {
        $message = "Invalid file type. Only images, PDF, DOCX are allowed.";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Hotel Details</title>
    <link rel="stylesheet" href="css/upload_hotel.css">
</head>
<!-- header Include -->
<?php include 'header.php'; ?>
<body>

<div class="container">
    <h2>Upload New Hotel</h2>

    <!-- Display message -->
    <?php if ($message): ?>
        <p><?= htmlspecialchars($message) ?></p>
    <?php endif; ?>

    <!-- Form to upload hotel and room details -->
    <form action="upload_hotel.php" method="POST" enctype="multipart/form-data">
        <div>
            <label for="hotel_name">Hotel Name:</label>
            <input type="text" name="hotel_name" required>
        </div>
        <div>
            <label for="location">Location:</label>
            <input type="text" name="location" required>
        </div>
        <div>
            <label for="rating">Rating:</label>
            <input type="number" name="rating" step="0.1" min="1" max="5">
        </div>
        <div>
            <label for="amenities">Amenities:</label>
            <textarea name="amenities"></textarea>
        </div>
        <div>
            <label for="contact_info">Contact Information:</label>
            <input type="text" name="contact_info">
        </div>
        <div>
            <label for="file">Upload File (e.g., image, document):</label>
            <input type="file" name="file" required>
        </div>
        <div>
            <label for="room_number">Room Number:</label>
            <input type="text" name="room_number" required>
        </div>
        <div>
            <label for="room_type">Room Type:</label>
            <input type="text" name="room_type">
        </div>
        <div>
            <label for="price">Room Price:</label>
            <input type="number" name="price" step="0.01" required>
        </div>
        <div>
            <label for="availability">Room Availability:</label>
            <input type="number" name="availability" min="0" max="1" value="1">
        </div>

        <button type="submit" name="submit">Upload Hotel</button>
    </form>
</div>
<?php include 'footer.php'; ?>

</body>
</html>
