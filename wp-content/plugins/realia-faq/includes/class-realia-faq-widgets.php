<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_FAQ_Widgets
 *
 * @class Realia_FAQ_Widgets
 * @package Realia_FAQ/Classes
 * @author Pragmatic Mates
 */
class Realia_FAQ_Widgets {
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
		require_once REALIA_FAQ_DIR . 'includes/widgets/class-realia-faq-widget-faq.php';
	}

	/**
	 * Register widgets
	 *
	 * @access public
	 * @return void
	 */
	public static function register() {
		register_widget( 'Realia_FAQ_Widget_FAQ' );
	}
}

Realia_FAQ_Widgets::init();