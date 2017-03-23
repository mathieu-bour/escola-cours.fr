$('.menu-item.has-submenu').on('click', function (e) {
    e.preventDefault();

    var isOpen = $(this).hasClass('open');
    var $submenu = $(this).find('.submenu');
    $(this).toggleClass('open');

    if (!isOpen) {
        $submenu.slideDown(300);
    } else {
        $submenu.slideUp(300);
    }
});