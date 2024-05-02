<?php 
    require 'functions.php';
    $students = query("SELECT * FROM student");

    if (isset($_POST['search'])){
        $students = search($_POST['keyword']);
    }
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
    <form action="" method="post">
        <input type="text" placeholder="enter data" name="keyword">
        <button type="submit" name="search">search</button>
    </form>
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>NO</th>
            <th>NAME</th>
            <th>STUDENT ID</th>
            <th>EMAIL</th>
            <th>FACULTY</th>
            <th>OPTION</th>
        </tr>
        <?php $i = 1;?>
        <?php foreach ($students as $std) :?>
            <tr>
                <td><?= $i ?></td>
                <td><?= $std -> name ?></td>
                <td><?= student_id($std -> id)?></td>
                <td><?= $std -> email ?></td>
                <td><?= $std -> faculty ?></td>
                <td class="option">
                    <a href="update.php?idUpdate=<?= $std -> id ?>">Edit</a>
                    <a href="delete.php?idDelete=<?= $std -> id ?>">Delete</a>
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