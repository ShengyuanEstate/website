<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Pricing_Widget_Pricing_Tables
 *
 * @class Realia_Pricing_Widget_Pricing_Tables
 * @package Realia_Pricing/Classes/Widgets
 * @author Pragmatic Mates
 */
class Realia_Pricing_Widget_Pricing_Tables extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function Realia_Pricing_Widget_Pricing_Tables() {
		parent::__construct(
			'pricing_widget',
			__( 'Pricing Tables', 'realia-pricing' ),
			array(
				'description' => __( 'Displays pricing tables', 'realia-pricing' ),
			)
		);
	}

	/**
	 * Frontend
	 *
	 * @access public
	 * @param array $args
	 * @param array $instance
	 * @return void
	 */
	function widget( $args, $instance ) {
		query_posts( array(
			'post_type'         => 'pricing_table',
		) );

		include Realia_Template_Loader::locate( 'widgets/pricing', REALIA_PRICING_DIR );

		wp_reset_query();
	}

	/**
	 * Update
	 *
	 * @access public
	 * @param array $new_instance
	 * @param array $old_instance
	 * @return array
	 */
	function update( $new_instance, $old_instance ) {
		return $new_instance;
	}

	/**
	 * Backend
	 *
	 * @access public
	 * @param array $instance
	 * @return void
	 */
	function form( $instance ) {
		include Realia_Template_Loader::locate( 'widgets/pricing-admin', REALIA_PRICING_DIR );
	}
}