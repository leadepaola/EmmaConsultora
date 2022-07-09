<!doctype html>
<html lang="es">

<head>
  <?php include('contenido-head.php') ?>
</head>

<body id="inicio">
  <?php include('nav.php') ?>

  <section id="hero">
    <div class="container animate__animated animate__fadeInLeft animate__slow">
      <div class="content-center topmargin-lg ">
        <h1>E<span>MM</span>A Consultora</h1>
        <p class="text-intro">
            Somos un equipo de profesionales dedicado a la asesoría y capacitación en el
            desarrollo de habilidades y competencias necesarias para el logro de
            objetivos individuales, grupales y organizacionales. Trabajamos en el diseño a
            medida de las mejores estrategias para que cada cliente logre sus objetivos. <br/>
            Nuestro objetivo es que cada cliente logre el suyo.<br/>
            Al mismo tiempo desarrollamos procesos de selección de personal.<br/>
            Nuestra prioridad es buscar el mejor empleo según el perfil de cada
            postulante y brindar a las organizaciones soluciones de calidad.

        </p>
        <a href="#servicios" class="nav-link btn-responsive btn-hero btn-primary topmargin-lg ">COMENZAR</a>
      </div>
    </div>
  </section>

  <section class="container topmargin-sm " id="servicios">
    <div class="title">
      <h2>Servicios</h2>
      <p class="text-muted">Contamos con una gran variedad de servicios para ofrecerte</p>
    </div>
    <div class="container-services">
      <div class="services">
        <h3>Selección</h3>
        <img loading="lazy" src="assets/images/seleccion.png" class="img-fluid" alt="">
        <p>
          ⦁ Asistencias a las empresas en la elaboración del perfil del Recurso Humano idóneo para el desempeño de una tarea específica. <br><br>
          ⦁ Búsqueda y selección de los Recursos Humanos requeridos por la empresa.
        </p>
      </div>
      <div class="services">
        <h3>Formación para Empresas</h3>
        <img loading="lazy" src="assets/images/formacion.png" class="img-fluid" alt="">
        <p>Desarrollamos programas a medida según las necesidades de cada cliente. A través de la articulación de la formación online y presencial, permitimos que los Recursos Humanos se desarrollen de forma más competitiva en su lugar de trabajo.</p>
      </div>
      <div class="services">
        <h3>Desarrollo de Talentos</h3>
        <img loading="lazy" src="assets/images/desarrollo.png" class="img-fluid" alt="">
        <p>Desarrollar un talento consiste en potenciar la capacidad intelectual o aptitud de una persona buscando el desarrollo de sus habilidades y competencias. También es adquirir las herramientas que permitan desarrollar con mucha habilidad una actividad.</p>
      </div>
      <div class="services">
        <h3>Programas para Empresas</h3>
        <img loading="lazy" src="assets/images/programa.png" class="img-fluid" alt="">
        <p>Trabajamos en la motivación y el desarrollo de habilidades para que tus empleados puedan trabajar en equipo teniendo por objetivo lograr el mejor producto o servicio de tu empresa.</p>
      </div>
    </div>
  </section>

  <section class="container" id="cursos">
    <div class="container-cursos">
      <div class="title">
        <h2>Cursos</h2>
        <p class="text-muted">Cursos brindados por el equipo de EMMA</p>
      </div>
      <div class="row" id="row-curso">

      </div>
    </div>
  </section>

  <section class="container" id="programas">
    <div class="container-programas">
      <div class="title">
        <h2>Programas para empresas</h2>
        <p class="text-muted">En EMMA ofrecemos los siguientes programas</p>
      </div>
      <div class="row" id="row-programas">


      </div>
    </div>
  </section>

  <section class="container" id="empleos">
    <div class="title">
      <h2>Bolsa de Empleo</h2>
      <p class="text-muted">Postulate al empleo que mas se adapte a tus gustos</p>
    </div>
    <div class="row">
      <section class="trabajos col-lg-9 col-md-12 col-sm-12 clearfix">
        <div class="row" id="empleo-body">


        </div>
        <div class="row">
          <a href="ofertas-laborales.php" class="col-8 btn btn-dark p-lg-3 p-2" style="margin:20px auto 30px auto"> Ver todos los empleos disponibles</a>
        </div>

      </section>

      <aside class="col-lg-3 col-md-12 col-sm-12" id="novedades">
        <h5 class="text-center p-0 m-0">Ultimas novedades</h5>

      </aside>

    </div>

  </section>

  <section class="container-fluid topmargin-lg mapa">
    <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d13133.994066057821!2d-58.44968706298634!3d-34.616840419787444!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x95bcca3911f8ab2d%3A0x27b394c2f3d87d2d!2sCaballito%2C%20CABA!5e0!3m2!1ses!2sar!4v1617625328891!5m2!1ses!2sar" width="100%" height="400" frameborder="0" style="border:0;" allowfullscreen="" aria-hidden="false" tabindex="0"></iframe>
  </section>


  <section class="bottommargin-lg" id="contacto">
    <div class="container form-box">
      <div class="row">
        <div class="title contact-header col-12">
          <h2>Escribinos</h2>
          <p class="text-muted mt-3">Dejanos tu mensaje y nos comunicaremos contigo</p>
        </div>

        <div class="container-contenido col-md-6 ">
          <div class="contenido">
            <i class="fas fa-map-marker-alt icono-info"> </i>
            <p>CABA, Zona Caballito</p>
          </div>
          <div class="contenido">
            <i class="far fa-envelope icono-info"></i>
            <p>emmatalentos@gmail.com</p>
          </div>
          <div class="contenido">
            <i class="fas fa-phone icono-info"></i>
            <p>+54 9 11 5262-4856 / +54 9 11 5459-9712</p>
          </div>
          <div class="contenido">
            <i class="far fa-clock icono-info"></i>
            <p>Lunes a viernes</p>
          </div>
        </div>
        <div class="container-form col-md-6  ">
          <form id="form-consulta" class="formulario">
            <input type="text" name="nombre" class="mb-0" placeholder="Nombre" id="nombre">
            <p class="p-0 m-0 error-nombre text-danger"></p>
            <input type="text" name="email" placeholder="E-mail" id="email" class="mb-0 mt-3">
            <p class="p-0 m-0 error-email text-danger"></p>

            <input type="tel" name="telefono" placeholder="Telefono" id="telefono" class="mb-0 mt-3">
            <p class="error-telefono text-danger"></p>

            <textarea name="mensaje" id="mensaje" placeholder="Mensaje" class="mb-0 mt-3"></textarea>
            <p class="error-mensaje text-danger"></p>
            <div id="exito"></div>
            <button class="btn pl-5 pr-5 mt-3 enviar">Enviar</button>
          </form>
        </div>
      </div>
  </section>

  <div class="modal fade" id="modal-success" tabindex="-1" role="dialog">
    <div class="modal-dialog modal-confirm" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <div class="icon-box">
            <i class="fas fa-check"></i>
          </div>
          <h4 class="modal-title">Exito!!</h4>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <p>Tu consulta se realizo con exito.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-success btn-block" data-dismiss="modal">Cerrar</button>
        </div>
      </div>
    </div>
  </div>

  <?php include('footer.php') ?>

  <?php include('assets-scripts.php') ?>

  <script>
    $(document).ready(function() {

      fetchEmpleos();
      fetchCursos();
      fetchProgramas();
      fetchNovedades();

      function fetchEmpleos() {
        $.ajax({
          url: 'crud/ajax/empleo/list-top-empleo.php',
          type: 'GET',
          success: function(response) {
            let listEmpleos = JSON.parse(response);
            let template = '';
            listEmpleos.forEach(listEmpleo => {
              template += `
                      <div id="${listEmpleo.id_empleo}" class="col-lg-6 col-md-6 col-sm-12">
                            <div class="card text-center">
                                <div class="card-body">
                                    <h5 class="card-title">${listEmpleo.titulo}</h5>
                                    <div class="contenido-empleo">
                                        <i class="fas fa-user"></i>
                                        <p>${listEmpleo.nombre_categoria}</p>
                                    </div>
                                    <div class="contenido-empleo">
                                        <i class="far fa-clock"></i>
                                        <p>${listEmpleo.disponibilidad_horaria}</p>
                                    </div>
                                    <div class="contenido-empleo">
                                        <i class="fas fa-map-marker-alt"></i>
                                        <p>${listEmpleo.nombre_localidad}</p>
                                    </div>
                                    <div class="contenido-empleo">
                                        <i class="fas fa-address-card"></i>
                                        <p>${listEmpleo.rango_trabajo}</p>
                                    </div>
                                </div>
                                <a href="oferta-laboral.php?id=${listEmpleo.id_empleo}" class="ver-empleos">Ver mas <i class="fas fa-arrow-right"></i></a>
                            </div>
                        </div>
                    `
            });

            $('#empleo-body').html(template);
          }

        });
      }

      function fetchCursos() {
        $.ajax({
          url: 'crud/ajax/curso/list-curso.php',
          type: 'GET',
          success: function(response) {
            let listCursos = JSON.parse(response);
            let template = '';
            listCursos.forEach(listCurso => {
              template += `
              <div class="col-lg-4 col-md-6 curso">
                  <div class="card text-center">
                      <div class="img-effect">
                          <img loading="lazy" src="crud/ajax/curso/${listCurso.imagen_curso}" class="card-img-top img-curso" style="max-height:155px" alt="">
                      </div>
                      <div class="card-body">
                          <h5 class="card-title p-2">${listCurso.titulo}</h5>
                          <p class="duracion text-left">
                              <img src="assets/images/alarm-outline.svg" alt="" width="22px" style="margin-top:-4px;">
                              Duracion: ${listCurso.duracion}
                          </p>
                          <p class="modalidad text-left">
                              <img src="assets/images/star-outline.svg" alt="" width="22px" style="margin-top:-4px;">
                              Modalidad: ${listCurso.modalidad}
                          </p>
                          ${listCurso.precio != 0 ? 
                            `<p class="precio text-left">
                            <img src="assets/images/pricetag-outline.svg" alt="" width="22px" style="margin-top:-4px;">
                            Precio: <span class="text-success">$${listCurso.precio}</span>
                            </p>`
                          : ''}
                          <a href="venta-curso.php?id=${listCurso.id_curso}" class="btn btn-block btn-danger mt-3 p-2">Ver mas</a>
                      </div>
                  </div>
              </div>
                    `
            });

            $('#row-curso').html(template);
          }

        });
      }

      function fetchProgramas() {
        $.ajax({
          url: 'crud/ajax/programa/list-programa.php',
          type: 'GET',
          success: function(response) {
            let listProgramas = JSON.parse(response);
            let template = '';
            listProgramas.forEach(listPrograma => {
              template += `
              <div class="col-lg-4 col-md-6 programas">
                <div class="card">
                    <div class="card-body ">
                        <h5 class="card-title text-center">${listPrograma.titulo}</h5>
                        <img loading="lazy" class="card-img-top" src="crud/ajax/programa/${listPrograma.imagen_programa}" alt="Card image cap">
                        <div class="expandable">
                            <p class="card-text mt-3" style="font-size: .9rem;">${listPrograma.descripcion}</p>
                        </div>
                        <div class="conteiner-button mt-4" style="display:flex; justify-content: center;">
                            <a target="_blank" href="https://wa.me/+54${listPrograma.celular}?text=Hola, quiero saber mas sobre el curso" class="btn btn-success p-3">Contactar por WhatsApp
                                <i class="fab fa-whatsapp" style="font-size: 20px; margin-left:7px;"></i>
                            </a>
                        </div>
                    </div>
                </div>
              </div>
                    `
            });

            $('#row-programas').html(template);
            //Programas para empresa
            $('div.expandable p').expander({
              slicePoint: 100, // si eliminamos por defecto es 100 caracteres
              expandText: 'Leer Mas', // por defecto es 'read more...'
              collapseTimer: 10000, // tiempo de para cerrar la expanción si desea poner 0 para no cerrar
              userCollapseText: 'Leer Menos' // por defecto es 'read less...'
            });
          }

        });
      }

      $('#form-consulta').submit(function(e) {

        e.preventDefault();

        $('#exito').empty();
        $(".enviar").prop("disabled", true);
        $(".enviar").html(
          `<span class="spinner spinner-border spinner-border-sm" role="status" aria-hidden="true"></span> Cargando...`);


        setTimeout(function() {

          let error = false;

          //valida nombre
          $nombre = $('#nombre').val().trim();
          var regexNombre = /^[a-zA-Z ]{3,80}$/;

          if (!regexNombre.test($('#nombre').val())) {
            error = true;
            $('.error-nombre').html('El nombre no es correcto');
          } else {
            $('.error-nombre').empty();
          }

          //valida email 
          $email = $('#email').val().trim();
          var regexEmail = /[\w-\.]{2,}@([\w-]{2,}\.)*([\w-]{2,}\.)[\w-]{2,4}/;

          if (!regexEmail.test($('#email').val())) {
            error = true;
            $('.error-email').html('El E-mail es invalido');
          } else {
            $('.error-email').empty();
          }

          //valida telefono
          $telefono = $('#telefono').val().trim();
          var regexTelefono = /(?<=\s|:)\(?(?:(0?[1-3]\d{1,2})\)?(?:\s|-)?)?((?:\d[\d-]{5}|15[\s\d-]{7})\d+)/;

          if (!regexTelefono.test($('#telefono').val())) {
            error = true;
            $('.error-telefono').html('telefono invalido ej de telefono valido: +54 11 4444-0000');
          } else {
            $('.error-telefono').empty();
          }

          //Valida comentario

          $mensaje = $('#mensaje').val().trim();
          if (($mensaje.length > 5) && ($mensaje.length <= 2000)) {
            $('.error-mensaje').empty();
          } else {
            error = true;
            $('.error-mensaje').html('El comentario esta vacio o supera los 2000 caracteres');
          }

          if (error == false) {

            $.ajax({
              url: 'crud/ajax/consulta/add-consulta.php',
              method: 'POST',
              data: $('#form-consulta').serialize(),
              success: function(data) {
                if (data == 'exito') {
                  $(".enviar").prop("disabled", false);
                  $(".enviar").html('Enviar');
                  $('#modal-success').modal('show');
                  $('#form-consulta').trigger('reset');
                } else if (data == "Error en el envio, revisa que los campos esten bien completados") {
                  $fallo = `<div class="alert alert-danger" role="alert">
                                            ${data}
                                        </div>`;
                  $('#exito').append($fallo);
                } else if (data == "Fallo en la consulta") {
                  $fallo = `<div class="alert alert-danger" role="alert">
                                            ${data}
                                        </div>`;
                  $('#exito').append($fallo);
                }
              }
            });
          } else {
            $(".enviar").prop("disabled", false);
            $(".enviar").html('Enviar');
            $('#exito').empty();
          }
        }, 1000);
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
                        <div class="novedades card d-md-inline-flex ">
                          <img class="card-img-top " src="crud/ajax/novedades/${listNovedad.imagen_novedades}" alt="imagen-anuncio">
                          <div class="card-body">
                            <h5 class="card-title text-dark">${listNovedad.titulo}</h5>
                            <p class="card-text texto-novedad text-secondary">${listNovedad.descripcion} (...)</p>
                            <a target="_blank" href="${listNovedad.link}" class="leer-articulo">Leer Articulo</a>
                          </div>
                        </div>  
                        `
            });
            $('#novedades').append(template);
          }
        });
      }
    });
  </script>
</body>

</html>