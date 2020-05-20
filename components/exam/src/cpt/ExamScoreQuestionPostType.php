<?php

namespace Saber\Exam;

class ExamScoreQuestionPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'exam_score_question';
  }

}
