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

    add_action( 'wp_ajax_saber_course_register', array( $this, 'jxRegister'));

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
    $courseRegistration = get_user_meta(
      $this->student->user->ID,
      'saber_course_registration_' . $this->course->id
    );

    if( $courseRegistration ) {
      $this->registered = 1;
    }

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

  /*
   * Check if current student has access to register
   */
  public function canRegister() {

    $access = $GLOBALS['saberAccess'];
    if( $access->grant ) {
      return true;
    }

    return false;

  }

  public function jxRegister() {

    $courseId = $_POST['courseId'];

    $registerCourse = new Course;
    $registerCourse->student = \Saber\Student\Model\Student::load();

    // get post data
    $response = array(
      'courseId' => $courseId,
      'data'    => $data,
      'message' => 'This response message will become available in the return in your JS ajax call'
    );
    print json_encode( $response );

    // end ajax hook callbacks safely
    wp_die();

  }

  public function renderUnregisteredMessage() {
    print 'You are not registered for this course yet. Click the register button to activate your enrollment in this course.';
  }

  public function renderRegisterButton() {
    print '<h3><button class="course-register-button">Register Now</button></h3>';
  }

}
