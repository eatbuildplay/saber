<?php

namespace Saber\Register;

class CourseRegisterPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'course_registration';
  }

}
