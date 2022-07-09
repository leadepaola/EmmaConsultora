<?php
include('../../../functions/connection.php');

if (isset($_POST['nombre_rubro'])) {
    if (!empty($_POST['nombre_rubro'])) {

        $id_rubro = NULL;
        $nombre_rubro = $_POST['nombre_rubro'];

        if(strlen($nombre_rubro)<20){
            $sql = "INSERT INTO categorias(id_categoria,nombre_categoria) VALUES(?,?)";
            $stmt = $mysqli->prepare($sql);

            $stmt->bind_param("is", $id_rubro, $nombre_rubro);

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

?>
