<?php
session_start();
if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "Please Login First";
    header("Location: Login.php");
    exit;
}

require_once("Backend/connection.php");
require_once("Backend/getData.php");

define('KHALTI_SECRET_KEY', '0bdd928dc04844d2a757b638d5ec8fc4');

// Function to initialize Khalti payment
function initializeKhaltiPayment($amount, $purchase_order_id)
{
    $url = "https://a.khalti.com/api/v2/epayment/initiate/";

    $data = array(
        'return_url' => 'http://localhost/ToursAndTravels/mybookings.php?payment_success=true&booking_id=' . $purchase_order_id,
        'website_url' => 'https://your-website.com',
        'amount' => $amount,
        'purchase_order_id' => $purchase_order_id,
        'purchase_order_name' => 'Hotel Booking',
    );

    $headers = array(
        'Authorization: Key ' . KHALTI_SECRET_KEY,
        'Content-Type: application/json'
    );

    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $url);
    curl_setopt($ch, CURLOPT_POST, 1);
    curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);

    $response = curl_exec($ch);
    curl_close($ch);

    return json_decode($response, true);
}

// Handle Payment Success
if (isset($_GET['payment_success']) && $_GET['payment_success'] == 'true') {
    $booking_id = mysqli_real_escape_string($conn, $_GET['booking_id']);
    $update_query = "UPDATE bookings SET status = 'paid' WHERE BookingsId = '$booking_id'";
    mysqli_query($conn, $update_query);
}

// Handle form submission for Khalti payment
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['pay_khalti'])) {
    $room_price = $_POST['room_price'];
    $purchase_order_id = $_POST['booking_id'];

    $response = initializeKhaltiPayment($room_price, $purchase_order_id);

    if (isset($response['payment_url'])) {
        header('Location: ' . $response['payment_url']);
        exit;
    } else {
        echo "<script>alert('Payment initialization failed');</script>";
    }
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Bookings</title>
    <link rel="stylesheet" href="Hotel_Booking/style.css">
    <link rel="stylesheet" href="Responsive/responsive.css">
    <link rel="icon" href="./logo.png">
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">
</head>
<style>
    .status--paid {
    background-color: #cce5ff;
    color: #004085;
}
</style>
<body>
    <nav class="wholenav hnav">
        <img src="logo.png" class="logo" alt="Logo" title="Holiday Hype" onclick="window.location.reload();">
        <div class="ho hide show">
            <a class="home" href="index.php">Home</a>
            <a class="package" href="suggestionLocation.php">Packages</a>
            <a class="booking" href="mybookings.php">My Bookings</a>
            <a class="hotel" href="hotel.php">Hotels</a>
        </div>
        <ul class="navbar hide show">
            <div>
                <?php if (isset($_SESSION['id'])): ?>
                    <div class="profile">
                        <a href="Account.php"><i class="fa-solid fa-user"></i></a>
                    </div>
                <?php else: ?>
                    <a class="signup-btn" href="SignUp.php">Sign Up</a>
                    <a class="login-btn" href="Login.php">Login</a>
                <?php endif; ?>
            </div>
        </ul>
        <img src="Responsive/ham.png" alt="hamburger" class="burger">
    </nav>

    <main>
        <section>
            <h2>My Bookings</h2>
            <hr>
            <?php
            // Fetch Bookings
            $result = fetchBookingsById($_SESSION['id']);

            if (mysqli_num_rows($result) < 1): ?>
                <div>
                    <p>No bookings to show</p>
                    <a href="suggestionLocation.php">Browse Packages</a>
                </div>
            <?php else: ?>
                <ul>
                    <?php while ($row = mysqli_fetch_assoc($result)): ?>
                        <li id="booking-<?php echo $row['BookingsId']; ?>">
                            <div>
                                <h3>Booking #<?php echo $row['BookingsId']; ?></h3>
                                <span class="status status--<?php echo strtolower($row['status']); ?>">
                                    <?php echo ucfirst($row['status']); ?>
                                </span>
                            </div>
                            <div>
                                <p>Package: <?php echo htmlspecialchars($row['PackageName']); ?></p>
                                <p>Booked Date: <?php echo date('F j, Y', strtotime($row['BookedDate'])); ?></p>
                                <p>Amount: NPR <?php echo number_format($row['Amount'], 2); ?></p>
                            </div>
                            <?php if ($row['status'] === 'approved'): ?>
                                <form action="" method="POST">
                                    <input type="hidden" name="room_price" value="<?php echo $row['Amount'] * 100; ?>">
                                    <input type="hidden" name="booking_id" value="<?php echo $row['BookingsId']; ?>">
                                    <button type="submit" name="pay_khalti" class="khalti-pay-btn"
                                        style="border: none; background: none; padding: 0;">
                                        <img src="LandingPage/khaltiLogo.png" alt="Khalti Logo" class="khalti-logo"
                                            style="height: 100px; width: 200px; border: none;">
                                    </button>

                                </form>
                            <?php endif; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </section>
    </main>

    <script>
        $(document).ready(function () {
            const urlParams = new URLSearchParams(window.location.search);
            const paymentSuccess = urlParams.get('payment_success');
            const bookingId = urlParams.get('booking_id');

            if (paymentSuccess === 'true') {
                toastr.success('Payment successful');

                // Update status display and hide Khalti button
                $('#booking-' + bookingId + ' .status')
                    .removeClass('status--approved')
                    .addClass('status--paid')
                    .text('Paid');
                $('#booking-' + bookingId + ' .khalti-pay-btn').hide();
            }
        });
    </script>
</body>

</html>