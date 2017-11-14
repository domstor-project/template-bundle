jQuery(document).ready(function ($) {
    $('#switchLocation').click(function (e) {
        e.preventDefault();
        var location = $('#switchLocation').data('target-location');
        if ($.isNumeric(location))
        {
            Cookies.set('location_id', location, { expires: 30, path: '/' });
            window.location = window.location.pathname;
        }
    });
});
