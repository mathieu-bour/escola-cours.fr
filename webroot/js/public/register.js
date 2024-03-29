/**
 * Register page
 * @author Mathieu Bour
 */

/**
 * The register form
 * @type {jQuery}
 */
var $registerForm = $('#user-register-form');

if ($registerForm.length > 0) {
    /*= Init
     *=====================================================*/
    // jQuery init
    /**
     * Still the register form, remove register- for better lisibility
     * @type {jQuery}
     */
    var $form = $registerForm;

    var formData = {};

    /**
     * The form message span
     * @type {jQuery}
     */
    var $formMessage = $('#register-form-message');

    /*= Owl Carousel Init
     *=====================================================*/
    var $formCarousel = $('#register-form-carousel');
    $formCarousel.owlCarousel({
        items: 1,
        mouseDrag: false,
        touchDrag: false,
        pullDrag: false,
        rewind: false,
        slideBy: 1
    });

    /**
     * The form next button
     * @type {jQuery}
     */
    var $formNext = $('#register-form-next');

    $formNext.on('click', function (e) {
        e.preventDefault();
        $formCarousel.trigger('next.owl.carousel');

        $formNext.hide();
        setFormMessage('', 'success');
    });

    /*= Stage 1
     *=====================================================*/
    var $locateBtn = $('#locate-btn');
    var defaultMap = {
        zoom: 5,
        center: {
            lat: 47,
            lng: 2
        }
    };
    var center;
    var marker = null;

    /**
     * Set the form message
     * @param {string} message the message
     * @param {string} state the state (success|danger|info|warning)
     * @return {undefined}
     */
    var setFormMessage = function (message, state) {
        $formMessage.text(message);
        if (state !== undefined) {
            $formMessage.removeAttr('class');
            $formMessage.addClass('text-' + state);
        }
        $formMessage.animateCss('bounceIn');
    };

    /**
     * Reset the marker position and the map center
     * @return {undefined}
     */
    var resetMarker = function () {
        if (marker !== null) {
            marker.setMap(null);
        }
        gmap.setZoom(defaultMap.zoom);
        gmap.setCenter(defaultMap.center);
    };

    /**
     * The main Google Map
     * @type {google.maps.Map}
     */
    var gmap = new google.maps.Map(document.getElementById('register-form-map'), {
        draggable: false,
        disableDefaultUI: true,
        scrollwheel: false,
        navigationControl: false,
        mapTypeControl: false,
        scaleControl: false,
        zoom: defaultMap.zoom,
        center: defaultMap.center
    });

    $locateBtn.on('click', function (e) {
        e.preventDefault();
        var $dynamicAddress = $form.find('#dynamic-address');
        var dynamicAddress = $dynamicAddress.val();

        if (dynamicAddress !== null) {
            var geocoder = new google.maps.Geocoder();

            geocoder.geocode({'address': dynamicAddress}, function (results, status) {
                if (status === 'OK') {
                    results = results[0];

                    // Format address
                    var address_components = {};
                    $.each(results.address_components, function(key, val) {
                        address_components[val.types[0]] = val.long_name;
                    });
                    $('input[name="address"]').val(address_components['street_number'] + ' ' + address_components['route']);
                    $('input[name="city"]').val(address_components['locality']);
                    $('input[name="zip_code"]').val(address_components['postal_code']);

                    // Place map and marker
                    $dynamicAddress.val(results.formatted_address);

                    center = {
                        lat: results.geometry.location.lat(),
                        lng: results.geometry.location.lng()
                    };

                    resetMarker();
                    marker = new google.maps.Marker({
                        position: center,
                        animation: google.maps.Animation.DROP,
                        map: gmap
                    });

                    gmap.setZoom(17);
                    gmap.setCenter(center);

                    $formMessage.show();
                    $formNext.show();
                    setFormMessage('C\'est ici ? Si non, essayez d\'entrer une adresse plus précise !', 'success');
                } else {
                    resetMarker();

                    $formNext.hide();
                    setFormMessage('On ne vous trouve pas ! Essayez d\'entrer une adresse plus précise !', 'danger');
                }
            });
        }
    });

    /*= Stage 2
     *=====================================================*/
    var $formInfoInputs = $('#lastname, #firstname, #email, #telephone');
    $formInfoInputs.on('keyup keypress blur change', function (e) {
        var allFilled = true;
        $formInfoInputs.each(function () {
            if ($(this).val() === '') {
                allFilled = false;
            }
        });

        if (allFilled) {
            $formNext.show();
            setFormMessage('Parfait ! Vous pouvez continuer.', 'success');
        } else {
            $formNext.hide();
            setFormMessage('', 'success');
        }
    });

    /*= Stage 3
     *=====================================================*/
    var $formPassword = $('#password');
    var $formPasswordConfirm = $('#password-confirm');
    var $formPasswordInputs = $('#password, #password-confirm');
    $formPasswordInputs.on('keyup keypress blur change', function (e) {
        var allFilled = $formPassword.val() !== '' && $formPasswordConfirm.val() !== '';
        var identical = $formPassword.val() === $formPasswordConfirm.val();

        if (allFilled && identical) {
            $formNext.show();
            setFormMessage('Excellent ! Il ne vous plus qu\'à choisir vos cours !', 'success');
        } else if(allFilled && !identical) {
            $formNext.hide();
            setFormMessage('Les mots de passe ne correspondent pas', 'danger');
        } else {
            $formNext.hide();
            setFormMessage('', 'success');
        }
    });
}
