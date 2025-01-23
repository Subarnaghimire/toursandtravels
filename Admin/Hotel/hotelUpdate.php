<?php 
session_start();
if(!isset($_SESSION['idz'])){
    header("Location: ../../index.php");
}
require_once "../../Backend/getData.php";
$id=$_GET['id'];
$row = fetchHotelByid($id);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../display/sweetalert.min.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="hotelAdd.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Admin Panel</title>
</head>
<body>
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
                    <a>Update Hotels</a>
                </div>
            </div>
        </div>
            <input type="text" id="package-name" name="package-name" >
    <div class="content">
      <form method="POST" action="../../Backend/Hotel/update.php">
          <input type="hidden" name="id" value="<?php echo $id; ?>">


          <label for="hotel-name">Hotel Name:</label>
          <input type="text" id="hotel-name" name="hotel-name" value=<?php echo $row['HotelName']; ?> required>

          <label for="location">Location:</label>
          <input type="text" id="location" name="location" value=<?php echo $row['HotelLocation']; ?> required>

          <label for="image-link">Image Link:</label>
          <input type="text" id="image-link" name="image-link" value=<?php echo $row['HotelImage']; ?> required>

          <label for="hotel-price">Price:</label>
          <input type="text" id="hotel-price" name="hotel-price" value=<?php echo $row['HotelPrice']; ?> required>

          <label for="hotel-contact">Contact:</label>
          <input type="text" id="hotel-contact" name="contact" value=<?php echo $row['Contact']; ?> required>

          <label for="about">Description:</label>
          <textarea id="about" name="about"  required><?php echo $row['HotelDescription']; ?></textarea>

        <button type="submit" name="submit">Submit</button>
        </form>
    </div>
</div>
</div>
</body>
</html>