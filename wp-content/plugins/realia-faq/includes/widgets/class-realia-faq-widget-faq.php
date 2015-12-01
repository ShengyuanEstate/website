<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_FAQ_Widget_FAQ
 *
 * @class Realia_FAQ_Widget_FAQ
 * @package Realia_FAQ/Classes/Widgets
 * @author Pragmatic Mates
 */
class Realia_FAQ_Widget_FAQ extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function Realia_FAQ_Widget_FAQ() {
		parent::__construct(
			'faq_widget', __( 'FAQ', 'realia-faq' ),
			array(
				'description' => __( 'Displays FAQ as accordions.', 'realia-faq' ),
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
			'post_type'         => 'faq',
			'posts_per_page'    => -1,
		) );

		include Realia_Template_Loader::locate( 'widgets/faq', REALIA_FAQ_DIR );

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
		include Realia_Template_Loader::locate( 'widgets/faq-admin', REALIA_FAQ_DIR );
	}
}