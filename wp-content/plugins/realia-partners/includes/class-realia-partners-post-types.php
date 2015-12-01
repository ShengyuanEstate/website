<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Partners_Post_Types
 *
 * @class Realia_Partners_Post_Types
 * @package Realia_Partners/Classes
 * @author Pragmatic Mates
 */
class Realia_Partners_Post_Types {
	/**
	 * Initialize property types
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		self::includes();
	}

	/**
	 * Loads property types
	 *
	 * @access public
	 * @return void
	 */
	public static function includes() {
		require_once REALIA_PARTNERS_DIR . 'includes/post-types/class-realia-partners-post-type-partner.php';
	}
}

Realia_Partners_Post_Types::init();
