<?php

/**
 *
 * Function for the custom adding of an image
 *
 */

function dx_get_uploader() {
	// jQuery
	wp_enqueue_script( 'jquery' );
	// This will enqueue the Media Uploader script
	wp_enqueue_media();
	?>
	<div>
		<label for="image_url"><?php _e( 'Upload Custom Image', 'dx-dark-site' ); ?></label>
		<input type="text" name="image_url" id="image_url" class="regular-text" value="<?php echo get_option( 'dx-dark-site-image' ); ?>">
		<input type="button" name="upload-btn" id="upload-btn" class="button-secondary" value="Upload Image">
	</div>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#upload-btn').click(function(e) {
		e.preventDefault();
			var image = wp.media({ 
				title: 'Upload Image',
				// mutiple: true if you want to upload multiple files at once
				multiple: false
			}).open()
			.on('select', function(e){
				// This will return the selected image from the Media Uploader, the result is an object
				var uploaded_image = image.state().get('selection').first();
				// We convert uploaded_image to a JSON object to make accessing it easier
				// Output to the console uploaded_image
				console.log(uploaded_image);
				var image_url = uploaded_image.toJSON().url;
				// Let's assign the url value to the input field
				$('#image_url').val(image_url);
			});
		});
	});
	</script>

	<?php

}

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}
$editor_settings = array(
	'media_buttons' => false,
	'quicktags'     => false,
	'teeny'         => true,
	'textarea_rows' => 10,
);

// set all input names as php vars
$dx_hidden_field_name = 'dx_submit_hidden';
$dx_redirect_name     = 'dx_redirect_to';
$dx_date_name         = 'dx_date';
$dx_time_name         = 'dx_time';
$dx_margin_field_name = 'dx_margin_top';
$dx_editor_id         = 'dx_my_editor';

// checks if the fields have data stored
if ( ! empty( get_option( $dx_editor_id ) ) ) {
	$dx_editor_content = ( get_option( $dx_editor_id ) );
} else {
	$dx_editor_content = '';
}

if ( ! empty( get_option( $dx_redirect_name ) ) ) {
	$dx_redirect_value = get_option( $dx_redirect_name );
} else {
	$dx_redirect_value = '';
}

if ( ! empty( get_option( $dx_date_name ) ) ) {
	$dx_date_value = get_option( $dx_date_name );
} else {
	$dx_date_value = '';
}

if ( ! empty( get_option( $dx_time_name ) ) ) {
	$dx_time_value = get_option( $dx_time_name );
} else {
	$dx_time_value = '';
}

if ( ! empty( get_option( $dx_margin_field_name ) ) ) {
	$dx_margin_field_value = get_option( $dx_margin_field_name );
} else {
	$dx_margin_field_value = 0;
}

// saves data from the input fields in wp_options table
if ( isset( $_POST[ $dx_hidden_field_name ] ) && 'Y' === $_POST[ $dx_hidden_field_name ] ) {
	$dx_editor_content     = sanitize_text_field( $_POST[ $dx_editor_id ] );
	$dx_redirect_value     = esc_url( $_POST[ $dx_redirect_name ] );
	$dx_date_value         = $_POST[ $dx_date_name ];
	$dx_time_value         = $_POST[ $dx_time_name ];
	$dx_margin_field_value = esc_html( $_POST[ $dx_margin_field_name ] );
	$dx_sanitized_content  = sanitize_text_field( $dx_editor_content );
	$dx_sanitized_margin   = esc_html( absint( $dx_margin_field_value ) );

	update_option( $dx_redirect_name, $dx_redirect_value );
	update_option( $dx_date_name, $dx_date_value );
	update_option( $dx_time_name, $dx_time_value );
	update_option( $dx_editor_id, $dx_editor_content );
	update_option( $dx_margin_field_name, esc_html( $dx_sanitized_margin ) );

	if ( isset( $_POST['image_url'] ) ) {
		$image_url = $_POST['image_url'];
		update_option( 'dx-dark-site-image', $image_url );
	}
	?>
	<div class="updated"><p><strong>
		<?php
		_e( 'Settings saved.', 'dx-dark-site' );
		?>
	</strong></p></div>
	<?php
}

$checkbox_enable_redirection_settings = '<input type="checkbox" id="enable-redirection" name="enable-redirection" value="1" ' . checked( 1, get_option( 'enable-redirection' ), false ) . '/>';

$checkbox_enable_countdown_banner_settings = '<input type="checkbox" id="enable-countdown-banner" name="enable-countdown-banner" value="1" ' . checked( 1, get_option( 'enable-countdown-banner' ), false ) . '/>';


?>
<div class="wrap">
<h1><?php _e( 'DX Dark Site Redirection', 'dx-dark-site' ); ?></h1>
<form name="form1" method="post" action="">

	<input type="hidden" name="<?php echo $dx_hidden_field_name; ?>" value="Y">

	<p><?php _e( 'Redirect to:', 'dx-dark-site-redirection' ); ?>
		<input type="text" name="<?php echo $dx_redirect_name; ?>" value="<?php echo $dx_redirect_value; ?>" size="40"> <b><?php echo $checkbox_enable_redirection_settings; ?> Enable redirection</b>
	</p><hr />

	<h1><?php _e( 'DX Countdown Banner', 'dx-dark-site' ); ?></h1>

	<h2 class="description"><?php echo $checkbox_enable_countdown_banner_settings; ?> Enable banner</h2>

	<p><?php _e( 'Expiry Date:', 'dx-dark-site' ); ?>
		<input type="date" name="<?php echo $dx_date_name; ?>" value="<?php echo $dx_date_value; ?>">
	</p><hr />

	<p><?php _e( 'Expiry Time:', 'dx-dark-site' ); ?>
		<input type="time" step=1 name="<?php echo $dx_time_name; ?>" value="<?php echo $dx_time_value; ?>">
	</p><hr />

	<p>
		<p><?php _e( '<span class="dashicons dashicons-editor-help"></span> Placing <b>[global-counter]</b> in your message will show a countdown timer.', 'dx-dark-site' ); ?></p>
		<?php wp_editor( wp_unslash( $dx_editor_content ), $dx_editor_id, $editor_settings ); ?>
	</p>

	<p> <?php _e( 'Margin from top (in rem Units) :', 'dx-dark-site' ); ?>
		<input type="number" name="<?php echo $dx_margin_field_name; ?>" value="<?php echo $dx_margin_field_value; ?>" min=0 max=20>
	</p>

	<p>
		<?php dx_get_uploader(); ?>
	</p>

	<?php submit_button( 'Save', 'primary' ); ?>

</form>
</div>
