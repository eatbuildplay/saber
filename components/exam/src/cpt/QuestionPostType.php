<?php

namespace Saber\Exam;

class QuestionPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'question';
  }

}
