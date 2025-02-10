<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <link rel="stylesheet" href="css/homepage.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>

<body>
    <!-- header Include -->
<?php include 'header.php'; ?>

    <div class="container">
        <h1>Welcome to Our Hotel</h1>
        
        <!-- Welcome message based on session -->
        <?php if (isset($_SESSION['username'])): ?>
            <p>Welcome back, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
        <?php else: ?>
            <p>Welcome, Guest!</p>
        <?php endif; ?>

        <!-- Navigation Links -->
        <nav>
            <ul>
                <li><a href="register.php">Register</a></li>
                <li><a href="login.php">Login</a></li>
                <li><a href="contact.php">Contact Us</a></li> 
                <li><a href="about.php">About Us</a></li>
            </ul>
        </nav>

        <!-- Promo Banner Section -->
        <section class="promo-banner">
            <h2>Special Offer!</h2>
            <p>Book now and get 20% off your first stay!</p>
        </section>

        <!-- Introduction Section -->
        <section class="introduction">
            <h2>Your Perfect Getaway</h2>
            <p>Experience unparalleled luxury and comfort at our hotel, located in the heart of the city.</p>
        </section>

        <!-- Web View Section (iframe) -->
        <!-- <section>
           <h2>Explore more information</h2>
            <iframe 
            src="https://www.googleadservices.com/pagead/aclk?sa=L&ai=DChcSEwjJv_iLzs-JAxWyg4MHHbyhI9wYABADGgJlZg&ae=2&aspm=1&co=1&ase=2&gclid=Cj0KCQiArby5BhCDARIsAIJvjISqRtDDZM5-j6dWbWNxRXmAPDVZAL7Ob60bL1foT3swM8FZ34lroKwaAlcrEALw_wcB&ohost=www.google.com&cid=CAESVuD2WMdf3qjoQ2O7DweV6YH_kzzbY2BxzOEm1wy3-UtEeDjomqOXxY40c6EIYr2ZEu0Eg6Z5ifilUUuwQ_kzkT0lOI-Ysjh6MZsuTkEnlSZq0Bbl42lH&sig=AOD64_3ZZlrweg5b1n4UCKX7ktAHyC_9Eg&q&nis=4&adurl&ved=2ahUKEwj44POLzs-JAxXv7AIHHSpNL_0Q0Qx6BAgMEAM" title="Web View"
            width="100%"
            height="600"
            frameborder="0"
            allowfullscreen
            title="Embedded information">
        </iframe>
        </section> -->

        <!-- Highlights Section -->
        <section class="highlights">
            <h2>Highlights</h2>

            <!-- Features Section -->
            <div class="features">
                <h3>Our Features</h3>
                <ul>
                    <li>Spacious rooms</li>
                    <li>Complimentary breakfast</li>
                    <li>Free Wi-Fi</li>
                    <li>On-site dining</li>
                    <li>Swimming pool and fitness center</li>
                    <li>24/7 concierge</li>
                </ul>
            </div>

            <!-- Testimonials Section -->
            <div class="testimonials">
                <h3>What Our Guests Say</h3>
                <blockquote>"An amazing experience!" - John Kizito</blockquote>
                <blockquote>"A beautiful hotel." - Osbert Kamukama</blockquote>
            </div>

            <!-- Gallery Section -->
            <div class="gallery">
                <h3>Gallery</h3>
                <div class="image-carousel">
                    <img src="photos/hotel1.svg" alt="Hotel Image 1" class="carousel-image" style="display: block;">
                    <img src="photos/hotel5.svg" alt="Hotel Image 2" class="carousel-image" style="display: none;">
                    <img src="photos/hotel3.svg" alt="Hotel Image 3" class="carousel-image" style="display: none;">
                    <img src="photos/hotel4.svg" alt="Hotel Image 1" class="carousel-image" style="display: block;">
                    <img src="photos/hotel6.svg" alt="Hotel Image 1" class="carousel-image" style="display: block;">
                    
                </div>
                <button onclick="prevImage()">Previous</button>
                <button onclick="nextImage()">Next</button>
            </div>
        </section>
    </div>

    <!-- JavaScript for Carousel -->
    <script>
        let currentImageIndex = 0;
        const images = document.querySelectorAll(".carousel-image");

        function showImage(index) {
            images.forEach((img, i) => {
                img.style.display = i === index ? "block" : "none";
            });
        }

        function nextImage() {
            currentImageIndex = (currentImageIndex + 1) % images.length;
            showImage(currentImageIndex);
        }

        function prevImage() {
            currentImageIndex = (currentImageIndex - 1 + images.length) % images.length;
            showImage(currentImageIndex);
        }

        // Auto-advance every 3 seconds
        setInterval(nextImage, 3000);
    </script>

    <!-- Footer Include -->
    <?php include 'footer.php'; ?>
</body>
</html>
