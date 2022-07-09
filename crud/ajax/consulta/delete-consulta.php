<?php 
    include('../../../functions/connection.php');


    if(isset($_POST['id'])) {
        $id = $_POST['id'];

        $query = "DELETE FROM contacto WHERE id_contacto = $id";
        $result = mysqli_query($mysqli, $query);

        if(!$result) {
            die('Query Failed.');
        }

        echo "Consulta eliminada con exito";
    }
    
?>