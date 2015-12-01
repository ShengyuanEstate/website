<?php class SP_News_Widget extends WP_Widget {

    function SP_News_Widget() {

        $widget_ops = array('classname' => 'SP_News_Widget', 'description' => __('Displayed Latest News Items from the News  in a sidebar', 'news_cpt') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'sp_news_widget' );
        $this->WP_Widget( 'sp_news_widget', __('Latest News Widget', 'news_cpt'), $widget_ops, $control_ops );
    }

    function form($instance) {
        $defaults = array(
        'limit'             => 5,
        'title'             => '',
        "date"              => false, 
        'show_category'     => false,
        'category'          => 0,
        );

        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;
    ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>">Number of Items: <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo attribute_escape($num_items); ?>" /></label></p>
      <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'news' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'news' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'news' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => 'news-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'news' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>	
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['num_items'] = $new_instance['num_items'];
        $instance['date'] = (bool) esc_attr( $new_instance['date'] );
        $instance['show_category'] = (bool) esc_attr( $new_instance['show_category'] );
        $instance['category']      = intval( $new_instance['category'] );   
        return $instance;
    }
    function widget($news_args, $instance) {
        extract($news_args, EXTR_SKIP);

        $current_post_name = get_query_var('name');

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $num_items = empty($instance['num_items']) ? '5' : apply_filters('widget_title', $instance['num_items']);
        if ( isset( $instance['date'] ) && ( 1 == $instance['date'] ) ) { $date = "true"; } else { $date = "false"; }
        if ( isset( $instance['show_category'] ) && ( 1 == $instance['show_category'] ) ) { $show_category = "true"; } else { $show_category = "false"; }
        if ( isset( $instance['category'] ) && is_numeric( $instance['category'] ) ) $category = intval( $instance['category'] );
        $postcount = 0;

        echo $before_widget;

?>
             <h4 class="widget-title"><?php echo $title ?></h4>
            <!--visual-columns-->
            <?php if($date == "false" && $show_category == "false"){ 
                $no_p = "no_p";
                }?>
            <div class="recent-news-items <?php echo $no_p?>">
                <ul>
            <?php // setup the query
            $news_args = array( 'suppress_filters' => true,
                           'posts_per_page' => $num_items,
                           'post_type' => 'news',
                           'order' => 'DESC'
                         );

            if($category != 0){
            	$news_args['tax_query'] = array( array( 'taxonomy' => 'news-category', 'field' => 'id', 'terms' => $category) );
            }
            $cust_loop = new WP_Query($news_args);
               $post_count = $cust_loop->post_count;
          $count = 0;
           
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
                    $count++;
               $terms = get_the_terms( $post->ID, 'news-category' );
                    $news_links = array();
                    if($terms){

                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                    $cate_name = join( ", ", $news_links );
                    ?>
                    <li class="news_li">
                       <h6> <a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
						<?php echo ($date == "true")? '<p>'.get_the_date('j, M y') : "" ;?>
                  		<?php echo ($date == "true" && $show_category == "true" && $cate_name != '') ? " , " : "";?>
                  		<?php echo ($show_category == 'true' && $cate_name != '') ? $cate_name.'</p>' : ""?>
                    </li>
            <?php endwhile;
            endif;
             wp_reset_query(); ?>

                </ul>
            </div>
<?php
        echo $after_widget;
    }
}
/* Register the widget */
function sp_news_widget_load_widgets() {
    register_widget( 'SP_News_Widget' );
}
/* Load the widget */
add_action( 'widgets_init', 'sp_news_widget_load_widgets' );
/* scrolling news */
class SP_News_scrolling_Widget extends WP_Widget {
    function SP_News_scrolling_Widget() {
        $widget_ops = array('classname' => 'SP_News_scrolling_Widget', 'description' => __('Displayed Latest News Items from the News  in a sidebar', 'news_cpt') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'sp_news_s_widget' );
        $this->WP_Widget( 'sp_news_s_widget', __('Latest News Scrolling Widget', 'news_cpt'), $widget_ops, $control_ops );
    }
    function form($instance) {
        $defaults = array(
        'limit'             => 5,
        'title'             => '',
        "date"              => false, 
        'show_category'     => false,
        'category'          => 0,
        );

        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;              
    ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>">Number of Items: <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo attribute_escape($num_items); ?>" /></label></p>
      <p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'news' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'news' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'news' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => 'news-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'news' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['num_items'] = $new_instance['num_items'];
        $instance['date'] = (bool) esc_attr( $new_instance['date'] );
        $instance['show_category'] = (bool) esc_attr( $new_instance['show_category'] );
        $instance['category']      = intval( $new_instance['category'] );        
        return $instance;
    }
    function widget($news_args, $instance) {
        extract($news_args, EXTR_SKIP);
        $current_post_name = get_query_var('name');
        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);  
		$num_items = empty($instance['num_items']) ? '5' : apply_filters('widget_title', $instance['num_items']);  
        if ( isset( $instance['date'] ) && ( 1 == $instance['date'] ) ) { $date = "true"; } else { $date = "false"; }
        if ( isset( $instance['show_category'] ) && ( 1 == $instance['show_category'] ) ) { $show_category = "true"; } else { $show_category = "false"; }
        if ( isset( $instance['category'] ) && is_numeric( $instance['category'] ) ) $category = intval( $instance['category'] );
        $postcount = 0;

        echo $before_widget;

?>
             <h4 class="widget-title"><?php echo $title ?></h4>
            <!--visual-columns-->
            <?php if($date == "false" && $show_category == "false"){ 
                $no_p = "no_p";
                }?>
            <div class="recent-news-items <?php echo $no_p;?>">
               <div class="newsticker-jcarousellite">
			   <ul>
            <?php // setup the query
            $news_args = array( 'suppress_filters' => true,
       							'posts_per_page' => $num_items,                   
                           'post_type' => 'news',
                           'order' => 'DESC'
                         );
            if($category != 0){
            	$news_args['tax_query'] = array( array( 'taxonomy' => 'news-category', 'field' => 'id', 'terms' => $category) );
            }
            $cust_loop = new WP_Query($news_args);
               $post_count = $cust_loop->post_count;
          $count = 0;
           
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
                    $count++;
               $terms = get_the_terms( $post->ID, 'news-category' );
                    $news_links = array();
                    if($terms){

                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                    $cate_name = join( ", ", $news_links );
                    ?>
                    <li class="news_li">
                        <h6><a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
                    	<?php echo ($date == "true")? '<p>'.get_the_date('j, M y') : "" ;?>
                  		<?php echo ($date == "true" && $show_category == "true" && $cate_name != '') ? " , " : "";?>
                  		<?php echo ($show_category == 'true' && $cate_name != '') ? $cate_name.'</p>' : ""?>
                    </li>
            <?php endwhile;
            endif;
             wp_reset_query(); ?>
                </ul>
	            </div>
            </div>
<?php
        echo $after_widget;
    }
}

/* Register the widget */
function sp_news_scroll_widget_load_widgets() {
    register_widget( 'SP_News_scrolling_Widget' );
}

/* Load the widget */
add_action( 'widgets_init', 'sp_news_scroll_widget_load_widgets' );

/* news with thumb */
class SP_News_thmb_Widget extends WP_Widget {

    function SP_News_thmb_Widget() {

        $widget_ops = array('classname' => 'SP_News_thmb_Widget', 'description' => __('Displayed Latest News Items in a sidebar with thumbnails', 'news_cpt') );
        $control_ops = array( 'width' => 350, 'height' => 450, 'id_base' => 'sp_news_sthumb_widget' );
        $this->WP_Widget( 'sp_news_sthumb_widget', __('Latest News with thumb', 'news_cpt'), $widget_ops, $control_ops );
    }

    function form($instance) {	
        $defaults = array(
        'limit'             => 5,
        'title'             => '',
        "date"              => false, 
        'show_category'     => false,
        'category'          => 0,
        );

        $instance = wp_parse_args( (array) $instance, $defaults );
        $title = isset($instance['title']) ? esc_attr($instance['title']) : '';
        $num_items = isset($instance['num_items']) ? absint($instance['num_items']) : 5;
    ?>
      <p><label for="<?php echo $this->get_field_id('title'); ?>">Title: <input class="widefat" id="<?php echo $this->get_field_id('title'); ?>" name="<?php echo $this->get_field_name('title'); ?>" type="text" value="<?php echo attribute_escape($title); ?>" /></label></p>
      <p><label for="<?php echo $this->get_field_id('num_items'); ?>">Number of Items: <input class="widefat" id="<?php echo $this->get_field_id('num_items'); ?>" name="<?php echo $this->get_field_name('num_items'); ?>" type="text" value="<?php echo attribute_escape($num_items); ?>" /></label></p>
    	<p>
            <input id="<?php echo $this->get_field_id( 'date' ); ?>" name="<?php echo $this->get_field_name( 'date' ); ?>" type="checkbox"<?php checked( $instance['date'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'date' ); ?>"><?php _e( 'Display Date', 'news' ); ?></label>
        </p>
        <p>
            <input id="<?php echo $this->get_field_id( 'show_category' ); ?>" name="<?php echo $this->get_field_name( 'show_category' ); ?>" type="checkbox"<?php checked( $instance['show_category'], 1 ); ?> />
            <label for="<?php echo $this->get_field_id( 'show_category' ); ?>"><?php _e( 'Display Category', 'news' ); ?></label>
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'category' ); ?>"><?php _e( 'Category:', 'news' ); ?></label>
            <?php
                $dropdown_args = array( 'taxonomy' => 'news-category', 'class' => 'widefat', 'show_option_all' => __( 'All', 'news' ), 'id' => $this->get_field_id( 'category' ), 'name' => $this->get_field_name( 'category' ), 'selected' => $instance['category'] );
                wp_dropdown_categories( $dropdown_args );
            ?>
        </p>
    <?php
    }

    function update($new_instance, $old_instance) {
        $instance = $old_instance;
        $instance['title'] = $new_instance['title'];
        $instance['num_items'] = $new_instance['num_items'];
        $instance['date'] = (bool) esc_attr( $new_instance['date'] );
        $instance['show_category'] = (bool) esc_attr( $new_instance['show_category'] );
        $instance['category']      = intval( $new_instance['category'] );
        return $instance;
    }
    function widget($news_args, $instance) {
        extract($news_args, EXTR_SKIP);

        $current_post_name = get_query_var('name');

        $title = empty($instance['title']) ? '' : apply_filters('widget_title', $instance['title']);
        $num_items = empty($instance['num_items']) ? '5' : apply_filters('widget_title', $instance['num_items']);
        if ( isset( $instance['date'] ) && ( 1 == $instance['date'] ) ) { $date = "true"; } else { $date = "false"; }
        if ( isset( $instance['show_category'] ) && ( 1 == $instance['show_category'] ) ) { $show_category = "true"; } else { $show_category = "false"; }
        if ( isset( $instance['category'] ) && is_numeric( $instance['category'] ) ) $category = intval( $instance['category'] );
        $postcount = 0;
        echo $before_widget;
?>
             <h4 class="widget-title"><?php echo $title ?></h4>
            <!--visual-columns-->
            <?php if($date == "false" && $show_category == "false"){ 
                $no_p = "no_p";
                }?>
            <div class="recent-news-items <?php echo $no_p;?>">
			  <div class="newstickerthumb">
                <ul>
            <?php // setup the query
            $news_args = array( 'suppress_filters' => true,
                           'posts_per_page' => $num_items,
                           'post_type' => 'news',
                           'order' => 'DESC'
                         );
            if($category != 0){
            	$news_args['tax_query'] = array( array( 'taxonomy' => 'news-category', 'field' => 'id', 'terms' => $category) );
            }

            $cust_loop = new WP_Query($news_args);
            $post_count = $cust_loop->post_count;
          $count = 0;
            if ($cust_loop->have_posts()) : while ($cust_loop->have_posts()) : $cust_loop->the_post(); $postcount++;
                    $count++;
               $terms = get_the_terms( $post->ID, 'news-category' );
                    $news_links = array();
                    if($terms){

                    foreach ( $terms as $term ) {
                        $term_link = get_term_link( $term );
                        $news_links[] = '<a href="' . esc_url( $term_link ) . '">'.$term->name.'</a>';
                    }
                }
                    $cate_name = join( ", ", $news_links );
                    ?>
                    <li class="news_li">
						<div class="news_thumb_left">
					   <a  href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"> 
                  		
                  	<?php
                  if ( function_exists('has_post_thumbnail') && has_post_thumbnail() ) {
                   the_post_thumbnail( array(80,80) );
                  }
                  ?> </a></div>
				  <div class="news_thumb_right">
                        <h6><a class="post-title" href="<?php the_permalink(); ?>" title="<?php the_title(); ?>"><?php the_title(); ?></a></h6>
						<?php echo ($date == "true")? '<p>'.get_the_date('j, M y') : "" ;?>
                  		<?php echo ($date == "true" && $show_category == "true" && $cate_name != '') ? " , " : "";?>
                  		<?php echo ($show_category == 'true' && $cate_name != '') ? $cate_name.'</p>' : ""?></div>
						
                    </li>
            <?php endwhile;
            endif;
             wp_reset_query(); ?>

                </ul>
            </div> </div>
<?php
        echo $after_widget;
    }
}
/* Register the widget */
function sp_news_thumb_widget_load_widgets() {
    register_widget( 'SP_News_thmb_Widget' );
}

/* Load the widget */
add_action( 'widgets_init', 'sp_news_thumb_widget_load_widgets' );