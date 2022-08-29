document.addEventListener("DOMContentLoaded", function (e) {

    // Ocultar textos del navbar en algunas paginas
    let URLactual = window.location.href;

    let navbar = document.getElementById('navbar');
    let icono_resposive = document.getElementsByClassName('navbar-toggler');
    let logo_click = document.getElementsByClassName('navbar-brand');

    if (URLactual.indexOf("emmaconsultora.com.ar/venta-curso.php") != -1 || URLactual.indexOf("emmaconsultora.com.ar/oferta-laboral.php") != -1 || URLactual.indexOf("emmaconsultora.com.ar/ofertas-laborales.php") != -1 || URLactual.indexOf("emmaconsultora.com.ar/login_EMMA.php") != -1) {
        navbar.style.display = 'none';
        icono_resposive[0].style.display = 'none';
        $(logo_click[0]).attr("href", "../");

    } else if (URLactual.indexOf("emmaconsultora.com.ar") != -1) {

        if (URLactual.indexOf("cpanel.php") != -1) {
            return 0;
        } else {
            navbar.style.display = 'visibility';
            icono_resposive[0].style.display = 'visibility';
            $('.click-logo').addClass('nav-link');
            $('.click-logo').attr("href", "#hero");

            // Smooth scrolling
            let scrollLink = $('.nav-link');
            scrollLink.click(function (e) {
                e.preventDefault();
                $('body,html').animate({
                    scrollTop: ($(this.hash).offset().top) - 85
                }, 1000);
            });

        }


    }


});
