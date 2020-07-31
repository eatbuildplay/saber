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
    update_post_meta( $this->id, 'exam_score_question_user', $uid );

    update_post_meta( $this->id, 'exam_score_question_exam_score', $this->examScore );

    if( is_object( $this->questionAnswer )) {
      update_post_meta( $this->id, 'exam_score_question_question_answer', $this->questionAnswer->id );
    } else {
      update_post_meta( $this->id, 'exam_score_question_question_answer', $this->questionAnswer );
    }

    update_post_meta( $this->id, 'exam_score_question_correct', $this->correct );
    update_post_meta( $this->id, 'exam_score_question_points', $this->points );

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

    $obj->user = get_post_meta( $obj->id, 'exam_score_question_user', 1 );
    $obj->examScore = get_post_meta( $obj->id, 'exam_score_question_exam_score', 1 );
    $obj->questionAnswer = get_post_meta( $obj->id, 'exam_score_question_question_answer', 1 );
    $obj->correct = get_post_meta( $obj->id, 'exam_score_question_correct', 1 );
    $obj->points = get_post_meta( $obj->id, 'exam_score_question_points', 1 );

    return $obj;

  }

}
