jQuery(document).ready(function($) {
    $('#abh_settings').find('input[type=radio]').bind('click', function() {
        abh_submitSettings();
    });
    $('form').attr('enctype', 'multipart/form-data');
    if ($('#description').length > 0) {
        $('#description').parents('.form-table:last').before($('#abh_settings'));
        $('.abh_description').append('<table></table>');
        $('.abh_description').find('table').append($('#description').parents('tr:last'));
    }

    $('#abh_subscribe_subscribe').bind('click', function(event) {
        if (event)
            event.preventDefault();

        $.getJSON(
                'http://squirrly.us6.list-manage.com/subscribe/post-json?c=?',
                {
                    u: '01c449a97e954978ad15d0665',
                    id: 'e30e0cf0f6',
                    EMAIL: $('#abh_subscribe_email').val()
                }, function(data) {
            $.getJSON(
                    abh_Query.ajaxurl,
                    {
                        action: 'abh_settings_subscribe',
                        nonce: abh_Query.nonce
                    }
            );
            $('#abh_option_subscribe').hide();
            $('#abh_option_social').show();
            if (data.result == "success") {
                $('#abh_option_social').prepend('<div id="abh_subscribe_confirmation">Thank you! Last step: Check your email and confirm the registration.</div>');
            }
        });
    });
});

function abh_submitSettings() {
    jQuery.getJSON(
            abh_Query.ajaxurl,
            {
                action: 'abh_settings_update',
                data: jQuery('#abh_settings').find('form').serialize(),
                nonce: abh_Query.nonce
            }
    );
}