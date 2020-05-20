<?php

namespace Frame\Exam;

class QuestionAnswerPostType extends \Frame\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'question_answer';
  }

}
