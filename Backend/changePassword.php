<?php 
require_once("getData.php");
require_once("connection.php");

session_start();
if (isset($_POST['submitPassword'])){
    $token = $_POST['token'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirm_password'];

    if($password != $confirmPassword){
        $_SESSION['error'] = "Password Does not Matches";
        header("Location: ../Password/changePassword.php?token=$token");
    } else {
        $h_password = password_hash($password, PASSWORD_DEFAULT);
        $updateQ="UPDATE User Set Password='$h_password' WHERE token='$token'";
        $result1 = mysqli_query($conn, $updateQ);
        if($result1){
            $new_token = bin2hex(random_bytes(16));

            $updateToken = "UPDATE User Set token='$new_token' WHERE token='$token'";
            $result2 = mysqli_query($conn, $updateToken);
            if($result2){
                $_SESSION['success'] = "Successfully Updated Password";
                echo '<script>window.location.href = "../Login.php"</script>';
            }
        }
    }
}
?>