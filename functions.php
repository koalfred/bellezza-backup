<?php
/**
 * Bellezza functions and definitions
 *
 * @link https://developer.wordpress.org/themes/basics/theme-functions/
 *
 * @package Bellezza
 */

if ( ! defined( '_S_VERSION' ) ) {
	// Replace the version number of the theme on each release.
	define( '_S_VERSION', '1.0.0' );
}

if ( ! function_exists( 'bellezza_setup' ) ) :
	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	function bellezza_setup() {
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on Bellezza, use a find and replace
		 * to change 'bellezza' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'bellezza', get_template_directory() . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'menu-1' => esc_html__( 'Primary', 'bellezza' ),
				'footer' => __( 'Footer Menu Location', 'bellezza' ),
      			'social' => __( 'Social Menu Location', 'bellezza' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5',
			array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
				'style',
				'script',
			)
		);

		// Set up the WordPress core custom background feature.
		add_theme_support(
			'custom-background',
			apply_filters(
				'bellezza_custom_background_args',
				array(
					'default-color' => 'ffffff',
					'default-image' => '',
				)
			)
		);

		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		/**
		 * Add support for core custom logo.
		 *
		 * @link https://codex.wordpress.org/Theme_Logo
		 */
		add_theme_support(
			'custom-logo',
			array(
				'height'      => 250,
				'width'       => 250,
				'flex-width'  => true,
				'flex-height' => true,
			)
		);
	}
endif;
add_action( 'after_setup_theme', 'bellezza_setup' );

/**
 * Set the content width in pixels, based on the theme's design and stylesheet.
 *
 * Priority 0 to make it available to lower priority callbacks.
 *
 * @global int $content_width
 */
function bellezza_content_width() {
	// This variable is intended to be overruled from themes.
	// Open WPCS issue: {@link https://github.com/WordPress-Coding-Standards/WordPress-Coding-Standards/issues/1043}.
	// phpcs:ignore WordPress.NamingConventions.PrefixAllGlobals.NonPrefixedVariableFound
	$GLOBALS['content_width'] = apply_filters( 'bellezza_content_width', 640 );
}
add_action( 'after_setup_theme', 'bellezza_content_width', 0 );

/**
 * Register widget area.
 *
 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
 */
function bellezza_widgets_init() {
	register_sidebar(
		array(
			'name'          => esc_html__( 'Sidebar', 'bellezza' ),
			'id'            => 'sidebar-1',
			'description'   => esc_html__( 'Add widgets here.', 'bellezza' ),
			'before_widget' => '<section id="%1$s" class="widget %2$s">',
			'after_widget'  => '</section>',
			'before_title'  => '<h2 class="widget-title">',
			'after_title'   => '</h2>',
		)
	);
}
add_action( 'widgets_init', 'bellezza_widgets_init' );

/**
 * Enqueue scripts and styles.
 */
function bellezza_scripts() {
	wp_enqueue_style( 'bellezza-style', get_stylesheet_uri(), array(), _S_VERSION );

	wp_enqueue_style( 'bellezza-lightbox', get_stylesheet_directory_uri(). '/css/lightbox.min.css', array(), _S_VERSION);

	wp_enqueue_style( 'bellezza-slider', get_stylesheet_directory_uri(). '/css/slider.css', array(), _S_VERSION);

	wp_enqueue_style( 'bellezza-accordion', get_stylesheet_directory_uri(). '/css/accordion.css', array(), _S_VERSION);

	wp_enqueue_style( 'bellezza-testimonial-slider', get_stylesheet_directory_uri(). '/slick/slick.css', array(), _S_VERSION);

	wp_style_add_data( 'bellezza-style', 'rtl', 'replace' );

	wp_enqueue_script( 'bellezza-navigation', get_template_directory_uri() . '/js/navigation.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'bellezza-lightbox-script', get_template_directory_uri() . '/js/lightbox.min.js', array('jquery'), _S_VERSION, true );

	wp_enqueue_script( 'bellezza-slider-script', get_template_directory_uri() . '/js/slider.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'bellezza-accordion-script', get_template_directory_uri() . '/js/accordion.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'bellezza-testimonial-slider-script', get_template_directory_uri() . '/slick/slick.min.js', array(), _S_VERSION, true );

	wp_enqueue_script( 'bellezza-testimonial-slider-2-script', get_template_directory_uri() . '/js/testimonial-slider.js', array(), _S_VERSION, true );
	
	wp_enqueue_script( 'google-map', 'https://maps.googleapis.com/maps/api/js?key=AIzaSyBvQPkzU9LIEdJHjFEavo4eRNRXrRnD9Ws', array(), '3', true );

	wp_enqueue_script( 'google-map-init', get_template_directory_uri() . '/js/google-maps.js', array('google-map', 'jquery'), '0.1', true );


	if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
		wp_enqueue_script( 'comment-reply' );
	}
}
add_action( 'wp_enqueue_scripts', 'bellezza_scripts' );

/**
 * Implement the Custom Header feature.
 */
require get_template_directory() . '/inc/custom-header.php';

/**
 * Custom template tags for this theme.
 */
require get_template_directory() . '/inc/template-tags.php';

/**
 * Functions which enhance the theme by hooking into WordPress.
 */
require get_template_directory() . '/inc/template-functions.php';

/**
 * Customizer additions.
 */
require get_template_directory() . '/inc/customizer.php';

/**
 * Load Jetpack compatibility file.
 */
if ( defined( 'JETPACK__VERSION' ) ) {
	require get_template_directory() . '/inc/jetpack.php';
}

/** 
 * Custom Post Types & Taxonomies
 * 
*/

require get_template_directory() . '/inc/cpt-taxonomy.php';


// Change excerpt length to 30 words
function ms_excerpt_length( $length ) {
	return 30;
}
add_filter( 'excerpt_length', 'ms_excerpt_length', 999 );

// Change excerpt ending to a link
function ms_excerpt_more( $more ) {
	return '... <a class="read-more" href="' . get_permalink() . '">Continue Reading</a>';
}
add_filter( 'excerpt_more', 'ms_excerpt_more' );


// disable editor from home page
function ms_post_filter( $use_block_editor, $post ) {
	if ( 14 === $post->ID ) {
		return false;
	}
	return $use_block_editor;
}
add_filter( 'use_block_editor_for_post', 'ms_post_filter', 10, 2 );

// Allows use of google map on page
function my_acf_google_map_api( $api ){
	$api['key'] = 'AIzaSyBvQPkzU9LIEdJHjFEavo4eRNRXrRnD9Ws';
	return $api;
}
add_filter('acf/fields/google_map/api', 'my_acf_google_map_api');