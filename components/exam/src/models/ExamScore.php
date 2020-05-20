<?php

namespace Frame\Exam\Model;

class ExamScore {

  public $id;
  public $title;
  public $exam;
  public $user;
  public $start;


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
    update_post_meta( $this->id, 'user', $uid );
    update_post_meta( $this->id, 'exam', $this->exam );
    update_post_meta( $this->id, 'start', date('Y-m-d H:i:s') );

  }

  public function create() {

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

    $fields = get_fields($post);

    $obj->user = $fields['user'];
    $obj->exam = $fields['exam'];
    $obj->start = $fields['start'];

    return $obj;

  }

}
