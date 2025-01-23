<!DOCTYPE html>
<html>
<head>
    <script type="text/javascript" src="../display/jquery.min.js"></script>
    <script type="text/javascript" src="../display/toastr.min.js"></script>
    <link href="../display/toastr.min.css" rel="stylesheet">
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="../logincreate/login.css">
    <script src="https://kit.fontawesome.com/97f454a94a.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script type="text/javascript" src="display/icons.js"></script>
    <title>Forget Password page</title>
</head>
<body>
<?php
    session_start();
    if (isset($_SESSION['errors'])){
        echo '<script>toastr.error("'.$_SESSION['errors'].'");</script>';
        unset($_SESSION['errors']);
    } else if (isset($_SESSION['success'])){
        echo '<script>toastr.success("'.$_SESSION['success'].'");</script>';
        unset($_SESSION['success']);
    }
?>
    <div class="container">
        <nav>
            <img src ="../logo.png" href="#" class="logo" alt="Logo" title="Holiday Hype"
                 onclick="window.location.reload();">
                 <div class="ho">
                    <a class="home" href="../index.php">Home</a>
                    <a class="package" href="../suggestionLocation.php">Packages</a>
                    <a class="booking" href="../mybookings.php">My Bookings</a>
                    <a class="hotel" href="../hotel.php">Hotels</a>
                 </div>
        </nav>   
        <div class="form-box">
            <div class="logo">
                <img src="../logo.png" alt="Project logo">
            </div>
            <form action="../Backend/forgetPassword.php" method="post">
                <div class="input-group">
                <h1>Enter your valid Email Address</h1>
                    <div class="input-field">
                        <i class="fa-solid fa-user"></i>
                        <input type="text" placeholder="Email Address" name="email" required>
                    </div>
                    
                    <button class="login_button" name="submit" type="submit">Continue</button>

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
            <p>Copyright © 2023 Holiday Hype  All Rights Reserved.</p>
        </div>
      </section>
 </div>
</body>
</html>