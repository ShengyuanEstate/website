<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Partners_Widgets
 *
 * @class Realia_Partners_Widgets
 * @package Realia_Partners/Classes
 * @author Pragmatic Mates
 */
class Realia_Partners_Widgets {
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
		require_once REALIA_PARTNERS_DIR . 'includes/widgets/class-realia-partners-widget-partners.php';
	}

	/**
	 * Register widgets
	 *
	 * @access public
	 * @return void
	 */
	public static function register() {
		register_widget( 'Realia_Partners_Widget_Partners' );
	}
}

Realia_Partners_Widgets::init();