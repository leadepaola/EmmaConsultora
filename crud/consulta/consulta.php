<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta</title>
</head>

<body>
    <h4 class="text-center mb-4">Consultas</h4>

    <div class="table-responsive">
        <table class="table">
            <thead>
                <tr>
                    <th scope="col" class="text-center">ID</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Telefono</th>
                    <th scope="col" class="text-center">Mensaje</th>
                </tr>
            </thead>
            <tbody id="consulta-body">



            </tbody>
        </table>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mensaje del consultante</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">

                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>

                </div>
            </div>
        </div>
    </div>

    <a href="#" id="vaciar-consultas" class="mt-3" style="font-size: 19px;">Vaciar todo</a>


</body>
<style>
    td[id^="mensaje"]:hover {
        border: 1px solid #066b68;
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function() {
        fetchConsultas();

        function fetchConsultas() {
            $.ajax({
                url: 'crud/ajax/consulta/list-consulta.php',
                type: 'GET',
                success: function(response) {
                    let listConsultas = JSON.parse(response);
                    let template = '';
                    listConsultas.forEach(listConsulta => {
                        template += `
                        <tr consultaId="${listConsulta.id}">
                            <th scope="row" class="text-center">${listConsulta.id}</th>
                            <td class="pt-3 text-center">${listConsulta.nombre}</td>
                            <td class="pt-3 text-center">${listConsulta.email}</td>
                            <td class="pt-3 text-center">${listConsulta.telefono}</td>
                            <td class="pt-3 text-truncate info" style="max-width: 350px;" data-toggle="modal" data-target="#exampleModal" id="mensaje${listConsulta.id}">${listConsulta.mensaje}</td>
                    
                            <td style="width:20px">
                                <button type="button" class="consulta-delete btn btn-danger p-2 m-0 ml-2 d-inline ">Eliminar</button>
                            </td>
                        </tr>
                    `
                    });
                    $('#consulta-body').html(template);
                    $('.consulta-delete').click(function() {
                        if (confirm('Estas seguro que quieres eliminar la consulta')) {
                            let element = $(this)[0].parentElement.parentElement;
                            let id = $(element).attr('consultaId');
                            $.post('crud/ajax/consulta/delete-consulta.php', {
                                id
                            }, function(response) {
                                fetchConsultas();
                            });
                        }
                    });

                }

            });
        }

        $('body').on('click', '.info', function() {
            let tdClick = $(this).attr('id');

            if (tdClick.indexOf("mensaje") > -1) {
                mensaje = $(this).html();
                $('.modal-body').html(mensaje);
            }
        });      

        $('#vaciar-consultas').click(function() {
            if (confirm('Estas seguro que quieres eliminar todas consulta')) {
                $.post('crud/ajax/consulta/delete-all.php',
                    function(response) {
                        // console.log(response);
                        fetchConsultas();
                    });
            }
        });


    });
</script>

</html>