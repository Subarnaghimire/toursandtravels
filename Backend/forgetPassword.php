<?php 
require_once("getData.php");
require_once("connection.php");

session_start();
if (isset($_POST['submit'])){
    $email = trim($_POST["email"]);

    $query = "SELECT * FROM User where Email='$email'";
    $result = mysqli_query($conn, $query);
    if(mysqli_num_rows($result) < 1){
        $_SESSION['errors'] = "No account found with this email";
        echo '<script>window.location.href = "../Password/forgetPassword.php"</script>';
    } else {
        $row = mysqli_fetch_assoc($result);
        $token = $row['token'];
        
        $to = $email;
        $subject = "Reset your password";
        $message = "Click the link below to reset your password:<br><br>";
        $message .= "https://travelsandtourz.000webhostapp.com/Password/changePassword.php?token=$token";
        $headers = "From: tourstravels01@gmail.com\r\n";
        $headers .= "Content-type: text/html\r\n";

        if(mail($to, $subject, $message, $headers)){
            $_SESSION['success'] = "A mail has been sent to you gmail. Please check it";
            header("Location: ../Password/forgetPassword.php");
        }
    }
}
?>