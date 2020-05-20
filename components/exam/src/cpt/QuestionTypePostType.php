<?php

namespace Frame\Exam;

class QuestionTypePostType extends \Frame\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'question_type';
  }

}
