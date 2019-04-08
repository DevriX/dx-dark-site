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

function dx_darksite_notice() {
	if ( ! empty( get_option( 'dx_my_editor' ) ) ) {
		if( ! isset( $_COOKIE['dx_darksite_note'] ) ) { ?>

			<div class="darksite-notice">
				<div class="darksite-notice-container">
					<div class="darksite-notice-image">
					</div>
					<div class="darksite-notice-content"><?php echo get_option( 'dx_my_editor' ); ?></div>
					<button id="darksite-notice-button" class="darksite-notice-button" onclick="SetDarksiteCookie()"><span>+</span></button>
				</div>
			</div>

			<style type="text/css">
				.darksite-notice { position: relative; background: #FFF; color: #333; margin-bottom: 2rem; }
				.darksite-notice-container { max-width: 1286px; margin: 0 auto; display: flex; padding: 2rem 1rem; }
				.darksite-notice-image { display: block; margin-right: 2rem; }
				.darksite-notice-image img { max-width: 150px }
				.darksite-notice-button { display: block; background: none; border: none; color: #000; font-size: 2rem; position: absolute; top: 0rem; right: 0rem; }
				.darksite-notice-button span { display: block; transform: rotate(45deg); color: #000; }
				.darksite-notice-active { padding-top: 0; }
			</style>

<?php  	}
	}
}

?>


<?php add_action( 'wp_head', 'dx_darksite_notice' ); ?>
<?php
/*
* We are aware this is an inline script. No need for additional files for this small script
*/
function dx_set_darksite_cookie() {
	if( ! empty( get_option( 'dx_my_editor' ) ) ) { ?>
		<script>
			jQuery(function($){
				let $notice = $('.darksite-notice');
				$('body').css('padding-top', $('.darksite-notice').height() + 151 + 'px' );
			});
			function SetDarksiteCookie() {
				days=0.0005; // number of days to keep the cookie
				currentDate = new Date();
				currentDate.setTime(currentDate.getTime()+(days*24*60*60*1000));
				document.cookie = 'dx_darksite_note=closed; expires=' + currentDate.toGMTString();
/*				jQuery('body').css('padding-top', '151px' );*/
				jQuery('.darksite-notice').hide();
			}
		</script> <?php
	}
}

add_action( 'wp_head', 'dx_set_darksite_cookie' );
