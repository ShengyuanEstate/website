<?php

/**
 * Libraries
 */
require_once 'assets/libraries/class-tgm-plugin-activation.php';

/**
 * Widgets
 */
require_once 'widgets/widget_simple_map.php';
require_once 'widgets/widget_features.php';

/**
 * Constants
 */
define( 'PROPERTY_EXCERPT_LENGTH', 22 );
define( 'AGENCY_EXCERPT_LENGTH', 20 );
define( 'AGENT_EXCERPT_LENGTH', 28 );
define( 'POST_EXCERPT_LENGTH', 30 );

/**
 * Init Widgets
 */
function aviators_widgets_init() {
    register_widget( 'Aviators_Widget_Simple_Map' );
    register_widget( 'Aviators_Widget_Features' );
}
add_action( 'widgets_init', 'aviators_widgets_init' );

/**
 * Custom excerpt length
 *
 * @param $length
 * @return int
 */
function properta_excerpt_length( $length ) {
	global $post;

	if ( $post->post_type == 'property' ) {
		return PROPERTY_EXCERPT_LENGTH;
	} elseif ( $post->post_type == 'agency' ) {
		return AGENCY_EXCERPT_LENGTH;
    } elseif ( $post->post_type == 'agent' ) {
        return AGENT_EXCERPT_LENGTH;
    } elseif ( $post->post_type == 'post' ) {
        return POST_EXCERPT_LENGTH;
    }

	return $length;
}
add_filter('excerpt_length', 'properta_excerpt_length' );

/**
 * Enqueue scripts & styles
 *
 * @return void
 */
