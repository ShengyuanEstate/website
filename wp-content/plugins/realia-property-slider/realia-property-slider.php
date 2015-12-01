<?php

/*
Plugin Name: Realia Property Slider
Version: 0.1.0
Description: Adds property slider widget which shows properties in slider format.
Author: Pragmatic Mates
Author URI: http://wprealia.com
Text Domain: realia-property-slider
Domain Path: /languages/
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! class_exists( 'Realia_Property_Slider' ) && class_exists( 'Realia' ) ) {
	/**
	 * Class Realia_Property_Slider
	 *
	 * @class Realia_Property_Slider
	 * @package Realia_Property_Slider
	 * @author Pragmatic Mates
	 */
	final class Realia_Property_Slider {
		/**
		 * Initialize Realia_Property_Slider plugin
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
			define( 'REALIA_PROPERTY_SLIDER_DIR', plugin_dir_path( __FILE__ ) );
		}

		/**
		 * Include classes
		 *
		 * @access public
		 * @return void
		 */
		public function includes() {
			require_once REALIA_PROPERTY_SLIDER_DIR . 'includes/class-realia-property-slider-scripts.php';
			require_once REALIA_PROPERTY_SLIDER_DIR . 'includes/class-realia-property-slider-widgets.php';
			require_once REALIA_PROPERTY_SLIDER_DIR . 'includes/class-realia-property-slider-extend.php';
		}

		/**
		 * Loads localization files
		 *
		 * @access public
		 * @return void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'realia-property-slider', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}
	}

	new Realia_Property_Slider();
}