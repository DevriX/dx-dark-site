$ = jQuery;
console.log("Pesho");

$(document).ready(function($) {
    $("#enable-banner").change( function() {

        if($('#enable-banner').is(':checked')) {
            alert("Banner is enabled.");

            $('#enable-banner').val( 1 );
            var ajax_field_value = $('#enable-banner').val();

            $.post( ajaxurl, { data: { "enable-banner" : ajax_field_value }, action: "add_to_base" } );
        } else {
            alert("Banner is disabled.");

            $('#enable-banner').val( 0 );
            var ajax_field_value = $('#enable-banner').val();

            $.post( ajaxurl, { data: { "enable-banner" : ajax_field_value }, action: "add_to_base" } );
        }
    });

});