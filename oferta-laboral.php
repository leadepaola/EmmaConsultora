<?php
include('functions/connection.php');
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $id = $_GET['id'];
    $sql = "SELECT * FROM empleos INNER JOIN categorias on empleos.categoria_id = categorias.id_categoria INNER JOIN disponibilidad ON empleos.disponibilidad_id = disponibilidad.id_disponibilidad INNER JOIN localidad ON empleos.localidad_id = localidad.id_localidad INNER JOIN rango ON empleos.rango_id = rango.id_rango WHERE id_empleo = $id";
    $resultado = $mysqli->query($sql);

    if ($resultado->num_rows > 0) {
        while ($row = $resultado->fetch_assoc()) {
            $id_empleo = $row['id_empleo'];
            $titulo = $row['titulo'];
            $nombre_categoria = $row['nombre_categoria'];
            $disponibilidad_horaria = $row['disponibilidad_horaria'];
            $nombre_localidad = $row['nombre_localidad'];
            $rango_trabajo = $row['rango_trabajo'];
            $descripcion = $row['descripcion'];
            $fecha = $row['fecha_publicacion'];
        }
    } else {
        header('Location: index.php');
    }
} else {
    header('Location: index.php');
}
?>
<!doctype html>
<html lang="es">

<head>
    <?php include('contenido-head.php') ?>
</head>

