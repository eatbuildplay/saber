<?php

namespace Saber\Course;

class Course {

  public function __construct() {

    require_once( SABER_PATH . 'components/course/src/CoursePostList.php' );
    new CoursePostList();

    require_once( SABER_PATH . 'components/course/src/CourseLessonPostList.php' );
    new CourseLessonPostList();

    require_once( SABER_PATH . 'components/course/src/models/Course.php' );

    require_once( SABER_PATH . 'components/course/src/shortcodes/CourseSingleHeaderShortcode.php' );
    new CourseSingleHeaderShortcode();

    add_action('init', [$this, 'registerPostTypes']);
    add_action('init', [$this, 'registerFields']);

    /* script calls */
    add_action('wp_enqueue_scripts', [$this, 'scripts']);


  }

  public function registerPostTypes() {

    require_once( SABER_PATH . 'components/course/src/cpt/CoursePostType.php' );
    $pt = new CoursePostType();
    $pt->register();

  }

  public function registerFields() {
    require_once( SABER_PATH . 'components/course/assets/fields/fields.php' );
  }

  public function scripts() {

    wp_enqueue_style(
      'saber-course-css',
      SABER_URL . 'components/course/assets/course.css',
      array(),
      '1.0.0',
      'all'
    );

    wp_enqueue_script(
      'saber-course-js',
      SABER_URL . 'components/course/assets/course.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

  }

}
