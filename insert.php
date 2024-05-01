<?php 
    require 'functions.php';
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        if (isset($_POST["add"])) {
            if (insert($_POST) > 0){       
                echo "<script>
                alert ('Data has been successfully added');
                window.location.href='index.php';
                </script>";
            }else {
                echo "<script>
                alert ('Failed to add data');
                window.location.href='index.php';
                </script>";
            }
        }
    }
    

?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Student</title>
    <link rel="stylesheet" href="insert-style.css">
</head>
<body>
    <h1>Insert Student Form</h1>
    <form action="" method="post" enctype="multipart/form-data" class="form-container">
        <div class="form-group">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="nameSubmit" required autofocus>
        </div>

        <div class="form-group">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="emailSubmit" required>
        </div>

        <div class="form-group">
            <label for="faculty">Faculty:</label><br>
            <input type="text" id="faculty" name="facultySubmit" required>
        </div>

        <div class="form-group">
            <button class="btn-submit" type="submit" name="add">Submit</button>
        </div>
    </form>
</body>
</html>
