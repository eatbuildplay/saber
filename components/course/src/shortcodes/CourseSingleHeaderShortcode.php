<?php

namespace Saber\Course;

class CourseSingleHeaderShortcode {

  public $tag = 'course-single-header';

  public function __construct() {

    add_action('init', array( $this, 'init'));

  }

  public function init() {
    add_shortcode($this->tag, array($this, 'doShortcode'));
  }

  public function doShortcode( $atts ) {

    global $post;
    $course = Model\Course::load( $post );

    $template = new \Saber\Template();
    $template->path = 'components/course/templates/';

    $content = '';

    // main template
    $template->name = 'course-single-header';
    $template->data = array(
      'course' => $course,
    );
    $content .= $template->get();

    return $content;

  }

}
