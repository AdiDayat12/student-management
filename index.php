<?php 
    require 'functions.php';

    $students = query();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Student Table</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <h1>STUDENT TABLE</h1>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>NO</th>
            <th>NAME</th>
            <th>EMAIL</th>
            <th>FACULTY</th>
            <th>OPTION</th>
        </tr>
        <?php $i = 1;?>
        <?php foreach ($students as $std) :?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $std -> name ?></td>
                <td><?= $std -> email ?></td>
                <td><?= $std -> faculty ?></td>
                <td>
                    <a href="update.php?id=<?= $std -> id ?>">Edit</a>
                    <a href="delete.php?id=<?= $std -> id ?>">Delete</a>
                </td>
                <?php $i++?>
            </tr>
            <?php endforeach?>

    </table>
    
    <div class="add-button" >
        <a href="insert.php" >Add Student</a>
    </div>
</body>
</html>