<?php

namespace Saber\Exam\Model;

class ExamScoreQuestion {

  public $id;
  public $title;
  public $user;
  public $examScore = 0;
  public $questionAnswer;
  public $correct;
  public $points = 0;

  public function save() {

    if( $this->id > 0 ) {
      $this->update();
    } else {
      $this->id = $this->create();
      if( !$this->id ) {
        return false;
      }
    }

    $uid = get_current_user_id();
    update_field( 'user', $uid, $this->id );

    update_field( 'exam_score', $this->examScore, $this->id );

    if( is_object( $this->questionAnswer )) {
      update_field( 'question_answer', $this->questionAnswer->id, $this->id );
    } else {
      update_field( 'question_answer', $this->questionAnswer, $this->id );
    }

    update_field( 'correct', $this->correct, $this->id );
    update_field( 'points', $this->points, $this->id );

  }

  public function create() {

    $params = [
      'post_type'   => 'exam_score_question',
      'post_title'  => $this->title,
      'post_status' => 'publish'
    ];
    $postId = wp_insert_post( $params );
    $this->id = $postId;
    return $postId;

  }

  public static function load( $post ) {

    // enable passing id and loading post from id
    if( is_numeric( $post )) {
      $post = get_post( $post );
    }

    $obj = new ExamScoreQuestion;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    return $obj;

  }

}
