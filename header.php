<!-- header.php -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
<link rel="stylesheet" href="css/header.css">

<header>
    <div class="header-container">
        <!-- Logo Section -->
        <div class="logo">
            <a href="index.php">
                <!-- Logo Image -->
                <img src="photos/logoo.svg" alt="Hotel Logo" style="height: 50px;">
            </a>
        </div>

        <!-- Navigation Links -->
        <nav>
    <ul>
        <li><a href="homepage.php">Home</a></li>
        <?php if (isset($_SESSION['username'])): ?>
            <!-- Links visible only to logged-in users -->
            <li><a href="profile.php">Profile</a></li>
            <?php if ($_SESSION['role'] == 'admin'): ?>
                <!-- Admin link visible only to admin users -->
                <li><a href="admin.php">Admin Dashboard</a></li>
            <?php endif; ?>
            <li><a href="logout.php">Logout</a></li>
        <?php else: ?>
            <!-- Links visible only to guests -->
            <li><a href="register.php">Register</a></li>
            <li><a href="login.php">Login</a></li>
        <?php endif; ?>
        <li><a href="contact.php">Contact Us</a></li>
        <li><a href="about.php">About Us</a></li>
    </ul>
</nav>


        <!-- User Welcome Message -->
        <div class="user-welcome">
            <?php if (isset($_SESSION['username'])): ?>
                <p>Welcome back, <?= htmlspecialchars($_SESSION['username']); ?>!</p>
            <?php else: ?>
                <p>Welcome, Guest!</p>
            <?php endif; ?>
        </div>
    </div>
</header>
