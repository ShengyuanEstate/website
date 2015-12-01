<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Pricing_Widgets
 *
 * @class Realia_Pricing_Widgets
 * @package Realia_Pricing/Classes
 * @author Pragmatic Mates
 */
class Realia_Pricing_Widgets {
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
		require_once REALIA_PRICING_DIR . 'includes/widgets/class-realia-pricing-widget-pricing-tables.php';
	}

	/**
	 * Register widgets
	 *
	 * @access public
	 * @return void
	 */
	public static function register() {
		register_widget( 'Realia_Pricing_Widget_Pricing_Tables' );
	}
}

Realia_Pricing_Widgets::init();