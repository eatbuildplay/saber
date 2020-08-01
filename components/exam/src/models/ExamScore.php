<?php

namespace Saber\Exam\Model;

class ExamScore {

  public $id;
  public $title;
  public $permalink;
  public $exam;
  public $user;
  public $start;
  public $examScoreQuestions;

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

    $this->permalink = get_permalink( $this->id );

    update_post_meta( $this->id, 'exam_score_user', $this->user );
    update_post_meta( $this->id, 'exam_score_exam', $this->exam );
    update_post_meta( $this->id, 'exam_score_start', date('Y-m-d H:i:s') );

  }

  public function create() {

    $this->title = "Exam " . $this->exam . ", User " . $this->user;

    $params = [
      'post_type'   => 'exam_score',
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

    $obj = new ExamScore;
    $obj->id = $post->ID;
    $obj->title = $post->post_title;
    $obj->permalink = get_permalink( $post->ID );

    $obj->user = get_post_meta( $obj->id, 'exam_score_user', 1);
    $examId = get_post_meta( $obj->id, 'exam_score_exam', 1);
    $obj->exam = Exam::load( $examId );

    $obj->start = get_post_meta( $obj->id, 'exam_score_start', 1);

    $obj->examScoreQuestions = ExamScoreQuestionList::fetch( $obj->id );

    return $obj;

  }

}
