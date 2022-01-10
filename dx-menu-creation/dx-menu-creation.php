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
}
add_action( 'admin_menu', 'dx_add_menu_page' );

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

	$default_tab = null;
	$tab         = isset( $_GET['tab'] ) ? $_GET['tab'] : $default_tab;

	?>
<!-- Our admin page content should all be inside .wrap -->
<div class="wrap">
	<!-- Print the page title -->
	<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
	<!-- Here are our tabs -->
	<nav class="nav-tab-wrapper">
		<a href="?page=dx-darksite-settings" class="nav-tab <?php if ( null === $tab ) : ?>
			nav-tab-active <?php endif; ?>">Main</a>
		<a href="?page=dx-darksite-settings&tab=redirection" class="nav-tab <?php if ( 'redirection' === $tab ) : ?>
			nav-tab-active <?php endif; ?>">Redirection</a>
		<a href="?page=dx-darksite-settings&tab=help" class="nav-tab <?php if ( 'help' === $tab ) : ?>
			nav-tab-active <?php endif; ?>">Help</a>
	</nav>

	<div class="tab-content">
		<?php
		switch ( $tab ) :
			case 'redirection':
				include( 'dx-redirection-banner.php' );
				break;
			case 'help':
				include( 'dx-dark-site-help-page.php' );
				break;
			default:
				include( 'dx-main.php' );
				break;
		endswitch;
		?>
	</div>
</div>
	<?php
}
