<?php

namespace Saber\Exam;

class QuestionTypePostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'question_type';
  }

}
