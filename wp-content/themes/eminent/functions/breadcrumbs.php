<?php
/*
 * eminent Breadcrumbs
*/
function eminent_custom_breadcrumbs() {

  $eminent_showonhome = 0; // 1 - show breadcrumbs on the homepage, 0 - don't show
  $eminent_delimiter = '/'; // eminent_delimiter between crumbs
  $eminent_home = __('Home','eminent'); // text for the 'Home' link
  $eminent_showcurrent = 1; // 1 - show current post/page title in breadcrumbs, 0 - don't show
  $eminent_before = ' '; // tag before the current crumb
  $eminent_after = ' '; // tag after the current crumb

  global $post;
  $eminent_homelink = esc_url(home_url('/'));

  if (is_home() || is_front_page()) {

    if ($eminent_showonhome == 1) echo '<li><a href="' . $eminent_homelink . '">' . $eminent_home . '</a></li>';
    
  }  else {

    echo '<li><a href="' . $eminent_homelink . '">' . $eminent_home . '</a> ' . $eminent_delimiter . '';
    
   if ( is_category() ) {
      $eminent_thisCat = get_category(get_query_var('cat'), false);
      if ($eminent_thisCat->parent != 0) echo get_category_parents($eminent_thisCat->parent, TRUE, ' ' . $eminent_delimiter . ' ');      
		echo $eminent_before; __('category','eminent'); echo ' "'.single_cat_title('', false) . '"' . $eminent_after;
    } 
    elseif ( is_search() ) {
      echo $eminent_before; __('Search Results For','eminent'); echo ' "'. get_search_query() . '"' . $eminent_after;

    } elseif ( is_day() ) {
      echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $eminent_delimiter . ' ';
      echo '<a href="' . esc_url(get_month_link(get_the_time('Y'),get_the_time('m'))) . '">' . get_the_time('F') . '</a> ' . $eminent_delimiter . ' ';
      echo $eminent_before . get_the_time('d') . $eminent_after;

    } elseif ( is_month() ) {
      echo '<a href="' . esc_url(get_year_link(get_the_time('Y'))) . '">' . get_the_time('Y') . '</a> ' . $eminent_delimiter . ' ';
      echo $eminent_before . get_the_time('F') . $eminent_after;

    } elseif ( is_year() ) {
      echo $eminent_before . get_the_time('Y') . $eminent_after;

    } elseif ( is_single() && !is_attachment() ) {
      if ( get_post_type() != 'post' ) {
        $eminent_post_type = get_post_type_object(get_post_type());
        $eminent_slug = $eminent_post_type->rewrite;
        echo '<a href="' . $eminent_homelink . '/' . $eminent_slug['slug'] . '/">' . $eminent_post_type->labels->singular_name . '</a>';
        if ($eminent_showcurrent == 1) echo ' ' . $eminent_delimiter . ' ' . $eminent_before . esc_attr(get_the_title()) . $eminent_after;
      } else {
        $eminent_cat = get_the_category(); $eminent_cat = $eminent_cat[0];
        $eminent_cats = get_category_parents($eminent_cat, TRUE, ' ' . $eminent_delimiter . ' ');
        if ($eminent_showcurrent == 0) $eminent_cats = preg_replace("#^(.+)\s$eminent_delimiter\s$#", "$1", $eminent_cats);
        echo $eminent_cats;
        if ($eminent_showcurrent == 1) echo $eminent_before . esc_attr(get_the_title()) . $eminent_after;
      }

    } elseif ( !is_single() && !is_page() && get_post_type() != 'post' && !is_404() ) {
      $eminent_post_type = get_post_type_object(get_post_type());
      echo $eminent_before . $eminent_post_type->labels->singular_name . $eminent_after;

    } elseif ( is_attachment() ) {
      $eminent_parent = get_post($post->post_parent);
      $eminent_cat = get_the_category($eminent_parent->ID); $eminent_cat = $eminent_cat[0];
      echo get_category_parents($eminent_cat, TRUE, ' ' . $eminent_delimiter . ' ');
      echo '<a href="' . esc_url(get_permalink($eminent_parent)) . '">' . $eminent_parent->post_title . '</a>';
      if ($eminent_showcurrent == 1) echo ' ' . $eminent_delimiter . ' ' . $eminent_before . esc_attr(get_the_title()) . $eminent_after;

    } elseif ( is_page() && !$post->post_parent ) {
      if ($eminent_showcurrent == 1) echo $eminent_before . esc_attr(get_the_title()) . $eminent_after;

    } elseif ( is_page() && $post->post_parent ) {
      $eminent_parent_id  = $post->post_parent;
      $eminent_breadcrumbs = array();
      while ($eminent_parent_id) {
        $eminent_page = get_page($eminent_parent_id);
        $eminent_breadcrumbs[] = '<a href="' . esc_url(get_permalink()) . '">' . esc_attr(get_the_title($eminent_page->ID)) . '</a>';
        $eminent_parent_id  = $eminent_page->post_parent;
      }
      $eminent_breadcrumbs = array_reverse($eminent_breadcrumbs);
      for ($eminent_i = 0; $eminent_i < count($eminent_breadcrumbs); $eminent_i++) {
        echo $eminent_breadcrumbs[$eminent_i];
        if ($eminent_i != count($eminent_breadcrumbs)-1) echo ' ' . $eminent_delimiter . ' ';
      }
      if ($eminent_showcurrent == 1) echo ' ' . $eminent_delimiter . ' ' . $eminent_before . esc_attr(get_the_title()) . $eminent_after;

    } elseif ( is_tag() ) {
      echo $eminent_before; __('Posts tagged','eminent'); echo ' "'.  single_tag_title('', false) . '"' . $eminent_after;

    } elseif ( is_author() ) {
       global $author;
      $eminent_userdata = get_userdata($author);
      echo $eminent_before; __('Articles posted by ','eminent'); echo $eminent_userdata->display_name . $eminent_after;

    } elseif ( is_404() ) {
      echo $eminent_before; __('Error 404','eminent'); echo $eminent_after;
    }
    
    if ( intval( get_query_var('paged') ) ) {
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ' (';
      echo __('Page','eminent') . ' ' . intval( get_query_var('paged') );
      if ( is_category() || is_day() || is_month() || is_year() || is_search() || is_tag() || is_author() ) echo ')';
    }
    echo '</li>';

  }
} 
