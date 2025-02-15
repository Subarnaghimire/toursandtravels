<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sign Up Page</title>
    <!-- Toastr CSS and JS -->
    <link href="display/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="display/jquery.min.js"></script>
    <script type="text/javascript" src="display/toastr.min.js"></script>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="logincreate/signup.css">
    <link rel="stylesheet" type="text/css" href="Responsive/responsive.css">
    <!-- Font Awesome Icons -->
    <script src="https://kit.fontawesome.com/97f454a94a.js" crossorigin="anonymous"></script>
    <!-- Boxicons -->
    <link href="https://unpkg.com/boxicons@latest/css/boxicons.min.css" rel="stylesheet">
    <!-- Favicon -->
    <link rel="icon" href="./logo.png">
</head>
<body>
    <!-- Display Toastr Notifications -->
    <?php
    session_start();
    if (isset($_SESSION['error'])) {
        echo '<script>toastr.error("' . $_SESSION['error'] . '");</script>';
        unset($_SESSION['error']);
    } elseif (isset($_SESSION['success'])) {
        echo '<script>toastr.success("' . $_SESSION['success'] . '");</script>';
        unset($_SESSION['success']);
    }
    ?>

    <!-- Navigation Bar -->
    <div class="container">
    <nav class="wholenav hnav">
        <img src="logo.png" href="#" class="logo" alt="Logo" title="Holiday Hype" onclick="window.location.reload();">
        <div class="ho hide show">
            <a class="home" href="index.php">Home</a>
            <a class="package" href="suggestionLocation.php">Packages</a>
            <a class="booking" href="mybookings.php">My Bookings</a>
            <a class="hotel" href="hotel.php">Hotels</a>
        </div>
        <img src="Responsive/ham.png" alt="hamburger" class="burger">
    </nav>

    <!-- Signup Form -->
        <div class="form-box">
            <div class="logo">
                <img src="logo.png" alt="Project Logo">
            </div>
            <h1>Holiday Hype</h1>
            <form method="POST" action="Backend/signup.php">
                <div class="input-group">
                    <!-- Name Field -->
                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Name" name="name" required>
                    </div>
                    <!-- Email Field -->
                    <div class="input-field">
                        <i class="fa-solid fa-envelope"></i>
                        <input type="email" placeholder="Email" name="email" required>
                    </div>
                    <!-- Password Field -->
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" required>
                    </div>
                    <!-- Confirm Password Field -->
                    <div class="input-field">
                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Confirm Password" name="confirm_password" required>
                    </div>
                    <!-- Submit Button -->
                    <button class="login_button" name="submit">Sign Up</button>
                    <!-- Login Link -->
                    <p>Or</p>
                    <p class="no_account">Already have an account? <a href="Login.php">Login</a></p>
                </div>
            </form>
        </div>

    <!-- Footer -->
    <div class="footer">
        <div class="foot">
            <div class="footer-content">
                <!-- Quick Links -->
                <div class="footlinks">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a class="aboutus" href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>
                <!-- Social Media Links -->
                <div class="footlink_social">
                    <h4>Connect</h4>
                    <div class="social">
                        <a href="https://www.facebook.com/" target="_blank"><i class='bx bxl-facebook'></i></a>
                        <a href="https://www.instagram.com/" target="_blank"><i class='bx bxl-instagram'></i></a>
                        <a href="https://www.twitter.com/" target="_blank"><i class='bx bxl-twitter'></i></a>
                        <a href="https://www.youtube.com/" target="_blank"><i class='bx bxl-youtube'></i></a>
                        <a href="https://www.tiktok.com/" target="_blank"><i class='bx bxl-tiktok'></i></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- Copyright -->
        <div class="end">
            <p>Copyright © 2024 Holiday Hype. All Rights Reserved.</p>
        </div>
    </div>
    </div>


    <!-- Responsive JS -->
    <script src="Responsive/responsives.js"></script>
</body>
</html>
