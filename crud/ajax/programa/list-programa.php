<?php 
    include('../../../functions/connection.php');

    $query = "SELECT * FROM programas ORDER BY id_programa DESC";

    $result = mysqli_query($mysqli, $query);

    if(!$result){
        die('Query Failed'. mysqli_error($mysqli));
    }

    $json = array();

    while($programa = mysqli_fetch_array($result)){
        $json[] = array(
            'id_programa'=> $programa['id_programa'],
            'titulo'=> $programa['titulo'],
            'imagen_programa'=> $programa['imagen_programa'],
            'descripcion'=> $programa['descripcion'],
            'celular'=> $programa['celular']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

?>