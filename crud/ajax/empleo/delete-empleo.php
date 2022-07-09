<?php 
    include('../../../functions/connection.php');


    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        $query = "DELETE FROM empleos WHERE id_empleo = $id";
        $result = mysqli_query($mysqli, $query);

        if(!$result) {
            die('Query Failed.');
        }

        echo "exito";
    }
    
?>