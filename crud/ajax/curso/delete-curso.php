<?php 
    include('../../../functions/connection.php');

    if(isset($_POST['id']) && isset($_POST['archivoId'])) {
        $archivoId = $_POST['archivoId'];
        $id = $_POST['id'];

        if (file_exists($archivoId)) {
            $success = unlink($archivoId);
            
            if ($success) {
                 echo "eliminado";
            }else{
                throw new Exception("Cannot delete $archivoId");
            }
        }else{
            echo "Archivo no existe";
        }

        $query = "DELETE FROM cursos WHERE id_curso = $id";
        $result = mysqli_query($mysqli, $query);

        if(!$result) {
            die('Query Failed.');
        }

        echo "exito";
     }
    
?>