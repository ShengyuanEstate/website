<?php
/*
* Register Source Sans Pro Google font for eminent
*/
function eminent_font_url() {
   $eminent_font_url = '';
   if ('off' !== _x('on', 'Raleway-Regular font: on or off', 'eminent')) {
       $eminent_font_url = add_query_arg('family', urlencode('Source Sans Pro'), "//fonts.googleapis.com/css?family=Source+Sans+Pro");
   }
   return $eminent_font_url;
}
/*
 * eminent Main Sidebar
*/
function eminent_widgets_init() {

	register_sidebar( array(
		'name'          => __( 'Main Sidebar', 'eminent' ),
		'id'            => 'sidebar-1',
		'description'   => __( 'Main sidebar that appears on the right.', 'eminent' ),
		'before_widget' => '<div class="sidebar-widget widget_categories"  >',
		'after_widget'  => '</div>',
		'before_title'  => '<h3 class="widget-title">',
		'after_title'   => '</h3>',
	) );
	 register_sidebar(array(
       'name' => __('Footer Area One', 'eminent'),
       'id' => 'footer-1',
       'description' => __('Footer Area One that appears on the footer.', 'eminent'),
       'before_widget' => '<div class="footer-widget">',
       'after_widget' => '</div>',
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ));
   register_sidebar(array(
       'name' => __('Footer Area Two', 'eminent'),
       'id' => 'footer-2',
       'description' => __('Footer Area Two that appears on the footer.', 'eminent'),
       'before_widget' => '<div class="footer-widget">',
       'after_widget' => '</div>',
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ));
   register_sidebar(array(
       'name' => __('Footer Area Three', 'eminent'),
       'id' => 'footer-3',
       'description' => __('Footer Area Three that appears on the footer.', 'eminent'),
       'before_widget' => '<div class="footer-widget">',
       'after_widget' => '</div>',
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ));
   register_sidebar(array(
       'name' => __('Footer Area Four', 'eminent'),
       'id' => 'footer-4',
       'description' => __('Footer Area Four that appears on the footer.', 'eminent'),
       'before_widget' => '<div class="footer-widget">',
       'after_widget' => '</div>',
       'before_title' => '<h3 class="widget-title">',
       'after_title' => '</h3>',
   ));
}
add_action( 'widgets_init', 'eminent_widgets_init' );
/*
 * eminent Set up post entry meta.
 *
 * Meta information for current post: categories, tags, permalink, author, and date.
 */
function eminent_entry_meta() {

	$eminent_category_list = get_the_category_list( ', ',' ');		
	$eminent_tag_list = get_the_tag_list(''.__('Tags ','eminent').' : ',' , ');
	$eminent_date = sprintf( '<time datetime="%1$s">%2$s</time>',
		esc_attr( get_the_date( 'c' ) ),
		esc_html( get_the_date() )
	);
	$eminent_author = sprintf( '<a href="%1$s" title="%2$s" >%3$s</a>',
		esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
		esc_attr( sprintf( __( 'View all posts by %s', 'eminent' ), get_the_author() ) ),
		get_the_author()
	);
		if(is_page_template('page-templates/homepage.php')){
		$eminent_utility_text = '<div class="post-meta"><ul><li class="post-author"> '.__('Posted','eminent').' :  %4$s </li> / <li> '.eminent_comment_number_custom().'</li></ul></div>';
	}
	elseif($eminent_category_list) {
		$eminent_utility_text = '<div class="post-meta"><ul> <li class="post-author"> '.__('Posted','eminent').' :  %4$s </li>  <li class="post-tag"> %2$s </li> / <li> '.__('Categorys','eminent').' : %1$s </li> / <li>  '.eminent_comment_number_custom().'</li></ul></div>';						
	}
	elseif($eminent_tag_list ) {
		$eminent_utility_text = '<div class="post-meta"><ul><li class="post-author"> '.__('Posted','eminent').' :  %4$s </li>  / <li class="post-tag"> '.__('Tags','eminent').' :  %2$s </li> / <li>   %1$s </li> / <li> '.eminent_comment_number_custom().'</li></ul></div>';
	}
	
	
	 else{
		$eminent_utility_text = '<div class="post-meta"><ul><li class="post-author"> '.__('Posted','eminent').' :  %4$s </li>  <li> '.eminent_comment_number_custom().'</li></ul></div>';
	}
	printf(
		$eminent_utility_text,
		$eminent_category_list,
		$eminent_tag_list,
		$eminent_date,
		$eminent_author
	);
}
function eminent_comment_number_custom(){
$eminent_num_comments = get_comments_number(); // get_comments_number returns only a numeric value
$eminent_comments=__('No Comments','eminent');
if ( comments_open() ) {
	if ( $eminent_num_comments == 0 ) {
		$eminent_comments = __('No Comments','eminent');
	} elseif ( $eminent_num_comments > 1 ) {
		$eminent_comments = $eminent_num_comments . __(' Comments','eminent');
	} else {
		$eminent_comments = __('1 Comment','eminent');
	}
}
return $eminent_comments;
}
/*
 * Comments placeholder function
 * 
**/
add_filter( 'comment_form_default_fields', 'eminent_comment_placeholders' );

function eminent_comment_placeholders( $fields )
{
	$fields['author'] = str_replace(
		'<input',
		'<input placeholder="'
		
		. _x(
		'Name *',
		'comment form placeholder',
		'eminent'
		)
		. '" required',
		
	$fields['author']
	);
	$fields['email'] = str_replace(
		'<input',
		'<input placeholder="'
		. _x(
		'Email Id *',
		'comment form placeholder',
		'eminent'
		)
		. '" required',
	$fields['email']
	);
	$fields['url'] = str_replace(
		'<input',
		'<input placeholder="'
		. _x(
		'Website URl',
		'comment form placeholder',
		'eminent'
		)
		. '" required',
	$fields['url']
	);
	
	return $fields;
}
add_filter( 'comment_form_defaults', 'eminent_textarea_insert' );
	function eminent_textarea_insert( $fields )
	{
		$fields['comment_field'] = str_replace(
			'<textarea',
			'<textarea  placeholder="'
			. _x(
			'Comment',
			'comment form placeholder',
			'eminent'
			)
		. '" ',
		$fields['comment_field']
		);
	return $fields;
	}
?>
