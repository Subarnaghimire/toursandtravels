<?php
    session_start();
    session_destroy();   
    session_start();
    $_SESSION['ok'] = "Logged out Successfully";
    echo '<script>window.location.href = "../index.php"</script>';
?>