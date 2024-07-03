<?php
session_start();
require 'functions.php';

if (isset($_POST['login'])) {
    if (login($_POST)) {
        $_SESSION['login'] = true;
        header("Location: index.php");
        exit();
    } else {
        // Jangan arahkan ke login.php di sini
        // echo "<script>alert('Login failed. Please check your credentials.');</script>";
        // header("Location: login.php");
        // exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link rel="stylesheet" href="login-styles.css">
</head>
<body>
    <form action="" method="POST">
        <label for="email">Enter your email:</label>
        <input type="text" id="email" name="email" required>

        <label for="password">Enter your password:</label>
        <input type="password" id="password" name="password" required>
        
        <button type="submit" name="login">Login</button>

        <div class="login-link">
            <p>Don't have an account? <a href="register.php">Register</a></p>
        </div>
    </form>
</body>
</html>
