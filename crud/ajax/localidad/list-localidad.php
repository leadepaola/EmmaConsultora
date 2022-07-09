<?php 
    include('../../../functions/connection.php');

    $query = "SELECT * from localidad ORDER BY id_localidad DESC";

    $result = mysqli_query($mysqli, $query);

    if(!$result){
        die('Query Failed'. mysqli_error($mysqli));
    }

    $json = array();

    while($localidades = mysqli_fetch_array($result)){
        $json[] = array(
            'id_localidad'=> $localidades['id_localidad'],
            'nombre_localidad'=> $localidades['nombre_localidad']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>
