<?php

namespace Frame\Exam;

class QuestionPostType extends \Frame\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'question';
  }

}
