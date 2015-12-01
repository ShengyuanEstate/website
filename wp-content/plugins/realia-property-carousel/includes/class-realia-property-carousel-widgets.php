<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Property_Carousel_Widgets
 *
 * @class Realia_Property_Carousel_Widgets
 * @package Realia_Property_Carousel/Classes
 * @author Pragmatic Mates
 */
class Realia_Property_Carousel_Widgets {
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
		require_once REALIA_PROPERTY_CAROUSEL_DIR . 'includes/widgets/class-realia-property-carousel-widget-property-carousel.php';
	}

	/**
	 * Register widgets
	 *
	 * @access public
	 * @return void
	 */
	public static function register() {
		register_widget( 'Realia_Property_Carousel_Widget_Property_Carousel' );
	}
}

Realia_Property_Carousel_Widgets::init();