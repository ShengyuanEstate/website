<?php

/*
Plugin Name: Realia FAQ
Version: 0.1.1
Description: Provides custom post type for Frequently Asked Questions which could be displayed by widget.
Author: Pragmatic Mates
Author URI: http://wprealia.com
Text Domain: realia-faq
Domain Path: /languages/
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! class_exists( 'Realia_FAQ' ) && class_exists( 'Realia' ) ) {
	/**
	 * Class Realia_FAQ
	 *
	 * @class Realia_FAQ
	 * @package Realia_FAQ
	 * @author Pragmatic Mates
	 */
	final class Realia_FAQ {
		/**
		 * Initialize Realia_FAQ plugin
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
			define( 'REALIA_FAQ_DIR', plugin_dir_path( __FILE__ ) );
			define( 'REALIA_FAQ_PREFIX', 'faq_' );
		}

		/**
		 * Include classes
		 *
		 * @access public
		 * @return void
		 */
		public function includes() {
			require_once REALIA_FAQ_DIR . 'includes/class-realia-faq-post-types.php';
			require_once REALIA_FAQ_DIR . 'includes/class-realia-faq-widgets.php';
		}

		/**
		 * Loads localization files
		 *
		 * @access public
		 * @return void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'realia-faq', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}
	}

	new Realia_FAQ();
}