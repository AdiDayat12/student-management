<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
$host = "localhost";
$username = "root";
$pass = "my1stmysql"; // ganti dengan password database Anda
$dbname = "university"; // ganti dengan nama database Anda
$conn = new mysqli($host, $username, $pass, $dbname);

function query($query) {
    global $conn;
    $stm = $conn->prepare($query);
    if (!$stm) {
        die("Failed to prepare statement: " . $conn->error);
    }
    $stm->execute();
    $result = $stm->get_result();
    $datas = [];
    while ($row = $result->fetch_object()) {
        $datas[] = $row;
    }
    $stm->close();
    return $datas;
}

function insert($data) {
    global $conn;
    $name = htmlspecialchars($data['nameSubmit']);
    $email = htmlspecialchars($data['emailSubmit']);
    $faculty = htmlspecialchars($data['facultySubmit']);
    $stm = $conn->prepare("INSERT INTO student (name, email, faculty) VALUES (?, ?, ?)");
    if (!$stm) {
        die("Failed to prepare statement: " . $conn->error());
    }
    $stm->bind_param("sss", $name, $email, $faculty);
    $success = $stm->execute();
    $affectedRows = $conn->affected_rows;
    $stm->close();
    return $success ? $affectedRows : -1;
}

function student_id($id) {
    $student_id = '24' . str_pad($id, 6, '0', STR_PAD_LEFT);
    return $student_id;
}

function delete($id) {
    global $conn;
    $stm = $conn->prepare("DELETE FROM student WHERE id = ?");
    $stm->bind_param("i", $id);
    $success = $stm->execute();
    $affectedRows = $conn->affected_rows;
    $stm->close();
    return $success ? $affectedRows : -1;
}

function select($id) {
    global $conn;
    $result = mysqli_query($conn, "SELECT * FROM student WHERE id = $id");
    $data = mysqli_fetch_object($result);
    return $data;
}

function update($datas) {
    global $conn;
    $id = $datas['idUpdate'];
    $name = htmlspecialchars($datas['nameUpdate']);
    $email = htmlspecialchars($datas['emailUpdate']);
    $faculty = htmlspecialchars($datas['facultyUpdate']);
    $query = "UPDATE student SET name = ?, email = ?, faculty = ? WHERE id = ?";
    $stm = $conn->prepare($query);
    $stm->bind_param("sssi", $name, $email, $faculty, $id);
    $success = $stm->execute();
    $affectedRows = $conn->affected_rows;
    $stm->close();
    return $success ? $affectedRows : -1;
}

function search($data) {
    global $conn;
    $email = $data['email'];
    $result = query("SELECT * FROM student WHERE email = ?");
    if (!empty($result)) {
        $row = $result[0];
        return $row;
    }
    return null;
}

function register($data) {
    global $conn;
    $email = $data['email'];
    $pass = $data['password'];
    $pass2 = $data['password-confirm'];
    if ($pass != $pass2) {
        echo "<script>alert('Password did not match!');</script>";
        return false;
    }
    $pass_hash = password_hash($pass, PASSWORD_DEFAULT);
    $pre_stm = $conn->prepare("INSERT INTO users VALUES (?, ?)");
    $pre_stm->bind_param("ss", $email, $pass_hash);
    $pre_stm->execute();
    $affectedRows = $pre_stm->affected_rows;
    $pre_stm->close();
    return $affectedRows;
}

function login($data) {
    global $conn;
    $email = $data['email'];
    $pass = $data['password'];
    $stm = $conn->prepare("SELECT * FROM users WHERE email = ?");
    $stm->bind_param("s", $email);
    $stm->execute();
    $result = $stm->get_result();
    if ($result->num_rows > 0) {
        $row = $result->fetch_object();
        if (password_verify($pass, $row->password)) {
            $_SESSION['login'] = true;
            return true;
        } else {
            echo "<script>alert('Wrong password');</script>";
            return false;
        }
    } else {
        echo "<script>alert('Email not found');</script>";
        return false;
    }
}

function searchAjax ($query, $params = []){
    global $conn;

    $pre_stm = $conn->prepare($query);
    
    $types = str_repeat('s', count($params)); // Asumsi semua parameter adalah string
    $pre_stm->bind_param($types, ...$params);

    $pre_stm->execute();

    $result = $pre_stm->get_result();

    $data = [];
    while ($row = $result->fetch_object()){
        $data [] = $row;
    }

    $pre_stm->close();
    
    return $data;
}
?>
