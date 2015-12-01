<?php

class Aviators_Widget_Simple_Map extends WP_Widget {
    function __construct( $id_base = null, $name = null, $widget_options = array(), $control_options = array() )  {
        if( !$id_base ) {
            $id_base = 'aviators_simple_map';
        }

        if ( ! $name ) {
            $name = __( 'Simple Map', 'properta' );
        }

        $widget_ops = array( 'description' => __( 'Displays 1 place in the map.', 'properta' ) );

        parent::__construct( $id_base, $name, $widget_ops );
    }

    function widget( $args, $instance ) {
        ?>

        <?php echo wp_kses( $args['before_widget'], wp_kses_allowed_html( 'post' ) ); ?>

        <?php $style = ! empty( $instance['style'] ) ? $instance['style'] : ''; ?>
        <?php $style_slug = ! empty( $_GET['map-style'] ) ? $_GET['map-style'] : $style; ?>

        <div class="map-wrapper">
            <div class="map" id="simple-map" style="height: <?php echo esc_attr( $instance['height'] ); ?>px"
                 data-transparent-marker-image="<?php echo get_template_directory_uri(); ?>/assets/img/transparent-marker-image.png"
                 data-latitude="<?php echo esc_attr( $instance['latitude'] ); ?>"
                 data-longitude="<?php echo esc_attr( $instance['longitude'] ); ?>"
                 data-zoom="<?php echo esc_attr( $instance['zoom'] ); ?>"
                 data-styles='<?php echo Realia_Google_Maps_Styles::get_style( $style_slug ); ?>'>
            </div>
        </div><!-- /.map-wrapper -->

        <?php echo wp_kses( $args['after_widget'], wp_kses_allowed_html( 'post' ) ); ?>

    <?php
    }

    function update( $new_instance, $old_instance ) {
        return $new_instance;
    }

    function form( $instance ) {
        ?>

        <?php $latitude = ! empty( $instance['latitude'] ) ? $instance['latitude'] : 40.772799; ?>
        <?php $longitude = ! empty( $instance['longitude'] ) ? $instance['longitude'] : -73.968653; ?>
        <?php $zoom = ! empty( $instance['zoom'] ) ? $instance['zoom'] : 16; ?>
        <?php $height = ! empty( $instance['height'] ) ? $instance['height'] : 350; ?>
        <?php $style = ! empty( $instance['style'] ) ? $instance['style'] : ''; ?>

        <!-- LATITUDE -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'latitude' ) ); ?>">
                <?php echo __( 'Latitude', 'properta' ); ?>
            </label>

            <input  class="widefat"
                    id="<?php echo esc_attr( $this->get_field_id( 'latitude' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'latitude' ) ); ?>"
                    type="text"
                    value="<?php echo esc_attr( $latitude ); ?>">
        </p>

        <!-- LONGITUDE -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'longitude' ) ); ?>">
                <?php echo __( 'Longitude', 'properta' ); ?>
            </label>

            <input  class="widefat"
                    id="<?php echo esc_attr( $this->get_field_id( 'longitude' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'longitude' ) ); ?>"
                    type="text"
                    value="<?php echo esc_attr( $longitude ); ?>">
        </p>

        <!-- ZOOM -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'zoom' ) ); ?>">
                <?php echo __( 'Zoom', 'properta' ); ?>
            </label>

            <input  class="widefat"
                    id="<?php echo esc_attr( $this->get_field_id( 'zoom' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'zoom' ) ); ?>"
                    type="number"
                    max="25"
                    min="0"
                    value="<?php echo esc_attr( $zoom ); ?>">
        </p>

        <!-- HEIGHT -->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>">
                <?php echo __( 'Height in pixels', 'properta' ); ?>
            </label>

            <input  class="widefat"
                    id="<?php echo esc_attr( $this->get_field_id( 'height' ) ); ?>"
                    name="<?php echo esc_attr( $this->get_field_name( 'height' ) ); ?>"
                    type="number"
                    min="0"
                    value="<?php echo esc_attr( $height ); ?>">
        </p>

        <!-- STYLE-->
        <p>
            <label for="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>">
                <?php echo __( 'Style', 'properta' ); ?>
            </label>

            <select id="<?php echo esc_attr( $this->get_field_id( 'style' ) ); ?>" name="<?php echo esc_attr( $this->get_field_name( 'style' ) ); ?>">
                <option value=""><?php echo __( 'Default', 'properta' ); ?></option>
                <?php $maps = Realia_Google_Maps_Styles::styles(); ?>
                <?php if ( is_array( $maps ) ) : ?>
                    <?php foreach ( $maps as $map ): ?>
                        <option <?php if ( $style == $map['slug'] ) : ?>selected="selected"<?php endif; ?>value="<?php echo esc_attr( $map['slug'] ); ?>"><?php echo esc_html( $map['title'] ); ?></option>
                    <?php endforeach; ?>
                <?php endif; ?>
            </select>
        </p>

    <?php
    }
}