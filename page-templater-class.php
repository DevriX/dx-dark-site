<?php
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
