<?php 
    include('../../../functions/connection.php');

    $query = "SELECT * FROM cursos ORDER BY id_curso DESC";

    $result = mysqli_query($mysqli, $query);

    if(!$result){
        die('Query Failed'. mysqli_error($mysqli));
    }

    $json = array();

    while($curso = mysqli_fetch_array($result)){
        $json[] = array(
            'id_curso'=> $curso['id_curso'],
            'titulo'=> $curso['titulo'],
            'imagen_curso'=> $curso['imagen_curso'],
            'modalidad'=> $curso['modalidad'],
            'duracion'=> $curso['duracion'],
            'precio'=> $curso['precio'],
            'descripcion'=> $curso['descripcion'],
            'celular'=> $curso['celular']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

?>