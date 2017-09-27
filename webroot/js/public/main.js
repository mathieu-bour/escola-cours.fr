$.fn.extend({
    animateCss: function (animationName) {
        var animationEnd = 'webkitAnimationEnd mozAnimationEnd MSAnimationEnd oanimationend animationend';
        this.addClass('animated ' + animationName).one(animationEnd, function() {
            $(this).removeClass('animated ' + animationName);
        });
    }
});

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

$('#main-carousel').owlCarousel({
    autoplay: true,
    loop: true,
    items: 1
});

$('#user-account-form').coursesForm();
$('#user-register-form').coursesForm();
$('#user-recruitment-form').coursesForm();

$('#user-slots-form').slotsTable();