<?php

namespace Saber\Exam;

class QuestionBankPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'question_bank';
  }

}
