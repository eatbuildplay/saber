<?php

namespace Saber\Exam;

class QuestionAnswerPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'question_answer';
  }

}
