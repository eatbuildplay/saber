<?php

namespace Frame\Exam\Model;

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

    $fields = get_fields($post);
    $obj->type = $fields['question_type'];

    $obj->options = QuestionOptionList::load( $fields['options'] );
    $obj->correct = QuestionOption::load( $fields['correct'] );

    return $obj;

  }

}
