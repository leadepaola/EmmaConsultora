<?php
    include('../../../functions/connection.php');

    if(isset($_POST['nombre']) && isset($_POST['email']) && isset($_POST['telefono']) && isset($_POST['mensaje'])){
        $id = NULL;
        $nombre = trim($_POST['nombre']);
        $email = trim($_POST['email']);
        $telefono = trim($_POST['telefono']);
        $mensaje = trim($_POST['mensaje']);

        $to = "emmatalentos@gmail.com";
        $subject = "Tienen una consulta en la web - emmarecursoshumanos.com.ar";
        
        $message = $mensaje."\n\n\n".
                   "Nombre: ".$nombre."\n".
                   "Email: ".$email."\n".
                   "Telefono: ".$telefono;
        $headers = "From:" ."Consultas-EMMA";     

        $sql = "INSERT INTO contacto(id_contacto,nombre,email,telefono,mensaje) VALUES(?,?,?,?,?)";

        $stmt = $mysqli->prepare($sql);

        $stmt->bind_param("issss", $id,$nombre,$email,$telefono,$mensaje);
       
        if($stmt->execute()){
            echo 'exito';
            mail($to,$subject,$message,$headers);
        }else{
            echo "Fallo en la consulta";
        }
    }else{
        echo "Error en el envio, revisa que los campos esten bien completados";
    }
        
?>