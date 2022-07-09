<?php 
    include('../../../functions/connection.php');

    $query = "SELECT * from contacto id_postulacion ORDER BY id_contacto DESC";

    $result = mysqli_query($mysqli, $query);
    

    if(!$result){
        die('Query Failed'. mysqli_error($mysqli));
    }

    $json = array();

    while($consultas = mysqli_fetch_array($result)){
        $json[] = array(
            'id'=> $consultas['id_contacto'],
            'nombre'=> $consultas['nombre'],
            'email'=> $consultas['email'],
            'telefono'=> $consultas['telefono'],
            'mensaje'=> $consultas['mensaje'],
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>
