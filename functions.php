<?php 
    $host = "localhost";
    $username = "root";
    $pass = "my1stmysql"; // use your own DB pass
    $dbname = "university"; // use your own DB 
    $conn = new mysqli($host, $username, $pass, $dbname);

    function query($query){
        global $conn;

        $stm = $conn->prepare($query);
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

        // take affected rows
        $affectedRows = $conn->affected_rows;
    
        // close statement
        $stm->close();
    
        // if operation success return affected rows
        if ($success) {
            return $affectedRows;
        } else {
            return -1; 
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

    function select($id){
        global $conn;
        $result = mysqli_query($conn, "SELECT * FROM student WHERE id = $id" );
        $data = mysqli_fetch_object($result);
        return $data;
    }

    function update($datas){
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
        
        if ($success){
            return $affectedRows;
        } else{
            return -1;
        }

    }

    //search

    function search($keyword){
        global $conn;
        
        $query = ("SELECT * FROM student WHERE name LIKE '%$keyword%' OR email LIKE '%$keyword%' OR faculty LIKE '%$keyword%'");
        
        return query($query);

    }

    



?>