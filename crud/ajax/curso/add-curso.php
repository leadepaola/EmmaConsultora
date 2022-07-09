<?php
    include('../../../functions/connection.php');

    if(isset($_POST['titulo']) && isset($_FILES['archivo']) && isset($_POST['modalidad']) && isset($_POST['duracion']) && isset($_POST['precio']) && isset($_POST['descripcion'])){
        
        $id_curso = NULL;
        $titulo = trim(mysqli_real_escape_string($mysqli, $_POST['titulo']));
       
        $archivo = trim(mysqli_real_escape_string($mysqli, $_FILES["archivo"]["name"]));
        $modalidad = mysqli_real_escape_string($mysqli, $_POST['modalidad']);
        $duracion = mysqli_real_escape_string($mysqli, $_POST['duracion']);
        $precio = mysqli_real_escape_string($mysqli, $_POST['precio']);
        $descripcion = mysqli_real_escape_string($mysqli, $_POST['descripcion']);
        $telefono = mysqli_real_escape_string($mysqli, $_POST['telefono']);

        // echo "$id_curso $titulo $fecha $archivo $modalidad $duracion $precio $descripcion";

        $size = 1024 * 1024 * 10;

        if($_FILES["archivo"]['size'] < $size){
            $carpeta = 'img-curso/';
            $tipo = $_FILES['archivo']['type'];
            $tipoNombre = $_FILES['archivo']['name'];
            $info = new SplFileInfo($tipoNombre);
            $infoExtension = $info->getExtension();
            $fechaArchivo = date('Ymd-His');

            if($tipo == "image/png" ){
                $archivoNombre = $carpeta.$fechaArchivo.".png";
            }else if( $tipo == "image/jpeg"){
                $archivoNombre = $carpeta.$fechaArchivo.".jpg";
            }

            $archivo = $archivoNombre;

            if(!file_exists($archivo)){
                $sql = "INSERT INTO cursos(id_curso, titulo, imagen_curso, modalidad,duracion,precio,descripcion,celular) VALUES ('$id_curso','$titulo','$archivo','$modalidad' ,'$duracion','$precio','$descripcion','$telefono')";

                $resultado = $mysqli->query($sql);

                if($resultado) {
                    if(move_uploaded_file($_FILES['archivo']['tmp_name'], $archivo)){
                        echo "exito";                        
                    }else{
                        echo "Error en el archivo";
                    }
                }else {
                    echo "Fallo en la insercion";
                }
            }else{
                echo "El archivo ya existe";
            }
        }else{
            echo "El archivo excede el tamaño permitido de 10mb";
        } 
    }else{
        echo "Error en el envio, revisa que los campos y el documento esten bien seleccionados";
    }
   

    


?>