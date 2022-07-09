<?php 
    include('../../../functions/connection.php');

    $query = "SELECT postulacion.id_postulacion, empleos.titulo, postulacion.nombre,
                postulacion.email, postulacion.mensaje, postulacion.curriculum FROM postulacion INNER JOIN
                empleos ON postulacion.empleo_id = empleos.id_empleo ORDER BY id_postulacion DESC";

    $result = mysqli_query($mysqli, $query);

    if(!$result){
        die('Query Failed'. mysqli_error($mysqli));
    }

    $json = array();

    while($postulacion = mysqli_fetch_array($result)){
        $json[] = array(
            'id_postulacion'=> $postulacion['id_postulacion'],
            'titulo_empleo'=> $postulacion['titulo'],
            'nombre'=> $postulacion['nombre'],
            'email'=> $postulacion['email'],
            'mensaje'=> $postulacion['mensaje'],
            'curriculum'=> $postulacion['curriculum']
        );
    }

    $jsonstring = json_encode($json);
    echo $jsonstring;

?>