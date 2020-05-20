<?php

namespace Saber\Exam\Model;

class QuestionList {

  public $questions;

  public static function load( $posts ) {

    $objs = [];
    foreach( $posts as $post ) {
      $objs[] = Question::load( $post );
    }
    return $objs;
    
  }

}
