<?php

namespace Saber\Access;

class Access {

  public $user;
  public $course;
  public $grant = false;

  public function __construct() {



  }

  public function courseAccess( $course ) {

    $this->user = wp_get_current_user();
    $this->course = $course;

  }

  public function renderBlockMessage() {
    print '<div class="saber-access-block">';
    print 'Sorry, you do not currently have access to this course.';
    print '</div>';
  }

}
