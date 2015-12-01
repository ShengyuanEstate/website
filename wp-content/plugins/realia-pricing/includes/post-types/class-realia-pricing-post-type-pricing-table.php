<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_Pricing_Post_Type_Pricing_Table
 *
 * @class Realia_Pricing_Post_Type_Pricing_Table
 * @package Realia_Pricing/Classes/Post_Types
 * @author Pragmatic Mates
 */
class Realia_Pricing_Post_Type_Pricing_Table {
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
            'name'                  => __( 'Pricing Tables', 'realia-pricing' ),
			'singular_name'         => __( 'Pricing Table', 'realia-pricing' ),
			'add_new'               => __( 'Add New Pricing Table', 'realia-pricing' ),
			'add_new_item'          => __( 'Add New Pricing Table', 'realia-pricing' ),
			'edit_item'             => __( 'Edit Pricing Table', 'realia-pricing' ),
			'new_item'              => __( 'New Pricing Table', 'realia-pricing' ),
			'all_items'             => __( 'Pricing Tables', 'realia-pricing' ),
			'view_item'             => __( 'View Pricing Table', 'realia-pricing' ),
			'search_items'          => __( 'Search Pricing Table', 'realia-pricing' ),
			'not_found'             => __( 'No Pricing Tables found', 'realia-pricing' ),
			'not_found_in_trash'    => __( 'No Pricing Tables found in Trash', 'realia-pricing' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'Pricing Tables', 'realia-pricing' ),
        );

		register_post_type( 'pricing_table',
			array(
				'labels'            => $labels,
				'supports'          => array( 'title' ),
				'public'            => false,
				'show_ui'           => true,
                'show_in_menu'      => method_exists( 'Realia_Admin_Menu', 'admin_menu' ) ? 'realia' : true,
				'menu_icon'         => 'dashicons-list-view',
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
		$metaboxes[ REALIA_PRICING_PREFIX . 'general' ] = array(
            'id'                    => REALIA_PRICING_PREFIX . 'general',
            'title'                 => __( 'General Options', 'pragmaticmates' ),
            'object_types'          => array( 'pricing_table' ),
            'context'               => 'normal',
            'priority'              => 'high',
            'show_names'            => true,
            'fields'                => array(
                array(
                    'id'   => REALIA_PRICING_PREFIX . 'price',
                    'name' => __( 'Price', 'realia-pricing' ),
                    'type' => 'text_medium',
                ),
                array(
                    'id'   => REALIA_PRICING_PREFIX . 'description',
                    'name' => __( 'Description', 'realia-pricing' ),
                    'type' => 'text_medium',
                ),
                array(
                    'id'   => REALIA_PRICING_PREFIX . 'button_text',
                    'name' => __( 'Button Text', 'realia-pricing' ),
                    'type' => 'text_medium',
                ),
                array(
                    'id'   => REALIA_PRICING_PREFIX . 'button_url',
                    'name' => __( 'Button Link', 'realia-pricing' ),
                    'type' => 'text_url',
                ),
                array(
                    'id'   => REALIA_PRICING_PREFIX . 'highlighted',
                    'name' => __( 'Highlight Table?', 'realia-pricing' ),
                    'type' => 'checkbox',
                ),
            ),
		);

        $metaboxes[ REALIA_PRICING_PREFIX . 'pricing_items'] = array(
            'id'                    => REALIA_PRICING_PREFIX . 'pricing_items',
            'title'                 => __( 'Pricing Table Items', 'realia-pricing' ),
            'object_types'          => array( 'pricing_table' ),
            'context'               => 'normal',
            'priority'              => 'high',
            'show_names'            => true,
            'fields'                => array(
                array(
                    'name'          => __( 'Item (row)', 'realia-pricing' ),
                    'id'            => REALIA_PRICING_PREFIX . 'items',
                    'type'          => 'text',
                    'repeatable'    => true,
                ),
            ),
        );

		return $metaboxes;
	}
}

Realia_Pricing_Post_Type_Pricing_Table::init();