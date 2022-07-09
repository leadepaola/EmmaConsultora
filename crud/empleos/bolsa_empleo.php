<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bolsa de Empleo</title>
</head>

<body>
    <h4 class="text-center mb-2">Empleos</h4>
    <button type="button" class="btn pt-3 pb-3 btn-success mb-4" data-toggle="modal" data-target="#addModal">Añadir Empleo a la Bolsa de Empleo</button>

    <div class="table-responsive">

        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col" class="text-center">Titulo</th>
                    <th scope="col">Rubro</th>
                    <th scope="col">Horario</th>
                    <th scope="col">Localidad</th>
                    <th scope="col">Rango</th>
                    <th scope="col">Descripcion</th>
                </tr>
            </thead>
            <tbody id="empleo-body">

            </tbody>
        </table>
    </div>

    <div class="modal fade" id="addModal" tabindex="-1" role="dialog" aria-labelledby="addModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Añadir Empleo</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form id="form-empleos">
                        <div class="form-group">
                            <label class="col-form-label">Ingrese el titulo del empleo:</label>
                            <input type="text" class="form-control" id="titulo" name="titulo" placeholder="Ej: Labor o Nombre de la empresa">
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Rubro:</label>
                            <select class="form-control" id="categorias" name="categorias">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Disponibilidad Horaria:</label>
                            <select class="form-control" id="disponibilidad" name="Disponibilidad">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Localidad:</label>
                            <select class="form-control" id="localidad" name="localidad">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlSelect1">Rango</label>
                            <select class="form-control" id="rango" name="rango">

                            </select>
                        </div>
                        <div class="form-group">
                            <label for="descripcion">descripción</label>
                            <textarea class="form-control" name="descripcion" id="descripcion" rows="3" placeholder="Escriba aquí lo que va a contener el empleo (max 5000 caracteres)"></textarea>
                            <p class="contador-caracteres text-danger text-right"></p>
                            <p class="error-descripcion text-danger"></p>
                        </div>
                        <div class="errors">
                        </div>
                        <div class="successDiv">
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn p-3 btn-secondary cancel-empleo" data-dismiss="modal">Volver</button>
                            <button type="submit" class="btn p-3 btn-primary btn-add" data-dismiss="hide">Añadir</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>
<script>
    $(document).ready(function() {
    
        fetchEmpleos();
        llenarForm('categorias', 'id_categoria', 'nombre_categoria');
        llenarForm('disponibilidad', 'id_disponibilidad', 'disponibilidad_horaria');
        llenarForm('localidad', 'id_localidad', 'nombre_localidad');
        llenarForm('rango', 'id_rango', 'rango_trabajo');

        function llenarForm(tabla, id, nombre) {

            const postData = {
                nombreTabla: tabla,
                id: id,
                nombre: nombre
            };

            $.post('crud/ajax/empleo/llenarform.php', postData, function(response) {
                const registros = JSON.parse(response);
                let template = `<option disabled selected>Selecciona una opción</option>`;
                registros.forEach(registro => {
                    template += `
                        <option value="${registro.id}">${registro.nombre}</option>
                    `;
                });
                $(`#${postData.nombreTabla}`).html(template);

            });
        }

        $('#form-empleos').submit(function(e) {
            e.preventDefault();

            let error = false;

            $descripcion = $('#descripcion').val().trim();

            if ($descripcion.length > 5000) {
                error = true;
                $('.error-descripcion').html('La descripcion supera los 5000 caracteres');

            } else {
                $('.error-descripcion').empty();
            }

            if (error == false) { 

                $.ajax({
                    url: 'crud/ajax/empleo/add-empleo.php',
                    method: 'POST',
                    data: $('#form-empleos').serialize(),
                    success: function(response) {
                        fetchEmpleos();
                        if (response == 'error') {
                            $('.success-alert').remove();
                            template = `<div class="alert alert-danger error-alert" role="alert">
                                            Hay campos vacios o la descripcion supera los 5000 caracteres
                                        </div>`;
                            $('.errors').html(template);
                        } else if (response == 'exito') {
                            $('#form-empleos').trigger('reset');
                            $('.error-alert').remove();
                            template = `<div class="alert alert-success success-alert" role="alert">
                                            Empleo agregado con exito!!
                                        </div>`;
                            $('.successDiv').html(template);
                        }
                    }
                });
            }
        });

        function fetchEmpleos() {
            $.ajax({
                url: 'crud/ajax/empleo/list-empleo.php',
                type: 'GET',
                success: function(response) {
                    let listEmpleos = JSON.parse(response);
                    let template = '';
                    listEmpleos.forEach(listEmpleo => {
                        template += `
                        <tr empleoId="${listEmpleo.id_empleo}">
                            <th scope="row" class="pt-3">${listEmpleo.id_empleo}</th>
                            <td class="pt-3">${listEmpleo.titulo}</td>
                            <td class="pt-3">${listEmpleo.nombre_categoria}</td>
                            <td class="pt-3" style="width: 100px;">${listEmpleo.disponibilidad_horaria}</td>
                            <td class="pt-3">${listEmpleo.nombre_localidad}</td>
                            <td class="pt-3" style="width: 50px;" >${listEmpleo.rango_trabajo}</td>
                            <td class="pt-3 text-truncate" style="max-width: 150px;">${listEmpleo.descripcion}</td>
                            <td>
                                <button type="button" class="empleo-delete btn btn-danger p-2 m-0 ml-2 d-inline ">Eliminar</button>
                            </td>
                        </tr>
                    `
                    });
                    $('#empleo-body').html(template);
                    $('.empleo-delete').click(function(){
                        if (confirm('Estas seguro que quieres eliminar un empleo')) {
                            let element = $(this)[0].parentElement.parentElement;
                            let id = $(element).attr('empleoId');
                            $.post('crud/ajax/empleo/delete-empleo.php', {
                                id
                            }, function(response) {
                                    fetchEmpleos();
                            });
                        }
                    });
                }
                
            });
            
        }

        $('#descripcion').keyup(function() {
            var text_max = 5000;
            var text_length = $('#descripcion').val().length;
            var text_remaining = text_max - text_length;
            $('.contador-caracteres').html('Quedan ' + text_remaining + ' caracteres');
        });

        $('.close').click(function(e) {
            e.preventDefault();
            $('#form-empleos').trigger('reset');
            $('.error-descripcion').empty();
            $('.error-alert').remove();
            $('.success-alert').remove();
        });

        $('.cancel-empleo').click(function(e) {
            e.preventDefault();
            $('#form-empleos').trigger('reset');
            $('.error-descripcion').empty();
            $('.error-alert').remove();
            $('.success-alert').remove();
        });
    });
</script>

</html>