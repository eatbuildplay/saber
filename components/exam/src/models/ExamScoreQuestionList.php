<?php

namespace Saber\Exam\Model;

class ExamScoreQuestionList {

  public $items;

  public static function fetch( $examScoreId ) {

    $posts = get_posts([
      'post_type'   => 'exam_score_question',
      'numberposts'	=> -1,
      'meta_query'  => [
        [
          'key'   => 'exam_score_question_exam_score',
          'value' => $examScoreId
        ]
      ]
    ]);

    return self::load($posts);

  }

  public static function load( $posts ) {

    $objs = [];
    foreach( $posts as $post ) {
      $objs[] = ExamScoreQuestion::load( $post );
    }

    return $objs;

  }

}
