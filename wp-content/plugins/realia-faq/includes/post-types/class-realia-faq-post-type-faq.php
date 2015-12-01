<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Class Realia_FAQ_Post_Type_FAQ
 *
 * @class Realia_FAQ_Post_Type_FAQ
 * @package Realia_FAQ/Classes/Post_Types
 * @author Pragmatic Mates
 */
class Realia_FAQ_Post_Type_FAQ {
	/**
	 * Initialize custom post type
	 *
	 * @access public
	 * @return void
	 */
	public static function init() {
		add_action( 'init', array( __CLASS__, 'definition' ) );
        add_filter( 'enter_title_here', array( __CLASS__, 'title' ) );
	}

	/**
	 * Custom post type definition
	 *
	 * @access public
	 * @return void
	 */
	public static function definition() {

		$labels = array(
			'name'                  => __( 'FAQ', 'realia-faq' ),
			'singular_name'         => __( 'FAQ', 'realia-faq' ),
			'add_new'               => __( 'Add New FAQ', 'realia-faq' ),
			'add_new_item'          => __( 'Add New FAQ', 'realia-faq' ),
			'edit_item'             => __( 'Edit FAQ', 'realia-faq' ),
			'new_item'              => __( 'New FAQ', 'realia-faq' ),
			'all_items'             => __( 'FAQ', 'realia-faq' ),
			'view_item'             => __( 'View FAQ', 'realia-faq' ),
			'search_items'          => __( 'Search FAQ', 'realia-faq' ),
			'not_found'             => __( 'No FAQ found', 'realia-faq' ),
			'not_found_in_trash'    => __( 'No FAQ found in Trash', 'realia-faq' ),
			'parent_item_colon'     => '',
			'menu_name'             => __( 'FAQ', 'realia-faq' ),
		);

		register_post_type( 'faq',
			array(
				'labels'            => $labels,
				'supports'          => array( 'title', 'editor' ),
				'public'            => false,
				'show_ui'           => true,
				'show_in_menu'      => method_exists( 'Realia_Admin_Menu', 'admin_menu' ) ? 'realia' : true,
				'menu_icon'         => 'dashicons-editor-help',
                'menu_position'     => 55,
			)
		);
	}

    /**
     * Replaces placeholder in "title" field
     *
     * @param $input
     * @return string|void
     */
    public static function title( $input ) {
        global $post_type;

        if ( is_admin() && 'faq' == $post_type ) {
            return __( "Frequently Asked Question", 'realia-faq' );
        }

        return $input;
    }
}

Realia_FAQ_Post_Type_FAQ::init();