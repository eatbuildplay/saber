<?php

namespace Saber\Exam\Model;

class QuestionAnswer {

  public $id;
  public $title;
  public $user;
  public $question;
  public $questionOption;

  public function save() {

    $this->user = get_current_user_id();

    if( $this->id > 0 ) {
      $this->update();
    } else {
      $this->id = $this->create();
      if( !$this->id ) {
        return false;
      }
    }

    update_post_meta( $this->id, 'question_answer_user', $this->user );

    if( is_object( $this->question )) {
      update_post_meta( $this->id, 'question_answer_question', $this->question->id );
    } else {
      update_post_meta( $this->id, 'question_answer_question', $this->question );
    }

    if( is_object( $this->questionOption )) {
      update_post_meta( $this->id, 'question_answer_question_option', $this->questionOption->id );
    } else {
      update_post_meta( $this->id, 'question_answer_question_option', $this->questionOption );
    }

  }

  public function create() {

    $this->title = 'Question ' . $this->question . ', User ' . $this->user;

    $params = [
      'post_type'   => 'question_answer',
      'post_title'  => $this->title,
      'post_status' => 'publish'
    ];
    $postId = wp_insert_post( $params );
    $this->id = $postId;
    return $postId;

  }

  public static function load( $post ) {

    $obj = new QuestionAnswer;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;

    $obj->user = get_post_meta( $obj->id, 'question_answer_user', 1 );
    $obj->question = get_post_meta( $obj->id, 'question_answer_question', 1 );
    $obj->questionOption = get_post_meta( $obj->id, 'question_answer_question_option', 1 );

    return $obj;

  }

}
