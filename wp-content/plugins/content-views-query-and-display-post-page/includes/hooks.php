<?php

/**
 * Custom filters/actions
 *
 * @package   PT_Content_Views
 * @author    PT Guy <palaceofthemes@gmail.com>
 * @license   GPL-2.0+
 * @link      http://www.contentviewspro.com/
 * @copyright 2014 PT Guy
 */
if ( !class_exists( 'PT_CV_Hooks' ) ) {

	/**
	 * @name PT_CV_Hooks
	 */
	class PT_CV_Hooks {

		/**
		 * Add custom filters/actions
		 */
		static function init() {
			// Filter Output
			add_filter( PT_CV_PREFIX_ . 'validate_settings', array( __CLASS__, 'filter_validate_settings' ), 10, 2 );

			// Do action
		}

		/**
		 * Validate settings filter
		 *
		 * @param string $errors The error message
		 * @param array  $args  The Query parameters array
		 */
		public static function filter_validate_settings( $errors, $args ) {

			$dargs = PT_CV_Functions::get_global_variable( 'dargs' );

			//			echo "<pre>";
			//			var_dump( 'query args', $args );
			//			echo "</pre>";
			//			echo "<pre>";
			//			var_dump( 'display args', $dargs );
			//			echo "</pre>";

			$messages = array(
				'field'	 => array(
					'select' => __( 'Please select an option in : ', PT_CV_TEXTDOMAIN ),
					'text'	 => __( 'Please set value in : ', PT_CV_TEXTDOMAIN ),
				),
				'tab'	 => array(
					'filter'	 => __( 'Filter Settings', PT_CV_TEXTDOMAIN ),
					'display'	 => __( 'Display Settings', PT_CV_TEXTDOMAIN ),
				),
			);

			/**
			 * Validate Query parameters
			 */
			// Post type
			if ( empty( $args[ 'post_type' ] ) ) {
				$errors[] = $messages[ 'field' ][ 'select' ] . $messages[ 'tab' ][ 'filter' ] . ' > ' . __( 'Content type', PT_CV_TEXTDOMAIN );
			}

			/**
			 * Validate common Display parameters
			 */
			// View type
			if ( empty( $dargs[ 'view-type' ] ) ) {
				$errors[] = $messages[ 'field' ][ 'select' ] . $messages[ 'tab' ][ 'display' ] . ' > ' . __( 'View type', PT_CV_TEXTDOMAIN );
			}

			// Layout format
			if ( empty( $dargs[ 'layout-format' ] ) ) {
				$errors[] = $messages[ 'field' ][ 'select' ] . $messages[ 'tab' ][ 'display' ] . ' > ' . __( 'Layout format', PT_CV_TEXTDOMAIN );
			}

			// Field settings
			if ( !isset( $dargs[ 'fields' ] ) ) {
				$errors[] = $messages[ 'field' ][ 'select' ] . $messages[ 'tab' ][ 'display' ] . ' > ' . __( 'Fields settings', PT_CV_TEXTDOMAIN ) . ' > ' . __( 'Fields display', PT_CV_TEXTDOMAIN );
			}

			// Item per page
			if ( isset( $dargs[ 'pagination-settings' ] ) ) {
				if ( empty( $dargs[ 'pagination-settings' ][ 'items-per-page' ] ) ) {
					$errors[] = $messages[ 'field' ][ 'text' ] . $messages[ 'tab' ][ 'display' ] . ' > ' . __( 'Pagination settings', PT_CV_TEXTDOMAIN ) . ' > ' . __( 'Items per page', PT_CV_TEXTDOMAIN );
				}
			}

			/**
			 * Validate Display parameters of view types
			 */
			if ( !empty( $dargs[ 'view-type' ] ) ) {
				switch ( $dargs[ 'view-type' ] ) {
					case 'grid':
						if ( empty( $dargs[ 'number-columns' ] ) ) {
							$errors[] = $messages[ 'field' ][ 'text' ] . $messages[ 'tab' ][ 'display' ] . ' > ' . __( 'View type settings', PT_CV_TEXTDOMAIN ) . ' > ' . __( 'Items per row', PT_CV_TEXTDOMAIN );
						}
						break;
				}
			}

			return array_filter( $errors );
		}

	}

}
