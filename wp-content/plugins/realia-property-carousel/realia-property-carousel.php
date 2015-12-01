<?php

/*
Plugin Name: Realia Property Carousel
Version: 0.1.0
Description: Adds property carousel widget which shows properties in carousel format. Plugin is using Owl Carousel jQuery library.
Author: Pragmatic Mates
Author URI: http://wprealia.com
Text Domain: realia-subscribers
Domain Path: /languages/
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! class_exists( 'Realia_Property_Carousel' ) && class_exists( 'Realia' ) ) {
	/**
	 * Class Realia_Property_Carousel
	 *
	 * @class Realia_Property_Carousel
	 * @package Realia_Property_Carousel
	 * @author Pragmatic Mates
	 */
	final class Realia_Property_Carousel {
		/**
		 * Initialize Realia_Property_Carousel plugin
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
			define( 'REALIA_PROPERTY_CAROUSEL_DIR', plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Include classes
		 *
		 * @access public
		 * @return void
		 */
		public function includes() {
			require_once REALIA_PROPERTY_CAROUSEL_DIR . 'includes/class-realia-property-carousel-scripts.php';
			require_once REALIA_PROPERTY_CAROUSEL_DIR . 'includes/class-realia-property-carousel-widgets.php';
		}

		/**
		 * Loads localization files
		 *
		 * @access public
		 * @return void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'realia-property-carousel', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}
	}

	new Realia_Property_Carousel();
}
