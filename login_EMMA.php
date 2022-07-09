<?php
session_start();

if (isset($_SESSION["user"])) {
    header("location: cpanel.php");
}

?>
<!doctype html>
<html lang="es">

<head>
    <?php include('contenido-head.php') ?>
</head>

<body>
    <?php include('nav.php') ?>

    <div class="container" style="margin-top:120px; ">
        <div class="row content-login">
            <div class="col-md-6 mb-2">
                <img src="assets/images/undraw_remotely_2j6y.svg" class="img-fluid" alt="imagen.svg">
            </div>
            <div class="col-md-6 mt-5">
                <h3 class="signin-text mb-4 text-center">Ingresar al panel de administracion</h3>
                <form>
                    <div class="form-group">
                        <label for="user">Usuario</label>
                        <input type="user" name="user" id="user" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="user">Contraseña</label>
                        <input type="password" name="password" id="password" class="form-control">
                    </div>
                    <div class="errors">
                    </div>
                    <div class="container-btn">
                        <button class="btn btn-class enviar">Ingresar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="modal-success" tabindex="-1" role="dialog">
        <div class="modal-dialog modal-confirm" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <div class="icon-box">
                        <i class="fas fa-check"></i>
                    </div>
                    <h4 class="modal-title">Exito!!</h4>
                </div>
                <div class="modal-body">
                    <p class="text-center mb-2">Logueado correctamente</p>
                    <span>Aguarde unos instantes a ser redirigido...</span>
                </div>
            </div>
        </div>
    </div>

    <?php include('footer.php') ?>
    <?php include('assets-scripts.php') ?>

    <script>
        $(document).ready(function() {
            $(".enviar").on("click", function(e) {
                e.preventDefault();

                let usuario = $('#user').val();
                let password = $('#password').val();

                let error = false;

                $(".enviar").prop("disabled", true);
                $(".enviar").html(
                    `<span class="spinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...`
                );

                setTimeout(function() {

                    $.ajax({
                        url: 'crud/login/login_start.php',
                        method: 'POST',
                        data: {
                            usuario,
                            password
                        },
                        cache: "false",
                        success: function(response) {
                            $('.errors').empty();
                            $(".enviar").prop("disabled", false);
                            $(".enviar").html('Ingresar');
                            if (response == "1") {
                                $('#modal-success').modal('show');
                                setTimeout(function() {

                                    $(location).attr('href', 'cpanel.php');
                                }, 2000);

                            } else {
                                template = `<div class="alert alert-danger error-alert" role="alert">
                                        Datos ingresados incorrectamente
                                    </div>`;
                                $('.errors').html(template);
                            }
                        }
                    });


                }, 1000);
            });

        });
    </script>

</body>

</html>