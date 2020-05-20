<?php

namespace Saber;

class PostListShortcode {

  public $tag = 'saber-post-list';

  public function __construct( $saberLoaderKey, $tag = false ) {
    if( $tag ) {
      $this->tag = $tag;
    }
    $this->saberLoaderKey = $saberLoaderKey;
    add_action('init', array( $this, 'init'));
  }

  public function init() {
    add_shortcode($this->tag, array($this, 'doShortcode'));
  }

  public function doShortcode( $atts ) {

    $atts = shortcode_atts( array(), $atts, $this->tag );
    $template = new Template();
    $template->path = 'src/post_lists/templates/';
    $template->name = 'post-list-canvas';
    $template->data = array(
      'saberLoaderKey' => $this->saberLoaderKey
    );
    return $template->get();

  }

}
