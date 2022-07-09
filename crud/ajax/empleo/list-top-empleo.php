<?php 
    include('../../../functions/connection.php');

    $query = "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
    INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
    INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
    INNER JOIN rango ON empleos.rango_id = rango.id_rango
    ORDER BY id_empleo DESC limit 4";

    $result = mysqli_query($mysqli, $query);

    if(!$result){
        die('Query Failed'. mysqli_error($mysqli));
    }

    $json = array();

    

    while($empleos = mysqli_fetch_array($result)){
        $json[] = array(
            'id_empleo' => $empleos['id_empleo'],
            'titulo' => $empleos['titulo'],
            'nombre_categoria' => $empleos['nombre_categoria'],
            'disponibilidad_horaria' => $empleos['disponibilidad_horaria'],
            'nombre_localidad' => $empleos['nombre_localidad'],
            'rango_trabajo' => $empleos['rango_trabajo'],
            'descripcion' => $empleos['descripcion']
        );

    }
    
    $jsonstring = json_encode($json);
    echo $jsonstring;
?>