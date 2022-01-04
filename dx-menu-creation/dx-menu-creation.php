<?php
/*
*
* Initialises menu and all metaboxes needed for the plugin to work.
*
*/


/**
 *
 * Adds menu admin page to DX Dark Site
 *
 */
function dx_add_menu_page() {
    add_menu_page( __( 'DX Dark Site', 'dx-dark-site' ), __( 'DX Dark Site', 'dx-dark-site' ), 'manage_options', 'dx-darksite-settings', 'dx_settings_page' );
	
	add_submenu_page( 'dx-darksite-settings', __( 'Redirection Banner', 'dx-dark-site-redirection' ), __( 'Redirection Banner', 'dx-dark-site-redirection' ), 'manage_options', 'dx-darksite-redirection', 'dx_darksite_redirection_call' );

	add_submenu_page( 'dx-darksite-settings', __( 'Help Page', 'dx-dark-site-help' ), __( 'Help Page', 'dx-dark-site-help' ), 'manage_options', 'dx-darksite-help', 'dx_darksite_help_call' );

}
add_action( 'admin_menu', 'dx_add_menu_page' );

function dx_darksite_help_call() {
	include( 'dx-dark-site-help-page.php' );
}

/**
 *
 * Function for the custom adding of an image
 *
 */

function dx_get_uploader() {
    // jQuery
    wp_enqueue_script('jquery');
    // This will enqueue the Media Uploader script
    wp_enqueue_media();
    ?>
        <div>
        <label for="image_url"><?php _e( 'Upload Custom Image', 'dx-dark-site'); ?></label>
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

// UPLOAD ENGINE
function load_wp_media_files() {
    wp_enqueue_media();

}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );

/**
 *
 * Adds the settigns fields and saves the data of them to wp_options table
 *
 */
function dx_settings_page() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    $editor_settings = array(
        'media_buttons' => false,
        'quicktags' => false,
        'teeny' => true,
    );

    // set all input names as php vars
    $dx_hidden_field_name = 'dx_submit_hidden';
    $dx_redirect_name     = 'dx_redirect_to';
	$dx_date_name         = 'dx_date';
	$dx_time_name         = 'dx_time';
    $dx_margin_field_name = 'dx_margin_top';
    $dx_editor_id         = 'dx_my_editor';

    // checks if the 4 fields have data stored
    if( ! empty( get_option( $dx_editor_id ) ) ) {
        $dx_editor_content =  ( get_option( $dx_editor_id ) );
    } else {
        $dx_editor_content = '';
    }

    if( ! empty( get_option( $dx_redirect_name ) ) ) {
        $dx_redirect_value = get_option( $dx_redirect_name );
    } else {
        $dx_redirect_value = '';
    }

    if( ! empty( get_option( $dx_margin_field_name ) ) ) {
        $dx_margin_field_value = get_option( $dx_margin_field_name );
    } else {
        $dx_margin_field_value = 0;
    }

	if( ! empty( get_option( $dx_date_name ) ) ) {
        $dx_date_value = get_option( $dx_date_name );
    } else {
        $dx_date_value = '';
    }

	if( ! empty( get_option( $dx_time_name ) ) ) {
        $dx_time_value = get_option( $dx_time_name );
    } else {
        $dx_time_value = '';
    }

    // saves data from the 5 input fields in wp_options table
    if( isset( $_POST[ $dx_hidden_field_name ] ) && $_POST[ $dx_hidden_field_name ] == 'Y' ) {
        $dx_redirect_value     = esc_url( $_POST[ $dx_redirect_name ] );
		$dx_date_value         = $_POST[ $dx_date_name ];
		$dx_time_value         = $_POST[ $dx_time_name ];
        $dx_editor_content     = sanitize_text_field( $_POST[ $dx_editor_id ] );
        $dx_margin_field_value = esc_html ( $_POST[ $dx_margin_field_name ] );

        $dx_sanitized_content = sanitize_text_field( $dx_editor_content );

        update_option( $dx_redirect_name, $dx_redirect_value );
		update_option( $dx_date_name, $dx_date_value );
		update_option( $dx_time_name, $dx_time_value );
        update_option( $dx_editor_id, $dx_editor_content );
        update_option( $dx_margin_field_name, esc_html( $dx_sanitized_margin ) );

        if( isset( $_POST['image_url'] ) ) {
            $image_url = $_POST['image_url'];
            update_option( 'dx-dark-site-image', $image_url );
        }
        ?> <div class="updated"><p><strong><?php _e( 'Settings saved.', 'dx-dark-site' ); ?></strong></p></div> <?php
    } ?>
    <div class="wrap">
    	<h1><?php _e( 'Dark Site', 'dx-dark-site' ); ?></h1>
    	<form name="form1" method="post" action="">

    		<input type="hidden" name="<?php echo $dx_hidden_field_name; ?>" value="Y">

    		<h3> <?php _e( 'REDIRECTION', 'dx-dark-site' ); ?></h3>

    		<p><?php _e("Redirect to:", 'dx-dark-site' ); ?>
    			<input type="text" name="<?php echo $dx_redirect_name; ?>" value="<?php echo $dx_redirect_value; ?>" size="40">
    		</p><hr />

			<p><?php _e("Expiry Date:", 'dx-dark-site' ); ?>
				<input type="date" name="<?php echo $dx_date_name; ?>" value="<?php echo $dx_date_value; ?>">
    		</p><hr />

			<p><?php _e("Expiry Time:", 'dx-dark-site' ); ?>
				<input type="time" step=1 name="<?php echo $dx_time_name; ?>" value="<?php echo $dx_time_value; ?>">
    		</p><hr />

    		<h3> <?php _e( 'BANNER', 'dx-dark-site' ); ?></h3>

            <p>
                <?php  wp_editor( wp_unslash( $dx_editor_content ), $dx_editor_id, $editor_settings ); ?>
            </p>

            <p> <?php _e( 'Margin from top (in rem Units) :', 'dx-dark-site' ); ?>
                <input type="number" name="<?php echo $dx_margin_field_name; ?>" value="<?php echo $dx_margin_field_value; ?>" min=0 max=20>
            </p>

            <p>
                <?php dx_get_uploader(); ?>
            </p>

    		<p class="submit">
                <?php submit_button( 'save', 'primary' ); ?>
    		</p>

    	</form>
    </div>
