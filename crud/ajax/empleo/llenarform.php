<?php 
    include('../../../functions/connection.php');
    $nombreTabla = $_POST['nombreTabla'];
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];

    $query = "SELECT * from $nombreTabla";

    $result = mysqli_query($mysqli, $query);

    if(!$result){
        die('Query Failed'. mysqli_error($mysqli));
    }

    $json = array();

    while($registros = mysqli_fetch_array($result)){
        $json[] = array(
            'id'=> $registros[$id],
            'nombre'=> $registros[$nombre]
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>
