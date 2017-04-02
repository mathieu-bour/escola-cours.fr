$('.toggle-nav').on('click', function (e) {
    e.preventDefault();
    var $nav = $('.nav');
    var $overlay = $('#overlay');

    $nav.toggleClass('open');

    if ($nav.hasClass('open')) {
        $overlay.fadeIn(300);
    } else {
        $overlay.fadeOut(300);
    }
});

$('.owl-carousel').owlCarousel({
    autoplay: true,
    loop: true,
    items: 1
});

$('#user-register-form, #user-account-form').coursesForm();

$('#user-slots-form').slotsTable();