<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Property_Slider_Widgets
 *
 * @class Realia_Property_Slider_Widgets
 * @package Realia_Property_Slider/Classes
 * @author Pragmatic Mates
 */
class Realia_Property_Slider_Widgets {
	/**
	 * Initialize widgets
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		self::includes();
		add_action( 'widgets_init', array( __CLASS__, 'register' ) );
	}

	/**
	 * Include widget classes
	 *
	 * @access public
	 * @return void
	 */
	public static function includes() {
		require_once REALIA_PROPERTY_SLIDER_DIR . 'includes/widgets/class-realia-property-slider-widget-property-slider.php';
	}

	/**
	 * Register widgets
	 *
	 * @access public
	 * @return void
	 */
	public static function register() {
		register_widget( 'Realia_Property_Slider_Widget_Property_Slider' );
	}
}

Realia_Property_Slider_Widgets::init();