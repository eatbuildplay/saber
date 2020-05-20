<?php

namespace Frame\Exam\Model;

class ExamScoreList {

  public $objects;

  public static function load( $posts ) {

    $objs = [];
    foreach( $posts as $post ) {
      $objs[] = ExamScore::load( $post );
    }
    $this->objects = $objs;
    return $objs;

  }

}
