<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_FAQ_Post_Types
 *
 * @class Realia_FAQ_Post_Types
 * @package Realia_FAQ/Classes
 * @author Pragmatic Mates
 */
class Realia_FAQ_Post_Types {
	/**
	 * Initialize post types
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		self::includes();
	}

	/**
	 * Loads post types
	 *
	 * @access public
	 * @return void
	 */
	public static function includes() {
		require_once REALIA_FAQ_DIR . 'includes/post-types/class-realia-faq-post-type-faq.php';
	}
}

Realia_FAQ_Post_Types::init();
