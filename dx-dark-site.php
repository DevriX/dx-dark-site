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
define( 'DX_STYLES_VERSION', '20201013' );

require_once( DX_DARKSITE_PATH . 'dx-menu-creation/dx-menu-creation.php' );

/**
 *
 * Redirect on added URL from Settings->Dark Site->REDIRECTION
 *
 */
function dx_darksite_redirect() {
	global $wp;

	$page_id = get_the_ID();

	if( has_shortcode( get_option( 'dx_my_editor' ), 'counter' ) || has_shortcode( get_post_field('post_content', $page_id), 'counter' )){
		return;
	}

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

			$dx_editor_content = get_option( 'dx_my_editor' );
			$dx_date = get_option( 'dx_date' );
			$dx_time = get_option( 'dx_time' );

			$dx_unslashed_content = wp_unslash( $dx_editor_content );
			$dx_unslashed_date = wp_unslash( $dx_date );
			$dx_unslashed_time = wp_unslash( $dx_time );

			
			$dx_date_kses = wp_kses_data( $dx_unslashed_date );
			$dx_time_kses = wp_kses_data( $dx_unslashed_time );
			$dx_date_time = $dx_date_kses . ' ' . $dx_time_kses;
			$dx_content = wp_kses_data( $dx_unslashed_content );

			$expiry_date  = strtotime( $dx_date_time );
+			$current_date = strtotime( gmdate( 'Y-m-d h:i:s' ) );
			?>
			<?php if ( $expiry_date >= $current_date ) : ?>
			<div class="darksite-notice">
				<div class="darksite-notice-container">
					<div class="darksite-notice-image">
						<img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/error-64-warning.png' ?>" alt="warning">
					</div>
					<div class="darksite-notice-content"><?php echo apply_filters( 'the_content', $dx_content ); ?></div>
					<button id="darksite-notice-button" class="darksite-notice-button" onclick="SetDarksiteCookie()"><span>+</span></button>
				</div><!-- .darksite-notice-container -->
			</div><!-- .darksite-notice -->
			<?php endif; ?>

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

/**
 * Counter Shortcode
 */
function dx_add_counter_shortcode( $atts ) {

	$attributes = shortcode_atts( array(
		'seconds' => '5',
	), $atts );

	return shortocde_handle( $attributes['seconds'] );
}
add_shortcode( 'counter', 'dx_add_counter_shortcode' );

/**
 * Global Counter Shortcode
 */
function dx_add_global_counter_shortcode( $atts ) {

	$attributes = shortcode_atts( array(
		'time' => 'January 2 2022 10:10:10',
	), $atts );

	return global_counter_shortocde_handle( $attributes['time'] );
}
add_shortcode( 'global-counter', 'dx_add_global_counter_shortcode' );

function shortocde_handle( $atts ) { ?>
    <script type="text/javascript">
        var timeleft = <?php echo $atts ?>;
        var downloadTimer = setInterval(function(){
            if(timeleft <= 0){
			    clearInterval(downloadTimer);
			    document.getElementById("countdown").innerHTML = "Redirecting Now";
				window.location.href = "<?php echo get_option( 'dx_redirect_to' ); ?>";
            } else {
			    document.getElementById("countdown").innerHTML = timeleft + " seconds";
            }
			    timeleft -= 1;
			}, 1000);
    </script>
    <?php
    return '<b id="countdown"></b>';
}

function global_counter_shortocde_handle( $atts ) {
	?>
	<script>
	var countDownDate = new Date("<?php echo $atts; ?>").getTime();

	var x = setInterval(function() {

	  var now = new Date().getTime();
	  var distance = countDownDate - now;

	  var days = Math.floor(distance / (1000 * 60 * 60 * 24));
	  var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
	  var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
	  var seconds = Math.floor((distance % (1000 * 60)) / 1000);

	  document.getElementById("counter").innerHTML = days + " days " + hours + " hours "
	  + minutes + " minutes " + seconds + " seconds";
	  if (distance < 0) {
	    clearInterval(x);
	    document.getElementById("demo").innerHTML = "EXPIRED";
	  }
	}, 1000);
	</script>
<?php return '<b id="counter"></b>';
}

function deactivate_this_plugin(){
    if (get_option('dx_switch_plugin') !== 'true') {
        deactivate_plugins('/dx-dark-site/dx-dark-site.php', true);
    }
    update_option('dx_switch_plugin', 'true');
}
add_action('admin_init', 'deactivate_this_plugin');

