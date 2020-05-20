<?php

namespace Saber\Exam;

class QuestionOptionPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'question_option';
  }

}
