<?php 
    include('../../../functions/connection.php');

    if(isset($_POST['nombre_localidad']) && isset($_POST['id']) ){
        if(!empty($_POST['nombre_localidad'])){
            $id = $_POST['id'];
            $nombre_localidad = $_POST['nombre_localidad'];

            if(strlen($nombre_localidad)<40){
                $query = "UPDATE localidad SET nombre_localidad = '$nombre_localidad' WHERE id_localidad = '$id'";

                $result = mysqli_query($mysqli, $query);

                if(!$result) {
                    die('Fallo la consulta');
                }

                echo "exito";
            }else {
                echo "error";
            }

            
        }else {
            echo "error";
        }
        
    }

?>