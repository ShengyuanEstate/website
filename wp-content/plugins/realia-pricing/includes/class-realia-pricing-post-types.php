<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Pricing_Post_Types
 *
 * @class Realia_Pricing_Post_Types
 * @package Realia_Pricing/Classes
 * @author Pragmatic Mates
 */
class Realia_Pricing_Post_Types {
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
		require_once REALIA_PRICING_DIR . 'includes/post-types/class-realia-pricing-post-type-pricing-table.php';
	}
}

Realia_Pricing_Post_Types::init();
