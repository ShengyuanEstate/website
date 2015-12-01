<?php

/*
Plugin Name: Realia PayPal
Version: 0.1.0
Description: Adds PayPal payment gateway.
Author: Pragmatic Mates
Author URI: http://wprealia.com
Text Domain: realia-paypal
Domain Path: /languages/
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! class_exists( 'Realia_PayPal' ) && class_exists( 'Realia' ) ) {
	/**
	 * Class Realia_PayPal
	 *
	 * @class Realia_PayPal
	 * @package Realia_PayPal
	 * @author Pragmatic Mates
	 */
	final class Realia_PayPal {
		/**
		 * Initialize Realia_PayPal plugin
		 */
		public function __construct() {
			$this->constants();
			$this->includes();
			$this->load_plugin_textdomain();
		}

		/**
		 * Defines constants
		 *
		 * @access public
		 * @return void
		 */
		public function constants() {
			define( 'REALIA_PAYPAL_DIR', plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Include classes
		 *
		 * @access public
		 * @return void
		 */
		public function includes() {
			require_once REALIA_PAYPAL_DIR . 'includes/class-realia-paypal-customizations.php';

			if ( Realia_Utilities::is_paypal_enabled() ) {
				require_once REALIA_PAYPAL_DIR . 'includes/class-realia-paypal-logic.php';
			}
		}

		/**
		 * Loads localization files
		 *
		 * @access public
		 * @return void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'realia-paypal', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}
	}

	new Realia_PayPal();
}