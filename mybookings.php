<?php
session_start();
if (!isset($_SESSION['id'])) {
    $_SESSION['error'] = "Please Login First";
    header("Location: Login.php");
    exit;
}

require_once("Backend/connection.php");
require_once("Backend/getData.php");

define('KHALTI_SECRET_KEY', '3c8e1137eac34775b370fc04199f6cff');

// Function to initialize Khalti payment
function initializeKhaltiPayment($amount, $purchase_order_id)
{
    $url = "https://a.khalti.com/api/v2/epayment/initiate/";

    $data = array(
        'return_url' => 'http://localhost/final/ToursAndTravels/mybookings.php?payment_success=true&booking_id=' . $purchase_order_id,
        'website_url' => 'http://localhost/final/ToursAndTravels',
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
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['cancel_booking'])) {
    $booking_id = mysqli_real_escape_string($conn, $_POST['booking_id']);
    $user_id = $_SESSION['id'];

    // Debugging: Log the booking ID and user ID
    error_log("Canceling booking ID: $booking_id for user ID: $user_id");

    // Verify booking belongs to user and is approved
    $check_query = "SELECT * FROM bookings 
                    WHERE BookingsId = '$booking_id' 
                    AND User_Id = '$user_id'
                    AND status = 'approved'";
    $result = mysqli_query($conn, $check_query);

    if (mysqli_num_rows($result) > 0) {
        // Debugging: Log that the booking is found and can be canceled
        error_log("Booking found and can be canceled.");

        $delete_query = "DELETE FROM bookings WHERE BookingsId = '$booking_id'";
        if (mysqli_query($conn, $delete_query)) {
            $_SESSION['success'] = "Booking cancelled successfully!";
            // Debugging: Log success
            error_log("Booking canceled successfully.");
        } else {
            $_SESSION['error'] = "Error cancelling booking: " . mysqli_error($conn);
            // Debugging: Log SQL error
            error_log("SQL Error: " . mysqli_error($conn));
        }
    } else {
        $_SESSION['error'] = "Booking cannot be cancelled or does not exist!";
        // Debugging: Log that the booking cannot be canceled
        error_log("Booking cannot be canceled or does not exist.");
    }

    header("Location: mybookings.php");
    exit;
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
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/sweetalert2@11/dist/sweetalert2.min.css">

    <style>
    /* Body and Main Section Styling */
    body {
        font-family: 'Arial', sans-serif;
        background-color: #f4f4f9;
        color: #333;
        margin: 0;
        padding: 0;
    }

    main {
        padding: 20px;
        max-width: 1200px;
        margin: 0 auto;
    }

    section {
        background-color: #fff;
        padding: 20px;
        border-radius: 8px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    h2 {
        font-size: 24px;
        margin-bottom: 20px;
        color: #1e88e5;
    }

    hr {
        border: 0;
        height: 1px;
        background: #ddd;
        margin-bottom: 20px;
    }

    /* Bookings List Styling */
    ul {
        list-style-type: none;
        padding: 0;
    }

    li {
        background-color: #f9f9f9;
        margin-bottom: 15px;
        padding: 15px;
        border-radius: 8px;
        border: 1px solid #ddd;
        transition: box-shadow 0.3s ease;
    }

    li:hover {
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
    }

    li div {
        margin-bottom: 10px;
    }

    li h3 {
        font-size: 18px;
        margin: 0;
        color: #333;
    }

    .status {
        display: inline-block;
        padding: 5px 10px;
        border-radius: 15px;
        font-size: 14px;
        font-weight: bold;
        text-transform: capitalize;
    }

    .status--approved {
        background-color: #d4edda;
        color: #155724;
    }

    .status--paid {
        background-color: #cce5ff;
        color: #004085;
    }

    .status--pending {
        background-color: #fff3cd;
        color: #856404;
    }

    p {
        margin: 5px 0;
        color: #555;
    }

    /* Button Group Styling */
    .button-group {
        display: flex;
        gap: 10px;
        margin-top: 15px;
    }

    .button-group form {
        flex: 1;
    }

    .khalti-pay-btn, .cancel-btn {
        padding: 12px 20px;
        margin: 0;
        display: flex;
        justify-content: center;
        align-items: center;
        width: 100%;
        border: none;
        font-size: 16px;
        font-weight: bold;
        border-radius: 30px;
        cursor: pointer;
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .khalti-pay-btn {
        background-color: #1e88e5;
        color: white;
    }

    .khalti-pay-btn:hover {
        background-color: #1565c0;
        transform: scale(1.05);
    }

    .khalti-pay-btn:active {
        background-color: #0d47a1;
        transform: scale(0.98);
    }

    .cancel-btn {
        background-color: #dc3545;
        color: white;
    }

    .cancel-btn:hover {
        background-color: #c82333;
        transform: scale(1.05);
    }

    .cancel-btn:active {
        background-color: #bd2130;
        transform: scale(0.98);
    }

    /* Receipt Download Link Styling */
    .receipt-download a {
        display: inline-block;
        padding: 10px 20px;
        background-color: #4CAF50;
        color: white;
        text-decoration: none;
        border-radius: 5px;
        margin-top: 10px;
        transition: background-color 0.3s ease;
    }

    .receipt-download a:hover {
        background-color: #45a049;
    }
</style>
</head>

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
                                <p><strong>Package:</strong> <?php echo htmlspecialchars($row['PackageName']); ?></p>
                                <p><strong>Booked Date:</strong> <?php echo date('F j, Y', strtotime($row['BookedDate'])); ?>
                                </p>
                                <p><strong>Amount:</strong> NPR <?php echo number_format($row['Amount'], 2); ?></p>
                            </div>
                            <?php if ($row['status'] === 'approved'): ?>
                                <div class="button-group">
                                    <!-- Existing Khalti Payment Form -->
                                    <form action="" method="POST">
                                        <input type="hidden" name="room_price" value="<?php echo $row['Amount'] * 100; ?>">
                                        <input type="hidden" name="booking_id" value="<?php echo $row['BookingsId']; ?>">
                                        <button type="submit" name="pay_khalti" class="khalti-pay-btn">
                                            Pay With Khalti
                                        </button>
                                    </form>

                                    <form action="" method="POST" id="cancelForm-<?php echo $row['BookingsId']; ?>">
                                        <input type="hidden" name="booking_id" value="<?php echo $row['BookingsId']; ?>">
                                        <input type="hidden" name="cancel_booking" value="true">
                                        <button type="button" class="cancel-btn"
                                            data-booking-id="<?php echo $row['BookingsId']; ?>">
                                            Cancel Booking
                                        </button>
                                    </form>

                                </div>
                            <?php endif; ?>
                            <?php if ($row['status'] === 'paid'): ?>
                                <div class="receipt-download">
                                    <a href="generate_receipt.php?booking_id=<?php echo $row['BookingsId']; ?>"
                                        class="download-receipt-btn">
                                        <i class="fa-solid fa-download"></i> Download Receipt
                                    </a>
                                </div>
                            <?php endif; ?>
                        </li>
                    <?php endwhile; ?>
                </ul>
            <?php endif; ?>
        </section>
    </main>

    <script>
        $(document).ready(function () {
            // Handle cancel button click
            $('.cancel-btn').on('click', function () {
                const bookingId = $(this).data('booking-id');

                // Show SweetAlert2 confirmation
                Swal.fire({
                    title: 'Are you sure?',
                    text: "You won't be able to revert this!",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#3085d6',
                    cancelButtonColor: '#d33',
                    confirmButtonText: 'Yes, cancel it!'
                }).then((result) => {
                    if (result.isConfirmed) {
                        // Submit the form if confirmed
                        $('#cancelForm-' + bookingId).submit();
                    }
                });
            });

            // Handle payment success and other toasts
            const urlParams = new URLSearchParams(window.location.search);
            const paymentSuccess = urlParams.get('payment_success');
            const bookingId = urlParams.get('booking_id');

            if (paymentSuccess === 'true') {
                Swal.fire({
                    icon: 'success',
                    title: 'Payment successful',
                    showConfirmButton: false,
                    timer: 1500
                });

                // Update status display and hide Khalti button
                $('#booking-' + bookingId + ' .status')
                    .removeClass('status--approved')
                    .addClass('status--paid')
                    .text('Paid');
                $('#booking-' + bookingId + ' .khalti-pay-btn').hide();
            }

            <?php if (isset($_SESSION['success'])): ?>
                Swal.fire({
                    icon: 'success',
                    title: '<?php echo $_SESSION['success']; ?>',
                    showConfirmButton: false,
                    timer: 1500
                });
                <?php unset($_SESSION['success']); ?>
            <?php endif; ?>

            <?php if (isset($_SESSION['error'])): ?>
                Swal.fire({
                    icon: 'error',
                    title: '<?php echo $_SESSION['error']; ?>',
                    showConfirmButton: false,
                    timer: 1500
                });
                <?php unset($_SESSION['error']); ?>
            <?php endif; ?>
        });
    </script>
</body>

</html>