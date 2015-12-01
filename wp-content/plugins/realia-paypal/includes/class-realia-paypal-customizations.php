<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Customizations
 *
 * @access public
 * @package Realia_Paypal/Classes/Customizations
 * @return void
 */
class Realia_Paypal_Customizations {
	/**
	 * Initialize customizations
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		self::includes();
	}

	/**
	 * Include all customizations
	 *
	 * @access public
	 * @return void
	 */
	public static function includes() {
		require_once REALIA_PAYPAL_DIR . 'includes/customizations/class-realia-paypal-customizations-paypal.php';
	}
}

Realia_PayPal_Customizations::init();