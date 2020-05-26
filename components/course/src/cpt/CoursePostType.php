<?php

namespace Saber\Course;

class CoursePostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'course';
  }

}
