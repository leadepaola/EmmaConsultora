<?php 
    include('../../../functions/connection.php');


    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        $query = "DELETE FROM localidad WHERE id_localidad  = $id";
        $result = mysqli_query($mysqli, $query);

        if(!$result) {
            die('Query Failed.');
        }

        echo "Rubro eliminado con exito";
    }
    
?>