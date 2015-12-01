<?php 
/*
 * eminent Enqueue css and js files
*/
function eminent_enqueue()
{
	wp_enqueue_style('eminent-bootstrap',get_template_directory_uri().'/css/bootstrap.css',array());
	wp_enqueue_style('eminent-font-awesome',get_template_directory_uri().'/css/font-awesome.css',array());
	wp_enqueue_style('eminent-style',get_stylesheet_uri(),array());
	
	/* js */
	wp_enqueue_script('eminent-bootstrapjs',get_template_directory_uri().'/js/bootstrap.js',array('jquery'));    
	wp_enqueue_script('eminent-scriptjs',get_template_directory_uri().'/js/script.js',array('jquery'));
	wp_enqueue_script('eminent-base', get_template_directory_uri() . '/js/base.js', array('jquery-masonry'));
	
	if ( is_singular() ) wp_enqueue_script( "comment-reply" ); 
}
add_action('wp_enqueue_scripts', 'eminent_enqueue');
