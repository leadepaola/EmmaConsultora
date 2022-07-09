<?php 
    include('../../../functions/connection.php');
    
    $paginaActual = $_POST['partida'];
    $categoria_id = $_POST['categoria'];
    $disponibilidad_id = $_POST['disponibilidad'];
    $localidad_id = $_POST['localidad'];
    $rango_id = $_POST['rango'];

    $consulta = '';
    
    // 1. 0000
    if($categoria_id == 0 && $disponibilidad_id == 0 && $localidad_id == 0 && $rango_id == 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos");
    }

    // 2. 0001
    if($categoria_id == 0 && $disponibilidad_id == 0 && $localidad_id == 0 && $rango_id != 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE rango_id  = $rango_id");
    }

    // 3. 0010
    if($categoria_id == 0 && $disponibilidad_id == 0 && $localidad_id != 0 && $rango_id == 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE localidad_id  = $localidad_id");
    }

    // 4. 0011

    if($categoria_id == 0 && $disponibilidad_id == 0 && $localidad_id != 0 && $rango_id != 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE localidad_id  = $localidad_id AND rango_id = $rango_id ");
    }

    //5. 0100
    if($categoria_id == 0 && $disponibilidad_id != 0 && $localidad_id == 0 && $rango_id == 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE disponibilidad_id  = $disponibilidad_id");
    }

    //6. 0101
    if($categoria_id == 0 && $disponibilidad_id != 0 && $localidad_id == 0 && $rango_id != 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE disponibilidad_id  = $disponibilidad_id AND rango_id = $rango_id");
    }

    //7. 0110
    if($categoria_id == 0 && $disponibilidad_id != 0 && $localidad_id != 0 && $rango_id == 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE disponibilidad_id  = $disponibilidad_id AND localidad_id = $localidad_id");
    }

    //8. 0111
    if($categoria_id == 0 && $disponibilidad_id != 0 && $localidad_id != 0 && $rango_id != 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE disponibilidad_id  = $disponibilidad_id AND localidad_id = $localidad_id AND rango_id = $rango_id ");
    }

    //9. 1000
    if($categoria_id != 0 && $disponibilidad_id == 0 && $localidad_id == 0 && $rango_id == 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE categoria_id  = $categoria_id");
    }

    //10. 1001
    if($categoria_id != 0 && $disponibilidad_id == 0 && $localidad_id == 0 && $rango_id != 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE categoria_id  = $categoria_id AND rango_id = $rango_id ");
    }

    //11. 1010
    if($categoria_id != 0 && $disponibilidad_id == 0 && $localidad_id != 0 && $rango_id == 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE categoria_id  = $categoria_id AND localidad_id = $localidad_id");
    }

    //12. 1011

    if($categoria_id != 0 && $disponibilidad_id == 0 && $localidad_id != 0 && $rango_id != 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE categoria_id  = $categoria_id AND localidad_id = $localidad_id AND rango_id = $rango_id ");
    }

    //13. 1100

    if($categoria_id != 0 && $disponibilidad_id != 0 && $localidad_id == 0 && $rango_id == 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE categoria_id  = $categoria_id AND disponibilidad_id = $disponibilidad_id");
    }

    //14. 1101

    if($categoria_id != 0 && $disponibilidad_id != 0 && $localidad_id == 0 && $rango_id != 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE categoria_id  = $categoria_id AND disponibilidad_id = $disponibilidad_id AND rango_id = $rango_id ");
    }

    //15. 1110

    if($categoria_id != 0 && $disponibilidad_id != 0 && $localidad_id != 0 && $rango_id == 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE categoria_id  = $categoria_id AND disponibilidad_id = $disponibilidad_id AND localidad_id = $localidad_id ");
    }

    //16. 1111

    if($categoria_id != 0 && $disponibilidad_id != 0 && $localidad_id != 0 && $rango_id != 0){ 
        $consulta = mysqli_query($mysqli, "SELECT * FROM empleos WHERE categoria_id  = $categoria_id AND disponibilidad_id = $disponibilidad_id AND localidad_id = $localidad_id AND rango_id = $rango_id");
    }


    $nroProductos = mysqli_num_rows($consulta);

    $nroLotes = 6;
    $nroPaginas = ceil($nroProductos/$nroLotes);
    $lista = '';
    $tabla = '';
    if($paginaActual > 1) {
        $lista = $lista.'<li class="page-item" >
            <a class="page-link" aria-label="Previous" href="javascript:pagination('.($paginaActual-1).');">
                <span aria-hidden="true">&laquo;</span>
                <span class="sr-only">Previous</span>
            </a>
        </li>
        ';
    }

    for($i=1; $i<=$nroPaginas;$i++){
        if($i == $paginaActual){
            $lista = $lista.'<li class="active page-item item"><a class="page-link" href="javascript:pagination('.$i.');">'.$i.'</a></li>';
        }else{
            $lista = $lista.'<li class="page-item"><a class="page-link" href="javascript:pagination('.$i.');">'.$i.'</a></li>';
        }
    }

    if($paginaActual<$nroPaginas){
        $lista = $lista.'<li class="page-item">
                <a class="page-link" aria-label="Next" href="javascript:pagination('.($paginaActual+1).');">
                    <span aria-hidden="true">&raquo;</span>
                    <span class="sr-only">Next</span>
                </a>
            </li>';
    }

    if($paginaActual <=1){
        $limit = 0;
    }else{
        $limit = $nroLotes*($paginaActual-1);
    }

    // // //FILTRO

    $query = '';

    // 1. 0000
    if($categoria_id == 0 && $disponibilidad_id == 0 && $localidad_id == 0 && $rango_id == 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    // 2. 0001
    if($categoria_id == 0 && $disponibilidad_id == 0 && $localidad_id == 0 && $rango_id != 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE rango_id  = $rango_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    // 3. 0010
    if($categoria_id == 0 && $disponibilidad_id == 0 && $localidad_id != 0 && $rango_id == 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE localidad_id  = $localidad_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    // 4. 0011
    if($categoria_id == 0 && $disponibilidad_id == 0 && $localidad_id != 0 && $rango_id != 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE localidad_id  = $localidad_id AND rango_id = $rango_id 
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    //5. 0100
    if($categoria_id == 0 && $disponibilidad_id != 0 && $localidad_id == 0 && $rango_id == 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE disponibilidad_id  = $disponibilidad_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    //6. 0101
    if($categoria_id == 0 && $disponibilidad_id != 0 && $localidad_id == 0 && $rango_id != 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE disponibilidad_id  = $disponibilidad_id AND rango_id = $rango_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    //7. 0110
    if($categoria_id == 0 && $disponibilidad_id != 0 && $localidad_id != 0 && $rango_id == 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE disponibilidad_id  = $disponibilidad_id AND localidad_id = $localidad_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    //8. 0111
    if($categoria_id == 0 && $disponibilidad_id != 0 && $localidad_id != 0 && $rango_id != 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE disponibilidad_id  = $disponibilidad_id AND localidad_id = $localidad_id AND rango_id = $rango_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    //9. 1000
    if($categoria_id != 0 && $disponibilidad_id == 0 && $localidad_id == 0 && $rango_id == 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE categoria_id  = $categoria_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    //10. 1001
    if($categoria_id != 0 && $disponibilidad_id == 0 && $localidad_id == 0 && $rango_id != 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE categoria_id  = $categoria_id AND rango_id = $rango_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    //11. 1010
    if($categoria_id != 0 && $disponibilidad_id == 0 && $localidad_id != 0 && $rango_id == 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE categoria_id  = $categoria_id AND localidad_id = $localidad_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    //12. 1011
    if($categoria_id != 0 && $disponibilidad_id == 0 && $localidad_id != 0 && $rango_id != 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE categoria_id  = $categoria_id AND localidad_id = $localidad_id AND rango_id = $rango_id 
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    //13. 1100
    if($categoria_id != 0 && $disponibilidad_id != 0 && $localidad_id == 0 && $rango_id == 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE categoria_id  = $categoria_id AND disponibilidad_id = $disponibilidad_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }
    
    //14. 1101
    if($categoria_id != 0 && $disponibilidad_id != 0 && $localidad_id == 0 && $rango_id != 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE categoria_id  = $categoria_id AND disponibilidad_id = $disponibilidad_id AND rango_id = $rango_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    //15. 1110
    if($categoria_id != 0 && $disponibilidad_id != 0 && $localidad_id != 0 && $rango_id == 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE categoria_id  = $categoria_id AND disponibilidad_id = $disponibilidad_id AND localidad_id = $localidad_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    //16. 1111
    if($categoria_id != 0 && $disponibilidad_id != 0 && $localidad_id != 0 && $rango_id != 0){ 
        $query = mysqli_query($mysqli, "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria 
        INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad
        INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad
        INNER JOIN rango ON empleos.rango_id = rango.id_rango
        WHERE categoria_id  = $categoria_id AND disponibilidad_id = $disponibilidad_id AND localidad_id = $localidad_id AND rango_id = $rango_id
        ORDER BY id_empleo DESC limit $limit, $nroLotes");
    }

    
    if(!$query){
        die('Query Failed'. mysqli_error($mysqli));
    }

    while($empleos = mysqli_fetch_array($query)){

        $tabla = $tabla.' <div id="'.$empleos['id_empleo'].'" class="animate__animated animate__fadeIn col-lg-4 col-md-6 col-sm-12">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">'.$empleos['titulo'].'</h5>
                                    <div class="contenido-empleo">
                                        <i class="fas fa-user"></i>
                                        <p>'.$empleos['nombre_categoria'].'</p>
                                     </div>
                                     <div class="contenido-empleo">
                                        <i class="far fa-clock"></i>
                                        <p>'.$empleos['disponibilidad_horaria'].'</p>
                                     </div>
                                     <div class="contenido-empleo">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <p>'.$empleos['nombre_localidad'].'</p>
                                      </div>
                                      <div class="contenido-empleo">
                                        <i class="fas fa-address-card"></i>
                                        <p>'.$empleos['rango_trabajo'].'</p>
                                      </div>
                                </div>
                                <a href="oferta-laboral.php?id='.$empleos['id_empleo'].'" class="ver-empleos">Ver mas <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
        ';

    }

    if(empty($tabla)){
        $tabla = '<p class="text-center pt-5 m-auto ">No se han encontrado resultados con los filtros seleccionados</p>';
    }

    $array = array(0 => $tabla, 1=> $lista);

    $jsonstring = json_encode($array);
    echo $jsonstring;
?>