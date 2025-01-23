<?php
  require_once("Backend/addData.php");
  require_once("Backend/getData.php");
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script type="text/javascript" src="display/sweetalert.min.js"></script>
    <title>Ratings</title>
    <link rel="icon" href="./logo.png">
    <link rel="stylesheet" type="text/css" href="RatingReview/rating.css">
    <link rel="stylesheet" type="text/css" href="Responsive/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <script type="text/javascript" src="display/icons.js"></script>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet"
    href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
</head>
<body>
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
<div class="container">
      <div class="ratingBox">
          <h1>Rate this system</h1>
          <form method="POST" action="">
            <div class="stars">
              <input type="radio" name="rating" value="5" id="5-stars" required>
              <label for="5-stars">&#9733;</label>
              <input type="radio" name="rating" value="4" id="4-stars">
              <label for="4-stars">&#9733;</label>
              <input type="radio" name="rating" value="3" id="3-stars">
              <label for="3-stars">&#9733;</label>
              <input type="radio" name="rating" value="2" id="2-stars">
              <label for="2-stars">&#9733;</label>
              <input type="radio" name="rating" value="1" id="1-star">
              <label for="1-star">&#9733;</label>
            </div>

          <h2>Give Some Feedbacks</h2>

        <textarea  rows="5" cols="50" style="width: 371px; height: 226px;" name="feedback" required></textarea><br>

        <input type="submit" value="Submit" class="button" name="submit">

        </form>
        </div>

<div class="reviewBox">
  <h1>All Reviews</h1>
  <?php
  $result = fetchRatings();
  if (mysqli_num_rows($result) == 0) {
    echo "<span>No reviews to show</span>";
  } else {
    while ($row = mysqli_fetch_assoc($result)) {
  ?>
      <div class="review">
        <div class="name"><?php echo $row['Username'] ?></div>
        <div class="rating">
          <?php
          $stars = "";
          $rating = $row['Ratings'];
          for ($i = 1; $i <= 5; $i++) {
            if ($i <= $rating) {
              $stars .= "<i class='fas fa-star' style='color: #fec700;'></i>";
            } else {
              $stars .= "<i class='fa fa-star' style='color: grey;'></i>";
            }
          }
          echo $stars;
          ?>
        </div>
        <br>
        <div class="content">
          <p><?php echo fetchFeedbackById($row['User_Id']); ?></p>
        </div>
      </div>
      <br><hr><br>
  <?php
    }
  }
  ?>
</div>

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
<script src="Responsive/responsives.js"></script>


<?php
  if(isset($_POST['submit'])){
    if(isset($_SESSION['id'])){
      $rating = $_POST["rating"];
      $feedback = $_POST["feedback"];

      if(addRating($rating, $_SESSION['id']) and addFeedbacks($feedback, $_SESSION['id'])){
        echo '<script>swal("Successfully added Rating and Feedback", {icon: "success"})</script>';
      } else {
        echo '<script>swal("Already rated the system", {icon: "error"})</script>';
      }
    } else {
      $_SESSION['error'] = "Please Login First";
      header("Location: Login.php");
    }
  }
?>

