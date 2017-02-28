$.fn.populate = function(data) {
    var $this = $(this);

    $.each(data, function (val, text) {
        $this.append($('<option>').attr('value', val).text(text));
    });

    return $this;
};