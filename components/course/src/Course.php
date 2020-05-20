<?php

namespace Saber\Course;

class Course {

  public function __construct() {

    require_once( Saber_PATH . 'components/course/src/CoursePostList.php' );
    new CoursePostList();

    require_once( Saber_PATH . 'components/course/src/CourseLessonPostList.php' );
    new CourseLessonPostList();

  }

}
