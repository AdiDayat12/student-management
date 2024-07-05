<?php
session_start();
if (!isset($_SESSION['login']) || !$_SESSION['login']) {
    header("Location: login.php");
    exit();
}
require 'functions.php';
$students = query("SELECT * FROM student");

if (isset($_POST['search'])) {
    $students = search($_POST);
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
    <form action="" method="get">
        <input type="text" placeholder="search student ..." id="keyword">
        <button type="submit" name="search">Search</button>
    </form>
    <div id="container">
    <table border="1" cellpadding="10" cellspacing="0">
        <tr>
            <th>NO</th>
            <th>NAME</th>
            <th>STUDENT ID</th>
            <th>EMAIL</th>
            <th>FACULTY</th>
            <th>OPTION</th>
        </tr>
        <?php $i = 1; ?>
        <?php foreach ($students as $std) : ?>
            <tr>
                <td><?= $i ?></td>
                <td><?= htmlspecialchars($std->name) ?></td>
                <td><?= htmlspecialchars(student_id($std->id)) ?></td>
                <td><?= htmlspecialchars($std->email) ?></td>
                <td><?= htmlspecialchars($std->faculty) ?></td>
                <td class="option">
                    <a href="update.php?idUpdate=<?= htmlspecialchars($std->id) ?>">Edit</a>
                    <a href="delete.php?idDelete=<?= htmlspecialchars($std->id) ?>">Delete</a>
                </td>
                <?php $i++ ?>
            </tr>
        <?php endforeach ?>
    </table>
    <div class="add-button">
        <a href="insert.php">Add Student</a>
    </div>
    </div>
    <script src="script.js"></script>
</body>
</html>
