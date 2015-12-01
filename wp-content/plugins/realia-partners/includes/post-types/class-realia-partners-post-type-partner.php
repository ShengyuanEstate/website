<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Partners_Post_Type_Partner
 *
 * @class Realia_Partners_Post_Type_Partner
 * @package Realia_Partners/Classes/Post_Types
 * @author Pragmatic Mates
 */
class Realia_Partners_Post_Type_Partner {
	/**
	 * Initialize custom post type
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
		add_filter( 'cmb2_meta_boxes', array( __CLASS__, 'fields' ) );
	}

	/**
	 * Custom post type definition
	 *
	 * @access public
	 * @return void
	 */
	public static function definition() {
		$labels = array(
			'name'                  => __( 'Partners', 'realia-partners' ),
			'singular_name'         => __( 'Partner', 'realia-partners' ),
			'add_new'               => __( 'Add New Partner', 'realia-partners' ),
			'add_new_item'          => __( 'Add New Partner', 'realia-partners' ),
			'edit_item'             => __( 'Edit Partner', 'realia-partners' ),
			'new_item'              => __( 'New Partner', 'realia-partners' ),
			'all_items'             => __( 'Partners', 'realia-partners' ),
			'view_item'             => __( 'View Partner', 'realia-partners' ),
			'search_items'          => __( 'Search Partner', 'realia-partners' ),
			'not_found'             => __( 'No Partners found', 'realia-partners' ),
			'not_found_in_trash'    => __( 'No Partners found in Trash', 'realia-partners' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Partners', 'realia-partners' ),
		);

		register_post_type( 'partner',
			array(
				'labels'            => $labels,
				'supports'          => array( 'title', 'thumbnail' ),
				'public'            => false,
				'show_ui'           => true,
                'show_in_menu'      => method_exists( 'Realia_Admin_Menu', 'admin_menu' ) ? 'realia' : true,
				'menu_icon'         => 'dashicons-businessman',
                'menu_position'     => 55,
			)
		);
	}

	/**
	 * Defines custom fields
	 *
	 * @access public
	 * @param array $metaboxes
	 * @return array
	 */
	public static function fields( array $metaboxes ) {
		$metaboxes['url'] = array(
			'id'                    => 'url',
			'title'                 => __( 'URL', 'realia' ),
			'object_types'          => array( 'partner' ),
			'context'               => 'normal',
			'priority'              => 'high',
			'show_names'            => true,
			'fields'                => array(
				array(
					'name'          => __( 'URL', 'realia' ),
					'type'          => 'text_url',
					'id'            => REALIA_PARTNERS_PREFIX . 'url',
				),
			),
		);

		return $metaboxes;
	}
}

Realia_Partners_Post_Type_Partner::init();