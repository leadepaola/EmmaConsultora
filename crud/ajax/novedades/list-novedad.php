<?php 
    include('../../../functions/connection.php');

    $query = "SELECT * FROM novedades ORDER BY id_novedades DESC";

    $result = mysqli_query($mysqli, $query);

    if(!$result){
        die('Query Failed'. mysqli_error($mysqli));
    }

    $json = array();

    while($postulacion = mysqli_fetch_array($result)){
        $json[] = array(
            'id_novedades'=> $postulacion['id_novedades'],
            'titulo'=> $postulacion['titulo'],
            'imagen_novedades'=> $postulacion['imagen_novedades'],
            'link'=> $postulacion['link'],
            'descripcion'=> $postulacion['descripcion_novedades']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

?>