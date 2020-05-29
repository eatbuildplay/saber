<?php

namespace Saber\Student;

class Student {

  public function __construct() {

    add_action('init', [$this, 'getCurrentUser']);

  }

  public function getCurrentUser() {

    $user = \wp_get_current_user();
    return $user;

  }

}
