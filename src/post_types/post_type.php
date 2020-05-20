<?php

function custom_post_type() {

	$labels = array(
		'name'                  => _x( 'Plans', 'Post Type General Name', 'saber' ),
		'singular_name'         => _x( 'Plan', 'Post Type Singular Name', 'saber' ),
		'menu_name'             => __( 'Plans', 'saber' ),
		'name_admin_bar'        => __( 'Plans', 'saber' ),
		'archives'              => __( 'Item Archives', 'saber' ),
		'attributes'            => __( 'Item Attributes', 'saber' ),
		'parent_item_colon'     => __( 'Parent Item:', 'saber' ),
		'all_items'             => __( 'All Items', 'saber' ),
		'add_new_item'          => __( 'Add New Item', 'saber' ),
		'add_new'               => __( 'Add New', 'saber' ),
		'new_item'              => __( 'New Item', 'saber' ),
		'edit_item'             => __( 'Edit Item', 'saber' ),
		'update_item'           => __( 'Update Item', 'saber' ),
		'view_item'             => __( 'View Item', 'saber' ),
		'view_items'            => __( 'View Items', 'saber' ),
		'search_items'          => __( 'Search Item', 'saber' ),
		'not_found'             => __( 'Not found', 'saber' ),
		'not_found_in_trash'    => __( 'Not found in Trash', 'saber' ),
		'featured_image'        => __( 'Featured Image', 'saber' ),
		'set_featured_image'    => __( 'Set featured image', 'saber' ),
		'remove_featured_image' => __( 'Remove featured image', 'saber' ),
		'use_featured_image'    => __( 'Use as featured image', 'saber' ),
		'insert_into_item'      => __( 'Insert into item', 'saber' ),
		'uploaded_to_this_item' => __( 'Uploaded to this item', 'saber' ),
		'items_list'            => __( 'Items list', 'saber' ),
		'items_list_navigation' => __( 'Items list navigation', 'saber' ),
		'filter_items_list'     => __( 'Filter items list', 'saber' ),
	);
	$args = array(
		'label'                 => __( 'Plan', 'saber' ),
		'description'           => __( 'Make business plans, marketing plans and other plan documents.', 'saber' ),
		'labels'                => $labels,
		'supports'              => array( 'title', 'editor' ),
		'taxonomies'            => array( 'category', 'post_tag' ),
		'hierarchical'          => false,
		'public'                => true,
		'show_ui'               => true,
		'show_in_menu'          => true,
		'menu_position'         => 5,
		'show_in_admin_bar'     => true,
		'show_in_nav_menus'     => true,
		'can_export'            => true,
		'has_archive'           => true,
		'exclude_from_search'   => false,
		'publicly_queryable'    => true,
		'capability_type'       => 'page',
		'show_in_rest'       		=> true,
	);
	register_post_type( 'saber_plan', $args );

	// move this so it only runs on changes
	flush_rewrite_rules();

}
add_action( 'init', 'custom_post_type', 0 );
