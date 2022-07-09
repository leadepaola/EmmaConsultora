<?php
require('functions/connection.php');
session_start();
if (!isset($_SESSION["user"])) {
    header("location: login_EMMA.php");
}
?>

<!doctype html>
<html lang="es">

<head>
    <?php include('contenido-head.php'); ?>
</head>

<body>


    <div class="wrapper">

        <nav id="sidebar">

            <div class="sidebar-header">
                <h3>CPANEL</h3>
            </div>
            <ul class="lisst-unstyled components">

                <!-- <p>The Providers</p> -->
                <li>
                    <a href="#Seccion-Empleos" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Bolsa de Empleo</a>
                    <ul class="collapse list-unstyled" id="Seccion-Empleos">
                        <li>
                            <a href="#" id="bolsaEmpleo">Añadir empleo</a>
                        </li>
                        <li>
                            <a href="#" id="rubros">Añadir Rubros</a>
                        </li>
                        <li>
                            <a href="#" id="localidades">Añadir Localidades</a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" id="cursos">Cursos</a>
                </li>
                <li>
                    <a href="#" id="programas">Programas para Empresas</a>
                </li>
                <li>
                    <a href="#" id="novedades">Novedades</a>
                </li>
                <li>
                    <a href="#" id="postulaciones">Postulaciones</a>
                </li>
                <li>
                    <a href="#" id="consulta">Consulta</a>
                </li>

                <li style="margin-top:240px;">
                    <a href="#" id="logout">Cerrar Sesion</a>
                </li>

            </ul>
        </nav>


        <div id="content">

            <nav class="navbar navbar-expand-lg navbar-light bg-light">
                <div class="container-fluid">
                    <button type="button" id="sidebarCollapse" class="btn btn-info">
                        <i class="fas fa-align-left"></i>
                        <span>Ocultar Sidebar</span>
                    </button>
                    <div>
                        <h2 class="dias_disp"></h2>
                    </div>
                </div>

            </nav>

            <br><br>

            <div class="content-empleos">

            </div>

        </div>


    </div>

    <?php include('assets-scripts.php') ?>

    <script>
        $(document).ready(function() {
            $dias_disp = 30;
            $('.dias_disp').html("dias disponibles: " + $dias_disp);
            $('#sidebarCollapse').on('click', function() {
                $('#sidebar').toggleClass('active');
            });

            if ($dias_disp > 0) {
                $('#bolsaEmpleo').click(function() {
                    var esperar = 1000;
                    $.ajax({
                        url: "crud/empleos/bolsa_empleo.php",
                        beforeSend: function() {
                            $('.content-empleos').text('Cargando...');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $('.content-empleos').html(data);
                            }, esperar);
                        }
                    });

                });

                $('#cursos').click(function() {
                    var esperar = 1000;
                    $.ajax({
                        url: "crud/cursos/cursos.php",
                        beforeSend: function() {
                            $('.content-empleos').text('Cargando...');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $('.content-empleos').html(data);
                            }, esperar);
                        }
                    });

                });

                $('#programas').click(function() {
                    var esperar = 1000;
                    $.ajax({
                        url: "crud/programas/programas.php",
                        beforeSend: function() {
                            $('.content-empleos').text('Cargando...');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $('.content-empleos').html(data);
                            }, esperar);
                        }
                    });

                });

                $('#novedades').click(function() {
                    var esperar = 1000;
                    $.ajax({
                        url: "crud/novedades/novedades.php",
                        beforeSend: function() {
                            $('.content-empleos').text('Cargando...');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $('.content-empleos').html(data);
                            }, esperar);
                        }
                    });

                });

                $('#postulaciones').click(function() {
                    var esperar = 1000;
                    $.ajax({
                        url: "crud/postulaciones/postulaciones.php",
                        beforeSend: function() {
                            $('.content-empleos').text('Cargando...');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $('.content-empleos').html(data);
                            }, esperar);
                        }
                    });

                });

                $('#consulta').click(function() {
                    var esperar = 1000;
                    $.ajax({
                        url: "crud/consulta/consulta.php",
                        beforeSend: function() {
                            $('.content-empleos').text('Cargando...');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $('.content-empleos').html(data);
                            }, esperar);
                        }
                    });

                });

                $('#rubros').click(function() {
                    var esperar = 1000;
                    $.ajax({
                        url: "crud/rubros/rubros.php",
                        beforeSend: function() {
                            $('.content-empleos').text('Cargando...');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $('.content-empleos').html(data);
                            }, esperar);

                        }
                    });

                });

                $('#localidades').click(function() {
                    var esperar = 1000;
                    $.ajax({
                        url: "crud/localidades/localidades.php",
                        beforeSend: function() {
                            $('.content-empleos').text('Cargando...');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $('.content-empleos').html(data);
                            }, esperar);
                        }
                    });

                });

                $('#logout').click(function() {
                    var esperar = 1000;
                    $.ajax({
                        beforeSend: function() {
                            $('.content-empleos').text('Cargando...');
                        },
                        success: function(data) {
                            setTimeout(function() {
                                $(location).attr('href', 'crud/login/logout.php');
                            }, esperar);
                        }
                    });

                });

            } else {
                $template_cuota = `<p class="alert alert-danger">Se ha detectado que la cuota del mes esta impaga, <b>por favor pongase al dia</b></p>
                <div class="alert alert-dark">
                    <p class="text-center"><b>Datos bancarios</b></p>
                    <p><b>Alias</b>: broma.frase.puerta</p>  
                    <p><b>CBU</b>: 14300017 - 13020821610011</p>  
                    <p><b>NRO. CUENTA</b>: 1302082161001</p>  
                </div>
                `;
                $('.content-empleos').html($template_cuota);
            }




        });
    </script>

</body>

</html>