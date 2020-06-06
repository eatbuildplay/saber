<?php

namespace Saber\Student\Model;

class Student {

  public $user;

  public function __construct() {



  }

  public static function load() {
    $student = new Student;
    $student->user = wp_get_current_user();
    return $student;
  }

}
