<?php 
    require 'functions.php';

    if (delete($_GET['idDelete']) > 0){
        echo "<script>
                alert ('Data has been successfully deleted');
                window.location.href='index.php';
                </script>";
    } else {
        echo "<script>
                alert ('Failed to delete data');
                window.location.href='index.php';
                </script>";
    }

?>