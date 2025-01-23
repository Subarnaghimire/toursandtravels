<!DOCTYPE html>
<html lang="en">
  <head>
      <link rel="stylesheet" type="text/css" href="Responsive/responsive.css">
    <script type="text/javascript" src="Responsive/responsives.js"></script>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="stylesheet" href="Package/suggestionLocation.css">
      <link rel="stylesheet" type="text/css" href="Responsive/responsive.css">
    <script type="text/javascript" src="display/sweetalert.min.js"></script>
    <link rel="icon" href="./logo.png">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <script
      src="https://kit.fontawesome.com/97f454a94a.js"
      crossorigin="anonymous"
    ></script>
    <script type="text/javascript" src="display/icons.js"></script>
    <title>Packages</title>
  </head>
  <body>
    <?php 
    session_start();
    if (isset($_SESSION['mssg'])){
      echo '<script>swal("'.$_SESSION['mssg'].'", {icon: "success"})</script>';
      unset($_SESSION['mssg']);
    } else if (isset($_SESSION['canceled'])){
      echo '<script>swal("'.$_SESSION['canceled'].'", {icon: "error"})</script>';
      unset($_SESSION['canceled']);
    }

  ?>
    <div class="conatainer">
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
            <input type="text" placeholder="Search.." id="find" onkeyup="search()"> 
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

      <h1>Suggested Locations</h1>
      <div class="location_box">
      <?php 
        include "Backend/getData.php";
        $result = fetchPackages();
        while($row = mysqli_fetch_array($result)){
          echo '<div class="locations">';
          echo '<a href="Package/package-description.php?id='.$row['Package_id'].'">';
          echo '<img src="'.$row["ImageLink"].'">';
         
          echo '<div class="location">';

            echo "<h3>".$row['PackageName']."</h3>";
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
           
           echo '</div>';

           echo '<div class="location_name" id="locationName">';
            echo '<p>'.$row['LocationName'].'</p>';
             echo '<p>'."Rs ". $row['Price'].'</p>';
            
             
           echo '</div>';

           echo '<div class="location_price">';

            echo '<p><i class="fa-solid fa-person-hiking fa-2xl"></i>'.$row['PackageName'].'</p>';
            echo '<p><i class="fa-regular fa-calendar-days fa-2xl"></i>'.$row['Days'] ." Days".'</p>';

            echo '<p><i class="fas fa-tachometer-alt fa-2xl"></i>'.$row['Difficulty'].'</p>';
          echo '</div>';
                  echo '</a>';

        echo '</div>';
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
      <p>Copyright © 2024 Holiday Hype  All Rights Reserved.</p>
  </div>
</section>
</div>

<script type="text/javascript">
function search() {
    let filter = document.getElementById('find').value.toUpperCase();
    let item = document.querySelectorAll('.locations');
    let l = document.getElementsByTagName('h3');
    for(var i = 0;i<=l.length;i++){
      let a=item[i].getElementsByTagName('h3')[0];
      let value=a.innerHTML || a.innerText || a.textContent;
      if(value.toUpperCase().indexOf(filter) > -1) {
        item[i].style.display="";
      }else{
        item[i].style.display="none";
      }
    }
}
</script>
</body>
</html>
<script src="Responsive/responsives.js"></script>
