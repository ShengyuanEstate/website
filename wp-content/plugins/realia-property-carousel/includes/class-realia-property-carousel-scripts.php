<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Property_Carousel_Scripts
 *
 * @class Realia_Property_Carousel_Scripts
 * @package Realia_Property_Carousel/Classes
 * @author Pragmatic Mates
 */
class Realia_Property_Carousel_Scripts {
	/**
	 * Initialize scripts
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		add_action( 'wp_enqueue_scripts', array( __CLASS__, 'enqueue_frontend' ) );
	}

	/**
	 * Loads frontend files
	 *
	 * @access public
	 * @return void
	 */
	public static function enqueue_frontend() {
		wp_register_script( 'owl.carousel', plugins_url( '/realia-property-carousel/libraries/owl.carousel/owl.carousel.js' ), array( 'jquery' ), false, true );
		wp_enqueue_script( 'owl.carousel' );

		wp_register_style( 'owl.carousel', plugins_url( '/realia-property-carousel/libraries/owl.carousel/assets/owl.carousel.css' ) );
		wp_enqueue_style( 'owl.carousel' );
	}
}

Realia_Property_Carousel_Scripts::init();
