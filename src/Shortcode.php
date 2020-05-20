<?php

namespace Frame;

class Shortcode {

  public $tag = 'frame-shortcode';
  public $templatePath = 'templates/';
  public $templateName = 'shortcode';
  public $templateData = [];

  public function __construct() {
    add_action('init', array( $this, 'init'));
  }

  public function init() {
    add_shortcode($this->tag, array($this, 'doShortcode'));
  }

  public function doShortcode( $atts ) {

    $atts = shortcode_atts( array(), $atts, $this->tag );
    $template = new Template();
    $template->path = $this->templatePath;
    $template->name = $this->templateName;
    $template->data = $this->templateData;
    return $template->get();

  }

}
