<?php

namespace Saber\Lesson\Model;

class Lesson {

  public $id;
  public $title;
  public $course;
  public $displayOrder;
  public $exam;

  public function load( $post ) {

    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Lesson;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;
    $obj->permalink = get_permalink( $post->ID );

    $fields = get_fields($post->ID);
    $obj->course = \Saber\Course\Model\Course::load( $fields['course'] );
    $obj->displayOrder = $fields['display_order'];

    if( isset( $fields['exam'] ) && $fields['exam'] > 0 ) {
      $obj->exam = \Saber\Exam\Model\Exam::load( $fields['exam'] );
    } else {
      $obj->exam = 0;
    }

    return $obj;

  }

}
