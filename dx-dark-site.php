<?php
/**
 * Plugin Name: DevriX Dark Site
 * Description: Plugin for emergency redirections and notices
 * Version:		1.0.0
 * Author:      DevriX
 * Author URI:  https://devrix.com/
 * License:     GPLv2 or later
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dx-dark-site
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'DX_DARKSITE_PATH', plugin_dir_path( __FILE__ ) );
define( 'DX_STYLES_VERSION', '15102019' );

require_once( DX_DARKSITE_PATH . 'dx-menu-creation/dx-menu-creation.php' );

/**
 *
 * Redirect on added URL from Settings->Dark Site->REDIRECTION
 *
 */
function dx_darksite_redirect() {
	global $wp;
	$dx_redirect_to = get_option( 'dx_redirect_to' );
	$dx_current_url = home_url( add_query_arg( array( $_GET ), $wp->request ) );
	$dx_url_with_dash = $dx_current_url . '/';

	// Redirect all visitors, if the option is enabled
	if( $dx_redirect_to != '' && ! is_user_logged_in() ) {
		if(  $dx_current_url !== $dx_redirect_to && $dx_url_with_dash !== $dx_redirect_to ) {
			wp_redirect( $dx_redirect_to );
			exit;
		}
	}
}
add_action( 'template_redirect', 'dx_darksite_redirect' );

/**
 *
 * This functions renders the content from  WYSIWYG redactor as notice on the front-end
 *
 */
function dx_darksite_notice() {
	if ( ! empty( get_option( 'dx_my_editor' ) ) ) {
		if( ! isset( $_COOKIE['dx_darksite_note'] ) ) {
			if( ! empty( get_option( 'dx_margin_top' ) ) ) {
				$dx_margin_top = get_option( 'dx_margin_top' );
			} else {
				$dx_margin_top = 0;
			}
			$dx_editor_content = get_option( 'dx_my_editor' );
			$dx_unslashed_content = wp_unslash( $dx_editor_content );

			$dx_content = wp_kses_data( $dx_unslashed_content );

			?>
			<div class="darksite-notice">
				<div class="darksite-notice-container">
					<div class="darksite-notice-image">
						<img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/error-64-warning.png' ?>" alt="warning">
					</div>
					<div class="darksite-notice-content"><?php echo $dx_content; ?></div>
					<button id="darksite-notice-button" class="darksite-notice-button" onclick="SetDarksiteCookie()"><span>+</span></button>
				</div><!-- .darksite-notice-container -->
			</div><!-- .darksite-notice -->

			<style type="text/css">
				.darksite-notice { margin-top: <?php echo $dx_margin_top ?>rem; }
			</style>
		<?php
		}
	}
}
add_action( 'wp_head', 'dx_darksite_notice' );

/**
 *
 * We are aware this is an inline script. No need for additional files for this small script
 *
 */
function dx_set_darksite_cookie() {
	if( ! empty( get_option( 'dx_my_editor' ) ) ) { ?>
		<script>
			jQuery(function($){
				let $notice = $( '.darksite-notice' );
			});
			function SetDarksiteCookie() {
				days=0.5; // number of days to keep the cookie
				currentDate = new Date();
				currentDate.setTime( currentDate.getTime() + ( days*24*60*60*1000 ) );
				document.cookie = 'dx_darksite_note=closed; expires=' + currentDate.toGMTString();
				jQuery( '.darksite-notice' ).hide();
			}
		</script> <?php
	}
}
add_action( 'wp_head', 'dx_set_darksite_cookie' );


/**
 * Enqueue Styles
 */
function dx_plugin_scripts() {
    wp_enqueue_style( 'dx-dark-site', plugin_dir_url( __FILE__ ) . 'assets/css/dx-dark-site.css', '', DX_STYLES_VERSION );
}

add_action( 'wp_enqueue_scripts', 'dx_plugin_scripts' );
