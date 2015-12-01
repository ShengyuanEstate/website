<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Property_Slider_Extend
 *
 * @class Realia_Property_Slider_Extend
 * @package Realia_Property_Slider/Classes
 * @author Pragmatic Mates
 */
class Realia_Property_Slider_Extend {
	/**
	 * Initialize scripts
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		add_action( 'cmb2_meta_boxes', array( __CLASS__, 'add_image_slider_field' ), 9999 );
	}

	public static function add_image_slider_field( $metaboxes ) {
		$metaboxes[REALIA_PROPERTY_PREFIX . 'general']['fields'][] = array(
			'name'              => __( 'Image for slider', 'realia-property-slider' ),
			'id'                => REALIA_PROPERTY_PREFIX . 'slider_image',
			'description'       => __( 'Use large images which has at least 1920px width and 1080px height.', 'realia-property-slider' ),
			'type'              => 'file',
		);

		return $metaboxes;
	}
}

Realia_Property_Slider_Extend::init();