<?php }


function dx_darksite_redirection_call() {
    if ( ! current_user_can( 'manage_options' ) ) {
        wp_die( __( 'You do not have sufficient permissions to access this page.' ) );
    }

    $editor_settings_second = array(
        'media_buttons' => false,
        'quicktags' => false,
        'teeny' => true,
    );

    // set all input names as php vars
    $dx_hidden_field_name_second = 'dx_submit_hidden_second';
    $dx_redirect_name_second     = 'dx_redirect_to_second';
	$dx_date_name_second         = 'dx_date_second';
	$dx_time_name_second         = 'dx_time_second';
    $dx_margin_field_name_second = 'dx_margin_top_second';
    $dx_editor_id_second         = 'dx_my_editor_second';

    // checks if the 4 fields have data stored
    if( ! empty( get_option( $dx_editor_id_second ) ) ) {
        $dx_editor_content_second =  ( get_option( $dx_editor_id_second ) );
    } else {
        $dx_editor_content_second = '';
    }

    if( ! empty( get_option( $dx_redirect_name_second ) ) ) {
        $dx_redirect_value_second = get_option( $dx_redirect_name_second );
    } else {
        $dx_redirect_value_second = '';
    }

    if( ! empty( get_option( $dx_margin_field_name_second ) ) ) {
        $dx_margin_field_value_second = get_option( $dx_margin_field_name_second );
    } else {
        $dx_margin_field_value_second = 0;
    }

	if( ! empty( get_option( $dx_date_name_second ) ) ) {
        $dx_date_value_second = get_option( $dx_date_name_second );
    } else {
        $dx_date_value_second = '';
    }

	if( ! empty( get_option( $dx_time_name_second ) ) ) {
        $dx_time_value_second = get_option( $dx_time_name_second );
    } else {
        $dx_time_value_second = '';
    }

    // saves data from the 5 input fields in wp_options table
    if( isset( $_POST[ $dx_hidden_field_name_second ] ) && $_POST[ $dx_hidden_field_name_second ] == 'Y' ) {
        $dx_redirect_value_second     = esc_url( $_POST[ $dx_redirect_name_second ] );
		$dx_date_value_second         = $_POST[ $dx_date_name_second ];
		$dx_time_value_second         = $_POST[ $dx_time_name_second ];
        $dx_editor_content_second     = sanitize_text_field( $_POST[ $dx_editor_id_second ] );
        $dx_margin_field_value_second = esc_html ( $_POST[ $dx_margin_field_name_second ] );

        $dx_sanitized_content_second = sanitize_text_field( $dx_editor_content_second );

        update_option( $dx_redirect_name_second, $dx_redirect_value_second );
		update_option( $dx_date_name_second, $dx_date_value_second );
		update_option( $dx_time_name_second, $dx_time_value_second );
        update_option( $dx_editor_id_second, $dx_editor_content_second );
        update_option( $dx_margin_field_name_second, esc_html( $dx_sanitized_margin_second ) );

        if( isset( $_POST['image_url_second'] ) ) {
            $image_url_second = $_POST['image_url_second'];
            update_option( 'dx-dark-site-image-second', $image_url_second );
        }
        ?> <div class="updated"><p><strong><?php _e( 'Settings saved.', 'dx-dark-site' ); ?></strong></p></div> <?php
    } ?>
    <div class="wrap">
    	<h1><?php _e( 'Dark Site', 'dx-dark-site' ); ?></h1>
    	<form name="form1" method="post" action="">

    		<input type="hidden" name="<?php echo $dx_hidden_field_name_second; ?>" value="Y">

    		<h3> <?php _e( 'REDIRECTION', 'dx-dark-site' ); ?></h3>

    		<p><?php _e("Redirect to:", 'dx-dark-site' ); ?>
    			<input type="text" required name="<?php echo $dx_redirect_name_second; ?>" value="<?php echo $dx_redirect_value_second; ?>" size="40">
    		</p><hr />

			<p><?php _e("Expiry Date:", 'dx-dark-site' ); ?>
				<input type="date" name="<?php echo $dx_date_name_second; ?>" value="<?php echo $dx_date_value_second; ?>">
    		</p><hr />

			<p><?php _e("Expiry Time:", 'dx-dark-site' ); ?>
				<input type="time" step=1 name="<?php echo $dx_time_name_second; ?>" value="<?php echo $dx_time_value_second; ?>">
    		</p><hr />

    		<h3> <?php _e( 'BANNER', 'dx-dark-site' ); ?></h3>

            <p>
                <?php  wp_editor( wp_unslash( $dx_editor_content_second ), $dx_editor_id_second, $editor_settings_second ); ?>
            </p>

            <p> <?php _e( 'Margin from top (in rem Units) :', 'dx-dark-site' ); ?>
                <input type="number" name="<?php echo $dx_margin_field_name_second; ?>" value="<?php echo $dx_margin_field_value_second; ?>" min=0 max=20>
            </p>

            <p>
                <?php dx_get_uploader(); ?>
            </p>

    		<p class="submit">
                <?php submit_button( 'save', 'primary' ); ?>
    		</p>

    	</form>
    </div>
<?php }
