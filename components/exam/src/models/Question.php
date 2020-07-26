<?php

namespace Saber\Exam\Model;

class Question {

  public $id;
  public $title;
  public $text;
  public $type;
  public $options;
  public $correct;

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Question;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    return $obj;

  }

}
