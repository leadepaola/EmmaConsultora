<?php
    include('../../../functions/connection.php');

    if(isset($_POST['titulo']) && isset($_POST['categorias']) && isset($_POST['Disponibilidad']) && isset($_POST['localidad']) && isset($_POST['rango']) && isset($_POST['descripcion'])){
        
        $id_empleo= NULL;
        $titulo = trim(mysqli_real_escape_string($mysqli, $_POST['titulo']));
        $categorias = mysqli_real_escape_string($mysqli, $_POST['categorias']);
        $Disponibilidad = mysqli_real_escape_string($mysqli, $_POST['Disponibilidad']);
        $localidad = mysqli_real_escape_string($mysqli, $_POST['localidad']);
        $rango = mysqli_real_escape_string($mysqli, $_POST['rango']);
        $descripcion = trim(mysqli_real_escape_string($mysqli, $_POST['descripcion']));
        $fecha = date('d/m/Y');

        if (!empty($titulo) && !is_numeric($titulo) && !empty($descripcion) ) {
            $sql = "INSERT INTO empleos(id_empleo,titulo,categoria_id,disponibilidad_id,localidad_id,rango_id,descripcion,fecha_publicacion) VALUES('".$id_empleo."','".$titulo."','".$categorias."','".$Disponibilidad."','".$localidad."','".$rango."','".$descripcion."', '$fecha')";

            if(mysqli_query($mysqli,$sql)){
                echo "exito";
            }
        }else{
            echo "error";
        }  
    }else {
        echo "error";
    }

?>