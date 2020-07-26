<?php

namespace Saber\Exam\Model;

class QuestionOption {

  public $id;
  public $title;
  public $label;

  public static function load( $post ) {

    $obj = new QuestionOption;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    return $obj;

  }

}
