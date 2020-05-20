<?php

namespace Frame\Exam;

class QuestionBankPostType extends \Frame\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'question_bank';
  }

}
