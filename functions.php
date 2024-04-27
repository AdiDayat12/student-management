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


?>