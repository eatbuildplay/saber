<?php

namespace Saber\Access;

class Access {

  public $student;
  public $course;
  public $grant = false;
  public $messages = [];

  public function __construct() {

    add_action('wp', [$this, 'run']);

    /* script calls */
    add_action('wp_enqueue_scripts', [$this, 'scripts']);

  }

  public function run() {

    global $post;
    if( $post->post_type != 'course' &&
        $post->post_type != 'lesson' ) {
      return;
    }

    // get course
    if( $post->post_type == 'lesson' ) {
      $lesson = $course = \Saber\Lesson\Model\Lesson::load( $post );
      $course = $lesson->course;
    } else {
      $course = \Saber\Course\Model\Course::load( $post );
    }

    // proceed with check
    $this->courseAccess( $course );

    // stash into global
    $GLOBALS['saberAccess'] = $this;

  }

  public function courseAccess( $course ) {

    $this->student = \Saber\Student\Model\Student::load();
    $this->course = $course;

    // set default course access
    if( !$this->course->courseAccess ) {
      $this->course->courseAccess = 3;
    }

    switch( $this->course->courseAccess ) {
      case 1:
        $this->grant = 1;
        break;
      case 2:
        if( $this->student->user->ID != 0 ) {
          $this->grant = 1;
        } else {
          $message = [];
          $message['body']  = 'You will need to open a Spanish10 account to access this course.';
          $message['body'] .= '<p><a href="https://spanish10.com/register/">Join Now</a></p>';
          $this->messages[] = $message;
        }
        break;
      case 3:
        if( $this->student->user->ID == 0 ) {
          $message = [];
          $message['body']  = 'You will need to open a Spanish10 account to access this course.';
          $message['body'] .= '<p><a href="https://spanish10.com/register/">Join Now</a></p>';
          $this->messages[] = $message;
          break;
        }
        $registerCourse = new \Saber\Register\Course;
        $check = $registerCourse->check( $this->course );
        if( $check ) {
          $this->grant = 1;
        } else {
          $message = [];
          $message['body']  = 'Register for this course.';
          $message['body'] .= '<p><a href="#" data-course-id="' . $this->course->id . '" class="course-register-button">Register Now</a></p>';
          $this->messages[] = $message;
        }
        break;
    }

  }

  public function renderBlockMessage() {
    print '<div class="saber-access-block">';
    foreach( $this->messages as $message ):
      print $message['body'];
    endforeach;
    print '</div>';
  }

  public function renderGrantMessage() {
    print '<div class="saber-access-grant">';
    print 'You are registered for this course.';
    print '</div>';
  }

  public function scripts() {

    wp_enqueue_style(
      'saber-access-css',
      SABER_URL . 'components/access/assets/access.css',
      [],
      '1.0.0'
    );

    wp_enqueue_script(
      'saber-access-js',
      SABER_URL . 'components/access/assets/access.js',
      array( 'jquery' ),
      '1.0.0',
      true
    );

    if( isset( $GLOBALS['saberAccess'] )) {

      wp_localize_script(
        'saber-access-js',
        'saberCourseAccess',
        [
          'access' => $GLOBALS['saberAccess']
        ]
      );

    }

  }

}
