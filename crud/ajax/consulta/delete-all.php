<?php 
    include('../../../functions/connection.php');

    $sql = "TRUNCATE TABLE contacto";

    // $sql = "DELETE * FROM contacto";
    // $sql2 = "ALTER TABLE contacto AUTO_INCREMENT=1";
    $result = mysqli_query($mysqli, $sql);
    // $result2 = mysqli_query($mysqli, $sql2);

     if(!$result) {
        die('Query Failed'. mysqli_error($mysqli));;
    }
    // if(!$result2) {
    //     die('Query Failed'. mysqli_error($mysqli));;
    // }

    echo "Consultas Eliminadas";
    
?>