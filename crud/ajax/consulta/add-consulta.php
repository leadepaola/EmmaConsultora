<?php
    include('../../../functions/connection.php');
    require '../../../vendor/autoload.php';

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    if(isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['mensaje'])){
        $id = NULL;
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $telefono = trim($_POST['telefono']);
        $mensaje = trim($_POST['mensaje']);

        $to = "joelgdeveloper@gmail.com";
        $subject = "Tienen una consulta en la web - emmarecursoshumanos.com.ar";

        $message = $mensaje."\n\n\n".
                   "Nombre: ".$nombre."\n".
                   "Email: ".$email."\n".
                   "Telefono: ".$telefono;

        $sql = "INSERT INTO contacto(id_contacto,nombre,email,telefono,mensaje) VALUES(?,?,?,?,?)";
        $stmt = $mysqli->prepare($sql);
        $stmt->bind_param("issss", $id,$nombre,$email,$telefono,$mensaje);

        if($stmt->execute()){
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

                // Destinatarios
                $mail->setFrom('joeelrp14@gmail.com', 'Consultas-EMMA');
                $mail->addAddress($to);

                // Contenido
                $mail->isHTML(false); // Poner en true si el cuerpo es HTML
                $mail->Subject = $subject;
                $mail->Body    = $message;

                $mail->send();
                echo 'exito';
            } catch (Exception $e) {
                echo "Fallo en la consulta";
            }

        } else {
            echo "Fallo en la consulta";
        }
    } else {
        echo "Error en el envío, revisa que los campos estén bien completados";
    }        
?>