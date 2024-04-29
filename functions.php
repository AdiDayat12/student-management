<?php 
    $host = "localhost";
    $username = "root";
    $pass = "my1stmysql"; // use your own DB pass
    $dbname = "university"; // use your own DB 
    $conn = new mysqli($host, $username, $pass, $dbname);

    function query(){
        global $conn;

        $stm = $conn->prepare("SELECT * FROM student");
        if (!$stm){
            die("Failed to prepare statement : " .$conn->error());
        }

        $stm->execute();

        $result = $stm->get_result();

        $datas = [];

        while ($row = $result->fetch_object()){
            $datas[] = $row;
        }

        $stm->close();
        
        return $datas;
    }

    function insert($data){
        global $conn;
        $name = htmlspecialchars($data['nameSubmit']);
        $email = htmlspecialchars($data['emailSubmit']);
        $faculty = htmlspecialchars($data['facultySubmit']);

        $stm = $conn->prepare("INSERT INTO student (name, email, faculty) VALUES (?, ?, ?)");

        if (!$stm){
            die("Failed to prepare statement : " .$conn->error());
        }

        $stm->bind_param("sss", $name, $email, $faculty);

        $success = $stm->execute();

        // Ambil jumlah baris yang terpengaruh
        $affectedRows = $conn->affected_rows;
    
        // Tutup statement
        $stm->close();
    
        // Jika operasi berhasil, kembalikan jumlah baris yang terpengaruh
        if ($success) {
            return $affectedRows;
        } else {
            // Jika operasi gagal, Anda bisa mengembalikan nilai lain atau melemparkan pengecualian (exception)
            return -1; // Nilai ini dapat diubah sesuai kebutuhan Anda
        }
    }


    function student_id($id){
        $student_id = '24'. str_pad($id, 6, '0', STR_PAD_LEFT);
        return $student_id;
    }
    

    function delete($id){
        global $conn;

        $stm = $conn->prepare("DELETE FROM student WHERE id = $id");

        $success = $stm->execute();
        
        $affectedRows = $conn->affected_rows;

        $stm->close();

        if ($success){
            return $affectedRows;
        }else {
            return -1;
        }
    }

    



?>