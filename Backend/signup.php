<?php
include ("connection.php");
session_start();

$username = $_SESSION['username'];
$email = $_SESSION['email'];
$h_password = $_SESSION['password'];

$token = bin2hex(random_bytes(16));

if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM User where Username='$username'")) > 0){     
    $_SESSION['error'] = "Username Already Taken!!";
} else if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM User where Email='$email'")) > 0){
    $_SESSION['error'] = "Email Already Taken";
}else{
    session_destroy();
    $insert_query = "INSERT INTO User(Username, Email, Password,token,Role) VALUES ('$username', '$email', '$h_password','$token','User')";
    if(mysqli_query($conn, $insert_query)){
        session_start();
        $_SESSION['success'] = "Congratulations!! Your account has been created.";
        echo '<script>window.location.href = "../Login.php"</script>';
    }
}
echo '<script>window.location.href = "../SignUp.php"</script>';
?>