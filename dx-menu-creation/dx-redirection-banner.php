<?php

/**
 *
 * Function for the custom adding of an image
 *
 */
function dx_get_uploader_redirection_banner() {
	// jQuery
	wp_enqueue_script( 'jquery' );
	// This will enqueue the Media Uploader script
	wp_enqueue_media();
	?>
	<div>
		<label for="image_url_redirection"><?php _e( 'Upload Custom Image', 'dx-dark-site-redirection-banner' ); ?></label>
		<input type="text" name="image_url_redirection" id="image_url_redirection" class="regular-text" value="<?php echo get_option( 'dx-dark-site-image-redirection-banner' ); ?>">
		<input type="button" name="upload-btn_redirection" id="upload-btn_redirection" class="button-secondary" value="Upload Image">
	</div>
	<script type="text/javascript">
	jQuery(document).ready(function($){
		$('#upload-btn_redirection').click(function(e) {
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
				$('#image_url_redirection').val(image_url);
			});
		});
	});
	</script>

	<?php

}

if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}

	$editor_settings_second_banner = array(
		'media_buttons' => false,
		'quicktags'     => false,
		'teeny'         => true,
		'textarea_rows' => 10,
	);

	// set all input names as php vars
	$dx_hidden_field_name_second_banner = 'dx_submit_hidden_second_banner';
	$dx_redirect_name_second_banner     = 'dx_redirect_to_second_banner';
	$dx_seconds_name_second_banner      = 'dx_seconds_to_second_banner';
	$dx_margin_field_name_second_banner = 'dx_margin_top_second_banner';
	$dx_editor_id_second_banner         = 'dx_my_editor_second_banner';

	// checks if the 4 fields have data stored
	if ( ! empty( get_option( $dx_editor_id_second_banner ) ) ) {
		$dx_editor_content_second_banner = ( get_option( $dx_editor_id_second_banner ) );
	} else {
		$dx_editor_content_second_banner = '';
	}

	if ( ! empty( get_option( $dx_redirect_name_second_banner ) ) ) {
		$dx_redirect_value_second_banner = get_option( $dx_redirect_name_second_banner );
	} else {
		$dx_redirect_value_second_banner = '';
	}

	if ( ! empty( get_option( $dx_seconds_name_second_banner ) ) ) {
		$dx_seconds_value_second_banner = get_option( $dx_seconds_name_second_banner );
	} else {
		$dx_seconds_value_second_banner = '';
	}

	if ( ! empty( get_option( $dx_margin_field_name_second_banner ) ) ) {
		$dx_margin_field_value_second_banner = get_option( $dx_margin_field_name_second_banner );
	} else {
		$dx_margin_field_value_second_banner = 0;
	}

	// saves data from the 5 input fields in wp_options table
	if ( isset( $_POST[ $dx_hidden_field_name_second_banner ] ) && 'Y' === $_POST[ $dx_hidden_field_name_second_banner ] ) {
		$dx_redirect_value_second_banner     = esc_url( $_POST[ $dx_redirect_name_second_banner ] );
		$dx_seconds_value_second_banner      = sanitize_text_field( $_POST[ $dx_seconds_name_second_banner ] );
		$dx_editor_content_second_banner     = sanitize_text_field( $_POST[ $dx_editor_id_second_banner ] );
		$dx_margin_field_value_second_banner = esc_html( $_POST[ $dx_margin_field_name_second_banner ] );

		$dx_sanitized_content_second_banner = sanitize_text_field( $dx_editor_content_second_banner );
		$dx_sanitized_margin_second_banner  = esc_html( absint( $dx_margin_field_value_second_banner ) );


		update_option( $dx_redirect_name_second_banner, $dx_redirect_value_second_banner );
		update_option( $dx_seconds_name_second_banner, $dx_seconds_value_second_banner );
		update_option( $dx_editor_id_second_banner, $dx_editor_content_second_banner );
		update_option( $dx_margin_field_name_second_banner, esc_html( $dx_sanitized_margin_second_banner ) );

		if ( isset( $_POST['image_url_redirection'] ) ) {
			$image_url = $_POST['image_url_redirection'];
			update_option( 'dx-dark-site-image-redirection-banner', $image_url );
		}

		?>
		<div class="updated"><p><strong>
			<?php
			_e( 'Settings saved.', 'dx-dark-site-redirection' );
			?>
		</strong></p></div>
		<?php
	}

	$checkbox_enable_banner_settings = '<input type="checkbox" id="enable-banner" name="enable-banner" value="1" ' . checked( 1, get_option( 'enable-banner' ), false ) . '/>';

	?>
	<div class="wrap">
		<h1><?php _e( 'Redirection Banner', 'dx-dark-site-redirection' ); ?></h1>
		<form name="form1" method="post" action="">

			<input type="hidden" name="<?php echo $dx_hidden_field_name_second_banner; ?>" value="Y">

			<h2 class="description"><?php echo $checkbox_enable_banner_settings; ?> Enable banner</h2>

			<p><?php _e( 'Redirect to:', 'dx-dark-site-redirection' ); ?>
				<input type="text" required name="<?php echo $dx_redirect_name_second_banner; ?>" value="<?php echo $dx_redirect_value_second_banner; ?>" size="40">
			</p><hr />

			<p><?php _e( 'Seconds:', 'dx-dark-site-redirection' ); ?>
				<input type="text" required name="<?php echo $dx_seconds_name_second_banner; ?>" value="<?php echo $dx_seconds_value_second_banner; ?>" size="10">
			</p><hr />

			<p>
				<p><?php _e( '<span class="dashicons dashicons-editor-help"></span> Placing <b>[counter]</b> in your message will show the banner and the remaining time before redirection.', 'dx-dark-site-redirection' ); ?></p>
				<?php wp_editor( wp_unslash( $dx_editor_content_second_banner ), $dx_editor_id_second_banner, $editor_settings_second_banner ); ?>
			</p>

			<p> <?php _e( 'Margin from top (in rem Units) :', 'dx-dark-site-redirection' ); ?>
				<input type="number" name="<?php echo $dx_margin_field_name_second_banner; ?>" value="<?php echo $dx_margin_field_value_second_banner; ?>" min=0 max=20>
			</p>

			<p>
				<?php dx_get_uploader_redirection_banner(); ?>
			</p>

			<?php submit_button( 'Save', 'primary' ); ?>

		</form>
	</div>
<?php
