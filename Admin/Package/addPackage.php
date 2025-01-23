<?php 
session_start();
if(!isset($_SESSION['idz'])){
    header("Location: ../../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../display/sweetalert.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="packageAdd.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Admin Panel</title>
</head>
<body>
  <?php 
    if (isset($_SESSION['mssg'])){
      echo '<script>swal("'.$_SESSION['mssg'].'", {icon: "success"})</script>';
      unset($_SESSION['mssg']);
    }
  ?>
    <div class="Dassh">
        <div class="hype">  
            <img src ="../../logo.png" href="#" class="logo" alt="Logo" title="Holiday Hype"
            onclick="window.location.reload();">
            <span>Holiday Hype</span>
        </div>
        <ul>
            <li><a href="../dashboard.php"><img src="../img/dashboard.png">Dashboard</a></li>
        </ul>
        <ul>
          <li><a href="../Package.php"><img src="../img/package.png">Package</a> </li>
        </ul>
        <ul>
          <li><a href="../feedback.php" class="active"><img src="../img/feedback.png">Feedback</a></li>
        </ul>
        <ul>
          <li><a href="../Bookings.php"><img src="../img/bookings.png">Bookings</a> </li>
        </ul>
        <ul>
          <li><a href="../hotel.php"><img src="../img/hotel.png">Hotel</a> </li>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="user">
                    <a>Add Packages</a>
                </div>
            </div>
        </div>
    <div class="content">
      <form method="POST" action="../../Backend/Package/add.php">
          <label for="package-name">Package Name:</label>
          <input type="text" id="package-name" name="package-name" required>

          <label for="total-days">Total Days:</label>
          <input type="number" id="total-days" name="total-days" required> 

          <label for="location">Location:</label>
          <input type="text" id="location" name="location" required>

          <label for="image-link">Image Link:</label>
          <input type="text" id="image-link" name="image-link" required>

          <label for="rating">Rating:</label>
          <input type="number" id="rating" name="rating" required>

          <label for="price">Price:</label>
          <input type="number" id="price" name="price" required>


          <label for="transportation">Transportation:</label>
          <input type="text" id="transportation" name="transportation"  required>

          <label for="accomodation">Accommodation:</label>
          <input type="text" id="accomodation" name="accomodation" required>

          <label for="difficulty">Difficulty:</label>
          <select id="difficulty" name="difficulty" class="input-field" required>
            <option value="">Select Difficulty</option>
            <option value="Easy">Easy</option>
            <option value="Moderate">Moderate</option>
            <option value="Challenging">Challenging</option>
          </select>

          <label for="about">About:</label>
          <textarea id="about" name="about" required></textarea>

          <label for="itinerary">Itinerary:</label>
          <textarea id="itinerary" name="itinerary" required></textarea>
        <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</div>
</div>
</body>
</html>