<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubros</title>
</head>

<body>
    <h4 class="text-center mb-2">Rubros</h4>
    <button type="button" class="btn pt-3 pb-3 mb-3 btn-success" data-toggle="modal" data-target="#addModal">Añadir rubro</button>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col">Rubro</th>
                    <th scope="col"></th>
                </tr>
            </thead>
            <tbody id="rubro-body">



            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Rubro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-rubros">
                        <div class="form-group">
                            <label class="col-form-label">Ingrese nombre del rubro:</label>
                            <input type="text" class="form-control" id="rubro" name="rubro" placeholder="Ej: Logistica">
                        </div>
                        <div class="errors">
                        </div>
                        <div class="successDiv">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel-rubro" data-dismiss="modal">Volver</button>
                            <button type="submit" class="btn btn-primary btn-add" data-dismiss="hide">Añadir</button>
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
                    <h5 class="modal-title" id="exampleModalLabel">Editar Rubro</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-rubro">
                        <div class="form-group">
                            <label class="col-form-label">Ingrese el nuevo nombre del rubro:</label>
                            <input type="hidden" id="rubroId">
                            <input type="text" class="form-control" id="updateRubro" name="updateRubro" placeholder="Ej: Logistica">
                        </div>
                        <div class="errors">
                        </div>
                        <div class="successDiv">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary cancel-rubro" data-dismiss="modal">Volver</button>
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

        fetchRubros();

        $('#form-rubros').submit(function(e) {
            e.preventDefault();
            const postData = {
                nombre_rubro: $('#rubro').val()
            };
            $.post('crud/ajax/rubro/add-rubro.php', postData, function(response) {
                fetchRubros();
                $('#form-rubros').trigger('reset');
                if (response == 'error') {
                    $('.success-alert').remove();
                    template = `<div class="alert alert-danger error-alert" role="alert">
                                    El campo esta vacio o tiene mas de 20 caracteres
                                </div>`;
                    $('.errors').html(template);
                } else if (response == 'exito') {
                    $('.error-alert').remove();
                    template = `<div class="alert alert-success success-alert" role="alert">
                                    Rubro agregado con exito!!
                                </div>`;
                    $('.successDiv').html(template);
                }
            });
        });

        function fetchRubros() {
            $.ajax({
                url: 'crud/ajax/rubro/list-rubro.php',
                type: 'GET',
                success: function(response) {
                    let listRubros = JSON.parse(response);
                    let template = '';
                    listRubros.forEach(listRubro => {
                        template += `
                        <tr rubroId="${listRubro.id_rubro}">
                            <th scope="row" class="text-center">${listRubro.id_rubro}</th>
                            <td class="pt-3">${listRubro.nombre_rubro}</td>
                            <td style="width:20px">
                                <button type="button" data-toggle="modal" data-target="#UpdateModal" class="rubro-update btn btn-primary p-2 m-0 ">Editar</button>
                                
                            </td>
                            <td style="width:20px">
                                <button type="button" class="rubro-delete btn btn-danger p-2 m-0 ml-2 " >Eliminar</button>
                            </td>
                        </tr>
                    `
                    });
                    $('#rubro-body').html(template);
                    $('.rubro-delete').click(function() {
                        if (confirm('Estas seguro que quieres eliminar un rubro')) {
                            let element = $(this)[0].parentElement.parentElement;
                            let id = $(element).attr('rubroId');
                            $.post('crud/ajax/rubro/delete-rubro.php', {
                                id
                            }, function(response) {
                                fetchRubros();
                            });
                        }
                    });
                }

            });
        }

        $(document).on('click', '.rubro-update', function() {
            let element = $(this)[0].parentElement.parentElement;
            let id = $(element).attr('rubroId');
            $.post('crud/ajax/rubro/single-rubro.php', {
                id
            }, function(response) {
                const listRubro = JSON.parse(response);
                $('#rubroId').val(listRubro.id_rubro);
                $('#updateRubro').val(listRubro.nombre_rubro);
            });
        });

        $('#form-rubro').submit(function(e) {
            e.preventDefault();
            const postData = {
                id: $('#rubroId').val(),
                nombre_rubro: $('#updateRubro').val()
            };
            $.post('crud/ajax/rubro/update-rubro.php', postData, function(response) {
                fetchRubros();
                $('#form-rubro').trigger('reset');
                if (response == 'error') {
                    $('.success-alert').remove();
                    template = `<div class="alert alert-danger error-alert" role="alert">
                                    El campo esta vacio o tiene mas de 20 caracteres
                                </div>`;
                    $('.errors').html(template)
                } else if (response == 'exito') {
                    $('.error-alert').remove();
                    template = `<div class="alert alert-success success-alert" role="alert">
                                    Rubro editado con exito!!
                                </div>`;
                    $('.successDiv').html(template);

                }
            });
        });

        $('.close').click(function(e) {
            e.preventDefault();
            $('#form-rubros').trigger('reset');
            $('.error-alert').remove();
            $('.success-alert').remove();
        });

        $('.cancel-rubro').click(function(e) {
            e.preventDefault();
            $('#form-rubros').trigger('reset');
            $('#form-rubro').trigger('reset');
            $('.error-alert').remove();
            $('.success-alert').remove();
        });

    });
</script>

</html>