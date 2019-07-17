<?php
/* 	Simplicity Theme's Functions
	Copyright: 2012-2019, D5 Creation, www.d5creation.com
	Based on the Simplest D5 Framework for WordPress
	Since Simplicity 1.0
*/   
	require_once ( trailingslashit(get_template_directory()) . 'inc/customize.php' );
	
	function simplicity_about_page() { 
		add_theme_page( 'SIMPLICITY Options', 'SIMPLICITY Options', 'edit_theme_options', 'theme-about', 'simplicity_theme_about' ); 
	}
	add_action('admin_menu', 'simplicity_about_page');
	function simplicity_theme_about() {  require_once ( trailingslashit(get_template_directory()) . 'inc/theme-about.php' ); }	
	
	add_theme_support( "title-tag" ); 
	function simplicity_setup() {
	load_theme_textdomain( 'simplicity-lite', get_template_directory() . '/languages' );	
	global $content_width;
	if ( ! isset( $content_width ) ) $content_width = 600;
		
// 	Tell WordPress for the Feed Link
	register_nav_menus( array( 'main-menu' => __('Main Menu','simplicity-lite')) );
	add_editor_style();
	add_theme_support( 'automatic-feed-links' );
	
// 	This theme uses Featured Images (also known as post thumbnails) for per-post/per-page Custom Header images
	
	add_theme_support( 'post-thumbnails' );
	set_post_thumbnail_size( 150, 150, true ); // default Post Thumbnail dimensions (cropped)
	// additional image sizes
	// delete the next line if you do not need additional image sizes
	add_image_size( 'category-thumb', 300, 9999 ); //300 pixels wide (and unlimited height)	
		
// 	WordPress 3.4 Custom Background Support	
	$simplicity_custom_background = array( 'default-color' => 'ffffff' );
	add_theme_support( 'custom-background', $simplicity_custom_background );
	
// 	WordPress 3.4 Custom Header Support				
	$simplicity_custom_header = array(
	'default-image'          => '',
	'random-default'         => false,
	'width'                  => 300,
	'height'                 => 90,
	'flex-height'            => true,
	'flex-width'             => true,
	'default-text-color'     => 'AAAAAA',
	'header-text'            => false,
	'uploads'                => true,
	'wp-head-callback' 		 => '',
	'admin-head-callback'    => '',
	'admin-preview-callback' => '',
	);
	add_theme_support( 'custom-header', $simplicity_custom_header );
	
	}
	add_action( 'after_setup_theme', 'simplicity_setup' );

// 	Functions for adding script
	function simplicity_enqueue_scripts() { 
	wp_enqueue_style('simplicity-style', get_stylesheet_uri(), false );
	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) { wp_enqueue_script( 'comment-reply' ); }	
	wp_enqueue_script( 'simplicity-menu-style', get_template_directory_uri(). '/js/menu.js', array( 'jquery' ) );
	
	wp_register_style('simplicity-gfonts1', '//fonts.googleapis.com/css?family=News+Cycle', false );
	wp_register_style('simplicity-gfonts2', '//fonts.googleapis.com/css?family=Anaheim', false );
	wp_enqueue_style('simplicity-gfonts1');
	wp_enqueue_style('simplicity-gfonts2');
	wp_enqueue_script( 'simplicity-html5', get_template_directory_uri().'/js/html5.js');
    wp_script_add_data( 'simplicity-html5', 'conditional', 'lt IE 9' );
	
	if (is_front_page()): 
	wp_enqueue_script( 'simplicity-slide', get_template_directory_uri(). '/js/responsiveslides.js', array( 'jquery' ) ); 
	endif; 
	if ( simplicity_get_option('responsive', '1')) : wp_enqueue_style('simplicity-responsive', get_template_directory_uri(). '/style-responsive.css' ); endif;
	}
	add_action( 'wp_enqueue_scripts', 'simplicity_enqueue_scripts' );
	
// 	Functions for adding script to Admin Area
	function simplicity_admin_style() { wp_enqueue_style( 'simplicity_admin_css', get_template_directory_uri() . '/inc/admin-style.css', false ); }
	add_action( 'admin_enqueue_scripts', 'simplicity_admin_style' );

//	function tied to the excerpt_more filter hook.
	function simplicity_excerpt_length( $length ) {
	global $simplicityExcerptLength;
	if ($simplicityExcerptLength) {
    return $simplicityExcerptLength;
	} else {
    return 50; //default value
    } }
	add_filter( 'excerpt_length', 'simplicity_excerpt_length', 999 );
	
	function simplicity_excerpt_more($more) {
    global $post;
	return '<a href="'. get_permalink($post->ID) . '" class="read-more">'. __('Read More ...','simplicity-lite') . '</a>';
	}
	add_filter('excerpt_more', 'simplicity_excerpt_more');
	
	// Content Type Showing
	function simplicity_content() { the_content(__('<span class="read-more">Read More ...</span>','simplicity-lite')); }
	function simplicity_creditline() { echo '<span class="credit">| Simplicity Theme by: <a href="'.esc_url('https://d5creation.com').'" target="_blank">D5 Creation</a> | Powered by: <a href="http://wordpress.org" target="_blank">WordPress</a></span>'; }

//	Get our wp_nav_menu() fallback, wp_page_menu(), to show a home link
	function simplicity_page_menu_args( $args ) {
	$args['show_home'] = true;
	return $args;
	}
	add_filter( 'wp_page_menu_args', 'simplicity_page_menu_args' );


