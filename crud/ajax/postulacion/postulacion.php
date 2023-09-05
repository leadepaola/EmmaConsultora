<?php
    include('../../../functions/connection.php');
    
        if(isset($_FILES["archivo"]) && isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["telefono"]) && isset($_POST["mensaje"]) && isset($_POST["id_empleo"]) && isset($_POST["nombre_empleo"])){
            $archivo = trim(mysqli_real_escape_string($mysqli, $_FILES["archivo"]["name"]));
            $carpeta = 'archivos/';
            $id_postulacion= NULL;
            $id_empleo = trim(mysqli_real_escape_string($mysqli, $_POST["id_empleo"]));
            $nombre = trim(mysqli_real_escape_string($mysqli, $_POST["nombre"]));
            $email = trim(mysqli_real_escape_string($mysqli, $_POST["email"]));
            $telefono = trim(mysqli_real_escape_string($mysqli, $_POST["telefono"]));
            $mensaje = trim(mysqli_real_escape_string($mysqli, $_POST["mensaje"]));
            $nombre_empleo = trim(mysqli_real_escape_string($mysqli, $_POST["nombre_empleo"]));
           
            $size = 1024 * 1024 * 10;

            if($_FILES["archivo"]['size'] < $size){

                $carpeta = 'archivos/';
                $tipo = $_FILES['archivo']['type'];
                $tipoNombre = $_FILES['archivo']['name'];
                $info = new SplFileInfo($tipoNombre);
                $infoExtension = $info->getExtension();
                $fecha = date('Ymd-His');

                if($tipo == "application/pdf"){
                    $archivoNombre = $carpeta.$fecha.".pdf";
                }else if( $tipo == "text/plain"){
                    $archivoNombre = $carpeta.$fecha.".txt";
                }else if($infoExtension == "docx"){
                    $archivoNombre = $carpeta.$fecha.".docx";
                }else if($infoExtension == "doc"){
                    $archivoNombre = $carpeta.$fecha.".doc";
                }

                $archivo = $archivoNombre;

                if(!file_exists($archivo)){
                    $sql = "INSERT INTO postulacion(id_postulacion, empleo_id, nombre, email, telefono, mensaje, curriculum) VALUES ('$id_postulacion','$id_empleo','$nombre','$email','$telefono','$mensaje','$archivo')";

                    $resultado = $mysqli->query($sql);

                    if($resultado) {
                        echo "exito";
                        if(move_uploaded_file($_FILES['archivo']['tmp_name'], $archivo)){
                        }else{
                            echo "Error en el archivo";
                        }
                        $to = "joelgdeveloper@gmail.com";
                        $subject = "Nueva Postulación a Empleo: ". $nombre_empleo;
                        
                        $message = "Se ha recibido una nueva postulación para el empleo: $nombre_empleo. \n\n";
                        $message .= "Nombre: $nombre \n";
                        $message .= "Email: $email \n";
                        $message .= "Teléfono: $telefono \n";
                        $message .= "Mensaje: $mensaje \n\n\n";
                        $message .= "Ingresa a la web para ver el CV de la persona";
                        $headers = "From:" ."Consultas-EMMA";   

                        mail($to,$subject,$message,$headers);
                    }else {
                        echo "Fallo en la postulacion";
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
