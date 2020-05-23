<?php

namespace Saber\Exam\Model;

class ExamScore {

  public $id;
  public $title;
  public $exam;
  public $user;
  public $start;
  public $questions = [];

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

    update_field( 'user', $this->user, $this->id );
    update_field( 'exam', $this->exam, $this->id );
    update_field( 'start', date('Y-m-d H:i:s'), $this->id );

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

    $fields = get_fields($post->ID);

    $obj->user = $fields['user'];
    $obj->exam = $fields['exam'];
    $obj->start = $fields['start'];

    $obj->questions = ExamScoreQuestionList::fetch( $obj->id );

    return $obj;

  }

}
