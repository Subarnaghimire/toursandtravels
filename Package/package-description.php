<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Holiday Hype</title>
    <link rel="stylesheet" type="text/css" href="package-description.css">
    <link rel="stylesheet" type="text/css" href="../Responsive/responsive.css">
    <link rel="icon" href="../logo.png">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="text/javascript" src="../display/icons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script
    src="https://kit.fontawesome.com/97f454a94a.js"
    crossorigin="anonymous"
  ></script>
    <title>Package description</title>

</head>
<body >
<nav class="wholenav hnav">
            <img src ="../logo.png" href="#" class="logo" alt="Logo" title="Holiday Hype"
                 onclick="window.location.reload();">
                 <div class="ho hide show">
                    <a class="home" href="../index.php">Home</a>
                    <a class="package" href="../suggestionLocation.php">Packages</a>
                    <a class="booking" href="../mybookings.php">My Bookings</a>
                    <a class="hotel" href="../hotel.php">Hotels</a>
                 </div>
          <form action="/action_page.php" class="search_box hide show">
            <input type="hidden" placeholder="Search.." id="find" onkeyup="search()"> 
          </form>
            <ul class="navbar hide show">
                <div>
                    <?php
                    if (isset($_SESSION['id'])){
                        echo '<div class="profile"><a href="../Account.php"><i class="fa-solid fa-user"></i></a></div>';
                    } else {
                        echo '<a class="signup-btn" <a href="../SignUp.php">Sign Up</a></a>';
                        echo '<a class="login-btn" <a href="../Login.php">Login</a></a>';
                    }
                    ?>
                </div>
            </ul>
            <img src="../Responsive/ham.png" alt="hambeger" class="burger" >
        </nav>   

        <div style="overflow-x:hidden;width:100%"> 
        <?php 
            include "../Backend/getData.php";
            include "../Backend/addData.php";
            $result = fetchPackageById($_GET['id']);
            $row = mysqli_fetch_array($result);

            echo "<h1>".$row['PackageName']."</h1>";

            
            echo "<div class='package-heading'>";
            $stars = "";
            $rating = $row['Rating'];
            for ($i = 1; $i <= 5; $i++) {
                if ($i <= $rating) {
                    $stars .= "<i class='fa-sharp fa-solid fa-star' style='color: #fec700;'></i>";
                } else {
                    $stars .= "<i class='fa fa-star checked'></i>";
                }
            }
            echo $stars;
            echo "</div>";

            echo "<section class='contain'>";
            echo "<div class='slider-wrapper'>";
            echo "<div class='slider'>";
            echo "<img id='slide-1' src='" . $row['ImageLink'] . "' alt='" . $row['PackageName'] . "'>";
            echo "<img id='slide-1' src='" . $row['ImageLink'] . "' alt='" . $row['PackageName'] . "'>";
            echo "<img id='slide-1' src='" . $row['ImageLink'] . "' alt='" . $row['PackageName'] . "'>";
            echo "</div>";

            echo "<div class='slider-nav'>";
            echo "<a href='#slide-1'></a>";
            echo "<a href='#slide-2'></a>";
            echo "<a href='#slide-3'></a>";
            echo "</div>";
            echo "</div>";
            echo "</section>";

            echo "<div class='time_duration'>";
            echo "<p><i class='fa-solid fa-map-pin'></i> Start at : Kathmandu</p>";
            echo "<p><i class='fa-solid fa-location-dot'></i> Trek region : " . $row['LocationName'] . "</p>";
            echo "<p><i class='fa-solid fa-plane'></i> Transportation : " . $row['Transportation'] . "</p>";
            echo "<p><i class='fa-solid fa-clock'></i> Duration : " . $row['Days'] . " Days</p>";
            echo "<p><i class='fa-sharp fa-solid fa-hotel'></i> Accommodation : ". $row['Accomodation']  ." Hotel</p>";
            echo "</div>";

            echo "<div class='description'>";
            echo "<p>'".$row['About']."'</p>";
            echo "</div>";

            echo "<h2 style='margin-left: 150px'>Itinerary<h2>";

            echo "<div class='description'>";
            echo "<p>'".$row['Itinerary']."'</p>";
            echo "</div>";
            
            if(isset($_SESSION['id'])){
                $user_has_booked = check_if_user_has_booked($_SESSION['id'], $_GET['id']);
                $button_text = "Not decided";
                if ($user_has_booked == "pending") {
                    $button_text = 'submitted';
                    echo "<div style='text-align: center ; color: blue'>Your Booking is pending for approval.</div>";
                } else if ($user_has_booked == "approved"){
                    echo "<div style='text-align: center ; color: green'>Your Booking is Approved</div>";
                } else {
                    echo "<form method='POST'>";
                    echo "<div class='submitButton'>";
                    echo "<button class='booking-button' type='submit' name='submit'>Book Now</button></form>";
                    echo "</div>";
                }
                
                if($button_text=="submitted"){
                    echo "<form method='POST'>";
                    echo "<div class='submitButton'>";
                    echo "<button class='booking-button' type='submit' name='cancelSubmit'>Cancel</button></form>";
                    echo "</div>";
                }

                if(isset($_POST['cancelSubmit'])){
                    $packId = $_GET['id'];
                    $id = $_SESSION['id'];

                    if(cancelBook($id, $packId)){
                        $_SESSION['canceled'] = "Your booking is canceled";
                        echo '<script>window.location.href = "../suggestionLocation.php"</script>';
                    }
                }

                if(isset($_POST['submit'])){
                    $packId = $_GET['id'];
                    $id = $_SESSION['id'];

                    if(addBookings($id, $packId)){
                        $_SESSION['mssg'] = "Booked successfully";
                        echo '<script>window.location.href = "../suggestionLocation.php"</script>';
                    }
                }

            } else {
                echo "<span style='margin-left: 500px; color: red'>Please Login First For Booking</span>";
            }
        ?>

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
    
    
</body>
</html>
<script src="../Responsive/responsives.js"></script>
