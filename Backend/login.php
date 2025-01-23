<?php
    session_start();
    include "connection.php";

    if(isset($_POST['username']) && isset($_POST['password'])){
        $username = $_POST['username'];
        $password = $_POST['password'];

        $query = "SELECT * FROM User WHERE Username='$username'";

        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0){

            $user = mysqli_fetch_assoc($result);
            if (password_verify($password, $user['password'])){
                if ($user['Role'] == 'User'){
                    $_SESSION['id'] = $user['User_Id']; 
                    $_SESSION['ok'] = "Successfully logged in";
                    header("location: ../index.php");
                    exit();
                } else if ($user['Role'] == 'Admin'){
                    $_SESSION['idz'] = $user['User_Id'];
                    $_SESSION['ok'] = "Successfully logged in";
                    header("location: ../Admin/dashboard.php");
                    exit();
                }
            } else {
                $_SESSION['error'] = "Invalid Password";
                echo '<script>window.location.href = "../Login.php";</script>';
            }
            
        } else{
            $_SESSION['error'] = "Invalid Username";
            echo '<script>window.location.href = "../Login.php";</script>';
        }
    }
?>