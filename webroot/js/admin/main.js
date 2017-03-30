$.ajaxPrefilter(function (options, originalOptions, jqXHR) {
    jqXHR.setRequestHeader('X-CSRF-Token', Cookies.get('csrfToken'));
});

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
$('#user-add-admin-form').coursesForm();

$.fn.select2.defaults.set("theme", "bootstrap");

moment.locale('fr');

Chart.scaleService.updateScaleDefaults('linear', {
    ticks: {
        beginAtZero: true
    }
});