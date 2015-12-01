<?php

/*
Plugin Name: Realia Pricing
Version: 0.1.1
Description: Provides custom post type for pricing tables, which could be displayed by widget.
Author: Pragmatic Mates
Author URI: http://wprealia.com
Text Domain: realia-pricing
Domain Path: /languages/
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! class_exists( 'Realia_Pricing' ) ) {
	/**
	 * Class Realia_Pricing
	 *
	 * @class Realia_Pricing
	 * @package Realia_Pricing
	 * @author Pragmatic Mates
	 */
	final class Realia_Pricing {
		/**
		 * Initialize Realia_Pricing plugin
		 */
		public function __construct() {
			$this->constants();
			$this->includes();
			$this->load_plugin_textdomain();
		}

		/**
		 * Defines constastants
		 *
		 * @access public
		 * @return void
		 */
		public function constants() {
			define( 'REALIA_PRICING_DIR', plugin_dir_path( __FILE__ ) );
			define( 'REALIA_PRICING_PREFIX', 'pricing_' );
		}

		/**
		 * Include classes
		 *
		 * @access public
		 * @return void
		 */
		public function includes() {
			require_once REALIA_PRICING_DIR . 'includes/class-realia-pricing-post-types.php';
			require_once REALIA_PRICING_DIR . 'includes/class-realia-pricing-widgets.php';
		}

		/**
		 * Loads localization files
		 *
		 * @access public
		 * @return void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'realia-pricing', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}
	}
}

new Realia_Pricing();