<?php 
/*
 * Set up the content width value based on the theme's design.
 */
if ( ! function_exists( 'eminent_setup' ) ) :
function eminent_setup() {
	
	// This theme uses wp_nav_menu() in one locations.
	register_nav_menus( array(
		'primary'   => __( 'Main Menu', 'eminent' ),	
	) );
	global $eminent_content_width;
	if ( ! isset( $content_width ) ) $content_width = 900;
			/*
		 * Make eminent theme available for translation.
		 */

	load_theme_textdomain( 'eminent', get_template_directory() . '/languages' );
	// This theme styles the visual editor to resemble the theme style.
	add_editor_style(array('css/editor-style.css', eminent_font_url()));
	// Add RSS feed links to <head> for posts and comments.
	add_theme_support('automatic-feed-links');
	add_theme_support( 'title-tag' );
	add_theme_support('post-thumbnails');

	set_post_thumbnail_size( 770, 350, true );
	 add_image_size('eminent-blog-thumbnail-image', 770, 400, true);
	 add_image_size('eminent-blog-thumbnail-image-home', 370, 263, true);
	
	/*        
	* Switch default core markup for search form, comment form, and comments        
	* to output valid HTML5.        
	*/
	add_theme_support('html5', array(
		'search-form', 'comment-form', 'comment-list',
	));
	// Add support for featured content.
	add_theme_support('featured-content', array(
	   'featured_content_filter' => 'eminent_get_featured_posts',
	   'max_posts' => 6,
	));
	
	add_theme_support( 'custom-header', apply_filters( 'eminent_custom_header_args', array(
	'uploads'       => true,
	'flex-height'   => true,
	'default-text-color' => '#e36229',
	'header-text' => true,
	'height' => '120',
	'width'  => '1260'
 	) ) );
	add_theme_support( 'custom-background', apply_filters( 'eminent_custom_background_args', array(
	'default-color' => 'f5f5f5',
	) ) );
	// This theme uses its own gallery styles.       
	add_filter('use_default_gallery_style', '__return_false');
	
	  	
}

endif; // eminent_setup
add_action( 'after_setup_theme', 'eminent_setup' );

add_action('wp_head','eminent_welcome_bg_img_css');
function eminent_welcome_bg_img_css()
{
	$eminent_welcome_image=get_theme_mod('eminent_welcome_image');
	$eminent_header_bg_img=get_theme_mod('eminent-breadcrumbsbg-bg');

	if (!empty($eminent_welcome_image)){
		$eminent_welcome_image = esc_url(get_theme_mod('eminent_welcome_image'));
		$eminent_welcome_output="<style> .welcome-section { background :url('".$eminent_welcome_image."');
		background-position: center;} </style>";
		echo $eminent_welcome_output;		
	}
	if (!empty($eminent_header_bg_img)){
		$eminent_header_bg_img = esc_url(get_theme_mod('eminent-breadcrumbsbg-bg'));
		$eminent_header_output="<style>  .page-title { background : url('".$eminent_header_bg_img."') no-repeat; } </style>";
		echo $eminent_header_output;		
	}
	
}

// add menu items in wp_nav_menu
add_filter( 'wp_nav_menu_items', 'eminent_custom_menu_item', 10, 2 );
function eminent_custom_menu_item ( $items, $args ) {
	if($args->theme_location == 'primary'){
			$items .= '<li class="search-box">
					<div class="theme_search_toggle">
						<a  href="javascript:void(0)">
							<i class="fa fa-search" ></i>
						</a></div>';
		$items .= '<div class="theme_search_wrapper" id="search-form-box">';
		$items .='<form method="get" action="'. home_url() .'">';
		$items .='<input type="text" value="'. get_search_query() .'" class="search-text-box" name="s" id="s"  placeholder="'. __("Search here","eminent") .'">';
		$items .='</form>';
		
		$items .='</div>
					
				</li>';
		return $items;				  
	}
}

/***  excerpt Length ***/ 		
function eminent_change_excerpt_more( $eminent_more ) {
    return '<div class="theme-button  text-center"><a class="default-btn" href="'. get_permalink() . '" >'.__('READ MORE','eminent').'</a></div>';
}
add_filter('excerpt_more', 'eminent_change_excerpt_more');
function eminent_excerpt_length( $eminent_length ) {
    return 24;
}
add_filter( 'excerpt_length', 'eminent_excerpt_length', 999 );


/* get in touch start */
require get_template_directory() . '/functions/getintouch.php';

/*** Enqueue css and js files ***/
require get_template_directory() . '/functions/enqueue-files.php';

/*** Theme Default Setup ***/
require get_template_directory() . '/functions/theme-default-setup.php';

/*** Breadcrumbs ***/
require get_template_directory() . '/functions/breadcrumbs.php';

/*** Custom Header ***/
require get_template_directory() . '/functions/custom-header.php';

/*** tgm-plugins ***/
require get_template_directory() . '/functions/tgm-plugins.php';

/*** Customizer ***/
require get_template_directory() . '/functions/theme-customizer.php';

/*** Social Widget ***/
require get_template_directory() . '/functions/social-widget.php';

require get_template_directory() . '/theme-options/theme-option.php';