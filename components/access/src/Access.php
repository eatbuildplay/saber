<?php

namespace Saber\Access;

class Access {

  public $student;
  public $course;
  public $grant = false;

  public function __construct() {

    add_action('wp', [$this, 'run']);

    /* script calls */
    add_action('wp_enqueue_scripts', [$this, 'scripts']);

  }

  public function run() {

    global $post;
    if( $post->post_type != 'course' ) {
      return;
    }

    // is course, proceed with check
    $course = \Saber\Course\Model\Course::load( $post );
    $this->courseAccess( $course );

    // stash into global
    $GLOBALS['saberAccess'] = $this;

  }

  public function courseAccess( $course ) {

    $this->student = \Saber\Student\Model\Student::load();
    $this->course = $course;

    // check for public access course
    if( $this->course->publicAccess ) {
      $this->grant = 1;
    }

    // check user is registered
    if( $this->student->user->ID != 0 ) {
      $this->grant = 1;
    }

    // check if paid membership required


  }

  public function renderBlockMessage() {
    print '<div class="saber-access-block">';
    print 'Sorry, you do not currently have access to this course.';
    print '</div>';
  }

  public function scripts() {

    wp_enqueue_script(
      'saber-access-js',
      SABER_URL . 'components/access/assets/access.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    wp_localize_script(
      'saber-access-js',
      'saberCourseAccess',
      [
        'access' => $GLOBALS['saberAccess']
      ]
    );

  }

}