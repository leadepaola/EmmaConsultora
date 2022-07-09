<?php
include('functions/connection.php');
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM cursos WHERE id_curso = $id";
    
    $resultado = $mysqli->query($sql);

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $id_curso = $row['id_curso'];
            $titulo = $row['titulo'];
            $imagen_curso = $row['imagen_curso'];
            $modalidad = $row['modalidad'];
            $duracion = $row['duracion'];
            $precio = $row['precio'];
            $descripcion = $row['descripcion'];
            $celular = $row['celular'];
        }
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('contenido-head.php') ?>
</head>

<body>
    <?php include('nav.php') ?>
    <section class="container" style="padding-top: 120px;margin-bottom:100px; ">
        <div class="row container-venta-curso">
            <div class="col-lg-5 col-md-12 col-sm-12 venta-img  animate__animated ">
                <img src="crud/ajax/curso/<?php echo $imagen_curso ?>" class="pl-4 img-rounded img-fluid" alt="">
            </div>
            <div class="col-lg-5 col-md-12 col-sm-12 venta-contenido animate__animated">
                <h5 class="card-title pt-5 text-center mb-4"><?php echo $titulo ?></h5>
                <div class="container-descripcion ">
                    <p class="duracion text-left">
                        <img src="assets/images/alarm-outline.svg" alt="" width="22px" style="margin-top:-4px;">
                        Duracion: <?php echo $duracion ?>
                    </p>
                    <p class="modalidad text-left">
                        <img src="assets/images/star-outline.svg" alt="" width="22px" style="margin-top:-4px;">
                        Modalidad: <?php echo $modalidad ?>
                    </p>
                    <?php if($precio !=0){ ?>
                    <p class="precio text-left">
                        <img src="assets/images/pricetag-outline.svg" alt="" width="22px" style="margin-top:-4px;">
                        Precio: <span class="text-success">$<?php echo $precio ?></span>
                    </p>
                    <?php } ?>
                    <p class="descripcion text-left mt-3"><?php echo $descripcion ?></p>
                </div>
                <div class="conteiner-button mt-4" style="display:flex; justify-content: center;">
                    <a target="_blank" href="https://wa.me/+54<?php echo $celular?>?text=Hola, quiero saber mas sobre el curso" class="btn btn-success p-3" >Contactar por WhatsApp
                        <i class="fab fa-whatsapp" style="font-size: 20px; margin-left:7px;"></i>
                    </a>
                </div>
                
            </div>
        </div>
    </section>
    <?php include('footer.php') ?>
    <?php include('assets-scripts.php') ?>
</body>

</html>