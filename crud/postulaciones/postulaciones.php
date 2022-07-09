<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rubros</title>
</head>

<body>
    <h4 class="text-center mb-5">Postulaciones</h4>
    <div class="table-responsive">
        <table class="table table-sm">
            <thead>
                <tr>
                    <th scope="col" class="text-center">Id</th>
                    <th scope="col" class="text-center">Trabajo</th>
                    <th scope="col" class="text-center">Nombre</th>
                    <th scope="col" class="text-center">Email</th>
                    <th scope="col" class="text-center">Mensaje</th>
                    <th scope="col" class="text-center">Curriculum</th>
                </tr>
            </thead>
            <tbody id="postulacion-body">



            </tbody>
        </table>
    </div>
    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Mensaje del Postulante</h5>
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

</body>
<style>
    td[id^="mensaje"]:hover {
        border: 1px solid #066b68;
        cursor: pointer;
    }
</style>
<script>
    $(document).ready(function() {
        fetchPostulaciones();

        function fetchPostulaciones() {

            $.ajax({
                url: 'crud/ajax/postulacion/list-postulacion.php',
                type: 'GET',
                success: function(response) {
                    let listPostulaciones = JSON.parse(response);
                    let template = '';
                    listPostulaciones.forEach(listPostulacion => {
                        template += `
                        <tr postulacionId="${listPostulacion.id_postulacion}">
                            <th scope="row" class="pt-3 text-center">${listPostulacion.id_postulacion}</th>
                            <td class="pt-3 text-center" >${listPostulacion.titulo_empleo}</td>
                            <td class="pt-3 text-center">${listPostulacion.nombre}</td>
                            <td class="pt-3 text-center">${listPostulacion.email}</td>
                            <td  class="pt-3 text-truncate info" style="max-width: 200px;" data-toggle="modal" data-target="#exampleModal" id="mensaje${listPostulacion.id_postulacion}">${listPostulacion.mensaje}</td>
                            <td archivoId="${listPostulacion.curriculum}" class="pt-3 "><a href="crud/ajax/postulacion/${listPostulacion.curriculum}" download="${listPostulacion.curriculum}">Descargar</a></td>
                            <td>
                                <button type="button" class="postulacion-delete btn btn-danger p-2 m-0 ml-2 d-inline ">Eliminar</button>
                            </td>
                        </tr>
                    `
                    });
                    $('#postulacion-body').html(template);
                    $('.postulacion-delete').click(function() {
                        if (confirm('Estas seguro que quieres eliminar un rubro')) {
                            let element = $(this)[0].parentElement.parentElement;
                            let archivo = $(this)[0].parentElement.parentElement.children[5];
                            let id = $(element).attr('postulacionId');
                            let archivoId = $(archivo).attr('archivoId');
                            // console.log(archivoId);
                            $.post('crud/ajax/postulacion/delete-postulacion.php', {
                                id, archivoId
                            }, function(response) {
                                fetchPostulaciones();
                                // console.log(response);
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

    });
</script>

</html>