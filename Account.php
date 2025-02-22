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
    <link rel="stylesheet" type="text/css" href="Account/Acc_Style.css">
    <link rel="stylesheet" type="text/css" href="Responsive/responsive.css">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Paytone+One&family=Poppins:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://unpkg.com/boxicons@latest/css/boxicons.min.css">
    <!-- Include SweetAlert -->
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<?php
    session_start();
    if (isset($_SESSION['success'])){
        echo '<script>toastr.success("'.$_SESSION['success'].'");</script>';
        unset($_SESSION['success']);
    } else if (isset($_SESSION['error'])){
        echo '<script>toastr.error("'.$_SESSION['error'].'");</script>';
        unset($_SESSION['error']);
    } 
?>
    <div class="content" id="home"> 
        <nav class="wholenav hnav">
            <img src="logo.png" href="#" class="logo" alt="Logo" title="Holiday Hype" onclick="window.location.reload();">
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
                        echo '<a class="signup-btn" href="SignUp.php">Sign Up</a>';
                        echo '<a class="login-btn" href="Login.php">Login</a>';
                    }
                    ?>
                </div>
            </ul>
            <img src="Responsive/ham.png" alt="hambeger" class="burger">
        </nav>   
    </div>
    <div class="main">
        <div class="container">
            <div class="header">
                <div class="nav">
                    <div class="user"></div>
                </div>
            </div>
            <?php
                require_once "Backend/getData.php";
                $row = fetchUserData($_SESSION['id']);
            ?>
            <div class="content">
                <div class="card">
                    <div class="box">
                        <h3><img src="Account/edit.png">Edit Details</h3>
                    </div>
                    <form method="POST" action="">
                        <label for="name">Username:</label>
                        <input type="text" value="<?php echo $row['Username']; ?>" id="name" name="name" required>
                        <button class="button" name="submitUsername">Update Username</button>
                        <br><br>

                        <label for="email">Email Address:</label>
                        <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>">
                        <button class="button" name="submitEmail">Update Email</button>
                    </form>
                </div>

                <div class="card">
                    <div class="box">
                        <h3><img src="Account/edit.png">Update Password</h3>
                    </div>
                    <form method="POST" action="">
                        <label for="old_password">Old Password:</label>
                        <input type="text" placeholder="Old Password" id="old_password" name="old_password" required><br><br>
                        
                        <label for="new_password">New Password:</label>
                        <input type="text" id="new_password" placeholder="New Password" name="new_password" required><br><br>
                    
                        <button class="button" name="update">Change Password</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="Dassh">
        <img src="Account/userl.png" href="#" class="userl" alt="userl" title="User Profile">
        <h4><?php echo $row['Username']; ?></h4>
        <h5><?php echo $row['Email']; ?></h5>
        <ul>
            <li><a href="Account.php"><img src="Account/gene.png">General</a></li>
        </ul>
        <ul>
            <li><a onclick="confirmLogout()"><img src="Account/logout.png">Logout</a></li>
        </ul>
    </div>   
    
    <section class="footer">
        <div class="foot">
            <div class="footer-content">
                <div class="footlinks">
                    <h4>Quick Links</h4>
                    <ul>
                        <li><a class="aboutus" href="#">About Us</a></li>
                        <li><a href="#">Contact Us</a></li>
                    </ul>
                </div>

                <div class="footlink_social">
                    <h4>Connect</h4>
                    <div class="social">
                        <a href="https://www.facebook.com/" target="_blank"><i class='bx bxl-facebook'></i></a>
                        <a href="https://www.instagram.com/" target="_blank"><i class='bx bxl-instagram'></i></a>
                        <a href="https://www.twitter.com/" target="_blank"><i class='bx bxl-twitter'></i></a>
                        <a href="https://www.youtube.com/" target="_blank"><i class='bx bxl-youtube'></i></a>
                        <a href="https://www.tiktok.com/" target="_blank"><i class='bx bxl-tiktok'></i></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="end">
            <p>Copyright © 2023 Holiday Hype All Rights Reserved.</p>
        </div>
    </section>
    <script src="Responsive/responsives.js"></script>
    <script>
        // Function to confirm logout
        function confirmLogout() {
            Swal.fire({
                title: 'Are you sure?',
                text: 'You are about to log out.',
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, log out!'
            }).then((result) => {
                if (result.isConfirmed) {
                    window.location.href = 'Backend/logout.php';
                }
            });
        }
    </script>
</body>
</html>

<?php
require_once "Backend/addData.php";

if(isset($_POST['submitUsername'])){
    $username = $_POST['name'];

    if (updateUsername($_SESSION['id'], $username)){
        $_SESSION['success'] = "Username Updated Successfully";
        echo '<script>window.location.href = "Account.php"</script>';
    } else {
        $_SESSION['error'] = "Username Already Taken";
        echo '<script>window.location.href = "Account.php"</script>';
    }   
}

if(isset($_POST['submitEmail'])){
    $email = $_POST['email'];

    if (updateEmail($_SESSION['id'], $email)){
        $_SESSION['success'] = "Email Updated Successfully";
        echo '<script>window.location.href = "Account.php"</script>';
    } else {
        $_SESSION['error'] = "Email Already Taken";
        echo '<script>window.location.href = "Account.php"</script>';
    }
}

if(isset($_POST['update'])){
    $old_password = $_POST['old_password'];
    $new_password = $_POST['new_password'];

    if (updatePassword($_SESSION['id'], $old_password, $new_password)){
        $_SESSION['success'] = "Password Updated Successfully";
        echo '<script>window.location.href = "Account.php"</script>';
    } else {
        $_SESSION['error'] = "Wrong Password";
        echo '<script>window.location.href = "Account.php"</script>';
    }
}
?>