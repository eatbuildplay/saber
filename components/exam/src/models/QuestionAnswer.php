<?php

namespace Saber\Exam\Model;

class QuestionAnswer {

  public $id;
  public $title;
  public $user;
  public $question;
  public $questionOption;

  public function save() {

    $uid = get_current_user_id();
    $this->user = $uid;

    if( $this->id > 0 ) {
      $this->update();
    } else {
      $this->id = $this->create();
      if( !$this->id ) {
        return false;
      }
    }

    update_post_meta( $this->id, 'user', $uid );

    if( is_object( $this->question )) {
      update_post_meta( $this->id, 'question', $this->question->id );
    } else {
      update_post_meta( $this->id, 'question', $this->question );
    }

    if( is_object( $this->question )) {
      update_post_meta( $this->id, 'question_option', $this->questionOption->id );
    } else {
      update_post_meta( $this->id, 'question_option', $this->questionOption );
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

    $fields = get_fields($post);
    $obj->user = $fields['user'];
    $obj->question = $fields['question'];
    $obj->questionOption = $fields['question_option'];

    return $obj;

  }

}
