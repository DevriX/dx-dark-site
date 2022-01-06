$ = jQuery;

$(document).ready(function($) {
    $("#enable-banner").change( function() {

        if($('#enable-banner').is(':checked')) {
            alert("Redirection banner is enabled.");

            $('#enable-banner').val( 1 );
            var ajax_field_value = $('#enable-banner').val();

            $.post( ajaxurl, { data: { "enable-banner" : ajax_field_value }, action: "add_to_base" } );
        } else {
            alert("Redirection banner is disabled.");

            $('#enable-banner').val( 0 );
            var ajax_field_value = $('#enable-banner').val();

            $.post( ajaxurl, { data: { "enable-banner" : ajax_field_value }, action: "add_to_base" } );
        }
    });

});

$(document).ready(function($) {
    $("#enable-countdown-banner").change( function() {

        if($('#enable-countdown-banner').is(':checked')) {
            alert("Countdown banner is enabled.");

            $('#enable-countdown-banner').val( 1 );
            var ajax_field_value = $('#enable-countdown-banner').val();

            $.post( ajaxurl, { data: { "enable-countdown-banner" : ajax_field_value }, action: "add_to_base" } );
        } else {
            alert("Countdown banner is disabled.");

            $('#enable-countdown-banner').val( 0 );
            var ajax_field_value = $('#enable-countdown-banner').val();

            $.post( ajaxurl, { data: { "enable-countdown-banner" : ajax_field_value }, action: "add_to_base" } );
        }
    });

});