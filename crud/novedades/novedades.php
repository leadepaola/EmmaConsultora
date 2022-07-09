<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Novedades</title>
</head>

<body>
    <h4 class="text-center mb-2">Novedades</h4>
    <p class="text-muted text-center" style="font-size: 12px;">Importante! manejarse con dos o tres novedades maximo. Esto ayuda a que la pagina no se deforme.</p>
    <button type="button" class="btn btn-success p-3 mb-3" data-toggle="modal" data-target="#addNovedad">Añadir Novedad</button>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" >imagen</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">URL</th>
                </tr>
            </thead>
            <tbody id="novedad-body">



            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addNovedad" tabindex="-1" role="dialog" aria-labelledby="addNovedad" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Novedad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-novedades">
                        <div class="form-group">
                            <label class="col-form-label">Ingrese el Titulo de la novedad:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ej: Personal doméstico: el aumento es del 28%">
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Ingrese una breve descripcion de la novedad:</label>
                            <input type="text" class="form-control" id="descripcion" name="descripcion" placeholder="Max 120 caracteres">
                            <p class="contador-caracteres text-danger text-right"></p>
                            <p class="error-descripcion text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Imagen que contendra la novedad:</label>
                            <input type="file" id="archivo" class="form-control-file" name="archivo">
                            <p class="error-archivo text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Imagen la URL de la pagina:</label>
                            <input type="text" id="url" class="form-control" name="url" placeholder="Ej: https://www.clarin.com/economia/personal-domestico-aumento">

                        </div>

                        <div class="errors">
                        </div>
                        <div class="successDiv">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel-novedad p-3" data-dismiss="modal">Volver</button>
                            <button type="submit" class="btn btn-primary btn-add p-3" data-dismiss="hide">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    $(document).ready(function() {
        fetchNovedades();

        $(".btn-add").on("click", function(e) {
            e.preventDefault();

            $(".errors").empty();
            $(".successDiv").empty();
            let error = false;

            $descripcion = $('#descripcion').val().trim();

            if ($descripcion.length > 120) {
                error = true;
                $('.error-descripcion').html('La descripcion supera los 1200 caracteres');

            } else {
                $('.error-descripcion').empty();
            }

            //Valida extension de archivo
            let archivo = $('#archivo').prop('files')[0];
            var datosForm = new FormData;
            var validaExtension = ['JPEG', 'JPG', 'PNG','png','jpg','jpeg'];
            datosForm.append("archivo", archivo);
            let extension = '';
            if (archivo) {
                extension = archivo.name.split('.').pop();
            }

            if ((extension != 'JPEG') && (extension != 'JPG') && (extension != 'PNG') && (extension != 'png') && (extension != 'jpg') && (extension != 'jpeg')) {
                error = true;
                $('.error-archivo').html('Formato de IMG invalidad, los formatos tienen que ser JPG,JPEG o PNG.');
            } else {
                $('.error-archivo').empty();
            }

            if (error == false) {

                $titulo = $('#titulo').val().trim();
                $descripcion = $('#descripcion').val().trim();
                $URL = $('#url').val().trim();
                datosForm.append("titulo", $titulo);
                datosForm.append("descripcion", $descripcion);
                datosForm.append("url", $URL);
                
                $.ajax({
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: datosForm,
                    url: 'crud/ajax/novedades/add-novedad.php'
                }).done(function(data) {
                    if (data == 'exito') {
                        fetchNovedades();
                        $('#form-novedades').trigger('reset');
                        $('.error-alert').remove();
                        template = `<div class="alert alert-success success-alert" role="alert">
                                        Novedad agregado con exito!!
                                    </div>`;
                        $('.successDiv').html(template);
                    }else{
                        $('.success-alert').remove();
                        template = `<div class="alert alert-danger error-alert" role="alert">
                                        Fallo en al insercion de la novedad
                                    </div>`;
                        $('.errors').html(template);
                    }
                }).fail(function() {
                    alert('el archivo no se pudo cargar');
                });
            }
        });

        function fetchNovedades() {
            $.ajax({
                url: 'crud/ajax/novedades/list-novedad.php',
                type: 'GET',
                success: function(response) {
                    let listNovedades = JSON.parse(response);
                    let template = '';
                    listNovedades.forEach(listNovedad => {
                        template += `
                        <tr novedadId="${listNovedad.id_novedades}">
                            <th scope="row" class="text-center"style="max-width: 100px;" >${listNovedad.id_novedades}</th>

                            <td  imagenId="${listNovedad.imagen_novedades}" class="pt-3" class="text-center" style="max-width: 100px;">
                            <a href="crud/ajax/novedades/${listNovedad.imagen_novedades}"  target="_blank">Click para ver la imagen</a>
                            </td>

                            <td class="pt-3" class="text-center" style="max-width: 100px;" >${listNovedad.titulo}</td>
                            <td  class="pt-3 text-truncate" style="max-width: 100px;" >${listNovedad.descripcion}</td>
                            <td  class="pt-3 text-truncate" style="max-width: 100px;" >${listNovedad.link}</td>
                            <td style="width:20px">
                                <button type="button" class="novedad-delete btn btn-danger p-2 m-0 ml-2 d-inline ">Eliminar</button>
                            </td>
                        </tr>
                    `
                    });
                    $('#novedad-body').html(template);
                    $('.novedad-delete').click(function() {
                        if (confirm('Estas seguro que quieres eliminar una novedad')) {
                            let element = $(this)[0].parentElement.parentElement;
                            let archivo = $(this)[0].parentElement.parentElement.children[1];
                            let id = $(element).attr('novedadId');
                            let archivoId = $(archivo).attr('imagenId');
                            console.log(archivoId);
                            $.post('crud/ajax/novedades/delete-novedad.php', {
                                id, archivoId
                            }, function(response) {
                                fetchNovedades();
                                
                            });
                        }
                    });
                }

            });
        }

        $('#descripcion').keyup(function() {
            var text_max = 120;
            var text_length = $('#descripcion').val().length;
            var text_remaining = text_max - text_length;
            $('.contador-caracteres').html('Quedan ' + text_remaining + ' caracteres');
        });


        $('.close').click(function(e) {
            e.preventDefault();
            $('.error-descripcion').empty();
            $('.error-archivo').empty();
            $('#form-novedades').trigger('reset');
            $('.error-alert').remove();
            $('.success-alert').remove();
        });

        $('.cancel-novedad').click(function(e) {
            e.preventDefault();
            $('.error-descripcion').empty();
            $('.error-archivo').empty();
            $('#form-novedades').trigger('reset');
            $('.error-alert').remove();
            $('.success-alert').remove();
        });
    });
</script>

</html>