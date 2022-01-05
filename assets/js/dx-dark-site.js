$ = jQuery;

$(document).ready(function($) {
    $("#enable-feature").change( function() {

        if($('#enable-feature').is(':checked')) {
            alert("Banner is enabled.");

            $('#enable-feature').val( 1 );
            var ajax_field_value = $('#enable-feature').val();

            $.post( ajaxurl, { data: { "enable-feature" : ajax_field_value }, action: "add_to_base" } );
        } else {
            alert("Banner is disabled.");

            $('#enable-feature').val( 0 );
            var ajax_field_value = $('#enable-feature').val();

            $.post( ajaxurl, { data: { "enable-feature" : ajax_field_value }, action: "add_to_base" } );
        }
    });

});