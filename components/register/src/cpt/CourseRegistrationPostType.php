<?php

namespace Saber\Register;

class CourseRegistrationPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'course_registration';
  }

}
