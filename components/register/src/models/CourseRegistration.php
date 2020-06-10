<?php

namespace Saber\Register\Model;

class CourseRegistration {

  public $course;
  public $student;
  public $registrationDate;

  public function create() {
    $args = [
      'post_type'   => 'course_registration',
      'post_title'  => time(),
      'post_status' => 'publish'
    ];
    $result = wp_insert_post( $args );
    return $result;
  }

  public function duplicateCheck() {
    return true;
  }

  public function fetchAllStudent( $student ) {

  }

  public function fetchAllCourse( $student ) {

  }

  public function fetch( $student, $course ) {

  }

}
