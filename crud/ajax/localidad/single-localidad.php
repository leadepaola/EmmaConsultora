<?php 
    include('../../../functions/connection.php');
    $id = $_POST['id'];
    $query = "SELECT * FROM localidad WHERE id_localidad  = $id";
    
    $result = mysqli_query($mysqli, $query);

    if(!$result) {
        die("Consulta Fallida!");
    }

    $json = array();

    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'id_localidad' => $row['id_localidad'],
            'nombre_localidad' => $row['nombre_localidad']
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;


?>