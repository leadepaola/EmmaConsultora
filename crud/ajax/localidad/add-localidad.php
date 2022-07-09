<?php
include('../../../functions/connection.php');

if (isset($_POST['nombre_localidad'])) {
    if (!empty($_POST['nombre_localidad'])) {

        $id_localidad = NULL;
        $nombre_localidad = $_POST['nombre_localidad'];

        if(strlen($nombre_localidad)<40){
            $sql = "INSERT INTO localidad(id_localidad,nombre_localidad) VALUES(?,?)";
            $stmt = $mysqli->prepare($sql);

            $stmt->bind_param("is", $id_localidad, $nombre_localidad);

            if ($stmt->execute()) {
                echo "exito";
                //$exitos[] = "Datos insertados con exito... Sera redireccionado en breve";                
            } else {
                echo $stmt->error;
            }
        }else{
            echo "error";
        }
        
    }else {
        echo "error";
    }
}
