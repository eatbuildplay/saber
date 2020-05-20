<?php

namespace Frame\Exam\Model;

class QuestionOptionList {

  public $questions;

  public static function load( $posts ) {

    $objs = [];
    foreach( $posts as $post ) {
      $objs[] = QuestionOption::load( $post );
    }
    return $objs;

  }

}
