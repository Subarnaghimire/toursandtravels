<!DOCTYPE html>
<html lang="en">
<head>
    <script type="text/javascript" src="display/jquery.min.js"></script>
    <script type="text/javascript" src="display/toastr.min.js"></script>
    <link href="display/toastr.min.css" rel="stylesheet">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holiday Hype</title>
    <link rel="icon" href="./logo.png">
    <script type="text/javascript" src="display/icons.js"></script>
    <link rel="stylesheet" type="text/css" href="Responsive/responsive.css">
    <link rel="stylesheet" href="LandingPage/Style.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
    <?php
        session_start();
        if (isset($_SESSION['ok'])){
            echo '<script>toastr.success("'.$_SESSION['ok'].'");</script>';
            unset($_SESSION['ok']);
        }
    ?>
    <div class="content" id="home"> 
        <nav class="wholenav hnav">
            <img src ="logo.png" href="#" class="logo" alt="Logo" title="Holiday Hype"
                 onclick="window.location.reload();">
                 <div class="ho hide show">
                    <a class="home" href="index.php">Home</a>
                    <a class="package" href="suggestionLocation.php">Packages</a>
                    <a class="booking" href="mybookings.php">My Bookings</a>
                    <a class="hotel" href="hotel.php">Hotels</a>
                 </div>
          <form action="/action_page.php" class="search_box hide show">
            <input type="hidden" placeholder="Search.." id="find" onkeyup="search()"> 
          </form>
            <ul class="navbar hide show">
                <div>
                    <?php
                    if (isset($_SESSION['id'])){
                        echo '<div class="profile"><a href="Account.php"><i class="fa-solid fa-user"></i></a></div>';
                    } else {
                        echo '<a class="signup-btn" <a href="SignUp.php">Sign Up</a></a>';
                        echo '<a class="login-btn" <a href="Login.php">Login</a></a>';
                    }
                    ?>
                </div>
            </ul>
            <img src="Responsive/ham.png" alt="hambeger" class="burger" >
        </nav>   

        <div class="background">
            <div class="title" style="color:aqua;">
                <h1>Lets enjoy your trip with Holiday Hype</h1>
                <p><b>Thinking of taking break form your daily boring life and want to have a special quality time with your loved ones?</b></p>
                <a class="button" href="suggestionLocation.php" >Start Now ></a>
            </div>
        </div>
    </div>

    <section class="container">
        <div class="text">
            <h2>Find the Travel Perfection</h2>
        </div>
        <div class="rowitems">
            <div class="container-box">
                <div class="container-image">
                   <img src="LandingPage/chat.png" alt="Chat">
                </div>
                <h4>Chat</h4>
                <p>Have a conversation with travel agency</p>
            </div>

            <div class="container-box">
                <div class="container-image">
                    <img src="LandingPage/rateus.jpg" alt="Rate Us" onclick="window.location.href='Rating.php'">
                </div>
                <h4>Feedback</h4>
                <p>Help us improve</p>
            </div>
        </div>
    </section>

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
</body>
</html>
<script src="Responsive/responsives.js"></script>

