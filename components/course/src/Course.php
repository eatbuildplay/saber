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

  }

  public function registerPostTypes() {

    require_once( SABER_PATH . 'components/course/src/cpt/CoursePostType.php' );
    $pt = new CoursePostType();
    $pt->register();

  }

  public function registerFields() {
    require_once( SABER_PATH . 'components/course/assets/fields.php' );
  }

}
