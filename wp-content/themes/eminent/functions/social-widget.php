<?php
/*
 * Eminent Social Widget
*/
add_action( 'widgets_init', 'eminent_socialwidget' );

function eminent_socialwidget() {
    register_widget( 'eminent_social_widget' );
}

class eminent_social_widget extends WP_Widget {

    function eminent_social_widget() {
        $eminent_widget_ops = array( 'classname' => 'eminent_social', 'description' => __('A widget that displays social links. ', 'eminent') );
       
        $eminent_control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'eminent-social-widget' );
       
        $this->WP_Widget( 'eminent-social-widget', __('Social Widget', 'eminent'), $eminent_widget_ops, $eminent_control_ops );
    }
   
    function widget( $eminent_args, $eminent_instance ) {
        extract( $eminent_args );

        //Our variables from the widget settings.
        $eminent_title = isset( $eminent_instance['title'] ) ? apply_filters('widget_title', $eminent_instance['title'] ) : '' ;
         $eminent_facebook = isset( $eminent_instance['facebook'] ) ? esc_url_raw(strip_tags($eminent_instance['facebook'])) : '';
        $eminent_twitter = isset( $eminent_instance['twitter'] ) ? esc_url_raw(strip_tags($eminent_instance['twitter'])) : '';
        $eminent_rss = isset( $eminent_instance['rss'] ) ? esc_url_raw(strip_tags($eminent_instance['pinterest'])) : '';
        $eminent_youtube = isset( $eminent_instance['youtube'] ) ? esc_url_raw(strip_tags($eminent_instance['youtube'])) : '';
        $eminent_pinterest = isset( $eminent_instance['pinterest'] ) ? esc_url_raw(strip_tags($eminent_instance['pinterest'])) : '';
		 ;

        echo $before_widget;

        //Display widget
?>       
 
	<?php
	$title = $eminent_instance['title'] ? $eminent_instance['title'] : __( 'Social', 'eminent' );
	echo $before_title . apply_filters( 'widget_title',  $title, $eminent_instance, $this->id_base ) . $after_title;
	?>
		
	<div class="social-links">
		
              <ul>
				  	<?php if(!empty($eminent_instance['facebook'])) { ?>
				    <li>
						<a target="_blank"  href="<?php echo esc_url($eminent_instance['facebook']); ?>">	<i class="fa fa-facebook"></i></a>
					</li>
					 <?php } ?>
					
					<?php if(!empty($eminent_instance['twitter'])) { ?>
					<li>
						<a target="_blank"  href="<?php echo esc_url($eminent_instance['twitter']); ?>">   <i class="fa fa-twitter"></i></a>
					</li>
					<?php } ?>
					
					<?php if(!empty($eminent_instance['rss'])) { ?>
					<li>
						<a target="_blank" href="<?php echo esc_url($eminent_instance['rss']); ?>"><i class="fa fa-rss"></i></a>
					</li>
					<?php } ?>
					
					<?php if(!empty($eminent_instance['pinterest'])) { ?>
					<li>
						<a target="_blank"  href="<?php echo esc_url($eminent_instance['pinterest']); ?>"><i class="fa fa-pinterest"></i></a>
					</li>
					<?php } ?>
					<?php if(!empty($eminent_instance['youtube'])) { ?>
					<li>
						<a target="_blank"  href="<?php echo esc_url($eminent_instance['youtube']); ?>"><i class="fa fa-youtube"></i></a>
					</li>
					<?php } ?>
              </ul>
      </div>

<?php
        echo $after_widget;
    }

    //Update the widget
   
    function update( $eminent_new_instance, $eminent_old_instance ) {
        $eminent_instance = $eminent_old_instance;

        //Strip tags from title and name to remove HTML
		$eminent_instance['title'] = esc_attr(strip_tags( $eminent_new_instance['title'] ));
		$eminent_instance['facebook'] = esc_url_raw(strip_tags( $eminent_new_instance['facebook'] ));
        $eminent_instance['youtube'] = esc_url_raw(strip_tags( $eminent_new_instance['youtube'] ));
        $eminent_instance['twitter'] = esc_url_raw(strip_tags( $eminent_new_instance['twitter'] ));
		$eminent_instance['rss'] = esc_url_raw(strip_tags( $eminent_new_instance['rss'] ));
		$eminent_instance['pinterest'] = esc_url_raw(strip_tags( $eminent_new_instance['pinterest'] ));

        return $eminent_instance;
    }

   
    function form( $eminent_instance ) {

?>

		<p>
            <label for="<?php echo $this->get_field_id( 'title' ); ?>"><?php _e('Widget Title:', 'eminent'); ?></label>
           <input type="text"  id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if(!empty($eminent_instance['title']))
             { 
				 echo esc_attr($eminent_instance['title']); } ?>" class="author-input"  />
				
        </p>
        
        <p>
            <label for="<?php echo $this->get_field_id( 'facebook' ); ?>"><?php _e('Facebook url:', 'eminent'); ?></label>
           <input type="text"  id="<?php echo $this->get_field_id( 'facebook' ); ?>" name="<?php echo $this->get_field_name( 'facebook' ); ?>" value="<?php if(!empty($eminent_instance['facebook']))
             { 
				 echo esc_url($eminent_instance['facebook']); } ?>" class="author-input"  />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'twitter' ); ?>"><?php _e('Twitter url:', 'eminent'); ?></label>
            <input  type="text"  id="<?php echo $this->get_field_id( 'twitter' ); ?>" name="<?php echo $this->get_field_name( 'twitter' ); ?>" value="<?php if(!empty($eminent_instance['twitter'])) { echo esc_url($eminent_instance['twitter']); } ?>" class="author-input" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'rss' ); ?>"><?php _e('rss url:', 'eminent'); ?></label>
            <input  type="text"  id="<?php echo $this->get_field_id( 'rss' ); ?>" name="<?php echo $this->get_field_name( 'rss' ); ?>" value="<?php if(!empty($eminent_instance['rss'])) { echo esc_url($eminent_instance['rss']); } ?>" class="author-input" />
        </p>
        <p>
            <label for="<?php echo $this->get_field_id( 'pinterest' ); ?>"><?php _e('pinterest url:', 'eminent'); ?></label>
            <input type="text"  id="<?php echo $this->get_field_id( 'pinterest' ); ?>" name="<?php echo $this->get_field_name( 'pinterest' ); ?>" value="<?php if(!empty($eminent_instance['pinterest'])) { echo esc_url($eminent_instance['pinterest']); } ?>" class="author-input" />
        </p>
		<p>
            <label for="<?php echo $this->get_field_id( 'youtube' ); ?>"><?php _e('Youtube url:', 'eminent'); ?></label>
            <input  type="text"  id="<?php echo $this->get_field_id( 'youtube' ); ?>" name="<?php echo $this->get_field_name( 'youtube' ); ?>" value="<?php if(!empty($eminent_instance['youtube'])) { echo esc_url($eminent_instance['youtube']); } ?>" class="author-input" />
        </p>
        
    <?php
    }
}



?>
