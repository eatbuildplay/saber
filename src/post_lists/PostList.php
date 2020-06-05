<?php

namespace Saber;

class PostList {

  public $saberLoaderKey = 'saber_post_list_load';
  public $loadHook = 'saber_post_list_load';

  public function __construct() {

    add_action( 'elementor/widgets/widgets_registered', [ $this, 'initWidgets' ] );

    $this->initShortcode();
    $this->initAjaxHooks();

    add_action('wp_enqueue_scripts', [$this, 'addScripts']);

  }

  public function initWidgets() {

    require_once( SABER_PATH . 'src/post_lists/elementor/PostListWidget.php' );
    \Elementor\Plugin::instance()->widgets_manager->register_widget_type( new PostListWidget() );

  }

  public function getPostType() {
    return 'post';
  }

  public function initShortcode() {
    require_once( SABER_PATH . 'src/post_lists/PostListShortcode.php' );
    new PostListShortcode( $this->saberLoaderKey, $this->getShortcodeTag() );
  }

  // enable override shortcode tag
  public function getShortcodeTag() {
    return false;
  }

  public function initAjaxHooks() {

    // setup ajax hooks
    add_action('wp_ajax_' . $this->loadHook, [$this, 'ajaxListLoad']);
    add_action('wp_ajax_nopriv_' . $this->loadHook, [$this, 'ajaxListLoad']);

  }

  public function order() {
    return [
      'orderBy' => 'title',
      'order'   => 'ASC'
    ];
  }

  public function setMetakey() {
    return false;
  }

  public function fetchPosts( $metaquery, $taxquery ) {

    $order = $this->order();

    $postType = $this->getPostType();
    $queryArgs = array(
      'numberposts' => -1,
      'post_type'   => $postType,
      'meta_query'  => $metaquery,
      'tax_query'   => $taxquery,
      'orderby'     => $order['orderby'],
      'order'       => $order['order']
    );

    if( $this->setMetakey() ) {
      $queryArgs['meta_key'] = $this->setMetakey();
    }
    $posts = get_posts( $queryArgs );
    return $posts;

  }

  public function addScripts() {

    wp_enqueue_style(
      'saber-post-list-css',
      SABER_URL . 'src/post_lists/assets/post_list.css',
      array(),
      '1.0.0',
      'all'
    );

    wp_enqueue_script(
      'saber-post-list-js',
      SABER_URL . 'src/post_lists/assets/post_list.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    /*
     * Localize JS including post ID
     */
    global $post;
    wp_localize_script(
      'saber-post-list-js',
      $this->saberLoaderKey,
      [
        'ajaxurl' => admin_url( 'admin-ajax.php' ),
        'postListLoadHook' => $this->loadHook,
        'postId' => $post->ID
      ]
    );

  }

  /*
   * Setup the list item template
   * Returns the prepared Template object
   * Override to use custom list item template
   */
  public function listItemTemplate() {

    $template = new Template();
    $template->path = 'src/post_lists/templates/';
    $template->name = 'post-list-item';
    return $template;

  }

  /*
   * Setup the list template
   * Returns the prepared Template object
   * Override to use custom list item template
   */
  public function listTemplate() {

    $template = new Template();
    $template->path = 'src/post_lists/templates/';
    $template->name = 'post-list';
    return $template;

  }

  public function metaQuery( $postId ) {
    return [];
  }

  public function ajaxListLoad() {

    // get filter values
    if( isset( $_POST['filters'] )) {
      $filters = $_POST['filters'];
    }

    // get post id
    if( isset( $_POST['postId'] )) {
      $postId = $_POST['postId'];
    }

    // setup metaquery
    $metaquery = $this->metaQuery( $postId );
    $taxquery = [];

    // fetch posts
    $posts = $this->fetchPosts( $metaquery, $taxquery );

    // get list item template
    $template = $this->listItemTemplate();

    // test if we can autoload the post model
    $modelBaseName = ucfirst( $this->getPostType() );
    $modelClassPath = '\Saber\Course\Model\\' . $modelBaseName;
    $classExists = class_exists( $modelClassPath );

    // load list item template
    $listItems = '';
    if( !empty( $posts )) :
      foreach( $posts as $index => $post ) :

        // autoload model
        if( $classExists ) {
          $model = \Saber\Course\Model\Course::load( $post );
        } else {
          $model = false;
        }

        $template->data = array(
          'model' => $model,
          'post'  => $post,
          'order' => $index+1
        );
        $listItems .= $template->get();
      endforeach;

    endif;

    /* add list item content to wrapper template */
    $template = $this->listTemplate();
    $template->data = array(
      'listItems' => $listItems
    );
    $content .= $template->get();

    // send response and exit
    $response = [
      'posts'       => $posts,
      'content'     => $content,
      'status'      => 'success'
    ];
    print json_encode( $response );
    wp_die();

  }

}