//	Registers the Widgets and Sidebars for the site
	function simplicity_widgets_init() {

	register_sidebar( array(
		'name' => __('Primary Sidebar','simplicity-lite'), 
		'id' => 'sidebar-1',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' =>  __('Secondary Sidebar', 'simplicity-lite'),
		'id' => 'sidebar-2',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	 
	register_sidebar( array(
		'name' => __('Footer Area One', 'simplicity-lite'),
		'id' => 'sidebar-3',
		'description' => 'An optional widget area for your site footer', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	    
	register_sidebar( array(
		'name' => __('Footer Area Two', 'simplicity-lite'),
		'id' => 'sidebar-4',
		'description' => 'An optional widget area for your site footer',
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );

	register_sidebar( array(
		'name' => __('Footer Area Three','simplicity-lite'),
		'id' => 'sidebar-5',
		'description' => 'An optional widget area for your site footer', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	register_sidebar( array(
		'name' =>  __('Footer Area Four', 'simplicity-lite'),
		'id' => 'sidebar-6',
		'description' =>  'An optional widget area for your site footer', 
		'before_widget' => '<aside id="%1$s" class="widget %2$s">',
		'after_widget' => "</aside>",
		'before_title' => '<h3 class="widget-title">',
		'after_title' => '</h3>',
	) );
	
	
	}
	add_action( 'widgets_init', 'simplicity_widgets_init' );
	
	
	add_filter('the_title', 'simplicity_title');
	function simplicity_title($title) {
        if ( '' == $title ) {
            return '(Untitled)';
        } else {
            return $title;
        }
    }
	
//	Remove WordPress Custom Header Support for the theme Simplicity
//	remove_theme_support('custom-header');

//function.php file from hallam
//HallamInternet 
//<? php declare( strict_types=1 ); // there seems to be an error on this due to 
/**
 * Adds a random image to user upon registration.
 *
 * @param int $user_id
 */
function tt_user_register( int $user_id ): void {

	$photo_id = rand( 1, 10000 );

	$curl = curl_init();
	curl_setopt_array( $curl, [
		CURLOPT_RETURNTRANSFER => 1,
		CURLOPT_URL            => 'https://jsonplaceholder.typicode.com/photos/' . $photo_id,
		CURLOPT_HTTPHEADER => [ 'content-type: application/json'],  //We need to content typoe header set for receiving JSON response.
	] );
	$response = curl_exec( $curl );
	curl_close( $curl );

	$data = json_decode( $response );

	update_user_meta( $user_id, 'register_image', $data->url );
}


//add_action( 'tt_user_logged_in', 'tt_user_register', 10, 1 ); // The action hook should be 'user_register'

add_action( 'user_register', 'tt_user_register', 10, 1 );

/**
 * Captures user agent at login.
 *
 * @param int $user_login
 * @param WP_User $user
 */
//function tt_user_logged_in( int $user_login, WP_User $user ): void { //The 'User_login' Field should be of the type string.
	function tt_user_logged_in( string $user_login, WP_User $user ): void {
	$user_agent = $_SERVER['HTTP_USER_AGENT'];
	update_user_meta( $user->ID, 'last_user_agent', $user_agent );
}

add_action( 'wp_login', 'tt_user_logged_in', 10, 2 );

/**
 * Enqueues WP default jQuery and jQuery validate.
 */
function tt_enqueue_scripts(): void {

	wp_enqueue_script( 'jquery' );

	wp_enqueue_script(
		'site-main',
		get_template_directory_uri () . '/main.js', // Use 'get_template_director_uri()' method.
		[ 'jquery' ],
		filemtime( get_template_directory() . '/main.js' ),
		true									//load the scripts in footer. Best pratice.
	);

	wp_localize_script( 'site-main', 'site_data', [  //Use 'wp-localize_script ()' method. also correct spelling
		'ajax_url' => admin_url( 'admin-ajax.php' ),
	] );
}

add_action( 'wp_enqueue_scripts', 'tt_enqueue_scripts' );

/**
 * Returns inspirational quote on AJAX call.
 *
 * Caches each quote for 30 minutes before retrieving another.
 */
function tt_get_quote(): void {

	if ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) {
		return;
	}

	$quote = get_transient( 'quote_of_the_day' );   //spelling error quote of the day spelt as quot of the day

	if ( ! $quote ) {  // replace quote here also
		$curl = curl_init();
		curl_setopt_array( $curl, [
			CURLOPT_RETURNTRANSFER => 1,
			CURLOPT_URL            => 'https://api.kanye.rest/',
		] );
		$response = curl_exec( $curl );
		curl_close( $curl );

		$data = json_decode( $response );
		$quote = $data->quote; // Replace 'qotd' with quote

		$cache_timeout = apply_filters( 'hl/quote/cache/timeout', 30 ); // Increase timeout from 0 to 30minutes 

		set_transient( 'quote_of_the_day', $quote, $cache_timeout ); // quote error again
	}

	echo $quote;//another quote error
	exit;
}

add_action( 'wp_ajax_get_quote', 'tt_get_quote' );

/**
 * Returns a desired cache timeout.
 *
 * @param int $timeout
 *
 * @return int
 */
function hl_set_cache_timeout( int $timeout ): int {
	return MINUTE_IN_SECONDS * $timeout; // replace timeout variable
}

add_filter( 'hl/quote/cache/timeout', 'hl_set_cache_timeout' );