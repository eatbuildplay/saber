<?php

namespace Saber\Course;

class Course {

  public function __construct() {

    require_once( SABER_PATH . 'components/course/src/CoursePostList.php' );
    new CoursePostList();

    require_once( SABER_PATH . 'components/course/src/CourseLessonPostList.php' );
    new CourseLessonPostList();

    require_once( SABER_PATH . 'components/course/models/Course.php' );

  }

}
