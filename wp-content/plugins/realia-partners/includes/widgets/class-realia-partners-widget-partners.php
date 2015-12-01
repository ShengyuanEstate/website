<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Partners_Widget_Partners
 *
 * @class Realia_Partners_Widget_Partners
 * @package Realia_Partners/Classes/Widgets
 * @author Pragmatic Mates
 */
class Realia_Partners_Widget_Partners extends WP_Widget {
	/**
	 * Initialize widget
	 *
	 * @access public
	 * @return void
	 */
	function Realia_Partners_Widget_Partners() {
		parent::__construct(
			'partners_widget',
			__( 'Partners', 'realia-partners' ),
			array(
				'description' => __( 'Displays partners widget', 'realia-partners' ),
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
			'post_type'         => 'partner',
			'posts_per_page'    => ! empty( $instance['count'] ) ? $instance['count'] : 3,
		) );

		include Realia_Template_Loader::locate( 'widgets/partners', REALIA_PARTNERS_DIR );

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
		include Realia_Template_Loader::locate( 'widgets/partners-admin', REALIA_PARTNERS_DIR );
	}
}