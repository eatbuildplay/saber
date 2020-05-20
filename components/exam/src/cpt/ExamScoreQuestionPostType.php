<?php

namespace Frame\Exam;

class ExamScoreQuestionPostType extends \Frame\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'exam_score_question';
  }

}
