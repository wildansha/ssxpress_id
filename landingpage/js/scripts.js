/*!
* Start Bootstrap - Agency v7.0.12 (Bootstrap 4 Adaptation)
*/

$(document).ready(function () {

    // Navbar shrink function
    function navbarShrink() {
        var $navbar = $('#mainNav');
        if (!$navbar.length) return;

        if ($(window).scrollTop() === 0) {
            $navbar.removeClass('navbar-shrink');
        } else {
            $navbar.addClass('navbar-shrink');
        }
    }

    // Initial check
    navbarShrink();

    // On scroll
    $(window).on('scroll', navbarShrink);

    // Activate Bootstrap 4 ScrollSpy
    $('body').scrollspy({
        target: '#mainNav',
        offset: 74
    });

    // Collapse responsive navbar when nav-link clicked
    $('#navbarResponsive .nav-link').on('click', function () {
        var $toggler = $('.navbar-toggler');
        if ($toggler.is(':visible')) {
            $toggler.trigger('click');
        }
    });

});
