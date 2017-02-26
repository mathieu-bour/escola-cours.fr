/**
 * Implements postJSON into jQuery
 * @param url
 * @param data
 * @param callback
 */
$.postJSON = function(url, data, callback) {
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'json',
        data: data,
        headers: {
            "X-CSRF-Token": Cookies.get('csrfToken')
        },
        success: callback
    });
};