<body id="inicio">
    <?php include('nav.php') ?>

    <section class="container" style="padding-top: 120px;" id="empleos">
        <div class="row">
            <div class="col-lg-6 col-md-12 container-empleos animate__animated">
                <div class="contenido-empleo">
                    <p class="fecha-publicacion mt-2 mb-3"> <?php echo $fecha ?> </p>
                </div>
                <div class="contenido-empleo mb-4">
                    <h4 class="m-auto"> <?php echo $titulo ?> </h4>
                </div>
                <div class="contenido-empleo">
                    <i class="fas fa-user"></i>
                    <p> <?php echo $nombre_categoria ?> </p>
                </div>
                <div class="contenido-empleo">
                    <i class="far fa-clock"></i>
                    <p> <?php echo $disponibilidad_horaria ?> </p>
                </div>
                <div class="contenido-empleo">
                    <i class="fas fa-map-marker-alt"></i>
                    <p> <?php echo $nombre_localidad ?> </p>
                </div>
                <div class="contenido-empleo">
                    <i class="fas fa-address-card"></i>
                    <p> <?php echo $rango_trabajo ?> </p>
                </div>
                <div class="contenido-empleo">
                    <p class="empleo-descripcion"> <?php echo $descripcion ?> </p>
                </div>
            </div>
            <div class="col-lg-6 col-md-12 p-5 animate__animated postulacion">
                <h3 class="text-center">Postulate</h3>
                <form class="p-4" id="form-postulacion" enctype="multipart/form-data">
                    <div class="form-group" id="form-empleos">
                        <input type="text" class="form-control p-3" id="nombre" name="nombre" placeholder="Nombre *">
                        <p class="error-nombre text-danger"></p>
                    </div>
                    <div class="form-group ">
                        <input type="text" class="form-control p-3" id="correo" name="correo" placeholder="E-mail *">
                        <p class="error-email text-danger"></p>
                    </div>
                    <div class="form-group">
                        <input type="text" class="form-control p-3" id="telefono" name="telefono" placeholder="Telefono *">
                        <p class="error-telefono text-danger"></p>
                    </div>
                    <div class="form-group">
                        <textarea class="form-control" placeholder="    Mensaje" id="mensaje" name="mensaje" rows="5"></textarea>
                        <p class="error-mensaje text-danger"></p>
                    </div>
                    <div class="form-group mt-4">
                        <label for="" class="">Adjuntar CV</label>
                        <input type="file" id="archivo" class="form-control-file" name="archivo">
                        <p class="error-archivo text-danger"></p>
                    </div>
                    <div id="exito"></div>
                    <button type="submit" id="<?php echo $id_empleo ?>" class="btn btn-primary enviar p-3 d-block mx-auto">Postularse</button>
                </form>
            </div>
        </div>

    </section>

    <div class="modal fade" id="modal-success" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-confirm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="fas fa-check"></i>
                    </div>	
                    <h4 class="modal-title">Exito!!</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <p>Tu postulacion se realizo con exito.</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-success btn-block" data-dismiss="modal">Cerrar</button>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php') ?>
    <?php include('assets-scripts.php') ?>

    <script>
        $(document).ready(function() {
            $(".enviar").on("click", function(event) {
                event.preventDefault();
                $(".enviar").prop("disabled", true);
                $(".enviar").html(
                    `<span class="spinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...`
                );

                setTimeout(function() {


                    $('#exito').empty();
                    
                    let error = false;

                    //valida nombre
                    $nombre = $('#nombre').val().trim();
                    var regexNombre = /^[a-zA-Z ]{3,80}$/;
                    if (!regexNombre.test($('#nombre').val())) {
                        error = true;
                        $('.error-nombre').html('El nombre no es correcto');
                    } else {
                        $('.error-nombre').empty();
                    }

                    //valida email 
                    $email = $('#correo').val().trim();
                    var regexEmail = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

                    if (!regexEmail.test($('#correo').val())) {
                        error = true;
                        $('.error-email').html('El E-mail es invalido');
                    } else {
                        $('.error-email').empty();
                    }

                    //valida telefono
                    $telefono = $('#telefono').val().trim();
                    var regexTelefono = /(?<=\s|:)\(?(?:(0?[1-3]\d{1,2})\)?(?:\s|-)?)?((?:\d[\d-]{5}|15[\s\d-]{7})\d+)/;

                    if (!regexTelefono.test($('#telefono').val())) {
                        error = true;
                        $('.error-telefono').html('telefono invalido ej de telefono valido: +54 11 4444-0000');
                    } else {
                        $('.error-telefono').empty();
                    }

                    //Valida comentario

                    $mensaje = $('#mensaje').val().trim();
                    if (($mensaje.length > 0) && ($mensaje.length <= 2000)) {
                        $('.error-mensaje').empty();
                    } else {

                        error = true;
                        $('.error-mensaje').html('El comentario esta vacio o supera los 2000 caracteres');
                    }


                    //Valida extension de archivo
                    let archivo = $('#archivo').prop('files')[0];
                    var datosForm = new FormData;
                    var validaExtension = ['pdf', 'word']
                    datosForm.append("archivo", archivo);
                    let extension = '';
                    if (archivo) {
                        extension = archivo.name.split('.').pop();
                    }


                    if ((extension != 'pdf') && (extension != 'txt') && (extension != 'docx') && (extension != 'doc')) {
                        error = true;
                        $('.error-archivo').html('Formato de archivo invalido.');
                    } else {
                        $('.error-archivo').empty();
                    }

                    //id del empleo
                    $id_empleo = $('.enviar').attr("id");

                    if (error == false) {

                        datosForm.append("id_empleo", $id_empleo);
                        datosForm.append("nombre", $nombre);
                        datosForm.append("email", $email);
                        datosForm.append("telefono", $telefono);
                        datosForm.append("mensaje", $mensaje);
                        datosForm.append("nombre_empleo", $titulo);

                        $('.error-nombre').empty();
                        $('.error-email').empty();
                        $('.error-telefono').empty();
                        $('.error-mensaje').empty();
                        $('.error-archivo').empty();
                        $.ajax({
                            type: 'POST',
                            cache: false,
                            contentType: false,
                            processData: false,
                            data: datosForm,
                            url: 'crud/ajax/postulacion/postulacion.php'
                        }).done(function(data) {
                            
                            
                            $('#exito').empty();
                            if (data == 'exito') {
                                $(".enviar").prop("disabled", false);
                                $(".enviar").html('Postularse');
                                $('#modal-success').modal('show');
                                $('#form-postulacion').trigger('reset');
                                
                            } else if (data == "Error en el envio, revisa que los campos y el documento esten bien seleccionados") {
                                $fallo = `<div class="alert alert-danger" role="alert">
                                            ${data}
                                        </div>`;
                                $('#exito').append($fallo);
                            } else if (data == "El archivo excede el tamaño permitido de 10mb") {
                                $fallo = `<div class="alert alert-danger" role="alert">
                                            ${data}
                                        </div>`;
                                $('#exito').append($fallo);

                            } else if (data == "El archivo ya existe") {
                                $fallo = `<div class="alert alert-danger" role="alert">
                                            ${data}
                                        </div>`;
                                $('#exito').append($fallo);
                            } else if (data == "Error en el archivo") {
                                $fallo = `<div class="alert alert-danger" role="alert">
                                            ${data}
                                        </div>`;
                                $('#exito').append($fallo);
                            } else if (data == "Fallo en la postulacion") {
                                $fallo = `<div class="alert alert-danger" role="alert">
                                            ${data}
                                        </div>`;
                                $('#exito').append($fallo);
                            }


                        }).fail(function() {
                            alert('el archivo no se pudo cargar');
                        });
                    } else {
                        $(".enviar").prop("disabled", false);
                        $(".enviar").html('Postularse');
                        $('#exito').empty();
                    
                    }

                }, 1000);

            });


        });
    </script>

</body>

</html>
