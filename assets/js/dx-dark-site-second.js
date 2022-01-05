$ = jQuery;

$(document).ready(function($) {
    $("#enable-feature-second").change( function() {

        if($('#enable-feature-second').is(':checked')) {
            alert("Banner is enabled.");

            $('#enable-feature-second').val( 1 );
            var ajax_field_value = $('#enable-feature-second').val();

            $.post( ajaxurl, { data-second: { "enable-feature-second" : ajax_field_value }, action: "add_to_base" } );
        } else {
            alert("Banner is disabled.");

            $('#enable-feature-second').val( 0 );
            var ajax_field_value = $('#enable-feature-second').val();

            $.post( ajaxurl, { data-second: { "enable-feature-second" : ajax_field_value }, action: "add_to_base" } );
        }
    });

});