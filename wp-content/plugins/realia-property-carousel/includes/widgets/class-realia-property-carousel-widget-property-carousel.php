<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Property_Carousel_Widget_Property_Carousel
 *
 * @class Realia_Property_Carousel_Widget_Property_Carousel
 * @package Realia_Property_Carousel/Classes/Widgets
 * @author Pragmatic Mates
 */
class Realia_Property_Carousel_Widget_Property_Carousel extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function Realia_Property_Carousel_Widget_Property_Carousel() {
		parent::__construct(
			'property_carousel_widget',
			__( 'Property Carousel', 'realia-property-carousel' ),
			array(
				'description' => __( 'Displays properties in carousel', 'realia-property-carousel' ),
			)
		);
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
		$query = array(
			'post_type'         => 'property',
			'posts_per_page'    => ! empty( $instance['count'] ) ? $instance['count'] : 4,
		);

		if ( ! empty( $instance['attribute'] ) ) {
			if ( $instance['attribute'] == 'featured' ) {
				$query['meta_query'][] = array(
					'key'       => REALIA_PROPERTY_PREFIX . 'featured',
					'value'     => 'on',
					'compare'   => '==',
				);
			} elseif ( $instance['attribute'] == 'reduced' ) {
				$query['meta_query'][] = array(
					'key'       => REALIA_PROPERTY_PREFIX . 'reduced',
					'value'     => 'on',
					'compare'   => '==',
				);
			}
		}

		query_posts( $query );

		include Realia_Template_Loader::locate( 'widgets/property-carousel', REALIA_PROPERTY_CAROUSEL_DIR );

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
		include Realia_Template_Loader::locate( 'widgets/property-carousel-admin', REALIA_PROPERTY_CAROUSEL_DIR );
	}
}