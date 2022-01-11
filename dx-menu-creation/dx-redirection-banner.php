<?php
if ( ! current_user_can( 'manage_options' ) ) {
	wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
}

	$editor_settings_second_banner = array(
		'media_buttons' => false,
		'quicktags'     => false,
		'teeny'         => true,
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

		update_option( $dx_redirect_name_second_banner, $dx_redirect_value_second_banner );
		update_option( $dx_seconds_name_second_banner, $dx_seconds_value_second_banner );
		update_option( $dx_editor_id_second_banner, $dx_editor_content_second_banner );
		update_option( $dx_margin_field_name_second_banner, esc_html( $dx_sanitized_margin_second_banner ) );

		if ( isset( $_POST['image_url_second_banner'] ) ) {
			$image_url_second_banner = $_POST['image_url_second_banner'];
			update_option( 'dx-dark-site-image-second-banner', $image_url_second_banner );
		}

		?>
		<div class="updated"><p><strong>
			<?php
			_e( 'Settings saved.', 'dx-dark-site-redirection' );
			?>
		</strong></p></div>
		<?php
	}

	$checkbox_enable_banner_settings  = '<input type="checkbox" id="enable-banner" name="enable-banner" value="1" ' . checked( 1, get_option( 'enable-banner' ), false ) . '/>';
	$checkbox_enable_banner_label     = '<label for="enable-banner"> Enable banner </label>';
	$checkbox_enable_banner_settings .= $checkbox_enable_banner_label;

	?>
	<div class="wrap">
		<h1><?php _e( 'Redirection Banner', 'dx-dark-site-redirection' ); ?></h1>
		<form name="form1" method="post" action="">

			<input type="hidden" name="<?php echo $dx_hidden_field_name_second_banner; ?>" value="Y">

			<h2 class="description"><?php _e( $checkbox_enable_banner_settings, 'dx-dark-site' ); ?></h2>

			<p><?php _e( 'Redirect to:', 'dx-dark-site-redirection' ); ?>
				<input type="text" required name="<?php echo $dx_redirect_name_second_banner; ?>" value="<?php echo $dx_redirect_value_second_banner; ?>" size="40">
			</p><hr />
			
			<p><?php _e( 'Seconds:', 'dx-dark-site-redirection' ); ?>
				<input type="text" required name="<?php echo $dx_seconds_name_second_banner; ?>" value="<?php echo $dx_seconds_value_second_banner; ?>" size="10">
			</p><hr />

			<p>
				<?php wp_editor( wp_unslash( $dx_editor_content_second_banner ), $dx_editor_id_second_banner, $editor_settings_second_banner ); ?>
			</p>

			<p> <?php _e( 'Margin from top (in rem Units) :', 'dx-dark-site-redirection' ); ?>
				<input type="number" name="<?php echo $dx_margin_field_name_second_banner; ?>" value="<?php echo $dx_margin_field_value_second_banner; ?>" min=0 max=20>
			</p>

			<p>
				<?php dx_get_uploader(); ?>
			</p>

			<p class="submit">
				<?php submit_button( 'Save', 'primary' ); ?>
			</p>

		</form>
	</div>
<?php
