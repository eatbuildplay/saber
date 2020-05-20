<?php

namespace Frame\Exam\Model;

class QuestionAnswerList {

  public $questions;

  public static function load( $posts ) {

    $objs = [];
    foreach( $posts as $post ) {
      $objs[] = QuestionAnswer::load( $post );
    }
    return $objs;

  }

}
