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

    $fields = get_fields($post);
    $obj->label = $fields['label'];

    return $obj;

  }

}
