<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="./logo.png">
    <link rel="stylesheet" type="text/css" href="Hotel_Booking/hotelPage.css">
    <link rel="stylesheet" type="text/css" href="Responsive/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="text/javascript" src="display/icons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script
    src="https://kit.fontawesome.com/97f454a94a.js"
    crossorigin="anonymous"
  ></script>
    <title>HOTEL PAGE</title>
</head>
<body>
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
          <form action="/action_page.php" class="search_box hide show">
            <input type="hidden" placeholder="Search.."> 
          </form>
            <ul class="navbar hide show">
                <div>
                    <?php
                    session_start();
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
        <div class="title">
            <p>TOP HOTEL IN THE CITY</p>
        </div>

        <div class="choose">
            <p>CHOOSE HOTELS</p>
            <div class="search">
                <input class="search-button" id="find" type="text" placeholder="Search.." name="search" onkeyup="search()">
            </div>
        </div>
        
       <div class="scroll">
        <div class="contain">
        <?php
            require_once "Backend/getData.php";
            $result = fetchHotels();
            while($row=mysqli_fetch_assoc($result)){
        ?>
            <div class="hotel-info-grid">
                <div class="picture">
                    <img class="hotel-picture" src="<?php echo $row['HotelImage']; ?>">
                </div>
                <div class="hotel-info">
                    <p class="hotel-title">
                      <?php echo $row["HotelName"] ?>
                    </p>
                    <div class="hotel-grids">
                        <p class="hotel-author">
                            <i class="fa-solid fa-location-dot"></i><?php echo $row["HotelLocation"] ?>
                        </p>
                        <p class="hotel-author">
                            <i class="fas fa-phone"></i><?php echo $row["Contact"] ?>
                        </p>
                        <br>
                    </div>

                    <div class="services">
                        <p class="hotel-stats">
                            <?php echo $row["HotelDescription"] ?>
                        </p>
                    </div>
                    <br><br>

                    <div class="price">
                        <p class="hotel-price">
                            Rs <?php echo $row["HotelPrice"] ?>
                        </p>
                        <p class="hotel-stay">
                            1 Room/Night
                        </p>
                      
                    </div>
                  </div>
              </div>
              <br><br>
            <?php }?>
       </div>
    </div>

       <div class="footer">
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
    </div>
 </div>   

<script type="text/javascript">
function search() {
    let filter = document.getElementById('find').value.toUpperCase();
    let items = document.querySelectorAll('.hotel-info-grid');
    for (let i = 0; i < items.length; i++) {
        let title = items[i].getElementsByClassName('hotel-author')[0];
        let value = title.textContent || title.innerText;
        if (value.toUpperCase().indexOf(filter) > -1) {
            items[i].style.display = "";
        } else {
            items[i].style.display = "none";
        }
    }
}
</script>
</body>
</html>
<script src="Responsive/responsives.js"></script>
