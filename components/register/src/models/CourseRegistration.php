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

    if( $result ) {
      $this->id = $result;
    } else {
      return false;
    }

    update_field( 'student', $this->student->user->ID, $this->id );
    update_field( 'course', $this->course->id, $this->id );

    return $result;

  }

  public function duplicate() {
    return false;
  }

  public function fetchAllStudent( $student = false ) {

    if( !$student ) {
      $student = \Saber\Student\Model\Student::load();
    }

    $posts = get_posts([
      'post_type'   => 'course_registration',
      'numberposts' => -1,
      'meta_query'  => [
        [
          'key' => 'student',
          'value' => $student->user->ID
        ]
      ]
    ]);

    if( !empty( $posts )) {
      $courses = [];
      foreach( $posts as $post ) {
        $courses[] = $this->load( $post );
      }
      return $courses;
    }

    return false;

  }

  public function fetchAllCourse( $student ) {

  }

  public function fetch( $student, $course ) {

    $posts = get_posts([
      'post_type'   => 'course_registration',
      'numberposts' => 1,
      'meta_query'  => [
        [
          'key' => 'student',
          'value' => $student->user->ID
        ],
        [
          'key' => 'course',
          'value' => $course->id
        ]
      ]
    ]);

    if( !empty( $posts )) {
      return $this->load( $posts[0] );
    }

    return false;

  }

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new CourseRegistration;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;
    $obj->registrationDate = get_the_date( 'Y-m-d', $post );

    $fields = get_fields($post);

    $obj->student = \Saber\Student\Model\Student::load( $fields['student'] );
    $obj->course = \Saber\Course\Model\Course::load( $fields['course'] );

    return $obj;

  }

}
