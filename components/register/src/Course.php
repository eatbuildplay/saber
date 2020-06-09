<?php

/*
 *
 * Handles course registrations
 *
 */

namespace Saber\Register;

class Course {

  public $student;
  public $course;
  public $registered = false;

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
    $this->check( $course );

    // stash into global
    $GLOBALS['saberRegisterCourse'] = $this;

  }

  public function check( $course ) {

    $this->student = \Saber\Student\Model\Student::load();
    $this->course = $course;

    // check if registered


  }

  public function scripts() {

    wp_enqueue_script(
      'saber-register-course-js',
      SABER_URL . 'components/register/assets/register_course.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    wp_localize_script(
      'saber-register-course-js',
      'saberCourseRegistry',
      [
        'data' => $GLOBALS['saberRegisterCourse']
      ]
    );

  }

}
