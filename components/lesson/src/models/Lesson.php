<?php

namespace Saber\Lesson\Model;

class Lesson {

  public $id;
  public $title;
  public $course;

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

    return $obj;

  }

}
