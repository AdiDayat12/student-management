<?php 
    require 'functions.php';

    if (isset($_POST['register'])){
        if (search($_POST)){
            if (register($_POST) > 0){
                echo "<script>
                alert ('Register successfull');
                window.location.href='index.php';
                </script>";
            }else {
                echo "<script>
                alert ('Failed to register');
                window.location.href='register.php';
                </script>";
            }
        }else{
            echo "<script>
                alert ('Email did not found');
                window.location.href='register.php';
                </script>";
        }
        
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
    <link rel="stylesheet" href="register-styles.css">
</head>
<body>
    <form action="" method="POST">
        <label for="email">Enter your email : </label>
        <input type="text" id="email" name="email">

        <label for="password">Enter your password :</label>
        <input type="password" id="password" name="password">

        <label for="password-confirm">Confirm your password :</label>
        <input type="password" id="password-confirm" name="password-confirm">
        
        <button type="submit" name="register">Register</button>

        <div class="login-link">
            <p>Already have an account? <a href="login.php">Login</a></p>
        </div>
    </form>
</body>
</html>