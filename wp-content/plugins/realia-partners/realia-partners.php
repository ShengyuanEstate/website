<?php

/*
Plugin Name: Realia Partners
Version: 0.1.1
Description: Provides custom post type for partners which logos could be displayed by widget.
Author: Pragmatic Mates
Author URI: http://wprealia.com
Text Domain: realia-partners
Domain Path: /languages/
License: GNU General Public License v3.0
License URI: http://www.gnu.org/licenses/gpl-3.0.html
*/

if ( ! class_exists( 'Realia_Partners' ) && class_exists( 'Realia' ) ) {
	/**
	 * Class Realia_Partners
	 *
	 * @class Realia_Partners
	 * @package Realia_Partners
	 * @author Pragmatic Mates
	 */
	final class Realia_Partners {
		/**
		 * Initialize Realia_Partners plugin
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
			define( 'REALIA_PARTNERS_DIR', plugin_dir_path( __FILE__ ) );
			define( 'REALIA_PARTNERS_PREFIX', 'partner_' );
		}

		/**
		 * Include classes
		 *
		 * @access public
		 * @return void
		 */
		public function includes() {
			require_once REALIA_PARTNERS_DIR . 'includes/class-realia-partners-post-types.php';
			require_once REALIA_PARTNERS_DIR . 'includes/class-realia-partners-widgets.php';
		}

		/**
		 * Loads localization files
		 *
		 * @access public
		 * @return void
		 */
		public function load_plugin_textdomain() {
			load_plugin_textdomain( 'realia-partners', false, plugin_basename( dirname( __FILE__ ) ) . '/languages' );
		}
	}

	new Realia_Partners();
}