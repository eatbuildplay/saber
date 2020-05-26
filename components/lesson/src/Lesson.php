<?php

namespace Saber\Lesson;

class Lesson {

  public function __construct() {

    add_action('wp_ajax_saber_lesson_list_load', [$this, 'jxListLoad']);
    add_action('wp_ajax_nopriv_saber_lesson_list_load', [$this, 'jxListLoad']);

    require_once( SABER_PATH . 'components/lesson/src/LessonSingleShortcode.php' );
    new LessonSingleShortcode();

    require_once( SABER_PATH . 'components/lesson/src/LessonPostList.php' );
    new LessonPostList();

    add_action('init', [$this, 'registerPostTypes']);
    add_action('init', [$this, 'registerFields']);

    add_action('wp_enqueue_scripts', [$this, 'addScripts']);

  }

  public function registerPostTypes() {

    require_once( SABER_PATH . 'components/lesson/src/cpt/LessonPostType.php' );
    $pt = new LessonPostType();
    $pt->register();

  }

  public function registerFields() {
    require_once( SABER_PATH . 'components/lesson/assets/fields.php' );
  }

  public function addScripts() {

    wp_enqueue_style(
      'saber-lesson-style',
      SABER_URL . 'components/lesson/assets/lesson.css',
      array(),
      '1.0.0',
      'all'
    );

    wp_enqueue_script(
      'saber-lesson-js',
      SABER_URL . 'components/lesson/assets/lesson.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

  }

}
