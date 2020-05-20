<?php

namespace Saber;

class PostType {

  public $settings = [];
  public $showInMenu = true;
  public $menuPosition = 10;

  public function getKey() {
    return 'saber';
  }

  public function getNameSingular() {
    $name = str_replace('_',' ',$this->getKey());
    return ucwords( $name );
  }

  public function getNamePlural() {
    return $this->getNameSingular() . 's';
  }

  public function getSettings() {
    $args = $this->getArguments();
    $args['labels'] = $this->getLabels();
    return $args;
  }

  public function register() {

    $key = $this->getKey();
    $settings = $this->getSettings();

    /*
    print '<pre>';
    var_dump( $key );
    var_dump( $settings );
    print '</pre>';
    die();
    */

    register_post_type( $key, $settings );

  }

  public function getArguments() {

    $nameSingular = $this->getNameSingular();

    return [
  		'label'                 => __( $nameSingular, 'saber' ),
  		'description'           => __( 'Custom post type registered with Saber.', 'saber' ),
  		'supports'              => array( 'title' ),
  		'taxonomies'            => [],
  		'hierarchical'          => false,
  		'public'                => true,
  		'show_ui'               => true,
  		'show_in_menu'          => $this->showInMenu,
  		'menu_position'         => $this->menuPosition,
  		'show_in_admin_bar'     => true,
  		'show_in_nav_menus'     => true,
  		'can_export'            => true,
  		'has_archive'           => false,
  		'exclude_from_search'   => false,
  		'publicly_queryable'    => true,
  		'capability_type'       => 'page',
  		'show_in_rest'       		=> true,
  	];

  }

  public function getLabels() {

    return [
  		'name'                  => _x( $this->getNamePlural(), 'Post Type General Name', 'saber' ),
  		'singular_name'         => _x( $this->getNameSingular(), 'Post Type Singular Name', 'saber' ),
  		'menu_name'             => __( $this->getNamePlural(), 'saber' ),
  		'name_admin_bar'        => __( $this->getNamePlural(), 'saber' ),
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
  	];

  }

}
