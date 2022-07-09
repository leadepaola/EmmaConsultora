<?php 
    include('../../../functions/connection.php');

    if(isset($_POST['nombre_rubro']) && isset($_POST['id']) ){
        if(!empty($_POST['nombre_rubro'])){
            $id = $_POST['id'];
            $nombre_rubro = $_POST['nombre_rubro'];

            if(strlen($nombre_rubro)<20){
                $query = "UPDATE categorias SET nombre_categoria = '$nombre_rubro' WHERE id_categoria = '$id'";

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