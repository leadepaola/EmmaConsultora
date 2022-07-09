<?php 
    include('../../../functions/connection.php');

    $query = "SELECT * from categorias ORDER BY id_categoria DESC";

    $result = mysqli_query($mysqli, $query);

    if(!$result){
        die('Query Failed'. mysqli_error($mysqli));
    }

    $json = array();

    while($rubros = mysqli_fetch_array($result)){
        $json[] = array(
            'id_rubro'=> $rubros['id_categoria'],
            'nombre_rubro'=> $rubros['nombre_categoria']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;
?>
