<?php 
session_start();
if(!isset($_SESSION['idz'])){
    header("Location: ../index.php");
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="../display/sweetalert.min.js"></script>
    <script src="confirm.js"></script>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Dashboard/dash.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css">
    <title>Admin Panel</title>
</head>
<style>
        .cards {
            display: grid;
            grid-template-columns: repeat(auto-fit, minmax(250px, 1fr));
            gap: 20px;
            margin-bottom: 30px;
        }
        .card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            display: flex;
            justify-content: space-between;
            align-items: center;
            transition: transform 0.3s;
        }
        .card:hover {
            transform: translateY(-5px);
        }
        .analytics-grid {
            display: grid;
            grid-template-columns: repeat(2, 1fr);
            gap: 20px;
            margin-top: 30px;
        }
        .analytics-card {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .analytics-card h2 {
            margin-bottom: 20px;
            color: #333;
            font-size: 1.2em;
        }
        .list-item {
            display: flex;
            justify-content: space-between;
            padding: 10px 0;
            border-bottom: 1px solid #eee;
        }
        .list-item:last-child {
            border-bottom: none;
        }
        .badge {
            background: #e3f2fd;
            color: #1976d2;
            padding: 5px 10px;
            border-radius: 20px;
            font-size: 0.8em;
        }
</style>
<body>
  <?php 
    require_once "../Backend/getCount.php";
    if (isset($_SESSION['mssg'])){
      echo '<script>swal("'.$_SESSION['mssg'].'", {icon: "success"})</script>';
      unset($_SESSION['mssg']);
    }
  ?>
   <div class="Dassh">
        <div class="hype">  
            <img src ="../logo.png" href="#" class="logo" alt="Logo" title="Holiday Hype"
            onclick="window.location.reload();">
            <span>Holiday Hype</span>
        </div>
        <ul>
            <li><a href="dashboard.php"><img src="img/dashboard.png">Dashboard</a></li>
        </ul>
        <ul>
          <li><a href="Package.php"><img src="img/package.png">Package</a> </li>
        </ul>
        <ul>
          <li><a href="feedback.php" class="active"><img src="img/feedback.png">Feedback</a></li>
        </ul>
        <ul>
          <li><a href="Bookings.php"><img src="img/bookings.png">Bookings</a> </li>
        </ul>
        <ul>
          <li><a href="hotel.php"><img src="img/hotel.png">Hotel</a> </li>
        </ul>
        <ul>
          <li><a onclick="toLogout()"><img src="img/logout.png">Logout</a> </li>
        </ul>
    </div>
    <div class="container">
        <div class="header">
            <div class="nav">
                <div class="user">
                    <a>Admin Dashboard</a>
                </div>
            </div>
        </div>
        
        <div class="content">
            <!-- Summary Cards -->
            <div class="cards">
                <div class="card">
                    <div class="box">
                        <h1><?php echo getUserCount();?></h1>
                        <h3>Total Users</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-users fa-2x" style="color: #1976d2;"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1><?php echo getBookingCount();?></h1>
                        <h3>Total Bookings</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-calendar-check fa-2x" style="color: #388e3c;"></i>
                    </div>
                </div>
                <div class="card">
                    <div class="box">
                        <h1><?php echo getPackageCount();?></h1>
                        <h3>Total Packages</h3>
                    </div>
                    <div class="icon-case">
                        <i class="fas fa-box fa-2x" style="color: #f57c00;"></i>
                    </div>
                </div>
            </div>

            <!-- Analytics Grid -->
            <div class="analytics-grid">
                <!-- Most Booked Packages -->
                <div class="analytics-card">
                    <h2>Most Popular Packages</h2>
                    <?php
                    $popular_packages = getMostBookedPackages();
                    while($package = mysqli_fetch_assoc($popular_packages)) {
                        echo '<div class="list-item">
                                <span>'.$package['PackageName'].'</span>
                                <span class="badge">'.$package['booking_count'].' bookings</span>
                              </div>';
                    }
                    ?>
                </div>

                <!-- Top Customers -->
                <div class="analytics-card">
                    <h2>Top Customers</h2>
                    <?php
                    $top_customers = getTopCustomers();
                    while($customer = mysqli_fetch_assoc($top_customers)) {
                        echo '<div class="list-item">
                                <span>'.$customer['Username'].'</span>
                                <span class="badge">'.$customer['booking_count'].' bookings</span>
                              </div>';
                    }
                    ?>
                </div>

                <!-- Recent Signups -->
                <div class="analytics-card">
                    <h2>Recent Signups</h2>
                    <?php
                    $recent_signups = getRecentSignups();
                    while($user = mysqli_fetch_assoc($recent_signups)) {
                        echo '<div class="list-item">
                                <span>'.$user['Username'].'</span>
                              </div>';
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>
