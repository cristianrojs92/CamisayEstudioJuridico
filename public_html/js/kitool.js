jQuery(document).ready(function ($) {

    // Sroll y Boton ir a arriba
    $(window).scroll(function () {
        if ($(this).scrollTop() > 100) {
            $('.back-to-top').fadeIn('slow');
        } else {
            $('.back-to-top').fadeOut('slow');
        }
    });

    //Evento Click de boton volver a arriba
    $('.back-to-top').click(function () {
        $('html, body').animate({scrollTop: 0}, 1500, 'easeInOutExpo');
        return false;
    });

    // Inicializar  wowjs para animacion
    new WOW().init();


    // Slider de tecnologias, uso libraria owlCarousel
    $(".tecnologias-carousel").owlCarousel({
        autoplay: true,
        dots: true,
        loop: true,
        responsive: {0: {items: 2}, 768: {items: 4}, 900: {items: 6}
        }
    });

});