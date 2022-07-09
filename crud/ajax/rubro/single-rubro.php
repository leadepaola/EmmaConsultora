<?php 
    include('../../../functions/connection.php');
    $id = $_POST['id'];
    $query = "SELECT * FROM categorias WHERE id_categoria = $id";
    
    $result = mysqli_query($mysqli, $query);

    if(!$result) {
        die("Consulta Fallida!");
    }

    $json = array();

    while($row = mysqli_fetch_array($result)){
        $json[] = array(
            'id_rubro' => $row['id_categoria'],
            'nombre_rubro' => $row['nombre_categoria']
        );
    }

    $jsonstring = json_encode($json[0]);
    echo $jsonstring;


?>