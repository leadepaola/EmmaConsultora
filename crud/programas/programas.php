<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Programas</title>
</head>

<body>
    <h4 class="text-center mb-2">Programas para Empresas</h4>
    <button type="button" class="btn pt-3 pb-3 btn-success mb-4" data-toggle="modal" data-target="#addPrograma">Añadir un programa</button>

    <div class="table-responsive">

        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Titulo</th>
                    <th scope="col" class="text-center">Imagen</th>
                    <th scope="col" class="text-center">Descripcion</th>
                    <th scope="col" class="text-center">Celular</th>
                </tr>
            </thead>
            <tbody id="programa-body">

            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addPrograma" tabindex="-1" role="dialog" aria-labelledby="addPrograma" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Programa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-programa">
                        <div class="form-group">
                            <label class="col-form-label">Ingrese el Titulo del programa:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ej: Curso sobre como actuar en una entrevista de trabajo">
                            <p class="error-titulo text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label class="col-form-label">Imagen que contendra el curso:</label>
                            <input type="file" id="archivo" class="form-control-file" name="archivo">
                            <p class="error-archivo text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" placeholder="Escriba aquí lo que va a contener el programa (max 3500 caracteres)"></textarea>
                            <p class="contador-caracteres text-danger text-right"></p>
                            <p class="error-descripcion text-danger"></p>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">Ingrese su numero de celular para el boton de WhatsApp</label>
                            <p class="text-info">El numero tiene que ser parecido a este ejemplo: 1138383413</p>
                            <input type="text" class="form-control" id="telefono" name="telefono" placeholder="Ej: 1138383413">
                            <p class="error-telefono text-danger"></p>
                        </div>
                        <div class="errors">
                        </div>
                        <div class="successDiv">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel-programa p-3" data-dismiss="modal">Volver</button>
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
        fetchProgramas();

        $(".btn-add").on("click", function(e) {
            e.preventDefault();
            $(".errors").empty();
            $(".successDiv").empty();
            let error = false;

            let titulo = $('#titulo').val().trim();

            if (titulo.length > 5 && titulo.length < 400) {
                $('.error-titulo').empty();
            } else {
                error = true;
                $('.error-titulo').html('El titulo es corto o supera los 400 caracteres');
            }

            let descripcion = $('#descripcion').val().trim();

            if (descripcion.length > 10 && descripcion.length < 3500) {
                $('.error-descripcion').empty();
            } else {
                error = true;
                $('.error-descripcion').html('La descripcion es corta o supera los 3500 caracteres');
            }

            //Valida extension de archivo
            let archivo = $('#archivo').prop('files')[0];
            var datosForm = new FormData;
            var validaExtension = ['JPEG', 'JPG', 'PNG', 'png', 'jpg', 'jpeg'];
            datosForm.append("archivo", archivo);
            let extension = '';
            if (archivo) {
                extension = archivo.name.split('.').pop();
            }

            if ((extension != 'JPEG') && (extension != 'JPG') && (extension != 'PNG') && (extension != 'png') && (extension != 'jpg') && (extension != 'jpeg')) {
                error = true;
                $('.error-archivo').html('Formato de IMG invalidado, los formatos tienen que ser JPG,JPEG o PNG.');
            } else {
                $('.error-archivo').empty();
            }

            //valida telefono
            let telefono = $('#telefono').val().trim();
            var regexTelefono = /^[0-9]*$/;

            if (!regexTelefono.test($('#telefono').val())) {
                error = true;
                $('.error-telefono').html('telefono invalido ej de telefono valido: 1135265420, todo junto');
            } else {
                $('.error-telefono').empty();
            }

            if (error == false) {

                datosForm.append("titulo", titulo);
                datosForm.append("descripcion", descripcion);
                datosForm.append("telefono", telefono);

                $.ajax({
                    type: 'POST',
                    cache: false,
                    contentType: false,
                    processData: false,
                    data: datosForm,
                    url: 'crud/ajax/programa/add-programa.php'
                }).done(function(data) {
                    if (data == 'exito') {
                        fetchProgramas();
                        $('#form-programa').trigger('reset');
                        $('.error-alert').remove();
                        template = `<div class="alert alert-success success-alert" role="alert">
                                        Programa agregado con exito!!
                                    </div>`;
                        $('.successDiv').html(template);
                    } else {
                        $('.success-alert').remove();
                        template = `<div class="alert alert-danger error-alert" role="alert">
                                        Fallo en al insercion del programa
                                    </div>`;
                        $('.errors').html(template);
                    }
                }).fail(function() {
                    alert('el archivo no se pudo cargar');
                });

            }
        });

        function fetchProgramas() {
            $.ajax({
                url: 'crud/ajax/programa/list-programa.php',
                type: 'GET',
                success: function(response) {
                    let listProgramas = JSON.parse(response);
                    let template = '';
                    listProgramas.forEach(listPrograma => {
                        template += `
                        <tr programaId="${listPrograma.id_programa}">
                            <th scope="row" class="pt-3 text-center" >${listPrograma.id_programa}</th>
                            <td class="pt-3 text-center" >${listPrograma.titulo}</td>
                            <td imagenId="${listPrograma.imagen_programa}" class="pt-3 text-center" style="max-width: 100px;">
                            <a href="crud/ajax/programa/${listPrograma.imagen_programa}" target="_blank">Click para ver la imagen</a>
                            </td>
                            <td class="pt-3 text-truncate text-center" style="max-width: 100px;" >${listPrograma.descripcion}</td>
                            <td class="pt-3 text-center">${listPrograma.celular}</td>
                            <td style="width:20px">
                                <button type="button" class="programa-delete btn btn-danger p-2 m-0 ml-2 d-inline ">Eliminar</button>
                            </td>
                        </tr>
                    `
                    });
                    $('#programa-body').html(template);
                    $('.programa-delete').click(function() {
                        if (confirm('Estas seguro que quieres eliminar un curso')) {
                            let element = $(this)[0].parentElement.parentElement;
                            let archivo = $(this)[0].parentElement.parentElement.children[2];
                            let id = $(element).attr('programaId');
                            let archivoId = $(archivo).attr('imagenId');
                            $.post('crud/ajax/programa/delete-programa.php', {
                                id,
                                archivoId
                            }, function(response) {
                                fetchProgramas();
                            });
                        }
                    });
                }

            });
        }

        $('#descripcion').keyup(function() {
            var text_max = 3500;
            var text_length = $('#descripcion').val().length;
            var text_remaining = text_max - text_length;
            $('.contador-caracteres').html('Quedan ' + text_remaining + ' caracteres');
        });

        $('.close').click(function(e) {
            e.preventDefault();
            $('.error-titulo ').empty();
            $('.error-descripcion').empty();
            $('.error-archivo').empty();

            $('#form-programa').trigger('reset');

            $('.error-alert').remove();
            $('.success-alert').remove();
        });

        $('.cancel-programa').click(function(e) {
            e.preventDefault();
            $('.error-titulo ').empty();
            $('.error-descripcion').empty();
            $('.error-archivo').empty();

            $('#form-programa').trigger('reset');

            $('.error-alert').remove();
            $('.success-alert').remove();
        });
    });
</script>

</html>