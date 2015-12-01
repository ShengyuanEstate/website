<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Property_Slider_Widget_Property_Slider
 *
 * @class Realia_Property_Slider_Widget_Property_Slider
 * @package Realia_Property_Slider/Classes/Widgets
 * @author Pragmatic Mates
 */
class Realia_Property_Slider_Widget_Property_Slider extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function Realia_Property_Slider_Widget_Property_Slider() {
		parent::__construct(
			'property_slider',
			__( 'Property Slider', 'realia-property-slider' ),
			array(
				'description' => __( 'Displays properties in slider', 'realia-property-slider' ),
			)
		);

		add_action( 'body_class', array( __CLASS__, 'add_body_class' ) );
	}

	/**
	 * Adds classes to body
	 *
	 * @param $classes array
	 *
	 * @access public
	 * @return array
	 */
	public static function add_body_class( $classes ) {
		$settings = get_option( 'widget_property_slider' );

		if ( is_array( $settings ) ) {
			foreach ( $settings as $key => $value ) {
				if ( is_active_widget( false, 'property_slider-' . $key, 'property_slider' ) ) {
					if ( ! empty( $value['classes'] ) ) {
						$parts   = explode( ',', $value['classes'] );
						$classes = array_merge( $classes, $parts );
					}
				}
			}
		}

		return $classes;
	}

	/**
	 * Frontend
	 *
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		$ids = explode( ',', $instance['ids'] );

		query_posts( array(
			'post_type'         => 'property',
			'post_status'       => 'publish',
			'posts_per_page'    => -1,
			'post__in'          => $ids,
			'orderby'           => 'post__in'
		) );

		include Realia_Template_Loader::locate( 'widgets/property-slider', REALIA_PROPERTY_SLIDER_DIR );

		wp_reset_query();
	}

	/**
	 * Update
	 *
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/**
	 * Backend
	 *
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		include Realia_Template_Loader::locate( 'widgets/property-slider-admin', REALIA_PROPERTY_SLIDER_DIR );
	}
}