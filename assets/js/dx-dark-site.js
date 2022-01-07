$ = jQuery;

$(document).ready(function($) {
    $("#enable-banner").change( function() {

        if($('#enable-banner').is(':checked')) {
            alert("Redirection banner is enabled.");

            $('#enable-banner').val( 1 );
            var ajax_field_value = $('#enable-banner').val();

            $.post( ajaxurl, { data: { "enable-banner" : ajax_field_value }, action: "add_to_base" } );

			$.post( ajaxurl, { data: { "enable-countdown-banner" : 0 }, action: "add_to_base" } );

			$.post( ajaxurl, { data: { "enable-redirection" : 0 }, action: "add_to_base" } );

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

			$.post( ajaxurl, { data: { "enable-banner" : 0 }, action: "add_to_base" } );

			$.post( ajaxurl, { data: { "enable-redirection" : 0 }, action: "add_to_base" } );

			window.setTimeout( function(){
				location.reload();
			}, 1000 );

        } else {
            alert("Countdown banner is disabled.");

            $('#enable-countdown-banner').val( 0 );
            var ajax_field_value = $('#enable-countdown-banner').val();

            $.post( ajaxurl, { data: { "enable-countdown-banner" : ajax_field_value }, action: "add_to_base" } );
        }
    });

});

$(document).ready(function($) {
    $("#enable-redirection").change( function() {

        if($('#enable-redirection').is(':checked')) {
            alert("Redirection is enabled.");

            $('#enable-redirection').val( 1 );
            var ajax_field_value = $('#enable-redirection').val();

            $.post( ajaxurl, { data: { "enable-redirection" : ajax_field_value }, action: "add_to_base" } );

			$.post( ajaxurl, { data: { "enable-countdown-banner" : 0 }, action: "add_to_base" } );

			$.post( ajaxurl, { data: { "enable-banner" : 0 }, action: "add_to_base" } );

			window.setTimeout( function(){
				location.reload();
			}, 1000 );

        } else {
            alert("Redirection is disabled.");

            $('#enable-redirection').val( 0 );
            var ajax_field_value = $('#enable-redirection').val();

            $.post( ajaxurl, { data: { "enable-redirection" : ajax_field_value }, action: "add_to_base" } );
        }
    });

});