$.fn.slotsTable = function () {
    var $checkboxes = $(this).find('input[type=checkbox]');

    $checkboxes.each(function () {
        if ($(this).prop('checked')) {
            $(this).parent().addClass('checked');
        }

        $(this).on('change', function () {
            $(this).parent().toggleClass('checked', $(this).prop('checked'));
        });
    });
};