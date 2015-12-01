<?php
/*
 * eminent Get in touch
*/
add_action( 'widgets_init', 'eminent_widget' );
function eminent_widget() {
    register_widget( 'eminent_info_widget' );
}
class eminent_info_widget extends WP_Widget {
    function eminent_info_widget() {
        $eminent_widget_ops = array( 'classname' => 'eminent_info', 'description' => __('A widget that displays the title,contact information. ', 'eminent') );
       
        $eminent_control_ops = array( 'width' => 300, 'height' => 350, 'id_base' => 'eminent-info-widget' );
       
        $this->WP_Widget( 'eminent-info-widget', __('Get In Touch', 'eminent'), $eminent_widget_ops, $eminent_control_ops );
    }
    function widget( $eminent_args, $eminent_instance ) {
        extract( $eminent_args );
        //Our variables from the widget settings.
        $eminent_title = isset( $eminent_instance['title'] ) ? apply_filters('widget_title', $eminent_instance['title'] ) : '' ;
        $eminent_address = isset( $eminent_instance['address'] ) ? sanitize_text_field(strip_tags($eminent_instance['address'])) : '';
       

        $eminent_phone = isset( $eminent_instance['phone'] ) ? sanitize_text_field(strip_tags($eminent_instance['phone'])) : '';
        $eminent_fax = isset( $eminent_instance['fax'] ) ? sanitize_text_field(strip_tags($eminent_instance['fax'])) : '';
        $eminent_email = isset( $eminent_instance['email'] ) ? sanitize_email(strip_tags($eminent_instance['email'])) : '';
        $eminent_website = isset( $eminent_instance['website'] ) ? esc_url_raw(strip_tags($eminent_instance['website'])) : '';
        echo $before_widget;
        //Display widget
?>
	
	<?php
	$title = $eminent_instance['title'] ? $eminent_instance['title'] : __( 'Contributor', 'eminent' );
	echo $before_title . apply_filters( 'widget_title',  $title, $eminent_instance, $this->id_base ) . $after_title;
	?>	
  <div class="contct-widget">
  <?php if(!empty($eminent_instance['address'])) { ?>
  <p><?php echo esc_attr($eminent_instance['address']); ?> 
  </p>
    <?php } ?>
    <?php if(!empty($eminent_instance['phone'])) { ?>
        <p><?php _e('Phone:','eminent');?> <?php echo esc_attr($eminent_instance['phone']); ?></p>
    <?php } ?>
    <?php if(!empty($eminent_instance['fax'])) { ?>
        <p><?php _e('Fax:','eminent');?> <?php echo esc_attr($eminent_instance['fax']); ?></p>
    <?php } ?>
    <?php if(!empty($eminent_instance['email'])) { ?>
        <p><?php _e('Email:','eminent');?> <a href="mailto:<?php echo esc_attr($eminent_instance['email']); ?>"><?php echo $eminent_instance['email']; ?></a></p>
    <?php } ?>
    <?php if(!empty($eminent_instance['website'])) { ?>
        <p><?php _e('Web:','eminent');?><a href="<?php echo esc_url($eminent_instance['website']); ?>"><?php echo esc_url($eminent_instance['website']); ?></a></p>
    <?php } ?>
          </div>
<?php        
        echo $after_widget;
    }
    //Update the widget
    function update( $new_instance, $old_instance ) {
        $eminent_instance = $old_instance;

        //Strip tags from title and name to remove HTML
        $eminent_instance['title'] = strip_tags( $new_instance['title'] );
        $eminent_instance['address'] = strip_tags( $new_instance['address'] );
        $eminent_instance['country'] = strip_tags( $new_instance['country'] );	
        $eminent_instance['phone'] = strip_tags( $new_instance['phone'] );
        $eminent_instance['fax'] = strip_tags( $new_instance['fax'] );
        $eminent_instance['website'] = esc_url_raw(strip_tags( $new_instance['website']));
        $eminent_instance['email'] = sanitize_email(strip_tags( $new_instance['email'] ));
		
        return $eminent_instance;
    }
    function form( $eminent_instance ) {
?>
<p>
  <label for="<?php echo $this->get_field_id( 'title' ); ?>">
    <?php _e('Widget Title:', 'eminent'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'title' ); ?>" name="<?php echo $this->get_field_name( 'title' ); ?>" value="<?php if(!empty($eminent_instance['title'])) { echo $eminent_instance['title']; } ?>"  type="text" class="widefat" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'address' ); ?>">
    <?php _e('Address:', 'eminent'); ?>
  </label>
  <textarea id="<?php echo $this->get_field_id( 'address' ); ?>" name="<?php echo $this->get_field_name( 'address' ); ?>"  class="widefat" ><?php if(!empty($eminent_instance['address'])) { echo $eminent_instance['address']; } ?> </textarea> 
</p>

<p>
  <label for="<?php echo $this->get_field_id( 'phone' ); ?>">
    <?php _e('Phone:', 'eminent'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'phone' ); ?>" name="<?php echo $this->get_field_name( 'phone' ); ?>" value="<?php if(!empty($eminent_instance['phone'])) { echo $eminent_instance['phone']; } ?>" type="text" class="widefat" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'fax' ); ?>">
    <?php _e('Fax:', 'eminent'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'fax' ); ?>" name="<?php echo $this->get_field_name( 'fax' ); ?>" value="<?php if(!empty($eminent_instance['fax'])) { echo $eminent_instance['fax']; } ?>" type="text" class="widefat" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'email' ); ?>">
    <?php _e('Email Address:', 'eminent'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'email' ); ?>" name="<?php echo $this->get_field_name( 'email' ); ?>" value="<?php if(!empty($eminent_instance['email'])) { echo esc_attr($eminent_instance['email']); } ?>" type="text" class="widefat" />
</p>
<p>
  <label for="<?php echo $this->get_field_id( 'website' ); ?>">
    <?php _e('Website:', 'eminent'); ?>
  </label>
  <input id="<?php echo $this->get_field_id( 'website' ); ?>" name="<?php echo $this->get_field_name( 'website' ); ?>" value="<?php if(!empty($eminent_instance['website'])) { echo $eminent_instance['website']; } ?>" type="text" class="widefat" />
</p>
<?php
    }
}

?>