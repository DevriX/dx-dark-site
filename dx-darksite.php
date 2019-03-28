<?php
/**
 * Plugin Name: DevriX Dark Site
 * Description: Plugin for emergency redirections and notices
 * Version:		1.0
 * Author:      DevriX
 * Author URI:  https://devrix.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dark_site
 */ 

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'DX_DARKSITE_PATH', plugin_dir_path( __FILE__ ) );

require_once( DX_DARKSITE_PATH . 'dx-menu-creation/dx-menu-creation.php' );


/*
 * Redirect on Enabled Checkbox from Options->Dark Site
*/

function dx_darksite_redirect() {
	global $wp;
	$redirect_to = get_option( 'dx_redirect_to' );
	$current_url = home_url( add_query_arg( array(), $wp->request ) );
	$url_with_dash = $current_url . '/';

	// Redirect all visitors, if the option is enabled
	if( $redirect_to != '' && ! is_user_logged_in() ) {
		if(  $current_url !== $redirect_to and $url_with_dash !== $redirect_to ) {
			wp_redirect( $redirect_to );
			exit;
		}
	}
}
add_action( 'template_redirect', 'dx_darksite_redirect' );

// TODO: Add Banner!