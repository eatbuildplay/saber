<?php

namespace Saber\Exam\Model;

class Question {

  public $id;
  public $title;
  public $type = 'question';
  public $body;
  public $type;
  public $options;
  public $correct; // index of the correct option

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Question;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    $obj->type = get_post_meta( $obj->id, 'question_type', 1);
    $obj->body = get_post_meta( $obj->id, 'question_body', 1);

    $optionsArray = get_post_meta( $obj->id, 'question_options', 1);
    $options = [];
    foreach( $optionsArray as $optionId ) {
      $options[] = \Saber\Exam\Model\QuestionOption::load( $optionId );
    }
    $obj->options = $options;

    return $obj;

  }

}
