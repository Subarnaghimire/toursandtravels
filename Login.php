

<!DOCTYPE html>
<html>\
<head>
    <script type="text/javascript" src="display/jquery.min.js"></script>
    <script type="text/javascript" src="display/toastr.min.js"></script>
    <link href="display/toastr.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="logincreate/login.css">
    <link rel="stylesheet" type="text/css" href="Responsive/responsive.css">
    <link rel="icon" href="./logo.png">
    <script src="https://kit.fontawesome.com/97f454a94a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script type="text/javascript" src="display/icons.js"></script>
    <title>Log in page</title>
</head>

<body>
<?php
    session_start();
    if (isset($_SESSION['error'])){
        echo '<script>toastr.error("'.$_SESSION['error'].'");</script>';
        unset($_SESSION['error']);
    } else if (isset($_SESSION['success'])){
        echo '<script>toastr.success("'.$_SESSION['success'].'");</script>';
        unset($_SESSION['success']);
    }
?>
    <div class="container">
                <nav class="wholenav hnav">
            <img src ="logo.png" href="#" class="logo" alt="Logo" title="Holiday Hype"
                 onclick="window.location.reload();">
                 <div class="ho hide show">
                    <a class="home" href="index.php">Home</a>
                    <a class="package" href="suggestionLocation.php">Packages</a>
                    <a class="booking" href="mybookings.php">My Bookings</a>
                    <a class="hotel" href="hotel.php">Hotels</a>
                 </div>
            <img src="Responsive/ham.png" alt="hambeger" class="burger" >
        </nav>   
        <div class="form-box">
            <div class="logo">
                <img src="logo.png" alt="Project logo">
            </div>
            <h1>Holiday Hype</h1>
            <form action="Backend/login.php" method="post">
                <div class="input-group">
                    <div class="input-field">

                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Username" name="username" required>
                    </div>

                    <div class="input-field">

                        <i class="fa-solid fa-lock"></i>
                        <input type="password" placeholder="Password" name="password" required>


                    </div>
                    
                    <button class="login_button">
                        Log in</button>
                    <p>Or</p>
                    <p class="no_account">No account : <a href="SignUp.php">Sign Up</a></p>
                 </div>
            </form>
        </div>

        <section class="footer">
            <div class="foot">
                <div class="footer-content">
                    <div class="footlinks">
                        <h4>Quick Links</h4>
                        <ul>
                        <li><a class="aboutus" href="#">About Us </a></li>
                        <li><a href="#">Contact Us </a></li>
                    </ul>
                </div>
      
                <div class="footlink_social">
                    <h4>Connect</h4>
                    <div class="social">
                        <a href="https://www.facebook.com/" target="_blank"><i class='bx bxl-facebook'></i></a>
                        <a href="https://www.instagram.com/" target="_blank"><i class='bx bxl-instagram' ></i></a>
                        <a href="https://www.twitter.com/" target="_blank"><i class='bx bxl-twitter' ></i></a>
                        <a href="https://www.youtube.com/" target="_blank"><i class='bx bxl-youtube' ></i></a>
                        <a href="https://www.tiktok.com/" target="_blank"><i class='bx bxl-tiktok' ></i></a>
                    </div>
                </div>
                
            </div>
        </div>
        <div class="end">
            <p>Copyright © 2024 Holiday Hype  All Rights Reserved.</p>
        </div>
      </section>
 </div>
</body>
</html>
<script src="Responsive/responsives.js"></script>