function properta_enqueue_files() {
	wp_register_style( 'colorbox', get_template_directory_uri() . '/assets/libraries/colorbox/example1/colorbox.css' );
    wp_enqueue_style( 'colorbox' );

    wp_register_style( 'fontawesome', get_template_directory_uri() . '/assets/libraries/font-awesome/css/font-awesome.min.css' );
    wp_enqueue_style( 'fontawesome' );

    wp_register_style( 'owl.carousel', get_template_directory_uri() . '/assets/libraries/owl.carousel/assets/owl.carousel.css' );
    wp_enqueue_style( 'owl.carousel' );

	wp_register_style( 'properta', get_template_directory_uri() . '/assets/css/properta.css' );
	wp_enqueue_style( 'properta' );

    wp_register_style( 'realia-font', plugins_url( '/realia/assets/fonts/realia/style.css' ) );
    wp_enqueue_style( 'realia-font' );

    wp_register_style( 'style', get_stylesheet_directory_uri() . '/style.css' );
    wp_enqueue_style( 'style' );

    wp_register_script( 'bootstrap-tooltip', get_template_directory_uri() . '/assets/libraries/bootstrap/javascripts/bootstrap/tooltip.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'bootstrap-tooltip' );

    wp_register_script( 'bootstrap-collapse', get_template_directory_uri() . '/assets/libraries/bootstrap/javascripts/bootstrap/collapse.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'bootstrap-collapse' );

    wp_register_script( 'bootstrap-transition', get_template_directory_uri() . '/assets/libraries/bootstrap/javascripts/bootstrap/transition.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'bootstrap-transition' );

    wp_register_script( 'colorbox', get_template_directory_uri() . '/assets/libraries/colorbox/jquery.colorbox-min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'colorbox' );

    wp_register_script( 'owl.carousel', get_template_directory_uri() . '/assets/libraries/owl.carousel/owl.carousel.min.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'owl.carousel' );

    wp_register_script( 'properta', get_template_directory_uri() . '/assets/js/properta.js', array( 'jquery' ), false, true );
    wp_enqueue_script( 'properta' );
}
add_action( 'wp_enqueue_scripts', 'properta_enqueue_files' );

/**
 * Additional after theme setup functions
 *
 * @return void
 */
function properta_after_theme_setup() {
	load_theme_textdomain( 'properta', get_template_directory() . '/languages' );

	add_theme_support( 'realia-custom-styles' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'custom-header', array() );
	add_theme_support( 'custom-background' );
	add_theme_support( 'menus' );
	add_theme_support( 'title-tag' );
    set_post_thumbnail_size( 300, 300, true );

	if ( ! isset( $content_width ) ) {
		$content_width = 1170;
	}
}
add_action( 'after_setup_theme', 'properta_after_theme_setup' );

/**
 * Register menus
 *
 * @return void
 */
function properta_menus() {
	register_nav_menu( 'primary', __( 'Primary', 'properta' ) );
	register_nav_menu( 'anonymous', __( 'Anonymous', 'properta' ) );
	register_nav_menu( 'authenticated', __( 'Authenticated', 'properta' ) );
}
add_action( 'init', 'properta_menus' );

/**
 * Custom widget areas
 *
 * @return void
 */
function properta_sidebars() {
	register_sidebar( array( 'name' => __( 'Primary', 'properta' ), 'id' => 'sidebar-1', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Top Fullwidth', 'properta' ), 'id' => 'sidebar-top-fullwidth', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Top', 'properta' ), 'id' => 'sidebar-top', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Content Top', 'properta' ), 'id' => 'sidebar-content-top', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Content Bottom', 'properta' ), 'id' => 'sidebar-content-bottom', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Bottom', 'properta' ), 'id' => 'sidebar-bottom', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer First', 'properta' ), 'id' => 'footer-first', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer Second', 'properta' ), 'id' => 'footer-second', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer Third', 'properta' ), 'id' => 'footer-third', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer Fourth', 'properta' ), 'id' => 'footer-fourth', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer Bottom Left', 'properta' ), 'id' => 'footer-bottom-left', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
	register_sidebar( array( 'name' => __( 'Footer Bottom Right', 'properta' ), 'id' => 'footer-bottom-right', 'before_widget' => '<div id="%1$s" class="widget %2$s">', 'after_widget' => '</div>' ) );
}
add_action( 'widgets_init', 'properta_sidebars' );

/**
 * Disable admin's bar top margin
 *
 * @return void
 */
function properta_disable_admin_bar_top_margin() {
	remove_action( 'wp_head', '_admin_bar_bump_cb' );
}
add_action( 'get_header', 'properta_disable_admin_bar_top_margin' );

/**
 * Read more for post excerpt
 *
 * @param $more
 * @return void|string
 */
function properta_excerpt_read_more( $more ) {
	global $post;

	if ( $post->post_type == 'property' || $post->post_type == 'agency' ) {
		return null;
	}

	return ' &hellip;';
}
add_filter( 'excerpt_more', 'properta_excerpt_read_more' );

/**
 * Registers sessions
 *
 * @return void
 */
function properta_register_session(){
	if( ! session_id() ) {
		session_start();
	}
}
add_action( 'init', 'properta_register_session' );

/**
 * Customizations
 *
 * @param $wp_customize
 * @return void
 */
function properta_customizations( $wp_customize ) {
	$wp_customize->add_section( 'properta_general', array( 'title' => __( 'Properta General', 'properta' ), 'priority' => 0 ) );


    // Logo
	$wp_customize->add_setting( 'properta_general_logo', array( 'sanitize_callback' => 'sanitize_text_field' ) );
	$wp_customize->add_control( new WP_Customize_Image_Control( $wp_customize, 'header_logo', array(
		'label'         => __( 'Logo', 'properta' ),
		'section'       => 'properta_general',
		'settings'      => 'properta_general_logo',
		'description'   => __( 'Logo displayed in header. By default it has some opacity added by CSS which will change after hover.', 'properta' ),
	) ) );

    // Action Button Page
    $wp_customize->add_setting( 'properta_general_action', array( 'sanitize_callback' => 'sanitize_text_field' ) );
    $wp_customize->add_control( 'properta_general_action', array(
        'label'         => __( 'Action Page', 'properta' ),
        'type'          => 'select',
        'section'       => 'properta_general',
        'settings'      => 'properta_general_action',
        'choices'       => aviators_get_pages(),
        'description'   => __( 'Page where the action button will point to.', 'properta' ),
    ) );

    // Action Button Text
    $wp_customize->add_setting( 'properta_general_action_text', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'properta_general_action_text', array(
        'label'             => __( 'Action Text', 'properta' ),
        'section'           => 'properta_general',
        'settings'          => 'properta_general_action_text',
        'description'       => __( 'Text displayed before action button.', 'properta' ),
    ) );

    // Action Button Icon
    $wp_customize->add_setting( 'properta_general_action_icon', array(
        'capability'        => 'edit_theme_options',
        'sanitize_callback' => 'sanitize_text_field',
    ) );

    $wp_customize->add_control( 'properta_general_action_icon', array(
        'label'             => __( 'Action Icon', 'properta' ),
        'section'           => 'properta_general',
        'settings'          => 'properta_general_action_icon',
        'description'       => __( 'Use an icon from Font Awesome. For example "fa-plus".', 'properta' ),
    ) );
}
add_action( 'customize_register', 'properta_customizations' );

/**
 * Get pages list
 *
 * @return array
 */
function aviators_get_pages() {
    $pages = array();
    $pages[] =  __( 'Not set', 'properta' );

    foreach ( get_pages() as $page ) {
        $pages[$page->ID] = $page->post_title;
    }

    return $pages;
}

/**
 * Comments template
 */
function aviators_comment( $comment, $args, $depth ) {
    $GLOBALS['comment'] = $comment;
    extract( $args, EXTR_SKIP );
    include 'templates/misc/comment.php';
}

/**
 * Class Properta_Menu_Walker
 */
class Properta_Menu_Walker extends Walker_Nav_Menu {
	/**
	 * Custom parent menu item class
	 *
	 * @param string $output
	 * @param int $depth
	 * @param array $args
	 * @return void
	 */
	public function start_lvl( &$output, $depth = 0, $args = array() ) {
		$indent = str_repeat("\t", $depth);
		$output .= "\n$indent<ul class=\"dropdown-menu sub-menu\">\n";
	}
}

/**
 * Register plugins
 *
 * @return void
 */
function properta_register_required_plugins() {
	$plugins = array(
		array(
			'name'                  => 'Realia',
			'slug'                  => 'realia',
			'is_automatic'          => true,
			'required'              => true,
		),
		array(
            'name'      			=> 'CMB2',
            'slug'      			=> 'cmb2',
            'is_automatic'          => true,
            'required'  			=> false,
        ),
		array(
            'name'      			=> 'WP REST API (WP API)',
            'slug'      			=> 'json-rest-api',
            'required'  			=> false,
        ),
		array(
            'name'                  => 'Contact Form 7',
            'slug'                  => 'contact-form-7',
            'required'              => false,
            'is_automatic'          => true,
        ),
		array(
			'name'                  => 'One Click',
			'slug'                  => 'one-click',
			'source'                => get_template_directory() . '/plugins/one-click.zip',
			'required'              => false,
			'force_deactivation'    => true,
			'is_automatic'          => true,
			'version'               => '0.1.0',
		),
		array(
            'name'                  => 'Realia Partners',
            'slug'                  => 'realia-partners',
            'source'                => get_template_directory() . '/plugins/realia-partners.zip',
            'required'              => false,
            'force_deactivation'    => true,
            'is_automatic'          => true,
            'version'               => '0.1.1',
        ),
        array(
            'name'                  => 'Realia Pricing',
            'slug'                  => 'realia-pricing',
            'source'                => get_template_directory() . '/plugins/realia-pricing.zip',
            'required'              => false,
            'force_deactivation'    => true,
            'is_automatic'          => true,
            'version'               => '0.1.1',
        ),
		array(
            'name'                  => 'Realia FAQ',
            'slug'                  => 'realia-faq',
            'source'                => get_template_directory() . '/plugins/realia-faq.zip',
            'required'              => false,
            'force_deactivation'    => true,
            'is_automatic'          => true,
            'version'               => '0.1.1',
        ),
		array(
			'name'                  => 'Realia PayPal',
			'slug'                  => 'realia-paypal',
			'source'                => get_template_directory() . '/plugins/realia-paypal.zip',
			'required'              => false,
			'force_deactivation'    => true,
			'is_automatic'          => true,
			'version'               => '0.1.0',
		),
		array(
            'name'                  => 'Realia Property Slider',
            'slug'                  => 'realia-property-slider',
            'source'                => get_template_directory() . '/plugins/realia-property-slider.zip',
            'required'              => false,
            'force_deactivation'    => true,
            'is_automatic'          => true,
            'version'               => '0.1.0',
        ),
		array(
            'name'                  => 'Realia Property Carousel',
            'slug'                  => 'realia-property-carousel',
            'source'                => get_template_directory() . '/plugins/realia-property-carousel.zip',
            'required'              => false,
            'force_deactivation'    => true,
            'is_automatic'          => true,
            'version'               => '0.1.0',
        ),
	);

	tgmpa( $plugins );
}

add_action( 'tgmpa_register', 'properta_register_required_plugins' );

