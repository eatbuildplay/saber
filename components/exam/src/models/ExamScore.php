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

    // post-based properties
    $obj->id = $post->ID;
    $obj->title = $post->post_title;
    $obj->permalink = get_permalink( $post->ID );

    // meta-based properties
    $obj->user = get_post_meta( $obj->id, 'exam_score_user', 1);
    $examId = get_post_meta( $obj->id, 'exam_score_exam', 1);
    $obj->exam = Exam::load( $examId );
    $obj->start = get_post_meta( $obj->id, 'exam_score_start', 1);
    $obj->examScoreQuestions = ExamScoreQuestionList::fetch( $obj->id );

    // calculated properties
    $obj->setQuestionCount();
    $obj->setQuestionsCorrectCount();
    $obj->setPointsAwarded();
    $obj->setPointsAwardedPercent();

    return $obj;

  }

  public function setQuestionCount() {
    $this->questionCount = count( $this->examScoreQuestions );
  }

  public function setQuestionsCorrectCount() {
    $this->questionsCorrectCount = 0;
    $this->questionsIncorrectCount = 0;
    foreach( $this->examScoreQuestions as $esq ) {
      if( $esq->correct ) {
        $this->questionsCorrectCount++;
      } else {
        $this->questionsIncorrectCount++;
      }
    }
  }

  public function setPointsAwarded() {
    $this->pointsAwarded = 0;
    foreach( $this->examScoreQuestions as $esq ) {
      if( $esq->correct ) {
        $this->pointsAwarded++;
      }
    }
  }

  /*
   * Returns number from 0-100
   * Uses round(), default up to 2 decimal points
   */
  public function setPointsAwardedPercent() {
    if( $this->pointsAwarded ) {
      $this->pointsAwardedPercent = round(($this->pointsAwarded / $this->questionCount) * 100);
    } else {
      $this->pointsAwardedPercent = 0;
    }
  }

}
