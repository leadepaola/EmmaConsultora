<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Localidades</title>
</head>

<body>
    <h4 class="text-center mb-2">Localidades</h4>
    <button type="button" class="btn btn-success p-3 mb-3" data-toggle="modal" data-target="#addModal">Añadir Localidad</button>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col">Localidad</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="localidad-body">



            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Localidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-localidades">
                        <div class="form-group">
                            <label class="col-form-label">Ingrese el nombre de la localidad:</label>
                            <input type="text" class="form-control" id="localidad" name="localidad" placeholder="Ej: Buenos aires, Caseros">
                        </div>
                        <div class="errors">
                        </div>
                        <div class="successDiv">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel-localidad p-3" data-dismiss="modal">Volver</button>
                            <button type="submit" class="btn btn-primary btn-add p-3" data-dismiss="hide">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="UpdateModal" tabindex="-1" role="dialog" aria-labelledby="UpdateModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Editar Localidad</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-localidad">
                        <div class="form-group">
                            <label class="col-form-label">Ingrese el nuevo nombre de la localidad:</label>
                            <input type="hidden" id="localidadId">
                            <input type="text" class="form-control" id="updateLocalidad" name="updateLocalidad" placeholder="Ej: Buenos Aires, Caseros">
                        </div>
                        <div class="errors">
                        </div>
                        <div class="successDiv">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel-localidad" data-dismiss="modal">Volver</button>
                            <button type="submit" class="btn btn-primary">Editar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

</body>

<script>
    $(document).ready(function() {
        fetchLocalidades();

        $('#form-localidades').submit(function(e) {
            e.preventDefault();
            const postData = {
                nombre_localidad: $('#localidad').val()
            };
            $.post('crud/ajax/localidad/add-localidad.php', postData, function(response) {
                fetchLocalidades();
                $('#form-localidades').trigger('reset');
                if (response == 'error') {
                    $('.success-alert').remove();
                    template = `<div class="alert alert-danger error-alert" role="alert">
                                    El campo esta vacio o tiene mas de 40 caracteres
                                </div>`;
                    $('.errors').html(template);
                } else if (response == 'exito') {
                    $('.error-alert').remove();
                    template = `<div class="alert alert-success success-alert" role="alert">
                                    Localidad agregada con exito!!
                                </div>`;
                    $('.successDiv').html(template);
                }
            });
        });

        function fetchLocalidades() {
            $.ajax({
                url: 'crud/ajax/localidad/list-localidad.php',
                type: 'GET',
                success: function(response) {
                    let listLocalidades = JSON.parse(response);
                    let template = '';
                    listLocalidades.forEach(listLocalidad => {
                        template += `
                        <tr localidadId="${listLocalidad.id_localidad}">
                            <th scope="row" class="text-center">${listLocalidad.id_localidad}</th>
                            <td class="pt-3" class="text-center">${listLocalidad.nombre_localidad}</td>
                            <td style="width:20px">
                                <button type="button" data-toggle="modal" data-target="#UpdateModal" class="localidad-update btn btn-primary p-2 m-0  d-inline">Editar</button>
                            </td>
                            <td style="width:20px">
                                <button type="button" class="localidad-delete btn btn-danger p-2 m-0 ml-2 d-inline ">Eliminar</button>
                            </td>
                        </tr>
                    `
                    });
                    $('#localidad-body').html(template);
                    $('.localidad-delete').click(function() {
                        if (confirm('Estas seguro que quieres eliminar un rubro')) {
                            let element = $(this)[0].parentElement.parentElement;
                            let id = $(element).attr('localidadId');
                            $.post('crud/ajax/localidad/delete-localidad.php', {
                                id
                            }, function(response) {
                                fetchLocalidades();
                            });
                        }
                    });
                }

            });
        }

        // $(document).on('click', '.localidad-delete', function() {
        //     if (confirm('Estas seguro que quieres eliminar un rubro')) {
        //         let element = $(this)[0].parentElement.parentElement;
        //         let id = $(element).attr('localidadId');
        //         $.post('crud/ajax/localidad/delete-localidad.php', {
        //             id
        //         }, function(response) {
        //             fetchLocalidades();
        //         });
        //     }
        // });

        $(document).on('click', '.localidad-update', function() {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('localidadId');
            $.post('crud/ajax/localidad/single-localidad.php', {
                id
            }, function(response) {
                const listLocalidad = JSON.parse(response);
                $('#localidadId').val(listLocalidad.id_localidad);
                $('#updateLocalidad').val(listLocalidad.nombre_localidad);
            });
        });

        $('#form-localidad').submit(function(e) {
            e.preventDefault();
            const postData = {
                id: $('#localidadId').val(),
                nombre_localidad: $('#updateLocalidad').val()
            };
            $.post('crud/ajax/localidad/update-localidad.php', postData, function(response) {
                fetchLocalidades();
                $('#form-localidad').trigger('reset');
                if (response == 'error') {
                    $('.success-alert').remove();
                    template = `<div class="alert alert-danger error-alert" role="alert">
                                    El campo esta vacio o tiene mas de 40 caracteres
                                </div>`;
                    $('.errors').html(template)
                } else if (response == 'exito') {
                    $('.error-alert').remove();
                    template = `<div class="alert alert-success success-alert" role="alert">
                                    Localidad editado con exito!!
                                </div>`;
                    $('.successDiv').html(template);

                }
            });
        });

        $('.close').click(function(e) {
            e.preventDefault();
            $('#form-localidades').trigger('reset');
            $('.error-alert').remove();
            $('.success-alert').remove();
        });

        $('.cancel-localidad').click(function(e) {
            e.preventDefault();
            $('#form-localidades').trigger('reset');
            $('.error-alert').remove();
            $('.success-alert').remove();
        });
    });
</script>

</html>