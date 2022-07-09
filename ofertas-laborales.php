<!DOCTYPE html>
<html lang="es">

<head>
    <?php include('contenido-head.php') ?>
</head>

<body>
    <?php include('nav.php') ?>

    <section class="container section-ofertas  " style="padding-top: 120px;" id="empleos">
        <div class="title">
            <h2>Bolsa de Empleo</h2>
            <p class="text-muted">Postulate al empleo que mas se adapte a tus gustos</p>
        </div>
        <form>
            <div class="form-row ml-1">
                <div class="form-group col-lg-2 col-md-5 col-sm-12 mr-3">
                    <select class="form-control" id="categorias" name="categorias">
                        <option selected value="0">Todas las Categorias</option>
                    </select>
                </div>
                <div class="form-group col-lg-2 col-md-5 col-sm-12 mr-3">
                    <select class="form-control" id="disponibilidad" name="disponibilidad">
                        <option selected value="0">Todos los horarios</option>
                    </select>
                </div>
                <div class="form-group col-lg-2 col-md-5 col-sm-12 mr-3">
                    <select class="form-control" id="localidad" name="localidad">
                        <option selected value="0">Todas las localidades</option>
                    </select>
                </div>
                <div class="form-group col-lg-2 col-md-5 col-sm-12 ">
                    <select class="form-control" id="rango" name="rango">
                        <option selected value="0">Todo los rangos</option>
                    </select>
                </div>
                <p class="d-none" id="categoria-select"></p>
                <p class="d-none" id="horario-select"></p>
                <p class="d-none" id="localidad-select"></p>
                <p class="d-none" id="rango-select"></p>
                
            </div>

        </form>

        <div class="row">
            <section class="trabajos col-12 clearfix ">
                <div class="row " id="empleo-body">

                </div>
            </section>
        </div>
    </section>

    <section class="container mt-4 mb-5">
        <nav aria-label="Page navigation example">
            <ul class="pagination justify-content-center " id="pagination">
                
            </ul>
        </nav>
    </section>
    <?php include('footer.php') ?>
    <?php include('assets-scripts.php') ?>
    <script>
        $(document).ready(pagination(1));

        llenarForm('categorias','id_categoria','nombre_categoria');
        llenarForm('disponibilidad','id_disponibilidad','disponibilidad_horaria');
        llenarForm('localidad','id_localidad','nombre_localidad');
        llenarForm('rango','id_rango','rango_trabajo');

        function llenarForm(tabla,id,nombre){
            
            const postData = {
                nombreTabla: tabla,
                id: id,
                nombre: nombre
            };
            
            $.post('crud/ajax/empleo/llenarform.php', postData, function(response){
                const registros = JSON.parse(response);
                let template = '';
                registros.forEach(registro =>{
                    template += `
                        <option value="${registro.id}">${registro.nombre}</option>
                    `;
                });
                $(`#${postData.nombreTabla}`).append(template);
                
            });
        }

        function pagination(partida){

            var url = 'crud/ajax/empleo/list-paginacion-empleo.php';
            var textCategoria = ($('#categorias').val());
            var textDisponibilidad = ($('#disponibilidad').val());
            var textLocalidad = ($('#localidad').val());
            var textRango = ($('#rango').val());
            // console.log(textRango);
            // console.log(textDisponibilidad);
            $.ajax({
                type: 'POST',
                url: url,
                data: {partida: partida,    
                       categoria: textCategoria,
                        disponibilidad: textDisponibilidad,
                        localidad: textLocalidad,
                        rango: textRango
                    },
                success:function(data){
                    var array = eval(data);
                    // console.log(data);
                    $('#empleo-body').html(array[0]);
                    $('#pagination').html(array[1]);
                }
            });
            return false;
        }
        
        $('#categorias').change(function(){
            var textCategoria = ($('#categorias').val());
            $('#categoria-select').html(textCategoria);
            pagination(1);
        });

        $('#disponibilidad').change(function(){
            var textDisponibilidad = ($('#disponibilidad').val());
            $('#horario-select').html(textDisponibilidad);
            pagination(1);
        });

        $('#localidad').change(function(){
            var textLocalidad = ($('#localidad').val());
            $('#localidad-select').html(textLocalidad);
            pagination(1);
        });

        $('#rango').change(function(){
            var textRango = ($('#rango').val());
            $('#rango-select').html(textRango);
            pagination(1);
        });
    </script>
</body>

</html>