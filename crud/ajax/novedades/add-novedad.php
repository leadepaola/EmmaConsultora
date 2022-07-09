<?php
    include('../../../functions/connection.php');
    
    if(isset($_POST['titulo']) && isset($_POST['descripcion']) && isset($_FILES['archivo']) && isset($_POST['url'])){
        
        $id_novedades = NULL;
        $titulo = trim(mysqli_real_escape_string($mysqli, $_POST['titulo']));
        $descripcion = mysqli_real_escape_string($mysqli, $_POST['descripcion']);
        $archivo = trim(mysqli_real_escape_string($mysqli, $_FILES["archivo"]["name"]));
        $url = mysqli_real_escape_string($mysqli, $_POST['url']);
        

        $carpeta = 'img-novedades/';
        $size = 1024 * 1024 * 10;

        if($_FILES["archivo"]['size'] < $size){
            $carpeta = 'img-novedades/';
            $tipo = $_FILES['archivo']['type'];
            $tipoNombre = $_FILES['archivo']['name'];
            $info = new SplFileInfo($tipoNombre);
            $infoExtension = $info->getExtension();
            $fecha = date('Ymd-His');
            
            if($tipo == "image/png" ){
                $archivoNombre = $carpeta.$fecha.".png";
            }else if( $tipo == "image/jpeg"){
                $archivoNombre = $carpeta.$fecha.".jpg";
            }

            $archivo = $archivoNombre;
            
            if(!file_exists($archivo)){
                $sql = "INSERT INTO novedades(id_novedades, imagen_novedades, titulo, link, descripcion_novedades) VALUES ('$id_novedades','$archivo','$titulo','$url','$descripcion')";

                // mysqli_query($mysqli,$sql);

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