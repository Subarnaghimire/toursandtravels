<?php
session_start();
include("connection.php");

if (isset($_POST['submit'])) {
    $username = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirm_password = $_POST['confirm_password'];

    // Validation patterns
    $username_pattern = "/^[a-zA-Z0-9]{4,20}$/";
    $email_pattern = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    // Validate inputs
    if (!preg_match($username_pattern, $username)) {
        $_SESSION['error'] = "Username should contain only letters and numbers (4-20 characters)";
        header("Location: ../SignUp.php");
        exit();
    }

    if (!preg_match($email_pattern, $email)) {
        $_SESSION['error'] = "Invalid Email Format";
        header("Location: ../SignUp.php");
        exit();
    }

    if (strlen($password) < 8) {
        $_SESSION['error'] = "Password should be at least 8 characters";
        header("Location: ../SignUp.php");
        exit();
    }

    if ($password !== $confirm_password) {
        $_SESSION['error'] = "Passwords do not match";
        header("Location: ../SignUp.php");
        exit();
    }

    // Check for existing users
    $stmt = $conn->prepare("SELECT * FROM User WHERE Username = ? OR Email = ?");
    $stmt->bind_param("ss", $username, $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $user = $result->fetch_assoc();
        $_SESSION['error'] = $user['Username'] === $username 
            ? "Username already taken" 
            : "Email already registered";
        header("Location: ../SignUp.php");
        exit();
    }

    // Hash password and create token
    $h_password = password_hash($password, PASSWORD_DEFAULT);
    $token = bin2hex(random_bytes(16));

    // Insert new user
    $insert_stmt = $conn->prepare("INSERT INTO User (Username, Email, Password, token, Role) VALUES (?, ?, ?, ?, 'User')");
    $insert_stmt->bind_param("ssss", $username, $email, $h_password, $token);

    if ($insert_stmt->execute()) {
        $_SESSION['success'] = "Account created successfully! Please login";
        header("Location: ../Login.php");
    } else {
        $_SESSION['error'] = "Registration failed: " . $conn->error;
        header("Location: ../SignUp.php");
    }

    $insert_stmt->close();
    $conn->close();
    exit();
}

// If someone tries to access this file directly
header("Location: ../SignUp.php");
exit();
?>
