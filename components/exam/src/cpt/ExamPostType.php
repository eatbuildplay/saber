<?php

namespace Saber\Exam;

class ExamPostType extends \Saber\PostType {

  public $showInMenu = false;

  public function getKey() {
    return 'exam';
  }

}
