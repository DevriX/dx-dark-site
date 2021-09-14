<?php
/**
 * Plugin Name: DX Dark Site
 * Description: Plugin for emergency redirections and notices
 * Version:		1.0.1
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
	$dx_current_url = esc_url( home_url( add_query_arg( array( $_GET ), $wp->request ) ) );
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
		if( ! isset( $_COOKIE[ 'dx_darksite_note' ] ) ) {
			if( ! empty( get_option( 'dx_margin_top' ) ) ) {
				$dx_margin_top = get_option( 'dx_margin_top' );
			} else {
				$dx_margin_top = 0;
			}
			$dx_editor_content = get_option( 'dx_my_editor' );
			$dx_unslashed_content = wp_unslash( $dx_editor_content );

			$dx_content = wp_kses_data( $dx_unslashed_content );

			$dx_custom_image = get_option( 'dx-dark-site-image' );

			?>
			<div class="darksite-notice">
				<div class="darksite-notice-container">
					<div class="darksite-notice-image">
						<?php if( empty( $dx_custom_image ) ) { ?>
							<img src="<?php echo plugin_dir_url( __FILE__ ) . 'assets/images/error-64-warning.png' ?>" alt="warning">
						<?php } else { ?>
							<img src="<?php echo $dx_custom_image; ?>" alt="warning">
						<?php } ?>
					</div>
					<div class="darksite-notice-content"><?php echo $dx_content; ?></div>
					<button id="darksite-notice-button" class="darksite-notice-button" onclick="SetDarksiteCookie()"><span>+</span></button>
				</div><!-- .darksite-notice-container -->
			</div><!-- .darksite-notice -->

			<style type="text/css">
				.darksite-notice { margin-top: <?php echo $dx_margin_top; ?>rem; }
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

class PageTemplater {

	/**
	 * A reference to an instance of this class.
	 */
	private static $instance;

	/**
	 * The array of templates that this plugin tracks.
	 */
	protected $templates;

	/**
	 * Returns an instance of this class. 
	 */
	public static function get_instance() {

		if ( null == self::$instance ) {
			self::$instance = new PageTemplater();
		} 

		return self::$instance;

	} 

	/**
	 * Initializes the plugin by setting filters and administration functions.
	 */
	private function __construct() {

		$this->templates = array();


		// Add a filter to the attributes metabox to inject template into the cache.
		if ( version_compare( floatval( get_bloginfo( 'version' ) ), '4.7', '<' ) ) {

			// 4.6 and older
			add_filter(
				'page_attributes_dropdown_pages_args',
				array( $this, 'register_project_templates' )
			);

		} else {

			// Add a filter to the wp 4.7 version attributes metabox
			add_filter(
				'theme_page_templates', array( $this, 'add_new_template' )
			);

		}

		// Add a filter to the save post to inject out template into the page cache
		add_filter(
			'wp_insert_post_data',
			array( $this, 'register_project_templates' )
		);


		// Add a filter to the template include to determine if the page has our
		// template assigned and return it's path
		add_filter(
			'template_include',
			array( $this, 'view_project_template')
		);


		// Add your templates to this array.
		$this->templates = array(
			'page-countdown.php' => 'Countdown Page',
		);

	}

	/**
	 * Adds our template to the page dropdown for v4.7+
	 *
	 */
	public function add_new_template( $posts_templates ) {
		$posts_templates = array_merge( $posts_templates, $this->templates );
		return $posts_templates;
	}

	public function register_project_templates( $atts ) {

		$cache_key = 'page_templates-' . md5( get_theme_root() . '/' . get_stylesheet() );

		$templates = wp_get_theme()->get_page_templates();
		if ( empty( $templates ) ) {
			$templates = array();
		} 

		wp_cache_delete( $cache_key , 'themes');

		$templates = array_merge( $templates, $this->templates );

		wp_cache_add( $cache_key, $templates, 'themes', 1800 );

		return $atts;

	} 

	public function view_project_template( $template ) {

		global $post;

		if ( ! $post ) {
			return $template;
		}

		if ( ! isset( $this->templates[get_post_meta( 
			$post->ID, '_wp_page_template', true 
		)] ) ) {
			return $template;
		} 

		$file = plugin_dir_path( __FILE__ ). get_post_meta( 
			$post->ID, '_wp_page_template', true
		);

		if ( file_exists( $file ) ) {
			return $file;
		} else {
			echo $file;
		}
		return $template;

	}

} 
add_action( 'plugins_loaded', array( 'PageTemplater', 'get_instance' ) );

/*** Countdown Timer Shortcode ***/
function next_event_shortcodes_init() {
	add_shortcode('next_event', 'next_event_shortcode');
  }
  add_action('init', 'next_event_shortcodes_init');
  
  function next_event_shortcode ($atts = [])
  {
	// normalize attribute keys to lowercase
	$atts = array_change_key_case((array)$atts, CASE_LOWER);
	if (!array_key_exists("date", $atts)) return false;
  
	$time_remaining = strtotime($atts['date']) - time();
  
	if ($time_remaining < 0) {
	  $time_remaining = 0;
	}
  
	$total_days_remaining = ceil($time_remaining / (60 * 60 * 24));
  
	if ($total_days_remaining >= 7) {
	  $weeks_remaining = sprintf("%02d", floor($total_days_remaining / 7));
	  $days_remaining = sprintf("%02d", $total_days_remaining % 7);
	} else {
	  $weeks_remaining = sprintf("%02d", 0);
	  $days_remaining = sprintf("%02d", $total_days_remaining);

	}
	
	echo "
	<div class='next-event'>
	  $weeks_remaining Weeks, $days_remaining Days
	</div>";
  }
