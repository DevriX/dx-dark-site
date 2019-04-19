<?php
/**
 * Plugin Name: DevriX Dark Site
 * Description: Plugin for emergency redirections and notices
 * Version:		1.0.0
 * Author:      DevriX
 * Author URI:  https://devrix.com/
 * License:     GPL2
 * License URI: https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain: dx_dark_site
 */

defined( 'ABSPATH' ) or die( 'No script kiddies please!' );
define( 'DX_DARKSITE_PATH', plugin_dir_path( __FILE__ ) );

require_once( DX_DARKSITE_PATH . 'dx-menu-creation/dx-menu-creation.php' );

/**
 *
 * Redirect on added URL from Settings->Dark Site->REDIRECTION
 *
 */
function dx_darksite_redirect() {
	global $wp;
	$dx_redirect_to = get_option( 'dx_redirect_to' );
	$dx_current_url = home_url(add_query_arg(array($_GET), $wp->request));
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
			} ?>
			<div class="darksite-notice">
				<div class="darksite-notice-container">
					<div class="darksite-notice-image">
						<img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/dx_exc_mark.png' ?>" alt="warning">
					</div>
					<div class="darksite-notice-content"><?php echo get_option( 'dx_my_editor' ); ?></div>
					<button id="darksite-notice-button" class="darksite-notice-button" onclick="SetDarksiteCookie()"><span>+</span></button>
				</div>
			</div>

			<style type="text/css">
				.darksite-notice { position: relative; background: #FFF; color: #333; margin-bottom: 2rem; margin-top: <?php echo $dx_margin_top ?>rem; }
				.darksite-notice-container { max-width: 1286px; margin: 0 auto; display: flex; padding: 2rem 1rem; }
				.darksite-notice-image { display: block; margin-right: 2rem; }
				.darksite-notice-image img { max-width: 90px ; max-height: 100px}
				.darksite-notice-button { display: flex; align-items: center; justify-content: center; width: 2rem; height: 2rem; padding: 0; background: none; border: none; color: #000; font-size: 1.5rem; position: absolute; top: 0.5rem; right: 1.0rem; cursor: pointer; border-radius: 0.3em; }
				.darksite-notice-button span { display: block; font-size: 2rem; transform: rotate(45deg); color: #000; }
				.darksite-notice-active { padding-top: 0; }
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
				let $notice = $('.darksite-notice');
			});
			function SetDarksiteCookie() {
				days=0.5; // number of days to keep the cookie
				currentDate = new Date();
				currentDate.setTime(currentDate.getTime()+(days*24*60*60*1000));
				document.cookie = 'dx_darksite_note=closed; expires=' + currentDate.toGMTString();
				jQuery('.darksite-notice').hide();
			}
		</script> <?php
	}
}
add_action( 'wp_head', 'dx_set_darksite_cookie' );
