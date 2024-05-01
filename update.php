<?php 
    require 'functions.php';
    $id = $_GET['idUpdate'];
    $student = select($id);
    if (isset($_POST['update'])){
        if (update($_POST) > 0){       
            echo "<script>
            alert ('Data has been successfully updated');
            window.location.href='index.php';
            </script>";
        }else {
            echo "<script>
            alert ('Failed to update data');
            window.location.href='index.php';
            </script>";
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
    <h1>Update Student Form</h1>
    <form action="" method="post" enctype="multipart/form-data" class="form-container">
        <input type="hidden" name="idUpdate" value="<?= $student->id ?>">
        <div class="form-group">
            <label for="name">Name:</label><br>
            <input type="text" id="name" name="nameUpdate" required autofocus value="<?= $student->name ?>">
        </div>

        <div class="form-group">
            <label for="email">Email:</label><br>
            <input type="email" id="email" name="emailUpdate" required value="<?= $student->email ?>">
        </div>

        <div class="form-group">
            <label for="faculty">Faculty:</label><br>
            <input type="text" id="faculty" name="facultyUpdate" required value="<?= $student->faculty ?>">
        </div>

        <div class="form-group">
            <button class="btn-submit" type="submit" name="update">Update</button>
        </div>
    </form>
</body>
</html>
