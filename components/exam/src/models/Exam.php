<?php

namespace Saber\Exam\Model;

class Exam {

  public $id;
  public $title;
  public $questions;
  public $timeline;

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new Exam;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    // $obj->questions = QuestionList::load();

    // course editor data
    $key = 'saber_exam_timeline_data';
    $timelineData = get_post_meta( $post->ID, $key, true );

    $obj->timeline = new \stdClass;
    $obj->timeline->items = [];
    $obj->timeline->data = json_decode( $timelineData );

    if(!empty( $obj->timeline->data )) {
      foreach( $obj->timeline->data as $item ) {
        if( $item->type == 'question' ) {
          $obj->timeline->items[] = \Saber\Question\Model\Question::load( $item->id );
        }
      }
    }

    return $obj;

  }

}
