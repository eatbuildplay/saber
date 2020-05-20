<?php

namespace Frame\Student;

class Student {

  public function __construct() {

    add_action('init', [$this, 'getCurrentUser']);

  }

  public function getCurrentUser() {

    $user = \wp_get_current_user();
    $name = $user->data->display_name;
    // print '<h2>' . $name . '</h2>';

  }

}
