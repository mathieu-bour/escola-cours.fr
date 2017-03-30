/**
 * main.js
 */
/*= AJAX Setup
 *=====================================================*/
$.ajaxPrefilter(function (options, originalOptions, jqXHR) {
    jqXHR.setRequestHeader('X-CSRF-Token', Cookies.get('csrfToken'));
});


/*= Sidebar submenus
 *=====================================================*/
$('.menu-item.has-submenu > a').on('click', function (e) {
    e.preventDefault();

    var $item = $(this).parent();
    var isOpen = $item.hasClass('open');
    var $submenu = $item.find('.submenu');
    $item.toggleClass('open');

    if (!isOpen) {
        $submenu.slideDown(300);
    } else {
        $submenu.slideUp(300);
    }
});


/*= Courses Form
 *=====================================================*/
$('#user-add-admin-form').coursesForm();


/*= select2 theme
 *=====================================================*/
$.fn.select2.defaults.set("theme", "bootstrap");


/*= moment
 *=====================================================*/
moment.locale('fr');


/*= Chart.js
 *=====================================================*/
Chart.scaleService.updateScaleDefaults('linear', {
    ticks: {
        beginAtZero: true
    }
});