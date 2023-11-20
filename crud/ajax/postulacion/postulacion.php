<?php
include('../../../functions/connection.php');
require '../../../vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

if (isset($_FILES["archivo"]) && isset($_POST["nombre"]) && isset($_POST["email"]) && isset($_POST["telefono"]) && isset($_POST["mensaje"]) && isset($_POST["id_empleo"])) {
    $archivo = trim(mysqli_real_escape_string($mysqli, $_FILES["archivo"]["name"]));
    $carpeta = 'archivos/';
    $id_postulacion = NULL;
    $id_empleo = trim(mysqli_real_escape_string($mysqli, $_POST["id_empleo"]));
    $nombre = trim(mysqli_real_escape_string($mysqli, $_POST["nombre"]));
    $email = trim(mysqli_real_escape_string($mysqli, $_POST["email"]));
    $telefono = trim(mysqli_real_escape_string($mysqli, $_POST["telefono"]));
    $mensaje = trim(mysqli_real_escape_string($mysqli, $_POST["mensaje"]));
    $size = 1024 * 1024 * 10;

    if ($_FILES["archivo"]['size'] < $size) {

        $tipo = $_FILES['archivo']['type'];
        $tipoNombre = $_FILES['archivo']['name'];
        $info = new SplFileInfo($tipoNombre);
        $infoExtension = $info->getExtension();
        $fecha = date('Ymd-His');

        if ($tipo == "application/pdf") {
            $archivoNombre = $carpeta . $fecha . ".pdf";
        } else if ($tipo == "text/plain") {
            $archivoNombre = $carpeta . $fecha . ".txt";
        } else if ($infoExtension == "docx") {
            $archivoNombre = $carpeta . $fecha . ".docx";
        } else if ($infoExtension == "doc") {
            $archivoNombre = $carpeta . $fecha . ".doc";
        }

        $archivo = $archivoNombre;

        if (!file_exists($archivo)) {
            $sql = "INSERT INTO postulacion(id_postulacion, empleo_id, nombre, email, telefono, mensaje, curriculum) VALUES ('$id_postulacion','$id_empleo','$nombre','$email','$telefono','$mensaje','$archivo')";
            $resultado = $mysqli->query($sql);

            if ($resultado) {

                if (move_uploaded_file($_FILES['archivo']['tmp_name'], $archivo)) {
                    // Enviar el correo usando PHPMailer
                    $mail = new PHPMailer(true);

                    try {
                        // Configuración del servidor
                        $mail->isSMTP();                                            
                        $mail->Host       = 'smtp.gmail.com';                     
                        $mail->SMTPAuth   = true;                                   
                        $mail->Username   = 'joelgdeveloper@gmail.com';                 
                        $mail->Password   = 'efpm dpjl ragc tapb';                            
                        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;        
                        $mail->Port       = 587;    
                        $to = 'joelgdeveloper@gmail.com';

                        // Destinatarios
                        $mail->setFrom('joeelrp14@gmail.com', 'Consultas-EMMA');
                        $mail->addAddress($to);

                        // Contenido
                        $mail->isHTML(false);
                        $mail->Subject = 'Nuevo postulante para el empleo ' . $id_empleo;
                        $mail->Body = $mensaje . "\n\n\n" . "Nombre: " . $nombre . "\n" . "Email: " . $email . "\n" . "Telefono: " . $telefono;
                        $mail->addAttachment($archivo);

                        $mail->send();
                        echo "exito";
                    } catch (Exception $e) {
                        echo "Error en el envío del correo: {$mail->ErrorInfo}";
                    }
                } else {
                    echo "Error en el archivo";
                }
            } else {
                echo "Fallo en la postulacion";
            }

        } else {
            echo "El archivo ya existe";
        }
    } else {
        echo "El archivo excede el tamaño permitido de 10mb";
    }

} else {
    echo "Error en el envio, revisa que los campos y el documento esten bien seleccionados";
}
?>
