<?php

// UPLOAD ENGINE
function load_wp_media_files() {
	wp_enqueue_media();

}
add_action( 'admin_enqueue_scripts', 'load_wp_media_files' );

/**
 *
 * Adds menu admin page to DX Dark Site
 *
 */
function dx_add_menu_page() {
	add_menu_page( __( 'DX Dark Site', 'dx-dark-site' ), __( 'DX Dark Site', 'dx-dark-site' ), 'manage_options', 'dx-darksite-settings', 'dx_settings_page', 'dashicons-clock' );
}
add_action( 'admin_menu', 'dx_add_menu_page' );

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
