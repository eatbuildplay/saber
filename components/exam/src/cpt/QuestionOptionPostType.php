<?php

namespace Frame\Exam;

class QuestionOptionPostType extends \Frame\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'question_option';
  }

}
