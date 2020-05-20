<?php

namespace Frame\Lesson;

class Lesson {

  public function __construct() {

    add_action('wp_ajax_frame_lesson_list_load', [$this, 'jxListLoad']);
    add_action('wp_ajax_nopriv_frame_lesson_list_load', [$this, 'jxListLoad']);

    require_once( FRAME_PATH . 'components/lesson/src/LessonSingleShortcode.php' );
    new LessonSingleShortcode();

    require_once( FRAME_PATH . 'components/lesson/src/LessonPostList.php' );
    new LessonPostList();

    add_action('wp_enqueue_scripts', [$this, 'addScripts']);

  }

  public function addScripts() {

    wp_enqueue_style(
      'frame-lesson-style',
      FRAME_URL . 'components/lesson/assets/lesson.css',
      array(),
      '1.0.0',
      'all'
    );

    wp_enqueue_script(
      'frame-lesson-js',
      FRAME_URL . 'components/lesson/assets/lesson.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

  }

}
