<?php

namespace Frame\Exam\Model;

class Exam {

  public $id;
  public $title;
  public $questions;

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Exam;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    $fields = get_fields($post);

    $obj->questions = QuestionList::load( $fields['questions'] );

    return $obj;

  }

}
